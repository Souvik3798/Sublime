<?php

namespace App\Filament\Owner\Resources\TermsandconditionsResource\Pages;

use App\Filament\Resources\WaterSportsActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWaterSportsActivity extends EditRecord
{
    protected static string $resource = WaterSportsActivityResource::class;

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
