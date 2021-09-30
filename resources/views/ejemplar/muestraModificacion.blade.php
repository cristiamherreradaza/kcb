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
            {{-- <a href="{{ url('Ejemplar/formulario/0') }}" class="btn btn-primary font-weight-bolder" onclick="nuevo()">
                <i class="fa fa-plus-square"></i> NUEVO EJEMPLAR
            </a> --}}
            <!--end::Button-->
        </div>
    </div>

    <div class="card-body">
        @forelse ($modificaciones as $m)
            @php
                $original = json_decode($m->original, true);
                $modificacion = json_decode($m->cambio, true);
                $utilidades = new App\librerias\Utilidades();
                $fechaHoraEs = $utilidades->fechaHoraCastellano($m->created_at);
            @endphp
            <div class="row">
                <div class="col-md-4">
                    <h3><span class="text-primary">Usuario: </span> 
                        @php
                            $user = App\User::find($m->user_id);
                            echo $user->name;
                        @endphp    
                    </h3>
                </div>
                <div class="col-md-8">

                    <h3><span class="text-primary">Fecha Hora: </span> {{ $fechaHoraEs }}</h3>
                </div>
            </div>
            
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
                            $estilo = 'class="table-success"';
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
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>NOMBRE</td>
                        <td>{{ $original['nombre'] }}</td>
                        <td>{{ $modificacion['nombre'] }}</td>
                    </tr>
                    @php
                        if($original['padre_id'] == $modificacion['padre_id']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                        $padreOriginal = App\Ejemplar::find($original['padre_id']);
                        $padreModificado = App\Ejemplar::find($modificacion['padre_id']);
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>PADRE</td>
                        <td>{{ ($padreOriginal)? $padreOriginal->nombre_completo:'' }}</td>
                        <td>{{ ($padreModificado)? $padreModificado->nombre_completo:'' }}</td>
                    </tr>
                    @php
                        if($original['madre_id'] == $modificacion['madre_id']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                        $madreOriginal = App\Ejemplar::find($original['madre_id']);
                        $madreModificado = App\Ejemplar::find($modificacion['madre_id']);
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>MADRE</td>
                        <td>{{ ($madreOriginal)? $madreOriginal->nombre_completo:'' }}</td>
                        <td>{{ ($madreModificado)? $madreModificado->nombre_completo:'' }}</td>
                    </tr>
                    @php
                        if($original['raza_id'] == $modificacion['raza_id']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                        $razaOriginal = App\Raza::find($original['raza_id']);
                        $razaModificado = App\Raza::find($modificacion['raza_id']);
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>RAZA</td>
                        <td>{{ ($razaOriginal)? $razaOriginal->nombre:'' }}</td>
                        <td>{{ ($razaModificado)? $razaModificado->nombre:'' }}</td>
                    </tr>
                    {{-- @php
                        if($original['camada_id'] == $modificacion['camada_id']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>CAMADA</td>
                        <td>{{ $original['camada_id'] }}</td>
                        <td>{{ $modificacion['camada_id'] }}</td>
                    </tr> --}}
                    @php
                        if($original['criadero_id'] == $modificacion['criadero_id']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                        $criaderoOriginal = App\Criadero::find($original['criadero_id']);
                        $criaderoModificado = App\Criadero::find($modificacion['criadero_id']);
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>CRIADERO</td>
                        <td>{{ ($criaderoOriginal)? $criaderoOriginal->nombre:'' }}</td>
                        <td>{{ ($criaderoModificado)? $criaderoModificado->nombre:'' }}</td>
                    </tr>
                    @php
                        if($original['propietario_id'] == $modificacion['propietario_id']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                        $propietarioOriginal = App\User::find($original['propietario_id']);
                        $propietarioModificado = App\User::find($modificacion['propietario_id']);
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>PROPIETARIO</td>
                        <td>{{ ($propietarioOriginal)? $propietarioOriginal->name:'' }}</td>
                        <td>{{ ($propietarioModificado)? $propietarioModificado->name:'' }}</td>
                    </tr>
                    {{-- @php
                        if($original['sucursal_id'] == $modificacion['sucursal_id']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>SUCURSAL</td>
                        <td>{{ $original['sucursal_id'] }}</td>
                        <td>{{ $modificacion['sucursal_id'] }}</td>
                    </tr> --}}
                    @php
                        if($original['codigo_nacionalizado'] == $modificacion['codigo_nacionalizado']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>CODIGO NACIONALIZADO</td>
                        <td>{{ $original['codigo_nacionalizado'] }}</td>
                        <td>{{ $modificacion['codigo_nacionalizado'] }}</td>
                    </tr>
                    {{-- @php
                        if($original['extranjero'] == $modificacion['extranjero']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>EXTRANGERO</td>
                        <td>{{ $original['extranjero'] }}</td>
                        <td>{{ $modificacion['extranjero'] }}</td>
                    </tr> --}}
                    @php
                        if($original['num_tatuaje'] == $modificacion['num_tatuaje']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>TATUAJE</td>
                        <td>{{ $original['num_tatuaje'] }}</td>
                        <td>{{ $modificacion['num_tatuaje'] }}</td>
                    </tr>
                    @php
                        if($original['chip'] == $modificacion['chip']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>CHIP</td>
                        <td>{{ $original['chip'] }}</td>
                        <td>{{ $modificacion['chip'] }}</td>
                    </tr>
                    @php
                        if($original['fecha_nacimiento'] == $modificacion['fecha_nacimiento']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>FECHA NACIMIENTO</td>
                        <td>{{ $original['fecha_nacimiento'] }}</td>
                        <td>{{ $modificacion['fecha_nacimiento'] }}</td>
                    </tr>
                    @php
                        if($original['color'] == $modificacion['color']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>COLOR</td>
                        <td>{{ $original['color'] }}</td>
                        <td>{{ $modificacion['color'] }}</td>
                    </tr>
                    @php
                        if($original['senas'] == $modificacion['senas']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>SEÑAS</td>
                        <td>{{ $original['senas'] }}</td>
                        <td>{{ $modificacion['senas'] }}</td>
                    </tr>
                    {{-- @php
                        if($original['nombre_completo'] == $modificacion['nombre_completo']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>NOMBRE COMPLETO</td>
                        <td>{{ $original['nombre_completo'] }}</td>
                        <td>{{ $modificacion['nombre_completo'] }}</td>
                    </tr> --}}
                    @php
                        if($original['lechigada'] == $modificacion['lechigada']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>LECHIGADA</td>
                        <td>{{ $original['lechigada'] }}</td>
                        <td>{{ $modificacion['lechigada'] }}</td>
                    </tr>
                    @php
                        if($original['sexo'] == $modificacion['sexo']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>SEXO</td>
                        <td>{{ $original['sexo'] }}</td>
                        <td>{{ $modificacion['sexo'] }}</td>
                    </tr>
                    {{-- @php
                        if($original['origen'] == $modificacion['origen']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>ORIGEN</td>
                        <td>{{ $original['origen'] }}</td>
                        <td>{{ $modificacion['origen'] }}</td>
                    </tr> --}}
                    {{-- @php
                        if($original['propietario_extranjero'] == $modificacion['propietario_extranjero']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>PROPIETARIO EXTRANGERO</td>
                        <td>{{ $original['propietario_extranjero'] }}</td>
                        <td>{{ $modificacion['propietario_extranjero'] }}</td>
                    </tr> --}}
                    {{-- @php
                        if($original['lugar_extranjero'] == $modificacion['lugar_extranjero']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>LUGAR EXTRANJERO</td>
                        <td>{{ $original['lugar_extranjero'] }}</td>
                        <td>{{ $modificacion['lugar_extranjero'] }}</td>
                    </tr> --}}
                    {{-- @php
                        if($original['titulos_extranjeros'] == $modificacion['titulos_extranjeros']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>TITULOS EXTRANGEROS</td>
                        <td>{{ $original['titulos_extranjeros'] }}</td>
                        <td>{{ $modificacion['titulos_extranjeros'] }}</td>
                    </tr> --}}
                    @php
                        if($original['consanguinidad'] == $modificacion['consanguinidad']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>CONSANGUINIDAD</td>
                        <td>{{ $original['consanguinidad'] }}</td>
                        <td>{{ $modificacion['consanguinidad'] }}</td>
                    </tr>
                    @php
                        if($original['hermano'] == $modificacion['hermano']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>HERMANOS</td>
                        <td>{{ $original['hermano'] }}</td>
                        <td>{{ $modificacion['hermano'] }}</td>
                    </tr>
                    @php
                        if($original['departamento'] == $modificacion['departamento']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>DEPARTAMENTO</td>
                        <td>{{ $original['departamento'] }}</td>
                        <td>{{ $modificacion['departamento'] }}</td>
                    </tr>
                    {{-- @php
                        if($original['fallecido'] == $modificacion['fallecido']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>FALLECIDO</td>
                        <td>{{ $original['fallecido'] }}</td>
                        <td>{{ $modificacion['fallecido'] }}</td>
                    </tr> --}}
                    @php
                        if($original['fecha_fallecido'] == $modificacion['fecha_fallecido']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>FECHA FALLECIDO</td>
                        <td>{{ $original['fecha_fallecido'] }}</td>
                        <td>{{ $modificacion['fecha_fallecido'] }}</td>
                    </tr>
                    @php
                        if($original['fecha_emision'] == $modificacion['fecha_emision']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>FECHA DE EMISION</td>
                        <td>{{ $original['fecha_emision'] }}</td>
                        <td>{{ $modificacion['fecha_emision'] }}</td>
                    </tr>
                    @php
                        if($original['fecha_nacionalizado'] == $modificacion['fecha_nacionalizado']){
                            $estilo = 'class="table-success"';
                        }else{
                            $estilo = 'class="table-danger"';
                        }
                    @endphp
                    <tr {!! $estilo !!}>
                        <td>FECHA NACIONALIZADO</td>
                        <td>{{ $original['fecha_nacionalizado'] }}</td>
                        <td>{{ $modificacion['fecha_nacionalizado'] }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="separator separator-dashed separator-border-2 separator-primary"></div>
            <h1>&nbsp;</h1>
        @empty
                
        @endforelse
    </div>
</div>
<!--end::Card-->
@stop