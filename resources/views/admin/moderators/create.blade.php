@extends('layouts.app')

@section('content')

<div class="form-holder-alt">
    <div class="form-alt">
        <div class="form-alt-header">
            <h3>New Moderator</h3>
        </div>

        <div class="form-alt-body">

            <form method="POST" action="{{route('admin.moderators.store')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <h5><label for="name">Name</label></h5>
                        <input type="text" class="form-control input-alt @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" />

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <h5><h5><label for="surname">Surname</label></h5>
                        <input type="text" class="form-control input-alt @error('surname') is-invalid @enderror" id="surname" name="surname" value="{{ old('surname') }}" />

                        @error('surname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <h5><label for="address">Address</label></h5>
                    <input type="text" class="form-control input-alt @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" />

                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <h5><label for="emp_number">Employee number</label></h5>
                        <input type="text" class="form-control input-alt @error('emp_number') is-invalid @enderror" 
                        id="emp_number" name="emp_number" value="{{ old('emp_number') }}" oninput="empNumber()" />

                        @error('emp_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <h5><label for="salary">Salary</label></h5>
                        <input type="text" class="form-control input-alt @error('salary') is-invalid @enderror" id="salary" name="salary" value="{{ old('salary') }}" placeholder="€" />

                        @error('salary')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <h5><label for="email">Email</label></h5>
                    <input type="email" class="form-control input-alt @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" />

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <h5><label for="phone">Phone</label></h5>
                    <input type="tel" class="form-control input-alt @error('phone') is-invalid @enderror" 
                    id="phone" name="phone" value="{{ old('phone') }}" oninput="phoneNumber()" />

                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <h5><label for="avatar">Profile picture</label></h5>
                    <input type="file" class="form-control input-alt @error('avatar') is-invalid @enderror" id="avatar" name="avatar" value="{{ old('avatar') }}" />

                    @error('avatar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <h5><label for="password">Password</label></h5>
                        <input type="password" class="form-control input-alt @error('password') is-invalid @enderror" id="password" name="password" autocomplete="new-password"/>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <h5><label for="passwordConfirm">Confirm Password</label></h5>
                        <input type="password" class="form-control input-alt @error('passwordConfirm') is-invalid @enderror" id="passwordConfirm" name="password_confirmation">

                        @error('passwordConfirm')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="submit-btn">
                    <a href="{{ route('admin.moderators.index') }}" class="">Cancel</a>
                    <button type="submit" class="">Submit</button>
                </div>      

            </form>
            
        </div>
    </div>
</div>

<script>
    function empNumber(){
        let empNumb = document.getElementById('emp_number');
        let toUpperCase = empNumb.value.toUpperCase();
        empNumb.value = toUpperCase;
        (empNumb.value.length > 5) ? (empNumb.value = empNumb.value.slice(0, 5)) : null;
    }

    function phoneNumber(){
        let input = document.getElementById('phone');
        let phone= input.value;

        (phone.length == 3) ? (input.value = `${phone}-`) 
        : (phone.length == 8) ? (input.value = `${phone}-`) 
        : (phone.length > 11) ? (input.value = phone.slice(0, 12)) 
        : null;
    }
</script>

@endsection
