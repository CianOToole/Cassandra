@extends('layouts.app')

@section('content')

<div class="form-holder">
    <div class="form">
        <div class="">
            <h1>Log in</h1>
        </div>

        <div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="form-group-parent">
                    <div class="form-group">
                        <h5><label for="email" class="">
                            <i class="far fa-envelope" style="padding-right: 8px"></i>
                            {{ __('Email') }}
                        </label></h5>

                        <div class="input-holder">
                            <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <h5><label for="password" class="">
                            <i class="fas fa-lock" style="padding-right: 12px"></i>
                            {{ __('Password') }}
                        </label></h5>

                        <div class="input-holder">
                            <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="login-group">
                        <button type="submit" class="">
                            <h6>{{ __('Login') }}</h6>
                        </button>
                    </div>
                    
                </div>
            </form>

        </div>
    </div>
</div>

@endsection
