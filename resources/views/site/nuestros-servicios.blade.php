@extends('templates.website')

@section('content')
    <div class="row section">
        <div class="col-12">
            <div class="section-title">
                Nuestros servicios
            </div>
        </div>
        <div class="col-12">
            <div class="row">
                @foreach ($servicios as $service)
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="member-team">
                            <div class="card">
                                <img src="{{asset($service->img)}}" class="card-img-top" alt="{{$service->img}}">
                                <div class="card-body">
                                    <h5 class="card-title">{{$service->name}}</h5>
                                    <p class="card-text">{{$service->description}}</p>
                                    <a class="btn btn-primary btn-block" href="servicio/{{$service->productLineId}}">
                                        <i class="fa fa-eye"></i> Ver
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection