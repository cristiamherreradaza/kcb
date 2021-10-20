<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style>
    #tabla-datos{
        font-size:10px;
        text-align: center;
    }
    #tabla-datos-cuerpo{
        font-size:10px;
        text-align: left;
    }
    #titulo{
        font-size:20px;
    }
    .number{
        text-align: center;
    }
</style>
<body>
    {{-- Hola: {{ $anio }} --}}
    <h1 class="text-center" id="titulo">REGISTRO DE EJEMPLARES <br> POR RAZA</h1>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
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
                    {{-- <tr>
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
                    </tr> --}}
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

            </table>
            
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
        </div>
    </div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>