
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

	</head>
    <style>
		img{
			display:block;
			margin:auto;
		}
	</style>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<br>
        <div class="container">
            {{-- <div class="row">
                <div class="col-md-4">
                    <div style="height: 100px;">
                        <img src="{{ url('img/fci.jpg') }}" alt="" height="100%">
                    </div>
                </div>
                <div class="col-md-4" style="">
                    <div style="height: 100px;">
                        <img src="{{ url('img/logo.png') }}" alt="" height="100%">
                    </div>
                </div>
                <div class="col-md-4" style="">
                    <div style="height: 100px;">
                        <img src="{{ url('img/logo.gif') }}" alt="" height="100%">
                    </div>
                </div>
            </div> --}}
            <img src="{{ url('img/registro-1.png') }}" alt="" width="50%">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center text-info">Ejemplar Registrado con Exito</h1>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-12">
                    <h4>
                        <b>EJEMPLAR: {{ $ejemplarVista->nombre_completo }}</b>
                    </h4>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-12">
                    <h4>
                        <b>EVENTO INSCRITO: {{ $ejemplarEvento->evento->nombre }}</b>
                    </h4>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-12">
                    <h4>
                        <b>COIDIGO DE REGISTRO: {{ $ejemplarEvento->id }}</b>
                    </h4>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <a href="http://kcb.org.bo/" class="btn btn-success btn-block">Volver a la Pagina WEB</a>
                </div>
                <div class="col-md-4">
                </div>
            </div>
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
	</body>
	<!--end::Body-->
</html>
<script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-switch.js') }}"></script>







