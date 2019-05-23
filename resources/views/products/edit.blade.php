@extends('layouts.app')
@section('title', 'Productos')
@section('style')
	<link href="{{ asset('css/products.css') }}" rel="stylesheet">
@endsection

@section('content')
	<div class="row justify-content-center mt-3">
		<h3>Edición de Producto - {{$product->name}}</h3>
	</div>
	<div class="row justify-content-center">
		<div class="col-12 col-sm-10 col-md-12 col-lg-8 col-xl-6">
			<div class="container my-3 px-3 py-3">
				<form id="product-form" action="/products/{{$product->id}}" method="POST" enctype="multipart/form-data" autocomplete="off">
					@csrf
					@method('PUT')
					@include('products.form')
					<button type="submit" class="btn btn-sm btn-info text-white">Guardar</button>
				</form>
			</div>
		</div>
	</div>
@endsection