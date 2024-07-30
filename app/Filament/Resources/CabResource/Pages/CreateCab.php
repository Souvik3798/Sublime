<?php

namespace App\Filament\Resources\CabResource\Pages;

use App\Filament\Resources\CabResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCab extends CreateRecord
{
    protected static string $resource = CabResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
