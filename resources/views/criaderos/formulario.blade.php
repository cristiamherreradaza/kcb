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
            <h3 class="card-label">FORMULARIO DE CRIADEROS
            </h3>
        </div>
        <div class="card-toolbar">
        </div>
    </div>

    <div class="card-body">
        <form action="{{ url('Criadero/guarda') }}" method="POST" id="formulario-usuarios">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Propietario
                            <span class="text-danger">*</span></label>
                            <input type="hidden" class="form-control" id="criadero_id" name="criadero_id" value="{{ ($propietarioCriador!=null)?$propietarioCriador->criadero->id:'' }}" />
                            @if ($propietarioCriador != null)
                                <br />
                                <button type="button" id="boton-propietario-id" class="btn btn-primary btn-block" onclick="cambiaPropietario()">{{ $propietarioCriador->propietario->name }} ({{ $propietarioCriador->propietario->ci }})</button>

                                <div id="select-propietario" style="display: none;">
                                    <select class="form-control select2" id="propietario_id" name="propietario_id" style="width: 100%">
                                        <option label="Label"></option>
                                    </select>
                                </div>
                            @else
                                <select class="form-control select2" id="propietario_id" name="propietario_id">
                                    <option label="Label"></option>
                                </select>
                            @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Co-Propietario

                            <span class="text-danger">*</span></label>

                            @if ($propietarioCriador != null)
                                <br />
                                {{-- @dd($propietarioCriador->criadero->copropietario) --}}
                                @if ($propietarioCriador->criadero->copropietario)
                                    <button type="button" id="boton-copropietario-id" class="btn btn-primary btn-block" onclick="cambiaCoPropietario()">{{ $propietarioCriador->criadero->copropietario->name }} ({{ $propietarioCriador->criadero->copropietario->ci }})</button>                                

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
                            @else
                                <div id="select-copropietario">
                                    <select class="form-control select2" id="copropietario_id" name="copropietario_id">
                                        <option label="Label"></option>
                                    </select>    
                                </div>
                            @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ ($propietarioCriador != null)? $propietarioCriador->criadero->nombre:'' }}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Registro FCI
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="registro_fci" name="registro_fci"  value="{{ ($propietarioCriador != null)? $propietarioCriador->criadero->registro_fci:'' }}" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Departamento
                            <span class="text-danger">*</span></label>
                        <select name="departamento" id="departamento" class="form-control">
                            <option value="La Paz" {{ ($propietarioCriador!=null)? ($propietarioCriador->criadero->departamento=="La Paz")?"selected":'':'' }}>La Paz</option>
                            <option value="Oruro" {{ ($propietarioCriador!=null)? ($propietarioCriador->criadero->departamento=="Oruro")?"selected":'':'' }}>Oruro</option>
                            <option value="Potosi" {{ ($propietarioCriador!=null)? ($propietarioCriador->criadero->departamento=="Potosi")?"selected":'':'' }}>Potosi</option>
                            <option value="Cochabamba" {{ ($propietarioCriador!=null)? ($propietarioCriador->criadero->departamento=="Cochabamba")?"selected":'':'' }}>Cochabamba</option>
                            <option value="Chuquisaca" {{ ($propietarioCriador!=null)? ($propietarioCriador->criadero->departamento=="Chuquisaca")?"selected":'':'' }}>Chuquisaca</option>
                            <option value="Tarija" {{ ($propietarioCriador!=null)? ($propietarioCriador->criadero->departamento=="Tarija")?"selected":'':'' }}>Tarija</option>
                            <option value="Pando" {{ ($propietarioCriador!=null)? ($propietarioCriador->criadero->departamento=="Pando")?"selected":'':'' }}>Pando</option>
                            <option value="Beni" {{ ($propietarioCriador!=null)? ($propietarioCriador->criadero->departamento=="Beni")?"selected":'':'' }}>Beni</option>
                            <option value="Santa Cruz" {{ ($propietarioCriador!=null)? ($propietarioCriador->criadero->departamento=="Santa Cruz")?"selected":'':'' }}>Santa Cruz</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Fecha
                            <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="fecha" id="fecha" value="{{ ($propietarioCriador!=null)?$propietarioCriador->criadero->fecha:'' }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Modalidad de Ingreso
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="modalidad_ingreso" name="modalidad_ingreso"  value="{{ ($propietarioCriador!=null)?$propietarioCriador->criadero->modalidad_ingreso:'' }}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Direccion
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="direccion" name="direccion"  value="{{ ($propietarioCriador!=null)?$propietarioCriador->criadero->direccion:'' }}" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Celulares
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="celulares" name="celulares"  value="{{ ($propietarioCriador!=null)?$propietarioCriador->criadero->celulares:'' }}" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Pagina Web
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="pagina_web" name="pagina_web"  value="{{ ($propietarioCriador!=null)?$propietarioCriador->criadero->pagina_web:'' }}" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email
                            <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email"  value="{{ ($propietarioCriador!=null)?$propietarioCriador->criadero->email:'' }}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6"><button type="button" class="btn btn-sm btn-success btn-block" onclick="crear()">GUARDAR</button></div>
                <div class="col-md-6"><button type="button" class="btn btn-sm btn-dark btn-block" onclick="volver()" >VOLVER</button></div>
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

    function volver(){
        window.location.href = "{{ url('Criadero/listado') }}";
    }

</script>
@endsection