@extends('layouts.front')
@section('title','Wishlist')

@section('content')
<div class="mb-4 py-3 bg-warning shadow-sm border-top">
    <div class="container">
       <a href="{{url('/')}}">
           Home
       </a>/
       <a href="{{url('wishlist')}}">
           Wishlist
       </a>
    </div>
 </div>
 <div class="container py-4">
    <div class="card wishlistitem shadow product_data">
        <div class="card-body">
           
            @if ($wish->count()>0)
                @foreach ($wish as $item )           
                    <div class="row product_data ">
                        <div class="col-md-2">
                            <img src="{{asset('assets/uploads/product/'.$item->product->image)}}" alt="image" style="height: 70px; width:70px;">
                        </div>
                        <div class="col-md-2 my-auto">
                            <h6>{{$item->product->name}}</h6>
                        </div>
                        <div class="col-md-2 my-auto">
                            <h6>Rs.{{$item->product->selling_price}}</h6>
                        </div>
                        <div class="col-md-2 my-auto">
                            <input type="hidden" value="{{$item->prod_id}}" class="product_id">
                            @if ($item->product->qty>=$item->prod_qty)
                                <label for="">Quantity</label>
                                <div class="input-group text-center mb-3">
                                    <button class="input-group-text decrement-btn   ">-</button>
                                    <input type="text" name="quantity" value="  {{$item->prod_qty}}" class="form-control  text-center qty-input">
                                    <button class="input-group-text  increment-btn  ">+</button>
                                </div>
                              
                            @else
                            <h6>Out of stock</h6>
                            @endif
                            
                        </div>
                        <div class="col-md-2">
                            <br>
                            <button class="btn btn-success addToCart">Add to cart</button>
                        </div>
                        <div class="col-md-2">
                            <br>
                            <button class="btn btn-danger delete-wishlist-item">Remove</button>
                        </div>
                    </div>
                
                @endforeach
           @else
                <div class="card-body text-center">
                    <h2>Your <i class="fa fa-heart"></i> Wishlist is empty.</h2>
                    <a href="{{url('category')}}" class="btn btn-outline-primary float-end">Continue shopping</a>
                </div>
            @endif
           
           
        </div>
      
    </div>
</div>
@endsection