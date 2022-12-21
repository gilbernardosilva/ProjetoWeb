@extends('layouts.app')

@section('content')
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-75">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center "style="height:420px;">
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <h2 class="fw-bold mb-2 text-uppercase">Reset Password</h2>
                                    <p class="text-white-50 mb-5">Please enter your email </p>
                                    <div class="form-outline form-white mb-4">
                                        <input type="email" id="email" name="email"
                                            class="form-control form-control-lg" value="{{ old('email') }}" />
                                        <label class="form-label" for="email">Email</label>
                                    </div>
                                    <button class="btn btn-outline-light btn-lg mb-4 px-5" type="submit">Send password reset link</button>
                                    @include('partials.errors')
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
