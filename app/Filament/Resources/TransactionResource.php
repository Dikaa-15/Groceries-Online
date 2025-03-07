<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Hamcrest\Core\Set;
use App\Models\Product;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Transaction;
use Filament\Resources\Resource;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    protected static ?string $navigationGroup = 'Shopping';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),

                Select::make('product_id')
                    ->label('Product')
                    ->relationship('product', 'name')
                    ->searchable()
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($state, $set, $get) {
                        self::updateTotalPrice($set, $get);
                    }),

                TextInput::make('quantity')
                    ->label('Quantity')
                    ->numeric()
                    ->minValue(1)
                    ->default(1)
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($state, $set, $get) {
                        self::updateTotalPrice($set, $get);
                    }),

                TextInput::make('total_price')
                    ->label('Total Price')
                    ->numeric()
                    ->disabled()
                    ->required(),

                Radio::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'success' => 'Success',
                        'failed' => 'Failed',
                    ])
                    ->default('pending')
                    ->required(),

                Radio::make('payment')
                    ->label('Payment Method')
                    ->options([
                        'bca' => 'BCA',
                        'bri' => 'BRI',
                        'bni' => 'BNI',
                    ])
                    ->required(),

                FileUpload::make('transfer_poto')
                    ->label('Transfer Proof')
                    ->image()
                    ->directory('payments')
                    ->required(),
            ]);
    }

    protected static function updateTotalPrice($set, $get): void
    {
        if (!($set instanceof \Filament\Forms\Set)) {
            return;
        }

        $productId = $get('product_id');
        $quantity = $get('quantity');

        $product = Product::find($productId);
        $totalPrice = $product ? $product->price * $quantity : 0;

        $set('total_price', $totalPrice);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('User'),
                TextColumn::make('product.name')->label('Product'),
                TextColumn::make('quantity')->label('Quantity'),
                TextColumn::make('total_price')->label('Total Price')->money('IDR'),
                TextColumn::make('status')->label('Status')->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'success' => 'success', // Hijau
                        'failed' => 'danger',   // Merah
                        'pending' => 'warning', // Kuning
                    }),
                TextColumn::make('payment')->label('Payment Method'),
                ImageColumn::make('transfer_poto')->label('Transfer Proof'),
                TextColumn::make('created_at')->label('Transaction Date')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
