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
            <th>DEPARTAMENTO</th>
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
            <td>
                @if ($e->raza_id != null)
                    {{ $e->raza['nombre'] }}
                @endif
            </td>
            <td>
                @if ($e->propietario_id != null)
                    @if ($e->propietario)
                        {{ $e->propietario['name'] }}
                    @endif
                @endif
            </td>
            <td>{{ $e->departamento }}</td>
            <td style="width: 10%">
                <button type="button" class="btn btn-icon btn-warning" onclick="edita('{{ $e->id }}')">
                    <i class="flaticon2-edit"></i>
                </button>
                @if ($e->camada_id != null)
                    <button type="button" class="btn btn-icon btn-dark" onclick="camada('{{ $e->camada_id }}')">
                        <i class="fab fa-buromobelexperte"></i>
                    </button>
                @endif
                <button type="button" class="btn btn-icon btn-info" onclick="informacion('{{ $e->id }}')">
                    <i class="far fa-file-alt"></i>
                </button>
                <button type="button" class="btn btn-icon btn-primary" onclick="logs('{{ $e->id }}')">
                    <i class="far fa-keyboard"></i>
                </button>
                @php
                    $padre = App\Camada::where('padre_id',$e->id)->count();
                    $madre = App\Camada::where('madre_id',$e->id)->count();
                    if($padre>0 || $madre>0){
                        $table = 0;
                        if($padre>0){
                            $table = 1;
                        }
                        echo '<button type="button" class="btn btn-icon btn-success" onclick="PadresCamadas('.$e->id.','.$table.')">
                                <i class="fas fa-bezier-curve"></i>
                            </button>';
                    }
                    // elseif($madre>0){
                    //     echo '<button type="button" class="btn btn-icon btn-success" onclick="">
                    //             <i class="fas fa-bezier-curve"></i>
                    //         </button>';
                    // }
                @endphp

                <button type="button" class="btn btn-icon btn-danger" onclick="elimina('{{ $e->id }}', '{{ $e->nombre }}')">
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
        responsive: true,
        language: {
            url: '{{ asset('datatableEs.json') }}'
        },
    });
</script>
