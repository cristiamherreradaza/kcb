@extends('layouts.app')

@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('css')

@endsection

@section('content')


{{-- Modal de registro de nuevo ejemplar --}}
<div class="modal fade" id="modal-registro-nuevo-ejemplar" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true" style="position: fixed;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRO DE NUEVO EJEMPLAR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="edita-formulario-nuevo-ejemplar">
                    @csrf
                    <div class="row">
                        <input type="text" id="edita_ejemplar_id" name="edita_ejemplar_id">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="kcb">Nombre Completo del ejemplar </label>
                                <span  pan class="text-danger">*</span>
                                {{-- <input type="hidden" name="sexo-modal" id="sexo-modal" value="macho"> --}}
                                <input type="text" class="form-control" id="edita_nuevo_nombre" name="edita_nuevo_nombre" autocomplete="off" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="kcb">Raza 
                                </label>
                                <span class="text-danger">*</span></label>
                                {{-- <input type="hidden" name="sexo-modal" id="sexo-modal" value="macho"> --}}
                                <select name="edita_nuevo_raza" id="edita_nuevo_raza" class="form-control" >
                                    <option value="{{ $ejemplar->raza->id }}">{{ $ejemplar->raza->nombre }}</option>
                                </select>
                                {{-- <input type="text" disabled class="form-control" id="edita_nuevo_raza" name="edita_nuevo_raza" autocomplete="off" value="{{ $ejemplar->raza->nombre }}"/> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Sexo</label>
                                <select class="form-control" id="edita_nuevo_sexo" name="edita_nuevo_sexo">
                                    <option value="Macho">Macho</option>
                                    <option value="Hembra">Hembra</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Codigo</label>
                                <input type="text" class="form-control" id="edita_nuevo_codigo" name="edita_nuevo_codigo">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Color</label>
                                <input type="text" class="form-control" id="edita_nuevo_color" name="edita_nuevo_color">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Señas o Marcas</label>
                                <input type="text" class="form-control" id="edita_nuevo_senas" name="edita_nuevo_senas">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Origen</label>
                                <input type="text" class="form-control" id="edita_nuevo_origen" name="edita_nuevo_origen">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Ciudad/Pais (Lugar)</label>
                                <input type="text" class="form-control" id="edita_nuevo_lugar" name="edita_nuevo_lugar">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="edita_nuevo_fecha_nacimiento" name="edita_nuevo_fecha_nacimiento">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Titulos</label>
                                <input type="text" class="form-control" id="edita_nuevo_titulos" name="edita_nuevo_titulos">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-success btn-block" onclick="guardaEjemplar()">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- End Modal de registro de nuevo ejemplar --}}

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
                <form action="{{ url('Ejemplar/guardaEjemplarEdita') }}" method="POST" id="edita-formulario-padres">
                    @csrf
                    <div class="row">
                        <div class="col-md-12" >
                            <div class="form-group">
                                <label for="kcb">Seleccione el Padre del Ejemplar
                                </label>
                                <br>
                                id ejempalr:
                                <input type="text" id="edicion_ejemplar_id" name="edicion_ejemplar_id" value="{{ $ejemplar->id }}">
                                <br>
                                id raza
                                <input type="text" id="edicion_raza_id" name="edicion_raza_id">
                                <br>
                                id padre
                                <input type="text" id="edicion_padre_id" name="edicion_padre_id">
                                <br>
                                id ejemplar a editar
                                <input type="text" id="edicion_ejemplar_id_editar" name="edicion_ejemplar_id_editar">
                                <div id="bloque-edita-padre">
                                    {{-- <button type='button' id='btn-padre' onclick='edicionAjaxBuscaEjemplar("Macho")' class='btn btn-block btn-primary'>PADRE</button> --}}
                                </div>
                                <br>
                                <label for="exampleInputPassword1">
                                    Registrar 
                                    <span class="label label-success label-inline font-weight-normal mr-2" onclick="registro_nuevo_ejemplar('Macho')">Nuevo Ejemplar</span>
                                </label><br>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" >
                            <div class="form-group">
                                <label for="kcb">Seleccione el Madre del Ejemplar
                                </label>
                                <input type="text" id="edicion_madre_id" name="edicion_madre_id">
                                <div id="bloque-edita-madre">
                                    {{-- <button type='button' id='btn-madre' onclick='edicionAjaxBuscaEjemplar("Hembra")' class='btn btn-block btn-info'>MADRE</button> --}}
                                </div>
                                <br>
                                <label for="exampleInputPassword1">
                                    Registrar 
                                    <span class="label label-success label-inline font-weight-normal mr-2" onclick="registro_nuevo_ejemplar('Hembra')">Nuevo Ejemplar</span>
                                </label><br>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" id="edita_padres_guarda" class="btn btn-success btn-block" onclick="guardarEjemplarEditado()">Guardar</button>
                        </div>
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
    {{-- Moodal Edita padres  --}}
    <div class="modal fade" id="edita-modal-padres" data-backdrop="static" tabindex="-1" role="dialog"
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
                                    <input type="hidden" name="edita-sexo-modal" id="edita-sexo-modal" value="macho">
                                    <input type="hidden" name="edita-raza-modal" id="edita-raza-modal" value="{{  $ejemplar->raza_id }}">
                                    <input type="text" class="form-control" id="edita-busqueda-kcb" name="edita-busqueda-kcb" autocomplete="off" />
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="nombre">Nombre
                                    </label>
                                    <input type="text" class="form-control" id="edita-busqueda-nombre" name="edita-busqueda-nombre" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12" id="EdicionajaxEjemplar">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- fin inicio modal  --}}


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

        // defiunimos la raza del ejemplar origen_nacionalizado

        $edicion_raza_id = $ejemplarOrigen->raza_id;
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

        $IdPapa = '';
        $IdAbuelo = '';
        $IdAbueloM = '';
        $IdAbuelaM = '';
        $IdTGPadre = '';
        $IdTGMadre = '';
        $IdCGPadre = '';
        $IdCGMadre = '';
        $IdTGMadreP1 = '';
        $IdTGMadreM2 = '';
        $IdAbueloTG1 = '';
        $IdAbuelaTG1 = '';
        $IdAbueloCG1 = '';
        $IdAbueloCG1M = '';
        $IdAbueloTG1M1 = '';
        $IdAbueloCG1M = '';
        $IdAbuelaTG1M1 = '';

        if($ejemplarOrigen->padre_id != null){
            $papa = App\Ejemplar::find($ejemplarOrigen->padre_id);

            $kcbPapa = ($papa)?$papa->kcb:'';
            $nombrePapa = ($papa != null)?$papa->nombre:'';
            $IdPapa = ($papa != null)?$papa->id:null;
            
            // preguntamos si el papa tiene padre
            // para sacar al abuelo
            if($papa->padre_id != null){

                $abuelo = App\Ejemplar::find($papa->padre_id);

                $kcbAbuelo = ($abuelo)?$abuelo->kcb:'';
                $nombreAbuelo = ($abuelo != null)?$abuelo->nombre:'';
                $IdAbuelo = ($abuelo != null)?$abuelo->id:null;

                // preguntamos si el abuelo tiene padre
                // para sacar al tecera generacion padre
                if($abuelo->padre_id != null){

                    $tGPadre = App\Ejemplar::find($abuelo->padre_id);

                    $kcbTGPadre = ($tGPadre)?$tGPadre->kcb:'';
                    $nombreTGPadre = ($tGPadre != null)?$tGPadre->nombre:'';
                    $IdTGPadre = ($tGPadre != null)?$tGPadre->id:null;

                    // preguntamos si la tercera generacion tiene padre
                    // para sacar al cuarta generacion padre
                    if($tGPadre->padre_id != null){

                        $cGPadre = App\Ejemplar::find($tGPadre->padre_id);
                        
                        $kcbCGPadre = ($cGPadre)?$cGPadre->kcb:'';
                        $nombreCGPadre = ($cGPadre != null)?$cGPadre->nombre:'';
                        $IdCGPadre = ($cGPadre != null)?$cGPadre->id:null;
                    }else{
                        $kcbCGPadre = '';
                        $nombreCGPadre = '';
                        $IdCGPadre = null;
                    }

                    // preguntamos si la tercera generacion tiene madre
                    // para sacar al cuarta generacion madre
                    if($tGPadre->madre_id != null){

                        $cGMadre = App\Ejemplar::find($tGPadre->madre_id);
                        
                        $kcbCGMadre = ($cGMadre)?$cGMadre->kcb:'';
                        $nombreCGMadre = ($cGMadre != null)?$cGMadre->nombre:'';
                        $IdCGMadre = ($cGMadre != null)?$cGMadre->id:null;
                    }else{
                        $kcbCGMadre = '';
                        $nombreCGMadre = '';
                        $IdCGMadre = null;
                    }

                }else{
                    $kcbTGPadre = '';
                    $nombreTGPadre = '';
                    $IdTGPadre = null;
                }

                // preguntamos si el abuelo tiene madre
                // para sacar al tecera generacion madre
                if($abuelo->madre_id != null){

                    $tGMadre = App\Ejemplar::find($abuelo->madre_id);

                    $kcbTGMadre = ($tGMadre)?$tGMadre->kcb:'';
                    $nombreTGMadre = ($tGMadre != null)?$tGMadre->nombre:'';
                    $IdTGMadre = ($tGMadre != null)?$tGMadre->id:null;

                    if($tGMadre->padre_id != null){

                        $CGMadreP = App\Ejemplar::find($tGMadre->padre_id);

                        $kcbTGMadreP1 = ($CGMadreP)?$CGMadreP->kcb:'';
                        $nombreTGMadreP1 = ($CGMadreP)?$CGMadreP->nombre:'';    
                        $IdTGMadreP1 = ($CGMadreP)?$CGMadreP->id:null;    
                    }else{
                        $kcbTGMadreP1 = '';
                        $nombreTGMadreP1 = '';    
                        $IdTGMadreP1 = null;    
                    }

                    // para la madre de del atercera generacion
                    if($tGMadre->madre_id != null){

                        $CGMadreM2 = App\Ejemplar::find($tGMadre->madre_id);

                        $kcbTGMadreM2 = ($CGMadreM2)?$CGMadreM2->kcb:'';
                        $nombreTGMadreM2 = ($CGMadreM2)?$CGMadreM2->nombre:'';    
                        $IdTGMadreM2 = ($CGMadreM2)?$CGMadreM2->id:null;    
                    }else{
                        $kcbTGMadreM2 = '';
                        $nombreTGMadreM2 = '';    
                        $IdTGMadreM2 = null;    
                    }

                }else{
                    $kcbtGMadre = '';
                    $nombretGMadre = '';
                    $IdTGMadre = null;
                }

            }else{
                $kcbAbuelo = '';
                $nombreAbuelo = '';
                $IdAbuelo = null;
            }

            // preguntamos si el papa tiene madre
            // para sacar al abuela
            if($papa->madre_id != null){

                $abuela = App\Ejemplar::find($papa->madre_id);

                $kcbAbuela = ($abuela)?$abuela->kcb:'';
                $nombreAbuela = ($abuela != null)?$abuela->nombre:'';
                $IdAbuela = ($abuela != null)?$abuela->id:null;

                if($abuela->padre_id != null){

                    $abueloTG = App\Ejemplar::find($abuela->padre_id);

                    $kcbAbueloTG1 = ($abueloTG)?$abueloTG->kcb:'';
                    $nombreAbueloTG1 = ($abueloTG)?$abueloTG->nombre:'';
                    $IdAbueloTG1 = ($abueloTG)?$abueloTG->id:null;

                    if($abueloTG->padre_id != null){

                        $abueloCG = App\Ejemplar::find($abueloTG->padre_id);

                        $kcbAbueloCG1 = ($abueloCG)?$abueloCG->kcb:'';
                        $nombreAbueloCG1 = ($abueloCG)?$abueloCG->nombre:'';
                        $IdAbueloCG1 = ($abueloCG)?$abueloCG->id:null;
                    }else{
                        $kcbAbueloCG1 = '';
                        $nombreAbueloCG1 = '';
                        $IdAbueloCG1 = null;
                    }

                    if($abueloTG->madre_id != null){

                        $abueloCGM = App\Ejemplar::find($abueloTG->madre_id);

                        $kcbAbueloCG1M = ($abueloCGM)?$abueloCGM->kcb:'';
                        $nombreAbueloCG1M = ($abueloCGM)?$abueloCGM->nombre:'';
                        $IdAbueloCG1M = ($abueloCGM)?$abueloCGM->id:null;
                    }else{
                        $kcbAbueloCG1M = '';
                        $nombreAbueloCG1M = '';
                        $IdAbueloCG1M = null;
                    }
                }else{
                    $kcbAbueloTG1 = '';
                    $nombreAbueloTG1 = '';
                    $IdAbueloTG1 = null;
                }

                // hacemos para su mama de la abuela
                if($abuela->madre_id != null){

                    $abuelaTG = App\Ejemplar::find($abuela->madre_id);

                    $kcbAbuelaTG1 = ($abuelaTG)?$abuelaTG->kcb:'';
                    $nombreAbuelaTG1 = ($abuelaTG)?$abuelaTG->nombre:'';
                    $IdAbuelaTG1 = ($abuelaTG)?$abuelaTG->id:null;

                    // aqui hay que hacer para la cuarte generracion tanto como padre y madres
                    if($abuelaTG->padre_id != null){

                        $abueloTGM1 = App\Ejemplar::find($abuelaTG->padre_id);

                        $kcbAbueloTG1M1 = ($abueloTGM1)?$abueloTGM1->kcb:'';
                        $nombreAbueloTG1M1 = ($abueloTGM1)?$abueloTGM1->nombre:'';
                        $IdAbueloTG1M1 = ($abueloTGM1)?$abueloTGM1->id:null;
                    }else{
                        $kcbAbueloTG1M1 = '';
                        $nombreAbueloTG1M1 = '';
                        $IdAbueloTG1M1 = null;
                    }
                    if($abuelaTG->madre_id != null){

                        $abuelaTGM1 = App\Ejemplar::find($abuelaTG->madre_id);

                        $kcbAbuelaTG1M1 = ($abuelaTGM1)?$abuelaTGM1->kcb:'';
                        $nombreAbuelaTG1M1 = ($abuelaTGM1)?$abuelaTGM1->nombre:'';
                        $IdAbuelaTG1M1 = ($abuelaTGM1)?$abuelaTGM1->id:null;
                    }else{
                        $kcbAbuelaTG1M1 = '';
                        $nombreAbuelaTG1M1 = '';
                        $IdAbuelaTG1M1 = null;
                    }
                }else{
                    $kcbAbuelaTG1 = '';
                    $nombreAbuelaTG1 = '';
                    $IdAbuelaTG1 = null;
                }
            }else{
                $kcbAbuela = '';
                $nombreAbuela = '';
                $IdAbuela = null;
            }

        }else{
            $kcbPapa = '';
            $nombrePapa = '';    
            $IdPapa = null;
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

        $IdAbuela = '';
        $IdTGPadreM = '';
        $IdTGMadreM = '';
        $IdCGPadreM1 = '';
        $IdCGPadreM1 = '';
        $IdCGPadreM2 = '';
        $IdCGPadreM = '';
        $IdCGMadreM = '';
        $IdabueloMSG = '';
        $IdabueloMSG2 = '';
        $IdabueloMTG1 = '';
        $IdabueloMTG1 = '';
        $IdabueloMTG11 = '';
        $IdabueloMSG22 = '';
        $IdabueloMSG222 = '';


        if($ejemplarOrigen->madre_id != null){
            $mama = App\Ejemplar::find($ejemplarOrigen->madre_id);

            $kcbMama = ($mama != null)?$mama->kcb:'';
            $nombreMama = ($mama != null)?$mama->nombre:'';
            $IdMama = ($mama != null)?$mama->id:null;

            if($mama->padre_id != null){

                $abueloM = App\Ejemplar::find($mama->padre_id);

                $kcbAbueloM     = ($abueloM)? $abueloM->kcb: '';
                $nombreAbueloM  = ($abueloM)? $abueloM->nombre: '';
                $IdAbueloM  = ($abueloM)? $abueloM->id: null;

                if($abueloM->padre_id != null){
                    
                    $tGPadreM = App\Ejemplar::find($abueloM->padre_id);

                    $kcbTGPadreM = ($tGPadreM)?$tGPadreM->kcb:'';
                    $nombreTGPadreM = ($tGPadreM)?$tGPadreM->nombre:'';
                    $IdTGPadreM = ($tGPadreM)?$tGPadreM->id:null;

                    if($tGPadreM->padre_id != null){

                        $CGPadreM1 = App\Ejemplar::find($tGPadreM->padre_id);

                        $kcbCGPadreM1 = ($CGPadreM1)?$CGPadreM1->kcb:'';
                        $nombreCGPadreM1 = ($CGPadreM1)?$CGPadreM1->nombre:'';
                        $IdCGPadreM1 = ($CGPadreM1)?$CGPadreM1->id:null;
                    }else{
                        $kcbCGPadreM1 = '';
                        $nombreCGPadreM1 = '';
                        $IdCGPadreM1 = null;
                    }
                    if($tGPadreM->madre_id != null){

                        $CGPadreM2 = App\Ejemplar::find($tGPadreM->madre_id);

                        $kcbCGPadreM2 = ($CGPadreM2)?$CGPadreM2->kcb:'';
                        $nombreCGPadreM2 = ($CGPadreM2)?$CGPadreM2->nombre:'';
                        $IdCGPadreM2 = ($CGPadreM2)?$CGPadreM2->id:null;
                    }else{
                        $kcbCGPadreM2 = '';
                        $nombreCGPadreM2 = '';
                        $IdCGPadreM2 = null;
                    }

                }else{
                    $kcbTGPadreM = '';
                    $nombreTGPadreM = '';
                    $IdTGPadreM = null;
                }

                if($abueloM->madre_id != null){

                    $tGMadreM = App\Ejemplar::find($abueloM->madre_id);

                    $kcbTGMadreM = ($tGMadreM)?$tGMadreM->kcb:'';
                    $nombreTGMadreM = ($tGMadreM)?$tGMadreM->nombre:'';
                    $IdTGMadreM = ($tGMadreM)?$tGMadreM->id:null;

                    if($tGMadreM->padre_id != null){

                        $CGPadreM = App\Ejemplar::find($tGMadreM->padre_id);

                        $kcbCGPadreM = ($CGPadreM)? $CGPadreM->kcb:'';                   
                        $nombreCGPadreM = ($CGPadreM)? $CGPadreM->nombre:'';                   
                        $IdCGPadreM = ($CGPadreM)? $CGPadreM->id:null;                   

                    }else{

                        $kcbCGPadreM = '';                   
                        $nombreCGPadreM = '';   
                        $IdCGPadreM = null;                   
                    }
                    if($tGMadreM->madre_id != null){

                        $CGMadreM = App\Ejemplar::find($tGMadreM->madre_id);

                        $kcbCGMadreM = ($CGMadreM)? $CGMadreM->kcb:'';                   
                        $nombreCGMadreM = ($CGMadreM)? $CGMadreM->nombre:'';                   
                        $IdCGMadreM = ($CGMadreM)? $CGMadreM->id:null;                   
                    }else{
                        $kcbCGMadreM = '';                   
                        $nombreCGPadreM = '';                   
                        $IdCGMadreM = null;                   
                    }
                }else{
                    $kcbTGMadreM = '';
                    $nombreTGMadreM = '';
                    $IdTGMadreM = null;
                }

            }else{

                $kcbAbueloM     = '';
                $nombreAbueloM  = '';
                $IdAbueloM  = null;
            }

            if($mama->madre_id != null){

                $abuelaM = App\Ejemplar::find($mama->madre_id);

                $kcbAbuelaM     = ($abuelaM)?$abuelaM->kcb:'';
                $nombreAbuelaM  = ($abuelaM)?$abuelaM->nombre:'';
                $IdAbuelaM  = ($abuelaM)?$abuelaM->id:null;

                if($abuelaM->padre_id != null){

                    $abueloSG   =App\Ejemplar::find($abuelaM->padre_id);

                    $kcbabueloMSG  = ($abueloSG)? $abueloSG->kcb:'' ;
                    $nombreabueloMSG  = ($abueloSG)? $abueloSG->nombre:'' ;
                    $IdabueloMSG  = ($abueloSG)? $abueloSG->id:null ;

                    if($abueloSG->padre_id){

                        $abueloTG1   =App\Ejemplar::find($abueloSG->padre_id);

                        $kcbabueloMTG1  = ($abueloTG1)? $abueloTG1->kcb:'' ;
                        $nombreabueloMTG1  = ($abueloTG1)? $abueloTG1->nombre:'' ;
                        $IdabueloMTG1  = ($abueloTG1)? $abueloTG1->id:null ;
                    }else{
                        $kcbabueloMTG1  = '' ;
                        $nombreabueloMTG1  = '' ;
                        $IdabueloMTG1  = null ;
                    }
                    // la madre de la cuarta generacion
                    if($abueloSG->madre_id != null){

                        $abueloTG11   =App\Ejemplar::find($abueloSG->madre_id);

                        $kcbabueloMTG11  = ($abueloTG11)? $abueloTG11->kcb:'' ;
                        $nombreabueloMTG11  = ($abueloTG11)? $abueloTG11->nombre:'' ;
                        $IdabueloMTG11  = ($abueloTG11)? $abueloTG11->id:null ;
                    }else{
                        $kcbabueloMTG11  = '' ;
                        $nombreabueloMTG11  = '' ;
                        $IdabueloMTG11  = null ;
                    }
                }else{
                    $kcbabueloMSG  = '' ;
                    $nombreabueloMSG  = '' ;
                    $IdabueloMSG  = null ;
                }
                // de aqui comienza las madres de la abuela
                if($abuelaM->madre_id != null){

                    $abueloSGM2   =App\Ejemplar::find($abuelaM->madre_id);

                    $kcbabueloMSG2  = ($abueloSGM2)? $abueloSGM2->kcb:'' ;
                    $nombreabueloMSG2  = ($abueloSGM2)? $abueloSGM2->nombre:'' ;
                    $IdabueloMSG2  = ($abueloSGM2)? $abueloSGM2->id:null ;

                    if($abueloSGM2->padre_id != null){

                        $abueloSGM22   =App\Ejemplar::find($abueloSGM2->padre_id);

                        $kcbabueloMSG22  = ($abueloSGM22)? $abueloSGM22->kcb:'' ;
                        $nombreabueloMSG22  = ($abueloSGM22)? $abueloSGM22->nombre:'' ;
                        $IdabueloMSG22  = ($abueloSGM22)? $abueloSGM22->id:null ;
                    }else{

                        $kcbabueloMSG22  = '' ;
                        $nombreabueloMSG22  = '' ;  
                        $IdabueloMSG22  = null ;
                    }
                    if($abueloSGM2->madre_id != null){

                        $abueloSGM222   =App\Ejemplar::find($abueloSGM2->madre_id);

                        $kcbabueloMSG222  = ($abueloSGM222)? $abueloSGM222->kcb:'' ;
                        $nombreabueloMSG222  = ($abueloSGM222)? $abueloSGM222->nombre:'' ;
                        $IdabueloMSG222  = ($abueloSGM222)? $abueloSGM222->id:null ;
                    }else{
                        $kcbabueloMSG222  = '' ;
                        $nombreabueloMSG222  = '' ;
                        $IdabueloMSG222  = null ;
                    }
                }else{
                    $kcbabueloMSG2  = '' ;
                    $nombreabueloMSG2  = '' ;
                    $IdabueloMSG2  = null ;
                }
            }else{
                $kcbAbuelaM     = '';
                $nombreAbuelaM  = '';
                $IdAbuelaM  = null;
            }

        }else{
            $kcbMama = '';
            $nombreMama = '';
            $IdMama = null;
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
                                        <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('{{ $IdPapa }}','{{ addslashes($nombreAbuelo) }}','{{ $IdAbuelo }}','{{ addslashes($nombreAbuela) }}','{{ $IdAbuela }}','{{ $edicion_raza_id }}')">
                                            PADRESp1
                                        </span>
                                    </td>
                                    <td rowspan="4">
                                        {{  $nombreAbuelo }}
                                        <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('{{ $IdAbuelo }}','{{ addslashes($nombreTGPadre) }}','{{ $IdTGPadre }}','{{ addslashes($nombreTGMadre) }}','{{ $IdTGMadre }}','{{ $edicion_raza_id }}')">
                                            PADRESa1
                                        </span>
                                    </td>
                                    <td rowspan="2">
                                        {{ $nombreTGPadre }}
                                        <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('{{ $IdTGPadre }}','{{ addslashes($nombreCGPadre) }}','{{ $IdCGPadre }}','{{ addslashes($nombreCGMadre) }}','{{ $IdCGMadre }}','{{ $edicion_raza_id }}')">
                                            PADRESt1
                                        </span>
                                    </td>
                                    <td>
                                        {{ $nombreCGPadre }}
                                        {{-- <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('padre')">
                                            PADRES
                                        </span> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ $nombreCGMadre }}
                                        {{-- <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('padre')">
                                            PADRES
                                        </span> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="2">
                                        {{ $nombreTGMadre }}
                                        <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('{{ $IdTGMadre }}','{{ addslashes($nombreTGMadreP1) }}','{{ $IdTGMadreP1 }}','{{ addslashes($nombreTGMadreM2) }}','{{ $IdTGMadreM2 }}','{{ $edicion_raza_id }}')">
                                            PADRESt2
                                        </span>
                                    </td>
                                    <td>
                                        {{ $nombreTGMadreP1 }}
                                        {{-- <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('padre')">
                                            PADRES
                                        </span> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ $nombreTGMadreM2 }}
                                        {{-- <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('padre')">
                                            PADRES
                                        </span> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="4">
                                        {{ $nombreAbuela }}
                                        <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('{{ $IdAbuela }}','{{ addslashes($nombreAbueloTG1) }}','{{ $IdAbueloTG1 }}','{{ addslashes($nombreAbuelaTG1) }}','{{  $IdAbuelaTG1  }}','{{ $edicion_raza_id }}')">
                                            PADRESa2
                                        </span>
                                    </td>
                                    <td rowspan="2">
                                        {{ $nombreAbueloTG1 }}
                                        <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('{{ $IdAbueloTG1 }}','{{ addslashes($nombreAbueloCG1) }}','{{ $IdAbueloCG1 }}','{{ addslashes($nombreAbueloCG1M) }}','{{  $IdAbueloCG1M  }}','{{ $edicion_raza_id }}')">
                                            PADRESt3
                                        </span>
                                    </td>
                                    <td>
                                        {{ $nombreAbueloCG1 }}
                                        {{-- <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('padre')">
                                            PADRES
                                        </span> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ $nombreAbueloCG1M }}
                                        {{-- <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('padre')">
                                            PADRES
                                        </span> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="2">
                                        {{ $nombreAbuelaTG1 }}
                                        <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('{{ $IdAbuelaTG1 }}','{{ addslashes($nombreAbueloTG1M1) }}','{{ $IdAbueloTG1M1 }}','{{ addslashes($nombreAbuelaTG1M1) }}','{{  $IdAbuelaTG1M1  }}','{{ $edicion_raza_id }}')">
                                            PADRESt4
                                        </span>
                                    </td>
                                    <td>
                                        {{ $nombreAbueloTG1M1 }}
                                        {{-- <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('padre')">
                                            PADRES
                                        </span> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ $nombreAbuelaTG1M1 }}
                                        {{-- <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('padre')">
                                            PADRES
                                        </span> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="8">
                                        {{ $nombreMama }}
                                        <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('{{ $IdMama }}','{{ addslashes($nombreAbueloM) }}','{{ $IdAbueloM }}','{{ addslashes($nombreAbuelaM) }}','{{  $IdAbuelaM  }}','{{ $edicion_raza_id }}')">
                                            PADRESp2
                                        </span>
                                    </td>
                                    <td rowspan="4">
                                        {{ $nombreAbueloM }}
                                        <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('{{ $IdAbueloM }}','{{ addslashes($nombreTGPadreM) }}','{{ $IdTGPadreM }}','{{ addslashes($nombreTGMadreM) }}','{{  $IdTGMadreM  }}','{{ $edicion_raza_id }}')">
                                            PADRESa3
                                        </span>
                                    </td>
                                    <td rowspan="2">
                                        {{ $nombreTGPadreM }}
                                        <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('{{ $IdTGPadreM }}','{{ addslashes($nombreCGPadreM1) }}','{{ $IdCGPadreM1 }}','{{ addslashes($nombreCGPadreM2) }}','{{  $IdCGPadreM2  }}','{{ $edicion_raza_id }}')">
                                            PADRESt5
                                        </span>
                                    </td>
                                    <td>
                                        {{ $nombreCGPadreM1 }}
                                        {{-- <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('padre')">
                                            PADRES
                                        </span> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ $nombreCGPadreM2 }}
                                        {{-- <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('padre')">
                                            PADRES
                                        </span> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="2">
                                        {{ $nombreTGMadreM }}
                                        <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('{{ $IdTGMadreM }}','{{ addslashes($nombreCGPadreM) }}','{{ $IdCGPadreM }}','{{ addslashes($nombreCGMadreM) }}','{{  $IdCGMadreM  }}','{{ $edicion_raza_id }}')">
                                            PADRESt6
                                        </span>
                                    </td>
                                    <td>
                                        {{ $nombreCGPadreM }}
                                        {{-- <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('padre')">
                                            PADRES
                                        </span> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ $nombreCGMadreM }}
                                        {{-- <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('padre')">
                                            PADRES
                                        </span> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="4">
                                        {{ $nombreAbuelaM }}
                                        <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('{{ $IdAbuelaM }}','{{ addslashes($nombreabueloMSG) }}','{{ $IdabueloMSG }}','{{ addslashes($nombreabueloMSG2) }}','{{  $IdabueloMSG2  }}','{{ $edicion_raza_id }}')">
                                            PADRESa4
                                        </span>
                                    </td>
                                    <td rowspan="2">
                                        {{ $nombreabueloMSG  }}
                                        <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('{{ $IdabueloMSG }}','{{ addslashes($nombreabueloMTG1) }}','{{ $IdabueloMTG1 }}','{{ addslashes($nombreabueloMTG11) }}','{{  $IdabueloMTG11  }}','{{ $edicion_raza_id }}')">
                                            PADRESt7
                                        </span>
                                    </td>
                                    <td>
                                        {{ $nombreabueloMTG1  }}
                                        {{-- <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('padre')">
                                            PADRES
                                        </span> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ $nombreabueloMTG11 }}
                                        {{-- <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('padre')">
                                            PADRES
                                        </span> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="2">
                                        {{ $nombreabueloMSG2 }}
                                        <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('{{ $IdabueloMSG2 }}','{{ addslashes($nombreabueloMSG22) }}','{{ $IdabueloMSG22 }}','{{ addslashes($nombreabueloMSG222) }}','{{  $IdabueloMSG222  }}','{{ $edicion_raza_id }}')">
                                            PADRESt8
                                        </span>
                                    </td>
                                    <td>
                                        {{ $nombreabueloMSG22 }}
                                        {{-- <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('padre')">
                                            PADRES
                                        </span> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        {{ $nombreabueloMSG222 }}
                                        {{-- <span class="btn btn-sm btn-transparent-success font-weight-bold mr-2" onclick="edicionPadre('padre')">
                                            PADRES
                                        </span> --}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
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
    function edicionPadre(id_ejemplar_editar, nom_papa, padre_id, nom_mama, madre_id, raza_id){
        // let haber = "Id Padre => "+padre_id+" nombre => "+nom_papa+"Id Madre => "+madre_id+" nombre =>"+nom_mama;
        // alert(haber);
        let botonPadre,botonMadre;
        let Macho = "Macho";
        let Hembra = "Hembra";

        if(nom_papa != '' && padre_id != ''){
            botonPadre = "<button type='button' id='btn-padre' onclick='edicionAjaxBuscaEjemplar("+'"Macho"'+")' class='btn btn-block btn-primary'>"+nom_papa+"</button>";
            $("#edicion_padre_id").val(padre_id);
            $("#edicion_raza_id").val(raza_id);
        }else{
            botonPadre = "<button type='button' id='btn-padre' onclick='edicionAjaxBuscaEjemplar("+'"Macho"'+")' class='btn btn-block btn-primary'>PADRE</button>";
        }
        if(nom_mama != '' && madre_id != ''){
            botonMadre = "<button type='button' id='btn-madre' onclick='edicionAjaxBuscaEjemplar("+'"Hembra"'+")' class='btn btn-block btn-info'>"+nom_mama+"</button>";
            $("#edicion_madre_id").val(madre_id);
        }else{
            botonMadre = "<button type='button' id='btn-madre' onclick='edicionAjaxBuscaEjemplar("+'"Hembra"'+")' class='btn btn-block btn-info'>MADRE</button>";
        }

        
        $('#bloque-edita-padre').html(botonPadre);
        $('#bloque-edita-madre').html(botonMadre);
        $('#edicion_ejemplar_id_editar').val(id_ejemplar_editar);

        if(id_ejemplar_editar){
            $("#edita_padres_guarda").prop('disabled', false);
            // console.log("si");
        }else{
            // console.log("no");
            $("#btn-padre").prop('disabled', true);
            $("#btn-madre").prop('disabled', true);
            $("#edita_padres_guarda").prop('disabled', true);
        }

        $('#modal-edicion-de-padres').modal('show');
    }

    $("#edita-busqueda-kcb, #edita-busqueda-nombre").on("change paste keyup", function() {

        let kcb = $("#edita-busqueda-kcb").val();
        let nombre = $("#edita-busqueda-nombre").val();
        let sexo = $("#edita-sexo-modal").val();
        let raza = $("#edita-raza-modal").val();

        $.ajax({
            url: "{{ url('Ejemplar/ajaxBuscaEjemplarEdita') }}",
            data: {
                kcb: kcb, 
                nombre: nombre,
                sexo: sexo,
                raza: raza
            },
            type: 'POST',
            success: function(data) {
                $("#EdicionajaxEjemplar").html(data);
            }
        });

    });

    function edicionAjaxBuscaEjemplar(sexo){
        // alert(sexo);
        $('#modal-edicion-de-padres').modal('hide');
        $("#edita-sexo-modal").val(sexo);

        $('#edita-modal-padres').modal('show');
    }

    function guardarEjemplarEditado(){
        $("#edita-formulario-padres").submit();
    }

    function registro_nuevo_ejemplar(sexo){
        // alert(sexo);
        $("#edita_nuevo_sexo option[value="+ sexo +"]").attr("selected",true);
        let ejemplar_editar = $("#edicion_ejemplar_id_editar").val();
        $("#edita_ejemplar_id").val(ejemplar_editar);
        // alert(ejemplar_editar);
        // if(sexo == "Macho"){

        // }else{

        // }
        $("#modal-edicion-de-padres").modal("hide");
        $("#modal-registro-nuevo-ejemplar").modal("show");
    }

    function guardaEjemplar(){
        // alert($("#edita_nuevo_sexo").val());

        if($("#edita-formulario-nuevo-ejemplar")[0].checkValidity()){
            let sexo = $("#edita_nuevo_sexo").val();

            $("#modal-registro-nuevo-ejemplar").modal('hide');
            Swal.fire("Excelente!", "Titulo Guardado!", "success");
            let datosFormularioNuevoEjemplar = $("#edita-formulario-nuevo-ejemplar").serializeArray();
            $.ajax({
				url: "{{ url('Ejemplar/ajaxGuardaEjemplar') }}",
				data: datosFormularioNuevoEjemplar,
				type: 'POST',
				success: function(data) {
                    if(sexo == "Macho"){
                        $('#bloque-edita-padre').html(data);
                    }else{
                        $('#bloque-edita-madre').html(data);
                    }
                    $("#modal-registro-nuevo-ejemplar").modal("hide");
                    $("#modal-edicion-de-padres").modal("show");
				}
			});
        }else{
            $("#edita-formulario-nuevo-ejemplar")[0].reportValidity();
        }
        $("#modal-registro-nuevo-ejemplar").modal("hide");
    }
</script>
@endsection