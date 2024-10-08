<?php

namespace App\Filament\Owner\Resources;

use App\Filament\Owner\Resources\RoomCategoryResource\Pages;
use App\Filament\Resources\RoomCategoryResource\RelationManagers;
use App\Models\RoomCategory;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoomCategoryResource extends Resource
{
    protected static ?string $model = RoomCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Hotels';

    protected static ?string $modelLabel = 'Room Type';

    protected static ?string $navigationLabel = 'Room Type';

    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('category')
                    ->label('Room Type')
                    ->required(),
                Forms\Components\Select::make('hotel_id')
                    ->label('Hotel')
                    ->relationship('hotel', 'hotelName')
                    ->required(),
                Forms\Components\TextInput::make('cp')
                    ->label('CP (Price)')
                    ->required(),
                Forms\Components\TextInput::make('map')
                    ->label('MAP (Price)')
                    ->required(),
                Forms\Components\TextInput::make('ap')
                    ->label('AP (Price)')
                    ->required(),
                Hidden::make('user_id')
                    ->default(auth()->id())
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category')
                    ->label('Room Type')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('hotel.hotelName')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListRoomCategories::route('/'),
            'create' => Pages\CreateRoomCategory::route('/create'),
            'edit' => Pages\EditRoomCategory::route('/{record}/edit'),
        ];
    }
}
