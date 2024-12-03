<?php

use Illuminate\Foundation\Inspiring;
use App\Console\Commands\RenewToken;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('app:renew-token')->daily();