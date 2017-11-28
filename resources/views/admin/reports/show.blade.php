@extends('layouts.app')

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">Reporte del proyecto <strong>{{ $project->name }}</strong></div>

    <div class="panel-body">
        @if (session('notification'))
            <div class="alert alert-success">
                {{ session('notification') }}
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/reports/highcharts.js') }}"></script>
    <script src="{{ asset('js/reports/exporting.js') }}"></script>
    <script>
        $(function () {
            $.get('{{ url('/reportes/proyectos/'.$project->id.'/by-descriptions') }}', function (data) {
                showHighChart(data);
            });
        });

        function showHighChart(data) {
            Highcharts.chart('container', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: '# de incidencias según descripción'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Incidencias',
                    colorByPoint: true,
                    data: data
                }]
            });
        }
    </script>
@endsection
