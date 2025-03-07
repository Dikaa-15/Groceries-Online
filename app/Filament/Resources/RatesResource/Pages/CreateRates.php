<?php

namespace App\Filament\Resources\RatesResource\Pages;

use App\Filament\Resources\RatesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRates extends CreateRecord
{
    protected static string $resource = RatesResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
