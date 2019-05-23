@extends('layouts.app')
@section('title', 'Usuarios')

@section('scripts')
	<script src="{{ asset('js/users/users.js') }}" defer></script>
	<script type="text/javascript">
		$(document).ready(function () {
			user = new User();
			$('[data-toggle="tooltip"]').tooltip({ boundary: 'window', "show": 500, "hide": 100 });
			document.getElementsByName('email2')[0].onpaste = function (e) { e.preventDefault(); };
			document.getElementsByName('password2')[0].onpaste = function (e) {	e.preventDefault(); };
		});
	</script>
@endsection

@section('content')
	<div class="row justify-content-center mt-3">
		<h3>Alta de Usuario</h3>
	</div>
	<div class="row justify-content-center my-2">
		<div class="col-12 col-sm-8 col-md-10 col-lg-5">
			<div class="container my-3 px-3 py-3 text-center">
				<form id="user_form" action="/users" method="POST" autocomplete="off">
					@csrf
					<div class="form-group row justify-content-center text-left">
						<div class="col-10 col-md-6">
							<input type="text" name="name" value="{{ old('name') }}" class="form-control form-control-sm shadow-sm w-100" onkeyup="validate_input(this, '^[a-zA-ZñÑ0-9]{5,100}$');" aria-describedby="name_help" data-toggle="tooltip" data-placement="right" title="Solo números y letras sin acentos, con 5 caracteres o más." />
							<small id="name_help" class="form-text text-muted">Nombre</small>
						</div>
						<div class="col-10 col-md-6">
							<select name="role_id" class="custom-select custom-select-sm form-control form-control-sm shadow-sm w-100">
								@foreach($roles as $role)
									@if(old('role_id') && old('role_id') == $role->id)
										<option value="{{$role->id}}" selected>{{$role->name}}</option>
									@else
										<option value="{{$role->id}}">{{$role->name}}</option>
									@endif
								@endforeach
							</select>
							<small id="rol_help" class="form-text text-muted">Rol</small>
						</div>
					</div>
					<div class="form-group row justify-content-center text-left">
						<div class="col-10 col-md-6 mb-3">
							<input type="text" name="email" value="{{ old('email') }}" class="form-control form-control-sm shadow-sm w-100" onkeyup="validate_input(this, '^[a-zA-Z0-9.!#$%&\'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$');" aria-describedby="email_help" />
							<small id="email_help" class="form-text text-muted">E-Mail</small>
						</div>
						<div class="col-10 col-md-6 mb-3">
							<input type="text" name="email2" value="{{ old('email2') }}" class="form-control form-control-sm shadow-sm w-100" onkeyup="user.check_equal_inputs('email', 'email2');" aria-describedby="email2_help" />
							<small id="email2_help" class="form-text text-muted">Repetir E-Mail</small>
						</div>
					</div>
					<div class="form-group row justify-content-center text-left">
						<div class="col-10 col-md-6 mb-3">
							<input type="password" name="password" value="{{ old('password') }}" class="form-control form-control-sm shadow-sm w-100" onkeyup="user.check_strength_password(this);" aria-describedby="password_help" />
							<small id="password_help" class="form-text text-muted">Contraseña <span id="strength_badge" class='badge font-sm'></small>
						</div>
						<div class="col-10 col-md-6 mb-3">
							<input type="password" name="password2" class="form-control form-control-sm shadow-sm w-100" onkeyup="user.check_equal_inputs('password', 'password2');" aria-describedby="password2_help" />
							<small id="password2_help" class="form-text text-muted">Repetir contraseña</small>
						</div>
					</div>
					<button type="button" class="btn btn-sm btn-info text-white" onclick="user.check_values(true, true);">Guardar</button>
				</form>
			</div>
		</div>
	</div>
@endsection
