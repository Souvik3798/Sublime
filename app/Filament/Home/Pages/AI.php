<?php

namespace App\Filament\Home\Pages;

use Filament\Pages\Page;

class AI extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';
    protected static ?int $navigationSort = 2;

    protected static ?string $label = 'AI Assistant';
    protected static ?string $pluralLabel = 'AI Assistant';

    protected static ?string $navigationLabel = 'AI Assistant';

    protected static ?string $modelLabel = 'AI Assistant';

    protected static string $view = 'filament.home.pages.a-i';
}
