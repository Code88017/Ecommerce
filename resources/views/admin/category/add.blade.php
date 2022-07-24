@extends('layouts.admin')

$@section('content')
<div class="card">
    <div class="card-header">
        <h4>Add category</h4>
    </div>
    <div class="card-body">
       <form action="{{url('insert-category')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="">Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Slug</label>
                <input type="text" name="slug" class="form-control">
            </div>
            <div class="col-md-12 mb-3">
                <label for="">Description</label>
              <textarea name="description" id="" class="form-control"  rows="3"></textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Status</label>
                <input type="checkbox" name="status" >
            </div>
            <div class="col-md-6 mb-3">
                <label for="">Popular</label>
                <input type="checkbox" name="popular" >
            </div>
            <div class="col-md-12 mb-3">
                <label for="">Meta title</label>
                <input type="text" name="meta_title" class="form-control">
            </div>
            <div class="col-md-12 mb-3">
                <label for="">Meta keywords</label>
              
                <textarea name="meta_keywords" id="" class="form-control"  rows="3"></textarea>
            </div>
            <div class="col-md-12 mb-3">
                <label for="">Meta Description</label>
                
                <textarea name="meta_description" id="" class="form-control"  rows="3"></textarea>
            </div>
            <div class="col-md-12 mb-3">
                <label for="">Image</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="col-md-12 mb-3">
                
                <button type="submit" name="image" class="btn btn-primary">Add</button>
            </div>
        </div>
       </form>
    </div>
</div>
@endsection