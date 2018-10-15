@extends('admin.admin')

@section('title')
    Kunde bearbeiten
@endsection

@section('content')
    <section class="content-header">
      <h1>
        Stammdaten bearbeiten
        <small>Stammdaten von {{ $user->fullname }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('admin::users') }}"><i class="fa fa-users"></i> Kundenverwaltung</a></li>
        <li><a href="{{ route('admin::users_show', $user->slug) }}"><i class="fa fa-user"></i> {{ $user->fullname }}</a></li>
        <li class="active">Kunde bearbeiten</li>
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
                {!! Form::model($user, array('route' => array('admin::users_update', $user->slug), 'role' => 'form')) !!}
                    @include('admin._forms._user_form')
                {!! Form::close() !!}
            </div>
        </div>
    </section>

@endsection
