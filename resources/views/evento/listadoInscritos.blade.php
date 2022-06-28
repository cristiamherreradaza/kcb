@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')

{{-- inicio modal  --}}

<!-- Modal-->
<div class="modal fade" id="modal-inscripcion-edita" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRADO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('Evento/editaInscripcionEjemplarEvento') }}" method="POST" id="formulario-edita-inscripcion">
                	@csrf
                	<div class="row">

                		<div class="col-md-4">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">Nombre Ejemplar
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="nombre" name="nombre" required />
                			    <input type="hidden" id="ejemplarEvento" name="ejemplarEvento"/>
                			    <input type="hidden" id="extranjero" name="extranjero"/>
                			</div>
                		</div>

                		<div class="col-md-4">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">Raza
                			    <span class="text-danger">*</span></label>
								<br>
								<select class="form-control select2" name="raza_id" id="raza_id">
									<option></option>
									@foreach ($razas as $r )
										<option value="{{ $r->id }}">{{ $r->nombre }}</option>
									@endforeach
								</select>
                			</div>
                		</div>

						<div class="col-md-4">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">KCB
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="kcb" name="kcb" />
                			</div>
                		</div>
                	</div>

					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Color
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="color" name="color"  />
                			</div>
						</div>
                        <div class="col-md-4">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Fecha Nacimiento
                			    <span class="text-danger">*</span></label>
                			    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" />
                			</div>
						</div>
                        <div class="col-md-4">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Sexo
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="sexo" name="sexo" />
                			</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Registro Extranjero
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="cod_extranjero" name="cod_extranjero" />
                			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Numero Tatuaje
                			    <span class="text-danger">*</span></label>
                			    <input type="number" class="form-control" id="num_tatuaje" name="num_tatuaje" />
                			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Chip
                			    <span class="text-danger">*</span></label>
                			    <input type="number" class="form-control" id="chip" name="chip" />
                			</div>
						</div>
					</div>

                    <div class="row">
						<div class="col-md-6">
							<div class="form-group">
                			    <label for="exampleInputPassword1">KCB Padre
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="kcb_padre" name="kcb_padre" />
                			</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Nombre Padre
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="nom_padre" name="nom_padre" />
                			</div>
						</div>
					</div>

                    <div class="row">
						<div class="col-md-6">
							<div class="form-group">
                			    <label for="exampleInputPassword1">KCB Madre
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="kcb_madre" name="kcb_madre" />
                			</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Nombre Madre
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="nom_madre" name="nom_madre" />
                			</div>
						</div>
					</div>

                    <div class="row">
						<div class="col-md-4">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Categoria
                			    <span class="text-danger">*</span></label>
								<select class="form-control select2" name="categoria_pista_id" id="categoria_pista_id">
									<option></option>
									@foreach ($categoriasPista as $cp)
										<option value="{{ $cp->id }}">{{ $cp->nombre }}</option>
									@endforeach
								</select>
                			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Criador
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="criador" name="criador" />
                			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Propietario
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="propietario" name="propietario" />
                			</div>
						</div>
					</div>

                    <div class="row">
						<div class="col-md-4">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Ciudad / Pais
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="ciudad" name="ciudad"  />
                			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Telefono
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="telefono" name="telefono" />
                			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Email
                			    <span class="text-danger">*</span></label>
                			    <input type="email" class="form-control" id="email" name="email" required />
                			</div>
						</div>
					</div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                			    <label for="exampleInputPassword1">Estado
                			    <span class="text-danger">*</span></label>
                                <select class="form-control" name="estado" id="estado" >
                                    <option value="Inscrito">Inscrito</option>
                                    <option value="Borrado">No Inscrito</option>
                                </select>
                			</div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-dark font-weight-bold" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success font-weight-bold" onclick="editaInscripcion()">Guardar</button>
            </div>
        </div>
    </div>
</div>
{{-- fin inicio modal  --}}

	<!--begin::Card-->
	<div class="card card-custom gutter-b">
		<div class="card-header flex-wrap py-3">
			<div class="card-title">
				<h3 class="card-label">LISTADOS DE REGISTRADOS - <span class="text-primary"> {{ $evento->nombre }} </span>
				</h3>
			</div>
			<div class="card-toolbar">
				<!--begin::Button-->
				<a href="{{ url('Evento/generaBestingPdf', [$evento->id, "especiales"]) }}" target="_target" class="btn btn-success font-weight-bolder">
					<i class="fa fa-plus-square"></i> Especiales
				</a>
				<!--end::Button-->
				<p style="padding-left: 2px"></p>
				
				<!--begin::Button-->
				<a href="{{ url('Evento/generaBestingPdf', [$evento->id, "absolutos"]) }}" target="_target" class="btn btn-success font-weight-bolder">
					<i class="fa fa-plus-square"></i> Absolutos
				</a>
				<!--end::Button-->
				<p style="padding-left: 2px"></p>
				
				<!--begin::Button-->
				<a href="{{ url('Evento/generaBestingPdf', [$evento->id, "jovenes"]) }}" target="_target" class="btn btn-success font-weight-bolder">
					<i class="fa fa-plus-square"></i> Jovenes
				</a>
				<!--end::Button-->
				<p style="padding-left: 2px"></p>

				<!--begin::Button-->
				<a href="{{ url('Evento/generaBestingPdf', [$evento->id, "adultos"]) }}" target="_target" class="btn btn-success font-weight-bolder">
					<i class="fa fa-plus-square"></i> Adultos
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
							<th>Kbc</th>
							<th>Nombre</th>
							<th>Raza</th>
							<th>Categoria</th>
							<th>Propietario</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($ejemplaresEventos as $ee)
							<tr>
								<td>{{ $ee->id }}</td>
								<td>{{ ($ee->ejemplar)? $ee->ejemplar->kcb: ''}}</td>
								<td>{{ ($ee->ejemplar)? $ee->ejemplar->nombre_completo : $ee->nombre_completo}}</td>
								<td>{{ ($ee->ejemplar)? $ee->ejemplar->raza->nombre : $ee->raza->nombre}}</td>
								<td>{{ $ee->categoriaPista->nombre }}</td>

								<td>
									@php
										if($ee->ejemplar){
											if($ee->ejemplar->propietario != null){
												echo $ee->ejemplar->propietario->name;
											}else{
												echo '';
											}
										}else{
											echo $ee->propietario;
										}

										// if($ee->ejemplar){
										// 	$proTra = App\Transferencia::where('ejemplar_id',$ee->ejemplar->id)
										// 								->where('estado','Actual')
										// 								->first();
										// 	if($proTra){
										// 		echo $proTra->propietario->name;
										// 	}else{
										// 		if($ee->ejemplar->propietario != null){
										// 			echo $ee->ejemplar->propietario->name;
										// 		}else{
										// 			echo '';
										// 		}
										// 	}
										// }else{
										// 	echo $ee->propietario;
										// }

									@endphp
								</td>
								<td>
                                    {{-- <button type="button" class="btn btn-icon btn-warning" onclick="edita('{{ $ee->id }}', '{{ ($ee->ejemplar)? addslashes($ee->ejemplar->nombre_completo) : addslashes($ee->nombre_completo) }}', '{{ ($ee->ejemplar)? $ee->ejemplar->raza->id : $ee->raza->id }}', '{{ ($ee->ejemplar)? $ee->ejemplar->kcb: '' }}', '{{ ($ee->ejemplar)? $ee->ejemplar->color: $ee->color }}', '{{ ($ee->ejemplar)? $ee->ejemplar->fecha_nacimiento: $ee->fecha_nacimiento }}', '{{ ($ee->ejemplar)? $ee->ejemplar->sexo : $ee->sexo }}', '{{ $ee->codigo_nacionalizado }}', '{{ ($ee->ejemplar)? $ee->ejemplar->num_tatuaje : $ee->tatuaje }}', '{{ ($ee->ejemplar)? $ee->ejemplar->chip : $ee->chip }}', '{{ ($ee->ejemplar)? $ee->ejemplar->padre->kcb : $ee->kcb_padre }}', '{{ ($ee->ejemplar)? addslashes($ee->ejemplar->padre->nombre) : addslashes($ee->nombre_padre) }}', '{{ ($ee->ejemplar)? $ee->ejemplar->madre->kcb : $ee->kcb_madre }}', '{{ ($ee->ejemplar)? addslashes($ee->ejemplar->madre->nombre) : addslashes($ee->nombre_madre) }}', '{{ $ee->categoria_pista_id }}', '{{ $ee->criador }}', '{{ ($ee->ejemplar)? addslashes($ee->ejemplar->propietario->name) : addslashes($ee->propietario) }}', '{{ ($ee->ejemplar)? $ee->ejemplar->propietario->departamento : $ee->ciudad }}', '{{ ($ee->ejemplar)? $ee->ejemplar->propietario->celulares : $ee->telefono }}', '{{ ($ee->ejemplar)? $ee->ejemplar->propietario->email : $ee->email }}', '{{ $ee->estado }}', '{{ $ee->extrangero }}' )"> --}}
									<button type="button" class="btn btn-icon btn-warning" onclick="edita('{{ $ee->id }}', '{{ ($ee->ejemplar)? trim(addslashes($ee->ejemplar->nombre_completo)): trim(addslashes($ee->nombre_completo)) }}', '{{ ($ee->ejemplar)? $ee->ejemplar->raza->id : $ee->raza->id }}', '{{ ($ee->ejemplar)? $ee->ejemplar->kcb: '' }}', '{{ ($ee->ejemplar)? $ee->ejemplar->color: $ee->color }}', '{{ ($ee->ejemplar)? $ee->ejemplar->fecha_nacimiento: $ee->fecha_nacimiento }}', '{{ ($ee->ejemplar)? $ee->ejemplar->sexo : $ee->sexo }}', '{{ $ee->codigo_nacionalizado }}', '{{ ($ee->ejemplar)? $ee->ejemplar->num_tatuaje : $ee->tatuaje }}', '{{ ($ee->ejemplar)? $ee->ejemplar->chip : $ee->chip }}', '{{ ($ee->ejemplar)? (($ee->ejemplar->padre)? $ee->ejemplar->padre->kcb : '') : $ee->kcb_padre }}', '{{ ($ee->ejemplar)? (($ee->ejemplar->padre)? addslashes($ee->ejemplar->padre->nombre) : '') : addslashes($ee->nombre_padre) }}', '{{ ($ee->ejemplar)? (($ee->ejemplar->madre)? $ee->ejemplar->madre->kcb : '') : $ee->kcb_madre }}', '{{ ($ee->ejemplar)? (($ee->ejemplar->madre)?  addslashes($ee->ejemplar->madre->nombre) : '') : addslashes($ee->nombre_madre) }}', '{{ $ee->categoria_pista_id }}', '{{ $ee->criador }}', '{{ ($ee->ejemplar)? (($ee->ejemplar->propietario)? addslashes($ee->ejemplar->propietario->name) : '' ) : addslashes($ee->propietario) }}', '{{ ($ee->ejemplar)? (($ee->ejemplar->propietario)? $ee->ejemplar->propietario->departamento : '') : $ee->ciudad }}', '{{ ($ee->ejemplar)? (($ee->ejemplar->propietario)? $ee->ejemplar->propietario->celulares : '') : $ee->telefono }}', '{{ ($ee->ejemplar)? (($ee->ejemplar->propietario)? $ee->ejemplar->propietario->email : '') : $ee->email }}', '{{ $ee->estado }}', '{{ $ee->extrangero }}' )">
                                        <i class="flaticon2-edit"></i>
                                    </button>
									<button type="button" class="btn btn-icon btn-danger" onclick="elimina('{{ $ee->id }}', '{{ ($ee->ejemplar)? trim(addslashes($ee->ejemplar->nombre_completo)) :  trim(addslashes($ee->nombre_completo)) }}')">
										<i class="flaticon2-cross"></i>
									</button>
								</td>
							</tr>
						@empty
							<h3 class="text-danger">NO EXISTEN INSCRITOS</h3>
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

		function edita(id, nombre, raza, kcb, color, fecha_nacimiento, sexo, cod_extrangero, tatuaje, chip, kcb_padre, nom_padre, kcb_madre, nom_madre, cat_pista_id, criador, propietario, ciudad, telefono, email, estado, extranjero)
    	{
			$('#ejemplarEvento').val(id);
			$('#nombre').val(nombre);
			$('#raza_id').val(raza);
			$('#raza_id').trigger('change');
			$('#kcb').val(kcb);
			$('#color').val(color);
			$('#fecha_nacimiento').val(fecha_nacimiento);
			$('#sexo').val(sexo);
			$('#cod_extranjero').val(cod_extrangero);
			$('#num_tatuaje').val(tatuaje);
			$('#chip').val(chip);
			$('#kcb_padre').val(kcb_padre);
			$('#nom_padre').val(nom_padre);
			$('#kcb_madre').val(kcb_madre);
			$('#nom_madre').val(nom_madre);
			$('#categoria_pista_id').val(cat_pista_id);
			$('#categoria_pista_id').trigger('change');
			$('#criador').val(criador);
			$('#propietario').val(propietario);
			$('#ciudad').val(ciudad);
			$('#telefono').val(telefono);
			$('#email').val(email);
			$('#estado').val(estado);
			$('#extranjero').val(extranjero);

            if(kcb != '' && cod_extrangero == ''){
				$("#nombre").prop('disabled', true);
				$("#raza_id").prop('disabled', true);
				$("#kcb").prop('disabled', true);
				$("#color").prop('disabled', true);
				$("#fecha_nacimiento").prop('disabled', true);
				$("#sexo").prop('disabled', true);
				$("#cod_extranjero").prop('disabled', true);
				$("#num_tatuaje").prop('disabled', true);
				$("#chip").prop('disabled', true);
				$("#kcb_padre").prop('disabled', true);
				$("#nom_padre").prop('disabled', true);
				$("#kcb_madre").prop('disabled', true);
				$("#nom_madre").prop('disabled', true);
				// $("#categoria_pista_id").prop('disabled', true);
				$("#criador").prop('disabled', true);
				$("#propietario").prop('disabled', true);
				$("#ciudad").prop('disabled', true);
				// $("#telefono").prop('disabled', true);
				// $("#email").prop('disabled', true);

			}else{
				// alert("vacio");
				$("#nombre").prop('disabled', false);
				$("#raza_id").prop('disabled', false);
				$("#kcb").prop('disabled', false);
				$("#color").prop('disabled', false);
				$("#fecha_nacimiento").prop('disabled', false);
				$("#sexo").prop('disabled', false);
				$("#cod_extranjero").prop('disabled', false);
				$("#num_tatuaje").prop('disabled', false);
				$("#chip").prop('disabled', false);
				$("#kcb_padre").prop('disabled', false);
				$("#nom_padre").prop('disabled', false);
				$("#kcb_madre").prop('disabled', false);
				$("#nom_madre").prop('disabled', false);
				$("#categoria_pista_id").prop('disabled', false);
				$("#criador").prop('disabled', false);
				$("#propietario").prop('disabled', false);
				$("#ciudad").prop('disabled', false);
				$("#telefono").prop('disabled', false);
				$("#email").prop('disabled', false);
			}

    		$("#modal-inscripcion-edita").modal('show');
    	}

    	function editaInscripcion()
    	{
			// verificamos que el formulario este correcto
    		if($("#formulario-edita-inscripcion")[0].checkValidity()){
				// enviamos el formulario
    			$("#formulario-edita-inscripcion").submit();
				// mostramos la alerta
				Swal.fire("Excelente!", "Registro Guardado!", "success");
    		}else{
				// de lo contrario mostramos los errores
				// del formulario
    			$("#formulario-edita-inscripcion")[0].reportValidity()
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

                    window.location.href = "{{ url('Evento/eliminaInscripcion') }}/"+id;

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

        $(function(){
			$('#raza_id').select2({
				placeholder: "Select a state"
			});
		});

		$(function(){
			$('#categoria_pista_id').select2({
				placeholder: "Select a state"
			});
		});

    </script>
@endsection
