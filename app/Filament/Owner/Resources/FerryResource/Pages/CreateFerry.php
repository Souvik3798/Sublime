<?php

namespace App\Filament\Owner\Resources\FerryResource\Pages;

use App\Filament\Owner\Resources\FerryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFerry extends CreateRecord
{
    protected static string $resource = FerryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
