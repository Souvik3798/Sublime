<?php

namespace App\Filament\Owner\Resources;

use App\Filament\Owner\Resources\RefundResource\Pages;
use App\Filament\Resources\RefundResource\RelationManagers;
use App\Models\Refund;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class RefundResource extends Resource
{
    protected static ?string $model = Refund::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Policy';
    protected static ?string $label = 'Refund and Cancellation';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('point')
                    ->label('Please Enter the Policy Points')
                    ->required()
                    ->columns(1)
                    ->rows(5)
                    ->default(fn($record) => $record ? $record->points()->pluck('point')->implode("\n") : null)
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
            'index' => Pages\ListRefunds::route('/'),
            'create' => Pages\CreateRefund::route('/create'),
            'edit' => Pages\EditRefund::route('/{record}/edit'),
        ];
    }
}
