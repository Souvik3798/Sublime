<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HotelImageResource\Pages;
use App\Filament\Resources\HotelImageResource\RelationManagers;
use App\Models\Hotel;
use App\Models\HotelImage;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class HotelImageResource extends Resource
{
    protected static ?string $model = HotelImage::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Hotels';

    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('hotel_id')
                    ->label('Hotel')
                    ->relationship('hotel', 'hotelName', function ($query) {
                        $query->where('user_id', auth()->id());
                    })
                    ->unique(table: HotelImage::class, ignoreRecord: true)
                    ->required(),
                Forms\Components\FileUpload::make('images')
                    ->label('Image')
                    ->image()
                    ->imageCropAspectRatio('16:9')
                    ->directory('uploads/Hotel')
                    ->uploadingMessage('Uploading Images...')
                    ->multiple()
                    ->reorderable()
                    ->maxFiles(4)
                    ->appendFiles()
                    ->required(),
                Hidden::make('user_id')
                    ->default(auth()->id())
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hotel.hotelName')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('images')
                    ->url(fn($record) => Storage::url('storage/' . implode(',', $record->images))) // Optional: If you want to make the image clickable
                    ->height(100) // Optional: Set the height of the image
                    ->width(100) // Optional: Set the width of the image
                    ->rounded(), // Optional: Set the image to be rounded

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
            'index' => Pages\ListHotelImages::route('/'),
            'create' => Pages\CreateHotelImage::route('/create'),
            'edit' => Pages\EditHotelImage::route('/{record}/edit'),
        ];
    }
}
