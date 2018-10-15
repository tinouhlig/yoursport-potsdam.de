@extends('admin.admin')

@section('title')
    Preis hinzufügen
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Preis hinzufügen
            <small>Neuen Preis erstellen</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('admin::prices') }}"><i class="fa fa-eur"></i> Finanzübersicht</a></li>
            <li class="active">Preis hinzufügen</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-10">
                @include('flash::message')
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {!! Form::open(array('route' => 'admin::prices_store', 'role' => 'form')) !!}
                    @include('admin._forms._price_form')
                {!! Form::close() !!}
            </div>
        </div>
    </section>

@endsection
