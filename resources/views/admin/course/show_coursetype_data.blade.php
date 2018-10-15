@extends('admin.admin')

@section('title')
    Kursoberbegriff - {{ $coursetype->name }}
@endsection

@section('content')
    <section class="content-header">
      <h1>
        Kursoberbegriff
        <small>Übersicht über Kursoberbegriff </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('admin::coursetypes') }}"><i class="fa fa-users"></i> Kursverwaltung</a></li>
        <li class="active">Kursoberbegriff</li>
      </ol>
    </section>

    <section class="content">
        @include('flash::message')
        <div class="row">
            <div class="col-md-4">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Stammdaten</h3>
                        <a href="{{ route('admin::coursetypes_edit', $coursetype->slug) }}" title="Benutzer bearbeiten" class="btn btn-default btn-xs pull-right"><i class="fa fa-edit"></i> Bearbeiten</a>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped">
                            <tr>
                                <td>Name</td>
                                <td>{{ $coursetype->name }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>{{ $coursetype->status }}</td>
                            </tr>
                            <tr>
                                <td>Beschreibung</td>
                                <td>{!! nl2br($coursetype->description) !!}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-solid">
                    <div class="box-header with-border">
                            <h3 class="box-title">zugeordnete Preise</h3>
                            <a href="#" title="Benutzer bearbeiten" class="btn btn-default btn-xs pull-right"><i class="fa fa-plus"></i> neuen Preis zuordnen</a>
                    </div>
                    <div class="box-body">
                        <div class="list-group">
                        @if(count($prices))
                            @foreach($prices as $price)
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" >
                                        <h4 class="panel-title"><a role="button" href="{{ route('admin::prices_show', $price->slug) }}">{{ $price->name }}</a></h4>
                                    </div>
                                </div>                             
                            @endforeach
                        @else
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" >
                                    <h4 class="panel-title">keine Preise zugeordnet</h4>
                                </div>
                            </div>
                        @endif
                        </div>
                    </div>
                </div>              
            </div>
            <div class="col-md-4">
                <div class="box box-solid">
                    <div class="box-header with-border">
                            <h3 class="box-title">zugeordnete Kurse</h3>
                            <a href="{{ route('admin::courses_create') }}" title="Kurs anlegen" class="btn btn-default btn-xs pull-right"><i class="fa fa-plus"></i> neuen Kurs anlegen</a>
                    </div>
                    <div class="box-body">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                @if(count($courses))
                                    @foreach($courses as $course)
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="heading{{$course->id}}">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#{{ $course->id }}" aria-expanded="true" aria-controls="{{ $course->id }}">
                                                        {{ $course->name_day }}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="{{ $course->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$course->id}}">
                                                <div class="panel-body">
                                                    {{ $course->name }}<br>
                                                    {{ $course->day }}<br>
                                                    {{ $course->start_datum }} - {{ $course->end_datum }}<br>
                                                    {{ $course->start_end_time }}<br><br>
                                                    <a class="btn btn-default" href="{{ route('admin::courses_show', $course->slug) }}"> zum Kurs </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" >
                                            <h4 class="panel-title">keine Kurse zugeordnet</h4>
                                        </div>
                                    </div>
                                @endif
                        </div>
                    </div>
                </div>              
            </div>
        </div>
    </section>
@endsection
