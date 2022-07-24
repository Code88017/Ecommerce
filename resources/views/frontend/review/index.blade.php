@extends('layouts.front')

@section('title','Write a review')
    

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if ($verify_purchase->count()>0)
                          <h5>You are writing a review for {{$p_check->name}}</h5>
                           <form action="{{url('/add-review')}}" method="POST">
                              @csrf
                              <input type="hidden" name="p_id" value="{{$p_check->id}}">
                              <textarea name="user_review" id="" placeholder="Write a review" rows="8" class="form-control"></textarea>
                              <button type="submit" class="btn btn-primary mt-3">Submit Review</button>
                           </form>
                        @else
                            <div class="alert alert-danger">
                                <h5>You are not eligible to review this product</h5>
                                <p>For the trusthworthiness of the reviews, only customers who purchased the product can write a reviewabout the product.</p>
                                <a href="{{url('/')}}" class="btn btn-primary mt-3">Go to home</a>
                            </div>
                        @endif
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
    