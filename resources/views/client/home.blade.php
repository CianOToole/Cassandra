@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Loggin successful.

                    <br>
                    <br>

                    <div class="flash-message">
                        @if($banning_state == 1)
                            <div class="alert alert-danger">
                                Warning: you have been ban from posting in the forum. Please watch out the community 
                                <a href="#" style="text-decoration: underline; color: #761B18;">guideline</a>.
                            </div>
                        @endif           
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>


@endsection
