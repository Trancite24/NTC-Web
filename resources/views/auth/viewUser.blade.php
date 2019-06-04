@extends('layouts.admin-lite')
@section('title')
    View Users
@endsection
@section('page-header')
    View Users
@endsection
@section('optional-header')
@endsection
@section('level')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">View User</li>
    </ol>
@endsection
@section('content')
    <div class="container">
        @isset($suspended_user)
            <div class="card-header" style="color: yellow; font-size: large">Successfully Suspend {{$suspended->email }}</div>
        @endisset
        @isset($activated_user)
            <div class="card-header" style="color: green; font-size: large">Successfully Activated {{$activated_user->email }}</div>
        @endisset
        @isset($failed_user)
            <div class="card-header" style="color: red; font-size: large">Failed No permission to suspend/activate {{$failed_user->email }}</div>
        @endisset
        <div class="row justify-content-center">
            @foreach($active_users as $active_user)
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h4>{{$active_user->name}}</h4>

                            <p>{{$active_user->type}}</p>
                            <p>{{$active_user->email}}</p>

                        </div>
                        <div class="icon">
                            <img src="{{$active_user->getFirstMediaUrl('profile_pictures', 'thumb') }}" class="user-image" >
                        </div>
                        <a href="/admin/users/suspend/{{$active_user->id}}" class="small-box-footer">block User <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                @endforeach
        </div>
        <div class="row justify-content-center">
            @foreach($inactive_users as $inactive_user)
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h4>{{$inactive_user->name}}</h4>

                            <p>{{$inactive_user->type}}</p>
                            <p>{{$inactive_user->email}}</p>
                        </div>
                        <div class="icon">
                            <img src="{{$inactive_user->getFirstMediaUrl('profile_pictures', 'thumb') }}" class="user-image">
                        </div>
                        <a href="/admin/users/activate/{{$inactive_user->id}}" class="small-box-footer">Activate User <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
