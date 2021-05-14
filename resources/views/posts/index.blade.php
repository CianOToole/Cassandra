@extends('layouts.app')

@section('content')

@php
    $count = 1;   
@endphp

<div class="container">
    <div class="row">

        <div class="col-md-8">

            <div class="media-holder">

                {{-- TABLE HEAD --}}

                <div class="col-12 tab-header">
                    <h4>{{ $topic[0]->title }} </h4>
                </div>

                {{-- BUTTON --}}

                <div class="col-12 table-search-bar">
                        <div class="table-header-btns post-hdr-btn" >
                            <h6>
                                <a href="{{ route('board.topics.index', $topic[0]->board_id) }}" class="form-btn">Back to topic</a>
                            </h6>    
                            <h6>
                                <a href="{{ route('forum.index', "boards") }}" class="form-btn-alt">Boards</a>
                            </h6>
                        </div>
                </div>

                {{-- POSTS --}}

                <div class="col-12 thread">

                    @foreach ($posts as $post)

                        @php           
                            $switch_bcg;         
                            ($count % 2 != 0) ? $switch_bcg = "blue-bck" : $switch_bcg = null;
                            // 
                            $refine_date = $post->updated_at;
                            $date = date("d/m/Y H:i:s", strtotime($refine_date));  
                            // 
                            $quote_id = $post->id;
                            $edit_id = $post->id;
                            $post_id = $post->id;

                            if($post->experience == true){
                                $border = "experienced";
                            }else if($post->role == 1){
                                $border = "admin";
                            }else if($post->role == 2){
                                $border = "moderator";
                            }else{
                                $border = null;
                            }
                        @endphp

                        <div class="row">

                            <div class="col-12 responsive-thread">
                                <div class="{{ $switch_bcg }} post">

                                    <div class="post-header">

                                        <figure>
                                            @if($post->avatar == "default-pp.png")
                                                <img class="post-img {{ $border }}-border" src=" {{ asset('img/default.svg') }}">
                                            @else
                                                <img class="post-img {{ $border }}-border" src=" {{ asset('storage/avatar/' . $post->avatar) }}">
                                            @endif
                                        </figure>

                                        <div class="post-data">
                                            <div class=" ">
                                                <p>{{ ($post->emp_name != null) ?  $post->emp_name : $post->clt_name}}  {{$post->surname}}</p>
                                            </div>   
                                            <div class="post-date">
                                                <p>{{$date}}</p>        
                                            </div>                         
                                        </div>    

                                        <div class="post-btns">
                                            <div class="quote-btn">
                                                <button id="{{ $quote_id }}"  onClick="quote(this.id)" class="" title="Quote post">
                                                    <i class="fas fa-quote-right"></i>
                                                </button>
                                            </div>

                                            @if($user = Auth::user()->id == $post->user_id)        

                                                <div class="edit-btn">
                                                    <button id="{{$edit_id}}" onClick="editPost(this.id, this.formAction)" class="" 
                                                    formAction="{{ route( 'topic.posts.update', [$topic_id, $post_id ]) }}" >
                                                        <i class="fas fa-pen"></i>
                                                    </button>         
                                                </div>

                                                <form method="POST" action="{{ route( 'topic.posts.destroy', [$topic_id, $post->id]) }}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value=" {{ csrf_token() }} ">                                        
                                                    <button type="submit" class="table-delete" title="Delete post">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                                
                                            @endif
                                        </div>

                                    </div>

                                    <div class="post-cnt">
                                        <p class="{{ $post->id }}">{{$post->post}}</p>
                                    </div>
                                    
                                </div>
                            </div>

                        </div>

                        @php
                            $count++;   
                        @endphp

                    @endforeach
                </div>

                <div class="col-12 text-post-cnt">
                    <form id="form_post" method="POST" action="{{ route( 'topic.posts.store', [$topic_id]) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                        <input id="form_post_put" type="hidden" name="_method" value="">
                        <div class="form-group">
                            <textarea type="text" class="txt-post" id="post_txt" name="post" placeholder="Listen to many, speak to a few."></textarea>
                        </div>
                        <h6 class="post-btn">
                            <div class="submit-btn">
                                @if(Auth::user()->hasRole('client') && $isBanned[0]->banned)
                                <p id="bannedMessage">You are banned and can no longer post on the forum. See our <span style="text-decoration: underline">guideline</span>.</p>
                                @else
                                <button type="submit" class="form-btn-alt">Post</button>
                                @endif
                            </div>    
                        </h6>
                    </form>
                </div>

                <div class="pagination-holder">
                    {{$posts->onEachSide(4)->links()}}
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

    {{--  quote passes the id on the clicked button (determined by the post id) --}}
    {{-- each post share in their class the id nmb which we fetch to get the textContent of the p element --}}
    {{-- then, we fetch the text area to prompt the textContent in it to quote --}}
    <script type="text/javascript">
        function quote(id){
            var posts_cnt = document.getElementsByClassName(id);
            var text = posts_cnt[0].textContent;        
            console.log(text);
            var post_txt = document.getElementById('post_txt');
            post_txt.innerHTML += text;
        }

        function editPost(id, action){
            var posts_cnt = document.getElementsByClassName(id);
            var text = posts_cnt[0].textContent;      
            var post_txt = document.getElementById('post_txt');
            post_txt.innerHTML += text;

            $("#form_post_put").attr("value", "PUT");
            
            console.log(action);
            
            $("#form_post").attr("action", action);

            }
    </script>

    </div>

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
@endsection
