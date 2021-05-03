@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">


            <div class="col-md-8 ">
                <div class="media-holder">

                    <div class="col-12 media-switch">
                        <h4>Boards</h4>
                        <h4>Newsfeed</h4>
                    </div>

                    <div class="col-12">

                        <!--<div id="boards" class="board-lnk">
                            @foreach ($boards as $board)
                                <a href="{{ route( 'board.topics.index', $board->id) }}">{{ $board->category }}</a>
                            @endforeach  
                        </div>-->

                        <div id="news">
                            <script src="{{ asset('js/news.js') }}" type="text/javascript"></script>
                            <div id="newsfeed"></div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="">
                    test
                </div>
            </div>

    </div>
</div>
@endsection
