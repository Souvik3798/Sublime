<?php

namespace App\Filament\Resources\KindlynoteResource\Pages;

use App\Filament\Resources\KindlynoteResource;
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
