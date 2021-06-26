@extends('templates.website')

@section('content')
    <div class="row section">
        <div class="col-12">
            <div class="section-title">
                Contáctenos
            </div>
        </div>
        <div class="col-12">
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.083963083147!2d-74.04772229289436!3d4.75543118845024!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f859a02f2e839%3A0x8cddbf0f0c721c36!2sCl.%20174b%20%2347-49%2C%20Bogot%C3%A1!5e0!3m2!1ses-419!2sco!4v1624670623323!5m2!1ses-419!2sco" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="location-data">
                <h3>Visitanos</h3>
                <table class="table table-address">
                    <tr>
                        <td><b>Dirección</b></td><td>Calle 174B-47-63 Costado sur del home center</td>
                    </tr>
                    <tr>
                        <td><b>Cel</b></td><td>3144348273</td>
                    </tr>
                    <tr>
                        <td><b>Tel</b></td><td>5265432</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="row section">
        <div class="col-12">
            <div class="section-secondary-title">
                Formulario de contacto
            </div>
        </div>
        <div class="col-12">
            <div class="row justify-content-center">
                <div class="col-xs-12 col-md-6">
                    <p class="contact-form-text">
                        Déjanos tu mensaje y nos pondremos en contacto cuanto antes.
                    </p>
                    <div class="col-12 form-container">
                        <form class="row">
                            <div class="col-xs-12 col-md-12">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <label for="email">Correo electrónico</label>
                                <input type="text" class="form-control" id="email">
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <label for="phone">Teléfono</label>
                                <input type="text" class="form-control" id="phone">
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <label for="message">Mensaje</label>
                                <textarea type="text" rows="5" class="form-control" id="message"></textarea>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <hr>
                                <button class="btn btn-primary btn-block">
                                    <i class="fas fa-paper-plane"></i> Enviar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection