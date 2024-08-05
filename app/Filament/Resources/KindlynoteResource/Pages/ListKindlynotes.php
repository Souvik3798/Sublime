<?php

namespace App\Filament\Resources\KindlynoteResource\Pages;

use App\Filament\Resources\KindlynoteResource;
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
