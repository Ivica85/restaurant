@extends('admin.admin_layout')

@section('content')




    <div>
        <h1 style="text-align: center; color: #007bff;">Customer Orders</h1>

        <form method="get" action="{{route('search')}}"  style="text-align: center; margin-bottom: 20px;">
            @csrf
            <input type="text" name="search" style="color: blue; padding: 5px; border: 1px solid #007bff; border-radius: 3px;">
            <input type="submit" value="Search" class="btn btn-primary" style="background-color: #007bff; color: #fff; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer;">
        </form>

        @if(Session::has('order_deleted'))
            <div class="alert alert-success" style="margin-bottom: 15px;">{{ session('order_deleted') }}</div>
        @endif

        <table class="reservations" style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Food name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{$order->name}}</td>
                    <td>{{$order->phone}}</td>
                    <td>{{$order->address}}</td>
                    <td>{{$order->food_name}}</td>
                    <td>{{$order->price}}$</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->price * $order->quantity}}$</td>
                    <td><a href="{{route('delete_order',$order->id)}}" style="color: #dc3545; text-decoration: none;">Delete</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>



@endsection
