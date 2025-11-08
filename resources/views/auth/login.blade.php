@extends('layouts.guest')

@section('content')
<div class="main-content">
    <div class="login-container">
        <div class="login-card">
            @if($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="POST" action="{{ route('auth.authenticate')}}">
                @csrf
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn-primary">Login</button>
            </form>
            <p>Don't have an account? <a href="{{ route('auth.register') }}">Register here.</a></p>
        </div>
    </div>
</div>
@endsection