@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">

            <p id="alert-message" class="alert collapse"></p>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Boards</h3>
                </div>

                <div class="card-body">
                                        
                    @if(count($boards) === 0)
                        <p>There are no boards yet</p>
                    @else
                        <table id="table-visits" class="table table-hover">
                            <thead>
                                <th>Category</th>
                            </thead>

                            <tbody>

                                @foreach ($boards as $board)
                                    <tr data-id=" {{ $board->id }} " data-href="{{ route( 'board.topics.index', $board->id) }}" class="">
                                        <td>{{ $board->category }}</td>
                                    </tr>
                                @endforeach                        
                            </body>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
