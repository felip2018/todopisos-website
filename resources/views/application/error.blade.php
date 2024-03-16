@extends('templates.app')

@section('content')
    <div class="row section">
        <div class="col-12">
            <div class="alert alert-warning">
                <label>Lo sentimos, se ha presentado un error</label>
                <p>{{$error_message}}</p>
            </div>
        </div>

    </div>
@endsection
