@extends('public.index')

@section('title')
    LogIn
@endsection

@section('content')
    <section id="login">
        <form method="POST" action="/auth/login">
            {!! csrf_field() !!}
            <div>
                Email
                <input type="email" name="email" value="{{ old('email') }}">
            </div>

            <div>
                Password
                <input type="password" name="password" id="password">
            </div>

            <div>
                <input type="checkbox" name="remember"> Remember Me
            </div>

            <div>
                <button type="submit">Login</button>
            </div>
        </form>
        <a href="{{ route('register') }}">Register</a>
    </section>
@endsection