@extends('layouts.app')

@section('styles')
    <style>
        #my-description { display: none; }
    </style>
@endsection

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">Dashboard</div>

    <div class="panel-body">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="" method="POST">
            {{ csrf_field() }}
            
            <div class="form-group">
                <label for="category_id">Categoría</label>
                <select name="category_id" class="form-control">
                    <option value="">General</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="severity">Severidad</label>
                <select name="severity" class="form-control">
                    <option value="M">Menor</option>
                    <option value="N">Normal</option>
                    <option value="A">Alta</option>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <select name="description" id="description" class="form-control">
                    <option value="">Seleccione descripción</option>
                    <option value="Ocurrió un problema con la aplicación web">Ocurrió un problema con la aplicación web</option>
                    <option value="Ocurrió un problema con la aplicación móvil">Ocurrió un problema con la aplicación móvil</option>
                    <option value="Ocurrió un problema con el hardware de la laptop">Ocurrió un problema con el hardware de la laptop</option>
                </select>
                <input type="checkbox" name="check-my-description" id="checkbox-description"> Escribir mi propia descripción
                <textarea name="my-description" id="my-description" class="form-control">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Registrar incidencia</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#checkbox-description').on('change', function () {
                $('#description').toggle();
                $('#my-description').toggle();
            });
        });
    </script>
@endsection