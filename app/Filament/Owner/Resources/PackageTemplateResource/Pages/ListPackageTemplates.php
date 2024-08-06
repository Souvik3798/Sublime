<?php

namespace App\Filament\Owner\Resources\PackageTemplateResource\Pages;

use App\Filament\Owner\Resources\PackageTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPackageTemplates extends ListRecords
{
    protected static string $resource = PackageTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
