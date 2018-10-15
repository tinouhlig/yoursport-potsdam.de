@extends('admin.admin')

@section('title')
    Kundenübersicht
@endsection

@section('styles')
    <link rel="stylesheet" href="/vendor/datatables/jquery.dataTables.css" media="screen" title="no title" charset="utf-8">

@section('content')
    <section class="content-header">
        <h1>
          Kundenübersicht
            <small>Liste aller registrierten Benutzer</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Kundenverwaltung</li>
        </ol>
    </section>

    <section class="content">
        @include('flash::message')

        @if (count($users))
            <div class="box">
              {{-- <div class="box-header">
                <h3 class="box-title">Data Table With Full Features</h3>
              </div><!-- /.box-header --> --}}
                <div class="box-body">
                    <table id="usertable" class="table table-bordered table-striped" data-page-length="25">
                        <thead>
                            <tr>
                                <th>Vorname</th>
                                <th>Nachname</th>
                                <th>E-Mailadresse</th>
                                <th>Telefonnummer</th>
                                <th>Rolle</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->first_name}}</td>
                                    <td>{{$user->last_name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->user_role}}</td>
                                    <td><a href="{{ route('admin::users_show', $user->slug) }}" class="btn btn-default btn-xs center-block" role="button">Details</a></td>
                                    <td><a class="btn btn-danger btn-xs center-block" role="button" data-toggle="modal" data-target="#deleteModal" data-whatever="{{ $user->fullname }}" data-link="{{ route('admin::users_delete', $user->slug) }}" ><i class="fa fa-trash-o fa-fw"></i> Löschen</a></td>
                                    {{-- <td></td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <p>überall ist liebe</p>
        @endif
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('admin::users_create') }}" title="Benutzer hinzufügen" class="btn btn-success pull-right" role="button"><i class="fa fa-user-plus fa-fw"></i> Benutzer hinzufügen</a>
            </div>
        </div>
        <div class="modal fade modal-danger" id="deleteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">ACHTUNG! Benutzer löschen?</h4>
                    </div>
                    <div class="modal-body">
                        <p>Soll der Benutzer <strong></strong> wirklich gelöscht werden?</p>
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

    <script type="text/javascript">
      $(function () {
        $("#usertable").DataTable();
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
