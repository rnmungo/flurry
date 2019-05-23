@extends('layouts.app')
@section('title', 'Clientes')
@section('scripts')
    <script type="text/javascript">
    	function validateSearch(form) {
    		event.preventDefault();
    		if (!form.search.value || form.search.value.length >= 3)
    			form.submit();
    		else
    			swal("Ingrese al menos 3 caracteres.", {buttons: false, timer: 1300});
    	}
	</script>
@endsection

@section('style')
	<style>		
		th {
			border-top: 1px solid #dee2e6 !important;
			border-bottom: 1px solid #dee2e6 !important;
		}

		.fa-btn {
			border-top-left-radius: 0;
			border-bottom-left-radius: 0;
			cursor: pointer;
			line-height: 0;
		}
	</style>
@endsection

@section('content')
	<div class="row justify-content-center mt-4">
		<h3>Listado de Clientes</h3>
	</div>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-10 col-xl-8">
				<form name="searchform" action="/customers/" method="GET" onsubmit="validateSearch(this);">
					<div class="form-inline my-2">
						<div class="input-group input-group-sm mt-1">
							<input class="form-control form-control-sm" type="text" name="search" placeholder="Nombre, apellido, teléfono, e-mail..." autofocus style="width: 20rem;" @if(request()->query('search')) value="{{ request()->query('search') }}" @endif>
		        			<span class="input-group-addon shadow-sm" data-toggle="tooltip" data-placement="top" title="También puede presionar Enter." onclick="this.submit();">
		        				<span class="input-group-text bg-info text-white fa-btn h-100" onclick="searchform.submit();">
									<span class="float-left mr-2">Buscar</span>
									<i class="fas fa-search"></i>
								</span>
							</span>
						</div>
						<a href="/customers/create" class="btn btn-info ml-auto mt-1 float-right shadow-sm border text-white" data-toggle="tooltip" data-placement="top" title="Cargar un nuevo cliente"><strong>Nuevo</strong></a>
					</div>
				</form>
				<table class="table table-sm table-light border table-hover my-3 text-center">
					<thead>
						<tr>
							<th scope="col">Nombre Completo</th>
							<th scope="col">Teléfono</th>
							<th scope="col">Celular</th>
							<th scope="col">Email</th>
							<th scope="col">Dirección</th>
							<th scope="col">Localidad</th>
							<th scope="col">Modificar</th>
							<th scope="col">Eliminar</th>							
						</tr>
					</thead>
					<tbody>
						@foreach($customers as $customer)
							<tr>
								<td class="border-0 align-middle">{{ $customer->full_name }}</td>
								<td class="border-0 align-middle">
									<a href="/customers/{{ $customer->id }}" data-toggle="tooltip" data-placement="top" title="Ver más datos del cliente">{{$customer->full_phone}}</a>
								</td>
								<td class="border-0 align-middle">
									<a href="/customers/{{ $customer->id }}" data-toggle="tooltip" data-placement="top" title="Ver más datos del cliente">{{$customer->full_mobile}}</a>
								</td>
								<td class="border-0 align-middle">{{$customer->email}}</td>
								<td class="border-0 align-middle">{{$customer->address}}</td>
								<td class="border-0 align-middle">{{$customer->locality->name}}</td>
								<td class="border-0 align-middle">
									<a href="{{route('customers.edit', ['customer' => $customer->id])}}" class="btn btn-sm btn-info text-white"><i class="far fa-edit" style="font-size: 1.2rem;"></i></a>
								</td>
								<td class="border-0 align-middle">
									<form id="delete_form{{$customer->id}}" action="/customers/{{$customer->id}}" method="POST" >
										@csrf
										@method('DELETE')
										<button type="button" class="btn btn-sm btn-danger" onclick="delete_from_form('{{'delete_form'.$customer->id}}', 'cliente');"><i class="far fa-trash-alt" style="font-size: 1.2rem;"></i></button>
									</form>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<label>Mostrar
					<select name="per_page" class="custom-select custom-select-sm form-control form-control-sm w-auto" onchange="this.form.submit();">
						<option {{ $customers->perPage() == 10  ? "selected" : "" }}>10</option>
						<option {{ $customers->perPage() == 15  ? "selected" : "" }}>15</option>
						<option {{ $customers->perPage() == 20  ? "selected" : "" }}>20</option>
						<option {{ $customers->perPage() == 50  ? "selected" : "" }}>50</option>
						<option {{ $customers->perPage() == 100 ? "selected" : "" }}>100</option>
					</select> clientes, sobre un total de {{ $customers->total() }}.
				</label>
				<div class="d-flex justify-content-end">
					{{ $customers->appends(request()->input())->onEachSide(1)->links() }}
				</div>
			</div>
		</div>
	</div>
@endsection