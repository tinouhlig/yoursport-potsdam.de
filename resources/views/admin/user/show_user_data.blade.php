@extends('admin.admin')

@section('title')
    Kundendaten
@endsection

@section('styles')
    <link rel="stylesheet" href="/vendor/select2/select2.min.css" media="screen" title="no title" charset="utf-8">
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Kundedaten
            <small>Übersicht über Benutzer {{ $user->fullname }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('admin::users') }}"><i class="fa fa-users"></i> Kundenverwaltung</a></li>
            <li class="active">Kundendaten</li>
        </ol>
    </section>

    <section class="content">
        @include('flash::message')
        <div class="row">
            {{-- START - Stammdaten --}}
            <div class="col-lg-4">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Stammdaten</h3>
                        <a href="{{ route('admin::users_edit', $user->slug) }}" title="Benutzer bearbeiten" class="btn btn-default btn-xs pull-right"><i class="fa fa-edit"></i> Bearbeiten</a>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped">
                            <tr>
                                <td>Vorname</td>
                                <td>{{ $user->first_name }}</td>
                            </tr>
                            <tr>
                                <td>Nachname</td>
                                <td>{{ $user->last_name }}</td>
                            </tr>
                            <tr>
                                <td>E-Mailadresse</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td>Telefonnummer</td>
                                <td>{{ $user->phone }}</td>
                            </tr>
                            <tr>
                                <td>Rolle</td>
                                <td>{{ $user->user_role }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            {{-- ENDE - Stammdaten --}}

            {{-- START - gebuchte Preise --}}
            <div class="col-lg-4">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        @if ($user->is_aktive)
                            <h3 class="box-title">gebuchte Preise</h3>
                            <a href="{{ route('admin::users_prices_edit', $user->slug) }}" title="Preise bearbeiten" class="btn btn-default btn-xs pull-right"><i class="fa fa-plus"></i> Preis buchen/bearbeiten</a>
                        @else
                            <h3 class="box-title">gebuchte Preise | Benutzer inaktiv</h3>
                        @endif
                    </div>
                    <div class="box-body">
                        @if(count($user->bookedPrices) or count($user->participantPrices))
                            @foreach($user->bookedPrices as $price)
                                <table class="table">
                                    <thead>
                                        <tr><td colspan="2"><a href="{{ route('admin::prices_show', $price->price->slug) }}">{{ $price->price->name }}</a></td></tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>gebucht am:</td>
                                            <td>{{ $price->booked_at->format('d.m.Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td>läuft bis zum:</td>
                                            <td>{{ $price->expire_at->format('d.m.Y') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endforeach
                            @foreach($user->participantPrices as $price)
                                <table class="table">
                                    <thead>
                                        <tr><td colspan="2"><a href="{{ route('admin::users_show', $price->user->slug) }}">{{ $price->price->name }} von {{ $price->user->fullname }}</a></td></tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>gebucht am:</td>
                                            <td>{{ $price->booked_at->format('d.m.Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td>läuft bis zum:</td>
                                            <td>{{ $price->expire_at->format('d.m.Y') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endforeach
                        @else
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" >
                                    <h4 class="panel-title">keine Preise gebucht</h4>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            {{-- ENDE - gebuchte Preise --}}

            {{-- START - gebuchte Kurse --}}
            <div class="col-lg-4">
                <div class="box box-solid">
                    @if(count($user->price) or count($user->participantPrices))
                        <div class="box-header with-border">
                            <h3 class="box-title">gebuchte Kurse</h3>
                        </div>
                        <div class="box-body">
                            @if (count($user->course))
                                @foreach($user->course as $course)
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" >
                                            <h4 class="panel-title">{{ $course->name_with_details }}
                                            <a href="{{ route('admin::users_courses_detach', ['user' => $user->slug, 'course_id' => $course->id]) }}" title="Kunde austragen" class="btn btn-default btn-xs pull-right"><i class="fa fa-sign-out"></i> austragen</a></h4>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" >
                                        <h4 class="panel-title">keine Kurse gebucht</h4>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="box-footer">
                            @if ($user->is_aktive)
                                {!! Form::open(array('route' => array('admin::users_courses_create', $user->slug), 'role' => 'form')) !!}
                                    <div class="form-group">
                                        <p class="help-block">Preis wählen!</p>
                                        @foreach ($user->price as $price)
                                            <div class="radio">
                                                <label><input type="radio" name="price_user_id" value="{{ $price->pivot->id }}">{{ $price->name }}</label>
                                            </div>
                                        @endforeach
                                        @foreach ($user->participantPrices as $price)
                                            <div class="radio">
                                                <label><input type="radio" name="price_user_id" value="{{ $price->id }}">{{ $price->price->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <p class="help-block">Kurse wählen!</p>
                                        {!! Form::select('course_id[]', $courses, null, ['class' => 'form-control multipleselect', 'multiple' => 'multiple']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::submit('Speichern', [ 'class' => 'form-control btn-success'] ) !!}
                                    </div>
                                {!! Form::close() !!}
                            @else
                                <em>Benutzer ist inaktiv</em>
                            @endif
                        </div>
                    @else
                        <div class="box-header with-border">
                            <h3 class="box-title">Du musst erst einen Preis buchen um den Kunden in einen Kurs eintragen zu können</h3>
                        </div>
                    @endif
                </div>
            </div>
            {{-- ENDE - gebuchte Kurse --}}
        </div>

        <div class="row">
            <div class="col-md-6">
                @if (count($user->coursedate()->coming()->get()))
                <div class="box">
                    <div class="box-body">
                        <table id="coursedatetable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Kurs</th>
                                    <th>Datum</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->coursedate()->coming()->get() as $coursedate)
                                    <tr>
                                        <td>{{$coursedate->course->name_with_details}}</td>
                                        <td>{{$coursedate->date_formated}}</td>
                                        <td><a class="btn btn-danger btn-xs center-block" role="button" data-toggle="modal" href="{{ route('admin::users_coursedate_detach', ['user' => $user->slug, 'coursedate_id' => $coursedate->id]) }}" ><i class="fa fa-sign-out fa-fw"></i> austragen</a></td>
                                        {{-- <td></td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-6">
                @if (count($user->nachholkurse()->gueltig()->get()))
                    <div class="box">
                        <div class="box-body">
                            <table id="nacholkursetable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nummer</th>
                                        <th>gültig bis</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->nachholkurse()->gueltig()->get() as $index => $nachholkurs)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ $nachholkurs->gueltig_bis_formated }}</td>
                                            <td><a href="{{ route('admin::users_nachholkurs_detach', ['user' => $user->slug, 'nachholkurs_id' => $nachholkurs->id]) }}" class="btn btn-danger btn-xs center-block"><i class="fa fa-trash fa-fw"></i>Löschen</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer">
                            <a href=" {{ route('admin::coursedates_user', $user->slug) }} " class="btn btn-default center-block m-t-10">Kunde zum Nachholen eintragen</a>
                        </div>
                    </div>
                @endif
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Nachholkurs hinzufügen</h3>
                    </div>
                    <div class="box-body">
                        {!! Form::open(array('route' => array('admin::users_nachholkurs_create', $user->slug), 'role' => 'form')) !!}
                            <div class="form-group">
                                {!! Form::label('gueltig_bis', 'Gültig bis') !!}
                                {!! Form::date('gueltig_bis', null, ['class' => 'form-control gueltig_bis', 'required' => 'required']) !!}
                                <p class="help-block">Pflichtfeld!</p>
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Speichern', [ 'class' => 'form-control btn-success'] ) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection

@section('scripts')
    <script src="/vendor/select2/select2.min.js" charset="utf-8"></script>
    <script type="text/javascript">
        $(".multipleselect").select2();
        $(".gueltig_bis").datepicker({ dateFormat: "yy-mm-dd" ,showAnim: 'disable'});
    </script>
 @endsection
