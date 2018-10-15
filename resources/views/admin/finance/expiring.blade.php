@extends('admin.admin')

@section('title')
    auslaufende Verträge
@endsection

@section('styles')
    <link rel="stylesheet" href="/vendor/datatables/jquery.dataTables.css" media="screen" title="no title" charset="utf-8">
    {{-- <link rel="stylesheet" href="/vendor/datatables/dataTables.bootstrap.css" media="screen" title="no title" charset="utf-8"> --}}
@stop

@section('content')
    <section class="content-header">
        <h1>
            auslaufende Verträge
            <small>Liste aller Verträge ({{ $contracts->count() }})</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{ route('admin::prices_dashboard') }}"><i class="fa fa-dashboard"></i> Finanz - Dashboard</a></li>
            <li class="active">auslaufende Verträge</li>
        </ol>
    </section>

    <section class="content">
        @include('flash::message')
        <div class="box">
            <div class="box-body">
                <p class="no-margin">Prüfe für folgende Verträge ob eine Kündigung eingegangen ist. Wenn nicht, musst du den Vertrag manuell verlängern.</p>
                <em>Es gibt derzeit noch <strong>keine</strong> automatische Verlängerung!</em>
            </div>
        </div>
        @if (!$contracts->isEmpty())
                <div class="box">
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name des Kunden</th>
                                    <th>Name des Vertrags</th>
                                    <th>Vertrag läuft aus am</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($contracts as $contract)
                                <tr>
                                    <td><a href="{{ route('admin::users_show', ['user' => $contract->user->slug]) }}">{{ $contract->user->fullname }}</a></td>
                                    <td>{{ $contract->price->name }}</td>
                                    <td>{{ $contract->expire_at->format('d.m.Y') }}</td>
                                    <td><a href="{{ route('admin::prices_expiring_extend', ['booked_price' => $contract->id]) }}" class="btn btn-flat btn-xs btn-success center-block">verlängern</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        @else
            <div class="box">
                <div class="box-body">
                    <p>Keine auslaufenden Verträge</p>
                </div>
            </div>
        @endif
    </section>
@endsection
