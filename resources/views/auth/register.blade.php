@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card border-0"
                style="background-color: #2a2a3e; border-left: 3px solid #f5c518 !important; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                <div class="card-body p-4">

                    {{-- Header --}}
                    <h3 class="fw-bold mb-1" style="color: #f5c518;">Create an account</h3>
                    <p class="mb-4" style="color: #888;">Join and start exploring movies</p>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label small" style="color: #aaa;">Name</label>
                            <input id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required autofocus
                                minlength="2" maxlength="255"
                                autocomplete="name"
                                class="form-control @error('name') is-invalid @enderror"
                                style="background-color: #1a1a2e; border: 1px solid #444; color: #fff;">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label small" style="color: #aaa;">Email</label>
                            <input id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
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
                                autocomplete="new-password"
                                class="form-control @error('password') is-invalid @enderror"
                                style="background-color: #1a1a2e; border: 1px solid #444; color: #fff;">
                            <div class="form-text small" style="color: #666;">
                                At least 8 characters with upper/lowercase, numbers and symbols.
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label small" style="color: #aaa;">Confirm Password</label>
                            <input id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                class="form-control"
                                style="background-color: #1a1a2e; border: 1px solid #444; color: #fff;">
                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                            class="btn w-100 fw-bold"
                            style="background-color: #f5c518; color: #000; border: none;">
                            Register
                        </button>
                    </form>

                    <hr style="border-color: #444;">

                    <p class="text-center mb-0 small" style="color: #888;">
                        Already have an account?
                        <a href="{{ route('login') }}" style="color: #f5c518; text-decoration: none;">Login</a>
                    </p>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection