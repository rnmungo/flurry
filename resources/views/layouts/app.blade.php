<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Flurry') }} - @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}" defer></script>
    <script src="{{ asset('js/functions.js') }}" defer></script>
    
    <!-- SweetAlert Scripts -->
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>

    <!-- Added scripts -->
    @yield('scripts')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Damion|Muli:400,600" rel="stylesheet" type="text/css">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    
    <!-- Added styles -->
    @yield('style')
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
            <div class="container" >
                <a class="navbar-brand" data-toggle="tooltip" data-placement="bottom" title="Volver a la página anterior" href="{{ url()->previous() }}">
                    <i class="far fa-arrow-alt-circle-left"></i>
                </a>                
                <a class="navbar-brand mr-auto" data-toggle="tooltip" data-placement="bottom" title="Pantalla de bienvenida" href="{{ url('/') }}">
                    <img src="/imagenes/iconos/Flurry.png" class="img-fluid img-circle icon" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @auth
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown">
                                <a id="navbarVen" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Ventas <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarVen">
                                    <a class="dropdown-item" href="/customers">
                                        Clientes
                                    </a>
                                    <a class="dropdown-item" href="/develop">
                                        Pedidos
                                    </a>
                                    <a class="dropdown-item" href="/develop">
                                        Pedidos (Borrador)
                                    </a>
                                </div>
                            </li>
                            @unless(Auth::user()->hasRole('Operator'))
                                <li class="nav-item dropdown">
                                    <a id="navbarAdm" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Administración <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarAdm">
                                        <a class="dropdown-item" href="/cadets">
                                            Cadetes
                                        </a>
                                        <a class="dropdown-item" href="/products">
                                            Productos
                                        </a>
                                        <a class="dropdown-item" href="/tastes">
                                            Gustos
                                        </a>
                                        <a class="dropdown-item" href="/develop">
                                            Agregados
                                        </a>
                                        <a class="dropdown-item" href="/develop">
                                            Motivos de cancelación
                                        </a>
                                        <a class="dropdown-item" href="/develop">
                                            Promociones
                                        </a>
                                    </div>
                                </li>
                            @endunless
                            @unless(Auth::user()->hasRole('Operator'))
                                <li class="nav-item dropdown mb-2 mb-lg-auto">
                                    <a id="navbarRep" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Reportes <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarRep">
                                        <a class="dropdown-item" href="/reports/develop">
                                            Diario Caja
                                        </a>
                                        <a class="dropdown-item" href="/reports/develop">
                                            Ventas
                                        </a>
                                        <a class="dropdown-item" href="/reports/develop">
                                            Productos más vendidos
                                        </a>
                                        <a class="dropdown-item" href="/reports/develop">
                                            Mejores Clientes
                                        </a>
                                        <a class="dropdown-item" href="/reports/develop">
                                            Reconvocatoria de Clientes
                                        </a>
                                        <a class="dropdown-item" href="/reports/develop">
                                            Cadetes
                                        </a>
                                        <a class="dropdown-item" href="/reports/develop">
                                            Histórico de precios
                                        </a>
                                        <a class="dropdown-item" href="/develop">
                                            Asistencia P/Elaboración de Gustos
                                        </a>
                                    </div>
                                </li>
                            @endunless
                        </ul>
                    @endauth
                    <!-- Right Side Of Navbar -->
                    @auth
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            <li class="nav-item dropdown mb-2 {{ Auth::user()->hasRole('Admin') ? '' : 'mt-2' }} my-lg-auto">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle p-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ Auth::user()->getAvatarFullPath() }}" class="img-fluid img-circle avatar d-none d-lg-inline" >
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item d-none d-lg-block" href="{{ route('users.change-avatar', ['user' => Auth::user()->random_id]) }}">
                                        Cambiar avatar
                                    </a>
                                    <a class="dropdown-item" href="{{ route('users.change-password', ['user' => Auth::user()->random_id]) }}">
                                        Cambiar contraseña
                                    </a>
                                    <a dusk="logout-button" class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Cerrar sesión
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li class="my-auto">
                                <a class="d-none d-lg-inline ml-5" href="/help" data-toggle="tooltip" data-placement="bottom" title="Ayuda">
                                    <i class="far fa-question-circle"></i>
                                </a>
                                <a class="nav-link d-lg-none" href="/help">
                                    Ayuda
                                </a>
                                @unless(Auth::user()->hasAnyRole(['Operator', 'Supervisor']))
                                    <a class="d-none d-lg-inline ml-1" href="/settings" data-toggle="tooltip" data-placement="bottom" title="Configuración del sistema">
                                        <i class="fas fa-cog" onclick="this.classList.add('fa-spin');"></i>
                                    </a>
                                    <a class="nav-link d-lg-none" href="/settings">
                                        Configuración
                                    </a>
                                @endunless
                            </li>
                        </ul>
                    @endauth
                </div>
            </div>
        </nav>
        @include('sweet::alert')
        <main class="container-fluid">
            @yield('content')
        </main>
    </div>
</body>
</html>
