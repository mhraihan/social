@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Latest Posts') }}</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="{{ route('message.store') }}" method="post">
                        @csrf
                        <textarea class="form-control" name="body" id="" rows="3"
                            placeholder="what's on your mind"></textarea>
                        <button type="submit" class="btn btn-right btn-primary">Post</button>
                    </form>
                </div>
                <hr>
                <div class="card-body">

                    @forelse ($messages as $message)
                    <h4>
                        <a href="{{ route('profile',$message->user) }}">
                            {{ $message->user->name }}
                        </a>
                    </h4>
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
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Notifications </div>
                <div class="card-body">
                    @foreach (auth()->user()->notifications as $notification)
                    <h4>
                        <a href="{{ route('profile', $notification->data['user_id']) }}">
                            {{ $notification->data['user_name'] }}
                        </a>
                        <small>started following you</small>
                    </h4>
                    <p>{{ $notification->created_at->diffForHumans() }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
