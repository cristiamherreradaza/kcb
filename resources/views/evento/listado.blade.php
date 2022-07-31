@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('metadatos')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')


{{-- inicio modal ADD CATEGORIAS  --}}
<div class="modal fade" id="modalAddCategoria" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">FORMULARIO DE ADICION DE CATEGORIA AL JUEZ <span class="text-info" id="nombreJuezAdd"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
				<form action="" id="formularioAddCategoria" method="POST">
					@csrf
					<input type="hidden" name="add_categoria_asignacion_id" id="add_categoria_asignacion_id">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Categorias <span class="text-danger">*</span></label>
								<select class="form-control select2" id="categoriasAdd" name="categoriasAdd[]" multiple="multiple" style="width:100%;">
									
								</select>
							</div>
						</div>
					</div>
				</form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-dark font-weight-bold" onclick="cerrarModalAddCategoria()">Cerrar</button>
                <button type="button" class="btn btn-success font-weight-bold" onclick="addCategoria()">Adicion Categoria</button>
            </div>
        </div>
    </div>
</div>
{{-- fin inicio modal ADD CATEGORIAS --}}


{{-- inicio modal CLONAR  --}}
<div class="modal fade" id="modalClonarEvento" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">FORMULARIO DE CLONACION DE VENTO <span class="text-info" id="nombreEventoClonar"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
				<form action="{{ url('Evento/clonarEvento') }}" id="formularioClonarEvento" method="POST">
					@csrf
					<input type="text" name="evento_id_clonar" id="evento_id_clonar">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="exampleInputPassword1">Nombre del evento
								<span class="text-danger">*</span></label>
								<input type="text" name="nombre_clonar" class="form-control" id="nombre_clonar"/>
							</div>
						</div>
					</div>
					<label>Tipo de evento</label>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="radio radio-lg">
									<input type="radio" checked="checked" name="radios3_1" value="Nacional"/>
									<span></span>
									Nacional
								</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="radio radio-lg">
									<input type="radio" name="radios3_1" checked="checked" value="Internacional"/>
									<span></span>
									Internacional
								</label>
							</div>
						</div>
					</div>
				</form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-dark font-weight-bold" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success font-weight-bold" onclick="clonar()">Clonar</button>
            </div>
        </div>
    </div>
</div>
{{-- fin inicio modal CLONAR --}}

{{-- inicio modal  --}}
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
				
				<label>Tipo de Asignacion</label>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="radio radio-lg">
								<input type="radio" id="checkPista" checked="checked" name="radios3_1" value="pista" onchange="cambiaAsignacion(this)"/>
								<span></span>
								 Por Pista
							</label>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="radio radio-lg">
								<input type="radio" id="checkGrupo" name="radios3_1" value="grupo" onchange="cambiaAsignacion(this)"/>
								<span></span>
								 Por Grupo
							</label>
						</div>
					</div>
				</div>

				<div id="bloque_pista">
					<div class="row">
						<div class="col-md-12">
							<form action="{{ url('Juez/guardaAsignacionEvento') }}" method="POST" id="formulario-asignacion">
								@csrf
								
								<input type="hidden" name="asignacion_evento_id" id="asignacion_evento_id">
								<input type="hidden" id="tipo_asignacion" value="pista" name="tipo_asignacion">

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
									<div class="col-md-4" >
										<div id="select_pistas">
											<div class="form-group">
												<label for="exampleInputPassword1">Pista
												<span class="text-danger">*</span></label>
												<select name="num_pista" id="num_pista" class="form-control" style="width:100%;" required>
		
												</select>
											</div>
										</div>
										<div id="select_grupos" style="display: none;">
											<div class="form-group">
												<label>Grupos <span class="text-danger">*</span></label>
												<select class="form-control select2" id="kt_select2_3_modal" name="grupos[]" multiple="multiple" style="width:100%;">
													
												</select>
											</div>
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
							<th>Habilitado</th>
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
									<div class="form-group row">
										<div class="col-3">
										 <span class="switch switch-outline switch-icon switch-success">
										  <label>
										   <input type="checkbox" {{ ($even->habilitado == 'Si')? 'checked' : '' }} id="evento_cerrerar_{{ $even->id }}" onchange='cerrarEvento({{ $even->id }}, "{{ $even->nombre }}")'/>
										   <span></span>
										  </label>
										 </span>
										</div>
									</div>
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
									<a href="{{ url('Juez/exportarExcel', [$even->id]) }}" class="btn btn-icon btn-success">
										<i class="fas fa-file-excel"></i>
									</a>
									<button type="button" class="btn btn-icon btn-white" onclick="clonarEvento('{{ $even->id }}', '{{ $even->nombre }}')">
										<i class="fas fa-copy"></i>
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

		$(function(){
			$('#grupo_juez_id').select2({
				placeholder: "Seleccione al juez"
			});
		});

		$(function(){
			$('#grupo_secretario_id').select2({
				placeholder: "Seleccione al secretario"
			});
		});

		// multi select
         $('#kt_select2_3_modal').select2({
          placeholder: "Select los grupos",
         });

		 $('#categoriasAdd').select2({
          placeholder: "Seleccion las categorias",
         });
		 

    	$(function () {
    	    $('#tabla-insumos').DataTable({
				responsive: true,
    	        language: {
    	            url: '{{ asset('datatableEs.json') }}',
    	        },
				order: [[ 0, "desc" ]]
    	    });

    	});

    	function nuevo(){
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

					if(data.status == 'success'){

						if(data.tipo != 'vacio'){

							if(data.tipo == 'pista'){
								$('#checkPista').prop('checked', true);
								$('#tipo_asignacion').val('pista');

								$('#select_pistas').show('toggle');
								$('#select_grupos').hide('toggle');
							}else{
								$('#checkGrupo').prop('checked', true);
								$('#tipo_asignacion').val('grupo');

								$('#select_grupos').show('toggle');
								$('#select_pistas').hide('toggle');
							}

							$('#checkPista').prop('disabled', true);
							$('#checkGrupo').prop('disabled', true);

						}else{

							$('#checkPista').prop('checked', true);
							$('#tipo_asignacion').val('pista');
							$('#select_pistas').css('display', 'block');
							$('#select_grupos').css('display', 'none');

							$('#checkPista').prop('disabled', false);
							$('#checkGrupo').prop('disabled', false);

						}

						$('#listaAsignaciones').html(data.listado);

						// PARA LOS GRUPOS
						$('#kt_select2_3_modal').empty();

						$(data.grupos).each(function( index , value) {
							$('#kt_select2_3_modal').prepend("<option value='"+value.grupo_id+"' >Grupo "+value.grupo_id+"</option>");
						});

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

							if(data.tipo != 'vacio'){

								if(data.tipo == 'pista'){
									$('#checkPista').prop('checked', true);
									$('#tipo_asignacion').val('pista');

									$('#select_pistas').show('toggle');
									$('#select_grupos').hide('toggle');
								}else{
									$('#checkGrupo').prop('checked', true);
									$('#tipo_asignacion').val('grupo');

									$('#select_grupos').show('toggle');
									$('#select_pistas').hide('toggle');
								}

								$('#checkPista').prop('disabled', true);
								$('#checkGrupo').prop('disabled', true);

							}else{

								$('#checkPista').prop('disabled', false);
								$('#checkGrupo').prop('disabled', false);

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

								if(data.tipo != 'vacio'){

									if(data.tipo == 'pista'){
										$('#checkPista').prop('checked', true);
										$('#tipo_asignacion').val('pista');

										$('#select_pistas').show('toggle');
										$('#select_grupos').hide('toggle');
									}else{
										$('#checkGrupo').prop('checked', true);
										$('#tipo_asignacion').val('grupo');

										$('#select_grupos').show('toggle');
										$('#select_pistas').hide('toggle');
									}

									$('#checkPista').prop('disabled', true);
									$('#checkGrupo').prop('disabled', true);

								}else{

									$('#checkPista').prop('disabled', false);
									$('#checkGrupo').prop('disabled', false);

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

		function cerrarEvento(evento, nombre){
			
			if($('#evento_cerrerar_'+evento).prop('checked')){
				var texto = 'habilitar';
				var sw = true;
			}else{
				var sw = false;
				var texto = 'cerrar';
			}

			Swal.fire({
                title: "Esta seguro de "+texto+" el evento "+nombre,
                // text: "Ya no podras recuperarlo!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, "+texto+"!",
                cancelButtonText: "No!",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {

					$.ajax({
						url: "{{ url('Evento/habilitaEvento') }}",
						data: {
							evento:evento
						},
						dataType: 'json',
						type: 'POST',
						success: function(data) {

							if(data.status == 'success'){
								Swal.fire(
								    "Exito!",
								    "Se cambio el estado con exito.",
								    "success"
								)
							}
							
						}
					});
					
                } else if (result.dismiss === "cancel") {

					if(sw)
						$('#evento_cerrerar_'+evento).prop('checked', false)
					else
						$('#evento_cerrerar_'+evento).prop('checked', true)


                    Swal.fire(
                        "Cancelado",
                        "La operacion fue cancelada",
                        "error"
                    )
                }
            });

		}

		function cambiaAsignacion(radio){

			if(radio.value == 'pista'){

				$('#select_pistas').show('toggle');
				$('#select_grupos').hide('toggle');

				$('#tipo_asignacion').val('pista');

			}else{

				$('#select_pistas').hide('toggle');
				$('#select_grupos').show('toggle');


				$('#tipo_asignacion').val('grupo');

			}
			
		}

		function clonarEvento(evento, nombre){

			$('#evento_id_clonar').val(evento);
			$('#nombre_clonar').val(nombre);
			$('#nombreEventoClonar').text(nombre);

			$('#modalClonarEvento').modal('show');

		}

		function clonar(evento, nombre){

			Swal.fire({
                title: "Esta seguro de clonar el evento "+nombre+"?",
                text: "Ya no podras recuperarlo!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, estoy seguro!",
                cancelButtonText: "No!",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {

					$('#formularioClonarEvento').submit();

                } else if (result.dismiss === "cancel") {

                    Swal.fire(
                        "Cancelado",
                        "La operacion fue cancelada",
                        "error"
                    )
                }
            });

		}

		function agregarCategoria(asignacion, nombre){

			$('#add_categoria_asignacion_id').val(asignacion);
			$('#nombreJuezAdd').text(nombre);

			$.ajax({
				url: "{{ url('Juez/categoriasAsignadas') }}",
				data: {asigancion: asignacion},
				dataType: 'json',
				type: 'POST',
				success: function(data) {

					if(data.status == 'success'){

						$('#categoriasAdd').empty();

						$('#categoriasAdd').append("<option "+( ((data.categorias).indexOf('Especiales') != -1)? 'selected' : '' )+" value='Especiales'>Especiales</option>");
						$('#categoriasAdd').append("<option "+( ((data.categorias).indexOf('Absolutos') != -1)? 'selected' : '' )+" value='Absolutos'>Absolutos</option>");
						$('#categoriasAdd').append("<option "+( ((data.categorias).indexOf('Jovenes') != -1)? 'selected' : '' )+" value='Jovenes'>Jovenes</option>");
						$('#categoriasAdd').append("<option "+( ((data.categorias).indexOf('Adultos') != -1)? 'selected' : '' )+" value='Adultos'>Adultos</option>");

					}
					
				}
			});

			$('#modalAddJuez').modal('hide');
			$('#modalAddCategoria').modal('show');

		}

		function addCategoria(){

			Swal.fire({
                title: "Esta seguro de adicionar las categorias?",
                text: "Ya no podras recuperarlo!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, estoy seguro!",
                cancelButtonText: "No!",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {

					var datos = $('#formularioAddCategoria').serializeArray();

					$.ajax({
						url: "{{ url('Juez/addCategoriaAsignacion') }}",
						data: datos,
						dataType: 'json',
						type: 'POST',
						success: function(data) {

							if(data.status == 'success'){

								Swal.fire({
								    title: "Exito!",
								    text: "Se cambio el estado con exito.",
								    icon: "success",
									timer: 1000
								})

								$('#listaAsignaciones').html(data.listado);

								$('#modalAddCategoria').modal('hide');
								$('#modalAddJuez').modal('show');

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

		function cerrarModalAddCategoria(){

			$('#modalAddCategoria').modal('hide');
			$('#modalAddJuez').modal('show');

		}

    </script>
@endsection
