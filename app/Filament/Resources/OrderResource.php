<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\Filter;
use Archilex\StackedImageColumn\Columns\StackedImageColumn;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $label = 'Commandes';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Utilisateurs')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\TextInput::make('billing_email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('ref_id')
                    ->label('Référence commande')
                    ->maxLength(255),
                Forms\Components\TextInput::make('billing_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('billing_address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('billing_city')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('billing_province')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('billing_postalcode')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('billing_phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('billing_name_on_card')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('billing_discount')
                    ->required(),
                Forms\Components\TextInput::make('billing_discount_code')
                    ->maxLength(255),
                Forms\Components\TextInput::make('billing_subtotal')
                    ->required(),
                Forms\Components\TextInput::make('billing_tax')
                    ->required(),
                Forms\Components\TextInput::make('billing_total')
                    ->required(),
                Forms\Components\TextInput::make('payment_gateway')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('shipped')
                ->label('Livré')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Clients'),
                StackedImageColumn::make('products.image'),
                Tables\Columns\TextColumn::make('ref_id')->searchable()->label('Référence'),
                Tables\Columns\TextColumn::make('billing_name'),
                Tables\Columns\TextColumn::make('billing_address'),

                Tables\Columns\TextColumn::make('billing_subtotal'),
                Tables\Columns\TextColumn::make('billing_total'),
                Tables\Columns\IconColumn::make('shipped')->label('Etat livraison')
                    ->boolean(),
            ])->reorderable('created_at')
            ->filters([
                Filter::make('shipped')->label('en Livraison')
                ->query(fn (Builder $query): Builder => $query->where('shipped', '=', 1)),
                Filter::make('shipped2')->label('Pas en Livraison')
                ->query(fn (Builder $query): Builder => $query->where('shipped', '=', 0)),
            ])
            ->actions([
                Tables\Actions\Action::make('livraison')->label('Envoyer en livraison')
                    ->url(fn (Order $record): string  => route('envoyer_livraison', $record->id))
                    ->requiresConfirmation(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
            'view' => Pages\ViewOrder::route('/{record}'),
        ];
    }
}
