<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FerryResource\Pages;
use App\Filament\Resources\FerryResource\RelationManagers;
use App\Models\Ferry;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FerryResource extends Resource
{
    protected static ?string $model = Ferry::class;

    protected static ?string $navigationIcon = 'heroicon-s-moon';

    protected static ?string $navigationGroup = 'Transportation';

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('Title')
                    ->label('Ferry Title')
                    ->required(),

                Repeater::make('price')
                    ->label('Location and Class Wise Pricing')
                    ->schema([
                        Select::make('location')
                            ->label('Location')
                            ->options([
                                'PB-HL' => 'PB-HL',
                                'HL-NL' => 'HL-NL',
                                'NL-PB' => 'NL-PB',
                                'HL-PB' => 'HL-PB'
                            ])
                            ->required(),
                        Select::make('class')
                            ->label('Class')
                            ->options([
                                'Economy' => 'Economy',
                                'Premium' => 'Premium',
                                'Royal' => 'Royal',
                                'Luxury' => 'Luxury',
                                'Deluxe' => 'Deluxe'
                            ])
                            ->required(),
                        TextInput::make('price')
                            ->label('Price')
                            ->numeric()
                            ->prefix('₹')
                            ->suffix('/-')
                            ->required(),
                    ])
                    ->columns(3), // Adjust the number of columns to match your desired layout
                Hidden::make('user_id')
                    ->default(auth()->id())

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Title')
                    ->sortable()
                    ->searchable(),
            ])->defaultSort('updated_at', 'desc')
            ->filters([
                //
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListFerries::route('/'),
            'create' => Pages\CreateFerry::route('/create'),
            'edit' => Pages\EditFerry::route('/{record}/edit'),
        ];
    }
}
