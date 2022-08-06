{{-- @if ($calificacion) --}}
<h5 class="text-primary text-center">CALIFICACIONES</h5>
<form action="">
    <table class="table text-center">
        <thead>
            <tr>
                <th>Numero</th>
                <th>Calificacion</th>
                <th>Lugar</th>
                @if($ganador)
                <th>certificado</th>
                @endif
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <h3 class="text-info">{{ ($calificacion)? $calificacion->numero_prefijo : $ejemplar_evento->numero_prefijo }}</h3>
                </td>
                <td>
                    <h3 class="text-info">{{ ($calificacion)? $calificacion->calificacion : '' }}</h3>
                    {{-- <select name="calificacion_ejemplar[]" id="calificacion_ejemplar" class="form-control">
                        <option value="">Sin Calificacion</option>
                        <option {{ ($calificacion)? (($calificacion->calificacion == 'Excelente')? 'selected' : '') : '' }} value="Excelente">Excelente</option>
                        <option {{ ($calificacion)? (($calificacion->calificacion == 'Muy')? 'selected' : '') : '' }} value="Muy Bueno">Muy Bueno</option>
                        <option {{ ($calificacion)? (($calificacion->calificacion == 'Bueno')? 'selected' : '') : '' }} value="Bueno">Bueno</option>
                        <option {{ ($calificacion)? (($calificacion->calificacion == 'Descalificado')? 'selected' : '') : '' }} value="Descalificado">Descalificado</option>
                        <option {{ ($calificacion)? (($calificacion->calificacion == 'Ausente')? 'selected' : '') : '' }} value="Ausente">Ausente</option>
                        <option {{ ($calificacion)? (($calificacion->calificacion == 'Dispenzado')? 'selected' : '') : '' }} value="Dispenzado">Dispenzado</option>
                    </select> --}}
                </td>
                <td>
                    <h3 class="text-info">{{ ($calificacion)? $calificacion->lugar : '' }}</h3>
                    {{-- <select name="lugar_ejemplar[]" id="lugar_ejemplar" class="form-control">
                        <option value="">Sin lugar</option>
                        <option {{ ($calificacion)? (($calificacion->lugar == 1)? 'selected' : '') : '' }} value="1">Primero</option>
                        <option {{ ($calificacion)? (($calificacion->lugar == 2)? 'selected' : '') : '' }} value="2">Segundo</option>
                        <option {{ ($calificacion)? (($calificacion->lugar == 3)? 'selected' : '') : '' }} value="3">Tercero</option>
                        <option {{ ($calificacion)? (($calificacion->lugar == 4)? 'selected' : '') : '' }} value="4">Cuarto</option>
                        <option {{ ($calificacion)? (($calificacion->lugar == 5)? 'selected' : '') : '' }} value="5">Quinto</option>
                    </select> --}}
                </td>
                @if ($ganador)
                    <td>
                        @php
                            if($ganador->categoria_id == 2 || $ganador->categoria_id == 11)
                                echo "<h3 class='text-info'>CCCB</h3>";
                            elseif($ganador->categoria_id == 3 || $ganador->categoria_id == 4)
                                echo "<h3 class='text-info'>CJCB</h3>";
                            elseif($ganador->categoria_id == 12 || $ganador->categoria_id == 13)
                                echo "<h3 class='text-info'>CJCGB</h3>";
                            elseif($ganador->categoria_id == 5 || $ganador->categoria_id == 6 || $ganador->categoria_id == 7 || $ganador->categoria_id == 8)
                                echo "<h3 class='text-info'>CACB</h3>";
                            elseif($ganador->categoria_id == 9 || $ganador->categoria_id == 10)
                                echo "<h3 class='text-info'>CGCB</h3>";
                            elseif($ganador->categoria_id == 9 || $ganador->categoria_id == 10)
                                echo "<h3 class='text-info'>CACV</h3>";

                        @endphp
                    </td>
                @endif
            </tr>
        </tbody>
    </table>
</form>
@if ($ganador)
    <div class="row text-center">
        <div class="col-md-4">
            @if ($ganador->mejor_escogido == "Si")
                @if ($ganador->categoria_id == 3 || $ganador->categoria_id == 4 || $ganador->categoria_id == 12 || $ganador->categoria_id == 13)
                    <h4 class='text-success text-center'><span class="text-danger">Mejor vencedor: </span> Joven</h4>
                @elseif($ganador->categoria_id == 5 || $ganador->categoria_id == 6 || $ganador->categoria_id == 7 || $ganador->categoria_id == 8 || $ganador->categoria_id == 9 || $ganador->categoria_id == 10 || $ganador->categoria_id == 14 || $ganador->categoria_id == 15)
                    <h4 class='text-success text-center'><span class="text-danger">Mejor vencedor: </span> Adulto</h4>
                @elseif($ganador->categoria_id == 2 || $ganador->categoria_id == 11)
                    <h4 class='text-success text-center'><span class="text-danger">Mejor vencedor: </span> Cachorro</h4>
                @elseif($ganador->categoria_id == 16 || $ganador->categoria_id == 17)
                    <h4 class='text-success text-center'><span class="text-danger">Mejor vencedor: </span> Veterano</h4>
                @endif
            @endif
        </div>
        <div class="col-md-4">
            @if ($ganador->mejor_macho == "Si")
                <h4 class='text-success text-center'><span class="text-danger">Mejor: </span> Macho</h4>
            @else
                <h4 class='text-success text-center'><span class="text-danger">Mejor: </span> Hembra</h4>
            @endif
        </div>
        <div class="col-md-4">
            @php
                $mejor = '';
                $swCachorro = false;
                $swjoven = false;
                $swRaza = false;
                $contador = 0;

                // cachorros
                if($ganador->mejor_cachorro == "Si"){
                    $mejor = $mejor." | <span class='text-info text-center'>Mejor Cachorro</span> ";

                    $swCachorro = true;
                    $contador++;
                }elseif($ganador->sexo_opuesto_cachorro == "Si"){
                    $mejor = $mejor." | <span class='text-info text-center'>Sexo opuesto</span> ";

                    $swCachorro = true;
                    $contador++;
                }

                // joven
                if($ganador->mejor_joven == "Si"){
                    $mejor = $mejor." | <span class='text-warning text-center'>Mejor Joven</span> ";

                    $swjoven = true;
                    $contador++;
                }elseif($ganador->sexo_opuesto_joven == "Si"){
                    $mejor = $mejor." | <span class='text-warning text-center'>Sexo opuesto</span> ";

                    $swjoven = true;
                    $contador++;
                }

                // raza
                if($ganador->mejor_raza == "Si"){
                    $mejor = $mejor." | <span class='text-success text-center'>Mejor Raza</span> ";

                    $swRaza = true;
                    $contador++;
                }elseif($ganador->sexo_opuesto_raza == "Si"){
                    $mejor = $mejor." | <span class='text-success text-center'>Sexo opuesto</span> ";

                    $swRaza = true;
                    $contador++;
                }

                echo $mejor;

                if($contador == 3){
                    $div = "col-md-4";
                }elseif($contador == 2){
                    $div = "col-md-6";
                }elseif($contador == 1){
                    $div = "col-md-12";
                }
                
                

            @endphp       
        </div>
    </div>
    <hr>
    <div class="row">
        @if ($contador == 3)

        @elseif($contador == 2)
            <div class="col-md-6">
                <h4 class="text-primary text-center">Calificacion de joven</h4>
                <select name="joven_1" id="joven_1" class="form-control">
                    <option {{ ($ganador->mejor_joven == "Si")? 'selected' : '' }} value="mejor_joven">Mejor Joven</option>
                    <option {{ ($ganador->sexo_opuesto_joven == "Si")? 'selected' : '' }} value="sexoopuesto_joven">Sexo opuesto</option>
                </select>
                <br>
                <button class="btn btn-success btn-block" onclick="modificaCalificacionFinal('joven', 1, '{{ $ganador->id }}')">Modificar</button>
            </div>
            <div class="col-md-6">
                <h4 class="text-primary text-center">Calificacion de raza</h4>
                <select name="raza_1" id="raza_1" class="form-control">
                    <option {{ ($ganador->mejor_raza == "Si")? 'selected' : '' }} value="mejor_raza">Mejor Raza</option>
                    <option {{ ($ganador->sexo_opuesto_raza == "Si")? 'selected' : '' }} value="sexoopuesto_raza">Sexo opuesto</option>
                </select>
                <br>
                <button class="btn btn-success btn-block" onclick="modificaCalificacionFinal('raza', 1, '{{ $ganador->id }}')">Modificar</button>
            </div>
        @elseif($contador == 1)
            <div class="col-md-12">
                @if ($swCachorro)
                    <h4 class="text-primary text-center">Calificacion de cachorro</h4>
                    <select name="cachorro_2" id="cachorro_2" class="form-control">
                        <option {{ ($ganador->mejor_cachorro == "Si")? 'selected' : '' }} value="mejor_cachorro">Mejor Cachorro</option>
                        <option {{ ($ganador->sexo_opuesto_cachorro == "Si")? 'selected' : '' }} value="sexoopuesto_cachorro">Sexo Opuesto</option>
                    </select>
                    <br>
                    <button class="btn btn-success btn-block" onclick="modificaCalificacionFinal('cachorro', 2, '{{ $ganador->id }}')">Modificar</button>
                @elseif($swjoven)
                    <h4 class="text-primary text-center">Calificacion de joven</h4>
                    <select name="joven_2" id="joven_2" class="form-control">
                        <option {{ ($ganador->mejor_joven == "Si")? 'selected' : '' }} value="mejor_joven">Mejor Joven</option>
                        <option {{ ($ganador->sexo_opuesto_joven == "Si")? 'selected' : '' }} value="sexoopuesto_joven">Sexo opuesto</option>
                    </select>
                    <br>
                    <button class="btn btn-success btn-block" onclick="modificaCalificacionFinal('joven', 2, '{{ $ganador->id }}')">Modificar</button>
                @elseif($swRaza)
                    <h4 class="text-primary text-center">Calificacion de raza</h4>
                    <select name="raza_2" id="raza_2" class="form-control">
                        <option {{ ($ganador->mejor_raza == "Si")? 'selected' : '' }} value="mejor_raza">Mejor Raza</option>
                        <option {{ ($ganador->sexo_opuesto_raza == "Si")? 'selected' : '' }} value="sexoopuesto_raza">Sexo opuesto</option>
                    </select>
                    <br>
                    <button class="btn btn-success btn-block" onclick="modificaCalificacionFinal('raza', 2, '{{ $ganador->id }}')">Modificar</button>
                @endif
            </div>
        @endif
    </div>
@endif
{{-- @else
    <h1 class="text-danger">No tiene calificacions</h1>
@endif --}}