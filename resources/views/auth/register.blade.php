@extends('layouts.app')

@section('content')

<div class="form-holder form-holder-halt">
    <div class="form register">
        <div class="">
            <h1>Sign in</h1>
        </div>

        <div>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="form-group-parent">
                    <div class="form-group">
                        <h5><label for="surname" class="">{{ __('Surname') }}</label></h5>
                        <div class="input-holder">
                            <input id="surname" type="text" class="@error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" />

                            @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <h5><label for="address" class="">{{ __('Adress') }}</label></h5>
                        <div class="input-holder">
                            <input id="address" type="text" class="@error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" />

                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <h5><label for="email" class="">{{ __('Email') }}</label></h5>
                        <div class="input-holder">
                            <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <h5><label for="phone" class="">{{ __('Phone') }}</label></h5>
                        <div class="input-holder">
                            <input id="phone" type="text" class="@error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" oninput="phoneNumber()">

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <h5><label for="password" class="">{{ __('Password') }}</label></h5>

                        <div class="input-holder">
                            <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <h5><label for="password-confirm" class="">{{ __('Confirm password') }}</label></h5>

                        <div class="input-holder">
                            <input id="password-confirm" type="password" class=" @error('password-confirm') is-invalid @enderror" name="password-confirm">

                            @error('password-confirm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="login-group login-group-alt">
                        <button type="submit" class="">
                            <h6>{{ __('Submit') }}</h6>
                        </button>
                    </div>
                    
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    function phoneNumber(){
        let input = document.getElementById('phone');
        let phone= input.value;

        (phone.length == 3) ? (input.value = `${phone}-`) 
        : (phone.length == 8) ? (input.value = `${phone}-`) 
        : (phone.length > 11) ? (input.value = phone.slice(0, 12)) 
        : null;
    }
</script>

{{-- <div class="form-holder">
    <div class="form-alt">
        <div class="form-alt-header">
            <h3> Sign up </h3>
        </div>

        <div class="form-alt-body">

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <h5><label for="surname">Surname</label></h5>
                    <input id="surname" type="text" class="form-control input-alt @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}">

                    @error('surname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <h5><label for="address">Address</label></h5>
                    <input id="address" type="text" class="form-control input-alt @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}">

                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <h5><label for="email">Email</label></h5>
                    <input id="email" type="text" class="form-control input-alt @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" />

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <h5><label for="phone">Phone</label></h5>
                    <input id="phone" type="text" class="form-control input-alt @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" oninput="phoneNumber()">

                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <h5><label for="password">Password</label></h5>
                        <input type="password" class="form-control input-alt @error('password') is-invalid @enderror" id="password" name="password" />

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group col-md-6">
                        <h5><label for="password-confirm">Confirm Password</label></h5>
                        <input type="password" class="form-control input-alt @error('password-confirm') is-invalid @enderror" id="password-confirm" name="password_confirmation">

                        @error('password-confirm')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                </div>

                <div class="submit-btn">
                    <button type="submit">{{ __('Register') }}</button>
                </div>      

            </form>
            
        </div>
    </div>
</div>

<script>
    function phoneNumber(){
        let input = document.getElementById('phone');
        let phone= input.value;

        (phone.length == 3) ? (input.value = `${phone}-`) 
        : (phone.length == 8) ? (input.value = `${phone}-`) 
        : (phone.length > 11) ? (input.value = phone.slice(0, 12)) 
        : null;
    }
</script> --}}

@endsection
