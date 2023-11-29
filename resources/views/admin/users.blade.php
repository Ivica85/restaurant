@extends('admin.admin_layout')

@section('content')
    <div class="container">
        @if(Session::has('deleted_user'))
            <div class="alert alert-success">{{ session('deleted_user') }}</div>
        @elseif(Session::has('access_denied'))
            <div class="alert alert-danger">{{ session('access_denied') }}</div>
        @endif

        <h1 class="mt-5">Lista korisnika</h1>
        <table class="table mt-3">
            <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Position</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        {{$user->user_type == 1 ? "Admin" : "User"}}
                    </td>
                    <form action="{{route('delete_user',$user->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <td>
                            <button class="btn btn-danger">Delete</button>
                        </td>
                    </form>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
