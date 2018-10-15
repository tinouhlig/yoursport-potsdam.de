@extends('trainer.index')

@section('title')
    Dashboard
@endsection

@section('content')

    <!-- Page Content -->
    <section id="profil-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Hallo {{ $user->first_name }}</h2>
                    <hr class="hr-primary">
                </div>
            </div>
        </div>
    </section>

    @if (!$coursedates->isEmpty())
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">Übersicht kommender Kurstermine</h2>
                        <hr class="hr-primary">
                    </div>
                </div>
                <div class="row">
                    @foreach ($coursedates as $day => $coursedatesPerDay)
                        <div class="col-md-6">
                            <div class="panel panel-default text-center">
                                <div class="panel-heading"><h4>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $day)->format('d.m.Y') }} </h4></div>
                                <div class="panel-body">
                                    @foreach ($coursedatesPerDay as $coursedate)
                                        <table class="table no-border">
                                            <tbody>
                                                <tr>
                                                    <td>Kurs:</td>
                                                    <td>{{ $coursedate->course->name_with_details }}</td>
                                                    <td><a href="{{ route('trainer::show_coursedate', [ 'coursedate' => $coursedate->id ]) }}" class="btn btn-xs">Zum Kurs</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Teilnehmer:</td>
                                                    <td>{{ $coursedate->user_count }} / {{ $coursedate->course->max_participants }}</td>
                                                    <td><a href="mailto:{{ $coursedate->mail_list }}" class="btn btn-xs">Mail an Teilnehmer</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        @if ($coursedatesPerDay->count() > 1)
                                            <hr>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section id="profil-stammdaten">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="primary-heading">Deine Stammdaten</h2>
                    <hr class="hr-primary">
                </div>
            </div>
            <div class="row text-center">
                <div class="col-lg-12">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="col-md-6 col-md-offset-3">
                    <table class="profile-dashboard-table">
                        <tr>
                            <td>Name: </td>
                            <td>{{ $user->fullname }}</td>
                        </tr>
                        <tr>
                            <td>E-Mailadresse:</td>
                            <td> {!! $user->email !!} </td>
                        </tr>
                        <tr>
                            <td>Telefonnummer:</td>
                            <td> {!! $user->phone !!} </td>
                        </tr>
                        <tr>
                            <td><a href="#" class="btn button-primary text-center" @click.prevent="showUserDataModal">Daten Bearbeiten</a></td>
                            <td><a href="#" class="btn button-primary text-center" @click.prevent="showChangePasswordModal">Passwort ändern</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div> <!-- ende Stammdaten Container -->
    </section>
    <changeuserdatamodal :show.sync="showUserData"></changeuserdatamodal>
    <changepasswordmodal :show.sync="showChangePassword"></changepasswordmodal>

    @include('trainer.partials._modals')
@endsection
