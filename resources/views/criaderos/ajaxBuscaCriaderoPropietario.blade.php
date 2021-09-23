<table class="table table-striped">
    <thead>
        <tr>
            <th>NOMBRE</th>
            <th>DEPARTAMENTO</th>
            <th>REGISTRO FCI</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($criaderos as $cri)
            <tr>
                <td>{{ $cri->nombre }}</td>
                <td>{{ $cri->departamento }}</td>
                <td>{{ $cri->registro_fci }}</td>
                <td>
                    <a href="#" class="btn btn-icon btn-success" onclick="selecciona(`{{ $cri->id }}`, `{{ trim($cri->nombre) }}`, `{{ trim($cri->descripcion) }}`);">
                        <i class="fas fa-check"></i>
                    </a>
                </td>
            </tr>
        @empty
            <h6 class="text-danger">NO EXISTEN CRIADEROS CON ESE NOMBRE</h6>
        @endforelse
    </tbody>
</table>
<script type="text/javascript">
    function selecciona(id, nombre, descripcion)
    {
        $("#criadero").val(nombre);
        $("#criadero_id").val(id);
        $("#busca-criadero-nombre").val('');
        $("#bloqueCriadero").html('');
        $("#msg-error-criadero").hide();
    }
</script>