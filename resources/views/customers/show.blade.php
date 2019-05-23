@extends('layouts.app')
@section('title', 'Cliente '.$customer->lastname)
@section('scripts')
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDu7tQ49-dLxuBPAb-Z3m3OfPCXRHB1RPQ" async defer></script>
	<script src="{{ asset('js/customers/customers.js') }}" defer></script>
	<script type="text/javascript" async defer>
		$(document).ready(function() {
			customer = new Customer();
			var latitude  = document.getElementById("latitude").value;
			var longitude = document.getElementById("longitude").value;
			if (latitude && longitude){
				customer.open_map("latitude", "longitude", "map");
			}
			else {
				var province  = '{{ config('ourconfig.location.province') }}';
				var country   = '{{ config('ourconfig.location.country') }}';
				var street    = '{{ $customer->street }}';
				var street_nr = '{{ $customer->street_number }}';
				var locality  = '{{ $customer->locality->name }}';
				customer.geolocation_show(province, country, street, street_nr, locality);
			}
		} );
	</script>
@endsection

@section('style')
	<style>
		.tab-content label {
		    font-weight: bold;
		}

		#map {
			height: 13rem;
		}

		.nav-link {
			background-color: transparent !important;
		}

		.fa-check {
			color: green;
		}

		.fa-exclamation {
			color: red;
		}

		.fa-question {
			color: blue;
		}
	</style>
@endsection

@section('content')

	<div class="row justify-content-center text-center mt-3">
		<div class="col-12">
			<h3>{{$customer->full_name}}</h3>
	 		<input id="customer_id" type="hidden" value="{{ $customer->id }}" />
	 		<input id="latitude"  name="latitude"  type="hidden" value="{{ $customer->latitude }}"  />
			<input id="longitude" name="longitude" type="hidden" value="{{ $customer->longitude }}" />
		</div>
	</div>
	<div class="row justify-content-center mt-1">
		<div class="col-12 col-lg-9 col-xl-7">
			<div class="container my-2">
				{{-- Tabs de Cliente --}}
				<div class="container border rounded shadow-sm" style="max-height: 20rem;">
					<ul id="tabs" class="nav nav-tabs m-1">
					    <li class="nav-item">
					        <a class="nav-link active" data-toggle="tab" href="#personalDataTab">Datos personales</a>
					    </li>
					    <li class="nav-item">
					        <a class="nav-link" data-toggle="tab" href="#addressTab">Domicilio</a>
					    </li>
					    <li class="nav-item">
					        <a class="nav-link" data-toggle="tab" href="#mapTab">Mapa</a>
					    </li>
					    <li class="nav-item">
					        <a class="nav-link" data-toggle="tab" href="#socialNetworksTab">Redes</a>
					    </li>
					</ul>
					<div class="tab-content p-2">
					    <div class="tab-pane fade active show" id="personalDataTab">
					    	<div class="row">
					    	    <div class="col-12 col-md-6">
					    	    	<div class="row">
					    	    	    <div class="col-4">
					    	    	        <label>Nombre</label>
					    	    	    </div>
					    	    	    <div class="col-8">
					    	    	        <p>{{$customer->name}}</p>
					    	    	    </div>
					    	    	</div>
					    	    	<div class="row">
					    	    	    <div class="col-4">
					    	    	        <label>Apellido</label>
					    	    	    </div>
					    	    	    <div class="col-8">
					    	    	        <p>{{$customer->lastname}}</p>
					    	    	    </div>
					    	    	</div>
					    	    	<div class="row">
					    	    	    <div class="col-4">
					    	    	        <label>E-Mail</label>
					    	    	    </div>
					    	    	    <div class="col-8">
					    	    	        <p style="word-wrap: break-word;">{{$customer->email}}</p>
					    	    	    </div>
					    	    	</div>
					    	    </div>
					    	    <div class="col-12 col-md-6">
					    	    	<div class="row">
					    	    	    <div class="col-4">
					    	    	        <label>Teléfono</label>
					    	    	    </div>
					    	    	    <div class="col-8">
					    	    	        <p>{{$customer->full_phone ?? '-'}}</p>
					    	    	    </div>
					    	    	</div>
					    	    	<div class="row">
					    	    	    <div class="col-4">
					    	    	        <label>Celular</label>
					    	    	    </div>
					    	    	    <div class="col-8">
					    	    	        <p>{{$customer->full_mobile ?? '-'}}</p>
					    	    	    </div>
					    	    	</div>
					    	    </div>
					    	</div>
					    </div>
					    <div class="tab-pane fade" id="addressTab">
							<div class="row">
					    	    <div class="col-12 col-md-6">
					    	    	<div class="row">
					    	    	    <div class="col-4">
					    	    	        <label>Calle</label>
					    	    	    </div>
					    	    	    <div class="col-8">
					    	    	        <p id="street">{{$customer->street}}</p>
					    	    	    </div>
					    	    	</div>
					    	    	@if($customer->between_street_one || $customer->between_street_two)
						    	    	<div class="row">
						    	    	    <div class="col-4">
						    	    	        <label>Entre calles</label>
						    	    	    </div>
						    	    	    <div class="col-8">
						    	    	        <p>{{$customer->between_street_one ?? '-'}}</p>
						    	    	    </div>
						    	    	</div>
						    	    	<div class="row">
						    	    	    <div class="col-4">
						    	    	        <label></label>
						    	    	    </div>
						    	    	    <div class="col-8">
						    	    	        <p>{{$customer->between_street_two ?? '-'}}</p>
						    	    	    </div>
						    	    	</div>
					    	    	@else
						    	    	<div class="row">
						    	    	    <div class="col-4">
						    	    	        <label>Entre calles</label>
						    	    	    </div>
						    	    	    <div class="col-8">
						    	    	        <p>-</p>
						    	    	    </div>
						    	    	</div>
					    	    	@endif
					    	    	<div class="row">
					    	    	    <div class="col-4">
					    	    	        <label>Localidad</label>
					    	    	    </div>
					    	    	    <div class="col-8">
					    	    	        <p id="locality">{{$customer->locality->name}}</p>
					    	    	    </div>
					    	    	</div>
					    		</div>
		    		    	    <div class="col-12 col-md-6">
		    		    	    	<div class="row">
					    	    	    <div class="col-4">
					    	    	        <label>Número</label>
					    	    	    </div>
					    	    	    <div class="col-8">
					    	    	        <p id="street_number">{{$customer->street_number}}</p>
					    	    	    </div>
					    	    	</div>
					    	    	<div class="row">
					    	    	    <div class="col-4">
					    	    	        <label>Piso</label>
					    	    	    </div>
					    	    	    <div class="col-8">
					    	    	        <p>{{$customer->floor ?? '-'}}</p>
					    	    	    </div>
					    	    	</div>
					    	    	<div class="row">
					    	    	    <div class="col-4">
					    	    	        <label>Departamento</label>
					    	    	    </div>
					    	    	    <div class="col-8">
					    	    	        <p>{{$customer->department ?? '-'}}</p>
					    	    	    </div>
					    	    	</div>
					    		</div>
					    	</div>					    	
			    	    </div>
		    	        <div class="tab-pane fade" id="mapTab">
		    	        	<div id="map" class="col-12 rounded shadow-sm mb-2">
		    	        		
		    	        	</div>
		    	    	</div>
			    	    <div class="tab-pane fade" id="socialNetworksTab">
			    			<div class="row">					    	
					    	    <div class="col-12 col-md-9 col-lg-8">
					    	    	<div class="row">
					    	    	    <div class="col-4 col-md-4">
					    	    	        <label>Facebook</label>
					    	    	    </div>
					    	    	    <div class="col-6 col-md-5">
					    	    	        @if($customer->facebook_nick)
					    	    	        	<p>
					    	    	        		<a href="http://www.facebook.com/{{$customer->facebook_nick}}" target="_blank" rel="noopener noreferrer">{{$customer->facebook_nick}}</a>
						    	    	        </p>
					    	    	        @else
					    	    	        	<p><i>Desconocido</i></p>
					    	    	        @endif
					    	    	    </div>
					    	    	    <div class="col-2 col-md-3 text-center">
    	    	        	    	        @if($customer->facebook_nick && $customer->facebook_verify)
    	    	        	    	        	<i class="fas fa-check" data-toggle="tooltip" data-placement="top" title="Cuenta verificada"></i>
    	    	        	    	        @elseif($customer->facebook_nick)
    	    	    							<i class="fas fa-exclamation" data-toggle="tooltip" data-placement="top" title="Cuenta no verificada"></i>
    	    	    						@else
    	    	    							<i class="fas fa-question" data-toggle="tooltip" data-placement="top" title="Cuenta desconocida"></i>
    	    	        	    	        @endif
					    	    	    </div>	
					    	    	</div>
					    	    	<div class="row">
					    	    	    <div class="col-4 col-md-4">
					    	    	        <label>Instagram</label>
					    	    	    </div>
					    	    	    <div class="col-6 col-md-5">
					    	    	    	@if($customer->instagram_nick)
					    	    	        	<p>
					    	    	        		<a href="http://www.instagram.com/{{$customer->instagram_nick}}" target="_blank" rel="noopener noreferrer">{{$customer->instagram_nick}}</a>
						    	    	        </p>
					    	    	        @else
					    	    	        	<p><i>Desconocido</i></p>
					    	    	        @endif
					    	    	    </div>
					    	    	    <div class="col-2 col-md-3 text-center">
    	    	        	    	        @if($customer->instagram_nick && $customer->instagram_verify)
    	    	        	    	        	<i class="fas fa-check" data-toggle="tooltip" data-placement="top" title="Cuenta verificada"></i>
    	    	        	    	        @elseif($customer->instagram_nick)
    	    	    							<i class="fas fa-exclamation" data-toggle="tooltip" data-placement="top" title="Cuenta no verificada"></i>
    	    	    						@else
    	    	    							<i class="fas fa-question" data-toggle="tooltip" data-placement="top" title="Cuenta desconocida"></i>
    	    	        	    	        @endif
					    	    	    </div>					    	    	    
					    	    	</div>
					    	    	<div class="row">
					    	    	    <div class="col-4 col-md-4">
					    	    	        <label>Twitter</label>
					    	    	    </div>
					    	    	    <div class="col-6 col-md-5">
					    	    	    	@if($customer->twitter_nick)
					    	    	        	<p>
					    	    	        		<a href="http://www.twitter.com/{{$customer->twitter_nick}}" target="_blank" rel="noopener noreferrer">{{$customer->twitter_nick}}</a>
					    	    	        	</p>
					    	    	        @else
					    	    	        	<p><i>Desconocido</i></p>
					    	    	        @endif
					    	    	    </div>
    	    	        	    	    <div class="col-2 col-md-3 text-center">
    	    	        	    	        @if($customer->twitter_nick && $customer->twitter_verify)
    	    	        	    	        	<i class="fas fa-check" data-toggle="tooltip" data-placement="top" title="Cuenta verificada"></i>
    	    	        	    	        @elseif($customer->twitter_nick)
    	    	    							<i class="fas fa-exclamation" data-toggle="tooltip" data-placement="top" title="Cuenta no verificada"></i>
    	    	    						@else
    	    	    							<i class="fas fa-question" data-toggle="tooltip" data-placement="top" title="Cuenta desconocida"></i>
    	    	        	    	        @endif
    	    	        	    	    </div>
					    	    	</div>
					    	    </div>
					    	</div>
					    </div>
					</div>
				</div>

				{{-- Estadísticas / Últimos pedidos --}}
				<div class="container border rounded shadow-sm mt-3" style="min-height: 17.5rem;">
					<ul class="nav nav-tabs m-1">
					    <li class="nav-item">
					        <a class="nav-link active" data-toggle="tab" href="#statisticsTab">Estadísticas</a>
					    </li>
					    <li class="nav-item">
					        <a class="nav-link" data-toggle="tab" href="#lastOrdersTab">Últimos pedidos</a>
					    </li>
					</ul>
					<div class="tab-content p-2">
					    <div class="tab-pane fade active show" id="statisticsTab">
			    	    	<div class="row">
			    	    	    <div class="col-4">
			    	    	        <label>Dado de alta</label>
			    	    	    </div>
			    	    	    <div class="col-8">
			    	    	        <p>{{$customer->created_at->isoFormat('LL')}}</p>
			    	    	    </div>
			    	    	</div>
			    	    	<div class="row">
			    	    	    <div class="col-4">
			    	    	        <label>Última compra</label>
			    	    	    </div>
			    	    	    <div class="col-8">
		    	    	        	<p>Ninguna compra aún.</p>
			    	    	    </div>
			    	    	</div>
			    	    	<div class="row">
			    	    	    <div class="col-4">
			    	    	        <label>Cantidad de compras</label>
			    	    	    </div>
			    	    	    <div class="col-8">
			    	    	        <p>0</p>
			    	    	    </div>
			    	    	</div>
			    	    	<div class="row">
			    	    	    <div class="col-4">
			    	    	        <label>Dinero gastado</label>
			    	    	    </div>
			    	    	    <div class="col-8">
			    	    	        <p>$ 0.00</p>
			    	    	    </div>
			    	    	</div>
			    	    	<div class="row">
			    	    	    <div class="col-4">
			    	    	        <label data-toggle="tooltip" data-placement="top" title="El más pedido por este cliente">Producto favorito</label>
			    	    	    </div>
			    	    	    <div class="col-8">
	    	    	    	    	<p>Ninguna compra aún.</p>
			    	    	    </div>
			    	    	</div>
					    </div>
					    <div class="tab-pane fade" id="lastOrdersTab">
	    	        		<p>Este cliente no realizó ningún pedido aún.</p>
						</div>
					</div>
				</div>

				{{-- Acciones --}}
				<div class="container border rounded shadow-sm mt-3 pt-1 pb-3">
            		<legend style="font-size: 1.2rem;">Acciones</legend>
					<div class="col-12 col-sm-6 col-lg-5 col-xl-3">
						<a href="/customers/{{$customer->id}}/edit" class="btn btn-sm btn-info w-100 my-1 text-white shadow-sm">Editar cliente</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection