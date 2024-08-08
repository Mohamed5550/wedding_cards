<?php

namespace App\Filament\Resources\InviteeResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class InviteeCountWidget extends BaseWidget
{
    protected static bool $isLazy = false;
    protected int | string | array $columnSpan = 1;

    protected function getStats(): array
    {
        return [
            Stat::make(__("Total Invites"), \App\Models\Invitee::count()),
        ];
    }

    protected function getColumns(): int
    {
        return 1;
    }
}
