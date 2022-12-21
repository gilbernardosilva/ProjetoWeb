@extends('layouts.app')

@section('content')
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center "style="height:785px;">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <h2 class="fw-bold mb-2 text-uppercase">Register</h2>
                                    <p class="text-white-50 mb-5">Please enter your register credentials</p>

                                    <div class="form-outline form-white mb-4">
                                        <input type="name" id="name" name="name"
                                            class="form-control form-control-lg" value="{{ old('name') }}" />
                                        <label class="form-label" for="name">Name</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="email" id="email" name="email"
                                            class="form-control form-control-lg" value="{{ old('email') }}"/>
                                        <label class="form-label" for="email">Email</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="password" name="password"
                                            class="form-control form-control-lg" required autocomplete="new-password" />
                                        <label class="form-label" for="password">Password</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="password-confirm"
                                            name="password-confirm" class="form-control form-control-lg" required
                                            autocomplete="new-password" >
                                        <label class="form-label" for="password-confirm">Password Confirmation</label>
                                    </div>
                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Register</button>
                                    @include('partials.errors')
                            </form>

                            <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                <a href="{{ route('auth.facebook') }}" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                <a href="{{ route('auth.twitter') }}" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                <a href="{{ route('auth.google') }}" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                            </div>

                            <div class="form-check form-white mt-4 text-center">
                                <p class="mb-0">Already have an account? <a
                                        href="/login"class="text-white-50 fw-bold">Sign In</a></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
