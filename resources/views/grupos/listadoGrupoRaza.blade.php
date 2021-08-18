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
                <h5 class="modal-title" id="exampleModalLabel">FORMULARIO DE GRUPO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('Grupo/agregarRaza') }}" method="POST" id="formulario-razas-grupos">
                	@csrf
                	<div class="row">
                		<div class="col-md-12">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">Nombre de la Raza
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="grupo_id" name="grupo_id" value="{{ $gruposRazas[0]->grupos->id }}"/>
								<select class="form-control select2" id="raza_id" name="raza_id">
									@forelse ($razas as $r)
										<option value="{{ $r->id }}">{{ $r->nombre }} {{ $r->descripcion }}</option>                                    
									@empty
										
									@endforelse
								</select>
                			</div>
                		</div>
                	</div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-dark font-weight-bold" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success font-weight-bold" onclick="agregar()">Agregar</button>
            </div>
        </div>
    </div>
</div>
{{-- fin inicio modal  --}}

	<!--begin::Card-->
	<div class="card card-custom gutter-b">
		<div class="card-header flex-wrap py-3">
			<div class="card-title">
				<h3 class="card-label">RAZAS DEL {{ $gruposRazas[0]->grupos->nombre }}
				</h3>
			</div>
			<div class="card-toolbar">
				<!--begin::Button-->
				<a href="#" class="btn btn-primary font-weight-bolder" onclick="nuevo()">
					<i class="fa fa-plus-square"></i> AGREGAR UNA NUEVA RAZA AL {{ $gruposRazas[0]->grupos->nombre }}
				</a>
				<!--end::Button-->
			</div>
		</div>
		{{-- @php
			dd($gruposRazas);
		@endphp --}}
		<div class="card-body">
			<!--begin: Datatable-->
			<div class="table-responsive m-t-40">
				<table class="table table-bordered table-hover table-striped" id="tabla-insumos">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Descripcion</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($gruposRazas as $ra)
							<tr>
								<td>{{ $ra->razas->id }}</td>
								<td>{{ $ra->razas->nombre }}</td>
								<td>{{ $ra->razas->descripcion }}</td>
								<td>
									<button type="button" class="btn btn-icon btn-danger" onclick="elimina('{{ $ra->id }}', '{{ $ra->nombre }}')">
										<i class="flaticon2-cross"></i>
									</button>
								</td>
							</tr>
						@empty
							<h3 class="text-danger">NO EXISTEN GRUPOS</h3>
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
    		$("#modalGrupo").modal('show');
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

                    window.location.href = "{{ url('Grupo/elimina') }}/"+id;

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

		$(function(){
			$('#raza_id').select2({
				placeholder: "Select a state"
			});
		});

		function agregar(){
			if($('#formulario-razas-grupos')[0].checkValidity()){
				$('#formulario-razas-grupos').submit();
				Swal.fire("Excelente!", "Registro Guardado!", "success");
			}else{
				$('#formulario-razas-grupos')[0].reportValidity()
			}
		}

    </script>
@endsection