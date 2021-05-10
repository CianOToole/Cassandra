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
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" />

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="surname">Surname</label>
                        <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname" value="{{ old('surname') }}" />

                        @error('surname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" />

                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="emp_number">Employee number</label>
                        <input type="text" class="form-control @error('emp_number') is-invalid @enderror" 
                        id="emp_number" name="emp_number" value="{{ old('emp_number') }}" placeholder="Ex: DG9J1" pattern="[0-9-A-Z]{5}" oninput="empNumber()" />

                        @error('emp_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="salary">Salary</label>
                        <input type="text" class="form-control @error('salary') is-invalid @enderror" id="salary" name="salary" value="{{ old('salary') }}" placeholder="€" />

                        @error('salary')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" />

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                    id="phone" name="phone" value="{{ old('phone') }}" placeholder="082-3278-23x" pattern="[0-9]{3}-[0-9]{4}-[0-9]{3}" oninput="phoneNumber()" />

                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="avatar">Profile picture</label>
                    <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" value="{{ old('avatar') }}" />

                    @error('avatar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" autocomplete="new-password"/>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="passwordConfirm">Confirm Password</label>
                        <input type="password" class="form-control @error('passwordConfirm') is-invalid @enderror" id="passwordConfirm" name="password_confirmation">

                        @error('passwordConfirm')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="float-right">
                    <a href="{{ route('admin.moderators.index') }}" class="btn btn-link">Cancel</a>
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
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
        console.log("bite")
    }
</script>

@endsection
