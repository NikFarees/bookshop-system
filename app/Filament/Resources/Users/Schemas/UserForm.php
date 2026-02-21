<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\Role;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->revealable()
                    ->confirmed(),
                TextInput::make('password_confirmation')
                    ->password()
                    ->required()
                    ->revealable()
                    ->label('Confirm Password'),
                Select::make('role_id')
                    ->label('Role')
                    ->options(Role::all()->pluck('name', 'id')
                        ->mapWithKeys(fn($name, $id) => [$id => ucwords(str_replace('_', ' ', $name))]))
                    ->required(),
                TextInput::make('phone')
                    ->tel(),
            ]);
    }
}
