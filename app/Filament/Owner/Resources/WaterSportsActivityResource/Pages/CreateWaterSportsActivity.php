<?php

namespace App\Filament\Owner\Resources\TermsandconditionsResource\Pages;

use App\Filament\Resources\WaterSportsActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWaterSportsActivity extends CreateRecord
{
    protected static string $resource = WaterSportsActivityResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
