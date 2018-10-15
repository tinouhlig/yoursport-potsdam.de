@extends('admin.admin')

@section('title')
    Kursoberbegriff
@endsection

@section('content')
    <section class="content-header">
      <h1>
        Kursoberbegriff
        <small>Übersicht über Kursoberbegriff {{ $coursetype->name }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('admin::coursetypes') }}"><i class="fa fa-list"></i> Kursverwaltung</a></li>
        <li><a href="{{ route('admin::coursetypes_show', $coursetype->slug) }}"><i class="fa fa-list"></i> {{ $coursetype->name }}</a></li>
        <li class="active">Kursoberbegriff</li>
      </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
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
                {!! Form::model($coursetype, array('route' => array('admin::coursetypes_update', $coursetype->slug), 'role' => 'form')) !!}
                    @include('admin._forms._coursetype_form')
                {!! Form::close() !!}
            </div>
        </div>
    </section>

@endsection
