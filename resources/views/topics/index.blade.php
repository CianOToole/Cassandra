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

                    <div class="" style="float: left">
                        {{$topics->onEachSide(4)->links()}}
                    </div>
                    
                    <a href="{{ route('forum.index') }}" class="btn btn-primary">Boards</a>

                    <div class="" style="float: right">                                 
                        <form class="form-inline my-2 my-lg-0" type="GET" action="{{ route('forum.topic', $board->id) }}">
                            <input type="search" placeholder="Search Topic" name="query" id="boards" value="" class="form-control mr-sm-2">
                            <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>
                    
                    @if(count($topics) === 0)
                        <p>There are no topics yet</p>
                    @else
                        <table id="table-visits" class="table table-hover">
                            <thead>
                                <th></th>
                                <th>Title</th>
                                <th>Original poster</th>
                                <th>Number of Replies</th>
                                <th>Last Message</th>
                                @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator'))
                                    <th style="float: right">Action</th>
                                @endif
                            </thead>

                            <tbody>
                                @foreach ($topics as $topic)
                                    <tr data-id=" {{ $topic->id }} " data-href="{{ route( 'topic.posts.index', $topic->id) }}" class="">
                                        <td>
                                            @if($topic->isPinned == true)
                                                <i class="fas fa-check-circle" style="color: rgb(224, 34, 34)"></i>
                                            @endif
                                            @if($topic->replies >= 10)
                                                <i class="fas fa-fire" style="color: rgb(224, 34, 34)"></i>
                                            @endif
                                        </td>
                                        <td>{{ $topic->title }}</td>
                                        <td><a href="{{ route( 'profile.index', [$topic->user_id, $board->id] ) }}">{{ $topic->surname }}</a></td>
                                        <td>{{ $topic->replies }}</td>
                                        <td>{{ substr($topic->updated_at, 11,18) }}</td>
                                        
                                        @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator'))
                                            <td>
                                                @auth
                                                    @if(Auth::user()->id == $topic->user_id)
                                                        <a href="{{ route( 'board.topics.edit', [$board->id, $topic->id]) }}" class="btn btn-dark" title="Edit topic" style="float: right">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                    @endif
                                                @endauth

                                                @auth
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
                                                @endauth

                                                @if($topic->isPinned == false  )
                                                    <form method="POST" action="{{ route( 'pinning', [$board->id, $topic->id]) }}" style="float: right">                                                
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <input class="radio-inline" type="hidden" aria-label="" name="isPinned" value="1">
                                                        <button type="submit" class="btn btn-outline-secondary" title="Pin topic" >
                                                            <i class="fas fa-thumbtack" ></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form method="POST" action="{{ route( 'pinning', [$board->id, $topic->id]) }}" style="float: right">     
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <input class="radio-inline" type="hidden" aria-label="" name="isPinned" value="0">
                                                        <button type="submit" class="btn btn-secondary" title="Unpin topic">
                                                            <i class="fas fa-thumbtack" ></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>                                        
                                        @endif
                                    </tr>
                                @endforeach                        
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
