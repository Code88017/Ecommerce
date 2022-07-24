@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Products</h3>
        </div>
        <div class="card-body">
           <table class="table table-ordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Small Description</th>
                    <th>Category</th>
                    <th>Selling Price</th>
                    <th>Image</th>
                    <th>Actions</th>
                    
                </tr>
            </thead>
            <tbody>
                
                @foreach ($product as $item )
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->small_description}}</td>
                    <td>{{$item->category->name}}</td>
                    <td>{{$item->selling_price}}</td>
                    <td> <img src="{{url('assets/uploads/product/'.$item->image )}}" alt="Image here" class="category_img">   </td>
                    <td>
                       <a href="{{url('edit-product/'.$item->id)}}" class="btn btn-info">Edit</a> 
                       <a href="{{url('delete-product/'.$item->id)}}" class="btn btn-dannger">Delete</a> 
                    </td>
                  
                </tr>
                    
                @endforeach
            </tbody>
           </table>
        </div>
    </div>
@endsection