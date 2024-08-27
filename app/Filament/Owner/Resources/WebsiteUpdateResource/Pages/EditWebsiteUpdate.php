<?php

namespace App\Filament\Owner\Resources\WebsiteUpdateResource\Pages;

use App\Filament\Owner\Resources\WebsiteUpdateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWebsiteUpdate extends EditRecord
{
    protected static string $resource = WebsiteUpdateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
