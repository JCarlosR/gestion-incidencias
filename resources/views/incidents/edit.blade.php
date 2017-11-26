@extends('layouts.app')

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">Editar incidencia seleccionada (# {{ $incident->id }})</div>

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
                        <option value="{{ $category->id }}" @if($incident->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="severity">Severidad</label>
                <select name="severity" class="form-control">
                    <option value="M" @if($incident->severity=='M') selected @endif>Menor</option>
                    <option value="N" @if($incident->severity=='N') selected @endif>Normal</option>
                    <option value="A" @if($incident->severity=='A') selected @endif>Alta</option>
                </select>
            </div>
            <div class="form-group">
                <label for="control_number">Número de control</label>
                <input type="text" name="control_number" class="form-control" value="{{ old('control_number', $incident->control_number) }}">
            </div>
            <div class="form-group">
                <label for="title">Nombre</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $incident->title) }}">
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <select name="description" id="description" @if($customDescription) style="display: none;" @endif class="form-control">
                    <option value="">Seleccione descripción</option>
                    @foreach ($descriptions as $description)
                        <option value="{{ $description }}" @if(old('description', $incident->description)==$description) selected @endif>
                            {{ $description }}
                        </option>
                    @endforeach
                    <option value="-1" @if($customDescription) selected @endif>(*) Ingresar mi propia descripción</option>
                </select>

                <textarea name="my-description" id="my-description" class="form-control" @if($customDescription==false) style="display: none;" @endif>{{ old('description', $incident->description) }}</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Guardar cambios</button>
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
        });
    </script>
@endsection
