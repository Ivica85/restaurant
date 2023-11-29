@extends('admin.admin_layout')

@section('content')

    <div class="form-container show-food">
        @if(Session::has('delete_chef'))
            <div class="alert alert-success">{{ session('delete_chef') }}</div>
        @endif

        <h1>Chefs</h1>
        <table class="table-food">
            <thead>
            <tr>
                <th>Chef Name</th>
                <th>Speciality</th>
                <th>Image</th>
                <th>Edit</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($chefs as $chef)
                <tr>
                    <td>{{$chef->name}}</td>
                    <td>{{$chef->speciality}}</td>
                    <td style="width:150px; height:150px;"><img src="chef_images/{{$chef->image}}" class="img-fluid"></td>
                    <td><a href="{{route('edit_chef',$chef->id)}}">Update</a></td>
                    <td><a href="{{route('delete_chef',$chef->id)}}">Delete</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>



    <div class="form-container">
        <h1>Add Chef</h1>
        @if(Session::has('chef_uploaded'))
            <div class="alert alert-success" style="max-height: 100px; overflow: auto; margin-bottom: 10px; padding: 10px; border-radius: 5px; background-color: #d4edda; border-color: #c3e6cb; color: #155724;">
                {{ session('chef_uploaded') }}
            </div>
        @endif
        <form action="{{route('upload_chef')}}" method="post" enctype="multipart/form-data" id="chefForm">
            @csrf
            <div>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required placeholder="Enter Name">
            </div>

            <div>
                <label for="speciality">Speciality</label>
                <input type="text" id="speciality" name="speciality" required placeholder="Enter the speciality">
            </div>

            <div>
                <label for="image">Image</label>
                <input type="file" id="image" name="image">
            </div>

            <div style="margin-top: 10px;">
                <input type="submit" value="Save">
            </div>
        </form>
    </div>




@endsection
