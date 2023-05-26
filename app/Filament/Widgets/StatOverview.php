<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\Widget;
use Filament\Widgets\StatsOverviewWidget\Card;


class StatOverview extends Widget
{
    protected static string $view = 'filament.widgets.stat-overview';
    protected function getCards(): array
    {
        return [
            Card::make('Utilisateur', User::query()->where('role_id', '=', 2)->count())
            ->description('Nombre d\'utilisateurs inscrits dans la plateforme')
            ->color('success'),
        ];
    }

    protected function getHeaderWidgets(): array
{
    return [
        StatOverviewWidget::class
    ];
}
}
