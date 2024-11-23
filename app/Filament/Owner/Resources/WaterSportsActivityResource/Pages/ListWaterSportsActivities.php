<?php

namespace App\Filament\Owner\Resources\WaterSportsActivityResource\Pages;

use App\Filament\Resources\WaterSportsActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWaterSportsActivities extends ListRecords
{
    protected static string $resource = WaterSportsActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
