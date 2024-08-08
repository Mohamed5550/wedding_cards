<?php

namespace App\Filament\Pages;

use App\Filament\Resources\UserResource\Widgets\AccountWidget;
use App\Filament\Resources\EventResource\Widgets\EventCountWidget;
use App\Filament\Resources\InviteeResource\Widgets\InviteeCountWidget;
 
class Dashboard extends \Filament\Pages\Dashboard
{
    public function getWidgets(): array
    {
        return [
            AccountWidget::class,
            EventCountWidget::class,
            InviteeCountWidget::class
        ];
    }

    public function getColumns(): int | string | array
    {
        return 2;
    }
}