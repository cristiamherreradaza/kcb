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
					<h5 class="modal-title" id="exampleModalLabel">FORMULARIO DE USUARIOS</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i aria-hidden="true" class="ki ki-close"></i>
					</button>
				</div>
				<div class="modal-body">
					<form action="{{ url('User/guarda') }}" method="POST" id="formulario-tipos">
						@csrf
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="exampleInputPassword1">Nombre de Usuario
									<span class="text-danger">*</span></label>
									<input type="hidden" class="form-control" id="user_id" name="user_id" />
									<input type="text" class="form-control" id="nombre" name="nombre" required />
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="exampleInputPassword1">Correo
									<span class="text-danger">*</span></label>
									<input type="email" class="form-control" id="correo" name="correo" required />
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group">
									<label for="exampleInputPassword1">Contraseña
									<span class="text-danger">*</span></label>
									<input type="password" class="form-control" id="contrasenia" name="contrasenia" required />
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
									<input type="text" class="form-control" id="cedula" name="cedula" pattern="[0-9]{15}" title="El numero no puede exeder mas de 15 digitos" required />
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="exampleInputPassword1">Genero
									<span class="text-danger">*</span></label>
									<select name="genero" id="genero" class="form-control">
										<option value="">Elija el Genero</option>
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
									<input type="text" class="form-control" id="celular" name="celular" required />
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
									<select name="sucursal" id="sucursal" class="form-control">
										<option value="">Ejija la Sucursal</option>
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="exampleInputPassword1">Perfil
									<span class="text-danger">*</span></label>
									<select name="perfil" id="perfil" class="form-control">
										<option value="">Elija el Perfil</option>p
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
				<h3 class="card-label">LISTA DE USUARIOS
				</h3>
			</div>
			<div class="card-toolbar">
				<!--begin::Button-->
				<a href="#" class="btn btn-primary font-weight-bolder" onclick="nuevo()">
					<i class="fa fa-plus-square"></i> NUEVO USUARIO
				</a>
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
							<th>Email</th>
							<th>Celular</th>
							<th>Cedula</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($usuarios as $u)
							<tr>
								<td>{{ $u->id }}</td>
								<td>{{ $u->name }}</td>
								<td>{{ $u->email }}</td>
								<td>{{ $u->celulares }}</td>
								<td>{{ $u->ci }}</td>
								<td>
									<button type="button" class="btn btn-icon btn-warning" onclick="edita('{{ $u->id }}', '{{ $u->nombre }}', '{{ $u->descripcion }}')">
										<i class="flaticon2-edit"></i>
									</button>
									<button type="button" class="btn btn-icon btn-danger" onclick="elimina('{{ $u->id }}', '{{ $u->nombre }}')">
										<i class="flaticon2-cross"></i>
									</button>
								</td>
							</tr>
						@empty
							<h3 class="text-danger">NO EXISTEN USUARIOS</h3>
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
		function nuevo()
    	{
			// pone los inputs vacios
			$("#user_id").val('');
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
    	{{-- $(document).ready(function() {
    	    $('#tabla_usuarios').DataTable({
				iDisplayLength: 10,
				processing: true,
				serverSide: true,
				ajax: "{{ url('User/ajax_listado') }}",
				"order": [[ 0, "desc" ]],
				columns: [
					{data: 'id', name: 'id'},
					{data: 'name', name: 'name'},
					{data: 'ci', name: 'ci'},
					{data: 'email', name: 'email'},
					{data: 'perfil', name: 'perfil'},
					{data: 'celulares', name: 'celulares'},
					{data: 'action'},
				],
                language: {
                    url: '{{ asset('datatableEs.json') }}'
                }
            });
    	} ); --}}

		function edita(id)
		{
			window.location.href = "{{ url('User/edita') }}/"+id;
		}

		function cuotas(id)
		{
			window.location.href = "{{ url('User/pagos') }}/"+id;
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

    </script>
@endsection