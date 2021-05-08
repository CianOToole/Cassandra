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
                                    @if($client[0]->avatar == "default-pp.png")
                                        <img src=" {{ asset('img/default.svg') }} " width="125px" height='125px' style="object-fit: fill;"" class = "rounded-circle">
                                    @else
                                        <img src=" {{ asset('storage/avatar/' . $client[0]->avatar) }} " width="125px" height='125px' style="object-fit: fill;"" class = "rounded-circle">
                                    @endif
                                </figure>
                            </div>
                            <div class="col-12 id-left">
                                <h4> {{ $client[0]->name }} {{ $client[0]->mn }} {{ $client[0]->surname }} </h4>
                            </div>
                        </div>

                        <div class="col-md-9">
                            {{-- TOP LEFT SIDE --}}
                            <div class="col-12 profile-btns-alt">    

                                @if($client[0]->isBanned == 0)
                                    <form class="bo-ban" method="POST" action="{{ route('admin.banning', $client[0]->id) }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="hidden" name="_method" value="PUT" />
                                        <input type="hidden" name="isBanned" value="1" />
                                        <button class="table-banning-alt table-ban" type="submit" title="Ban user">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </form>
                                @else
                                    <form class="bo-ban" method="POST" action="{{ route('admin.unban', $client[0]->id) }}" >
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="hidden" name="_method" value="PUT" />
                                        <input type="hidden" name="isBanned" value="0" />
                                        <button class="table-banning-alt table-unban" type="submit"  title="Unban user">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                @endif

                                <form class="bo-del" method="POST" action="{{ route( 'admin.clients.destroy', $client[0]->id) }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
                                    <button type="submit" class="table-delete-alt" title="Delete Clients">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                                <h6>
                                    <a href="{{ route('admin.clients.index') }} " class="form-btn-alt" title="Back to Clients table">Back to table</a>
                                </h6>

                            </div>

                            {{-- TOP RIGHT SIDE --}}
                            <div class="col-12">    
                                <div class="prf-data">
                                    <div class="personal-dt">
                                        <h6>Email:</h6> <p>{{ $client[0]->email }}</p>
                                    </div>
                                    <div class="personal-dt">
                                        <h6>Phone:</h6> <p>{{ $client[0]->phone }}</p>
                                    </div>
                                    <div class="personal-dt">
                                        <h6>Gender: </h6> <p>{{ $client[0]->gender }}</p>
                                    </div>
                                    <div class="personal-dt">
                                        <h6>Date of Birth: </h6> <p>{{ $client[0]->dob }}</p>
                                    </div>
                                    <div class="personal-dt">
                                        <h6>Address:</h6> <p>{{ $client[0]->address }}</p>
                                    </div>
                                    <div class="personal-dt">
                                        <h6>Additional address:</h6> <p>{{ $client[0]->postcode }}, {{ $client[0]->country }}</p>
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
                            <h3 class="prf-h3">User posts</h3>
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
                                            @if($client[0]->avatar == "default-pp.png")
                                                <img class="post-img" src=" {{ asset('img/default.svg') }}">
                                            @else
                                                <img class="post-img" src=" {{ asset('storage/avatar/' . $client[0]->avatar) }} ">
                                            @endif
                                        </figure>

                                        <div class="post-data">
                                            <div class=" ">
                                                <p>{{ $client[0]->name }} {{ $client[0]->surname }}</p>
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
