@extends('layouts.app')

@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">FORMULARIO DE INSCRIPCION (EPOSICION "SOL DEL ORIENTE")</h3>
            </div>
            <!--begin::Form-->
            <form action="" method="POST" id="" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="exampleInputPasswo¶rd1">
                                        Nacional</label>
                                        <input id='check_busca' data-switch="true" type="checkbox" checked data-on-color="primary"  onchange="mostrarBusqueda()"/>
                                        <label class="exampleInputPassword1">
                                        Extrangero</label>
                                    </div>
                                    <span class="form-text text-danger" id="msg-error-email" style="display: none;">Correo duplicado, cambielo!!!</span>
                                </div>
                                <div class="col-md-6">
                                    <div id="bloque-nacional">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label class="exampleInputPassword1">
                                                    KCB
                                                    </label>
                                                    <input type="text" class="form-control" id="kcb_busca" name="kcb_busca" />
                                                    <span class="form-text text-danger" id="msg-error-kcb" style="display: none;">Ejemplar no Registrado</span>
                                                    <span class="form-text text-success" id="msg-good-kcb" style="display: none;">Ejemplar Registrado</span>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <br>
                                                <button type="button" class="btn btn-success btn-block" onclick="buscaKcb()">B</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="bloque-extrangero" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label class="exampleInputPassword1">
                                                    Codigo Extrangero</label>
                                                    <input type="text" class="form-control" id="cod_extrangero" name="cod_extrangero" />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <br>
                                                <button type="button" class="btn btn-success">B</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                Raza</label>
                                <select class="form-control select2" id="raza_id" name="raza_id">
                                    <option value=""></option>
                                    {{-- @if ($ejemplar != null && $ejemplar->raza_id != null)
                                        <option value="{{ $ejemplar->raza->id }}"> {{ $ejemplar->raza->id }} {{ $ejemplar->raza->nombre }} {{ $ejemplar->raza->descripcion }}</option>
                                    @endif --}}
                                    @forelse ($razas as $r)
                                        <option value="{{ $r->id }}">{{ $r->nombre }} {{ $r->descripcion }}</option>                                    
                                    @empty
                                        
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                Nombre del ejemplar</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                Color</label>
                                <input type="text" class="form-control" id="color" name="color" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                Sexo</label>
                                <select name="" id="" class="form-control" id="sexo" name="sexo" >
                                    <option value="Macho">Macho</option>
                                    <option value="Hembra">Hembra</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                Registro de Extrangero</label>
                                <input type="text" class="form-control" id="registro_extrangero" name="registro_extrangero" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                Tatuaje</label>
                                <input type="text" class="form-control" id="tatuaje" name="tatuaje" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                Microchip</label>
                                <input type="text" class="form-control" id="chip" name="chip" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                KCB del Padre</label>
                                <input type="text" class="form-control" id="kcb_padre" name="kcb_padre" required />
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                Nombre del Padre</label>
                                <input type="text" class="form-control" id="nom_padre" name="nom_padre" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                KCB del Madre</label>
                                <input type="text" class="form-control" id="kcb_madre" name="kcb_madre" required />
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                Nombre del Madre</label>
                                <input type="text" class="form-control" id="nom_madre" name="nom_madre" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                Categorias</label>
                                <input type="text" class="form-control" id="cotagoria" name="cotagoria" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                Criador</label>
                                <input type="text" class="form-control" id="criador" name="criador" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                Propietario</label>
                                <input type="text" class="form-control" id="propietario" name="propietario" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                Ciudad / Pais</label>
                                <input type="text" class="form-control" id="ciudad" name="ciudad" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                Telefono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                Email</label>
                                <input type="text" class="form-control" id="email" name="email" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-success btn-block">INSCRIBRI EJEMPLAR</button>    
                        </div>    
                    </div>                    
                </div>
                
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
    
</div>

@stop

@section('js')
    {{-- <script src="{{ asset('assets/js/pages/crud/file-upload/dropzonejs.js') }}"></script> --}}
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-switch.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            // definimos cabecera donde estarra el token y poder hacer nuestras operaciones de put,post...
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function guarda()
        {
            if ($("#formularioPersona")[0].checkValidity()) {

                $("#formularioPersona").submit();
                Swal.fire("Excelente!", "Se guardo el distrito!", "success");

            }else{
                $("#formularioPersona")[0].reportValidity();
            }
        }

        function canbiaDepartamento()
        {
            let departamento = $("#departamento").val();

            $.ajax({
                url: "{{ url('User/ajaxDistrito') }}",
                data: {departamento: departamento},
                type: 'POST',
                success: function(data) {
                    $("#ajaxDistritos").html(data);
                    // $("#listadoProductosAjax").html(data);
                }
            });

        }

        function mostrarBusqueda(){
            // alert("holas");
            $("#bloque-nacional").toggle('slow');
            $("#bloque-extrangero").toggle('slow');
            var c = document.getElementById('check_busca').checked;
            if(c){
                // alert("nacional");
            }else{
                // alert("extragero");
            }                
        }

        function buscaKcb(){
            // alert("kcb");
            let kcb = $("#kcb_busca").val();
            $.ajax({
                url: "{{ url('Evento/ajaxBuscaEjemplar') }}",
                data: {
                    kcb: kcb
                },
                type: "POST",
                success: function(data) {
                    //convertimos la respuesta para poder trabajar
                    let ejemplar = JSON.parse(data);
                    // let ejemplar = JSON.stringify(data);
                    console.log(ejemplar);
                    // if(ejemplar[0]){
                    //     // console.log("lleno");
                    //     $("#nombre").val(ejemplar[0].nombre_completo);
                    //     $("#color").val(ejemplar[0].color);
                    //     $("#fecha_nacimiento").val(ejemplar[0].fecha_nacimiento);
                    //     $("#sexo").val(ejemplar[0].sexo);
                    //     $("#registro_extrangero").val(ejemplar[0].codigo_nacionalizado);
                    //     $("#tatuaje").val(ejemplar[0].num_tatuaje);
                    //     $("#chip").val(ejemplar[0].chip);
                    //     $("#kcb_padre").val(ejemplar[0].padre_id);
                    //     $("#nom_padre").val(ejemplar[0].padre_id);
                    //     $("#kcb_madre").val(ejemplar[0].madre_id);
                    //     $("#nom_madre").val(ejemplar[0].madre_id);
                    //     $("#raza_id").val(ejemplar[0].raza_id);
                    //     $("#msg-good-kcb").show();
                    // }else{
                    //     // console.log("vacio");
                    //     $("#msg-error-kcb").show();
                    // }
                    // console.log(data);
                    // console.log("===================================");
                    // console.log(ejemplar);
                    // console.log("===================================");
                    // console.log(ejemplar[0].kcb);
                    // console.log(data)
                    // $("#ajaxPropietario").html(data);
                }
            });
        }

        $("#raza_id").select2({
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

        // $("#kcb_busca, #cod_extrangero").on("change paste keyup", function() {

        //     let kcb = $("#kcb_busca").val();
        //     let cod_extragero = $("#cod_extrangero").val();

        //     // console.log(kcb);

        //     $.ajax({
        //         url: "{{ url('Evento/ajaxBuscaEjemplar') }}",
        //         data: {
        //             cedula: cedula,
        //             nombre: nombre
        //         },
        //         type: "POST",
        //         success: function(data) {
        //             //convertimos la respuesta para poder trabajar
        //             let ejemplar = JSON.parse(data);
        //             console.log(ejemplar.kcb)
        //             $("#ajaxPropietario").html(data);
        //         }
        //     });
        // });

    </script>
@endsection
