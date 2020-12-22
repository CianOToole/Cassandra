@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Add new Moderator</h3>
                </div>

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{route('admin.moderators.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group ">
                            <label for="cover">Profile picture</label>                            
                            <div class="col-md-8">
                                <input type="file" class="form-control" id="avatar" name="avatar" value="" />
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="name">Name</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" />
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="surname">Surname</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="surname" name="surname" value="{{ old('surname') }}" />
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="email">Email</label>
                            <div class="col-md-8">
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" />
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="phone">Phone</label>
                            <div class="col-md-8">
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" 
                                placeholder="08x-xxxx-xxx" pattern="[0-9]{3}-[0-9]{4}-[0-9]{3}"/>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="address">Address</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}"/>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="emp_number">Employee Number</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="emp_number" name="emp_number" 
                                            value="{{ old('emp_number') }}" placeholder="Ex: DG9J1" pattern="[0-9-A-Z]{5}"/>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="salary">Salary</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="salary" name="salary" value="{{ old('salary') }}" placeholder="€"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class=" col-form-label ">{{ __('Password') }}</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="password-confirm" class="col-form-label ">{{ __('Confirm Password') }}</label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
    </div>
</div>
@endsection
