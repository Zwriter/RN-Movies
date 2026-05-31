@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card border-0"
                style="background-color: #2a2a3e; border-left: 3px solid #f5c518 !important; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                <div class="card-body p-4">

                    {{-- Header --}}
                    <h3 class="fw-bold mb-1" style="color: #f5c518;">Welcome back</h3>
                    <p class="mb-4" style="color: #888;">Sign in to your account</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label small" style="color: #aaa;">Email</label>
                            <input id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required autofocus
                                class="form-control @error('email') is-invalid @enderror"
                                style="background-color: #1a1a2e; border: 1px solid #444; color: #fff;">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label small" style="color: #aaa;">Password</label>
                            <input id="password"
                                type="password"
                                name="password"
                                required
                                class="form-control @error('password') is-invalid @enderror"
                                style="background-color: #1a1a2e; border: 1px solid #444; color: #fff;">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Remember me --}}
                        <div class="mb-4 d-flex align-items-center gap-2">
                            <input type="checkbox"
                                class="form-check-input m-0"
                                name="remember"
                                id="remember"
                                style="border-color: #444; background-color: #1a1a2e;">
                            <label class="form-check-label small" for="remember" style="color: #aaa;">
                                Remember me
                            </label>
                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                            class="btn w-100 fw-bold"
                            style="background-color: #f5c518; color: #000; border: none;">
                            Login
                        </button>
                    </form>

                    <hr style="border-color: #444;">

                    <p class="text-center mb-0 small" style="color: #888;">
                        Don't have an account?
                        <a href="{{ route('register') }}" style="color: #f5c518; text-decoration: none;">Register</a>
                    </p>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection