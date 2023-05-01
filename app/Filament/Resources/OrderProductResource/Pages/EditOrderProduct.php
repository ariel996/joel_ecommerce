<?php

namespace App\Filament\Resources\OrderProductResource\Pages;

use App\Filament\Resources\OrderProductResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrderProduct extends EditRecord
{
    protected static string $resource = OrderProductResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
