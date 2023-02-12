<?php

namespace App\Observers;

use App\Models\Bus;
use App\Models\Seat;

class BusesObserver
{
    public function created(Bus $bus)
    {
        \Log::info($bus);
        for ($i = 1; $i = $bus->seat_count; $i++) {
            Seat::create([
                'bus_id' => $bus->id,
                'name' => "A" . $i
            ]);
        }
    }
}
