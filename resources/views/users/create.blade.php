@extends('layouts.app')
@section('content')
    <h3 class="text-center">Create User</h3>
    <form action="{{ route('users.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="title">User Title</label>
            <input type="text" name="first_name" id="first_name" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" value="{{ old('first_name') }}" placeholder="Enter First name">
            <input type="text" name="middle_name" id="middle_name" class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : '' }}" value="{{ old('middle_name') }}" placeholder="Enter middle name">
            <input type="text" name="last_name" id="last_name" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" value="{{ old('last_name') }}" placeholder="Enter last name">
            <input type="date" name="DOB" id="DOB" class="form-control {{ $errors->has('DOB') ? 'is-invalid' : '' }}" value="{{ old('DOB') }}" placeholder="Enter DOB">
            <input type="text" name="gender" id="gender" class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" value="{{ old('gender') }}" placeholder="Enter gender">
            <input type="text" name="address" id="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" value="{{ old('address') }}" placeholder="Enter address">
            <input type="text" name="postcode" id="postcode" class="form-control {{ $errors->has('postcode') ? 'is-invalid' : '' }}" value="{{ old('postcode') }}" placeholder="Enter postcode">
            <input type="text" name="country" id="country" class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" value="{{ old('country') }}" placeholder="Enter country">
            <input type="text" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="Enter email">
            <input type="text" name="phone" id="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" value="{{ old('phone') }}" placeholder="Enter phone">
            <input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" value="{{ old('password') }}" placeholder="Enter password">
            @if($errors->has('title'))
                <span class="invalid-feedback">
                    {{ $errors->first('title') }}
                </span>
            @endif
        </div>
        
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection