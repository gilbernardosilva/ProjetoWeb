@extends('layouts.app')
@section('content')
    @if(auth()->user()->id == $user->id)
    @include('profile.showOwn')
    @else
    @include('profile.showOther')
    @endif
@endsection
