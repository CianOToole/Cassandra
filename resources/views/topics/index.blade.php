@extends('layouts.app')

@section('content')

@php
    $count = 1;   
@endphp

<p id="alert-message" class="alert collapse"></p>

<div class="container">
    <div class="row">

        <div class="col-md-8 ">

            <div class="media-holder">

                {{-- TABLE HEADED --}}

                <div class="col-12 tab-header">
                    <h4 class="">{{$board->category}} </h4>
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

                            {{-- NEW TOPIC MODAL FORM --}}

                                <!-- Button trigger modal -->
                                <button type="button" class="form-btn" data-toggle="modal" data-target="#newTopic" style="padding-top: 5px; padding-bottom: 5px">
                                    <i class="fas fa-plus-circle"></i>
                                    <span style="margin-left: 6px">New topic</span>
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="newTopic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title" id="exampleModalLabel">New topic</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">

                                                @if($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                        
                                                <form action="{{route('board.topics.store', $board->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group-parent">
                                                        <div class="form-group">
                                                            <h5><label for="title" class="">{{ __('Title') }}</label></h5>
                                                            <div class="input-holder">
                                                                <input type="text" class="" id="title" name="title" value="{{ old('title') }}" />
                                                            </div>
                                                            @error('title')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                            
                                                    <div class="form-group-parent">
                                                        <div class="form-group ">
                                                            <h5><label for="post" class="">{{ __('Post') }}</label></h5>
                                                            <div class="input-holder">
                                                                <textarea class="" id="post" name="post" value="{{ old('post') }}"
                                                                placeholder="“Listen to many, speak to a few.” ... "> </textarea>
                                                            </div>
                                                            @error('post')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                            
                                                    <div class="submit-btn">
                                                        @if(Auth::user()->hasRole('client') && $isBanned[0]->banned)
                                                            <p id="bannedMessage">You are banned and can no longer post on the forum. See our <span style="text-decoration: underline">guideline</span>.</p>
                                                        @else
                                                        <button type="submit" class="">Submit</button>
                                                        @endif
                                                    </div>    
                            
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                {{-- END NEW TOPIC MODAL FORM --}}
  
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

                        <table id="" class="table table-hover table-sort">
                            
                            <thead>
                                @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator'))
                                    <th>Pin</th>
                                @elseif(Auth::user()->hasRole('client'))
                                    <th>Pinned</th>
                                @endif
                                <th class="sort">Title</th>
                                <th class="sort">Original poster</th>
                                <th class="sort">Replies</th>
                                <th class="sort">Last Message</th>
                                @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator'))
                                    <th>Delete</th>
                                @endif
                            </thead>

                            <tbody>
                                @foreach ($topics as $topic)

                                    @php           
                                        $switch_bcg;         
                                        ($count % 2 != 0) ? $switch_bcg = "blue-bck" : $switch_bcg = null;
                                    @endphp

                                    <tr class="{{ $switch_bcg }}" data-id=" {{ $topic->id }}" >

                                        <td>
                                            @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator'))
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
                                            @elseif(Auth::user()->hasRole('client') && $topic->isPinned == true)
                                                <p class="unpin unpin-alt" >
                                                    <i class="fas fa-thumbtack" ></i>
                                                </p>
                                            @endif
                                        </td>
                                    
                                        @if($topic->replies >= 10)
                                            <td class="trend-mark topic-tt">
                                                <a href="{{ route( 'topic.posts.index', $topic->id) }}">{{ $topic->title }}</a>
                                            </td>
                                        @else
                                            <td class=" topic-tt">
                                                <a href="{{ route( 'topic.posts.index', $topic->id) }}" style="color: #2081F9">{{ $topic->title }}</a>
                                            </td>
                                        @endif
                                        
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="op_btn" data-toggle="modal" data-target="#tableModal{{$topic->op_id}}">
                                                <p>{{$topic->op_surname}}</p>
                                            </button>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="tableModal{{$topic->op_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="label{{$topic->op_id}}">Original poster </h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-12">
                                                                @if($topic->op_avatar == "default-pp.png")
                                                                    <img src=" {{ asset('img/default.svg') }} " width="50px" height='50px' style="object-fit: fill;"" class = "rounded-circle">
                                                                @else
                                                                    <img src=" {{ asset('storage/avatar/' . $topic->op_avatar) }} " width="50px" height='50px' style="object-fit: fill;"" class = "rounded-circle">
                                                                @endif
                                                            </div>
                                                            <hr>
                                                            <div class="col-12 pm-details">
                                                                <h5>{{ $topic->op_surname }}</h5>
                                                            </div>
                                                            <div class="col-12 pm-details">
                                                                <h5>{{ $topic->op_email }}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

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
                                    @php
                                        $count++;   
                                    @endphp
                                @endforeach                        
                            </tbody>
                            
                        </table>
                        
                    </div>
                    @endif     
                    <div class="pagination-holder">
                        {{$topics->onEachSide(4)->links()}}
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
                                                    <img src=" {{ asset('img/default.svg') }} " width="50px" height='50px' style="object-fit: fill;"" class = "rounded-circle">
                                                @else
                                                    <img src=" {{ asset('storage/avatar/' . $moderator->avatar) }} " width="50px" height='50px' style="object-fit: fill;"" class = "rounded-circle">
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

            {{-- FUND SECTION --}}

            <div class="wallet">
                <div class="media-holder ">

                    <div class="col-12 tab-header fund-box">
                        <h4>Wallet</h4>
                        <h6><button type="submit" class="">Fund</button> </h6>
                    </div>

                    <div class="col-12 tab-cnt">
                        <div class="balance-header">
                            @foreach ($balances as $balance)
                            <h5>Balance</h5>
                            <h5>{{$balance->amount + $portfolioCash }}€</h5>
                        @endforeach
                        </div>
                        <div class="balance-body">
                            <div class="balance-row">
                                <p>Portfolio</p>
                                <h6>{{ $portfolioCash }}</h6>
                            </div>
                            <div class="balance-row">
                                <p>Available to trade</p>
                                <h6>€{{ $balance->amount }}</h6>
                            </div>
                            <div class="balance-row">
                                <p>Daily +/-</p>
                                <h6>{{ $gainLoss }}€</h6>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="row watchlist">
        {{-- <script src="{{ asset('js/watchlist.js') }}"></script> --}}

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
@endsection
