@extends('layouts.app')

@section('content')

<script src="{{ asset('js/watchlist.js') }}"></script>
<div class="container">
    <div class="row">

            <div class="col-md-8 ">
                <div class="media-holder">

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

            {{-- FUND SECTION --}}

            <div class="col-md-4">
                <div class="media-holder">

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
            </div>
            
    </div>
</div>
@endsection
