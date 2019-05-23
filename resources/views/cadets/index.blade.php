@extends('layouts.app')
@section('title', 'Cadetes')
@section('scripts')
	<!-- DataTables Scripts -->
    <script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}" defer></script>
    <script src="{{ asset('js/cadets/cadets.js') }}" defer></script>
   	<script type="text/javascript">
		$(document).ready(function() {
			cadet = new Cadet();
			cadet.init_vars();
		});
	</script>
@endsection

@section('style')
	<link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
	<div class="row justify-content-center mt-4">
		<h3>Listado de Cadetes</h3>
	</div>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-12 col-md-10 col-lg-6 col-xl-4">
				<form class="form-inline my-2 my-lg-2" id="new_form" action="/cadets" method="POST" >
					@csrf
					<button type="button" class="btn btn-sm btn-info ml-auto shadow-sm float-right text-white" data-toggle="tooltip" data-placement="top" title="Crea un nuevo cadete" onclick="cadet.setName()"><strong>Nuevo</strong></button>
					<input type="hidden" id="newCadetName" name="name" >
				</form>
				<table class="table table-sm table-light table-hover my-3 table-responsive-lg border text-center" id="cadetsTable">
					<thead>
						<tr>
							<th scope="col" class="text-center border-bottom">Nombre</th>
							<th scope="col" class="text-center border-bottom">Modificar</th>
							<th scope="col" class="text-center border-bottom">Eliminar</th>
						</tr>
					</thead>
					<tbody>
						@foreach($cadets as $cadet)
							<tr>
								<td class="border-0 align-middle">{{$cadet->name}}</td>
								<td class="border-0 align-middle">
									<form id="form_edit{{$cadet->id}}" action="/cadets/{{$cadet->id}}" method="POST" >
										@csrf
										@method('PUT')
										<button type="button" class="btn btn-sm btn-info text-white" onclick="cadet.setName('{{$cadet->name}}', {{$cadet->id}});"><i class="far fa-edit" style="font-size: 1.5rem;"></i></button>
								    	<input type="hidden" id="updateCadetName" name="name" >
									</form>
								</td>
								<td class="border-0 align-middle">
									<form id="form_delete{{$cadet->id}}" action="/cadets/{{$cadet->id}}" method="POST" >
										@csrf
										@method('DELETE')
										<button type="button" class="btn btn-sm btn-danger" onclick="delete_from_form('{{'form_delete'.$cadet->id}}', 'cadete');"><i class="far fa-trash-alt" style="font-size: 1.5rem;"></i></button>
									</form>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table> 
			</div>
		</div>
	</div>
@endsection