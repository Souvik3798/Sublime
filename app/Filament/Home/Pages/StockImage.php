<?php

namespace App\Filament\Home\Pages;

use Filament\Pages\Page;

class StockImage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-s-photo';

    protected static ?string $title = 'AI Images';

    protected static string $view = 'filament.home.pages.stock-image';
}
