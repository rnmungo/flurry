<div class="row justify-content-center my-4">
	<div class="col-12 col-lg-6 col-xl-4">
        <div class="container-fluid">
        	<p style="font-size: 1.2rem;">Datos personales</p>
            <hr class="hr-fading">
            <div class="form-group row justify-content-center mt-2">
            	<div class="col-12 col-sm-4 col-lg-5">
            		<input type="text" name="name" value="{{ old('name') ?: $customer->name ?: '' }}" class="form-control form-control-sm shadow-sm" onkeyup="validate_input(this, '^[a-zA-ZñÑ\'áéíóúÁÉÍÓÚ]+( [a-zA-ZñÑ\'áéíóúÁÉÍÓÚ]+)*$');" aria-describedby="name_help" />
                    <small id="name_help" class="form-text text-muted">Nombre/s</small>
            	</div>
            	<div class="col-12 col-sm-4 col-lg-5">
            		<input type="text" name="lastname" value="{{ old('lastname') ?: $customer->lastname ?: '' }}" class="form-control form-control-sm shadow-sm" onkeyup="validate_input(this, '^[a-zA-ZñÑ\'áéíóúÁÉÍÓÚ]+( [a-zA-ZñÑ\'áéíóúÁÉÍÓÚ]+)*$');" aria-describedby="lastname_help" />
            		<small id="lastname_help" class="form-text text-muted">Apellido/s</small>
            	</div>
            </div>
            <div class="form-group row justify-content-center">
            	<div class="col-12 col-sm-8 col-lg-10">
            		<input type="email" name="email" value="{{ old('email') ?: $customer->email ?: '' }}" class="form-control form-control-sm shadow-sm" aria-describedby="email_help" onkeyup="validate_input(this, '^[a-zA-Z0-9.!#$%&\'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$');" />
            		<small id="email_help" class="form-text text-muted">E-mail</small>
            	</div>
            </div>
            <div class="form-group row justify-content-center">
            	<div class="col-5 col-sm-3 col-lg-4 col-xl-5">
            		<select name="area_code_phone_id" class="custom-select custom-select-sm shadow-sm" aria-describedby="phone_help">
            			@foreach($area_codes as $area_code)
            				@if(old('area_code_phone_id') && $area_code->id == old('area_code_phone_id'))
            					<option value="{{ $area_code->id }}" selected>{{ '(+'.strval($international_code->code).') 9 '.$area_code->code }}</option>
            				@elseif(!old('area_code_phone_id') && $area_code->id == $customer->area_code_phone_id)
        						<option value="{{ $area_code->id }}" selected>{{ '(+'.strval($international_code->code).') 9 '.$area_code->code }}</option>
                            @elseif(!old('area_code_phone_id') && $area_code->code == 11)
                                <option value="{{ $area_code->id }}" selected>{{ '(+'.strval($international_code->code).') 9 '.$area_code->code }}</option>
        					@else
        						<option value="{{ $area_code->id }}">{{ '(+'.strval($international_code->code).') 9 '.$area_code->code }}</option>
            				@endif
            			@endforeach
            		</select>
            		<small id="phone_help" class="form-text text-muted">Teléfono</small>
            	</div>
            	<div class="col-7 col-sm-5 col-lg-6 col-xl-5">
            		<input type="text" id="phone" name="phone" value="{{ old('phone') ?: $customer->phone ?: '' }}" class="form-control form-control-sm shadow-sm" onkeyup="validate_input(this, '^([0-9]){6,8}?$');" />
            	</div>
            </div>
            <div class="form-group row justify-content-center">
            	<div class="col-5 col-sm-3 col-lg-4 col-xl-5">
            		<select name="area_code_mobile_id" class="custom-select custom-select-sm shadow-sm" aria-describedby="mobile_help">
            			@foreach($area_codes as $area_code)
            				@if(old('area_code_mobile_id') && $area_code->id == old('area_code_mobile_id'))
            					<option value="{{ $area_code->id }}" selected>{{ '(+'.strval($international_code->code).') 9 '.$area_code->code }}</option>
                            @elseif(!old('area_code_mobile_id') && $area_code->id == $customer->area_code_mobile_id)
                                <option value="{{ $area_code->id }}" selected>{{ '(+'.strval($international_code->code).') 9 '.$area_code->code }}</option>
            				@elseif(!old('area_code_mobile_id') && $area_code->code == 11)
        						<option value="{{ $area_code->id }}" selected>{{ '(+'.strval($international_code->code).') 9 '.$area_code->code }}</option>
        					@else
        						<option value="{{ $area_code->id }}">{{ '(+'.strval($international_code->code).') 9 '.$area_code->code }}</option>
            				@endif
            			@endforeach
            		</select>
            		<small id="mobile_help" class="form-text text-muted">Celular</small>
            	</div>
            	<div class="col-7 col-sm-5 col-lg-6 col-xl-5">
            		<input type="text" name="mobile" value="{{ $mobile ?: old('mobile') ?: $customer->mobile ?: '' }}" class="form-control form-control-sm shadow-sm" onkeyup="validate_input(this, '^([0-9]){6,8}?$');" />
            	</div>
            </div>
        </div>
	</div>
	<div class="col-12 col-lg-6 col-xl-4">
		<div class="container-fluid">
			<p style="font-size: 1.2rem;">Redes</p>
            <hr class="hr-fading">
            <div class="form-group row justify-content-center">
            	<div class="col-12 col-sm-5">
            		<input type="text" name="facebook_nick" value="{{ old('facebook_nick') ?: $customer->facebook_nick ?: '' }}" class="form-control form-control-sm shadow-sm" onkeyup="validate_input(this, '^([a-zA-ZñÑ0-9_.]){1,40}?$');" aria-describedby="facebook_help" />
            		<small id="facebook_help" class="form-text text-muted">Facebook</small>
            	</div>
            	<div class="col-10 col-sm-2 col-lg-3">
            		<button type="button" class="btn btn-sm btn-info shadow-sm w-100 text-white" onclick="window.open('http://www.facebook.com/' + document.getElementsByName('facebook_nick')[0].value);" data-toggle="tooltip" data-placement="top" title="Ir a la página de Facebook">Validar</button>
            	</div>
            	<div class="col-2 col-sm-1">
            		<input type="checkbox" name="facebook_verify" class="form-check-input mt-2 mx-auto" {{ old('facebook_verify') || $customer->facebook_verify ? 'checked' : '' }}/>
            	</div>
            </div>
            <div class="form-group row justify-content-center">
            	<div class="col-12 col-sm-5">
            		<input type="text" name="instagram_nick" value="{{ old('instagram_nick') ?: $customer->instagram_nick ?: '' }}" class="form-control form-control-sm shadow-sm" onkeyup="validate_input(this, '^([a-zA-ZñÑ0-9_.]){1,40}?$');" aria-describedby="instagram_help" />
            		<small id="instagram_help" class="form-text text-muted">Instagram</small>
            	</div>
            	<div class="col-10 col-sm-2 col-lg-3">
            		<button type="button" class="btn btn-sm btn-info shadow-sm w-100 text-white" onclick="window.open('http://www.instagram.com/' + document.getElementsByName('instagram_nick')[0].value);" data-toggle="tooltip" data-placement="top" title="Ir a la página de Instagram">Validar</button>
            	</div>
            	<div class="col-2 col-sm-1">
            		<input type="checkbox" name="instagram_verify" class="form-check-input mt-2 mx-auto" {{ old('instagram_verify') || $customer->instagram_verify ? 'checked' : '' }} />
            	</div>
            </div>
            <div class="form-group row justify-content-center">
            	<div class="col-12 col-sm-5">
            		<input type="text" name="twitter_nick" value="{{ old('twitter_nick') ?: $customer->twitter_nick ?: '' }}" class="form-control form-control-sm shadow-sm" onkeyup="validate_input(this, '^([a-zA-ZñÑ0-9_.]){1,40}?$');" aria-describedby="twitter_help" />
            		<small id="twitter_help" class="form-text text-muted">Twitter</small>
            	</div>
            	<div class="col-10 col-sm-2 col-lg-3">
            		<button type="button" class="btn btn-sm btn-info shadow-sm w-100 text-white" onclick="window.open('http://www.twitter.com/' + document.getElementsByName('twitter_nick')[0].value);" data-toggle="tooltip" data-placement="top" title="Ir a la página de Twitter">Validar</button>
            	</div>
            	<div class="col-2 col-sm-1">
            		<input type="checkbox" name="twitter_verify" class="form-check-input mt-2 mx-auto" {{ old('twitter_verify') || $customer->twitter_verify ? 'checked' : '' }}/>
            	</div>
            </div>
		</div>
	</div>
</div>
<div class="row justify-content-center align-items-center">
	<div class="col-12 col-lg-6 col-xl-4">
		<div class="container-fluid">
			<p style="font-size: 1.2rem;">Domicilio</p>
            <hr class="hr-fading">
            <div class="form-group row justify-content-center">
            	<div class="col-12 col-sm-4 col-lg-5 my-1">
            		<input type="text" name="street" value="{{ old('street') ?: $customer->street ?: '' }}" class="form-control form-control-sm shadow-sm" onkeyup="validate_input(this, '^[a-zA-ZñÑ\'áéíóúÁÉÍÓÚ0-9]+( [a-zA-ZñÑ\'áéíóúÁÉÍÓÚ0-9]+)*$'); customer.verify_address_changes('{{$customer->street}}', '{{$customer->street_number}}', '{{$customer->locality_id}}', '{{$customer->latitude}}', '{{$customer->longitude}}');" aria-describedby="street_help" />
            		<small id="street_help" class="form-text text-muted">Calle</small>
            	</div>
            	<div class="col-12 col-sm-4 col-lg-5 my-1">
            		<select name="locality_id" class="custom-select custom-select-sm shadow-sm" onchange="customer.verify_address_changes('{{$customer->street}}', '{{$customer->street_number}}', '{{$customer->locality_id}}', '{{$customer->latitude}}', '{{$customer->longitude}}');" aria-describedby="locality_help">
            			@foreach($localities as $locality)
            				@if(old('locality_id') && $locality->id == old('locality_id'))
            					<option value="{{ $locality->id }}" selected>{{ $locality->name }}</option>
            				@elseif(isset($customer) && $customer->locality_id && $locality->id == $customer->locality_id)
            					<option value="{{ $locality->id }}" selected>{{ $locality->name }}</option>
            				@elseif(!old('locality_id') && $locality->id == 1)
        						<option value="{{ $locality->id }}" selected>{{ $locality->name }}</option>
        					@else
        						<option value="{{ $locality->id }}">{{ $locality->name }}</option>
            				@endif
            			@endforeach
            		</select>
            		<small id="locality_help" class="form-text text-muted">Localidad</small>
            	</div>
            </div>
            <div class="form-group row justify-content-center">
            	<div class="col-4 col-sm-3 col-md-2 col-lg-4 my-1">
            		<input type="text" name="street_number" value="{{ old('street_number') ?: $customer->street_number ?: '' }}" class="form-control form-control-sm shadow-sm" aria-describedby="street_number_help" onkeyup="validate_input(this, '^([0-9]){1,5}?$'); customer.verify_address_changes('{{$customer->street}}', '{{$customer->street_number}}', '{{$customer->locality_id}}', '{{$customer->latitude}}', '{{$customer->longitude}}');" />
            		<small id="street_number_help" class="form-text text-muted">Número</small>
            	</div>
            	<div class="col-4 col-sm-2 col-md-3 my-1">
            		<input type="text" name="floor" value="{{ old('floor') ?: $customer->floor ?: '' }}" class="form-control form-control-sm shadow-sm" onkeyup="validate_input(this, '^([0-9]){1,2}?$');" aria-describedby="floor_help" />
            		<small id="floor_help" class="form-text text-muted">Piso</small>
            	</div>
            	<div class="col-4 col-sm-3 my-1">
            		<input type="text" name="department" value="{{ old('department') ?: $customer->department ?: '' }}" class="form-control form-control-sm shadow-sm" onkeyup="validate_input(this, '^([a-zA-Z0-9]){1,2}?$');" aria-describedby="department_help" />
            		<small id="department_help" class="form-text text-muted">Dpto.</small>
            	</div>
            </div>
            <div class="form-group row justify-content-center">
            	<div class="col-12 col-sm-4 col-lg-5 my-1">
            		<input type="text" name="between_street_one" value="{{ old('between_street_one') ?: $customer->between_street_one ?: '' }}" class="form-control form-control-sm shadow-sm" onkeyup="validate_input(this, '^[a-zA-ZñÑ\'áéíóúÁÉÍÓÚ0-9]+( [a-zA-ZñÑ\'áéíóúÁÉÍÓÚ0-9]+)*$');" aria-describedby="between_street_help" />
            		<small id="between_street_help" class="form-text text-muted">Entre calle - 1</small>
            	</div>
            	<div class="col-12 col-sm-4 col-lg-5 my-1">
            		<input type="text" name="between_street_two" value="{{ old('between_street_two') ?: $customer->between_street_two ?: '' }}" class="form-control form-control-sm shadow-sm" onkeyup="validate_input(this, '^[a-zA-ZñÑ\'áéíóúÁÉÍÓÚ0-9]+( [a-zA-ZñÑ\'áéíóúÁÉÍÓÚ0-9]+)*$');" aria-describedby="between_street2_help" />
            		<small id="between_street2_help" class="form-text text-muted">Entre calle - 2</small>
            	</div>
            </div>
            <div class="form-group row justify-content-center">
            	<div class="col-12 col-sm-4 col-md-3 col-lg-5 my-1">
            		<input type="text" name="latitude" value="{{ old('latitude') ?: $customer->latitude ?: '' }}" class="form-control form-control-sm shadow-sm" style="cursor: not-allowed;" readonly="readonly" aria-describedby="latitude_help" />
            		<small id="latitude_help" class="form-text text-muted">Latitud</small>
            	</div>
            	<div class="col-12 col-sm-4 col-md-3 col-lg-5 my-1">
            		<input type="text" name="longitude" value="{{ old('longitude') ?: $customer->longitude ?: '' }}" class="form-control form-control-sm shadow-sm" style="cursor: not-allowed;" readonly="readonly" aria-describedby="longitude_help" />
            		<small id="longitude_help" class="form-text text-muted">Longitud</small>
            	</div>
                <input type="hidden" name="latitude_aux" value="" />
                <input type="hidden" name="longitude_aux" value="" />
            	<div class="col-12 col-sm-5 col-md-2 col-lg-4 my-1" id="buttons_map">
            		@if(($customer->latitude && $customer->longitude) || (old('latitude') && old('longitude')))
                        <button type="button" class="btn btn-sm btn-info shadow-sm rounded w-100 text-white" onclick="customer.open_map('latitude', 'longitude', 'map');" >Ver en mapa</button>
                    @else
                        <button type="button" class="btn btn-sm btn-info shadow-sm rounded w-100 text-white" onclick="customer.geolocation_customer();" >Geolocalizar</button>
                    @endif
            	</div>
            </div>
        </div>
	</div>
	<div class="col-12 col-lg-6 col-xl-4">
		<div id="map" class="col-12 mx-auto w-100 rounded shadow-sm border" style="min-height: 20rem; max-height: 25rem; display: none;">
    	</div>
	</div>
</div>
<div class="text-center my-4">
	<button type="submit" class="btn btn-info shadow-sm rounded text-white">Guardar</button>
</div>