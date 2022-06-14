@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('metadatos')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')

    
    {{-- inicio modal ganadores  --}}
    <div class="modal fade" id="modalGanadoresEjmeplar" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">MEJORES EJEMPLARES DE LA RAZA <span class="text-info" id="mejor_raza"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="bloque_mejores_ejemplares_machos">
                        
                    </div>

                    <div id="bloque_mejores_ejemplares_hembras">
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info btn-block" onclick="volver()">Volver</button>
                </div>
            </div>
        </div>
    </div>
    {{-- fin inicio modal ganadores --}}

    {{-- inicio modal calificacion  --}}
    {{-- <div class="modal fade" id="modalCalificacionEjmeplar" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CALIFICAION DE <span class="text-info" id="numero_ejemplar"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Calificacion</label>
                            <select name="" id="" class="form-control">
                                <option value="">Excelente</option>
                                <option value="">Muy Bien</option>
                                <option value="">Bien</option>
                                <option value="">Regular</option>
                                <option value="">Descartado</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Ponderacion</label>
                            <select name="" id="" class="form-control">
                                <option value="">1</option>
                                <option value="">2</option>
                                <option value="">3</option>
                                <option value="">4</option>
                                <option value="">5</option>
                                <option value="">6</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info btn-block" onclick="volver()">Volver</button>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- fin inicio modal calificacion --}}

    {{-- inicio modal  --}}
    <div class="modal fade" id="modalCalificacion" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">FORMULARIO DE CALIFICACION</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="ejemplares-categorias">

                    </div>
                    <hr>
                    <div id="bloque_ganador" style="display: none">

                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    {{-- fin inicio modal  --}}

    <!--begin::Card-->
	<div class="card card-custom gutter-b">
		<div class="card-header flex-wrap py-3">
			<div class="card-title">
				<h3 class="card-label">CATEGORIAS</h3>
			</div>
			<div class="card-toolbar">

			</div>
		</div>
		<div class="card-body">

            {{-- <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-success btn-block" onclick="califaicarEjemplares()">Calificar</button>
                </div>
            </div> --}}

            <br>
            <div id="accordion">
                <form action="" id="formulario-calificacion">

                    <input type="text" value="{{ $evento->id }}" name="evento_id">

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
                                                                                <span class="text-info">{{ $razas->raza->nombre." --->".$razas->raza->id }}</span>
                                                                            </h3>
                                                                        </button>
                                                                    </center>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <button class="btn btn-info btn-icon btn-sm" type="button" onclick="modalGanadores('{{ $razas->raza->id }}', '{{ $razas->raza->nombre }}', '{{ $evento->id }}')"><i class="fa fa-list"></i></button>
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

                                                                // dd($categoriasJovenJovenCampeonMacho);

                                                                // dd($categoriaHembra, $categoriaMacho);

                                                                
                                                                echo "<h1>Machos</h1>";
                                                                print_r($categoriasCachorroAbsolutosMacho);
                                                                echo "<hr>";
                                                                print_r($categoriasJovenJovenCampeonMacho);
                                                                echo "<hr>";
                                                                print_r($categoriasIntrerAbierCampeGrandMacho);

                                                                echo "<br><hr><br>";

                                                                echo "<h1>Hembras</h1>";
                                                                print_r($categoriasCachorroAbsolutosHembra);
                                                                echo "<hr>";
                                                                print_r($categoriasJovenJovenCampeonHembra);
                                                                echo "<hr>";
                                                                print_r($categoriasIntrerAbierCampeGrandHembra);

                                                                echo "<br>";
                                                                echo "<br>";
                                                                echo "<br>";
                                                                echo "<br>";
                                                                print_r($arrayCategoriasMachos);
                                                                echo "<br>";
                                                                echo "<hr>";
                                                                echo "<br>";
                                                                print_r($arrayCategoriasHembras);

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

                                                                                        <button class="btn btn-primary btn-block" type="button">
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
                                                                                                        <button class="btn btn-primary btn-block" type="button">
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

                                                            <hr class="border-5 bg-warning">

                                                            <h3 class="text-center text-primary">Machos</h3>
                                                            
                                                            @while ($contadorMacho < $cantCategoriaMacho)
                                                                <div class="row">
                                                                    @for ($i = 0; $i < 3 ; $i++)
                                                                        @if ($contadorMacho < $cantCategoriaMacho)

                                                                            <div class="col-md-3">
                                                                                <table class="table table-hover text-center">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th class="text-primary">
                                                                                                <button class="btn btn-primary btn-block" type="button" onclick="califaicarEjemplares('{{ $categoriaMacho[$contadorMacho]['categoria_id'] }}' ,'{{ $razas->raza_id }}', '{{ $evento->id }}')">
                                                                                                    {{ $categoriaMacho[$contadorMacho]['nombre']}}
                                                                                                </button>
                                                                                            </th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    @php
                                                                                        $categoria_id       =   $categoriaMacho[$contadorMacho]['categoria_id'];
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
                                                                            </div>
                                                                            @php
                                                                                $contadorMacho++;
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

                                                                                        <button class="btn btn-block" type="button"  style="background: #F94EE4 ; color:white">
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
                                                                                                        <button class="btn btn-block" type="button" style="color: white;background: #F94EE4 ;">
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

                                                            <hr class="border-5 bg-warning">

                                                            <h3 class="text-center"  style="color: #F94EE4 ;">Hembras</h3>
                                                            
                                                            @while ($contadorHembra < $cantCategoriaHembra)
                                                                <div class="row">
                                                                    @for ($i = 0; $i < 4 ; $i++)
                                                                        @if ($contadorHembra < $cantCategoriaHembra)
                                                                            <div class="col-md-3">
                                                                                <table class="table table-hover text-center">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th style="color: #F94EE4 ;">
                                                                                                <button type="button" class="btn btn-block" style="background: #F94EE4; color:white;" onclick="califaicarEjemplares('{{ $categoriaHembra[$contadorHembra]['categoria_id'] }}' ,'{{ $razas->raza_id }}', '{{ $evento->id }}')">
                                                                                                    {{ $categoriaHembra[$contadorHembra]['nombre']}}
                                                                                                </button>
                                                                                            </th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    @php
                                                                                        $categoria_id       =   $categoriaHembra[$contadorHembra]['categoria_id'];
                                                                                        $raza_id            =   $razas->raza_id;
                                                                                        $evento_id          =   $evento->id;

                                                                                        $ejemplares = App\Juez::EjemplarCatalogoRaza($categoria_id, $raza_id, $evento_id);

                                                                                    @endphp
                                                                                    <tbody>
                                                                                        @foreach ( $ejemplares as $eje)
                                                                                            @if ($eje->sexo == "Hembra")
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <h1 style="color: #F94EE4;">
                                                                                                            {{ $eje->numero_prefijo }}
                                                                                                        </h1>
                                                                                                    </td>
                                                                                                </tr>    
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            @php
                                                                                $contadorHembra++;
                                                                            @endphp
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                            @endwhile

                                                            {{-- <hr class="border-5 bg-danger">

                                                            @while ($contador < $cantCategoriasRazas)
                                                                <div class="row">
                                                                    @for ($i = 0; $i < 4 ; $i++)
                                                                        @if ($contador < $cantCategoriasRazas)
                                                                            <div class="col-md-3">
                                                                                <table class="table table-hover text-center">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>{{ $categoriasRaza[$contador]->categoriaPista->nombre }}</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    @php

                                                                                        $categoria_id =   $categoriasRaza[$contador]->categoria_pista_id;
                                                                                        $raza_id            =   $razas->raza_id;
                                                                                        $evento_id          =   $evento->id;

                                                                                        $ejemplares = App\Juez::EjemplarCatalogoRaza($categoria_id, $raza_id, $evento_id);

                                                                                    @endphp
                                                                                    <tbody>
                                                                                        @foreach ( $ejemplares as $eje)
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <button class="btn btn-block btn-success" onclick="calificar('{{ $eje->numero_prefijo }}')" type="button">
                                                                                                        {{ $eje->numero_prefijo }}
                                                                                                    </button>
                                                                                                </td>
                                                                                            </tr>    
                                                                                        @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            @php
                                                                                $contador++;
                                                                            @endphp
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                            @endwhile --}}

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

            console.log($('#'+ejmplares).val());

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

        function finalizarCalificacion(ejemplarEvento, raza, evento, categoria, sexo, numero, ejemplar){

            var datos = $('#formularioCalificacionCategoria').serialize();

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

                            $('#bloque_ganador').html(data.ganadorhtml);
                            $('#bloque_ganador').toggle('show');

                            console.log("si")


                        }else{
                            console.log("no")
                        }

                    }else{

                        $(data.ejemplar_evento_id).each(function(index, element) {

                            $("._"+element).css("display", "block");

                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Hay calificacion repedita!',
                            text: 'Revise la planilla!',
                            // footer: '<a href="">Why do I have this issue?</a>'
                        })


                    }

                }

            });

        }

        function modalGanadores(raza, nombre, evento){

            $.ajax({

                url: "{{ url('Juez/ajaxGanadores') }}",
                data: {
                    raza        : raza,
                    evento      : evento,
                },
                type: 'POST',
                dataType: 'json',
                success: function(data) {

                    // console.log(data);
                    $('#bloque_mejores_ejemplares_machos').html(data.table_machos)
                    $('#bloque_mejores_ejemplares_hembras').html(data.table_hembras)

                    $('#mejor_raza').text(nombre);
                    $('#modalGanadoresEjmeplar').modal('show');

                    // if(data.status === "success"){

                    //     $('#bloque_ganador').css('display', 'none');

                    //     $('#ejemplares-categorias').html(data.table)
                    //     $('#modalCalificacion').modal('show');

                    // }else{

                    // }

                }

            });

        }

    </script>
   
@endsection

