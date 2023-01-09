@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-6 offset-3 text-center">
                <h1>Chat with {{$user->name}}</h1>
                <h3>Subject - {{ $thread->subject }}</h3>
                <div class="timeline-centered">
                    <div class="messageStream">
                        @foreach ($thread->messages as $message)
                            <article class="timeline-entry">
                                <div class="timeline-entry-inner">
                                    <div class="timeline-icon">
                                        <i class="fa fa-bullhorn"></i>
                                    </div>
                                    <div class="timeline-label">
                                        <h3>{{ $message->user->name }} <span>Posted
                                                {{ $message->created_at->diffForHumans() }}</span></h3>
                                        <p>{{ $message->body }}</p>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
                <h3>Add a new message</h3>
                <form action="{{ route('messages.update', $thread->id) }}" method="post">
                    {{ method_field('post') }}
                    {{ csrf_field() }}
                    <!-- Message Form Input -->
                    <div class="form-group">
                        <textarea name="message" class="form-control">{{ old('message') }}</textarea>
                    </div>
                    <!-- Message Participant -->
                    <input type="hidden" id="recipients" name="recipients" value="$user->id" />
                    <!--<div class="select">
                        <select name="user_id" id="user_id" class="form-select">
                            <option type="checkbox" name="recipients[]" value="{{ $user->id }}">
                                {{ $user->name }}</option>
                        </select>
                    </div>-->

                    <!-- Submit Form Input -->
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary form-control">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
