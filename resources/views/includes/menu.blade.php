@if (auth()->check())
	<div class="panel-footer" align="center">
		<div class="user-box">
			<form action="{{ url('/profile/image') }}" id="avatarForm">
				{{ csrf_field() }}
				<input type="file" style="display: none" id="avatarInput">
			</form>
			<div class="wrap">
				<div class="user-img">
					@if (auth()->user()->image)
						<img src="{{ asset('images/users/'.auth()->id().'.'.auth()->user()->image ) }}" alt="user-img" id="avatarImage" title="{{ auth()->user()->name }}" class="img-circle  img-responsive">
					@else
						<img src="{{ asset('images/users/0.jpg') }}" alt="user-img" id="avatarImage" title="{{ auth()->user()->name }}" class="img-circle img-responsive">
					@endif
				</div>
				<div class="text_over_image" id="textToEdit">Editar</div>
			</div>
			<h5>{{ auth()->user()->name }}</h5>
		</div>
	</div>
@endif
<div class="panel panel-primary">
	<div class="panel-heading">Menú</div>
	<div class="panel-body">
		<ul class="nav nav-pills nav-stacked">
			@if (auth()->check())
				<li @if(request()->is('home')) class="active" @endif>
					<a href="/home">Dashboard</a>
				</li>

				{{-- @if (! auth()->user()->is_client) --}}
				{{-- <li @if(request()->is('ver')) class="active" @endif> --}}
				{{-- <a href="/ver">Ver incidencias</a> --}}
				{{-- </li> --}}
				{{-- @endif --}}

				<li @if(request()->is('reportar')) class="active" @endif>
					<a href="/reportar">Reportar incidencia</a>
				</li>

				@if (auth()->user()->is_admin)
				<li role="presentation" class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						Administración <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="/usuarios">Usuarios</a></li>
						<li><a href="/proyectos">Proyectos</a></li>
						<li><a href="/descripciones">Descripciones</a></li>
						<li><a href="/reportes">Reportes</a></li>
					</ul>
				</li>
				@endif
			@else
				<li @if(request()->is('/')) class="active" @endif><a href="/">Bienvenido</a></li>
				<li @if(request()->is('instrucciones')) class="active" @endif><a href="/instrucciones">Instrucciones</a></li>
				<li @if(request()->is('acerca-de')) class="active" @endif><a href="/acerca-de">Créditos</a></li>
			@endif
		</ul>
	</div>
</div>
@if (auth()->check())
<div class="panel panel-primary">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-search"></i>
		Buscar incidencia
	</div>
	<div class="panel-body">
		<form action="{{ url('search') }}">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Número de control" name="control_number" required>
			</div>
		</form>
	</div>
</div>
@endif
