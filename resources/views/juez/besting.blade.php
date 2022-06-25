@php
    $grupo1  = array();
    $grupo2  = array();
    $grupo3  = array();
    $grupo4  = array();
    $grupo5  = array();
    $grupo6  = array();
    $grupo7  = array();
    $grupo8  = array();
    $grupo9  = array();
    $grupo10 = array();

    // vamos separando en arrary difrerentes
    foreach ( $ganadores as $g ){

        switch ($g->grupo_id) {
            case 1:
                array_push($grupo1, $g);
                break;
            case 2:
                array_push($grupo2, $g);
                break;
            case 3:
                array_push($grupo3, $g);
                break;
            case 4:
                array_push($grupo4, $g);
                break;
            case 5:
                array_push($grupo5, $g);
                break;
            case 6:
                array_push($grupo6, $g);
                break;
            case 7:
                array_push($grupo7, $g);
                break;
            case 8:
                array_push($grupo8, $g);
                break;
            case 9:
                array_push($grupo9, $g);
                break;
            case 10:
                array_push($grupo10, $g);
                break;
        }
        
    }

    // creamos el array para que recorramos mas facil

    $mayor = 0;
    $array_grupo  = array();
    if(!empty($grupo1)){

        if(count($grupo1) > $mayor){
            $mayor  = count($grupo1);
        }

        array_push($array_grupo, $grupo1);
    }
    if(!empty($grupo2)){
        array_push($array_grupo, $grupo2);

        if(count($grupo2) > $mayor){
            $mayor  = count($grupo2);
        }
    }
    if(!empty($grupo3)){
        array_push($array_grupo, $grupo3);

        if(count($grupo3) > $mayor){
            $mayor  = count($grupo3);
        }
    }
    if(!empty($grupo4)){
        array_push($array_grupo, $grupo4);

        if(count($grupo4) > $mayor){
            $mayor  = count($grupo4);
        }
    }
    if(!empty($grupo5)){
        array_push($array_grupo, $grupo5);

        if(count($grupo5) > $mayor){
            $mayor  = count($grupo5);
        }
    }
    if(!empty($grupo6)){
        array_push($array_grupo, $grupo6);

        if(count($grupo6) > $mayor){
            $mayor  = count($grupo6);
        }
    }
    if(!empty($grupo7)){
        array_push($array_grupo, $grupo7);

        if(count($grupo7) > $mayor){
            $mayor  = count($grupo7);
        }
    }
    if(!empty($grupo8)){
        array_push($array_grupo, $grupo8);

        if(count($grupo8) > $mayor){
            $mayor  = count($grupo8);
        }
    }
    if(!empty($grupo9)){
        array_push($array_grupo, $grupo9);

        if(count($grupo9) > $mayor){
            $mayor  = count($grupo9);
        }
    }
    if(!empty($grupo10)){
        array_push($array_grupo, $grupo10);

        if(count($grupo10) > $mayor){
            $mayor  = count($grupo10);
        }
    }

@endphp
<input type="hidden" value="{{ $tipo }}" name="tipo_besting" id="tipo_besting">
<table class="table table-bordered table-hover table-striped" style="width:100%;">
    <thead>
        <tr>
            @foreach ( $array_grupo as $ag)
                <th>GRUPO {{ $ag[0]['grupo_id'] }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @for($i = 0; $i < $mayor; $i++)
            <tr>
                @foreach ( $array_grupo as $ag)

                    @if (count($ag) > $i)
                        <td>
                            <div class="row">
                                <input type="hidden" value="{{ $ag[$i]->raza_id }}" name="raza_ids_{{ $ag[$i]->grupo_id }}_[]">
                                <input type="hidden" value="{{ $ag[$i]->numero_prefijo }}" name="numeros_{{ $ag[$i]->grupo_id }}_[]">
                                <input type="hidden" value="{{ $ag[$i]->categoria_id }}" name="categoria_pista_ids_{{ $ag[$i]->grupo_id }}_[]">
                                <input type="hidden" value="{{ $ag[$i]->ejemplar_evento_id }}" name="ejemplar_eventos_ids_{{ $ag[$i]->grupo_id }}_[]">
                                <input type="hidden" value="{{ $ag[$i]->ejemplar_id }}" name="ejemplares_ids_{{ $ag[$i]->grupo_id }}_[]">
                                <input type="hidden" value="{{ $ag[$i]->id }}" name="ganador_ids_{{ $ag[$i]->grupo_id }}_[]">
                                <div class="col-md-12 text-primary text-center">
                                    <h5>
                                        {{ $ag[$i]->numero_prefijo }}
                                    </h5>
                                </div>
                            </div>
                                <div class="row">
                                    @php
                                    
                                        $besting = App\Juez::recuperaGanadorBesting($ag[$i]->ejemplar_evento_id, $tipo, $ag[$i]->grupo_id, $evento_id);

                                    @endphp
                                    <div class="col-md-12">
                                        <select name="grupo_{{ $ag[$i]->grupo_id }}_[]" id="" class="form-control" {{ ($besting)? 'disabled' : '' }}>
                                            <option value="1" {{ (($besting)? (($besting->lugar == '1')? 'selected' : '') : '') }}>Primero</option>
                                            <option value="2" {{ (($besting)? (($besting->lugar == '2')? 'selected' : '') : '') }}>Segundo</option>
                                            <option value="3" {{ (($besting)? (($besting->lugar == '3')? 'selected' : '') : '') }}>Tercero</option>
                                            <option value="4" {{ (($besting)? (($besting->lugar == '4')? 'selected' : '') : '') }}>Cuarto</option>
                                            <option value="5" {{ (($besting)? (($besting->lugar == '5')? 'selected' : '') : '') }}>Quinto</option>
                                            <option value="6" {{ (($besting)? (($besting->lugar == '6')? 'selected' : '') : '') }}>Sexto</option>
                                        </select>
                                    </div>
                                </div>
                        </td>
                    @else
                        <td></td>                        
                    @endif
                @endforeach
            </tr>
        @endfor
    </tbody>
    <tfoot>
        <tr>
            @foreach ( $array_grupo as $ag)
                <th>
                    @if (!App\Juez::recuperaGanadorBesting($ag[0]->ejemplar_evento_id, $tipo, $ag[0]->grupo_id, $evento_id))
                        <button onclick="mejorGrupo('{{ $ag[0]->grupo_id }}')" type="button" class="btn btn-success btn-block"> Finalizar </button>
                    @endif
                </th>
            @endforeach
        </tr>
        <tr>
            @foreach ( $array_grupo as $ag)
                <th>
                    @php

                        // VERIFICAMOS SI YA HAY GANAODRES O NO
                        $bestingMejorGrupoRescatado = App\Juez::getMejorGrupoMejorRecerbaTipo($ag[0]->grupo_id, $tipo, 'mejor_grupo', $evento_id);
                        $bestingMejorRecerva = App\Juez::getMejorGrupoMejorRecerbaTipo($ag[0]->grupo_id, $tipo, 'mejor_recerva', $evento_id);

                        // VERIFICAMOS SI EN EL GRUPO YA HAY FINALISTAS PARA QUE YA NO CMABIEN
                        $finalistas = App\Juez::getFinalistas($evento_id, $ag[0]->grupo_id, $tipo);

                    @endphp
                    @if($bestingMejorGrupoRescatado || $bestingMejorRecerva)
                        @if($bestingMejorGrupoRescatado != null)
                            <div>
                                <div class="form-group">
                                    <label>ELIJA AL QUE INGRESARA</label>
                                    <div class="radio-inline">
                                        <label class="radio">
                                            @if(count($finalistas) == 0)
                                                <input type="radio" name="radios_{{ $ag[0]->grupo_id }}" onchange="cambiaMejor('{{ $bestingMejorGrupoRescatado->id }}', '{{ ($bestingMejorRecerva)? $bestingMejorRecerva->id : 0 }}', '{{ $bestingMejorGrupoRescatado->numero_prefijo }}')"/>
                                                <span></span>
                                            @endif
                                            Mejor de grupo => <small style="font-size: 15px" class="text-info">{{ $bestingMejorGrupoRescatado->numero_prefijo }}</small>
                                            </label>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <hr>
                        @if($bestingMejorRecerva != null)
                            <div>
                                <div class="form-group">
                                    <div class="radio-inline">
                                        <label class="radio">

                                            @if (count($finalistas) == 0)
                                                <input type="radio" name="radios_{{ $ag[0]->grupo_id }}"  onchange="cambiaMejor( '{{ $bestingMejorRecerva->id }}' , '{{ ($bestingMejorGrupoRescatado)? $bestingMejorGrupoRescatado->id : 0 }}', '{{ $bestingMejorRecerva->numero_prefijo }}')"/>
                                                <span></span>
                                            @endif

                                            Reserva de grupo => <small style="font-size: 15px" class="text-info">{{ $bestingMejorRecerva->numero_prefijo }}</small>
                                            </label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else

                        <div id="mejor_grupo_{{ $ag[0]->grupo_id }}" style="display: none">
                            <div id="mejor_grupo_{{ $ag[0]->grupo_id }}_numero">

                            </div>
                        </div>
                        <hr>
                        <div id="reserva_grupo_{{ $ag[0]->grupo_id }}" style="display: none">
                            <div id="reserva_grupo_{{ $ag[0]->grupo_id }}_numero">

                            </div>
                        </div>

                    @endif
                </th>
            @endforeach
        </tr>
    </tfoot>
</table>