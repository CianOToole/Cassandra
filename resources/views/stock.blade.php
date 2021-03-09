@extends('layouts.app')

@section('content')

    <div class="container work">

        <div class="row bite">

            <div class="col-md-8 graph">
                <script src="{{ asset('js/stock.js') }}" type="text/javascript"></script>
                
            </div>
            <div class="col-md-4">
                <h1>Lorem ipsum dolor sit amet.</h1>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Distinctio, quaerat in? Inventore amet eligendi cupiditate fugit aut nihil repellat debitis,
                nisi labore incidunt modi provident suscipit natus necessitatibus in voluptatem, ad repellendus non culpa.
                Nemo non at, recusandae dolore, eum, similique ratione voluptas eligendi nisi expedita fuga error! Vero
                facilis,
                optio dolore repudiandae alias officia reiciendis animi soluta commodi facere debitis sint consectetur,
                ducimus repellendus,
                porro rem! Provident esse eaque non iste, doloribus vitae repudiandae rerum eligendi quas sequi! Harum
                cupiditate magni commodi e
                sse, officia, facilis quam perspiciatis dolor a earum laborum id iste accusamus fugit! Ipsa nesciunt
                dignissimos dolores.
            </div>
            {{-- href="{{route('trades.create',$stock->price)}}" --}}
            {{-- <a href="#" onmousedown="promptOrder()" id="myBtn" class="btn btn-primary float-left">Order</a> --}}
        </div>
        <form action="{{ route('trades.create') }}" method="get">
            <div class="input-group">
                <input type="hidden" id="hideBtn" name="ticket" value="">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>



        <script src="https://unpkg.com/lightweight-charts/dist/lightweight-charts.standalone.production.js"></script>
        <script src="{{ asset('js/balance.js') }}" type="text/javascript"></script>

    </div>

@endsection
