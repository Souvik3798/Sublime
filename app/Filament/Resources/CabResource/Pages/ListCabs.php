<?php

namespace App\Filament\Resources\CabResource\Pages;

use App\Filament\Resources\CabResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCabs extends ListRecords
{
    protected static string $resource = CabResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
