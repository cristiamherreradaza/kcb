<table class="table table-striped">
    <thead>
        <tr>
            <th>FECHA</th>
            <th>TITULO</th>
            {{--  <th></th>  --}}
        </tr>
    </thead>
    <tbody>
        @forelse ($titulosEjemplares as $te)
        <tr>
            <td>{{ $te->fecha_obtencion }}</td>
            <td>{{ $te->titulo->nombre}}</td>
            <td>
                <button type="button" class="btn btn-icon btn-danger" onclick="eliminaTitulo('{{ $te->id }}', '{{ $te->titulo->nombre }}')">
                    <i class="flaticon2-cross"></i>
                </button>
            </td>
        </tr>
        @empty
        <h3>No tiene examenes</h3>
        @endforelse
    </tbody>
</table>
<a href="#" class="btn btn-info btn-block" onclick="nuevoTitulo()">Nuevo Titulo</a>
