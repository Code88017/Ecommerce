@extends('layouts.front')

@section('title',$product->name)
    

@section('content')
    
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
           <form action="{{url('/add-rating')}}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rate {{$product->name}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="rating-css">
                        <div class="star-icon">
                            @if ($user_rating)
                                @for ($i=1;$i<=$user_rating->stars_rating;$i++)
                                    <input type="radio" value="{{$i}}" name="product_rating" checked id="rating{{$i}}">
                                    <label for="rating{{$i}}" class="fa fa-star"></label>
                                @endfor
                                    @for ($j=$user_rating->stars_rating+1;$j<=5;$j++)
                                    <input type="radio" value="{{$j}}" name="product_rating"  id="rating{{$j}}">
                                    <label for="rating{{$j}}" class="fa fa-star"></label>
                                @endfor 
                            @else
                         
                                <input type="radio" value="1" name="product_rating" checked id="rating1">
                                <label for="rating1" class="fa fa-star"></label>
                                <input type="radio" value="2" name="product_rating" id="rating2">
                                <label for="rating2" class="fa fa-star"></label>
                                <input type="radio" value="3" name="product_rating" id="rating3">
                                <label for="rating3" class="fa fa-star"></label>
                                <input type="radio" value="4" name="product_rating" id="rating4">
                                <label for="rating4" class="fa fa-star"></label>
                                <input type="radio" value="5" name="product_rating" id="rating5">
                                <label for="rating5" class="fa fa-star"></label>
                                    
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
      </div>
    </div>
  </div>
  


   

  <div class="py-3 mb-4 shadow-sm bg-warning border-top">
     <div class="container">
        <h6 class="mb-0">
            <a href="{{url('category')}}">
            Collections
           </a>/
           <a href="{{url('category/'.$product->category->slug)}}">
            {{$product->category->name}}
           </a> /
            <a href="{{url('category/'.$product->category->slug.'/'.$product->slug)}}">
             {{$product->name}}
            </a>
            </h6>
     </div>
  </div>
  <div class="container">
     <div class="card shadow product_data">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 border-right">
                    <img src="{{asset('assets/uploads/product/'.$product->image)}}" alt="" >
                </div>
                <div class="col-md-8">
                    <h2 class="mb-0">
                        {{$product->name}}
                        @if ($product->trending=='1')
                             <label for="" class=" trending_tag float-end badge bg-danger">Trending</label> 
                        @endif
                        
                    </h2>
                    <hr>
                    <label for="" class="me-3">Original Price : <s>Rs.{{$product->original_price}}</s></label>
                    <label for="" class="fw-bold">Selling Price : Rs.{{$product->selling_price}}</label>
                 
                    @php
                        $num=number_format($rating_value)
                    @endphp
                    <div class="rating">
                        @for ($i=1;$i<=$num;$i++)
                            <i class="fa fa-star checked"></i>
                        @endfor
                        @for ($j=$num+1;$j<=5;$j++)
                           <i class="fa fa-star"></i>
                        @endfor
                        @if ($rate->count()>0)
                           <span>{{$rate->count()}} Rating</span>
                        @else
                            No Rating
                        @endif
                        
                    </div>
                    <p class="mt-3">
                        {!!$product->small_description!!}
                    </p>
                    <hr>
                    @if ($product->qty>0)
                      <label for="" class="badge bg-success">In stock</label>
                    @else
                      <label for="" class="badge bg-danger">Out of stock</label>
                        
                    @endif

                    <div class="row mt-2">
                        <div class="col-md-2">
                            <input type="hidden" value="{{$product->id}}" class="product_id">
                            <label for="">Quantity</label>
                            <div class="input-group text-center mb-3">
                                <button class="input-group-text px-2 decrement-btn">-</button>
                                <input type="text" name="quantity" value="1" class="form-control text-center qty-input">
                                <button class="input-group-text px-2 increment-btn">+</button>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <br>
                            @if ($product->qty>0)
                                  <button type="button" class="btn btn-success me-3 float-start addToCart">Add to Cart <i class="fa fa-shopping-cart"></i></button>
                            @endif
                           
                                 <button type="button" class="btn btn-danger me-3 float-start addToWishlist">Add to Wishlist <i class="fa fa-heart"></i></button>
                        </div>
                    </div>
                    
                </div>
                <hr>
                <div class="col-md-12">
                    <h2>Description</h2>
                    <p>{{$product->description}}</p>
                   
                      

                </div>
                
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Rate {{$product->name}}
                      </button>
                    <a href="{{url('add-review/'.$product->slug.'/user-review' )}}" class="btn btn-link" >
                       Write a review
                    </a>
                </div>
                <div class="col-md-8">
                    @foreach ($review as $item )
                        <div class="user-review">
                  
                            <label for="">{{$item->user->name.' '.$item->user->lname}}</label>
                            @if ($item->user_id==Auth::id())
                               <a href="{{url('edit-review/'.$product->slug.'/user-review')}}">edit</a>
                            @endif
                            <br>
                            @php
                                $ratingg=App\Models\Rating::where('prod_id',$product->id)->where('user_id',$item->user->id)->first();
                            @endphp
                            @if ($ratingg)
                                @php
                                $user_rate=$ratingg->stars_rating
                                @endphp
                                @for ($i=1;$i<=$user_rate;$i++)
                                    <i class="fa fa-star checked"></i>
                                @endfor
                                @for ($j=$user_rate+1;$j<=5;$j++)
                                    <i class="fa fa-star "></i>
                                @endfor 
                            @endif
                           
                          
                            <small>Reviewed on {{$item->created_at->format('d M Y')}}</small>
                            <p>{{$item->user_review}}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
     </div>
  </div>
@endsection

