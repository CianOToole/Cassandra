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
                        <h3 class="card-title"> {{ $user[0]->surname }}'s Profile</h3>
                    </div>
        
                    <div class="card-body">
                            <table id="table-visit" class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td rowspan="6">
                                                <img src=" {{ asset('storage/avatar/' . $user[0]->avatar) }} " width="125px" height='125px'  
                                                style="object-fit: fill;"" class = "rounded-circle">
                                            </td>
                                        </tr>
                                        @if($user[0]->employee == null )
                                        <tr>
                                            <td>Client</td>
                                            <td>{{ $user[0]->client->name }} {{ $user[0]->client->middle_name }} {{ $user[0]->surname }}</td>
                                        </tr>   
                                        @endif
                                        <tr>
                                            <td>Email</td>
                                            <td>{{ $user[0]->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td>{{ $user[0]->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td>{{ $user[0]->address }}
                                                @if($user[0]->employee == null )
                                                , {{ $user[0]->client->postcode }}, {{ $user[0]->client->country }}
                                                @endif
                                            </td>
                                        </tr>   
                                        @if($user[0]->employee == null )
                                            <tr>
                                                <td>Date of Birth</td>
                                                <td>{{ $user[0]->client->DOB }}</td>
                                            </tr>   
                                            <tr>
                                                <td>Gender</td>
                                                <td>{{ $user[0]->client->gender }}</td>
                                            </tr> 
                                            <tr>
                                                <td>Gender</td>
                                                <td>{{ ($user[0]->client->isBanned == 0) ? "" : "banned from posting"}}</td>
                                            </tr> 
                                        @endif
                                    </body>
                            </table>
                            
                        <div class="" style="float: right">    
                            <a href="{{ route('board.topics.index', $board[0]->id) }}" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>
                </div>
        
            </div>
        
        
        </div>
    </div>
</div>
@endsection


