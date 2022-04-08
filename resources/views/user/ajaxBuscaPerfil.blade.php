<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">


<table class="table table-bordered table-hover table-striped" id="tabla_permisos">
    <thead>
        <tr>
            <th>ID</th>
            <th>MENU</th>
            <th>ESTADO</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($permisos as $p)
            @if($p->menu)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->menu->nombre }}</td>
                    <td>
                        @if ($p->estado == 'Visible')
                            <button type="button" class="btn  btn-success" onclick="cambiaEstado('{{ $p->id }}','{{ $p->perfil_id }}')">
                                {{ ($p->estado) }}
                            </button>
                        @else
                            <button type="button" class="btn  btn-danger" onclick="cambiaEstado('{{ $p->id }}','{{ $p->perfil_id }}')">
                                {{ ($p->estado) }}
                            </button>
                        @endif
                    </td>
                </tr>
            @endif
        @empty
            <h3 class="text-danger">NO EXISTEN USUARIOS</h3>
        @endforelse
    </tbody>
    <tbody>
    </tbody>
</table>

<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
    $('#tabla_permisos').DataTable({
        order: [[ 0, "asc" ]],
        // order: [[ 0, "desc" ]],
        searching: false,
        lengthChange: false,
        language: {
            url: '{{ asset('datatableEs.json') }}'
        },
    });
</script>
