@extends('layouts.app')

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">Resultados de búsqueda</div>

    <div class="panel-body">
		<p>Se encontraron {{ $results->count() }} resultados, para la búsqueda del número de control "<strong>{{ $control_number }}</strong>".</p>
		<table class="table table-bordered">
			<thead>
			<tr>
				<th>ID</th>
				<th>Nro de control</th>
				<th>Categoría</th>
				<th>Severidad</th>
				<th>Estado</th>
				<th>Fecha creación</th>
				<th>Nombre</th>
				<th>Responsable</th>
			</tr>
			</thead>
			<tbody>
			@foreach ($results as $incident)
				<tr>
					<td>
						<a href="/ver/{{ $incident->id }}">
							{{ $incident->id }}
						</a>
					</td>
					<td>{{ $incident->control_number }}</td>
					<td>{{ $incident->category_name }}</td>
					<td>{{ $incident->severity_full }}</td>
					<td>{{ $incident->state }}</td>
					<td>{{ $incident->created_at }}</td>
					<td>{{ $incident->title_short }}</td>
					<td>
						{{ $incident->support_id ? $incident->support->name : 'Sin asignar' }}
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
    </div>
</div>
@endsection
