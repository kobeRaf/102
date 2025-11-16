@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center justify-content-center" 
     style="height: 80vh; background-color: #f8f9fa; overflow: hidden;">
    <div class="card border-0 shadow-lg rounded-4 d-flex flex-row" 
         style="max-width: 900px; width: 90%; max-height: 80vh; overflow: hidden;">

        <!-- Left Panel: Logo + Title -->
        <div style="background-color: #2b4b7b; color: #ffffff; width: 45%; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem; border-top-left-radius: 0.5rem; border-bottom-left-radius: 0.5rem;">
            <img src="{{ asset('icon/CHECKLOGO-Transparent.png') }}" alt="Check Register Logo" style="width: 120px; height: auto; margin-bottom: 1rem;">
            <h3 class="fw-bold text-white text-center">Check Register System</h3>
        </div>

        <!-- Right Panel: Login Form -->
        <div style="width: 55%; padding: 2rem; display: flex; flex-direction: column; justify-content: center;">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-dark">{{ __('Login') }}</h3>
                <p class="text-muted small">Access your account</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Username -->
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Username') }}</label>
                    <input id="name" type="text"
                           class="form-control rounded-pill @error('user_name') is-invalid @enderror"
                           name="user_name" value="{{ old('user_name') }}" required autofocus>
                    @error('user_name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" type="password"
                           class="form-control rounded-pill @error('password') is-invalid @enderror"
                           name="password" required autocomplete="current-password">
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Forgot -->
                <div class="d-flex justify-content-end mb-3">
                    <a href="#" class="small text-primary text-decoration-none">
                        Forgot Password?
                    </a>
                </div>

                <!-- Login Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary rounded-pill py-2 fw-semibold">
                        {{ __('Login') }}
                    </button>
                </div>

                <!-- Register -->
                <div class="text-center mt-4">
                    <p class="small text-muted mb-0">Don’t have an account? 
                        <a href="{{ route('register') }}" class="fw-bold text-decoration-none text-primary">
                            {{ __('Sign Up') }}
                        </a>
                    </p>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection
