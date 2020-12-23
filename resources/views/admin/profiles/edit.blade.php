@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title"> Edit {{ $admin[0]->name }} {{ $admin[0]->surname }}'s Profile </h3>
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
                    
                    <form method="POST" action="{{ route('admin.profiles.update', $admin[0]->id) }}"  enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group">
                            <label for="avatar">Profile picture</label>                            
                            <div class="">
                                <input type="file" class="form-control" id="avatar" name="avatar" value="" />
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="name" class="">{{ __('Name') }}</label>

                            <div class="">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" 
                                value="{{ old('name', $admin[0]->name) }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="">
                                <label for="surname" class="">{{ __('Surname') }}</label>
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" 
                                value="{{ old('surname', $admin[0]->surname) }}" required autocomplete="surname" autofocus>

                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="">{{ __('E-Mail Address') }}</label>

                            <div class="">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" 
                                value="{{ old('email', $admin[0]->email) }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="phone" class="">{{ __('Phone') }}</label>

                            <div class="">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" 
                                value="{{ old('phone', $admin[0]->phone) }}" required autocomplete="phone" placeholder="08x-xxxx-xxx" 
                                pattern="[0-9]{3}-[0-9]{4}-[0-9]{3}"
                                autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>  

                        <div class="form-group">
                            <label for="address" class="">{{ __('Address') }}</label>

                            <div class="">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" 
                                value="{{ old('address', $admin[0]->address) }}"" required autocomplete="address" autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="emp_number" class="">{{ __('Employee Number') }}</label>

                            <div class="">
                                <input id="emp_number" type="text" class="form-control @error('address') is-invalid @enderror" name="emp_number" 
                                value="{{ old('emp_number', $admin[0]->emp_number) }}"" required 
                                pattern="[0-9-A-Z]{5}" autocomplete="emp_number" autofocus>

                                @error('emp_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="salary" class="">{{ __('Salary') }}</label>

                            <div class="">
                                <input id="salary" type="text" class="form-control @error('salary') is-invalid @enderror" name="salary" 
                                value="{{ old('salary', $admin[0]->salary) }} " required autocomplete="salary" autofocus>

                                @error('salary')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="float-right">
                            <a href="{{ route('admin.profiles.index') }}" class="btn btn-link">Cancel</a>
                            <button type="submit" class="btn btn-primary pull-right">Submit</button>
                        </div>      

                    </form>

                </div>  
            </div>
        </div>
    </div>
</div>
@endsection
