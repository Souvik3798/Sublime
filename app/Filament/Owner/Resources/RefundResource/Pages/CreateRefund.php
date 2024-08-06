<?php

namespace App\Filament\Owner\Resources\RefundResource\Pages;

use App\Filament\Owner\Resources\RefundResource;
use App\Models\Refund;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateRefund extends CreateRecord
{
    protected static string $resource = RefundResource::class;

    public function create(bool $another = false): void
    {
        // Split the points by new lines
        $points = preg_split('/\r\n|\r|\n/', $this->data['point']);

        // Manually create each Refund entry
        foreach ($points as $point) {
            Refund::create([
                'point' => $point,
                'user_id' => auth()->id(), // Set user_id directly
            ]);
        }

        // If you want to redirect or do anything else after creation, handle it here.
        Notification::make()
            ->title('Refund points created successfully.')
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
