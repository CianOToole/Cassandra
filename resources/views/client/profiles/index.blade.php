@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $client[0]->name }} {{ $client[0]->middle_name }} {{ $profile->surname }}'s profile</h3>
                    </div>
        
                    <div class="card-body">
                            <table id="table-visit" class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td rowspan="6">
                                                <img src=" {{ asset('storage/avatar/' . $profile->avatar) }} " width="125px" height='125px'  
                                                style="object-fit: fill;"" class = "rounded-circle">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{ $profile->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td>{{ $profile->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td>{{ $profile->address }}, {{ $client[0]->postcode }}, {{ $client[0]->country }}</td>
                                        </tr>   
                                        <tr>
                                            <td>Gender</td>
                                            <td>{{ $client[0]->gender }}</td>
                                        </tr>   
                                        <tr>
                                            <td>Date of Birth</td>
                                            <td>{{ $client[0]->DOB }} €</td>
                                        </tr>   
                                        <tr>
                                            <td>Banned</td>
                                            <td>{{ ($client[0]->isBanned == 0) ? "no" : "yes" }}</td>
                                        </tr>
                                    </body>
                            </table>
                            
                        <div class="" style="float: right">    
                            <a href="{{ route('client.home') }} " class="btn btn-link">Back</a>
                            <a href="{{ route('client.profiles.edit', $profile->id) }} " class="btn btn-dark">
                                <i class="fas fa-pen"></i>
                            </a>
                        </div>
                    </div>
                </div>
        
            </div>
        
        
        </div>
    </div>
</div>
@endsection


