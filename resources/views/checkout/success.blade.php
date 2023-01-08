@extends('layouts.app')
@section('content')
    @livewireScripts()
    <div class="mt-5 card">
        <div style="display: flex; align-items: center; justify-content:center;">
            <title class="text-center">Thanks for your order!</title>
            <h1 class="text-center">Thanks for your order, {{ Auth::user()->name }}!</h1>
        </div>
        <p class="text-center">
            We appreciate your business!
            Your product key has been sent to your email.
            If you have any questions, please email
            <a href="mailto:orders@glquadrics.com">support@glquadrics.com</a>.
        </p>
    </div>
    @include('partials.footer')
@endsection
