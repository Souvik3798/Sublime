<?php

namespace App\Filament\Resources\EntryfeesResource\Pages;

use App\Filament\Resources\EntryfeesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEntryfees extends ListRecords
{
    protected static string $resource = EntryfeesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
