@extends('layouts.app')

@section('content')
<!--Begin::Row-->
@php
        // $propietarios = App\User::where('perfil_id',4)->count();


        // $ejemplares = App\Ejemplar::all()->count();



        // $ejemplaresRegistrados = DB::table('ejemplares')
        //                         ->select('ejemplares.created_at')
        //                         ->groupBy('ejemplares.raza_id')
        //                         ->get();

        // $registrosEjemplares = array();

        // for($i = 1 ; $i <= 12 ; $i++){

        //     $inidate = date("Y")."-".(($i<=9)? '0'.$i : $i )."-01";
        //     $findate = date("Y")."-".(($i<=9)? '0'.$i : $i )."-".cal_days_in_month(CAL_GREGORIAN, (($i<=9)? '0'.$i : $i ) , date("Y"));

        //     $cantiodadREgistroMes = App\Ejemplar::whereBetween('created_at',["$inidate","$findate"])
        //                             ->count(); 

        //     array_push($registrosEjemplares, $cantiodadREgistroMes);

        // }

        // $usuariosDona = array();

        // $criador = App\User::where('tipo', 'Criador')->count();
        // array_push($usuariosDona, $criador);

        // $socio = App\User::where('tipo', 'Socio')->count();
        // array_push($usuariosDona, $socio);
        
        // $indefinido = App\User::whereNull('tipo')->count();
        // array_push($usuariosDona, $indefinido);

        // $ejemplarExNa = array();

        // $ejemplaresNacionales = App\Ejemplar::whereNotNull('kcb')->count();
        // array_push($ejemplarExNa, $ejemplaresNacionales);

        // $ejemplaresExtranjeros = App\Ejemplar::whereNull('kcb')->count();
        // array_push($ejemplarExNa, $ejemplaresExtranjeros);
@endphp
<div class="row">
    <div class="col-xl-4">
        <!--begin::Stats Widget 22-->
        <div class="card card-custom bgi-no-repeat card-stretch gutter-b"
            style="background-position: right top; background-size: 30% auto; background-image: url(assets/media/svg/shapes/abstract-3.svg)">
            <!--begin::Body-->
            <div class="card-body my-4">
                <a href="#"
                    class="card-title font-weight-bolder text-info font-size-h6 mb-4 text-hover-state-dark d-block">PROPIETARIOS</a>
                <div class="font-weight-bold text-muted font-size-sm">
                    {{-- <span class="text-dark-75 font-weight-bolder font-size-h2 mr-2">{{ $propietarios }}</span>Registrados --}}
                </div>
                <div class="progress progress-xs mt-7 bg-info-o-60">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 22%;" aria-valuenow="50"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 22-->
    </div>
    <div class="col-xl-4">
        <!--begin::Stats Widget 23-->
        <div class="card card-custom bg-info card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body my-4">
                <a href="#"
                    class="card-title font-weight-bolder text-white font-size-h6 mb-4 text-hover-state-dark d-block">Usuarios</a>
                <div class="font-weight-bold text-white font-size-sm">
                    <span class="font-size-h2 mr-2">1</span>Registrado
                </div>
                <div class="progress progress-xs mt-7 bg-white-o-90">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 87%;" aria-valuenow="50"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 23-->
    </div>
    <div class="col-xl-4">
        <!--begin::Stats Widget 24-->
        <div class="card card-custom bg-dark card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body my-4">
                <a href="#"
                    class="card-title font-weight-bolder text-white font-size-h6 mb-4 text-hover-state-dark d-block">Ejemplares</a>
                <div class="font-weight-bold text-white font-size-sm">
                    {{-- <span class="font-size-h2 mr-2">{{ $ejemplares }}</span>Registrados --}}
                </div>
                <div class="progress progress-xs mt-7 bg-white-o-90">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 52%;" aria-valuenow="50"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats: Widget 24-->
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    {{-- <h3 class="card-label">Registro de Ejemplares de la gestion {{ date('Y') }}</h3> --}}
                </div>
            </div>
            <div class="card-body">
                <!--begin::Chart-->
                <div id="chart" class="d-flex justify-content-center"></div>
                <!--end::Chart-->
            </div>
        </div>
        <!--end::Card-->
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">Procentaje de Ejemplares Nacionales y Extranjeros</h3>
                </div>
            </div>
            <div class="card-body">
                <!--begin::Chart-->
                <div id="chart_1" class="d-flex justify-content-center"></div>
                <!--end::Chart-->
            </div>
        </div>
        <!--end::Card-->
    </div>

    <div class="col-lg-6">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">Usuarios Registrados por Tipo</h3>
                </div>
            </div>
            <div class="card-body">
                <!--begin::Chart-->
                <div id="chart_2" class="d-flex justify-content-center"></div>
                <!--end::Chart-->
            </div>
        </div>
        <!--end::Card-->
    </div>
</div>
<!--End::Row-->
@stop

@section('js')
    {{-- <script src="{{ asset('assets/js/pages/features/charts/apexcharts.js') }}"></script> --}}
    {{-- <script>
      const $array1;
      $array1 = @json($registrosEjemplares);
      console.log($array1);

      for($i=0; $i < $array1.length ; $i++){
        console.log($array1[$i]);
      }
      // grafico de barras
        var options = {
          series: [{
          name: 'Ejemplares',
          // data: [5000, 3, 4, 10, 4, 5, 3, 2, 1, 3, 5, 2] //valores del grafico
          // data: ['50', 3, 4, 10, 4, 5, 3, 2, 1, 3, 5, 2] //valores del grafico
          data: @json($registrosEjemplares) //valores del grafico

        }],
          chart: {
          height: 350,
          type: 'bar',
        },
        plotOptions: {
          bar: {
            borderRadius: 10,
            dataLabels: {
              position: 'top', // top, center, bottom
            },
          }
        },
        dataLabels: {
          enabled: true,
          formatter: function (val) {
            return val + "";
          },
          offsetY: -20,
          style: {
            fontSize: '12px',
            colors: ["#304758"]
          }
        },
        
        xaxis: {
          categories: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
          position: 'top',
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          crosshairs: {
            fill: {
              type: 'gradient',
              gradient: {
                colorFrom: '#D8E3F0',
                colorTo: '#BED1E6',
                stops: [0, 100],
                opacityFrom: 0.4,
                opacityTo: 0.5,
              }
            }
          },
          tooltip: {
            enabled: true,
          }
        },
        yaxis: {
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false,
          },
          labels: {
            show: false,
            formatter: function (val) {
              return val + "";
            }
          }
        
        },
        title: {
          text: 'Cantidad de ejemplares registrados de esta gestion',
          floating: true,
          offsetY: 330,
          align: 'center',
          style: {
            color: '#444'
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        // grafico pie
        var options = {
          // series: [44, 55],
          series: @json($ejemplarExNa),
          chart: {
          width: 480,
          type: 'pie',
        },
        labels: ['Ejemplares Nacionales', 'Ejemplares Extranjeros'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#chart_1"), options);
        chart.render();

        // grafico dona
         var options = {
          // series: [44, 55,10],
          series: @json($usuariosDona),
          chart: {
          width: 480,
          type: 'donut',
        },
        labels: ['Criador', 'Socio', 'indefinido'],	
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#chart_2"), options);
        chart.render();
    
    </script> --}}
@endsection