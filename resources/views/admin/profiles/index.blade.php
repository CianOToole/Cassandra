@extends('layouts.app')

@section('content')

@php
    $count = 1;   
@endphp

<div class="container" style="margin-top: -1.5rem; margin-bottom: -1.5rem;">
    <div class="row">
        <div class="col prf-responsiveness">
            <div class="profile-holder">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="profile-head"></div>

                <div class="profile">
                    <div class="row">

                        <div class="col-md-3 profile-left">
                            <div class="col-12">
                                <figure class="profile-pic">
                                    @if($profile->avatar == "default-pp.png")
                                        <img class="post-img" src=" {{ asset('img/default.svg') }} " width="15px" height='125px' style="object-fit: fill;"" class = "rounded-circle">
                                    @else
                                        <img src=" {{ asset('storage/avatar/' . $profile->avatar) }} " width="125px" height='125px' style="object-fit: fill;"" class = "rounded-circle">
                                    @endif
                                </figure>
                            </div>
                            <div class="col-12 id-left">
                                <h4> {{ $admin[0]->name }} {{ $profile->surname }} </h4>
                            </div>
                        </div>

                        <div class="col-md-9">
                            {{-- TOP LEFT SIDE --}}
                            <div class="col-12 profile-btns">    
                                <div>
                                    <a class="prf-home" href="{{ route('admin.home') }} " title="Back home">
                                        <i class="fas fa-home"></i>
                                    </a>
                                </div>
                                <div>
                                    <a class="prf-edit" href="{{ route('admin.profiles.edit', $profile->id) }} " title="Edit my profile">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>

                            {{-- TOP RIGHT SIDE --}}
                            <div class="col-12">    
                                <div class="prf-data">
                                    <div class="personal-dt">
                                        <h6>Email:</h6> <p>{{ $profile->email }}</p>
                                    </div>
                                    <div class="personal-dt">
                                        <h6>Phone:</h6> <p>{{ $profile->phone }}</p>
                                    </div>
                                    <div class="personal-dt">
                                        <h6>Address:</h6> <p>{{ $profile->address }}</p>
                                    </div>
                                    <div class="personal-dt">
                                        <h6>Employee number: </h6> <p>{{ $admin[0]->emp_number }}</p>
                                    </div>
                                    <div class="personal-dt">
                                        <h6>Salary: </h6> <p>{{ $admin[0]->salary }}€</p>
                                    </div>
                                    <div></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- POSTS --}}

                <div class="profile-foot col-12 thread">

                    <div class="row">
                        <div class="col-12">
                            <h3 class="prf-h3">Your previous posts</h3>
                        </div>
                    </div>
                    
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
                        @endphp

                        <div class="row">

                            <div class="col-12 responsive-thread">
                                <div class="{{ $switch_bcg }} post">

                                    <div class="post-header">

                                        <figure>
                                            @if($profile->avatar == "default-pp.png")
                                                <img class="post-img" src=" {{ asset('img/default.svg') }}">
                                            @else
                                                <img class="post-img" src=" {{ asset('storage/avatar/' . $profile->avatar) }} ">
                                            @endif
                                        </figure>

                                        <div class="post-data">
                                            <div class=" ">
                                                <p>{{ $admin[0]->name }} {{ $profile->surname }}</p>
                                            </div>   
                                            <div class="post-date">
                                                <p>{{$post->updated_at}}</p>        
                                            </div>                         
                                        </div>    

                                        <div class="post-btns">
                                            <h6>
                                                <a href=" {{ route('topic.posts.index', $post->topic_id) }} " class="form-btn prf-thred-btn">  
                                                    <span>Go to topic</span>
                                                </a>
                                            </h6> 

                                            <form method="POST" action="{{ route( 'topic.posts.destroy', [$post->topic_id, $post->id]) }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value=" {{ csrf_token() }} ">                                        
                                                <button type="submit" class="table-delete" title="Delete post">
                                                    <i class="fas fa-trash" style="font-size: 24px"></i>
                                                </button>
                                            </form>
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
                    <div class="pagination-holder">
                        {{$posts->onEachSide(4)->links()}}
                    </div>
                </div>
                    
            </div>
        </div>
    </div>
</div>

@endsection


