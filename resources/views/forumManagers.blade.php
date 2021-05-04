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
                                        
                                        <tr>
                                            <td>Email</td>
                                            <td>{{ $user[0]->email }}</td>
                                        </tr>


                                    </body>
                            </table>
                            

                    </div>
                </div>
        
            </div>
        
        
        </div>
    </div>
</div>
@endsection


