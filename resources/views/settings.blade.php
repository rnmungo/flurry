@extends('layouts.app')
@section('title', 'Configuraciones')
@section('scripts')
    <script>
    	function confirmReset(element) {
		    swal({
		          title: "¿Está seguro?",
		          text: "Todas las configuraciones volverán a sus valores por defecto.",
		          icon: "warning",
		          closeOnClickOutside: false,
		          closeOnEsc: false,
		          buttons: {			   
						    cancel: {
						      text: "Cancelar",
						      value: false,
						      visible: true
						    },
						    confirm: {
						      text: "Sí, restablecer",
						      value: true,
						      visible: true
						    }
						   },
		          dangerMode: true
		         })
				 .then((willReset) => {
		            if (willReset) 
		            	window.location.href = element.href;
		         });
		    return false;
    	}
    </script>
@endsection

@section('content')
	<div class="row justify-content-center mt-4 mb-2">
		<h3>Configuración del Sistema</h3>
	</div>
	<div class="row justify-content-center">
		<div class="col-12 col-lg-10 col-xl-8">
			<a id="btn_view_users" class="btn btn-sm btn-info border my-2 text-white" href="/users" data-toggle="tooltip" data-placement="top" title="Ir al listado de usuarios">Ver usuarios</a>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-12 col-lg-10 col-xl-8">
			<table class="table table-sm table-light table-hover table-responsive-lg my-3 border">
				<thead>
					<tr>
						<th scope="col" class="text-center border-bottom border-top">#</th>
						<th scope="col" class="text-center border-bottom border-top">Nombre</th>
						<th scope="col" class="text-center border-bottom border-top">Descripción</th>
						<th scope="col" colspan="2" class="text-center border-bottom border-top">Valor</th>
					</tr>
				</thead>
				<tbody>
				@foreach($settings as $setting)
					<form action="/settings/{{$setting->id}}" method="POST">
					@csrf
					@method('PUT')
						<tr>
							<th scope="row" class="align-middle border-0">{{ $loop->iteration }}</th>
							<td class="align-middle border-0">{{ $setting->alias }}</td>
							<td class="align-middle border-0">{{ $setting->description }}</td>
							<td class="text-center align-middle border-0">
								@if($setting->name == "pending_orders_alerts")
									<div class="btn-group btn-group-toggle" data-toggle="buttons">
									    <label class="btn btn-sm btn-info text-white {{ $setting->value == 1 ? 'active' : '' }}">
									        <input type="radio" name="value" value="1"> Sí
									    </label>
									    <label class="btn btn-sm btn-info text-white {{ $setting->value == 0 ? 'active' : '' }}">
									        <input type="radio" name="value" value="0"> No
									    </label>
									</div>
								@else
									<input type="text" name="value" value="{{ $setting->value }}" class="form-control form-control-sm shadow-sm" />
								@endif
							</td>
							<td class="align-middle border-0">
								<button type="submit" class="btn btn-sm btn-info shadow-sm text-white">Guardar</button>
							</td>
						</tr>
					</form>
				@endforeach
				</tbody>
			</table>
			<a class="btn btn-secondary btn-sm float-right mb-3" data-toggle="tooltip" data-placement="top" title="Ver manual de ayuda" href="/help#configuraciones">Acerca de esta pantalla</a>
			<a class="btn btn-secondary btn-sm float-right mb-3 mr-3" href="/settings/reset" onclick="return confirmReset(this);">Restablecer configuración</a>
		</div>
	</div>
@endsection
