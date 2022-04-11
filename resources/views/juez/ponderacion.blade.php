@extends('layouts.app')

@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')

	<!--begin::Card-->
	<div class="card card-custom gutter-b">
		<div class="card-header flex-wrap py-3">
			<div class="card-title">
				<h3 class="card-label">CALIFICACION AL EVENTO DEL GRUPO -> <span class="text-info">{{ $grupo_id }}</span> DE LA RAZA -> <span class="text-info">{{ $raza->nombre }}</span>
				</h3>
			</div>
			<div class="card-toolbar">
				<!--begin::Button-->
				{{-- <a href="#" class="btn btn-primary font-weight-bolder" onclick="nuevo()">
					<i class="fa fa-plus-square"></i> NUEVO JUEZ
				</a> --}}
				<!--end::Button-->
			</div>
		</div>

		<div class="card-body">
            @php
            
                $cantidadCategorias = count($array_categorias);

                $contador = 0 ;

            @endphp
            
            @while ($contador < $cantidadCategorias)
                <div class="row">
                    @php
                        $sw = true;
                    @endphp
                    @for ($i = 0; $i < 2; $i++)
                        @if($contador < $cantidadCategorias)
                            <br><br><br>
                            <div class="col-md-6">
                                @if($sw)
                                    @php

                                        if($array_categorias[$contador][0]->categoria_pista_id == 1 || $array_categorias[$contador][0]->categoria_pista_id == 2 || $array_categorias[$contador][0]->categoria_pista_id == 11){
                                            $text = "CACHORRO";
                                        }

                                        if($array_categorias[$contador][0]->categoria_pista_id == 3 || $array_categorias[$contador][0]->categoria_pista_id == 4){
                                            $text = "JOVEN";
                                        }

                                        if($array_categorias[$contador][0]->categoria_pista_id == 12 || $array_categorias[$contador][0]->categoria_pista_id == 13){
                                            $text = "JOVEN CAMPEON";
                                        }

                                        if($array_categorias[$contador][0]->categoria_pista_id == 5 || $array_categorias[$contador][0]->categoria_pista_id == 6){
                                            $text = "INTERMEDIA";
                                        }

                                        if($array_categorias[$contador][0]->categoria_pista_id == 7 || $array_categorias[$contador][0]->categoria_pista_id == 8){
                                            $text = "ABIERTAS";
                                        }

                                        if($array_categorias[$contador][0]->categoria_pista_id == 9 || $array_categorias[$contador][0]->categoria_pista_id == 10){
                                            $text = "CAMPEON";
                                        }

                                        if($array_categorias[$contador][0]->categoria_pista_id == 14 || $array_categorias[$contador][0]->categoria_pista_id == 15){
                                            $text = "GRAN CAMPEON";
                                        }

                                        if($array_categorias[$contador][0]->categoria_pista_id == 16 || $array_categorias[$contador][0]->categoria_pista_id == 17){
                                            $text = "VETERANOS";
                                        }
                                        $swm = false;
                                    @endphp
                                @endif
                                <button onclick="muestra_tabla({{ $contador }})" type="button" class="btn btn-primary btn-lg btn-block">{{ $text }}</button>
                                <br>
                                <table class="table table-bordered table-hover table-striped" id="table_{{ $contador }}" style="display: none">
                                    <thead>
                                        <tr>
                                            <th>NUMERO</th>
                                            <th>CALIFICACION</th>
                                            <th>LUGAR</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($array_categorias[$contador] as $ca)
                                            @if ($ca->extrangero == "si")
                                                <tr>
                                                    <form action="" id="formulario_{{ $ca->id }}">
                                                        <td>{{ $ca->numero_prefijo }}</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Calificaion
                                                                <span class="text-danger">*</span></label>
                                                                <input type="hidden" name="ejemplar_evento" id="ejemplar_evento">
                                                                <select class="form-control "name="calificacion" id="calificacion">
                                                                    <option value="Excelente">Excelente</option>
                                                                    <option value="Muy Bien">Muy Bien</option>
                                                                    <option value="Bien">Bien</option>
                                                                    <option value="Descalificado">Descalificado</option>
                                                                    <option value="Ausente">Ausente</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Lugar
                                                                <span class="text-danger">*</span></label>
                                                                <select class="form-control "name="lugar" id="lugar">
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-success btn-icon" onclick="ponderacion({{ $ca->id }})"><i class="fa fa-check"></i></button>
                                                        </td>
                                                    </form>
                                                </tr>
                                            @else
                                                @if($ca->ejemplar)
                                                    <tr>
                                                        <form action=""  id="formulario_{{ $ca->id }}">
                                                            <td>{{ $ca->numero_prefijo }}</td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input type="hidden" name="ejemplar_evento" id="ejemplar_evento" value="{{ $ca->id }}">
                                                                    <select class="form-control "name="calificacion" id="calificacion">
                                                                        <option value="Excelente">Excelente</option>
                                                                        <option value="Muy Bien">Muy Bien</option>
                                                                        <option value="Bien">Bien</option>
                                                                        <option value="Descalificado">Descalificado</option>
                                                                        <option value="Ausente">Ausente</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <select class="form-control "name="lugar" id="lugar">
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-success btn-icon" onclick="ponderacion({{ $ca->id }})"><i class="fa fa-check"></i></button>
                                                            </td>
                                                        </form>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @php
                                $contador++;       
                            @endphp
                        @endif    
                    @endfor
                </div>
            @endwhile
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

    	$(function () {
    	    $('#tabla-insumos').DataTable({
				responsive: true,
    	        language: {
    	            url: '{{ asset('datatableEs.json') }}',
    	        },
				order: [[ 0, "desc" ]]
    	    });

    	});

        function muestra_tabla(num_table){
            $nombre_table = "table_"+num_table;
            $("#"+$nombre_table).toggle('show');
        }

        function cachorro(){
            $('#table-cachorro').toggle('show');
        }

        function joven(){
            $('#table-joven').toggle('show');
        }

        function jovenCampeon(){
            $('#table-jovenCampeon').toggle('show');
        }

        function intermedia(){
            $('#table-intermedia').toggle('show');
        }

        function abierta(){
            $('#table-abierta').toggle('show');
        }

        function campeones(){
            $('#table-campeones').toggle('show');
        }

        function grandesCampeones(){
            $('#table-grandesCampeones').toggle('show');
        }

        function veteranos(){
            $('#table-veterano').toggle('show');
        }

        function ponderacion(formulario){

            $formulario = "formulario_"+formulario;

            var datosFormulario = $("#"+$formulario).serialize();

            $.ajax({
                type: 'POST',
                url: "{{ url('Juez/guardaPonderacion') }}",
                data: datosFormulario,
                
                success: function(data){
                    /*
                    * Se ejecuta cuando termina la petición y esta ha sido
                    * correcta
                    * */
                    // $(".respuesta").html(data);
                    Swal.fire("Excelente!", "Ejemplar Calificado!", "success");
                },
                error: function(data){
                    /*
                    * Se ejecuta si la peticón ha sido erronea
                    * */
                    // let error = JSON.parse(data);
                    if(data.responseJSON.message){
                        Swal.fire("Nota ya ponderada!", "Hay un ejemplar que ya tiene la misma nota!", "error");
                    }
                    
                }
            });
        }

        function crear(){
            // verificamos que el formulario este correcto
    		if($("#formulario-ponderacion")[0].checkValidity()){
				// enviamos el formulario
    			$("#formulario-ponderacion").submit();
				// mostramos la alerta
				Swal.fire("Excelente!", "Registro Guardado!", "success");
    		}else{
				// de lo contrario mostramos los errores
				// del formulario
    			$("#formulario-ponderacion")[0].reportValidity()
    		}
        }

    </script>
@endsection
