@extends('admin.admin_layout')

@section('content')

    <div class="form-container">
        @if(Session::has('updated_chef'))
            <div class="alert alert-success">{{ session('updated_chef') }}</div>
        @endif
        <h1>Upload Food</h1>
        <form action="{{route('update_chef',$chef->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <label for="title">Food Name</label>
                <input type="text" name="name" placeholder="Write a name"  value="{{$chef->name}}"required>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label>Current Image</label>
                <img height="100" src="/chef_images/{{$chef->image}}">
            </div>
            <div>
                <label for="image">New Image</label>
                <input type="file" name="image">
                @error('image')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="speciality">Speciality</label>
                <input type="text" name="speciality" placeholder="Speciality" value="{{$chef->speciality}}" required>
                @error('speciality')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <input type="submit" value="Save">
            </div>

        </form>


    </div>

@endsection
