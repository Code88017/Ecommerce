@extends('layouts.front')

@section('title')
    E-shop:Categories
@endsection

@section('content')
   <div class="py-5">
    <div class="container">
        <h3>All Categories</h3>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    @foreach ($category as $cat )
                       <div class="col-md-3">
                            <a href="{{url('category/'.$cat->slug)}}">
                                <div class="card">
                                    <img src="{{asset('assets/uploads/category/'.$cat->image)}}" alt="Category Image">
                                    <div class="card-body">
                                        <h5>{{$cat->name}}</h5>
                                        <span >{{$cat->description}}</span>
                                    
                                    </div>
                                </div>
                            </a>
                       </div>
                        
                    @endforeach
                </div>
            </div>
        </div>
    </div>
   </div>

@endsection