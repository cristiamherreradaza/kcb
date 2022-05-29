@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')

{{-- inicio modal  --}}

<!-- Modal-->
<div class="modal fade" id="modalJuez" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">FORMULARIO DE JUEZ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('Juez/guarda') }}" method="POST" id="formulario-juez" enctype="multipart/form-data" target="_target">
                	@csrf
                	<div class="row">
                		<div class="col-md-4">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">Nombre del Juez
                			    <span class="text-danger">*</span></label>
                			    <input type="hidden" id="juez_id" name="juez_id" value="0" />
                			    <input type="text" class="form-control" id="nombre" name="nombre" required />
                			</div>
                		</div>
                		<div class="col-md-4">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">Email
                			    <span class="text-danger">*</span></label>
                			    <input type="email" class="form-control" id="email" name="email" required />
                			</div>
                		</div>
						<div class="col-md-4">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">Categoria
                			    <span class="text-danger">*</span></label>
								<select name="categoria_juez_id" id="categoria_juez_id" class="form-control">
									@foreach ($categoriaJuez as $cj)
										<option value="{{ $cj->id }}">{{ $cj->nombre }}</option>
									@endforeach
								</select>
                			</div>
                		</div>
                	</div>

					<div class="row">
						<div class="col-md-6">
                			<div class="form-group">
                			    <label for="exampleInputPassword1">Pais
                			    <span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="departamento" name="departamento">
                			</div>
                		</div>
						<div class="col-md-6">
							<p style="margin-top: 24px"></p>
							<input type='file' id="imgInp"  class="form-control" name="imgInp"/>
						</div>
                	</div>
					<div class="row">
						<div class="col-md-12">
							<center>
								<div style="max-width: 300px">
									<img id="blah" src="https://via.placeholder.com/150" alt="Tu imagen" width="100%"/>
								</div>
							</center>
						</div>
					</div>

                </form>
            </div>
            <div class="modal-footer">
				<div class="row">
					<div class="col-md-6">
						<button type="button" class="btn btn-light-dark font-weight-bold " data-dismiss="modal">Cerrar</button>
					</div>
					<div class="col-md-6">
						<button type="button" class="btn btn-success font-weight-bold"  onclick="crear()">Guardar</button>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>
{{-- fin inicio modal  --}}

	<!--begin::Card-->
	<div class="card card-custom gutter-b">
		<div class="card-header flex-wrap py-3">
			<div class="card-title">
				<h3 class="card-label">LISTADO DE JUEZ
				</h3>
			</div>
			<div class="card-toolbar">
				<!--begin::Button-->
				<a href="#" class="btn btn-primary font-weight-bolder" onclick="nuevo()">
					<i class="fa fa-plus-square"></i> NUEVO JUEZ
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
							<th>Email</th>
							<th>Categoria</th>
							<th>Pais</th>
							<th>Foto</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($jueces as $juez)
							<tr>
								<td>{{ $juez->id }}</td>
								<td>{{ $juez->nombre }}</td>
								<td>{{ $juez->email }}</td>
								<td>{{ $juez->categoriaJuez->nombre }}</td>
								<td>{{ $juez->departamento }}</td>
								<td>
									<div style="max-width: 50px">
										<img src="{{ url("imagenesJueces/$juez->foto") }}" alt="" width="100">
									</div>
								</td>
								<td>
									<button type="button" class="btn btn-icon btn-warning" onclick="edita('{{ $juez->id }}', '{{ $juez->nombre }}', '{{ $juez->email }}', '{{ $juez->foto }}', '{{ $juez->departamento }}', '{{ $juez->categoria_juez_id}}')">
										<i class="flaticon2-edit"></i>
									</button>
									<button type="button" class="btn btn-icon btn-danger" onclick="elimina('{{ $juez->id }}', '{{ $juez->nombre }}')">
										<i class="flaticon2-cross"></i>
									</button>
								</td>
							</tr>
						@empty
							<h3 class="text-danger">NO EXISTEN JUECES</h3>
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
				responsive: true,
    	        language: {
    	            url: '{{ asset('datatableEs.json') }}',
    	        },
				order: [[ 0, "desc" ]]
    	    });

    	});

    	function nuevo()
    	{
			// pone los inputs vacios
			$("#juez_id").val('0');
			$("#nombre").val('');
			$("#email").val('');
			$("#fecha_nacimiento").val('');
			$("#direccion").val('');
			$("#celulares").val('');
			$("#departamento").val('');
			// abre el modal
    		$("#modalJuez").modal('show');
    	}

		function edita(id, nombre, email, foto,  departamento, categoria_juez_id)
    	{
			// colocamos valores en los inputs
			$("#juez_id").val(id);
			$("#nombre").val(nombre);
			$("#email").val(email);
			$("#departamento").val(departamento);
			$("#categoria_juez_id").val(categoria_juez_id);

			var ruta = "{{ url('imagenesJueces') }}/"+foto;

			$('#blah').attr('src', ruta);

			// mostramos el modal
    		$("#modalJuez").modal('show');
    	}

    	function crear()
    	{
			// verificamos que el formulario este correcto
    		if($("#formulario-juez")[0].checkValidity()){
				// enviamos el formulario
    			$("#formulario-juez").submit();
				// mostramos la alerta
				Swal.fire("Excelente!", "Registro Guardado!", "success");
    		}else{
				// de lo contrario mostramos los errores
				// del formulario
    			$("#formulario-juez")[0].reportValidity()
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

                    window.location.href = "{{ url('Juez/elimina') }}/"+id;

                    Swal.fire(
                        "Borrado!",
                        "El registro fue eliminado.",
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



		function readImage (input) {
			if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#blah').attr('src', e.target.result); // Renderizamos la imagen
			}
			reader.readAsDataURL(input.files[0]);
			}
		}

		$("#imgInp").change(function () {
			// Código a ejecutar cuando se detecta un cambio de archivO
			readImage(this);
		});


    </script>
@endsection
