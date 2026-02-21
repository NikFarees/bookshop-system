<?php

namespace App\Filament\Resources\Schools\Pages;

use App\Filament\Resources\Schools\SchoolResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSchool extends CreateRecord
{
    protected static string $resource = SchoolResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Ensure type is always set to 'school'
        $data['type'] = 'school';
        
        return $data;
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
