@extends('layouts.app')

@section('content')
    <h2 class="text-center">All Stocks</h2>
    <ul class="list-group py-3 mb-3">
        @forelse($stocks as $stock)
            <li class="list-group-item my-2">
                <h5>{{ $stock->ticker }}</h5>
                <p>{{ Str::limit($stock->price,10) }}</p>
                {{-- <small class="float-right">{{ $stock->created_at->diffForHumans() }}</small> --}}
                <a href="{{route('stocks.show',$stock->id)}}">Trade</a>
            </li>
        @empty
            <h4 class="text-center">No Stocks Found!</h4>
        @endforelse
    </ul>
    <div class="d-flex justify-content-center">
        {{-- {{ $stocks->links() }} --}}
    </div>
@endsection