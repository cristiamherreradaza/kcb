@extends('layouts.app')

@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

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
				&nbsp;
				<a href="#" class="btn btn-success btn-icon font-weight-bolder" onclick="muestraBarra();">
					<i class="fas fa-search"></i> </a>
				<!--end::Button-->
			</div>
		</div>

		<div class="card-body">
            <div id="barra-busqueda" style="display: none">
				<form action="{{ url('Criadero/ajaxListadoCriadero') }}" method="POST" id="formulario-busqueda-usuarios">
					@csrf
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputPassword1">Nombre
									<span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="nombre_buscar" name="nombre_buscar" />
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputPassword1">Criador
									<span class="text-danger">*</span></label>
									<br>
								{{-- <input type="text" class="form-control" id="criador_buscar" name="cedula_buscar" /> --}}
								<select class="form-control select2" style="width: 100%;" id="criador_buscar" name="criador_buscar">
									<option label="Label"></option>
								</select>
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputPassword1">Departamento
									<span class="text-danger">*</span></label>
								<select name="departamento_buscar" id="departamento_buscar" class="form-control" >
									<option value="" >SELECCIONE</option>
									<option value="La Paz" >La Paz</option>
									<option value="Oruro" >Oruro</option>
									<option value="Potosi" >Potosi</option>
									<option value="Cochabamba" >Cochabamba</option>
									<option value="Chuquisaca" >Chuquisaca</option>
									<option value="Tarija" >Tarija</option>
									<option value="Pando" >Pando</option>
									<option value="Beni" >Beni</option>
									<option value="Santa Cruz" >Santa Cruz</option>
								</select>
								{{-- <input type="text" class="form-control" id="departamento_buscar" name="departamento_buscar" /> --}}
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputPassword1">&nbsp;</label>
								<button type="button" class="btn btn-success btn-block" onclick="bucarCriadero()">BUSCAR</button>
							</div>
						</div>

					</div>
				</form>
			</div>
			<!--begin: Datatable-->
			<div class="table-responsive m-t-40" id="ajaxCriadero">

			</div>
			<!--end: Datatable-->
		</div>
	</div>
	<!--end::Card-->
@stop

@section('js')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
	<script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }} "></script>
    <script type="text/javascript">

		//Llamamamos a lista de ajax
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$(function () {
			// funcion para llamar a los datos iniciales de la tabla
			let datosBusquda = $('#formulario-busqueda-usuarios').serializeArray();

			$.ajax({
				url: "{{ url('Criadero/ajaxListadoCriadero') }}",
				data: datosBusquda,
				type: 'POST',
				success: function(data) {
					$('#ajaxCriadero').html(data);
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
			window.location.href = "{{ url('Criadero/formulario') }}/0";
    	}

		function edita(id)
		{
			window.location.href = "{{ url('Criadero/formulario') }}/"+id;
		}

		function elimina(id, nombre)
        {
            Swal.fire({
                title: "Quieres eliminar "+nombre+" "+id,
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
		function bucarCriadero()
		{
			var this_item = document.getElementById('barra-busqueda');
			this_item.style.display = 'none';

			let datosBusquda = $('#formulario-busqueda-usuarios').serializeArray();

			$.ajax({
				url: "{{ url('Criadero/ajaxListadoCriadero') }}",
				data: datosBusquda,
				type: 'POST',
				success: function(data) {
					$('#ajaxCriadero').html(data);
				}
			});

		}

		$("#criador_buscar").select2({
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
