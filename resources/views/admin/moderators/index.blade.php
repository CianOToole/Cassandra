@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">

            <p id="alert-message" class="alert collapse"></p>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Moderators Table</h3>
                </div>

                <div class="card-body">
                    
                    @if(count($users) === 0)
                        <p>There are no Moderators yet</p>
                    @else
                        <table id="table-visits" class="table table-hover">
                            <thead>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Employee Number</th>
                                <th>Salary</th>
                                <th>Action</th>
                            </thead>
                                <tbody>                                    
                                    <div class="" style=" float:left">
                                        {{$users->onEachSide(3)->links()}}
                                    </div>
                                    @foreach ($users as $user)
                                        <tr data-id=" {{ $user->id }} " data-href="{{ route( 'admin.moderators.show', $user->id) }}">
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->surname }}</td>
                                            <td>{{ Str::limit($user->email, 18) }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ Str::limit($user->address, 18) }}</td>
                                            <td>{{ $user->emp_number }}</td>
                                            <td>{{ $user->salary }} €</td>
                                            <td>
                                                <form style="display:inline-block" method="POST" action="{{ route( 'admin.moderators.destroy', $user->id) }}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
                                                    <button type="submit" class="form-control btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach                        
                                </body>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
