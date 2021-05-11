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
                    <h4>Moderators Table</h4>
                </div>

                {{-- ADD BUTTON --}}

                <div class="col-12 table-search-bar">
                    <div class="row bo-btns">
                        <div>
                            <h6>
                                <a href=" {{ route('admin.moderators.create') }} " class="form-btn">
                                    <i class="fas fa-plus-circle"></i><span style="margin-left: 6px">Add moderator</span>
                                </a>
                            </h6>
                        </div>
                    </div>
                </div>

                {{-- TABLE BODY --}}

                <div class="col-12">

                    @if(count($users) === 0)
                        <p>There are no Moderators yet</p>
                    @else

                    <div class="table-responsiveness">
                        <table id="" class="table table-hover table-sort">
                            
                            <thead>
                                <th class="sort">Surname</th>
                                <th class="sort">Name</th>
                                <th class="sort">Email</th>
                                <th class="sort">Phone Number</th>
                                <th class="sort">Address</th>
                                <th class="sort">Employee Number</th>
                                <th class="sort">Salary</th>
                                <th>Delete</th>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                    @php           
                                        $switch_bcg;         
                                        ($count % 2 != 0) ? $switch_bcg = "blue-bck" : $switch_bcg = null;
                                    @endphp
                                    <tr data-id=" {{ $user->id }} " data-href="{{ route( 'admin.moderators.show', $user->id) }}" class="{{ $switch_bcg }}">
                                        <td>{{ $user->surname }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ Str::limit($user->email, 18) }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ Str::limit($user->address, 18) }}</td>
                                        <td>{{ $user->emp_number }}</td>
                                        <td>{{ $user->salary }} €</td>
                                        <td>
                                            <form class="bo-del" method="POST" action="{{ route( 'admin.moderators.destroy', $user->id) }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
                                                <button type="submit" class="table-delete" title="Delete Moderator">
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
