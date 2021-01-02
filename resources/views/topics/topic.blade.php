@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">

            <p id="alert-message" class="alert collapse"></p>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Topic</h3>
                    @auth
                        @if (Auth::user()->hasRole('admin'))               
                            <a href=" {{ route('board.topics.create', $board->id) }} " class="btn btn-primary float-right add-btn">  
                                <i class="fas fa-plus-circle"></i><span style="margin-left: 6px">Add</span>
                            </a>
                        @endif
                    @endauth
                </div>

                <div class="card-body">                    
                    @if(count($topic) === 0)
                        <p>No Such topic</p>
                    @else
                        <table id="table-visits" class="table table-hover">
                            <thead>
                                <th>Title</th>
                                @auth
                                    @if (Auth::user()->hasRole('admin'))
                                    <th style="float: right">Action</th>
                                    @endif
                                @endauth
                            </thead>

                            <tbody>

                                <a href="{{ route('forum.index') }}" class="btn btn-primary">Boards</a>
                                <a href="{{ route('board.topics.index', $board->id) }}" class="btn btn-outline-primary">Back</a>

                                <div class="" style="float: right">                                 
                                    <form class="form-inline my-2 my-lg-0" type="GET" action="{{ route('forum.topic', $board->id) }}">
                                        <input type="search" placeholder="Search topic" name="query" id="topics" value="" class="form-control mr-sm-2">
                                        <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
                                    </form>
                                </div>

                                <tr data-id=" {{ $topic[0]->id }} " data-href="{{ route( 'board.topics.index', $topic[0]->id) }}" class=""> 
                                    <td>{{ $topic[0]->title }}</td>
                                    <td>
                                        @auth
                                            @if(Auth::user()->id == $topic[0]->user_id)
                                                <a href="{{ route( 'board.topics.edit', [$board->id, $topic[0]->id] ) }}" class="btn btn-dark" title="Edit user's profile" style="float: right">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                            @endif
                                        @endauth                                                
                                        @auth
                                            @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator'))
                                                <div class="" style="float: right; margin-right: 3px">
                                                    <form style="display:inline-block" method="POST" action="{{ route( 'board.topics.destroy',[ $board->id, $topic[0]->id]) }}">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
                                                        <button type="submit" class="form-control btn btn-danger" title="Delete user's profile">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endauth
                                    </td>
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
