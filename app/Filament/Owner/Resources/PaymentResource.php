<?php

namespace App\Filament\Owner\Resources;

use App\Filament\Owner\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\CustomPackage;
use App\Models\HotelCategory;
use App\Models\payment;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class PaymentResource extends Resource
{
    protected static ?string $model = payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Packages';

    protected static ?int $navigationSort = 13;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('customers_id')
                    ->relationship('customers', 'customer')
                    ->live()
                    ->searchable()
                    ->required(),
                Select::make('custom_package')
                    ->options(function (callable $get) {
                        $package = CustomPackage::where('customers_id', $get('customers_id'))->get();
                        if (!$package) {
                            return;
                        }
                        return $package->pluck('name', 'id');
                    })
                    ->live()
                    ->required(),
                Select::make('hotel_type')
                    ->options(function (callable $get) {
                        $package = CustomPackage::find($get('custom_package'));
                        if (!$package) {
                            return;
                        }

                        $type = [];

                        foreach ($package['rooms'] as $room) {
                            $roomtype = HotelCategory::where('user_id', auth()->id());
                            for ($i = 1; $i < count($roomtype); $i++) {
                                if ($room['hotel_type'] == $i) {
                                    if (!in_array($room['hotel_type'], $type)) {
                                        array_push($type, $room['hotel_type']);
                                    }
                                }
                            }
                        }

                        $category = HotelCategory::find($type);

                        return $category->pluck('category', 'id');
                    })
                    ->required()
                    ->afterStateUpdated(function (string $operation, $state, Forms\Set $set, callable $get) {
                        if ($operation !== 'create' && $operation !== 'edit') {
                            return;
                        }
                    })
                    ->live(),
                TextInput::make('total_amount')
                    ->label('Total Amount')
                    ->prefix('₹')
                    ->numeric()
                    ->required(),
                TextInput::make('amount_paid')
                    ->prefix('₹')
                    ->numeric()
                    ->required(),
                Textarea::make('bank')
                    ->label('Transaction details')
                    ->required(),
                DatePicker::make('payment_date')
                    ->required(),
                Textarea::make('reference')
                    ->label('Refence (If Any)'),
                Hidden::make('user_id')
                    ->default(auth()->id())

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customers.customer')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('total_amount')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('amount_paid')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('payment_date')
                    ->since()
                    ->sortable()
                    ->searchable(),
            ])->defaultSort('updated_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('View Doc')
                        ->icon('heroicon-o-eye')
                        ->url(fn (payment $record) => route('voucher.pdf.voucher', $record))
                        ->openUrlInNewTab()
                        ->color('info'),
                    Tables\Actions\EditAction::make(),
                    DeleteAction::make(),
                    Action::make('Download Pdf')
                        ->icon('heroicon-o-arrow-down-on-square-stack')
                        ->url(fn (payment $record) => route('voucher.pdf.download', $record))
                        ->openUrlInNewTab(),
                ])
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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
