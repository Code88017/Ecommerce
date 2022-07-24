@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Categories</h3>
        </div>
        <div class="card-body">
           <table class="table table-ordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                    
                </tr>
            </thead>
            <tbody>
                
                @foreach ($category as $item )
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->description}}</td>
                    <td> <img src="{{url('assets/uploads/category/'.$item->image )}}" alt="Image here" class="category_img">   </td>
                    <td>
                       <a href="{{url('edit-category/'.$item->id)}}" class="btn btn-info">Edit</a> 
                       <a href="{{url('delete-category/'.$item->id)}}" class="btn btn-dannger">Delete</a> 
                    </td>
                  
                </tr>
                    
                @endforeach
            </tbody>
           </table>
        </div>
    </div>
@endsection