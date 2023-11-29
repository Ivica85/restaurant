@extends('admin.admin_layout')

@section('content')

    <div class="form-container">
        @if(Session::has('updated_food'))
            <div class="alert alert-success">{{ session('updated_food') }}</div>
        @endif
        <h1>Upload Food</h1>
        <form action="{{route('update_food',$food->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <label for="title">Food Name</label>
                <input type="text" name="name" placeholder="Write a name"  value="{{$food->name}}"required>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="price">Price</label>
                <input type="number" name="price" placeholder="Price" value="{{$food->price}}"required>
                @error('price')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label>Current Image</label>
                <img height="100" src="/food_images/{{$food->image}}">
            </div>
            <div>
                <label for="image">New Image</label>
                <input type="file" name="image">
                @error('image')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="description">Description</label>
                <input type="text" name="description" placeholder="Description" value="{{$food->description}}" required>
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <input type="submit" value="Save">
            </div>

        </form>


    </div>

@endsection
