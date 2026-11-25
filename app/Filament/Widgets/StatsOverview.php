<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Job;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Active jobs', Job::query()->whereNotIn('status', ['completed', 'cancelled'])->count())
                ->description('Pergola & gazebo projects in pipeline')
                ->color('success'),
            Stat::make('Customers', Customer::query()->count())
                ->description('Homeowners & property managers')
                ->color('primary'),
            Stat::make('Open invoices', Invoice::query()->whereIn('status', ['sent', 'partial', 'overdue'])->count())
                ->description('Awaiting payment')
                ->color('warning'),
            Stat::make('Appointments (7d)', Appointment::query()->where('starts_at', '>=', now())->where('starts_at', '<=', now()->addDays(7))->count())
                ->description('Estimates & installs scheduled')
                ->color('info'),
        ];
    }
}
