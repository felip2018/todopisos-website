<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Todo pisos y cortinas</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('assets/css/website.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/footer.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/gallery.css')}}">
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
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                              <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto" style="width: 100%;">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/">Inicio</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/quienes-somos">Quienes somos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/nuestros-servicios">Nuestros servicios</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/contactenos">Contáctenos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/galeria">Galería</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/iniciar-sesion"><i class="fas fa-sign-in-alt"></i> Iniciar sesión</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>

                @yield('content')

                <footer>
                        <div class="row justify-content-center" style="text-align: center">
                            <div class="col-12">
                                <p>Todopisos y Cortinas - 2024&#169;</p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="row justify-content-center">
                                    <!--<div class="col-xs-12 col-sm-12 col-md-4">
                                        <a target="_blank" href="https://www.facebook.com/ceasdance?mibextid=b06tZ0">
                                            <img src="{{asset('assets/img/Iconos/facebook.png')}}" alt="">
                                        </a>
                                        <p>Facebook </p>
                                    </div>-->
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <div class="clickeable">
                                            <a target="_blank" href="https://www.instagram.com/todopisos06?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">
                                                <img src="{{asset('assets/img/Iconos/instagram.png')}}" alt="">
                                            </a>
                                            <p>Instagram</p>
                                        </div>

                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <div class="clickeable">
                                            <a target="_blank" href="https://wa.me/3144348273">
                                                <img src="{{asset('assets/img/Iconos/whatsapp.png')}}" alt="">
                                            </a>
                                            <p>Whatsapp</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </footer>

            </div>
        </div>


        <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/js/quotation.js')}}"></script>
        <script src="{{asset('assets/js/contact-form.js')}}"></script>

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
