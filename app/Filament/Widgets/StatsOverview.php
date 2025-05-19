<?php

namespace App\Filament\Widgets;

use App\Models\Interest;
use App\Models\Skill;
use App\Models\Service;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Support\Enums\IconPosition;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class StatsOverview extends BaseWidget
{
    protected static int $columns = 4;

    protected function getStats(): array
    {
        $usersInactive = Cache::remember('users_inactive', 3600, function () {
            return User::select('id')->where('status', 0)->count();
        });
        
        $usersActives = Cache::remember('users_actives', 3600, function () {
            return User::select('id')->where('status', 1)->count();
        });
        
        $skills = Cache::remember('skills_count', 3600, function () {
            return Skill::select('id')->count();
        });
        
        $interest = Cache::remember('interest_count', 3600, function () {
            return Interest::select('id')->count();
        });
        
        $totalComplete = Cache::remember('total_complete_profiles', 3600, function () {
            return User::getTotalCompleteProfiles();
        });
        
        $totalIncomplete = Cache::remember('total_incomplete_profiles', 3600, function () {
            return User::getTotalIncompleteProfiles();
        });
        
        $totalProcess = Cache::remember('total_process_profiles', 3600, function () {
            return User::getTotalProcessProfiles();
        });
        
        $updatedThisMonth = Cache::remember('users_updated_this_month', 3600, function () {
            return User::whereMonth('updated_at', Carbon::now()->month)
                      ->whereYear('updated_at', Carbon::now()->year)
                      ->count();
        });
        
        return [
            Stat::make('Usuarios inactivos', number_format($usersInactive))
                ->description('Pendientes de activación')
                ->descriptionIcon('heroicon-m-user-minus', IconPosition::Before)
                ->color('danger'),
            Stat::make('Usuarios activos', number_format($usersActives))
                ->description('Usuarios verificados')
                ->descriptionIcon('heroicon-m-user-circle', IconPosition::Before)
                ->color('success'),
            Stat::make('Habilidades', number_format($skills))
                ->description('Competencias registradas')
                ->descriptionIcon('heroicon-m-academic-cap', IconPosition::Before)
                ->color('info'),
            Stat::make('Intereses', number_format($interest))
                ->description('Áreas de interés')
                ->descriptionIcon('heroicon-m-heart', IconPosition::Before)
                ->color('primary'),
            Stat::make('Perfiles actualizados', number_format($totalComplete))
                ->description('Completos')
                ->color('success')
                ->descriptionIcon('heroicon-m-check-badge', IconPosition::Before),
            Stat::make('Perfiles incompletos', number_format($totalIncomplete))
                ->description('Requieren atención')
                ->color('danger')
                ->descriptionIcon('heroicon-m-exclamation-triangle', IconPosition::Before),
            Stat::make('Completando perfiles', number_format($totalProcess))
                ->description('En proceso')
                ->color('warning')
                ->descriptionIcon('heroicon-m-clock', IconPosition::Before),
            Stat::make('Actualizados este mes', number_format($updatedThisMonth))
                ->description('Perfiles modificados')
                ->color('success')
                ->descriptionIcon('heroicon-m-arrow-path', IconPosition::Before),
        ];
    }
}
