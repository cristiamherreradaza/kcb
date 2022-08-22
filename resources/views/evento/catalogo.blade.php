@php
    use \App\Http\Controllers\EventoController;
@endphp
@extends('layouts.app')
@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')

    {{-- <div class="row">
        <div class="col-md-12">
            <h2>CATEGORIA CACHORROS ESPECIALES</h2>
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
                $grupo11 = array();

                foreach ($ejemplares as $key => $e){

                    $cant = App\GrupoRaza::where('raza_id',$e->raza_id)
                                            ->first();
                    if($cant){
                        if($e->extrangero == 'no'){
                            $ejemplar = $e->ejemplar_id;
                        }else{
                            $ejemplar = (-1) * $e->id;
                        }
                        // dd($ejemplar);
                        // echo ($key+1)." - Nombre Raza: ".$cant->razas->nombre." <---> Raza ID: ".$cant->razas->id." <---> Grupo ID: ".$cant->grupo_id." <---> Ejemplar ID: ".$e->ejemplar_id."<br>";
                        switch ($cant->grupo_id) {
                            case 1:
                                array_push($grupo1, "$ejemplar");
                                // echo "i equals 0";
                                break;
                            case 2:
                                array_push($grupo2, "$ejemplar");
                                // echo "i equals 1";
                                break;
                            case 3:
                                array_push($grupo3, "$ejemplar");
                                // echo "i equals 2";
                                break;
                            case 4:
                                array_push($grupo4, "$ejemplar");
                                // echo "i equals 0";
                                break;
                            case 5:
                                array_push($grupo5, "$ejemplar");
                                // echo "i equals 1";
                                break;
                            case 6:
                                array_push($grupo6, "$ejemplar");
                                // echo "i equals 2";
                                break;
                            case 7:
                                array_push($grupo7, "$ejemplar");
                                // echo "i equals 0";
                                break;
                            case 8:
                                array_push($grupo8, "$ejemplar");
                                // echo "i equals 1";
                                break;
                            case 9:
                                array_push($grupo9, "$ejemplar");
                                // echo "i equals 2";
                                break;
                            case 10:
                                array_push($grupo10, "$ejemplar");
                                // echo "i equals 2";
                                break;
                            case 11:
                                array_push($grupo11, "$ejemplar");
                                // echo "i equals 2";
                                break;
                        }
                    }
                }
                // echo '<br><br>grupo I -> ';
                // print_r($grupo1);
                // echo '<br><br>grupo II -> ';
                // print_r($grupo2);
                // echo '<br><br>grupo III -> ';
                // print_r($grupo3);
                // echo '<br><br>grupo IV -> ';
                // print_r($grupo4);
                // echo '<br><br>grupo V -> ';
                // print_r($grupo5);
                // echo '<br><br>grupo VI -> ';
                // print_r($grupo6);
                // echo '<br><br>grupo VII -> ';
                // print_r($grupo7);
                // echo '<br><br>grupo VIII -> ';
                // print_r($grupo8);
                // echo '<br><br>grupo IX -> ';
                // print_r($grupo9);
                // echo '<br><br>grupo X -> ';
                // print_r($grupo10);
            @endphp
            @if (!empty($grupo1))
                <h5 class="text-primary">Grupo I</h5>
                @php
                    EventoController::armaCatalogo($grupo1, $evento->id, 1,1);
                @endphp
            @endif
            @if (!empty($grupo2))
                <h5 class="text-primary">Grupo II</h5>
                @php
                    EventoController::armaCatalogo($grupo2, $evento->id, 2,1);
                @endphp
            @endif
            @if (!empty($grupo3))
                <h5 class="text-primary">Grupo III</h5>
                @php
                    EventoController::armaCatalogo($grupo3, $evento->id, 3,1);
                @endphp
            @endif
            @if (!empty($grupo4))
                <h5 class="text-primary">Grupo IV</h5>
                @php
                    EventoController::armaCatalogo($grupo4, $evento->id, 4,1);
                @endphp
            @endif
            @if (!empty($grupo5))
                <h5 class="text-primary">Grupo V</h5>
                @php
                    EventoController::armaCatalogo($grupo5, $evento->id, 5,1);
                @endphp
            @endif
            @if (!empty($grupo6))
                <h5 class="text-primary">Grupo VI</h5>
                @php
                    EventoController::armaCatalogo($grupo6, $evento->id, 6,1);
                @endphp
            @endif
            @if (!empty($grupo7))
                <h5 class="text-primary">Grupo VII</h5>
                @php
                    EventoController::armaCatalogo($grupo7, $evento->id, 7,1);
                @endphp
            @endif
            @if (!empty($grupo8))
                <h5 class="text-primary">Grupo VIII</h5>
                @php
                    EventoController::armaCatalogo($grupo8, $evento->id, 8,1);
                @endphp
            @endif
            @if (!empty($grupo9))
                <h5 class="text-primary">Grupo IX</h5>
                @php
                    EventoController::armaCatalogo($grupo9, $evento->id, 9,1);
                @endphp
            @endif
            @if (!empty($grupo10))
                <h5 class="text-primary">Grupo X</h5>
                @php
                    EventoController::armaCatalogo($grupo10, $evento->id, 10,1);
                @endphp
            @endif

            @if (!empty($grupo11))
                <h5 class="text-primary">Grupo XI</h5>
                @php
                    EventoController::armaCatalogo($grupo11, $evento->id, 11,1);
                @endphp
            @endif
        </div>
    </div> --}}

    {{-- <div class="row">
        <div class="col-md-12">
            <h2>CATEGORIA CACHORROS ABSOLUTOS</h2>

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
                $grupo11 = array();
                // dd($ejemplaresAbsolutos);
                foreach ($ejemplaresAbsolutos as $key => $e){

                    $cant = App\GrupoRaza::where('raza_id',$e->raza_id)
                                            ->first();
                    if($cant){
                        // echo ($key+1)." - Nombre Raza: ".$cant->razas->nombre." <---> Raza ID: ".$cant->razas->id." <---> Grupo ID: ".$cant->grupo_id." <---> Ejemplar ID: ".$e->ejemplar_id."<br>";
                        if($e->extrangero == 'no'){
                            $ejemplar = $e->ejemplar_id;
                        }else{
                            $ejemplar = (-1) * $e->id;
                        }
                        // echo '<h1>'.$ejemplar.'</h1>';
                        switch ($cant->grupo_id) {
                            case 1:
                                array_push($grupo1, "$ejemplar");
                                // echo "i equals 0";
                                break;
                            case 2:
                                array_push($grupo2, "$ejemplar");
                                // echo "i equals 1";
                                break;
                            case 3:
                                array_push($grupo3, "$ejemplar");
                                // echo "i equals 2";
                                break;
                            case 4:
                                array_push($grupo4, "$ejemplar");
                                // echo "i equals 0";
                                break;
                            case 5:
                                array_push($grupo5, "$ejemplar");
                                // echo "i equals 1";
                                break;
                            case 6:
                                array_push($grupo6, "$ejemplar");
                                // echo "i equals 2";
                                break;
                            case 7:
                                array_push($grupo7, "$ejemplar");
                                // echo "i equals 0";
                                break;
                            case 8:
                                array_push($grupo8, "$ejemplar");
                                // echo "i equals 1";
                                break;
                            case 9:
                                array_push($grupo9, "$ejemplar");
                                // echo "i equals 2";
                                break;
                            case 10:
                                array_push($grupo10, "$ejemplar");
                                // echo "i equals 2";
                                break;
                            case 11:
                                array_push($grupo11, "$ejemplar");
                                // echo "i equals 2";
                                break;
                        }
                    }
                }
                // echo '<br><br>grupo I -> ';
                // print_r($grupo1);
                // echo '<br><br>grupo II -> ';
                // print_r($grupo2);
                // echo '<br><br>grupo III -> ';
                // print_r($grupo3);
                // echo '<br><br>grupo IV -> ';
                // print_r($grupo4);
                // echo '<br><br>grupo V -> ';
                // print_r($grupo5);
                // echo '<br><br>grupo VI -> ';
                // print_r($grupo6);
                // echo '<br><br>grupo VII -> ';
                // print_r($grupo7);
                // echo '<br><br>grupo VIII -> ';
                // print_r($grupo8);
                // echo '<br><br>grupo IX -> ';
                // print_r($grupo9);
                // echo '<br><br>grupo X -> ';
                // print_r($grupo10);
            @endphp
        @if (!empty($grupo1))
            <h5 class="text-primary">Grupo I</h5>
            @php
                EventoController::armaCatalogo($grupo1, $evento->id, 1,2);
            @endphp
        @endif
        @if (!empty($grupo2))
            <h5 class="text-primary">Grupo II</h5>
            @php
                EventoController::armaCatalogo($grupo2, $evento->id, 2,2);
            @endphp
        @endif
        @if (!empty($grupo3))
            <h5 class="text-primary">Grupo III</h5>
            @php
                EventoController::armaCatalogo($grupo3, $evento->id, 3,2);
            @endphp
        @endif
        @if (!empty($grupo4))
            <h5 class="text-primary">Grupo IV</h5>
            @php
                EventoController::armaCatalogo($grupo4, $evento->id, 4,2);
            @endphp
        @endif
        @if (!empty($grupo5))
            <h5 class="text-primary">Grupo V</h5>
            @php
                EventoController::armaCatalogo($grupo5, $evento->id, 5,2);
            @endphp
        @endif
        @if (!empty($grupo6))
            <h5 class="text-primary">Grupo VI</h5>
            @php
                EventoController::armaCatalogo($grupo6, $evento->id, 6,2);
            @endphp
        @endif
        @if (!empty($grupo7))
            <h5 class="text-primary">Grupo VII</h5>
            @php
                EventoController::armaCatalogo($grupo7, $evento->id, 7,2);
            @endphp
        @endif
        @if (!empty($grupo8))
            <h5 class="text-primary">Grupo VIII</h5>
            @php
                EventoController::armaCatalogo($grupo8, $evento->id, 8,2);
            @endphp
        @endif
        @if (!empty($grupo9))
            <h5 class="text-primary">Grupo IX</h5>
            @php
                EventoController::armaCatalogo($grupo9, $evento->id, 9,2);
            @endphp
        @endif
        @if (!empty($grupo10))
            <h5 class="text-primary">Grupo X</h5>
            @php
                EventoController::armaCatalogo($grupo10, $evento->id, 10,2);
            @endphp
        @endif
        @if (!empty($grupo11))
            <h5 class="text-primary">Grupo XI</h5>
            @php
                EventoController::armaCatalogo($grupo11, $evento->id, 11,2);
            @endphp
        @endif
        </div>
    </div> --}}

    {{-- <div class="row">
        <div class="col-md-12">
            <h2>CATEGORIA JOVENES</h2>

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
                $grupo11 = array();
                foreach ($ejemplaresJovenes as $key => $e){

                    $cant = App\GrupoRaza::where('raza_id',$e->raza_id)
                                            ->first();
                                            // dd($cant);
                    if($cant){
                        if($e->extrangero == 'no'){
                            $ejemplar = $e->ejemplar_id;
                        }else{
                            $ejemplar = (-1) * $e->id;
                        }
                        // echo ($key+1)." - Nombre Raza: ".$cant->razas->nombre." <---> Raza ID: ".$cant->razas->id." <---> Grupo ID: ".$cant->grupo_id." <---> Ejemplar ID: ".$e->ejemplar_id."<br>";
                        switch ($cant->grupo_id) {
                            case 1:
                                array_push($grupo1, "$ejemplar");
                                // echo "i equals 0";
                                break;
                            case 2:
                                array_push($grupo2, "$ejemplar");
                                // echo "i equals 1";
                                break;
                            case 3:
                                array_push($grupo3, "$ejemplar");
                                // echo "i equals 2";
                                break;
                            case 4:
                                array_push($grupo4, "$ejemplar");
                                // echo "i equals 0";
                                break;
                            case 5:
                                array_push($grupo5, "$ejemplar");
                                // echo "i equals 1";
                                break;
                            case 6:
                                array_push($grupo6, "$ejemplar");
                                // echo "i equals 2";
                                break;
                            case 7:
                                array_push($grupo7, "$ejemplar");
                                // echo "i equals 0";
                                break;
                            case 8:
                                array_push($grupo8, "$ejemplar");
                                // echo "i equals 1";
                                break;
                            case 9:
                                array_push($grupo9, "$ejemplar");
                                // echo "i equals 2";
                                break;
                            case 10:
                                array_push($grupo10, "$ejemplar");
                                // echo "i equals 2";
                                break;
                            case 11:
                                array_push($grupo11, "$ejemplar");
                                // echo "i equals 2";
                                break;
                        }
                    }
                }
                // echo '<br><br>grupo I -> ';
                // print_r($grupo1);
                // echo '<br><br>grupo II -> ';
                // print_r($grupo2);
                // echo '<br><br>grupo III -> ';
                // print_r($grupo3);
                // echo '<br><br>grupo IV -> ';
                // print_r($grupo4);
                // echo '<br><br>grupo V -> ';
                // print_r($grupo5);
                // echo '<br><br>grupo VI -> ';
                // print_r($grupo6);
                // echo '<br><br>grupo VII -> ';
                // print_r($grupo7);
                // echo '<br><br>grupo VIII -> ';
                // print_r($grupo8);
                // echo '<br><br>grupo IX -> ';
                // print_r($grupo9);
                // echo '<br><br>grupo X -> ';
                // print_r($grupo10);
            @endphp
        @if (!empty($grupo1))
            <h5 class="text-primary">Grupo I</h5>
            @php
                EventoController::armaCatalogo($grupo1, $evento->id, 1,3);
            @endphp
        @endif
        @if (!empty($grupo2))
            <h5 class="text-primary">Grupo II</h5>
            @php
                EventoController::armaCatalogo($grupo2, $evento->id, 2,3);
            @endphp
        @endif
        @if (!empty($grupo3))
            <h5 class="text-primary">Grupo III</h5>
            @php
                EventoController::armaCatalogo($grupo3, $evento->id, 3,3);
            @endphp
        @endif
        @if (!empty($grupo4))
            <h5 class="text-primary">Grupo IV</h5>
            @php
                EventoController::armaCatalogo($grupo4, $evento->id, 4,3);
            @endphp
        @endif
        @if (!empty($grupo5))
            <h5 class="text-primary">Grupo V</h5>
            @php
                EventoController::armaCatalogo($grupo5, $evento->id, 5,3);
            @endphp
        @endif
        @if (!empty($grupo6))
            <h5 class="text-primary">Grupo VI</h5>
            @php
                EventoController::armaCatalogo($grupo6, $evento->id, 6,3);
            @endphp
        @endif
        @if (!empty($grupo7))
            <h5 class="text-primary">Grupo VII</h5>
            @php
                EventoController::armaCatalogo($grupo7, $evento->id, 7,3);
            @endphp
        @endif
        @if (!empty($grupo8))
            <h5 class="text-primary">Grupo VIII</h5>
            @php
                EventoController::armaCatalogo($grupo8, $evento->id, 8,3);
            @endphp
        @endif
        @if (!empty($grupo9))
            <h5 class="text-primary">Grupo IX</h5>
            @php
                EventoController::armaCatalogo($grupo9, $evento->id, 9,3);
            @endphp
        @endif
        @if (!empty($grupo10))
            <h5 class="text-primary">Grupo X</h5>
            @php
                EventoController::armaCatalogo($grupo10, $evento->id, 10,3);
            @endphp
        @endif
        @if (!empty($grupo11))
            <h5 class="text-primary">Grupo XI</h5>
            @php
                EventoController::armaCatalogo($grupo11, $evento->id, 11,3);
            @endphp
        @endif
        </div>
    </div> --}}

    <div class="row">
        <div class="col-md-12">
            {{-- <h2>CATEGORIA JOVENES Y ADULTOS</h2> --}}
            <h2>CATEGORIA ADULTOS</h2>

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
                $grupo11 = array();
                // dd($ejemplaresAdulto);
                foreach ($ejemplaresAdulto as $key => $e){

                    $cant = App\GrupoRaza::where('raza_id',$e->raza_id)
                                            ->first();
                    if($cant){
                        // echo ($key+1)." - Nombre Raza: ".$cant->razas->nombre." <---> Raza ID: ".$cant->razas->id." <---> Grupo ID: ".$cant->grupo_id." <---> Ejemplar ID: ".$e->ejemplar_id."<br>";
                        if($e->extrangero == 'no'){
                            $ejemplar = $e->ejemplar_id;
                        }else{
                            $ejemplar = (-1) * $e->id;
                        }
                        switch ($cant->grupo_id) {
                            case 1:
                                array_push($grupo1, "$ejemplar");
                                // echo "i equals 0";
                                break;
                            case 2:
                                array_push($grupo2, "$ejemplar");
                                // echo "i equals 1";
                                break;
                            case 3:
                                array_push($grupo3, "$ejemplar");
                                // echo "i equals 2";
                                break;
                            case 4:
                                array_push($grupo4, "$ejemplar");
                                // echo "i equals 0";
                                break;
                            case 5:
                                array_push($grupo5, "$ejemplar");
                                // echo "i equals 1";
                                break;
                            case 6:
                                array_push($grupo6, "$ejemplar");
                                // echo "i equals 2";
                                break;
                            case 7:
                                array_push($grupo7, "$ejemplar");
                                // echo "i equals 0";
                                break;
                            case 8:
                                array_push($grupo8, "$ejemplar");
                                // echo "i equals 1";
                                break;
                            case 9:
                                array_push($grupo9, "$ejemplar");
                                // echo "i equals 2";
                                break;
                            case 10:
                                array_push($grupo10, "$ejemplar");
                                // echo "i equals 2";
                                break;
                            case 11:
                                array_push($grupo11, "$ejemplar");
                                // echo "i equals 2";
                                break;
                        }
                    }
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

            @endphp
        {{-- @if (!empty($grupo1))
            <h5 class="text-primary">Grupo I</h5>
            @php
                EventoController::armaCatalogo($grupo1, $evento->id, 1,4);
            @endphp
        @endif
        @if (!empty($grupo2))
            <h5 class="text-primary">Grupo II</h5>
            @php
                EventoController::armaCatalogo($grupo2, $evento->id, 2,4);
            @endphp
        @endif
        @if (!empty($grupo3))
            <h5 class="text-primary">Grupo III</h5>
            @php
                EventoController::armaCatalogo($grupo3, $evento->id, 3,4);
            @endphp
        @endif
        @if (!empty($grupo4))
            <h5 class="text-primary">Grupo IV</h5>
            @php
                EventoController::armaCatalogo($grupo4, $evento->id, 4,4);
            @endphp
        @endif --}}
        @if (!empty($grupo5))
            <h5 class="text-primary">Grupo V</h5>
            @php
                EventoController::armaCatalogo($grupo5, $evento->id, 5,4);
            @endphp
        @endif
        @if (!empty($grupo6))
            <h5 class="text-primary">Grupo VI</h5>
            @php
                EventoController::armaCatalogo($grupo6, $evento->id, 6,4);
            @endphp
        @endif
        @if (!empty($grupo7))
            <h5 class="text-primary">Grupo VII</h5>
            @php
                EventoController::armaCatalogo($grupo7, $evento->id, 7,4);
            @endphp
        @endif
        @if (!empty($grupo8))
            <h5 class="text-primary">Grupo VIII</h5>
            @php
                EventoController::armaCatalogo($grupo8, $evento->id, 8,4);
            @endphp
        @endif
        @if (!empty($grupo9))
            <h5 class="text-primary">Grupo IX</h5>
            @php
                EventoController::armaCatalogo($grupo9, $evento->id, 9,4);
            @endphp
        @endif
        @if (!empty($grupo10))
            <h5 class="text-primary">Grupo X</h5>
            @php
                EventoController::armaCatalogo($grupo10, $evento->id, 10,4);
            @endphp
        @endif
        @if (!empty($grupo11))
            <h5 class="text-primary">Grupo XI</h5>
            @php
                EventoController::armaCatalogo($grupo11, $evento->id, 11,4);
            @endphp
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
