<?php

namespace App\Filament\Home\Resources\StockImagesResource\Pages;

use App\Filament\Home\Resources\StockImagesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStockImages extends ListRecords
{
    protected static string $resource = StockImagesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
