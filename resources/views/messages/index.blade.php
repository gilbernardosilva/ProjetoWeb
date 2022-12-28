@extends('layouts.app')

@section('content')
    @include('partials.flash')
    <div class="container">
        <ul class="messages">
                <li>Messages @include('messages.unread-count')</li>
                <li><a href="/dashboard/create">Create New Message</a></li>
        </ul>
    </div>
    @each('partials.thread', $threads, 'thread', 'partials.no-threads')
@stop