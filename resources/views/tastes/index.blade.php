@extends('layouts.app')
@section('title', 'Gustos')
@section('scripts')
	<!-- DataTables Scripts -->
    <script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}" defer></script>
    <script src="{{ asset('js/tastes/tastes.js') }}" defer></script>
   	<script type="text/javascript">
		$(document).ready(function() {
			taste = new Taste();
			taste.init_vars();
		});
	</script>
@endsection

@section('style')
	<link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
	<div class="row justify-content-center mt-4">
		<h3>Listado de Gustos</h3>
	</div>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-10 col-xl-8">
				<div class="form-inline my-2 my-lg-2">
					<div class="input-group input-group-sm mt-1">
						<input class="form-control form-control-sm" type="text" placeholder="Nombre o descripción..." id="searchText" autofocus style="width: 18rem;">
            			<span class="input-group-addon shadow-sm">
            				<span class="input-group-text bg-info text-white h-100" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
								<i class="fas fa-search"></i>
							</span>
						</span>
					</div>
					<a id="btn_new_taste" href="/tastes/create" class="btn btn-sm btn-info ml-auto float-right text-white" data-toggle="tooltip" data-placement="top" title="Crea un nuevo gusto"><strong>Nuevo</strong></a>
				</div>
				<table class="table table-sm table-light table-hover my-3 table-responsive-lg border text-center" id="tastesTable" >
					<thead>
						<tr>
							<th scope="col" class="border-bottom">Nombre</th>
							<th scope="col" class="border-bottom">Descripción</th>
							<th scope="col" class="border-bottom">Modificar</th>
							<th scope="col" class="border-bottom">Eliminar</th>
						</tr>
					</thead>
					<tbody>
						@foreach($tastes as $taste)
							<tr>
								<td class="border-0 align-middle {{$taste->white_text ? 'text-white' : 'text-dark'}}" style="background-color: #{{$taste->color}};">{{$taste->name}}</td>
								<td class="border-0 align-middle">{{$taste->description}}</td>
								<td class="border-0 align-middle">
									<form id="edit_form{{$taste->id}}" action="/tastes/{{$taste->id}}/edit" method="GET" >
										<button type="button" class="btn btn-sm btn-info text-white" onclick="document.getElementById('{{'edit_form'.$taste->id}}').submit();"><i class="far fa-edit" style="font-size: 1.5rem;"></i></button>
									</form>
								</td>
								<td class="border-0 align-middle">
									<form id="delete_form{{$taste->id}}" action="/tastes/{{$taste->id}}" method="POST" >
										@csrf
										@method('DELETE')
										<button type="button" class="btn btn-sm btn-danger" onclick="delete_from_form('{{'delete_form'.$taste->id}}', 'gusto');"><i class="far fa-trash-alt" style="font-size: 1.5rem;"></i></button>
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