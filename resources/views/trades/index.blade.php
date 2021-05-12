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
                            <th scope="col">Performance</th>
                            <th scope="col">Low</th>
                            <th scope="col">High</th>
                            <th scope="col">Avg Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trades as $trade)
                       

                            <tr >
                                <th scope="row">{{ $trade->ticker }}</th>
                                <td>bruh</td>
                                <td>{{ $trade->ticker }}</td>
                                <td>{{ $trade->amount }}</td>
                                <td>{{ $trade->id }}</td>
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

            <div class="col-4 blockColour">
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
                                    <h5>Balance</h5>
                                    <h5>{{ $balance[0]->amount }}€</h5>
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
        </div>

        

    </div>
@endsection
