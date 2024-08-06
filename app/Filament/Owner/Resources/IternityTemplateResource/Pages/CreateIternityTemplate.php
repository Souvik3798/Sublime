<?php

namespace App\Filament\Owner\Resources\IternityTemplateResource\Pages;

use App\Filament\Owner\Resources\IternityTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIternityTemplate extends CreateRecord
{
    protected static string $resource = IternityTemplateResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
