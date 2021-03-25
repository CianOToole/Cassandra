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
        </div>
    </div>
@endsection
