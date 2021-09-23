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
        <script src="{{asset('assets/js/variables.js')}}"></script>
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
                                    <td>
                                      <a href="/carrito">
                                        <i class="fas fa-shopping-cart"></i>
                                        <label id="numberItems">0</label>
                                      </a>
                                    </td>
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

        <style>
            .owl-carousel .item {
              background: #FFFFFF;
              padding: 10px;
              border:1px solid #CCCCCC;
              border-radius: 5px;
              box-shadow: 0px 0px 10px #CCCCCC;
            }
            .owl-carousel .item b {
              color: #333333;
            }
            </style>
            <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
            <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
            <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}" />
            <link rel="stylesheet" href="{{asset('assets/css/owl.theme.green.min.css')}}"/>           
            
            
            <script>
              jQuery(document).ready(function($){
                $('.owl-carousel').owlCarousel({
                  loop: false,
                  margin: 10,
                  nav: false,
                  responsive:{
                    0:{
                      items:1
                    },
                    600:{
                      items:3
                    },
                    1000:{
                      items:3
                    }
                  }
                })
              });

              if (localStorage.getItem('carrito')) {
                const carrito = JSON.parse(localStorage.getItem('carrito'));
                jQuery('#numberItems').html(carrito.length);
              } else {
                jQuery('#numberItems').html(0);
              }
        </script>
    </body>
</html>
