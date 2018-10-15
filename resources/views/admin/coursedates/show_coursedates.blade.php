@extends('admin.admin')

@section('title')
    Kurstermine
@endsection

@section('styles')
    <link rel="stylesheet" href="/vendor/datatables/jquery.dataTables.css" media="screen" title="no title" charset="utf-8">
    {{-- <link rel="stylesheet" href="/vendor/datatables/dataTables.bootstrap.css" media="screen" title="no title" charset="utf-8"> --}}
@stop

@section('content')
    <section class="content-header">
        <h1>
          Kursterminübersicht
            <small>Liste aller Kurstermine</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Kurstermine</li>
        </ol>
    </section>

    <section class="content">
        @include('flash::message')
        @if (isset($user))
            <div class="box">
                <div class="box-body">
                    <em>Nachholkurs für <a href="{{ route('admin::users_show', $user->slug) }}">{{ $user->full_name }}</a></em>
                </div>
            </div>
        @endif
        @if (count($coursedates))
            <div class="box">
                <div class="box-body">
                    <table id="coursedatetable" class="table table-bordered table-striped" data-page-length="25">
                        <thead>
                            <tr>
                                <th>Kursname</th>
                                <th>Datum</th>
                                <th>Anzahl Teilnehmer</th>
                                <th>Zum Termin</th>
                                <th>Deaktivieren</th>
                                @if ( isset($user) )
                                    <th>Aktion</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($coursedates as $coursedate)
                                <tr>
                                    <td><a href="{{ route('admin::coursedates_show', ['coursedate' => $coursedate->id]) }}">{{$coursedate->course->name_with_details}}</a></td>
                                    <td>{{$coursedate->date_formated}}</td>
                                    <td>{{$coursedate->user->count()}} / {{$coursedate->course->max_participants}}</td>
                                    <td><a class="btn btn-default btn-sm" href="{{ route('admin::coursedates_show', ['coursedate' => $coursedate->id]) }}">Zum Termin</a></td>
                                    <td><a role="button" data-toggle="modal" data-target="#terminAbsagen" data-whatever="{{ $coursedate->date_formated }}" data-link="{{ route('admin::coursedate_deactivate', [ 'coursedate' => $coursedate->id ]) }}" class="btn btn-danger btn-sm">Kurs absagen</a></td>
                                    @if ( isset($user) )
                                        @if (!$user->coursedate()->find($coursedate->id))
                                            <td><a href="{{ route('admin::users_coursedate_attach', ['user' => $user->slug, 'coursedate_id' => $coursedate->id]) }}" class="btn btn-default btn-sm">Kunde in Kurs eintragen</a></td>
                                        @else
                                            <td></td>
                                        @endif
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <p>Keine Kurse vorhanden</p>
        @endif
        <div class="modal fade modal-danger" id="terminAbsagen">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">ACHTUNG! Termin absagen?</h4>
                    </div>
                    <div class="modal-body">
                        <p>Willst du den Termin am <strong></strong> wirklich absagen?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Schließen</button>
                        <a href="" class="btn btn-outline" role="button"><i class="fa fa-trash-o fa-fw"></i> Termin absagen</a>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </section>
@endsection

@section('scripts')
    <script type="text/javascript">
      $(document).ready(function() {
        $("#coursedatetable").DataTable({
            'bSort': false
        });
        $('#terminAbsagen').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var date = button.data('whatever') // Extract info from data-* attributes
            var link = button.data('link')
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            // modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body strong').text(date)
            modal.find('.modal-footer a').attr("href", link);
        });
      });
    </script>
@stop
