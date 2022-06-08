@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('metadatos')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')


    {{-- inicio modal calificacion  --}}
    <div class="modal fade" id="modalCalificacionEjmeplar" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CALIFICAION DE <span class="text-info" id="numero_ejemplar"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Calificacion</label>
                            <select name="" id="" class="form-control">
                                <option value="">Excelente</option>
                                <option value="">Muy Bien</option>
                                <option value="">Bien</option>
                                <option value="">Regular</option>
                                <option value="">Descartado</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Ponderacion</label>
                            <select name="" id="" class="form-control">
                                <option value="">1</option>
                                <option value="">2</option>
                                <option value="">3</option>
                                <option value="">4</option>
                                <option value="">5</option>
                                <option value="">6</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info btn-block" onclick="volver()">Volver</button>
                </div>
            </div>
        </div>
    </div>
    {{-- fin inicio modal calificacion --}}

    {{-- inicio modal  --}}
    <div class="modal fade" id="modalCalificacion" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">FORMULARIO DE CALIFICACION</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="ejemplares-categorias">

                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    {{-- fin inicio modal  --}}

    <!--begin::Card-->
	<div class="card card-custom gutter-b">
		<div class="card-header flex-wrap py-3">
			<div class="card-title">
				<h3 class="card-label">CATEGORIAS</h3>
			</div>
			<div class="card-toolbar">

			</div>
		</div>
		<div class="card-body">

            {{-- <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-success btn-block" onclick="califaicarEjemplares()">Calificar</button>
                </div>
            </div> --}}

            <br>
            <div id="accordion">
                <form action="" id="formulario-calificacion">

                    <input type="text" value="{{ $evento->id }}" name="evento_id">

                    @foreach ($arrayEjemplaresTotal as $key => $a)

                        @if(count($a['ejemplares']) > 0)

                            <div class="card">
                                <div class="card-header" id="headingOne{{ $key }}">
                                    <h5 class="mb-0">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <center>
                                                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne{{ $key }}" aria-expanded="false" aria-controls="collapseOne{{ $key }}">
                                                        <h3> {{ $a['grupo'] }}</h3>
                                                    </button>
                                                </center>
                                            </div>
                                        </div>
                                    </h5>
                                </div>
                            
                                <div id="collapseOne{{ $key }}" class="collapse" aria-labelledby="headingOne{{ $key }}" data-parent="#accordion">
                                    <div class="card-body">
                                        @php
                                            $ejemplaresRazas = $a['ejemplares'];
                                        @endphp

                                        <div id="accordionRasas{{ $key }}">

                                            @foreach($ejemplaresRazas as $keyRazas => $razas)

                                                <div class="card">
                                                    <div class="card-header" id="headingOneRazas{{ $keyRazas."_".$key }}">
                                                        <h5 class="mb-0">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <center>
                                                                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOneRazas{{ $keyRazas."_".$key }}" aria-expanded="true" aria-controls="collapseOneRazas{{ $keyRazas."_".$key }}">
                                                                            <h6>
                                                                                <span class="text-info">{{ $razas->raza->nombre." --->".$razas->raza->id }}</span>
                                                                            </h3>
                                                                        </button>
                                                                    </center>
                                                                </div>
                                                            </div>
                                                        </h5>
                                                    </div>
                                            
                                                    <div id="collapseOneRazas{{ $keyRazas."_".$key }}" class="collapse" aria-labelledby="headingOneRazas{{ $keyRazas."_".$key }}" data-parent="#accordionRasas{{ $key }}">
                                                        <div class="card-body">

                                                            @php

                                                                $categoriasRaza = App\Juez::categoriaRaza($evento->id,$razas->raza_id);

                                                                $cantCategoriasRazas = count($categoriasRaza);

                                                                $contadorHembra = 0 ;
                                                                $contadorMacho = 0 ;
                                                                $contador = 0;

                                                                $categoriaHembra = array();
                                                                $categoriaMacho  = array();

                                                                foreach ($categoriasRaza as $cr){

                                                                    if($cr->categoria_pista_id != 1){

                                                                        $dato = array(
                                                                            'nombre'         => $cr->categoriaPista->nombre,
                                                                            'categoria_id'   => $cr->categoria_pista_id
                                                                        );

                                                                        if($cr->categoria_pista_id == 2 || $cr->categoria_pista_id == 4 || $cr->categoria_pista_id == 6 || $cr->categoria_pista_id == 8 || $cr->categoria_pista_id == 10 || $cr->categoria_pista_id == 13 || $cr->categoria_pista_id == 15 || $cr->categoria_pista_id == 17){

                                                                            array_push($categoriaHembra, $dato);

                                                                        }elseif($cr->categoria_pista_id == 1){
                                                                            
                                                                            array_push($categoriaHembra, $dato);
                                                                            array_push($categoriaMacho, $dato);

                                                                        }else{
                                                                            
                                                                            array_push($categoriaMacho, $dato);

                                                                        }
                                                                    }

                                                                }

                                                                $cantCategoriaHembra = count($categoriaHembra);
                                                                $cantCategoriaMacho = count($categoriaMacho);

                                                            @endphp
                                                            <h3 class="text-center text-primary">Machos</h3>

                                                            @while ($contadorMacho < $cantCategoriaMacho)
                                                                <div class="row">
                                                                    @for ($i = 0; $i < 4 ; $i++)
                                                                        @if ($contadorMacho < $cantCategoriaMacho)
                                                                            <div class="col-md-3">
                                                                                <table class="table table-hover text-center">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th class="text-primary">
                                                                                                <button class="btn btn-primary btn-block" type="button" onclick="califaicarEjemplares('{{ $categoriaMacho[$contadorMacho]['categoria_id'] }}' ,'{{ $razas->raza_id }}', '{{ $evento->id }}')">
                                                                                                    {{ $categoriaMacho[$contadorMacho]['nombre']}}
                                                                                                </button>
                                                                                            </th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    @php
                                                                                        $categoria_id       =   $categoriaMacho[$contadorMacho]['categoria_id'];
                                                                                        $raza_id            =   $razas->raza_id;
                                                                                        $evento_id          =   $evento->id;

                                                                                        $ejemplares = App\Juez::EjemplarCatalogoRaza($categoria_id, $raza_id, $evento_id);

                                                                                    @endphp
                                                                                    <tbody>
                                                                                        @foreach ( $ejemplares as $eje)
                                                                                            @if ($eje->sexo == 'Macho')
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <h1 class="text-primary">
                                                                                                            {{ $eje->numero_prefijo }}
                                                                                                        </h1>
                                                                                                    </td>
                                                                                                </tr>    
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            @php
                                                                                $contadorMacho++;
                                                                            @endphp
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                            @endwhile

                                                            <hr class="border-5 bg-dark">

                                                            <h3 class="text-center"  style="color: #F94EE4 ;">Hembras</h3>
                                                            
                                                            @while ($contadorHembra < $cantCategoriaHembra)
                                                                <div class="row">
                                                                    @for ($i = 0; $i < 4 ; $i++)
                                                                        @if ($contadorHembra < $cantCategoriaHembra)
                                                                            <div class="col-md-3">
                                                                                <table class="table table-hover text-center">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th style="color: #F94EE4 ;">
                                                                                                <button type="button" class="btn btn-block" style="background: #F94EE4; color:white;" onclick="califaicarEjemplares('{{ $categoriaHembra[$contadorHembra]['categoria_id'] }}' ,'{{ $razas->raza_id }}', '{{ $evento->id }}')">
                                                                                                    {{ $categoriaHembra[$contadorHembra]['nombre']}}
                                                                                                </button>
                                                                                            </th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    @php
                                                                                        $categoria_id       =   $categoriaHembra[$contadorHembra]['categoria_id'];
                                                                                        $raza_id            =   $razas->raza_id;
                                                                                        $evento_id          =   $evento->id;

                                                                                        $ejemplares = App\Juez::EjemplarCatalogoRaza($categoria_id, $raza_id, $evento_id);

                                                                                    @endphp
                                                                                    <tbody>
                                                                                        @foreach ( $ejemplares as $eje)
                                                                                            @if ($eje->sexo == "Hembra")
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <h1 style="color: #F94EE4;">
                                                                                                            {{ $eje->numero_prefijo }}
                                                                                                        </h1>
                                                                                                    </td>
                                                                                                </tr>    
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            @php
                                                                                $contadorHembra++;
                                                                            @endphp
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                            @endwhile

                                                            {{-- <hr class="border-5 bg-danger">

                                                            @while ($contador < $cantCategoriasRazas)
                                                                <div class="row">
                                                                    @for ($i = 0; $i < 4 ; $i++)
                                                                        @if ($contador < $cantCategoriasRazas)
                                                                            <div class="col-md-3">
                                                                                <table class="table table-hover text-center">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>{{ $categoriasRaza[$contador]->categoriaPista->nombre }}</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    @php

                                                                                        $categoria_id =   $categoriasRaza[$contador]->categoria_pista_id;
                                                                                        $raza_id            =   $razas->raza_id;
                                                                                        $evento_id          =   $evento->id;

                                                                                        $ejemplares = App\Juez::EjemplarCatalogoRaza($categoria_id, $raza_id, $evento_id);

                                                                                    @endphp
                                                                                    <tbody>
                                                                                        @foreach ( $ejemplares as $eje)
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <button class="btn btn-block btn-success" onclick="calificar('{{ $eje->numero_prefijo }}')" type="button">
                                                                                                        {{ $eje->numero_prefijo }}
                                                                                                    </button>
                                                                                                </td>
                                                                                            </tr>    
                                                                                        @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            @php
                                                                                $contador++;
                                                                            @endphp
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                            @endwhile --}}

                                                            <div class="col-lg-4">
                                                                <!--begin::Card-->
                                                                <a href="#" class="card card-custom wave wave-animate-slow bg-grey-100 mb-8 mb-lg-0">
                                                                    
                                                                </a>
                                                                <!--end::Card-->
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach

                                        </div>

                                    </div>
                                </div>
                            </div>    
                        @endif
    
                    @endforeach
                </form>
            </div>
            
		</div>
	</div>
	<!--end::Card-->

@stop

@section('js')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

    <script type="text/javascript">

        $( document ).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        function checkEjemplares(ejmplares){

            console.log($('#'+ejmplares).val());

            var isChecked = document.getElementById(ejmplares).checked;

            if(!isChecked){
                var elementos = document.getElementsByClassName(ejmplares);

                for(var i = 0; i < elementos.length ; i++){
                    $("#"+elementos[i].id).prop('checked', false);
                }    

            }else{

                var elementos = document.getElementsByClassName(ejmplares);

                for(var i = 0; i < elementos.length ; i++){
                    $("#"+elementos[i].id).prop('checked', true);
                }

            }
        }

        function califaicarEjemplares(categoria, raza, evento){

            $.ajax({

                url: "{{ url('Juez/AjaxEjemplarCatalogoRaza') }}",
                data: {
                    categoria: categoria,
                    raza: raza,
                    evento: evento
                },
                type: 'POST',
                dataType: 'json',
                success: function(data) {

                    if(data.status === "success"){

                        $('#ejemplares-categorias').html(data.table)
                        $('#modalCalificacion').modal('show');

                    }else{

                    }

                }

            });

        }

        function calificar(numero){

            $('#numero_ejemplar').text(numero);

            $('#modalCalificacion').modal('hide');
            $('#modalCalificacionEjmeplar').modal('show');

        }

        function volver(){
            
            $('#modalCalificacion').modal('show');
            $('#modalCalificacionEjmeplar').modal('hide');

        }

    </script>
   
@endsection
