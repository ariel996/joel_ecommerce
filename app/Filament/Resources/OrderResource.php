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
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Clients'),
                //Tables\Columns\TextColumn::make('billing_email'),
                Tables\Columns\TextColumn::make('billing_name'),
                Tables\Columns\TextColumn::make('billing_address'),
                /*Tables\Columns\TextColumn::make('billing_city'),
                Tables\Columns\TextColumn::make('billing_province'),
                Tables\Columns\TextColumn::make('billing_postalcode'),
                Tables\Columns\TextColumn::make('billing_phone'),
                Tables\Columns\TextColumn::make('billing_name_on_card'),
                Tables\Columns\TextColumn::make('billing_discount'),
                Tables\Columns\TextColumn::make('billing_discount_code'),*/
                Tables\Columns\TextColumn::make('billing_subtotal'),
                //Tables\Columns\TextColumn::make('billing_tax'),
                Tables\Columns\TextColumn::make('billing_total'),
                //Tables\Columns\TextColumn::make('payment_gateway'),
                Tables\Columns\IconColumn::make('shipped')->label('Etat livraison')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
        ];
    }
}
