<hr>
<h4 class="text-center text-warning" id="cantidad_de_asignacion">
    @php
        if($faltantes == 0){
            echo 'YA ASIGNO LA CANTIDAD TOPE JUEZ POR PISTA';
        }else{
            echo "AUN FALTAN ".$faltantes." ASIGNACIONES";
        }
    @endphp
</h4>
<hr>
<h2 class="text-success text-center">Asignacion</h2>
<hr>
<table class="table table-striped">
    <thead>
        <tr>
            <th>JUEZ</th>
            <th>SECRETARIO</th>
            <th>PISTA</th>
             <th></th> 
        </tr>
    </thead>
    <tbody>
        @forelse ($asiganaciones as $asig)
        <tr>
            <td>{{ $asig->juez->nombre }}</td>
            <td>{{ $asig->secretario->name}}</td>
            <td>{{ $asig->num_pista}}</td>
            <td>
                <button type="button" class="btn btn-icon btn-danger" onclick="eliminaAsigancion('{{ $asig->id }}', '{{$asig->juez->nombre  }}')">
                    <i class="flaticon2-cross"></i>
                </button>
            </td>
        </tr>
        @empty
        <h3 class="text-danger">No tiene Jueces Asginados</h3>
        @endforelse
    </tbody>
</table>
