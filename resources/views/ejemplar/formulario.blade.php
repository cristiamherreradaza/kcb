@extends('layouts.app')

@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')
{{-- inicio modal  --}}
<!-- Modal-->

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
                            <option value="Nombre" {{ ($ejemplar!=null)? ($ejemplar->sexo=="Macho")?"selected":'':'' }}>Macho</option>
                            <option value="Afijo" {{ ($ejemplar!=null)? ($ejemplar->sexo=="Hembra")?"selected":'':'' }}>Hembra</option>
                        </select>
                    </div>
                </div>
                
            </div>

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Padre

                            <span class="text-danger">*</span></label>

                            @if ($ejemplar != null)
                                <br />
                                <button type="button" id="boton-copropietario-id" class="btn btn-primary btn-block" onclick="cambiaCoPropietario()">{{ $ejemplar->copropietario->name }} ({{ $ejemplar->copropietario->ci }})</button>                                

                                <div id="select-copropietario" style="display: none;">
                                    <select class="form-control select2" id="copropietario_id" name="copropietario_id" style="width: 100%">
                                        <option label="Label"></option>
                                    </select>
                                </div>
                            @else
                                <div id="select-copropietario">
                                    <select class="form-control select2" id="copropietario_id" name="copropietario_id">
                                        <option label="Label"></option>
                                    </select>    
                                </div>
                            @endif
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

    $("#copropietario_id").select2({
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
                // console.log(data.vEmail);     
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


</script>
@endsection