<?php

namespace App\Filament\Widgets;

use App\Models\Skill;
use App\Models\Service;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Support\Enums\IconPosition;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $usersInactive = User::select('id')->where('status',0)->count();
        $usersActives = User::select('id')->where('status',1)->count();
        $skills = Skill::select('id')->count();
        $services = Service::select('id')->count();
        return [
            Stat::make('Usuarios inactivos', number_format($usersInactive))
                ->description('Total de usuarios')
                ->descriptionIcon('heroicon-m-arrow-trending-up', IconPosition::Before),
            Stat::make('Usuarios activos', number_format($usersActives))
                ->description('Total de usuarios')
                ->descriptionIcon('heroicon-m-arrow-trending-up', IconPosition::Before),
            Stat::make('Habilidades', number_format($skills))
                ->description('Total de habilidades')
                ->descriptionIcon('heroicon-m-arrow-trending-up', IconPosition::Before),
            Stat::make('Servicios', number_format($services))
                ->description('Total de servicios')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }
}
