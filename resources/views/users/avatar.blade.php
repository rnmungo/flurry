@extends('layouts.app')
@section('title', 'Usuarios')

@section('style')
<style>
	.card h5 {
		font-size: 1.1rem !important;
		height: 3rem;
	}

	.card {
		height: 11rem; 
		min-width: 15rem !important;
		max-width: 15rem !important;
	}

	.card .img-fluid {
		height: 5rem;
	}
</style>
@endsection

@section('content')
	<script>
		function select_avatar(avatar){
			document.getElementById('action_user').value = "system_avatar";
			document.getElementById("selected_avatar").value = avatar;
			document.getElementById('avatar_form').submit();
		}

		function upload_avatar(){
			let form = document.getElementById('avatar_form');
			document.getElementById('action_user').value = "custom_avatar";
			$('#custom_avatar').trigger('click');
			$('#custom_avatar').change(function(e) {
				if ($(this).val()) {
					form.submit();
				}
			});
		}
	</script>
	<div class="row justify-content-center mt-3">
		<h3>Cambio de Avatar - {{Auth::user()->name}}</h3>
	</div>
	<div class="row justify-content-center my-2">
		<h4>Avatar Actual: {{Auth::user()->getAvatarName()}}</h4>
	</div>
	<div class="row justify-content-center">
		<div class="col-12 col-lg-10">
			<div class="container d-block" style="min-height: 25rem;">
				<div class="row justify-content-center my-2">
					@foreach($avatares as $avatar)
						<div class="col-12 col-sm-6 col-md-4 col-xl-3 m-2 shadow-sm card">
							<h5 class="card-header mt-2 text-center">
							  	{{ ucfirst($avatar->getBasename('.png')) }}
							</h5>
							<button type="button" class="btn btn-sm btn-default my-auto w-100" onclick="select_avatar('{{ $avatar->getBasename() }}');" >
								<img src="{{ "/imagenes/avatares/".$avatar->getBasename() }}" class="img-fluid" alt='{{$avatar->getBasename()}}' />
							</button>
						</div>
					@endforeach
					<button type="button" class="btn btn-secondary btn-lg mt-2" onclick="upload_avatar()">Elegir desde mi computadora...</button>
				</div>
				<form id="avatar_form" class="d-none" action="{{ route('users.update', ['user' => Auth::user()->random_id]) }}" method="POST" enctype="multipart/form-data" >
					@csrf
					@method('PUT')
				    <input type="hidden" id="selected_avatar" name="avatar" >
		    	    <input type="file"   id="custom_avatar"   name="custom_avatar" class="d-none" accept=".jpg,.png" >
				    <input type="hidden" id="action_user"     name="action_user" value="system_avatar" />
				</form> 
			</div>
		</div>
	</div>
@endsection