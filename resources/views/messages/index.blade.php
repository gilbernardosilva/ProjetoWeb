@extends('layouts.app')

@section('content')
    @if (Session::has('error_message'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error_message') }}
        </div>
    @endif
    <div class="container">
        <ul class="messages">
            <li><a href="/dashboard/create">Create New Message</a></li>
        </ul>
    </div>
    @if($threads->count() > 0)
        <div class="timeline-centered">
            
            @foreach($threads as $thread)
                <?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : ''; ?>
                <article class="timeline-entry">

                    <div class="timeline-entry-inner">
                        <div class="timeline-icon">
                            <i class="fa fa-comments fa-2x"></i>
                        </div>
                        <div class="timeline-label">
                            <h4 class="media-heading">
                                <a href="{{ route('messages.show', $thread->id) }}">{{ $thread->subject }}</a>
                            </h4>
                            <p>{{ $thread->latestMessage->body }}</p>
                            <p><small><strong>Participants:</strong> {{ $thread->participantsString(Auth::id()) }}</small></p>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        
    @else<br />
        <p>Sorry, no messages.</p>
    @endif
@stop