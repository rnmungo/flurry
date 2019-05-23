<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Flurry') }} - Acerca de</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
        <style>
            .text {
                font-size: 1.3rem;
                display: inline-block;
                text-align: left;
            }

            .bottom-center {
                position: absolute;
                bottom: 18px;
            }

            @media (min-width: 481px) and (max-width: 767px) {
                .text {
                    font-size: 1.2rem;
                    max-width: 90%;
                }
            }

            @media (max-width: 480px) {
                .text {
                    font-size: 1.1rem;
                    max-width: 75%;
                }
            }
        </style>
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
                    <img src="/imagenes/DueSystemLogo.png" class="img-fluid img-circle logo" >
                </div>

                <div class="text">
                    <b>{{ config('app.name', 'Flurry') }}</b> es un sistema web ideado para la gestión completa de su negocio.
                    <br><br>Desarrollado por:
                    <br>Contacto:
                    <br><br>Versión 1.0. Abril de 2019.
                </div>
            </div>
            <div class="bottom-center links">
                <a href="/">Volver</a>
            </div>
        </div>
    </body>
</html>
