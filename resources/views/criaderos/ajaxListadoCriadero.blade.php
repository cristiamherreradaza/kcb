<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
<table class="table table-bordered table-hover table-striped" id="tabla_criaderos">
    <thead>
        <tr>
            <th>ID</th>
            <th>Propietario</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Celular</th>
            <th>Departamento</th>
            {{-- <th>Criaderos</th> --}}
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($datosCriaderos as $cri)
        @if($cri->criadero)
        <tr>
            <td>{{ $cri->idProCria}}</td>
            <td>{{ $cri->propietario->name }}</td>
            <td>{{ $cri->criadero->nombre }}</td>
            <td>{{ $cri->criadero->email }}</td>
            <td>{{ $cri->criadero->celulares }}</td>
            <td>{{ $cri->criadero->departamento }}</td>
            {{-- <td>
                @php
                    $cantidad = App\PropietarioCriadero::where('propietario_id', $cri->id)
                                                        ->count();

                    echo $cantidad;
                @endphp
            </td> --}}
            <td>
                <button type="button" class="btn btn-icon btn-warning" onclick="edita('{{ $cri->idProCria }}')">
                    <i class="flaticon2-edit"></i>
                </button>
                <button type="button" class="btn btn-icon btn-danger"
                    onclick="elimina('{{ $cri->idProCria }}', '{{ $cri->nombre }}')">
                    <i class="flaticon2-cross"></i>
                </button>
            </td>
        </tr>
        @endif

        @empty
        <h3 class="text-danger">NO EXISTEN CRIADEROS</h3>
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
        responsive: true,
        language: {
            url: '{{ asset('datatableEs.json') }}'
        },
    });
</script>
