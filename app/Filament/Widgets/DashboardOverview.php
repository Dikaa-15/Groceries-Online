<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class DashboardOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Users', User::count())
                ->description('Jumlah pengguna')
                ->icon('heroicon-o-user-group')
                ->color('success'),

            Card::make('Total Products', Product::count())
                ->description('Jumlah produk')
                ->icon('heroicon-o-cube')
                ->color('primary'),
                // ->icon('heroicon-s-arrow-trending-down'),
                
                Card::make('Total Transactions', 'IDR ' . number_format(Transaction::sum('total_price'), 2))
                ->description('Total transaksi')
                ->icon('heroicon-o-shopping-cart')
                ->color('warning')
                ->color('danger'),
        ];
    }
}
