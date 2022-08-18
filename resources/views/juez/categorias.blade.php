@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('metadatos')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')

    {{-- inicio modal BESTING  --}}
    <div class="modal fade" id="modalPlanillaFinales" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">PLANILLA DE FINALES DE <span class="text-info" id="finales"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-bs">
                        <!--Begin::Header-->
                        <div class="card-header card-header-tabs-line">
                            <div class="card-toolbar">
                                <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x" role="tablist">
                                    <li class="nav-item mr-3">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_apps_contacts_view_tab_2">
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
                                            <span class="nav-text font-weight-bold">GANADORES DE RAZA</span>
                                        </a>
                                    </li>
                                    <li class="nav-item mr-3">
                                        <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_3">
                                            <span class="nav-icon mr-2">
                                                <span class="svg-icon mr-3">
                                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Devices/Display1.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path d="M11,20 L11,17 C11,16.4477153 11.4477153,16 12,16 C12.5522847,16 13,16.4477153 13,17 L13,20 L15.5,20 C15.7761424,20 16,20.2238576 16,20.5 C16,20.7761424 15.7761424,21 15.5,21 L8.5,21 C8.22385763,21 8,20.7761424 8,20.5 C8,20.2238576 8.22385763,20 8.5,20 L11,20 Z" fill="#000000" opacity="0.3" />
                                                            <path d="M3,5 L21,5 C21.5522847,5 22,5.44771525 22,6 L22,16 C22,16.5522847 21.5522847,17 21,17 L3,17 C2.44771525,17 2,16.5522847 2,16 L2,6 C2,5.44771525 2.44771525,5 3,5 Z M4.5,8 C4.22385763,8 4,8.22385763 4,8.5 C4,8.77614237 4.22385763,9 4.5,9 L13.5,9 C13.7761424,9 14,8.77614237 14,8.5 C14,8.22385763 13.7761424,8 13.5,8 L4.5,8 Z M4.5,10 C4.22385763,10 4,10.2238576 4,10.5 C4,10.7761424 4.22385763,11 4.5,11 L7.5,11 C7.77614237,11 8,10.7761424 8,10.5 C8,10.2238576 7.77614237,10 7.5,10 L4.5,10 Z" fill="#000000" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                            <span class="nav-text font-weight-bold">BEST IN SHOW <span class="text-info" id="finales1"></span></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--Begin::Body-->
                        <div class="card-body px-0">
                            <div class="tab-content pt-5">
                                <!--begin::Tab Content-->
                                <div class="tab-pane active" id="kt_apps_contacts_view_tab_2" role="tabpanel">
                                    <div id="tabla-finales" class="table-responsive">

                                    </div>
                                </div>
                                <!--end::Tab Content-->
                                <!--begin::Tab Content-->
                                <div class="tab-pane" id="kt_apps_contacts_view_tab_3" role="tabpanel">
                                    <div id="besting_ya_ganadores">

                                    </div>
                                    <hr>
                                    <h3 class="text-success text-center">PLANILLA</h3>
                                    <div id="besting_finalistas">

                                    </div>
                                </div>
                                <!--end::Tab Content-->
                                <!--begin::Tab Content-->
                                <div class="tab-pane" id="kt_apps_contacts_view_tab_4" role="tabpanel">
                                    <h1>Este es el cuarto</h1>
                                </div>
                                <!--end::Tab Content-->
                                <!--begin::Tab Content-->
                                <div class="tab-pane" id="kt_apps_contacts_view_tab_1" role="tabpanel">
                                    <h1>Este es el cuarto</h1>
                                </div>
                                <!--end::Tab Content-->
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    {{-- fin inicio modal BESTING  --}}


    {{-- inicio modal  --}}
    <div class="modal fade" id="modalGanadores" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">GANADORES DE RAZA <span class="text-info" id="vencedor_raza"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="text-primary text-center">Vencedores Machos</h6>
                    <div id="vencedores_machos" class="table-responsive">

                    </div>

                    <hr>

                    <h6 style="text-align: center; color:#F94EE4;">Vencedores Hembras</h6>
                    <div id="vencedores_hembras" class="table-responsive">

                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div id="mejor_macho_vencedor">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="mejor_hembra_vencedor">

                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-4">
                            <div id="select_ecoge_mejor_cachorro">

                            </div>
                            <hr>
                            <div id="bloque_mejor_cachorro_escogido" style="display: none">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div id="select_ecoge_mejor_joven">

                            </div>
                            <hr>
                            <div id="bloque_mejor_joven_escogido" style="display: none">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div id="select_ecoge_mejor_raza">

                            </div>
                            <hr>
                            <div id="bloque_mejor_raza_escogido" style="display: none">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    {{-- fin inicio modal  --}}


    {{-- inicio modal  --}}
    <div class="modal fade" id="modalCalificacionCategorias" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">FORMULARIO DE CALIFICACION DE LA RAZA  <span id="nombre_raza_calificacion" class="text-info"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>

                <input type="hidden" id="valoresGanadores" value="0">
                <input type="hidden" id="valorCambiaCertificado" value="0">

                <div class="modal-body">
                    <div id="ejemplares-categorias" class="row">

                    </div>
                    <hr>
                    
                    <div id="bloques_ganadores">

                    </div>
                    <hr>
                    
                    <div id="bloques_mejor_categoria" style="display: none">

                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    {{-- fin inicio modal  --}}

    
    {{-- inicio modal planilla  --}}
    <div class="modal fade" id="modalPlanillaFinal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">PLANILLA DE CALIFICACION</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                  <br>
                  <div id="planilla_final" style="height: 700px;">
                  </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info btn-block" onclick="volver()">Volver</button>
                </div>
            </div>
        </div>
    </div>
    {{-- fin inicio modal ganadores --}}

    <!--begin::Card-->
	<div class="card card-custom gutter-b">
		<div class="card-header flex-wrap py-3">
			<div class="card-title">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="card-label">CATEGORIAS</h3>
                    </div>
                </div>

			</div>
			<div class="card-toolbar">
                <div class="row">
                    <div class="col-md-3">
                        <button type="button" onclick="bestingGanadores('{{ $evento->id }}', 'especiales')" class="btn btn-success">Especiales</button>
                    </div>
                    <div class="col-md-3">
                        <button type="button" onclick="bestingGanadores('{{ $evento->id }}', 'absolutos')" class="btn btn-success">Absolutos</button>
                    </div>
                    <div class="col-md-3">
                        <button type="button" onclick="bestingGanadores('{{ $evento->id }}', 'jovenes')" class="btn btn-success">Jovenes</button>
                    </div>
                    <div class="col-md-3">
                        <button type="button" onclick="bestingGanadores('{{ $evento->id }}', 'adultos')" class="btn btn-success">Adultos</button>
                    </div>
                </div>
			</div>
		</div>
		<div class="card-body">
            <div id="accordion">
                <form action="" id="formulario-calificacion">

                    <input type="hidden" value="{{ $evento->id }}" name="evento_id">
                    <input type="hidden" value="{{ ($asignacion->estado == 1)? $asignacion->num_pista : 0  }}" name="asignacion_id">

                    {{-- @dd($arrayEjemplaresTotal) --}}

                    @foreach ($arrayEjemplaresTotal as $key => $a)

                        @if(count($a['ejemplares']) > 0)

                            <div class="card">
                                <div class="card-header" id="headingOne{{ $key }}">
                                    <h5 class="mb-0">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <center>
                                                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne{{ $key }}" aria-expanded="false" aria-controls="collapseOne{{ $key }}">
                                                        <h3> {{ $a['grupo'] }}</h3>
                                                    </button>
                                                </center>
                                            </div>
                                        </div>
                                    </h5>
                                </div>
                            
                                <div id="collapseOne{{ $key }}" class="collapse" aria-labelledby="headingOne{{ $key }}" data-parent="#accordion">
                                    <div class="card-body">
                                        @php
                                            $ejemplaresRazas = $a['ejemplares'];
                                        @endphp

                                        <div id="accordionRasas{{ $key }}">

                                            @foreach($ejemplaresRazas as $keyRazas => $razas)

                                                <div class="card">
                                                    <div class="card-header" id="headingOneRazas{{ $keyRazas."_".$key }}">
                                                        <h5 class="mb-0">
                                                            <div class="row">
                                                                <div class="col-md-11">
                                                                    <center>
                                                                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOneRazas{{ $keyRazas."_".$key }}" aria-expanded="true" aria-controls="collapseOneRazas{{ $keyRazas."_".$key }}">
                                                                            <h6>
                                                                                <span class="text-info">{{ str_replace([1,2,3,4,5,6,7,8,9,0, '(', ')'], '', $razas->raza->nombre) }}</span>
                                                                            </h3>
                                                                        </button>
                                                                    </center>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <button class="btn btn-primary btn-icon btn-sm" type="button" onclick="modalGanadores('{{ $razas->raza->id }}', '{{ $evento->id }}', '{{ str_replace([1,2,3,4,5,6,7,8,9,0, '(', ')'], '', $razas->raza->nombre) }}')"><i class="fa fa-list"></i></button>
                                                                    {{-- <button class="btn btn-primary btn-icon btn-sm" type="button" onclick="modalGanadores('{{ $razas->raza->id }}', '{{ $evento->id }}', '{{ $razas->raza->nombre }}')"><i class="fa fa-list"></i></button> --}}
                                                                </div>
                                                            </div>
                                                        </h5>

                                                    </div>
                                            
                                                    <div id="collapseOneRazas{{ $keyRazas."_".$key }}" class="collapse" aria-labelledby="headingOneRazas{{ $keyRazas."_".$key }}" data-parent="#accordionRasas{{ $key }}">
                                                        <div class="card-body">

                                                            <hr>

                                                            @php

                                                                $categoriasRaza = App\Juez::categoriaRaza($evento->id, $razas->raza_id);

                                                                $cantCategoriasRazas = count($categoriasRaza);

                                                                $contadorHembra = 0 ;
                                                                $contadorMacho = 0 ;
                                                                $contador = 0;

                                                                $categoriaHembra = array();
                                                                $categoriaMacho  = array();

                                                                // para las categorias
                                                                $categoriasCachorroAbsolutosMacho        = array();
                                                                $categoriasJovenJovenCampeonMacho        = array();
                                                                $categoriasIntrerAbierCampeGrandMacho    = array();

                                                                $categoriasCachorroAbsolutosHembra        = array();
                                                                $categoriasJovenJovenCampeonHembra        = array();
                                                                $categoriasIntrerAbierCampeGrandHembra    = array();

                                                                foreach ($categoriasRaza as $cr){

                                                                    if($cr->categoria_pista_id != 1){

                                                                        $dato = array(
                                                                            'nombre'         => $cr->categoriaPista->nombre,
                                                                            'categoria_id'   => $cr->categoria_pista_id
                                                                        );

                                                                        if($cr->categoria_pista_id == 2 || $cr->categoria_pista_id == 4 || $cr->categoria_pista_id == 6 || $cr->categoria_pista_id == 8 || $cr->categoria_pista_id == 10 || $cr->categoria_pista_id == 13 || $cr->categoria_pista_id == 15 || $cr->categoria_pista_id == 17){

                                                                            array_push($categoriaHembra, $dato);

                                                                        }elseif($cr->categoria_pista_id == 1){
                                                                            
                                                                            array_push($categoriaHembra, $dato);
                                                                            array_push($categoriaMacho, $dato);

                                                                        }else{
                                                                            
                                                                            array_push($categoriaMacho, $dato);

                                                                        }

                                                                        // PARA JOVEN Y JOVEN CAMPEON MACHOS
                                                                        if($cr->categoria_pista_id == 3 || $cr->categoria_pista_id == 12){

                                                                            $dato = array(
                                                                                'nombre'         => $cr->categoriaPista->nombre,
                                                                                'categoria_id'   => $cr->categoria_pista_id
                                                                            );

                                                                            array_push($categoriasJovenJovenCampeonMacho,$dato);

                                                                        }

                                                                        // PARA INTERMEDIA, ABIERTA, CAMPEONES Y GRANDES CAMPEONES MACHOS
                                                                        if($cr->categoria_pista_id == 5 || $cr->categoria_pista_id == 7 || $cr->categoria_pista_id == 9 || $cr->categoria_pista_id == 14){

                                                                            $dato = array(
                                                                                'nombre'         => $cr->categoriaPista->nombre,
                                                                                'categoria_id'   => $cr->categoria_pista_id
                                                                            );

                                                                            array_push($categoriasIntrerAbierCampeGrandMacho, $dato);
                                                                        }

                                                                        // PARA LOS CACHORROS ABSOLUTOS MACHOS
                                                                        if($cr->categoria_pista_id == 11){

                                                                            $dato = array(
                                                                                'nombre'         => $cr->categoriaPista->nombre,
                                                                                'categoria_id'   => $cr->categoria_pista_id
                                                                            );

                                                                            array_push($categoriasCachorroAbsolutosMacho, $dato);
                                                                        }

                                                                        // PARA JOVEN Y JOVEN CAMPEON HEMBRAS
                                                                        if($cr->categoria_pista_id == 4 || $cr->categoria_pista_id == 13){

                                                                            $dato = array(
                                                                                'nombre'         => $cr->categoriaPista->nombre,
                                                                                'categoria_id'   => $cr->categoria_pista_id
                                                                            );

                                                                            array_push($categoriasJovenJovenCampeonHembra,$dato);
                                                                        }

                                                                        // PARA INTERMEDIA, ABIERTA, CAMPEONES Y GRANDES CAMPEONES HEMBRAS
                                                                        if($cr->categoria_pista_id == 6 || $cr->categoria_pista_id == 8 || $cr->categoria_pista_id == 10 || $cr->categoria_pista_id == 15){

                                                                            $dato = array(
                                                                                'nombre'         => $cr->categoriaPista->nombre,
                                                                                'categoria_id'   => $cr->categoria_pista_id
                                                                            );

                                                                            array_push($categoriasIntrerAbierCampeGrandHembra,$dato);
                                                                        }

                                                                        // PARA LOS CACHORROS ABSOLUTOS MACHOS
                                                                        if($cr->categoria_pista_id == 2){

                                                                            $dato = array(
                                                                                'nombre'         => $cr->categoriaPista->nombre,
                                                                                'categoria_id'   => $cr->categoria_pista_id
                                                                            );

                                                                            array_push($categoriasCachorroAbsolutosHembra, $dato);
                                                                        }
                                                                    }

                                                                }
                                                                
                                                                // PARA MACHO
                                                                $arrayCategoriasMachos = array();

                                                                array_push($arrayCategoriasMachos,$categoriasCachorroAbsolutosMacho);
                                                                array_push($arrayCategoriasMachos,$categoriasJovenJovenCampeonMacho);
                                                                array_push($arrayCategoriasMachos,$categoriasIntrerAbierCampeGrandMacho);

                                                                // PARA HEMBRAS
                                                                $arrayCategoriasHembras = array();

                                                                array_push($arrayCategoriasHembras,$categoriasCachorroAbsolutosHembra);
                                                                array_push($arrayCategoriasHembras,$categoriasJovenJovenCampeonHembra);
                                                                array_push($arrayCategoriasHembras,$categoriasIntrerAbierCampeGrandHembra);

                                                                $cantCategoriaHembra = count($categoriaHembra);
                                                                $cantCategoriaMacho = count($categoriaMacho);

                                                                $contadorArryaMacho = 0 ;
                                                                $contadorMacho1 = 0;

                                                                
                                                                $contadorArryaHembra = 0 ;
                                                                $contadorHembra1 = 0;

                                                            @endphp

                                                                
                                                            <h3 class="text-center text-primary">Machos</h3>
                                                            
                                                            @while ($contadorArryaMacho < 3)
                                                                <div class="row">
                                                                    @for ($i = 0; $i < 3 ; $i++)
                                                                        @if ($contadorArryaMacho < 3)

                                                                            @if (count($arrayCategoriasMachos[$contadorArryaMacho]) != 0)
                                                                                <div class="col-md-4">
                                                                                    
                                                                                    @if (count($arrayCategoriasMachos[$contadorArryaMacho]) > 1)

                                                                                        @php
                                                                                            $contadorMacho1 = 0;
                                                                                        @endphp 

                                                                                        <button class="btn btn-primary btn-block" type="button" onclick="modalcategorias({{ json_encode($arrayCategoriasMachos[$contadorArryaMacho]) }}, '{{ $razas->raza_id }}', '{{ $evento->id }}', '{{ str_replace([1,2,3,4,5,6,7,8,9,0 ,'(',')'], '',$razas->raza->nombre) }}', '{{ ($asignacion->estado == 1)? $asignacion->num_pista : 0  }}')">
                                                                                            @foreach ( $arrayCategoriasMachos[$contadorArryaMacho] as $cate)

                                                                                                {{ $cate['nombre'].' <-> ' }}

                                                                                            @endforeach
                                                                                        </button>

                                                                                        <div class="row">
                                                                                            @foreach ( $arrayCategoriasMachos[$contadorArryaMacho] as $ejemCAte)
                                                                                            <div class="col-md-6">
                                                                                                <table class="table table-hover text-center">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th>{{ $ejemCAte['nombre'] }}</th>
                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                        @php
                                                                                                            $categoria_id       =   $ejemCAte['categoria_id'];
                                                                                                            $raza_id            =   $razas->raza_id;
                                                                                                            $evento_id          =   $evento->id;

                                                                                                            $ejemplares = App\Juez::EjemplarCatalogoRaza($categoria_id, $raza_id, $evento_id);

                                                                                                        @endphp
                                                                                                    <tbody>

                                                                                                        @foreach ( $ejemplares  as  $eje)
                                                                                                            <tr>
                                                                                                                <td>
                                                                                                                    <h1 class="text-primary">
                                                                                                                        {{ $eje->numero_prefijo }}
                                                                                                                    </h1>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        @endforeach
                                                                                                        
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                            @endforeach
                                                                                        </div>

                                                                                    @else
                                                                                        <table class="table table-hover text-center">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th class="text-primary">
                                                                                                        <button class="btn btn-primary btn-block" type="button" onclick="modalcategorias({{ json_encode($arrayCategoriasMachos[$contadorArryaMacho]) }}, '{{ $razas->raza_id }}', '{{ $evento->id }}', '{{ str_replace([1,2,3,4,5,6,7,8,9,0 ,'(',')'], '',$razas->raza->nombre) }}', '{{ ($asignacion->estado == 1)? $asignacion->num_pista : 0  }}')">
                                                                                                            {{ $arrayCategoriasMachos[$contadorArryaMacho][0]['nombre'] }}
                                                                                                        </button>
                                                                                                    </th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            @php
                                                                                                $categoria_id       =   $arrayCategoriasMachos[$contadorArryaMacho][0]['categoria_id'];
                                                                                                $raza_id            =   $razas->raza_id;
                                                                                                $evento_id          =   $evento->id;

                                                                                                $ejemplares = App\Juez::EjemplarCatalogoRaza($categoria_id, $raza_id, $evento_id);

                                                                                            @endphp
                                                                                            <tbody>
                                                                                                @foreach ( $ejemplares as $eje)
                                                                                                    @if ($eje->sexo == 'Macho')
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <h1 class="text-primary">
                                                                                                                    {{ $eje->numero_prefijo }}
                                                                                                                </h1>
                                                                                                            </td>
                                                                                                        </tr>    
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </tbody>
                                                                                        </table>

                                                                                    @endif
                                                                                </div>
                                                                            @endif

                                                                            @php
                                                                                $contadorMacho1++;
                                                                                $contadorArryaMacho++;
                                                                            @endphp
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                            @endwhile

                                                            <hr class="border-5 bg-dark">

                                                            <h3 class="text-center" style="color: #F94EE4 ;">Hembras</h3>
                                                            @while ($contadorArryaHembra < 3)
                                                                <div class="row">
                                                                    @for ($i = 0; $i < 3 ; $i++)
                                                                        @if ($contadorArryaHembra < 3)

                                                                            @if (count($arrayCategoriasHembras[$contadorArryaHembra]) != 0)
                                                                                <div class="col-md-4">
                                                                                    
                                                                                    @if (count($arrayCategoriasHembras[$contadorArryaHembra]) > 1)

                                                                                        @php
                                                                                            $contadorHembra1 = 0;
                                                                                        @endphp 

                                                                                        <button class="btn btn-block" type="button"  style="background: #F94EE4 ; color:white" onclick="modalcategorias({{ json_encode($arrayCategoriasHembras[$contadorArryaHembra]) }}, '{{ $razas->raza_id }}', '{{ $evento->id }}', '{{ str_replace([1,2,3,4,5,6,7,8,9,0 ,'(',')'], '',$razas->raza->nombre) }}', '{{ ($asignacion->estado == 1)? $asignacion->num_pista : 0  }}')">
                                                                                            @foreach ( $arrayCategoriasHembras[$contadorArryaHembra] as $cate)
                                                                                                {{ $cate['nombre'].' <-> ' }}
                                                                                            @endforeach
                                                                                        </button>
                                                                                        <div class="row">
                                                                                            @foreach ( $arrayCategoriasHembras[$contadorArryaHembra] as $ejemCAte)
                                                                                            <div class="col-md-6">
                                                                                                <table class="table table-hover text-center">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th>{{ $ejemCAte['nombre'] }}</th>
                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                        @php
                                                                                                            $categoria_id       =   $ejemCAte['categoria_id'];
                                                                                                            $raza_id            =   $razas->raza_id;
                                                                                                            $evento_id          =   $evento->id;

                                                                                                            $ejemplares = App\Juez::EjemplarCatalogoRaza($categoria_id, $raza_id, $evento_id);

                                                                                                        @endphp
                                                                                                    <tbody>

                                                                                                        @foreach ( $ejemplares  as  $eje)
                                                                                                            <tr>
                                                                                                                <td>
                                                                                                                    <h1  style="color: #F94EE4 ;">
                                                                                                                        {{ $eje->numero_prefijo }}
                                                                                                                    </h1>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        @endforeach
                                                                                                        
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                            @endforeach
                                                                                        </div>

                                                                                    @else
                                                                                        <table class="table table-hover text-center">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th class="text-primary">
                                                                                                        <button class="btn btn-block" type="button" style="color: white;background: #F94EE4 ;" onclick="modalcategorias({{ json_encode($arrayCategoriasHembras[$contadorArryaHembra]) }}, '{{ $razas->raza_id }}', '{{ $evento->id }}', '{{ str_replace([1,2,3,4,5,6,7,8,9,0 ,'(',')'], '',$razas->raza->nombre) }}', '{{ ($asignacion->estado == 1)? $asignacion->num_pista : 0  }}')">
                                                                                                            {{ $arrayCategoriasHembras[$contadorArryaHembra][0]['nombre'] }}
                                                                                                        </button>
                                                                                                    </th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            @php
                                                                                                $categoria_id       =   $arrayCategoriasHembras[$contadorArryaHembra][0]['categoria_id'];
                                                                                                $raza_id            =   $razas->raza_id;
                                                                                                $evento_id          =   $evento->id;

                                                                                                $ejemplares = App\Juez::EjemplarCatalogoRaza($categoria_id, $raza_id, $evento_id);

                                                                                            @endphp
                                                                                            <tbody>
                                                                                                @foreach ( $ejemplares as $eje)
                                                                                                    @if ($eje->sexo == 'Hembra')
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <h1 style="color: #F94EE4 ;">
                                                                                                                    {{ $eje->numero_prefijo }}
                                                                                                                </h1>
                                                                                                            </td>
                                                                                                        </tr>    
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </tbody>
                                                                                        </table>

                                                                                    @endif
                                                                                </div>
                                                                            @endif

                                                                            @php
                                                                                $contadorHembra1++;
                                                                                $contadorArryaHembra++;
                                                                            @endphp
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                            @endwhile

                                                            <div class="col-lg-4">
                                                                <!--begin::Card-->
                                                                <a href="#" class="card card-custom wave wave-animate-slow bg-grey-100 mb-8 mb-lg-0">
                                                                    
                                                                </a>
                                                                <!--end::Card-->
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach

                                        </div>

                                    </div>
                                </div>
                            </div>    
                        @endif
    
                    @endforeach
                </form>
            </div>
            
		</div>
	</div>
	<!--end::Card-->

@stop

@section('js')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

    <script type="text/javascript">

        $( document ).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        function checkEjemplares(ejmplares){

            var isChecked = document.getElementById(ejmplares).checked;

            if(!isChecked){
                var elementos = document.getElementsByClassName(ejmplares);

                for(var i = 0; i < elementos.length ; i++){
                    $("#"+elementos[i].id).prop('checked', false);
                }    

            }else{

                var elementos = document.getElementsByClassName(ejmplares);

                for(var i = 0; i < elementos.length ; i++){
                    $("#"+elementos[i].id).prop('checked', true);
                }

            }
        }

        function califaicarEjemplares(categoria, raza, evento){

            $.ajax({

                url: "{{ url('Juez/AjaxEjemplarCatalogoRaza') }}",
                data: {
                    categoria: categoria,
                    raza: raza,
                    evento: evento
                },
                type: 'POST',
                dataType: 'json',
                success: function(data) {

                    if(data.status === "success"){

                        $('#bloque_ganador').css('display', 'none');

                        $('#ejemplares-categorias').html(data.table)
                        $('#modalCalificacion').modal('show');

                    }else{

                    }

                }

            });

        }

        function calificar(numero){

            $('#numero_ejemplar').text(numero);

            $('#modalCalificacion').modal('hide');
            $('#modalCalificacionEjmeplar').modal('show');

        }

        function volver(){
            
            $('#modalCalificacion').modal('show');
            $('#modalCalificacionEjmeplar').modal('hide');

        }

        function finalizarCalificacion(categoria){

            Swal.fire({
                title: 'Esta seguro de calificar la categoria?',
                text: "No podra revertir eso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, estoy seguro!'
            }).then((result) => {
                if (result.isConfirmed) {

                    var datos = $('#formulario_'+categoria).serialize();

                    $.ajax({

                        url: "{{ url('Juez/ajaxFinalizarCalificacion') }}",
                        data: datos,
                        type: 'POST',
                        dataType: 'json',
                        success: function(data) {

                            $(data.ejemplar_enviados).each(function(index, element) {

                                $("._"+element).css("display", "none");

                            });

                            if(data.status === 'success'){

                                if(data.ganador){

                                    $('#ganador_'+data.categoria).html(data.ganadorhtml);
                                    $('#ganador_'+data.categoria).show('toggle');

                                    // bloqueamos el boton
                                    // $('#button_'+categoria).prop('disabled', true);

                                    $('#valoresGanadores').val($('#valoresGanadores').val()+","+data.gandadorActivo);

                                    // ESTO PARA CAMBIAR DEL CERTIFICADO
                                    if(data.intercambioCertificado){
                                        $('#valorCambiaCertificado').val($('#valorCambiaCertificado').val()+","+data.intercambioCertificado);
                                    }

                                }else{
                                    $('#ganador_'+data.categoria).html('');
                                }

                            }else{

                                $(data.ejemplar_evento_id).each(function(index, element) {

                                    $("._"+element).css("display", "block");

                                });

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Hay calificacion repedita!',
                                    text: 'Revise la planilla!',
                                })
                            }

                        }

                    });

                }
            })

        }

        function modalPlanilla(raza, nombre, evento){

            $.ajax({

                url: "{{ url('Juez/ajaxPlanilla') }}",
                data: {
                    raza        : raza,
                    evento      : evento,
                },
                type: 'POST',
                dataType: 'json',
                success: function(data) {

                    $('#planilla_final').html(data.planilla);

                    $('#modalPlanillaFinal').modal('show'); 

                }

            });

        }

        function modalcategorias(array, raza_id, evento_id, nombreRaza, pista){

            $('#valoresGanadores').val(0);
            $('#valorCambiaCertificado').val(0);

            $.ajax({

                url: "{{ url('Juez/ajaxCategoriasCalificacion') }}",
                data: {
                    categorias  :   array,
                    raza        :   raza_id,
                    evento      :   evento_id,
                    pista       :   pista
                },
                type: 'POST',
                dataType: 'json',
                success: function(data) {

                    $('#bloques_ganadores').html(data.divGanadoresCategorias);

                    $('#bloque_ganador').css('display', 'none');
                    $('#bloques_mejor_categoria').css('display', 'none');
                    

                    $('#ejemplares-categorias').html(data.tables);

                    $('#nombre_raza_calificacion').text(nombreRaza);

                    $('#modalCalificacionCategorias').modal('show');

                    // PREGUNTAMOS POR SI HAY GANADOS Y SI YA ESTA REGISTRADO
                    if(data.statusGanador == "success"){
                        
                    }

                    // PREGUNTAMOS SI HAY MEJOR ESCOJIDO
                    if(data.mejorEscogido){

                        $('#bloques_mejor_categoria').show('toggle');
                        $('#bloques_mejor_categoria').html(data.mejorEscogidoHtml);

                    }

                }

            });

        }

        function escogerMejor(ganador, numero, vendedores){

            Swal.fire({
                title: 'Esta seguro de seleccionar al ejemplar con numero '+numero+' como mejor?',
                text: "No podra revertir eso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, estoy seguro!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({

                        url: "{{ url('Juez/ajaxCalificacionMejor') }}",
                        data: {
                            ganador  :   ganador
                        },
                        type: 'POST',
                        dataType: 'json',
                        success: function(data) {

                            $('#bloques_mejor_categoria').html(data.mejor);
                            $('#bloques_mejor_categoria').toggle('show');

                            if($('#valoresGanadores').val() == 0){
                                // bloqueamos el boton
                                $(vendedores).each(function( index , value) {
                                    $('#button_escogeMejor_'+value).prop('disabled', true);
                                });

                            }else{

                                let ganadores = ($('#valoresGanadores').val()).split(",");

                                $(ganadores).each(function( index , value) {
                                    if(value != 0)
                                        $('#button_escogeMejor_'+value).prop('disabled', true);
                                });
                            }

                            // bloqueamos los botones
                            $(data.categoria).each(function(index, value){
                                $('#button_'+value).prop('disabled', true);
                            });
                        }
                    });
                }
            })
        }

        function modalGanadores(raza, evento, nombre_raza){

            $.ajax({

                url: "{{ url('Juez/ajaxGanadores') }}",
                data: {
                    raza    :   raza,
                    evento  :   evento,
                    pista   :   {{ ($asignacion->estado == 1)? $asignacion->num_pista : 0  }}
                },
                type: 'POST',
                dataType: 'json',
                success: function(data){

                    if(data.status === 'success'){

                        // PONEMOS HIDEN TODOS LOS ANTERIORES
                        $('#bloque_mejor_cachorro_escogido').css('display', 'none');
                        $('#bloque_mejor_joven_escogido').css('display', 'none');
                        $('#bloque_mejor_raza_escogido').css('display', 'none');
                        $('#select_ecoge_mejor_raza').html('');

                        $('#mejor_macho_vencedor').css('display', 'block');
                        $('#vencedores_machos').html(data.tableMachos)
                        $('#vencedores_hembras').html(data.tableHembras)

                        // cachorro
                        $('#select_ecoge_mejor_cachorro').html(data.selectCachorro);

                        // joven
                        $('#select_ecoge_mejor_joven').html(data.selectJoven);

                        // seteamos el nombre de la raza
                        $('#vencedor_raza').text(nombre_raza);

                        $('#modalGanadores').modal('show');

                        if(data.MejoOpuestoJoven){

                            $('#bloque_mejor_joven_escogido').html(data.htmlMejoOpuestoJoven);
                            $('#bloque_mejor_joven_escogido').show('toggle');

                        }

                        console.log(data.mejorRaza)

                        // para el mejro de la raza
                        if(data.mejorRaza == "mejor_raza_calificado"){

                            $('#bloque_mejor_raza_escogido').html(data.mejorRazaHtml);
                            $('#bloque_mejor_raza_escogido').show('toggle');

                        }else if(data.mejorRaza == "mejor_raza_sin_calificado"){

                            $('#select_ecoge_mejor_raza').html(data.mejorRazaHtml);
                            
                        }

                        // para los mejores vencedores
                        $('#mejor_macho_vencedor').html(data.mejor_vencedor_macho);
                        $('#mejor_hembra_vencedor').html(data.mejor_vencedor_hembra);

                    }

                }

            });

        }

        function mejorVencedores(sexo){

            var name = 'mejor_'+sexo;

            var mejores = document.getElementsByName(name);
            var conta = 0;
            var vencedor = 0;

            for (let index = 0; index < mejores.length; index++) {
                const element = mejores[index];
                if(element.checked){
                    conta++;
                    vencedor = element;
                    break;
                }
            }

            if(conta > 0){

                Swal.fire({
                title: 'Esta seguro de calificar mejor '+sexo+'?',
                text: "No podra revertir eso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, estoy seguro!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('Juez/mejorVencedores') }}",
                            data: {
                                vencedor : vencedor.value,
                                pista    : {{ ($asignacion->estado == 1)? $asignacion->num_pista : 0  }}
                            },
                            type: 'POST',
                            dataType: 'json',
                            success: function(data){

                                if(data.status === "success"){

                                    if(data.sexo === 'Macho'){

                                        $('#mejor_macho_vencedor').html(data.html);
                                        // $('#mejor_macho_vencedor').toggle('show');

                                    }else{
                                        
                                        $('#mejor_hembra_vencedor').html(data.html);
                                        // $('#mejor_hembra_vencedor').toggle('show');

                                    }

                                    $('#select_ecoge_mejor_raza').html(data.selectMejoresRaza);

                                    // bloquemos los botones
                                    $('#button_mejor_'+sexo).prop('disabled', true);

                                }else{

                                }

                            }
                        });

                    }
                })
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Debe seleccionar un mejor macho!',
                    text: 'Revise la planilla!',
                })
            }
        }

        function guardaMejor(tipo){

            var valor = 'select_'+tipo+'_mejor';

            Swal.fire({
                title: 'Esta seguro de poner a '+$('select[name='+valor+'] option:selected').text()+' como mejor '+tipo+'?',
                text: "No podra revertir eso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, estoy seguro!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ url('Juez/mejorRazaFinPlanilla') }}",
                        data: {
                            vencedor : $('#select_'+tipo+'_mejor').val(),
                            tipo : tipo,
                            pista : {{ ($asignacion->estado == 1)? $asignacion->num_pista : 0  }}
                        },
                        type: 'POST',
                        dataType: 'json',
                        success: function(data){

                            if(data.status === "success"){

                                $('#select_ecoge_mejor_raza').html(data.selectMejoresRaza);

                                $('#bloque_mejor_'+data.tipo+'_escogido').toggle('show');
                                $('#bloque_mejor_'+data.tipo+'_escogido').html(data.mejor);

                                // bloqueamos el boton
                                $('#button_guarda_mejo_'+data.tipo).prop('disabled', true);

                            }else{

                            }

                        }
                    });
                }   

            })


        }

        function bestingGanadores(evento, tipo){    

            $.ajax({
                url: "{{ url('Juez/bestingGanadores') }}",
                data: {
                    evento  : evento,
                    tipo    : tipo,
                    pista   : {{ ($asignacion->estado == 1)? $asignacion->num_pista : 0  }}
                },
                type: 'POST',
                dataType: 'json',
                success: function(data){

                    if(data.status === "success"){
                        
                        $('#finales').text((tipo.toString()).toUpperCase());
                        $('#finales1').text((tipo.toString()).toUpperCase());
    
                        $('#tabla-finales').html(data.table);

                        $('#besting_finalistas').html(data.finalistas);

                        // MOSTRAMOS LOS GANADORES
                        $('#besting_ya_ganadores').html(data.tablaFinalistasCalificados);
    
                        $('#modalPlanillaFinales').modal('show');

                    }

                }
            });
        }

        function mejorGrupo(grupo, tipo){

            Swal.fire({
                title: 'Esta seguro de realizar la calificacion de grupo?',
                text: "No podra revertir eso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, estoy seguro!'
            }).then((result) => {
                if (result.isConfirmed) {
                
                    // eso es para las calificacione
                    let calificaciones = [];
                    var elemet = document.getElementsByName('grupo_'+grupo+'_[]');
                    for (let index = 0; index < elemet.length; index++) {calificaciones.push(elemet[index].value);}

                    // eso es para las numeros
                    let numeros_prefijos = [];
                    var elemet = document.getElementsByName('numeros_'+grupo+'_[]');
                    for (let index = 0; index < elemet.length; index++) {numeros_prefijos.push(elemet[index].value);}

                    // eso es para las categorias pistas
                    let categorias_pistas = [];
                    var elemet = document.getElementsByName('categoria_pista_ids_'+grupo+'_[]');
                    for (let index = 0; index < elemet.length; index++) {categorias_pistas.push(elemet[index].value);}
                    
                    // eso es para las ejemplares eventos
                    let ejemplares_eventos = [];
                    var elemet = document.getElementsByName('ejemplar_eventos_ids_'+grupo+'_[]');
                    for (let index = 0; index < elemet.length; index++) {ejemplares_eventos.push(elemet[index].value);}

                    // eso es para las ejemplares
                    let ejempleres_id = [];
                    var elemet = document.getElementsByName('ejemplares_ids_'+grupo+'_[]');
                    for (let index = 0; index < elemet.length; index++) {ejempleres_id.push(elemet[index].value);}

                    // eso es para las ganadores id
                    let ganadores_id = [];
                    var elemet = document.getElementsByName('ganador_ids_'+grupo+'_[]');
                    for (let index = 0; index < elemet.length; index++) {ganadores_id.push(elemet[index].value);}

                    // eso es para las razas
                    let razas_id = [];
                    var elemet = document.getElementsByName('raza_ids_'+grupo+'_[]');
                    for (let index = 0; index < elemet.length; index++) {razas_id.push(elemet[index].value);}

                    var tipo = $('#tipo_besting').val();

                    // SETEAMOS TODO
                    $(ejemplares_eventos).each(function(index, value){
                        $("#besting_"+tipo+"_"+grupo+"_"+value).css("display", "none");
                    })

                    $.ajax({
                        url: "{{ url('Juez/calificabesting') }}",
                        data: {
                            calificaciones      : calificaciones,
                            numeros             : numeros_prefijos,
                            categorias_pistas   : categorias_pistas,
                            grupo               : grupo,
                            ejempleres_id       : ejempleres_id,
                            ganadores_id        : ganadores_id,
                            evento              : {{ $evento->id }},
                            ejemplares_eventos  : ejemplares_eventos,
                            razas_ids           : razas_id,
                            tipo                : tipo,
                            pista               : {{ ($asignacion->estado == 1)? $asignacion->num_pista : 0  }}
                        },
                        type: 'POST',
                        dataType: 'json',
                        success: function(data){

                            console.log(data);

                            if(data.status === "success"){

                                if(data.mejor_grupo != null){
                                    $('#mejor_grupo_'+data.grupo+'_numero').html(data.finalistaMejor);
                                    $('#mejor_grupo_'+data.grupo).toggle('show');
                                }

                                if(data.reserva_grupo != null){
                                    $('#reserva_grupo_'+data.grupo+'_numero').html(data.finalistaMejorRecerva);
                                    $('#reserva_grupo_'+data.grupo).toggle('show');
                                }

                                $('#besting_finalistas').html(data.finalistas);

                                // BLOQUEAMOS LOS BOTONES
                                $('#btn_grupo_'+grupo).prop('disabled', true);

                            }else if(data.status === "error_repeat"){

                                $(data.ejemplares_repetidos).each(function(index, value){
                                    $("#besting_"+data.tipo+"_"+data.grupo+"_"+value).css("display", "block");
                                })

                            }else if(data.status === "error_no_calificado"){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Debe calificar como minimo a '+data.cantidad+' participipantes del grupo!',
                                    text: 'Revise la planilla!',
                                })   
                            }

                        }
                    });

                }
            })
        }

        function calificaFinal(select, ganador, numero){

            var calificacion = $('#calificacion_final_'+numero).val();

            Swal.fire({
                title: 'Esta seguro de seleccionar al ejemplar con numero '+numero+' como '+calificacion+' lugar?',
                text: "No podra revertir eso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, estoy seguro!'
            }).then((result) => {
                if (result.isConfirmed) {
                    if(calificacion != null){
                        $.ajax({
                            url: "{{ url('Juez/calificaFinales') }}",
                            data: {
                                ganador         : ganador,
                                numero          : numero,
                                calificacion    : calificacion
                            },
                            type: 'POST',
                            dataType: 'json',
                            success: function(data){

                                if(data.status === "success"){

                                    $('#besting_finalistas').html(data.finalistas);

                                    // MOSTRAMOS LOS GANADORES
                                    $('#besting_ya_ganadores').html(data.tablaFinalistasCalificados);

                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Correcto!',
                                        text: 'Se califico con exito!',
                                    })

                                }

                            }
                        });

                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Debe escoger un puesto!',
                            text: 'Escoja un puesto!',
                        })
                    }
                }
            })

            

        }

        // function cambiaMejor(mejor, recerva, numeroMejor){

        //     Swal.fire({
        //         title: 'Esta seguro de seleccionar al ejemplar con numero '+numeroMejor+' como mejor?',
        //         text: "No podra revertir eso!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Si, estoy seguro!'
        //     }).then((result) => {
        //         if (result.isConfirmed) {

        //             $.ajax({
        //                 url: "{{ url('Juez/cambiaMejorRecerva') }}",
        //                 data: {
        //                     mejor : mejor,
        //                     recerva : recerva
        //                 },
        //                 type: 'POST',
        //                 dataType: 'json',
        //                 success: function(data){

        //                     if(data.status === "success"){

        //                         Swal.fire({
        //                             icon: 'success',
        //                             title: 'Correcto!',
        //                             text: 'Se cambio  con exito!',
        //                         })

        //                         $('#besting_finalistas').html(data.finalistas);
        //                     }
                            
        //                 }
        //             });

        //         }
        //     })
        // }

        function agregaCertificado(certificado, ganador){

            Swal.fire({
                title: 'Esta seguro de agregar la certificacion?',
                text: "No podra revertir eso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, estoy seguro!'
            }).then((result) => {

                if(certificado == 1)
                    var certif = 'certificacionCLACAB_';
                else
                    var certif = 'certificacionCACIB_';

                if( $('#'+certif+ganador).prop('checked') )
                    var sw = true;
                else
                    var sw = false;


                if (result.isConfirmed) {
                    
                    $.ajax({
                        url: "{{ url('Juez/certificacionExtrangero') }}",
                        data: {
                            tipoCertificacion : certificado,
                            ganador           : ganador
                        },
                        type: 'POST',
                        dataType: 'json',
                        success: function(data){

                            if(data.status === "success"){

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Correcto!',
                                    text: 'Se cambio  con exito!',
                                })

                            }
                            
                        }
                    });

                }else{
                    if(sw)
                        $('#'+certif+ganador).prop("checked", false);
                    else
                        $('#'+certif+ganador).prop("checked", true);
                }
            })
        }

        function cambiaCertificado(ganador, existentes){

            Swal.fire({
                title: 'Esta seguro de agregar la certificacion?',
                text: "No podra revertir eso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, estoy seguro!'
            }).then((result) => {

                if( $('#darCertificacion_'+ganador).prop('checked') )
                    var sw = true;
                else
                    var sw = false;


                if (result.isConfirmed) {

                    console.log(ganador, existentes[0]);

                    if(existentes[0] == 0){
                        existentes = ($('#valorCambiaCertificado').val()).split(',');
                    }

                    var puntos = $('#puntos_calificados_'+ganador).val();

                    if(puntos != ""){

                        $.ajax({
                            url: "{{ url('Juez/cambiaCertificado') }}",
                            data: {
                                existentes : existentes,
                                ganador    : ganador,
                                puntos     : puntos
                            },
                            type: 'POST',
                            dataType: 'json',
                            success: function(data){

                                if(data.status === "success"){

                                    console.log("pSERDEOR=> "+data.perdedor, "GANADORS=> "+ganador);

                                    $('#bloque_btn_escogeMejor_'+ganador).show('toggle');
                                    $('#bloque_radio_escogeMejor_'+ganador).hide('toggle');

                                    $('#bloque_radio_escogeMejor_'+data.perdedor).show('toggle');
                                    $('#bloque_btn_escogeMejor_'+data.perdedor).hide('toggle');


                                    if($('#bloque_btn_escogeMejor_'+ganador).css('display') == 'none'){
                                        // Acción si el elemento no es visible
                                        console.log('si visuble el btn'+" bloque_btn_escogeMejor_"+ganador)
                                    }else{
                                        // Acción si el elemento es visible
                                        console.log('nadaa el btn'+" bloque_btn_escogeMejor_"+ganador)
                                    }


                                    if($('#bloque_radio_escogeMejor_'+ganador).css('display') == 'none'){
                                        // Acción si el elemento no es visible
                                        console.log('si visuble el radio'+" bloque_radio_escogeMejor_"+ganador)
                                    }else{
                                        // Acción si el elemento es visible
                                        console.log('nadaa el radio'+" bloque_radio_escogeMejor_"+ganador)
                                    }


                                    if($('#bloque_btn_escogeMejor_'+data.perdedor).css('display') == 'none'){
                                        // Acción si el elemento no es visible
                                        console.log('si visuble el btn data.perdedor'+" bloque_btn_escogeMejor_"+data.perdedor)
                                    }else{
                                        // Acción si el elemento es visible
                                        console.log('nadaa el btn data.perdedor'+" bloque_btn_escogeMejor_"+data.perdedor)
                                    }


                                    if($('#bloque_radio_escogeMejor_'+data.perdedor).css('display') == 'none'){
                                        // Acción si el elemento no es visible
                                        console.log('si visuble el radio data.perdedor '+" bloque_radio_escogeMejor_"+data.perdedor)
                                    }else{
                                        // Acción si el elemento es visible
                                        console.log('nadaa el radio data.perdedor'+" bloque_radio_escogeMejor_"+data.perdedor)
                                    }



                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Correcto!',
                                        text: 'Se cambio  con exito!',
                                    })

                                }
                                
                            }
                        });

                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Falta puntuacion!',
                            text: 'Debe seleccionar un puntaje!',
                            timer: 2000
                        })
                    }
                }else{
                    if(sw)
                        $('#darCertificacion_'+ganador).prop("checked", false);
                    else
                        $('#darCertificacion_'+ganador).prop("checked", true);
                }
            })


        }

    </script>
   
@endsection

