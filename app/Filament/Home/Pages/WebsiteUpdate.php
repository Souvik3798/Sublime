<?php

namespace App\Filament\Home\Pages;

use App\Models\WebsiteUpdate as ModelsWebsiteUpdate;
use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\ButtonAction;
use GuzzleHttp\Client;

class WebsiteUpdate extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-s-globe-alt';
    protected static ?string $title = 'Update Website Information';
    protected static string $view = 'filament.home.pages.website-update';

    public $url;
    public $query;
    public $urlIsValid = false;

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('url')
                ->label('URL')
                ->required()
                ->url()
                ->placeholder('Enter the URL')
                ->live() // This makes the input reactive to changes
                ->afterStateUpdated(function (?string $state) {
                    if ($state !== null) {
                        $this->checkUrl($state); // Validate the URL
                    } else {
                        $this->urlIsValid = false;
                    }
                })
                ->afterStateHydrated(function (?string $state) {
                    if ($state !== null) {
                        $this->checkUrl($state); // Validate the URL
                    } else {
                        $this->urlIsValid = false;
                    }
                }),

            Forms\Components\Textarea::make('query')
                ->label('Query')
                ->columns(20)
                ->required()
                ->placeholder('Enter the query'),
        ];
    }

    public function checkUrl($url)
    {
        $client = new Client();
        try {
            $response = $client->head($url);
            $this->url = $url;
            $this->urlIsValid = $response->getStatusCode() === 200;
        } catch (\Exception $e) {
            $this->urlIsValid = false;
        }
    }

    public function submit(): void
    {
        $this->validate();

        ModelsWebsiteUpdate::create([
            'url' => $this->url,
            'user_id' => auth()->id(),
            'query' => $this->query,
        ]);

        $this->url = '';
        $this->query = '';
        $this->urlIsValid = false;

        Notification::make()
            ->title('Request Sent Successfully')
            ->success()
            ->send();
    }

    protected function getActions(): array
    {
        return [
            ButtonAction::make('submit')
                ->label('Send Request')
                ->action('submit')
                ->icon('heroicon-s-arrow-up-tray')
                ->color('success'),
        ];
    }
}
