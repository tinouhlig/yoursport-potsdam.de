@extends('admin.admin')

@section('title')
    Kursdaten - {{ $course->name_day }}
@endsection

@section('styles')
    <link rel="stylesheet" href="/vendor/datatables/jquery.dataTables.css" media="screen" title="no title" charset="utf-8">
    {{-- <link rel="stylesheet" href="/vendor/datatables/dataTables.bootstrap.css" media="screen" title="no title" charset="utf-8"> --}}
    <link rel="stylesheet" href="/vendor/select2/select2.min.css" media="screen" title="no title" charset="utf-8">
@stop

@section('content')
    <section class="content-header">
      <h1>
        Kursdaten
        <small>Übersicht über Kurs {{ $course->name_day }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('admin::courses') }}"><i class="fa fa-users"></i> Kursverwaltung</a></li>
        <li class="active">Kursdaten - {{ $course->name_day }}</li>
      </ol>
    </section>

    <section class="content">
        @include('flash::message')
        <div class="row">
            <div class="col-md-6">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Stammdaten</h3>
                        <a href="{{ route('admin::courses_edit', $course->slug) }}" title="Kurs bearbeiten" class="btn btn-default btn-xs pull-right"><i class="fa fa-edit"></i></a>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped">
                            <tr>
                                <td>Kursoberbegriff</td>
                                <td><a href="{{ route('admin::coursetypes_show', $course->coursetype->slug) }}">{{ $course->coursetype->name }}</a></td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>{{ $course->name}}</td>
                            </tr>
                            <tr>
                                <td>Tag</td>
                                <td>{{ $course->day }}</td>
                            </tr>
                            <tr>
                                <td>Startzeit</td>
                                <td>{{ $course->time }}</td>
                            </tr>
                            <tr>
                                <td>Dauer in Minuten</td>
                                <td>{{ $course->length }}</td>
                            </tr>
                            <tr>
                                <td>max. Anz. Teilnehmer</td>
                                <td>{{ $course->max_participants }}</td>
                            </tr>
                            <tr>
                                <td>Startdatum</td>
                                <td>{{ $course->start_datum }}</td>
                            </tr>
                            <tr>
                                <td>Enddatum</td>
                                <td>{{ $course->end_datum }}</td>
                            </tr>
                            <tr>
                                <td>Trainer</td>
                                <td>{{ $course->trainer->fullname or 'kein Trainer zugeordnet' }}</td>
                            </tr>
                            <tr>
                                <td><a href="{{ route('admin::courses_edit', $course->slug) }}" class="btn btn-block btn-sm btn-default"><i class="fa fa-edit"></i> Kurs bearbeiten</a></td>
                                @if ($course->isActive())
                                    <td><a class="btn btn-block btn-sm btn-danger" role="button" data-toggle="modal" data-target="#course_deactivate">Kurs deaktivieren</a></td>
                                @else
                                    <td><a class="btn btn-block btn-sm btn-success" role="button" data-toggle="modal" data-target="#course_activate">Kurs aktivieren</a></td>
                                @endif
                                
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Kursteilnehmer</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>lfd. Nr</th>
                                    <th>Name</th>
                                    <th>E-Mail</th>
                                    <th>Vertrag</th>
                                    <th>Aktion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($course->user->count())
                                    @foreach ($course->user as $id=>$user)
                                        <tr>
                                            <td>{{ $id+1 }}</td>
                                            <td>{{ $user->fullname }}</td>
                                            <td><a class="primary-link" href="mailto:{{ $user->email}}">{{ $user->email}}</a></td>
                                            <td>{{ $user->all_prices->where('id', $user->pivot->price_user_id)->first()->price->name}}</td>
                                            <td><a href="{{ route('admin::users_show', $user->slug) }}" class="btn btn-default btn-xs">zum Kunden</a></td>
                                        </tr>
                                        <?php $id++ ?>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>keine Teilnehmer vorhanden</td>
                                    </tr>
                                @endif
                                    
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-success pull-right" href="mailto:info@yoursport-potsdam.de?bcc={{ $userMails }}">E-Mail an alle ></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Kurstermine</h3>
                    </div>
                    <div class="box-body">
                        <table id="course-coursedate-table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Datum</th>
                                    <th>Status</th>
                                    <th>Anzahl Teilnehmer</th>
                                    <th>Aktion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($course->coursedate_future as $coursedate)
                                    <tr>
                                        <td>{{ $coursedate->date_formated }}</td>
                                        <td>{{ $coursedate->status}}</td>
                                        <td>{{ $coursedate->user()->get()->count()}}</td>
                                        <td>
                                            <a class="btn btn-danger btn-xs center-block" role="button" data-toggle="modal" data-target="#coursedate_deactivate" data-link="{{ route('admin::coursedate_deactivate', $coursedate->id) }}" ><i class="fa fa-sign-out fa-fw"></i> Absagen</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="coursedate_deactivate">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">ACHTUNG! Diesen Kurs wirklich absagen?</h4>
                </div>
                <div class="modal-body">
                    <h4>Was passiert?</h4>
                    <p>Alle Teilnehmer bekommen eine Mail, dass der Kurs nicht stattfindet.</p>
                    <p>Der Trainer bekommt eine Mail, dass der Kurs nicht stattfindet.</p>
                    <p>Alle Teilnehmer bekommen einen Kurs gutgeschrieben</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Schließen</button>
                    <a href="" class="btn btn-danger" role="button"><i class="fa fa-sign-out fa-fw"></i> Jetzt Absagen</a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    @include('admin.course._deactivate_course_modal')
    @include('admin.course._activate_course_modal')
@endsection

@section('scripts')
    
    <script type="text/javascript">
        $(document).ready(function() {
            $(function () {
                $("#course-coursedate-table").DataTable({
                    "aaSorting": []
                });
            });
            $('#coursedate_deactivate').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var name = button.data('whatever') // Extract info from data-* attributes
                var link = button.data('link')
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-footer a').attr("href", link);
            });
        });
    </script>
@stop
