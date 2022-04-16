<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    #tabla-datos{
        /* background-color:black; */
        color: black;
        font-size:9px;
        text-align: center;
    }
    table,th , td{
        border: 1.5px solid black;
        border-collapse: collapse;
    }
    #tabla-datos-cuerpo{
        font-size:10px;
        text-align: left;
        padding:1px;
    }
    #titulo{
        position: absolute;
        margin-top: -30px;
        font-size:20px;
        margin-left: 400px;
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
        margin-left: -20px;
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

    <h1 id="titulo">PLANILLA DE RAZA </h1>
    {{-- <br> --}}
    <div class="cabeza-datos">
        <div id="juez">JUEZ: {{ $datoPlanilla[0]->juez->nombre }}</div>
        <div id="lugar">LUGAR Y FECHA: {{ date('d/m/Y') }}</div>
        <div id="raza">RAZA: {{ $datoPlanilla[0]->raza->nombre }}</div>
        <div id="grupo">GRUPO: {{ $datoPlanilla[0]->grupo_id }}</div>
    </div>

    <br>        

    <div class="planillaMacho">

        <div id="machos">
            <h3>
                <span> O </span>
                <span> H </span>
                <span> C </span>
                <span> A </span>
                <span> M </span>
            </h3>
        </div>

        <div id="table-cachorros">
            <table>
                <thead id="tabla-datos">
                    <tr>
                        <th colspan="3">CACHORRO <br> 6 a 9 meses</th>
                    </tr>
                </thead>
                <tbody id="tabla-datos-cuerpo">
                    <tr>
                        <th>Nº</th>
                        <th>Calf.</th>
                        <th>Lugar</th>
                    </tr>
                    @php
                        $cantidad = count($cachorrosMacho);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            <th id="numero_prefijo">{{ $cachorrosMacho[$i]->inscripcion->numero_prefijo }}</th>
                            <th id="calificaion">{{ $cachorrosMacho[$i]->calificacion }}</th>
                            <th>{{ $cachorrosMacho[$i]->lugar }}</th>
                        @else
                            <th id="numero_prefijo"><p style="padding-top: 1px;"></p></th>
                            <th id="calificaion"></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    <td colspan="3" style="font-size: 10px;">
                        CCCB
                        <table id="tabla-ponderacion">
                            <thead >
                                <tr>
                                    <th id="tabla-dentroTabla">N</th>
                                </tr>
                            </thead>
                            <tbody >
                                <tr>
                                    <td id="tabla-dentroTablaponderacion"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tfoot>
            </table>
        </div>
    
        <div id="table-joven">
            <table>
                <thead id="tabla-datos">
                    <tr>
                        <th colspan="3">JOVEN <br> 9 a 18 meses</th>
                    </tr>
                </thead>
                <tbody id="tabla-datos-cuerpo">
                    <tr>
                        <th>Nº</th>
                        <th>Calf.</th>
                        <th>Lugar</th>
                    </tr>
                    @php
                        $cantidad = count($jovenMacho);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            <th id="numero_prefijo">{{ $jovenMacho[$i]->inscripcion->numero_prefijo }}</th>
                            <th id="calificaion">{{ $jovenMacho[$i]->calificacion }}</th>
                            <th>{{ $jovenMacho[$i]->lugar }}</th>
                        @else
                            <th id="numero_prefijo"><p style="padding-top: 1px;"></p></th>
                            <th id="calificaion"></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    <td colspan="3" style="font-size: 10px;">
                        CJCB
                        <table id="tabla-ponderacion">
                            <thead >
                                <tr>
                                    <th id="tabla-dentroTabla">N</th>
                                </tr>
                            </thead>
                            <tbody >
                                <tr>
                                    <td id="tabla-dentroTablaponderacion"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tfoot>
            </table>
        </div>
    
        <div id="table-jovenCampeon">
            <table>
                <thead id="tabla-datos">
                    <tr>
                        <th colspan="3">JOVEN CAMPEON <br> 9 a 18 meses</th>
                    </tr>
                </thead>
                <tbody id="tabla-datos-cuerpo">
                    <tr>
                        <th>Nº</th>
                        <th>Calf.</th>
                        <th>Lugar</th>
                    </tr>
                    @php
                        $cantidad = count($jovenCampeonMacho);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            <th id="numero_prefijo">{{ $jovenCampeonMacho[$i]->inscripcion->numero_prefijo }}</th>
                            <th id="calificaion">{{ $jovenCampeonMacho[$i]->calificacion }}</th>
                            <th>{{ $jovenCampeonMacho[$i]->lugar }}</th>
                        @else
                            <th id="numero_prefijo"><p style="padding-top: 1px;"></p></th>
                            <th id="calificaion"></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    <td colspan="3" style="font-size: 10px;">
                        CJCGB
                        <table id="tabla-ponderacion">
                            <thead >
                                <tr>
                                    <th id="tabla-dentroTabla">N</th>
                                </tr>
                            </thead>
                            <tbody >
                                <tr>
                                    <td id="tabla-dentroTablaponderacion"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tfoot>
            </table>
        </div>
        
        <div id="table-intermedio">
            <table>
                <thead id="tabla-datos">
                    <tr>
                        <th colspan="3">INTERMEDIA <br> 15 a 24 meses</th>
                    </tr>
                </thead>
                <tbody id="tabla-datos-cuerpo">
                    <tr>
                        <th>Nº</th>
                        <th>Calf.</th>
                        <th>Lugar</th>
                    </tr>
                    @php
                        $cantidad = count($intermediaMacho);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            <th id="numero_prefijo">{{ $intermediaMacho[$i]->inscripcion->numero_prefijo }}</th>
                            <th id="calificaion">{{ $intermediaMacho[$i]->calificacion }}</th>
                            <th>{{ $intermediaMacho[$i]->lugar }}</th>
                        @else
                            <th id="numero_prefijo"><p style="padding-top: 1px;"></p></th>
                            <th id="calificaion"></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    <td colspan="3" style="height: 47px"></td>
                </tfoot>
            </table>
        </div>
    
        <div id="table-abierta">
            <table>
                <thead id="tabla-datos">
                    <tr>
                        <th colspan="3">ABIERTA <br> Mayor a 24 Meses</th>
                    </tr>
                </thead>
                <tbody id="tabla-datos-cuerpo">
                    <tr>
                        <th>Nº</th>
                        <th>Calf.</th>
                        <th>Lugar</th>
                    </tr>
                    @php
                        $cantidad = count($abiertaMacho);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            <th id="numero_prefijo">{{ $abiertaMacho[$i]->inscripcion->numero_prefijo }}</th>
                            <th id="calificaion">{{ $abiertaMacho[$i]->calificacion }}</th>
                            <th>{{ $abiertaMacho[$i]->lugar }}</th>
                        @else
                            <th id="numero_prefijo"><p style="padding-top: 1px;"></p></th>
                            <th id="calificaion"></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    <td colspan="3" style="height: 47px"></td>
                </tfoot>
            </table>
        </div>
    
        <div id="table-campeones">
            <table>
                <thead id="tabla-datos">
                    <tr>
                        <th id="cabecera-campeones" colspan="3">CAMPEONES</th>
                    </tr>
                </thead>
                <tbody id="tabla-datos-cuerpo">
                    <tr>
                        <th>Nº</th>
                        <th>Calf.</th>
                        <th>Lugar</th>
                    </tr>
                    @php
                        $cantidad = count($campeonesMacho);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            <th id="numero_prefijo">{{ $campeonesMacho[$i]->inscripcion->numero_prefijo }}</th>
                            <th id="calificaion">{{ $campeonesMacho[$i]->calificacion }}</th>
                            <th>{{ $campeonesMacho[$i]->lugar }}</th>
                        @else
                            <th id="numero_prefijo"><p style="padding-top: 1px;"></p></th>
                            <th id="calificaion"></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    <td colspan="3" style="font-size: 10px;">
                        CGCB
                        <table id="tabla-ponderacion">
                            <thead >
                                <tr>
                                    <th id="tabla-dentroTabla">N</th>
                                </tr>
                            </thead>
                            <tbody >
                                <tr>
                                    <td id="tabla-dentroTablaponderacion"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tfoot>
            </table>
        </div>
    
        <div id="table-grandesCampeones">
            <table>
                <thead id="tabla-datos">
                    <tr>
                        <th id="cabecera-campeones"  colspan="3">GRANDES CAMPEONES</th>
                    </tr>
                </thead>
                <tbody id="tabla-datos-cuerpo">
                    <tr>
                        <th>Nº</th>
                        <th>Calf.</th>
                        <th>Lugar</th>
                    </tr>
                    @php
                        $cantidad = count($GrandesCampeonesMacho);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            <th id="numero_prefijo">{{ $GrandesCampeonesMacho[$i]->inscripcion->numero_prefijo }}</th>
                            <th id="calificaion">{{ $GrandesCampeonesMacho[$i]->calificacion }}</th>
                            <th>{{ $GrandesCampeonesMacho[$i]->lugar }}</th>
                        @else
                            <th id="numero_prefijo"><p style="padding-top: 1px;"></p></th>
                            <th id="calificaion"></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    <td colspan="3" style="height: 47px"></td>
                </tfoot>
            </table>
        </div>
    
        <div id="table-veteranos">
            <table>
                <thead id="tabla-datos">
                    <tr>
                        <th id="cabecera-campeones"  colspan="3">VETERANOS</th>
                    </tr>
                </thead>
                <tbody id="tabla-datos-cuerpo">
                    <tr>
                        <th>Nº</th>
                        <th>Calf.</th>
                        <th>Lugar</th>
                    </tr>
                    @php
                        $cantidad = count($veteranosMacho);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            <th id="numero_prefijo">{{ $veteranosMacho[$i]->inscripcion->numero_prefijo }}</th>
                            <th id="calificaion">{{ $veteranosMacho[$i]->calificacion }}</th>
                            <th>{{ $veteranosMacho[$i]->lugar }}</th>                                
                        @else
                            <th id="numero_prefijo"><p style="padding-top: 1px;"></p></th>
                            <th id="calificaion"></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    <td colspan="3" style="font-size: 10px;">
                        CACV
                        <table id="tabla-ponderacion">
                            <thead >
                                <tr>
                                    <th id="tabla-dentroTabla">N</th>
                                </tr>
                            </thead>
                            <tbody >
                                <tr>
                                    <td id="tabla-dentroTablaponderacion"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="planillaHembra">

        <div id="hembra">
            <h3>
                <span> A </span>
                <span> R </span>
                <span> B </span>
                <span> M </span>
                <span> E </span>
                <span> H </span>
            </h3>
        </div>

        <div id="table-cachorrosHembra">
            <table>
                <thead id="tabla-datos">
                    <tr>
                        <th colspan="3">CACHORRO <br> 6 a 9 meses</th>
                    </tr>
                </thead>
                <tbody id="tabla-datos-cuerpo">
                    <tr>
                        <th>Nº</th>
                        <th>Calf.</th>
                        <th>Lugar</th>
                    </tr>
                    @php
                        $cantidad = count($cachorrosHembra);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            <th id="numero_prefijo">{{ $cachorrosHembra[$i]->inscripcion->numero_prefijo }}</th>
                            <th id="calificaion">{{ $cachorrosHembra[$i]->calificacion }}</th>
                            <th>{{ $cachorrosHembra[$i]->lugar }}</th>
                        @else
                            <th id="numero_prefijo"><p style="padding-top: 1px;"></p></th>
                            <th id="calificaion"></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    <td colspan="3" style="font-size: 10px;">
                        CACV
                        <table id="tabla-ponderacion">
                            <thead >
                                <tr>
                                    <th id="tabla-dentroTabla">N</th>
                                </tr>
                            </thead>
                            <tbody >
                                <tr>
                                    <td id="tabla-dentroTablaponderacion"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tfoot>
            </table>
        </div>
    
        <div id="table-jovenHembra">
            <table>
                <thead id="tabla-datos">
                    <tr>
                        <th colspan="3">JOVEN <br> 9 a 18 meses</th>
                    </tr>
                </thead>
                <tbody id="tabla-datos-cuerpo">
                    <tr>
                        <th>Nº</th>
                        <th>Calf.</th>
                        <th>Lugar</th>
                    </tr>
                    @php
                        $cantidad = count($jovenHembra);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            <th id="numero_prefijo">{{ $jovenHembra[$i]->inscripcion->numero_prefijo }}</th>
                            <th id="calificaion">{{ $jovenHembra[$i]->calificacion }}</th>
                            <th>{{ $jovenHembra[$i]->lugar }}</th>
                        @else
                            <th id="numero_prefijo"><p style="padding-top: 1px;"></p></th>
                            <th id="calificaion"></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    <td colspan="3" style="font-size: 10px;">
                        CACV
                        <table id="tabla-ponderacion">
                            <thead >
                                <tr>
                                    <th id="tabla-dentroTabla">N</th>
                                </tr>
                            </thead>
                            <tbody >
                                <tr>
                                    <td id="tabla-dentroTablaponderacion"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tfoot>
            </table>
        </div>
    
        <div id="table-jovenCampeonHembra">
            <table>
                <thead id="tabla-datos">
                    <tr>
                        <th colspan="3">JOVEN CAMPEON <br> 9 a 18 meses</th>
                    </tr>
                </thead>
                <tbody id="tabla-datos-cuerpo">
                    <tr>
                        <th>Nº</th>
                        <th>Calf.</th>
                        <th>Lugar</th>
                    </tr>
                    @php
                        $cantidad = count($jovenCampeonHembra);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            <th id="numero_prefijo">{{ $jovenCampeonHembra[$i]->inscripcion->numero_prefijo }}</th>
                            <th id="calificaion">{{ $jovenCampeonHembra[$i]->calificacion }}</th>
                            <th>{{ $jovenCampeonHembra[$i]->lugar }}</th>
                        @else
                            <th id="numero_prefijo"><p style="padding-top: 1px;"></p></th>
                            <th id="calificaion"></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    <td colspan="3" style="font-size: 10px;">
                        CACV
                        <table id="tabla-ponderacion">
                            <thead >
                                <tr>
                                    <th id="tabla-dentroTabla">N</th>
                                </tr>
                            </thead>
                            <tbody >
                                <tr>
                                    <td id="tabla-dentroTablaponderacion"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tfoot>
            </table>
        </div>
        
        <div id="table-intermedioHembra">
            <table>
                <thead id="tabla-datos">
                    <tr>
                        <th colspan="3">INTERMEDIA <br> 15 a 24 meses</th>
                    </tr>
                </thead>
                <tbody id="tabla-datos-cuerpo">
                    <tr>
                        <th>Nº</th>
                        <th>Calf.</th>
                        <th>Lugar</th>
                    </tr>
                    @php
                        $cantidad = count($intermediaHembra);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            <th id="numero_prefijo">{{ $intermediaHembra[$i]->inscripcion->numero_prefijo }}</th>
                            <th id="calificaion">{{ $intermediaHembra[$i]->calificacion }}</th>
                            <th>{{ $intermediaHembra[$i]->lugar }}</th>
                        @else
                            <th id="numero_prefijo"><p style="padding-top: 1px;"></p></th>
                            <th id="calificaion"></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    <td colspan="3" style="height: 47px"></td>
                </tfoot>
            </table>
        </div>
    
        <div id="table-abiertaHembra">
            <table>
                <thead id="tabla-datos">
                    <tr>
                        <th colspan="3">ABIERTA <br> Mayor a 24 Meses</th>
                    </tr>
                </thead>
                <tbody id="tabla-datos-cuerpo">
                    <tr>
                        <th>Nº</th>
                        <th>Calf.</th>
                        <th>Lugar</th>
                    </tr>
                    @php
                        $cantidad = count($abiertaHembra);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            <th id="numero_prefijo">{{ $abiertaHembra[$i]->inscripcion->numero_prefijo }}</th>
                            <th id="calificaion">{{ $abiertaHembra[$i]->calificacion }}</th>
                            <th>{{ $abiertaHembra[$i]->lugar }}</th>
                        @else
                            <th id="numero_prefijo"><p style="padding-top: 1px;"></p></th>
                            <th id="calificaion"></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    <td colspan="3" style="height: 47px"></td>
                </tfoot>
            </table>
        </div>
    
        <div id="table-campeonesHembra">
            <table>
                <thead id="tabla-datos">
                    <tr>
                        <th id="cabecera-campeones"  colspan="3">CAMPEONES</th>
                    </tr>
                </thead>
                <tbody id="tabla-datos-cuerpo">
                    <tr>
                        <th>Nº</th>
                        <th>Calf.</th>
                        <th>Lugar</th>
                    </tr>
                    @php
                        $cantidad = count($campeonesHembra);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            <th id="numero_prefijo">{{ $campeonesHembra[$i]->inscripcion->numero_prefijo }}</th>
                            <th id="calificaion">{{ $campeonesHembra[$i]->calificacion }}</th>
                            <th>{{ $campeonesHembra[$i]->lugar }}</th>
                        @else
                            <th id="numero_prefijo"><p style="padding-top: 1px;"></p></th>
                            <th id="calificaion"></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    <td colspan="3" style="font-size: 10px;">
                        CACV
                        <table id="tabla-ponderacion">
                            <thead >
                                <tr>
                                    <th id="tabla-dentroTabla">N</th>
                                </tr>
                            </thead>
                            <tbody >
                                <tr>
                                    <td id="tabla-dentroTablaponderacion"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tfoot>
            </table>
        </div>
    
        <div id="table-grandesCampeonesHembra">
            <table>
                <thead id="tabla-datos">
                    <tr>
                        <th  id="cabecera-campeones"  colspan="3">GRANDES CAMPEONES</th>
                    </tr>
                </thead>
                <tbody id="tabla-datos-cuerpo">
                    <tr>
                        <th>Nº</th>
                        <th>Calf.</th>
                        <th>Lugar</th>
                    </tr>
                    @php
                        $cantidad = count($GrandesCampeonesHembra);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            <th id="numero_prefijo">{{ $GrandesCampeonesHembra[$i]->inscripcion->numero_prefijo }}</th>
                            <th id="calificaion">{{ $GrandesCampeonesHembra[$i]->calificacion }}</th>
                            <th>{{ $GrandesCampeonesHembra[$i]->lugar }}</th>
                        @else
                            <th id="numero_prefijo"><p style="padding-top: 1px;"></p></th>
                            <th id="calificaion"></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    <td colspan="3" style="height: 47px"></td>
                </tfoot>
            </table>
        </div>
    
        <div id="table-veteranosHembra">
            <table>
                <thead id="tabla-datos">
                    <tr>
                        <th  id="cabecera-campeones"  colspan="3">VETERANOS</th>
                    </tr>
                </thead>
                <tbody id="tabla-datos-cuerpo">
                    <tr>
                        <th>Nº</th>
                        <th>Calf.</th>
                        <th>Lugar</th>
                    </tr>
                    @php
                        $cantidad = count($veteranosHembra);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            <th id="numero_prefijo">{{ $veteranosHembra[$i]->inscripcion->numero_prefijo }}</th>
                            <th id="calificaion">{{ $veteranosHembra[$i]->calificacion }}</th>
                            <th>{{ $veteranosHembra[$i]->lugar }}</th>
                        @else
                            <th id="numero_prefijo"><p style="padding-top: 1px;"></p></th>
                            <th id="calificaion"></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    <td colspan="3" style="font-size: 10px;">
                        CACV
                        <table id="tabla-ponderacion">
                            <thead >
                                <tr>
                                    <th id="tabla-dentroTabla">N</th>
                                </tr>
                            </thead>
                            <tbody >
                                <tr>
                                    <td id="tabla-dentroTablaponderacion"></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tfoot>
            </table>
        </div>
    </div>
    
</body>
</html>