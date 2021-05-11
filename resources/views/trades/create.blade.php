@extends('layouts.app')
@section('content')
<div class="container work">
    <h3 class="text-center">Make order</h3>
    <form action="{{ route('trades.store') }}" method="post">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="price_at_order" value="{{ $price_at_order }}">
        <input type="hidden" name="stock_ticker" value="{{ $stock_ticker }}">
        
        <input type="hidden" name="beta" value="{{ $beta }}">
        <input type="hidden" name="volAvg" value="{{ $volAvg }}">
        <input type="hidden" name="changes" value="{{ $changes }}">
        <input type="hidden" name="range" value="{{ $range }}">
        <div class="form-group">
            <label for="amount">Trade</label>
            <input type="text" name="amount" id="amount"
                class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" value="{{ old('amount') }}"
                placeholder="Enter amount">
            @if ($errors->has('amount'))
                <span class="invalid-feedback">
                    {{ $errors->first('amount') }}
                </span>
            @endif
        </div>
        <div class="form-group">
            <label for="sellOrBuy">Buy</label>
            <input type="radio" name="sellOrBuy" id="amousellOrBuynt"
                class="form-control {{ $errors->has('sellOrBuy') ? 'is-invalid' : '' }}" 
                placeholder="Enter sellOrBuy" value="1">

                <label for="male">Sell</label><br>

                <input type="radio" name="sellOrBuy" id="amousellOrBuynt"
                class="form-control {{ $errors->has('sellOrBuy') ? 'is-invalid' : '' }}" 
                placeholder="Enter sellOrBuy" value="0">
                
            @if ($errors->has('sellOrBuy'))
                <span class="invalid-feedback">
                    {{ $errors->first('sellOrBuy') }}
                </span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Order</button>
    </form>
</div>
@endsection
