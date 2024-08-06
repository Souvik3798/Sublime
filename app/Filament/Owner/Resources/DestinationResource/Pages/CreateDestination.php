<?php

namespace App\Filament\Owner\Resources\DestinationResource\Pages;

use App\Filament\Owner\Resources\DestinationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDestination extends CreateRecord
{
    protected static string $resource = DestinationResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
