@extends('admin.admin')

@section('title')
    Dashboard
@endsection

@section('content')
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
      </ol>
    </section>

    <section class="content">
        <!-- Small boxes (Stat box) -->
        @include('flash::message')
        @if ($expiring_contracts > 0)
            <div class="row">
                <div class="col-lg-12">
                <div class="box bg-danger">
                    <div class="box-body">
                        <h4 class="box-title">
                            Achtung! Du hast auslaufende Verträge zu prüfen ( {{ $expiring_contracts }} )
                            <a href="{{ route('admin::prices_expiring') }}" class="btn btn-default m-l-20">Zu den Verträgen</a>
                        </h4>
                    </div>
                </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-4 col-xs-6">
            <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $users->count() }}</h3>
                        <p>aktive Teilnehmer</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                    <a href="{{ route('admin::users') }}" class="small-box-footer">Kundenübersicht <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
            <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ $courses->count() }}</h3>
                        <p>aktive Kurse</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                    </div>
                    <a href="{{ route('admin::courses') }}" class="small-box-footer">Kursübersicht <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-4 col-xs-6">
            <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ round($monatliche_einnahmen) }} €</h3>
                        <p>monatl. Einnahmen durch Verträge</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-line-chart" aria-hidden="true"></i>
                    </div>
                    <a href="" class="small-box-footer">Finanzübersicht <i class="fa fa-eur"></i></a>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->

        <div class="row ">
            <div class="col-lg-12">
                <div class="dashboard-header">
                    <h3 class="dashboard-title">kommende 4 Kurstage</h3>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($coming_dates as $date)
                <div class="col-lg-3 col-sm-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ $date->formatLocalized('%A') }} der {{ $date->format('d.m.Y') }}</h3>
                        </div>
                        <div class="box-body">
                            @if ( !$coursedates[$date->format('Y-m-d')]->isEmpty() )
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Anzahl Teilnehmer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coursedates[$date->format('Y-m-d')]->sortBy('course.time') as $coursedate)
                                            <tr >
                                                @if ($coursedate->user->count() < 2)
                                                    <td>
                                                        <a href="{{ route('admin::coursedates_show', [ 'coursedate' => $coursedate->id ]) }}" class="text-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{ $coursedate->course->name_with_details_public }}</a>
                                                        
                                                    </td>
                                                @else
                                                <td><a href="{{ route('admin::coursedates_show', [ 'coursedate' => $coursedate->id ]) }}">{{ $coursedate->course->name_with_details_public }}</a></td>
                                                @endif
                                                <td>
                                                    {{ $coursedate->user->count() }} / {{ $coursedate->course->max_participants }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                
                            @else
                                <p>An diesem Tag gibts es keine Kurse</p>
                            @endif
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    
        <div class="row ">
            <div class="col-lg-12">
                <div class="dashboard-header">
                    <h3 class="dashboard-title">ein paar schöne Diagramme</h3>
                </div>
            </div>
        </div>

        <div class="row ">
            
            <div class="col-lg-6">
                <div class="box">
                    <div class="box-header with-border text-center">
                        <h3 class="box-title">Neukunden pro Monat</h3>
                    </div>
                    <div class="box-body">
                        <canvas id="chart_users" width="300" height="250"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="box">
                    <div class="box-header with-border text-center">
                        <h3 class="box-title">Besuchte Kurse der letzten 6 Monate</h3>
                    </div>
                    <div class="box-body">
                        <canvas id="chart_coursedates" width="300" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>
    <script type="text/javascript">
        var chart_coursedates = new Chart(document.getElementById("chart_coursedates"), {
            type: 'line',
            data: {
                labels: {!! json_encode($chart_coursedates_array['labels']) !!},
                datasets: [{
                    label: "Anzahl besuchter Kurse",
                    data: {!! json_encode($chart_coursedates_array['data']) !!},
                    fill: true,
                    backgroundColor: 'rgba(0,166,90,0.5)',
                    borderColor: 'rgba(0,166,90,1)'
                }]
            },
            options: {
                legend: { display: false },
                maintainAspectRatio: false
            }
        });

        var chart_users = new Chart(document.getElementById("chart_users"), {
            type: 'bar',
            data: {
                labels: {!! json_encode($chart_users_array['labels']) !!},
                datasets: [{
                    label: "Anzahl Neukunden",
                    data: {!! json_encode($chart_users_array['data']) !!},
                    fill: true,
                    backgroundColor: '#00a65a'
                }]
            },
            options: {
                legend: { display: false },
                maintainAspectRatio: false,
            
                events: false,
                tooltips: {
                    enabled: false
                },
                hover:  {
                    animationDuration: 0
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            suggestedMax: 60
                        }
                    }]
                },
                animation: {
                    duration: 1,
                    onComplete: function () {
                        var chartInstance = this.chart,
                            ctx = chartInstance.ctx;
                        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';

                        this.data.datasets.forEach(function (dataset, i) {
                            var meta = chartInstance.controller.getDatasetMeta(i);
                            meta.data.forEach(function (bar, index) {
                                var data = dataset.data[index];                            
                                ctx.fillText(data, bar._model.x, bar._model.y - 5);
                            });
                        });
                    }
                }
            }
        });
    </script>
@stop