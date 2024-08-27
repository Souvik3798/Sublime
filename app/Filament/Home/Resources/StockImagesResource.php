<?php

namespace App\Filament\Home\Resources;

use App\Filament\Home\Resources\StockImagesResource\Pages;
use App\Filament\Home\Resources\StockImagesResource\RelationManagers;
use App\Models\StockImages;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class StockImagesResource extends Resource
{
    protected static ?string $model = StockImages::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name'),
                FileUpload::make('image')
                    ->image()
                    ->directory('uploads/StockImages')
                    ->uploadingMessage('Uploading Images...')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\ImageColumn::make('image'),
            ])
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
            'index' => Pages\ListStockImages::route('/'),
            'create' => Pages\CreateStockImages::route('/create'),
            'edit' => Pages\EditStockImages::route('/{record}/edit'),
        ];
    }


    public static function canCreate(): bool
    {
        return Auth::check() && Auth::user()->id === 1; // Replace 1 with the ID of the user who should have access
    }

    public static function canEdit(Model $record): bool
    {
        return Auth::check() && Auth::user()->id === 1; // Replace 1 with the ID of the user who should have access
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::check() && Auth::user()->id === 1; // Replace 1 with the ID of the user who should have access
    }
}
