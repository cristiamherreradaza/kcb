@extends('layouts.app')

@section('content')

<!--begin::Card-->
<div class="card card-custom gutter-b">
    <div class="card-header flex-wrap py-3">
        <div class="card-title">
            <h3 class="card-label">LISTADO DE CAMBIOS
            </h3>
        </div>
        <div class="card-toolbar">
            <!--begin::Button-->
            <a href="{{ url('Ejemplar/formulario/0') }}" class="btn btn-primary font-weight-bolder" onclick="nuevo()">
                <i class="fa fa-plus-square"></i> NUEVO EJEMPLAR
            </a>
            <!--end::Button-->
        </div>
    </div>

    <div class="card-body">
        @forelse ($modificaciones as $m)
            @php
                $original = json_decode($m->original, true);
                $modificacion = json_decode($m->cambio, true);
            @endphp
            <h3>Usuario: Administrador</h3>
            <h3>Fecha Hora: {{ $m->created_at }}</h3>
            <table class="table table-bordered table-hover table-striped" id="tabla_criaderos">
                <thead>
                    <tr>
                        <th>Campo</th>
                        <th>Original</th>
                        <th>Modificacion</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        if($original['kcb'] == $modificacion['kcb']){
                            $estilo = '';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp

                    <tr {!! $estilo !!}>
                        <td>KCB</td>
                        <td>{{ $original['kcb'] }}</td>
                        <td>{{ $modificacion['kcb'] }}</td>
                    </tr>
                    @php
                        if($original['nombre'] == $modificacion['nombre']){
                            $estilo = '';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>NOMBRE</td>
                        <td>{{ $original['nombre'] }}</td>
                        <td>{{ $modificacion['nombre'] }}</td>
                    </tr>
                </tbody>
            </table>
        @empty
                
        @endforelse
    </div>
</div>
<!--end::Card-->
@stop