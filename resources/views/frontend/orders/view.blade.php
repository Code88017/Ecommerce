@extends('layouts.front')
@section('title','View orders')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Order View
                            <a href="{{url('my-order')}}" class="btn btn-warning float-end">Back</a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 view-order">
                                <h6>Shipping Details</h6>
                                <hr>
                                <label for="">First Name</label>
                                <div class="border ">{{$order->fname}}</div>
                                <label for="">Last Name</label>
                                <div class="border ">{{$order->lname}}</div>
                                <label for="">Email</label>
                                <div class="border ">{{$order->email}}</div>
                                <label for="">Contact</label>
                                <div class="border ">{{$order->phone}}</div>
                                <label for="">Shipping Address</label>
                                <div class="border ">
                                    {{$order->address1}} <br>
                                    {{$order->address2}} <br>
                                    {{$order->city}} <br>
                                    {{$order->state}}
                                    {{$order->country}}
                                </div>
                                <label for="">Zip Code</label>
                                <div class="border p-2">{{$order->pincode}}</div>
                            </div>
                            
                            <div class="col-md-6">
                                <h6>Order Details</h6>
                                <hr>
                                <br>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderitem as $item )
                                            <tr>
                                               <td>{{$item->product->name}}</td>
                                               <td>{{$item->qty}}</td>
                                               <td>{{$item->price}}</td>
                                               <td>
                                                  <img src="{{asset('assets/uploads/product/'.$item->product->image)}}" alt="product image" style="width:50px;">
                                               </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                  
                                </table>
                                <h4 class="px-2">Grand total: <span class="float-end">Rs.{{$order->total_price}}</span></h4>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection