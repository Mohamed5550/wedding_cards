<?php

namespace App\Filament\Resources\WeddingCardResource\Pages;

use App\Filament\Resources\WeddingCardResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWeddingCard extends EditRecord
{
    protected static string $resource = WeddingCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
