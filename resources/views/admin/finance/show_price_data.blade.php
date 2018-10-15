@extends('admin.admin')

@section('title')
    Preisdaten
@endsection

@section('styles')
    <link rel="stylesheet" href="/vendor/datatables/jquery.dataTables.css" media="screen" title="no title" charset="utf-8">
@stop

@section('content')
    <section class="content-header">
        <h1>
          Preisdaten
            <small>{{ $price->name }}</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li><a href="{{ route('admin::prices') }}"><i class="fa fa-eur"></i> Preisübersicht</a></li>
        <li class="active">{{ $price->name }}</li>
        </ol>
    </section>

    <section class="content">
        @include('flash::message')
        <div class="col-md-4">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Stammdaten</h3>
                    <a href="{{ route('admin::prices_edit', $price->slug) }}" title="Preis bearbeiten" class="btn btn-default btn-xs pull-right"><i class="fa fa-edit"></i> Bearbeiten</a>
                </div>
                <div class="box-body">
                    <table class="table table-striped">
                        <tr>
                            <td>Name</td>
                            <td>{{ $price->name}}</td>
                        </tr>
                        <tr>
                            <td>Betrag</td>
                            <td>{{ $price->amount_ger }}</td>
                        </tr>
                        <tr>
                            <td>Laufzeit</td>
                            <td>{{ $price->duration }} {{ $price->duration_type_ger }}</td>
                        </tr>
                        <tr>
                            <td>max. Kurse pro Woche</td>
                            <td>{{ $price->courses_per_week }}</td>
                        </tr>
                        <tr>
                            <td>Vertragsverlängerung in Monaten</td>
                            <td>{{ $price->contract_extension or '' }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>{{ $price->status }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

