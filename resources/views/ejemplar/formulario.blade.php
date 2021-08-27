@extends('layouts.app')

@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')

{{--  modal Examen  --}}

<div class="modal fade" id="modal-examen" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">NUEVO EXAMEN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="formulario-padres">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kcb">Examen
                                </label>
                                <input type="text" class="form-control" name="nombre_examen" id="nombre_examen">
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
                            <input type="text" class="form-control" id="doctor" name="doctor" autocomplete="off" />
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
                                <input type="text" class="form-control" name="resultado" id="resultado">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">Codigo DFC
                                </label>
                                <input type="text" class="form-control" id="obserbacion" name="obserbacion" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn btn-primary btn-block">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{--  end modal Examen  --}}
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
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ ($ejemplar != null)? $ejemplar->nombre:'' }}" required />
                        <input type="hidden" value="{{ ($ejemplar==null)? 0:$ejemplar->id }}" name="ejemplar_id" id="ejemplar_id">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="prefijo">Prefijo del nombre
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="prefijo" name="prefijo" value="{{ ($ejemplar != null)? $ejemplar->prefijo:'' }}" />
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
                        <input type="text" class="form-control" id="kcb" name="kcb" value="{{ ($ejemplar != null)? $ejemplar->kcb:'' }}" required />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="num_tatuaje">Numero Tatuaje
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="num_tatuaje" name="num_tatuaje" value="{{ ($ejemplar != null)? $ejemplar->num_tatuaje:'' }}" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="chip">Numero Chip
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="chip" name="chip" value="{{ ($ejemplar != null)? $ejemplar->chip:'' }}" />
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
                        <input type="text" class="form-control" id="color" name="color" value="{{ ($ejemplar != null)? $ejemplar->color:'' }}" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="senas">Se&ntilde;as o Marcas
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="senas" name="senas" value="{{ ($ejemplar != null)? $ejemplar->senas:'' }}" />
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
                        <button type="button" class="btn btn-primary btn-block" onclick="seleccionaPadre()">KCB: {{ $ejemplar->padre->kcb }} NOMBRE: {{ $ejemplar->padre->nombre }}</button>
                    @else
                        <button type="button" class="btn btn-primary btn-block" onclick="seleccionaPadre()">PADRE</button>
                    @endif
                </div>
                <input type="hidden" name="madre_id" id="madre_id">
                <div class="col-md-6" id="btn-madre">
                    @if ($ejemplar != null && $ejemplar->madre_id != null)
                        <button type="button" class="btn btn-info btn-block" onclick="seleccionaPadre()">KCB: {{ $ejemplar->madre->kcb }} NOMBRE: {{ $ejemplar->madre->nombre }}</button>
                    @else
                        <button type="button" class="btn btn-info btn-block" onclick="seleccionaMadre()">MADRE</button>
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

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="color">Consanguinidad
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="consanguinidad" name="consanguinidad" value="{{ ($ejemplar != null)? $ejemplar->consanguinidad:'' }}" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="color">Hermano
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="hermano" name="hermano" value="{{ ($ejemplar != null)? $ejemplar->hermano:'' }}" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="color">Lechigada
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="lechigada" name="lechigada"
                            value="{{ ($ejemplar != null)? $ejemplar->lechigada:'' }}" />
                    </div>
                </div>

                <div class="col-md-3">
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
                    <button type="button" class="btn btn-light-danger btn-block font-weight-bold mr-2" onclick="muestraBloqueFallecido();"> FALLECIDO, PERDIDO O ROBADO</button>
                </div>
            </div>
            <br>
            <div class="row" style="display: none;" id="bloque-fallecido">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="nombre">Fecha Fallecido
                            <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="fecha_fallecido" name="fecha_fallecido" value="{{ ($ejemplar != null)? $ejemplar->nombre:'' }}" />
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="prefijo">Fecha Perdido
                            <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="fecha_perdido" name="fecha_perdido" value="{{ ($ejemplar != null)? $ejemplar->prefijo:'' }}" />
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="form-group">
                        <label for="prefijo">Descripcion de la perdida
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="descripcion_perdido" name="descripcion_perdido" value="{{ ($ejemplar != null)? $ejemplar->prefijo:'' }}" />
                    </div>
                </div>

                
            </div>

            <br />
            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-light-dark btn-block font-weight-bold mr-2"
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
                        <label for="prefijo">Fecha Nacionalizado crt 
                            <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="fecha_nacionalizado" name="fecha_nacionalizado"
                            value="{{ ($ejemplar != null)? $ejemplar->prefijo:'' }}" />
                    </div>
                </div>
            
            </div>

            <br />

            @if ($ejemplar != null)
                <ul class="nav nav-primary nav-pills nav-justified" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">EXAMENES</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">TRANSFERENCIAS</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">TITULOS</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        @php
                            $examenes = App\ExamenMascota::where('ejemplar_id', $ejemplar->id)
                                                                ->get();
                            //dd($examenes);
                            $numeroExamenes = $examenes->count();
                            //dd($numeroExamenes);
                        @endphp
                        <br>
                        @if ($numeroExamenes != 0)
                            <table class="table table-striped">
                                <tr>
                                    <th>FECHA</th>
                                    <th>EXAMEN</th>
                                </tr>
                                @foreach ($examenes as $e)
                                    <tr>
                                        <td>{{ $e->fecha_examen }}</td>
                                        <td>{{ $e->examen->nombre }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
            				<a href="#" class="btn btn-info font-weight-bolder btn-block" onclick="nuevoExamen()">Nuevo Examen</a>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        ...TRANSFERENCIAS
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        ...TITULOS
                    </div>
                </div>
                {{--  <div class="row">
                
                    <div class="col-md-4"><button type="button" class="btn btn-dark font-weight-bold btn-block">EXAMENES</button></div>
                    <div class="col-md-4"><button type="button" class="btn btn-dark font-weight-bold btn-block">TRANSFERENCIAS</button></div>
                    <div class="col-md-4"><button type="button" class="btn btn-dark font-weight-bold btn-block">TITULOS</button></div>
                
                </div>  --}}
                <br />
            @endif


            <div class="row">
                <div class="col-md-6"><button type="button" class="btn btn-success btn-block" onclick="guardar()">GUARDAR</button></div>
                <div class="col-md-6"><button type="button" class="btn btn-dark btn-block">VOLVER</button></div>
            </div>
        </form>
    </div>
</div>
<!--end::Card-->
@stop

@section('js')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }} "></script>
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
</script>
@endsection