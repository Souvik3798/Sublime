<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HotelResource\Pages;
use App\Filament\Resources\HotelResource\RelationManagers;
use App\Models\Hotel;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HotelResource extends Resource
{
    protected static ?string $model = Hotel::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Hotels';

    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('hotel_category_id')
                    ->label('Hotel Category')
                    ->relationship('hotel_category', 'category', function ($query) {
                        $query->where('user_id', auth()->id());
                    })
                    ->required(),
                Forms\Components\TextInput::make('hotelName')
                    ->label('Hotel Name')
                    ->required(),
                Select::make('destination_id')
                    ->label('Located At')
                    ->createOptionForm([
                        TextInput::make('Title')
                            ->required(),
                        Hidden::make('user_id')
                            ->default(auth()->id()),
                    ])
                    ->relationship('destination', 'Title', function ($query) {
                        $query->where('user_id', auth()->id());
                    })
                    ->required(),
                Hidden::make('user_id')
                    ->default(auth()->id())

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hotelName')
                    ->label('Hotel Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('hotel_category.category')
                    ->label('Hotel Type')
                    ->sortable()
                    ->searchable(),

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
            'index' => Pages\ListHotels::route('/'),
            'create' => Pages\CreateHotel::route('/create'),
            'edit' => Pages\EditHotel::route('/{record}/edit'),
        ];
    }
}
