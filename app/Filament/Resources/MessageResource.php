<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MessageResource\Pages;
use App\Filament\Resources\MessageResource\RelationManagers;
use App\Models\Message;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;
    protected static ?string $label = 'Messages';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('expediteur_id')
                    ->label('Expéditeur')
                    ->relationship('expediteur', 'name')
                    ->required(),
                Forms\Components\Select::make('destinataire_id')
                    ->label('Destinataire')
                    ->relationship('destinataire', 'name')
                    ->required(),
                Forms\Components\RichEditor::make('contenue')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('objet')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('date')
                    ->required(),
                Forms\Components\Toggle::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('expediteur_id'),
                Tables\Columns\TextColumn::make('destinataire_id'),
                Tables\Columns\TextColumn::make('contenue'),
                Tables\Columns\TextColumn::make('objet'),
                Tables\Columns\TextColumn::make('date')
                    ->date(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('lu')->label('Lu')
                    ->url(fn (Message $record): string  => route('lu', $record->id))
                    ->requiresConfirmation(),
                Tables\Actions\CreateAction::make()->form([
                    Forms\Components\Select::make('expediteur_id')
                    ->label('Expéditeur')
                    ->relationship('expediteur', 'name')
                    ->required(),
                Forms\Components\Select::make('destinataire_id')
                    ->label('Destinataire')
                    ->relationship('destinataire', 'name')
                    ->required(),
                Forms\Components\TextInput::make('objet')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('date')
                    ->required(),
                Forms\Components\RichEditor::make('contenue')
                    ->required()
                    ->maxLength(255),
                ])->label('Répondre')
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
            'index' => Pages\ListMessages::route('/'),
            'create' => Pages\CreateMessage::route('/create'),
            'edit' => Pages\EditMessage::route('/{record}/edit'),
        ];
    }
}
