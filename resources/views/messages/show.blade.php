@extends('layouts.app')

@section('content')
    <div class="col-md-6">
        <h1>Subject - {{ $thread->subject }}</h1>
        <div class="timeline-centered">
            <div class="messageStream">
                @foreach($thread->messages as $message)
                    <article class="timeline-entry">

                        <div class="timeline-entry-inner">

                            <div class="timeline-icon">
                                <i class="fa fa-bullhorn"></i>
                            </div>

                            <div class="timeline-label">
                                <h2>{{ $message->user->name }} <span>Posted {{ $message->created_at->diffForHumans() }}</span></h2>
                                <p>{{ $message->body }}</p>
                            </div>
                        </div>

                    </article>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <h2>Add a new message</h2>
        <form action="{{ route('messages.update', $thread->id) }}" method="post">
            {{ method_field('post') }}
            {{ csrf_field() }}
        
            <!-- Message Form Input -->
            <div class="form-group">
                <textarea name="message" class="form-control">{{ old('message') }}</textarea>
            </div>

            <!-- Message Participant -->
            <div class="select">
                @foreach($users as $user)
                    <select name="user_id" id="user_id" class="form-select">
                        <option type="checkbox" name="recipients[]" value="{{ $user->id }}">{{ $user->name }}</option>
                    </select>
                @endforeach    
            </div>

            <!-- Submit Form Input -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary form-control">Submit</button>
            </div>
        </form>
    </div>    
@stop