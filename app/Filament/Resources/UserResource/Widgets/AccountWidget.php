<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class AccountWidget extends \Filament\Widgets\AccountWidget
{
    protected int | string | array $columnSpan = 2;
}
