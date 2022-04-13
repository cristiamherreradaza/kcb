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
        background-color:black;
        color: white;
        font-size:10px;
        text-align: center;
    }
    table,th , td{
        border: 1px solid black;
        border-collapse: collapse;
    }
    #tabla-datos-cuerpo{
        font-size:10px;
        text-align: left;
        padding:1px;
    }
    #titulo{
        font-size:20px;
        text-align:center;
    }
    .number{
        text-align: center;
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
        margin-left: 217px;
    }
    #table-intermedio{
        position: absolute;
        margin-left: 308px;
    }
    #table-abierta{
        position: absolute;
        margin-left: 377px;
    }
    #table-campeones{
        position: absolute;
        margin-left: 457px;
    }
    #table-grandesCampeones{
        position: absolute;
        margin-left: 524px;
    }
    #table-veteranos{
        position: absolute;
        margin-left: 642px;
    }



    /* hembra */
    /* #planillaHembra{
        position: absolute;
    } */
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
        margin-left: 217px;
        margin-top: 350px;
    }
    #table-intermedioHembra{
        position: absolute;
        margin-left: 308px;
        margin-top: 350px;
    }
    #table-abiertaHembra{
        position: absolute;
        margin-left: 377px;
        margin-top: 350px;
    }
    #table-campeonesHembra{
        position: absolute;
        margin-left: 457px;
        margin-top: 350px;
    }
    #table-grandesCampeonesHembra{
        position: absolute;
        margin-left: 524px;
        margin-top: 350px;
    }
    #table-veteranosHembra{
        position: absolute;
        margin-left: 642px;
        margin-top: 350px;
    }
</style>
<body>
    {{-- Hola: {{ $anio }} --}}
    {{-- <h1 class="text-center" id="titulo">REGISTRO DE EJEMPLARES <br> POR RAZA</h1> --}}
    <h1 id="titulo">PLANILLA DE RAZA </h1>
    <br>
    <div class="row">
        <div class="col-md-3">Juez:</div>
        <div class="col-md-3">Lugar</div>
        <div class="col-md-3">Raza</div>
        <div class="col-md-3">Grupo</div>
    </div>

    <div class="planillaMacho">
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
                        $cantidad = count($cachorros);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            @if ($cachorros[$i]->sexo == "Macho")
                                <th style="padding:5px;">{{ $cachorros[$i]->inscripcion->numero_prefijo }}</th>
                                <th>{{ $cachorros[$i]->calificacion }}</th>
                                <th>{{ $cachorros[$i]->lugar }}</th>
                            @else
                                <th><p style="padding-top: 1px;"></p></th>
                                <th></th>
                                <th></th>
                            @endif
                        @else
                            <th><p style="padding-top: 1px;"></p></th>
                            <th></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    {{-- <td></td>
                    <td>TOTALES</td> --}}
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
                        $cantidad = count($joven);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            @if ($joven[$i]->sexo == "Macho")
                                <th style="padding:5px;">{{ $joven[$i]->inscripcion->numero_prefijo }}</th>
                                <th>{{ $joven[$i]->calificacion }}</th>
                                <th>{{ $joven[$i]->lugar }}</th>
                            @else
                                <th><p style="padding-top: 1px;"></p></th>
                                <th></th>
                                <th></th>
                            @endif
                        @else
                            <th><p style="padding-top: 1px;"></p></th>
                            <th></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    {{-- <td></td>
                    <td>TOTALES</td> --}}
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
                        $cantidad = count($jovenCampeon);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            @if ($jovenCampeon[$i]->sexo == "Macho")
                                <th style="padding:5px;">{{ $jovenCampeon[$i]->inscripcion->numero_prefijo }}</th>
                                <th>{{ $jovenCampeon[$i]->calificacion }}</th>
                                <th>{{ $jovenCampeon[$i]->lugar }}</th>
                            @else
                                <th><p style="padding-top: 1px;"></p></th>
                                <th></th>
                                <th></th>
                            @endif
                        @else
                            <th><p style="padding-top: 1px;"></p></th>
                            <th></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    {{-- <td></td>
                    <td>TOTALES</td> --}}
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
                        $cantidad = count($intermedia);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            @if ($intermedia[$i]->sexo == "Macho")
                                <th style="padding:5px;">{{ $intermedia[$i]->inscripcion->numero_prefijo }}</th>
                                <th>{{ $intermedia[$i]->calificacion }}</th>
                                <th>{{ $intermedia[$i]->lugar }}</th>
                            @else
                                <th><p style="padding-top: 1px;"></p></th>
                                <th></th>
                                <th></th>
                            @endif
                        @else
                            <th><p style="padding-top: 1px;"></p></th>
                            <th></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    {{-- <td></td>
                    <td>TOTALES</td> --}}
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
                        $cantidad = count($abierta);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            @if ($abierta[$i]->sexo == "Macho")
                                <th style="padding:5px;">{{ $abierta[$i]->inscripcion->numero_prefijo }}</th>
                                <th>{{ $abierta[$i]->calificacion }}</th>
                                <th>{{ $abierta[$i]->lugar }}</th>
                            @else
                                <th><p style="padding-top: 1px;"></p></th>
                                <th></th>
                                <th></th>
                            @endif
                        @else
                            <th><p style="padding-top: 1px;"></p></th>
                            <th></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    {{-- <td></td>
                    <td>TOTALES</td> --}}
                </tfoot>
            </table>
        </div>
    
        <div id="table-campeones">
            <table>
                <thead id="tabla-datos">
                    <tr>
                        <th colspan="3">CAMPEONES</th>
                    </tr>
                </thead>
                <tbody id="tabla-datos-cuerpo">
                    <tr>
                        <th>Nº</th>
                        <th>Calf.</th>
                        <th>Lugar</th>
                    </tr>
                    @php
                        $cantidad = count($campeones);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            @if ($campeones[$i]->sexo == "Macho")
                                <th style="padding:5px;">{{ $campeones[$i]->inscripcion->numero_prefijo }}</th>
                                <th>{{ $campeones[$i]->calificacion }}</th>
                                <th>{{ $campeones[$i]->lugar }}</th>
                            @else
                                <th><p style="padding-top: 1px;"></p></th>
                                <th></th>
                                <th></th>
                            @endif
                        @else
                            <th><p style="padding-top: 1px;"></p></th>
                            <th></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    {{-- <td></td>
                    <td>TOTALES</td> --}}
                </tfoot>
            </table>
        </div>
    
        <div id="table-grandesCampeones">
            <table>
                <thead id="tabla-datos">
                    <tr>
                        <th colspan="3">GRANDES CAMPEONES</th>
                    </tr>
                </thead>
                <tbody id="tabla-datos-cuerpo">
                    <tr>
                        <th>Nº</th>
                        <th>Calf.</th>
                        <th>Lugar</th>
                    </tr>
                    @php
                        $cantidad = count($GrandesCampeones);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            @if ($GrandesCampeones[$i]->sexo == "Macho")
                                <th style="padding:5px;">{{ $GrandesCampeones[$i]->inscripcion->numero_prefijo }}</th>
                                <th>{{ $GrandesCampeones[$i]->calificacion }}</th>
                                <th>{{ $GrandesCampeones[$i]->lugar }}</th>
                            @else
                                <th><p style="padding-top: 1px;"></p></th>
                                <th></th>
                                <th></th>
                            @endif
                        @else
                            <th><p style="padding-top: 1px;"></p></th>
                            <th></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    {{-- <td></td>
                    <td>TOTALES</td> --}}
                </tfoot>
            </table>
        </div>
    
        <div id="table-veteranos">
            <table>
                <thead id="tabla-datos">
                    <tr>
                        <th colspan="3">VETERANOS</th>
                    </tr>
                </thead>
                <tbody id="tabla-datos-cuerpo">
                    <tr>
                        <th>Nº</th>
                        <th>Calf.</th>
                        <th>Lugar</th>
                    </tr>
                    @php
                        $cantidad = count($veteranos);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            @if ($veteranos[$i]->sexo == "Macho")
                                <th style="padding:5px;">{{ $veteranos[$i]->inscripcion->numero_prefijo }}</th>
                                <th>{{ $veteranos[$i]->calificacion }}</th>
                                <th>{{ $veteranos[$i]->lugar }}</th>                                
                            @else
                                <th><p style="padding-top: 1px;"></p></th>
                                <th></th>
                                <th></th>
                            @endif
                        @else
                            <th><p style="padding-top: 1px;"></p></th>
                            <th></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    {{-- <td></td>
                    <td>TOTALES</td> --}}
                </tfoot>
            </table>
        </div>
    </div>

    <div class="planillaHembra">
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
                        $cantidad = count($cachorros);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            @if ($cachorros[$i]->sexo == "Hembra")
                                <th style="padding:5px;">{{ $cachorros[$i]->inscripcion->numero_prefijo }}</th>
                                <th>{{ $cachorros[$i]->calificacion }}</th>
                                <th>{{ $cachorros[$i]->lugar }}</th>
                            @else
                                <th><p style="padding-top: 1px;"></p></th>
                                <th></th>
                                <th></th>
                            @endif
                        @else
                            <th><p style="padding-top: 1px;"></p></th>
                            <th></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    {{-- <td></td>
                    <td>TOTALES</td> --}}
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
                        $cantidad = count($joven);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            @if ($joven[$i]->sexo == "Hembra")
                                <th style="padding:5px;">{{ $joven[$i]->inscripcion->numero_prefijo }}</th>
                                <th>{{ $joven[$i]->calificacion }}</th>
                                <th>{{ $joven[$i]->lugar }}</th>
                            @else
                                <th><p style="padding-top: 1px;"></p></th>
                                <th></th>
                                <th></th>
                            @endif
                        @else
                            <th><p style="padding-top: 1px;"></p></th>
                            <th></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    {{-- <td></td>
                    <td>TOTALES</td> --}}
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
                        $cantidad = count($jovenCampeon);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            @if ($jovenCampeon[$i]->sexo == "Hembra")
                                <th style="padding:5px;">{{ $jovenCampeon[$i]->inscripcion->numero_prefijo }}</th>
                                <th>{{ $jovenCampeon[$i]->calificacion }}</th>
                                <th>{{ $jovenCampeon[$i]->lugar }}</th>
                            @else
                                <th><p style="padding-top: 1px;"></p></th>
                                <th></th>
                                <th></th>
                            @endif
                        @else
                            <th><p style="padding-top: 1px;"></p></th>
                            <th></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    {{-- <td></td>
                    <td>TOTALES</td> --}}
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
                        $cantidad = count($intermedia);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            @if ($intermedia[$i]->sexo == "Hembra")
                                <th style="padding:5px;">{{ $intermedia[$i]->inscripcion->numero_prefijo }}</th>
                                <th>{{ $intermedia[$i]->calificacion }}</th>
                                <th>{{ $intermedia[$i]->lugar }}</th>
                            @else
                                <th><p style="padding-top: 1px;"></p></th>
                                <th></th>
                                <th></th>
                            @endif
                        @else
                            <th><p style="padding-top: 1px;"></p></th>
                            <th></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    {{-- <td></td>
                    <td>TOTALES</td> --}}
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
                        $cantidad = count($abierta);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            @if ($abierta[$i]->sexo == "Hembra")
                                <th style="padding:5px;">{{ $abierta[$i]->inscripcion->numero_prefijo }}</th>
                                <th>{{ $abierta[$i]->calificacion }}</th>
                                <th>{{ $abierta[$i]->lugar }}</th>
                            @else
                                <th><p style="padding-top: 1px;"></p></th>
                                <th></th>
                                <th></th>
                            @endif
                        @else
                            <th><p style="padding-top: 1px;"></p></th>
                            <th></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    {{-- <td></td>
                    <td>TOTALES</td> --}}
                </tfoot>
            </table>
        </div>
    
        <div id="table-campeonesHembra">
            <table>
                <thead id="tabla-datos">
                    <tr>
                        <th colspan="3">CAMPEONES</th>
                    </tr>
                </thead>
                <tbody id="tabla-datos-cuerpo">
                    <tr>
                        <th>Nº</th>
                        <th>Calf.</th>
                        <th>Lugar</th>
                    </tr>
                    @php
                        $cantidad = count($campeones);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            @if ($campeones[$i]->sexo == "Hembra")
                                <th style="padding:5px;">{{ $campeones[$i]->inscripcion->numero_prefijo }}</th>
                                <th>{{ $campeones[$i]->calificacion }}</th>
                                <th>{{ $campeones[$i]->lugar }}</th>
                            @else
                                <th><p style="padding-top: 1px;"></p></th>
                                <th></th>
                                <th></th>
                            @endif
                        @else
                            <th><p style="padding-top: 1px;"></p></th>
                            <th></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    {{-- <td></td>
                    <td>TOTALES</td> --}}
                </tfoot>
            </table>
        </div>
    
        <div id="table-grandesCampeonesHembra">
            <table>
                <thead id="tabla-datos">
                    <tr>
                        <th colspan="3">GRANDES CAMPEONES</th>
                    </tr>
                </thead>
                <tbody id="tabla-datos-cuerpo">
                    <tr>
                        <th>Nº</th>
                        <th>Calf.</th>
                        <th>Lugar</th>
                    </tr>
                    @php
                        $cantidad = count($GrandesCampeones);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            @if ($GrandesCampeones[$i]->sexo == "Hembra")
                                <th style="padding:5px;">{{ $GrandesCampeones[$i]->inscripcion->numero_prefijo }}</th>
                                <th>{{ $GrandesCampeones[$i]->calificacion }}</th>
                                <th>{{ $GrandesCampeones[$i]->lugar }}</th>
                            @else
                                <th><p style="padding-top: 1px;"></p></th>
                                <th></th>
                                <th></th>
                            @endif
                        @else
                            <th><p style="padding-top: 1px;"></p></th>
                            <th></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    {{-- <td></td>
                    <td>TOTALES</td> --}}
                </tfoot>
            </table>
        </div>
    
        <div id="table-veteranosHembra">
            <table>
                <thead id="tabla-datos">
                    <tr>
                        <th colspan="3">VETERANOS</th>
                    </tr>
                </thead>
                <tbody id="tabla-datos-cuerpo">
                    <tr>
                        <th>Nº</th>
                        <th>Calf.</th>
                        <th>Lugar</th>
                    </tr>
                    @php
                        $cantidad = count($veteranos);
                    @endphp
                    @for ($i=0 ; $i < 9 ; $i++)
                    <tr>
                        @if ($i < $cantidad)
                            @if ($veteranos[$i]->sexo == "Hembra")
                                <th style="padding:5px;">{{ $veteranos[$i]->inscripcion->numero_prefijo }}</th>
                                <th>{{ $veteranos[$i]->calificacion }}</th>
                                <th>{{ $veteranos[$i]->lugar }}</th>
                            @else
                                <th><p style="padding-top: 1px;"></p></th>
                                <th></th>
                                <th></th>
                            @endif
                        @else
                            <th><p style="padding-top: 1px;"></p></th>
                            <th></th>
                            <th></th>
                        @endif
                    </tr>
                    @endfor
                </tbody>
                <tfoot>
                    {{-- <td></td>
                    <td>TOTALES</td> --}}
                </tfoot>
            </table>
        </div>
    </div>
    
</body>
</html>