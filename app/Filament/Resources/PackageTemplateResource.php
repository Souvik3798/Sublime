<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageTemplateResource\Pages;
use App\Filament\Resources\PackageTemplateResource\RelationManagers;
use App\Models\Category;
use App\Models\PackageCategory;
use App\Models\PackageTemplate;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PackageTemplateResource extends Resource
{
    protected static ?string $model = PackageTemplate::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';

    protected static ?string $navigationGroup = 'Templates';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Select::make('Category')
                // ->options(PackageCategory::all()->pluck('name','id')->toArray())
                // ->required(),
                Select::make('category_id')
                    ->label('Category')
                    ->options(Category::where('user_id', auth()->id())->pluck('name', 'id'))
                    ->required(),
                TextInput::make('days')
                    ->required()
                    ->label('Number of Days')
                    ->numeric(),
                TextInput::make('nights')
                    ->required()
                    ->label('Number of Nights')
                    ->numeric(),
                TextInput::make('name')
                    ->label('Title')
                    ->live()
                    ->required()
                    ->autocomplete('off'),
                TagsInput::make('inclusions')
                    ->required()
                    ->placeholder('Type Inclusion then press Enter'),
                TagsInput::make('exclusions')
                    ->required()
                    ->placeholder('Type Inclusion then press Enter')
                    ->hintColor('green'),
                Hidden::make('user_id')
                    ->default(auth()->id())
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                TagsColumn::make('inclusions')
                    ->searchable()
                    ->sortable(),

                TagsColumn::make('exclusions')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make(),
                ViewAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListPackageTemplates::route('/'),
            'create' => Pages\CreatePackageTemplate::route('/create'),
            'edit' => Pages\EditPackageTemplate::route('/{record}/edit'),
        ];
    }
}
