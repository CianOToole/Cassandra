@extends('layouts.app')

@section('content')
<div class="container-fluid">

    {{-- LOGIN  --}}
    <div class="row">
        <div class="col-12 hp-sec-1" style="padding-left: 0;">
            <div class="sec-1-sub">
                <p id="hp-tt-1">Welcome to</p>
                <p id="hp-tt-2">Cassandra</p>
                <h5 id="hp-tt-3">Your professional paper trade application</h5>
                @guest
                    @if (Route::has('login'))
                        <a id="hp-login" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @endif
                @endguest
            </div>
            <div class=""></div>
        </div>
    </div>

    {{-- PRESENTATION  --}}

    <div class="row" style="background: #fff">
        <div class="col-12 hp-sec-2">
            <div class="sec-2-sub">
                <h1 id="" class="col-12">Who we are</h1>
                <p id="intro" class="col-12">Cassandra aims to provide an online service for online paper trade with real stock data. 
                    As It is sometimes tough for individuals to dive into trading, Cassandra offers the help to start trading.</p>
            </div>
        </div>
    </div>

    {{-- SERVICES  --}}

    <div class="row">
        <div class="col-12 hp-sec-3">
            <div class="sec-2-sub">
                <h1 id="" class="col-12">Our services</h1>
                <div id="services-holder">
                    <div class="service-holder">
                        <i class="fas fa-chart-pie"></i>
                        <h4>Finance</h4>
                        <p>The financial tools and data are as precise as possible enabling oe's best analysis.</p>
                    </div>
                    <div class="service-holder">
                        <i class="fas fa-share-alt"></i>
                        <h4>Social trading</h4>
                        <p>The platform provides a platform for its user to interact with other traders.</p>
                    </div>
                    <div class="service-holder"> 
                        <i class="fas fa-newspaper"></i>
                        <h4>Newsfeed</h4>
                        <p>The article selection offer ones research with  the most up-to-date information.</p>
                    </div>
                    <div class="service-holder">
                        <i class="fas fa-vial"></i>
                        <h4>Expertise</h4>
                        <p>Cassandra comes with a handful team of technicians always on the edge to improve the service.</p>
                    </div>
                    <div class="service-holder">
                        <i class="fas fa-share-alt"></i>
                        <h4>Fees</h4>
                        <p>Cassandra takes transaction fee for every trading, no more. </p>
                    </div>
                    <div class="service-holder"> 
                        <i class="fas fa-phone-alt"></i>
                        <h4>Legal support</h4>
                        <p>Support  is available for whoever needs help for legal issues, covering all the EU countries.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    {{-- FOOTER  --}}

<footer id="hp-footer">
    <h6>Copyright © 2022. All rights reserved by Cassandra</h6>
</footer>
@endsection
