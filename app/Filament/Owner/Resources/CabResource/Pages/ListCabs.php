<?php

namespace App\Filament\Owner\Resources\CabResource\Pages;

use App\Filament\Owner\Resources\CabResource;
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
