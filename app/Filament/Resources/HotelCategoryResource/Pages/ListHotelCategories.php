<?php

namespace App\Filament\Resources\HotelCategoryResource\Pages;

use App\Filament\Resources\HotelCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHotelCategories extends ListRecords
{
    protected static string $resource = HotelCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
