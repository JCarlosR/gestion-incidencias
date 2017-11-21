@extends('layouts.app')

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">Descripciones predefinidas</div>

    <div class="panel-body">
        @if (session('notification'))
            <div class="alert alert-success">
                {{ session('notification') }}
            </div>
        @endif

        <form action="" method="POST">
            {{ csrf_field() }}

            <div class="descriptions">
                @foreach ($descriptions as $description)
                    <div class="form-group">
                        <input type="text" name="descriptions[]" class="form-control" value="{{ $description }}">
                    </div>
                @endforeach
                <template id="template-description">
                    <div class="form-group">
                        <input type="text" name="descriptions[]" class="form-control">
                    </div>
                </template>
                <div class="form-group">
                    <input type="text" name="descriptions[]" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <button type="button" class="btn btn-primary" title="Añadir descripción" id="add-description">
                    <i class="glyphicon glyphicon-plus-sign"></i>
                </button>
                <button type="submit" class="btn btn-success">Guardar descripciones</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        var template;
        $(function () {
           $('#add-description').on('click', addDescription);
           template = $('#template-description');
        });

        function addDescription() {
            var $description = template.html();
            $('.descriptions').append($description);
        }
    </script>
@endsection
