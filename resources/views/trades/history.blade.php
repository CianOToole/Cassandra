@extends('layouts.app')

@section('content')

@php
    $count = 1;   
@endphp

    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="media-holder">

                    <div class="col-12 tab-header">
                        <a href="{{ route('trades.index') }}" class="float-left portfolioText">Portfolio</a>
                        <a href="{{ route('trades.history') }}" class="historyText">History</a>
                    </div>



                    <div class="table-responsiveness">
                        <table class="table table-hover table-sort">
                            <thead class="white">
                                <th scope="col">Stock</th>
                                <th scope="col">Changes</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Range</th>
                                <th scope="col">Beta</th>
                                <th scope="col">End Trade</th>
                            </thead>
                            <tbody>
                                @foreach ($trades as $trade)
                                    @php
                                        $switch_bcg;
                                        $count % 2 != 0 ? ($switch_bcg = 'blue-bck') : ($switch_bcg = null);
                                    @endphp
                                    <tr class="{{ $switch_bcg }}">
                                        <th >{{ $trade->ticker }}</th>
                                        <td>{{ $trade->changes }}</td>
                                        <td>{{ $trade->amount }}</td>
                                        <td>{{ $trade->range }}</td>
                                        <td>{{ $trade->beta }}</td>

                                        <td><button type="button" class="btn btn-danger"
                                                onclick="document.querySelector('#delete-form').submit()">End trade</button>
                                            <form method="POST" id="delete-form"
                                                action="{{ route('trades.destroy', $trade->id) }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @php
                                        $count++;   
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
@endsection
