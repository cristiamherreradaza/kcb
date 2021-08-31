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
                <h5 class="modal-title" id="exampleModalLabel">FORMULARIO DE SUCURSAL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('Sucursal/guarda') }}" method="POST" id="formulario-tipos">
                	@csrf
                	<div class="row">
                		<div class="col-md-6">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">Nombre del Sucursal
                			    <span class="text-danger">*</span></label>
                			    <input type="hidden" class="form-control" id="sucursal_id" name="sucursal_id" />
                			    <input type="text" class="form-control" id="nombre" name="nombre" required />
                			</div>
                		</div>

						<div class="col-md-6">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">Celulares
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="celulares" name="celulares" required />
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
                		<div class="col-md-6">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">Departamento
                			    <span class="text-danger">*</span></label>
                			    {{-- <input type="text" class="form-control" id="descripcion" name="descripcion" required /> --}}
								<select name="departamento" id="departamento" class="form-control" required>
									<option value="La Paz">La Paz</option>
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
						<div class="col-md-6">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">Cuenta
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="cuenta" name="cuenta" required />
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
				<h3 class="card-label">TIPOS DE SUCURSALES
				</h3>
			</div>
			<div class="card-toolbar">
				<!--begin::Button-->
				<a href="#" class="btn btn-primary font-weight-bolder" onclick="nuevo()">
					<i class="fa fa-plus-square"></i> NUEVO SUCURSAL
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
							<th>Direccion</th>
							<th>Celulares</th>
							<th>Departamento</th>
							<th>Cuenta</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($sucursales as $su)
							<tr>
								<td>{{ $su->id }}</td>
								<td>{{ $su->nombre }}</td>
								<td>{{ $su->direccion }}</td>
								<td>{{ $su->celulares }}</td>
								<td>{{ $su->departamento }}</td>
								<td>{{ $su->cuenta }}</td>
								<td>
									<button type="button" class="btn btn-sm btn-icon btn-warning" onclick="edita('{{ $su->id }}', '{{ $su->nombre }}', '{{ $su->direccion }}', '{{ $su->celulares }}', '{{ $su->departamento }}', '{{ $su->cuenta }}')">
										<i class="flaticon2-edit"></i>
									</button>
									<button type="button" class="btn btn-sm btn-icon btn-danger" onclick="elimina('{{ $su->id }}', '{{ $su->nombre }}')">
										<i class="flaticon2-cross"></i>
									</button>
								</td>
							</tr>
						@empty
							<h3 class="text-danger">NO EXISTEN SUCURSALES</h3>
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
			$("#sucursal_id").val('');
			$("#nombre").val('');
			$("#direccion").val('');
			$("#celulares").val('');
			$("#departamento").val('La Paz');
			$("#cuenta").val('');

			// abre el modal
    		$("#modalRaza").modal('show');
    	}

		function edita(id, nombre, direccion, celulares, departamento, cuenta)
    	{
			// colocamos valores en los inputs
			$("#sucursal_id").val(id);
			$("#nombre").val(nombre);
			$("#direccion").val(direccion);
			$("#celulares").val(celulares);
			$("#departamento").val(departamento);
			$("#cuenta").val(cuenta);

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

                    window.location.href = "{{ url('Sucursal/elimina') }}/"+id;

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