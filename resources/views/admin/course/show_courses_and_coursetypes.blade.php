@extends('admin.admin')

@section('title')
    Kursübersicht
@endsection

@section('styles')
    <link rel="stylesheet" href="/vendor/datatables/jquery.dataTables.css" media="screen" title="no title" charset="utf-8">
    {{-- <link rel="stylesheet" href="/vendor/datatables/dataTables.bootstrap.css" media="screen" title="no title" charset="utf-8"> --}}
@stop

@section('content')
    <section class="content-header">
        <h1>
          Kursübersicht
            <small>Liste aller Kurse</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Kursverwaltung</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                    <a href="{{ route('admin::courses') }}" type="button" id="coursetable-button" class="btn btn-default">Kurse</a>
                    <a href="{{ route('admin::coursetypes') }}" type="button" id="coursetypetable-button" class="btn btn-default">Kursoberbegriffe</a>
            </div>
        </div>
        @include('flash::message')
        <div class="row">
            <div class="col-md-6 col-md-offset-6">
                <div class="box">
                    <div class="btn-group btn-group-justified" role="group" aria-label="...">
                        <a href="{{ route('admin::courses_create') }}" title="Kurs hinzufügen" class="btn btn-success" role="button"><i class="fa fa-plus fa-fw"></i> Kurs hinzufügen</a>
                        <a href="{{ route('admin::coursetypes_create') }}" title="Kurs hinzufügen" class="btn btn-success" role="button"><i class="fa fa-plus fa-fw"></i> Kursoberbegriff hinzufügen</a>
                    </div>
                </div>
            </div>
        </div>
        @if(Route::current()->getName() == 'admin::courses')
            @include('admin._partials._coursetable')
        @elseif(Route::current()->getName() == 'admin::coursetypes')
            @include('admin._partials._coursetypetable')
        @else
            <p>Etwas ist schief gelaufen. Bitte überprüfe den Link</p>
        @endif
        <div class="modal fade modal-danger" id="deleteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">ACHTUNG! Kurs/Kursoberbegriff löschen?</h4>
                    </div>
                    <div class="modal-body">
                        <p>Soll der Kurs/Kursoberbegriff <strong></strong> wirklich gelöscht werden?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Schließen</button>
                        <a href="" class="btn btn-outline" role="button"><i class="fa fa-trash-o fa-fw"></i> Löschen</a>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </section>
@endsection

@section('scripts')
    {{-- <script src="/vendor/datatables/dataTables.bootstrap.min.js" charset="utf-8"></script>
    <script src="/vendor/datatables/jquery.dataTables.min.js" charset="utf-8"></script> --}}

    <script type="text/javascript">
      $(function () {
        $("#coursetable").DataTable();
      });
      $('#deleteModal').on('show.bs.modal', function (event) {
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
    </script>
@stop
