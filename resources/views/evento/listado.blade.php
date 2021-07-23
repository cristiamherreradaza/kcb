@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')

{{-- inicio modal  --}}

<!-- Modal-->
<div class="modal fade" id="modalGrupo" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">FORMULARIO DE EVENTOS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('Evento/guarda') }}" method="POST" id="formulario-tipos">
                	@csrf
                	<div class="row">

                		<div class="col-md-4">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">Nombre del Evento
                			    <span class="text-danger">*</span></label>
                			    <input type="hidden" class="form-control" id="evento_id" name="evento_id" />
                			    <input type="text" class="form-control" id="nombre" name="nombre" required />
                			</div>
                		</div>

                		<div class="col-md-4">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">Fecha de Inicio
                			    <span class="text-danger">*</span></label>
                			    <input type="datetime-local" class="form-control" id="fecha_ini" name="fecha_ini" required />
                			</div>
                		</div>

						<div class="col-md-4">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">Fecha de Fin
                			    <span class="text-danger">*</span></label>
                			    <input type="datetime-local" class="form-control" id="fecha_fin" name="fecha_fin" required />
                			</div>
                		</div>
                	</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Direccion
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="direccion" name="direccion" required />
                			</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Ciudad
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="ciudad" name="ciudad" required />
                			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Numero de Pista
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="num_pista" name="num_pista" required />
                			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Circuito
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="circuito" name="circuito" required />
                			</div>
						</div>
					</div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-dark font-weight-bold" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success font-weight-bold" onclick="crear()">Guardar</button>
            </div>
        </div>
    </div>
</div>
{{-- fin inicio modal  --}}

	<!--begin::Card-->
	<div class="card card-custom gutter-b">
		<div class="card-header flex-wrap py-3">
			<div class="card-title">
				<h3 class="card-label">TIPOS DE EVENTOS
				</h3>
			</div>
			<div class="card-toolbar">
				<!--begin::Button-->
				<a href="#" class="btn btn-primary font-weight-bolder" onclick="nuevo()">
					<i class="fa fa-plus-square"></i> NUEVO EVENTO
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
							<th>Nombre</th>
							<th>Fecha de Inicio</th>
							<th>Fecha de Fin</th>
							<th>Direccion</th>
							<th>Ciudad</th>
							<th>Numero Pista</th>
							<th>Circuito</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($eventos as $even)
							<tr>
								<td>{{ $even->id }}</td>
								<td>{{ $even->nombre }}</td>
								<td>{{ $even->fecha_inicio }}</td>
								<td>{{ $even->fecha_fin }}</td>
								<td>{{ $even->direccion }}</td>
								<td>{{ $even->ciudad }}</td>
								<td>{{ $even->numero_pista }}</td>
								<td>{{ $even->circuito }}</td>
								<td>
									<button type="button" class="btn btn-icon btn-warning" onclick="edita('{{ $even->id }}', '{{ $even->nombre }}', '{{ $even->fecha_inicio }}', '{{ $even->fecha_fin }}', '{{ $even->direccion }}', '{{ $even->ciudad }}', '{{ $even->numero_pista }}', '{{ $even->circuito }}')">
										<i class="flaticon2-edit"></i>
									</button>
									<button type="button" class="btn btn-icon btn-danger" onclick="elimina('{{ $even->id }}', '{{ $even->nombre }}')">
										<i class="flaticon2-cross"></i>
									</button>
								</td>
							</tr>
						@empty
							<h3 class="text-danger">NO EXISTEN EVENTOS</h3>
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
    	        language: {
    	            url: '{{ asset('datatableEs.json') }}',
    	        },
				order: [[ 0, "desc" ]]
    	    });

    	});

    	function nuevo()
    	{
			// pone los inputs vacios
			$("#evento_id").val('');
			$("#nombre").val('');
			$("#fecha_ini").val('');
			$("#fecha_fin").val('');
			$("#direccion").val('');
			$("#ciudad").val('');
			$("#num_pista").val('');
			$("#circuito").val('');
			// abre el modal
    		$("#modalGrupo").modal('show');
    	}

		function edita(id, nombre, fecha_ini, fecha_fin, direccion, ciudad, num_pista, circuito)
    	{
			// colocamos valores en los inputs
			$("#evento_id").val(id);
			$("#nombre").val(nombre);
			$("#fecha_ini").val(fecha_ini.replace(' ','T'));
			$("#fecha_fin").val(fecha_fin.replace(' ','T'));
			$("#direccion").val(direccion);
			$("#ciudad").val(ciudad);
			$("#num_pista").val(num_pista);
			$("#circuito").val(circuito);
			// mostramos el modal
			$("#fecha_ini").val(fecha_ini.replace(' ','T'));

    		$("#modalGrupo").modal('show');
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

                    window.location.href = "{{ url('Evento/elimina') }}/"+id;

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