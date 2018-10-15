@extends('admin.admin')

@section('title')
    Kursoberbegriff hinzufügen
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Kurs hinzufügen
            <small>Neuen Kursoberbegriff erstellen</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('admin::courses') }}"><i class="fa fa-list"></i> Kursverwaltung</a></li>
            <li class="active">Kursoberbegriff hinzufügen</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-5">
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
                {!! Form::open(array('route' => 'admin::coursetypes_store', 'role' => 'form')) !!}
                    @include('admin._forms._coursetype_form')
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection
