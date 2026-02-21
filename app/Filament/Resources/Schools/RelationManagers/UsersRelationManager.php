<?php

namespace App\Filament\Resources\Schools\RelationManagers;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    protected static ?string $title = 'School Staff';

    protected static ?string $modelLabel = 'Staff Member';

    protected static ?string $pluralModelLabel = 'Staff Members';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('role.name')
                    ->label('System Role')
                    ->badge()
                    ->formatStateUsing(function (string $state): string {
                        return match ($state) {
                            'school_admin' => 'School Admin',
                            'school_staff' => 'School Staff',
                            default => $state,
                        };
                    })
                    ->color(function (string $state): string {
                        return match ($state) {
                            'school_admin' => 'warning',
                            'school_staff' => 'info',
                            default => 'gray',
                        };
                    }),

                TextColumn::make('pivot.org_role')
                    ->label('Organization Role')
                    ->badge()
                    ->formatStateUsing(function (string $state): string {
                        return ucfirst($state);
                    })
                    ->color(function (string $state): string {
                        return match ($state) {
                            'admin' => 'warning',
                            'staff' => 'info',
                            default => 'gray',
                        };
                    }),

                TextColumn::make('pivot.status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(function (string $state): string {
                        return ucfirst($state);
                    })
                    ->color(function (string $state): string {
                        return match ($state) {
                            'active' => 'success',
                            'disabled' => 'danger',
                            default => 'gray',
                        };
                    }),

                TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('pivot.created_at')
                    ->label('Added On')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('role_id')
                    ->label('System Role')
                    ->options([
                        '5' => 'School Admin',
                        '6' => 'School Staff',
                    ]),
            ])
            ->headerActions([
                Action::make('create_staff')
                    ->label('Create Staff Member')
                    ->icon('heroicon-o-plus')
                    ->form([
                        TextInput::make('name')
                            ->label('Full Name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->required()
                            ->unique('users', 'email')
                            ->maxLength(255),

                        TextInput::make('phone')
                            ->label('Phone Number')
                            ->tel()
                            ->maxLength(20),

                        TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->revealable()
                            ->required()
                            ->confirmed()
                            ->minLength(8),

                        TextInput::make('password_confirmation')
                            ->label('Confirm Password')
                            ->password()
                            ->revealable()
                            ->required(),

                        Select::make('role')
                            ->label('Role')
                            ->options([
                                'admin' => 'Administrator (School Admin)',
                                'staff' => 'Staff Member (School Staff)',
                            ])
                            ->required()
                            ->default('staff'),
                    ])
                    ->action(function (array $data) {
                        $roleMapping = [
                            'admin' => ['role_id' => 5, 'org_role' => 'admin'],
                            'staff' => ['role_id' => 6, 'org_role' => 'staff'],
                        ];

                        $mapping = $roleMapping[$data['role']];

                        $user = User::create([
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'phone' => $data['phone'] ?? null,
                            'password' => Hash::make($data['password']),
                            'role_id' => $mapping['role_id'],
                            'status' => 'active',
                        ]);

                        $this->ownerRecord->users()->attach($user->id, [
                            'org_role' => $mapping['org_role'],
                            'status' => 'active',
                        ]);

                        Notification::make()
                            ->title('Staff member created')
                            ->body("{$user->name} has been created and linked to this school.")
                            ->success()
                            ->send();
                    }),
            ])
            ->recordActions([
                Action::make('remove')
                    ->label('Remove')
                    ->color('danger')
                    ->icon('heroicon-o-trash')
                    ->requiresConfirmation()
                    ->modalHeading('Remove Staff Member')
                    ->modalDescription('Are you sure you want to remove this staff member from the school?')
                    ->action(function ($record) {
                        $this->ownerRecord->users()->detach($record->id);
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DeleteBulkAction::make()
                    //     ->label('Remove Selected')
                    //     ->modalHeading('Remove Staff Members')
                    //     ->modalDescription('Are you sure you want to remove the selected staff members from the school?')
                    //     ->action(function ($records) {
                    //         $this->ownerRecord->users()->detach($records->pluck('id'));
                    //     }),
                ]),
            ])
            ->emptyStateHeading('No staff members assigned')
            ->emptyStateDescription('Create a new staff member to link them to this school.')
            ->defaultSort('organization_users.created_at', 'desc');
    }
}