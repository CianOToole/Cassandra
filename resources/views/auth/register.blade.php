@extends('layouts.app')

@section('content')

<div class="form-holder">
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
</script>


{{-- 

                        




                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" 
                                required autocomplete="new-password">
                            </div>
                        </div>


 --}}
@endsection
