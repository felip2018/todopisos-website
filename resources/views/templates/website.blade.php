<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Todo en pisos y cortinas</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('assets/css/website.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.css')}}">
    </head>
    <body>

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <img class="logo-todopisos" src="{{asset('assets/img/logo_todopisos_alt.png')}}" alt="Logo Todopisos">
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <div class="navigation-menu">
                            <table class="table">
                                <tr>
                                    <td><a href="/">Inicio</a></td>
                                    <td><a href="/quienes-somos">Quienes somos</a></td>
                                    <td><a href="/nuestros-servicios">Nuestros servicios</a></td>
                                    <td><a href="/contactenos">Contáctenos</a></td>
                                    <td><a href="/iniciar-sesion"><i class="fas fa-sign-in-alt"></i> Iniciar sesión</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                @yield('content')

            </div>
        </div>

        
        <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    </body>
</html>
