@extends('admin.admin')

@section('title')
    Kurs bearbeiten
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Kurs bearbeiten
            <small>{{ $course->name_day }} bearbeiten</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('admin::courses') }}"><i class="fa fa-list"></i> Kursverwaltung</a></li>
            <li><a href="{{ route('admin::courses_show', $course->slug) }}"><i class="fa fa-list"></i> {{ $course->name_day }}</a></li>
            <li class="active">Kurs bearbeiten</li>
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
                {!! Form::model($course, array('route' => array('admin::courses_update', $course->slug), 'role' => 'form')) !!}
                    @include('admin._forms._course_form')
                {!! Form::close() !!}
            </div>
        </div>
    </section>
@endsection


