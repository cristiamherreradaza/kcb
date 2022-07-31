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
	<div class="modal fade" id="modalNuevoSecretario" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">FORMULARIO DE SECRETARIO</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i aria-hidden="true" class="ki ki-close"></i>
					</button>
				</div>
				<div class="modal-body">
					<form action="{{ url('User/guardaSecretario') }}" method="POST" id="formularioSecretario" enctype="multipart/form-data">
                        <input type="hidden" value="0" name="secretario_id" id="secretario_id">
						@csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nombre
                                    <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nombre" name="nombre">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Correo
                                    <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="correo" name="correo" onfocusout="validaEmail()">
									<span class="form-text text-danger" id="msg-error-email" style="display: none;">Correo duplicado, cambielo!!!</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Cedula
                                    <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="cedula" name="cedula">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Celular
                                    <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="celular" name="celular">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Genero
                                    <span class="text-danger">*</span></label>
                                    <select name="genero" id="genero" class="form-control">
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Contraseña
                                    <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password" name="password">
									<span class="form-text text-info">Si desea cambiar o crear llenar</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Firma
                                    <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="firma" name="firma">
                                </div>
                            </div>
                        </div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light-dark font-weight-bold" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-success font-weight-bold" onclick="guardar()">Guardar</button>
				</div>
			</div>
		</div>
	</div>
	{{-- fin inicio modal  --}}

	<!--begin::Card-->
	<div class="card card-custom gutter-b">
		<div class="card-header flex-wrap py-3">
			<div class="card-title">
				<h3 class="card-label">LISTA DE SECRETARIOS
				</h3>
			</div>
			<div class="card-toolbar">
				<!--begin::Button-->
				<a href="#" class="btn btn-primary font-weight-bolder" onclick="nuevo()">
					<i class="fa fa-plus-square"></i> NUEVO SECRETARIO
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
							<th>Firma</th>
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
									<img src="{{ url('imagenesFirmaJuezSecre',[$u->estado]) }}" alt="Firma" width="50%">	
								</td>
								<td>
									<button type="button" class="btn btn-icon btn-warning" onclick="edita('{{ $u->id }}', '{{ $u->name }}', '{{ $u->email }}', '{{ $u->celulares }}', '{{ $u->ci }}', '{{ $u->estado }}')">
										<i class="flaticon2-edit"></i>
									</button>
									<button type="button" class="btn btn-icon btn-danger" onclick="elimina('{{ $u->id }}', '{{ $u->name }}')">
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

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$(function () {
			$('#tabla_usuarios').DataTable({
				order: [[ 0, "desc" ]],
				responsive: true,
				lengthChange: false,
				language: {
					url: '{{ asset('datatableEs.json') }}'
				},
			});
    	});

		function nuevo(){

			$('#formularioSecretario')[0].reset();

            $('#modalNuevoSecretario').modal('show');

    	}

		function edita(secretario, nombre, email, celular, cedula, firma){

			$('#secretario_id').val(secretario);
			$('#nombre').val(nombre);
			$('#correo').val(email);
			$('#cedula').val(cedula);
			$('#celular').val(celular);
			$('#password').val();

            $('#modalNuevoSecretario').modal('show');

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
		
		function guardar(){

            if($('#formularioSecretario')[0].checkValidity()){
                $('#formularioSecretario').submit();
            }else{
                $('#formularioSecretario')[0].reportValidity();
            }

		}

        function validaEmail(){

			let email = $("#email").val();

			$.ajax({
				url: "{{ url('User/validaEmail') }}",
				data: {email: email},
				type: 'POST',
				success: function(data) {
					if(data.vEmail > 0)
						$("#msg-error-email").show();
					else
						$("#msg-error-email").hide();
				}
			});
		}
    </script>
@endsection
