<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
<table class="table table-bordered table-hover table-striped" id="tabla_usuarios">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Celular</th>
            <th>Cedula</th>
            <th>Departamento</th>
            <th>Tipo</th>
            <th>Camada</th>
            <th>Criaderos</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($datosPropietarios as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->name }}</td>
            <td>{{ $p->email }}</td>
            <td>{{ $p->celulares }}</td>
            <td>{{ $p->ci }}</td>
            <td>{{ $p->departamento }}</td>
            <td>{{ $p->tipo }}</td>
            <td>
                @php
                    $ejemplar = App\Ejemplar::where('propietario_id',$p->id)
                                            ->orderBy('id','desc')
                                            ->first();
                    if($ejemplar){
                        if($ejemplar->camada){
                            echo $ejemplar->camada->camada;
                        }
                    }
                @endphp
            </td>
            <td>
                @php
                    $cantidad = App\PropietarioCriadero::where('propietario_id', $p->id)
                                                        ->count();

                    echo $cantidad;
                @endphp
            </td>
            <td>
                <button type="button" class="btn btn-sm btn-icon btn-warning" onclick="edita('{{ $p->id }}')">
                    <i class="flaticon2-edit"></i>
                </button>
                <button type="button" class="btn btn-sm btn-icon btn-success" onclick="listaCriadero('{{ $p->id }}')">
                    <i class="fas fa-dog"></i>
                </button>
                <button type="button" class="btn btn-sm btn-icon btn-danger"
                    onclick="elimina('{{ $p->id }}', '{{ $p->name }}')">
                    <i class="flaticon2-cross"></i>
                </button>
            </td>
        </tr>
        @empty
        <h3 class="text-danger">NO EXISTEN USUARIOS</h3>
        @endforelse
    </tbody>
    <tbody>
    </tbody>
</table>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
    $('#tabla_usuarios').DataTable({
        order: [[ 0, "desc" ]],
        searching: false,
        lengthChange: false,
        language: {
            url: '{{ asset('datatableEs.json') }}'
        },
    });
</script>