@extends('layouts.front')
@section('title','My Cart')

@section('content')
   <div class="mb-4 py-3 bg-warning shadow-sm border-top">
      <div class="container">
         <a href="{{url('/')}}">
             Home
         </a>/
         <a href="{{url('cart')}}">
             Cart
         </a>
      </div>
   </div>
    <div class="container py-4">
        <div class="card shadow cartitem product_data">
            @if ($cartItem->count()>0)
                
           
                <div class="card-body">
                    @php
                        $total=0;
                    @endphp
                    @foreach ($cartItem as $cart )           
                        <div class="row product_data ">
                            <div class="col-md-2">
                                <img src="{{asset('assets/uploads/product/'.$cart->product->image)}}" alt="image" style="height: 70px; width:70px;">
                            </div>
                            <div class="col-md-3 my-auto">
                                <h6>{{$cart->product->name}}</h6>
                            </div>
                            <div class="col-md-2 my-auto">
                                <h6>Rs.{{$cart->product->selling_price}}</h6>
                            </div>
                            <div class="col-md-3 my-auto">
                                <input type="hidden" value="{{$cart->prod_id}}" class="product_id">
                                @if ($cart->product->qty>=$cart->prod_qty)
                                    <label for="">Quantity</label>
                                    <div class="input-group text-center mb-3">
                                        <button class="input-group-text decrement-btn   changeQuantity">-</button>
                                        <input type="text" name="quantity" value="  {{$cart->prod_qty}}" class="form-control  text-center qty-input">
                                        <button class="input-group-text  increment-btn changeQuantity ">+</button>
                                    </div>
                                    @php
                                        $total +=$cart->product->selling_price*$cart->prod_qty;
                                    @endphp
                                @else
                                <h6>Out of stock</h6>
                                @endif
                                
                            </div>
                            <div class="col-md-2">
                                <br>
                                <button class="btn btn-danger delete-cart-item">Remove</button>
                            </div>
                        </div>
                    
                    @endforeach
                </div>
                <div class="card-footer">
                    <h6>Total Rs.{{$total}}/-
                    <a href="{{url('checkout')}}" class="btn btn-outline-success float-end">Proceed to Checkout</a>
                    </h6>
                </div>
            @else
                <div class="card-body text-center">
                    <h2>Your <i class="fa fa-shopping-cart"></i> Cart is empty.</h2>
                    <a href="{{url('category')}}" class="btn btn-outline-primary float-end">Continue shopping</a>
                </div>
            @endif
        </div>
    </div>
@endsection