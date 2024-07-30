<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('User Details')
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('email')
                            ->required()
                            ->email()
                            ->unique(table: User::class, ignoreRecord: true),
                        TextInput::make('password')
                            ->required()
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->visible(fn ($livewire) => $livewire instanceof CreateUser)
                            ->rule(Password::default()),
                        TextInput::make('website')
                            ->placeholder('www.example.com'),
                        TextInput::make('phone')
                            ->tel()
                            ->prefix('+91'),
                        FileUpload::make('logo')
                            ->image()
                            ->directory('uploads/Logo')
                            ->uploadingMessage('Uploading Images...'),
                        Textarea::make('address')
                            ->rows(5),
                    ])->columns(2),
                Section::make('User New password')
                    ->schema([
                        TextInput::make('new_password')
                            ->nullable()
                            ->password()
                            ->rule(Password::default()),
                        TextInput::make('new_password_confirmation')
                            ->password()
                            ->same('new_password')
                            ->requiredWith('new_password'),

                    ])->visible(fn ($livewire) => $livewire instanceof EditUser),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')->searchable()
                    ->sortable(),
                TextColumn::make('phone')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('website')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')->date()
                    ->sortable(),
                ImageColumn::make('logo')
                    ->url(fn ($record) => Storage::url('storage/' . $record->logo))
                    ->width(100)

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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return Auth::check() && Auth::user()->id === 1; // Replace 1 with the ID of the user who should have access
    }

    public static function canCreate(): bool
    {
        return Auth::check() && Auth::user()->id === 1; // Replace 1 with the ID of the user who should have access
    }

    public static function canEdit(Model $record): bool
    {
        return Auth::check() && Auth::user()->id === 1; // Replace 1 with the ID of the user who should have access
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::check() && Auth::user()->id === 1; // Replace 1 with the ID of the user who should have access
    }
}
