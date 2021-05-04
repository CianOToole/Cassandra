@extends('layouts.app')

@section('content')

<p id="alert-message" class="alert collapse"></p>

<div class="container">
    <div class="row">

        <div class="col-md-8 ">

            <div class="media-holder">

                {{-- TABLE HEADED --}}

                <div class="col-12 tab-header">

                    <h4 class="">{{$board->category}}</h4>

                </div>

                {{-- SEARCH BAR --}}

                <div class="col-12 table-search-bar">
                    <div class="row">

                        <div class="col-lg-7" style="padding-right: 0;">
                            <form class="search-topic" type="GET" action="{{ route('forum.topic', $board->id) }}">
                                <input type="search" placeholder="Search topic" class="topic-search-input" name="query" id="boards" value="" >
                            </form>
                        </div>

                        <div class="col-lg-5 table-header-btns" style="padding-left: 0;">
                            <h6>
                                <a href=" {{ route('board.topics.create', $board->id) }} " class="form-btn">  
                                    <i class="fas fa-plus-circle"></i><span style="margin-left: 6px">New topic</span>
                                </a>
                            </h6>    
                            <h6>
                                <a href="{{ route('forum.index', "boards") }}" class="form-btn-alt">Boards</a>
                            </h6>
                        </div>

                    </div>
                </div>

                {{-- TABLE BODY --}}

                <div class="col-12">

                    @if(count($topics) === 0)
                        <p>There are no topics yet</p>
                    @else

                    <div class="table-responsiveness">

                        <table id="table-visits" class="table table-hover">
                            
                            <thead>
                                <th></th>
                                <th>Title</th>
                                <th>Original poster</th>
                                <th>Replies</th>
                                <th>Last Message</th>
                                @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator'))
                                    <th >Action</th>
                                @endif
                            </thead>

                            <tbody>
                                @foreach ($topics as $topic)
                                    <tr data-id=" {{ $topic->id }} " data-href="{{ route( 'topic.posts.index', $topic->id) }}" class="">

                                        <td>
                                            <form method="POST" action="{{ route( 'pinning', [$board->id, $topic->id]) }}" class="pin-holder">                                                
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="PUT">

                                                @if($topic->isPinned == false  )
                                                    <input class="radio-inline" type="hidden" aria-label="" name="isPinned" value="1">
                                                    <button type="submit" class="pin" title="Pin topic" >
                                                @else
                                                    <input class="radio-inline" type="hidden" aria-label="" name="isPinned" value="0">
                                                    <button type="submit" class="unpin" title="Unpin topic">
                                                @endif                                                        
                                                    <i class="fas fa-thumbtack" ></i>
                                                </button>
                                            </form>
                                        </td>
                                    
                                        @if($topic->replies >= 10)
                                            <td class="trend-mark">{{ $topic->title }}</td>
                                        @else
                                            <td class="">{{ $topic->title }}</td>
                                        @endif
                                        
                                        <td><a href="{{ route( 'profile.index', [$topic->user_id, $board->id] ) }}">{{ $topic->surname }}</a></td>
                                        <td>{{ $topic->replies }}</td>
                                        <td>{{ substr($topic->updated_at, 11,18) }}</td>
                                        
                                        @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator'))
                                            <td>
                                                
                                                <div class="icon-cell">
                                                    @auth
                                                        <form  method="POST" action="{{ route( 'board.topics.destroy', [$board->id, $topic->id]) }}">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
                                                            
                                                            <button type="submit" class="table-delete" title="Delete Topic">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endauth
                                                </div>
                                            </td>                                        
                                        @endif

                                    </tr>
                                @endforeach                        
                            </tbody>
                            
                        </table>
                        
                    </div>
                    @endif     
                    {{-- <div>
                        {{$topics->onEachSide(4)->links()}}
                    </div> --}}
                </div>

            </div>
            
        </div>

        {{-- PROJECT MANAGMENT --}}

        <div class="col-md-4">
            <div class="media-holder">
                <div class="col-12 tab-header">
                    <h4>Forum Management</h4>
                </div>

                <div class="col-12 tab-cnt">

                    <ul class="list-moderators">
                        <li class="list-first-child">Admins:</li>
                        @foreach ($admins as $admin)
                            <li class="list-admins">
                                <a href=" {{ route('forumManagers', $admin->id) }} "> {{ $admin->surname }} </a>
                            </li>
                        @endforeach  
                    </ul>

                    <ul class="list-moderators" style="padding-top: 15px">
                        <li class="list-first-child">Moderators:</li>
                        @foreach ($moderators as $moderator)
                        <li class="list-mods">
                            <a href=" {{ route('forumManagers', $moderator->id) }} "> {{ $moderator->surname }} </a>
                        </li>
                        @endforeach  
                    </ul>

                </div>
            </div>

        </div>

    </div>
</div>
@endsection
