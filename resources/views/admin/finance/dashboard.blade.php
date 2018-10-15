@extends('admin.admin')

@section('title')
    Dashboard
@endsection

@section('content')
    <section class="content-header">
      <h1>
        Finanzen - Dashboard
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Finanzen - Dashboard</li>
      </ol>
    </section>

    <section class="content">
        <!-- Small boxes (Stat box) -->
        @include('flash::message')
        <div class="box">
            <div class="box-body">
                <div class="col-lg-4">
                    <a href="{{ route('admin::prices_active') }}" class="btn btn-lg btn-flat btn-success center-block">
                        Übersicht gebuchte Verträge
                        <span class="btn-helper--block small">bestehende Verträge in Bezug zum Kunden</span>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{ route('admin::prices') }}" class="btn btn-lg btn-flat btn-warning center-block">
                        Übersicht verfügbare Verträge
                        <span class="btn-helper--block small">Verwaltung der Verträge / Neue hinzufügen</span>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{ route('admin::prices_expiring') }}" class="btn btn-lg btn-flat btn-danger center-block">
                        auslaufende Verträge
                        <span class="btn-helper--block small">verlängern auslaufender Verträge / Kündigungskontrolle</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
