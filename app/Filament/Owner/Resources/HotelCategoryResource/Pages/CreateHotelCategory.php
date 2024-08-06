<?php

namespace App\Filament\Owner\Resources\HotelCategoryResource\Pages;

use App\Filament\Owner\Resources\HotelCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHotelCategory extends CreateRecord
{
    protected static string $resource = HotelCategoryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
