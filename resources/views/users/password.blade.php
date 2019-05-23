@extends('layouts.app')
@section('title', 'Cambio de Contraseña')
@section('scripts')
	<script src="{{ asset('js/users/users.js') }}" defer></script>
	<script type="text/javascript">
		$(document).ready(function () {
			user = new User();
			document.getElementsByName('password2')[0].onpaste = function (e) {	e.preventDefault(); };
		});
	</script>
@endsection
@section('content')
	<div class="row justify-content-center mt-3 text-center">
		<h3>Cambio de Contraseña - {{Auth::user()->name}}</h3>
	</div>
	<div class="row justify-content-center mt-2">
		<div class="col-10 col-sm-6 col-md-4 col-xl-2">
			<form id="user_form" action="/users/{{Auth::user()->random_id}}" method="POST">
				@csrf
				@method('PUT')
				<input type="hidden" name="action_user" value="change_password" />
				<div class="form-group row justify-content-center">
					<div class="col-12">
						<hr class="hr-fading" />
					</div>
					<div class="col-12 mb-3">
						<input type="password" name="password" class="form-control form-control-sm shadow-sm w-100" onkeyup="user.check_strength_password(this);" aria-describedby="new_password_help" />
						<small id="new_password_help" class="form-text text-muted">Contraseña nueva <span id="strength_badge" class='badge font-sm'></small>
					</div>
					<div class="col-12 mb-3">
						<input type="password" name="password2" class="form-control form-control-sm shadow-sm w-100" onkeyup="user.check_equal_inputs('password', 'password2');" aria-describedby="new_password_2_help" />
						<small id="new_password_2_help" class="form-text text-muted">Repetir contraseña</small>
					</div>
					<div class="col-12 text-center">
						<button type="button" class="btn btn-sm btn-info shadow-sm text-white" onclick="user.check_values(true, false);">Guardar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection