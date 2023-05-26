<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Order;


class LatestOrders extends Widget
{
    protected static string $view = 'filament.widgets.latest-orders';
    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return Order::query()->where('shipped', '!=', 1)->get();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('user.name')->label('Clients'),
                Tables\Columns\TextColumn::make('ref_id')->label('Référence'),
                Tables\Columns\TextColumn::make('billing_name'),
                Tables\Columns\TextColumn::make('billing_address'),
                Tables\Columns\TextColumn::make('billing_subtotal'),
                Tables\Columns\TextColumn::make('billing_total'),
        ];
    }
}
