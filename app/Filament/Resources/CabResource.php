<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CabResource\Pages;
use App\Filament\Resources\CabResource\RelationManagers;
use App\Models\Cab;
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

class CabResource extends Resource
{
    protected static ?string $model = Cab::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Transportation';

    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('Title')
                    ->label('Cab Service Title')
                    ->required(),

                Repeater::make('price')
                    ->label('Vehicle Pricing')
                    ->schema([
                        Select::make('vehicle_type')
                            ->label('Vehicle Type')
                            ->options([
                                '7' => '7 Seater',
                                '13' => '13 Seater',
                                '17' => '17 Seater',
                                '26' => '26 Seater',
                            ])
                            ->required(),
                        TextInput::make('price')
                            ->label('Price')
                            ->numeric()
                            ->prefix('₹')
                            ->suffix('/-')
                            ->required(),
                    ])
                    ->columns(2),

                Hidden::make('user_id')
                    ->default(auth()->id()),
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
            'index' => Pages\ListCabs::route('/'),
            'create' => Pages\CreateCab::route('/create'),
            'edit' => Pages\EditCab::route('/{record}/edit'),
        ];
    }
}
