@extends('layouts.app')

@section('content')
    <div class="container float-left">
        <h2 class="text-center">All Trades</h2>

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
                    <tr>
                        <th scope="row">{{ $trade->ticker }}</th>
                        <td>bruh</td>
                        <td>{{ $trade->ticker }}</td>
                        <td>{{ $trade->amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>




    </div>
    <div class="container">
        <div class="row">
            <h2 class="walletText col">Wallet</h2>
            <button type="submit" class="btn btn-primary moveRight col">Fund</button>
        </div>
         {{-- <hr> --}}
        <div class="row">
            @foreach ($balances as $balance)
            <h2 class="walletText col">Balance</h2>
            <h2 class="walletText col">{{$balance->amount + $portfolioCash}}</h2>
            @endforeach
        </div>
        {{-- <hr> --}}
        <div class="row">
            <h2 class="walletText col">Portfolio</h2>
            <h2 class="walletText col">{{$portfolioCash}}</h2>
        </div>
        <div class="row">
            @foreach ($balances as $balance)
            <h2 class="walletText col">Available to trade</h2>
            <h2 class="walletText col">€{{$balance->amount}}</h2>
            @endforeach
        </div>
        <div class="row">
            <h2 class="walletText col">Daily +/-</h2>
            <h2 class="walletText col">{{$gainLoss}}€</h2>
        </div>
    </div>
@endsection
