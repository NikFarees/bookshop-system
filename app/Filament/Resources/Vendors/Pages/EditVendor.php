<?php

namespace App\Filament\Resources\Vendors\Pages;

use App\Filament\Resources\Vendors\VendorResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVendor extends EditRecord
{
    protected static string $resource = VendorResource::class;

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }

    public function getContentTabLabel(): ?string
    {
        return 'Vendor Details';
    }

    public function getContentTabIcon(): string|null
    {
        return 'heroicon-o-building-storefront';
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
