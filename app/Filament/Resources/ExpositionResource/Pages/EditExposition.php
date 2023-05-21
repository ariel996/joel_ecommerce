<?php

namespace App\Filament\Resources\ExpositionResource\Pages;

use App\Filament\Resources\ExpositionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExposition extends EditRecord
{
    protected static string $resource = ExpositionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
