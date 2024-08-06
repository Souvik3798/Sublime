<?php

namespace App\Filament\Owner\Resources\EntryfeesResource\Pages;

use App\Filament\Owner\Resources\EntryfeesResource;
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
