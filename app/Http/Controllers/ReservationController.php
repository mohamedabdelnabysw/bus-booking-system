<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReserveRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Ticket;
use App\Services\AvailableSeatsService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    protected $availableSeatsService;
    public function __construct(AvailableSeatsService $availableSeatsService)
    {
        $this->availableSeatsService = $availableSeatsService;
    }
    public function store(ReserveRequest $request)
    {
        return response()->json(Ticket::create($request->validated()));
    }

    public function  AvailableSeats(SearchRequest $request)
    {
        return response()->json(
            $this->availableSeatsService->get($request->validated()['from_id'], $request->validated()['to_id'])
        );
    }

}
