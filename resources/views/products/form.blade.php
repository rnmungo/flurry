<div class="row">
    <div class="col-12 col-lg-6">
        <fieldset>
            <p class="text-center" style="font-size: 1.2rem;">Datos básicos</p>
            <hr class="hr-fading">
            <div class="form-group row">
                <div class="col-12 col-sm-8 col-md-6 col-lg-10 col-xl-9">
                    <input type="text" class="form-control form-control-sm shadow-sm w-100" name="name" value="{{ old('name') ?: $product->name ?: '' }}" onkeyup="validate_input(this, '^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9./#&º]+( [a-zA-ZñÑáéíóúÁÉÍÓÚ0-9./#&º]+)*$');" aria-describedby="name_help">
                    <small id="name_help" class="form-text text-muted">Nombre</small>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-8">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control form-control-sm shadow-sm w-75" name="alias" value="{{ old('alias') ?: $product->alias ?: '' }}" onkeyup="validate_input(this, '^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9./#&º]+( [a-zA-ZñÑáéíóúÁÉÍÓÚ0-9./#&º]+)*$');" aria-describedby="alias_help">
                        <span class="input-group-addon shadow-sm" data-toggle="tooltip" data-placement="top" title="Si lo completa, se mostrará el alias cuando no entre el Nombre. Por ejemplo: H.1Kg, como abreviación de Helado 1 Kg.">
                            <span class="input-group-text bg-info text-white h-100" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                <i class="fas fa-info"></i>
                            </span>
                        </span>
                    </div>
                    <small id="alias_help" class="form-text text-muted">Alias (Opcional)</small>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <input type="text" class="form-control form-control-sm shadow-sm w-100" name="description" value="{{ old('description') ?: $product->description ?: '' }}" onkeyup="validate_input(this, '^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9./#&º,]+( [a-zA-ZñÑáéíóúÁÉÍÓÚ0-9./#&º,]+)*$');" aria-describedby="description_help" >
                    <small id="description_help" class="form-text text-muted">Descripción (Detalle del producto)</small>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon shadow-sm" data-toggle="tooltip" data-placement="top" title="Ingrese el precio separando los decimales con un punto.">
                            <span class="input-group-text bg-info text-white h-100" style="border-top-right-radius: 0; border-bottom-right-radius: 0;">
                                <i class="fas fa-dollar-sign"></i>
                            </span>
                        </span>
                        <input type="text" class="form-control form-control-sm shadow-sm w-auto" name="price" value="{{old('price') ?: $product->price ?: ''}}" onkeyup="validate_input(this, '^[0-9]+([.][0-9]{1,2})?$');" aria-describedby="price_help">
                    </div>
                    <small id="price_help" class="form-text text-muted">Precio</small>
                </div>
            </div>
        </fieldset>
        <fieldset class="mt-2">
            <p class="text-center" style="font-size: 1.2rem;">Configuración adicional</p>
            <hr class="hr-fading">
            <div class="form-group my-1">
              	<div class="custom-control custom-switch">
                	<input type="checkbox" class="custom-control-input" id="has_tastes" name="hasTastes" value="1" onchange="document.getElementsByName('max_tastes')[0].disabled = !this.checked;" {{ $product->hasTastes ? "checked" : "" }} >
                	<label class="custom-control-label" for="has_tastes">Lleva gustos</label>
            	</div>
            </div>
            <div class="form-group row mt-2">
                <div class="col-5 col-lg-4">
                    <select class="custom-select custom-select-sm form-control form-control-sm w-auto" name="max_tastes" {{ $product->hasTastes ? "" : "disabled" }} aria-describedby="max_tastes_help">
                        @for($i = 1; $i <= 5; $i++)
                            <option {{ $product->max_tastes == $i ? "selected" : "" }}>{{$i}}</option>
                        @endfor
                    </select>
                    <small id="max_tastes_help" class="form-text text-muted">Cantidad de gustos</small>
                </div>
                <div class="col-12 col-sm-7 col-lg-8">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control form-control-sm shadow-sm w-75" name="weight" value="{{old('weight') ?: $product->weight ?: ''}}" onkeyup="validate_input(this, '^\\d+$');" aria-describedby="weight_help">
                        <span class="input-group-addon shadow-sm" data-toggle="tooltip" data-placement="top" title="Ingrese el peso del producto expresado en gramos.">
                            <span class="input-group-text bg-info text-white h-100 px-1 py-0" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                <i>Gr.</i>
                            </span>
                        </span>
                    </div>
                    <small id="weight_help" class="form-text text-muted">Peso</small>
                </div>
            </div>
        </fieldset>				
    </div>
    <div class="col-12 col-lg-6 mb-5">
        <div class="container" id="pictureDiv">
            <button type="button" class="close position-absolute text-right" aria-label="Close" title="Eliminar imagen" onclick="deleteImage('{{'/imagenes/productos/'.config('ourconfig.products.default_image')}}')">
                <span aria-hidden="true" id="deleteBtn" class="align-top text-dark ml-1" style="display: {{ $product->hasPicture() ? 'block' : 'none' }};">&times;</span>
            </button>
            <img class="mx-auto d-block mt-4 mb-2 border shadow-sm img-fluid" id="picturePreview" src="/imagenes/productos/{{$product->picture}}" >
            <input type="hidden" id="deletePictureFlag" name="deletePictureFlag" />
        </div>            
    	<div class="custom-file mx-auto d-block">
    	    <input type="file" class="custom-file-input" name="picture" id="picture" aria-describedby="picture_help" onchange="readImage(this);">
    	    <label for="picture" id="pictureLabel" class="custom-file-label">Seleccionar imagen...</label>
            <small id="picture_help" class="form-text text-muted">Imagen de producto</small>
    	</div>
    </div>
</div>