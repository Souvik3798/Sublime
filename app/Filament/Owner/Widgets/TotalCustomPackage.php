<?php

namespace App\Filament\Owner\Widgets;

use App\Models\CustomPackage;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class TotalCustomPackage extends ChartWidget
{
    protected static ?string $heading = 'Custom Packages';

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        switch ($activeFilter) {
            case 'today':
                $start = now()->startOfDay();
                $data = Trend::model(CustomPackage::class)
                    ->between(
                        start: $start,
                        end: now(),
                    )
                    ->perHour()
                    ->count();
                $labelFormat = 'H:i'; // Hour and minute format
                break;

            case 'week':
            case 'month':
                $start = $activeFilter === 'week' ? now()->subWeek()->startOfDay() : now()->subMonth()->startOfDay();
                $data = Trend::model(CustomPackage::class)
                    ->between(
                        start: $start,
                        end: now(),
                    )
                    ->perDay()
                    ->count();
                $labelFormat = 'd M'; // Day and month format
                break;

            case 'year':
            default:
                $start = now()->subYear()->startOfDay();
                $data = Trend::model(CustomPackage::class)
                    ->between(
                        start: $start,
                        end: now(),
                    )
                    ->perMonth()
                    ->count();
                $labelFormat = 'M Y'; // Month and year format
                break;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Custom Package Count',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor' => 'blue',
                    'pointBackgroundColor' => 'blue',
                    'pointBorderColor' => 'blue',
                    'pointRadius' => 5, // Adjust point size
                    'pointHoverRadius' => 7, // Adjust hover point size
                    'fill' => false,
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => \Carbon\Carbon::parse($value->date)->format($labelFormat)),
            'options' => [
                'plugins' => [
                    'datalabels' => [
                        'display' => true,
                        'align' => 'top',
                        'anchor' => 'end',
                        'formatter' => fn ($value) => round($value, 2), // Format the displayed value
                        'font' => [
                            'weight' => 'bold',
                            'size' => 12,
                        ],
                    ],
                ],
                'scales' => [
                    'y' => [
                        'beginAtZero' => true,
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getFilters(): ?array
    {
        return [
            'year' => 'This year',
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
        ];
    }
}
