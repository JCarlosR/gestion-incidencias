@extends('layouts.app')

@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('notification'))
    <div class="alert alert-success">
        {{ session('notification') }}
    </div>
@endif

<div class="panel panel-primary">
    <div class="panel-heading">
        <i class="glyphicon glyphicon-user"></i>
        Datos de usuario
    </div>
    <div class="panel-body">
        <p>A continuación puedes editar tus datos de usuario.</p>
        <form action="{{ url('profile/data') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" class="form-control" required value="{{ auth()->user()->name }}">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" disabled>
                <p class="help-block">Para modificar tu e-mail debes ponerte en contacto con un administrador.</p>
            </div>
            <button class="btn btn-primary">
                Guardar cambios
            </button>
        </form>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <i class="glyphicon glyphicon-lock"></i>
        Modificar contraseña
    </div>
    <div class="panel-body">
        <p>Ingresa tu nueva contraseña 2 veces para confirmar el cambio.</p>
        <form action="{{ url('profile/password') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmar contraseña</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button class="btn btn-primary">
                Cambiar contraseña
            </button>
        </form>
    </div>
</div>
@endsection
