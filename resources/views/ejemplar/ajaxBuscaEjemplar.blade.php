<table class="table table-striped">
    <thead>
        <tr>
            <th>KCB</th>
            <th>NOMBRE</th>
            <th>RAZA</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($ejemplares as $e)
            <tr>
                <td>{{ $e->kcb }}</td>
                <td>{{ $e->nombre_completo }}</td>
                <td>{{ $e->raza->nombre }}</td>
                <td>
                    <a href="#" class="btn btn-icon btn-success" onclick="selecciona('{{ $e->kcb }}', '{{ $e->nombre_completo }}');">
                        <i class="fas fa-check"></i>
                    </a>
                </td>
            </tr>
        @empty
            <h2 class="text-danger">NO EXISTEN REGISTROS</h2>
        @endforelse
    </tbody>
</table>
<script type="text/javascript">


    function selecciona(kcb_id, nombre_completo)
    {
        var boton = '<button type="button" class="btn btn-primary btn-block" onclick="seleccionaPadre()">'+nombre_completo+'</button>';
        $("#btn-padre").html(boton);
        $("#modal-padres").modal('hide');
    }
</script>