@extends('layouts.front')

@section('title')
    E-shop
@endsection

@section('content')
     @include('layouts.inc.slider')
    <div class="py-5">
        <div class="container">
           <h3>Featured Products</h3>
           <hr>
            <div class="row">
               
                <div class="owl-carousel feature-carousel owl-theme">
                    @foreach ($featured_product as $prod )
                        <div class="item">
                            <div class="card ">
                                <a href="{{url('category/'.$prod->slug)}}">
                                    <img src="{{asset('assets/uploads/product/'. $prod->image)}}" class="img-responsive" alt="">
                                    <div class="card-body">
                                        <h5>{{$prod->name}}</h5>
                                    
                                        <span class="float-start">Rs.{{$prod->selling_price}}</span>
                                        <span class="float-end"><s>Rs.{{$prod->original_price}}</s></span>
                                    </div>
                                </a>
                            </div>
                        </div> 
                    @endforeach         
                </div>
            </div>
        </div>
    </div>
    <div class="py-3">
        <div class="container">
           <h3>Trending Products</h3>
           <hr>
            <div class="row">
               
                <div class="owl-carousel feature-carousel owl-theme">
                    @foreach ($trnd_cat as $cate )
                        <div class="item">
                            <div class="card ">
                                <a href="{{url('category/'.$cate->slug)}}">
                                    <img src="{{asset('assets/uploads/category/'. $cate->image)}}" class="img-responsive" alt="">
                                    <div class="card-body">
                                        <h5>{{$cate->name}}</h5>
                                    
                                        <span >{{$cate->description}}</span>
                                    
                                    </div>
                                </a>
                            </div>
                        </div> 
                    @endforeach         
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
           $('.feature-carousel').owlCarousel({
                loop:true,
                margin:10,
                nav:true,
                dots:false,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:4
                    }
                }
            })
    </script>
@endsection