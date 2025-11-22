@extends('layouts.guest')

@section('content')
<div class="main-content">
    <div class="login-container">
        <div class="login-card">
            <div class="auth-header">
                <h1>Join Our Slambook!</h1>
                <p class="auth-subtitle">Create an account to share your story</p>
            </div>

            @if($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('auth.register') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your full name"
                        value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email"
                        value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Minimum 6 characters" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Re-enter your password" required>
                </div>
                <button type="submit" class="btn-primary btn-block">Create Account</button>
            </form>
            <div class="auth-footer">
                <p>Already have an account? <a href="{{ route('auth.login') }}">Login here</a></p>
            </div>
        </div>
    </div>
</div>
@endsection