@extends('layouts.guest')

@section('content')
<div class="main-content">
    <div class="container">
        <div class="card">
            <h1>Register Page</h1>
            @if($errors->any())
            <div style="color:red;">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="POST" action="{{ route('auth.register') }}">
                @csrf
                <label>Name:</label>
                <input type="text" name="name" required><br>
                <label>Email:</label>
                <input type="email" name="email" required><br>
                <label>Password:</label>
                <input type="password" name="password" required><br>
                <label>Confirm Password:</label>
                <input type="password" name="password_confirmation" required><br>
                <button type="submit" class="btn-primary">Register</button>
            </form>
            <p>Already have an account? <a href="{{ route('auth.login') }}">Login here</a>.</p>
        </div>
    </div>
</div>
@endsection