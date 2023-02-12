<?php

namespace App\Services;

use App\Models\Ticket;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Collection;

class AvailableSeatsService
{
    public function get($from, $to)
    {
        $trips = Trip::with('tripDestinations')->whereHas('tripDestinations', function ($query) use ($from) {
            $query->where('station_id', $from);
        })->whereHas('tripDestinations', function ($query) use ($to) {
            $query->where('station_id', $to);
        })->get();

        if( !$trips ) {
            return $trips;
        }
        $tripWithStops = $trips->map(function ($trip) use ($from, $to) {
            return [
                'trip_id' => $trip->id,
                'bus_id' => $trip->bus_id,
                'from_stop_number' => $trip->tripDestinations->firstWhere('station_id', $from)->stop_number,
                'to_stop_number' => $trip->tripDestinations->firstWhere('station_id', $to)->stop_number,
            ];
        });
        $resevedSeats = new Collection();
        foreach ($tripWithStops as $stop) {
            $tickets = Ticket::where('trip_id', $stop['trip_id'])
                ->where('to_stop_number', '>=', $stop['to_stop_number'])
                ->where('from_stop_number', '<', $stop['to_stop_number'])
                ->get();
            $resevedSeats = $resevedSeats->merge($tickets);
        }
        if ($resevedSeats->isEmpty()) {
            $seats = Trip::with('bus.seats')->whereIn('id', $tripWithStops->pluck('trip_id'))->get();
        } else {
            $seats = Trip::with([
                'bus.seats' => function ($query) use ($resevedSeats) {
                    $query->whereNotIn('id', $resevedSeats->pluck('seat_id'));
            }])->whereIn('id', $tripWithStops->pluck('trip_id'))->get();
        }
        return $seats;
    }
}
