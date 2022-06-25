<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    /* #tabla-datos{
        color: black;
        font-size:9px;
        text-align: center;
    } */
    .tabla_planilla, tabla_planillaTh, tabla_planillaTd{
        border: 1.5px solid black;
        border-collapse: collapse;
    }

    /* #tabla-datos-cuerpo{
        font-size:10px;
        text-align: left;
        padding:1px;
    } */


    /* el primeor que se utilizpo */
    #titulo{
        text-align: center;
        /* position: absolute; */
        margin-top: -30px;
        font-size:20px;
        /* margin-left: 400px; */
    }

    .texto_mejor_recerva{

        font-size:9px;

    }

    .espacioPadingVacio{

        padding:10px

    }
    .centreado{
        text-align: center:
    }
    .texto_mejor_grupo{
        font-size: 9px;
        padding-left: 3px;
        padding-right: 2px;
        border:1 solid black;
        background: #D4D2D4
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

    #firma_juez{
        text-align: center;
        margin-left: -600px;
        margin-top:110px;
        font-size:12px;
    }

    #firma_ayudante{
        text-align: center;
        margin-left: 700px;
        margin-top:-43px;
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
</style>
<body>

    <h1 id="titulo">
        @if($tipo ==  "especiales")
            PLANILLA DE CACHORRO ESPECIAL            
        @elseif ($tipo ==  "absolutos")
            PLANILLA FINALES CACHORRO ABSOLUTO
        @elseif ($tipo ==  "jovenes")
            PLANILLA DE FINALES JOVENES
        @elseif ($tipo ==  "adultos")
            PLANILLA DE FINALES ADULTOS
        @endif
    </h1>
    <div class="cabeza-datos">
        <div id="juez">JUEZ: {{ $juez->juez->nombre }}</div>
        <div id="lugar">LUGAR Y FECHA: {{ date('d/m/Y') }}</div>
        {{-- <div id="raza">RAZA:</div> --}}
        {{-- <div id="grupo">GRUPO: </div> --}}
    </div>

    <br>
    
    <div id="planilla">
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
                    <td class="tabla_planilla">RECERVA</td>
                    <td class="tabla_planilla">MEJOR DE <br> RAZA</td>
                    <td class="tabla_planilla">RECERVA</td>
                    <td class="tabla_planilla">MEJOR DE <br> RAZA</td>
                    <td class="tabla_planilla">RECERVA</td>
                    <td class="tabla_planilla">MEJOR DE <br> RAZA</td>
                    <td class="tabla_planilla">RECERVA</td>
                    <td class="tabla_planilla">MEJOR DE <br> RAZA</td>
                    <td class="tabla_planilla">RECERVA</td>
                    <td class="tabla_planilla">MEJOR DE <br> RAZA</td>
                    <td class="tabla_planilla">RECERVA</td>
                    <td class="tabla_planilla">MEJOR DE <br> RAZA</td>
                    <td class="tabla_planilla">RECERVA</td>
                    <td class="tabla_planilla">MEJOR DE <br> RAZA</td>
                    <td class="tabla_planilla">RECERVA</td>
                    <td class="tabla_planilla">MEJOR DE <br> RAZA</td>
                    <td class="tabla_planilla">RECERVA</td>
                    <td class="tabla_planilla">MEJOR DE <br> RAZA</td>
                    <td class="tabla_planilla">RECERVA</td>
                    <td class="tabla_planilla">MEJOR DE <br> RAZA</td>
                    <td class="tabla_planilla">RECERVA</td>
                </tr>

                @for($i = 0; $i < 14; $i++)
                    <tr class="tabla_planilla">
                        @foreach ( $arrayGrupo as $ag )
                            @if(count($ag) > $i)
                                <td class="tabla_planilla centreado">{{ $ag[$i]->numero_prefijo }}</td>   
                                <td class="tabla_planilla centreado">{{ $ag[$i]->lugar }}</td>   
                            @else
                                <td class="tabla_planilla espacioPadingVacio"></td>
                                <td class="tabla_planilla espacioPadingVacio"></td>
                            @endif
                        @endforeach
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>

    <br>

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
                    @foreach ( $arrayGrupo as $ag )
                        @if (count($ag) > 0)
                            @php
                                $mejoGrupo = null;
                                // $mejoRecerva = null;

                                foreach ($ag as $g){
                                    if($g->mejor_grupo == "Si"){
                                        $mejoGrupo = $g;
                                    }
                                    
                                    // if($g->recerva_grupo == "Si"){
                                    //     $mejoRecerva = $g;
                                    // }
                                }
                            @endphp
                            <td class="tabla_planilla espacioPadingVacio">{{ (($mejoGrupo)? $mejoGrupo->numero_prefijo : '') }}</td>
                        @else
                            <td class="tabla_planilla espacioPadingVacio"></td>
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
                    @foreach ( $arrayGrupo as $ag )
                        @if (count($ag) > 0)
                            @php
                                // $mejoGrupo = null;
                                $mejoRecerva = null;

                                foreach ($ag as $g){
                                    // if($g->mejor_grupo == "Si"){
                                    //     $mejoGrupo = $g;
                                    // }
                                    
                                    if($g->recerva_grupo == "Si"){
                                        $mejoRecerva = $g;
                                    }
                                }
                            @endphp
                            <td class="tabla_planilla espacioPadingVacio">{{ (($mejoRecerva)? $mejoRecerva->numero_prefijo: '') }}</td>
                        @else
                            <td class="tabla_planilla espacioPadingVacio"></td>
                        @endif
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>

    <br>

    <div id="divPadre">
        MEJOR CACHORRO ESPECIAL
        <div id="divHijo">{{ ($primerLugar)? $primerLugar->numero_prefijo : '' }}</div>
    </div>
    <div id="divPadre_segundo">
        SEGUNDO
        <div id="divHijo_segundo">{{ ($segundoLugar)? $segundoLugar->numero_prefijo : '' }}</div>
    </div>
    <div id="divPadre_tercero">
        TERCERO
        <div id="divHijo_tercero">{{ ($tercerLugar)? $tercerLugar->numero_prefijo : '' }}</div>
    </div>
    <div id="divPadre_cuarto">
        CUARTO
        <div id="divHijo_cuarto">{{ ($cuartoLugar)? $cuartoLugar->numero_prefijo : '' }}</div>
    </div>
    <div id="divPadre_quinto">
        QUINTO
        <div id="divHijo_quinto">{{ ($quintoLugar)? $quintoLugar->numero_prefijo : '' }}</div>
    </div>

    <div id="firma_juez">
        _____________________________<br>
        NOMBRE Y FIRMA <br>
        <b>JUEZ</b>
    </div>

    <div id="firma_ayudante">
        _____________________________<br>
        NOMBRE Y FIRMA <br>
        <b>AYUDANTE DE JUEZ</b>
    </div>
    
</body>
</html>