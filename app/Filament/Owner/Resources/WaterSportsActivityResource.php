<?php

namespace App\Filament\Owner\Resources;

use App\Filament\Resources\WaterSportsActivityResource\Pages;
use App\Filament\Resources\WaterSportsActivityResource\RelationManagers;
use App\Models\WaterSportsActivity;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WaterSportsActivityResource extends Resource
{
    protected static ?string $model = WaterSportsActivity::class;

    protected static ?string $navigationIcon = 'heroicon-s-lifebuoy';
    protected static ?string $navigationGroup = 'General';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Activity Name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->rows(3)
                    ->nullable(),

                Forms\Components\TextInput::make('adult_price')
                    ->label('Adult Price')
                    ->numeric()
                    ->default(0) // Set default value as 0
                    ->prefix('₹') // Add rupee symbol as prefix
                    ->required(),

                Forms\Components\TextInput::make('child_5_12_price')
                    ->label('Child (5-12 Years) Price')
                    ->numeric()
                    ->default(0) // Set default value as 0
                    ->prefix('₹') // Add rupee symbol as prefix
                    ->required(),

                Forms\Components\TextInput::make('child_2_5_price')
                    ->label('Child (2-5 Years) Price')
                    ->numeric()
                    ->default(0) // Set default value as 0
                    ->prefix('₹') // Add rupee symbol as prefix
                    ->required(),

                Forms\Components\TextInput::make('infant_price')
                    ->label('Infant Price')
                    ->numeric()
                    ->default(0) // Set default value as 0
                    ->prefix('₹') // Add rupee symbol as prefix
                    ->nullable(),

                Hidden::make('user_id')
                    ->default(auth()->id()),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Activity Name'),
                Tables\Columns\TextColumn::make('adult_price')->label('Adult Price')->money('INR'),
                Tables\Columns\TextColumn::make('child_5_12_price')->label('Child (5-12 Years) Price')->money('INR'),
                Tables\Columns\TextColumn::make('child_2_5_price')->label('Child (2-5 Years) Price')->money('INR'),
                Tables\Columns\TextColumn::make('infant_price')->label('Infant Price')->money('INR'),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->date()->since(),
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
            'index' => Pages\ListWaterSportsActivities::route('/'),
            'create' => Pages\CreateWaterSportsActivity::route('/create'),
            'edit' => Pages\EditWaterSportsActivity::route('/{record}/edit'),
        ];
    }
}
