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
                <td>                   
                    @if ($e->raza_id != null)
                    {{ $e->raza->nombre }}
                    @endif
                </td>
                <td>
                    <a href="#" class="btn btn-icon btn-success" onclick="selecciona(`{{ $e->id }}`, '{{ $e->kcb }}', `{{ trim($e->nombre_completo) }}` ,`{{ $e->sexo }}`);">
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
    function selecciona(id, kcb, nombre_completo, sexo)
    {
        if(sexo == 'Macho'){
            var boton = '<button type="button" class="btn btn-sm btn-primary btn-block" onclick="edicionAjaxBuscaEjemplar('+"'Macho'"+')">'+'KCB: '+kcb+' NOMBRE: '+nombre_completo+'</button>';
            $("#bloque-edita-padre").html(boton);
            $("#edita-modal-padres").modal('hide');
            $("#edicion_padre_id").val(id);
        }else{
            var boton = '<button type="button" class="btn btn-sm btn-info btn-block" onclick="edicionAjaxBuscaEjemplar('+"'Hembra'"+')">'+'KCB: '+kcb+' NOMBRE: '+nombre_completo+'</button>';
            $("#bloque-edita-madre").html(boton);
            $("#edita-modal-padres").modal('hide');
            $("#edicion_madre_id").val(id);
        }
        $('#modal-edicion-de-padres').modal('show');
    }
</script>