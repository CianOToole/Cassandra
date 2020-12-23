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
                        <h3 class="card-title">Moderator: {{ $moderator[0]->name }} {{ $profile->surname }}</h3>
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
                                            <td>{{ $profile->address }}</td>
                                        </tr>   
                                        <tr>
                                            <td>Employee Number</td>
                                            <td>{{ $moderator[0]->emp_number }}</td>
                                        </tr>   
                                        <tr>
                                            <td>Salary</td>
                                            <td>{{ $moderator[0]->salary }} €</td>
                                        </tr>   
                                    </body>
                            </table>
                            
                        <div class="" style="float: right">    
                            <a href="{{ route('moderator.home') }} " class="btn btn-link">Back</a>
                            <a href="{{ route('moderator.profiles.edit', $profile->id) }} " class="btn btn-dark">
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


