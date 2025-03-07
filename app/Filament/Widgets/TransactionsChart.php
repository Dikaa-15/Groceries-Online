<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class TransactionsChart extends ChartWidget
{
    protected static ?string $heading = 'Statistik Transaksi & Penjualan';

    protected function getData(): array
    {
        $transactions = Transaction::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total_transactions'),
            DB::raw('SUM(quantity) as total_sold')
        )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Total Transaksi',
                    'data' => $transactions->pluck('total_transactions'),
                    'backgroundColor' => 'rgba(54, 162, 235, 0.5)', // Biru
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 2,
                ],
                [
                    'label' => 'Produk Terjual',
                    'data' => $transactions->pluck('total_sold'),
                    'backgroundColor' => 'rgba(255, 99, 132, 0.5)', // Merah
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'borderWidth' => 2,
                ]
            ],
            'labels' => $transactions->pluck('date')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line'; // Bisa diganti 'bar', 'pie', dll.
    }
}
