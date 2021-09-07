@extends('layouts.app')

@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/jquery.orgchart.css') }}">
@endsection

@section('content')

@php
    use App\Http\Controllers\EjemplarController;
@endphp
{{-- inicio modal  --}}
<!-- Modal-->

{{-- fin inicio modal  --}}

<!--begin::Card-->
<style type="text/css">
    .orgchart { background: white; }
    .orgchart .kennel .title { background-color: #3699FF; };
    .orgchart .kennel .content { border-color: #000000; };
</style>

<div class="card card-custom gutter-b">
    <div class="card-body">
        <!--begin::Details-->
        <div class="d-flex mb-9">
            <!--begin: Pic-->
            <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">

                <img src="{{ asset('assets/media/logoKensi.png') }}" height="110" alt="image">
                <hr/>
                <center>
                    <div id="qrcode"></div>
                </center>
                
            </div>
            <!--end::Pic-->
            <!--begin::Info-->
            <div class="flex-grow-1">
                <!--begin::Title-->
                <div class="d-flex justify-content-between flex-wrap mt-1">
                    <div class="d-flex mr-3">
                        <h2><span class="text-primary">NOMBRE: </span> {{ $ejemplar->nombre_completo }}</h2>
                    </div>
                </div>

                <hr />
                <!--end::Title-->
                <!--begin::Content-->
                <div class="row">
                    <div class="col-md-4">
                        <h6><span class="text-primary">RAZA: </span>
                            @if ($ejemplar->raza_id != null)
                                {{ $ejemplar->raza->nombre }}
                            @endif
                        </h6>
                    </div>

                    <div class="col-md-8">
                        <h6><span class="text-primary">GRUPO: </span>
                            @if ($ejemplar->raza_id != null)
                                {{ $ejemplar->raza->descripcion }}
                            @endif
                        </h6>
                    </div>
                </div>

                <hr />

                <div class="row">
                    <div class="col-md-3">
                        <h6><span class="text-primary">PADRE: </span>
                            @if ($ejemplar->padre_id != null)
                                {{ $ejemplar->padre->nombre }}
                            @endif
                        </h6>
                    </div>
                
                    <div class="col-md-3">
                        <h6><span class="text-primary">MADRE: </span>
                            @if ($ejemplar->madre_id != null)
                                {{ $ejemplar->madre->nombre }}
                            @endif
                        </h6>
                    </div>

                    <div class="col-md-6">
                        <h6><span class="text-primary">PROPIETARIO: </span>
                            @if ($ejemplar->propietario_id != null)
                                {{ $ejemplar->propietario->name }}
                            @endif
                        </h6>
                    </div>
                </div>

                <hr />

                <div class="row">
                    <div class="col-md-3">
                        <h6><span class="text-primary">SEXO: </span> {{ $ejemplar->sexo }}</h6>
                    </div>
                
                    <div class="col-md-3">
                        <h6><span class="text-primary">AFIJO: </span> 
                            @if ($ejemplar->criadero_id != null)
                                {{ $ejemplar->criadero->nombre }}
                            @endif
                        </h6>
                    </div>

                    <div class="col-md-3">
                        <h6><span class="text-primary">COLOR: </span> 
                            {{ $ejemplar->color }}
                        </h6>
                    </div>
                
                    <div class="col-md-3">
                        <h6><span class="text-primary">SEÑAS: </span> {{ $ejemplar->senas }}</h6>
                    </div>
                </div>

                <hr />

                <div class="row">
                    <div class="col-md-3">
                        <h6><span class="text-primary">HERMANOS: </span>
                            {{ $ejemplar->hermanos }}
                        </h6>
                    </div>
                </div>
                <!--end::Content-->
            </div>
            <!--end::Info-->
        </div>
        <!--end::Details-->
        <div class="separator separator-solid"></div>
        <!--begin::Items-->
        <div class="d-flex align-items-center flex-wrap mt-8">
            <!--begin::Item-->
            <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                <span class="mr-4">
                    <i class="icon-xl-3x fas fa-dog"></i>
                </span>
                <div class="d-flex flex-column text-dark-75">
                    <span class="font-weight-bolder font-size-sm text-primary">KCB</span>
                    <span class="font-weight-bolder font-size-h5">
                        <span class="text-dark-50 font-weight-bold"></span>{{ $ejemplar->kcb }}</span>
                </div>
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                <span class="mr-4">
                    <i class="icon-xl-3x fas fa-barcode"></i>
                </span>
                <div class="d-flex flex-column text-dark-75">
                    <span class="font-weight-bolder font-size-sm text-primary">CHIP</span>
                    <span class="font-weight-bolder font-size-h5">
                        <span class="text-dark-50 font-weight-bold"></span>{{ $ejemplar->chip }}</span>
                </div>
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                <span class="mr-4">
                    <i class="icon-xl-3x fas fa-democrat"></i>
                </span>
                <div class="d-flex flex-column text-dark-75">
                    <span class="font-weight-bolder font-size-sm text-primary">TATUAJE</span>
                    <span class="font-weight-bolder font-size-h5">
                        <span class="text-dark-50 font-weight-bold"></span>{{ $ejemplar->num_tatuaje }}</span>
                </div>
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                <span class="mr-4">
                    <i class="icon-xl-3x fas fa-list-alt"></i>
                </span>
                <div class="d-flex flex-column text-dark-75">
                    <span class="font-weight-bolder font-size-sm text-primary">LECHIGADA</span>
                    <span class="font-weight-bolder font-size-h5">
                        <span class="text-dark-50 font-weight-bold"></span>{{ $ejemplar->lechigada }}</span>
                </div>
            </div>
            <!--end::Item-->
            <!--begin::Item-->
            <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                <span class="mr-4">
                    <i class="icon-xl-3x fas fa-calendar-day"></i>
                </span>
                <div class="d-flex flex-column text-dark-75">
                    <span class="font-weight-bolder font-size-sm text-primary">F. NACIMIENTO</span>
                    <span class="font-weight-bolder font-size-h5">
                        <span class="text-dark-50 font-weight-bold"></span>{{ $ejemplar->fecha_nacimiento }}</span>
                </div>
            </div>
            <!--end::Item-->
        </div>
        <!--begin::Items-->
    </div>
</div>


<div class="card card-custom gutter-b">
    <div class="card-header flex-wrap py-3">
        <div class="card-title">
            <h3 class="card-label">
                GENERACIONES 
            </h3>
        </div>
        <div class="card-toolbar">
        </div>
    </div>

    <div class="card-body" id="chart-container" style="height: 320px;">
    </div>
</div>
<!--end::Card-->

@php
    // sacamos las generaciones
    $ejemplarOrigen = App\Ejemplar::find($ejemplar->id);
    // definimos las variables del padre
    $kcbAbuelo = '';
    $nombreAbuelo = '';
    $kcbAbuela = '';
    $nombreAbuela = '';
    $kcbTGPadre = '';
    $nombreTGPadre = '';
    $kcbTGMadre = '';
    $nombreTGMadre = '';
    $kcbCGPadre = '';
    $nombreCGPadre = '';
    $kcbCGMadre = '';
    $nombreCGMadre = '';

    if($ejemplarOrigen->padre_id != null){
        $papa = App\Ejemplar::find($ejemplarOrigen->padre_id);

        $kcbPapa = ($papa)?$papa->kcb:'';
        $nombrePapa = ($papa != null)?$papa->nombre:'';
        
        // preguntamos si el papa tiene padre
        // para sacar al abuelo
        if($papa->padre_id != null){

            $abuelo = App\Ejemplar::find($papa->padre_id);

            $kcbAbuelo = ($abuelo)?$abuelo->kcb:'';
            $nombreAbuelo = ($abuelo != null)?$abuelo->nombre:'';

            // preguntamos si el abuelo tiene padre
            // para sacar al tecera generacion padre
            if($abuelo->padre_id != null){

                $tGPadre = App\Ejemplar::find($abuelo->padre_id);

                $kcbTGPadre = ($tGPadre)?$tGPadre->kcb:'';
                $nombreTGPadre = ($tGPadre != null)?$tGPadre->nombre:'';

                // preguntamos si la tercera generacion tiene padre
                // para sacar al cuarta generacion padre
                if($tGPadre->padre_id != null){

                    $cGPadre = App\Ejemplar::find($tGPadre->padre_id);
                    
                    $kcbCGPadre = ($cGPadre)?$cGPadre->kcb:'';
                    $nombreCGPadre = ($cGPadre != null)?$cGPadre->nombre:'';
                }else{
                    $kcbCGPadre = '';
                    $nombreCGPadre = '';
                }

                // preguntamos si la tercera generacion tiene madre
                // para sacar al cuarta generacion madre
                if($tGPadre->madre_id != null){

                    $cGMadre = App\Ejemplar::find($tGPadre->madre_id);
                    
                    $kcbCGMadre = ($cGMadre)?$cGMadre->kcb:'';
                    $nombreCGMadre = ($cGMadre != null)?$cGMadre->nombre:'';
                }else{
                    $kcbCGMadre = '';
                    $nombreCGMadre = '';
                }

            }else{
                $kcbTGPadre = '';
                $nombreTGPadre = '';
            }

            // preguntamos si el abuelo tiene madre
            // para sacar al tecera generacion madre
            if($abuelo->madre_id != null){

                $tGMadre = App\Ejemplar::find($abuelo->madre_id);

                $kcbTGMadre = ($tGMadre)?$tGMadre->kcb:'';
                $nombreTGMadre = ($tGMadre != null)?$tGMadre->nombre:'';

            }else{
                $kcbtGMadre = '';
                $nombretGMadre = '';
            }

        }else{
            $kcbAbuelo = '';
            $nombreAbuelo = '';
        }

        // preguntamos si el papa tiene madre
        // para sacar al abuela
        if($papa->madre_id != null){

            $abuela = App\Ejemplar::find($papa->madre_id);

            $kcbAbuela = ($abuela)?$abuela->kcb:'';
            $nombreAbuela = ($abuela != null)?$abuela->nombre:'';

        }else{
            $kcbAbuela = '';
            $nombreAbuela = '';
        }

    }else{
        $kcbPapa = '';
        $nombrePapa = '';        
    }
    // definimos las variables de la madre
    $kcbAbueloM = '';
    $nombreAbueloM = '';
    $kcbAbuelaM = '';
    $nombreAbuelaM = '';
    $kcbTGPadreM = '';
    $nombreTGPadreM = '';
    $kcbTGMadreM = '';
    $nombreTGMadreM = '';
    $kcbCGPadreM = '';
    $nombreCGPadreM = '';
    $kcbCGMadreM = '';
    $nombreCGMadreM = '';
    
    $kcbCGPadreM1 = '';
    $nombreCGPadreM1 = '';
    $kcbCGPadreM2 = '';
    $nombreCGPadreM2 = '';
    if($ejemplarOrigen->madre_id != null){
        $mama = App\Ejemplar::find($ejemplarOrigen->madre_id);

        $kcbMama = ($mama != null)?$mama->kcb:'';
        $nombreMama = ($mama != null)?$mama->nombre:'';

        if($mama->padre_id != null){

            $abueloM = App\Ejemplar::find($mama->padre_id);

            $kcbAbueloM     = ($abueloM)? $abueloM->kcb: '';
            $nombreAbueloM  = ($abueloM)? $abueloM->nombre: '';

            if($abueloM->padre_id != null){
                
                $tGPadreM = App\Ejemplar::find($abueloM->padre_id);

                $kcbTGPadreM = ($tGPadreM)?$tGPadreM->kcb:'';
                $nombreTGPadreM = ($tGPadreM)?$tGPadreM->nombre:'';

                if($tGPadreM->padre_id != null){

                    $CGPadreM1 = App\Ejemplar::find($tGPadreM->padre_id);

                    $kcbCGPadreM1 = ($CGPadreM1)?$CGPadreM1->kcb:'';
                    $nombreCGPadreM1 = ($CGPadreM1)?$CGPadreM1->nombre:'';
                }else{
                    $kcbCGPadreM1 = '';
                    $nombreCGPadreM1 = '';
                }
                if($tGPadreM->madre_id != null){

                    $CGPadreM2 = App\Ejemplar::find($tGPadreM->madre_id);

                    $kcbCGPadreM2 = ($CGPadreM2)?$CGPadreM2->kcb:'';
                    $nombreCGPadreM2 = ($CGPadreM2)?$CGPadreM2->nombre:'';
                }else{
                    $kcbCGPadreM2 = '';
                    $nombreCGPadreM2 = '';
                }

            }else{
                $kcbTGPadreM = '';
                $nombreTGPadreM = '';
            }

            if($abueloM->madre_id != null){

                $tGMadreM = App\Ejemplar::find($abueloM->madre_id);

                $kcbTGMadreM = ($tGMadreM)?$tGMadreM->kcb:'';
                $nombreTGMadreM = ($tGMadreM)?$tGMadreM->nombre:'';

                if($tGMadreM->padre_id != null){

                    $CGPadreM = App\Ejemplar::find($tGMadreM->padre_id);

                    $kcbCGPadreM = ($CGPadreM)? $CGPadreM->kcb:'';                   
                    $nombreCGPadreM = ($CGPadreM)? $CGPadreM->nombre:'';                   

                }else{

                    $kcbCGPadreM = '';                   
                    $nombreCGPadreM = '';                   
                }
                if($tGMadreM->madre_id != null){

                    $CGMadreM = App\Ejemplar::find($tGMadreM->madre_id);

                    $kcbCGMadreM = ($CGMadreM)? $CGMadreM->kcb:'';                   
                    $nombreCGMadreM = ($CGMadreM)? $CGMadreM->nombre:'';                   
                }else{
                    $kcbCGMadreM = '';                   
                    $nombreCGPadreM = '';                   
                }
            }else{
                $kcbTGMadreM = '';
                $nombreTGMadreM = '';
            }

        }else{

            $kcbAbueloM     = '';
            $nombreAbueloM  = '';
        }

        if($mama->madre_id != null){

            $abuelaM = App\Ejemplar::find($mama->madre_id);

            $kcbAbuelaM     = ($abuelaM)?$abuelaM->kcb:'';
            $nombreAbuelaM  = ($abuelaM)?$abuelaM->nombre:'';

            // if($abuelaM->padre_id != null){
                
            //     $abuelaM = App\Ejemplar::find($abuelaM->padre_id);

            //     $kcbAbuelaM     = ($abuelaM)?$abuelaM->kcb:'';
            //     $nombreAbuelaM  = ($abuelaM)?$abuelaM->nombre:'';
            // }else{

            // }
        }else{

        }

    }else{
        $kcbMama = '';
        $nombreMama = '';
    }
@endphp
@stop

@section('js')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }} "></script>
<script src="{{ asset('assets/js/qrcode.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.orgchart.min.js') }}"></script>
<script src="{{ asset('assets/js/html2canvas.js') }}"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    (function($){

  $(function() {

    /*
    'children': [
        { 'name': 'Bo Miao', 'title': 'department manager' },
        { 'name': 'Su Miao', 'title': 'department manager',
          'children': [
            { 'name': 'Tie Hua', 'title': 'senior engineer' },
            { 'name': 'Hei Hei', 'title': 'senior engineer' }
          ]
        },
        { 'name': 'Hong Miao', 'title': 'department manager' },
        { 'name': 'Chun Miao', 'title': 'department manager' }
      ]
    */
    var datascource = {
      'name': '{{ $ejemplar->kcb }}',
      'title': '{{ $ejemplar->nombre }}',
      'relationship': { 'children_num': 2 },
      'children': [
        { 'name': '{{ trim($kcbPapa) }}', 'title': '{{ trim($nombrePapa) }}', 'className': 'kennel',
          'children': [
            { 'name': '{{ $kcbAbuelo }}', 'title': '{{ $nombreAbuelo }}', 'className': 'kennel',
                'children': [
                    {'name': '{{ $kcbTGPadre }}', 'title': '{{ trim($nombreTGPadre) }}', 'className': 'kennel',
                        'children': [
                            {'name': '{{ $kcbCGPadre }}', 'title': '{{ trim($nombreCGPadre) }}', 'className': 'kennel'},
                            {'name': '{{ $kcbCGMadre }}', 'title': '{{ trim($nombreCGMadre) }}', 'className': 'kennel'}
                        ],
                    },
                    {'name': '{{ $kcbTGMadre }}', 'title': '{{ trim($nombreTGMadre) }}', 'className': 'kennel'}
                ],
            },
            { 'name': '{{ $kcbAbuela }}', 'title': '{{ trim($nombreAbuela) }}', 'className': 'kennel'}
          ]
        },
        //de aqui comienza las madres
        { 'name': '{{ $kcbMama }}', 'title': '{{ trim($nombreMama) }}', 'className': 'kennel',
            'children':[
                {'name': '{{ $kcbAbueloM }}', 'title': '{{ trim($nombreAbueloM) }}', 'className': 'kennel',
                    'children' : [
                        {'name': '{{ $kcbTGPadreM }}', 'title': '{{ trim($nombreTGPadreM) }}', 'className': 'kennel',
                            'children': [
                                {'name': '{{ $kcbCGPadreM1 }}', 'title': '{{ trim($nombreCGPadreM1) }}', 'className': 'kennel'},
                                {'name': '{{ $kcbCGPadreM2 }}', 'title': '{{ trim($nombreCGPadreM2) }}', 'className': 'kennel'}
                            ],
                        },
                        {'name': '{{ $kcbTGMadreM }}', 'title': '{{ trim($nombreTGMadreM) }}', 'className': 'kennel',
                            'children': [
                                {'name': '{{ $kcbCGPadreM }}', 'title': '{{ trim($nombreCGPadreM) }}', 'className': 'kennel'},
                                {'name': '{{ $kcbCGMadreM }}', 'title': '{{ trim($nombreCGMadreM) }}', 'className': 'kennel'}
                            ],
                        }
                    ],
                },
                {'name': '{{ $kcbAbuelaM }}', 'title': '{{ trim($nombreAbuelaM) }}', 'className': 'kennel'}

            ],
                
        }
      ]
    };

    $('#chart-container').orgchart({
      'data' : datascource,
      'depth': 2,
      'draggable':false,
    //   'parentNodeSymbol':'fa-users',
    //   'pan': true,
    //   'zoom': true,
      'direction': 'l2r',
      'nodeTitle': 'name',
      'nodeContent': 'title',
    //   'nodeID': 'id',
      'createNode': function($node, data) {
        var nodePrompt = $('<i>', {
          'class': 'fa fa-info-circle second-menu-icon',
          click: function() {
            $(this).siblings('.second-menu').toggle();
          }
        });
        var secondMenu = '<div class="second-menu"><img class="avatar" src="img/avatar/' + data.id + '.jpg"></div>';
        // $node.append(nodePrompt).append(secondMenu);
      }
    });

  });

})(jQuery);

    let cadenaQr = "178436029";
		// console.log(cadenaQr);
		var qrcode = new QRCode("qrcode", {
			text: cadenaQr,
			width: 120,
			height: 120,
			colorDark : "#000000",
			colorLight : "#ffffff",
			correctLevel : QRCode.CorrectLevel.H
		});
    
</script>
@endsection