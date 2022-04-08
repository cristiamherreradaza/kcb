@extends('layouts.app')

@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
	{{-- inicio modal  --}}
	<!-- Modal-->
	<div class="modal fade" id="modalGrupo" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">FORMULARIO DE USUARIOS</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i aria-hidden="true" class="ki ki-close"></i>
					</button>
				</div>
				<div class="modal-body">
						<form action="{{ url('User/guarda') }}" method="POST" id="formulario-usuarios">
							@csrf
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label for="exampleInputPassword1">Nombre de Usuario
										<span class="text-danger">*</span></label>
										<input type="hidden" class="form-control" id="user_id" name="user_id" />
										<input type="text" class="form-control" id="name" name="name" required />
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label for="exampleInputPassword1">Correo
										<span class="text-danger">*</span></label>
										<input type="email" class="form-control" id="email" name="email" required />
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<label for="exampleInputPassword1">Contraseña
										<span class="text-danger">*</span></label>
										<input type="password" class="form-control" id="password" name="password" required />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="exampleInputPassword1">Fecha de Nacimiento
										<span class="text-danger">*</span></label>
										<input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required />
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="exampleInputPassword1">Cedula
										<span class="text-danger">*</span></label>
										<input type="number" class="form-control" id="ci" name="ci" title="El numero no puede exeder mas de 15 digitos" required />
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="exampleInputPassword1">Genero
										<span class="text-danger">*</span></label>
										<select name="genero" id="genero" class="form-control">
											<option value="Masculino">Masculino</option>
											<option value="Femenino">Femenino</option>
											<option value="Otros">Otros</option>
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="exampleInputPassword1">Celular
										<span class="text-danger">*</span></label>
										<input type="text" class="form-control" id="celulares" name="celulares" required />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label for="exampleInputPassword1">Direccion
										<span class="text-danger">*</span></label>
										<input type="text" class="form-control" id="direccion" name="direccion" required />
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="exampleInputPassword1">Sucursal
										<span class="text-danger">*</span></label>
										<select name="sucursal_id" id="sucursal_id" class="form-control">
											@forelse ($sucursales as $s)
												<option value="{{ $s->id }}">{{ $s->nombre }}</option>
											@empty
												NO existen sucursales
											@endforelse
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="exampleInputPassword1">Perfil
										<span class="text-danger">*</span></label>
										<select name="perfil_id" id="perfil_id" class="form-control">
											@forelse ($perfiles as $p)
												<option value="{{ $p->id }}">{{ $p->nombre }}</option>p
											@empty
												No existen perfiles
											@endforelse
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="exampleInputPassword1">Socio
										<span class="text-danger">*</span></label>
										<select name="socio" id="socio" class="form-control">
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
				<h3 class="card-label">LISTA DE PROPIETARIOS
				</h3>
			</div>
			<div class="card-toolbar">
				<!--begin::Button-->
				<a href="#" class="btn btn-primary font-weight-bolder" onclick="nuevo()">
					<i class="fa fa-plus-square"></i> NUEVO PROPIETARIO
				</a>
				&nbsp;
				<a href="#" class="btn btn-success btn-icon font-weight-bolder" onclick="muestraBarra();">
					<i class="fas fa-search"></i> </a>
				<!--end::Button-->
			</div>
		</div>

		<div class="card-body">
			<div id="barra-busqueda" style="display: none">
				<form action="{{ url('User/ajaxListadoPropietarios') }}" method="POST" id="formulario-busqueda-usuarios">
					@csrf
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputPassword1">Nombre
									<span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="nombre_buscar" name="nombre_buscar" />
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputPassword1">Cedula
									<span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="cedula_buscar" name="cedula_buscar" />
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="exampleInputPassword1">&nbsp;</label>
								<button type="button" class="btn btn-success btn-block" onclick="buscarPropietario()">BUSCAR</button>
							</div>
						</div>

					</div>
				</form>
			</div>
			<!--begin: Datatable-->
			{{-- <div class="table-responsive m-t-40" id=""> --}}
			<div  id="ajaxPropietarios">

			</div>
			<!--end: Datatable-->
		</div>
	</div>
	<!--end::Card-->
@stop

@section('js')

    <script type="text/javascript">

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$(function () {
			// funcion para llamar a los datos iniciales de la tabla
			let datosBusquda = $('#formulario-busqueda-usuarios').serializeArray();

			$.ajax({
				url: "{{ url('User/ajaxListadoPropietarios') }}",
				data: datosBusquda,
				type: 'POST',
				success: function(data) {
					$('#ajaxPropietarios').html(data);
				}
			});

    	});

		function crear()
		{
			if($('#formulario-usuarios')[0].checkValidity()){
				$('#formulario-usuarios').submit();
			}else{
				$('#formulario-usuarios')[0].reportValidity()
			}
		}

		function nuevo()
    	{
			window.location.href = "{{ url('User/formularioPropietario') }}/0";
    	}

		function edita(id)
		{
			window.location.href = "{{ url('User/formularioPropietario') }}/"+id;
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
                    window.location.href = "{{ url('User/eliminaPropietario') }}/"+id;
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
		//lista de criaderos
		function listaCriadero(id){
			window.location.href = "{{ url('User/listadoCriadero') }}/"+id;
		}

		function buscarPropietario()
		{

			let datosBusquda = $('#formulario-busqueda-usuarios').serializeArray();

			$.ajax({
				url: "{{ url('User/ajaxListadoPropietarios') }}",
				data: datosBusquda,
				type: 'POST',
				success: function(data) {
					$('#ajaxPropietarios').html(data);
				}
			});

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
