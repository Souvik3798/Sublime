<?php

namespace App\Filament\Owner\Resources;

use App\Filament\Owner\Resources\WebsiteUpdateResource\Pages;
use App\Filament\Owner\Resources\WebsiteUpdateResource\RelationManagers;
use App\Models\WebsiteUpdate;
use Filament\Actions\StaticAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
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
                TextColumn::make('users.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('url')
                    ->copyable()
                    ->copyMessage('URL address copied')
                    ->searchable(),
                Tables\Columns\TextColumn::make('query')
                    ->limit(50)
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Action::make('view')
                    ->label('View')
                    ->icon('heroicon-s-eye')
                    ->modalAlignment(Alignment::Center)
                    ->modalIcon('heroicon-s-pencil-square')
                    ->modalIconColor('warning')
                    ->modalContent(fn(WebsiteUpdate $record): View => view(
                        'filament.home.pages.actions.advance',
                        ['record' => $record],
                    ))
                    ->modalSubmitAction(false)
                    ->modalCancelAction(fn(StaticAction $action) => $action->label('Close'))
                    ->modalHeading('View Website Update Details') // Optionally set a custom heading
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
            // 'edit' => Pages\EditWebsiteUpdate::route('/{record}/edit'),
        ];
    }
}
