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

        /* background-color : green; */
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
    }

    .fecha{
        position: absolute;
        font-size:11px;
        left: 45%;
    }

    #header{
        text-align: center;
    }

    .table{
        position: absolute;
        margin-top: 30px;
        border: 0.7px solid black;
        font-size:8px;
        width: 120px;
        border-collapse:collapse;
    }

    .cachorro{
        /* margin-left: 62px; */
    }

    .joven{
        margin-left: 119px;
    }

    .jovenCampeon{
        margin-left: 239px;
    }

    .intermedia{
        margin-left: 358px;
    }

    .abierta{
        margin-left: 476px;
    }

    .campoeones{
        margin-left: 595px;
    }

    .grandesCampeones{
        margin-left: 714px;
    }

    .veteranos{
        margin-left: 833px;
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

    .certificadosJoven{
        position: absolute;
        border: 1px solid black;
        width: 118px;
        margin-top: 178px;
        font-size:10px;
        margin-left: 119px;
    }

    .certificadosJovenCampeon{
        position: absolute;
        border: 1px solid black;
        width: 118px;
        margin-top: 178px;
        font-size:10px;
        margin-left: 238px;
    }

    .certificadosIntermedia{
        position: absolute;
        border: 1px solid black;
        width: 118px;
        margin-top: 178px;
        font-size:10px;
        margin-left: 357px;
    }

    .certificadosAbierta{
        position: absolute;
        border: 1px solid black;
        width: 118px;
        margin-top: 178px;
        font-size:10px;
        margin-left: 476px;
    }

    .certificadosCampeones{
        position: absolute;
        border: 1px solid black;
        width: 118px;
        margin-top: 178px;
        font-size:10px;
        margin-left: 595px;
    }

    .certificadosGrandesCampeones{
        position: absolute;
        border: 1px solid black;
        width: 118px;
        margin-top: 178px;
        font-size:10px;
        margin-left: 714px;
    }

    .certificadosVeterano{
        position: absolute;
        border: 1px solid black;
        width: 118px;
        margin-top: 178px;
        font-size:10px;
        margin-left: 833px;
    }

    .machosVEncedores{
        position: absolute;
        margin-top: 225px;
        font-size: 12px;
        width: 590px;
    }
    .celdasMejores{
        width: 50px;
    }
    .mejoresVencedoresLetras{
        text-align: right;
    }

</style>
<body>

    @foreach ($arrayEjemplaresTotal as $aet)
        @php
            $ejempleresRazas = $aet['ejemplares'];
        @endphp
        @foreach ( $ejempleresRazas as $er)

            <div class="planilla">
                <div id="header">   
                    PLANILLA DE RAZA
                </div>

                <p class="juez">
                    Juez: {{ $asignacion->juez->nombre }}
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

                    // dd($er->raza_id, $categoriaCachorroAbsolutoMacho, $categoriaJovenMacho, $categoriaJovenCampeonMacho, $categoriaIntermediaMacho, $categoriaAbiertaMacho, $categoriaCampeonMacho, $categoriaGrandesCampeonesMacho, $categoriaVeteranosMacho);

                @endphp

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
                        $mejorCategoria = App\Juez::mejorCategoriaEscogito($evento_id, 11, $pista, $er->raza_id);
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
                        $mejorCategoria = App\Juez::mejorCategoriaEscogito($evento_id, 3, $pista, $er->raza_id);
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
                    CJGB
                    @php
                        $mejorCategoria = App\Juez::mejorCategoriaEscogito($evento_id, 12, $pista, $er->raza_id);
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
                    CCCB
                    @php
                        $mejorCategoria = App\Juez::mejorCategoriaEscogito($evento_id, 5, $pista, $er->raza_id);
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
                <div class="certificadosAbierta bordes">
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
                </div>

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
                    CCCB
                    @php
                        $mejorCategoria = App\Juez::mejorCategoriaEscogito($evento_id, 9, $pista, $er->raza_id);
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
                    CCCB
                    @php
                        $mejorCategoria = App\Juez::mejorCategoriaEscogito($evento_id, 14, $pista, $er->raza_id);
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
                    CCCB
                    @php
                        $mejorCategoria = App\Juez::mejorCategoriaEscogito($evento_id, 16, $pista, $er->raza_id);
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

                <div class="machosVEncedores bordes">
                    <table style="width: 100%;">
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
                    </table>
                </div>

            </div>
        @endforeach
    @endforeach
</body>
</html>