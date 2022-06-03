@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('metadatos')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')



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
                    <div class="row">
                        <div class="col-md-12">

                            
                            <div class="card card-custom card-stretch card-stretch-half gutter-b">
                                <div class="card-body p-0">
                                    <div class="align-items-center justify-content-between card-spacer flex-grow-1">
                                        <span class="symbol symbol-50 symbol-light-success mr-2">
                                            <span class="symbol-label">
                                                <span class="svg-icon svg-icon-xl svg-icon-success">
                                                    <h1 class="text-dark">1E</h1>
                                                </span>
                                            </span>
                                        </span>

                                        <span class="symbol symbol-50 symbol-light-success mr-2">
                                            <span class="symbol-label">
                                                <span class="svg-icon svg-icon-xl svg-icon-success">
                                                    <h1 class="text-dark">1E</h1>
                                                </span>
                                            </span>
                                        </span>

                                        <span class="symbol symbol-50 symbol-light-success mr-2">
                                            <span class="symbol-label">
                                                <span class="svg-icon svg-icon-xl svg-icon-success">
                                                    <h1 class="text-dark">1E</h1>
                                                </span>
                                            </span>
                                        </span>

                                        <span class="symbol symbol-50 symbol-light-success mr-2">
                                            <span class="symbol-label">
                                                <span class="svg-icon svg-icon-xl svg-icon-success">
                                                    <h1 class="text-dark">1E</h1>
                                                </span>
                                            </span>
                                        </span>

                                    </div>
                                </div>
                            </div>

                        </div>
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

            {{--  @dd($arrayEjemplaresTotal)  --}}


            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-success btn-block" onclick="califaicarEjemplares()">Calificar</button>
                </div>
            </div>

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
                                            {{--  <div class="col-md-1">

                                            </div>  --}}
                                            <div class="col-md-12">
                                                <center>
                                                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne{{ $key }}" aria-expanded="false" aria-controls="collapseOne{{ $key }}">
                                                        <h4> {{ $a['grupo'] }}</h4>
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
                                                                            <span class="text-info">{{ $razas->raza->nombre }}</span>
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

                                                                $contador = 0 ;
                                                            @endphp

                                                            @while ($contador < $cantCategoriasRazas)
                                                                <div class="row">
                                                                    @for ($i = 0; $i < 4 ; $i++)
                                                                        @if ($contador < $cantCategoriasRazas)
                                                                            <div class="col-lg-3">
                                                                                
                                                                                <a href="#" onclick="califaicarEjemplares()" class="card card-custom wave wave-animate-slow bg-grey-100 mb-8 mb-lg-0">
                                                                                    <!--begin::Card Body-->
                                                                                    <div class="card-body">
                                                                                        <div class="d-flex align-items-center p-6">
                                                                                            <div class="d-flex flex-column">
                                                                                                <h6 class="text-dark h6 mb-3">{{ $categoriasRaza[$contador]->categoriaPista->nombre }}</h6>
                                                                                            </div>
                                                                                            <!--end::Content-->
                                                                                        </div>
                                                                                    </div>
                                                                                    <!--end::Card Body-->
                                                                                </a>

                                                                            </div>
                                                                            @php
                                                                                $contador++;
                                                                            @endphp
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                            @endwhile

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

        function califaicarEjemplares(){

            $('#modalCalificacion').modal('show');

            {{--  if ($('input[type=checkbox]:checked').length==0){
                
                Swal.fire(
                    "Alerta!",
                    "Debe sellecionar al menos un grupo.",
                    "warning",
                )
                    
            }else{
                var dato = $('#formulario-calificacion').serialize();

                $.ajax({
                    url: "{{ url('Juez/AjaxPlanillaCalificacion') }}",
                    data: dato,
                    type: 'POST',
                    dataType: 'json',
                    success: function(data) {

                        $('#formulario_calificaion').html(data.formulario)

                        console.log(data.formulario)

                        $('#modalCalificacion').modal('show');

                    }
                });
            }  --}}

            
        }

    </script>
   
@endsection
