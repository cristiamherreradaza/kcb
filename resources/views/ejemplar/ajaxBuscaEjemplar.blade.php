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
                    <a href="#" class="btn btn-icon btn-success" onclick="selecciona(`{{ $e->id }}`, '{{ $e->kcb }}', `{{ trim($e->nombre_completo) }}` ,`{{ $e->sexo }}`, `{{ $camada }}`);">
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
    function selecciona(id, kcb, nombre_completo, sexo, camada)
    {
        if(camada) {
            //console.log(camada);
            let camda_id = $('#add_camada_id').val();
            window.location.href = "{{ url('Ejemplar/guardaEjemplarCamada') }}/"+camda_id+"/"+id;
        }else{
            if(sexo == 'Macho'){
                var boton = '<button type="button" class="btn btn-primary btn-block" onclick="seleccionaPadre()">'+'KCB: '+kcb+' NOMBRE: '+nombre_completo+'</button>';
                $("#btn-padre").html(boton);
                $("#modal-padres").modal('hide');
                $("#padre_id").val(id);
            }else{
                var boton = '<button type="button" class="btn btn-info btn-block" onclick="seleccionaMadre()">'+'KCB: '+kcb+' NOMBRE: '+nombre_completo+'</button>';
                $("#btn-madre").html(boton);
                $("#modal-padres").modal('hide');
                $("#madre_id").val(id);
            }
        }
    }
</script>
