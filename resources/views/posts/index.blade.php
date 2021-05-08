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
                            <button type="submit" class="form-btn-alt">Post</button>
                        </h6>
                    </form>
                </div>

                <div class="pagination-holder">
                    {{$posts->onEachSide(4)->links()}}
                </div>
            </div>

        </div>

        {{-- FORUM MANAGMENT --}}

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
@endsection
