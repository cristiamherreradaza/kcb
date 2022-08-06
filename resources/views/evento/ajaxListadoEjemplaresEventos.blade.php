<hr>
<h4 class="text-center text-warning" id="cantidad_de_asignacion">
    {{-- @php
        if($faltantes == 0){
            echo 'YA ASIGNO LA CANTIDAD TOPE JUEZ POR PISTA';
        }else{
            echo "AUN FALTAN ".$faltantes." ASIGNACIONES";
        }
    @endphp --}}
</h4>
<hr>
<h2 class="text-success text-center">Ejemplares</h2>
<hr>
<table class="table table-striped" id="table_ejemplres_numeros">
    <thead>
        <tr>
            <th>Numero</th>
            <th>Calificacion</th>
            <th>Mejor Categoria</th>
            <th>Mejor Vencedor</th>
            <th>Mejor Raza</th> 
            <th>Calf. Grupo</th> 
            <th>Podio</th> 
            <th></th> 
        </tr>
    </thead>
    <tbody>
        @forelse ($ejemplaresEventos as $e)
            <tr>
                <td width="2px"><h3 class="text-primary text-center">{{ $e->numero_prefijo }}</h3></td>
                <td width="2px">
                    @php
                        $calificacion = App\Calificacion::where('ejemplares_eventos_id', $e->id)
                                                        ->where('pista', $num_pista)
                                                        ->first();
                        if($calificacion)
                            echo "<span class='text-info text-center'>".$calificacion->calificacion." : ".$calificacion->lugar."</span>";

                    @endphp
                </td>
                <td width="2px">
                    @php
                        $mojorGanador = App\Ganador::where('ejemplar_evento_id', $e->id)
                                                    ->where('pista', $num_pista)
                                                    ->where('mejor_escogido', "Si")
                                                    ->first();
                    @endphp
                    @if ($mojorGanador)
                        @if ($mojorGanador->categoria_id == 3 || $mojorGanador->categoria_id == 4 || $mojorGanador->categoria_id == 12 || $mojorGanador->categoria_id == 13)
                            <span class='text-info text-center'>Mejor Joven</span>
                        @elseif($mojorGanador->categoria_id == 5 || $mojorGanador->categoria_id == 6 || $mojorGanador->categoria_id == 7 || $mojorGanador->categoria_id == 8 || $mojorGanador->categoria_id == 9 || $mojorGanador->categoria_id == 10 || $mojorGanador->categoria_id == 14 || $mojorGanador->categoria_id == 15)
                            <span class='text-info text-center'>Mejor Adulto</span>
                        @elseif($mojorGanador->categoria_id == 2 || $mojorGanador->categoria_id == 11)
                            <span class='text-info text-center'>Mejor Cachorro</span>
                        @elseif($mojorGanador->categoria_id == 16 || $mojorGanador->categoria_id == 17)
                            <span class='text-info text-center'>Mejor Veterano</span>
                        @endif
                    @endif
                </td>
                <td width="2px">
                    @if ($mojorGanador)
                        @if ($mojorGanador->mejor_macho == "Si")
                            <span class='text-info text-center'>Mejor Macho</span>
                        @else
                            <span class='text-info text-center'>Mejor Hembra</span>
                        @endif
                    @endif
                </td>
                <td width="2px">
                    @php
                        if($mojorGanador){
                            $mejor = '';

                            // cachorros
                            if($mojorGanador->mejor_cachorro == "Si"){
                                $mejor = $mejor." | <span class='text-info text-center'>Mejor Cachorro</span> ";
                            }elseif($mojorGanador->sexo_opuesto_cachorro == "Si"){
                                $mejor = $mejor." | <span class='text-info text-center'>Sexo opuesto</span> ";
                            }

                            // joven
                            if($mojorGanador->mejor_joven == "Si"){
                                $mejor = $mejor." | <span class='text-warning text-center'>Mejor Joven</span> ";
                            }elseif($mojorGanador->sexo_opuesto_joven == "Si"){
                                $mejor = $mejor." | <span class='text-warning text-center'>Sexo opuesto</span> ";
                            }

                            // raza
                            if($mojorGanador->mejor_raza == "Si"){
                                $mejor = $mejor." | <span class='text-success text-center'>Mejor Raza</span> ";
                            }elseif($mojorGanador->sexo_opuesto_raza == "Si"){
                                $mejor = $mejor." | <span class='text-success text-center'>Sexo opuesto</span> ";
                            }

                            echo $mejor;
                        }
                    @endphp
                </td>
                <td width="2px">
                    @php
                        $besting = App\Besting::where('ejemplar_evento_id', $e->id)
                                                ->where('pista', $num_pista)
                                                ->first();

                        if($besting)
                            echo "<span class='text-info text-center'>".$besting->lugar."</span>";

                    @endphp
                </td>
                <td>
                    @if($besting)
                        <span class='text-info text-center'>{{ $besting->lugar_finalista }}</span>
                    @endif
                </td>
                <td>
                    <button class="btn btn-warning btn-icon btn-sm" onclick="verDetalleCalificacion('{{ $e->id }}', '{{ $num_pista }}', '{{ $e->evento_id }}')"><i class="fa fa-eye"></i></button>
                </td>
            </tr>
        @empty
            <h3 class="text-danger">No tiene ejemplares</h3>
        @endforelse
    </tbody>
</table>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
    $('#table_ejemplres_numeros').DataTable({
        // order: [[ 0, "desc" ]],
        // searching: false,
        lengthChange: false,
        responsive: true,
        language: {
            url: '{{ asset('datatableEs.json') }}'
        },
    });
</script>
