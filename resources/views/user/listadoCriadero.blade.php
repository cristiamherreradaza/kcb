@extends('layouts.app')

@section('metadatos')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')

	{{-- inicio modal  --}}
	<!-- Modal-->
	<div class="modal fade" id="modal-registro-criadero" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">AGREGAR UN NUEVO CRIADERO</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i aria-hidden="true" class="ki ki-close"></i>
					</button>
				</div>
				<div class="modal-body">
					<form action="{{ url('Criadero/guardaCriaderoNuevoPropietario') }}" method="POST" id="formulario-agrega-criadero-nuevo-propietario">
						@csrf
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="exampleInputPassword1">Propietario
									<span class="text-danger">*</span></label>
									{{-- <input type="text" class="form-control" id="criadero_id" name="criadero_id"/> --}}
									<select class="form-control" id="propietario_id" name="propietario_id" required >
										<option value="{{ $propietario->id }}">{{ $propietario->name }}</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="exampleInputPassword1">Co-Propietario
									<span class="text-danger">*</span></label>
									<div id="select-copropietario">
										<select class="form-control select2" id="copropietario_id" name="copropietario_id" required >
											<option label="Label"></option>
										</select>    
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="exampleInputPassword1">Nombre</label>
									<input type="text" class="form-control" id="nombre" name="nombre"  required  />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="exampleInputPassword1">Registro FCI
									<span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="registro_fci" name="registro_fci" required  />
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="exampleInputPassword1">Departamento
									<span class="text-danger">*</span></label>
									<select name="departamento" id="departamento" class="form-control"  required >
										<option value="La Paz">La Paz</option>
										<option value="Oruro" >Oruro</option>
										<option value="Potosi" >Potosi</option>
										<option value="Cochabamba" >Cochabamba</option>
										<option value="Chuquisaca" >Chuquisaca</option>
										<option value="Tarija" >Tarija</option>
										<option value="Pando" >Pando</option>
										<option value="Beni" >Beni</option>
										<option value="Santa Cruz">Santa Cruz</option>
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="exampleInputPassword1">Fecha
									<span class="text-danger">*</span></label>
									<input type="date" class="form-control" name="fecha" id="fecha" required >
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="exampleInputPassword1">Modalidad de Ingreso
									<span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="modalidad_ingreso" name="modalidad_ingreso"   required />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="exampleInputPassword1">Direccion
									<span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="direccion" name="direccion"  required  />
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="exampleInputPassword1">Celulares
									<span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="celulares" name="celulares"  required  />
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="exampleInputPassword1">Pagina Web
									{{-- <span class="text-danger">*</span></label> --}}
									<input type="text" class="form-control" id="pagina_web" name="pagina_web"  />
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="exampleInputPassword1">Email
										<span class="text-danger">*</span></label>
									<input type="email" class="form-control" id="email" name="email"  />
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-light-dark font-weight-bold" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-sm btn-success font-weight-bold" onclick="agregarProtietarioCriadero()">Guardar</button>
				</div>
			</div>
		</div>
	</div> 
	{{-- fin inicio modal  --}}

	{{-- inicio modal  --}}
	<!-- Modal-->
	<div class="modal fade" id="modal-agregar-criadero" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">AGREGAR UN NUEVO CRIADERO</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i aria-hidden="true" class="ki ki-close"></i>
					</button>
				</div>
				<div class="modal-body">
					<form action="{{ url('Criadero/guardaCriaderoPropietario') }}" method="POST" id="formulario-agrega-criadero-propietario">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="exampleInputPassword1">Propietario
									<span class="text-danger">*</span></label>
									<select name="propietario_id" id="propietario_id" class="form-control" required>
										<option value="{{ $propietario->id }}">{{ $propietario->name }}</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputPassword1">Criadero
									<span class="text-danger">*</span></label>
									<input type="hidden" id="criadero_id" name="criadero_id">
									<input type="text" class="form-control" id="criadero" name="criadero" required disabled/>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputPassword1">Buscar Criadero por Nombre
										<span class="text-danger">*</span>
										<span class="label label-success label-inline font-weight-normal mr-2" onclick="registroNuevoCriadero()">NUEVO</span>
									</label>
									<input type="text" class="form-control" id="busca-criadero-nombre" name="busca-criadero-nombre" />
									<span class="form-text text-danger" id="msg-error-criadero" style="display: none;">Debe seleccionar un Criadero</span>
								</div>
							</div>
						</div>
					</form>
					<div class="row">
						<div class="col-md-12">
							<div id="bloqueCriadero">

							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-light-dark font-weight-bold" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-sm btn-success font-weight-bold" onclick="agregarEjemplarCriadero()">Guardar</button>
				</div>
			</div>
		</div>
	</div> 
	{{-- fin inicio modal  --}}

	<!--begin::Card-->
	<div class="card card-custom gutter-b">
		<div class="card-header flex-wrap py-3">
			<div class="card-title">
				<h3 class="card-label">LISTA DE CRIADEROS DEL PROPIETARIO <span class="text-primary">{{ $propietario->name }}</span>
				</h3>
			</div>
			<div class="card-toolbar">
				<!--begin::Button-->
				<a href="#" class="btn btn-primary font-weight-bolder" onclick="nuevo()">
					<i class="fa fa-plus-square"></i> NUEVO CRIADERO
				</a>
				&nbsp;
				<a href="#" class="btn btn-success btn-icon font-weight-bolder" onclick="muestraBarra();">
					<i class="fas fa-search"></i> </a>
				<!--end::Button-->
			</div>
		</div>
		
		<div class="card-body">
			<!--begin: Datatable-->
			<div class="table-responsive m-t-40">
                <table class="table table-bordered table-hover table-striped" id="tabla_usuarios">
                    <thead>
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Regsitro FCI</th>
							<th>Departamento</th>
							<th>Fecha</th>
							<th>Modalidad</th>
							<th>Direccion</th>
							<th>Celulares</th>
							<th>Pagina Web</th>
							<th>Email</th>
							{{--  <th>Observaciones</th>  --}}
							{{-- <th>Actions</th> --}}
						</tr>
					</thead>
                    <tbody>
                        @forelse ($criaderos as $cri )
                            <tr>
                                <td>{{ $cri->id}}</td>
                                <td>{{ $cri->criadero->nombre }}</td>
                                <td>{{ $cri->criadero->registro_fci}}</td>
                                <td>{{ $cri->criadero->departamento}}</td>
                                <td>{{ $cri->criadero->fecha}}</td>
                                <td>{{ $cri->criadero->modalidad_ingreso}}</td>
                                <td>{{ $cri->criadero->direccion}}</td>
                                <td>{{ $cri->criadero->celulares}}</td>
                                <td>{{ $cri->criadero->pagina_web}}</td>
                                <td>{{ $cri->criadero->email}}</td>
                                {{--  <td>{{ $cri->observacion}}</td>  --}}
                                {{-- <td></td> --}}
                            </tr>
                        @empty
                            No TIENE CRIADEROS
                        @endforelse
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
			$('#tabla_usuarios').DataTable({
				language: {
					url: '{{ asset('datatableEs.json') }}'
				},
			});

    	});

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		function nuevo()
    	{

			$("#modal-agregar-criadero").modal('show');
			// alert("En desarrollo :v");
			// window.location.href = "{{ url('User/formulario') }}/0";
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
                    window.location.href = "{{ url('User/elimina') }}/"+id;
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

		$("#busca-criadero-nombre").on("paste keyup", function() {

			let nombre = $("#busca-criadero-nombre").val();

			$.ajax({
				url: "{{ url('Criadero/ajaxBuscaCriaderoPropietario') }}",
				data:{
					nombre:nombre
				},
				type: 'POST',
				success: function(data) {
					$("#bloqueCriadero").html(data);
				}
			});
		});

		function agregarEjemplarCriadero(){
			if($("#criadero").val() != '' ){
				$('#formulario-agrega-criadero-propietario').submit();
			}else{
				$("#msg-error-criadero").show();
			}
		}

		function registroNuevoCriadero(){
			$("#modal-agregar-criadero").modal('hide');
			$("#modal-registro-criadero").modal('show');
			// alert("en desarrollo :v");
		}

		$("#copropietario_id").select2({
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

		function agregarProtietarioCriadero(){
			if($('#formulario-agrega-criadero-nuevo-propietario')[0].checkValidity()){
				$('#formulario-agrega-criadero-nuevo-propietario').submit();
				Swal.fire("Excelente!", "Ejemplar Guardado!", "success");
			}else{
				$('#formulario-agrega-criadero-nuevo-propietario')[0].reportValidity()
			}
			// alert("en desarrollo :v");
		}

		function muestraBarra(){
			var this_item = document.getElementById('barra-busqueda'); 
			if( this_item.style.display == 'block' ) {
				this_item.style.display = 'none';
			}
			else {
				this_item.style.display = 'block';
			}
		}
	
    </script>
@endsection