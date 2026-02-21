<?php

namespace App\Filament\Resources\Vendors\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class VendorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Vendor Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('code')
                    ->label('Vendor Code')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'suspended' => 'danger',
                        'rejected' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('city')
                    ->label('City')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('state')
                    ->label('State')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'suspended' => 'Suspended',
                        'rejected' => 'Rejected',
                    ]),

                SelectFilter::make('state')
                    ->options([
                        'Johor' => 'Johor',
                        'Kedah' => 'Kedah',
                        'Kelantan' => 'Kelantan',
                        'Malacca' => 'Malacca',
                        'Negeri Sembilan' => 'Negeri Sembilan',
                        'Pahang' => 'Pahang',
                        'Penang' => 'Penang',
                        'Perak' => 'Perak',
                        'Perlis' => 'Perlis',
                        'Sabah' => 'Sabah',
                        'Sarawak' => 'Sarawak',
                        'Selangor' => 'Selangor',
                        'Terengganu' => 'Terengganu',
                        'Kuala Lumpur' => 'Kuala Lumpur',
                        'Labuan' => 'Labuan',
                        'Putrajaya' => 'Putrajaya',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([]),
            ])
            ->defaultSort('name');
    }
}
