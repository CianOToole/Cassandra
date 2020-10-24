@extends('layouts.app')

@section('content')
    <h2 class="text-center">All Users</h2>
    <ul class="list-group py-3 mb-3">
        @forelse($users as $user)
            <li class="list-group-item my-2">
                <h5>{{ $user->first_name }}</h5>
                <p>{{ Str::limit($user->last_name,10) }}</p>
                <small class="float-right">{{ $user->created_at->diffForHumans() }}</small>
                <a href="{{route('users.show',$user->id)}}">Read More</a>
            </li>
        @empty
            <h4 class="text-center">No Users Found!</h4>
        @endforelse
    </ul>
    <div class="d-flex justify-content-center">
        {{ $users->links() }}
    </div>
@endsection