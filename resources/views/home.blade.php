@extends('layouts.admin-lite')
@section('title')
    Dashboard
    @endsection
@section('page-header')
    Dashboard
    @endsection
@section('optional-header')
    @endsection
@section('level')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
    @endsection
@section('content')
{{--<div class="container" style="margin-left:0; margin-right:0;">--}}
    <div class="row justify-content-center">
        {{--<div class="col-md-8">--}}
            <div class="card">
                {{--  <div class="card-header"></div>  --}}
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-warning" role="alert">
                            {{ session('status') }}
                        </div>
                    @else
                </div>
            </div>
             <div class="row">
                <div class="col-lg-3 col-xs-6" style="padding-left: 30px;">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                        <h3>{{$routes}}</h3>
                        <p>Routes</p>
                        </div>
                        <div class="icon">
                        <i class="fa fa-map-marker"></i>
                        </div>
                    </div>
                </div>
                    <!-- small box -->
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                        <h3>{{$nics}}</h3>
                        <p>Users</p>
                        </div>
                        <div class="icon">
                         <i class="fa fa-user"></i>
                        </div>
                    </div>
                </div>
                  <!-- small box -->
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                        <h3>{{$journeys}}</h3>
                        <p>Journeys</p>
                        </div>
                        <div class="icon">
                         <i class="fa fa-road"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6" style="padding-right: 30px;">
                    <div class="small-box bg-blue">
                        <div class="inner">
                        <h3>0</h3>
                        <p>GPS Devices</p>
                        </div>
                        <div class="icon">
                         <i class="fa fa-cubes"></i>
                        </div>
                    </div>
                </div>
            </div>

                    @endif


        {{--</div>--}}
    </div>
{{--</div>--}}
@endsection
