<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Plinilla</title>
</head>
<style>

    .planilla{

        height: 720px;

    }

    .raza{
        position: absolute;
        float: right;
        margin-right: 2px;
        font-size:11px;
    }

    .juez{
        position: absolute;
        font-size:11px;
        {{--  margin-top: 2px;  --}}
    }

    .fecha{
        position: absolute;
        font-size:11px;
        left: 45%;
    }

    #header{
        text-align: center;
    }
    .headerCabezera{
        margin-left: 50px;
        margin-top:-30px;
    }
    .nombreKennel{
        margin-top: -10px;
        font-weight: bold;
    }
    .imgLogo{
        position: relative;
        margin-top: -40px;
    }
    .imgLogoFci{
        position: absolute;
        float: right;
        margin-right: -450px;
        margin-top: -35px;
    }

    .table{
        position: absolute;
        margin-top: 30px;
        border: 0.7px solid black;
        font-size:8px;
        width: 120px;
        border-collapse:collapse;
    }
    .joven{
        /* margin-left: 119px; */
        margin-left: 129px;
        background-color: #c2ddf3;
    }

    .jovenCampeon{
        margin-left: 249px;
        background-color: #c2ddf3;
    }

    .intermedia{
        margin-left: 368px;
        background-color: #ededdd;
    }

    .abierta{
        margin-left: 486px;
        background-color: #ededdd;
    }

    .campoeones{
        margin-left: 605px;
        background-color: #ededdd;
    }

    .grandesCampeones{
        margin-left: 724px;
        background-color: #ededdd;
    }

    .veteranos{
        margin-left: 843px;
    }

    /* ESPASCION BORDES */
    .bordes{
        border: 1px solid black;
    }
    .espacionCabeceraTable{
        padding-top: 5px;
        padding-bottom:5;
    }

    .espacionCeldasVacias{
        height: 15px;
    }
    .contenidoCeldasLlenas{
        height: 15px;
        font-size: 12px;
    }

    .certificados{
        position: absolute;
        border: 1px solid black;
        width: 118px;
        margin-top: 178px;
        font-size:10px;
    }
    .tableCertificado{
        border: 1px solid black;
        position: relative;
        margin-left:50px;
        width: 50px; 
        height: 8px;
        border-collapse:collapse;
        margin-top: -5px;
    }
    .tableCertificadoAbierta{
        border: 1px solid black;
        /* position: relative; */
        position: absolute;
        margin-left:100px;
        width: 50px; 
        height: 8px;
        border-collapse:collapse;
        margin-top: -34px;
    }

    .certificadosJoven{
        position: absolute;
        border: 1px solid black;
        width: 118px;
        margin-top: 178px;
        font-size:10px;
        margin-left: 129px;
        background-color: #c2ddf3;
    }

    .certificadosJovenCampeon{
        position: absolute;
        border: 1px solid black;
        width: 118px;
        margin-top: 178px;
        font-size:10px;
        margin-left: 248px;
        background-color: #c2ddf3;
    }

    .certificadosIntermedia{
        position: absolute;
        border: 1px solid black;
        width: 237px;
        margin-top: 178px;
        font-size:10px;
        margin-left: 367px;
        background-color: #ededdd;
    }

    .certificadosAbierta{
        position: absolute;
        border: 1px solid black;
        width: 118px;
        margin-top: 178px;
        font-size:10px;
        margin-left: 486px;
        background-color: #ededdd;
    }

    .certificadosCampeones{
        position: absolute;
        border: 1px solid black;
        width: 118px;
        margin-top: 178px;
        font-size:10px;
        margin-left: 605px;
        background-color: #ededdd;
    }

    .certificadosGrandesCampeones{
        position: absolute;
        border: 1px solid black;
        width: 118px;
        margin-top: 178px;
        font-size:10px;
        margin-left: 724px;
        background-color: #ededdd;
    }

    .certificadosVeterano{
        position: absolute;
        border: 1px solid black;
        width: 118px;
        margin-top: 178px;
        font-size:10px;
        margin-left: 843px;
    }
    .adentroMejor{
        border: 1px solid black;
        width: 30px;
        height: 20px;
        margin-left: auto;
        margin-right: auto;
        font-size:16px;
    }

    .machosVEncedoresCachorro{
        position: absolute;
        width: 118px;
        margin-top: 200px;
        text-align:center;
        font-size: 10px;
    }
    .machosVEncedoresJoven{
        position: absolute;
        width: 238px;
        height: 20px;
        margin-top: 230px;
        text-align:center;
        font-size: 9px;
        margin-left: 97;
        border-collapse:collapse;
    }
    .machosVEncedoresAdulto{
        position: absolute;
        width: 356px;
        height: 20px;
        margin-top: 230px;
        text-align:center;
        font-size: 9px;
        margin-left: 367px;
        border-collapse:collapse;
    }

    .machosVEncedores{
        position: absolute;
        margin-top: 225px;
        font-size: 12px;
        margin-left: 100px;
    }
    .celdasMejores{
        width: 50px;
        text-align: center;
    }
    .mejoresVencedoresLetras{
        text-align: right;
    }

    /* PARA LAS HEMBRAS */
    .tableHembra{
        position: absolute;
        margin-top: 300px;
        border: 0.7px solid black;
        font-size:8px;
        width: 120px;
        border-collapse:collapse;
    }
    .jovenHembra{
        margin-left: 129px;
        background-color: #c2ddf3;
    }

    .jovenCampeonHembra{
        margin-left: 249px;
        background-color: #c2ddf3;
    }

    .intermediaHembra{
        margin-left: 368px;
        background-color:#ededdd;
    }

    .abiertaHembra{
        margin-left: 486px;
        background-color:#ededdd;
    }

    .campoeonesHembra{
        margin-left: 605px;
        background-color:#ededdd;
    }

    .grandesCampeonesHembra{
        margin-left: 724px;
        background-color:#ededdd;
    }

    .veteranosHembra{
        margin-left: 843px;
    }

    .certificadosHembra{
        position: absolute;
        border: 1px solid black;
        width: 118px;
        margin-top: 448px;
        font-size:10px;
    }
    .certificadosJovenHembra{
        position: absolute;
        border: 1px solid black;
        width: 118px;
        margin-top: 448px;
        font-size:10px;
        margin-left: 129px;
        background-color: #c2ddf3;
    }

    .certificadosJovenCampeonHembra{
        position: absolute;
        border: 1px solid black;
        width: 118px;
        margin-top: 448px;
        font-size:10px;
        margin-left: 248px;
        background-color: #c2ddf3;
    }

    .certificadosIntermediaHembra{
        position: absolute;
        border: 1px solid black;
        width: 237px;
        margin-top: 448px;
        font-size:10px;
        margin-left: 367px;
        background-color:#ededdd;
    }

    .certificadosAbiertaHembra{
        position: absolute;
        border: 1px solid black;
        width: 118px;
        margin-top: 448px;
        font-size:10px;
        margin-left: 486px;
        background-color:#ededdd;
    }

    .certificadosCampeonesHembra{
        position: absolute;
        border: 1px solid black;
        width: 118px;
        margin-top: 448px;
        font-size:10px;
        margin-left: 605px;
        background-color:#ededdd;
    }

    .certificadosGrandesCampeonesHembra{
        position: absolute;
        border: 1px solid black;
        width: 118px;
        margin-top: 448px;
        font-size:10px;
        margin-left: 724px;
        background-color:#ededdd;
    }

    .certificadosVeteranoHembra{
        position: absolute;
        border: 1px solid black;
        width: 118px;
        margin-top: 448px;
        font-size:10px;
        margin-left: 843px;
    }
    .hembraVencedores{
        position: absolute;
        margin-top: 495px;
        font-size: 12px;
        width: 590px;
        margin-left: 102px;
    }
    .hembraVencedoresCachorro{
        position: absolute;
        margin-top: 500px;
        font-size: 9px;
        width: 118px;
        /* margin-left: 102px; */
    }
    .hembraVencedoresJoven{
        position: absolute;
        margin-top: 500px;
        font-size: 9px;
        width: 238px;
        margin-left: 130px;
        border-collapse: collapse;
    }
    .hembraVencedoresAdulto{
        position: absolute;
        margin-top: 500px;
        font-size: 9px;
        width: 359px;
        margin-left: 367px;
        border-collapse: collapse;
    }
    .mejorRazaCJA{
        position: absolute;
        margin-top: 570px;
        font-size: 12px;
        width: 725px;
    }

    /* FIRMAS DIGITALES */
    .bloque_firmas{
        position: absolute;
        margin-top: 600px;
        margin-left: 750px;
        text-align: center;
        font-size: 12px;
    }
    .espacio_firmas{
        padding-top:15px;
        padding-bottom:15px;
    }
    .firma_figital{
        position: absolute;
        margin-top: -50px;
        width: 180px;
        margin-left: 350px;
    }
    .firma_figital_secretario{
        position: absolute;
        margin-top: -40px;
        width: 180px;
    }

    .machosVEncedoresExtragero{

    }
    
    .extrangeroMacho{
        position: absolute;
        margin-left: 643px;
        font-size: 10px;
        /* margin-top: -55px; */
        margin-top: 5px;
    }
    .tablaEstrangero{
        border-collapse:collapse;
    }
    .extrangeroNumero{
        font-size: 13px;
        padding: 5px;
    }
    .extrangeroMachoCacib{
        position: absolute;
        margin-left: 712px;
        font-size: 10px;
        margin-top: 5px;
        /* margin-top: -55px; */
    }

    /* para los machos */
    .machos{
        margin-left: -30px;
        position: absolute;
        border: 0.7px solid black;;
        padding: 1px;
        padding-top: 19px;
        padding-bottom: 19px;
        margin-top: 30px;
    }

    .hembras{
        margin-left: -30px;
        position: absolute;
        border: 0.7px solid black;;
        padding: 1px;
        padding-top: 9px;
        padding-bottom: 9px;
        margin-top: 300px;
    }

    h3 span { 
        display: block; 
        writing-mode: vertical-lr;
        transform: rotate(-90deg);
    }
    .mejorCachorro{
        width: 118px;
        height: 90px;
        position: absolute;
    }
    .mejorJoven{
        width: 235px;
        height: 90px;
        margin-left: 132px;
        position: absolute;
    }
    .mejorTitulo{
        font-size:9px;
        text-align: center;
        font-weight: bold;
        padding: 1px;
    }
    .mejorTituloJoven{
        font-size:9px;
        {{--  text-align: center;  --}}
        text-align: right;
        font-weight: bold;
        padding: 1px;
    }
    .textoTituloMejor{
        text-align: center;
        font-size:8px;
        position: absolute;
    }
    .textoTituloMejorJoven{
        width: 100%;
        text-align: center;
        font-size:16px;
        position: absolute;
        {{--  border: 1px solid ;  --}}
    }
    .textMejoNumero{
        width:40px;
        height: 20px;
        position: absolute;
    }
    .textMejoNumeroJoven{
        width:40px;
        height: 20px;
        position: absolute;
    }
    .mejorRaza{
        width: 355px;
        height: 90px;
        margin-left: 368px;
        position: absolute;
    }
</style>
<body>

    @foreach ($arrayEjemplaresTotal as $aet)
        @php
            $ejempleresRazas = $aet['ejemplares'];
        @endphp
        @foreach ( $ejempleresRazas as $er)
        
        {{--  <div class="headerCabezera">
            Kennel Club Boliviano
        </div>  --}}
            <div class="planilla">
                
                <div class="imgLogo">
                    <img src="{{ url('img/logo.png') }}" width="4%" alt="">
                </div>

                <div class="headerCabezera">
                    Kennel Club Boliviano
                </div>

                <div id="header">   
                    PLANILLA DE RAZA
                </div>

                <div class="imgLogoFci">
                    <img src="{{ url('img/logo.gif') }}" width="6%" alt="">
                    <img src="{{ url('img/fci.jpg') }}" width="6%" alt="">
                </div>

                <p class="juez">

                    @if ($asignacion[0]->estado == 1)
                        
                        Juez: {{ $asignacion[0]->juez->nombre}}
                    
                    @else

                        @php
                            $grupo = App\EjemplarEvento::getGrupo($er->raza->id);

                            $asigEnco = null;

                            foreach ($asignacion as $a){
                                if(in_array($grupo->grupo_id, json_decode($a->grupos))){
                                    $asigEnco = $a;
                                    break;
                                }
                            }
                        @endphp

                        Juez: {{ ($asigEnco)? $asigEnco->juez->nombre :''}}
                        
                    @endif
                    
                 </p>

                <p class="fecha">
                    Fecha {{ date('d/m/Y') }}
                 </p>

                <p class="raza">
                   Raza: {{ $er->raza->nombre }}
                </p>

                @php

                    // PARA LAS CATEGORIAS NACHOS
                    $categoriaCachorroAbsolutoMacho      = array();
                    $categoriaJovenMacho                 = array();
                    $categoriaJovenCampeonMacho          = array();
                    $categoriaIntermediaMacho            = array();
                    $categoriaAbiertaMacho               = array();
                    $categoriaCampeonMacho               = array();
                    $categoriaGrandesCampeonesMacho      = array();
                    $categoriaVeteranosMacho             = array();

                    // CACHORROS ABSOLUTOS
                    $categoriaCachorroAbsolutoMacho  = App\Juez::EjemplarCatalogoRaza(11, $er->raza_id, $evento_id);
                    
                    // JOVEN
                    $categoriaJovenMacho             = App\Juez::EjemplarCatalogoRaza(3, $er->raza_id, $evento_id);

                    // JOVEN CAMPEON
                    $categoriaJovenCampeonMacho      = App\Juez::EjemplarCatalogoRaza(12, $er->raza_id, $evento_id);
                    
                    // INTERMEDIA
                    $categoriaIntermediaMacho        = App\Juez::EjemplarCatalogoRaza(5, $er->raza_id, $evento_id);
                    
                    // ABIERTA
                    $categoriaAbiertaMacho           = App\Juez::EjemplarCatalogoRaza(7, $er->raza_id, $evento_id);
                    
                    // CAMPEONES
                    $categoriaCampeonMacho           = App\Juez::EjemplarCatalogoRaza(9, $er->raza_id, $evento_id);

                    // GRANDES CAMPEONES
                    $categoriaGrandesCampeonesMacho  = App\Juez::EjemplarCatalogoRaza(14, $er->raza_id, $evento_id);
                    
                    // VETERANOS
                    $categoriaVeteranosMacho         = App\Juez::EjemplarCatalogoRaza(16, $er->raza_id, $evento_id);

                @endphp
                <div class="machos">
                    <h3>
                        <span> O </span>
                        <span> H </span>
                        <span> C </span>
                        <span> A </span>
                        <span> M </span>
                    </h3>
                </div>

                {{-- PARA LOS MACHOS --}}
                <table class="table cachorro">
                    <thead>
                        <tr>
                            <th colspan="3">CACHORRO <br> 6 a 9 meses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bordes">N~</td>
                            <td class="bordes">Calf.</td>
                            <td class="bordes">Lugar</td>
                        </tr>
                        @for ($i = 0; $i < 6 ; $i++)
                            @if ($i < count($categoriaCachorroAbsolutoMacho))
                                <tr>
                                    <td class="bordes contenidoCeldasLlenas">{{ $categoriaCachorroAbsolutoMacho[$i]->numero_prefijo }}</td>
                                    @php
                                        $calificaion = App\Juez::ejemplarEventoInscrito($categoriaCachorroAbsolutoMacho[$i]->id, $pista);
                                    @endphp
                                    <td class="bordes contenidoCeldasLlenas">{{  ($calificaion)? $calificaion->calificacion : ''  }}</td>
                                    <td class="bordes contenidoCeldasLlenas">{{ ($calificaion)? $calificaion->lugar : '' }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td class="bordes espacionCeldasVacias"></td>
                                    <td class="bordes"></td>
                                    <td class="bordes"></td>
                                </tr>
                            @endif
                        @endfor
                    </tbody>
                </table>
                <div class="certificados bordes">
                    CCCB
                    @php
                        $mejorCategoria = App\Juez::mejorCategoriaEscogito($evento_id, [11], $pista, $er->raza_id);
                    @endphp
                    <table class="tableCertificado">
                        <thead class="bordes">
                            <th>N~</th>                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="contenidoCeldasLlenas">
                                    {{ ($mejorCategoria)? $mejorCategoria->numero_prefijo : '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <table class="table joven">
                    <thead>
                        <tr>
                            <th colspan="3">JOVEN <br> 9 a 18 meses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bordes">N~</td>
                            <td class="bordes">Calf.</td>
                            <td class="bordes">Lugar</td>
                        </tr>
                        @for ($i = 0; $i < 6 ; $i++)
                            @if ($i < count($categoriaJovenMacho))
                                <tr>
                                    <td class="bordes contenidoCeldasLlenas">{{ $categoriaJovenMacho[$i]->numero_prefijo }}</td>
                                    @php
                                        $calificaion = App\Juez::ejemplarEventoInscrito($categoriaJovenMacho[$i]->id, $pista);
                                    @endphp
                                    <td class="bordes contenidoCeldasLlenas">{{  ($calificaion)? $calificaion->calificacion : ''  }}</td>
                                    <td class="bordes contenidoCeldasLlenas">{{ ($calificaion)? $calificaion->lugar : '' }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td class="bordes espacionCeldasVacias"></td>
                                    <td class="bordes"></td>
                                    <td class="bordes"></td>
                                </tr>
                            @endif
                        @endfor
                    </tbody>
                </table>
                <div class="certificadosJoven bordes">
                    CJCB
                    @php
                        $mejorCategoria = App\Juez::mejorCategoriaEscogito($evento_id, [3], $pista, $er->raza_id);
                    @endphp
                    <table class="tableCertificado">
                        <thead class="bordes">
                            <th>N~</th>                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="contenidoCeldasLlenas">
                                    {{ ($mejorCategoria)? $mejorCategoria->numero_prefijo : '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <table class="table jovenCampeon">
                    <thead>
                        <tr>
                            <th colspan="3">JOVEN CAMPEON <br> 9 a 18 meses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bordes">N~</td>
                            <td class="bordes">Calf.</td>
                            <td class="bordes">Lugar</td>
                        </tr>
                        @for ($i = 0; $i < 6 ; $i++)
                            @if ($i < count($categoriaJovenCampeonMacho))
                                <tr>
                                    <td class="bordes contenidoCeldasLlenas">{{ $categoriaJovenCampeonMacho[$i]->numero_prefijo }}</td>
                                    @php
                                        $calificaion = App\Juez::ejemplarEventoInscrito($categoriaJovenCampeonMacho[$i]->id, $pista);
                                    @endphp
                                    <td class="bordes contenidoCeldasLlenas">{{  ($calificaion)? $calificaion->calificacion : ''  }}</td>
                                    <td class="bordes contenidoCeldasLlenas">{{ ($calificaion)? $calificaion->lugar : '' }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td class="bordes espacionCeldasVacias"></td>
                                    <td class="bordes"></td>
                                    <td class="bordes"></td>
                                </tr>
                            @endif
                        @endfor
                    </tbody>
                </table>
                <div class="certificadosJovenCampeon bordes">
                    CJCGB
                    @php
                        $mejorCategoria = App\Juez::mejorCategoriaEscogito($evento_id, [12], $pista, $er->raza_id);
                    @endphp
                    <table class="tableCertificado">
                        <thead class="bordes">
                            <th>N~</th>                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="contenidoCeldasLlenas">
                                    {{ ($mejorCategoria)? $mejorCategoria->numero_prefijo : '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <table class="table intermedia">
                    <thead>
                        <tr>
                            <th colspan="3">INTERMEDIA <br> 15 a 24 meses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bordes">N~</td>
                            <td class="bordes">Calf.</td>
                            <td class="bordes">Lugar</td>
                        </tr>
                        @for ($i = 0; $i < 6 ; $i++)
                            @if ($i < count($categoriaIntermediaMacho))
                                <tr>
                                    <td class="bordes contenidoCeldasLlenas">{{ $categoriaIntermediaMacho[$i]->numero_prefijo }}</td>
                                    @php
                                        $calificaion = App\Juez::ejemplarEventoInscrito($categoriaIntermediaMacho[$i]->id, $pista);
                                    @endphp
                                    <td class="bordes contenidoCeldasLlenas">{{  ($calificaion)? $calificaion->calificacion : ''  }}</td>
                                    <td class="bordes contenidoCeldasLlenas">{{ ($calificaion)? $calificaion->lugar : '' }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td class="bordes espacionCeldasVacias"></td>
                                    <td class="bordes"></td>
                                    <td class="bordes"></td>
                                </tr>
                            @endif
                        @endfor
                    </tbody>
                </table>
                <div class="certificadosIntermedia bordes">
                    CACB
                    @php
                        $mejorCategoria = App\Juez::mejorCategoriaEscogito($evento_id, [5,7], $pista, $er->raza_id);
                    @endphp
                    <table class="tableCertificado">
                        <thead class="bordes">
                            <th>N~</th>                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="contenidoCeldasLlenas">
                                    {{ ($mejorCategoria)? $mejorCategoria->numero_prefijo : '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="tableCertificadoAbierta">
                        <thead class="bordes">
                            <th>Puntos</th>                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="contenidoCeldasLlenas">
                                    {{ ($mejorCategoria)? $mejorCategoria->puntos : '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    {{--  @php
                        $mejorCategoria = App\Juez::mejorCategoriaEscogito($evento_id, 7, $pista, $er->raza_id);
                    @endphp
                    <table class="tableCertificadoAbierta">
                        <thead class="bordes">
                            <th>Puntos</th>                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="contenidoCeldasLlenas">
                                    {{ ($mejorCategoria)? $mejorCategoria->numero_prefijo : '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>  --}}
                </div>

                <table class="table abierta">
                    <thead>
                        <tr>
                            <th colspan="3">ABIERTA <br> MAYOR A 24 MESES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bordes">N~</td>
                            <td class="bordes">Calf.</td>
                            <td class="bordes">Lugar</td>
                        </tr>
                        @for ($i = 0; $i < 6 ; $i++)
                            @if ($i < count($categoriaAbiertaMacho))
                                <tr>
                                    <td class="bordes contenidoCeldasLlenas">{{ $categoriaAbiertaMacho[$i]->numero_prefijo }}</td>
                                    @php
                                        $calificaion = App\Juez::ejemplarEventoInscrito($categoriaAbiertaMacho[$i]->id, $pista);
                                    @endphp
                                    <td class="bordes contenidoCeldasLlenas">{{  ($calificaion)? $calificaion->calificacion : ''  }}</td>
                                    <td class="bordes contenidoCeldasLlenas">{{ ($calificaion)? $calificaion->lugar : '' }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td class="bordes espacionCeldasVacias"></td>
                                    <td class="bordes"></td>
                                    <td class="bordes"></td>
                                </tr>
                            @endif
                        @endfor
                    </tbody>
                </table>

                {{-- <div class="certificadosAbierta bordes">
                    CCCB
                    @php
                        $mejorCategoria = App\Juez::mejorCategoriaEscogito($evento_id, 7, $pista, $er->raza_id);
                    @endphp
                    <table class="tableCertificado">
                        <thead class="bordes">
                            <th>N~</th>                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="contenidoCeldasLlenas">
                                    {{ ($mejorCategoria)? $mejorCategoria->numero_prefijo : '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> --}}

                <table class="table campoeones">
                    <thead>
                        <tr>
                            <th colspan="3" class="espacionCabeceraTable">CAMPEONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bordes">N~</td>
                            <td class="bordes">Calf.</td>
                            <td class="bordes">Lugar</td>
                        </tr>
                        @for ($i = 0; $i < 6 ; $i++)
                            @if ($i < count($categoriaCampeonMacho))
                                <tr>
                                    <td class="bordes contenidoCeldasLlenas">{{ $categoriaCampeonMacho[$i]->numero_prefijo }}</td>
                                    @php
                                        $calificaion = App\Juez::ejemplarEventoInscrito($categoriaCampeonMacho[$i]->id, $pista);
                                    @endphp
                                    <td class="bordes contenidoCeldasLlenas">{{  ($calificaion)? $calificaion->calificacion : ''  }}</td>
                                    <td class="bordes contenidoCeldasLlenas">{{ ($calificaion)? $calificaion->lugar : '' }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td class="bordes espacionCeldasVacias"></td>
                                    <td class="bordes"></td>
                                    <td class="bordes"></td>
                                </tr>
                            @endif
                        @endfor
                    </tbody>
                </table>
                <div class="certificadosCampeones bordes">
                    CGCB
                    @php
                        $mejorCategoria = App\Juez::mejorCategoriaEscogito($evento_id, [9], $pista, $er->raza_id);
                    @endphp
                    <table class="tableCertificado">
                        <thead class="bordes">
                            <th>N~</th>                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="contenidoCeldasLlenas">
                                    {{ ($mejorCategoria)? $mejorCategoria->numero_prefijo : '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <table class="table grandesCampeones">
                    <thead>
                        <tr>
                            <th colspan="3" class="espacionCabeceraTable">GRANDES CAMPEONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bordes">N~</td>
                            <td class="bordes">Calf.</td>
                            <td class="bordes">Lugar</td>
                        </tr>
                        @for ($i = 0; $i < 6 ; $i++)
                            @if ($i < count($categoriaGrandesCampeonesMacho))
                                <tr> 
                                    <td class="bordes contenidoCeldasLlenas">{{ $categoriaGrandesCampeonesMacho[$i]->numero_prefijo }}</td>
                                    @php
                                        $calificaion = App\Juez::ejemplarEventoInscrito($categoriaGrandesCampeonesMacho[$i]->id, $pista);
                                    @endphp
                                    <td class="bordes contenidoCeldasLlenas">{{  ($calificaion)? $calificaion->calificacion : ''  }}</td>
                                    <td class="bordes contenidoCeldasLlenas">{{ ($calificaion)? $calificaion->lugar : '' }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td class="bordes espacionCeldasVacias"></td>
                                    <td class="bordes"></td>
                                    <td class="bordes"></td>
                                </tr>
                            @endif
                        @endfor
                    </tbody>
                </table>
                <div class="certificadosGrandesCampeones bordes">
                    {{-- CCCB --}}
                    <div style="margin-top:12px"></div>
                    {{-- <div style="padding-top:10px"></div> --}}
                    @php
                        $mejorCategoria = App\Juez::mejorCategoriaEscogito($evento_id, [14], $pista, $er->raza_id);
                    @endphp
                    <table class="tableCertificado">
                        <thead class="bordes">
                            <th>N~</th>                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="contenidoCeldasLlenas">
                                    {{ ($mejorCategoria)? $mejorCategoria->numero_prefijo : '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <table class="table veteranos">
                    <thead>
                        <tr>
                            <th colspan="3" class="espacionCabeceraTable">VETERANOS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bordes">N~</td>
                            <td class="bordes">Calf.</td>
                            <td class="bordes">Lugar</td>
                        </tr>
                        @for ($i = 0; $i < 6 ; $i++)
                            @if ($i < count($categoriaVeteranosMacho))
                                <tr>
                                    <td class="bordes contenidoCeldasLlenas">{{ $categoriaVeteranosMacho[$i]->numero_prefijo }}</td>
                                    @php
                                        $calificaion = App\Juez::ejemplarEventoInscrito($categoriaVeteranosMacho[$i]->id, $pista);
                                    @endphp
                                    <td class="bordes contenidoCeldasLlenas">{{ ($calificaion)? $calificaion->calificacion : '' }}</td>
                                    <td class="bordes contenidoCeldasLlenas">{{ ($calificaion)? $calificaion->lugar : '' }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td class="bordes espacionCeldasVacias"></td>
                                    <td class="bordes"></td>
                                    <td class="bordes"></td>
                                </tr>
                            @endif
                        @endfor
                    </tbody>
                </table>
                <div class="certificadosVeterano bordes">
                    CACV
                    @php
                        $mejorCategoria = App\Juez::mejorCategoriaEscogito($evento_id, [16], $pista, $er->raza_id);
                    @endphp
                    <table class="tableCertificado">
                        <thead class="bordes">
                            <th>N~</th>                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="contenidoCeldasLlenas">
                                    {{ ($mejorCategoria)? $mejorCategoria->numero_prefijo : '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="machosVEncedoresCachorro">
                    <table class="table bordes">
                        <thead>
                            <tr class="bordes" style="background-color: #D2FECC;">
                                <th>MEJOR CACHORO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td height="25px">
                                    <div class="adentroMejor">
                                        @php
                                            $mejorVencedor = App\Juez::ganadorEjemplarEvento($er->raza_id, $evento_id, [11], "Macho", $pista);

                                            if($mejorVencedor)
                                                echo $mejorVencedor->numero_prefijo;
                                        @endphp
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <table class="machosVEncedoresJoven bordes">
                    <thead>
                        <tr class="bordes" style="background-color: #17D8FF;">
                            <th>MEJOR JOVEN MACHO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td height="25px">
                                <div class="adentroMejor">
                                    @php
                                        $mejorVencedor = App\Juez::ganadorEjemplarEvento($er->raza_id, $evento_id, [3, 12], "Macho", $pista);

                                        if($mejorVencedor)
                                            echo $mejorVencedor->numero_prefijo;
                                    @endphp
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="machosVEncedoresAdulto bordes">
                    <thead>
                        <tr class="bordes" style="background-color: #F9FF86;">
                            <th>MEJOR ADULTO MACHO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td height="25px">
                                <div class="adentroMejor">
                                    @php
                                        $mejorVencedor = App\Juez::ganadorEjemplarEvento($er->raza_id, $evento_id, [5, 7, 9, 14], "Macho", $pista);

                                        if($mejorVencedor)
                                            echo $mejorVencedor->numero_prefijo;
                                    @endphp
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="machosVEncedores">
                    {{-- <table style="width: 100%;">
                        <thead>
                            <tr>
                                <th colspan="8" style="background: #C1BEC1: width=100%;;">
                                    MACHOS VENCEDORES
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="mejoresVencedoresLetras">CACHORRO</td>
                                @php
                                    $mejorVencedor = App\Juez::ganadorEjemplarEvento($er->raza_id, $evento_id, [11], "Macho", $pista);
                                @endphp
                                <td class="bordes celdasMejores">{{ ($mejorVencedor)? $mejorVencedor->numero_prefijo : '' }}</td>
                                <td class="mejoresVencedoresLetras">JOVEN</td>
                                @php
                                    $mejorVencedor = App\Juez::ganadorEjemplarEvento($er->raza_id, $evento_id, [3, 12], "Macho", $pista);
                                @endphp
                                <td class="bordes celdasMejores">{{ ($mejorVencedor)? $mejorVencedor->numero_prefijo : '' }}</td>
                                <td class="mejoresVencedoresLetras">ADULTO</td>
                                @php
                                    $mejorVencedor = App\Juez::ganadorEjemplarEvento($er->raza_id, $evento_id, [5, 7, 9, 14], "Macho", $pista);
                                @endphp
                                <td class="bordes celdasMejores">{{ ($mejorVencedor)? $mejorVencedor->numero_prefijo : '' }}</td>
                                <td class="mejoresVencedoresLetras">VETERANO</td>
                                @php
                                    $mejorVencedor = App\Juez::ganadorEjemplarEvento($er->raza_id, $evento_id, [16], "Macho", $pista);
                                @endphp
                                <td class="bordes celdasMejores">{{ ($mejorVencedor)? $mejorVencedor->numero_prefijo : '' }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="7" style="background: #C1BEC1;">
                                    MEJOR MACHO
                                </th>
                                @php
                                    $mejorMAcho = App\Juez::mejorVencedorSexo($evento_id, $er->raza_id, [3, 12, 5, 7, 9, 14], $pista, 'mejor_macho');
                                @endphp
                                <th class="bordes celdasMejores">{{ ($mejorMAcho)? $mejorMAcho->numero_prefijo : '' }}</th>
                            </tr>
                        </tfoot>
                    </table> --}}
                    
                    <div class="extrangeroMacho">
                        <table class="bordes tablaEstrangero">
                            <thead>
                                <tr>
                                    <th  class="bordes" height="2" colspan="2">N</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="bordes">CLACAB</td>
                                    @php
                                        $certificado = App\Juez::getCertificacionExtranjero($evento_id, $pista, $er->raza_id, 'certificacionCLACAB', 'Macho');
                                    @endphp
                                    <td class="bordes"><span class="extrangeroNumero">{{ (($certificado)? $certificado->numero_prefijo : '' ) }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="extrangeroMachoCacib">
                        <table class="bordes tablaEstrangero">
                            <thead>
                                <tr>
                                    <th  class="bordes" height="2" colspan="2">N</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="bordes">CACIB</td>
                                    @php
                                        $certificado = App\Juez::getCertificacionExtranjero($evento_id, $pista, $er->raza_id, 'certificacionCACIB', 'Macho');
                                    @endphp
                                    <td class="bordes"><span class="extrangeroNumero">{{ (($certificado)? $certificado->numero_prefijo : '' ) }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

                

                @php

                    // PARA LAS CATEGORIAS HEMBRAS
                    $categoriaCachorroAbsolutoHembras      = array();
                    $categoriaJovenHembras                 = array();
                    $categoriaJovenCampeonHembras          = array();
                    $categoriaIntermediaHembras            = array();
                    $categoriaAbiertaHembras               = array();
                    $categoriaCampeonHembras               = array();
                    $categoriaGrandesCampeonesHembras      = array();
                    $categoriaVeteranosHembras             = array();

                    // CACHORROS ABSOLUTOS
                    $categoriaCachorroAbsolutoHembras  = App\Juez::EjemplarCatalogoRaza(2, $er->raza_id, $evento_id);
                    
                    // JOVEN
                    $categoriaJovenHembras             = App\Juez::EjemplarCatalogoRaza(4, $er->raza_id, $evento_id);

                    // JOVEN CAMPEON
                    $categoriaJovenCampeonHembras      = App\Juez::EjemplarCatalogoRaza(13, $er->raza_id, $evento_id);
                    
                    // INTERMEDIA
                    $categoriaIntermediaHembras        = App\Juez::EjemplarCatalogoRaza(6, $er->raza_id, $evento_id);
                    
                    // ABIERTA
                    $categoriaAbiertaHembras           = App\Juez::EjemplarCatalogoRaza(8, $er->raza_id, $evento_id);
                    
                    // CAMPEONES
                    $categoriaCampeonHembras           = App\Juez::EjemplarCatalogoRaza(10, $er->raza_id, $evento_id);

                    // GRANDES CAMPEONES
                    $categoriaGrandesCampeonesHembras  = App\Juez::EjemplarCatalogoRaza(15, $er->raza_id, $evento_id);
                    
                    // VETERANOS
                    $categoriaVeteranosHembras         = App\Juez::EjemplarCatalogoRaza(17, $er->raza_id, $evento_id);

                @endphp
                <div class="hembras">
                    <h3>
                        <span> A </span>
                        <span> R </span>
                        <span> B </span>
                        <span> M </span>
                        <span> E </span>
                        <span> H </span>
                    </h3>
                </div>

                 {{-- PARA LOS HEMBRAS --}}
                 <table class="tableHembra cachorro">
                    <thead>
                        <tr>
                            <th colspan="3">CACHORRO <br> 6 a 9 meses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bordes">N~</td>
                            <td class="bordes">Calf.</td>
                            <td class="bordes">Lugar</td>
                        </tr>
                        @for ($i = 0; $i < 6 ; $i++)
                            @if ($i < count($categoriaCachorroAbsolutoHembras))
                                <tr>
                                    <td class="bordes contenidoCeldasLlenas">{{ $categoriaCachorroAbsolutoHembras[$i]->numero_prefijo }}</td>
                                    @php
                                        $calificaion = App\Juez::ejemplarEventoInscrito($categoriaCachorroAbsolutoHembras[$i]->id, $pista);
                                    @endphp
                                    <td class="bordes contenidoCeldasLlenas">{{  ($calificaion)? $calificaion->calificacion : ''  }}</td>
                                    <td class="bordes contenidoCeldasLlenas">{{ ($calificaion)? $calificaion->lugar : '' }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td class="bordes espacionCeldasVacias"></td>
                                    <td class="bordes"></td>
                                    <td class="bordes"></td>
                                </tr>
                            @endif
                        @endfor
                    </tbody>
                </table>
                <div class="certificadosHembra bordes">
                    CCCB
                    @php
                        $mejorCategoria = App\Juez::mejorCategoriaEscogito($evento_id, [2], $pista, $er->raza_id);
                    @endphp
                    <table class="tableCertificado">
                        <thead class="bordes">
                            <th>N~</th>                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="contenidoCeldasLlenas">
                                    {{ ($mejorCategoria)? $mejorCategoria->numero_prefijo : '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <table class="tableHembra jovenHembra">
                    <thead>
                        <tr>
                            <th colspan="3">JOVEN <br> 9 a 18 meses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bordes">N~</td>
                            <td class="bordes">Calf.</td>
                            <td class="bordes">Lugar</td>
                        </tr>
                        @for ($i = 0; $i < 6 ; $i++)
                            @if ($i < count($categoriaJovenHembras))
                                <tr>
                                    <td class="bordes contenidoCeldasLlenas">{{ $categoriaJovenHembras[$i]->numero_prefijo }}</td>
                                    @php
                                        $calificaion = App\Juez::ejemplarEventoInscrito($categoriaJovenHembras[$i]->id, $pista);
                                    @endphp
                                    <td class="bordes contenidoCeldasLlenas">{{  ($calificaion)? $calificaion->calificacion : ''  }}</td>
                                    <td class="bordes contenidoCeldasLlenas">{{ ($calificaion)? $calificaion->lugar : '' }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td class="bordes espacionCeldasVacias"></td>
                                    <td class="bordes"></td>
                                    <td class="bordes"></td>
                                </tr>
                            @endif
                        @endfor
                    </tbody>
                </table>
                <div class="certificadosJovenHembra bordes">
                    CJCB
                    @php
                        $mejorCategoria = App\Juez::mejorCategoriaEscogito($evento_id, [4], $pista, $er->raza_id);
                    @endphp
                    <table class="tableCertificado">
                        <thead class="bordes">
                            <th>N~</th>                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="contenidoCeldasLlenas">
                                    {{ ($mejorCategoria)? $mejorCategoria->numero_prefijo : '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <table class="tableHembra jovenCampeonHembra">
                    <thead>
                        <tr>
                            <th colspan="3">JOVEN CAMPEON <br> 9 a 18 meses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bordes">N~</td>
                            <td class="bordes">Calf.</td>
                            <td class="bordes">Lugar</td>
                        </tr>
                        @for ($i = 0; $i < 6 ; $i++)
                            @if ($i < count($categoriaJovenCampeonHembras))
                                <tr>
                                    <td class="bordes contenidoCeldasLlenas">{{ $categoriaJovenCampeonHembras[$i]->numero_prefijo }}</td>
                                    @php
                                        $calificaion = App\Juez::ejemplarEventoInscrito($categoriaJovenCampeonHembras[$i]->id, $pista);
                                    @endphp
                                    <td class="bordes contenidoCeldasLlenas">{{  ($calificaion)? $calificaion->calificacion : ''  }}</td>
                                    <td class="bordes contenidoCeldasLlenas">{{ ($calificaion)? $calificaion->lugar : '' }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td class="bordes espacionCeldasVacias"></td>
                                    <td class="bordes"></td>
                                    <td class="bordes"></td>
                                </tr>
                            @endif
                        @endfor
                    </tbody>
                </table>
                <div class="certificadosJovenCampeonHembra bordes">
                    CJCGB
                    @php
                        $mejorCategoria = App\Juez::mejorCategoriaEscogito($evento_id, [13], $pista, $er->raza_id);
                    @endphp
                    <table class="tableCertificado">
                        <thead class="bordes">
                            <th>N~</th>                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="contenidoCeldasLlenas">
                                    {{ ($mejorCategoria)? $mejorCategoria->numero_prefijo : '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <table class="tableHembra intermediaHembra">
                    <thead>
                        <tr>
                            <th colspan="3">INTERMEDIA <br> 15 a 24 meses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bordes">N~</td>
                            <td class="bordes">Calf.</td>
                            <td class="bordes">Lugar</td>
                        </tr>
                        @for ($i = 0; $i < 6 ; $i++)
                            @if ($i < count($categoriaIntermediaHembras))
                                <tr>
                                    <td class="bordes contenidoCeldasLlenas">{{ $categoriaIntermediaHembras[$i]->numero_prefijo }}</td>
                                    @php
                                        $calificaion = App\Juez::ejemplarEventoInscrito($categoriaIntermediaHembras[$i]->id, $pista);
                                    @endphp
                                    <td class="bordes contenidoCeldasLlenas">{{  ($calificaion)? $calificaion->calificacion : ''  }}</td>
                                    <td class="bordes contenidoCeldasLlenas">{{ ($calificaion)? $calificaion->lugar : '' }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td class="bordes espacionCeldasVacias"></td>
                                    <td class="bordes"></td>
                                    <td class="bordes"></td>
                                </tr>
                            @endif
                        @endfor
                    </tbody>
                </table>
                <div class="certificadosIntermediaHembra bordes">
                    CACB
                    @php
                        $mejorCategoria = App\Juez::mejorCategoriaEscogito($evento_id, [6, 8], $pista, $er->raza_id);
                    @endphp
                    <table class="tableCertificado">
                        <thead class="bordes">
                            <th>N~</th>                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="contenidoCeldasLlenas">
                                    {{ ($mejorCategoria)? $mejorCategoria->numero_prefijo : '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="tableCertificadoAbierta">
                        <thead class="bordes">
                            <th>Puntos</th>                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="contenidoCeldasLlenas">
                                    {{ ($mejorCategoria)? $mejorCategoria->puntos : '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <table class="tableHembra abiertaHembra">
                    <thead>
                        <tr>
                            <th colspan="3">ABIERTA <br> MAYOR A 24 MESES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bordes">N~</td>
                            <td class="bordes">Calf.</td>
                            <td class="bordes">Lugar</td>
                        </tr>
                        @for ($i = 0; $i < 6 ; $i++)
                            @if ($i < count($categoriaAbiertaHembras))
                                <tr>
                                    <td class="bordes contenidoCeldasLlenas">{{ $categoriaAbiertaHembras[$i]->numero_prefijo }}</td>
                                    @php
                                        $calificaion = App\Juez::ejemplarEventoInscrito($categoriaAbiertaHembras[$i]->id, $pista);
                                    @endphp
                                    <td class="bordes contenidoCeldasLlenas">{{  ($calificaion)? $calificaion->calificacion : ''  }}</td>
                                    <td class="bordes contenidoCeldasLlenas">{{ ($calificaion)? $calificaion->lugar : '' }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td class="bordes espacionCeldasVacias"></td>
                                    <td class="bordes"></td>
                                    <td class="bordes"></td>
                                </tr>
                            @endif
                        @endfor
                    </tbody>
                </table>
                {{-- <div class="certificadosAbiertaHembra bordes">
                    CCCB
                    @php
                        $mejorCategoria = App\Juez::mejorCategoriaEscogito($evento_id, [8], $pista, $er->raza_id);
                    @endphp
                    <table class="tableCertificado">
                        <thead class="bordes">
                            <th>N~</th>                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="contenidoCeldasLlenas">
                                    {{ ($mejorCategoria)? $mejorCategoria->numero_prefijo : '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> --}}

                <table class="tableHembra campoeonesHembra">
                    <thead>
                        <tr>
                            <th colspan="3" class="espacionCabeceraTable">CAMPEONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bordes">N~</td>
                            <td class="bordes">Calf.</td>
                            <td class="bordes">Lugar</td>
                        </tr>
                        @for ($i = 0; $i < 6 ; $i++)
                            @if ($i < count($categoriaCampeonHembras))
                                <tr>
                                    <td class="bordes contenidoCeldasLlenas">{{ $categoriaCampeonHembras[$i]->numero_prefijo }}</td>
                                    @php
                                        $calificaion = App\Juez::ejemplarEventoInscrito($categoriaCampeonHembras[$i]->id, $pista);
                                    @endphp
                                    <td class="bordes contenidoCeldasLlenas">{{  ($calificaion)? $calificaion->calificacion : ''  }}</td>
                                    <td class="bordes contenidoCeldasLlenas">{{ ($calificaion)? $calificaion->lugar : '' }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td class="bordes espacionCeldasVacias"></td>
                                    <td class="bordes"></td>
                                    <td class="bordes"></td>
                                </tr>
                            @endif
                        @endfor
                    </tbody>
                </table>
                <div class="certificadosCampeonesHembra bordes">
                    CGCB
                    @php
                        $mejorCategoria = App\Juez::mejorCategoriaEscogito($evento_id, [10], $pista, $er->raza_id);
                    @endphp
                    <table class="tableCertificado">
                        <thead class="bordes">
                            <th>N~</th>                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="contenidoCeldasLlenas">
                                    {{ ($mejorCategoria)? $mejorCategoria->numero_prefijo : '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <table class="tableHembra grandesCampeonesHembra">
                    <thead>
                        <tr>
                            <th colspan="3" class="espacionCabeceraTable">GRANDES CAMPEONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bordes">N~</td>
                            <td class="bordes">Calf.</td>
                            <td class="bordes">Lugar</td>
                        </tr>
                        @for ($i = 0; $i < 6 ; $i++)
                            @if ($i < count($categoriaGrandesCampeonesHembras))
                                <tr> 
                                    <td class="bordes contenidoCeldasLlenas">{{ $categoriaGrandesCampeonesHembras[$i]->numero_prefijo }}</td>
                                    @php
                                        $calificaion = App\Juez::ejemplarEventoInscrito($categoriaGrandesCampeonesHembras[$i]->id, $pista);
                                    @endphp
                                    <td class="bordes contenidoCeldasLlenas">{{  ($calificaion)? $calificaion->calificacion : ''  }}</td>
                                    <td class="bordes contenidoCeldasLlenas">{{ ($calificaion)? $calificaion->lugar : '' }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td class="bordes espacionCeldasVacias"></td>
                                    <td class="bordes"></td>
                                    <td class="bordes"></td>
                                </tr>
                            @endif
                        @endfor
                    </tbody>
                </table>
                <div class="certificadosGrandesCampeonesHembra bordes">
                    <div style="margin-top:12px"></div>
                    @php
                        $mejorCategoria = App\Juez::mejorCategoriaEscogito($evento_id, [15], $pista, $er->raza_id);
                    @endphp
                    <table class="tableCertificado">
                        <thead class="bordes">
                            <th>N~</th>                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="contenidoCeldasLlenas">
                                    {{ ($mejorCategoria)? $mejorCategoria->numero_prefijo : '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <table class="tableHembra veteranosHembra">
                    <thead>
                        <tr>
                            <th colspan="3" class="espacionCabeceraTable">VETERANOS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bordes">N~</td>
                            <td class="bordes">Calf.</td>
                            <td class="bordes">Lugar</td>
                        </tr>
                        @for ($i = 0; $i < 6 ; $i++)
                            @if ($i < count($categoriaVeteranosMacho))
                                <tr>
                                    <td class="bordes contenidoCeldasLlenas">{{ $categoriaVeteranosMacho[$i]->numero_prefijo }}</td>
                                    @php
                                        $calificaion = App\Juez::ejemplarEventoInscrito($categoriaVeteranosMacho[$i]->id, $pista);
                                    @endphp
                                    <td class="bordes contenidoCeldasLlenas">{{ ($calificaion)? $calificaion->calificacion : '' }}</td>
                                    <td class="bordes contenidoCeldasLlenas">{{ ($calificaion)? $calificaion->lugar : '' }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td class="bordes espacionCeldasVacias"></td>
                                    <td class="bordes"></td>
                                    <td class="bordes"></td>
                                </tr>
                            @endif
                        @endfor
                    </tbody>
                </table>
                <div class="certificadosVeteranoHembra bordes">
                    CACV
                    @php
                        $mejorCategoria = App\Juez::mejorCategoriaEscogito($evento_id, [16], $pista, $er->raza_id);
                    @endphp
                    <table class="tableCertificado">
                        <thead class="bordes">
                            <th>N~</th>                            
                        </thead>
                        <tbody>
                            <tr>
                                <td class="contenidoCeldasLlenas">
                                    {{ ($mejorCategoria)? $mejorCategoria->numero_prefijo : '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- <div class="hembraVencedores"> --}}
                    <table class="hembraVencedoresCachorro table bordes">
                        <thead>
                            <tr class="bordes" style="background-color: #D2FECC;">
                                <th>MEJOR CACHORO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td height="25px">
                                    <div class="adentroMejor">
                                        @php
                                            $mejorVencedor = App\Juez::ganadorEjemplarEvento($er->raza_id, $evento_id, [2], "Hembra", $pista);

                                            if($mejorVencedor)
                                                echo $mejorVencedor->numero_prefijo;
                                        @endphp
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                {{-- </div> --}}

                <table class="hembraVencedoresJoven bordes">
                    <thead>
                        <tr class="bordes" style="background-color: #17D8FF;">
                            <th>MEJOR JOVEN MACHO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td height="25px">
                                <div class="adentroMejor">
                                    @php
                                        $mejorVencedor = App\Juez::ganadorEjemplarEvento($er->raza_id, $evento_id, [4, 13], "Hembra", $pista);

                                        if($mejorVencedor)
                                            echo $mejorVencedor->numero_prefijo;
                                    @endphp
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="hembraVencedoresAdulto bordes">
                    <thead>
                        <tr class="bordes" style="background-color: #F9FF86;">
                            <th>MEJOR ADULTO MACHO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td height="25px">
                                <div class="adentroMejor">
                                    @php
                                        $mejorVencedor = App\Juez::ganadorEjemplarEvento($er->raza_id, $evento_id, [6, 8, 10, 15], "Hembra", $pista);

                                        if($mejorVencedor)
                                            echo $mejorVencedor->numero_prefijo;
                                    @endphp
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="hembraVencedores">
                    {{-- <table style="width: 100%;">
                        <thead>
                            <tr>
                                <th colspan="8" style="background: #C1BEC1: width=100%;;">
                                    HEMBRAS VENCEDORES
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="mejoresVencedoresLetras">CACHORRO</td>
                                @php
                                    $mejorVencedor = App\Juez::ganadorEjemplarEvento($er->raza_id, $evento_id, [2], "Hembra", $pista);
                                @endphp
                                <td class="bordes celdasMejores">{{ ($mejorVencedor)? $mejorVencedor->numero_prefijo : '' }}</td>
                                <td class="mejoresVencedoresLetras">JOVEN</td>
                                @php
                                    $mejorVencedor = App\Juez::ganadorEjemplarEvento($er->raza_id, $evento_id, [4, 13], "Hembra", $pista);
                                @endphp
                                <td class="bordes celdasMejores">{{ ($mejorVencedor)? $mejorVencedor->numero_prefijo : '' }}</td>
                                <td class="mejoresVencedoresLetras">ADULTO</td>
                                @php
                                    $mejorVencedor = App\Juez::ganadorEjemplarEvento($er->raza_id, $evento_id, [6, 8, 10, 15], "Hembra", $pista);
                                @endphp
                                <td class="bordes celdasMejores">{{ ($mejorVencedor)? $mejorVencedor->numero_prefijo : '' }}</td>
                                <td class="mejoresVencedoresLetras">VETERANO</td>
                                @php
                                    $mejorVencedor = App\Juez::ganadorEjemplarEvento($er->raza_id, $evento_id, [17], "Hembra", $pista);
                                @endphp
                                <td class="bordes celdasMejores">{{ ($mejorVencedor)? $mejorVencedor->numero_prefijo : '' }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="7" style="background: #C1BEC1;">
                                    MEJOR HEMBRA
                                </th>
                                @php
                                    $mejorHembra = App\Juez::mejorVencedorSexo($evento_id, $er->raza_id, [4, 13, 6, 8, 10, 15], $pista, 'mejor_hembra');
                                @endphp
                                <th class="bordes celdasMejores">{{ ($mejorHembra)? $mejorHembra->numero_prefijo : '' }}</th>
                            </tr>
                        </tfoot>
                    </table> --}}

                    <div class="extrangeroMacho">
                        <table class="bordes tablaEstrangero">
                            <thead>
                                <tr>
                                    <th  class="bordes" height="2" colspan="2">N</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="bordes">CLACAB</td>
                                    @php
                                        $certificado = App\Juez::getCertificacionExtranjero($evento_id, $pista, $er->raza_id, 'certificacionCLACAB', 'Hembra');
                                    @endphp
                                    <td class="bordes"><span class="extrangeroNumero">{{ (($certificado)? $certificado->numero_prefijo : '' ) }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="extrangeroMachoCacib">
                        <table class="bordes tablaEstrangero">
                            <thead>
                                <tr>
                                    <th  class="bordes" height="2" colspan="2">N</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="bordes">CACIB</td>
                                    @php
                                        $certificado = App\Juez::getCertificacionExtranjero($evento_id, $pista, $er->raza_id, 'certificacionCACIB', 'Hembra');
                                    @endphp
                                    <td class="bordes"><span class="extrangeroNumero">{{ (($certificado)? $certificado->numero_prefijo : '' ) }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mejorRazaCJA">
                    <div class="mejorCachorro bordes">
                        <div class="mejorTitulo">
                            CACHORRO ABSOLUTO
                        </div>
                        <br>
                        <table width="90%" style="float: right;">
                            <thead>
                                <tr>
                                    @php
                                        $mejor = App\Juez::mejorCategoria($evento_id, $pista, $er->raza_id, 'mejor_cachorro');
                                    @endphp
                                    <th class="bordes textMejoNumero">{{ ($mejor)? $mejor->numero_prefijo : '' }}</th>
                                    <th class="textoTituloMejor">Mejor <br> Cachorro</th>
                                </tr>
                            </thead>
                        </table>
                        <br>
                        <br>
                        <table width="90%" style="float: right;">
                            <thead>
                                <tr>
                                    @php
                                        $sexoOpuesto = App\Juez::mejorCategoria($evento_id, $pista, $er->raza_id, 'sexo_opuesto_cachorro');
                                    @endphp
                                    <th class="bordes textMejoNumero">{{ ($sexoOpuesto)? $sexoOpuesto->numero_prefijo : '' }}</th>
                                    <th class="textoTituloMejor">Sexo <br> Opuesto</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="mejorJoven bordes">
                        <div class="mejorTituloJoven">
                            JOVENES
                        </div>
                        <br>
                        <table width="90%" style="float: right;">
                            <thead>
                                <tr>
                                    @php
                                        $mejor = App\Juez::mejorCategoria($evento_id, $pista, $er->raza_id, 'mejor_joven');
                                    @endphp
                                    <th class="bordes textMejoNumeroJoven">{{ ($mejor)? $mejor->numero_prefijo : '' }}</th>
                                    <th class="textoTituloMejorJoven">MEJOR JOVEN</th>
                                </tr>
                            </thead>
                        </table>
                        <br>
                        <br>
                        <table width="90%" style="float: right;">
                            <thead>
                                <tr>
                                    @php
                                        $sexoOpuesto = App\Juez::mejorCategoria($evento_id, $pista, $er->raza_id, 'sexo_opuesto_joven');
                                    @endphp
                                    <th class="bordes textMejoNumeroJoven">{{ ($sexoOpuesto)? $sexoOpuesto->numero_prefijo : '' }}</th>
                                    <th class="textoTituloMejorJoven">SEXO OPUESTO</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <div class="mejorRaza bordes">
                        <br>
                        <br>
                        <table width="90%" style="float: right;">
                            <thead>
                                <tr>
                                    @php
                                        $mejor = App\Juez::mejorCategoria($evento_id, $pista, $er->raza_id, 'mejor_raza');
                                    @endphp
                                    <th class="bordes textMejoNumeroJoven">{{ ($mejor)? $mejor->numero_prefijo : '' }}</th>
                                    <th class="textoTituloMejorJoven">MEJOR DE LA RAZA</th>
                                </tr>
                            </thead>
                        </table>
                        <br>
                        <br>
                        <table width="90%" style="float: right;">
                            <thead>
                                <tr>
                                    @php
                                        $sexoOpuesto = App\Juez::mejorCategoria($evento_id, $pista, $er->raza_id, 'sexo_opuesto_raza');
                                    @endphp
                                    <th class="bordes textMejoNumeroJoven">{{ ($sexoOpuesto)? $sexoOpuesto->numero_prefijo : '' }}</th>
                                    <th class="textoTituloMejorJoven">SEXO OPUESTO</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    {{--  <table width="100%">
                        <tbody>
                            <tr>
                                <td class="mejoresVencedoresLetras">MEJOR CACHORRO</td>
                                @php
                                    $mejor = App\Juez::mejorCategoria($evento_id, $pista, $er->raza_id, 'mejor_cachorro');
                                @endphp
                                <td class="bordes celdasMejores">{{ ($mejor)? $mejor->numero_prefijo : '' }}</td>
                                <td class="mejoresVencedoresLetras">MEJOR JOVEN</td>
                                @php
                                    $mejor = App\Juez::mejorCategoria($evento_id, $pista, $er->raza_id, 'mejor_joven');
                                @endphp
                                <td class="bordes celdasMejores">{{ ($mejor)? $mejor->numero_prefijo : '' }}</td>
                                <td class="mejoresVencedoresLetras">MEJOR DE LA RAZA</td>
                                @php
                                    $mejor = App\Juez::mejorCategoria($evento_id, $pista, $er->raza_id, 'mejor_raza');
                                @endphp
                                <td class="bordes celdasMejores">{{ ($mejor)? $mejor->numero_prefijo : '' }}</td>
                            </tr>
                            <tr>
                                <td class="mejoresVencedoresLetras">SEXO OPUESTO</td>
                                @php
                                    $sexoOpuesto = App\Juez::mejorCategoria($evento_id, $pista, $er->raza_id, 'sexo_opuesto_cachorro');
                                @endphp
                                <td class="bordes celdasMejores">{{ ($sexoOpuesto)? $sexoOpuesto->numero_prefijo : '' }}</td>
                                <td class="mejoresVencedoresLetras">SEXO OPUESTO</td>
                                @php
                                    $sexoOpuesto = App\Juez::mejorCategoria($evento_id, $pista, $er->raza_id, 'sexo_opuesto_joven');
                                @endphp
                                <td class="bordes celdasMejores">{{ ($sexoOpuesto)? $sexoOpuesto->numero_prefijo : '' }}</td>
                                <td class="mejoresVencedoresLetras">SEXO OPUESTO</td>
                                @php
                                    $sexoOpuesto = App\Juez::mejorCategoria($evento_id, $pista, $er->raza_id, 'sexo_opuesto_raza');
                                @endphp
                                <td class="bordes celdasMejores">{{ ($sexoOpuesto)? $sexoOpuesto->numero_prefijo : '' }}</td>
                            </tr>
                        </tbody>
                    </table>  --}}
                </div>
                
                
                <div class="bloque_firmas">
                    <div class="firma_figital">
                        @php

                            if($asignacion[0]->estado == 1){
                                $firmaJuez = $asignacion[0]->juez->estado;
                            }else{
                                if($asigEnco){
                                    $firmaJuez = $asigEnco->juez->estado;
                                }
                            }

                        @endphp

                        @if ($asignacion[0]->estado == 1)
                            <img src="{{ url("imagenesFirmaJuezSecre/$firmaJuez") }}" width="100%" alt="">
                        @else
                            @if ($asigEnco)
                                <img src="{{ url("imagenesFirmaJuezSecre/$firmaJuez") }}" width="100%" alt="">
                            @endif
                        @endif

                    </div>

                    _____________________________<br>
                        <b>JUEZ</b>

                        <p class="espacio_firmas"></p>

                    <div class="firma_figital_secretario">
                        @php

                            if($asignacion[0]->estado == 1){
                                $firmaSecre = $asignacion[0]->secretario->estado;
                            }else{
                                if($asigEnco){
                                    $firmaSecre = $asigEnco->secretario->estado;
                                }
                            }

                        @endphp

                        @if ($asignacion[0]->estado == 1)
                            <img src="{{ url("imagenesFirmaJuezSecre/$firmaSecre") }}" width="100%" alt="">
                        @else
                            @if ($asigEnco)
                                <img src="{{ url("imagenesFirmaJuezSecre/$firmaSecre") }}" width="100%" alt="">
                            @endif
                        @endif
                        
                    </div>

                    _____________________________<br>
                        <b>AYUDANTE DE JUEZ</b>
                </div>
            </div>
        @endforeach
        @break
    @endforeach
</body>
</html>