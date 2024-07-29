<?php

namespace App\Filament\Resources\WeddingCardResource\Pages;

use App\Filament\Resources\WeddingCardResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWeddingCards extends ListRecords
{
    protected static string $resource = WeddingCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
