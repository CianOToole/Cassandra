@extends('layouts.app')

@section('content')
    <h2 class="text-center">All Trades</h2>
    <ul class="list-group py-3 mb-3">
        @forelse($trades as $trade)
            <li class="list-group-item my-2">
                <h5>{{ $trade->id }}</h5>
                <p>{{ Str::limit($trade->amount,10) }}</p>
                <small class="float-right">{{ $trade->created_at->diffForHumans() }}</small>
                <a href="{{route('trades.show',$trade->id)}}">Read More</a>
            </li>
        @empty
            <h4 class="text-center">No Todos Found!</h4>
        @endforelse
    </ul>
    <div class="d-flex justify-content-center">
        {{ $trades->links() }}
    </div>
@endsection