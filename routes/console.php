<?php

use App\Jobs\CloseJob;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
    CloseJob::dispatch();
})->dailyAt('08:00')->timezone('Europe/Paris')->name('close_tickets');