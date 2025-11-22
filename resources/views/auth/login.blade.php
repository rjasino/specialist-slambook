@extends('layouts.guest')

@section('content')
<div class="main-content">
    <div class="login-container">
        <div class="login-card">
            <div class="auth-header">
                <h1>Welcome Back!</h1>
                <p class="auth-subtitle">Sign in to access your Slambook</p>
            </div>

            @if($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('auth.authenticate')}}">
                @csrf
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn-primary btn-block">Login</button>
            </form>
            <div class="auth-footer">
                <p>Don't have an account? <a href="{{ route('auth.register') }}">Register here</a></p>
            </div>
        </div>
    </div>
</div>
@endsection