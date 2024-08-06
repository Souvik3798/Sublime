<?php

namespace App\Filament\Owner\Resources\TermsandconditionsResource\Pages;

use App\Filament\Owner\Resources\TermsandconditionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTermsandconditions extends ListRecords
{
    protected static string $resource = TermsandconditionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
