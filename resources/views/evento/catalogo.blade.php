@extends('layouts.app')
@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>CATEGORIA CACHORROS ESPECIALES</h2>
        {{-- @dd($ejemplares) --}}
        @php
            $grupo1  = array();
            $grupo2  = array();
            $grupo3  = array();
            $grupo4  = array();
            $grupo5  = array();
            $grupo6  = array();
            $grupo7  = array();
            $grupo8  = array();
            $grupo9  = array();
            $grupo10 = array();
            foreach ($ejemplares as $key => $e){

                $cant = App\GrupoRaza::where('raza_id',$e->raza_id)
                                        ->first();
                if($cant){
                    echo ($key+1)." - Nombre Raza: ".$cant->razas->nombre." <---> Raza ID: ".$cant->razas->id." <---> Grupo ID: ".$cant->grupo_id." <---> Ejemplar ID: ".$e->ejemplar_id."<br>";
                    switch ($cant->grupo_id) {
                        case 1:
                            array_push($grupo1, "$e->ejemplar_id");
                            // echo "i equals 0";
                            break;
                        case 2:
                            array_push($grupo2, "$e->ejemplar_id");
                            // echo "i equals 1";
                            break;
                        case 3:
                            array_push($grupo3, "$e->ejemplar_id");
                            // echo "i equals 2";
                            break;
                        case 4:
                            array_push($grupo4, "$e->ejemplar_id");
                            // echo "i equals 0";
                            break;
                        case 5:
                            array_push($grupo5, "$e->ejemplar_id");
                            // echo "i equals 1";
                            break;
                        case 6:
                            array_push($grupo6, "$e->ejemplar_id");
                            // echo "i equals 2";
                            break;
                        case 7:
                            array_push($grupo7, "$e->ejemplar_id");
                            // echo "i equals 0";
                            break;
                        case 8:
                            array_push($grupo8, "$e->ejemplar_id");
                            // echo "i equals 1";
                            break;
                        case 9:
                            array_push($grupo9, "$e->ejemplar_id");
                            // echo "i equals 2";
                            break;
                        case 10:
                            array_push($grupo10, "$e->ejemplar_id");
                            // echo "i equals 2";
                            break;
                    }
                }
                // dd($cant->razas->nombre);
            }
            echo '<br><br>grupo I -> ';
            print_r($grupo1);
            echo '<br><br>grupo II -> ';
            print_r($grupo2);
            echo '<br><br>grupo III -> ';
            print_r($grupo3);
            echo '<br><br>grupo IV -> ';
            print_r($grupo4);
            echo '<br><br>grupo V -> ';
            print_r($grupo5);
            echo '<br><br>grupo VI -> ';
            print_r($grupo6);
            echo '<br><br>grupo VII -> ';
            print_r($grupo7);
            echo '<br><br>grupo VIII -> ';
            print_r($grupo8);
            echo '<br><br>grupo IX -> ';
            print_r($grupo9);
            echo '<br><br>grupo X -> ';
            print_r($grupo10);
            // $grupos = array();
            // foreach ($ejemplares as $key => $e){
                // echo $e;
                // if($e->grupoRaza){
                    // echo  ($key+1)." - ".$e->nombre_completo." <---> ".$e->id." <---> ".$e->grupoRaza->razas->nombre." <---><b> ".$e->grupoRaza->grupos->nombre."</b><br>";
                    // dd($e->raza->grupo->grupos->nombre);
                //     echo  ($key+1)." - ".$e->nombre_completo." <---> ".$e->id." <---> ".$e->raza->nombre." <---> ".$e->raza->grupo->grupos->nombre."<br>";
                // }
                // dd($e->grupoRaza->razas->nombre);
            // }
            // foreach ($variable as $key => $value) {
            //     # code...
            // }
        @endphp
        @if (!empty($grupo1))
            <h5 class="text-primary">Grupo I</h5>
            <h5 class="text-primary">
                @php
                    $ejemplar = App\Ejemplar::find($grupo1[0]);
                    if($ejemplar){
                        echo $ejemplar->raza->nombre;
                    }
                @endphp
            </h5>
        @endif
        @if (!empty($grupo2))
            <h5 class="text-primary">Grupo II</h5>
             @php

                 $razas = Illuminate\Support\Facades\DB::table('ejemplares_eventos ee')
                                ->join('razas r', 'ee.raza_id', '=', 'r.id')
                                ->join('grupos_razas gr', 'gr.raza_id', '=', 'r.id')
                                ->join('grupos g', 'g.id', '=', 'gr.grupo_id')
                                ->where('ee.evento_id',64)
                                ->where('ee.categorias_pistas',1)
                                ->where('g.id',2)
                                ->groupBy('r.id')
                                ->orderBy('r.nombre','asc')
                                ->select('r.*')
                                ->toSql();

                echo $razas;
             @endphp
            {{-- <h5 class="text-primary">
                @php
                    $ejemplar = App\Ejemplar::find($grupo2[0]);
                    if($ejemplar){
                        echo $ejemplar->raza->nombre;
                    }
                @endphp
            </h5>
            @forelse ($grupo2 as $g2)
                {{ $g2 }}
                @php
                    $eje = App\Ejemplar::find($g2);
                    if($eje){
                        echo $eje->nombre."<br>" ;
                    }else{
                        echo "->".$g2."<br>";
                    }
                @endphp
            @empty
                
            @endforelse --}}
        @endif
        @if (!empty($grupo3))
            <h5 class="text-primary">Grupo III</h5>
            <h5 class="text-primary">
                @php
                    $ejemplar = App\Ejemplar::find($grupo3[0]);
                    if($ejemplar){
                        echo $ejemplar->raza->nombre;
                    }
                @endphp
            </h5>
        @endif
        @if (!empty($grupo4))
            <h5 class="text-primary">Grupo IV</h5>
            <h5 class="text-primary">
                @php
                    $ejemplar = App\Ejemplar::find($grupo4[0]);
                    if($ejemplar){
                        echo $ejemplar->raza->nombre;
                    }
                @endphp
            </h5>
        @endif
        @if (!empty($grupo5))
            <h5 class="text-primary">Grupo V</h5>
            <h5 class="text-primary">
                @php
                    $ejemplar = App\Ejemplar::find($grupo5[0]);
                    if($ejemplar){
                        echo $ejemplar->raza->nombre;
                    }
                @endphp
            </h5>
        @endif
        @if (!empty($grupo6))
            <h5 class="text-primary">Grupo VI</h5>
            <h5 class="text-primary">
                @php
                    $ejemplar = App\Ejemplar::find($grupo6[0]);
                    if($ejemplar){
                        echo $ejemplar->raza->nombre;
                    }
                @endphp
            </h5>
        @endif
        @if (!empty($grupo7))
            <h5 class="text-primary">Grupo VII</h5>
            <h5 class="text-primary">
                @php
                    $ejemplar = App\Ejemplar::find($grupo7[0]);
                    if($ejemplar){
                        echo $ejemplar->raza->nombre;
                    }
                @endphp
            </h5>
        @endif
        @if (!empty($grupo8))
            <h5 class="text-primary">Grupo VIII</h5>
            <h5 class="text-primary">
                @php
                    $ejemplar = App\Ejemplar::find($grupo8[0]);
                    if($ejemplar){
                        echo $ejemplar->raza->nombre;
                    }
                @endphp
            </h5>
        @endif
        @if (!empty($grupo9))
            <h5 class="text-primary">Grupo IX</h5>
            <h5 class="text-primary">
                @php
                    $ejemplar = App\Ejemplar::find($grupo9[0]);
                    if($ejemplar){
                        echo $ejemplar->raza->nombre;
                    }
                @endphp
            </h5>
        @endif
        @if (!empty($grupo10))
            <h5 class="text-primary">Grupo X</h5>
            <h5 class="text-primary">
                @php
                    $ejemplar = App\Ejemplar::find($grupo10[0]);
                    if($ejemplar){
                        echo $ejemplar->raza->nombre;
                    }
                @endphp
            </h5>
        @endif
    </div>
</div>
@stop

@section('js')
    {{-- <script src="{{ asset('assets/js/pages/crud/file-upload/dropzonejs.js') }}"></script> --}}
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-switch.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            // definimos cabecera donde estarra el token y poder hacer nuestras operaciones de put,post...
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection
