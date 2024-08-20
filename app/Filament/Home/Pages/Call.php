<?php

namespace App\Filament\Home\Pages;

use Filament\Pages\Page;

class Call extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-phone-x-mark';
    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.home.pages.call';
}
