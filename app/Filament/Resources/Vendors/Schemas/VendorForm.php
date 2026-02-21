<?php

namespace App\Filament\Resources\Vendors\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VendorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('type')
                    ->default('vendor'),

                TextInput::make('name')
                    ->label('Vendor Name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('code')
                    ->label('Vendor Code')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(50)
                    ->placeholder('e.g. VND01'),

                TextInput::make('phone')
                    ->label('Phone Number')
                    ->tel()
                    ->maxLength(20),

                TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->maxLength(255),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'suspended' => 'Suspended',
                        'rejected' => 'Rejected',
                    ])
                    ->default('pending')
                    ->required(),

                TextInput::make('address_line1')
                    ->label('Address Line 1')
                    ->required()
                    ->maxLength(255),

                TextInput::make('address_line2')
                    ->label('Address Line 2 (Optional)')
                    ->maxLength(255),

                TextInput::make('city')
                    ->label('City')
                    ->required()
                    ->maxLength(100),

                Select::make('state')
                    ->label('State')
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
                    ])
                    ->searchable()
                    ->required(),

                TextInput::make('postcode')
                    ->label('Postcode')
                    ->required()
                    ->numeric()
                    ->length(5),

                TextInput::make('country')
                    ->label('Country')
                    ->default('Malaysia')
                    ->required()
                    ->maxLength(100),
            ]);
    }
}
