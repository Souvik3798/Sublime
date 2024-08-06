<?php

namespace App\Filament\Owner\Resources;

use App\Filament\Owner\Resources\IternityTemplateResource\Pages;
use App\Filament\Resources\IternityTemplateResource\RelationManagers;
use App\Models\IternityTemplate;
use App\Models\preset;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IternityTemplateResource extends Resource
{
    protected static ?string $model = IternityTemplate::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Templates';

    protected static ?string $modelLabel = 'Itinerary Template';

    protected static ?string $navigationLabel = 'Itinerary Template';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('Title')
                    ->label('Title')
                    ->required(),
                Textarea::make('Description')
                    ->required(),
                TagsInput::make('locationCovered')
                    ->label('Locations Covered')
                    ->placeholder('Type Location Name and press Enter')
                    ->required(),
                Hidden::make('user_id')
                    ->default(auth()->id())
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('Description')
                    ->limit(50)
                    ->searchable()
                    ->sortable()
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }

                        // Only render the tooltip if the column content exceeds the length limit.
                        return $state;
                    }),
                TagsColumn::make('locationCovered')
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
            'index' => Pages\ListIternityTemplates::route('/'),
            'create' => Pages\CreateIternityTemplate::route('/create'),
            'edit' => Pages\EditIternityTemplate::route('/{record}/edit'),
        ];
    }
}
