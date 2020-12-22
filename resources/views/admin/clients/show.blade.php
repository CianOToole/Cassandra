@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $client[0]->name }} {{ $client[0]->middle_name }} {{ $client[0]->surname }}'s Profile</h3>
                </div>

                <div class="card-body">
                        <table id="table-visit" class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td rowspan="6">
                                            <img src=" {{ asset('storage/avatar/' . $client[0]->avatar) }} " width='150px' height="150px" 
                                            style="object-fit: fill;""  class = "rounded-circle">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $client[0]->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>{{ $client[0]->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>{{ $client[0]->address }}, {{ $client[0]->postcode }}, {{ $client[0]->country }}</td>
                                    </tr>
                                    <tr>
                                        <td>Date of Birth</td>
                                        <td>{{ $client[0]->DOB }}</td>
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td>{{ $client[0]->gender }}</td>
                                    </tr>
                                    <tr>
                                        <td>Experienced</td>
                                        <td>{{ ($client[0]->isExperienced == 0) ? "no" : "yes" }}</td>
                                    </tr>
                                    <tr>
                                        <td>Banned</td>
                                        <td>{{ ($client[0]->isBanned == 0) ? "no" : "yes" }}</td>
                                    </tr>
                                         
                                </body>
                        </table>
                        
                    <div class="" style="float: right">
                        <a href="{{ route('admin.clients.index') }} " class="btn btn-link">Back</a>
                        <a href="{{ route('admin.clients.edit', $client[0]->id) }} " class="btn btn-dark">
                            <i class="fas fa-pen"></i>
                        </a>
                        <form style="display:inline-block" method="POST" action="{{ route( 'admin.clients.destroy', $client[0]->id) }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
                            <button type="submit" class="form-control btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
