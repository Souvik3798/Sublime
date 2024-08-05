<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KindlynoteResource\Pages;
use App\Filament\Resources\KindlynoteResource\RelationManagers;
use App\Models\Kindlynote;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KindlynoteResource extends Resource
{
    protected static ?string $model = Kindlynote::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Policy';
    protected static ?string $label = 'Kindly Note';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('point')
                    ->label('Please Enter the Policy Points')
                    ->required()
                    ->columnSpanFull()
                    ->rows(5)
                    ->default(fn ($record) => $record ? $record->points()->pluck('point')->implode("\n") : null)
                    ->visibleOn('create'),
                TextInput::make('point')
                    ->label('Refund and Cancellation Policy')
                    ->required()
                    ->visibleOn('edit')
                    ->columns(2),
                Hidden::make('user_id')
                    ->default(auth()->id())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('point')
                    ->label('Kindly Note'),
            ])->defaultSort('updated_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->modifyQueryUsing(function ($query) {
                return $query->where('user_id', auth()->id());
            });
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
            'index' => Pages\ListKindlynotes::route('/'),
            'create' => Pages\CreateKindlynote::route('/create'),
            'edit' => Pages\EditKindlynote::route('/{record}/edit'),
        ];
    }
}
