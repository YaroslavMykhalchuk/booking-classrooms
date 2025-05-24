<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\Schedule;
use App\Tasks\DeleteBookingsTask;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(new DeleteBookingsTask)->weeklyOn(6, '18:00')->name('delete-booking-task')->withoutOverlapping();