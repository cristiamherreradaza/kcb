<table class="table table-striped">
    <thead>
        <tr>
            <th>CEDULA</th>
            <th>NOMBRE</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($propietarios as $pro)
            <tr>
                <td>{{ $pro->ci }}</td>
                <td>{{ $pro->name }}</td>
                <td>
                    <a href="#" class="btn btn-icon btn-success" onclick="selecciona(`{{ $pro->id }}`, `{{ trim($pro->name) }}` ,`{{ $pro->ci }}`);">
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
    function selecciona(id, nombre_completo, cedula){

        var boton = '<button class="btn btn-primary btn-block" type="button" onclick="BuscaPropietario()">Cedula: '+cedula+' Nombre:  '+nombre_completo+'</button>'
        $('#transferencia_propietario').html(boton);
        $('#modal-propietario').modal('hide');
        $('#transferencia_propietario_id').val(id);
        $('#modal-tramsferencia').modal('show');
    }
</script>