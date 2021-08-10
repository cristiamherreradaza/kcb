@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')

	<!--begin::Card-->
	<div class="card card-custom gutter-b">
		<div class="card-header flex-wrap py-3">
			<div class="card-title">
				<h3 class="card-label">LISTA DE CRIADEROS 
				</h3>
			</div>
			<div class="card-toolbar">
				<!--begin::Button-->
				<a href="#" class="btn btn-primary font-weight-bolder" onclick="nuevo()">
					<i class="fa fa-plus-square"></i> NUEVO CRIADERO 
				</a>
				<!--end::Button-->
			</div>
		</div>
		
		<div class="card-body">
			<!--begin: Datatable-->
			<div class="table-responsive m-t-40">
				<table class="table table-bordered table-hover table-striped" id="tabla_criaderos">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Propietario</th>
							<th>Copropietario</th>
							<th>Celular</th>
							<th>Pagina Web</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($criaderos as $cri)
							<tr>
								<td>{{ $cri->id }}</td>
								<td>{{ $cri->nombre }}</td>
								{{--  <td>{{ $cri->propietario->name }}</td>
								<td>{{ $cri->copropietario->name }}</td>  --}}
								<td>{{ $cri->celulares }}</td>
								<td>{{ $cri->pagina_web }}</td>
								<td>
									<button type="button" class="btn btn-icon btn-warning" onclick="edita('{{ $cri->id }}')">
										<i class="flaticon2-edit"></i>
									</button>
									<button type="button" class="btn btn-icon btn-danger" onclick="elimina('{{ $cri->id }}', '{{ $cri->nombre }}')">
										<i class="flaticon2-cross"></i>
									</button>
								</td>
							</tr>
						@empty
							<h3 class="text-danger">NO EXISTEN CRIADEROS</h3>
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
			$('#tabla_criaderos').DataTable({
				order: [[ 0, "desc" ]],
				language: {
					url: '{{ asset('datatableEs.json') }}'
				},
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
			window.location.href = "{{ url('Criadero/formulario') }}/0";
    	}
		
		function edita(id)
		{
			window.location.href = "{{ url('Criadero/formulario') }}/"+id;
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
                    window.location.href = "{{ url('Criadero/elimina') }}/"+id;
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