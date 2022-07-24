@extends('layouts.front')

@section('title')
{{$category->name}}
@endsection

@section('content')
  <div class="py-5">
    <div class="container">
        <h3>{{$category->name}}</h3>
        <div class="row">
            @foreach ($product as $prd )
                <div class="col-md-3">
                    <a href="{{url('category/'.$category->slug.'/'.$prd->slug)}}">
                    <div class="card">
                        
                            <img src="{{asset('assets/uploads/product/'.$prd->image)}}" class="img-responsive" alt="">
                            <div class="card-body">
                                <p>
                                    {{$prd->name}}
                                </p>
                                <span class="float-start">Rs.{{$prd->selling_price}}</span>
                                <span class="float-end">Rs.<s>{{$prd->original_price}}</s></span>
                            </div>
                        
                    </div>
                   </a>
                </div> 
            @endforeach
            
        </div>
    </div>
  </div>
@endsection