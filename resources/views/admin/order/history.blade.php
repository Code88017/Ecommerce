@extends('layouts.admin')
@section('title','Orders')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Orders history
                            <a href="{{url('orders')}}" class="btn btn-warning float-right">New Order </a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Order Date</th>
                                    <th>Tracking no.</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $ord )
                                    <tr>
                                        <td>{{date('d-m-Y',strtotime($ord->created_at))}}</td>
                                        <td>{{$ord->tracking_no}}</td>
                                        <td>{{$ord->total_price}}</td>
                                        <td>{{$ord->status=='0' ? 'pending':'complete'}}</td>
                                        <td><a href="{{url('admin/view_order/'.$ord->id)}}" class="btn btn-primary">View</a></td>
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