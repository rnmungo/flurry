@extends('layouts.app')
@section('title', 'Productos')
@section('scripts')
	<!-- DataTables Scripts -->
    <script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}" defer></script>
    <script src="{{ asset('js/products/products.js') }}" defer></script>
   	<script type="text/javascript">
		$(document).ready(function() {
			product = new Product();
			product.init_vars();
		});
	</script>
@endsection

@section('style')
	<link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
	<style>	
		.product {
			height: 3rem;
			width: 3rem;
		}
	</style>
@endsection

@section('content')
	<div class="row justify-content-center mt-4">
		<h3>Listado de Productos</h3>
	</div>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-10 col-xl-8">
				<div class="form-inline my-2 my-lg-2">
					<div class="input-group input-group-sm mt-1">
						<input class="form-control form-control-sm" type="text" placeholder="Nombre, descripción o precio..." id="searchText" autofocus style="width: 18rem;">
            			<span class="input-group-addon shadow-sm">
            				<span class="input-group-text bg-info text-white h-100" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
								<i class="fas fa-search"></i>
							</span>
						</span>
					</div>
					<a id="btn_new_product" href="/products/create" class="btn btn-sm btn-info ml-auto mt-1 float-right shadow-sm border text-white" data-toggle="tooltip" data-placement="top" title="Crea un nuevo producto"><strong>Nuevo</strong></a>
				</div>
				<table class="table table-sm table-light table-hover my-3 table-responsive-lg border text-center" id="productsTable" >
					<thead>
						<tr>
							<th scope="col" class="text-center border-bottom"></th>
							<th scope="col" class="text-center border-bottom">Producto</th>
							<th scope="col" class="text-center border-bottom">Descripción</th>
							<th scope="col" class="text-center border-bottom">Precio</th>
							<th scope="col" class="text-center border-bottom">Gustos</th>
							<th scope="col" class="text-center border-bottom">Modificar</th>
							<th scope="col" class="text-center border-bottom">Eliminar</th>
						</tr>
					</thead>
					<tbody>
						@foreach($products as $product)
							<tr>
								<td class="border-0 align-middle"><img src='/imagenes/productos/{{$product->picture}}' class="product"></td>
								<td class="border-0 align-middle text-left">{{$product->name}}</td>
								<td class="border-0 align-middle">{{$product->description}}</td>
								<td class="border-0 align-middle">{{'$'.$product->price}}</td>
								<td class="border-0 align-middle">{{$product->hasTastes ? $product->max_tastes : '-'}}</td>
								<td class="border-0 align-middle">
									<form id="edit_form{{$product->id}}" action="/products/{{$product->id}}/edit" method="GET" >
										<button type="button" class="btn btn-sm btn-info text-white" onclick="document.getElementById('{{'edit_form'.$product->id}}').submit();"><i class="far fa-edit" style="font-size: 1.5rem;"></i></button>
									</form>
								</td>
								<td class="border-0 align-middle">
									<form id="delete_form{{$product->id}}" action="/products/{{$product->id}}" method="POST" >
										@csrf
										@method('DELETE')
										<button type="button" class="btn btn-sm btn-danger" onclick="delete_from_form('{{'delete_form'.$product->id}}', 'producto');"><i class="far fa-trash-alt" style="font-size: 1.5rem;"></i></button>
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