<?php

namespace App\Filament\Owner\Resources\RefundResource\Pages;

use App\Filament\Owner\Resources\RefundResource;
use App\Models\Refund;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditRefund extends EditRecord
{
    protected static string $resource = RefundResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
