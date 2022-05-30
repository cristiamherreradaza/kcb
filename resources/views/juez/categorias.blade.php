@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('metadatos')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')



    {{-- inicio modal  --}}
    <div class="modal fade" id="modalCalificacion" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">FORMULARIO DE CALIFICACION</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="formulario_calificaion">

                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    {{-- fin inicio modal  --}}

    <!--begin::Card-->
	<div class="card card-custom gutter-b">
		<div class="card-header flex-wrap py-3">
			<div class="card-title">
				<h3 class="card-label">CATEGORIAS</h3>
			</div>
			<div class="card-toolbar">

			</div>
		</div>
		<div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-success btn-block" onclick="califaicarEjemplares()">Calificar</button>
                </div>
            </div>

            <br>
            <div id="accordion">
                <form action="" id="formulario-calificacion">
                    <input type="hidden" value="{{ $evento->id }}" name="evento_id">
                    @foreach ($arrayEjemplaresTotal as $key => $a)
                        <div class="card">
                            <div class="card-header" id="headingOne{{ $key }}">
                                <h5 class="mb-0">
                                    <div class="row">
                                        <div class="col-md-1">

                                            <div class="form-group">
                                                <label>Seleccionar</label>
                                                <div class="checkbox-inline">
                                                    <label class="checkbox checkbox-lg">
                                                        <input type="checkbox" id="{{ $a['nombre'] }}" value="{{ $a['nombre'] }}" onchange="checkEjemplares('{{ $a['nombre'] }}')"/>
                                                        <span></span>
                                                        {{-- Option 1 --}}
                                                    </label>
                                                </div>
                                                {{-- <span class="form-text text-muted">Some help text goes here</span> --}}
                                            </div>

                                        </div>
                                        <div class="col-md-11">
                                            <center>
                                                <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne{{ $key }}" aria-expanded="false" aria-controls="collapseOne{{ $key }}">
                                                    <h4> Ejemplares {{ $a['nombre'] }}</h4>
                                                </button>
                                            </center>
                                        </div>
                                    </div>
                                </h5>
                            </div>
                        
                            <div id="collapseOne{{ $key }}" class="collapse" aria-labelledby="headingOne{{ $key }}" data-parent="#accordion">
                                <div class="card-body">
                                    @php
                                        
                                        $grupo1  = array();
                                        $grupo2  = array();
                                        $grupo3  = array();
                                        $grupo4  = array();
                                        $grupo5  = array();
                                        $grupo6  = array();
                                        $grupo7  = array();
                                        $grupo8  = array();
                                        $grupo9  = array();
                                        $grupo10 = array();

                                        foreach($a['ejemplares'] as $eje){

                                            $grupoRaza = App\GrupoRaza::where('raza_id',$eje->raza_id)
                                                                    ->first();
                                            if($grupoRaza){

                                                switch ($grupoRaza->grupo_id) {
                                                    case 1:
                                                        array_push($grupo1, $eje);
                                                        break;
                                                    case 2:
                                                        array_push($grupo2, $eje);
                                                        break;
                                                    case 3:
                                                        array_push($grupo3, $eje);
                                                        break;
                                                    case 4:
                                                        array_push($grupo4, $eje);
                                                        break;
                                                    case 5:
                                                        array_push($grupo5, $eje);
                                                        break;
                                                    case 6:
                                                        array_push($grupo6, $eje);
                                                        break;
                                                    case 7:
                                                        array_push($grupo7, $eje);
                                                        break;
                                                    case 8:
                                                        array_push($grupo8, $eje);
                                                        break;
                                                    case 9:
                                                        array_push($grupo9, $eje);
                                                        break;
                                                    case 10:
                                                        array_push($grupo10, $eje);
                                                        break;
                                                }
                                            }
                                        }


                                        $arrayEjemplaresGrupos = array();

                                        array_push($arrayEjemplaresGrupos, $grupo1);
                                        array_push($arrayEjemplaresGrupos, $grupo2);
                                        array_push($arrayEjemplaresGrupos, $grupo3);
                                        array_push($arrayEjemplaresGrupos, $grupo4);
                                        array_push($arrayEjemplaresGrupos, $grupo5);
                                        array_push($arrayEjemplaresGrupos, $grupo6);
                                        array_push($arrayEjemplaresGrupos, $grupo7);
                                        array_push($arrayEjemplaresGrupos, $grupo8);
                                        array_push($arrayEjemplaresGrupos, $grupo9);
                                        array_push($arrayEjemplaresGrupos, $grupo10);

                                    @endphp
                                    @foreach ($arrayEjemplaresGrupos as $keyGrupo => $aeg)

                                        @if (!empty($aeg))
                                            <!-- Datatable-->  
                                            <div class="table-responsive m-t-40">
                                                <table class="table table-bordered table-hover table-striped" id="tabla-insumos">
                                                    <thead>
                                                        <tr class="text-info text-center">
                                                            <th>
                                                                <div class="form-group">
                                                                    {{-- <label>Seleccionar</label> --}}
                                                                    <div class="checkbox-inline">
                                                                        <label class="checkbox checkbox-lg">
                                                                            <input type="checkbox" id="{{ $a['nombre'].($keyGrupo+1) }}" name="ejemplares[]" value="{{ $a['nombre'].','.($keyGrupo+1) }}" class="{{ $a['nombre'] }}"/>
                                                                            <span></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <th colspan="2">
                                                                <h4>Grupo {{ $keyGrupo+1 }}</h4>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th></th>
                                                            <th width="1000px">RAZA</th>
                                                            <th>CANTIDAD</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ( $aeg as $keyEjeGru => $eg)
                                                            <tr>
                                                                <td></td>
                                                                <td>{{ $eg->raza->nombre }}</td>
                                                                <td>{{ $eg->cantRaza }}</td>
                                                            </tr>   
                                                        @endforeach
                                                
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!--end: Datatable-->  
                                        <br>
                                        <hr>
                                        @endif
                                    @endforeach                              
                                </div>
                            </div>
                        </div>        
                    @endforeach
                </form>
            </div>
		</div>
	</div>
	<!--end::Card-->

@stop

@section('js')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

    <script type="text/javascript">

        $( document ).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        function checkEjemplares(ejmplares){

            console.log($('#'+ejmplares).val());

            var isChecked = document.getElementById(ejmplares).checked;

            if(!isChecked){
                var elementos = document.getElementsByClassName(ejmplares);

                for(var i = 0; i < elementos.length ; i++){
                    $("#"+elementos[i].id).prop('checked', false);
                }    

            }else{

                var elementos = document.getElementsByClassName(ejmplares);

                for(var i = 0; i < elementos.length ; i++){
                    $("#"+elementos[i].id).prop('checked', true);
                }

            }
        }

        function califaicarEjemplares(){

            if ($('input[type=checkbox]:checked').length==0){
                
                Swal.fire(
                    "Alerta!",
                    "Debe sellecionar al menos un grupo.",
                    "warning",
                )
                    
            }else{
                var dato = $('#formulario-calificacion').serialize();

                $.ajax({
                    url: "{{ url('Juez/AjaxPlanillaCalificacion') }}",
                    data: dato,
                    type: 'POST',
                    dataType: 'json',
                    success: function(data) {

                        $('#formulario_calificaion').html(data.formulario)

                        console.log(data.formulario)

                        $('#modalCalificacion').modal('show');

                        // $('#listaAsignaciones').html(data);
                    }
                });
            }

            
        }

    </script>
   
@endsection
