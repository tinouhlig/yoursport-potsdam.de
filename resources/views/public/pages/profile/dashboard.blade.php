@extends('public.pages.profile.index')

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
            @if ($user->nachholkurse()->gueltig()->get()->count() > 0)
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <p class="text-primary">Du kannst aktuell {{ $user->nachholkurse()->gueltig()->get()->count() }} Kurse nachholen.</p>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-xs-6 col-md-3 col-md-offset-3 text-center">
                    <a href="#profil-kurse" class="btn button-primary page-scroll width-200 width-xs-auto">Deine Kurse ></a>
                </div>
                <div class="col-xs-6 col-md-3 text-center">
                    <a href="#profil-stammdaten" class="btn button-primary page-scroll width-200 width-xs-auto">Deine Stammdaten ></a>
                </div>
            </div>
        </div>
    </section>

    @if (count($user->course))
    <section id="profil-kurse" class="bg-tafel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="light-heading">Deine Kurse</h2>
                    <hr class="hr-primary">
                </div>
            </div>
            <div class="row text-light">
                <div class="profile-kurs-wrapper">
                    <div class="profile-kurs-item">
                        <div class="profile-kurs-item-header">
                            <h4 class="light-heading">Deine gebuchten Kurse</h4>
                            <hr class="hr-primary">
                        </div>
                        <ol class="profile-dashboard-kursliste">
                            @foreach ($user->course as $kurs)
                                <li>{{ $kurs->name_kursplan }} am {{ $kurs->day }} um {{ $kurs->time }}</li>
                            @endforeach
                        </ol>
                    </div>
                    <div class="profile-kurs-item">
                        <div class="profile-kurs-item-header">
                            <h4 class="section-heading">kommende Kurstermine</h4>
                            <hr class="hr-primary">
                        </div>
                        <ol class="profile-dashboard-kursliste">
                            @foreach ($user->coming_coursedates as $kurstermin)
                                <li>
                                    {{ $kurstermin->course->name_kursplan }} am {{ $kurstermin->date_formated }} um {{ $kurstermin->course->time }}
                                    <a  href="{{ route('profile::coursedate_detach', [ 'coursedate_id' => $kurstermin->id ]) }}" 
                                        class="btn profile-dashboard-button" @click.prevent="showKursabmeldungModal"
                                        data-toggle="tooltip" title="Aus dem Kurs austragen"
                                    >
                                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                                    </a>
                                </li>
                            @endforeach
                        </ol>
                        <div class="kurstermin-info-cta">
                            <a href="{{ route('profile::user_coursedates') }}" class="btn button-primary">Alle Trainingstermine ></a>
                        </div>
                    </div>
                    @if ($user->nachholkurse()->gueltig()->get()->count() > 0)
                        <div class="profile-kurs-item">
                            <div class="profile-kurs-item-header">
                                <h4 class="section-heading">Deine Nachholkurse</h4>
                                <hr class="hr-primary">
                            </div>
                            <ol class="profile-dashboard-kursliste">
                                @foreach ($user->nachholkurse()->gueltig()->get()->sortBy('gueltig_bis') as $kurs)
                                    <li>
                                        gültig bis {{ $kurs->gueltig_bis_formated }}
                                        <a href="{{ route('kursplan') }}" class="btn btn-sm button-primary profile-dashboard-button">
                                            Kurs auswählen
                                        </a>
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @else
    <section id="profil-kurse" class="bg-tafel">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="light-heading">Du hast zur Zeit keinen Kurs gebucht</h2>
                    <hr class="hr-primary">
                </div>
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
                <div class="col-md-6">
                    <h4 class="primary-heading">Deine Benutzerdaten</h4>
                    <hr class="hr-primary">
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
                @if (count($user->price))
                    <div class="col-md-6">
                        <h4 class="primary-heading">Deine Vertragsdaten</h4>
                        <hr class="hr-primary">
                        <table class="profile-dashboard-table">
                            <tr>
                                <td>Name: </td>
                                <td>{{ $user->price->first()->name }}</td>
                            </tr>
                            <tr>
                                <td>gebucht am:</td>
                                <td> {{ Carbon\Carbon::createFromFormat('Y-m-d', $user->price->first()->pivot->booked_at)->format('d.m.Y') }} </td>
                            </tr>
                        </table>
                    </div>
                @endif
            </div>
        </div> <!-- ende Stammdaten Container -->
    </section>
    <kursabmeldungmodal :show.sync="showModal" :link="linkKursabmeldung"></kursabmeldungmodal>
    <changeuserdatamodal :show.sync="showUserData"></changeuserdatamodal>
    <changepasswordmodal :show.sync="showChangePassword"></changepasswordmodal>

    @include('public._partials._vue-components._profile-dashboard')
@endsection
