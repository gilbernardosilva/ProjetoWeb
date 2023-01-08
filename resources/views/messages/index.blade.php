@extends('layouts.app')

@section('content')
<div class="text-center">
    <h1 class = "mb-4"> Messages Hub </h1>
        <ul class="messages">
            <a href="{{ route('messages.create') }}">Create New Message</a>
        </ul>
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
    @include('partials.errors')
@endsection
