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
				<h3 class="card-label">LISTA DE EJEMPLARES
				</h3>
			</div>
			<div class="card-toolbar">
				<!--begin::Button-->
				<a href="{{ url('Ejemplar/formulario/0') }}" class="btn btn-primary font-weight-bolder" onclick="nuevo()">
					<i class="fa fa-plus-square"></i> NUEVO EJEMPLAR 
				</a>
				<!--end::Button-->
			</div>
		</div>
		
		<div class="card-body">

			<form action="{{ url('Criadero/ajaxListadoCriadero') }}" method="POST" id="formulario-busqueda-ejemplares">
				@csrf
				<div class="row">
					<div class="col-md-1">
						<div class="form-group">
							<label for="exampleInputPassword1">KCB</label>
							<input type="text" class="form-control" id="kcb_buscar" name="kcb_buscar" />
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<label for="exampleInputPassword1">NOMBRE</label>
							<input type="text" class="form-control" id="nombre_buscar" name="nombre_buscar" />
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<label for="exampleInputPassword1">CHIP</label>
							<input type="text" class="form-control" id="chip_buscar" name="chip_buscar" />
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="exampleInputPassword1">RAZA
								</label>
							<select class="form-control select2" id="raza_buscar" name="raza_buscar">
								<option value="">Busca por raza</option>
								@forelse ($razas as $r)
									<option value="{{ $r->id }}">{{ $r->nombre }}</option>
								@empty
					
								@endforelse
							</select>
						</div>
					</div>
			
					<div class="col-md-3">
						<div class="form-group">
							<label for="exampleInputPassword1">PROPIETARIO
								</label>
							<select class="form-control select2" id="propietario_buscar" name="propietario_buscar">
								<option label="Label"></option>
							</select>
						</div>
					</div>

					<div class="col-md-1">
						<div class="form-group">
							<p style="margin-top: 24px;"></p>

							<a href="#" class="btn btn-icon btn-primary" onclick="buscaEjemplares()">
								<i class="fas fa-search"></i>
							</a>
							<a href="#" class="btn btn-icon btn-success" onclick="generaExcel()">
								<i class="fas fa-file-excel"></i>
							</a>
						</div>
					</div>

				</div>
			</form>
			
			<!--begin: Datatable-->
			<div class="table-responsive m-t-40" id="ajaxEjemplares">

			</div>
			<!--end: Datatable-->
		</div>
	</div>
	<!--end::Card-->
@stop

@section('js')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
	<script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }} "></script>
    <script type="text/javascript">

		//Llamamamos a lista de ajax
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$(function () {
			// funcion para llamar a los datos iniciales de la tabla
			let datosBusquda = $('#formulario-busqueda-ejemplares').serializeArray();

			$.ajax({
				url: "{{ url('Ejemplar/ajaxListado') }}",
				data: datosBusquda,
				type: 'POST',
				success: function(data) {
					$('#ajaxEjemplares').html(data);
				}
			});

			$('#raza_buscar').select2({
    	        placeholder: "Seleccione la raza"
	        });
    	});

		function crear()
		{
			if($('#formulario-usuarios')[0].checkValidity()){
				$('#formulario-usuarios').submit();
			}else{
				$('#formulario-usuarios')[0].reportValidity()
			}
		}

		function nuevo()
    	{
			window.location.href = "{{ url('Criadero/formulario') }}/0";
    	}
		
		function edita(id)
		{
			window.location.href = "{{ url('Ejemplar/formulario') }}/"+id;
		}

		function elimina(id, nombre)
        {
            Swal.fire({
                title: "Quieres eliminar "+nombre,
                text: "Ya no podras recuperarlo!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, borrar!",
                cancelButtonText: "No, cancelar!",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    window.location.href = "{{ url('Criadero/elimina') }}/"+id;
                    Swal.fire(
                        "Borrado!",
                        "El registro fue eliminado.",
                        "success"
                    )
                    // result.dismiss can be "cancel", "overlay",
                    // "close", and "timer"
                } else if (result.dismiss === "cancel") {
                    Swal.fire(
                        "Cancelado",
                        "La operacion fue cancelada",
                        "error"
                    )
                }
            });
        }
		function buscaEjemplares()
		{
			let datosBusqueda = $('#formulario-busqueda-ejemplares').serializeArray();

			$.ajax({
				url: "{{ url('Ejemplar/ajaxListado') }}",
				data: datosBusqueda,
				type: 'POST',
				success: function(data) {
					$('#ajaxEjemplares').html(data);
				}
			});

		}

		$("#propietario_buscar").select2({
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

		function generaExcel()
		{
			alert("funcion en construccion");
		}

    </script>
@endsection