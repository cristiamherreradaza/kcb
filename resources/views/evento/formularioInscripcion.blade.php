
<!DOCTYPE html>

<html lang="en">
	<!--begin::Head-->
	<head>
		<meta charset="utf-8" />
		{{-- @yield('metadatos') --}}
        <meta name="csrf-token" content="{{ csrf_token() }}" />
		<title>KENNEL CLUB BOLIVIANO</title>
		<meta name="description" content="Base form control examples" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<link href="{{ asset('assets/css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" />

		@section('css')
		@show
		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
		{!! htmlScriptTagJsApi([
            'action' => 'homepage',
            'callback_then' => 'callbackThen',
            'callback_catch' => 'callbackCatch'
        ]) !!}
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		<!--begin::Header Mobile-->
		<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
			<!--begin::Logo-->
			<a href="#">
				<img alt="Logo" src="{{ asset('assets/media/logos/logo-light.png') }}" />
			</a>
			<!--end::Logo-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
				<!--begin::Aside Mobile Toggle-->
				<button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
					<span></span>
				</button>
				<!--end::Aside Mobile Toggle-->
				<!--begin::Header Menu Mobile Toggle-->
				<button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
					<span></span>
				</button>
				<!--end::Header Menu Mobile Toggle-->
				<!--begin::Topbar Mobile Toggle-->
				<button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
					<span class="svg-icon svg-icon-xl">
						<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24" />
								<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
								<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>
				</button>
				<!--end::Topbar Mobile Toggle-->
			</div>
			<!--end::Toolbar-->
		</div>
		<div class="container">
			<br><br>
			<div class="row">
				<div class="col-md-6">
					<div style="height: 200px;">
						<img src="{{ url('img/fci.jpg') }}" alt="" height="100%">
					</div>
				</div>
				<div class="col-md-6" style="">
					<div style="height: 200px;">
						<img src="{{ url('img/logo.gif') }}" alt="" height="100%" style="float: right;">
					</div>
				</div>
			</div>
			<br><br>
			<div class="row">
				<div class="col-md-12">
					<!--begin::Card-->
					<div class="card card-custom gutter-b example example-compact">
						<div class="card-header">
							<h3 class="card-title">FORMULARIO DE INSCRIPCION ({{ $evento->nombre }})</h3>
						</div>
						<!--begin::Form-->
						<form action="{{ url('Evento/inscribirEvento') }}" method="POST" id="formulario-inscripcion-evento" >
							@csrf
							<div class="card-body">
								<input type="hidden" name="evento_id" id="evento_id" value="{{ $evento->id }}">
								<input type="hidden" name="ejemplar_meses" id="ejemplar_meses" >
								<input type="hidden" name="ejemplar_id" id="ejemplar_id">
								<div class="row">
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="exampleInputPasswo¶rd1">
													Nacional</label>
													<input id='check_busca' data-switch="true" type="checkbox" checked data-on-color="primary"  onchange="mostrarBusqueda()"/>
													<label class="exampleInputPassword1">
													Extrangero</label>
												</div>
												<span class="form-text text-danger" id="msg-error-email" style="display: none;">Correo duplicado, cambielo!!!</span>
											</div>
											<div class="col-md-6">
												<div id="bloque-nacional">
													<div class="row">
														<div class="col-md-9">
															<div class="form-group">
																<label class="exampleInputPassword1">
																KCB
																</label>
																<input type="text" class="form-control" id="kcb_busca" name="kcb_busca" />
																<span class="form-text text-danger" id="msg-error-kcb" style="display: none;">Ejemplar no Registrado</span>
																<span class="form-text text-success" id="msg-good-kcb" style="display: none;">Ejemplar Registrado</span>
																<span class="form-text text-danger" id="msg-vacio-kcb" style="display: none;">Digitar un K.C.B.</span>
															</div>
														</div>
														<div class="col-md-3">
															<br>
															<button type="button" class="btn btn-success btn-block" onclick="buscaKcb()"><i class="fa fa-search"></i></button>
														</div>
													</div>
												</div>
												<div id="bloque-extrangero" style="display: none;">
													<div class="row">
														<div class="col-md-9">
															<div class="form-group">
																<label class="exampleInputPassword1">
																Codigo Extrangero</label>
																<input type="text" class="form-control" id="cod_extrangero" name="cod_extrangero"/>
																<span class="form-text text-danger" id="msg-vacio-cod" style="display: none;">Digitar un Codigo de Extranjero</span>
															</div>
														</div>
														<div class="col-md-3">
															<br>
															<button type="button" class="btn btn-success btn-block" onclick="buscaCodigo()" ><i class="fa fa-search"></i></button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="exampleInputPassword1">
											Raza</label>
											<select class="form-control select2" id="raza_id" name="raza_id"  required >
												<option value=""></option>
												{{-- @if ($ejemplar != null && $ejemplar->raza_id != null)
													<option value="{{ $ejemplar->raza->id }}"> {{ $ejemplar->raza->id }} {{ $ejemplar->raza->nombre }} {{ $ejemplar->raza->descripcion }}</option>
												@endif --}}
												@forelse ($razas as $r)
													<option value="{{ $r->id }}">{{ $r->nombre }} {{ $r->descripcion }}</option>                                    
												@empty
													
												@endforelse
											</select>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="exampleInputPassword1">
											Nombre del ejemplar</label>
											<input type="text" class="form-control" id="nombre" name="nombre" required />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="exampleInputPassword1">
											Color</label>
											<input type="text" class="form-control" id="color" name="color" required />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="exampleInputPassword1">
											Fecha de Nacimiento</label>
											<input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" onchange="calcular_fecha()" required />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="exampleInputPassword1">
											Sexo</label>
											<select class="form-control" id="sexo" name="sexo" >
												<option value="Macho">Macho</option>
												<option value="Hembra">Hembra</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="exampleInputPassword1">
											Registro de Extrangero</label>
											<input type="text" class="form-control" id="registro_extrangero" name="registro_extrangero"/>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="exampleInputPassword1">
											Tatuaje</label>
											<input type="text" class="form-control" id="tatuaje" name="tatuaje" />
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="exampleInputPassword1">
											Microchip</label>
											<input type="text" class="form-control" id="chip" name="chip"/>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="exampleInputPassword1">
											KCB del Padre</label>
											<input type="text" class="form-control" id="kcb_padre" name="kcb_padre"/>
										</div>
									</div>
									<div class="col-md-8">
										<div class="form-group">
											<label class="exampleInputPassword1">
											Nombre del Padre</label>
											<input type="text" class="form-control" id="nom_padre" name="nom_padre" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="exampleInputPassword1">
											KCB del Madre</label>
											<input type="text" class="form-control" id="kcb_madre" name="kcb_madre" />
										</div>
									</div>
									<div class="col-md-8">
										<div class="form-group">
											<label class="exampleInputPassword1">
											Nombre del Madre</label>
											<input type="text" class="form-control" id="nom_madre" name="nom_madre"/>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="exampleInputPassword1">
											Categorias</label>
											<h4 id="msjEdad" class="text-success"></h4>
											<select class="form-control select2" id="categoria_pista" name="categoria_pista" required >
												<option value=""></option>
												{{-- @if ($ejemplar != null && $ejemplar->raza_id != null)
													<option value="{{ $ejemplar->raza->id }}"> {{ $ejemplar->raza->id }} {{ $ejemplar->raza->nombre }} {{ $ejemplar->raza->descripcion }}</option>
												@endif --}}
												@forelse ($categorias_pistas as $ca)
													<option value="{{ $ca->id }}">{{ $ca->nombre }} {{ $ca->desde }}</option>                                    
												@empty
													
												@endforelse
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="exampleInputPassword1">
											Criador</label>
											<input type="text" class="form-control" id="criador" name="criador"/>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="exampleInputPassword1">
											Propietario</label>
											<input type="text" class="form-control" id="propietario" name="propietario" required />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="exampleInputPassword1">
											Ciudad / Pais</label>
											<input type="text" class="form-control" id="ciudad" name="ciudad" required />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="exampleInputPassword1">
											Telefono</label>
											<input type="text" class="form-control" id="telefono" name="telefono" required />
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="exampleInputPassword1">
											Email</label>
											<input type="email" class="form-control" id="email" name="email" required />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<button type="button" class="btn btn-success btn-block" onclick="inscribir()">INSCRIBRI EJEMPLAR</button>    
									</div>    
								</div>                    
							</div>
						</form>
						<!--end::Form-->
					</div>
					<!--end::Card-->
				</div>
				
			</div>
		</div>
		<!--end::Header Mobile-->
		
		<!--end::Main-->
		<!-- begin::User Panel-->
		
		
		<div id="kt_scrolltop" class="scrolltop">
			<span class="svg-icon">
				<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<polygon points="0 0 24 0 24 24 0 24" />
						<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
						<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
					</g>
				</svg>
				<!--end::Svg Icon-->
			</span>
		</div>
		<!--end::Scrolltop-->
		<!--begin::Sticky Toolbar-->
		
		<!--end::Sticky Toolbar-->
		<!--begin::Demo Panel-->
		
		<!--end::Demo Panel-->
		<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
		<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
		<script src="{{ asset('assets/js/pages/features/miscellaneous/sweetalert2.js') }}"></script>
		<script>
			// script para que todos los formularios pasen con ENTER en vez de TAB
			jQuery(document).ready(function() {
				$('body').on('keydown', 'input, select', function(e) {
				if (e.key === "Enter") {
					var self = $(this), form = self.parents('form:eq(0)'), focusable, next;
					focusable = form.find('input,a,select,button,textarea').filter(':visible');
					next = focusable.eq(focusable.index(this)+1);
					if (next.length) {
						next.focus();
					} else {
						form.submit();
					}
					return false;
				}
				});
			});
		</script>
		<script type="text/javascript">
			$.ajaxSetup({
				// definimos cabecera donde estarra el token y poder hacer nuestras operaciones de put,post...
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		
		function guarda()
		{
		if ($("#formularioPersona")[0].checkValidity()) {
		
		$("#formularioPersona").submit();
		Swal.fire("Excelente!", "Se guardo el distrito!", "success");
		
		}else{
		$("#formularioPersona")[0].reportValidity();
		}
		}
		
		function mostrarBusqueda(){
			$("#bloque-nacional").toggle('slow');
			$("#bloque-extrangero").toggle('slow');
		}
		
		function buscaKcb(){
			let kcb = $("#kcb_busca").val();
			if(kcb != ''){
			// alert("vacio");
			$.ajax({
				url: "{{ url('Evento/ajaxBuscaEjemplar') }}",
				data: {
				kcb: kcb
				},
				type: "POST",
				success: function(data) {
					//convertimos la respuesta para poder trabajar
					let ejemplar = JSON.parse(data);
					// let ejemplar = JSON.stringify(data);
					// console.log(ejemplar);
					if(ejemplar.id){
						// console.log("lleno");
						$("#ejemplar_id").val(ejemplar.id);
						$("#nombre").val(ejemplar.nombre_completo);
						$("#color").val(ejemplar.color);
						$("#fecha_nacimiento").val(ejemplar.fecha_nacimiento);
						$("#sexo").val(ejemplar.sexo);
						$("#registro_extrangero").val(ejemplar.codigo_nacionalizado);
						$("#tatuaje").val(ejemplar.num_tatuaje);
						$("#chip").val(ejemplar.chip);
						$("#kcb_padre").val(ejemplar.kcb_padre);
						$("#nom_padre").val(ejemplar.nombre_padre);
						$("#kcb_madre").val(ejemplar.kcb_madre);
						$("#nom_madre").val(ejemplar.nombre_madre);
						$("#propietario").val(ejemplar.nom_propietario);
						$("#ciudad").val(ejemplar.departamento);
						$("#telefono").val(ejemplar.celulares);
						$("#email").val(ejemplar.email);
						$("#raza_id").val(ejemplar.raza_id);
						$('#raza_id').trigger('change');
						$("#msg-good-kcb").show();
						$("#msg-error-kcb").hide();
						$("#msg-vacio-kcb").hide();
						calcular_fecha();
					}else{
						$("#ejemplar_id").val('');
						$("#nombre").val('');
						$("#color").val('');
						$("#fecha_nacimiento").val('');
						$("#sexo").val('');
						$("#registro_extrangero").val('');
						$("#tatuaje").val('');
						$("#chip").val('');
						$("#kcb_padre").val('');
						$("#nom_padre").val('');
						$("#propietario").val(ejemplar.nom_propietario);
						$("#ciudad").val(ejemplar.departamento);
						$("#telefono").val(ejemplar.celulares);
						$("#email").val(ejemplar.email);
						$("#kcb_madre").val('');
						$("#nom_madre").val('');
						$("#raza_id").val('');
						$('#raza_id').trigger('change');
		
						// console.log("vacio");
						$("#msg-error-kcb").show();
					}
				}
			});
			}else{
			$("#msg-vacio-kcb").show();
			}
		
		}
		
		$(function(){
			$('#raza_id').select2({
			placeholder: "Select a state"
			});
		});
		
		$(function(){
			$('#categoria_pista').select2({
			placeholder: "Select a state"
			});
		});
		
		function calcular_fecha(){
		
			let fecha_nacimiento    = $("#fecha_nacimiento").val();
			let fecha_inicio_evento = "2021-08-08";
		
			fecha_cal = new Date(fecha_nacimiento);
			fechaP = fecha_inicio_evento;
			dt2 = new Date(fechaP);
			meses = diff_months(dt2, fecha_cal);
			$('#msjEdad').html("OJO su Ejemplar tiene <b>" + meses + " meses</b>");
			$("#ejemplar_meses").val(meses);
		}
		
		function crea_fecha(fecha) {
			a = fecha[0] + fecha[1] + fecha[2] + fecha[3];
			m = fecha[4] + fecha[5];
			d = fecha[6] + fecha[7];
			return a + "-" + m + "-" + d;
		}
		
		function diff_months(dt2, dt1) {
			var diff =(dt2.getTime() - dt1.getTime()) / 1000;
			diff /= (60 * 60 * 24 * 30);
			return Math.abs(Math.round(diff));
		}
		
		function inscribir(){
			if($('#formulario-inscripcion-evento')[0].checkValidity()){
				$('#formulario-inscripcion-evento').submit();
				Swal.fire("Excelente!", "Registro Guardado!", "success");
			}else{
				$('#formulario-inscripcion-evento')[0].reportValidity();
			}
		}
		
		function buscaCodigo(){
			//alert("busqueda por codigo extrangero en desarrolo :)");
			let cod_ex = $("#cod_extrangero").val();
			//alert(cod_ex);
			if(cod_ex != ''){
			// alert("vacio");
			$.ajax({
				url: "{{ url('Evento/ajaxBuscaExtranjero') }}",
				data: {
				cod_ex: cod_ex
				},
				type: "POST",
				success: function(data) {
						//convertimos la respuesta para poder trabajar
						let ejemplar = JSON.parse(data);
						// let ejemplar = JSON.stringify(data);
						//console.log(ejemplar);
					if(ejemplar.id){
						// console.log("lleno");
						//$("#ejemplar_id").val(ejemplar.id);
						$("#nombre").val(ejemplar.nombre_completo);
						$("#color").val(ejemplar.color);
						$("#fecha_nacimiento").val(ejemplar.fecha_nacimiento);
						$("#sexo").val(ejemplar.sexo);
						$("#registro_extrangero").val(ejemplar.codigo_nacionalizado);
						$("#criador").val(ejemplar.criador);
						$("#tatuaje").val(ejemplar.num_tatuaje);
						$("#chip").val(ejemplar.chip);
						$("#kcb_padre").val(ejemplar.kcb_padre);
						$("#nom_padre").val(ejemplar.nombre_padre);
						$("#kcb_madre").val(ejemplar.kcb_madre);
						$("#nom_madre").val(ejemplar.nombre_madre);
						$("#propietario").val(ejemplar.propietario);
						$("#ciudad").val(ejemplar.ciudad);
						$("#telefono").val(ejemplar.telefono);
						$("#email").val(ejemplar.email);
						$("#raza_id").val(ejemplar.raza_id);
						$('#raza_id').trigger('change');
						$("#msg-good-kcb").show();
						$("#msg-error-kcb").hide();
						$("#msg-vacio-kcb").hide();
						calcular_fecha();
					}else{
						$("#ejemplar_id").val('');
						$("#nombre").val('');
						$("#color").val('');
						$("#fecha_nacimiento").val('');
						$("#sexo").val('');
						$("#registro_extrangero").val('');
						$("#tatuaje").val('');
						$("#chip").val('');
						$("#kcb_padre").val('');
						$("#nom_padre").val('');
						$("#propietario").val(ejemplar.nom_propietario);
						$("#ciudad").val(ejemplar.departamento);
						$("#telefono").val(ejemplar.celulares);
						$("#email").val(ejemplar.email);
						$("#kcb_madre").val('');
						$("#nom_madre").val('');
						$("#raza_id").val('');
						$('#raza_id').trigger('change');
		
						// console.log("vacio");
						$("#msg-error-kcb").show();
					}
				}
			});
			}else{
			$("#msg-vacio-cod").show();
			}
		
		}
		
		</script>
	</body>
	<!--end::Body-->
</html>
<script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-switch.js') }}"></script>







