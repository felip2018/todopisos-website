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
        @foreach ($data->ourTeam as $person)
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="member-team">
                    <div class="card">
                        <img src="{{asset($person->img)}}" class="card-img-top" alt="{{$person->img}}">
                        <div class="card-body">
                            <h5 class="card-title">{{$person->name}}</h5>
                            <p class="card-text">{{$person->job}}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection