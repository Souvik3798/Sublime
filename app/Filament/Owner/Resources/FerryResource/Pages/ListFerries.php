<?php

namespace App\Filament\Owner\Resources\FerryResource\Pages;

use App\Filament\Owner\Resources\FerryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFerries extends ListRecords
{
    protected static string $resource = FerryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
