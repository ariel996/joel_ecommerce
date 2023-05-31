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
use Archilex\StackedImageColumn\Columns\StackedImageColumn;

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
                Forms\Components\TextInput::make('code_produit')
                    ->maxLength(10)
                    ->required(),

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
                Tables\Columns\TextColumn::make('category.name'),
                Tables\Columns\TextColumn::make('supplier.nom'),
                Tables\Columns\TextColumn::make('code_produit')->label('Code Produit'),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('description'),
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
