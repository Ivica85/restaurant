@extends('admin.admin_layout')


@section('content')


    <div class="form-container show-food">
        @if(Session::has('deleted_food'))
            <div class="alert alert-success">{{ session('deleted_food') }}</div>
        @endif

        <h1>Food Menu</h1>
            <table class="table-food">
                <thead>
                    <tr>
                        <th>Food Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Edit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($foods as $food)
                        <tr>
                            <td>{{$food->name}}</td>
                            <td>{{$food->price}}</td>
                            <td>{{$food->description}}</td>
                            <td style="width:150px; height:150px;"><img src="food_images/{{$food->image}}" class="img-fluid"></td>
                            <td><a href="{{route('edit_food',$food->id)}}">Update</a></td>
                            <td><a href="{{route('delete_food',$food->id)}}">Delete</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>

    <div class="form-container">
        @if(Session::has('uploaded_food'))
            <div class="alert alert-success">{{ session('uploaded_food') }}</div>
        @endif
        <h1>Upload Food</h1>
        <form action="{{route('upload_food')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="title">Food Name</label>
                <input type="text" name="name" placeholder="Write a name" required>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="price">Price</label>
                <input type="number" name="price" placeholder="Price" required>
                @error('price')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="image">Image</label>
                <input type="file" name="image">
                @error('image')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="description">Description</label>
                <input type="text" name="description" placeholder="Description" required>
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

