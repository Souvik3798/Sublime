<?php

namespace App\Filament\Owner\Resources\KindlynoteResource\Pages;

use App\Filament\Owner\Resources\KindlynoteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKindlynote extends EditRecord
{
    protected static string $resource = KindlynoteResource::class;

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
