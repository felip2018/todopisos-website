@extends('templates.app')

@section('content')
    <div class="row section">
        <div class="col-12">
            <div class="section-title">
                Formulario de contacto
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                        <th>Datos</th>
                        <th>Mensaje</th>
                        <th>Opciones</th>
                    </thead>
                    <tbody>
                        @foreach($data as $c)
                            <?php
                                $bg = $c->status == 'CONTACTADO' ? "#1dd1a1" : "#feca57";
                                ?>
                            <tr>
                                <td>
                                    <p>
                                        {{$c->name}}<br>
                                        {{$c->email}}<br>
                                        {{$c->phone}}<br>
                                        <span style="background-color: {{$bg}}; color: #ffffff;padding: 5px; border-radius: 5px;">{{$c->status}}</span>
                                    </p>
                                </td>
                                <td>
                                    {{$c->message}}
                                </td>
                                <td>
                                    @if($c->status == 'ACTIVO')
                                        <button class="btn btn-info" title="Marcar como contactado" onclick="updateContactFormStatus({{$c->id}}, 'CONTACTADO')">
                                            <i class="fa fa-check"></i>
                                        </button>
                                    @else
                                        <button class="btn btn-warning" title="Desmarcar" onclick="updateContactFormStatus({{$c->id}}, 'ACTIVO')">
                                            <i class="fa fa-undo"></i>
                                        </button>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
