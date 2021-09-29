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
				<h3 class="card-label">PERMISOS DE PERFILES 
				</h3>
			</div>
			<div class="card-toolbar">
				<!--begin::Button-->
				{{-- <a href="#" class="btn btn-primary font-weight-bolder" onclick="nuevo()">
					<i class="fa fa-plus-square"></i> NUEVO USUARIO
				</a> --}}
				<!--end::Button-->
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-8">
				<div class="card-header flex-wrap py-3">
					<form action="" method="" id="formulario-permiso">
						<div class="form-group">
							{{-- <label for="exampleInputPassword1">Seleccion un perfil
								<span class="text-danger">*</span></label> --}}
							<select name="perfil" id="perfil" class="form-control" required>
								<option value="">Seleccione un perfil</option>
								@foreach ($perfiles as $p)
									<option value="{{ $p->id }}">{{ $p->nombre }}</option>
								@endforeach
							</select>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card-header flex-wrap py-3">
					<button class="btn btn-primary btn-block" type="button" onclick="seleccionaPerfil()">Buscar</button>
				</div>
			</div>
		</div>
		
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<div id="contenido">

					</div>
				</div>
			</div>
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

		function seleccionaPerfil(){
			if($('#formulario-permiso')[0].checkValidity()){
				let perfil = $("#perfil").val();
				$.ajax({
					url: "{{ url('User/ajaxBuscaPermisos') }}",
					data: {
						perfil_id: perfil
					},
					type: 'POST',
					success: function(data) {
						$("#contenido").html(data);
					}
				});
			}else{
				$('#formulario-permiso')[0].reportValidity()
			}
		}

		function cambiaEstado(id, perfil){
			$.ajax({
				url: "{{ url('User/cambiaEstadoMenuPerfil') }}",
				data: {
					perfil_id: perfil,
					menu_id: id
				},
				type: 'POST',
				success: function(data) {
					$("#contenido").html(data);
				}
			});
		}
    </script>
@endsection