@extends('templates.website')

@section('content')
    <div class="row section">
        <div class="col-12">
            <div class="section-title">
                Iniciar sesión
            </div>
        </div>
        <div class="col-12">
            <div class="row justify-content-center">
                <div class="col-xs-12 col-md-6">
                    <p class="contact-form-text">
                        Ingresa tus datos de usuario para iniciar sesión.
                    </p>
                    <div class="col-12 form-container">
                        <form class="row">
                            <div class="col-xs-12 col-md-12">
                                <label for="user">Usuario</label>
                                <input type="text" class="form-control" id="user">
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <label for="pass">Contraseña</label>
                                <input type="password" class="form-control" id="pass">
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <hr>
                                <button type="button" class="btn btn-success btn-block">
                                    <i class="fas fa-sign-in-alt"></i> Iniciar sesión
                                </button>
                                <a type="button" class="btn btn-info btn-block" href="/registrarse" target="_blank">
                                    <i class="fas fa-user-tie"></i> Registrarse como cliente
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection