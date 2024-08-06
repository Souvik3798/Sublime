<?php

namespace App\Filament\Owner\Resources\HotelImageResource\Pages;

use App\Filament\Owner\Resources\HotelImageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHotelImage extends CreateRecord
{
    protected static string $resource = HotelImageResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
