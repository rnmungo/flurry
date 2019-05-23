@extends('layouts.app')
@section('title', 'Clientes')
@section('scripts')
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDu7tQ49-dLxuBPAb-Z3m3OfPCXRHB1RPQ" async defer></script>
	<script src="{{ asset('js/customers/customers.js') }}" defer></script>
	<script type="text/javascript">
		$(document).ready(function (){
			province = '{{config('ourconfig.location.province', 'Buenos Aires')}}';
			country = '{{config('ourconfig.location.country', 'Argentina')}}';
			customer = new Customer();
		});
	</script>
@endsection
@section('content')
	<div class="row justify-content-center mt-3">
		<h3 class="text-center">Nuevo Cliente</h3>
	</div>
	<form action="/customers" method="POST" autocomplete="off">
		@csrf
		@include('customers.form')
	</form>
@endsection