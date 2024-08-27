<?php

namespace App\Filament\Owner\Resources;

use App\Filament\Owner\Resources\WebsiteUpdateResource\Pages;
use App\Filament\Owner\Resources\WebsiteUpdateResource\RelationManagers;
use App\Models\WebsiteUpdate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WebsiteUpdateResource extends Resource
{
    protected static ?string $model = WebsiteUpdate::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // public static function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             //
    //         ]);
    // }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('users.name'),
                Tables\Columns\TextColumn::make('url')->searchable(),
                Tables\Columns\TextColumn::make('query')
                    ->limit(50)
                    ->searchable(),
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
            'index' => Pages\ListWebsiteUpdates::route('/'),
            // 'create' => Pages\CreateWebsiteUpdate::route('/create'),
            'edit' => Pages\EditWebsiteUpdate::route('/{record}/edit'),
        ];
    }
}
