<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{config('app.name', 'Flurry')}} - Iniciar Sesión</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Damion|Muli:400,600" rel="stylesheet" type="text/css">
        <!-- Scripts -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDu7tQ49-dLxuBPAb-Z3m3OfPCXRHB1RPQ" async defer></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/sweetalert.min.js') }}"></script>
        <script type="text/javascript">
            function init_geolocation() {
                function geolocalization(pos) {
                    var form = document.getElementById("login");
                    var coords = pos.coords;
                    var latlng = new google.maps.LatLng(coords.latitude, coords.longitude);
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({
                        'location': latlng
                    }, function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            var latitude = document.createElement("input");
                            latitude.setAttribute("type", "hidden");
                            latitude.setAttribute("name", "latitude");
                            latitude.setAttribute("value", results[0].geometry.location.lat().toFixed(8));
                            form.appendChild(latitude);
                            var longitude = document.createElement("input");
                            longitude.setAttribute("type", "hidden");
                            longitude.setAttribute("name", "longitude");
                            longitude.setAttribute("value", results[0].geometry.location.lng().toFixed(8));
                            form.appendChild(longitude);
                            var address = document.createElement("input");
                            address.setAttribute("type", "hidden");
                            address.setAttribute("name", "address");
                            address.setAttribute("value", results[0].formatted_address);
                            form.appendChild(address);
                            form.submit();
                        }
                    })

                }
                function catch_location(err) {
                    console.warn('Error ' + err.code + ': ' + err.message);
                    document.getElementById("login").submit();
                }
                var options = {
                    enableHighAccuracy: true,
                    timeout: 20000,
                    maximumAge: 0
                };
                navigator.geolocation.getCurrentPosition(geolocalization, catch_location, options);
            }
            function focus_password_field(e) {
                if (e.KeyCode == 13 || e.which == 13) { document.getElementById('password').focus(); }
            }
            function confirm_login(e) {
                if (e.KeyCode == 13 || e.which == 13) { init_geolocation(); }
            }
        </script>
        <!-- Styles -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    </head>
    <body>
        @include('sweet::alert')
        <div class="container" style="margin-top: 12%;">
            <div class="row justify-content-center mt-5 text-center">
                <div class="col-10 col-md-6 col-lg-4 shadow border bg-white">
                    <form id="login" method="POST" action="{{ route('login') }}" autocomplete="off">
                        @csrf
                        <img src="/imagenes/iconos/Flurry.png" class="img-fluid img-circle my-4" style="height: 6rem;" >
                        <div class="form-group row">
                            <div class="col-12">
                                <label class="field a-field a-field_a2 page__field">
                                    <input type="text" class="field__input a-field__input" placeholder=" " id="name" name="name" value="{{ old('name') }}" onkeypress="focus_password_field(event);" required>
                                    <span class="a-field__label-wrap">
                                        <span class="a-field__label">Usuario</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label class="field a-field a-field_a2 page__field">
                                    <input type="password" class="field__input a-field__input" placeholder=" " id="password" name="password" value="{{ old('password') }}" onkeypress="confirm_login(event);" required>
                                    <span class="a-field__label-wrap">
                                        <span class="a-field__label">Contraseña</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <div class="col-12">
                                <button type="button" class="btn btn-dark rounded shadow my-3" onclick="init_geolocation();">
                                    Iniciar Sesión
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>