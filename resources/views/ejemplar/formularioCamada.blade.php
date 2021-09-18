@extends('layouts.app')

@section('metadatos')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')

{{-- inicio modal padres --}}
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
{{-- fin inicio modal padre  --}}


{{-- inicio modal  --}}
<!-- Modal-->

{{-- fin inicio modal  --}}

<!--begin::Card-->
<div class="card card-custom gutter-b">
    <div class="card-header flex-wrap py-3">
        <div class="card-title">
            <h3 class="card-label">FORMULARIO DE CAMADA
            </h3>
        </div>
        <div class="card-toolbar">
        </div>
    </div>

    <div class="card card-body">
        
        <!--begin::Form-->
        <form action="{{ url('Ejemplar/guardaCamada') }}" method="POST" class="form">
            @csrf

            <div class="row">
                <input type="hidden" name="padre_id" id="padre_id">
                <div class="col-md-6" id="btn-padre">
                    <button type="button" class="btn btn-sm btn-primary btn-block" onclick="seleccionaPadre()">PADRE</button>
                </div>
                <input type="hidden" name="madre_id" id="madre_id">
                <div class="col-md-6" id="btn-madre">
                    <button type="button" class="btn btn-sm btn-info btn-block" onclick="seleccionaMadre()">MADRE</button>
                </div>
            </div>
            
            <br />

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">PROPIETARIO
                        </label>
                        <select class="form-control select2" id="propietario_id" name="propietario_id">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">AFIJO
                        </label>
                        <select class="form-control select2" id="criadero_id" name="criadero_id">
                            <option value=""></option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="prefijo">Prefijo del nombre
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="prefijo" name="prefijo" value="" placeholder="de o de la" />
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="primero_mostrar">Primero Mostrar
                            <span class="text-danger">*</span></label>
                        <select name="primero_mostrar" id="primero_mostrar" class="form-control">
                            <option value="Nombre">Nombre</option>
                            <option value="Afijo">Afijo</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-8">
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
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="color">Lechigada
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="lechigada" name="lechigada"
                             placeholder="CBBA/RW-028/C - REG 27/06/21" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="color">Fecha Emision
                            <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="fecha_emision" name="fecha_emision"/>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="kcb">Fecha de Nacimiento
                        </label>
                        <input type="date" class="form-control" id="fecha_nacimiento"
                            name="fecha_nacimiento" autocomplete="off" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Departamento
                            <span class="text-danger">*</span></label>
                        <select name="departamento" id="departamento" class="form-control">
                            <option value="La Paz">
                                La Paz</option>
                            <option value="Oruro">
                                Oruro</option>
                            <option value="Potosi">
                                Potosi</option>
                            <option value="Cochabamba">
                                Cochabamba</option>
                            <option value="Chuquisaca">
                                Chuquisaca</option>
                            <option value="Tarija">
                                Tarija</option>
                            <option value="Pando">
                                Pando</option>
                            <option value="Beni">
                                Beni</option>
                            <option value="Santa Cruz">
                                Santa Cruz</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- <div class="separator separator-dashed my-8"></div> --}}
            <h3 class="text-primary">EJEMPLARES</h3>
    
            <div id="ejemplares_1">
                <div class="form-group row" id="ejemplares_1">
                    <div data-repeater-list="ejemplar" class="col-lg-12">
                        <div data-repeater-item class="form-group row align-items-center">
                            <div class="col-md-3">
                                <label>Nombre:</label>
                                <input type="text" class="form-control" placeholder="Snoopy" name="nombre" />
                                <div class="d-md-none mb-2"></div>
                            </div>

                            <div class="col-md-2">
                                <label>Kcb:</label>
                                <input type="text" class="form-control" placeholder="457854" name="kcb" />
                                <div class="d-md-none mb-2"></div>
                            </div>

                            <div class="col-md-2">
                                <label>No. Tatuaje:</label>
                                <input type="text" class="form-control" placeholder="45789" name="num_tatuaje" />
                                <div class="d-md-none mb-2"></div>
                            </div>

                            <div class="col-md-3">
                                <label>Chip:</label>
                                <input type="text" class="form-control" placeholder="900057600430900" name="chip" />
                                <div class="d-md-none mb-2"></div>
                            </div>

                            <div class="col-md-2">
                                <label>Color:</label>
                                <input type="text" class="form-control" placeholder="Blanco" name="color" />
                                <div class="d-md-none mb-2"></div>
                            </div>

                            <div class="col-md-2">
                                <label>Senas:</label>
                                <input type="text" class="form-control" placeholder="Machas Blancas" name="senas" />
                                <div class="d-md-none mb-2"></div>
                            </div>

                            <div class="col-md-2">
                                <label for="sexo">Sexo
                                    <span class="text-danger">*</span></label>
                                <select name="sexo" id="sexo" class="form-control">
                                    <option value="Macho">Macho</option>
                                    <option value="Hembra">Hembra</option>
                                </select>
                            </div>
                            
                            <div class="col-md-3">
                                <br />
                                <a href="javascript:;" data-repeater-delete=""
                                    class="btn btn-block font-weight-bolder btn-light-danger">
                                    <i class="la la-trash-o"></i>Eliminar Ejemplar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <a href="javascript:;" data-repeater-create="" class="btn btn-block font-weight-bolder btn-light-primary">
                            <i class="la la-plus"></i>Adicionar Ejemplar
                        </a>
                    </div>
                </div>

                <br />

                <div class="row">
                    <div class="col-md-6"><button type="submit" class="btn btn-sm btn-success btn-block">GUARDAR</button></div>
                    <div class="col-md-6"><button type="button" class="btn btn-sm btn-dark btn-block" onclick="volver()">VOLVER</button>
                    </div>
                </div>
                
            </div>

        </form>
        <!--end::Form-->
    </div>

    
</div>
<!--end::Card-->
@stop

@section('js')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    jQuery(document).ready(function() {
       
        $('#ejemplares_1').repeater({
            initEmpty: false,
           
            defaultValues: {
                'text-input': 'foo'
            },
             
            show: function () {
                $(this).slideDown();
            },

            hide: function (deleteElement) {                
                $(this).slideUp(deleteElement);                 
            },
            
            isFirstItemUndeletable: true
        });
    
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
                // console.log(data.vEmail);     
                if(data.vEmail > 0){
                    $("#msg-error-email").show();
                }else{
                    $("#msg-error-email").hide();
                }
            }
        });
    }

    {{--  busqueda de padre --}}
    function seleccionaPadre()
    {
        $("#modal-padres").modal('show');        
        $("#sexo-modal").val('macho');
        $("#ajaxEjemplar").html('');
        $("#busqueda-kcb").val('');
        $("#busqueda-nombre").val('');
    }

    {{--  busqueda de madre  --}}
    function seleccionaMadre()
    {
        $("#modal-padres").modal('show');
        $("#sexo-modal").val('hembra');
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
</script>
@endsection