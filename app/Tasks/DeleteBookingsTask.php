<?php

namespace App\Tasks;

use App\Models\Booking;

class DeleteBookingsTask
{
    public function __invoke()
    {
        Booking::where('status', 'active')
            ->where('created_at', '<', now())
            ->delete();
    }
}