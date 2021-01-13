@extends('layouts.app')

@section('content')
@php
    $count = 1;   
@endphp

<div class="container-fluid" style="display: inline-block">
    <div class="row">
        <div class="col-md-8 block">

            <div class="col-12 post-title">
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
                    @endphp

                    <div class="row {{ $switch_bcg }}" >

                        <div class="col-12" >
                            <div class="" style="float: right">
                                <button>quote</button>
                                <button>edit</button>
                                <button>delete</button>
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
                                        {{$post->name}} {{$post->surname}}
                                    </p>        
                                </div>

                                <div class="col-3">
                                    <p style="float: right">{{$date}}</p>
                                </div>
                                
                            </div>
                            <hr>
                        </div>

                        <div class="col-md-12">
                            <p>{{$post->post}}</p>
                        </div>

                    </div>

                    @php
                        $count++;   
                    @endphp
                @endforeach
            </div>

        </div>

        <div class="col-md-4 red"></div>
    </div>
</div>
@endsection
