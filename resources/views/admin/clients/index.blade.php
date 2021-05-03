@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">

            <p id="alert-message" class="alert collapse"></p>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Clients Table</h3>
                </div>

                <div class="card-body">
                    
                    @if(count($users) === 0)
                        <p>There are no clients yet</p>
                    @else
                        <table id="table-visits" class="table table-hover">
                            <thead>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>DoB</th>
                                <th>Gender</th>
                                <th>Exp.</th>
                                <th>(Un)Ban</th>
                                <th>Action</th>
                            </thead>
                                <tbody>                                    
                                    <div class="" style=" float:left">
                                        {{ $users->onEachSide(3)->links() }}
                                    </div>
                                    @foreach ($users as $user)
                                        @php
                                            ($user->isBanned == 1) ? $banning = "banned" : $banning = null;                                            
                                            ($user->name == null & $user->middle_name == null) ? $required = "required" : $required = null;
                                        @endphp
                                        <tr data-id=" {{ $user->id }} " data-href="{{ route( 'admin.clients.show', $user->id) }}" class="status-{{$banning}}">
                                            <td class="update-{{ $required }}">{{($user->name == null & $user->middle_name == null) ? "Update profile": $user->name }} </td>
                                            <td>{{ $user->surname }}</td>
                                            <td>{{ Str::limit($user->email, 13) }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ Str::limit($user->address, 13) }}</td>
                                            <td class="update-{{ $required }}">{{ ($user->DOB == null) ? "Update profile" : $user->DOB }}</td>
                                            <td class="update-{{ $required }}">
                                                @if ($user->gender == 'male')
                                                    male
                                                    @elseif ($user->gender == 'female')
                                                    female
                                                    @else 
                                                    update profile                                                    
                                                @endif    
                                            </td>
                                            <td>{{ ($user->isExperienced == 0) ? "no" : "yes" }}</td>
                                            <td>
                                                @if($user->isBanned == 0)
                                                    <form method="POST" action="{{ route('admin.banning', $user->id) }}">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="_method" value="PUT">
                                                            <input class="radio-inline" type="hidden" aria-label="" name="isBanned" value="1">
                                                            <button type="submit" class="btn btn-primary"  title="Ban user">
                                                                <i class="fas fa-ban"></i>
                                                            </button>
                                                    </form>
                                                @else
                                                    <form method="POST" action="{{ route('admin.unban', $user->id) }}" >
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="_method" value="PUT">
                                                            <input class="radio-inline" type="hidden" aria-label="" name="isBanned" value="0">
                                                            <button type="submit" class="btn btn-primary"  title="Unban user">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                                <form style="display:inline-block" method="POST" action="{{ route( 'admin.clients.destroy', $user->id) }}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
                                                    <button type="submit" class="form-control btn btn-danger" title="Delete user's profile">
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
