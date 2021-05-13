@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">

            <div class="col-12">    
                <div class="media-holder">

                    <div class="stock-banner">
                        {{-- <div class="col-12"> --}}
                            <div class="">
                                <p class="" id="myBtn"></p>
                                <h1 class="" id="myBtn2"></h1>
                            </div>
                    
                            <form class="" action="{{ route('trades.create') }}" method="get">
                                <div class="input-group">
                                    <input type="hidden" id="hideBtn" name="ticket" value="">
                                </div>
                                <button type="submit" class="order-stock">Order</button>
                            </form>
                        {{-- </div> --}}
                    </div>
                
                </div>
            </div>
        </div>


        <div class="row">

            <div class="col-md-8">    
                <div class="media-holder graph graph-holder" >
                        <script src="{{ asset('js/stock.js') }}" type="text/javascript"></script>
                </div>
            </div>

            <div class="col-md-4">    

                <div class="media-holder">
                    <div class="col-12 tab-header">
                        <h4 id="companyName"></h4>
                    </div>
                    <div class="stock-sheet">
                        <p>Price</p>
                        <h6  id="stockPrice" ></h6>
                    </div>
                    <div class="stock-sheet">
                        <p>Market's cap</p>
                        <h6  id="stockCap" ></h6>
                    </div>
                    <div class="stock-sheet">
                        <p>Average volume</p>
                        <h6  id="stockVol" ></h6>
                    </div>
                    <div class="stock-sheet">
                        <p>Sector</p>
                        <h6  id="stockSector" ></h6>
                    </div>
                    <div class="stock-sheet">
                        <p>Range</p>
                        <h6  id="stockRange" ></h6>
                    </div>
                    <div class="stock-sheet">
                        <p>Insdustry</p>
                        <h6  id="stockIndutry" ></h6>
                    </div>
                </div>

                {{-- <div class="media-holder "> --}}
                    {{-- FUND SECTION --}}

                    <div class="wallet">
                        <div class="media-holder ">

                            <div class="col-12 tab-header fund-box">
                                <h4>Wallet</h4>
                                <h6><button type="submit" class="">Fund</button> </h6>
                            </div>

                            <div class="col-12 tab-cnt">
                                <div class="balance-header">
                                    <h5>Balance</h5>
                                    <h5>{{ $balance->amount }}€</h5>
                                </div>
                                <div class="balance-body">
                                    <div class="balance-row">
                                        <p>Portfolio</p>
                                        <h6>22389.22€</h6>
                                    </div>
                                    <div class="balance-row">
                                        <p>Available to trade</p>
                                        <h6>1112,389.21€</h6>
                                    </div>
                                    <div class="balance-row">
                                        <p>Daily +/-</p>
                                        <h6>-5692.21.99€</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                {{-- </div> --}}
            </div>

    </div>

    <div class="row watchlist">
        {{-- <script src="{{ asset('js/watchlist.js') }}"></script> --}}

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

    <script src="https://unpkg.com/lightweight-charts/dist/lightweight-charts.standalone.production.js"></script>
    <script src="{{ asset('js/balance.js') }}" type="text/javascript"></script>

</div>

@endsection
