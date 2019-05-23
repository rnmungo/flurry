@extends('layouts.app')
@section('title', 'Usuarios')
@section('scripts')
	<script src="{{ asset('js/users/users.js') }}" defer></script>
	<script type="text/javascript">
		$(document).ready(function () {
			user = new User();
			user.init_vars();
		});
	</script>
@endsection

@section('style')
	<style>	
		.avatar {
			height: 3.5rem;
			width: 3.5rem;
		}
		button:disabled
		{
		    opacity: 0.3;
		    cursor: not-allowed;
		}
	</style>
@endsection

@section('content')
	<div class="row justify-content-center mt-4">
		<h3>Listado de Usuarios</h3>
	</div>
	<div class="row justify-content-center">
		<div class="col-12 col-sm-10 col-md-12 col-lg-6">
			<div class="form-inline my-2 justify-content-end">
				<a id="btn_new_user" href="/users/create" class="btn btn-sm btn-info shadow-sm border text-white" data-toggle="tooltip" data-placement="top" title="Cargar un nuevo usuario"><strong>Nuevo</strong></a>
			</div>
			<table class="table table-sm table-light table-hover table-responsive-lg my-3 border text-center" >
				<thead>
					<tr>
					    <th scope="col" class="border-bottom border-top">Avatar</th>
					    <th scope="col" class="border-bottom border-top">Nombre</th>
					    <th scope="col" class="border-bottom border-top">Email</th>
					    <th scope="col" class="border-bottom border-top">Permisos</th>
					    <th scope="col" class="border-bottom border-top">Modificar</th>
					    <th scope="col" class="border-bottom border-top">Eliminar</th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
						<tr>
					        <td class="border-0 align-middle">
					        	<img src='/imagenes/avatares/{{$user->avatar}}' class="avatar">
					        </td>
					        <td class="border-0 align-middle">{{$user->name}}</td>
					        <td class="border-0 align-middle">{{$user->email}}</td>
					        <td class="border-0 align-middle">{{$user->role->name}}</td>
					        <td class="border-0 align-middle">
					        	<form id="edit_form{{$user->id}}" action="/users/{{$user->random_id}}/edit" method="GET" >
				    	        	<button type="button" class="btn btn-sm btn-info text-white" onclick="document.getElementById('edit_form{{$user->id}}').submit();" {{ Auth::user()->id==$user->id ? "disabled" : ""}}><i class="far fa-edit" style="font-size: 1.5rem;"></i></button>
			    	        	</form>
					    	</td>
			    	        <td class="border-0 align-middle">
			    	        	<form id="delete_form{{$user->id}}" action="/users/{{$user->random_id}}" method="POST" >
									@csrf
									@method('DELETE')
				    	        	<button type="button" class="btn btn-sm btn-danger" onclick="delete_from_form('{{'delete_form'.$user->id}}', 'usuario');" {{ Auth::user()->id==$user->id ? "disabled" : ""}}><i class="far fa-trash-alt" style="font-size: 1.5rem;"></i></button>
			    	        	</form>
			    	    	</td>
						</tr>
					@endforeach
				</tbody>
			</table> 
		</div>
	</div>
@endsection