<table class="table table-striped">
    <thead>
        <tr>
            <th>FECHA</th>
            <th>PROPIETARIO</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($ejemplarTransferencias as $et)
        <tr>
            <td>{{ $et->fecha_transferencia }}</td>
            <td>{{ $et->propietario->name }}</td>
            <td>
                <button type="button" class="btn btn-icon btn-danger" onclick="eliminaTransferencia('{{ $et->id }}', '{{ $et->propietario->name }}')">
                    <i class="flaticon2-cross"></i>
                </button>
            </td>
        </tr>
        @empty
        <h3>No tiene Transferencias</h3>
        @endforelse
    </tbody>
</table>
<a href="#" class="btn btn-info btn-block" onclick="nuevaTransferencia()">Nueva Tramsferencia</a>
