@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">

            <p id="alert-message" class="alert collapse"></p>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Boards</h3>
                    @auth
                        @if (Auth::user()->hasRole('admin'))
                            {{-- <a href=" {{ route('admin.clients.create') }} " class="btn btn-primary float-right add-btn"> --}}                    
                            <a href=" # " class="btn btn-primary float-right add-btn">
                                <i class="fas fa-plus-circle"></i><span style="margin-left: 6px">Add</span>
                            </a>
                        @endif
                    @endauth
                </div>

                <div class="card-body">                    
                    @if(count($board) === 0)
                        <p>No Such board</p>
                    @else
                        <table id="table-visits" class="table table-hover">
                            <thead>
                                <th>Category</th>
                                @auth
                                    @if (Auth::user()->hasRole('admin'))
                                    <th style="float: right">Action</th>
                                    @endif
                                @endauth
                            </thead>
                            <tbody>

                                <div class="" style="float: right">                                 
                                    <form class="form-inline my-2 my-lg-0" type="GET" action="{{ route('forum.board') }}">
                                        <select name="query"  id="boards">
                                            @foreach ($categories as $category)
                                                <option value="{{$category}}">{{$category}}</option>                                                    
                                            @endforeach
                                            </select>
                                        <button class="btn btn-primary" type="submit">Search</button>
                                    </form>
                                </div>

                                <tr data-id=" {{ $board[0]->id }} " data-href="#" class=""> 
                                    <td>{{ $board[0]->category }}</td>
                                    @auth
                                        @if (Auth::user()->hasRole('admin'))
                                            <td>
                                                {{-- <a href="{{ route( 'admin.clients.edit', $user->id) }}" class="btn btn-dark" title="Edit user's profile"> --}}
                                                    <a href="#" class="btn btn-dark" title="Edit user's profile" style="float: right">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                                {{-- <form style="display:inline-block" method="POST" action="{{ route( 'admin.clients.destroy', $user->id) }}"> --}}
                                                <div class="" style="float: right; margin-right: 3px">
                                                    <form style="display:inline-block" method="POST" action="#">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
                                                        <button type="submit" class="form-control btn btn-danger" title="Delete user's profile">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endif
                                    @endauth
                                </tr>
                            </body>
                        </table>
                    @endif                    
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
