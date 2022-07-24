@extends('layouts.front')
@section('title','My orders')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>My oders</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tracking no.</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $ord )
                                    <tr>
                                        <td>{{$ord->tracking_no}}</td>
                                        <td>{{$ord->total_price}}</td>
                                        <td>{{$ord->status=='0' ? 'pending':'complete'}}</td>
                                        <td><a href="{{url('view_order/'.$ord->id)}}" class="btn btn-primary">View</a></td>
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