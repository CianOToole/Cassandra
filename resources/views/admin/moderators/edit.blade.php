@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Edit {{ $moderator[0]->name }} {{ $moderator[0]->surname }}'s Profile</h3>
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
                    
                    <form method="POST" action="{{ route('admin.moderators.update', $moderator[0]->id) }}"  enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">

                        <img src="{{ asset('storage/covers/' . $moderator[0]->avatar) }}" width="150" alt="">

                        <div class="form-group">
                            <label for="cover">Profile picture</label>                            
                            <div class="">
                                <input type="file" class="form-control" id="avatar" name="avatar" value="" />
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('title', $moderator[0]->name) }}" />
                        </div>

                        <div class="form-group">
                            <label for="surname">Surname</label>
                            <input type="text" class="form-control" id="surname" name="surname" value="{{ old('title', $moderator[0]->surname) }}" />
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('title', $moderator[0]->phone) }}" 
                            placeholder="08x-xxxx-xxx" pattern="[0-9]{3}-[0-9]{4}-[0-9]{3}"/>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('title', $moderator[0]->email) }}" />
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('title', $moderator[0]->address) }}" />
                        </div>

                        <div class="form-group">
                            <label for="emp_number">Employee Number</label>
                            <input type="text" class="form-control" id="emp_number" name="emp_number" 
                                        value="{{ old('emp_number', $moderator[0]->emp_number) }}" pattern="[0-9-A-Z]{5}"/>
                        </div>

                        <div class="form-group">
                            <label for="salary">Salary</label>
                            <input type="text" class="form-control" id="salary" name="salary" 
                                        value="{{ old('title', $moderator[0]->salary) }}" placeholder="€"/>
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
