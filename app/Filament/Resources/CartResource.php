<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Cart;
use Filament\Tables;
use App\Models\Carts;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CartResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CartResource\RelationManagers;

class CartResource extends Resource
{
    protected static ?string $model = Carts::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() > 0 ? 'primary' : 'danger';
    }

    protected static ?string $navigationGroup = 'Shopping';

    public static function form(Form $form): Form
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
                    ->required(),

                TextInput::make('quantity')
                    ->label('Quantity')
                    ->numeric()
                    ->minValue(1)
                    ->default(1)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('User'),
                ImageColumn::make('product.image')->label('Image')->circular(),
                TextColumn::make('product.name')->label('Product'),
                TextColumn::make('quantity')->label('Quantity'),
                TextColumn::make('created_at')->label('Added At')->date('F j, Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCarts::route('/'),
            'create' => Pages\CreateCart::route('/create'),
            'edit' => Pages\EditCart::route('/{record}/edit'),
        ];
    }
}
