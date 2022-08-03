<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>

    .planilla{

        height: 720px;
        /* background-color :red; */

    }

    .tabla_planilla, tabla_planillaTh, tabla_planillaTd{
        border: 1.5px solid black;
        border-collapse: collapse;
    }

    /* el primeor que se utilizpo */
    .titulo{
        text-align: center;
        margin-top: -10px;
        font-size:20px;
    }

    .texto_mejor_recerva{

        font-size:9px;

    }

    .espacioPadingVacio{

        text-align: center;
        height: 10px;

        /* padding:8px */
        /* padding-top: 4px;
        padding-bottom: 4px; */

    }
    .espacioPadingVacioTd{
        padding:9px
    }
    .centreado{
        text-align: center:
    }
    .texto_mejor_grupo{
        font-size: 9px;
        padding-left: 3px;
        padding-right: 2px;
        border:1 solid black;
        background: #D4D2D4;

        width: 78px;
    }

    #divPadre {
        width: 150px;
        border: 1 solid black;
        padding: 3px;
        text-align: center;
        font-size:12px;
        background: #D4D2D4;
        position: absolute;
        margin-left: 400px;
    }
    #divHijo {
        height:30px;
        width:80px;
        margin:0px auto;
        background-color:white;
        border: 1 solid black;
        font-size:20px;
        padding-top: 5px;
    }

    /* segundo */
    #divPadre_segundo {
        width: 70px;
        border: 1 solid black;
        padding: 3px;
        text-align: center;
        font-size:12px;
        background: #D4D2D4;
        position: absolute;
        margin-left: 225px;
    }
    #divHijo_segundo {
        height:30px;
        width:69px;
        margin:0px auto;
        background-color:white;
        border: 1 solid black;
        font-size:17px;
        padding-top: 5px;
    }

    /* tercero */
    #divPadre_tercero {
        width: 70px;
        border: 1 solid black;
        padding: 3px;
        text-align: center;
        font-size:12px;
        background: #D4D2D4;
        position: absolute;
        margin-left: 670px;
    }
    #divHijo_tercero {
        height:30px;
        width:69px;
        margin:0px auto;
        background-color:white;
        border: 1 solid black;
        font-size:17px;
        padding-top: 5px;
    }

    /* cuarto */
    #divPadre_cuarto {
        width: 70px;
        border: 1 solid black;
        padding: 3px;
        text-align: center;
        font-size:12px;
        background: #D4D2D4;
        position: absolute;
        margin-left: 50px;
    }
    #divHijo_cuarto {
        height:30px;
        width:69px;
        margin:0px auto;
        background-color:white;
        border: 1 solid black;
        font-size:17px;
        padding-top: 5px;
    }

    /* quinto */
    #divPadre_quinto {
        width: 70px;
        border: 1 solid black;
        padding: 3px;
        text-align: center;
        font-size:12px;
        background: #D4D2D4;
        position: absolute;
        margin-left: 840px;
    }
    #divHijo_quinto {
        height:30px;
        width:69px;
        margin:0px auto;
        background-color:white;
        border: 1 solid black;
        font-size:17px;
        padding-top: 5px;
    }

    .firma_juez{
        text-align: center;
        margin-left: -600px;
        margin-top: 140px;
        font-size: 12px;
    }

    .firma_ayudante{
        text-align: center;
        margin-left: 700px;
        margin-top:-44px;
        font-size:12px;
        position: absolute;
    }

    #table-cachorros{
        position: absolute;
        margin-left: 20px;
    }
    #table-joven{
        position: absolute;
        margin-left: 150px;
    }
    #table-jovenCampeon{
        position: absolute;
        margin-left: 267px;
    }
    #table-intermedio{
        position: absolute;
        margin-left: 389px;
    }
    #table-abierta{
        position: absolute;
        margin-left: 506px;
    }
    #table-campeones{
        position: absolute;
        margin-left: 625px;
    }
    #table-grandesCampeones{
        position: absolute;
        margin-left: 742px;
    }
    #table-veteranos{
        position: absolute;
        margin-left: 877px;
    }

    /* HEMBRAS */
    #table-cachorrosHembra{
        position: absolute;
        margin-left: 20px;
        margin-top: 350px;
    }
    #table-jovenHembra{
        position: absolute;
        margin-left: 150px;
        margin-top: 350px;
    }
    #table-jovenCampeonHembra{
        position: absolute;
        margin-left: 267px;
        margin-top: 350px;
    }
    #table-intermedioHembra{
        position: absolute;
        margin-left: 389px;
        margin-top: 350px;
    }
    #table-abiertaHembra{
        position: absolute;
        margin-left: 506px;
        margin-top: 350px;
    }
    #table-campeonesHembra{
        position: absolute;
        margin-left: 625px;
        margin-top: 350px;
    }
    #table-grandesCampeonesHembra{
        position: absolute;
        margin-left: 742px;
        margin-top: 350px;
    }
    #table-veteranosHembra{
        position: absolute;
        margin-left: 877px;
        margin-top: 350px;
    }

    h3 span { 
        display: block; 
        writing-mode: vertical-lr;
        transform: rotate(-90deg);
    }

    #machos{
        margin-left: -20px;
        position: absolute;
        border: solid;
        padding: 5px;
        padding-top: 55px;
        padding-bottom: 55px;
    }

    #cabecera-campeones{
        padding-top: 7px;
        padding-bottom: 6px;
    }
    #hembra{
        margin-left: -20px;
        position: absolute;
        border: solid;
        padding: 5px;
        padding-top: 56px;
        padding-bottom: 56px;
        margin-top: 350px;
    }

    #juez{
        /* margin-left: -20px; */
        position: absolute;
    }
    #lugar{
        position: absolute;
        margin-left:300px;
    }
    #raza{
        position: absolute;
        margin-left:550px;
    }
    #grupo{
        position: absolute;
        margin-left:890px;
    }
    #calificaion{
        width: 60px;
        height: 20px;
    }
    #numero_prefijo{
        width: 20px;
    }
    #tabla-dentroTabla{
        width: 50px;
        font-size:10px;
    }
    #tabla-dentroTablaponderacion{
        height: 20px;
    }
    #tabla-ponderacion{
        margin-left: 50px;
        margin-top: -5px;
    }

    /* FIRMAS DIGITALES */
    #firma_figital{
        position: absolute;
        margin-top: 70px;
        margin-left: 70px;
        width: 255px;
    }
    #firma_figital_secretario{
        position: absolute;
        margin-top: -100px;
        margin-left: 650px;
        width: 240px;
    }

</style>
<body>
    {{-- @dd($arrayTipos) --}}
    @foreach ( $arrayTipos as $aT)
        <div class="planilla">
            <h1 class="titulo">
                @if($aT['tipo'] ==  "especiales")
                    PLANILLA DE CACHORRO ESPECIAL            
                @elseif ($aT['tipo'] ==  "absolutos")
                    PLANILLA FINALES CACHORRO ABSOLUTO
                @elseif ($aT['tipo'] ==  "jovenes")
                    PLANILLA DE FINALES JOVENES
                @elseif ($aT['tipo'] ==  "adultos")
                    PLANILLA DE FINALES ADULTOS
                @endif
            </h1>
            
            <div class="cabeza-datos">
                @php
                    if($juez[0]->estado == 2){
                        $juezEscojido = null;
                        foreach ($juez as $j){
                            if(in_array(ucfirst($aT['tipo']), json_decode($j->categorias))){
                                $juezEscojido = $j;
                                break;
                            }
                        }
                    }else{
                        $juezEscojido = $juez[0];
                    }
                @endphp
                <div id="juez">JUEZ: {{ $juezEscojido->juez->nombre }}</div>
                <div id="lugar">LUGAR Y FECHA: {{ date('d/m/Y') }}</div>
            </div>
        
            <br>
            
            <table class="tabla_planilla">
                <thead>
                    <tr>
                        <th class="tabla_planilla" colspan="2">Grupo 1</th>
                        <th class="tabla_planilla" colspan="2">Grupo 2</th>
                        <th class="tabla_planilla" colspan="2">Grupo 3</th>
                        <th class="tabla_planilla" colspan="2">Grupo 4</th>
                        <th class="tabla_planilla" colspan="2">Grupo 5</th>
                        <th class="tabla_planilla" colspan="2">Grupo 6</th>
                        <th class="tabla_planilla" colspan="2">Grupo 7</th>
                        <th class="tabla_planilla" colspan="2">Grupo 8</th>
                        <th class="tabla_planilla" colspan="2">Grupo 9</th>
                        <th class="tabla_planilla" colspan="2">Grupo 10</th>
                        <th class="tabla_planilla" colspan="2">Grupo 11</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="texto_mejor_recerva tabla_planilla">
                        <td class="tabla_planilla">MEJOR DE <br> RAZA</td>
                        <td class="tabla_planilla">LUGAR</td>
                        <td class="tabla_planilla">MEJOR DE <br> RAZA</td>
                        <td class="tabla_planilla">LUGAR</td>
                        <td class="tabla_planilla">MEJOR DE <br> RAZA</td>
                        <td class="tabla_planilla">LUGAR</td>
                        <td class="tabla_planilla">MEJOR DE <br> RAZA</td>
                        <td class="tabla_planilla">LUGAR</td>
                        <td class="tabla_planilla">MEJOR DE <br> RAZA</td>
                        <td class="tabla_planilla">LUGAR</td>
                        <td class="tabla_planilla">MEJOR DE <br> RAZA</td>
                        <td class="tabla_planilla">LUGAR</td>
                        <td class="tabla_planilla">MEJOR DE <br> RAZA</td>
                        <td class="tabla_planilla">LUGAR</td>
                        <td class="tabla_planilla">MEJOR DE <br> RAZA</td>
                        <td class="tabla_planilla">LUGAR</td>
                        <td class="tabla_planilla">MEJOR DE <br> RAZA</td>
                        <td class="tabla_planilla">LUGAR</td>
                        <td class="tabla_planilla">MEJOR DE <br> RAZA</td>
                        <td class="tabla_planilla">LUGAR</td>
                        <td class="tabla_planilla">MEJOR DE <br> RAZA</td>
                        <td class="tabla_planilla">LUGAR</td>
                    </tr>

                    @for($i = 0; $i < 9; $i++)
                    {{-- @for($i = 0; $i < 14; $i++) --}}
                        <tr class="tabla_planilla">
                            @foreach ( $aT['grupos'] as $ag )
                                @if(count($ag) > $i)
                                    <td class="tabla_planilla centreado">{{ $ag[$i]->numero_prefijo }}</td>   
                                    <td class="tabla_planilla centreado">{{ $ag[$i]->lugar }}</td>   
                                @else
                                    <td class="tabla_planilla espacioPadingVacioTd"></td>
                                    <td class="tabla_planilla espacioPadingVacioTd"></td>
                                @endif
                            @endforeach
                        </tr>
                    @endfor
                </tbody>
            </table>

            <p style="margin-top: 0px;"></p>

            <div id="mejores_grupo">
                <table class="tabla_planilla">
                    <thead>
                        <tr>
                            <th class="texto_mejor_grupo">MEJOR DE GRUPO</th>
                            <th class="texto_mejor_grupo">MEJOR DE GRUPO</th>
                            <th class="texto_mejor_grupo">MEJOR DE GRUPO</th>
                            <th class="texto_mejor_grupo">MEJOR DE GRUPO</th>
                            <th class="texto_mejor_grupo">MEJOR DE GRUPO</th>
                            <th class="texto_mejor_grupo">MEJOR DE GRUPO</th>
                            <th class="texto_mejor_grupo">MEJOR DE GRUPO</th>
                            <th class="texto_mejor_grupo">MEJOR DE GRUPO</th>
                            <th class="texto_mejor_grupo">MEJOR DE GRUPO</th>
                            <th class="texto_mejor_grupo">MEJOR DE GRUPO</th>
                            <th class="texto_mejor_grupo">MEJOR DE GRUPO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ( $aT['grupos'] as $ag )
                                @if (count($ag) > 0)
                                    @php
                                        $mejoGrupo = null;
        
                                        foreach ($ag as $g){
                                            if($g->mejor_grupo == "Si"){
                                                $mejoGrupo = $g;
                                            }
                                        }
                                    @endphp
                                    <td class="tabla_planilla espacioPadingVacio">{{ (($mejoGrupo)? $mejoGrupo->numero_prefijo : '') }}</td>
                                @else
                                    <td class="tabla_planilla espacioPadingVacioTd"></td>
                                @endif
                            @endforeach
                        </tr>
                    </tbody>
                </table>
                <table class="tabla_planilla">
                    <thead>
                        <tr>
                            <th class="texto_mejor_grupo">RESERVA DE GRUPO</th>
                            <th class="texto_mejor_grupo">RESERVA DE GRUPO</th>
                            <th class="texto_mejor_grupo">RESERVA DE GRUPO</th>
                            <th class="texto_mejor_grupo">RESERVA DE GRUPO</th>
                            <th class="texto_mejor_grupo">RESERVA DE GRUPO</th>
                            <th class="texto_mejor_grupo">RESERVA DE GRUPO</th>
                            <th class="texto_mejor_grupo">RESERVA DE GRUPO</th>
                            <th class="texto_mejor_grupo">RESERVA DE GRUPO</th>
                            <th class="texto_mejor_grupo">RESERVA DE GRUPO</th>
                            <th class="texto_mejor_grupo">RESERVA DE GRUPO</th>
                            <th class="texto_mejor_grupo">RESERVA DE GRUPO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ( $aT['grupos'] as $ag )
                                @if (count($ag) > 0)
                                    @php
                                        $recerva_grupo = null;
        
                                        foreach ($ag as $g){
                                            if($g->recerva_grupo == "Si"){
                                                $recerva_grupo = $g;
                                            }
                                        }
                                    @endphp
                                    <td class="tabla_planilla espacioPadingVacio">{{ (($recerva_grupo)? $recerva_grupo->numero_prefijo: '') }}</td>
                                @else
                                    <td class="tabla_planilla espacioPadingVacioTd"></td>
                                @endif
                            @endforeach
                        </tr>
                    </tbody>
                </table>
                <table class="tabla_planilla">
                    <thead>
                        <tr>
                            <th class="texto_mejor_grupo">3ro de Grupo</th>
                            <th class="texto_mejor_grupo">3ro de Grupo</th>
                            <th class="texto_mejor_grupo">3ro de Grupo</th>
                            <th class="texto_mejor_grupo">3ro de Grupo</th>
                            <th class="texto_mejor_grupo">3ro de Grupo</th>
                            <th class="texto_mejor_grupo">3ro de Grupo</th>
                            <th class="texto_mejor_grupo">3ro de Grupo</th>
                            <th class="texto_mejor_grupo">3ro de Grupo</th>
                            <th class="texto_mejor_grupo">3ro de Grupo</th>
                            <th class="texto_mejor_grupo">3ro de Grupo</th>
                            <th class="texto_mejor_grupo">3ro de Grupo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ( $aT['grupos'] as $ag )
                                @if (count($ag) > 0)
                                    @php
                                        $tercerLugar = null;
        
                                        foreach ($ag as $g){
                                            if($g->lugar == 3){
                                            // if($g->recerva_grupo == "Si"){
                                                $tercerLugar = $g;
                                            }
                                        }
                                    @endphp
                                    <td class="tabla_planilla espacioPadingVacio">{{ (($tercerLugar)? $tercerLugar->numero_prefijo: '') }}</td>
                                @else
                                    <td class="tabla_planilla espacioPadingVacioTd"></td>
                                @endif
                            @endforeach
                        </tr>
                    </tbody>
                </table>
                <table class="tabla_planilla">
                    <thead>
                        <tr>
                            <th class="texto_mejor_grupo">4to de Grupo</th>
                            <th class="texto_mejor_grupo">4to de Grupo</th>
                            <th class="texto_mejor_grupo">4to de Grupo</th>
                            <th class="texto_mejor_grupo">4to de Grupo</th>
                            <th class="texto_mejor_grupo">4to de Grupo</th>
                            <th class="texto_mejor_grupo">4to de Grupo</th>
                            <th class="texto_mejor_grupo">4to de Grupo</th>
                            <th class="texto_mejor_grupo">4to de Grupo</th>
                            <th class="texto_mejor_grupo">4to de Grupo</th>
                            <th class="texto_mejor_grupo">4to de Grupo</th>
                            <th class="texto_mejor_grupo">4to de Grupo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ( $aT['grupos'] as $ag )
                                @if (count($ag) > 0)
                                    @php
                                        $cuartoLugar = null;
        
                                        foreach ($ag as $g){
                                            if($g->lugar == 4){
                                            // if($g->recerva_grupo == "Si"){
                                                $cuartoLugar = $g;
                                            }
                                        }
                                    @endphp
                                    <td class="tabla_planilla espacioPadingVacio">{{ (($cuartoLugar)? $cuartoLugar->numero_prefijo: '') }}</td>
                                @else
                                    <td class="tabla_planilla espacioPadingVacioTd"></td>
                                @endif
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        
            <br>

            <div id="divPadre">
                MEJOR CACHORRO ESPECIAL
                <div id="divHijo">{{ ($aT['primero'])? $aT['primero']->numero_prefijo : '' }}</div>
            </div>
            <div id="divPadre_segundo">
                SEGUNDO
                <div id="divHijo_segundo">{{ ($aT['segundo'])? $aT['segundo']->numero_prefijo : '' }}</div>
            </div>
            <div id="divPadre_tercero">
                TERCERO
                <div id="divHijo_tercero">{{ ($aT['tercer'])? $aT['tercer']->numero_prefijo : '' }}</div>
            </div>
            <div id="divPadre_cuarto">
                CUARTO
                <div id="divHijo_cuarto">{{ ($aT['cuarto'])? $aT['cuarto']->numero_prefijo : '' }}</div>
            </div>
            <div id="divPadre_quinto">
                QUINTO
                <div id="divHijo_quinto">{{ ($aT['quinto'])? $aT['quinto']->numero_prefijo : '' }}</div>
            </div>

            <div id="firma_figital">
                @php
                    if($juez[0]->estado == 2){
                        $juezEscojido = null;
                        foreach ($juez as $j){
                            if(in_array(ucfirst($aT['tipo']), json_decode($j->categorias))){
                                $juezEscojido = $j;
                                break;
                            }
                        }
                    }else{
                        $juezEscojido = $juez[0];
                    }


                    $firmaJuez = $juezEscojido->juez->estado;
                @endphp
                <img src="{{ url("imagenesFirmaJuezSecre/$firmaJuez") }}" width="100%" alt="">
            </div>
            
            <div class="firma_juez">
                _____________________________<br>
                NOMBRE Y FIRMA <br>
                <b>JUEZ</b>
            </div>

            <div id="firma_figital_secretario">
                @php
                    $firmaSecre = $juezEscojido->secretario->estado;
                @endphp
                <img src="{{ url("imagenesFirmaJuezSecre/$firmaSecre") }}" width="100%" alt="">
            </div>

            <div class="firma_ayudante">
                _____________________________<br>
                NOMBRE Y FIRMA <br>
                <b>AYUDANTE DE JUEZ</b>
            </div>
        </div>

    @endforeach
</body>
</html>