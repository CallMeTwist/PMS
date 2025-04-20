<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Models\Unit;
use Filament\Widgets\ChartWidget;

class PatientsPerUnitChart extends ChartWidget
{
    protected static ?string $heading = 'Patients per Unit';

    protected function getData(): array
    {
        $units = Unit::withCount('patients')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Number of Patients',
                    'data' => $units->pluck('patients_count'),
                    'backgroundColor' => '#3b82f6',
                ],
            ],
            'labels' => $units->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
