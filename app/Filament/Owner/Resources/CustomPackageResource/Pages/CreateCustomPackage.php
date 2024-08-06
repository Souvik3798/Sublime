<?php

namespace App\Filament\Owner\Resources\CustomPackageResource\Pages;

use App\Filament\Owner\Resources\CustomPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomPackage extends CreateRecord
{
    protected static string $resource = CustomPackageResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
