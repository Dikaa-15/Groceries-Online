<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestTransactions extends BaseWidget
{
    protected static ?string $heading = 'Latest Transactions'; // Judul widget
    protected int|string|array $columnSpan = 'full'; // Membuat widget full width

    protected function getTableQuery(): Builder  // Perbaiki return type
    {
        return Transaction::query()->latest()->limit(5);
    }

    protected function getTableColumns(): array
    {
        return [
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
            ImageColumn::make('transfer_poto')->label('Proof'),
            TextColumn::make('created_at')->label('Order date')->date('F j, Y'),

        ];
    }

    protected function getTableFilters(): array
    {
        return [
            SelectFilter::make('status')
                ->label('Transaction Status')
                ->options([
                    'success' => 'Success',
                    'failed' => 'Failed',
                    'pending' => 'Pending',
                ]),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            ViewAction::make(),
            Action::make('approve')
                ->label('Approve')
                ->icon('heroicon-o-check-circle')
                ->requiresConfirmation()
                ->color('success')
                ->visible(fn($record): bool => $record->status === 'pending')
                ->action(function ($record) {
                    $record->update(['status' => 'success']);
                }),
        ];
    }
}
