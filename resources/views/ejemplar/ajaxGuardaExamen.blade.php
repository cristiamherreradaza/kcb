<table class="table table-striped">
    <thead>
        <tr>
            <th>FECHA</th>
            <th>EXAMEN</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($examenesEjemplar as $ee)
        <tr>
            <td>{{ $ee->fecha_examen }}</td>
            <td>{{ $ee->examen->nombre }}</td>
            <td>
                <button type="button" class="btn btn-sm btn-icon btn-warning" onclick="editaExamen('{{ $ee->id }}', '{{ $ee->examen_id }}', '{{ $ee->fecha_examen }}', '{{ $ee->revisor }}', '{{ $ee->resultado }}', '{{ $ee->observacion }}', '{{ $ee->numero_formulario }}', '{{ $ee->dfc }}')">
                    <i class="flaticon2-edit"></i>
                </button>
                <button type="button" class="btn btn-sm btn-icon btn-danger"
                    onclick="eliminaExamen('{{ $ee->id }}', '{{ $ee->examen->nombre }}')">
                    <i class="flaticon2-cross"></i>
                </button>
            </td>
        </tr>
        @empty
        <h3>No tiene examenes</h3>
        @endforelse
    </tbody>
</table>    
<a href="#" class="btn btn-info btn-block" onclick="nuevoExamen()">Nuevo Examen</a>