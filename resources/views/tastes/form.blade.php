<fieldset>
    <div class="form-group row">
        <div class="col-12 col-sm-6">
            <input type="text" class="form-control form-control-sm mt-3 shadow-sm w-100{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ?: $taste->name ?: '' }}" aria-describedby="nombre_help">
            <small id="nombre_help" class="form-text text-muted">Nombre</small>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12">
            <input type="text" class="form-control form-control-sm mt-3 shadow-sm w-100{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') ?: $taste->description ?: '' }}" aria-describedby="description_help">
            <small id="description_help" class="form-text text-muted">Descripción detallada del gusto</small>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-9 col-sm-8">
            <div class="input-group input-group-sm mt-3" id="cp1" style="width: auto;">
                <input type="text" class="form-control form-control-sm input-lg{{ $errors->has('color') ? ' is-invalid' : '' }}" id="colorinput" name="color" value="{{ old('color') ?: $taste->color ?: '' }}" aria-describedby="colorHelp" style="width: auto;" />
                <span class="input-group-append" data-toggle="tooltip" data-placement="top" title="Elija un color acorde al gusto">
                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                </span>
            </div>
            <small id="colorHelp" class="form-text text-muted">Clic en el recuadro para elegir un color</small>
        </div>
        <div class="col-3 col-sm-4 m-auto">
            <div class="form-group my-1">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" data-toggle="tooltip" data-placement="bottom" title="Si el color del gusto es oscuro y activa esta opción, el texto que contenga será claro, en caso contrario, saldrá oscuro y no será legible." id="white_text" name="white_text" {{ $taste->white_text ? "checked" : "" }}/>
                    <label class="custom-control-label font-sm" for="white_text">¿Texto blanco?</label>
                </div>
            </div>
        </div>
    </div>
</fieldset>