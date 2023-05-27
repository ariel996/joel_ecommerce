<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RetourProduitResource\Pages;
use App\Filament\Resources\RetourProduitResource\RelationManagers;
use App\Models\RetourProduit;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\Filter;

class RetourProduitResource extends Resource
{
    protected static ?string $model = RetourProduit::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('reference_commande')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('etat_produit')
                    ->options([
                        'Comme neuf' => 'Comme neuf',
                        'En mauvaise etat' => 'En mauvaise etat',
                    ])
                    ->required(),
                Forms\Components\Toggle::make('accepted')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference_commande')
                    ->label('Référence de la commande'),
                Tables\Columns\TextColumn::make('etat_produit')
                    ->label('Etat du produit'),
                Tables\Columns\IconColumn::make('accepted')
                    ->label('Accepté ?')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Crée le')
                    ->dateTime(),
            ])
            ->filters([
                Filter::make('accepted')->label('accepté')
                ->query(fn (Builder $query): Builder => $query->where('accepted', '=', 1)),
            ])
            ->actions([
                Tables\Actions\Action::make('accepted')->label('Accepté')
                    ->url(fn (RetourProduit $record): string  => route('accepter', $record->id))
                    ->requiresConfirmation(),
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
            'index' => Pages\ListRetourProduits::route('/'),
            'create' => Pages\CreateRetourProduit::route('/create'),
            'edit' => Pages\EditRetourProduit::route('/{record}/edit'),
        ];
    }
}
