@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')


	<!--begin::Card-->
	<div class="card card-custom gutter-b">
		<div class="card-header flex-wrap py-3">
			<div class="card-title">
				<h3 class="card-label">REPORTE REGISTRO DE EJEMPLARES POR RAZA
				</h3>
			</div>
			<div class="card-toolbar">
				<!--begin::Button-->
				{{-- <a href="#" class="btn btn-primary font-weight-bolder" onclick="nuevo()">
					<i class="fa fa-plus-square"></i> NUEVA RAZA
				</a> --}}
				<!--end::Button-->
			</div>
		</div>
		
		<div class="card-body">
			<!--begin: Datatable-->
			<div class="table-responsive m-t-40">
                <form action="{{ url('Reporte/ejemplarporrazaPdf') }}" method="POST" id="formulario-reporte">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Seleccione el Año
                                <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="number" class="form-control" id="anio" name="anio" value="{{ date('Y') }}" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-danger btn-block"  onclick="generar()"><i class="far fa-file-pdf"></i>Generar</button>
                        </div>
                    </div>
                </form>
			</div>
			<!--end: Datatable-->
		</div>
	</div>
	<!--end::Card-->
@stop

@section('js')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script type="text/javascript">

        function generar(){
            // alert('en desarrollo :v');
            $('#formulario-reporte').submit();
        }


		// $(function () {
		// 	$('#tabla-raza').DataTable({
		// 		order: [[ 1, "asc" ]],
		// 		language: {
		// 			url: '{{ asset('datatableEs.json') }}'
		// 		},
		// 	});
    	// });

    	// function nuevo()
    	// {
		// 	// pone los inputs vacios
		// 	$("#raza_id").val('');
		// 	$("#nombre").val('');
		// 	$("#descripcion").val('');
		// 	// abre el modal
    	// 	$("#modalRaza").modal('show');
    	// }

		// function edita(id, nombre, descripcion)
    	// {
		// 	// colocamos valores en los inputs
		// 	$("#raza_id").val(id);
		// 	$("#nombre").val(nombre);
		// 	$("#descripcion").val(descripcion);

		// 	// mostramos el modal
    	// 	$("#modalRaza").modal('show');
    	// }

    	// function crear()
    	// {
		// 	// verificamos que el formulario este correcto
    	// 	if($("#formulario-tipos")[0].checkValidity()){
		// 		// enviamos el formulario
    	// 		$("#formulario-tipos").submit();
		// 		// mostramos la alerta
		// 		Swal.fire("Excelente!", "Registro Guardado!", "success");
    	// 	}else{
		// 		// de lo contrario mostramos los errores
		// 		// del formulario
    	// 		$("#formulario-tipos")[0].reportValidity()
    	// 	}

    	// }

		// function elimina(id, nombre)
        // {
		// 	// mostramos la pregunta en el alert
        //     Swal.fire({
        //         title: "Quieres eliminar "+nombre,
        //         text: "Ya no podras recuperarlo!",
        //         icon: "warning",
        //         showCancelButton: true,
        //         confirmButtonText: "Si, borrar!",
        //         cancelButtonText: "No, cancelar!",
        //         reverseButtons: true
        //     }).then(function(result) {
		// 		// si pulsa boton si
        //         if (result.value) {

        //             window.location.href = "{{ url('Raza/elimina') }}/"+id;

        //             Swal.fire(
        //                 "Borrado!",
        //                 "El registro fue eliminado.",
        //                 "success"
        //             )
        //             // result.dismiss can be "cancel", "overlay",
        //             // "close", and "timer"
        //         } else if (result.dismiss === "cancel") {
        //             Swal.fire(
        //                 "Cancelado",
        //                 "La operacion fue cancelada",
        //                 "error"
        //             )
        //         }
        //     });
        // }

    </script>
@endsection