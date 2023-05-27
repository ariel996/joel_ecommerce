<?php

namespace App\Filament\Resources\RetourProduitResource\Pages;

use App\Filament\Resources\RetourProduitResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRetourProduits extends ListRecords
{
    protected static string $resource = RetourProduitResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
