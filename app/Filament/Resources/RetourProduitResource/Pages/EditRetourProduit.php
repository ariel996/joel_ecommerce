<?php

namespace App\Filament\Resources\RetourProduitResource\Pages;

use App\Filament\Resources\RetourProduitResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRetourProduit extends EditRecord
{
    protected static string $resource = RetourProduitResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
