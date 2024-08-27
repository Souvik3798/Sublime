<?php

namespace App\Filament\Home\Resources\StockImagesResource\Pages;

use App\Filament\Home\Resources\StockImagesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStockImages extends CreateRecord
{
    protected static string $resource = StockImagesResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
