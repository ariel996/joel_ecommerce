<?php

namespace App\Filament\Resources\LivraisonResource\Pages;

use App\Filament\Resources\LivraisonResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLivraison extends EditRecord
{
    protected static string $resource = LivraisonResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
