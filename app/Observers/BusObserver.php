<?php

namespace App\Observers;

use App\Models\Bus;
use App\Models\Seat;

class BusObserver
{
    /**
     * Handle the Bus "created" event.
     *
     * @param  \App\Models\Bus  $bus
     * @return void
     */
    public function created(Bus $bus)
    {
        for ($i = 1; $i <= 12; $i++) {
            Seat::create([
                'bus_id' => $bus->id,
                'name' => "A" . $i
            ]);
        }
    }
}
