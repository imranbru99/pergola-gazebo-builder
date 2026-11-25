<?php

namespace App\Filament\Widgets;

use App\Models\Payment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RevenueStats extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        $month = Payment::query()->whereMonth('paid_at', now()->month)->whereYear('paid_at', now()->year)->sum('amount');
        $ytd = Payment::query()->whereYear('paid_at', now()->year)->sum('amount');

        return [
            Stat::make('Payments this month', '$'.number_format((float) $month, 2))
                ->description('Collected structure build revenue')
                ->color('success'),
            Stat::make('YTD collections', '$'.number_format((float) $ytd, 2))
                ->description('Year to date')
                ->color('primary'),
        ];
    }
}
