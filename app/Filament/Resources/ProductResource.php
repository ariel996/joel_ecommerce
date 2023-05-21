<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Camya\Filament\Forms\Components\TitleWithSlugInput;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $label = 'Produits';


    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->label('Catégories')
                    ->relationship('category', 'name')
                    ->required(),
                    Forms\Components\Select::make('exposition_id')
                    ->label('Salle exposition')
                    ->relationship('exposition', 'nom')
                    ->required(),
                    Forms\Components\DateTimePicker::make('date_heure_exposition')
                    ->required()
                    ->label('Date et heure exposition'),
                Forms\Components\Select::make('supplier_id')
                ->label('Fourniseseurs')
                    ->relationship('supplier', 'nom'),
                TitleWithSlugInput::make(
                    fieldTitle: 'name', // The name of the field in your model that stores the title.
                    fieldSlug: 'slug', // The name of the field in your model that will store the slug.
                ),
                Forms\Components\TextInput::make('details')
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                ->label('Prix unitaire')
                    ->required(),
                Forms\Components\FileUpload::make('image')
                    ->required(),
                Forms\Components\FileUpload::make('images')
                ->label('Gallerie')
                    ->required(),
                Forms\Components\Toggle::make('featured')
                ->label('Favorite ?')
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                ->label('Quantité')
                    ->required(),
                Forms\Components\RichEditor::make('description')
                ->label('Description')
                    ->required()
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category_id'),
                Tables\Columns\TextColumn::make('supplier.id'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('details'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\IconColumn::make('featured')
                    ->boolean(),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
