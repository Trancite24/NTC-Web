@extends('layouts.admin-lite')
@section('title')
Update Account
@endsection
@section('page-header')
Update Account
@endsection
@section('optional-header')
@endsection
@section('level')
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Account</a></li>
    <li class="active">Update</li>
</ol>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @isset($success)
                <div class="card-header" style="color: green; font-size: large"> {{$success}}</div>
                @endisset
                <div class="card-body">
                    <form method="POST" action="{{ route('updateAccount') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{Auth::user()->name}}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="help-block" style="color: red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('updateAccount') }}
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
