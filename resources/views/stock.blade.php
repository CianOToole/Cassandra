@extends('layouts.app')

@section('content')

    <div class="container work">

        <div class="row blockColour stockHiddenInputForm">
                <div class="col-md-6">
                    <p class="stockAndExchange" id="myBtn"></p>
                    <p class="priceOfStock" id="myBtn2"></p>
                </div>
            <div class="col-md-6">
               
                <form action="{{ route('trades.create') }}" method="get">
                    <div class="input-group ">
                        <input type="hidden" id="hideBtn" name="ticket" value="">
                    </div>
                    <button type="submit" class="btn btn-primary stockButton">Order</button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="row bite blockColour  col-md-8 ">
                <div class="col-md-12 graph col-sm-6">
                    <script src="{{ asset('js/stock.js') }}" type="text/javascript"></script>
                </div>
            </div>

            <div class="row bite position-sticky col-md-4">
                <div class="col-md-12 blockColour stockData ">
                    <h1 id="myBtn4"></h1>
                    <hr>
                    <p  id="myBtn5"></p>
                    <hr>
                    <p  id="myBtn6"></p>
                    <hr>
                    <p  id="myBtn7"></p>
                    <hr>
                    <p  id="myBtn8"></p>
                    <hr>
                    <p  id="myBtn9"></p>
                    <hr>
                    <p  id="myBtn10"></p>
                </div>

                <div class="col-md-12 blockColour">
                    <div class="row">
                        <h2 class="walletText col">Wallet</h2>
                        <button type="submit" class="btn btn-primary moveRight col">Fund</button>
                    </div>
                    {{-- <hr> --}}
                    <div class="row">
                        @foreach ($balances as $balance)
                            <h2 class="walletText col">Balance</h2>
                            <h2 class="walletText col">{{ $balance->amount + $portfolioCash }}</h2>
                        @endforeach
                    </div>
                    {{-- <hr> --}}
                    <div class="row">
                        <h2 class="walletText col">Portfolio</h2>
                        <h2 class="walletText col">{{ $portfolioCash }}</h2>
                    </div>
                    <div class="row">
                        @foreach ($balances as $balance)
                            <h2 class="walletText col">Available to trade</h2>
                            <h2 class="walletText col">€{{ $balance->amount }}</h2>
                        @endforeach
                    </div>
                    <div class="row">
                        <h2 class="walletText col">Daily +/-</h2>
                        <h2 class="walletText col">{{ $gainLoss }}€</h2>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <script src="https://unpkg.com/lightweight-charts/dist/lightweight-charts.standalone.production.js"></script>
    <script src="{{ asset('js/balance.js') }}" type="text/javascript"></script>

    </div>

@endsection
