@extends('admin.admin')

@section('title')
    Kurs erstellen
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Kurs hinzufügen
            <small>Neuen Kurs erstellen</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('admin::courses') }}"><i class="fa fa-list"></i> Kursverwaltung</a></li>
            <li class="active">Kurs hinzufügen</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
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
                {!! Form::open(array('route' => 'admin::courses_store', 'role' => 'form')) !!}
                    @include('admin._forms._course_form')
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection

