<?php

namespace App\Filament\Widgets;

use App\Models\Job;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class JobsChart extends ChartWidget
{
    protected static ?string $heading = 'Jobs by status';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $rows = Job::query()
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        return [
            'datasets' => [
                [
                    'label' => 'Jobs',
                    'data' => $rows->values()->all(),
                    'backgroundColor' => ['#0F6B63', '#C9A227', '#8B5E3C', '#3D8B80', '#15201E', '#6B7280'],
                ],
            ],
            'labels' => $rows->keys()->map(fn ($s) => ucfirst(str_replace('_', ' ', $s)))->all(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
