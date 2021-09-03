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
                        <h6><span class="text-primary">PROPIETARIO: </span> {{ $ejemplar->propietario->name }}</h6>
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

    <div class="card-body">
        @php
            $padres = EjemplarController::consultaPadres($ejemplar->id);
            echo $padres->padre->nombre;
        @endphp        
        <center>
        <div id="chart-container"></div>
        </center>
    </div>
</div>
<!--end::Card-->
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

    var datascource = {
      'id': '1',
      'name': '{{ $ejemplar->kcb }}',
      'title': '{{ $ejemplar->nombre }}',
      'relationship': { 'children_num': 2 },
      'children': [
        { 'id': '2', 'name': 'Bo Miao', 'title': 'department manager', 'relationship': { 'children_num': 0, 'parent_num': 1,'sibling_num': 7 }},
        { 'id': '3', 'name': 'Su Miao', 'title': 'department manager', 'relationship': { 'children_num': 2, 'parent_num': 1,'sibling_num': 7 },
          'children': [
            { 'id': '4', 'name': 'Tie Hua', 'title': 'senior engineer', 'relationship': { 'children_num': 0, 'parent_num': 1,'sibling_num': 1 }},
            { 'id': '5', 'name': 'Hei Hei', 'title': 'senior engineer', 'relationship': { 'children_num': 2, 'parent_num': 1,'sibling_num': 1 },
              'children': [
                { 'id': '6', 'name': 'Pang Pang', 'title': 'engineer', 'relationship': { 'children_num': 0, 'parent_num': 1,'sibling_num': 1 }},
                { 'id': '7', 'name': 'Xiang Xiang', 'title': 'UE engineer', 'relationship': { 'children_num': 0, 'parent_num': 1,'sibling_num': 1 }}
              ]
            }
          ]
        }
        
      ]
    };

    $('#chart-container').orgchart({
      'data' : datascource,
      'depth': 2,
      'nodeTitle': 'name',
      'nodeContent': 'title',
      'nodeID': 'id',
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