@extends('layouts.app')
@section('title', 'Gustos')
@section('scripts')
	<script src="//cdn.rawgit.com/twbs/bootstrap/v4.1.3/dist/js/bootstrap.bundle.min.js" defer></script>
	<script src="{{ asset('js/bootstrap-colorpicker.min.js') }}" defer></script>
	<script type="text/javascript">
		$(window).on('load', function() {
		    $('#cp1').colorpicker({
		    	 format: "hex",
		    	 useHashPrefix: false
		    });
		});
	</script>
@endsection

@section('style')
	<link href="{{ asset('css/bootstrap-colorpicker.css') }}" rel="stylesheet">
	<style>
		.form-cont {
			min-width: 30rem;
			width: 55rem;
		}

		.form-group input[type="text"] {
		    width: 30rem;
		}

		button[type="submit"] {
			margin:0 auto;
			display: block;
		}
	</style>
@endsection

@section('content')
	<div class="row justify-content-center mt-3">
		<h3>Edición de Gusto - {{$taste->name}}</h3>
	</div>
	<div class="row justify-content-center">
		<div class="col-12 col-lg-6 col-xl-5">
			<div class="container border rounded my-2 shadow-sm">
				<form action="/tastes/{{$taste->id}}" method="POST" autocomplete="off">
					@csrf
					@method('PUT')
					@include('tastes.form', ['taste' => $taste])
					<button type="submit" class="btn btn-sm btn-info mb-3 text-white">Guardar</button>
				</form>
			</div>
		</div>
	</div>
@endsection