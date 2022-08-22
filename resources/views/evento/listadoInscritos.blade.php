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
                        <div class="col-md-6">
                            <div class="form-group">
                			    <label for="exampleInputPassword1">Estado
                			    <span class="text-danger">*</span></label>
                                <select class="form-control" name="estado" id="estado" >
                                    <option value="Inscrito">Inscrito</option>
                                    <option value="Borrado">No Inscrito</option>
                                </select>
                			</div>
                        </div>
						<div class="col-md-6">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Extrangero
                			    <span class="text-danger">*</span></label>
                                <select class="form-control" name="extrangero" id="extrangero" >
                                    <option value="si">Si</option>
                                    <option value="no">No</option>
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


<!-- Modal NUEVA INSCRIPCION-->
<div class="modal fade" id="modal-inscripcion-agrega" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRO DE NUEVO EJEMPLAR AL EVENTO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('Evento/inscribirEjemplar') }}" method="POST" id="formulario_nueva_inscripcion">
                	@csrf
					<input type="hidden" name="inscribe_ejemplar_id" id="inscribe_ejemplar_id">
					<input type="hidden" name="inscribe_evento_id" id="inscribe_evento_id" value="{{ $evento->id }}">
					<input type="hidden" name="inscribe_extranjero" id="inscribe_extranjero" value="no">

					<div class="form-group">
						<label>Tipo de ejemplar</label>
						<div class="radio-inline">
							<label class="radio radio-lg">
								<input type="radio" checked="checked" name="radios3_1" value="nacional" onchange="tipoEjemplar(this)"/>
								<span></span>
								Nacional
							</label>
							<label class="radio radio-lg">
								<input type="radio" name="radios3_1" value="extranjero"  onchange="tipoEjemplar(this)"/>
								<span></span>
								Extranjero
							</label>
						</div>
						<span class="form-text text-muted">Elija el tipo de ejemplar</span>
					</div>


                	<div class="row">
						<div class="col-md-2">
							<div id="bloque_busca_kcb">
								<div class="form-group">
									<label for="exampleInputPassword1">KCB
									<span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="inscribe_kcb" name="inscribe_kcb" onblur="buscaEjemplar()" />
								</div>
							</div>
							<div id="bloque_busca_codigo" style="display: none;">
								<div class="form-group">
									<label for="exampleInputPassword1">CODIGO
									<span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="inscribe_codigo_extranjero" name="inscribe_codigo_extranjero" onblur="buscaExtranjero()" />
								</div>
							</div>
                		</div>
						<div class="col-md-2">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">NUMERO
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="inscribe_numero_prefijo" name="inscribe_numero_prefijo" placeholder="5J"/>
                			</div>
                		</div>

                		<div class="col-md-4">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">Nombre Ejemplar
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="inscribe_nombre" name="inscribe_nombre" required />
                			</div>
                		</div>

                		<div class="col-md-4">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">Raza
                			    <span class="text-danger">*</span></label>
								<br>
								<select class="form-control select2" name="inscribe_raza_id" id="inscribe_raza_id" style="width: 100%">
									<option></option>
									@foreach ($razas as $r )
										<option value="{{ $r->id }}">{{ $r->nombre }}</option>
									@endforeach
								</select>
                			</div>
                		</div>

                	</div>

					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Color
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="inscribe_color" name="inscribe_color"  />
                			</div>
						</div>
                        <div class="col-md-4">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Fecha Nacimiento
                			    <span class="text-danger">*</span></label>
                			    <input type="date" class="form-control" id="inscribe_fecha_nacimiento" name="inscribe_fecha_nacimiento" />
                			</div>
						</div>
                        <div class="col-md-4">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Sexo
                			    <span class="text-danger">*</span></label>
								<select name="inscribe_sexo" id="inscribe_sexo" class="form-control">
									<option value="Macho">Macho</option>
									<option value="Hembra">Hembra</option>
								</select>
                			    {{-- <input type="text" class="form-control" id="inscribe_sexo" name="inscribe_sexo" /> --}}
                			</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Registro Extranjero
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="inscribe_cod_extranjero" name="inscribe_cod_extranjero" />
                			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Numero Tatuaje
                			    <span class="text-danger">*</span></label>
                			    <input type="number" class="form-control" id="inscribe_num_tatuaje" name="inscribe_num_tatuaje" />
                			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Chip
                			    <span class="text-danger">*</span></label>
                			    <input type="number" class="form-control" id="inscribe_chip" name="inscribe_chip" />
                			</div>
						</div>
					</div>

                    <div class="row">
						<div class="col-md-6">
							<div class="form-group">
                			    <label for="exampleInputPassword1">KCB Padre
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="inscribe_kcb_padre" name="inscribe_kcb_padre" />
                			</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Nombre Padre
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="inscribe_nom_padre" name="inscribe_nom_padre" />
                			</div>
						</div>
					</div>

                    <div class="row">
						<div class="col-md-6">
							<div class="form-group">
                			    <label for="exampleInputPassword1">KCB Madre
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="inscribe_kcb_madre" name="inscribe_kcb_madre" />
                			</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Nombre Madre
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="inscribe_nom_madre" name="inscribe_nom_madre" />
                			</div>
						</div>
					</div>

                    <div class="row">
						<div class="col-md-4">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Categoria
                			    <span class="text-danger">*</span></label>
								<select class="form-control select2" name="inscribe_categoria_pista_id" id="inscribe_categoria_pista_id" style="width: 100%" required>
									<option></option>
									@foreach ($categoriasPista as $cp)
										<option value="{{ $cp->id }}">{{ $cp->nombre }}</option>
									@endforeach
								</select>
                			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Propietario
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="inscribe_propietario" name="inscribe_propietario" />
                			</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Ciudad / Pais
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="inscribe_ciudad" name="inscribe_ciudad"  />
                			</div>
						</div>
					</div>

                    <div class="row">
						<div class="col-md-6">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Telefono
                			    <span class="text-danger">*</span></label>
                			    <input type="text" class="form-control" id="inscribe_telefono" name="inscribe_telefono" />
                			</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
                			    <label for="exampleInputPassword1">Email
                			    <span class="text-danger">*</span></label>
                			    <input type="email" class="form-control" id="inscribe_email" name="inscribe_email" required />
                			</div>
						</div>
					</div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-dark font-weight-bold" data-dismiss="modal">Cerrar</button>
                <button type="button" onclick="agregarEjemplarEvento()" class="btn btn-success font-weight-bold" onclick="">Guardar</button>
            </div>
        </div>
    </div>
</div>
{{-- fin inicio modal END NUEVA INSCRIPCION  --}}

	<!--begin::Card-->
	<div class="card card-custom gutter-b">
		<div class="card-header flex-wrap py-3">
			<div class="card-title">
				<h3 class="card-label">LISTADOS DE REGISTRADOS - <span class="text-primary"> {{ $evento->nombre }} </span>
				</h3>
			</div>
			<div class="card-toolbar">
				<!--begin::Button-->

				<!--begin::Button-->
				<button onclick="agregarEjeplarModal()" class="btn btn-info font-weight-bolder"><i class="fa fa-plus-square"></i> Nueva Inscripcion</button>
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
							<th>Sexo</th>
							<th>Grupo</th>
							<th>Categoria</th>
							<th>Propietario</th>
							<th>Numero</th>
							<th>Carnet</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($ejemplaresEventos as $ee)
							{{-- @dd($ee) --}}
							<tr>
								<td>{{ $ee->id }}</td>
								<td>{{ ($ee->ejemplar)? $ee->ejemplar->kcb: ''}}</td>
								<td>{{ ($ee->ejemplar)? $ee->ejemplar->nombre_completo : $ee->nombre_completo}}</td>
								<td>{{ ($ee->ejemplar)? $ee->ejemplar->raza->nombre : $ee->raza->nombre}}</td>
								<td>{{ ($ee->ejemplar)? $ee->ejemplar->sexo : $ee->sexo}}</td>
								<td>
									@php
										$grupo = App\EjemplarEvento::getGrupo($ee->raza_id);

										echo ($grupo)? "Grupo ".$grupo->grupo_id : '' ;
									@endphp
								</td>
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

									@endphp
								</td>
								<td>
									{{ $ee->numero_prefijo }}
								</td>
								<td>
									@if ($ee->carnet != null)
										<h6 class="text-success">Yes!</h6>
										{{-- <a href="{{ url('imagenesCarnet/'.$ee->carnet) }}" download>
											<img src="{{ url('imagenesCarnet/'.$ee->carnet) }}" alt="" width="80px">
										</a> --}}
									@else
										<h6 class="text-danger">No tiene carnet</h6>
									@endif
								</td>
								<td>
									<button type="button" class="btn btn-icon btn-warning" onclick="edita('{{ $ee->id }}', '{{ ($ee->ejemplar)? trim(addslashes($ee->ejemplar->nombre_completo)): trim(addslashes($ee->nombre_completo)) }}', '{{ ($ee->ejemplar)? $ee->ejemplar->raza->id : $ee->raza->id }}', '{{ ($ee->ejemplar)? $ee->ejemplar->kcb: '' }}', '{{ ($ee->ejemplar)? $ee->ejemplar->color: $ee->color }}', '{{ ($ee->ejemplar)? $ee->ejemplar->fecha_nacimiento: $ee->fecha_nacimiento }}', '{{ ($ee->ejemplar)? $ee->ejemplar->sexo : $ee->sexo }}', '{{ $ee->codigo_nacionalizado }}', '{{ ($ee->ejemplar)? $ee->ejemplar->num_tatuaje : $ee->tatuaje }}', '{{ ($ee->ejemplar)? $ee->ejemplar->chip : $ee->chip }}', '{{ ($ee->ejemplar)? (($ee->ejemplar->padre)? $ee->ejemplar->padre->kcb : '') : $ee->kcb_padre }}', '{{ ($ee->ejemplar)? (($ee->ejemplar->padre)? addslashes($ee->ejemplar->padre->nombre) : '') : addslashes($ee->nombre_padre) }}', '{{ ($ee->ejemplar)? (($ee->ejemplar->madre)? $ee->ejemplar->madre->kcb : '') : $ee->kcb_madre }}', '{{ ($ee->ejemplar)? (($ee->ejemplar->madre)?  addslashes($ee->ejemplar->madre->nombre) : '') : addslashes($ee->nombre_madre) }}', '{{ $ee->categoria_pista_id }}', '{{ addslashes($ee->criador) }}', '{{ ($ee->ejemplar)? (($ee->ejemplar->propietario)? addslashes($ee->ejemplar->propietario->name) : '' ) : addslashes($ee->propietario) }}', '{{ ($ee->ejemplar)? (($ee->ejemplar->propietario)? $ee->ejemplar->propietario->departamento : '') : $ee->ciudad }}', '{{ ($ee->ejemplar)? (($ee->ejemplar->propietario)? $ee->ejemplar->propietario->celulares : '') : $ee->telefono }}', '{{ ($ee->ejemplar)? (($ee->ejemplar->propietario)? $ee->ejemplar->propietario->email : '') : $ee->email }}', '{{ $ee->estado }}', '{{ $ee->extrangero }}' )">
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

		$( document ).ready(function() {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		});

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
			$('#extrangero').val(extranjero);
			

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
			$('#categoria_pista_id, #inscribe_raza_id, #inscribe_categoria_pista_id').select2({
				placeholder: "seleccion"
			});
		});

		function agregarEjeplarModal(){

			// console.log("holas");
			$('#modal-inscripcion-agrega').modal('show');

		}

		function buscaEjemplar(){

			let kcb = $("#inscribe_kcb").val();

			if(kcb != ''){

				// alert("vacio");
				$.ajax({
					url: "{{ url('Evento/ajaxBuscaEjemplar') }}",
					data: {
					kcb: kcb
					},
					type: "POST",
					success: function(data) {

						//convertimos la respuesta para poder trabajar
						let ejemplar = JSON.parse(data);

						if(!$.isEmptyObject(ejemplar)){

							$('#inscribe_ejemplar_id').val(ejemplar.id);
							$('#inscribe_nombre').val(ejemplar.nombre_completo);
							$('#inscribe_raza_id').val(ejemplar.raza_id);
							$('#inscribe_raza_id').trigger('change');
							$('#inscribe_color').val(ejemplar.color);
							$('#inscribe_fecha_nacimiento').val(ejemplar.fecha_nacimiento);
							$('#inscribe_sexo').val(ejemplar.sexo);
							$('#inscribe_chip').val(ejemplar.chip);
							$('#inscribe_cod_extranjero').val(ejemplar.codigo_nacionalizado);
							$('#inscribe_num_tatuaje').val(ejemplar.num_tatuaje);
							$('#inscribe_kcb_padre').val(ejemplar.kcb_padre);
							$('#inscribe_nom_padre').val(ejemplar.nombre_padre);
							$('#inscribe_kcb_madre').val(ejemplar.kcb_madre);
							$('#inscribe_nom_madre').val(ejemplar.nombre_madre);
							$('#inscribe_propietario').val(ejemplar.nom_propietario);
							$('#inscribe_ciudad').val(ejemplar.departamento);
							$('#inscribe_telefono').val(ejemplar.celulares);
							$('#inscribe_email').val(ejemplar.email);
							$("#inscribe_nombre").prop('readonly', true);
							$("#inscribe_raza_id").prop('disabled', true);
							$("#inscribe_color").prop('readonly', true);
							$("#inscribe_fecha_nacimiento").prop('readonly', true);
							$("#inscribe_sexo").prop('readonly', true);
							$("#inscribe_chip").prop('readonly', true);
							$("#inscribe_cod_extranjero").prop('readonly', true);
							$("#inscribe_num_tatuaje").prop('readonly', true);
							$("#inscribe_kcb_padre").prop('readonly', true);
							$("#inscribe_nom_padre").prop('readonly', true);
							$("#inscribe_kcb_madre").prop('readonly', true);
							$("#inscribe_nom_madre").prop('readonly', true);
							$("#inscribe_propietario").prop('readonly', true);
							$("#inscribe_ciudad").prop('readonly', true);

						}else{

							$('#inscribe_ejemplar_id').val(0);
							$('#inscribe_nombre').val('');
							$('#inscribe_raza_id').val('');
							$('#inscribe_raza_id').trigger('change');
							$('#inscribe_color').val('');
							$('#inscribe_fecha_nacimiento').val('');
							$('#inscribe_sexo').val('');
							$('#inscribe_chip').val('');
							$('#inscribe_cod_extranjero').val('');
							$('#inscribe_num_tatuaje').val('');
							$('#inscribe_kcb_padre').val('');
							$('#inscribe_nom_padre').val('');
							$('#inscribe_kcb_madre').val('');
							$('#inscribe_nom_madre').val('');
							$('#inscribe_propietario').val('');
							$('#inscribe_ciudad').val('');
							$('#inscribe_telefono').val('');
							$('#inscribe_email').val('');
							$("#inscribe_nombre").prop('readonly', false);
							$("#inscribe_raza_id").prop('disabled', false);
							$("#inscribe_color").prop('readonly', false);
							$("#inscribe_fecha_nacimiento").prop('readonly', false);
							$("#inscribe_sexo").prop('readonly', false);
							$("#inscribe_chip").prop('readonly', false);
							$("#inscribe_cod_extranjero").prop('readonly', false);
							$("#inscribe_num_tatuaje").prop('readonly', false);
							$("#inscribe_kcb_padre").prop('readonly', false);
							$("#inscribe_nom_padre").prop('readonly', false);
							$("#inscribe_kcb_madre").prop('readonly', false);
							$("#inscribe_nom_madre").prop('readonly', false);
							$("#inscribe_propietario").prop('readonly', false);
							$("#inscribe_ciudad").prop('readonly', false);

						}
					}
				});

			}else{

				$("#msg-vacio-kcb").show();

			}

		}

		function agregarEjemplarEvento(){

			if($('#formulario_nueva_inscripcion')[0].checkValidity()){

				$('#formulario_nueva_inscripcion').submit();

			}else{
				$('#formulario_nueva_inscripcion')[0].reportValidity();
			}

		}

		function tipoEjemplar(radio){

			if(radio.value == 'nacional'){
				$('#bloque_busca_kcb').show('toogle');
				$('#bloque_busca_codigo').hide('toogle');
				$('#inscribe_extranjero').val('no')
			}else{
				$('#bloque_busca_codigo').show('toogle');
				$('#bloque_busca_kcb').hide('toogle');
				$('#inscribe_extranjero').val('si')
			}

			// SETEABNDO LOS CAMPOS
			$('#inscribe_ejemplar_id').val(0);
			$('#inscribe_nombre').val('');
			$('#inscribe_raza_id').val('');
			$('#inscribe_raza_id').trigger('change');
			$('#inscribe_color').val('');
			$('#inscribe_fecha_nacimiento').val('');
			$('#inscribe_sexo').val('');
			$('#inscribe_chip').val('');
			$('#inscribe_cod_extranjero').val('');
			$('#inscribe_num_tatuaje').val('');
			$('#inscribe_kcb_padre').val('');
			$('#inscribe_nom_padre').val('');
			$('#inscribe_kcb_madre').val('');
			$('#inscribe_nom_madre').val('');
			$('#inscribe_propietario').val('');
			$('#inscribe_ciudad').val('');
			$('#inscribe_telefono').val('');
			$('#inscribe_email').val('');
			$("#inscribe_nombre").prop('readonly', false);
			$("#inscribe_raza_id").prop('disabled', false);
			$("#inscribe_color").prop('readonly', false);
			$("#inscribe_fecha_nacimiento").prop('readonly', false);
			$("#inscribe_sexo").prop('readonly', false);
			$("#inscribe_chip").prop('readonly', false);
			$("#inscribe_cod_extranjero").prop('readonly', false);
			$("#inscribe_num_tatuaje").prop('readonly', false);
			$("#inscribe_kcb_padre").prop('readonly', false);
			$("#inscribe_nom_padre").prop('readonly', false);
			$("#inscribe_kcb_madre").prop('readonly', false);
			$("#inscribe_nom_madre").prop('readonly', false);
			$("#inscribe_propietario").prop('readonly', false);
			$("#inscribe_ciudad").prop('readonly', false);

		}

		function buscaExtranjero(radio){
			
			let codigo = $("#inscribe_codigo_extranjero").val();

			if(codigo != ''){

				// alert("vacio");
				$.ajax({
					url: "{{ url('Evento/buscaExtranjero') }}",
					data: {
					codigo: codigo
					},
					type: "POST",
					dateType: 'json',
					success: function(data) {

						if(data.status == 'success'){

							$('#inscribe_ejemplar_id').val(data.ejemplar.id);
							$('#inscribe_nombre').val(data.ejemplar.nombre_completo);
							$('#inscribe_raza_id').val(data.ejemplar.raza_id);
							$('#inscribe_raza_id').trigger('change');
							$('#inscribe_color').val(data.ejemplar.color);
							$('#inscribe_fecha_nacimiento').val(data.ejemplar.fecha_nacimiento);
							$('#inscribe_sexo').val(data.ejemplar.sexo);
							$('#inscribe_chip').val(data.ejemplar.chip);
							$('#inscribe_cod_extranjero').val(data.ejemplar.codigo_nacionalizado);
							$('#inscribe_num_tatuaje').val(data.ejemplar.num_tatuaje);
							$('#inscribe_kcb_padre').val(data.ejemplar.kcb_padre);
							$('#inscribe_nom_padre').val(data.ejemplar.nombre_padre);
							$('#inscribe_kcb_madre').val(data.ejemplar.kcb_madre);
							$('#inscribe_nom_madre').val(data.ejemplar.nombre_madre);
							$('#inscribe_propietario').val(data.ejemplar.nom_propietario);
							$('#inscribe_ciudad').val(data.ejemplar.departamento);
							$('#inscribe_telefono').val(data.ejemplar.celulares);
							$('#inscribe_email').val(data.ejemplar.email);
							$("#inscribe_nombre").prop('readonly', true);
							$("#inscribe_raza_id").prop('disabled', true);
							$("#inscribe_color").prop('readonly', true);
							$("#inscribe_fecha_nacimiento").prop('readonly', true);
							$("#inscribe_sexo").prop('readonly', true);
							$("#inscribe_chip").prop('readonly', true);
							$("#inscribe_cod_extranjero").prop('readonly', true);
							$("#inscribe_num_tatuaje").prop('readonly', true);
							$("#inscribe_kcb_padre").prop('readonly', true);
							$("#inscribe_nom_padre").prop('readonly', true);
							$("#inscribe_kcb_madre").prop('readonly', true);
							$("#inscribe_nom_madre").prop('readonly', true);
							$("#inscribe_propietario").prop('readonly', true);
							$("#inscribe_ciudad").prop('readonly', true);


						}else{

							$('#inscribe_ejemplar_id').val(0);
							$('#inscribe_nombre').val('');
							$('#inscribe_raza_id').val('');
							$('#inscribe_raza_id').trigger('change');
							$('#inscribe_color').val('');
							$('#inscribe_fecha_nacimiento').val('');
							$('#inscribe_sexo').val('');
							$('#inscribe_chip').val('');
							$('#inscribe_cod_extranjero').val('');
							$('#inscribe_num_tatuaje').val('');
							$('#inscribe_kcb_padre').val('');
							$('#inscribe_nom_padre').val('');
							$('#inscribe_kcb_madre').val('');
							$('#inscribe_nom_madre').val('');
							$('#inscribe_propietario').val('');
							$('#inscribe_ciudad').val('');
							$('#inscribe_telefono').val('');
							$('#inscribe_email').val('');
							$("#inscribe_nombre").prop('readonly', false);
							$("#inscribe_raza_id").prop('disabled', false);
							$("#inscribe_color").prop('readonly', false);
							$("#inscribe_fecha_nacimiento").prop('readonly', false);
							$("#inscribe_sexo").prop('readonly', false);
							$("#inscribe_chip").prop('readonly', false);
							$("#inscribe_cod_extranjero").prop('readonly', false);
							$("#inscribe_num_tatuaje").prop('readonly', false);
							$("#inscribe_kcb_padre").prop('readonly', false);
							$("#inscribe_nom_padre").prop('readonly', false);
							$("#inscribe_kcb_madre").prop('readonly', false);
							$("#inscribe_nom_madre").prop('readonly', false);
							$("#inscribe_propietario").prop('readonly', false);
							$("#inscribe_ciudad").prop('readonly', false);

						}

					}
				});

			}else{

				$("#msg-vacio-kcb").show();

			}

		}

    </script>
@endsection
