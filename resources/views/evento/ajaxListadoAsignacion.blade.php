<hr>
<h2 class="text-success text-center">Asignacion</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>JUEZ</th>
            <th>SECRETARIO</th>
            {{--  <th></th>  --}}
        </tr>
    </thead>
    <tbody>
        @forelse ($asiganaciones as $asig)
        <tr>
            <td>{{ $asig->juez->nombre }}</td>
            <td>{{ $asig->secretario->name}}</td>
            <td>
                <button type="button" class="btn btn-sm btn-icon btn-danger" onclick="eliminaAsigancion('{{ $asig->id }}', '{{$asig->juez->nombre  }}')">
                    <i class="flaticon2-cross"></i>
                </button>
            </td>
        </tr>
        @empty
        <h3 class="text-danger">No tiene Jueces Asginados</h3>
        @endforelse
    </tbody>
</table>    