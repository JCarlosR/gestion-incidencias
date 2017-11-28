@extends('layouts.app')

@section('styles')
    <style>
        #my-description { display: none; }
    </style>
@endsection

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">Reportar nueva incidencia</div>

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

        @if (session('notification'))
            <div class="alert alert-success">
                {{ session('notification') }}
            </div>
        @endif

        <form action="" method="POST" enctype="multipart/form-data">
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
                <label for="control_number">Número de control</label>
                <input type="text" name="control_number" class="form-control" value="{{ old('control_number') }}">
            </div>
            <div class="form-group">
                <label for="title">Nombre</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <select name="description" id="description" class="form-control">
                    <option value="">Seleccione descripción</option>
                    @foreach ($descriptions as $description)
                        <option value="{{ $description }}">{{ $description }}</option>
                    @endforeach
                    <option value="-1">(*) Ingresar mi propia descripción</option>
                </select>
                <textarea name="my-description" id="my-description" class="form-control">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <input type="checkbox" id="add-attachment"> Deseo añadir un archivo adjunto
            </div>
            <div class="form-group" style="display: none;" id="attachment-group">
                <label for="attachment">Archivo adjunto</label>
                <input type="file" name="attachment">
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
            $('#description').on('change', function () {
                var value = $(this).val();
                if (value === '-1') {
                    $('#description').hide();
                    $('#my-description').fadeIn();
                }
            });

            $('#add-attachment').on('click', function () {
                $('#attachment-group').fadeToggle();
            });
        });
    </script>
@endsection