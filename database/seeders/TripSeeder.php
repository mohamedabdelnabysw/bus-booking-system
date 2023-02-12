<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Station;
use App\Models\Trip;
use App\Models\TripDestination;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stations = Station::skip(2)->limit(4)->get();
        $trip = Trip::create([
            'from_station_id' => $stations->first()->id,
            'to_station_id' => $stations->last()->id,
            'bus_id' => Bus::all()->first()->id
        ]);
        $stations->map(function ($station , $key) use ($trip) {
            TripDestination::create([
                "trip_id" => $trip->id,
                'station_id' => $station->id,
                'stop_number' => $key + 1
            ]);
        });
    }
}
