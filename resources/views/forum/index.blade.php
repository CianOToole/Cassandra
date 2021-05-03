@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

<script>

    </script>
            <div class="col-md-8 ">
                <div class="media-holder">

                    <div class="col-12 media-switch">
                        <button id="boardTab">
                            <h4>Boards</h4>
                        </button>
                        <button id="newsfeedTab">
                            <h4>Newsfeed</h4>
                        </button>
                    </div>

                    <div class="col-12">

                        <div id="boards" class="board-lnk">
                            @foreach ($boards as $board)
                                <a href="{{ route( 'board.topics.index', $board->id) }}">{{ $board->category }}</a>
                            @endforeach  
                        </div>

                        <div id="news">
                            <script src="{{ asset('js/news.js') }}" type="text/javascript"></script>
                            <div id="newsfeed"></div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="media-holder">
                    <div class="col-12 tab-header">
                        <h4>Forum Management</h4>
                    </div>

                    <div class="col-12">
                        <ul class="list-moderators">
                            <li>Admins:</li>
                            @foreach ($admins as $admin)
                                <li>
                                    <a href=" {{ route('profile.indexOne', $admin->id) }} "> {{ $admin->surname }} </a>
                                </li>
                            @endforeach  
                        </ul>
                        <ul class="list-moderators">
                            <li>Moderators:</li>
                            @foreach ($moderators as $moderator)
                                <li>{{ $moderator->id }}</li>
                            @endforeach  
                        </ul>
                    </div>
                </div>

            </div>
            


    </div>
</div>
<script src="{{ asset('js/forum.js') }}" type="text/javascript"></script>
@endsection
