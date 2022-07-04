@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('metadatos')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')


{{-- inicio modal  --}}

<!-- Modal-->
<div class="modal fade" id="modalAddJuez" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">FORMULARIO DE ASIGNACION DE JUEZ AL EVENTO <span class="text-info" id="nombreEvento"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<form action="{{ url('Juez/guardaAsignacionEvento') }}" method="POST" id="formulario-asignacion">
							@csrf
							<input type="hidden" name="asignacion_evento_id" id="asignacion_evento_id">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label for="exampleInputPassword1">Juez
										<span class="text-danger">*</span></label>
										<select name="juez_id" id="juez_id" class="form-control" style="width:100%;">
											<option value=""></option>
											@foreach ($jueces as $juez)
												<option value="{{ $juez->id }}">{{ $juez->nombre }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="exampleInputPassword1">Secretario
										<span class="text-danger">*</span></label>
										<select name="secretario_id" id="secretario_id" class="form-control" style="width:100%;">
											<option value=""></option>
											@foreach ($secretarios as $secre)
												<option value="{{ $secre->id }}">{{ $secre->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="exampleInputPassword1">Pista
										<span class="text-danger">*</span></label>
										<select name="num_pista" id="num_pista" class="form-control" style="width:100%;" required>

										</select>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div id="listaAsignaciones">

						</div>
					</div>
				</div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-dark font-weight-bold" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success font-weight-bold" onclick="Asignar()">Guardar</button>
            </div>
        </div>
    </div>
</div>
{{-- fin inicio modal  --}}

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
                			    <input type="date" class="form-control" id="fecha_ini" name="fecha_ini" required />
                			</div>
                		</div>

						<div class="col-md-4">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">Fecha de Fin
                			    <span class="text-danger">*</span></label>
                			    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required />
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
						<div class="col-md-3">
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
						<div class="col-md-3">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Numero de Pista
                			    <span class="text-danger">*</span></label>
                			    <input type="number" class="form-control" id="num_pista" name="num_pista" required />
                			</div>
						</div>
						<div class="col-md-3">
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
						<div class="col-md-3">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Habilitado
                			    <span class="text-danger">*</span></label>
								<select name="habilitado" id="habilitado" class="form-control">
									<option value="Si">Si</option>
									<option value="No">No</option>
								</select>
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
							<th>departamento</th>
							<th>Numero Pista</th>
							<th>Circuito</th>
							<th>Postulantes</th>
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
								<td>{{ $even->departamento }}</td>
								<td>{{ $even->numero_pista }}</td>
								<td>{{ $even->circuito }}</td>
								<td>
									@php
										$postulantes = App\EjemplarEvento::where('evento_id',$even->id)->count();
										echo $postulantes;
									@endphp
								</td>
								<td>
									<button type="button" class="btn btn-icon btn-warning" onclick="edita('{{ $even->id }}', '{{ $even->nombre }}', '{{ $even->fecha_inicio }}', '{{ $even->fecha_fin }}', '{{ $even->direccion }}', '{{ $even->departamento }}', '{{ $even->numero_pista }}', '{{ $even->circuito }}', '{{ $even->habilitado }}')">
										<i class="flaticon2-edit"></i>
									</button>
									<button type="button" class="btn btn-icon btn-primary" onclick="catalogo('{{ $even->id }}')" title="Catalogo">
										<i class="fas fa-book-open"></i>
									</button>
									<button type="button" class="btn btn-icon btn-info" onclick="listaInscritos('{{ $even->id }}')">
										<i class="far fa-list-alt"></i>
									</button>
									<button type="button" class="btn btn-icon btn-success" onclick="addJuez('{{ $even->id }}', '{{ $even->nombre }}', '{{ $even->numero_pista }}')">
										<i class="fas fa-gavel"></i>
									</button>
									<button type="button" class="btn btn-icon btn-dark" onclick="generaNumeracion('{{ $even->id }}', '{{ $even->nombre }}')">
										<i class="fas fa-monument"></i>
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

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$(function(){
			$('#juez_id').select2({
				placeholder: "Select a state"
			});
		});

		$(function(){
			$('#secretario_id').select2({
				placeholder: "Select a state"
			});
		});

		// $(function(){
		// 	$('#evento_id').select2({
		// 		placeholder: "Select a state"
		// 	});
		// });

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
			$("#evento_id").val('');
			$("#nombre").val('');
			$("#fecha_ini").val('');
			$("#fecha_fin").val('');
			$("#direccion").val('');
			$("#departamento").val('La Paz');
			$("#num_pista").val('');
			$("#circuito").val('');
			// abre el modal
    		$("#modalGrupo").modal('show');
    	}

		function edita(id, nombre, fecha_ini, fecha_fin, direccion, departamento, num_pista, circuito, habilitado)
    	{
			// colocamos valores en los inputs
			$("#evento_id").val(id);
			$("#nombre").val(nombre);
			$("#fecha_ini").val(fecha_ini);
			$("#fecha_fin").val(fecha_fin);
			// $("#fecha_ini").val(fecha_ini.replace(' ','T'));
			// $("#fecha_fin").val(fecha_fin.replace(' ','T'));
			$("#direccion").val(direccion);
			$("#departamento").val(departamento);
			$("#num_pista").val(num_pista);
			$("#circuito").val(circuito);
			$("#habilitado").val(habilitado);
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

		function listaInscritos(id){
			window.location.href = "{{ url('Evento/listadoInscritos') }}/"+id;
		}

		function catalogo(id){
			// alert("En desarrollo :v");
			window.location.href = "{{ url('Evento/catalogo') }}/"+id;
		}

		function addJuez(id, nombre, numero_pista){
			$('#asignacion_evento_id').val(id);
			$('#nombreEvento').text(nombre);

			$('#juez_id').val('');
			$("#juez_id").trigger('change');
			$('#secretario_id').val('');
			$("#secretario_id").trigger('change');

			// PARA EL SELECT DE CATEGORIAS
			// eliminamos todas las opciones del select
			$('#num_pista').empty();

			let option = '';
			for (let index = 1; index <= numero_pista; index++) {
				option = option+'<option value='+index+'>'+index+'</option>'
			}

			$('#num_pista').append(option);


			$.ajax({
				url: "{{ url('Juez/ajaxListadoAsignacion') }}",
				data: {
					evento_id:id
				},
				type: 'POST',
				dataType: 'json',
				success: function(data) {

					console.log(data);

					if(data.status == 'success'){

						if(data.cantAsignaciones == 0){

							$('#juez_id').prop('disabled', true);
							$('#secretario_id').prop('disabled', true);

						}else{

							$('#juez_id').prop('disabled', false);
							$('#secretario_id').prop('disabled', false);

						}

						$('#listaAsignaciones').html(data.listado);

					}

				}
			});

			$('#modalAddJuez').modal('show');
		}

		function Asignar(){
			// verificamos que el formulario este correcto
    		if($("#formulario-asignacion")[0].checkValidity()){

				let datosFormularioAsignacion = $("#formulario-asignacion").serializeArray();

				$.ajax({
					url: "{{ url('Juez/ajaxguardaAsignacionEvento') }}",
					data: datosFormularioAsignacion,
					type: 'POST',
					dataType:'json',
					success: function(data) {

						if(data.status == 'success'){
							
							$('#listaAsignaciones').html(data.listado);

							if(data.cantAsignaciones == 0){

								$('#juez_id').prop('disabled', true);
								$('#secretario_id').prop('disabled', true);

							}else{

								$('#juez_id').prop('disabled', false);
								$('#secretario_id').prop('disabled', false);

							}
							
	
							Swal.fire(
								"Exito!",
								"El Juez fue Agregado.",
								"success"
							)

						}
						
					}
				});

    		}else{
    			$("#formulario-asignacion")[0].reportValidity()
    		}
		}

		function eliminaAsigancion(id, nombre){

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

					$.ajax({
						url: "{{ url('Juez/ajaxEliminaAsignacion') }}",
						data: {
							asignacion_id:id
						},
						dataType: 'json',
						type: 'POST',
						success: function(data) {

							if(data.status == 'success'){

								if(data.cantAsignaciones == 0){

									$('#juez_id').prop('disabled', true);
									$('#secretario_id').prop('disabled', true);

								}else{

									$('#juez_id').prop('disabled', false);
									$('#secretario_id').prop('disabled', false);

								}

								$('#listaAsignaciones').html(data.listado);
								
								Swal.fire(
									"Borrado!",
									"El registro fue eliminado.",
									"success"
								)

							}
							
						}
					});


                } else if (result.dismiss === "cancel") {

                    Swal.fire(
                        "Cancelado",
                        "La operacion fue cancelada",
                        "error"
                    )
                }
            });

		}

		function generaNumeracion(id ,nombre){
			Swal.fire({
                title: "Quieres generar la numeracion para el Evento "+nombre,
                // text: "Ya no podras recuperarlo!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, Generar!",
                cancelButtonText: "No, cancelar!",
                reverseButtons: true
            }).then(function(result) {
				// si pulsa boton si
                if (result.value) {

					window.location.href = "{{ url('Evento/catalogoNumeracion')}}/"+id;

                    Swal.fire(
                        "Exito!",
                        "La generacion fue un Exito.",
                        "success"
                    )
					
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
