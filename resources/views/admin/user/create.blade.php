@extends('admin.admin')

@section('title')
    Kunde hinzufügen
@endsection

@section('content')
    <section class="content-header">
      <h1>
        Kunde hinzufügen
        <small>Anlage eines neuen Benutzers</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('admin::users') }}"><i class="fa fa-users"></i> Kundenverwaltung</a></li>
        <li class="active">Kunde hinzufügen</li>
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
                {!! Form::open(array('route' => 'admin::users_store', 'role' => 'form')) !!}
                    @include('admin._forms._user_form')
                {!! Form::close() !!}
            </div>
        </div>
    </section>

@endsection
