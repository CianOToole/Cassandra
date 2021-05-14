@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-8">
                <a href="{{route('trades.index')}}" class="float-left portfolioText">Portfolio</a>
                <a href="{{route('trades.history')}}" class="historyText">History</a>

                {{-- <li class="list-group-item my-2">
                <h5>{{ $trade->id }}</h5>
                <p>{{ Str::limit($trade->amount,10) }}</p>
                <small class="float-right">{{ $trade->created_at->diffForHumans() }}</small>
                <a href="{{route('trades.show',$trade->id)}}">Read More</a>
            </li> --}}

                <table class="table table-striped ">
                    <thead class="white">
                        <tr>
                            <th scope="col">Stock</th>
                            <th scope="col">Changes</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Range</th>
                            <th scope="col">Beta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trades as $trade)
                       

                            <tr >
                                <th scope="row">{{ $trade->ticker }}</th>
                                <td>{{ $trade->changes }}</td>
                                <td>{{ $trade->amount }}</td>
                                <td>{{ $trade->range }}</td>
                                <td>{{ $trade->beta }}</td>
                              
                                <td><button type="button" class="btn btn-danger" onclick="document.querySelector('#delete-form').submit()">End trade</button>
                                    <form method="POST" id="delete-form" action="{{route('trades.destroy',$trade->id)}}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-4">
                <div class="media-holder ">
                    {{-- FUND SECTION --}}

                    <div class="wallet">
                        <div class="media-holder ">

                            <div class="col-12 tab-header fund-box">
                                <h4>Wallet</h4>
                                <h6><button type="submit" class="">Fund</button> </h6>
                            </div>

                            <div class="col-12 tab-cnt">
                                <div class="balance-header">
                                @foreach ($balances as $balance)
                                    <h5>Balance</h5>
                                    <h5>{{$balance->amount + $portfolioCash }}€</h5>
                                @endforeach
                                </div>
                                <div class="balance-body">
                                    <div class="balance-row">
                                        <p>Portfolio</p>
                                        <h6>{{ $portfolioCash }}</h6>
                                    </div>
                                    <div class="balance-row">
                                        <p>Available to trade</p>
                                        <h6>€{{ $balance->amount }}</h6>
                                    </div>
                                    <div class="balance-row">
                                        <p>Daily +/-</p>
                                        <h6>{{ $gainLoss }}€</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        

    </div>
@endsection
