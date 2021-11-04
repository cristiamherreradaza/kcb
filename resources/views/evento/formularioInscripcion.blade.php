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
            <form action="{{ url('Evento/inscribirEvento') }}" method="POST" id="formulario-inscripcion-evento" >
                @csrf
                <div class="card-body">
                    <input type="hidden" name="evento_id" id="evento_id" value="{{ $evento->id }}">
                    <br>                    
                    <input type="hidden" name="ejemplar_meses" id="ejemplar_meses" >
                    <br>
                    <input type="hidden" name="ejemplar_id" id="ejemplar_id">
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
                                                    <span class="form-text text-danger" id="msg-vacio-kcb" style="display: none;">Digitar un K.C.B.</span>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <br>
                                                <button type="button" class="btn btn-success btn-block" onclick="buscaKcb()"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="bloque-extrangero" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label class="exampleInputPassword1">
                                                    Codigo Extrangero</label>
                                                    <input type="text" class="form-control" id="cod_extrangero" name="cod_extrangero"/>
                                                    <span class="form-text text-danger" id="msg-vacio-cod" style="display: none;">Digitar un Codigo de Extranjero</span>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <br>
                                                <button type="button" class="btn btn-success btn-block" onclick="buscaCodigo()" ><i class="fa fa-search"></i></button>
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
                                <select class="form-control select2" id="raza_id" name="raza_id"  required >
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
                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" onchange="calcular_fecha()" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                Sexo</label>
                                <select class="form-control" id="sexo" name="sexo" >
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
                                <input type="text" class="form-control" id="registro_extrangero" name="registro_extrangero"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                Tatuaje</label>
                                <input type="text" class="form-control" id="tatuaje" name="tatuaje" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                Microchip</label>
                                <input type="text" class="form-control" id="chip" name="chip"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                KCB del Padre</label>
                                <input type="text" class="form-control" id="kcb_padre" name="kcb_padre"/>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                Nombre del Padre</label>
                                <input type="text" class="form-control" id="nom_padre" name="nom_padre" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                KCB del Madre</label>
                                <input type="text" class="form-control" id="kcb_madre" name="kcb_madre" />
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                Nombre del Madre</label>
                                <input type="text" class="form-control" id="nom_madre" name="nom_madre"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                Categorias</label>
                                <h4 id="msjEdad" class="text-success"></h4>
                                <select class="form-control select2" id="categoria_pista" name="categoria_pista" required >
                                    <option value=""></option>
                                    {{-- @if ($ejemplar != null && $ejemplar->raza_id != null)
                                        <option value="{{ $ejemplar->raza->id }}"> {{ $ejemplar->raza->id }} {{ $ejemplar->raza->nombre }} {{ $ejemplar->raza->descripcion }}</option>
                                    @endif --}}
                                    @forelse ($categorias_pistas as $ca)
                                        <option value="{{ $ca->id }}">{{ $ca->nombre }} {{ $ca->desde }}</option>                                    
                                    @empty
                                        
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="exampleInputPassword1">
                                Criador</label>
                                <input type="text" class="form-control" id="criador" name="criador"/>
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
                                <input type="email" class="form-control" id="email" name="email" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-success btn-block" onclick="inscribir()">INSCRIBRI EJEMPLAR</button>    
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
                         
        }

        function buscaKcb(){
            // alert("kcb");
            let kcb = $("#kcb_busca").val();
            if(kcb != ''){
                // alert("vacio");
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
                        // console.log(ejemplar);
                        if(ejemplar.id){
                            // console.log("lleno");
                            $("#ejemplar_id").val(ejemplar.id);
                            $("#nombre").val(ejemplar.nombre_completo);
                            $("#color").val(ejemplar.color);
                            $("#fecha_nacimiento").val(ejemplar.fecha_nacimiento);
                            $("#sexo").val(ejemplar.sexo);
                            $("#registro_extrangero").val(ejemplar.codigo_nacionalizado);
                            $("#tatuaje").val(ejemplar.num_tatuaje);
                            $("#chip").val(ejemplar.chip);
                            $("#kcb_padre").val(ejemplar.kcb_padre);
                            $("#nom_padre").val(ejemplar.nombre_padre);
                            $("#kcb_madre").val(ejemplar.kcb_madre);
                            $("#nom_madre").val(ejemplar.nombre_madre);
                            $("#propietario").val(ejemplar.nom_propietario);
                            $("#ciudad").val(ejemplar.departamento);
                            $("#telefono").val(ejemplar.celulares);
                            $("#email").val(ejemplar.email);
                            $("#raza_id").val(ejemplar.raza_id);
                            $('#raza_id').trigger('change');
                            $("#msg-good-kcb").show();
                            $("#msg-error-kcb").hide();
                            $("#msg-vacio-kcb").hide();
                            calcular_fecha();
                        }else{
                            $("#ejemplar_id").val('');
                            $("#nombre").val('');
                            $("#color").val('');
                            $("#fecha_nacimiento").val('');
                            $("#sexo").val('');
                            $("#registro_extrangero").val('');
                            $("#tatuaje").val('');
                            $("#chip").val('');
                            $("#kcb_padre").val('');
                            $("#nom_padre").val('');
                            $("#propietario").val(ejemplar.nom_propietario);
                            $("#ciudad").val(ejemplar.departamento);
                            $("#telefono").val(ejemplar.celulares);
                            $("#email").val(ejemplar.email);
                            $("#kcb_madre").val('');
                            $("#nom_madre").val('');
                            $("#raza_id").val('');
                            $('#raza_id').trigger('change');

                            // console.log("vacio");
                            $("#msg-error-kcb").show();
                        }
                    }
                });
            }else{
                $("#msg-vacio-kcb").show();
            }
            
        }

        $(function(){
        $('#raza_id').select2({
                placeholder: "Select a state"
            });
        });

        $(function(){
        $('#categoria_pista').select2({
                placeholder: "Select a state"
            });
        });

        function calcular_fecha(){

            let fecha_nacimiento    = $("#fecha_nacimiento").val();
            let fecha_inicio_evento = "{{ $evento->fecha_inicio }}";
            
            fecha_cal = new Date(fecha_nacimiento);
            fechaP = fecha_inicio_evento;
            dt2 = new Date(fechaP);
            meses = diff_months(dt2, fecha_cal);
            $('#msjEdad').html("OJO su Ejemplar tiene <b>" + meses + " meses</b>");
            $("#ejemplar_meses").val(meses);
        }

        function crea_fecha(fecha) {
            a = fecha[0] + fecha[1] + fecha[2] + fecha[3];
            m = fecha[4] + fecha[5];
            d = fecha[6] + fecha[7];
            return a + "-" + m + "-" + d;
        }

        function diff_months(dt2, dt1) {
            var diff =(dt2.getTime() - dt1.getTime()) / 1000;
            diff /= (60 * 60 * 24 * 30);
            return Math.abs(Math.round(diff));
        }

        function inscribir(){

            // var c = document.getElementById('check_busca').checked;
            // if(c){
            if($('#formulario-inscripcion-evento')[0].checkValidity()){
                $('#formulario-inscripcion-evento').submit();
                Swal.fire("Excelente!", "Registro Guardado!", "success");
            }else{
                $('#formulario-inscripcion-evento')[0].reportValidity();
            }
                // if($("#kcb_busca").val() != ''){
                //     alert("kcb lleno");
                // }else{
                //     alert("kcb vacio");
                // }
                // alert("nacional");
            // }else{
                // alert("extragero");
            // }   
            // alert("como s4e");
        }

        function buscaCodigo(){
            //alert("busqueda por codigo extrangero en desarrolo :)");
            let cod_ex = $("#cod_extrangero").val();
            //alert(cod_ex);
            if(cod_ex != ''){
                // alert("vacio");
                $.ajax({
                    url: "{{ url('Evento/ajaxBuscaExtranjero') }}",
                    data: {
                        cod_ex: cod_ex
                    },
                    type: "POST",
                    success: function(data) {
                        //convertimos la respuesta para poder trabajar
                        let ejemplar = JSON.parse(data);
                        // let ejemplar = JSON.stringify(data);
                        //console.log(ejemplar);
                        if(ejemplar.id){
                            // console.log("lleno");
                            //$("#ejemplar_id").val(ejemplar.id);
                            $("#nombre").val(ejemplar.nombre_completo);
                            $("#color").val(ejemplar.color);
                            $("#fecha_nacimiento").val(ejemplar.fecha_nacimiento);
                            $("#sexo").val(ejemplar.sexo);
                            $("#registro_extrangero").val(ejemplar.codigo_nacionalizado);
                            $("#criador").val(ejemplar.criador);
                            $("#tatuaje").val(ejemplar.num_tatuaje);
                            $("#chip").val(ejemplar.chip);
                            $("#kcb_padre").val(ejemplar.kcb_padre);
                            $("#nom_padre").val(ejemplar.nombre_padre);
                            $("#kcb_madre").val(ejemplar.kcb_madre);
                            $("#nom_madre").val(ejemplar.nombre_madre);
                            $("#propietario").val(ejemplar.propietario);
                            $("#ciudad").val(ejemplar.ciudad);
                            $("#telefono").val(ejemplar.telefono);
                            $("#email").val(ejemplar.email);
                            $("#raza_id").val(ejemplar.raza_id);
                            $('#raza_id').trigger('change');
                            $("#msg-good-kcb").show();
                            $("#msg-error-kcb").hide();
                            $("#msg-vacio-kcb").hide();
                            calcular_fecha();
                        }else{
                            $("#ejemplar_id").val('');
                            $("#nombre").val('');
                            $("#color").val('');
                            $("#fecha_nacimiento").val('');
                            $("#sexo").val('');
                            $("#registro_extrangero").val('');
                            $("#tatuaje").val('');
                            $("#chip").val('');
                            $("#kcb_padre").val('');
                            $("#nom_padre").val('');
                            $("#propietario").val(ejemplar.nom_propietario);
                            $("#ciudad").val(ejemplar.departamento);
                            $("#telefono").val(ejemplar.celulares);
                            $("#email").val(ejemplar.email);
                            $("#kcb_madre").val('');
                            $("#nom_madre").val('');
                            $("#raza_id").val('');
                            $('#raza_id').trigger('change');

                            // console.log("vacio");
                            $("#msg-error-kcb").show();
                        }
                    }
                });
            }else{
                $("#msg-vacio-cod").show();
            }
            
        }

        // $("#fecha_nacimiento").on("change paste keyup", function() {

        //     let fecha_nacimiento    = $("#fecha_nacimiento").val();
        //     alert(fecha_nacimiento);
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
