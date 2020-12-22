@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $moderator[0]->name }} {{ $moderator[0]->surname }}'s Profile</h3>
                </div>

                <div class="card-body">
                        <table id="table-visit" class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td rowspan="6">
                                            <img src=" {{ asset('storage/avatar/' . $moderator[0]->avatar) }} " width='150px' height="150px" 
                                            style="object-fit: fill;""  class = "rounded-circle">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>id</td>
                                        <td>{{ $moderator[0]->id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $moderator[0]->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>{{ $moderator[0]->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>{{ $moderator[0]->address }}</td>
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
                        <a href="{{ route('admin.moderators.index') }} " class="btn btn-link">Back</a>
                        <a href="{{ route('admin.moderators.edit', $moderator[0]->id) }} " class="btn btn-dark">
                            <i class="fas fa-pen"></i>
                        </a>
                        <form style="display:inline-block" method="POST" action="{{ route( 'admin.moderators.destroy', $moderator[0]->id) }}">
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
