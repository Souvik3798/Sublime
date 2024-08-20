<?php

namespace App\Filament\Home\Pages;

use Filament\Pages\Page;

class VirtualTour extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-globe-americas';
    protected static ?int $navigationSort = 1;
    protected static string $view = 'filament.home.pages.virtual-tour';
}
