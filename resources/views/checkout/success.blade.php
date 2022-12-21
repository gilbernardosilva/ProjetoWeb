@extends('layouts.app')
@section('content')
    @livewireScripts()
    @include('partials.header')
    <html>

    <head>
        <title class="center">Thanks for your order!</title>
    </head>

    <body>
        <h1>Thanks for your order, {{ Auth::user()->name }}!</h1>
        <p>
            We appreciate your business!
            If you have any questions, please email
            <a href="mailto:orders@glquadrics.com">support@glquadrics.com</a>.
        </p>
    </body>

    </html>
    @include('partials.footer')
@endsection
