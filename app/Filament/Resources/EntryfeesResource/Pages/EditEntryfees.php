<?php

namespace App\Filament\Resources\EntryfeesResource\Pages;

use App\Filament\Resources\EntryfeesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEntryfees extends EditRecord
{
    protected static string $resource = EntryfeesResource::class;

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
