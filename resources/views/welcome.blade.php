<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Flurry') }} - Bienvenido</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Inicio</a>
                    @else
                        <a href="{{ route('login') }}">Iniciar Sesión</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div>
                    <img src="/imagenes/iconos/Flurry.png" class="img-fluid img-circle logo" >
                </div>

                <div class="title m-b-md">
                    {{config('app.name', 'Flurry')}}
                </div>

                <div class="links">
                    @auth
                        <a href="/orders">Ventas</a>
                        @if(Auth::user()->hasAnyRole(['Admin', 'Manager', 'Supervisor']))
                            <a href="/products">Administración</a>
                        @endif
                        @if(Auth::user()->hasAnyRole(['Admin', 'Manager', 'Supervisor']))
                            <a href="/reports">Reportes</a>
                        @endif
                    @else
                        <a href="/orders">Ventas</a>
                    @endauth
                </div>
            </div>
            <div class="bottom-right links">
                <a href="/about">Acerca de...</a>
            </div>
        </div>
    </body>
</html>
