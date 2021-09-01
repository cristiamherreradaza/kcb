@extends('layouts.app')

@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')
{{-- inicio modal  --}}
<!-- Modal-->

{{-- fin inicio modal  --}}

<!--begin::Card-->

<div class="row">
    <div class="col-xl-4">
        <!--begin::Engage Widget 9-->
        <div class="card card-custom card-stretch gutter-b">
            <div class="card-body d-flex p-0">
                <div class="flex-grow-1 p-20 pb-40 card-rounded flex-grow-1 bgi-no-repeat"
                    style="background-color: #1B283F; background-position: calc(100% + 0.5rem) bottom; background-size: 50% auto; background-image: url(assets/media/svg/humans/custom-10.svg)">
                    <h2 class="text-white pb-5 font-weight-bolder">NOMBRE: {{ $ejemplar->nombre_completo }}</h2>

                    <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                        <span class="mr-4">
                            <i class="icon-xl-2x fas fa-clipboard-list"></i>
                        </span>
                        <div class="d-flex flex-column text-white">
                            <span class="font-weight-bolder font-size-sm"><span class="text-primary">KCB</span></span>
                            <span class="font-weight-bolder font-size-h5">
                                <span class="text-dark-50 font-weight-bold"></span>{{ $ejemplar->kcb }}</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                        <span class="mr-4">
                            <i class="icon-xl-2x fas fa-clipboard-list"></i>
                        </span>
                        <div class="d-flex flex-column text-white">
                            <span class="font-weight-bolder font-size-sm"><span class="text-primary">TATUAJE</span></span>
                            <span class="font-weight-bolder font-size-h5">
                                <span class="text-dark-50 font-weight-bold"></span>{{ $ejemplar->num_tatuaje }}</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                        <span class="mr-4">
                            <i class="icon-xl-2x fas fa-clipboard-list"></i>
                        </span>
                        <div class="d-flex flex-column text-white">
                            <span class="font-weight-bolder font-size-sm"><span class="text-primary">CHIP</span></span>
                            <span class="font-weight-bolder font-size-h5">
                                <span class="text-dark-50 font-weight-bold"></span>{{ $ejemplar->chip }}</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--end::Engage Widget 9-->
    </div>
    <div class="col-md-9"></div>
</div>


<div class="card card-custom gutter-b">
    <div class="card-header flex-wrap py-3">
        <div class="card-title">
            <h3 class="card-label">
                <span class="text-primary">NOMBRE: </span>{{ $ejemplar->nombre }} 
            </h3>
        </div>
        <div class="card-toolbar">
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                    <span class="mr-4">
                        <i class="icon-xl-3x fas fa-clipboard-list"></i>
                    </span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bolder font-size-sm"><span class="text-primary">RAZA</span></span>
                        <span class="font-weight-bolder font-size-h5">
                            <span class="text-dark-50 font-weight-bold"></span>{{ $ejemplar->raza->nombre }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                    <span class="mr-4">
                        <i class="icon-xl-3x fas fa-clipboard-list"></i>
                    </span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bolder font-size-sm"><span class="text-primary">GRUPO</span></span>
                        <span class="font-weight-bolder font-size-h5">
                            <span class="text-dark-50 font-weight-bold"></span>{{ $ejemplar->raza->descripcion }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                    <span class="mr-4">
                        <i class="icon-xl-3x fas fa-dog"></i>
                    </span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bolder font-size-sm"><span class="text-primary">PADRE</span></span>
                        <span class="font-weight-bolder font-size-h5">
                            <span class="text-dark-50 font-weight-bold"></span>{{ $ejemplar->padre['nombre'] }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                    <span class="mr-4">
                        <i class="icon-xl-3x fas fa-dog"></i>
                    </span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bolder font-size-sm"><span class="text-primary">MADRE</span></span>
                        <span class="font-weight-bolder font-size-h5">
                            <span class="text-dark-50 font-weight-bold"></span>{{ $ejemplar->madre['nombre'] }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                    <span class="mr-4">
                        <i class="icon-xl-3x fas fa-user-alt"></i>
                    </span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bolder font-size-sm"><span class="text-primary">PROPIETARIO</span></span>
                        <span class="font-weight-bolder font-size-h5">
                            <span class="text-dark-50 font-weight-bold"></span>{{ $ejemplar->propietario['name'] }}</span>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                    <span class="mr-4">
                        <i class="icon-xl-3x fas fa-dog"></i>
                    </span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bolder font-size-sm"><span class="text-primary">PADRE</span></span>
                        <span class="font-weight-bolder font-size-h5">
                            <span class="text-dark-50 font-weight-bold"></span>{{ $ejemplar->padre['nombre'] }}</span>
                    </div>
                </div>
            </div>
        
            <div class="col-md-4">
                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                    <span class="mr-4">
                        <i class="icon-xl-3x fas fa-dog"></i>
                    </span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bolder font-size-sm"><span class="text-primary">MADRE</span></span>
                        <span class="font-weight-bolder font-size-h5">
                            <span class="text-dark-50 font-weight-bold"></span>{{ $ejemplar->madre['nombre'] }}</span>
                    </div>
                </div>
            </div>
        
            <div class="col-md-4">
                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                    <span class="mr-4">
                        <i class="icon-xl-3x fas fa-user-alt"></i>
                    </span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bolder font-size-sm"><span class="text-primary">PROPIETARIO</span></span>
                        <span class="font-weight-bolder font-size-h5">
                            <span class="text-dark-50 font-weight-bold"></span>{{ $ejemplar->propietario['name'] }}</span>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</div>
<!--end::Card-->
@stop

@section('js')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }} "></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endsection