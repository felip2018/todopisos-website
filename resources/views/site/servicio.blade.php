@extends('templates.website')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="section-title">
                {{$servicio->name}}
            </div>
            <div class="alert alert-info">
                {{$servicio->description}}
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($productos as $p)
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="member-team">
                    <div class="card">
                        <img src="{{asset($p->img)}}" class="card-img-top" alt="{{$p->img}}">
                        <div class="card-body">
                            <h5 class="card-title">{{$p->name}}</h5>
                            <p class="card-text">{{$p->description}}</p>
                            <button class="btn btn-primary btn-block" onclick="addProductToQuotation({{$p->productId}},'{{$p->name}}','{{$p->img}}')">
                                <i class="fa fa-plus"></i> Agregar a cotización
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
@endsection