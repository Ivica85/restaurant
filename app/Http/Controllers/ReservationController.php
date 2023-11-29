<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReservationController extends Controller
{
    public function reservation(ReservationRequest $request )
    {
        $reservation = new Reservation();
        $reservation->name = $request->input('name');
        $reservation->email = $request->input('email');
        $reservation->phone = $request->input('phone');
        $reservation->guests = $request->input('guests');
        $reservation->date = $request->input('date');
        $reservation->time = $request->input('time');
        $reservation->message = $request->input('message');



        $reservation->save();

        Session::flash('reservation', "Reservation successfully added.");
        return redirect()->back();
    }

    public function view_reservations()
    {
        $reservations = Reservation::all();

        return view('admin.view_reservations',compact('reservations'));
    }

    public function delete_reservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        Session::flash('delete_reservation', "Reservation successfully deleted.");

        return redirect()->back();
    }


}
