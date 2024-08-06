<?php

namespace App\Filament\Owner\Resources\EntryfeesResource\Pages;

use App\Filament\Owner\Resources\EntryfeesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEntryfees extends CreateRecord
{
    protected static string $resource = EntryfeesResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
