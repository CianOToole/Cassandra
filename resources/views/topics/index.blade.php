@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">

            <p id="alert-message" class="alert collapse"></p>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{$board->category}}</h3>
                        <a href=" {{ route('board.topics.create', $board->id) }} " class="btn btn-primary float-right add-btn">  
                            <i class="fas fa-plus-circle"></i><span style="margin-left: 6px">Add</span>
                        </a>
                </div>

                <div class="card-body">
                    
                    @if(count($topics) === 0)
                        <p>There are no topics yet</p>
                    @else
                        <table id="table-visits" class="table table-hover">

                            <div class="" style="float: left">
                                {{$topics->onEachSide(4)->links()}}
                            </div>
                            
                            <a href="{{ route('forum.index') }}" class="btn btn-primary">Boards</a>

                            <div class="" style="float: right">                                 
                                <form class="form-inline my-2 my-lg-0" type="GET" action="{{ route('forum.topic', $board->id) }}">
                                    <input type="search" placeholder="Search Board" name="query" id="boards" value="" class="form-control mr-sm-2">
                                    <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
                                </form>
                            </div>

                            <thead>
                                <th>Title</th>
                                <th>Original poster</th>
                                <th>Number of Replies</th>
                                <th>Last Message</th>
                                    <th style="float: right">Action</th>
                            </thead>

                            <tbody>
                                

                                @foreach ($topics as $topic)
                                    {{-- <tr data-id=" {{ $board->id }} " data-href="{{ route( 'board.topics.index', $board->id) }}" class=""> --}}
                                    <tr data-id=" {{ $topic->id }} " data-href="#" class="">
                                        <td>{{ $topic->title }}</td>
                                        <td><a href="{{ route( 'profile.index', [$topic->user_id, $board->id] ) }}">{{ $topic->surname }}</a></td>
                                        <td>
                             
                                        </td>
                                        <td>{{ substr($topic->updated_at, 11,18) }}</td>
                                        <td>
                                            @auth
                                                @if(Auth::user()->id == $topic->user_id)
                                                    <a href="{{ route( 'board.topics.edit', [$board->id, $topic->id]) }}" class="btn btn-dark" title="Edit topic" style="float: right">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                @endif
                                            @endauth
                                            @auth
                                                @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator'))
                                                    <div class="" style="float: right; margin-right: 3px">
                                                        <form style="display:inline-block" method="POST" action="{{ route( 'board.topics.destroy', [$board->id, $topic->id]) }}">
                                                            <form style="display:inline-block" method="POST" action="#">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
                                                            <button type="submit" class="form-control btn btn-danger" title="Delete Topic">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endauth
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
