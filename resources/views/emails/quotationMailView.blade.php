<!DOCTYPE html>
<html>
<head>
    <title>Todo en pisos y cortinas</title>
    <style>
        .container {
            width:800px;
            margin:auto;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px #CCCCCC;
        }
        .title {
            text-align: center;
        }
        img {
            width: 50%;
        }
        .customerInfo {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 50px;
            background-color: beige;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">
            @if(isset($message))
                <img src="{{$message->embed('assets/img/logo_todopisos_alt.png')}}" alt="logo_todopisos_alt.png">
            @else
                <img src="{{asset('assets/img/logo_todopisos_alt.png')}}" alt="logo_todopisos_alt.png">
            @endif
        </div>
        <p>{{$body}}</p>
        <div class="customerInfo">
            <b>Nombre</b>
            <p>{{$user->fullname}}</p>
            <b>Identificación</b>
            <p>{{$user->docType.' '.$user->docNum}}</p>
            <b>Teléfono</b>
            <p>{{$user->phone}}</p>
            <b>Dirección</b>
            <p>{{$user->address}}</p>
        </div>
        <hr>
        <div>
            <b>Lista de productos a cotizar: </b><br>
            @foreach ($products as $p)
            <b>{{$p["name"]}}</b><br>
            <label>Comentarios: </label><br>
            <p>{{$p["comment"]}}</p>
            @endforeach
        </div>
        <hr>
        <div>
            <b>Comentarios generales: </b>
            <p>{{$customerObservations}}</p>
        </div>
    </div>
</body>
</html>