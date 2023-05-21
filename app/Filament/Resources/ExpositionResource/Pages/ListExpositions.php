<?php

namespace App\Filament\Resources\ExpositionResource\Pages;

use App\Filament\Resources\ExpositionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExpositions extends ListRecords
{
    protected static string $resource = ExpositionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
