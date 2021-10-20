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
	<div class="modal fade" id="modalPermiso" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">PERMISOS DEL USUARIOS <span class="text-primary"></span></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i aria-hidden="true" class="ki ki-close"></i>
					</button>
				</div>
				<div class="modal-body">
					<form action="" method="POST" id="formulario-permiso">
						@csrf
						<div id="permisos">

						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-light-dark font-weight-bold" data-dismiss="modal">Cerrar</button>
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
									<button type="button" class="btn btn-sm btn-icon btn-warning" onclick="edita('{{ $u->id }}')">
										<i class="flaticon2-edit"></i>
									</button>
									<button type="button" class="btn btn-sm btn-icon btn-primary" onclick="permisos('{{ $u->id }}')">
										<i class="far fa-list-alt"></i>
									</button>
									<button type="button" class="btn btn-sm btn-icon btn-danger" onclick="elimina('{{ $u->id }}', '{{ $u->name }}')">
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
				language: {
					url: '{{ asset('datatableEs.json') }}'
				},
			});
    	});

		function nuevo()
    	{
			window.location.href = "{{ url('User/formulario') }}/0";
    	}
		
		function edita(id)
		{
			window.location.href = "{{ url('User/formulario') }}/"+id;
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
		function permisos(id){
			let user_id = id;

			$.ajax({
				url: "{{ url('User/ajaxPermisos') }}",
				data: {
					user_id: user_id
				},
				type: 'POST',
				success: function(data) {
					$("#permisos").html(data);
					$("#modalPermiso").modal('show');
				}
			});
		}
		function guarda(id){
			let user_1 = id;
			let valor = $("#"+id+"").prop('checked')
			$.ajax({
				url: "{{ url('User/guardaPermiso') }}",
				data: {
					user: user_1,
					valor: valor
				},
				type: 'POST',
				success: function(data) {
					// $("#permisos").html('');
					$("#permisos").html(data);

					// Swal.fire(
                    //     "Guardado!",
                    //     "Se gurdo con Exito el Permiso.",
                    //     "success"
                    // )
				}
			});
		}
    </script>
@endsection