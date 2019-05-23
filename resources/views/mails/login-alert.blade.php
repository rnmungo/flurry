<div style="text-align: justify;">
	<p>Estimado/a {{ Auth::user()->name }}, se le informa que hubo un inicio de sesión en el sistema <b>{{ config('app.name', 'Flurry') }}</b>@isset($latitude) desde {{ $address }} (Latitud: {{ $latitude }} - Longitud: {{ $longitude }} @endisset.
	</p>
	</br>
	<p>Si no fue usted, comuníquese con su área de trabajo para alertar sobre este incidente.</p>
	</br>
	</br>
	<p>Le recordamos que este es un mail automático, por favor no conteste el mail.</p>
</div>