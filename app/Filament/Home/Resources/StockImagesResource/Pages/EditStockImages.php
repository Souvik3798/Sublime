<?php

namespace App\Filament\Home\Resources\StockImagesResource\Pages;

use App\Filament\Home\Resources\StockImagesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStockImages extends EditRecord
{
    protected static string $resource = StockImagesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
