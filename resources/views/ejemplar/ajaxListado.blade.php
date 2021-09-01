<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
<table class="table table-bordered table-hover table-striped" id="tabla_criaderos">
    <thead>
        <tr>
            <th>ID</th>
            <th>KCB</th>
            <th>NOMBRE</th>
            <th>CHIP</th>
            <th>RAZA</th>
            <th>PROPIETARIO</th>
            {{-- <th>Criaderos</th> --}}
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($ejemplares as $e)
        <tr>
            <td>{{ $e->id }}</td>
            <td>{{ $e->kcb }}</td>
            <td>{{ $e->nombre_completo }}</td>
            <td>{{ $e->chip }}</td>
            <td>{{ $e->raza['nombre'] }}</td>
            <td>{{ $e->propietario['name'] }}</td>
            <td style="width: 10%">
                <button type="button" class="btn btn-sm btn-icon btn-warning" onclick="edita('{{ $e->id }}')">
                    <i class="flaticon2-edit"></i>
                </button>

                <button type="button" class="btn btn-sm btn-icon btn-info" onclick="informacion('{{ $e->id }}')">
                    <i class="far fa-file-alt"></i>
                </button>

                <button type="button" class="btn btn-sm btn-icon btn-danger" onclick="elimina('{{ $e->id }}', '{{ $e->nombre }}')">
                    <i class="flaticon2-cross"></i>
                </button>
            </td>
        </tr>
        @empty
        <h3 class="text-danger">NO EXISTEN DATOS</h3>
        @endforelse
    </tbody>
    <tbody>
    </tbody>
</table>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
    $('#tabla_criaderos').DataTable({
        order: [[ 0, "desc" ]],
        searching: false,
        lengthChange: false,
        language: {
            url: '{{ asset('datatableEs.json') }}'
        },
    });
</script>