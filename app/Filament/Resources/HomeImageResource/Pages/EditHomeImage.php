<?php

namespace App\Filament\Resources\HomeImageResource\Pages;

use App\Filament\Resources\HomeImageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHomeImage extends EditRecord
{
    protected static string $resource = HomeImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
