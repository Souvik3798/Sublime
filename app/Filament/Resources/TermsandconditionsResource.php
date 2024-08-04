<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TermsandconditionsResource\Pages;
use App\Filament\Resources\TermsandconditionsResource\RelationManagers;
use App\Models\Termsandconditions;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TermsandconditionsResource extends Resource
{
    protected static ?string $model = Termsandconditions::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Policy';
    protected static ?string $label = 'Terms and Conditions';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('point')
                    ->label('Please Enter the Policy Points')
                    ->required()
                    ->columns(1)
                    ->rows(5)
                    ->default(fn ($record) => $record ? $record->points()->pluck('point')->implode("\n") : null)
                    ->visibleOn('create'),
                TextInput::make('point')
                    ->label('Refund and Cancellation Policy')
                    ->required()
                    ->visibleOn('edit')
                    ->columns(2),
                Hidden::make('user_id')
                    ->default(auth()->id())
                    ->required(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('point')
                    ->label('Policy'),
            ])->defaultSort('updated_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->modifyQueryUsing(function ($query) {
                return $query->where('user_id', auth()->id());
            })
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
            'index' => Pages\ListTermsandconditions::route('/'),
            'create' => Pages\CreateTermsandconditions::route('/create'),
            'edit' => Pages\EditTermsandconditions::route('/{record}/edit'),
        ];
    }
}
