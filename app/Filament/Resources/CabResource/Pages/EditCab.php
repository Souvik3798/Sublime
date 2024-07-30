<?php

namespace App\Filament\Resources\CabResource\Pages;

use App\Filament\Resources\CabResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCab extends EditRecord
{
    protected static string $resource = CabResource::class;

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
