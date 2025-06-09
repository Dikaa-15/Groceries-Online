<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentAsset;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        Filament::registerRenderHook(
            'head.end',
            fn(): string => '<link rel="stylesheet" href="' . asset('css/filament-custom.css') . '">'
        );

        Paginator::useTailwind();
    }
}
