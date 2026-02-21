<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Filament\Schemas\Components\Tabs\Tab as TabsTab;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'super_admin' => TabsTab::make('Super Admin')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereHas('role', fn(Builder $q) => $q->where('name', 'super_admin')))
                ->badge(User::whereHas('role', fn(Builder $q) => $q->where('name', 'super_admin'))->count()),

            'admin' => TabsTab::make('Admin')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereHas('role', fn(Builder $q) => $q->where('name', 'admin')))
                ->badge(User::whereHas('role', fn(Builder $q) => $q->where('name', 'admin'))->count()),

            'vendor' => TabsTab::make('Vendor')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereHas('role', fn(Builder $q) => $q->whereIn('name', ['vendor_admin', 'vendor_staff'])))
                ->badge(User::whereHas('role', fn(Builder $q) => $q->whereIn('name', ['vendor_admin', 'vendor_staff']))->count()),

            'school' => TabsTab::make('School')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereHas('role', fn(Builder $q) => $q->whereIn('name', ['school_admin', 'school_staff'])))
                ->badge(User::whereHas('role', fn(Builder $q) => $q->whereIn('name', ['school_admin', 'school_staff']))->count()),

            'parent' => TabsTab::make('Parent')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereHas('role', fn(Builder $q) => $q->where('name', 'parent')))
                ->badge(User::whereHas('role', fn(Builder $q) => $q->where('name', 'parent'))->count()),

            'all' => TabsTab::make('All')
                ->badge(User::count()),
        ];
    }
}
