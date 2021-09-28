<div class="row">
    {{-- @dd($menus->count()) --}}
    @php
        $cantidadToltal  = $menus->count();
        $columnas = 2;
        $canCol = round($cantidadToltal/$columnas);
        $canRes = $cantidadToltal - $canCol;
        $contador = 1;
    // echo $cantidad;

    @endphp

    @foreach ($menus as $m )
        @if ($contador <= $canCol)
            @if ($contador == 1)
                <div class="col-md-6">
                    <br><input type="checkbox" id="{{ $m->id}}" onchange="guarda('{{ $m->id }}')" {{ ($m->estado)? "checked":''}} > {{$m->menu->nombre}}
            @else
                @if ($contador==$canCol)
                        <br><input type="checkbox" id="{{ $m->id}}" onchange="guarda('{{ $m->id }}')" {{ ($m->estado)? "checked":''}} > {{$m->menu->nombre}}
                    </div>
                @else
                    <br><input type="checkbox" id="{{ $m->id}}" onchange="guarda('{{ $m->id }}')" {{ ($m->estado)? "checked":''}} > {{$m->menu->nombre}}
                @endif
            @endif
        @else
            @if ($contador==($canCol+1))
                <div class="col-md-6">
                    <br><input type="checkbox" id="{{ $m->id}}" onchange="guarda('{{ $m->id }}')" {{ ($m->estado)? "checked":''}} > {{$m->menu->nombre}}        
            @else
                @if ($contador==$cantidadToltal)
                    <br><input type="checkbox" id="{{ $m->id}}" onchange="guarda('{{ $m->id }}')" {{ ($m->estado)? "checked":''}} > {{$m->menu->nombre}}
                </div>
                @else
                    <br><input type="checkbox" id="{{ $m->id}}" onchange="guarda('{{ $m->id }}')" {{ ($m->estado)? "checked":''}} > {{$m->menu->nombre}}        
                @endif
            @endif
        @endif
        @php
            $contador++;
        @endphp
    @endforeach
</div>