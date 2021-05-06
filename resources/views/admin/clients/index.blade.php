@extends('layouts.app')

@section('content')

@php
    $count = 1;   
@endphp

<p id="alert-message" class="alert collapse"></p>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="media-holder">

                {{-- TABLE HEADED --}}

                <div class="col-12 tab-header">
                    <h4>Clients Table</h4>
                </div>
                    
                {{-- TABLE BODY --}}

                <div class="col-12 bo-clients">

                    @if(count($users) === 0)
                        <p>There are no Clients yet</p>
                    @else

                    <div class="table-responsiveness">
                        <table id="" class="table table-hover table-sort">

                            <thead>
                                <th>Ban</th>
                                <th class="sort">Surname</th>
                                <th class="sort">Name</th>
                                <th class="sort">Email</th>
                                <th class="sort">Phone Number</th>
                                <th class="sort">Address</th>
                                <th class="sort">DoB</th>
                                <th class="sort">Gender</th>
                                <th>Delete</th>
                            </thead>

                            <tbody>                                    
                                @foreach ($users as $user)
                                    @php
                                        $switch_bcg;         
                                        ($count % 2 != 0) ? $switch_bcg = "blue-bck" : $switch_bcg = null;

                                        ($user->name == null & $user->middle_name == null) ? $required = "required" : $required = null;
                                        ($user->isExperienced == 1) ? $experience = "exp-user" : $experience ="no-exp";
                                    @endphp

                                    <tr data-id=" {{ $user->id }} " data-href="{{ route( 'admin.clients.show', $user->id) }}" class="{{ $switch_bcg}}">

                                        <td>
                                            @if($user->isBanned == 0)
                                                <form class="bo-ban" method="POST" action="{{ route('admin.banning', $user->id) }}">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                    <input type="hidden" name="_method" value="PUT" />
                                                    <input type="hidden" name="isBanned" value="1" />
                                                    <button class="table-banning table-ban" type="submit" title="Ban user">
                                                        <i class="fas fa-ban"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form class="bo-ban" method="POST" action="{{ route('admin.unban', $user->id) }}" >
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                    <input type="hidden" name="_method" value="PUT" />
                                                    <input type="hidden" name="isBanned" value="0" />
                                                    <button class="table-banning table-unban" type="submit"  title="Unban user">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>

                                        <td class="{{ $experience }}">{{ $user->surname }}</td>
                                        <td class="update-{{ $required }} {{ $experience }}">{{($user->name == null & $user->middle_name == null) ? "Update profile": $user->name }} </td>
                                        <td class="{{ $experience }}">{{ Str::limit($user->email, 13) }}</td>
                                        <td class="{{ $experience }}">{{ $user->phone }}</td>
                                        <td class="{{ $experience }}">{{ Str::limit($user->address, 13) }}</td>
                                        <td class="update-{{ $required }} {{ $experience }}">{{ ($user->DOB == null) ? "Update profile" : $user->DOB }}</td>

                                        <td class="update-{{ $required }} {{ $experience }}">
                                            @if ($user->gender == 'male')
                                                Male
                                                @elseif ($user->gender == 'female')
                                                Female
                                                @else 
                                                Required                                                    
                                            @endif    
                                        </td>

                                        <td>
                                            <form class="bo-del" method="POST" action="{{ route( 'admin.clients.destroy', $user->id) }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
                                                <button type="submit" class="table-delete" title="Delete Clients">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    @php
                                        $count++;   
                                    @endphp
                                @endforeach                        
                            </tbody>

                        </table>                        
                    </div>

                    @endif     
                    <div class="pagination-holder">
                        {{$users->onEachSide(4)->links()}}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection