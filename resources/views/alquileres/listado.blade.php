@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')

{{-- inicio modal  --}}

<!-- Modal-->
<div class="modal fade" id="modalRaza" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">FORMULARIO DE ALQUILER</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('Titulo/guarda') }}" method="POST" id="formulario-tipos">
                	@csrf
                	<div class="row">
                		<div class="col-md-4">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">AFIJO
                			    <span class="text-danger">*</span></label>
                			    <input type="hidden" class="form-control" id="titulo_id" name="titulo_id" />
                			    <input type="text" class="form-control" id="criadero_id" name="criadero_id" required />
                			</div>
                		</div>
                		<div class="col-md-4">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">EJEMPLAR
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="ejemplar_id" name="ejemplar_id" required />
                			</div>
                		</div>
                        <div class="col-md-4">
                            <div class="form-group">
                			    <label for="exampleInputPassword1">PROPIETARIO ACTUAL
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="propietario_original_id" name="propietario_original_id" required />
                			</div>
                        </div>
                	</div>
                    <div class="row">
                		<div class="col-md-6">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">PROPIETARIO A ALQUILAR
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="propietario_alquilado_id" name="propietario_alquilado_id" required />
                			</div>
                		</div>
                		<div class="col-md-6">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">FECHA
                			    <span class="text-danger">*</span></label>
                			    <input type="date" class="form-control" id="fecha" name="fecha" required />
                			</div>
                		</div>
                	</div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-light-dark font-weight-bold" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-sm btn-success font-weight-bold" onclick="crear()">Guardar</button>
            </div>
        </div>
    </div>
</div>
{{-- fin inicio modal  --}}

	<!--begin::Card-->
	<div class="card card-custom gutter-b">
		<div class="card-header flex-wrap py-3">
			<div class="card-title">
				<h3 class="card-label">ALQUILERES
				</h3>
			</div>
			<div class="card-toolbar">
				<!--begin::Button-->
				<a href="#" class="btn btn-primary font-weight-bolder" onclick="nuevo()">
					<i class="fa fa-plus-square"></i> NUEVO ALQUILER
				</a>
				<!--end::Button-->
			</div>
		</div>
		
		<div class="card-body">
			<!--begin: Datatable-->
			<div class="table-responsive m-t-40">
				<table class="table table-bordered table-hover table-striped" id="tabla-insumos">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nombre criadero</th>
							<th>Propietario Antiguo</th>
							<th>Propietario Alquilado</th>
							<th>Ejemplar</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($alquileres as $a)
							@if($a->ejemplar)
								<tr>
									<td>{{ $a->id }}</td>
									<td>{{ $a->criadero->nombre }}</td>
									<td>{{ $a->propietario_antiguo->name }}</td>
									<td>{{ $a->propietario_alquilado->name }}</td>
									<td>{{ $a->ejemplar->nombre_completo }}</td>
									<td>
										{{--  <button type="button" class="btn btn-sm btn-icon btn-warning" onclick="edita('{{ $a->id }}', '{{ $a->nombre }}', '{{ $a->descripcion }}')">
											<i class="flaticon2-edit"></i>
										</button>  --}}
										<button type="button" class="btn btn-sm btn-icon btn-danger" onclick="elimina('{{ $a->id }}', '{{ $a->nombre }}')">
											<i class="flaticon2-cross"></i>
										</button>
									</td>
								</tr>
							@endif
						@empty
							<h3 class="text-danger">NO EXISTEN ALQUILERES</h3>
						@endforelse
					</tbody>
					<tbody>
					</tbody>
				</table>
			</div>
			<!--end: Datatable-->
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

    	function nuevo()
    	{
			// pone los inputs vacios
			$("#titulo_id").val('');
			$("#nombre").val('');
			$("#descripcion").val('');
			// abre el modal
    		$("#modalRaza").modal('show');
    	}

		function edita(id, nombre, descripcion)
    	{
			// colocamos valores en los inputs
			$("#titulo_id").val(id);
			$("#nombre").val(nombre);
			$("#descripcion").val(descripcion);

			// mostramos el modal
    		$("#modalRaza").modal('show');
    	}

    	function crear()
    	{
			// verificamos que el formulario este correcto
    		if($("#formulario-tipos")[0].checkValidity()){
				// enviamos el formulario
    			$("#formulario-tipos").submit();
				// mostramos la alerta
				Swal.fire("Excelente!", "Registro Guardado!", "success");
    		}else{
				// de lo contrario mostramos los errores
				// del formulario
    			$("#formulario-tipos")[0].reportValidity()
    		}

    	}

		function elimina(id, nombre)
        {
			// mostramos la pregunta en el alert
            Swal.fire({
                title: "Quieres eliminar "+nombre,
                text: "Ya no podras recuperarlo!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, borrar!",
                cancelButtonText: "No, cancelar!",
                reverseButtons: true
            }).then(function(result) {
				// si pulsa boton si
                if (result.value) {

                    window.location.href = "{{ url('Titulo/elimina') }}/"+id;

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

    </script>
@endsection