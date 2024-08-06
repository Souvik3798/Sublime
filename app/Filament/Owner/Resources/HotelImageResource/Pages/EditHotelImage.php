<?php

namespace App\Filament\Owner\Resources\HotelImageResource\Pages;

use App\Filament\Owner\Resources\HotelImageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHotelImage extends EditRecord
{
    protected static string $resource = HotelImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
