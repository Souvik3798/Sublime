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
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StockImagesResource extends Resource
{
    protected static ?string $model = StockImages::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-on-square-stack';

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
                Stack::make([
                    Tables\Columns\TextColumn::make('name'),
                    Tables\Columns\ImageColumn::make('image')
                        ->height(200),
                ])
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('Download')
                    ->icon('heroicon-s-arrow-down-tray')
                    ->color('success')
                    ->action(function (StockImages $record) {
                        $filePath = 'uploads/StockImages/' . basename($record->image);
                        return Storage::disk('public')->download($filePath);
                    }),

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
