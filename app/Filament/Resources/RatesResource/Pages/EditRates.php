<?php

namespace App\Filament\Resources\RatesResource\Pages;

use App\Filament\Resources\RatesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRates extends EditRecord
{
    protected static string $resource = RatesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
