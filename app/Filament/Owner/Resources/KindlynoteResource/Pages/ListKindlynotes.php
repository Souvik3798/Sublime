<?php

namespace App\Filament\Owner\Resources\KindlynoteResource\Pages;

use App\Filament\Owner\Resources\KindlynoteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKindlynotes extends ListRecords
{
    protected static string $resource = KindlynoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
