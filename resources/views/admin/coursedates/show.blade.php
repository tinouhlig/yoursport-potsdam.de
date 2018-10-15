@extends('admin.admin')

@section('title')
    Kurstermin
@endsection

@section('styles')
    <link rel="stylesheet" href="/vendor/datatables/jquery.dataTables.css" media="screen" title="no title" charset="utf-8">
@stop

@section('content')
    <section class="content-header">
        <h1>
            {{ $coursedate->course->name_with_details }} am {{ $coursedate->date_formated }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('admin::coursedates') }}"><i class="fa fa-calendar"></i> Kurstermine</a></li>
            <li class="active">Kurstermin {{ $coursedate->date_formated }}</li>
        </ol>
    </section>

    <section class="content">
        @include('flash::message')
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Liste aller Teilnehmer</h3>
            </div>
            <div class="box-body" id="add-Neukunde-wrapper">
                <table id="usertable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>E-Mailadresse</th>
                            <th>Telefonnummer</th>
                            <th>Aktion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coursedate->user as $user)
                            <tr>
                                <td><a href="{{ route('admin::users_show', ['user' => $user->slug]) }}">{{ $user->fullname }}</a></td>
                                <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                <td>{{ $user->phone }}</td>
                                <td><a role="button" data-toggle="modal" data-target="#kundeAustragen" data-whatever="{{ $user->fullname }}" data-link="{{ route('admin::users_coursedate_detach', ['user' => $user->slug, 'coursedate_id' => $coursedate->id]) }}"  class="btn btn-danger btn-xs">Kunde austragen &emsp;<i class="fa fa-sign-out" aria-hidden="true"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @include('admin._partials._add_dummy_to_coursedate')
            </div>
            <div class="box-footer">
                <a href="mailto:info@yoursport-potsdam.de?bcc={{ $userMails }}" class="btn btn-success">E-Mail an alle</a>
                <a role="button" data-toggle="modal" data-target="#terminAbsagen" data-whatever="{{ $coursedate->date_formated }}" data-link="{{ route('admin::coursedate_deactivate', [ 'coursedate' => $coursedate->id ]) }}" class="btn btn-danger pull-right">Kurs absagen</a>
            </div>
        </div>
        
        <div class="modal fade modal-danger" id="kundeAustragen">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">ACHTUNG! Kunde aus dem Termin austragen?</h4>
                    </div>
                    <div class="modal-body">
                        <p>Willst du den Kunden <strong></strong> wirklich aus dem Termin austragen?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Schließen</button>
                        <a href="" class="btn btn-outline" role="button"><i class="fa fa-trash-o fa-fw"></i> Austragen</a>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
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
            $("#usertable").DataTable();
        });
        $('#kundeAustragen').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var name = button.data('whatever') // Extract info from data-* attributes
            var link = button.data('link')
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            // modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body strong').text(name)
            modal.find('.modal-footer a').attr("href", link);
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
    </script>
@stop
