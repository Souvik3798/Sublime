<?php

namespace App\Filament\Owner\Resources\EntryfeesResource\Pages;

use App\Filament\Owner\Resources\EntryfeesResource;
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
