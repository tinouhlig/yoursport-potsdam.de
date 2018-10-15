@extends('public.index')

@section('title')
    Passwort aktualisieren
@endsection

@section('content')
    <div class="container">
        <section class="reset">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Passwort aktualisieren</h2>
                    <hr class="hr-primary">
                </div>
            </div>
            <div class="row">
                <div class="kontakt-form">
                    {!! Form::open(array('route' => 'post_reset_token', 'role' => 'form')) !!}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            {!! Form::label('email', 'E-Mailadresse') !!}
                            {!! Form::email('email', null, [ 'class' => 'form-control', 'required' => 'required' ] ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', 'Passwort') !!}
                            {!! Form::password('password',[ 'class' => 'form-control', 'required' => 'required' ] ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password_confirmation', 'Passwort wiederholen') !!}
                            {!! Form::password('password_confirmation',[ 'class' => 'form-control', 'required' => 'required' ] ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Passwort aktualisieren', [ 'class' => 'form-control btn button-primary'] ) !!}
                        </div>
                        {!! Form::text('spam_filter', null, [ 'class' => 'input-hidden']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </section>
    </div>
@endsection