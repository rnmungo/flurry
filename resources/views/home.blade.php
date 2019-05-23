@extends('layouts.app')
@section('title', 'Inicio')
@section('content')
<div class="container">
    <div class="row justify-content-center text-center" >
		<svg viewBox="0 0 1800 600" class="svg-home">
		  <symbol id="s-text">
		    <text text-anchor="middle"
		          x="50%"
		          y="35%"
		          class="webcoderskull"
		          >
		      {{ config('app.name', 'Flurry') }} 
		    </text>
		    <text text-anchor="middle"
		          x="50%"
		          y="68%"
		          class="text--line"
		          >
		     Heladería
		    </text>
		  </symbol>
		  <g class="g-ants">
		    <use xlink:href="#s-text"
		      class="webcoderskull-1"></use>     
		    <use xlink:href="#s-text"
		      class="webcoderskull-1"></use>     
		    <use xlink:href="#s-text"
		      class="webcoderskull-1"></use>     
		    <use xlink:href="#s-text"
		      class="webcoderskull-1"></use>     
		    <use xlink:href="#s-text"
		      class="webcoderskull-1"></use>     
		  </g>
		</svg>
    </div>
</div>
@endsection
