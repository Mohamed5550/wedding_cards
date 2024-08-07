<?php

namespace App\Filament\Pages;

use App\Models\Event;
use Filament\Pages\Page;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.dashboard';

    public function getStats(): array
    {
        dd('aa');
        return [
            Stat::make(
                label: __("Total events"),
                value: Event::count(),
            ),
            // ...
        ];
    }
}
