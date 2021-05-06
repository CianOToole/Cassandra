@extends('layouts.app')

@section('content')

<div class="container" style="margin-top: -1.5rem; margin-bottom: -1.5rem;">
    <div class="row">
        <div class="col">
            <div class="profile-holder">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="profile-head"></div>

                <div class="profile">
                    <div class="row">

                        <div class="col-md-3 profile-left">
                            <div class="col-12">
                                <figure class="profile-pic">
                                    <img src=" {{ asset('storage/avatar/' . $profile->avatar) }} " width="125px" height='125px' style="object-fit: fill;"" class = "rounded-circle">
                                </figure>
                            </div>
                            <div class="col-12 id-left">
                                <h4> {{ $admin[0]->name }} {{ $profile->surname }} </h4>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="col-12 profile-btns">    
                                <div>
                                    <a class="prf-home" href="{{ route('admin.home') }} " title="Back home">
                                        <i class="fas fa-home"></i>
                                    </a>
                                </div>
                                <div>
                                    <a class="prf-edit" href="{{ route('admin.profiles.edit', $profile->id) }} " title="Edit my profile">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="col-12">    
                                <div class="gg">
                                    <div class="personal-dt">
                                        <h4>Email: {{ $profile->email }}</h4>
                                    </div>
                                    <div class="personal-dt">
                                        <h4>Phone: {{ $profile->phone }}</h4>
                                    </div>
                                    <div class="personal-dt">
                                        <h4>Address: {{ $profile->address }}</h4>
                                    </div>
                                    <div class="personal-dt">
                                        <h4>Employee number: {{ $admin[0]->emp_number }}</h4>
                                    </div>
                                    <div class="personal-dt">
                                        <h4>Salary: {{ $admin[0]->salary }}</h4>
                                    </div>
                                    <div></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="profile-foot"></div>
            </div>
        </div>
    </div>
</div>

{{-- 
<td>Email</td>
<td>{{ $profile->email }}</td>

<td>Phone</td>
<td>{{ $profile->phone }}</td>

<td>Address</td>
<td>{{ $profile->address }}</td>

<td>Employee Number</td>
<td>{{ $admin[0]->emp_number }}</td>

<td>Salary</td>
<td>{{ $admin[0]->salary }} €</td>
--}}
@endsection


