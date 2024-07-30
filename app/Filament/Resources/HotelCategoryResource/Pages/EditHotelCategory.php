<?php

namespace App\Filament\Resources\HotelCategoryResource\Pages;

use App\Filament\Resources\HotelCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHotelCategory extends EditRecord
{
    protected static string $resource = HotelCategoryResource::class;

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
