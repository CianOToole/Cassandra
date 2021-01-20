@extends('layouts.app')

@section('content')
@php
    $count = 1;   
@endphp

<div class="container-fluid" style="display: inline-block">
    <div class="row">

        <div class="col-md-8 block">

            <div class="col-12 post-title">
                <div class="" style="float: left">
                    {{$posts->onEachSide(4)->links()}}
                </div>
                <h3>{{$topic_title[0]}}</h3>
                <hr>
            </div>

            <div class="col-12 post-body">

                @foreach ($posts as $post)
                    @php           
                        $switch_bcg;         
                        ($count % 2 == 0) ? $switch_bcg = "blue-bck" : $switch_bcg = null;
                        $refine_date = $post->updated_at;
                        $date = date("d/m/Y H:i:s", strtotime($refine_date));  
                        
                        $quote_id = $post->id;
                        $edit_id = $post->id;
                        $post_id = $post->id;
                    @endphp

                    <div class="row {{ $switch_bcg }}" >
                        <div class="col-12" >
                            <div class="" style="float: right">

                                <button id="{{ $quote_id }}"  onClick="quote(this.id)" class="btn btn-primary">
                                    <i class="fas fa-quote-right"></i>
                                </button>

                                @if($user = Auth::user()->id == $post->user_id)        

                                    <button id="{{$edit_id}}" onClick="editPost(this.id, this.formAction)" class="btn btn-dark btn-{{$edit_id}}" 
                                    formAction="{{ route( 'topic.posts.update', [$topic_id, $post_id ]) }}" >
                                        <i class="fas fa-pen"></i>
                                    </button>         

                                    <form style="display:inline-block" method="POST" action="{{ route( 'topic.posts.destroy', [$topic_id, $post->id]) }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value=" {{ csrf_token() }} ">                                        
                                        <button type="submit" class="form-control btn btn-danger" title="Delete post">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="row">

                                <div class="col-9" style="display: inline-flex">
                                    <figure>
                                        <img src=" {{ asset('storage/avatar/' . $post->avatar) }} " width="45px" height='45px'  
                                        style="object-fit: fill;"" class = "">
                                    </figure>
                                    <p>
                                        {{ ($post->emp_name != null) ?  $post->emp_name : $post->clt_name}}  {{$post->surname}}                                        
                                    </p>        
                                </div>

                                <div class="col-3">
                                    <p style="float: right">{{$date}}</p>
                                </div>
                                
                            </div>
                            <hr>
                        </div>

                        <div class="col-md-12">
                            <p class="{{ $post->id }}">{{$post->post}}</p>
                        </div>

                    </div>

                    @php
                        $count++;   
                    @endphp
                @endforeach
            </div>

            <div class="">
                <form id="form_post" method="POST" action="{{ route( 'topic.posts.store', [$topic_id]) }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                    <input id="form_post_put" type="hidden" name="_method" value="">
                    <div class="form-group">
                      <textarea type="text" class="form-control" id="post_txt" name="post" placeholder="Post what you have to say, nobody is here to judge you.."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Post</button>
                  </form>
            </div>

        </div>

        <div class="col-md-4"></div>
    </div>
</div>
@endsection
