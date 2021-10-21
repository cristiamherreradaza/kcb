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
    .fila{
        /* width: 5000px; */
        /* height: 50000px; */
        /* background-color:red; */
        /* padding: 1em 3px 30px 5px; */
    }
</style>
<body>
    {{-- Hola: {{ $anio }} --}}
    {{-- <h1 class="text-center" id="titulo">REGISTRO DE EJEMPLARES <br> POR RAZA</h1> --}}
    <h1 id="titulo">REGISTRO DE EJEMPLARES <br> POR RAZA</h1>
    <hr>
    {{-- <div class="row">
        <div class="col-md-12"> --}}
            <table>
                <thead id="tabla-datos">
                    <tr>
                        <th>N°</th>
                        <th>RAZA</th>
                        <th>REGISTRO INICIAL<br>{{ $anio-1 }}</th>
                        <th>NACIDOS<br>{{ $anio-1 }}</th>
                        <th>NACIONALIZADOS<br>{{ $anio-1 }}</th>
                        <th>REGISTRO INICIAL<br>{{ $anio }}</th>
                        <th>NACIDOS<br>{{ $anio }}</th>
                        <th>NACIONALIZADOS<br>{{ $anio }}</th>
                    </tr>
                </thead>
                <tbody id="tabla-datos-cuerpo">
                    @php
                        $continicial = 0;
                        $contnacido = 0;
                        $contnacionalizado = 0;
                        $continicial1 = 0;
                        $contnacido1 = 0;
                        $contnacionalizado1 = 0;
                    @endphp
                    @foreach($ejemplares as $key => $e)
                        <tr class="fila">
                            <th>{{ $key+1 }}</th>
                            <td>
                                @php
                                    $raza = App\Raza::find($e->raza_id);

                                    echo $raza->nombre;
                           
                                @endphp
                            </td>
                            <td class="number">
                                @php
                                    $inicial = App\Ejemplar::where('raza_id', $e->raza_id)
                                                            ->whereBetween('created_at',[($anio-1).'-01-01',($anio-1).'-12-31'])
                                                            ->count();

                                    echo $inicial;

                                    $continicial = $continicial + $inicial;

                                @endphp
                            </td>
                            <td class="number">
                                @php
                                    $nacido = App\Ejemplar::where('raza_id', $e->raza_id)
                                                            ->whereBetween('fecha_nacimiento',[($anio-1).'-01-01',($anio-1).'-12-31'])
                                                            ->count();

                                    echo $nacido;

                                    $contnacido = $contnacido + $nacido;

                                @endphp
                            </td>
                            <td class="number">
                                @php
                                    $nacionalizado = App\Ejemplar::where('raza_id', $e->raza_id)
                                                            ->whereBetween('fecha_nacionalizado',[($anio-1).'-01-01',($anio-1).'-12-31'])
                                                            ->count();

                                    echo $nacionalizado;

                                    $contnacionalizado = $contnacionalizado + $nacionalizado;
                                @endphp
                            </td>
                            <td class="number">
                                @php
                                    $inicial1 = App\Ejemplar::where('raza_id', $e->raza_id)
                                                            ->whereBetween('created_at',[($anio).'-01-01',($anio).'-12-31'])
                                                            ->count();

                                    echo $inicial1;

                                    $continicial1 = $continicial1 + $inicial1;
                                @endphp
                            </td>
                            <td class="number">
                                @php
                                    $nacido1 = App\Ejemplar::where('raza_id', $e->raza_id)
                                                            ->whereBetween('fecha_nacimiento',[($anio).'-01-01',($anio).'-12-31'])
                                                            ->count();

                                    echo $nacido1;

                                    $contnacido1 = $contnacido1 + $nacido1;
                                @endphp
                            </td>
                            <td class="number">
                                @php
                                    $nacionalizado1 = App\Ejemplar::where('raza_id', $e->raza_id)
                                                            ->whereBetween('fecha_nacionalizado',[($anio).'-01-01',($anio).'-12-31'])
                                                            ->count();

                                    echo $nacionalizado1;

                                    $contnacionalizado1 = $contnacionalizado1 + $nacionalizado1;
                                @endphp
                            </td>
                        </tr>    
                    @endforeach
                </tbody>
                <tfoot>
                    <td></td>
                    <td>TOTALES</td>
                    <td>{{ $continicial }}</td>
                    <td>{{ $contnacido }}</td>
                    <td>{{ $contnacionalizado }}</td>
                    <td>{{ $continicial1 }}</td>
                    <td>{{ $contnacido1 }}</td>
                    <td>{{ $contnacionalizado1 }}</td>
                </tfoot>
            </table>


            {{-- <table class="table">
                <thead class="thead-dark"  id="tabla-datos">
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">RAZA</th>
                        <th scope="col">REGISTRO INICIAL<br>{{ $anio-1 }}</th>
                        <th scope="col">NACIDOS<br>{{ $anio-1 }}</th>
                        <th scope="col">NACIONALIZADOS<br>{{ $anio-1 }}</th>
                        <th scope="col">REGISTRO INICIAL<br>{{ $anio }}</th>
                        <th scope="col">NACIDOS<br>{{ $anio }}</th>
                        <th scope="col">NACIONALIZADOS<br>{{ $anio }}</th>
                    </tr>
                </thead>
                <tbody id="tabla-datos-cuerpo">
                    @php
                        $continicial = 0;
                        $contnacido = 0;
                        $contnacionalizado = 0;
                        $continicial1 = 0;
                        $contnacido1 = 0;
                        $contnacionalizado1 = 0;
                    @endphp
                    @foreach($ejemplares as $key => $e)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>
                                @php
                                    $raza = App\Raza::find($e->raza_id);

                                    echo $raza->nombre;
                           
                                @endphp
                            </td>
                            <td class="number">
                                @php
                                    $inicial = App\Ejemplar::where('raza_id', $e->raza_id)
                                                            ->whereBetween('created_at',[($anio-1).'-01-01',($anio-1).'-12-31'])
                                                            ->count();

                                    echo $inicial;

                                    $continicial = $continicial + $inicial;

                                @endphp
                            </td>
                            <td class="number">
                                @php
                                    $nacido = App\Ejemplar::where('raza_id', $e->raza_id)
                                                            ->whereBetween('fecha_nacimiento',[($anio-1).'-01-01',($anio-1).'-12-31'])
                                                            ->count();

                                    echo $nacido;

                                    $contnacido = $contnacido + $nacido;

                                @endphp
                            </td>
                            <td class="number">
                                @php
                                    $nacionalizado = App\Ejemplar::where('raza_id', $e->raza_id)
                                                            ->whereBetween('fecha_nacionalizado',[($anio-1).'-01-01',($anio-1).'-12-31'])
                                                            ->count();

                                    echo $nacionalizado;

                                    $contnacionalizado = $contnacionalizado + $nacionalizado;
                                @endphp
                            </td>
                            <td class="number">
                                @php
                                    $inicial1 = App\Ejemplar::where('raza_id', $e->raza_id)
                                                            ->whereBetween('created_at',[($anio).'-01-01',($anio).'-12-31'])
                                                            ->count();

                                    echo $inicial1;

                                    $continicial1 = $continicial1 + $inicial1;
                                @endphp
                            </td>
                            <td class="number">
                                @php
                                    $nacido1 = App\Ejemplar::where('raza_id', $e->raza_id)
                                                            ->whereBetween('fecha_nacimiento',[($anio).'-01-01',($anio).'-12-31'])
                                                            ->count();

                                    echo $nacido1;

                                    $contnacido1 = $contnacido1 + $nacido1;
                                @endphp
                            </td>
                            <td class="number">
                                @php
                                    $nacionalizado1 = App\Ejemplar::where('raza_id', $e->raza_id)
                                                            ->whereBetween('fecha_nacionalizado',[($anio).'-01-01',($anio).'-12-31'])
                                                            ->count();

                                    echo $nacionalizado1;

                                    $contnacionalizado1 = $contnacionalizado1 + $nacionalizado1;
                                @endphp
                            </td>
                        </tr>    
                    @endforeach
                </tbody>
                <tfoot class="thead-dark">
                    <td></td>
                    <td>TOTALES</td>
                    <td>{{ $continicial }}</td>
                    <td>{{ $contnacido }}</td>
                    <td>{{ $contnacionalizado }}</td>
                    <td>{{ $continicial1 }}</td>
                    <td>{{ $contnacido1 }}</td>
                    <td>{{ $contnacionalizado1 }}</td>
                </tfoot>

            </table> --}}
            <br>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    </tr>
                    <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    </tr>
                    <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        {{-- </div>
    </div> --}}
</body>
</html>