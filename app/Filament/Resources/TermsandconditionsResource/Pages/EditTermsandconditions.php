<?php

namespace App\Filament\Resources\TermsandconditionsResource\Pages;

use App\Filament\Resources\TermsandconditionsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTermsandconditions extends EditRecord
{
    protected static string $resource = TermsandconditionsResource::class;

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
