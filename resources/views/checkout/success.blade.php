@extends('layouts.app')
@section('content')
    @livewireScripts()
    <div class="d-flex justify-content-center">
        <title class="text-center">Thanks for your order!</title>
        <h1 class="text-center">Thanks for your order, {{ Auth::user()->name }}!</h1>
        <p class="text-center">
            We appreciate your business!
            Your product key has been sent to ur email.
            If you have any questions, please email
            <a href="mailto:orders@glquadrics.com">support@glquadrics.com</a>.
        </p>
    </div>
    @include('partials.footer')
@endsection
