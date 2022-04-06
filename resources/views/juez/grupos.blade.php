@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')

{{-- inicio modal  --}}

<!-- Modal-->
<div class="modal fade" id="modalJuez" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">FORMULARIO DE JUEZ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('Juez/guarda') }}" method="POST" id="formulario-juez">
                	@csrf
                	<div class="row">
                		<div class="col-md-4">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">Nombre del Juez
                			    <span class="text-danger">*</span></label>
                			    <input type="hidden" id="juez_id" name="juez_id" value="0" />
                			    <input type="text" class="form-control" id="nombre" name="nombre" required />
                			</div>
                		</div>
                		<div class="col-md-4">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">Email
                			    <span class="text-danger">*</span></label>
                			    <input type="email" class="form-control" id="email" name="email" required />
                			</div>
                		</div>
						<div class="col-md-4">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">Fecha Nacimiento
                			    <span class="text-danger">*</span></label>
                			    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required />
                			</div>
                		</div>
                	</div>

					<div class="row">
                		<div class="col-md-4">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">Direccion
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="direccion" name="direccion" required />
                			</div>
                		</div>
                		<div class="col-md-4">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">Celulares
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="celulares" name="celulares" required />
                			</div>
                		</div>
						<div class="col-md-4">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">Departamento
                			    <span class="text-danger">*</span></label>
								<select class="form-control" id="departamento" name="departamento">
									<option value="La paz">La paz</option>
									<option value="Oruro">Oruro</option>
									<option value="Potosi">Potosi</option>
									<option value="Cochabamba">Cochabamba</option>
									<option value="Chuquisaca">Chuquisaca</option>
									<option value="Tarija">Tarija</option>
									<option value="Pando">Pando</option>
									<option value="Beni">Beni</option>
									<option value="Santa Cruz">Santa Cruz</option>
								</select>
                			</div>
                		</div>
                	</div>
                </form>
            </div>
            <div class="modal-footer">
				<div class="row">
					<div class="col-md-6">
						<button type="button" class="btn btn-sm btn-light-dark font-weight-bold " data-dismiss="modal">Cerrar</button>
					</div>
					<div class="col-md-6">
						<button type="button" class="btn btn-sm btn-success font-weight-bold"  onclick="crear()">Guardar</button>
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
				<h3 class="card-label">GRUPOS
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
                $cantidadGrupos = count($grupos);

                $contador = 0 ;
            @endphp
            @while ($contador < $cantidadGrupos)
                <div class="row">

                    @for($i = 0; $i < 4; $i++)
                        @if($contador < $cantidadGrupos)
                            <div class="col-md-3">
                                <!--begin::Card-->
                                <div class="card card-custom gutter-b card-stretch">
                                    <!--begin::Body-->
                                    <div class="card-body text-center pt-4">
                                        <!--begin::User-->
                                        <div class="mt-7">
                                            <div class="symbol symbol-circle symbol-lg-90">
                                                {{-- <img src="/metronic/theme/html/demo1/dist/assets/media/project-logos/1.png" alt="image" /> --}}
                                                <i class="fa fa-users fa-4x text-success"></i>
                                            </div>
                                        </div>
                                        <!--end::User-->
                                        <!--begin::Name-->
                                        <div class="my-4">
                                            <a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4">Grupo {{ $grupos[$contador]->id }}</a>
                                        </div>
                                        <!--end::Name-->
                                        <!--begin::Buttons-->
                                        <div class="mt-9">
                                            <a href="{{ url('Juez/razas', [$grupos[$contador]->evento_id, $grupos[$contador]->id]) }}" class="btn btn-light-primary font-weight-bolder btn-sm py-3 px-6 text-uppercase">Ver Razas</a>
                                        </div>
                                        <!--end::Buttons-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            @php
                                $contador++;
                            @endphp
                        @endif
                    @endfor
                </div>
            @endwhile
        </div>
		{{-- <div class="card-body">

            @php
                $contador = 0 ;

                $colores = array("success", "warning", "info", "dark", "danger", "primary");

            @endphp
            @while ($contador < $cantidadAsignaciones)
                <div class="row">
                    @for($i = 0; $i < 3; $i++)
                        @php
                            $seleccion = array_rand($colores);
                        @endphp
                        @if($contador < $cantidadAsignaciones)
                            <div class="col-md-4">
                                <div class="card card-custom wave wave-animate-slow wave-{{ $colores[$seleccion] }} mb-8 mb-lg-0">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center p-5">
                                            <div class="mr-6">
                                                <i class="fa fa-dog fa-5x text-{{ $colores[$seleccion] }}"></i>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <a href="{{ url('Juez/grupos', [$asignaciones[$contador]->evento_id]) }}" class="btn btn-success btn-block"> <i class="fa fa-check"></i> Calificar</a>
                                                <div class="text-dark-100"><h4>{{ $asignaciones[$contador]->evento->nombre }}</h4></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                                $contador++;
                            @endphp
                        @endif
                    @endfor
                </div>
                <br>
            @endwhile
		</div> --}}
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

    </script>
@endsection