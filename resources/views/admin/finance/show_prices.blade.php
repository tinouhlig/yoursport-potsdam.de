@extends('admin.admin')

@section('title')
    Finanzübersicht
@endsection

@section('styles')
    <link rel="stylesheet" href="/vendor/datatables/jquery.dataTables.css" media="screen" title="no title" charset="utf-8">
    {{-- <link rel="stylesheet" href="/vendor/datatables/dataTables.bootstrap.css" media="screen" title="no title" charset="utf-8"> --}}
@stop

@section('content')
    <section class="content-header">
        <h1>
          Preisübersicht
            <small>Liste aller Preise</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{ route('admin::prices_dashboard') }}"><i class="fa fa-dashboard"></i> Finanz - Dashboard</a></li>
            <li class="active">Finanzen</li>
        </ol>
    </section>

    <section class="content">
        @include('flash::message')

        @if (count($prices))
            <div class="box">
              {{-- <div class="box-header">
                <h3 class="box-title">Data Table With Full Features</h3>
              </div><!-- /.box-header --> --}}
                <div class="box-body">
                    <table id="pricetable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Betrag</th>
                                <th>Laufzeit</th>
                                <th>max. Kurse pro Woche</th>
                                <th>Status</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prices as $price)
                                <tr>
                                    <td>{{$price->name}}</td>
                                    <td>{{$price->amount}}</td>
                                    <td>{{$price->duration}} {{ $price->duration_type_ger }}</td>
                                    <td>{{$price->courses_per_week}}</td>
                                    <td>{{$price->status}}</td>
                                    <td><a href="{{ route('admin::prices_show', $price->slug) }}" class="btn btn-default btn-xs center-block" role="button">Details</a></td>
                                    <td><a class="btn btn-danger btn-xs center-block" role="button" data-toggle="modal" data-target="#deleteModal" data-whatever="{{ $price->name }}" data-link="{{ route('admin::prices_delete', $price->slug) }}" ><i class="fa fa-trash-o fa-fw"></i> Löschen</a></td>
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
                <a href="{{ route('admin::prices_create') }}" title="Preis hinzufügen" class="btn btn-success pull-right" role="button"><i class="fa fa-eur fa-fw"></i> Preis hinzufügen</a>
            </div>
        </div>
        <div class="modal fade modal-danger" id="deleteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">ACHTUNG! Preis löschen?</h4>
                    </div>
                    <div class="modal-body">
                        <p>Soll der Preis <strong></strong> wirklich gelöscht werden?</p>
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
        $("#pricetable").DataTable();
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
