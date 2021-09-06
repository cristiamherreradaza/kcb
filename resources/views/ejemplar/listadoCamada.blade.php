@extends('layouts.app')

@section('metadatos')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')

{{-- inicio modal busqueda de ejemplar --}}

<!-- Modal-->
<div class="modal fade" id="modal-padres" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">BUSQUEDA DE EJEMPLARES</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="formulario-padres">
                    @csrf
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kcb">KCB
                                </label>
                                <input type="hidden" name="sexo-modal" id="sexo-modal" value="todos">
                                <input type="text" class="form-control" id="busqueda-kcb" name="busqueda-kcb" autocomplete="off" />
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="nombre">Nombre
                                </label>
                                <input type="text" class="form-control" id="busqueda-nombre" name="busqueda-nombre" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-12" id="ajaxEjemplar">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- fin inicio modal busqueda de ejemplar  --}}

	<!--begin::Card-->
	<div class="card card-custom gutter-b">
		<div class="card-header flex-wrap py-3">
			<div class="card-title">
				<h3 class="card-label">LISTADO DE EJEMPLARES DE LA CAMADA
				</h3>
                <input type="hidden" id="add_camada_id" value="{{ $camada->id }}">
			</div>
			<div class="card-toolbar">
				<!--begin::Button-->
				<a href="#" class="btn btn-primary font-weight-bolder" onclick="nuevo()">
					<i class="fa fa-plus-square"></i> NUEVO EJEMPLAR
				</a>
				<!--end::Button-->
			</div>
		</div>
		
		<div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h3>
                        <span class="text-primary">Padre: </span>{{ $camada->padre->nombre_completo }}
                    </h3>
                </div>
                <div class="col-md-6">
                    <h3>
                        <span class="text-primary">Madre: </span>{{ $camada->madre->nombre_completo }}
                    </h3>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h3>
                        <span class="text-primary">Raza: </span>{{ $camada->raza->nombre }}
                    </h3>
                </div>
                <div class="col-md-6">
                    <h3>
                        <span class="text-primary">Fecha de Nacimeinto: </span>{{ $camada->fecha_nacimiento }}
                    </h3>
                </div>
            </div>
            <br>
			<!--begin: Datatable-->
			<div class="table-responsive m-t-40">
				<table class="table table-bordered table-hover table-striped" id="tabla-insumos">
					<thead>
						<tr>
							<th>ID</th>
							<th>Kcb</th>
							<th>Nombre</th>
							<th>Chip</th>
							<th>Tatuaje</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@forelse ($ejemplaresCamada as $ec)
							<tr>
								<td>{{ $ec->id }}</td>
								<td>{{ $ec->kcb }}</td>
								<td>{{ $ec->nombre_completo }}</td>
								<td>{{ $ec->chip }}</td>
								<td>{{ $ec->num_tatuaje }}</td>
								<td>
									<button type="button" class="btn btn-sm btn-icon btn-danger" onclick="elimina('{{ $ec->id }}', '{{ $ec->nombre }}')">
										<i class="flaticon2-cross"></i>
									</button>
								</td>
							</tr>
						@empty
							<h3 class="text-danger">NO EXISTEN RAZAS</h3>
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
    	    $('#tabla-insumos').DataTable({
    	        language: {
    	            url: '{{ asset('datatableEs.json') }}',
    	        },
				order: [[ 0, "desc" ]]
    	    });

    	});

    	function nuevo()
    	{
			// pone los inputs vacios
			$("#busqueda-kcb").val('');
			$("#busqueda-nombre").val('');
			//$("#descripcion").val('');
			// abre el modal
    		$("#modal-padres").modal('show');
    	}

		function edita(id, nombre, descripcion)
    	{
			// colocamos valores en los inputs
			$("#titulo_id").val(id);
			$("#nombre").val(nombre);
			$("#descripcion").val(descripcion);

			// mostramos el modal
    		$("#modalRaza").modal('show');
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

                    window.location.href = "{{ url('Ejemplar/eliminaEjemplarCamada') }}/"+id;

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

        $("#busqueda-kcb, #busqueda-nombre").on("change paste keyup", function() {

            let kcb = $("#busqueda-kcb").val();
            let nombre = $("#busqueda-nombre").val();
            let sexo = $("#sexo-modal").val();
    
            $.ajax({
                url: "{{ url('Ejemplar/ajaxBuscaEjemplar') }}",
                data: {
                    kcb: kcb, 
                    nombre: nombre,
                    sexo: sexo
                },
                type: 'POST',
                success: function(data) {
                    $("#ajaxEjemplar").html(data);
                }
            });
    
        });

    </script>
@endsection