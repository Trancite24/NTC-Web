@extends('layouts.mdb')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <form class="text-center border border-light p-5" method="POST" action="{{ route('login') }}">
                @csrf
                <img src="/images/ntc-logo.png" style="width:35%">
                <p class="h4 mb-4">Sign in</p>

                <!-- Email -->
                <input type="email" id="email" name="email" class="form-control mb-4" placeholder="E-mail" value="{{ old('email')}}">
                @error('email')
                    <span class="invalid-feedback" style="display: inline-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <!-- Password -->
                <input type="password" id="password" name="password" class="form-control mb-4" placeholder="Password">
                @error('password')
                    <span class="invalid-feedback" style="display: inline-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="d-flex justify-content-around">
                    <div>
                        <!-- Remember me -->
                       <!--  <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="defaultLoginFormRemember">Remember me</label>
                        </div> -->
                    </div>
                    <div>
                        <!-- Forgot password -->
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif                    </div>
                </div>

                <!-- Sign in button -->
                <button class="btn btn-primary btn-block my-4" type="submit">Sign in</button>

            </form>
        </div>
    </div>
</div>
@endsection
