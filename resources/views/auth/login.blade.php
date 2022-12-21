@extends('layouts.app')

@section('content')
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center "style="height:670px;">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                    <p class="text-white-50 mb-5">Please enter your email and password</p>
                                    <div class="form-outline form-white mb-4">
                                        <input type="email" id="email" name="email"
                                            class="form-control form-control-lg" value="{{ old('email') }}" />
                                        <label class="form-label" for="email">Email</label>
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="password" name="password"
                                            class="form-control form-control-lg" required autocomplete="current-password" />
                                        <label class="form-label" for="password">Password</label>
                                    </div>
                                    <div class="d-flex justify-content-center text-center mb-3">
                                        <div class="form-check form-white">
                                            <input class="form-check-input mr-4" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember"> {{ __('Remember Me') }}</label>
                                        </div>
                                        <p class="small ml-5 pb-lg-2"><a class="text-white-50"
                                            href="{{ route('password.request') }}">Forgot password?</a></p>
                                    </div>
                                    <button class="btn btn-outline-light btn-lg mb-4 px-5" type="submit">Login</button>

                                    @include('partials.errors')
                            </form>
                            <div class="d-flex justify-content-center text-center pt-1">
                                <a href="{{ route('auth.facebook') }}" class="text-white"><i
                                        class="fab fa-facebook-f fa-lg"></i></a>
                                <a href="{{ route('auth.twitter') }}" class="text-white"><i
                                        class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                <a href="{{ route('auth.google') }}" class="text-white"><i
                                        class="fab fa-google fa-lg"></i></a>
                            </div>
                            <div class="form-check form-white mt-4">
                                <p class="mb-0">Don't have an account? <a
                                        href="/register"class="text-white-50 fw-bold">Sign Up</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
