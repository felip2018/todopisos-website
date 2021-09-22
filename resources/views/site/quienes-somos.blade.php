@extends('templates.website')

@section('content')
    <div class="row section">
        <div class="col-12">
            <div class="section-title">
                Quienes somos
            </div>
        </div>
        <div class="col-12">
            <div class="row justify-content-center">
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="resume">
                        <?php echo $data->description; ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8">
                    <div class="about-img">
                        <img src="{{asset($data->image)}}" alt="{{$data->image}}" width="100%" height="100%">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row section">
        <div class="col-12">
            <div class="section-secondary-title">
                Nuestro equipo
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="member-team">
                <div class="card">
                    <img src="{{asset('assets/img/dummy-user.png')}}" class="card-img-top" alt="dummy">
                    <div class="card-body">
                        <h5 class="card-title">Isabel</h5>
                        <p class="card-text">Diseñadora</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="member-team">
                <div class="card">
                    <img src="{{asset('assets/img/dummy-user.png')}}" class="card-img-top" alt="dummy">
                    <div class="card-body">
                        <h5 class="card-title">Juan</h5>
                        <p class="card-text">Instalador</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="member-team">
                <div class="card">
                    <img src="{{asset('assets/img/dummy-user.png')}}" class="card-img-top" alt="dummy">
                    <div class="card-body">
                        <h5 class="card-title">Carlos</h5>
                        <p class="card-text">Ventas</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="member-team">
                <div class="card">
                    <img src="{{asset('assets/img/dummy-user.png')}}" class="card-img-top" alt="dummy">
                    <div class="card-body">
                        <h5 class="card-title">María</h5>
                        <p class="card-text">Comercial</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection