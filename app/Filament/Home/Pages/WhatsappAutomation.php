<?php

namespace App\Filament\Home\Pages;

use Filament\Pages\Page;

class WhatsappAutomation extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';
    protected static ?int $navigationSort = 4;

    protected static string $view = 'filament.home.pages.whatsapp-automation';
}
