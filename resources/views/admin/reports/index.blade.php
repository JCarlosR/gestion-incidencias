@extends('layouts.app')

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">Reporte general</div>

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

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Proyecto</th>
                    <th class="text-center">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->name }}</td>
                        <td class="text-center">
                            <a href="{{ url('/reportes?project_id='.$project->id) }}" class="btn btn-primary btn-sm" title="Ver reporte por proyecto">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/reports/highcharts.js') }}"></script>
    <script src="{{ asset('js/reports/exporting.js') }}"></script>
    <script>
        $(function () {
            $.get('{{ url('/reportes/by-project') }}', function (data) {
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
                    text: '# de incidencias por proyecto'
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
