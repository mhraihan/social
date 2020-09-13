@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>
                        {{ $user->name }}
                    </h5>
                    @if (auth()->user() != $user)
                    <form action="{{ route('profile.flow',['user' => $user]) }}" method="post">
                        @csrf
                        @if (auth()->user()->isFollowing($user))
                        <input type="submit" class="btn btn-danger float-right" name="unfollow" value="Unfollow" />
                        @else
                        <input type="submit" class="btn btn-info float-right" name="follow" value="Follow">
                        @endif
                    </form>
                    @endif
                </div>
                <div class="card-body">
                    @forelse ($user->messages as $message)
                    {{ $message->body }}
                    <br>
                    {{ $message->created_at->diffForHumans() }}
                    <hr>
                    @empty
                    <p>No post found!</p>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
