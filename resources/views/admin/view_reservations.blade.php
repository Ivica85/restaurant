@extends('admin.admin_layout')

@section('content')



    <div>
        @if(Session::has('delete_reservation'))
            <div class="alert alert-success">{{ session('delete_reservation') }}</div>
        @endif
        <table  class="reservations">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Guests</th>
                <th>Date</th>
                <th>Time</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->name }}</td>
                    <td>{{ $reservation->email }}</td>
                    <td>{{ $reservation->phone }}</td>
                    <td>{{ $reservation->guests }}</td>
                    <td>{{ $reservation->date }}</td>
                    <td>{{ $reservation->time }}</td>
                    <td>{{ $reservation->message }}</td>
                    <td><a href="{{route('delete_reservation',$reservation->id)}}">Delete</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
