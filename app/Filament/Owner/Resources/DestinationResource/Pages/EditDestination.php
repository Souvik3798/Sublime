<?php

namespace App\Filament\Owner\Resources\DestinationResource\Pages;

use App\Filament\Owner\Resources\DestinationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDestination extends EditRecord
{
    protected static string $resource = DestinationResource::class;

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
