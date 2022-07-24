@extends('layouts.front')
@section('title','checkout')

@section('content')
    <div class="mb-4 py-3 bg-warning shadow-sm border-top">
        <div class="container">
        <a href="{{url('/')}}">
            Home
        </a>/
        <a href="{{url('cart')}}">
            Cart
        </a>/
        <a href="{{url('checkout')}}">
            checkout
        </a>
        </div>
    </div>
   <div class="container py-4">
    <form action="{{url('place-order')}}" method="POST">
        {{ csrf_field() }}
      <div class="row">
         <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h6>Basic details</h6>
                    <div class="row checkout-form">
                        <div class="col-md-6">
                            <label for="">First Name</label>
                            <input type="text" class="form-control fname" value="{{Auth::user()->name}}" name="fname" placeholder="Enter First Name">
                            <span id="fname_err" class="text-danger "></span>
                        </div>
                        <div class="col-md-6">
                            <label for="">Last Name</label>
                            <input type="text" name="lname" value="{{Auth::user()->lname}}" class="form-control lname" placeholder="Enter last Name">
                            <span id="lname_err" class="text-danger "></span>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">Email</label>
                            <input type="email" name="email" value="{{Auth::user()->email}}" class="form-control email" placeholder="Enter Email">
                            <span id="email_err" class="text-danger "></span>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">Phone Number</label>
                            <input type="text" name="phone_no" class="form-control phone" value="{{Auth::user()->phone}}" placeholder="Enter Phone Number">
                            <span id="phone_err" class="text-danger "></span>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">Address 1</label>
                            <input type="text" name="address1" class="form-control address1" value="{{Auth::user()->address1}}" placeholder="Enter Address 1">
                            <span id="add1_err" class="text-danger "></span>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">Address 2</label>
                            <input type="text" name="address2" class="form-control address2" value="{{Auth::user()->address2}}" placeholder="Enter Address 2">
                            <span id="add2_err" class="text-danger "></span>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">City</label>
                            <input type="text" value="{{Auth::user()->city}}" name="city" class="form-control city" placeholder="Enter City">
                            <span id="city_err" class="text-danger "></span>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">State</label>
                            <input type="text" value="{{Auth::user()->state}}" name="state" class="form-control state" placeholder="Enter State">
                            <span id="state_err" class="text-danger "></span>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">Country</label>
                            <input type="text" name="country" value="{{Auth::user()->country}}" class="form-control country" placeholder="Enter Country">
                            <span id="country_err" class="text-danger "></span>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">Pin Code</label>
                            <input type="text" value="{{Auth::user()->pincode}}" name="pincode" class="form-control pincode" placeholder="Enter Pin Code">
                            <span id="pincode_err" class="text-danger "></span>
                        </div>
                    </div>
                </div>
            </div>
         </div>
         <div class="col-md-5">
            <div class="card">
                @if ($cart->count()>0)
                    <div class="card-body">
                        <h6>Order details</h6>
                        <hr>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody >
                                    @php
                                        $total=0;
                                    @endphp
                                    @foreach ($cart as $item )
                                    <tr>
                                        <td>{{$item->product->name}}</td>
                                        <td>{{$item->prod_qty}}</td>
                                        <td>Rs.{{$item->product->selling_price}}</td>
                                    </tr> 
                                    @php
                                            $total +=$item->product->selling_price*$item->prod_qty;
                                        @endphp
                                    @endforeach
                                    <tr>
                                        <td colspan="2"><h6>total</h6></td>
                                        <td><h6>Rs.{{$total}}</h6></td>
                                        <input type="hidden" class="total" name="total" value="{{$total}}">
                                    </tr>
                            </tbody>
                        
                        </table>
                        <input type="hidden" name="payment_mode" value="COD">
                        <hr>
                        <button type="submit" class="btn btn-success w-100">Place order | COD</button>
                        {{-- <button type="button" class="btn btn-primary w-100 mt-3 razorpay-btn">Pay with Razorpay</button> --}}
                         <div id="paypal-button-container" class="mt-3"></div>
                    </div>
                @else
                     <div class="card-body">
                        <h3>You have no order</h3>
                     </div>
                @endif
            </div>
         </div>
      </div>
    </form>
   </div> 
@endsection
@section('scripts')
<script src="https://www.paypal.com/sdk/js?client-id=AWJMVegGJrwtaDWRzCb6N7gMhlQzqYhj1_xvr1-6UujJFlq9qbvQzZHCv3VsK0I6mA5awfUjMrfrvH5w" data_source="integrationbuilder"></script>

<script>
    var total=$('.total').val();
    paypal.Buttons({

      // Sets up the transaction when a payment button is clicked

      createOrder: (data, actions) => {

        return actions.order.create({
           
          purchase_units: [{

            amount: {

              value: total // Can also reference a variable or function

            }

          }]

        });

      },

      // Finalize the transaction after payer approval

      onApprove: (data, actions) => {

        return actions.order.capture().then(function(orderData) {

          // Successful capture! For dev/demo purposes:

        //   console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

        //   const transaction = orderData.purchase_units[0].payments.captures[0];

        //   alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
        $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

        var fname=$('.fname').val();
        var lname=$('.lname').val();
        var email=$('.email').val();
        var phone=$('.phone').val();
        var address1=$('.address1').val();
        var address2=$('.address2').val();
        var city=$('.city').val();
        var state=$('.state').val();
        var country=$('.country').val();
        var pincode=$('.pincode').val();
          $.ajax({
                type: 'POST',
                url: '/place-order',
                data: {
                    'fname':fname,
                    'lname':lname,
                    'email':email,
                    'phone_no':phone,
                    'address1':address1,
                    'address2':address2,
                    'city':city,
                    'state':state,
                    'country':country,
                    'pincode':pincode,
                    'payment_mode':'Paid by paypal',
                    'payment_id':orderData.id,
                
                },
                success:function(res){
                    swal(res.status)
                    .then((value) => {
                        window.location.href="/my-order";
                    });
                   
                    }
               
        
            });
        });

      }

    }).render('#paypal-button-container');

  </script>
@endsection