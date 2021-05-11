@extends('layouts.app')

@section('content')

    <div class="container work">

        <div class="row blockColour stockHiddenInputForm">
            <div class="col-12">
                <div class="col-md-6">
                    <p class="stockAndExchange" id="myBtn"></p>
                    <p class="priceOfStock" id="myBtn2"></p>
                </div>
     
                <form class="col-md-6" action="{{ route('trades.create') }}" method="get">
                    <div class="input-group">
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

            <div class="col-md-4">

                <div class="col-12">
                    <div class="media-holder">
                        <div class="col-12 tab-header">
                            <h4 id="myBtn4"></h4>
                        </div>
                        {{-- <h1 id="myBtn4"></h1> --}}
                        {{-- <hr> --}}
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
                </div>

                <div class="col-12">

                    <div class="media-holder">

                        <div class="col-12 tab-header fund-box">
                            <h4>Wallet</h4>
                            <h6><button type="submit" class="">Fund</button> </h6>
                        </div>
    
                        <div class="col-12 tab-cnt">
                            <div class="balance-header">
                                <h5>Balance</h5>
                                <h5>9999.99€</h5>
                            </div>
                            <div class="balance-body">
                                <div class="balance-row">
                                    <h6>Portfolio</h6>
                                    <h6>22389.22€</h6>
                                </div>
                                <div class="balance-row">
                                    <h6>Available to trade</h6>
                                    <h6>1112,389.21€</h6>
                                </div>
                                <div class="balance-row">
                                    <h6>Daily +/-</h6>
                                    <h6>-5692.21.99€</h6>
                                </div>
                            </div>
                        </div>
    
                    </div>

                    {{-- <hr>
                    <div class="row">
                        @foreach ($balances as $balance)
                            <h2 class="walletText col">Balance</h2>
                            <h2 class="walletText col">{{ $balance->amount + $portfolioCash }}</h2>
                        @endforeach
                    </div>
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
                    </div> --}}
                </div>
            </div>
        </div>


    </div>


    <script src="https://unpkg.com/lightweight-charts/dist/lightweight-charts.standalone.production.js"></script>
    <script src="{{ asset('js/balance.js') }}" type="text/javascript"></script>

    </div>

@endsection
