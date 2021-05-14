@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

            <div class="col-md-8 ">
                <div class="media-holder">

                    <div class="col-12 media-switch">
                        <button id="boardTab" class="border-tab-btn">
                            <h4>Boards</h4>
                        </button>
                        <button id="newsfeedTab" class="border-tab-btn">
                            <h4>Newsfeed</h4>
                        </button>
                    </div>

                    <div class="col-12 news-holder">

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

                                <button type="button" class="list-admins" data-toggle="modal" data-target="#exampleModal{{$admin->id}}">
                                    {{ $admin->surname }} 
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$admin->id}}" tabindex="-1" role="dialog" aria-labelledby="labe{{$admin->id}}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="labe{{$admin->id}}">Admin </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-12">
                                                    @if($admin->avatar == "default-pp.png")
                                                        <img src=" {{ asset('img/default.svg') }} " width="50px" height='50px' style="object-fit: fill;"" class = "rounded-circle">
                                                    @else
                                                        <img src=" {{ asset('storage/avatar/' . $admin->avatar) }} " width="50px" height='50px' style="object-fit: fill;"" class = "rounded-circle">
                                                    @endif
                                                </div>
                                                <hr>
                                                <div class="col-12 pm-details">
                                                    <h5>{{ $admin->surname }}</h5>
                                                </div>
                                                <div class="col-12 pm-details">
                                                    <h5>{{ $admin->email }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach  
                        </ul>

                        <ul class="list-moderators">
                            <li class="list-first-child">Moderators:</li>
                            @foreach ($moderators as $moderator)

                                <button type="button" class="list-mods" data-toggle="modal" data-target="#exampleModal{{$moderator->id}}">
                                    {{ $moderator->surname }} 
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$moderator->id}}" tabindex="-1" role="dialog" aria-labelledby="labe{{$admin->id}}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="labe{{$moderator->id}}">Moderator </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-12">
                                                    @if($moderator->avatar == "default-pp.png")
                                                        <img src=" {{ asset('img/default.svg') }} " width="50px" height='50px' style="object-fit: fill;" class = "rounded-circle">
                                                    @else
                                                        <img src=" {{ asset('storage/avatar/' . $moderator->avatar) }} " width="50px" height='50px' style="object-fit: fill;" class = "rounded-circle">
                                                    @endif
                                                </div>
                                                <hr>
                                                <div class="col-12 pm-details">
                                                    <h5>{{ $moderator->surname }}</h5>
                                                </div>
                                                <div class="col-12 pm-details">
                                                    <h5>{{ $moderator->email }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach  
                        </ul>
                    </div>

                </div>
            </div>
            
    </div>

    {{-- WATCHLIST --}}

    <div class="row watchlist">
        <script src="{{ asset('js/watchlist.js') }}"></script>

        <div class="col-md-8 ">
            <div class="media-holder ">

                <div class="col-12 tab-header">
                    <h4>Watchlist</h4>
                </div>

                <div class="col-12 tab-cnt">

                    <div class="table-responsiveness">
                        <table id="" class="watchlist-tbl table-hover table-sort">    
                            <thead>
                                <th class="sort">Company</th>
                                <th class="sort">Exchange</th>
                                <th class="sort">Price</th>
                                <th class="sort">Open</th>
                                <th class="sort">Volume</th>
                            </thead>

                            <tbody id="watchlistBody"></tbody>    

                        </table>                        
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>
<script src="{{ asset('js/forum.js') }}" type="text/javascript"></script>
@endsection
