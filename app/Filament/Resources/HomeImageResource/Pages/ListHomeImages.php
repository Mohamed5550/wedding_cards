<?php

namespace App\Filament\Resources\HomeImageResource\Pages;

use App\Filament\Resources\HomeImageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHomeImages extends ListRecords
{
    protected static string $resource = HomeImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
