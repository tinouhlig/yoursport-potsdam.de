@extends('public.index')

@section('title')
    Login
@endsection

@section('content')
    <section id="login">
        <div class="login-form">
            {!! Form::open(array('route' => 'post_login', 'role' => 'form')) !!}
                <div class="form-group">
                    {!! Form::label('email', 'E-Mailadresse') !!}
                    {!! Form::email('email', null, [ 'class' => 'form-control'] ) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Passwort') !!}
                    {!! Form::password('password', [ 'class' => 'form-control'] ) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Login', [ 'class' => 'form-control button-primary'] ) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </section>
@endsection
