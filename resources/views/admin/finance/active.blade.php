@extends('admin.admin')

@section('title')
    laufende Verträge
@endsection

@section('styles')
    <link rel="stylesheet" href="/vendor/datatables/jquery.dataTables.css" media="screen" title="no title" charset="utf-8">
    {{-- <link rel="stylesheet" href="/vendor/datatables/dataTables.bootstrap.css" media="screen" title="no title" charset="utf-8"> --}}
@stop

@section('content')
    <section class="content-header">
        <h1>
            laufende Verträge
            <small>Liste aller Verträge ({{ $contracts->count() }})</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{ route('admin::prices_dashboard') }}"><i class="fa fa-dashboard"></i> Finanz - Dashboard</a></li>
            <li class="active">laufende Verträge</li>
        </ol>
    </section>

    <section class="content">
        @include('flash::message')
        @if ($contracts)
                <div class="box">
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name des Kunden</th>
                                    <th>Name des Vertrags</th>
                                    <th>Vertrag läuft aus am</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($contracts as $contract)
                                <tr>
                                    <td>{{ $contract->user->fullname }}</td>
                                    <td>{{ $contract->price->name }}</td>
                                    <td>{{ $contract->expire_at_formated }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        @else
            <div class="box">
                <div class="box-body">
                    <p>Keine laufenden Verträge</p>
                </div>
            </div>
        @endif
    </section>
@endsection
