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
                                    @php                                 
                                            ($client[0]->name == null & $client[0]->middle_name == null) ? $required = "required" : $required = null;
                                    @endphp
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
                                        <td class="update-{{ $required }}">{{ $client[0]->address }}, 
                                            {{ ($client[0]->postcode == null) ? "Update profile" : $client[0]->postcode }}, 
                                            {{ ($client[0]->country == null) ? "Update profile" : $client[0]->country }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >Date of Birth</td>
                                        <td class="update-{{ $required }}">{{ ($client[0]->DOB == null) ? "Update profile" : $client[0]->DOB }}</td>
                                    </tr>
                                    <tr>
                                        <td >Gender</td>
                                        <td class="update-{{ $required }}">{{ ($client[0]->gender == null) ? "Update profile" : $client[0]->gender }}</td>
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
                        <a href="{{ route('admin.clients.index') }} " class="btn btn-link" title="Back to Clients table">Back</a>
                        @if($client[0]->isBanned == 0)
                            <form method="POST" action="{{ route('admin.banning', $client[0]->id) }}" style="display: inline-block">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PUT">
                                    <input class="radio-inline" type="hidden" aria-label="" name="isBanned" value="1">
                                    <button type="submit" class="btn btn-primary"  title="Ban user">
                                        <i class="fas fa-ban"></i>
                                    </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.unban', $client[0]->id) }}" style="display: inline-block">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PUT">
                                    <input class="radio-inline" type="hidden" aria-label="" name="isBanned" value="0">
                                    <button type="submit" class="btn btn-primary"  title="Unban user">
                                        <i class="fas fa-check"></i>
                                    </button>
                            </form>
                        @endif
                        <a href="{{ route('admin.clients.edit', $client[0]->id) }} " class="btn btn-dark" title="Edit user's Profile">
                            <i class="fas fa-pen"></i>
                        </a>
                        <form style="display:inline-block" method="POST" action="{{ route( 'admin.clients.destroy', $client[0]->id) }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
                            <button type="submit" class="form-control btn btn-danger" title="Delete user's Profile">
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
