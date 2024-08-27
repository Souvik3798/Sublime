<?php

namespace App\Filament\Home\Pages;

use Filament\Pages\Page;

class AI extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';
    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return '';
    }

    protected static string $view = 'filament.home.pages.a-i';
}
