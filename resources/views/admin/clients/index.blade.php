@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">

            <p id="alert-message" class="alert collapse"></p>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Clients Table</h3>
                <a href=" {{ route('admin.clients.create') }} " class="btn btn-primary float-right add-btn">
                    <i class="fas fa-plus-circle"></i><span style="margin-left: 6px">Add</span>
                </a>
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
                                <th>Ban.</th>
                                <th>Action</th>
                            </thead>
                                <tbody>                                    
                                    <div class="" style=" float:left">
                                        {{ $users->onEachSide(3)->links() }}
                                    </div>
                                    @foreach ($users as $user)
                                        @php
                                            if($user->isBanned == 1){
                                                $banning = "banned";
                                            }else{
                                                $banning = null;
                                            }
                                        @endphp
                                        <tr data-id=" {{ $user->id }} " data-href="{{ route( 'admin.clients.show', $user->id) }}" class="status-{{$banning}}">
                                            <td>{{ $user->name }}. {{ substr($user->middle_name, 0, 1) }}</td>
                                            <td>{{ $user->surname }}</td>
                                            <td>{{ Str::limit($user->email, 15) }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ Str::limit($user->address, 15) }}</td>
                                            <td>{{ $user->DOB }}</td>
                                            <td>{{ ($user->gender == 'male') ? 'M' : 'F' }}</td>
                                            <td>{{ ($user->isExperienced == 0) ? "no" : "yes" }}</td>
                                            <td>{{ ($user->isBanned == 0) ? "no" : "yes" }}</td>
                                            <td>
                                                <a href="{{ route( 'admin.clients.edit', $user->id) }}" class="btn btn-dark">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                <form style="display:inline-block" method="POST" action="{{ route( 'admin.clients.destroy', $user->id) }}">
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
