@extends('layouts.admin-lite')
@section('title')
    Change Password
@endsection
@section('page-header')
    Change Password
@endsection
@section('optional-header')
@endsection
@section('level')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Account</a></li>
        <li class="active">Change Password</li>
    </ol>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @isset($error)
                        <div class="card-header" style="color: red; font-size: large">{{$error}}</div>
                    @endisset
                    @isset($success)
                        <div class="card-header" style="color: green; font-size: large">{{$success}}</div>
                    @endisset
                    <div class="card-body">
                        <form method="POST" action="{{ route('updatePassword') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="old_password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                                <div class="col-md-6">
                                    <input id="old_password" type="password" class="form-control @error('old-password') is-invalid @enderror" name="old_password" required autocomplete="new-password" placeholder="Enter Your current Password">

                                    @error('old_password')
                                    <span class="help-block" style="color:red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter Your new Password">

                                    @error('password')
                                    <span class="help-block" style="color:red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Re-type Your new Password">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-4 offset-md-4">
                                </div>
                                <div class="col-md-2 offset-md-4">
                                    <a class="btn btn-warning form-control" href="{{ route('home') }}">Cancel</a>
                                </div>
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
