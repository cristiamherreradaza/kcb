<div class="row">
    {{-- @dd($menusPerfiles->count()) --}}
    @php
        $cantidadToltal  = $menusPerfiles->count();
        $columnas = 2;
        $canCol = round($cantidadToltal/$columnas);
        $canRes = $cantidadToltal - $canCol;
        $contador = 1;
    // echo $cantidad;

    @endphp

    @foreach ($menusPerfiles as $m )
        @if ($contador <= $canCol)
            @if ($contador == 1)
                <div class="col-md-6">
                    @if ($m->menu->direccion!='#')
                        <br>- <input type="checkbox" id="{{ $m->id}}" onchange="guarda('{{ $m->id }}')" {{ ($m->estado=='Visible')? "checked":''}} > <label for="{{ $m->id}}">{{$m->menu->nombre}}</label> 
                    @else
                        <br><input type="checkbox" id="{{ $m->id}}" onchange="guarda('{{ $m->id }}')" {{ ($m->estado=='Visible')? "checked":''}} > <label for="{{ $m->id}}">{{$m->menu->nombre}}</label> 
                    @endif
            @else
                @if ($contador==$canCol)
                    @if ($m->menu->direccion!='#')
                            <br>- <input type="checkbox" id="{{ $m->id}}" onchange="guarda('{{ $m->id }}')" {{ ($m->estado=='Visible')? "checked":''}} > <label for="{{ $m->id}}">{{$m->menu->nombre}}</label> 
                        </div>
                    @else
                            <br><input type="checkbox" id="{{ $m->id}}" onchange="guarda('{{ $m->id }}')" {{ ($m->estado=='Visible')? "checked":''}} > <label for="{{ $m->id}}">{{$m->menu->nombre}}</label> 
                        </div>
                    @endif
                @else
                    @if ($m->menu->direccion!='#')
                        <br>- <input type="checkbox" id="{{ $m->id}}" onchange="guarda('{{ $m->id }}')" {{ ($m->estado=='Visible')? "checked":''}} > <label for="{{ $m->id}}">{{$m->menu->nombre}}</label> 
                    @else
                        <br><input type="checkbox" id="{{ $m->id}}" onchange="guarda('{{ $m->id }}')" {{ ($m->estado=='Visible')? "checked":''}} > <label for="{{ $m->id}}">{{$m->menu->nombre}}</label> 
                    @endif
                @endif
            @endif
        @else
            @if ($contador==($canCol+1))
                <div class="col-md-6">
                    @if ($m->menu->direccion!='#')
                        <br>- <input type="checkbox" id="{{ $m->id}}" onchange="guarda('{{ $m->id }}')" {{ ($m->estado=='Visible')? "checked":''}} > <label for="{{ $m->id}}">{{$m->menu->nombre}}</label>         
                    @else
                        <br><input type="checkbox" id="{{ $m->id}}" onchange="guarda('{{ $m->id }}')" {{ ($m->estado=='Visible')? "checked":''}} > <label for="{{ $m->id}}">{{$m->menu->nombre}}</label>         
                    @endif
            @else
                @if ($contador==$cantidadToltal)
                    @if ($m->menu->direccion!='#')
                        <br>- <input type="checkbox" id="{{ $m->id}}" onchange="guarda('{{ $m->id }}')" {{ ($m->estado=='Visible')? "checked":''}} > <label for="{{ $m->id}}">{{$m->menu->nombre}}</label> 
                    @else
                        <br><input type="checkbox" id="{{ $m->id}}" onchange="guarda('{{ $m->id }}')" {{ ($m->estado=='Visible')? "checked":''}} > <label for="{{ $m->id}}">{{$m->menu->nombre}}</label> 
                    @endif
                </div>
                @else
                    @if ($m->menu->direccion!='#')
                        <br>- <input type="checkbox" id="{{ $m->id}}" onchange="guarda('{{ $m->id }}')" {{ ($m->estado=='Visible')? "checked":''}} > <label for="{{ $m->id}}">{{$m->menu->nombre}}</label>         
                    @else
                        <br><input type="checkbox" id="{{ $m->id}}" onchange="guarda('{{ $m->id }}')" {{ ($m->estado=='Visible')? "checked":''}} > <label for="{{ $m->id}}">{{$m->menu->nombre}}</label>         
                    @endif
                @endif
            @endif
        @endif
        @php
            $contador++;
        @endphp
    @endforeach
</div>