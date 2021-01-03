@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">New topic</h3>
                </div>

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{route('board.topics.store', $board->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group ">
                            <label for="title">Title</label>
                            <div class="">
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" />
                            </div>
                        </div>

                        <div class="float-right">
                            <a href="{{ route('board.topics.index', $board->id) }}" class="btn btn-link">Cancel</a>
                            <button type="submit" class="btn btn-primary pull-right">Submit</button>
                        </div>    
                        

                    </form>

                </div>  
            </div>
        </div>
    </div>
</div>
@endsection
