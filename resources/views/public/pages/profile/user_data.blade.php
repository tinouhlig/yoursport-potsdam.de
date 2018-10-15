@extends('public.pages.profile.index')

@section('title')
    Persönliche Daten
@endsection

@section('content')

    <!-- Page Content -->
    <section id="user-data">
        <div class="row text-center">
            <div class="col-lg-12">
                <h2>Persönliche Daten</h2>
                <hr class="hr-primary">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @include('flash::message')
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <div class="user-stammdaten">
                    <p>Datenübersicht</p>
                    <hr class="hr-primary">
                    <table class="profile-user_data-stammdaten">
                        <tr>
                            <td>Vorname:</td>
                            <td>{{ $user->first_name }}</td>
                        </tr>
                        <tr>
                            <td>Nachname:</td>
                            <td>{{ $user->last_name }}</td>
                        </tr>
                        <tr>
                            <td>E-Mailadresse:</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>Telefonnummer:</td>
                            <td>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <td><a href="#" class="btn button-primary text-center" @click.prevent="showUserDataModal">Daten Bearbeiten</a></td>
                            <td><a href="#" class="btn button-primary text-center" @click.prevent="showChangePasswordModal">Passwort ändern</a></td>
                        </tr>
                    </table>
                </div>
            </div>
            <changeuserdatamodal :show.sync="showUserData"></changeuserdatamodal>
            <changepasswordmodal :show.sync="showChangePassword"></changepasswordmodal>
            @include('public._partials._vue-components._user_data')
            {{-- <div class="col-md-6">
                <div class="col-lg-6 col-lg-offset-3">
                    @include('flash::message')
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul class="profile-error-list">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {!! Form::open(array('route' => 'profile::save_password', 'role' => 'form')) !!}
                        <div class="form-group">
                            {!! Form::label('old_password', 'Altes Passwort') !!}
                            {!! Form::password('old_password', ['class' => 'form-control', 'required' => 'required' ] ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', 'Neues Passwort') !!}
                            {!! Form::password('password', ['class' => 'form-control', 'required' => 'required' ] ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password_confirm', 'Neues Passwort wiederholen') !!}
                            {!! Form::password('password_confirmation', ['class' => 'form-control', 'required' => 'required' ] ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Speichern', [ 'class' => 'form-control btn button-primary'] ) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div> --}}
        </div>
    </section>
    <!-- /#page-content-wrapper -->
@endsection
