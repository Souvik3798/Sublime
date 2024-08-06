<?php

namespace App\Filament\Owner\Resources\RoomCategoryResource\Pages;

use App\Filament\Owner\Resources\RoomCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRoomCategory extends CreateRecord
{
    protected static string $resource = RoomCategoryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
