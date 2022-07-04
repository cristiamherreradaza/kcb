@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')

	<!--begin::Card-->
	<div class="card card-custom gutter-b">
		<div class="card-header flex-wrap py-3">
			<div class="card-title">
				<h3 class="card-label">CALIFICACION
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
                                                {{-- @dd() --}}
                                                <a href="{{ url('Juez/categorias', [$asignaciones[$contador]->evento_id, $asignaciones[$contador]->id]) }}" class="btn btn-success btn-block"> <i class="fa fa-check"></i> Calificar</a>
                                                {{-- <a href="{{ url('Juez/grupos', [$asignaciones[$contador]->evento_id]) }}" class="btn btn-success btn-block"> <i class="fa fa-check"></i> Calificar</a> --}}
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

    </script>
@endsection
