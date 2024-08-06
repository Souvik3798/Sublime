<?php

namespace App\Filament\Owner\Resources\CustomPackageResource\Pages;

use App\Filament\Owner\Resources\CustomPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomPackages extends ListRecords
{
    protected static string $resource = CustomPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
