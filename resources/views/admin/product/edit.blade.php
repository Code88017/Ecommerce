@extends('layouts.admin')

$@section('content')
<div class="card">
    <div class="card-header">
        <h4>Add Product</h4>
    </div>
    <div class="card-body">
       <form action="{{url('update-product/'.$product->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="">Category</label>
               <select name="cate_id" class="form-control" id="" >
                    <option value="{{$product->category->id}}">{{$product->category->name}}</option>
                  
               
               </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Name</label>
                <input type="text" name="name" class="form-control" value="{{$product->name}}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Slug</label>
                <input type="text" name="slug" class="form-control"  value="{{$product->slug}}">
            </div>
            <div class="col-md-12 mb-3">
                <label for="">Small Description</label>
              <textarea name="small_description" id="" class="form-control"   rows="3">{{$product->small_description}}</textarea>
            </div>
            <div class="col-md-12 mb-3">
                <label for="">Description</label>
              <textarea name="description" id="" class="form-control"    rows="3">{{$product->description}}</textarea>
            </div>
           
            <div class="col-md-6 mb-3">
                <label for="">Original Price</label>
                <input type="number" name="original_price"  value="{{$product->original_price}}" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Selling Price</label>
                <input type="number" name="selling_price"  value="{{$product->selling_price}}" class="form-control">
            </div>
           
            <div class="col-md-6 mb-3">
                <label for="">Tax</label>
                <input type="number" name="tax"  value="{{$product->tax}}" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Quantity</label>
                <input type="number"  value="{{$product->qty}}" name="qty" class="form-control">
            </div>
           
          
           
            <div class="col-md-6 mb-3">
                <label for="">Status</label>
                <input type="checkbox"  {{$product->status? 'chec':''}} name="status" >
            </div>
           
            <div class="col-md-6 mb-3">
                <label for="">Trending</label>
                <input type="checkbox"  {{$product->status? 'chec':''}} name="trending"  >
            </div>
            
            <div class="col-md-12 mb-3">
                <label for="">Meta title</label>
                <input type="text" name="meta_title"  value="{{$product->meta_title}}" class="form-control">
            </div>
            
            <div class="col-md-12 mb-3">
                <label for="">Meta keywords</label>
              
                <textarea name="meta_keywords" id="" class="form-control"  rows="3">
                    {{$product->meta_keywords}}
                </textarea>
            </div>
            <div class="col-md-12 mb-3">
                <label for="">Meta Description</label>
                
                <textarea name="meta_description" id="" class="form-control"  rows="3">
                    {{$product->meta_description}}
                </textarea>
            </div>
            <div>
                <img src="{{asset('assets/uploads/product/'.$product->image)}}" class="category_img" alt="">
            </div>
            <div class="col-md-12 mb-3">
                <label for="">Image</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="col-md-12 mb-3">
                
                <button type="submit" name="update" class="btn btn-primary">update</button>
            </div>
        </div>
       </form>
    </div>
</div>
@endsection