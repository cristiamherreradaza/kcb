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
                			    <label for="exampleInputPassword1">Departamento
                			    <span class="text-danger">*</span></label>
								<select name="departamento" id="departamento" class="form-control">
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
                			    {{-- <input type="text" class="form-control" id="departamento" name="departamento" required /> --}}
                			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Numero de Pista
                			    <span class="text-danger">*</span></label>
                			    <input type="number" class="form-control" id="num_pista" name="num_pista" required />
                			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputPassword1">Tipo de Evento
									<span class="text-danger">*</span></label> <p></p>
                			    <label class="checkbox checkbox-success">
									<input type="checkbox" name="circuito" id="circuito"/>
									<span></span>
									&nbsp;Circuito
								</label>
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
				<h3 class="card-label">LISTADO DE BITACORA
				</h3>
			</div>
			<div class="card-toolbar">
				<!--begin::Button-->
				{{-- <a href="#" class="btn btn-primary font-weight-bolder" onclick="nuevo()">
					<i class="fa fa-plus-square"></i> NUEVO EVENTO
				</a> --}}
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
							<th>Usuario</th>
							<th>Ejemplar</th>
							<th>Campo</th>
							<th>Dato Original</th>
							<th>Dato Modificado</th>
							{{-- <th>Regional</th> --}}
							<th>Hora / Fecha</th>
							<th>Accion</th>
							{{-- <th>Circuito</th>
							<th>Postulantes</th>
							<th>Acciones</th> --}}
						</tr>
					</thead>
					<tbody>
						@forelse ($modificaiones as $m)
						@php
							$jemplar = App\Ejemplar::find($m->ejemplar_id);
						@endphp
						@if($jemplar && $m->user)
							<tr>
								<td>{{ $m->id }}</td>
								<td>
                                    {{ $m->user->name }}
                                </td>
								<td>
									@php
										$jemplar = App\Ejemplar::find($m->ejemplar_id);
										if($jemplar){
											echo $jemplar->nombre;
										}
									@endphp
								</td>
								<td>
									@php
										if($m->campo == 'EXAMEN' || $m->campo == 'TRAMSFERENCIA' || $m->campo == 'TITULO'){
											echo '<span class="label label-lg label-light-primary label-inline">'.$m->campo.'</span>';
										}else{
											echo $m->campo;
										}
									@endphp
								</td>
								<td>{{ $m->dato_anteriror }}</td>
								<td>{{ $m->dato_modificado }}</td>
								<td>
									@php
						                $utilidades = new App\librerias\Utilidades();
										$fecha = $utilidades->fechaHoraCastellano($m->created_at);
										echo $fecha;
									@endphp
								</td>
								<td>
									@php
										$style = '';
										if($m->accion == 'Modificado'){
											$style = 'warning';
										}elseif($m->accion == 'Eliminado'){
											$style = 'danger';
										}elseif($m->accion == 'Agregado'){
											$style = 'success';
										}
									@endphp
									<span class="label label-lg label-light-{{ $style }} label-inline">{{ $m->accion }}</span>
								</td>
							</tr>
						@endif
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
				responsive: true,
    	        language: {
    	            url: '{{ asset('datatableEs.json') }}',
    	        },
				order: [[ 0, "desc" ]]
    	    });

    	});

    	// function nuevo()
    	// {
		// 	// pone los inputs vacios
		// 	$("#evento_id").val('');
		// 	$("#nombre").val('');
		// 	$("#fecha_ini").val('');
		// 	$("#fecha_fin").val('');
		// 	$("#direccion").val('');
		// 	$("#departamento").val('La Paz');
		// 	$("#num_pista").val('');
		// 	$("#circuito").val('');
		// 	// abre el modal
    	// 	$("#modalGrupo").modal('show');
    	// }

		// function edita(id, nombre, fecha_ini, fecha_fin, direccion, departamento, num_pista, circuito)
    	// {
		// 	// colocamos valores en los inputs
		// 	$("#evento_id").val(id);
		// 	$("#nombre").val(nombre);
		// 	$("#fecha_ini").val(fecha_ini.replace(' ','T'));
		// 	$("#fecha_fin").val(fecha_fin.replace(' ','T'));
		// 	$("#direccion").val(direccion);
		// 	$("#departamento").val(departamento);
		// 	$("#num_pista").val(num_pista);
		// 	$("#circuito").val(circuito);
		// 	// mostramos el modal
		// 	$("#fecha_ini").val(fecha_ini.replace(' ','T'));

    	// 	$("#modalGrupo").modal('show');
    	// }

    	// function crear()
    	// {
		// 	// verificamos que el formulario este correcto
    	// 	if($("#formulario-tipos")[0].checkValidity()){
		// 		// enviamos el formulario
    	// 		$("#formulario-tipos").submit();
		// 		// mostramos la alerta
		// 		Swal.fire("Excelente!", "Registro Guardado!", "success");
    	// 	}else{
		// 		// de lo contrario mostramos los errores
		// 		// del formulario
    	// 		$("#formulario-tipos")[0].reportValidity()
    	// 	}

    	// }

		// function elimina(id, nombre)
        // {
		// 	// mostramos la pregunta en el alert
        //     Swal.fire({
        //         title: "Quieres eliminar "+nombre,
        //         text: "Ya no podras recuperarlo!",
        //         icon: "warning",
        //         showCancelButton: true,
        //         confirmButtonText: "Si, borrar!",
        //         cancelButtonText: "No, cancelar!",
        //         reverseButtons: true
        //     }).then(function(result) {
		// 		// si pulsa boton si
        //         if (result.value) {

        //             window.location.href = "{{ url('Evento/elimina') }}/"+id;

        //             Swal.fire(
        //                 "Borrado!",
        //                 "El registro fue eliminado.",
        //                 "success"
        //             )
        //             // result.dismiss can be "cancel", "overlay",
        //             // "close", and "timer"
        //         } else if (result.dismiss === "cancel") {
        //             Swal.fire(
        //                 "Cancelado",
        //                 "La operacion fue cancelada",
        //                 "error"
        //             )
        //         }
        //     });
        // }

		// function listaInscritos(id){
		// 	window.location.href = "{{ url('Evento/listadoInscritos') }}/"+id;
		// }

		// function catalogo(id){
		// 	// alert("En desarrollo :v");
		// 	window.location.href = "{{ url('Evento/catalogo') }}/"+id;
		// }

    </script>
@endsection
