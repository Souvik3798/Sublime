<?php

namespace App\Filament\Owner\Resources\AddonResource\Pages;

use App\Filament\Owner\Resources\AddonResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAddon extends CreateRecord
{
    protected static string $resource = AddonResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
