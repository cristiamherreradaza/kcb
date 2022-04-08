@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')

{{-- inicio modal  --}}

<!-- Modal-->
<div class="modal fade" id="modalPonderacion" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">FORMULARIO DE PONDERACION AL EJEMPLAR <span class="text-success" id="name-ejemplar"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('Juez/guardaPonderacion') }}" method="POST" id="formulario-ponderacion">
                	@csrf
                	<div class="row">
                		<div class="col-md-6">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">Calificaion
                			    <span class="text-danger">*</span></label>
                                <input type="text" name="ejemplar_evento" id="ejemplar_evento">
                                <select class="form-control "name="calificacion" id="calificacion">
                                    <option value="Excelente">Excelente</option>
                                    <option value="Muy Bien">Muy Bien</option>
                                    <option value="Bien">Bien</option>
                                    <option value="Descalificado">Descalificado</option>
                                    <option value="Ausente">Ausente</option>
                                </select>
                			</div>
                		</div>
                		<div class="col-md-6">
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
                		</div>
                	</div>
                </form>
            </div>
            <div class="modal-footer">
				<div class="row">
					<div class="col-md-6">
						<button type="button" class="btn btn-light-dark font-weight-bold " data-dismiss="modal">Cerrar</button>
					</div>
					<div class="col-md-6">
						<button type="button" class="btn btn-success font-weight-bold"  onclick="crear()">Guardar</button>
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
				<h3 class="card-label">CALIFICACION AL EVENTO <span class="text-info">{{ $evento->nombre }}</span>
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
            <div class="row">
                <div class="col-md-6">
                    <button onclick="cachorro()" type="button" class="btn btn-primary btn-lg btn-block">CACHORRO</button>
                    <br>
                    <table class="table table-bordered table-hover table-striped" id="table-cachorro" style="display: none">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cachorros as $ca)
                                @if ($ca->extrangero == "si")
                                    <tr>
                                        <td>{{ $ca->id }}</td>
                                        <td>{{ $ca->nombre_completo }}</td>
                                        <td>
                                            <button class="btn btn-success btn-icon" onclick="ponderacion('{{ $ca->nombre_completo }}', '{{ $ca->id }}')"><i class="fa fa-list"></i></button>
                                        </td>
                                    </tr>
                                @else
                                    @if($ca->ejemplar)
                                        <tr>
                                            <td>{{ $ca->ejemplar->id }}</td>
                                            <td>{{ $ca->ejemplar->nombre_completo }}</td>
                                            <td>
                                                <button class="btn btn-success btn-icon" onclick="ponderacion('{{ $ca->ejemplar->nombre_completo }}', '{{ $ca->id }}')"><i class="fa fa-list"></i></button>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <button onclick="joven()" type="button" class="btn btn-success btn-lg btn-block">JOVEN</button>
                    <br>
                    <table class="table table-bordered table-hover table-striped" id="table-joven" style="display: none">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jovenes as $jo)
                                @if ($jo->extrangero == "si")
                                    <tr>
                                        <td>{{ $jo->id }}</td>
                                        <td>{{ $jo->nombre_completo }}</td>
                                        <td>
                                            <button class="btn btn-success btn-icon" onclick="ponderacion('{{ $jo->nombre_completo }}', '{{ $jo->id }}')"><i class="fa fa-list"></i></button>
                                        </td>
                                    </tr>
                                @else
                                    @if($jo->ejemplar)
                                        <tr>
                                            <td>{{ $jo->ejemplar->id }}</td>
                                            <td>{{ $jo->ejemplar->nombre_completo }}</td>
                                            <td>
                                                <button class="btn btn-success btn-icon" onclick="ponderacion('{{ $jo->ejemplar->nombre_completo }}', '{{ $jo->id }}')"><i class="fa fa-list"></i></button>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <button onclick="jovenCampeon()" type="button" class="btn btn-primary btn-lg btn-block">JOVEN CAMPEON</button>
                    <br>
                    <table class="table table-bordered table-hover table-striped" id="table-jovenCampeon" style="display: none">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jovenesCampeones as $joCa)
                                @if ($joCa->extrangero == "si")
                                    <tr>
                                        <td>{{ $joCa->id }}</td>
                                        <td>{{ $joCa->nombre_completo }}</td>
                                        <td>
                                            <button class="btn btn-success btn-icon" onclick="ponderacion('{{ $joCa->nombre_completo }}', '{{ $joCa->id }}')"><i class="fa fa-list"></i></button>
                                        </td>
                                    </tr>
                                @else
                                    @if($joCa->ejemplar)
                                        <tr>
                                            <td>{{ $joCa->ejemplar->id }}</td>
                                            <td>{{ $joCa->ejemplar->nombre_completo }}</td>
                                            <td>
                                                <button class="btn btn-success btn-icon" onclick="ponderacion('{{ $joCa->ejemplar->nombre_completo }}', '{{ $joCa->id }}')"><i class="fa fa-list"></i></button>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <button onclick="intermedia()" type="button" class="btn btn-success btn-lg btn-block">INTERMEDIA</button>
                    <br>
                    <table class="table table-bordered table-hover table-striped" id="table-intermedia" style="display: none">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($intermedia as $int)
                                @if ($int->extrangero == "si")
                                    <tr>
                                        <td>{{ $int->id }}</td>
                                        <td>{{ $int->nombre_completo }}</td>
                                        <td>
                                            <button class="btn btn-success btn-icon" onclick="ponderacion('{{ $int->nombre_completo }}', '{{ $int->id }}')"><i class="fa fa-list"></i></button>
                                        </td>
                                    </tr>
                                @else
                                    @if($int->ejemplar)
                                        <tr>
                                            <td>{{ $int->ejemplar->id }}</td>
                                            <td>{{ $int->ejemplar->nombre_completo }}</td>
                                            <td>
                                                <button class="btn btn-success btn-icon" onclick="ponderacion('{{ $int->ejemplar->nombre_completo }}', '{{ $int->id }}')"><i class="fa fa-list"></i></button>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <button onclick="abierta()" type="button" class="btn btn-primary btn-lg btn-block">ABIERTA</button>
                    <br>
                    <table class="table table-bordered table-hover table-striped" id="table-abierta" style="display: none">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($abiertas as $abi)
                                @if ($abi->extrangero == "si")
                                    <tr>
                                        <td>{{ $abi->id }}</td>
                                        <td>{{ $abi->nombre_completo }}</td>
                                        <td>
                                            <button class="btn btn-success btn-icon" onclick="ponderacion('{{ $abi->nombre_completo }}', '{{ $abi->id }}')"><i class="fa fa-list"></i></button>
                                        </td>
                                    </tr>
                                @else
                                    @if($abi->ejemplar)
                                        <tr>
                                            <td>{{ $abi->ejemplar->id }}</td>
                                            <td>{{ $abi->ejemplar->nombre_completo }}</td>
                                            <td>
                                                <button class="btn btn-success btn-icon" onclick="ponderacion('{{ $abi->ejemplar->nombre_completo }}', '{{ $abi->id }}')"><i class="fa fa-list"></i></button>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <button onclick="campeones()" type="button" class="btn btn-success btn-lg btn-block">CAMPEONES</button>
                    <br>
                    <table class="table table-bordered table-hover table-striped" id="table-campeones" style="display: none">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($campeones as $cam)
                                @if ($cam->extrangero == "si")
                                    <tr>
                                        <td>{{ $cam->id }}</td>
                                        <td>{{ $cam->nombre_completo }}</td>
                                        <td>
                                            <button class="btn btn-success btn-icon" onclick="ponderacion('{{ $cam->nombre_completo }}', '{{ $cam->id }}')"><i class="fa fa-list"></i></button>
                                        </td>
                                    </tr>
                                @else
                                    @if($cam->ejemplar)
                                        <tr>
                                            <td>{{ $cam->ejemplar->id }}</td>
                                            <td>{{ $cam->ejemplar->nombre_completo }}</td>
                                            <td>
                                                <button class="btn btn-success btn-icon" onclick="ponderacion('{{ $cam->ejemplar->nombre_completo }}', '{{ $cam->id }}')"><i class="fa fa-list"></i></button>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <button onclick="grandesCampeones()" type="button" class="btn btn-primary btn-lg btn-block">GRANDES CAMPEONES</button>
                    <br>
                    <table class="table table-bordered table-hover table-striped" id="table-grandesCampeones" style="display: none">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($GranCampeones as $graCamp)
                                @if ($graCamp->extrangero == "si")
                                    <tr>
                                        <td>{{ $graCamp->id }}</td>
                                        <td>{{ $graCamp->nombre_completo }}</td>
                                        <td>
                                            <button class="btn btn-success btn-icon" onclick="ponderacion('{{ $graCamp->nombre_completo }}', '{{ $graCamp->id }}')"><i class="fa fa-list"></i></button>
                                        </td>
                                    </tr>
                                @else
                                    @if($graCamp->ejemplar)
                                        <tr>
                                            <td>{{ $graCamp->ejemplar->id }}</td>
                                            <td>{{ $graCamp->ejemplar->nombre_completo }}</td>
                                            <td>
                                                <button class="btn btn-success btn-icon" onclick="ponderacion('{{ $graCamp->ejemplar->nombre_completo }}', '{{ $graCamp->id }}')"><i class="fa fa-list"></i></button>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <button onclick="veteranos()" type="button" class="btn btn-success btn-lg btn-block">VETERANOS</button>
                    <br>
                    <table class="table table-bordered table-hover table-striped" id="table-veterano" style="display: none">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($veteranos as $vet)
                                @if ($vet->extrangero == "si")
                                    <tr>
                                        <td>{{ $vet->id }}</td>
                                        <td>{{ $vet->nombre_completo }}</td>
                                        <td>
                                            <button class="btn btn-success btn-icon" onclick="ponderacion('{{ $vet->nombre_completo }}', '{{ $vet->id }}')"><i class="fa fa-list"></i></button>
                                        </td>
                                    </tr>
                                @else
                                    @if($vet->ejemplar)
                                        <tr>
                                            <td>{{ $vet->ejemplar->id }}</td>
                                            <td>{{ $vet->ejemplar->nombre_completo }}</td>
                                            <td>
                                                <button class="btn btn-success btn-icon" onclick="ponderacion('{{ $vet->ejemplar->nombre_completo }}', '{{ $vet->id }}')"><i class="fa fa-list"></i></button>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
		</div>
	</div>
	<!--end::Card-->
@stop

@section('js')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script type="text/javascript">

    	$(function () {
    	    $('#tabla-insumos').DataTable({
				responsive: true,
    	        language: {
    	            url: '{{ asset('datatableEs.json') }}',
    	        },
				order: [[ 0, "desc" ]]
    	    });

    	});

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

        function ponderacion(nombre, ejemplar_evento){
            $("#name-ejemplar").text(nombre);
            $('#ejemplar_evento').val(ejemplar_evento);

            $('#modalPonderacion').modal('show');
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
