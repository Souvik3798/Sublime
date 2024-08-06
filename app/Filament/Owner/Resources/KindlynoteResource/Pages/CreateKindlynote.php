<?php

namespace App\Filament\Owner\Resources\KindlynoteResource\Pages;

use App\Filament\Owner\Resources\KindlynoteResource;
use App\Models\Kindlynote;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateKindlynote extends CreateRecord
{
    protected static string $resource = KindlynoteResource::class;

    public function create(bool $another = false): void
    {
        // Split the points by new lines
        $points = preg_split('/\r\n|\r|\n/', $this->data['point']);

        // Manually create each Refund entry
        foreach ($points as $point) {
            Kindlynote::create([
                'point' => $point,
                'user_id' => auth()->id(), // Set user_id directly
            ]);
        }

        // If you want to redirect or do anything else after creation, handle it here.
        Notification::make()
            ->title('Kindly Notes created successfully.')
            ->success()
            ->send();

        // Redirect to the index page or stay on the create page if $another is true
        if ($another) {
            $this->redirect($this->getResource()::getUrl('create'));
        } else {
            $this->redirect($this->getResource()::getUrl('index'));
        }
    }
}
