<?php

namespace App\Filament\Owner\Resources\RoomCategoryResource\Pages;

use App\Filament\Owner\Resources\RoomCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRoomCategory extends EditRecord
{
    protected static string $resource = RoomCategoryResource::class;

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
