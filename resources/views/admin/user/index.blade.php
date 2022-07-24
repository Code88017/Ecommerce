@extends('layouts.admin')
@section('title','Users')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Users
                          
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $item )
                                    <tr>
                                       <td>{{$item->id}}</td>
                                       <td>{{$item->name.' '.$item->lname}}</td>
                                       <td>{{$item->email}}</td>
                                       <td>{{$item->phone}}</td>
                                       <td>
                                        <a href="{{url('view-user/'.$item->id)}}" class="btn btn-primary btn-sm">View</a>
                                       </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection