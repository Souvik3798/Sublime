<?php

namespace App\Filament\Owner\Resources\FerryResource\Pages;

use App\Filament\Owner\Resources\FerryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFerry extends EditRecord
{
    protected static string $resource = FerryResource::class;

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
