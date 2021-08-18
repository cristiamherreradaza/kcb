@extends('layouts.app')

@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')
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
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ ($ejemplar != null)? $ejemplar->nombre:'' }}" />
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
                        <input type="text" class="form-control" id="kcb" name="kcb" value="{{ ($ejemplar != null)? $ejemplar->kcb:'' }}" />
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
                            <option value="Nombre" {{ ($ejemplar!=null)? ($ejemplar->sexo=="macho")?"selected":'':'' }}>Macho</option>
                            <option value="Afijo" {{ ($ejemplar!=null)? ($ejemplar->sexo=="hembra")?"selected":'':'' }}>Hembra</option>
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
                    <button type="button" class="btn btn-primary btn-block" onclick="seleccionaPadre()">PADRE</button>
                </div>
                <input type="hidden" name="madre_id" id="madre_id">
                <div class="col-md-6" id="btn-madre">
                    <button type="button" class="btn btn-info btn-block" onclick="seleccionaMadre()">MADRE</button>
                </div>
                
            </div>
            <br />
            <div class="row">
            
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">PROPIETARIO
                        </label>
                        <select class="form-control select2" id="propietario_id" name="propietario_id">
                            <option label="Label"></option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">AFIJO
                        </label>
                        <select class="form-control select2" id="criadero_id" name="criadero_id">
                            <option label="Label"></option>
                        </select>
                    </div>
                </div>
            
            </div>

            <div class="row">
                <div class="col-md-6"><button type="button" class="btn btn-success btn-block" onclick="crear()">GUARDAR</button></div>
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

    function crear()
    {
        if($('#formulario-usuarios')[0].checkValidity()){
            $('#formulario-usuarios').submit();
            Swal.fire("Excelente!", "Registro Guardado!", "success");
        }else{
            $('#formulario-usuarios')[0].reportValidity()
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
</script>
@endsection