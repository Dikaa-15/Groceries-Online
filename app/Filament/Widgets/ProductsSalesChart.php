<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\Transaction;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ProductsSalesChart extends ChartWidget
{
    protected static ?string $heading = 'Statistik Penjualan Produk';

    protected function getData(): array
    {
        $sales = Transaction::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(quantity) as total_sold')
        )
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Produk Terjual',
                    'data' => $sales->pluck('total_sold'),
                    'backgroundColor' => 'rgba(75, 192, 192, 0.5)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $sales->pluck('date')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    public static function canView(): bool
    {
        return true;
    }
}
