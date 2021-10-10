<?php
declare(strict_types=1);

namespace App\Enjoythetrip\Traits;

use Illuminate\Http\Request;

trait Ajax {


    public function ajaxGetReservationData(Request $request)
    {

        $reservation = $this->bR->getReservationData($request);

        return response()->json([
            'room_number' => $reservation->room->room_number,
            'day_in' => $reservation->day_in,
            'day_out' => $reservation->day_out,
            'FullName' => $reservation->user->FullName,
            'userLink' => route('person', ['id' => $reservation->user->id]),
            'confirmResLink' => route('confirmResLink', ['id' => $reservation->id]),
            'deleteResLink' => route('deleteResLink', ['id' => $reservation->id]),
            'status' => $reservation->status
        ]);
    }


}

