<?php

namespace App\Filament\Resources\RatesResource\Pages;

use App\Filament\Resources\RatesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRates extends ListRecords
{
    protected static string $resource = RatesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
