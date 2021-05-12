@extends('layouts.app')
@section('content')



{{-- <div class="container work">
    <h3 class="text-center">Make order</h3>
    <form action="{{ route('trades.store') }}" method="post">
        <div>
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
        </div>
    </form> --}}



    <div class="form-holder">
        <div class="form">
            <div class="">
                <h1>Order</h1>
            </div>
    
            <div>
                
                <form method="POST" action="{{ route('trades.store') }}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="price_at_order" value="{{ $price_at_order }}">
                <input type="hidden" name="stock_ticker" value="{{ $stock_ticker }}">
                <input type="hidden" name="beta" value="{{ $beta }}">
                <input type="hidden" name="volAvg" value="{{ $volAvg }}">
                <input type="hidden" name="changes" value="{{ $changes }}">
                <input type="hidden" name="range" value="{{ $range }}">
                    
                    <div class="form-group-parent">
                        <div class="form-group">
                            <h5><label for="amount" class="">
                                {{-- <i class="far fa-envelope" style="padding-right: 8px"></i> --}}
                                {{ __('Amount') }}
                            </label></h5>
    
                            <div class="input-holder">
                                <input id="amount" type="text" class="@error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required autocomplete="amount" autofocus>
    
                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                        <h5><label for="buy or sell" class="">
                            {{-- <i class="far fa-envelope" style="padding-right: 8px"></i> --}}
                            {{ __('Buy or Sell') }}
                        </label></h5>
                        <div class="input-holder">
                        <select class="custom-select" id="sellOrBuy" name="sellOrBuy" style="border-color: #222 !important">
                                    <option value= "{{1}}">{{'Buy'}}</option>
                                    <option value= "{{0}}">{{ 'Sell'}}</option>
                        </select>
                        </div>
                        @error('sellOrBuy')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
    
                        <div class="login-group">
                            <button type="submit" class="">
                                <h6>{{ __('Submit') }}</h6>
                            </button>
                        </div>
                        
                    </div>
                </form>
    
            </div>
        </div>
    </div>
</div>
@endsection
