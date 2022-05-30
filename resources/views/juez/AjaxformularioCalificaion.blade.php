<form action="">

    @forelse ( $arrayEjemplaresDevuetos as $aed)

        @php
            $arrayRaza = array();
        @endphp

        <div class="table-responsive m-t-40">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr class="text-info text-center">
                        <th colspan="2">
                            @php
                                if($aed[0]->categoria_pista_id == 1){
                                    $categoria = "Especial";
                                }elseif($aed[0]->categoria_pista_id == 11 || $aed[0]->categoria_pista_id == 2){
                                    $categoria = "Absoluto";
                                }elseif($aed[0]->categoria_pista_id == 3 || $aed[0]->categoria_pista_id == 4 || $aed[0]->categoria_pista_id == 12 || $aed[0]->categoria_pista_id == 13){
                                    $categoria = "Jovenes";
                                }elseif($aed[0]->categoria_pista_id == 5 || $aed[0]->categoria_pista_id == 6 || $aed[0]->categoria_pista_id == 7 || $aed[0]->categoria_pista_id == 8 || $aed[0]->categoria_pista_id == 9 || $aed[0]->categoria_pista_id == 10 || $aed[0]->categoria_pista_id == 14 || $aed[0]->categoria_pista_id == 15 || $aed[0]->categoria_pista_id == 16 || $aed[0]->categoria_pista_id == 17 || $aed[0]->categoria_pista_id == 18 || $aed[0]->categoria_pista_id == 19 || $aed[0]->categoria_pista_id == 20){
                                    $categoria = "Adultos";
                                }
                            @endphp
                            <span class="text-primary">{{ $categoria }}</span> -> Grupo -> <span class="text-primary">{{ $aed[0]->grupo_id }}</span>
                        </th>
                    </tr>
                    <tr>
                        <th width="100px">Numero</th>
                        <th>Calificacion</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ( $aed as $ed)

                        @if (!in_array($ed->raza_id,$arrayRaza))
                            <tr class="text-center">
                                <td colspan="2">
                                    <h6>{{ $ed->raza->nombre }}</h6>
                                </td>
                            </tr>
                            @php
                                array_push($arrayRaza,$ed->raza_id);
                            @endphp
                        @endif

                        <tr>
                            <td>
                                <h2 class="text-center text-primary">
                                    {{ $ed->numero_prefijo }}
                                </h2>
                            </td>
                            <td>
                                <select name="" id="" class="form-control">
                                    <option value="">Bien</option>
                                    <option value="">Muy Bien</option>
                                    <option value="">Excelente</option>
                                </select>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    @empty
        <h3 class="text-danger text-center">Sin datos</h3>
    @endforelse

    {{-- <div class="row">
        <div class="col-md-12">
            <button class="btn btn-success btn-block"></button>
        </div>
    </div> --}}
</form>