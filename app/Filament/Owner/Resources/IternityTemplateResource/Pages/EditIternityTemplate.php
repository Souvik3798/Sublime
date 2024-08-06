<?php

namespace App\Filament\Owner\Resources\IternityTemplateResource\Pages;

use App\Filament\Owner\Resources\IternityTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIternityTemplate extends EditRecord
{
    protected static string $resource = IternityTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
