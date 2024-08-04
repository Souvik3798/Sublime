<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EntryfeesResource\Pages;
use App\Filament\Resources\EntryfeesResource\RelationManagers;
use App\Models\Entryfees;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EntryfeesResource extends Resource
{
    protected static ?string $model = Entryfees::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'General';
    protected static ?string $label = 'Entry Fees';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('place')
                    ->required()
                    ->label('Place'),
                TextInput::make('fee')
                    ->numeric()
                    ->label('Amount Per Person')
                    ->prefix('₹.')
                    ->suffix('/-')
                    ->required(),
                Hidden::make('user_id')
                    ->default(auth()->id()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('place')
                    ->label('Place'),
                TextColumn::make('fee')
                    ->label('Amount')
                    ->prefix('₹.')
                    ->suffix('/-')
            ])->defaultSort('updated_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListEntryfees::route('/'),
            'create' => Pages\CreateEntryfees::route('/create'),
            'edit' => Pages\EditEntryfees::route('/{record}/edit'),
        ];
    }
}
