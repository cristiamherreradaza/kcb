@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
    <style>
        .especiales{
            font-size:60px;
            position: absolute;
            color: rgb(0, 8, 245);
            font-weight: bold;
            -webkit-text-stroke: 2px rgb(255, 255, 255);
        }
        #primeroEspecial{
            margin-left:280px;
            margin-top:70px;
        }
        #segundoEspecial{
            margin-left:160px;
            margin-top:90px;
        }
        #terceroEspecial{
            margin-left:395px;
            margin-top:100px;
        }
        #cuartoEspecial{
            margin-left:25px;
            margin-top:110px;
        }
        #quintooEspecial{
            margin-left:515px;
            margin-top:115px;
        }
        
    </style>
@endsection

@section('metadatos')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')

	<!--begin::Card-->
	<div class="card card-custom gutter-b">
		<div class="card-header flex-wrap py-3">
			<div class="card-title">
				<h3 class="card-label">KANKING GANADORES</h3>
			</div>
		</div>
		<div class="card-body">
            
            <div class="card-header card-header-tabs-line">
                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-bold nav-tabs-line-3x" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#kt_apps_contacts_view_tab_1">
                                <span class="nav-icon mr-2">
                                    <span class="svg-icon mr-3">
                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Notification2.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000" />
                                                <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                                <span class="nav-text">MEJORES DE RAZAS</span>
                            </a>
                        </li>
                        <li class="nav-item mr-3">
                            <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_2">
                                <span class="nav-icon mr-2">
                                    <span class="svg-icon mr-3">
                                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Chat-check.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                <path d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z" fill="#000000" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                                <span class="nav-text">PODIO</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body px-0">
                <div class="tab-content pt-5">
                    <!--begin::Tab Content-->
                    <div class="tab-pane active" id="kt_apps_contacts_view_tab_1" role="tabpanel">
                        <div class="container">
                            @php
                                $contadoresRazas = 0;
                                $cantidadRazas = count($ejemplares);
                            @endphp
                            @while ($contadoresRazas < $cantidadRazas)
                                <div class="row">
                                    @for ($i = 1 ; $i <= 4 ; $i++)
                                        @if ($contadoresRazas < $cantidadRazas)
                                            <div class="col-xl-3 border">
                                                <!--begin::Card-->
                                                <div class="card card-custom gutter-b card-stretch">
                                                    <!--begin::Body-->
                                                    <div class="card-body pt-4 d-flex flex-column justify-content-between">
                                                        <!--begin::User-->
                                                        <div class="">
                                                            <center>
                                                                <!--begin::Title-->
                                                                <div class="d-flex flex-column">
                                                                    <h4 style="height: 50px;" class="text-success font-weight-bold text-hover-primary mb-0">{{ str_replace(['(', ')', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0'], '' , $ejemplares[$contadoresRazas]['nombre']) }}</h4>
                                                                </div>
                                                                <!--end::Title-->
                                                            </center>
                                                        </div>
                                                        <!--end::User-->
                                                        <!--begin::Desc-->
                                                        @if ($ejemplares[$contadoresRazas]['mejorCachoro'] || $ejemplares[$contadoresRazas]['mejorCachoroSexoOpuesto'])
                                                            <p class="text-center text-info">
                                                                Cachorro
                                                            </p>
                                                            <div class="row text-center">
                                                                <div class="col-md-6">
                                                                    @if ($ejemplares[$contadoresRazas]['mejorCachoro'])
                                                                        <span class="text-primary">MEJOR CACHORRO</span>
                                                                        <br>
                                                                        <h5>{{ $ejemplares[$contadoresRazas]['mejorCachoro']->numero_prefijo }}</h5>

                                                                        <img class="listonMejor" src="{{ url('img/liston2.png') }}" alt="" width="35%">

                                                                    @endif
                                                                </div>
                                                                <div class="col-md-6">
                                                                    @if ($ejemplares[$contadoresRazas]['mejorCachoroSexoOpuesto'])
                                                                        <span class="text-primary">MEJOR SEXO OPUESTO</span>
                                                                        <br>
                                                                        <h5>{{ $ejemplares[$contadoresRazas]['mejorCachoroSexoOpuesto']->numero_prefijo }}</h5>

                                                                        <img class="listonMejor" src="{{ url('img/liston2.png') }}" alt="" width="35%">

                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if($ejemplares[$contadoresRazas]['mejorJoven'] || $ejemplares[$contadoresRazas]['mejorJovenSexoOpuesto'])
                                                            <p class="text-center text-info">
                                                                Joven
                                                            </p>
                                                            <div class="row text-center">
                                                                <div class="col-md-6">
                                                                    @if ($ejemplares[$contadoresRazas]['mejorJoven'])
                                                                        <span class="text-primary">MEJOR JOVEN</span>
                                                                        <br>
                                                                        <h5>{{ $ejemplares[$contadoresRazas]['mejorJoven']->numero_prefijo }}</h5>

                                                                        <img class="listonMejor" src="{{ url('img/liston.png') }}" alt="" width="40%">

                                                                    @endif
                                                                </div>
                                                                <div class="col-md-6">
                                                                    @if ($ejemplares[$contadoresRazas]['mejorJovenSexoOpuesto'])
                                                                        <span class="text-primary">MEJOR SEXO OPUESTO</span>
                                                                        <br>
                                                                        <h5>{{ $ejemplares[$contadoresRazas]['mejorJovenSexoOpuesto']->numero_prefijo }}</h5>

                                                                        <img class="listonMejor" src="{{ url('img/liston.png') }}" alt="" width="40%">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if($ejemplares[$contadoresRazas]['mejorRaza'] || $ejemplares[$contadoresRazas]['mejorRazaSexoOpuesto'])
                                                            <p class="text-center text-info">
                                                                Raza
                                                            </p>
                                                            <div class="row text-center">
                                                                <div class="col-md-6">
                                                                    @if ($ejemplares[$contadoresRazas]['mejorRaza'])
                                                                        <span class="text-primary">MEJOR DE LA RAZA</span>
                                                                        <br>
                                                                        <h5>{{ $ejemplares[$contadoresRazas]['mejorRaza']->numero_prefijo }}</h5>
                                                                        @if($ejemplares[$contadoresRazas]['mejorRaza']->certificacionCLACAB == "Si")
                                                                            <i class="fa fa-star text-primary" aria-hidden="true"></i>  
                                                                        @endif
                                                                        @if($ejemplares[$contadoresRazas]['mejorRaza']->certificacionCACIB == "Si")
                                                                            <i class="fa fa-star text-warning" aria-hidden="true"></i>  
                                                                        @endif

                                                                        <img class="listonMejor" src="{{ url('img/liston1.png') }}" alt="" width="35%">

                                                                    @endif
                                                                </div>
                                                                {{-- <div class="col-md-6" style="background-image: url({{ url('img/liston.png') }});"> --}}
                                                                <div class="col-md-6">
                                                                    @if ($ejemplares[$contadoresRazas]['mejorRazaSexoOpuesto'])
                                                                        <span class="text-primary">MEJOR SEXO OPUESTO</span>
                                                                        <br>
                                                                        <h5>{{ $ejemplares[$contadoresRazas]['mejorRazaSexoOpuesto']->numero_prefijo }}</h5>
                                                                        @if($ejemplares[$contadoresRazas]['mejorRazaSexoOpuesto']->certificacionCLACAB == "Si")
                                                                            <i class="fa fa-star text-primary" aria-hidden="true"></i>  
                                                                        @endif
                                                                        @if($ejemplares[$contadoresRazas]['mejorRazaSexoOpuesto']->certificacionCACIB == "Si")
                                                                            <i class="fa fa-star text-warning" aria-hidden="true"></i>  
                                                                        @endif

                                                                        <img class="listonMejor" src="{{ url('img/liston1.png') }}" alt="" width="35%">

                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <!--end::Desc-->
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                                <!--end::Card-->
                                            </div>
                                        @endif
                                            
                                        @php
                                            $contadoresRazas++;
                                        @endphp
                                    @endfor
                                </div>
                            @endwhile
                        </div>
                    </div>
                    <!--end::Tab Content-->
                    <!--begin::Tab Content-->
                    <div class="tab-pane" id="kt_apps_contacts_view_tab_2" role="tabpanel">
                        <div class="container">
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <h1>CACHORROS ESPECIALES</h1>
                                    <p id="primeroEspecial" class="especiales">
                                        @if ($arrarEspeciales['primero'])
                                            {{ $arrarEspeciales['primero']->numero_prefijo }}
                                        @endif
                                    </p>
                                    <p id="segundoEspecial" class="especiales">
                                        @if ($arrarEspeciales['segundo'])
                                            {{ $arrarEspeciales['segundo']->numero_prefijo }}
                                        @endif
                                    </p>
                                    <p id="terceroEspecial" class="especiales">
                                        @if ($arrarEspeciales['tercer'])
                                            {{ $arrarEspeciales['tercer']->numero_prefijo }}
                                        @endif
                                    </p>
                                    <p id="cuartoEspecial" class="especiales">
                                        @if ($arrarEspeciales['cuarto'])
                                            {{ $arrarEspeciales['cuarto']->numero_prefijo }}
                                        @endif
                                    </p>
                                    <p id="quintooEspecial" class="especiales">
                                        @if ($arrarEspeciales['quinto'])
                                            {{ $arrarEspeciales['quinto']->numero_prefijo }}
                                        @endif
                                    </p>
                                    <img src="{{ url('img/podioKennel.jpg') }}" alt="" width="100%">
                                </div>
                                <div class="col-md-6">
                                    <h1>CACHORROS ABSOLUTOS</h1>
                                    <p id="primeroEspecial" class="especiales">
                                        @if ($arrarAbsoluto['primero'])
                                            {{ $arrarAbsoluto['primero']->numero_prefijo }}
                                        @endif
                                    </p>
                                    <p id="segundoEspecial" class="especiales">
                                        @if ($arrarAbsoluto['segundo'])
                                            {{ $arrarAbsoluto['segundo']->numero_prefijo }}
                                        @endif
                                    </p>
                                    <p id="terceroEspecial" class="especiales">
                                        @if ($arrarAbsoluto['tercer'])
                                            {{ $arrarAbsoluto['tercer']->numero_prefijo }}
                                        @endif
                                    </p>
                                    <p id="cuartoEspecial" class="especiales">
                                        @if ($arrarAbsoluto['cuarto'])
                                            {{ $arrarAbsoluto['cuarto']->numero_prefijo }}
                                        @endif
                                    </p>
                                    <p id="quintooEspecial" class="especiales">
                                        @if ($arrarAbsoluto['quinto'])
                                            {{ $arrarAbsoluto['quinto']->numero_prefijo }}
                                        @endif
                                    </p>
                                    <img src="{{ url('img/podioKennel.jpg') }}" alt="" width="100%">
                                </div>
                            </div>
                            <br>
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <h1>JOVENES</h1>
                                    <p id="primeroEspecial" class="especiales">
                                        @if ($arrarJoven['primero'])
                                            {{ $arrarJoven['primero']->numero_prefijo }}
                                        @endif
                                    </p>
                                    <p id="segundoEspecial" class="especiales">
                                        @if ($arrarJoven['segundo'])
                                            {{ $arrarJoven['segundo']->numero_prefijo }}
                                        @endif
                                    </p>
                                    <p id="terceroEspecial" class="especiales">
                                        @if ($arrarJoven['tercer'])
                                            {{ $arrarJoven['tercer']->numero_prefijo }}
                                        @endif
                                    </p>
                                    <p id="cuartoEspecial" class="especiales">
                                        @if ($arrarJoven['cuarto'])
                                            {{ $arrarJoven['cuarto']->numero_prefijo }}
                                        @endif
                                    </p>
                                    <p id="quintooEspecial" class="especiales">
                                        @if ($arrarJoven['quinto'])
                                            {{ $arrarJoven['quinto']->numero_prefijo }}
                                        @endif
                                    </p>
                                    <img src="{{ url('img/podioKennel.jpg') }}" alt="" width="100%">
                                </div>
                                <div class="col-md-6">
                                    <h1>ADULTOS</h1>
                                    <p id="primeroEspecial" class="especiales">
                                        @if ($arrarAdulto['primero'])
                                            {{ $arrarAdulto['primero']->numero_prefijo }}
                                        @endif
                                    </p>
                                    <p id="segundoEspecial" class="especiales">
                                        @if ($arrarAdulto['segundo'])
                                            {{ $arrarAdulto['segundo']->numero_prefijo }}
                                        @endif
                                    </p>
                                    <p id="terceroEspecial" class="especiales">
                                        @if ($arrarAdulto['tercer'])
                                            {{ $arrarAdulto['tercer']->numero_prefijo }}
                                        @endif
                                    </p>
                                    <p id="cuartoEspecial" class="especiales">
                                        @if ($arrarAdulto['cuarto'])
                                            {{ $arrarAdulto['cuarto']->numero_prefijo }}
                                        @endif
                                    </p>
                                    <p id="quintooEspecial" class="especiales">
                                        @if ($arrarAdulto['quinto'])
                                            {{ $arrarAdulto['quinto']->numero_prefijo }}
                                        @endif
                                    </p>
                                    <img src="{{ url('img/podioKennel.jpg') }}" alt="" width="100%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Body-->
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

    </script>
@endsection
