@extends('admin.admin')

@section('title')
    Preise bearbeiten
@endsection

@section('styles')
    <link rel="stylesheet" href="/vendor/select2/select2.min.css" media="screen" title="no title" charset="utf-8">
@endsection

@section('content')
    <section class="content-header">
      <h1>
        Preise bearbeiten
        <small>Preise von {{ $user->fullname }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ route('admin::users') }}"><i class="fa fa-users"></i> Kundenverwaltung</a></li>
        <li><a href="{{ route('admin::users_show', $user->slug) }}"><i class="fa fa-user"></i> {{ $user->fullname }}</a></li>
        <li class="active">Preise bearbeiten</li>
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
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="box box-solid">
                    <div class="box-header with-border">
                            <h3 class="box-title">gebuchte Preise</h3>
                    </div>
                    <div class="box-body">
                        @if(count($user_prices))
                            @foreach($user_prices as $user_price)
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" >
                                        <h4 class="panel-title">
                                            <a role="button" href="{{ route('admin::prices_show', $user_price->slug) }}">{{ $user_price->name }}</a>
                                            <a href="{{ route('admin::users_prices_detach', ['user' => $user->slug, 'price_id' => $user_price->pivot->price_id, 'user_price_id' => $user_price->pivot->id]) }}" title="Preise löschen" class="btn btn-default btn-xs pull-right"><i class="fa fa-trash"></i> Preis löschen</a>
                                        </h4>
                                    </div>
                                    <div class="panel-body">
                                        {!! Form::model($user_price->pivot, array('route' => array('admin::users_prices_update', $user->slug), 'role' => 'form')) !!}
                                            {!! Form::hidden('price_id') !!}
                                            <div class="form-group">
                                                {!! Form::label('booked_at', 'gebucht am') !!}
                                                {!! Form::date('booked_at', null, ['class' => 'form-control']) !!}
                                                <p class="help-block">Pflichtfeld!</p>
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('expire_at', 'läuft aus am') !!}
                                                {!! Form::date('expire_at', null, ['class' => 'form-control']) !!}
                                                <p class="help-block">Pflichtfeld!</p>
                                            </div>
                                            <div class="checkbox">
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::checkbox('cancelled') !!} gekündigt
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                {!! Form::submit('Speichern', [ 'class' => 'form-control btn-success'] ) !!}
                                            </div>
                                        {!! Form::close() !!} 
                                    </div>
                                </div>                   
                            @endforeach
                        @else
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" >
                                    <h4 class="panel-title">der Kunde hat keine Preise gebucht</h4>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @if (count($user->participantPrices))
                <div class="box box-solid">
                    <div class="box-header with-border">
                            <h3 class="box-title">Der Kunde ist in folgende Vertrag eingetragen</h3>
                    </div>
                    <div class="box-body">
                        @foreach($user->participantPrices as $user_price)
                            <div class="panel panel-default">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <h4 class="no-margin">{{ $user_price->price->name }} <a href="{{ route('admin::users_show', $user_price->user->slug) }}"><small>von {{ $user_price->user->fullname }}</small></a></h4>
                                        </li>
                                        <li class="list-group-item">
                                            gebucht am: {{ $user_price->booked_at->format('d.m.Y') }}
                                        </li>
                                        <li class="list-group-item">
                                            läuft aus am: {{ $user_price->expire_at->format('d.m.Y') }}
                                        </li>
                                        <li class="list-group-item">
                                            <a href="{{ route('admin::users_prices_update_detach_partner', [$user->slug, $user_price->id]) }}" class="btn btn-block btn-sm btn-danger">Kunde aus Preis austragen</a>
                                        </li>
                                    </ul>
                            </div>                   
                        @endforeach
                    </div>
                </div>              
                @endif
            </div>
            <div class="col-md-4">
                <div class="box box-solid">
                    <div class="box-header with-border">
                            <h3 class="box-title">Preise buchen</h3>
                    </div>
                    <div class="box-body">
                        {!! Form::open(array('route' => array('admin::users_prices_create', $user->slug), 'role' => 'form', 'class' => 'add-price')) !!}
                            @include('admin._forms._user_price_form')
                        {!! Form::close() !!}
                    </div>
                </div>              
            </div>
            <div class="col-md-4" id="addUsertoPrice">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Kunden zu bestehenden Preis hinzufügen</h3>
                    </div>
                    <div class="box-body">
                        {!! Form::open([ 'route' => ['admin::users_prices_update_add_partner', $user->slug], 'role' => 'form']) !!}
                        <div class="form-group">
                            <select class="user-input form-control" style="width: 100%" name="user">
                                <option value=""></option>
                                <option v-for="client in clients" :value="client.slug">@{{ client.fullname }}</option>
                            </select>
                        </div>
                        <div class="form-group" v-show=" selectedClient.booked_prices.length > 0 ">
                            <select class="price-input form-control" style="width: 100%" name="price">
                                <option value=""></option>
                                <option v-for="price in selectedClient.booked_prices" :value="price.id">@{{ price.price.name }}</option>
                            </select>
                        </div>
                        <input type="submit" class="form-control btn-success" value="Speichern">
                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="/vendor/select2/select2.min.js" charset="utf-8"></script>
    <script type="text/javascript">
        $(".user-input").select2({
            placeholder: "Wähle einen Kunden",
        });
        $(".price-input").select2({
            placeholder: "Wähle einen Vertrag",
        });
        new Vue({
            el: '#addUsertoPrice',
            data: {
                clients: {},
                selectedClientSlug: null,
                selectedClient: { booked_prices: {} },
            },
            methods: {
                fetchUsers: function () {
                    $.getJSON('/api/clients/', function (clients) {
                        this.clients = clients;
                    }.bind(this));
                },
                fetchUserData: function (slug) {
                    $.getJSON('/api/clients/' + slug, function (user) {
                        this.selectedClient = user;
                        console.log('user: ',user);
                    }.bind(this));
                }
            },
            ready: function () {
                this.fetchUsers();
                $('.user-input').on('select2:select', function (evt) {
                    this.selectedClientSlug = evt.params.data.id;
                    this.fetchUserData(this.selectedClientSlug);
                }.bind(this));
            }

        });
        var prices = <?= json_encode($prices) ?>;

        $(".new_expire_at").datepicker({ dateFormat: "yy-mm-dd" ,showAnim: 'disable'});
        $(".new_booked_at").datepicker({ dateFormat: "yy-mm-dd" ,showAnim: 'disable'});
        $(".new_booked_at").datepicker("setDate",new Date());

        $('.new-price, .new_booked_at').bind('change', function () {
            var id = $(".new-price").val();
            var priceId = -1;
            for (var i = 0; i < prices.length; i++) {
                if (prices[i].id == id) {
                    priceId = i;
                    break;
                }
            }

            var expire_at = new Date($(".new_booked_at").val());
            if (prices[priceId].duration_type == 'weeks') {
                expire_at.setDate(expire_at.getDate()+(parseInt(prices[priceId].duration - 1)*7));
            } else {
                expire_at.setMonth(expire_at.getMonth()+parseInt(prices[priceId].duration));
            }
            $(".new_expire_at").datepicker("setDate",expire_at);
        });
        $('.new-price').trigger('change');
    
    </script>
@endsection

