@extends('layouts.app')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center bg-light">
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-body p-5">
                <!-- Title -->
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-dark">{{ __('Create Account') }}</h3>
                    <p class="text-muted small">Fill in the details to get started</p>
                </div>

                <!-- Register Form -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Username -->
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Username') }}</label>
                        <input id="name" type="text"
                               class="form-control rounded-pill @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password"
                               class="form-control rounded-pill @error('password') is-invalid @enderror"
                               name="password" required autocomplete="new-password">
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password"
                               class="form-control rounded-pill"
                               name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <!-- Register Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary rounded-pill py-2 fw-semibold">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>

                <!-- Already have an account -->
                <div class="text-center mt-4">
                    <p class="small text-muted mb-0">Already have an account? 
                        <a href="{{ route('login') }}" class="fw-bold text-decoration-none text-primary">
                            {{ __('Login') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
