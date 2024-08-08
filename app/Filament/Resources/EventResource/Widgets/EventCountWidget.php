<?php

namespace App\Filament\Resources\EventResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EventCountWidget extends BaseWidget
{
    protected static bool $isLazy = false;
    protected int | string | array $columnSpan = 1;

    protected function getStats(): array
    {
        return [
            Stat::make(__("Total Events"), \App\Models\Event::count()),
        ];
    }

    protected function getColumns(): int
    {
        return 1;
    }
}
