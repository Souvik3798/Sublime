<?php

namespace App\Filament\Home\Pages;

use App\Models\WebsiteUpdate as ModelsWebsiteUpdate;
use Filament\Pages\Page;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\ButtonAction;

class WebsiteUpdate extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-s-globe-alt';
    protected static string $view = 'filament.home.pages.website-update';

    public $url;
    public $query;

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('url')
                ->label('URL')
                ->required()
                ->url()
                ->placeholder('Enter the URL'),

            Forms\Components\Textarea::make('query')
                ->label('Query')
                ->columns(20)
                ->required()
                ->placeholder('Enter the query'),
        ];
    }

    public function submit(): void
    {
        $this->validate();

        ModelsWebsiteUpdate::create([
            'url' => $this->url,
            'query' => $this->query,
        ]);

        $this->url = '';
        $this->query = '';

        Notification::make()
            ->title('Query Save Successfully')
            ->success()
            ->send();
    }

    // protected function getActions(): array
    // {
    //     return [
    //         ButtonAction::make('submit')
    //             ->label('Save')
    //             ->action('submit')
    //             ->icon('heroicon-s-arrow-up-tray')
    //             ->color('success'),
    //     ];
    // }
}
