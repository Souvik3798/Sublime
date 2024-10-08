<?php

namespace App\Filament\Owner\Resources\AddonResource\Pages;

use App\Filament\Owner\Resources\AddonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAddon extends EditRecord
{
    protected static string $resource = AddonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
