@extends('layouts.app')

@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('css')

@endsection

@section('content')

{{-- Modal de registro de padres genealogico --}}
<div class="modal fade" id="modal-edicion-de-padres" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true" style="position: fixed;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EJEMPLAR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="formulario-padres">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="kcb">Cedula
                                </label>
                                <input type="text" class="form-control" id="busca-ci" name="busca-ci" autocomplete="off" />
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="nombre">Nombre
                                </label>
                                <input type="text" class="form-control" id="busca-nombre" name="busca-nombre" autocomplete="off" />
                            </div>
                        </div> --}}
                    </div>
                </form>
                {{-- <div class="row">
                    <div class="col-md-12" id="ajaxPropietario">

                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
{{-- End Modal de registro de padres genealogico --}}

@if ($ejemplar != null)
    {{-- Modal busca propietario --}}
    <div class="modal fade" id="modal-propietario" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true" style="position: fixed;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">BUSQUEDA DE PROPIETARIOS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="formulario-padres">
                        @csrf
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kcb">Cedula
                                    </label>
                                    {{-- <input type="hidden" name="sexo-modal" id="sexo-modal" value="macho"> --}}
                                    <input type="text" class="form-control" id="busca-ci" name="busca-ci" autocomplete="off" />
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="nombre">Nombre
                                    </label>
                                    <input type="text" class="form-control" id="busca-nombre" name="busca-nombre" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        {{-- <div class="col-md-12" id="ajaxEjemplar"> --}}
                        <div class="col-md-12" id="ajaxPropietario">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End busca propietario --}}

    {{-- Modal Nuevo Propietario --}}
    <div class="modal fade" id="modal-nuevo-propietario" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true" style="position: fixed;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">NUEVO PROPIETARIO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="formulario-padres">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kcb">Nombre de Usuario
                                    </label>
                                    <input type="text" class="form-control" id="nuevo_propietario_nombre" name="nuevo_propietario_nombre" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kcb">Correo
                                    </label>
                                    <input type="text" class="form-control" id="nuevo_propietario_email" name="nuevo_propietario_correo" onfocusout="validaEmail()" autocomplete="off" />
                                    <span class="form-text text-danger" id="msg-error-email" style="display: none;">Correo duplicado, cambielo!!!</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kcb">Fecha de Nacimiento
                                    </label>
                                    <input type="date" class="form-control" id="nuevo_propietario_fecha_nacimiento" name="nuevo_propietario_fecha_nacimiento" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kcb">Cedula
                                    </label>
                                    <input type="text" class="form-control" id="nuevo_propietario_cedula" name="nuevo_propietario_cedula" onfocusout="validaCedula()" autocomplete="off" />
                                    <span class="form-text text-danger" id="msg-error-cedula" style="display: none;">Cedula duplicado, cambielo!!!</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kcb">Genero
                                    </label>
                                    <select class="form-control" id="nuevo_propietario_genero" name="nuevo_propietario_genero">
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kcb">Celular
                                    </label>
                                    <input type="text" class="form-control" id="nuevo_propietario_celular" name="nuevo_propietario_celular" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="kcb">Direccion
                                    </label>
                                    <input type="text" class="form-control" id="nuevo_propietario_direccion" name="nuevo_propietario_direccion" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="kcb">Departamento
                                    </label>
                                    <select class="form-control" id="nuevo_propietario_departamento" name="nuevo_propietario_departamento">
                                        <option value="La paz">La paz</option>
                                        <option value="Oruro">Oruro</option>
                                        <option value="Potosi">Potosi</option>
                                        <option value="Cochabamba">Cochabamba</option>
                                        <option value="Chuquisaca">Chuquisaca</option>
                                        <option value="Tarija">Tarija</option>
                                        <option value="Pando">Pando</option>
                                        <option value="Beni">Beni</option>
                                        <option value="Santa Cruz">Santa Cruz</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="kcb">Tipo
                                    </label>
                                    <select class="form-control" name="nuevo_propietario_tipo" id="nuevo_propietario_tipo">
                                        <option value="Socio">Socio</option>
                                        <option value="Criador">Criador</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <button type="button" class="btn btn-success btn-block" onclick="guardarPropietario()">Guardar</button>
                        </div>
                    </form>
                    <div class="row">
                        {{-- <div class="col-md-12" id="ajaxEjemplar"> --}}
                        <div class="col-md-12" id="ajaxPropietario">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End modal Nuevo Propietario --}}

    {{--  modal Transferencia  --}}
    <div class="modal fade" id="modal-tramsferencia" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">NUEVA TRANSFERENCIA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="formulario-transferencia">
                        @csrf
                        <input type="hidden" name="transferencia_ejemplar_id" value="{{ $ejemplar->id }}">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">
                                        PROPIETARIO 
                                        <span class="label label-success label-inline font-weight-normal mr-2" onclick="ajaxNuevoPropietario();">NUEVO</span>
                                    </label><br>
                                    {{-- <select class="form-control select2" id="transferencia_propietario_id" name="transferencia_propietario_id">
                                        <option label="Label"></option>
                                    </select> --}}
                                    <input type="hidden" name="transferencia_propietario_id" id="transferencia_propietario_id">
                                    <div id="transferencia_propietario">
                                        <button class="btn btn-primary btn-block" type="button" onclick="BuscaPropietario()">Propietario</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre">Fecha de Transferencia
                                    </label>
                                    <input type="date" class="form-control" id="transferencia_fecha_transferencia" name="transferencia_fecha_transferencia" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">En caso de ser Pedigree
                                    </label>
                                    <div class="form-group row">
                                        {{-- <label class="col-3 col-form-label">Success State</label> --}}
                                        <div class="col-9 col-form-label">
                                            <div class="checkbox-inline">
                                                <label class="checkbox checkbox-lg checkbox-success">
                                                    <input type="checkbox" name="transferencia_pedigree" id="transferencia_pedigree" {{--  checked="checked"  --}} />
                                                    <span></span>
                                                    Pedigree
                                                </label>
                                            </div>
                                            {{-- <span class="form-text text-muted">Some help text goes here</span> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Fecha de Exportacion
                                    </label>
                                    <input type="date" class="form-control" id="transferencia_fecha_exportacion" name="transferencia_fecha_exportacion" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Estado
                                    </label>
                                    <select class="form-control" name="transferencia_estado" id="transferencia_estado">
                                        <option value="Actual">Propietario Actual</option>
                                        <option value="Anterior">Propietario Anterior</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kcb">Pais Destino
                                    </label>
                                    <input type="text" class="form-control" name="transferencia_pais_destino" id="transferencia_pais_destino">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <button type="button" class="btn btn-sm btn-success btn-block" onclick="guardaTransferencia();">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--  end modal Transferencia  --}}


{{--  modal Titulo  --}}
    <div class="modal fade" id="modal-titulo" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">NUEVO TITULO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="formulario-titulo">
                        @csrf
                        <input type="hidden" name="titulo_ejemplar_id" value="{{ $ejemplar->id }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">TITULO
                                    </label><br>
                                    <select class="form-control select2" id="titulo_titulo_id" name="titulo_titulo_id">
                                        {{--  @if ($ejemplar != null && $ejemplar->raza_id != null)
                                            <option value="{{ $ejemplar->raza->id }}"> {{ $ejemplar->raza->id }} {{ $ejemplar->raza->nombre }} {{ $ejemplar->raza->descripcion }}</option>
                                        @endif  --}}
                                        @forelse ($titulos as $ti)
                                            <option value="{{ $ti->id }}">{{ $ti->nombre }} {{ $ti->descripcion }}</option>                                    
                                        @empty
                                            
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Fecha de Obtencion
                                    </label>
                                    <input type="date" class="form-control" id="titulo_fecha_obtencion" name="titulo_fecha_obtencion" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <button type="button" class="btn btn-sm btn-success btn-block" onclick="guardarTitulo();">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--  end modal Titulo  --}}


    {{--  modal Examen  --}}

    <div class="modal fade" id="modal-examen" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">NUEVO EXAMEN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('Ejemplar/guardaExamen') }}" method="POST" id="formulario-examenes">
                        @csrf
                        <input type="hidden" name="ejemplar_examen_id" value="{{ $ejemplar->id }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kcb">Examen
                                    </label><br>
                                    {{--  <input type="text" class="form-control" name="nombre_examen" id="nombre_examen" required>  --}}
                                    <select class="form-control select2" id="nombre_examen" name="nombre_examen">
                                        {{--  @if ($ejemplar != null && $ejemplar->raza_id != null)
                                            <option value="{{ $ejemplar->raza->id }}"> {{ $ejemplar->raza->id }} {{ $ejemplar->raza->nombre }} {{ $ejemplar->raza->descripcion }}</option>
                                        @endif  --}}
                                        @forelse ($examenes as $ex)
                                            <option value="{{ $ex->id }}">{{ $ex->nombre }} {{ $ex->descripcion }}</option>                                    
                                        @empty
                                            
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Fecha
                                    </label>
                                    <input type="date" class="form-control" id="fecha_examen" name="fecha_examen" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="nombre">Doctor
                                </label>
                                <input type="text" class="form-control" id="doctor_examen" name="doctor_examen" autocomplete="off" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kcb">Resultado
                                    </label>
                                    <input type="text" class="form-control" name="resultado" id="resultado">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Observacion
                                    </label>
                                    <input type="text" class="form-control" id="obserbacion" name="obserbacion" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kcb">Num. Formulario
                                    </label>
                                    <input type="text" class="form-control" name="examen_num_formulario" id="examen_num_formulario">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Codigo DFC
                                    </label>
                                    <input type="text" class="form-control" id="examen_dcf" name="examen_dcf" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <button type="button" class="btn btn-sm btn-success btn-block" onclick="guardaExamen();">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--  end modal Examen  --}}

    {{-- HACEMOS LA CONSULTA PARA EL ARBOL DE GENEALOGIA --}}

    @php
        // sacamos las generaciones
        $ejemplarOrigen = App\Ejemplar::find($ejemplar->id);
        // definimos las variables del padre
        $kcbAbuelo = '';
        $nombreAbuelo = '';
        $kcbAbuela = '';
        $nombreAbuela = '';
        $kcbTGPadre = '';
        $nombreTGPadre = '';
        $kcbTGMadre = '';
        $nombreTGMadre = '';
        $kcbCGPadre = '';
        $nombreCGPadre = '';
        $kcbCGMadre = '';
        $nombreCGMadre = '';
        
        $kcbTGMadreP1 = '';
        $nombreTGMadreP1 = '';  
        
        $kcbTGMadreM2 = '';
        $nombreTGMadreM2 = '';

        
        $kcbAbueloTG1 = '';
        $nombreAbueloTG1 = '';

        $kcbAbuelaTG1 = '';
        $nombreAbuelaTG1 = '';
    
        $kcbAbueloCG1 = '';
        $nombreAbueloCG1 = '';

        $kcbAbueloCG1M = '';
        $nombreAbueloCG1M = '';

        $kcbAbueloTG1M1 = '';
        $nombreAbueloTG1M1 = '';
        
        $kcbAbuelaTG1M1 = '';
        $nombreAbuelaTG1M1 = '';

        if($ejemplarOrigen->padre_id != null){
            $papa = App\Ejemplar::find($ejemplarOrigen->padre_id);

            $kcbPapa = ($papa)?$papa->kcb:'';
            $nombrePapa = ($papa != null)?$papa->nombre:'';
            
            // preguntamos si el papa tiene padre
            // para sacar al abuelo
            if($papa->padre_id != null){

                $abuelo = App\Ejemplar::find($papa->padre_id);

                $kcbAbuelo = ($abuelo)?$abuelo->kcb:'';
                $nombreAbuelo = ($abuelo != null)?$abuelo->nombre:'';

                // preguntamos si el abuelo tiene padre
                // para sacar al tecera generacion padre
                if($abuelo->padre_id != null){

                    $tGPadre = App\Ejemplar::find($abuelo->padre_id);

                    $kcbTGPadre = ($tGPadre)?$tGPadre->kcb:'';
                    $nombreTGPadre = ($tGPadre != null)?$tGPadre->nombre:'';

                    // preguntamos si la tercera generacion tiene padre
                    // para sacar al cuarta generacion padre
                    if($tGPadre->padre_id != null){

                        $cGPadre = App\Ejemplar::find($tGPadre->padre_id);
                        
                        $kcbCGPadre = ($cGPadre)?$cGPadre->kcb:'';
                        $nombreCGPadre = ($cGPadre != null)?$cGPadre->nombre:'';
                    }else{
                        $kcbCGPadre = '';
                        $nombreCGPadre = '';
                    }

                    // preguntamos si la tercera generacion tiene madre
                    // para sacar al cuarta generacion madre
                    if($tGPadre->madre_id != null){

                        $cGMadre = App\Ejemplar::find($tGPadre->madre_id);
                        
                        $kcbCGMadre = ($cGMadre)?$cGMadre->kcb:'';
                        $nombreCGMadre = ($cGMadre != null)?$cGMadre->nombre:'';
                    }else{
                        $kcbCGMadre = '';
                        $nombreCGMadre = '';
                    }

                }else{
                    $kcbTGPadre = '';
                    $nombreTGPadre = '';
                }

                // preguntamos si el abuelo tiene madre
                // para sacar al tecera generacion madre
                if($abuelo->madre_id != null){

                    $tGMadre = App\Ejemplar::find($abuelo->madre_id);

                    $kcbTGMadre = ($tGMadre)?$tGMadre->kcb:'';
                    $nombreTGMadre = ($tGMadre != null)?$tGMadre->nombre:'';

                    if($tGMadre->padre_id != null){

                        $CGMadreP = App\Ejemplar::find($tGMadre->padre_id);

                        $kcbTGMadreP1 = ($CGMadreP)?$CGMadreP->kcb:'';
                        $nombreTGMadreP1 = ($CGMadreP)?$CGMadreP->nombre:'';    
                    }else{
                        $kcbTGMadreP1 = '';
                        $nombreTGMadreP1 = '';    
                    }

                    // para la madre de del atercera generacion
                    if($tGMadre->madre_id != null){

                        $CGMadreM2 = App\Ejemplar::find($tGMadre->madre_id);

                        $kcbTGMadreM2 = ($CGMadreM2)?$CGMadreM2->kcb:'';
                        $nombreTGMadreM2 = ($CGMadreM2)?$CGMadreM2->nombre:'';    
                    }else{
                        $kcbTGMadreM2 = '';
                        $nombreTGMadreM2 = '';    
                    }

                }else{
                    $kcbtGMadre = '';
                    $nombretGMadre = '';
                }

            }else{
                $kcbAbuelo = '';
                $nombreAbuelo = '';
            }

            // preguntamos si el papa tiene madre
            // para sacar al abuela
            if($papa->madre_id != null){

                $abuela = App\Ejemplar::find($papa->madre_id);

                $kcbAbuela = ($abuela)?$abuela->kcb:'';
                $nombreAbuela = ($abuela != null)?$abuela->nombre:'';

                if($abuela->padre_id != null){

                    $abueloTG = App\Ejemplar::find($abuela->padre_id);

                    $kcbAbueloTG1 = ($abueloTG)?$abueloTG->kcb:'';
                    $nombreAbueloTG1 = ($abueloTG)?$abueloTG->nombre:'';

                    if($abueloTG->padre_id != null){

                        $abueloCG = App\Ejemplar::find($abueloTG->padre_id);

                        $kcbAbueloCG1 = ($abueloCG)?$abueloCG->kcb:'';
                        $nombreAbueloCG1 = ($abueloCG)?$abueloCG->nombre:'';
                    }else{
                        $kcbAbueloCG1 = '';
                        $nombreAbueloCG1 = '';
                    }

                    if($abueloTG->madre_id != null){

                        $abueloCGM = App\Ejemplar::find($abueloTG->madre_id);

                        $kcbAbueloCG1M = ($abueloCGM)?$abueloCGM->kcb:'';
                        $nombreAbueloCG1M = ($abueloCGM)?$abueloCGM->nombre:'';
                    }else{
                        $kcbAbueloCG1M = '';
                        $nombreAbueloCG1M = '';
                    }
                }else{
                    $kcbAbueloTG1 = '';
                    $nombreAbueloTG1 = '';
                }

                // hacemos para su mama de la abuela
                if($abuela->madre_id != null){

                    $abuelaTG = App\Ejemplar::find($abuela->madre_id);

                    $kcbAbuelaTG1 = ($abuelaTG)?$abuelaTG->kcb:'';
                    $nombreAbuelaTG1 = ($abuelaTG)?$abuelaTG->nombre:'';

                    // aqui hay que hacer para la cuarte generracion tanto como padre y madres
                    if($abuelaTG->padre_id != null){

                        $abueloTGM1 = App\Ejemplar::find($abuelaTG->padre_id);

                        $kcbAbueloTG1M1 = ($abueloTGM1)?$abueloTGM1->kcb:'';
                        $nombreAbueloTG1M1 = ($abueloTGM1)?$abueloTGM1->nombre:'';
                    }else{
                        $kcbAbueloTG1M1 = '';
                        $nombreAbueloTG1M1 = '';
                    }
                    if($abuelaTG->madre_id != null){

                        $abuelaTGM1 = App\Ejemplar::find($abuelaTG->madre_id);

                        $kcbAbuelaTG1M1 = ($abuelaTGM1)?$abuelaTGM1->kcb:'';
                        $nombreAbuelaTG1M1 = ($abuelaTGM1)?$abuelaTGM1->nombre:'';
                    }else{
                        $kcbAbuelaTG1M1 = '';
                        $nombreAbuelaTG1M1 = '';
                    }
                }else{
                    $kcbAbuelaTG1 = '';
                    $nombreAbuelaTG1 = '';
                }
            }else{
                $kcbAbuela = '';
                $nombreAbuela = '';
            }

        }else{
            $kcbPapa = '';
            $nombrePapa = '';        
        }
        // definimos las variables de la madre
        $kcbAbueloM = '';
        $nombreAbueloM = '';
        $kcbAbuelaM = '';
        $nombreAbuelaM = '';
        $kcbTGPadreM = '';
        $nombreTGPadreM = '';
        $kcbTGMadreM = '';
        $nombreTGMadreM = '';
        $kcbCGPadreM = '';
        $nombreCGPadreM = '';
        $kcbCGMadreM = '';
        $nombreCGMadreM = '';
        
        $kcbCGPadreM1 = '';
        $nombreCGPadreM1 = '';
        $kcbCGPadreM2 = '';
        $nombreCGPadreM2 = '';
        $kcbabueloMSG  = '' ;
        $nombreabueloMSG  = '' ;
        
        $kcbabueloMSG2  = '' ;
        $nombreabueloMSG2  = '' ;
        
        $kcbabueloMTG1  = '' ;
        $nombreabueloMTG1  = '' ;
        
        $kcbabueloMTG11  = '' ;
        $nombreabueloMTG11  = '' ;
        
        $kcbabueloMSG22  = '' ;
        $nombreabueloMSG22  = '' ;

        $kcbabueloMSG222  = '' ;
        $nombreabueloMSG222  = '' ;
        if($ejemplarOrigen->madre_id != null){
            $mama = App\Ejemplar::find($ejemplarOrigen->madre_id);

            $kcbMama = ($mama != null)?$mama->kcb:'';
            $nombreMama = ($mama != null)?$mama->nombre:'';

            if($mama->padre_id != null){

                $abueloM = App\Ejemplar::find($mama->padre_id);

                $kcbAbueloM     = ($abueloM)? $abueloM->kcb: '';
                $nombreAbueloM  = ($abueloM)? $abueloM->nombre: '';

                if($abueloM->padre_id != null){
                    
                    $tGPadreM = App\Ejemplar::find($abueloM->padre_id);

                    $kcbTGPadreM = ($tGPadreM)?$tGPadreM->kcb:'';
                    $nombreTGPadreM = ($tGPadreM)?$tGPadreM->nombre:'';

                    if($tGPadreM->padre_id != null){

                        $CGPadreM1 = App\Ejemplar::find($tGPadreM->padre_id);

                        $kcbCGPadreM1 = ($CGPadreM1)?$CGPadreM1->kcb:'';
                        $nombreCGPadreM1 = ($CGPadreM1)?$CGPadreM1->nombre:'';
                    }else{
                        $kcbCGPadreM1 = '';
                        $nombreCGPadreM1 = '';
                    }
                    if($tGPadreM->madre_id != null){

                        $CGPadreM2 = App\Ejemplar::find($tGPadreM->madre_id);

                        $kcbCGPadreM2 = ($CGPadreM2)?$CGPadreM2->kcb:'';
                        $nombreCGPadreM2 = ($CGPadreM2)?$CGPadreM2->nombre:'';
                    }else{
                        $kcbCGPadreM2 = '';
                        $nombreCGPadreM2 = '';
                    }

                }else{
                    $kcbTGPadreM = '';
                    $nombreTGPadreM = '';
                }

                if($abueloM->madre_id != null){

                    $tGMadreM = App\Ejemplar::find($abueloM->madre_id);

                    $kcbTGMadreM = ($tGMadreM)?$tGMadreM->kcb:'';
                    $nombreTGMadreM = ($tGMadreM)?$tGMadreM->nombre:'';

                    if($tGMadreM->padre_id != null){

                        $CGPadreM = App\Ejemplar::find($tGMadreM->padre_id);

                        $kcbCGPadreM = ($CGPadreM)? $CGPadreM->kcb:'';                   
                        $nombreCGPadreM = ($CGPadreM)? $CGPadreM->nombre:'';                   

                    }else{

                        $kcbCGPadreM = '';                   
                        $nombreCGPadreM = '';                   
                    }
                    if($tGMadreM->madre_id != null){

                        $CGMadreM = App\Ejemplar::find($tGMadreM->madre_id);

                        $kcbCGMadreM = ($CGMadreM)? $CGMadreM->kcb:'';                   
                        $nombreCGMadreM = ($CGMadreM)? $CGMadreM->nombre:'';                   
                    }else{
                        $kcbCGMadreM = '';                   
                        $nombreCGPadreM = '';                   
                    }
                }else{
                    $kcbTGMadreM = '';
                    $nombreTGMadreM = '';
                }

            }else{

                $kcbAbueloM     = '';
                $nombreAbueloM  = '';
            }

            if($mama->madre_id != null){

                $abuelaM = App\Ejemplar::find($mama->madre_id);

                $kcbAbuelaM     = ($abuelaM)?$abuelaM->kcb:'';
                $nombreAbuelaM  = ($abuelaM)?$abuelaM->nombre:'';

                if($abuelaM->padre_id != null){

                    $abueloSG   =App\Ejemplar::find($abuelaM->padre_id);

                    $kcbabueloMSG  = ($abueloSG)? $abueloSG->kcb:'' ;
                    $nombreabueloMSG  = ($abueloSG)? $abueloSG->nombre:'' ;

                    if($abueloSG->padre_id){

                        $abueloTG1   =App\Ejemplar::find($abueloSG->padre_id);

                        $kcbabueloMTG1  = ($abueloTG1)? $abueloTG1->kcb:'' ;
                        $nombreabueloMTG1  = ($abueloTG1)? $abueloTG1->nombre:'' ;
                    }else{
                        $kcbabueloMTG1  = '' ;
                        $nombreabueloMTG1  = '' ;
                    }
                    // la madre de la cuarta generacion
                    if($abueloSG->madre_id != null){

                        $abueloTG11   =App\Ejemplar::find($abueloSG->madre_id);

                        $kcbabueloMTG11  = ($abueloTG11)? $abueloTG11->kcb:'' ;
                        $nombreabueloMTG11  = ($abueloTG11)? $abueloTG11->nombre:'' ;
                    }else{
                        $kcbabueloMTG11  = '' ;
                        $nombreabueloMTG11  = '' ;
                    }
                }else{
                    $kcbabueloMSG  = '' ;
                    $nombreabueloMSG  = '' ;
                }
                // de aqui comienza las madres de la abuela
                if($abuelaM->madre_id != null){

                    $abueloSGM2   =App\Ejemplar::find($abuelaM->madre_id);

                    $kcbabueloMSG2  = ($abueloSGM2)? $abueloSGM2->kcb:'' ;
                    $nombreabueloMSG2  = ($abueloSGM2)? $abueloSGM2->nombre:'' ;

                    if($abueloSGM2->padre_id != null){

                        $abueloSGM22   =App\Ejemplar::find($abueloSGM2->padre_id);

                        $kcbabueloMSG22  = ($abueloSGM22)? $abueloSGM22->kcb:'' ;
                        $nombreabueloMSG22  = ($abueloSGM22)? $abueloSGM22->nombre:'' ;
                    }else{

                        $kcbabueloMSG22  = '' ;
                        $nombreabueloMSG22  = '' ;  
                    }
                    if($abueloSGM2->madre_id != null){

                        $abueloSGM222   =App\Ejemplar::find($abueloSGM2->madre_id);

                        $kcbabueloMSG222  = ($abueloSGM222)? $abueloSGM222->kcb:'' ;
                        $nombreabueloMSG222  = ($abueloSGM222)? $abueloSGM222->nombre:'' ;
                    }else{
                        $kcbabueloMSG222  = '' ;
                        $nombreabueloMSG222  = '' ;
                    }
                }else{
                    $kcbabueloMSG2  = '' ;
                    $nombreabueloMSG2  = '' ;
                }
            }else{
                $kcbAbuelaM     = '';
                $nombreAbuelaM  = '';
            }

        }else{
            $kcbMama = '';
            $nombreMama = '';
        }
    @endphp

    {{-- END HACEMOS LA CONSULTA PARA EL ARBOL DE GENEALOGIA --}}

@endif
{{-- inicio modal  --}}
<div class="modal fade" id="modal-padres" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">BUSQUEDA DE EJEMPLARES</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="formulario-padres">
                    @csrf
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kcb">KCB
                                </label>
                                <input type="hidden" name="sexo-modal" id="sexo-modal" value="macho">
                                <input type="text" class="form-control" id="busqueda-kcb" name="busqueda-kcb" autocomplete="off" />
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="nombre">Nombre
                                </label>
                                <input type="text" class="form-control" id="busqueda-nombre" name="busqueda-nombre" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-12" id="ajaxEjemplar">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- fin inicio modal  --}}

<!--begin::Card-->
<div class="card card-custom gutter-b">
    <div class="card-header flex-wrap py-3">
        <div class="card-title">
            <h3 class="card-label">FORMULARIO EJEMPLAR
            </h3>
        </div>
        <div class="card-toolbar">
        </div>
    </div>

    <div class="card-body">
        <form action="{{ url('Ejemplar/guarda') }}" method="POST" id="formulario-ejemplar">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre">Nombre
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ ($ejemplar != null)? $ejemplar->nombre:'' }}" placeholder="Demitri" required />
                        <input type="hidden" value="{{ ($ejemplar==null)? 0:$ejemplar->id }}" name="ejemplar_id" id="ejemplar_id">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="prefijo">Prefijo del nombre
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="prefijo" name="prefijo" value="{{ ($ejemplar != null)? $ejemplar->prefijo:'' }}" placeholder="de o de la" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="primero_mostrar">Primero Mostrar
                            <span class="text-danger">*</span></label>
                        <select name="primero_mostrar" id="primero_mostrar" class="form-control">
                            <option value="Nombre" {{ ($ejemplar!=null)? ($ejemplar->primero_mostrar=="Nombre")?"selected":'':'' }}>Nombre</option>
                            <option value="Afijo" {{ ($ejemplar!=null)? ($ejemplar->primero_mostrar=="Afijo")?"selected":'':'' }}>Afijo</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="kcb">KCB
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="kcb" name="kcb" value="{{ ($ejemplar != null)? $ejemplar->kcb:'' }}" placeholder="65123" required />
                        <span class="form-text text-info">Ultimo KCB: 
                            @php
                                $ultimoKCB = App\Ejemplar::latest()->first();
                                echo $ultimoKCB->kcb;
                            @endphp
                        </span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="num_tatuaje">Numero Tatuaje
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="num_tatuaje" name="num_tatuaje" value="{{ ($ejemplar != null)? $ejemplar->num_tatuaje:'' }}" placeholder="04578" placeholder="" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="chip">Numero Chip
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="chip" name="chip" value="{{ ($ejemplar != null)? $ejemplar->chip:'' }}" placeholder="900057600430900" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="fecha_nacimiento">Fecha Nacimiento
                            <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ ($ejemplar != null)? $ejemplar->fecha_nacimiento:'' }}" />
                    </div>
                </div>
                
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="color">Color
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="color" name="color" value="{{ ($ejemplar != null)? $ejemplar->color:'' }}" placeholder="Negro/Fuego" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="senas">Se&ntilde;as o Marcas
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="senas" name="senas" value="{{ ($ejemplar != null)? $ejemplar->senas:'' }}" placeholder="Manchas Cafes" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="sexo">Sexo
                            <span class="text-danger">*</span></label>
                        <select name="sexo" id="sexo" class="form-control">
                            <option value="Macho" {{ ($ejemplar!=null)? ($ejemplar->sexo=="Macho")?"selected":'':'' }}>Macho</option>
                            <option value="Hembra" {{ ($ejemplar!=null)? ($ejemplar->sexo=="Hembra")?"selected":'':'' }}>Hembra</option>
                        </select>
                    </div>
                </div>
                
            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Raza
                            <span class="text-danger">*</span></label>
                            <select class="form-control select2" id="raza_id" name="raza_id">
                                @if ($ejemplar != null && $ejemplar->raza_id != null)
                                    <option value="{{ $ejemplar->raza->id }}"> {{ $ejemplar->raza->id }} {{ $ejemplar->raza->nombre }} {{ $ejemplar->raza->descripcion }}</option>
                                @endif
                                @forelse ($razas as $r)
                                    <option value="{{ $r->id }}">{{ $r->nombre }} {{ $r->descripcion }}</option>                                    
                                @empty
                                    
                                @endforelse
                            </select>
                    </div>
                </div>

            </div>

            <div class="row">
                <input type="hidden" name="padre_id" id="padre_id">
                <div class="col-md-6" id="btn-padre">
                    @if ($ejemplar != null && $ejemplar->padre_id != null) 
                        <button type="button" class="btn btn-sm btn-primary btn-block" onclick="seleccionaPadre()">KCB: {{ $ejemplar->padre->kcb }} NOMBRE: {{ $ejemplar->padre->nombre }}</button>
                    @else
                        <button type="button" class="btn btn-sm btn-primary btn-block" onclick="seleccionaPadre()">PADRE</button>
                    @endif
                </div>
                <input type="hidden" name="madre_id" id="madre_id">
                <div class="col-md-6" id="btn-madre">
                    @if ($ejemplar != null && $ejemplar->madre_id != null)
                        <button type="button" class="btn btn-sm btn-info btn-block" onclick="seleccionaPadre()">KCB: {{ $ejemplar->madre->kcb }} NOMBRE: {{ $ejemplar->madre->nombre }}</button>
                    @else
                        <button type="button" class="btn btn-sm btn-info btn-block" onclick="seleccionaMadre()">MADRE</button>
                    @endif
                </div>
                
            </div>
            <br />
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="exampleInputPassword1">PROPIETARIO
                        </label>
                        <select class="form-control select2" id="propietario_id" name="propietario_id">
                            @if ($ejemplar != null && $ejemplar->propietario_id != null)
                                <option value="{{ $ejemplar->propietario->id }}">{{ $ejemplar->propietario->name }}</option>
                            @endif
                            <option label="Label"></option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="color">Consanguinidad
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="consanguinidad" name="consanguinidad" value="{{ ($ejemplar != null)? $ejemplar->consanguinidad:'' }}" placeholder="4:2:4" />
                    </div>
                </div>

                <div class="col-md-3">
                @php
                    $var = "";
                @endphp

                    <div class="form-group">
                        <label for="exampleInputPassword1">Departamento
                            <span class="text-danger">*</span></label>
                        <select name="departamento" id="departamento" class="form-control">
                            <option value="La Paz" {{ ($var!=null)? ($var=="La Paz")?"selected":'':'' }}>
                                La Paz</option>
                            <option value="Oruro" {{ ($var!=null)? ($var=="Oruro")?"selected":'':'' }}>
                                Oruro</option>
                            <option value="Potosi" {{ ($var!=null)? ($var=="Potosi")?"selected":'':'' }}>
                                Potosi</option>
                            <option value="Cochabamba" {{ ($var!=null)? ($var=="Cochabamba")?"selected":'':'' }}>
                                Cochabamba</option>
                            <option value="Chuquisaca" {{ ($var!=null)? ($var=="Chuquisaca")?"selected":'':'' }}>
                                Chuquisaca</option>
                            <option value="Tarija" {{ ($var!=null)? ($var=="Tarija")?"selected":'':'' }}>
                                Tarija</option>
                            <option value="Pando" {{ ($var!=null)? ($var=="Pando")?"selected":'':'' }}>
                                Pando</option>
                            <option value="Beni" {{ ($var!=null)? ($var=="Beni")?"selected":'':'' }}>
                                Beni</option>
                            <option value="Santa Cruz" {{ ($var!=null)? ($var=="Santa Cruz")?"selected":'':'' }}>
                                Santa Cruz</option>
                        </select>
                    </div>
                </div>         
            </div>

            <div class="row">                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">AFIJO
                        </label>
                        <select class="form-control select2" id="criadero_id" name="criadero_id" required>
                            @if ($ejemplar != null && $ejemplar->criadero_id != null)
                                <option value="{{ $ejemplar->criadero->id }}">{{ $ejemplar->criadero->nombre }}</option>
                            @endif
                            <option label="Label"></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="exampleInputPassword1">
                        Alquiler</label>
                        <div class="">
                            <input id='check_alquiler' data-switch="true" type="checkbox" data-on-color="primary"  onchange="mostrarAlquiler()"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" style="display: none;" id="bloque_alquiler_propietario">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Propietario Alquilado
                                    <span class="text-danger">*</span></label>
                                    <select class="form-control select2" id="alquiler_propietario_id" name="alquiler_propietario_id">
                                        @if ($ejemplar != null && $ejemplar->propietario_id != null)
                                            <option value="{{ $ejemplar->propietario->id }}">{{ $ejemplar->propietario->name }}</option>
                                        @endif
                                        <option label="Label"></option>
                                    </select>
                                    <input type="hidden" id="alquiler_value" name="alquiler_value">
                            </div>
                            <div class="col-md-6">
                                <label for="">Fecha Alquilado</label>
                                <input type="date" class="form-control" id="alquiler_propietario_fecha" name="alquiler_propietario_fecha">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="color">Hermano
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="hermano" name="hermano" value="{{ ($ejemplar != null)? $ejemplar->hermano:'' }}" placeholder="CAIN, CANDY, CIRA, CONY" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="color">Lechigada
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="lechigada" name="lechigada"
                            value="{{ ($ejemplar != null)? $ejemplar->lechigada:'' }}" placeholder="CBBA/RW-028/C - REG 27/06/21" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="color">Fecha Emision
                            <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="fecha_emision" name="fecha_emision"
                            value="{{ ($ejemplar != null)? $ejemplar->fecha_emision:date('Y-m-d') }}" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-sm btn-light-danger btn-block font-weight-bold mr-2" onclick="muestraBloqueFallecido();"> FALLECIDO, PERDIDO O ROBADO</button>
                </div>
            </div>
            <br>
            <div class="row" style="display: none;" id="bloque-fallecido">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="nombre">Fecha Fallecido
                            <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="fecha_fallecido" name="fecha_fallecido" value="{{ ($ejemplar != null)? $ejemplar->nombre:'' }}" />
                        <span class="form-text text-muted">Si fallecio seleccionar fecha</span>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="prefijo">Fecha Perdido
                            <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="fecha_perdido" name="fecha_perdido" value="{{ ($ejemplar != null)? $ejemplar->prefijo:'' }}" />
                        <span class="form-text text-muted">Si se extravio seleccionar fecha</span>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="form-group">
                        <label for="prefijo">Descripcion de la perdida
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="descripcion_perdido" name="descripcion_perdido" value="{{ ($ejemplar != null)? $ejemplar->prefijo:'' }}" placeholder="Se extravion por la plaza Villaroel a horas 13:00, lleva una chompa color rojo, reponde a nombre Snoopy" />
                    </div>
                </div>
                
            </div>

            {{-- <br /> --}}
            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-sm btn-light-dark btn-block font-weight-bold mr-2"
                        onclick="muestraBloqueNacionalizado();"> NACIONALIZADO</button>
                </div>
            </div>
            <br>
            <div class="row" style="display: none;" id="bloque-nacionalizado">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="prefijo">Origen (Ciudad)
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="origen_nacionalizado" name="origen_nacionalizado"
                            value="{{ ($ejemplar != null)? $ejemplar->prefijo:'' }}" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="prefijo">Codigo / Registro
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="codigo_nacionalizado" name="codigo_nacionalizado"
                            value="{{ ($ejemplar != null)? $ejemplar->prefijo:'' }}" />
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="prefijo">Fecha Nacionalizado
                            <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="fecha_nacionalizado" name="fecha_nacionalizado"
                            value="{{ ($ejemplar != null)? $ejemplar->prefijo:'' }}" />
                    </div>
                </div>
            
            </div>

            <br />

            @if ($ejemplar != null)

                <div class="example-preview">
                    <ul class="nav nav-pills nav-justified" id="myTab1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="examenes-tab-1" data-toggle="tab" href="#examenes-1">
                                <span class="nav-icon">
                                    <i class="far fa-list-alt"></i>
                                </span>
                                <span class="nav-text">EXAMENES</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="transferencias-tab-1" data-toggle="tab" href="#transferencias-1" aria-controls="transferencias">
                                <span class="nav-icon">
                                    <i class="fas fa-arrows-alt-h"></i>
                                </span>
                                <span class="nav-text">TRANSFERENCIAS</span>
                            </a>
                        </li>                        
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab-1" data-toggle="tab" href="#titulos-1" aria-controls="titulos">
                                <span class="nav-icon">
                                    <i class="fas fa-award"></i>
                                </span>
                                <span class="nav-text">TITULOS</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content mt-5" id="myTabContent1">
                        <div class="tab-pane fade show active" id="examenes-1" role="tabpanel" aria-labelledby="examenes-tab-1">
                            @php
                                $examenes = App\ExamenMascota::where('ejemplar_id', $ejemplar->id)
                                                                    ->orderBy('id', 'desc')
                                                                    ->get();
                                $numeroExamenes = $examenes->count();
                            @endphp
                            @if ($numeroExamenes != 0)
                                <table class="table table-striped">
                                    <tr>
                                        <th>FECHA</th>
                                        <th>EXAMEN</th>
                                        <th></th>
                                    </tr>
                                    @foreach ($examenes as $e)
                                        <tr>
                                            <td>{{ $e->fecha_examen }}</td>
                                            <td>{{ $e->examen->nombre }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-icon btn-danger" onclick="eliminaExamen('{{ $e->id }}', '{{ $e->examen->nombre }}')">
                                                    <i class="flaticon2-cross"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                <a href="#" class="btn btn-info btn-block" onclick="nuevoExamen()">Nuevo Examen</a>
                            @else
                                <a href="#" class="btn btn-info btn-block" onclick="nuevoExamen()">Nuevo Examen</a>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="transferencias-1" role="tabpanel" aria-labelledby="transferencias-tab-1">
                            @php
                                $transferencias = App\Transferencia::where('ejemplar_id', $ejemplar->id)
                                                                    ->orderBy('id', 'desc')
                                                                    ->get();
                                $numeroTransferencia = $transferencias->count();
                            @endphp
                            @if ($numeroTransferencia != 0)
                                <table class="table table-striped">
                                    <tr>
                                        <th>FECHA</th>
                                        <th>PROPIETARIO</th>
                                        <th></th>
                                    </tr>
                                    @foreach ($transferencias as $tra)
                                        <tr>
                                            <td>{{ $tra->fecha_transferencia }}</td>
                                            <td>{{ $tra->propietario->name }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-icon btn-danger" onclick="eliminaTransferencia('{{ $tra->id }}', '{{ $tra->propietario->name }}')">
                                                    <i class="flaticon2-cross"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                <a href="#" class="btn btn-info btn-block" onclick="nuevaTransferencia()">Nueva Tramsferencia</a>
                            @else
                                <a href="#" class="btn btn-info btn-block" onclick="nuevaTransferencia()">Nueva Tramsferencia</a>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="titulos-1" role="tabpanel" aria-labelledby="contact-tab-1">
                            @php
                                $tituloEjemplar = App\TituloEjemplar::where('ejemplar_id', $ejemplar->id)
                                                                    ->orderBy('id', 'desc')
                                                                    ->get();
                                $numeroTituloEjemplares = $tituloEjemplar->count();
                            @endphp
                            @if ($numeroTituloEjemplares != 0)
                                <table class="table table-striped">
                                    <tr>
                                        <th>FECHA</th>
                                        <th>EXAMEN</th>
                                        <th></th>
                                    </tr>
                                    @foreach ($tituloEjemplar as $te)
                                        <tr>
                                            <td>{{ $te->fecha_obtencion }}</td>
                                            <td>{{ $te->titulo->nombre}}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-icon btn-danger" onclick="eliminaTitulo('{{ $te->id }}', '{{ $te->titulo->nombre }}')">
                                                    <i class="flaticon2-cross"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                <a href="#" class="btn btn-info btn-block" onclick="nuevoTitulo()">Nuevo Titulo</a>
                            @else
                                <a href="#" class="btn btn-info btn-block" onclick="nuevoTitulo()">Nuevo Titulo</a>
                            @endif
                        </div>
                    </div>
                </div>
                <br />
            @endif


            <div class="row">
                <div class="col-md-6"><button type="button" class="btn btn-sm btn-success btn-block" onclick="guardar()">GUARDAR</button></div>
                <div class="col-md-6"><button type="button" class="btn btn-sm btn-dark btn-block" onclick="volver()" >VOLVER</button></div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <br />
                    <h2 class="text-center text-primary">GENEALOGIA</h2>
                    {{-- <br /> --}}
                    <table class="table table-bordered table-dark">
                        <thead>
                            <tr>
                                <th class="text-primary">
                                    <h4>PADRES</h4>
                                </th>
                                <th class="text-primary">
                                    <h4>ABUELOS</h4>
                                </th>
                                <th class="text-primary">
                                    <h4>TERCERA GENERACION</h4>
                                </th>
                                <th class="text-primary">
                                    <h4>CUARTA GENERACION</h4>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="8">
                                    {{ $nombrePapa }}
                                    <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre()">
                                        PADRES
                                    </span>
                                </td>
                                <td rowspan="4"> {{  $nombreAbuelo }} </td>
                                <td rowspan="2">{{ $nombreTGPadre }} </td>
                                <td>{{ $nombreCGPadre }}</td>
                            </tr>
                            <tr>
                                <td>{{ $nombreCGMadre }}</td>
                            </tr>
                            <tr>
                                <td rowspan="2"> {{ $nombreTGMadre }} </td>
                                <td>{{ $nombreTGMadreP1 }} </td>
                            </tr>
                            <tr>
                                <td>{{ $nombreTGMadreM2 }} </td>
                            </tr>
                            <tr>
                                <td rowspan="4"> {{ $nombreAbuela }} </td>
                                <td rowspan="2">{{ $nombreAbueloTG1 }}</td>
                                <td>{{ $nombreAbueloCG1 }} </td>
                            </tr>
                            <tr>
                                <td>{{ $nombreAbueloCG1M }}</td>
                            </tr>
                            <tr>
                                <td rowspan="2"> {{ $nombreAbuelaTG1 }} </td>
                                <td>{{ $nombreAbueloTG1M1 }} </td>
                            </tr>
                            <tr>
                                <td>{{ $nombreAbuelaTG1M1 }} </td>
                            </tr>
                            <tr>
                                <td rowspan="8">
                                    {{ $nombreMama }}
                                    <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2">
                                        PADRES
                                    </span>
                                </td>
                                <td rowspan="4">{{ $nombreAbueloM }} </td>
                                <td rowspan="2">{{ $nombreTGPadreM }} </td>
                                <td>{{ $nombreCGPadreM1 }} </td>
                            </tr>
                            <tr>
                                <td>{{ $nombreCGPadreM2 }}</td>
                            </tr>
                            <tr>
                                <td rowspan="2">{{ $nombreTGMadreM }}</td>
                                <td>{{ $nombreCGPadreM }} </td>
                            </tr>
                            <tr>
                                <td>{{ $nombreCGMadreM }}</td>
                            </tr>
                            <tr>
                                <td rowspan="4">{{ $nombreAbuelaM }}</td>
                                <td rowspan="2">{{ $nombreabueloMSG  }}</td>
                                <td>{{ $nombreabueloMTG1  }}</td>
                            </tr>
                            <tr>
                                <td>{{ $nombreabueloMTG11 }} </td>
                            </tr>
                            <tr>
                                <td rowspan="2">{{ $nombreabueloMSG2 }} </td>
                                <td>{{ $nombreabueloMSG22 }}</td>
                            </tr>
                            <tr>
                                <td>{{ $nombreabueloMSG222 }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>
<!--end::Card-->
@stop

@section('js')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }} "></script>
<script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-switch.js') }}"></script>
<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function(){
        $('#raza_id').select2({
            placeholder: "Select a state"
        });
    });

    $("#propietario_id").select2({
        placeholder: "Busca por nombre",
        allowClear: true,
        ajax: {
            url: "{{ url('User/ajaxBuscaPropietario') }}",
            dataType: 'json',
            method: 'POST',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term,
                };
            },
            processResults: function (response) {

                return {
                    results: response
                };
            },
            cache: true
        },
        minimumInputLength: 1,
    });

    $("#criadero_id").select2({
        placeholder: "Busca por nombre",
        allowClear: true,
        ajax: {
            url: "{{ url('Criadero/ajaxBuscaCriadero') }}",
            dataType: 'json',
            method: 'POST',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term,
                };
            },
            processResults: function (response) {

                return {
                    results: response
                };
            },
            cache: true
        },
        minimumInputLength: 1,
    });

    function guardar()
    {
        if($('#formulario-ejemplar')[0].checkValidity()){
            $('#formulario-ejemplar').submit();
            Swal.fire("Excelente!", "Ejemplar Guardado!", "success");
        }else{
            $('#formulario-ejemplar')[0].reportValidity()
        }
    }

    function validaEmail()
    {
        let email = $("#email").val();

        $.ajax({
            url: "{{ url('User/validaEmail') }}",
            data: {email: email},
            type: 'POST',
            success: function(data) {

                if(data.vEmail > 0){
                    $("#msg-error-email").show();
                }else{
                    $("#msg-error-email").hide();
                }
            }
        });
    }

    function cambiaPropietario()
    {
        $("#select-propietario").show();
        $("#boton-propietario-id").hide();
    }

    function cambiaCoPropietario()
    {
        $("#select-copropietario").show();
        $("#boton-copropietario-id").hide();
    }

    function seleccionaPadre()
    {
        $("#modal-padres").modal('show');        
        $("#sexo-modal").val('macho');
        $("#ajaxEjemplar").html('');
        $("#busqueda-kcb").val('');
        $("#busqueda-nombre").val('');
    }

    $("#busqueda-kcb, #busqueda-nombre").on("change paste keyup", function() {

        let kcb = $("#busqueda-kcb").val();
        let nombre = $("#busqueda-nombre").val();
        let sexo = $("#sexo-modal").val();

        $.ajax({
            url: "{{ url('Ejemplar/ajaxBuscaEjemplar') }}",
            data: {
                kcb: kcb, 
                nombre: nombre,
                sexo: sexo
            },
            type: 'POST',
            success: function(data) {
                $("#ajaxEjemplar").html(data);
            }
        });

    });

    function seleccionaMadre()
    {
        $("#modal-padres").modal('show');
        $("#sexo-modal").val('hembra');
        $("#ajaxEjemplar").html('');
        $("#busqueda-kcb").val('');
        $("#busqueda-nombre").val('');
    }

    function muestraBloqueFallecido(){
        $("#bloque-fallecido").toggle('slow');
    }

    function muestraBloqueNacionalizado(){
        $("#bloque-nacionalizado").toggle('slow');
    }
    function nuevoExamen(){
        $("#modal-examen").modal('show');
    }

    {{--  EXAMNES  --}}
    $(function(){
        $('#nombre_examen').select2({
            placeholder: "Select a state"
        });
    });

    function guardaExamen(){
        // $("#formulario-examen")
        if($("#formulario-examenes")[0].checkValidity()){
            // alert('bien');
            $("#modal-examen").modal('hide');
            Swal.fire("Excelente!", "Examen Guardado!", "success");
            let datosFormularioExamen = $("#formulario-examenes").serializeArray();
            $.ajax({
				url: "{{ url('Ejemplar/ajaxGuardaExamen') }}",
				data: datosFormularioExamen,
				type: 'POST',
				success: function(data) {
					$('#examenes-1').html(data);
				}
			});
        }else{
            $("#formulario-examenes")[0].reportValidity();
        }
    }

    function eliminaExamen(id, nombreExamen){

        Swal.fire({
            // mostramos el modal de confirmacion eliminar
            title: "Quieres eliminar "+nombreExamen,
            text: "Ya no podras recuperarlo!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, borrar!",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true
        }).then(function(result) {
            // si pulsa boton si
            if (result.value) {

                // window.location.href = "{{ url('Ejemplar/eliminaExamen') }}/"+id;
                // enviar via ajax la eliminacion

                $.ajax({
                    url: "{{ url('Ejemplar/ajaxEliminaExamen') }}",
                    data: {idExamen: id},
                    type: 'POST',
                    success: function(data) {
                        $('#examenes-1').html(data);
                    }
                });


                Swal.fire(
                    "Borrado!",
                    "El registro fue eliminado.",
                    "success"
                )
                // result.dismiss can be "cancel", "overlay",
                // "close", and "timer"
            } else if (result.dismiss === "cancel") {
                Swal.fire(
                    "Cancelado",
                    "La operacion fue cancelada",
                    "error"
                )
            }
        });

    }

    // TRAMSFERENCIAS

    function nuevaTransferencia() {
        //mostramos el modal
        $("#modal-tramsferencia").modal('show');

        //limpiamos el formulario de transferencias
        $("#transferencia_fecha_transferencia").val('');
        $("#transferencia_fecha_exportacion").val('');
        $("#transferencia_estado").val('Actual')
        $("#transferencia_pais_destino").val('');
        $("#transferencia_pedigree").prop("checked", false);
        boton = '<button class="btn btn-primary btn-block" type="button" onclick="BuscaPropietario()">Propietario</button>';
        $("#transferencia_propietario").html(boton);
    }

    {{-- $("#transferencia_propietario_id").select2({
        placeholder: "Busca por nombre",
        allowClear: true,
        ajax: {
            url: "{{ url('User/ajaxBuscaPropietario') }}",
            dataType: 'json',
            method: 'POST',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term,
                };
            },
            processResults: function (response) {

                return {
                    results: response
                };
            },
            cache: true
        },
        minimumInputLength: 1,
    }); --}}

    function guardaTransferencia(){
        // $("#formulario-examen")
        if($("#formulario-transferencia")[0].checkValidity()){
            // alert('bien');
            $("#modal-tramsferencia").modal('hide');
            Swal.fire("Excelente!", "Examen Guardado!", "success");
            let datosFormularioTransferencia = $("#formulario-transferencia").serializeArray();
            $.ajax({
				url: "{{ url('Ejemplar/ajaxGuardaTransferencia') }}",
				data: datosFormularioTransferencia,
				type: 'POST',
				success: function(data) {
					$('#transferencias-1').html(data);
				}
			});
        }else{
            $("#formulario-transferencia")[0].reportValidity();
        }
    }

    function eliminaTransferencia(id, nombrePropietario){
        Swal.fire({
            // mostramos el modal de confirmacion eliminar
            title: "Quieres eliminar "+nombrePropietario,
            text: "Ya no podras recuperarlo!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, borrar!",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true
        }).then(function(result) {
            // si pulsa boton si
            if (result.value) {

                // window.location.href = "{{ url('Ejemplar/eliminaExamen') }}/"+id;
                // enviar via ajax la eliminacion

                $.ajax({
                    url: "{{ url('Ejemplar/ajaxEliminaTransferencia') }}",
                    data: {idTransferencia: id},
                    type: 'POST',
                    success: function(data) {
                        $('#transferencias-1').html(data);
                    }
                });


                Swal.fire(
                    "Borrado!",
                    "El registro fue eliminado.",
                    "success"
                )
                // result.dismiss can be "cancel", "overlay",
                // "close", and "timer"
            } else if (result.dismiss === "cancel") {
                Swal.fire(
                    "Cancelado",
                    "La operacion fue cancelada",
                    "error"
                )
            }
        });
    }

    {{--  TITULOS  --}}

    function nuevoTitulo(){
        $("#modal-titulo").modal('show');
    }

    function guardarTitulo(){
        if($("#formulario-titulo")[0].checkValidity()){
            // alert('bien');
            $("#modal-titulo").modal('hide');
            Swal.fire("Excelente!", "Titulo Guardado!", "success");
            let datosFormularioTitulo = $("#formulario-titulo").serializeArray();
            $.ajax({
				url: "{{ url('Ejemplar/ajaxGuardaTitulo') }}",
				data: datosFormularioTitulo,
				type: 'POST',
				success: function(data) {
					$('#titulos-1').html(data);
				}
			});
        }else{
            $("#formulario-titulo")[0].reportValidity();
        }
    }

    $(function(){
        $('#titulo_titulo_id').select2({
            placeholder: "Select a state"
        });
    });

    function eliminaTitulo(id, nombrePropietario){
        Swal.fire({
            // mostramos el modal de confirmacion eliminar
            title: "Quieres eliminar "+nombrePropietario,
            text: "Ya no podras recuperarlo!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, borrar!",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true
        }).then(function(result) {
            // si pulsa boton si
            if (result.value) {

                // window.location.href = "{{ url('Ejemplar/eliminaExamen') }}/"+id;
                // enviar via ajax la eliminacion

                $.ajax({
                    url: "{{ url('Ejemplar/ajaxEliminaTitulo') }}",
                    data: {idTituloEjemplar: id},
                    type: 'POST',
                    success: function(data) {
                        $('#titulos-1').html(data);
                    }
                });


                Swal.fire(
                    "Borrado!",
                    "El registro fue eliminado.",
                    "success"
                )
                // result.dismiss can be "cancel", "overlay",
                // "close", and "timer"
            } else if (result.dismiss === "cancel") {
                Swal.fire(
                    "Cancelado",
                    "La operacion fue cancelada",
                    "error"
                )
            }
        });
    }
    function volver(){
        alert('Volver');
    }

    {{-- BUSCA PROPIETARIO --}}
    function BuscaPropietario(){
        $("#modal-tramsferencia").modal('hide');
        $("#modal-propietario").modal('show');
        $("#busca-ci").val('')
    }

    $("#busca-ci, #busca-nombre").on("change paste keyup", function() {

        let cedula = $("#busca-ci").val();
        let nombre = $("#busca-nombre").val();

        $.ajax({
            url: "{{ url('User/ajaxBuscaPropietarioTransferencia') }}",
            data: {
                cedula: cedula,
                nombre: nombre
            },
            type: "POST",
            success: function(data) {
                $("#ajaxPropietario").html(data);
            }
        });
    });

    function ajaxNuevoPropietario(){
        //alert('hola');

        $("#modal-tramsferencia").modal('hide');
        $('#modal-nuevo-propietario').modal('show');

        //limpiamos el formulario de nuevo propietario
        $('#nuevo_propietario_nombre').val('');
        $('#nuevo_propietario_email').val('');
        $('#nuevo_propietario_fecha_nacimiento').val('');
        $('#nuevo_propietario_cedula').val('');
        $('#nuevo_propietario_genero').val('Masculino');
        $('#nuevo_propietario_celular').val('');
        $('#nuevo_propietario_direccion').val('');
        $('#nuevo_propietario_departamento').val('La paz');
        $('#nuevo_propietario_tipo').val('Socio');

    }

    function guardarPropietario(){
        //alert('Guardar Propietario en procedimiento');
        let nombre              = $('#nuevo_propietario_nombre').val();
        let email               = $('#nuevo_propietario_email').val();
        let fecha_nacimiento    = $('#nuevo_propietario_fecha_nacimiento').val();
        let cedula              = $('#nuevo_propietario_cedula').val();
        let genero              = $('#nuevo_propietario_genero').val();
        let celular             = $('#nuevo_propietario_celular').val();
        let direccion           = $('#nuevo_propietario_direccion').val();
        let departamento        = $('#nuevo_propietario_departamento').val();
        let tipo                = $('#nuevo_propietario_tipo').val();

        let datosFormularioNuevoPropietario = {
            nombre: nombre,
            email: email,
            fecha_nacimiento: fecha_nacimiento,
            cedula: cedula,
            genero: genero,
            celular: celular,
            direccion: direccion,
            departamento: departamento,
            tipo: tipo
        }
        //console.log(datosFormularioNuevoPropietario);
        $.ajax({
            url: "{{ url('User/ajaxGuardaNuevoPropietario') }}",
            data: datosFormularioNuevoPropietario,
            type: "post",
            success: function(data){
                $("#transferencia_propietario").html(data);
                $("#modal-tramsferencia").modal('show');
                $('#modal-nuevo-propietario').modal('hide');
            }
        });
    }

    function validaEmail()
    {
        let email = $("#nuevo_propietario_email").val();

        $.ajax({
            url: "{{ url('User/validaEmail') }}",
            data: {email: email},
            type: 'POST',
            success: function(data) {
                // console.log(data.vEmail);     
                if(data.vEmail > 0){
                    $("#msg-error-email").show();
                }else{
                    $("#msg-error-email").hide();
                }
            }
        });
    }

    function validaCedula(){
        let cedula = $("#nuevo_propietario_cedula").val();

        $.ajax({
            url: "{{ url('User/validaCedula') }}",
            data: {cedula: cedula},
            type: 'POST',
            success: function(data) {
                // console.log(data.vEmail);     
                if(data.vCedula > 0){
                    $("#msg-error-cedula").show();
                }else{
                    $("#msg-error-cedula").hide();
                }
            }
        });
    }
    
    // Class definition

    var KTBootstrapSwitch = function() {
        // Private functions
        var demos = function() {
        // minimum setup
            $('[data-switch=true]').bootstrapSwitch();
        };
    
        return {
            // public functions
            init: function() {
                demos();
            },
        };
    }();
    
    jQuery(document).ready(function() {
        KTBootstrapSwitch.init();
    });
    
    function mostrarAlquiler() {
        var c = document.getElementById('check_alquiler').checked;
        if(c){
            $("#bloque_alquiler_propietario").toggle('slow');
            $("#alquiler_value").val(1);
            //alert("si");
        }else{
            $("#bloque_alquiler_propietario").toggle('slow');
            $("#alquiler_value").val(0);
            //alert("no");
        }
    }

    $("#alquiler_propietario_id").select2({
        placeholder: "Busca por nombre",
        allowClear: true,
        ajax: {
            url: "{{ url('User/ajaxBuscaPropietario') }}",
            dataType: 'json',
            method: 'POST',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term,
                };
            },
            processResults: function (response) {

                return {
                    results: response
                };
            },
            cache: true
        },
        minimumInputLength: 1,
    });

    // edicion de padres de ejemplares
    function edicionPadre(){
        // alert("hola");
        $('#modal-edicion-de-padres').modal('show');
    }
</script>
@endsection