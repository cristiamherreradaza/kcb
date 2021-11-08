{{-- <!DOCTYPE html> --}}
<html lang="es">
<head>
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head><meta charset="UTF-8">
@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection
<style type="text/css">
    @page {
        /* size: landscape; */
        margin: 0;
    }
    body{
        width: 100%;
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
    }
    #certificado{
        /* padding: 15px 20px 0px 160px; */
        padding: 85px 0px 0px 0px;
        width: 80%;
        /* height: 100%; */
    }
    #enlaces a{
        background-color:yellow;
    }
    #datos-ejemplar-1{
        position: absolute;
        top: 95px;
        left: 310px;
        width: 700px;
    }
    #table-datos-1{
        width: 100%;
    }
    .header-datos-ejemplar{
        position: absolute;
        font-size: 25px;
        padding: 0;
        margin: 0;
        color: #0414ff;
        font-weight: bold;
    }
    /* -------------   cabezera    ---------- */
    .header-3{
        width: 380px;
        height: 28px;
        position: absolute;
        top: -10px;
    }
    .header-6{
        position: absolute;
        top: 85px;
        width:140px;
        height: 20px;
    }
    .reg-kcb{
        position: absolute;
        top: 85px;
        width:140px;
        height: 20px;
        left: 535px;
    }
    .header-12{
        position: absolute;
        top: 140px;
        left: 0px;
        /* left: 620px; */
        width: 400px;
        height: 20px;
    }
    .header-1{
        position: absolute;
        top: -9px;
        width:670px;
        height: 28px;
        left: 535px;
    }
    .header-4{
        position: absolute;
        top: 40px;
        left: 535px;
        width:  170px;
        height: 28px;
    }
    .codigo-qr{
        top: 200px;
        left: -170px;
        position: absolute;
    }
    .header-5{
        width:147px;
        height: 25;
        position: absolute;
        top: 40px;
        left: 885px;
    }
    .header-10{
        position: absolute;
        top: 100px;
        left: 885px;
    }
    /* --------- cuerpo  ----------- */
    .principal{
        position: absolute;
        width: 600px;
        height: 60px;
        font-size: 18px;
        left: -100px;
    }
    .principal_1{
        top: 865px;
    }

    .padres{
        position: absolute;
        width: 600px;
        height: 60px;
        font-size: 18px;
        left: 43px;
    }
    .padre_1{
        top: 430px;
    }

    .padre_2{
        top: 1310px;
    }

    .abuelos{
        position: absolute;
        font-size: 12px;
        left: 235px;
        width: 490px;
        height: 60px;
    }
    .abuelo_1{
        top: 210px;
    }
    .abuelo_2{
        top: 655px;
    }
    .abuelo_3{
        top: 1085px;
    }
    .abuelo_4{
        top: 1530px;
    }

    .tercera_generaciones{
        position: absolute;
        font-size: 11px;
        height: 60px;
        width: 490px;
        left: 390px;
    }
    .tg_1{
        top: 112px;
    }
    .tg_2{
        top: 322px;
    }
    .tg_3{
        top: 555px;
    }
    .tg_4{
        top: 768px;
    }
    .tg_5{
        top: 980px;
    }
    .tg_6{
        top: 1195px;
    }
    .tg_7{
        top: 1422px;
    }
    .tg_8{
        top: 1638px;
    }

    .cuarta_generaciones{
        position: absolute;
        width: 490px;
        height: 60px;
        font-size: 11px;
        left: 735px;
    }
    .cg_1{
        /* background-color:black; */
        top: 50px;
    }
    .cg_2{
        top: 175px;
    }
    .cg_3{
        top: 260px;
    }
    .cg_4{
        top: 385px;
    }
    .cg_5{
        top: 493px;
    }
    .cg_6{
        top: 618px;
    }
    .cg_7{
        top: 705px;
    }
    .cg_8{
        top: 830px;
    }
    .cg_9{
        top: 918px;
    }
    .cg_10{
        top: 1043px;
    }
    .cg_11{
        top: 1133px;
    }
    .cg_12{
        top: 1258px;
    }
    .cg_13{
        top: 1360px;
    }
    .cg_14{
        top: 1485px;
    }
    .cg_15{
        top: 1575px;
    }
    .cg_16{
        top: 1700px;
    }


















    
    
    /* .header-2{
        position: absolute;
        top: 30px;
        width:670px;
        height: 28px;
    } */
    /* .criador{
        font-size:16px;
        position: absolute;
        top: 27px;
        left: 450;
    } */
    .header-7{
        position: absolute;
        top: 83px;
        left: 500px;
        font-size: 15px;
        width:  170px;
        height: 22px;
    }
    .header-8{
        position: absolute;
        top: 100px;
        font-size: 16px;

    }
    .header-9{
        position: absolute;
        top: 100px;
        font-size: 16px;
        left: 280px;
    }
    .header-11{
        width: 670px;
        height: 25px;
        position: absolute;
        top: 122px;
    }
    #color{
        position: absolute;
        left: 500px;
        padding: 0px 0px 0px 0px;
        width: 172px;
        background-color:green;
        font-size: 15px;
        opacity: 0.5;
    }
    
    /* #direccion{
        font-size: 14px;
        padding: 10px 0px 7px 0px;
    } */
    /* #telefono{
        padding: 3px 0px 0px 0px;
    } */
    /* #email{
        padding: 0px 0px 0px 60px;
    } */
    /* .afijo{
        position: absolute;
        top: -5px;
        font-size:22px;
        width:350px;
        height: 36px;
    } */
    /* .direccion{
        font-size:15px;
        position: absolute;
        top: 60px;
    }
    .telefonos{
        font-size:17px;
        position: absolute;
        top: 86px;
    }
    .correo{
        font-size:17px;
        position: absolute;
        top: 105px;
        padding: 0px 0px 0px 49px;
    } */
    /* .raza{
        position: absolute;
        color: yellow;
        width:410px;
        opacity: 0.5;


        background-color: red;
        font-size: 17px;
        height: 28px;
    } */
    /* .titulos{
        height: 33px;
    } */
    /* .hermanos{
        width: 670px;
        height: 25px;
    } */
    #datos-ejemplar-2{
        position: absolute;
        top: 86px;
        left: 1050px;
        color: #0414ff;
        font-weight: bold;
        width: 550px;
        padding:0%;
    }
    #arbol-genealogio{
        position: absolute;
        top: 262px;
        left: 220px;
        color: #0414ff;
        font-weight: bold;
        width:1340px;   
        height: 560px;   
    }
    #tabla-genealogio{
        width:100%;
    }
    
    
    
    
   
    

    .lechigada{
        /* background-color: yellowgreen; */
        position: absolute;
        /* width: 200px;
        height: 50px; */
        font-size: 15px;
        top: 760px;
        /* bottom: 155px; */
        left: 570px;
        color: #0414ff;
        font-weight: bold;
    }
    
</style>
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
    
    $kcbTGMadreP1 = '';
    $nombreTGMadreP1 = '';  
    
    $kcbTGMadreM2 = '';
    $nombreTGMadreM2 = '';

    
    $kcbAbueloTG1 = '';
    $nombreAbueloTG1 = '';

    $kcbAbuelaTG1 = '';
    $nombreAbuelaTG1 = '';
   
    $kcbAbueloCG1 = '';
    $nombreAbueloCG1 = '';

    $kcbAbueloCG1M = '';
    $nombreAbueloCG1M = '';

    $kcbAbueloTG1M1 = '';
    $nombreAbueloTG1M1 = '';
    
    $kcbAbuelaTG1M1 = '';
    $nombreAbuelaTG1M1 = '';

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

                if($tGMadre->padre_id != null){

                    $CGMadreP = App\Ejemplar::find($tGMadre->padre_id);

                    $kcbTGMadreP1 = ($CGMadreP)?$CGMadreP->kcb:'';
                    $nombreTGMadreP1 = ($CGMadreP)?$CGMadreP->nombre:'';    
                }else{
                    $kcbTGMadreP1 = '';
                    $nombreTGMadreP1 = '';    
                }

                // para la madre de del atercera generacion
                if($tGMadre->madre_id != null){

                    $CGMadreM2 = App\Ejemplar::find($tGMadre->madre_id);

                    $kcbTGMadreM2 = ($CGMadreM2)?$CGMadreM2->kcb:'';
                    $nombreTGMadreM2 = ($CGMadreM2)?$CGMadreM2->nombre:'';    
                }else{
                    $kcbTGMadreM2 = '';
                    $nombreTGMadreM2 = '';    
                }

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

            if($abuela->padre_id != null){

                $abueloTG = App\Ejemplar::find($abuela->padre_id);

                $kcbAbueloTG1 = ($abueloTG)?$abueloTG->kcb:'';
                $nombreAbueloTG1 = ($abueloTG)?$abueloTG->nombre:'';

                if($abueloTG->padre_id != null){

                    $abueloCG = App\Ejemplar::find($abueloTG->padre_id);

                    $kcbAbueloCG1 = ($abueloCG)?$abueloCG->kcb:'';
                    $nombreAbueloCG1 = ($abueloCG)?$abueloCG->nombre:'';
                }else{
                    $kcbAbueloCG1 = '';
                    $nombreAbueloCG1 = '';
                }

                if($abueloTG->madre_id != null){

                    $abueloCGM = App\Ejemplar::find($abueloTG->madre_id);

                    $kcbAbueloCG1M = ($abueloCGM)?$abueloCGM->kcb:'';
                    $nombreAbueloCG1M = ($abueloCGM)?$abueloCGM->nombre:'';
                }else{
                    $kcbAbueloCG1M = '';
                    $nombreAbueloCG1M = '';
                }
            }else{
                $kcbAbueloTG1 = '';
                $nombreAbueloTG1 = '';
            }

            // hacemos para su mama de la abuela
            if($abuela->madre_id != null){

                $abuelaTG = App\Ejemplar::find($abuela->madre_id);

                $kcbAbuelaTG1 = ($abuelaTG)?$abuelaTG->kcb:'';
                $nombreAbuelaTG1 = ($abuelaTG)?$abuelaTG->nombre:'';

                // aqui hay que hacer para la cuarte generracion tanto como padre y madres
                if($abuelaTG->padre_id != null){

                    $abueloTGM1 = App\Ejemplar::find($abuelaTG->padre_id);

                    $kcbAbueloTG1M1 = ($abueloTGM1)?$abueloTGM1->kcb:'';
                    $nombreAbueloTG1M1 = ($abueloTGM1)?$abueloTGM1->nombre:'';
                }else{
                    $kcbAbueloTG1M1 = '';
                    $nombreAbueloTG1M1 = '';
                }
                if($abuelaTG->madre_id != null){

                    $abuelaTGM1 = App\Ejemplar::find($abuelaTG->madre_id);

                    $kcbAbuelaTG1M1 = ($abuelaTGM1)?$abuelaTGM1->kcb:'';
                    $nombreAbuelaTG1M1 = ($abuelaTGM1)?$abuelaTGM1->nombre:'';
                }else{
                    $kcbAbuelaTG1M1 = '';
                    $nombreAbuelaTG1M1 = '';
                }
            }else{
                $kcbAbuelaTG1 = '';
                $nombreAbuelaTG1 = '';
            }
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
    $kcbabueloMSG  = '' ;
    $nombreabueloMSG  = '' ;
    
    $kcbabueloMSG2  = '' ;
    $nombreabueloMSG2  = '' ;
    
    $kcbabueloMTG1  = '' ;
    $nombreabueloMTG1  = '' ;
    
    $kcbabueloMTG11  = '' ;
    $nombreabueloMTG11  = '' ;
    
    $kcbabueloMSG22  = '' ;
    $nombreabueloMSG22  = '' ;

    $kcbabueloMSG222  = '' ;
    $nombreabueloMSG222  = '' ;
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

            if($abuelaM->padre_id != null){

                $abueloSG   =App\Ejemplar::find($abuelaM->padre_id);

                $kcbabueloMSG  = ($abueloSG)? $abueloSG->kcb:'' ;
                $nombreabueloMSG  = ($abueloSG)? $abueloSG->nombre:'' ;

                if($abueloSG->padre_id){

                    $abueloTG1   =App\Ejemplar::find($abueloSG->padre_id);

                    $kcbabueloMTG1  = ($abueloTG1)? $abueloTG1->kcb:'' ;
                    $nombreabueloMTG1  = ($abueloTG1)? $abueloTG1->nombre:'' ;
                }else{
                    $kcbabueloMTG1  = '' ;
                    $nombreabueloMTG1  = '' ;
                }
                // la madre de la cuarta generacion
                if($abueloSG->madre_id != null){

                    $abueloTG11   =App\Ejemplar::find($abueloSG->madre_id);

                    $kcbabueloMTG11  = ($abueloTG11)? $abueloTG11->kcb:'' ;
                    $nombreabueloMTG11  = ($abueloTG11)? $abueloTG11->nombre:'' ;
                }else{
                    $kcbabueloMTG11  = '' ;
                    $nombreabueloMTG11  = '' ;
                }
            }else{
                $kcbabueloMSG  = '' ;
                $nombreabueloMSG  = '' ;
            }
            // de aqui comienza las madres de la abuela
            if($abuelaM->madre_id != null){

                $abueloSGM2   =App\Ejemplar::find($abuelaM->madre_id);

                $kcbabueloMSG2  = ($abueloSGM2)? $abueloSGM2->kcb:'' ;
                $nombreabueloMSG2  = ($abueloSGM2)? $abueloSGM2->nombre:'' ;

                if($abueloSGM2->padre_id != null){

                    $abueloSGM22   =App\Ejemplar::find($abueloSGM2->padre_id);

                    $kcbabueloMSG22  = ($abueloSGM22)? $abueloSGM22->kcb:'' ;
                    $nombreabueloMSG22  = ($abueloSGM22)? $abueloSGM22->nombre:'' ;
                }else{

                    $kcbabueloMSG22  = '' ;
                    $nombreabueloMSG22  = '' ;  
                }
                if($abueloSGM2->madre_id != null){

                    $abueloSGM222   =App\Ejemplar::find($abueloSGM2->madre_id);

                    $kcbabueloMSG222  = ($abueloSGM222)? $abueloSGM222->kcb:'' ;
                    $nombreabueloMSG222  = ($abueloSGM222)? $abueloSGM222->nombre:'' ;
                }else{
                    $kcbabueloMSG222  = '' ;
                    $nombreabueloMSG222  = '' ;
                }
            }else{
                $kcbabueloMSG2  = '' ;
                $nombreabueloMSG2  = '' ;
            }
        }else{
            $kcbAbuelaM     = '';
            $nombreAbuelaM  = '';
        }

    }else{
        $kcbMama = '';
        $nombreMama = '';
    }
@endphp
<body onload="shrink()">
    <div id="bloque-certificado">
        {{-- <img src="{{ url('img/certificado_1.jpg') }}" width="77%" id="certificado" alt="No hay imagen"> --}}
        <img src="{{ url('img/certificado_3.1.jpg') }}" id="certificado" alt="No hay imagen">
        <div id="datos-ejemplar-1">
            <div class="header-datos-ejemplar">
                <div class="header-1">
                    {{ $ejemplar->nombre_completo }}
                </div>
                {{-- <div class="header-2">
                    @php
                        $titulos = App\TituloEjemplar::where('ejemplar_id',$ejemplar->id)->get();
                        $titulos1 = '';
                        foreach ($titulos as $t){
                            $titulos1= $t->titulo->nombre ;
                        }
                    @endphp
                </div> --}}
                <div class="header-3"><span class="header-3s">{{ strtoupper($ejemplar->raza->nombre) }}</span></div>
                <div class="header-4"><span class="header-4s">{{ $ejemplar->color }}</span></div>
                <div class="header-5">{{ strtoupper($ejemplar->sexo)}}</div>
                <div class="header-6">{{ date('d/m/Y',strtotime($ejemplar->fecha_nacimiento)) }}</div>
                <div class="reg-kcb">{{ ($ejemplar->kcb == 'nulo' || $ejemplar->kcb == '')? $ejemplar->codigo_nacionalizado:"KCB-".$ejemplar->kcb  }}</div>
                {{-- <div class="header-7">{{ ($ejemplar->consanguinidad!=null)? $ejemplar->consanguinidad :'--------'}}</div> --}}
                {{-- <div class="header-8">{{ $ejemplar->kcb }}</div> --}}
                {{-- <div class="header-9">{{ ($ejemplar->num_tatuaje != null)? $ejemplar->num_tatuaje:'--------'}}</div> --}}
                <div class="header-10">{{ $ejemplar->chip }}</div>
                {{-- <div class="header-11">
                    <span class="hermanos1">
                        @php
                            $hermanos = App\Ejemplar::where('camada_id',$ejemplar->camada_id)
                                                    ->whereNotNull('camada_id')
                                                    ->get();
                            $nombres = '';
                            foreach ($hermanos as $h){
                                if($h->id != $ejemplar->id){
                                    $nombres =$nombres.$h->nombre.', ';
                                }
                            }
                        @endphp
                        {{ substr($nombres, 0, -2)}}
                    </span>
                </div> --}}
                <div class="header-12">{{ ($ejemplar->propietario)? $ejemplar->propietario->name : '' }}</div>
                <div class="codigo-qr"><div id="qrcode"></div></div>

            </div>
        </div>
        {{-- <div id="datos-ejemplar-2">
            <div class="datos-secundarios">
                <div class="afijo"> <span class="afijos">{{ ($ejemplar->criadero)? $ejemplar->criadero->nombre." FCI: ".$ejemplar->criadero->registro_fci : '' }}</span></div>
                <div class="criador">{{ ($ejemplar->propietario)? $ejemplar->propietario->name : '' }}</div>
                <div class="direccion">{{ ($ejemplar->propietario)?  $ejemplar->propietario->direccion : ''}}</div>
                <div class="telefonos">{{  ($ejemplar->propietario)? $ejemplar->propietario->celulares : ''}}</div>
                <div class="correo">{{ ($ejemplar->propietario)? $ejemplar->propietario->email :'' }}</div>
                <div class="codigo-qr"><div id="qrcode"></div></div>
            </div>
        </div> --}}

        <div id="arbol-genealogio">
            <section id="bloque-ejemplar-principal">
                <div class="principal_1 principal">
                    <span class="princiaples">
                        @php
                            if(isset($ejemplar)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$ejemplar->id)->count();
                                if($titulosw != 0){
                                    $titulo = App\TituloEjemplar::where('ejemplar_id',$ejemplar->id)->get();
                                    $i = 1;
                                    foreach ($titulo as $t){
                                        if($i <= 5){
                                            echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                            $i++;
                                        }else{
                                            $i = 1;
                                            echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                        }
                                    }
                                    echo "<br>";
                                }
                                echo $ejemplar->nombre_completo." ";
                                if(!($ejemplar->kcb == 'nulo' || $ejemplar->kcb == '')){
                                    echo "K.C.B. ".$ejemplar->kcb." ";
                                }else{
                                    echo $ejemplar->codigo_nacionalizado." ";
                                }
                                if($ejemplar->num_tatuaje != ''){
                                    echo "No. x Raza ".$ejemplar->num_tatuaje."<br>";
                                }
                                if($ejemplar->chip != ''){
                                    echo "Chip ".$ejemplar->chip."<br>";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$ejemplar->id)
                                                                        ->get();
                                foreach ($examenMascotaPapa as $e){
                                    echo $e->examen->nombre.": ".$e->resultado."<br>";
                                }
                                if($ejemplar->color != '0' && $ejemplar->color != '.'){
                                    echo "Color: ".$ejemplar->color;
                                }
                            }
                        @endphp
                    </span>
                </div>
            </section>
            <section id="bloque-padres" >
                <div class="padre_1 padres">
                    <span class="padres1">
                        @php
                            if(isset($papa)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$papa->id)->count();
                                if($titulosw != 0){
                                    $titulo = App\TituloEjemplar::where('ejemplar_id',$papa->id)->get();
                                    $i = 1;
                                    foreach ($titulo as $t){
                                        if($i <= 5){
                                            echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                            $i++;
                                        }else{
                                            $i = 1;
                                            echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                        }
                                    }
                                    echo "<br>";
                                }
                                echo $papa->nombre_completo." ";
                                if(!($papa->kcb == 'nulo' || $papa->kcb == '')){
                                    echo "K.C.B. ".$papa->kcb." ";
                                }else{
                                    echo $papa->codigo_nacionalizado." ";
                                }
                                if($papa->num_tatuaje != ''){
                                    echo "No. x Raza ".$papa->num_tatuaje."<br>";
                                }
                                if($papa->chip != ''){
                                    echo "Chip ".$papa->chip."<br>";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$papa->id)
                                                                        ->get();
                                foreach ($examenMascotaPapa as $e){
                                    echo $e->examen->nombre.": ".$e->resultado."<br>";
                                }
                                if($papa->color != '0' && $papa->color != '.'){
                                    echo "Color: ".$papa->color;
                                }
                            }
                        @endphp
                    </span>
                </div>

                <div class="padre_2 padres">
                    <span class="padres1">
                        @php
                            if(isset($mama)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$mama->id)->count();
                                if($titulosw != 0){
                                    $titulo = App\TituloEjemplar::where('ejemplar_id',$mama->id)->get();
                                    $i = 1;
                                    foreach ($titulo as $t){
                                        if($i <= 5){
                                            echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                            $i++;
                                        }else{
                                            $i = 1;
                                            echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                        }
                                    }
                                    echo "<br>";
                                }
                                echo $mama->nombre_completo." ";
                                if(!($mama->kcb == 'nulo' || $mama->kcb == '')){
                                    echo "K.C.B. ".$mama->kcb." ";
                                }else{
                                    echo $mama->codigo_nacionalizado." ";
                                }
                                if($mama->num_tatuaje != ''){
                                    echo "No. x Raza ".$mama->num_tatuaje."<br>";
                                }
                                if($mama->chip != ''){
                                    echo "Chip ".$mama->chip."<br>";
                                }

                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$mama->id)
                                            ->get();
                                foreach ($examenMascotaPapa as $e){
                                    echo $e->examen->nombre;
                                    echo $e->resultado;
                                }
                                if($mama->color != '0' && $mama->color != '.'){
                                    echo "Color: ".$mama->color;
                                }
                            }
                        @endphp
                    </span>
                </div>
            </section>

            <section id="bloque-abuelos">
                <div class="abuelo_1 abuelos">
                    <span class="abuelos1">
                        @php
                            if(isset($abuelo)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$abuelo->id)->count();
                                if($titulosw != 0){
                                    $titulo = App\TituloEjemplar::where('ejemplar_id',$abuelo->id)->get();
                                    $i = 1;
                                    foreach ($titulo as $t){
                                        if($i <= 4){
                                            echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                            $i++;
                                        }else{
                                            $i = 1;
                                            echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                        }
                                    }
                                    echo "<br>";
                                }
                                echo $abuelo->nombre_completo." ";
                                if(!($abuelo->kcb == 'nulo' || $abuelo->kcb == '')){
                                    echo "K.C.B. ".$abuelo->kcb." ";
                                }else{
                                    echo $abuelo->codigo_nacionalizado." ";
                                }
                                if($abuelo->num_tatuaje != ''){
                                    echo "No. x Raza ".$abuelo->num_tatuaje." ";
                                }
                                if($abuelo->chip != ''){
                                    echo "Chip ".$abuelo->chip."<br>";
                                }

                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$abuelo->id)
                                            ->get();
                                foreach($examenMascotaPapa as $e){
                                    echo $e->examen->nombre.": ".$e->resultado."<br>";
                                }
                                if($abuelo->color != '0' && $abuelo->color != '.'){
                                    echo "Color: ".$abuelo->color;
                                }
                            }
                        @endphp
                    </span>
                </div>

                <div class="abuelo_2 abuelos">
                    <span class="abuelos1">
                        @php
                            if(isset($abuela)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$abuela->id)->count();
                                if($titulosw != 0){
                                    $titulo = App\TituloEjemplar::where('ejemplar_id',$abuela->id)->get();
                                    $i = 1;
                                    foreach ($titulo as $t){
                                        if($i <= 4){
                                            echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                            $i++;
                                        }else{
                                            $i = 1;
                                            echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                        }
                                    }
                                    echo "<br>";
                                }
                                echo $abuela->nombre_completo." ";
                                if(!($abuela->kcb == 'nulo' || $abuela->kcb == '')){
                                    echo "K.C.B. ".$abuela->kcb." ";
                                }else{
                                    echo $abuela->codigo_nacionalizado." ";
                                }
                                if($abuela->num_tatuaje != ''){
                                    echo "No. x Raza ".$abuela->num_tatuaje." ";
                                }
                                if($abuela->chip != ''){
                                    echo "Chip ".$abuela->chip."<br>";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$abuela->id)
                                            ->get();
                                foreach($examenMascotaPapa as $e){
                                    echo $e->examen->nombre.": ".$e->resultado."<br>";
                                }
                                if($abuela->color != '0' && $abuela->color != '.'){
                                    echo "Color: ".$abuela->color;
                                }
                            }
                        @endphp
                    </span>
                </div>

                <div class="abuelo_3 abuelos">
                    <span class="abuelos1">
                        @php
                            if(isset($abueloM)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$abueloM->id)->count();
                                if($titulosw != 0){
                                    $titulo = App\TituloEjemplar::where('ejemplar_id',$abueloM->id)->get();
                                    $i = 1;
                                    foreach ($titulo as $t){
                                        if($i <= 4){
                                            echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                            $i++;
                                        }else{
                                            $i = 1;
                                            echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                        }
                                    }
                                    echo "<br>";
                                }
                                echo $abueloM->nombre_completo." ";
                                if(!($abueloM->kcb == 'nulo' || $abueloM->kcb == '')){
                                    echo "K.C.B. ".$abueloM->kcb." ";
                                }else{
                                    echo $abueloM->codigo_nacionalizado." ";
                                }
                                if($abueloM->num_tatuaje != ''){
                                    echo "No. x Raza ".$abueloM->num_tatuaje." ";
                                }
                                if($abueloM->chip != ''){
                                    echo "Chip ".$abueloM->chip."<br>";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$abueloM->id)
                                            ->get();
                                foreach($examenMascotaPapa as $e){
                                    echo $e->examen->nombre.": ".$e->resultado."<br>";
                                }
                                if($abueloM->color != '0' && $abueloM->color != '.'){
                                    echo "Color: ".$abueloM->color;
                                }
                            }
                        @endphp
                    </span>
                </div>
                <div class="abuelo_4 abuelos">
                    <span class="abuelos1">
                        @php
                            if(isset($abuelaM)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$abuelaM->id)->count();
                                if($titulosw != 0){
                                    $titulo = App\TituloEjemplar::where('ejemplar_id',$abuelaM->id)->get();
                                    $i = 1;
                                    foreach ($titulo as $t){
                                        if($i <= 4){
                                            echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                            $i++;
                                        }else{
                                            $i = 1;
                                            echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                        }
                                    }
                                    echo "<br>";
                                }
                                echo $abuelaM->nombre_completo." ";
                                if(!($abuelaM->kcb == 'nulo' || $abuelaM->kcb == '')){
                                    echo "K.C.B. ".$abuelaM->kcb." ";
                                }else{
                                    echo $abuelaM->codigo_nacionalizado." ";
                                }
                                if($abuelaM->num_tatuaje != ''){
                                    echo "No. x Raza ".$abuelaM->num_tatuaje." ";
                                }
                                if($abuelaM->chip != ''){
                                    echo "Chip ".$abuelaM->chip."<br>";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$abuelaM->id)
                                                                    ->get();
                                foreach($examenMascotaPapa as $e){
                                    echo $e->examen->nombre.": ".$e->resultado."<br>";
                                }
                                if($abuelaM->color != '0' && $abuelaM->color != '.'){
                                    echo "Color: ".$abuelaM->color;
                                }
                            }
                        @endphp
                    </span>
                </div>
            </section>

            <section id="bloque-tg">
                <div  class="tg_1 tercera_generaciones">
                    <span class="tercera_generaciones1">
                        @php
                            if(isset($tGPadre)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$tGPadre->id)->count();
                                if($titulosw != 0){
                                    $titulo = App\TituloEjemplar::where('ejemplar_id',$tGPadre->id)->get();
                                    $i = 1;
                                    foreach ($titulo as $t){
                                        if($i <= 9){
                                            echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                            $i++;
                                        }else{
                                            $i = 1;
                                            echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                        }
                                    }
                                    echo "<br>";
                                }
                                echo $tGPadre->nombre_completo." ";
                                if(!($tGPadre->kcb == 'nulo' || $tGPadre->kcb == '')){
                                    echo "K.C.B. ".$tGPadre->kcb." ";
                                }else{
                                    echo $tGPadre->codigo_nacionalizado." ";
                                }
                                if($tGPadre->num_tatuaje != ''){
                                    echo "No. x Raza ".$tGPadre->num_tatuaje." ";
                                }
                                if($tGPadre->chip != ''){
                                    echo "Chip ".$tGPadre->chip."<br>";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$tGPadre->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                                if($examenMascotaPapa){
                                    $examenPapa = $examenMascotaPapa->examen->nombre;
                                    $resultadoPapa = $examenMascotaPapa->resultado;
                                }else{
                                    $examenPapa = "";
                                    $resultadoPapa = "";
                                }

                                if($examenPapa != ""){
                                    echo $examenPapa." ".$resultadoPapa."<br>";
                                }
                                if($tGPadre->color != '0' && $tGPadre->color != '.'){
                                    echo "Color: ".$tGPadre->color;
                                }
                            }
                        @endphp
                    </span>
                </div>

                <div  class="tg_2 tercera_generaciones">
                    <span class="tercera_generaciones1">
                        @php
                            if(isset($tGMadre)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$tGMadre->id)->count();
                                if($titulosw != 0){
                                    $titulo = App\TituloEjemplar::where('ejemplar_id',$tGMadre->id)->get();
                                    $i = 1;
                                    foreach ($titulo as $t){
                                        if($i <= 9){
                                            echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                            $i++;
                                        }else{
                                            $i = 1;
                                            echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                        }
                                    }
                                    echo "<br>";
                                }
                                echo $tGMadre->nombre_completo." ";
                                if(!($tGMadre->kcb == 'nulo' || $tGMadre->kcb == '')){
                                    echo "K.C.B. ".$tGMadre->kcb." ";
                                }else{
                                    echo $tGMadre->codigo_nacionalizado." ";
                                }
                                if($tGMadre->num_tatuaje != ''){
                                    echo "No. x Raza ".$tGMadre->num_tatuaje." ";
                                }
                                if($tGMadre->chip != ''){
                                    echo "Chip ".$tGMadre->chip."<br>";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$tGMadre->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                                if($examenMascotaPapa){
                                    $examenPapa = $examenMascotaPapa->examen->nombre;
                                    $resultadoPapa = $examenMascotaPapa->resultado;
                                }else{
                                    $examenPapa = "";
                                    $resultadoPapa = "";
                                }

                                if($examenPapa != ""){
                                    echo $examenPapa." ".$resultadoPapa."<br>";
                                }
                                if($tGMadre->color != '0' && $tGMadre->color != '.'){
                                    echo "Color: ".$tGMadre->color;
                                }
                            }
                        @endphp
                    </span>
                </div>

                <div  class="tg_3 tercera_generaciones">
                    <span class="tercera_generaciones1">
                        @php
                            if(isset($abueloTG)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$abueloTG->id)->count();
                                if($titulosw != 0){
                                    $titulo = App\TituloEjemplar::where('ejemplar_id',$abueloTG->id)->get();
                                    $i = 1;
                                    foreach ($titulo as $t){
                                        if($i <= 9){
                                            echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                            $i++;
                                        }else{
                                            $i = 1;
                                            echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                        }
                                    }
                                    echo "<br>";
                                }
                                echo $abueloTG->nombre_completo." ";
                                if(!($abueloTG->kcb == 'nulo' || $abueloTG->kcb == '')){
                                    echo "K.C.B. ".$abueloTG->kcb." ";
                                }else{
                                    echo $abueloTG->codigo_nacionalizado." ";
                                }
                                if($abueloTG->num_tatuaje != ''){
                                    echo "No. x Raza ".$abueloTG->num_tatuaje." ";
                                }
                                if($abueloTG->chip != ''){
                                    echo "Chip ".$abueloTG->chip."<br>";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$abueloTG->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                                if($examenMascotaPapa){
                                    $examenPapa = $examenMascotaPapa->examen->nombre;
                                    $resultadoPapa = $examenMascotaPapa->resultado;
                                }else{
                                    $examenPapa = "";
                                    $resultadoPapa = "";
                                }

                                if($examenPapa != ""){
                                    echo $examenPapa." ".$resultadoPapa."<br>";
                                }
                                if($abueloTG->color != '0' && $abueloTG->color != '.'){
                                    echo "Color: ".$abueloTG->color;
                                }
                            }
                        @endphp
                    </span>
                </div>

                <div  class="tg_4 tercera_generaciones">
                    <span class="tercera_generaciones1">
                        @php
                            if(isset($abuelaTG)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$abuelaTG->id)->count();
                                if($titulosw != 0){
                                    $titulo = App\TituloEjemplar::where('ejemplar_id',$abuelaTG->id)->get();
                                    $i = 1;
                                    foreach ($titulo as $t){
                                        if($i <= 9){
                                            echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                            $i++;
                                        }else{
                                            $i = 1;
                                            echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                        }
                                    }
                                    echo "<br>";
                                }
                                echo $abuelaTG->nombre_completo." ";
                                if(!($abuelaTG->kcb == 'nulo' || $abuelaTG->kcb == '')){
                                    echo "K.C.B. ".$abuelaTG->kcb." ";
                                }else{
                                    echo $abuelaTG->codigo_nacionalizado." ";
                                }
                                if($abuelaTG->num_tatuaje != ''){
                                    echo "No. x Raza ".$abuelaTG->num_tatuaje." ";
                                }
                                if($abuelaTG->chip != ''){
                                    echo "Chip ".$abuelaTG->chip."<br>";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$abuelaTG->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                                if($examenMascotaPapa){
                                    $examenPapa = $examenMascotaPapa->examen->nombre;
                                    $resultadoPapa = $examenMascotaPapa->resultado;
                                }else{
                                    $examenPapa = "";
                                    $resultadoPapa = "";
                                }

                                if($examenPapa != ""){
                                    echo $examenPapa." ".$resultadoPapa."<br>";
                                }
                                if($abuelaTG->color != '0' && $abuelaTG->color != '.'){
                                    echo "Color: ".$abuelaTG->color;
                                }
                            }
                        @endphp
                    </span>
                </div>

                <div class="tg_5 tercera_generaciones">
                    <span class="tercera_generaciones1">
                        @php
                            if(isset($tGPadreM)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$tGPadreM->id)->count();
                                if($titulosw != 0){
                                    $titulo = App\TituloEjemplar::where('ejemplar_id',$tGPadreM->id)->get();
                                    $i = 1;
                                    foreach ($titulo as $t){
                                        if($i <= 9){
                                            echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                            $i++;
                                        }else{
                                            $i = 1;
                                            echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                        }
                                    }
                                    echo "<br>";
                                }
                                echo $tGPadreM->nombre_completo." ";
                                if(!($tGPadreM->kcb == 'nulo' || $tGPadreM->kcb == '')){
                                    echo "K.C.B. ".$tGPadreM->kcb." ";
                                }else{
                                    echo $tGPadreM->codigo_nacionalizado." ";
                                }
                                if($tGPadreM->num_tatuaje != ''){
                                    echo "No. x Raza ".$tGPadreM->num_tatuaje." ";
                                }
                                if($tGPadreM->chip != ''){
                                    echo "Chip ".$tGPadreM->chip."<br>";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$tGPadreM->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                                if($examenMascotaPapa){
                                    $examenPapa = $examenMascotaPapa->examen->nombre;
                                    $resultadoPapa = $examenMascotaPapa->resultado;
                                }else{
                                    $examenPapa = "";
                                    $resultadoPapa = "";
                                }
                                
                                if($examenPapa != ""){
                                    echo $examenPapa." ".$resultadoPapa."<br>";
                                }
                                if($tGPadreM->color != '0' && $tGPadreM->color != '.'){
                                    echo "Color: ".$tGPadreM->color;
                                }
                            }
                        @endphp
                    </span>
                </div>
                <div class="tg_6 tercera_generaciones">
                    <span class="tercera_generaciones1">
                        @php
                            if(isset($tGMadreM)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$tGMadreM->id)->count();
                                if($titulosw != 0){
                                    $titulo = App\TituloEjemplar::where('ejemplar_id',$tGMadreM->id)->get();
                                    $i = 1;
                                    foreach ($titulo as $t){
                                        if($i <= 9){
                                            echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                            $i++;
                                        }else{
                                            $i = 1;
                                            echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                        }
                                    }
                                    echo "<br>";
                                }
                                echo $tGMadreM->nombre_completo." ";
                                if(!($tGMadreM->kcb == 'nulo' || $tGMadreM->kcb == '')){
                                    echo "K.C.B. ".$tGMadreM->kcb." ";
                                }else{
                                    echo $tGMadreM->codigo_nacionalizado." ";
                                }
                                if($tGMadreM->num_tatuaje != ''){
                                    echo "No. x Raza ".$tGMadreM->num_tatuaje." ";
                                }
                                if($tGMadreM->chip != ''){
                                    echo "Chip ".$tGMadreM->chip."<br>";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$tGMadreM->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                                if($examenMascotaPapa){
                                    $examenPapa = $examenMascotaPapa->examen->nombre;
                                    $resultadoPapa = $examenMascotaPapa->resultado;
                                }else{
                                    $examenPapa = "";
                                    $resultadoPapa = "";
                                }
                                
                                if($examenPapa != ""){
                                    echo $examenPapa." ".$resultadoPapa."<br>";
                                }
                                if($tGMadreM->color != '0' && $tGMadreM->color != '.'){
                                    echo "Color: ".$tGMadreM->color;
                                }
                            }
                        @endphp
                    </span>
                </div>
                <div class="tg_7 tercera_generaciones">
                    <span class="tercera_generaciones1">
                        @php
                            if(isset($abueloSG)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$abueloSG->id)->count();
                                if($titulosw != 0){
                                    $titulo = App\TituloEjemplar::where('ejemplar_id',$abueloSG->id)->get();
                                    $i = 1;
                                    foreach ($titulo as $t){
                                        if($i <= 9){
                                            echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                            $i++;
                                        }else{
                                            $i = 1;
                                            echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                        }
                                    }
                                    echo "<br>";
                                }
                                echo $abueloSG->nombre_completo." ";
                                if(!($abueloSG->kcb == 'nulo' || $abueloSG->kcb == '')){
                                    echo "K.C.B. ".$abueloSG->kcb." ";
                                }else{
                                    echo $abueloSG->codigo_nacionalizado." ";
                                }
                                if($abueloSG->num_tatuaje != ''){
                                    echo "No. x Raza ".$abueloSG->num_tatuaje." ";
                                }
                                if($abueloSG->chip != ''){
                                    echo "Chip ".$abueloSG->chip."<br>";
                                }

                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$abueloSG->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                                if($examenMascotaPapa){
                                    $examenPapa = $examenMascotaPapa->examen->nombre;
                                    $resultadoPapa = $examenMascotaPapa->resultado;
                                }else{
                                    $examenPapa = "";
                                    $resultadoPapa = "";
                                }
                                
                                if($examenPapa != ""){
                                    echo $examenPapa." ".$resultadoPapa."<br>";
                                }
                                
                                if($abueloSG->color != '0' && $abueloSG->color != '.'){
                                    echo "Color: ".$abueloSG->color;
                                }
                            }
                        @endphp
                    </span>
                </div>
                <div class="tg_8 tercera_generaciones">
                    <span class="tercera_generaciones1">
                        @php
                            if(isset($abueloSGM2)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$abueloSGM2->id)->count();
                                if($titulosw != 0){
                                    $titulo = App\TituloEjemplar::where('ejemplar_id',$abueloSGM2->id)->get();
                                    $i = 1;
                                    foreach ($titulo as $t){
                                        if($i <= 9){
                                            echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                            $i++;
                                        }else{
                                            $i = 1;
                                            echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                        }
                                    }
                                    echo "<br>";
                                }
                                echo $abueloSGM2->nombre_completo." ";
                                if(!($abueloSGM2->kcb == 'nulo' || $abueloSGM2->kcb == '')){
                                    echo "K.C.B. ".$abueloSGM2->kcb." ";
                                }else{
                                    echo $abueloSGM2->codigo_nacionalizado." ";
                                }
                                if($abueloSGM2->num_tatuaje != ''){
                                    echo "No. x Raza ".$abueloSGM2->num_tatuaje." ";
                                }
                                if($abueloSGM2->chip != ''){
                                    echo "Chip ".$abueloSGM2->chip."<br>";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$abueloSGM2->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                                if($examenMascotaPapa){
                                    $examenPapa = $examenMascotaPapa->examen->nombre;
                                    $resultadoPapa = $examenMascotaPapa->resultado;
                                }else{
                                    $examenPapa = "";
                                    $resultadoPapa = "";
                                }
                                
                                if($examenPapa != ""){
                                    echo $examenPapa." ".$resultadoPapa."<br>";
                                }
                                if($abueloSGM2->color != '0' && $abueloSGM2->color != '.'){
                                    echo "Color: ".$abueloSGM2->color;
                                }
                            }
                        @endphp
                    </span>
                </div>
                
                
            </section>
            
            <section id="bloque-cg">
                <div  class="cg_1 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($cGPadre)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$cGPadre->id)->count();
                                    if($titulosw != 0){
                                        $titulo = App\TituloEjemplar::where('ejemplar_id',$cGPadre->id)->get();
                                        $i = 1;
                                        foreach ($titulo as $t){
                                            if($i <= 12){
                                                echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                                $i++;
                                            }else{
                                                $i = 1;
                                                echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                            }
                                        }
                                        echo "<br>";
                                    }
                                echo $cGPadre->nombre_completo." ";

                                if(!($cGPadre->kcb == 'nulo' || $cGPadre->kcb == '')){
                                    echo "K.C.B. ".$cGPadre->kcb." ";
                                }else{
                                    echo $cGPadre->codigo_nacionalizado."<br>";
                                }
                                if($cGPadre->num_tatuaje != ''){
                                    echo "No. x Raza ".$cGPadre->num_tatuaje." ";
                                }
                                if($cGPadre->chip != ''){
                                    echo "Chip ".$cGPadre->chip." ";
                                }

                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$cGPadre->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                                if($examenMascotaPapa){
                                    $examenPapa = $examenMascotaPapa->examen->nombre;
                                    $resultadoPapa = $examenMascotaPapa->resultado;
                                }else{
                                    $examenPapa = "";
                                    $resultadoPapa = "";
                                }

                                echo $examenPapa." ";
                                echo $resultadoPapa." ";
                                if($cGPadre->color != '0' && $cGPadre->color != '.'){
                                    echo "Color: ".$cGPadre->color." ";
                                }
                            }
                        @endphp
                    </span>
                </div>
                <div  class="cg_2 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($cGMadre)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$cGMadre->id)->count();
                                    if($titulosw != 0){
                                        $titulo = App\TituloEjemplar::where('ejemplar_id',$cGMadre->id)->get();
                                        $i = 1;
                                        foreach ($titulo as $t){
                                            if($i <= 12){
                                                echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                                $i++;
                                            }else{
                                                $i = 1;
                                                echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                            }
                                        }
                                        echo "<br>";
                                    }
                                echo $cGMadre->nombre_completo." ";
                                if(!($cGMadre->kcb == 'nulo' || $cGMadre->kcb == '')){
                                    echo "K.C.B. ".$cGMadre->kcb." ";
                                }else{
                                    echo $cGMadre->codigo_nacionalizado."<br>";
                                }
                                if($cGMadre->num_tatuaje != ''){
                                    echo "No. x Raza ".$cGMadre->num_tatuaje." ";
                                }
                                if($cGMadre->chip != ''){
                                    echo "Chip ".$cGMadre->chip." ";
                                }

                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$cGMadre->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                                if($examenMascotaPapa){
                                    $examenPapa = $examenMascotaPapa->examen->nombre;
                                    $resultadoPapa = $examenMascotaPapa->resultado;
                                }else{
                                    $examenPapa = "";
                                    $resultadoPapa = "";
                                }

                                echo $examenPapa." ";
                                echo $resultadoPapa." ";
                                if($cGMadre->color != '0' && $cGMadre->color != '.'){
                                    echo "Color: ".$cGMadre->color." ";
                                }
                            }
                        @endphp
                    </span>
                </div>

                <div  class="cg_3 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($CGMadreP)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$CGMadreP->id)->count();
                                    if($titulosw != 0){
                                        $titulo = App\TituloEjemplar::where('ejemplar_id',$CGMadreP->id)->get();
                                        $i = 1;
                                        foreach ($titulo as $t){
                                            if($i <= 12){
                                                echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                                $i++;
                                            }else{
                                                $i = 1;
                                                echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                            }
                                        }
                                        echo "<br>";
                                    }
                                echo $CGMadreP->nombre_completo." ";
                                if(!($CGMadreP->kcb == 'nulo' || $CGMadreP->kcb == '')){
                                    echo "K.C.B. ".$CGMadreP->kcb." ";
                                }else{
                                    echo $CGMadreP->codigo_nacionalizado."<br>";
                                }
                                if($CGMadreP->num_tatuaje != ''){
                                    echo "No. x Raza ".$CGMadreP->num_tatuaje." ";
                                }
                                if($CGMadreP->chip != ''){
                                    echo "Chip ".$CGMadreP->chip." ";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$CGMadreP->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                                if($examenMascotaPapa){
                                    $examenPapa = $examenMascotaPapa->examen->nombre;
                                    $resultadoPapa = $examenMascotaPapa->resultado;
                                }else{
                                    $examenPapa = "";
                                    $resultadoPapa = "";
                                }

                                echo $examenPapa." ";
                                echo $resultadoPapa." ";
                                if($CGMadreP->color != '0' && $CGMadreP->color != '.'){
                                    echo "Color: ".$CGMadreP->color." ";
                                }
                            }
                        @endphp
                    </span>
                </div>

                <div  class="cg_4 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($CGMadreM2)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$CGMadreM2->id)->count();
                                    if($titulosw != 0){
                                        $titulo = App\TituloEjemplar::where('ejemplar_id',$CGMadreM2->id)->get();
                                        $i = 1;
                                        foreach ($titulo as $t){
                                            if($i <= 12){
                                                echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                                $i++;
                                            }else{
                                                $i = 1;
                                                echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                            }
                                        }
                                        echo "<br>";
                                    }
                                echo $CGMadreM2->nombre_completo." ";
                                if(!($CGMadreM2->kcb == 'nulo' || $CGMadreM2->kcb == '')){
                                    echo "K.C.B. ".$CGMadreM2->kcb." ";
                                }else{
                                    echo $CGMadreM2->codigo_nacionalizado."<br>";
                                }
                                if($CGMadreM2->num_tatuaje != ''){
                                    echo "No. x Raza ".$CGMadreM2->num_tatuaje." ";
                                }
                                if($CGMadreM2->chip != ''){
                                    echo "Chip ".$CGMadreM2->chip." ";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$CGMadreM2->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                                if($examenMascotaPapa){
                                    $examenPapa = $examenMascotaPapa->examen->nombre;
                                    $resultadoPapa = $examenMascotaPapa->resultado;
                                }else{
                                    $examenPapa = "";
                                    $resultadoPapa = "";
                                }

                                echo $examenPapa." ";
                                echo $resultadoPapa." ";
                                if($CGMadreM2->color != '0' && $CGMadreM2->color != '.'){
                                    echo "Color: ".$CGMadreM2->color." ";
                                }
                            }
                        @endphp
                    </span>
                </div>

                <div  class="cg_5 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($abueloCG)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$abueloCG->id)->count();
                                    if($titulosw != 0){
                                        $titulo = App\TituloEjemplar::where('ejemplar_id',$abueloCG->id)->get();
                                        $i = 1;
                                        foreach ($titulo as $t){
                                            if($i <= 12){
                                                echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                                $i++;
                                            }else{
                                                $i = 1;
                                                echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                            }
                                        }
                                        echo "<br>";
                                    }
                                echo $abueloCG->nombre_completo." ";
                                if(!($abueloCG->kcb == 'nulo' || $abueloCG->kcb == '')){
                                    echo "K.C.B. ".$abueloCG->kcb." ";
                                }else{
                                    echo $abueloCG->codigo_nacionalizado."<br>";
                                }
                                if($abueloCG->num_tatuaje != ''){
                                    echo "No. x Raza ".$abueloCG->num_tatuaje." ";
                                }
                                if($abueloCG->chip != ''){
                                    echo "Chip ".$abueloCG->chip." ";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$abueloCG->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                                if($examenMascotaPapa){
                                    $examenPapa = $examenMascotaPapa->examen->nombre;
                                    $resultadoPapa = $examenMascotaPapa->resultado;
                                }else{
                                    $examenPapa = "";
                                    $resultadoPapa = "";
                                }
            
                                echo $examenPapa." ";
                                echo $resultadoPapa." ";
                                if($abueloCG->color != '0' && $abueloCG->color != '.'){
                                    echo "Color: ".$abueloCG->color." ";
                                }
                            }
                        @endphp
                    </span>
                </div>

                <div  class="cg_6 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($abueloCGM)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$abueloCGM->id)->count();
                                    if($titulosw != 0){
                                        $titulo = App\TituloEjemplar::where('ejemplar_id',$abueloCGM->id)->get();
                                        $i = 1;
                                        foreach ($titulo as $t){
                                            if($i <= 12){
                                                echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                                $i++;
                                            }else{
                                                $i = 1;
                                                echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                            }
                                        }
                                        echo "<br>";
                                    }
                                echo $abueloCGM->nombre_completo." ";
                                if(!($abueloCGM->kcb == 'nulo' || $abueloCGM->kcb == '')){
                                    echo "K.C.B. ".$abueloCGM->kcb." ";
                                }else{
                                    echo $abueloCGM->codigo_nacionalizado."<br>";
                                }
                                if($abueloCGM->num_tatuaje != ''){
                                    echo "No. x Raza ".$abueloCGM->num_tatuaje." ";
                                }
                                if($abueloCGM->chip != ''){
                                    echo "Chip ".$abueloCGM->chip." ";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$abueloCGM->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                                if($examenMascotaPapa){
                                    $examenPapa = $examenMascotaPapa->examen->nombre;
                                    $resultadoPapa = $examenMascotaPapa->resultado;
                                }else{
                                    $examenPapa = "";
                                    $resultadoPapa = "";
                                }

                                echo $examenPapa." ";
                                echo $resultadoPapa." ";
                                if($abueloCGM->color != '0' && $abueloCGM->color != '.'){
                                    echo "Color: ".$abueloCGM->color." ";
                                }
                            }
                        @endphp
                    </span>
                </div>

                <div  class="cg_7 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($abueloTGM1)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$abueloTGM1->id)->count();
                                    if($titulosw != 0){
                                        $titulo = App\TituloEjemplar::where('ejemplar_id',$abueloTGM1->id)->get();
                                        $i = 1;
                                        foreach ($titulo as $t){
                                            if($i <= 12){
                                                echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                                $i++;
                                            }else{
                                                $i = 1;
                                                echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                            }
                                        }
                                        echo "<br>";
                                    }
                                echo $abueloTGM1->nombre_completo." ";
                                if(!($abueloTGM1->kcb == 'nulo' || $abueloTGM1->kcb == '')){
                                    echo "K.C.B. ".$abueloTGM1->kcb." ";
                                }else{
                                    echo $abueloTGM1->codigo_nacionalizado."<br>";
                                }
                                if($abueloTGM1->num_tatuaje != ''){
                                    echo "No. x Raza ".$abueloTGM1->num_tatuaje." ";
                                }
                                if($abueloTGM1->chip != ''){
                                    echo "Chip ".$abueloTGM1->chip." ";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$abueloTGM1->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                                if($examenMascotaPapa){
                                    $examenPapa = $examenMascotaPapa->examen->nombre;
                                    $resultadoPapa = $examenMascotaPapa->resultado;
                                }else{
                                    $examenPapa = "";
                                    $resultadoPapa = "";
                                }

                                echo $examenPapa." ";
                                echo $resultadoPapa." ";
                                if($abueloTGM1->color != '0' && $abueloTGM1->color != '.'){
                                    echo "Color: ".$abueloTGM1->color." ";
                                }
                            }
                        @endphp
                    </span>
                </div>

                <div  class="cg_8 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($abuelaTGM1)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$abuelaTGM1->id)->count();
                                    if($titulosw != 0){
                                        $titulo = App\TituloEjemplar::where('ejemplar_id',$abuelaTGM1->id)->get();
                                        $i = 1;
                                        foreach ($titulo as $t){
                                            if($i <= 12){
                                                echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                                $i++;
                                            }else{
                                                $i = 1;
                                                echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                            }
                                        }
                                        echo "<br>";
                                    }
                                echo $abuelaTGM1->nombre_completo." ";
                                if(!($abuelaTGM1->kcb == 'nulo' || $abuelaTGM1->kcb == '')){
                                    echo "K.C.B. ".$abuelaTGM1->kcb." ";
                                }else{
                                    echo $abuelaTGM1->codigo_nacionalizado."<br>";
                                }
                                if($abuelaTGM1->num_tatuaje != ''){
                                    echo "No. x Raza ".$abuelaTGM1->num_tatuaje." ";
                                }
                                if($abuelaTGM1->chip != ''){
                                    echo "Chip ".$abuelaTGM1->chip." ";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$abuelaTGM1->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                                if($examenMascotaPapa){
                                    $examenPapa = $examenMascotaPapa->examen->nombre;
                                    $resultadoPapa = $examenMascotaPapa->resultado;
                                }else{
                                    $examenPapa = "";
                                    $resultadoPapa = "";
                                }

                                echo $examenPapa." ";
                                echo $resultadoPapa." ";
                                if($abuelaTGM1->color != '0' && $abuelaTGM1->color != '.'){
                                    echo "Color: ".$abuelaTGM1->color." ";
                                }
                            }
                        @endphp
                    </span>
                </div>

                <div  class="cg_9 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($CGPadreM1)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$CGPadreM1->id)->count();
                                    if($titulosw != 0){
                                        $titulo = App\TituloEjemplar::where('ejemplar_id',$CGPadreM1->id)->get();
                                        $i = 1;
                                        foreach ($titulo as $t){
                                            if($i <= 12){
                                                echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                                $i++;
                                            }else{
                                                $i = 1;
                                                echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                            }
                                        }
                                        echo "<br>";
                                    }
                                echo $CGPadreM1->nombre_completo." ";
                                if(!($CGPadreM1->kcb == 'nulo' || $CGPadreM1->kcb == '')){
                                    echo "K.C.B. ".$CGPadreM1->kcb." ";
                                }else{
                                    echo $CGPadreM1->codigo_nacionalizado."<br>";
                                }
                                if($CGPadreM1->num_tatuaje != ''){
                                    echo "No. x Raza ".$CGPadreM1->num_tatuaje." ";
                                }
                                if($CGPadreM1->chip != ''){
                                    echo "Chip ".$CGPadreM1->chip." ";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$CGPadreM1->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                                if($examenMascotaPapa){
                                    $examenPapa = $examenMascotaPapa->examen->nombre;
                                    $resultadoPapa = $examenMascotaPapa->resultado;
                                }else{
                                    $examenPapa = "";
                                    $resultadoPapa = "";
                                }

                                echo $examenPapa." ";
                                echo $resultadoPapa." ";
                                if($CGPadreM1->color != '0' && $CGPadreM1->color != '.'){
                                    echo "Color: ".$CGPadreM1->color." ";
                                }
                            }
                        @endphp
                    </span>
                </div>

                <div  class="cg_10 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($CGPadreM2)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$CGPadreM2->id)->count();
                                    if($titulosw != 0){
                                        $titulo = App\TituloEjemplar::where('ejemplar_id',$CGPadreM2->id)->get();
                                        $i = 1;
                                        foreach ($titulo as $t){
                                            if($i <= 12){
                                                echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                                $i++;
                                            }else{
                                                $i = 1;
                                                echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                            }
                                        }
                                        echo "<br>";
                                    }
                                echo $CGPadreM2->nombre_completo." ";
                                if(!($CGPadreM2->kcb == 'nulo' || $CGPadreM2->kcb == '')){
                                    echo "K.C.B. ".$CGPadreM2->kcb." ";
                                }else{
                                    echo $CGPadreM2->codigo_nacionalizado."<br>";
                                }
                                if($CGPadreM2->num_tatuaje != ''){
                                    echo "No. x Raza ".$CGPadreM2->num_tatuaje." ";
                                }
                                if($CGPadreM2->chip != ''){
                                    echo "Chip ".$CGPadreM2->chip." ";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$CGPadreM2->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                                if($examenMascotaPapa){
                                    $examenPapa = $examenMascotaPapa->examen->nombre;
                                    $resultadoPapa = $examenMascotaPapa->resultado;
                                }else{
                                    $examenPapa = "";
                                    $resultadoPapa = "";
                                }

                                echo $examenPapa." ";
                                echo $resultadoPapa." ";
                                if($CGPadreM2->color != '0' && $CGPadreM2->color != '.'){
                                    echo "Color: ".$CGPadreM2->color." ";
                                }
                            }
                        @endphp
                    </span>
                </div>

                <div class="cg_11 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($CGPadreM)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$CGPadreM->id)->count();
                                    if($titulosw != 0){
                                        $titulo = App\TituloEjemplar::where('ejemplar_id',$CGPadreM->id)->get();
                                        $i = 1;
                                        foreach ($titulo as $t){
                                            if($i <= 12){
                                                echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                                $i++;
                                            }else{
                                                $i = 1;
                                                echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                            }
                                        }
                                        echo "<br>";
                                    }
                                echo $CGPadreM->nombre_completo." ";
                                if(!($CGPadreM->kcb == 'nulo' || $CGPadreM->kcb == '')){
                                    echo "K.C.B. ".$CGPadreM->kcb." ";
                                }else{
                                    echo $CGPadreM->codigo_nacionalizado."<br>";
                                }
                                if($CGPadreM->num_tatuaje != ''){
                                    echo "No. x Raza ".$CGPadreM->num_tatuaje." ";
                                }
                                if($CGPadreM->chip != ''){
                                    echo "Chip ".$CGPadreM->chip." ";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$CGPadreM->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                                if($examenMascotaPapa){
                                    $examenPapa = $examenMascotaPapa->examen->nombre;
                                    $resultadoPapa = $examenMascotaPapa->resultado;
                                }else{
                                    $examenPapa = "";
                                    $resultadoPapa = "";
                                }

                                echo $examenPapa." ";
                                echo $resultadoPapa." ";
                                if($CGPadreM->color != '0' && $CGPadreM->color != '.'){
                                    echo "Color: ".$CGPadreM->color." ";
                                }
                            }
                        @endphp
                    </span>
                </div>
                <div class="cg_12 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($CGMadreM)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$CGMadreM->id)->count();
                                    if($titulosw != 0){
                                        $titulo = App\TituloEjemplar::where('ejemplar_id',$CGMadreM->id)->get();
                                        $i = 1;
                                        foreach ($titulo as $t){
                                            if($i <= 12){
                                                echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                                $i++;
                                            }else{
                                                $i = 1;
                                                echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                            }
                                        }
                                        echo "<br>";
                                    }
                                echo $CGMadreM->nombre_completo." ";
                                if(!($CGMadreM->kcb == 'nulo' || $CGMadreM->kcb == '')){
                                    echo "K.C.B. ".$CGMadreM->kcb." ";
                                }else{
                                    echo $CGMadreM->codigo_nacionalizado."<br>";
                                }
                                if($CGMadreM->num_tatuaje != ''){
                                    echo "No. x Raza ".$CGMadreM->num_tatuaje." ";
                                }
                                if($CGMadreM->chip != ''){
                                    echo "Chip ".$CGMadreM->chip." ";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$CGMadreM->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                                if($examenMascotaPapa){
                                    $examenPapa = $examenMascotaPapa->examen->nombre;
                                    $resultadoPapa = $examenMascotaPapa->resultado;
                                }else{
                                    $examenPapa = "";
                                    $resultadoPapa = "";
                                }

                                echo $examenPapa." ";
                                echo $resultadoPapa." ";
                                if($CGMadreM->color != '0' && $CGMadreM->color != '.'){
                                    echo "Color: ".$CGMadreM->color." ";
                                }
                            }
                        @endphp
                    </span>
                </div>
                <div class="cg_13 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($abueloTG1)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$abueloTG1->id)->count();
                                    if($titulosw != 0){
                                        $titulo = App\TituloEjemplar::where('ejemplar_id',$abueloTG1->id)->get();
                                        $i = 1;
                                        foreach ($titulo as $t){
                                            if($i <= 12){
                                                echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                                $i++;
                                            }else{
                                                $i = 1;
                                                echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                            }
                                        }
                                        echo "<br>";
                                    }
                                echo $abueloTG1->nombre_completo." ";
                                if(!($abueloTG1->kcb == 'nulo' || $abueloTG1->kcb == '')){
                                    echo "K.C.B. ".$abueloTG1->kcb." ";
                                }else{
                                    echo $abueloTG1->codigo_nacionalizado."<br>";
                                }
                                if($abueloTG1->num_tatuaje != ''){
                                    echo "No. x Raza ".$abueloTG1->num_tatuaje." ";
                                }
                                if($abueloTG1->chip != ''){
                                    echo "Chip ".$abueloTG1->chip." ";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$abueloTG1->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                                if($examenMascotaPapa){
                                    $examenPapa = $examenMascotaPapa->examen->nombre;
                                    $resultadoPapa = $examenMascotaPapa->resultado;
                                }else{
                                    $examenPapa = "";
                                    $resultadoPapa = "";
                                }

                                echo $examenPapa." ";
                                echo $resultadoPapa." ";
                                if($abueloTG1->color != '0' && $abueloTG1->color != '.'){
                                    echo "Color: ".$abueloTG1->color." ";
                                }
                            }
                        @endphp
                    </span>
                </div>
                <div class="cg_14 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($abueloTG11)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$abueloTG11->id)->count();
                                    if($titulosw != 0){
                                        $titulo = App\TituloEjemplar::where('ejemplar_id',$abueloTG11->id)->get();
                                        $i = 1;
                                        foreach ($titulo as $t){
                                            if($i <= 12){
                                                echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                                $i++;
                                            }else{
                                                $i = 1;
                                                echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                            }
                                        }
                                        echo "<br>";
                                    }
                                echo $abueloTG11->nombre_completo." ";
                                if(!($abueloTG11->kcb == 'nulo' || $abueloTG11->kcb == '')){
                                    echo "K.C.B. ".$abueloTG11->kcb." ";
                                }else{
                                    echo $abueloTG11->codigo_nacionalizado."<br>";
                                }
                                if($abueloTG11->num_tatuaje != ''){
                                    echo "No. x Raza ".$abueloTG11->num_tatuaje." ";
                                }
                                if($abueloTG11->chip != ''){
                                    echo "Chip ".$abueloTG11->chip." ";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$abueloTG11->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                                if($examenMascotaPapa){
                                    $examenPapa = $examenMascotaPapa->examen->nombre;
                                    $resultadoPapa = $examenMascotaPapa->resultado;
                                }else{
                                    $examenPapa = "";
                                    $resultadoPapa = "";
                                }

                                echo $examenPapa." ";
                                echo $resultadoPapa." ";
                                if($abueloTG11->color != '0' && $abueloTG11->color != '.'){
                                    echo "Color: ".$abueloTG11->color." ";
                                }
                            }
                        @endphp
                    </span>
                </div>
                <div class="cg_15 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($abueloSGM22)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$abueloSGM22->id)->count();
                                    if($titulosw != 0){
                                        $titulo = App\TituloEjemplar::where('ejemplar_id',$abueloSGM22->id)->get();
                                        $i = 1;
                                        foreach ($titulo as $t){
                                            if($i <= 12){
                                                echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                                $i++;
                                            }else{
                                                $i = 1;
                                                echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                            }
                                        }
                                        echo "<br>";
                                    }
                                echo $abueloSGM22->nombre_completo." ";
                                if(!($abueloSGM22->kcb == 'nulo' || $abueloSGM22->kcb == '')){
                                    echo "K.C.B. ".$abueloSGM22->kcb." ";
                                }else{
                                    echo $abueloSGM22->codigo_nacionalizado."<br>";
                                }
                                if($abueloSGM22->num_tatuaje != ''){
                                    echo "No. x Raza ".$abueloSGM22->num_tatuaje." ";
                                }
                                if($abueloSGM22->chip != ''){
                                    echo "Chip ".$abueloSGM22->chip." ";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$abueloSGM22->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                                if($examenMascotaPapa){
                                    $examenPapa = $examenMascotaPapa->examen->nombre;
                                    $resultadoPapa = $examenMascotaPapa->resultado;
                                }else{
                                    $examenPapa = "";
                                    $resultadoPapa = "";
                                }

                                echo $examenPapa." ";
                                echo $resultadoPapa." ";
                                if($abueloSGM22->color != '0' && $abueloSGM22->color != '.'){
                                    echo "Color: ".$abueloSGM22->color." ";
                                }
                            }
                        @endphp
                    </span>
                </div>
                <div class="cg_16 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($abueloSGM222)){
                                $titulosw = App\TituloEjemplar::where('ejemplar_id',$abueloSGM222)->count();
                                    if($titulosw != 0){
                                        $titulo = App\TituloEjemplar::where('ejemplar_id',$abueloSGM222)->get();
                                        $i = 1;
                                        foreach ($titulo as $t){
                                            if($i <= 12){
                                                echo "<span class='text-danger'>".$t->titulo->nombre."</span>";
                                                $i++;
                                            }else{
                                                $i = 1;
                                                echo "<br><span class='text-danger'>".$t->titulo->nombre."</span>";
                                            }
                                        }
                                        echo "<br>";
                                    }
                                echo $abueloSGM222->nombre_completo." ";
                                if(!($abueloSGM222->kcb == 'nulo' || $abueloSGM222->kcb == '')){
                                    echo "K.C.B. ".$abueloSGM222->kcb." ";
                                }else{
                                    echo $abueloSGM222->codigo_nacionalizado."<br>";
                                }
                                if($abueloSGM222->num_tatuaje != ''){
                                    echo "No. x Raza ".$abueloSGM222->num_tatuaje." ";
                                }
                                if($abueloSGM222->chip != ''){
                                    echo "Chip ".$abueloSGM222->chip." ";
                                }
                                $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$abueloSGM222->id)
                                            ->where('examen_id','=',3)
                                            ->first();
                                if($examenMascotaPapa){
                                    $examenPapa = $examenMascotaPapa->examen->nombre;
                                    $resultadoPapa = $examenMascotaPapa->resultado;
                                }else{
                                    $examenPapa = "";
                                    $resultadoPapa = "";
                                }

                                echo $examenPapa." ";
                                echo $resultadoPapa." ";
                                if($abueloSGM222->color != '0' && $abueloSGM222->color != '.'){
                                    echo "Color: ".$abueloSGM222->color." ";
                                }
                            }
                        @endphp
                    </span>
                </div>
            </section>

            
        </div>
        
        {{-- <section id="footer">
            <div class="footer1">
                <div class="lechigada">
                    @php
                        $utilidades = new App\librerias\Utilidades();
                        $fechaHoraEs = $utilidades->fechaNormal($ejemplar->fecha_emision);
                    @endphp
                    {{ $ejemplar->lechigada }} <br>
                    {{ $fechaHoraEs }}
                    
                </div>
                <div class="fecha-emicion">

                </div>
            </div>
        </section> --}}
    </div>
    <div id="enlaces">
        <a href="{{ url('Ejemplar/informacion') }}/{{ $ejemplar->id }}">Volver</a>
        <a href="#" onclick="imprimir()">Imprimir</a>
        <a href="{{ url('Ejemplar/certificadoRosadoAdelante') }}/{{ $ejemplar->id }}">Siguiente</a>
    </div>
    @php
        $input = $ejemplar->nombre_completo;
        setlocale(LC_ALL, "en_US.utf8");
        $output = iconv("utf-8", "ascii//TRANSLIT", $input);
        $output = str_replace("'",'',$output);
        $nombre_ejemplar = $output;
    @endphp
</body>
</html>

<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/qrcode.min.js') }}"></script>


<script type="text/javascript">



    function imprimir(){
        if({{ Auth::user()->id }} == 1){
            $('#certificado').hide();
            $('#enlaces').hide();
            window.print();
            $('#enlaces').show();
            $('#certificado').show();
        }
    }
    
    let cadenaQr = "KCB: {{ $ejemplar->kcb }}\nNombre: {{$nombre_ejemplar}}\nRaza: {{trim($ejemplar->raza->nombre)}}\nN. Tatuaje: {{$ejemplar->num_tatuaje}}\nChip: {{ $ejemplar->chip }}\nSexo: {{ $ejemplar->sexo }}\nF. Nacimeinto: {{ date('d/m/Y' ,strtotime($ejemplar->fecha_nacimiento)) }}\nPagina Web: https://kcb.org.bo/";

    var qrcode = new QRCode("qrcode", {
        text: cadenaQr,
        width: 200,
        height: 200,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.L
    // qrcode.makeCode("cómo es bro");
    });

    // jQuery(document).bind("keyup keydown", function(e){
    //     if(e.ctrlKey && e.keyCode == 80){
    //         Print(); e.preventDefault();
    //     }
    // });
    $(window).keydown(function(event) { 
        if(event.ctrlKey && event.keyCode == 80) { 
            if({{ Auth::user()->id }} == 1){
                var certificado  = document.getElementById("certificado");
                $('#certificado').hide();
                $('#enlaces').hide();
                window.print();
                $('#certificado').show();
                $('#enlaces').show();
                certificado.style.width = "80%";
                // certificado.style.height = "80%";
                event.preventDefault(); 
            }else{
                $('#bloque-certificado').hide();
                $('#enlaces').hide();
                window.print();
                $('#bloque-certificado').show();
                $('#enlaces').show();
                event.preventDefault(); 
            }
        } 
    });

    // padres
    function shrink()
    {


        /*******************  PRINCIPAL  *************************/

        var textDivs = document.getElementsByClassName("principal");
        var textDivsLength = textDivs.length;

        for(var i=0; i<textDivsLength; i++) {

            var textDiv = textDivs[i];

            var textSpan = textDiv.getElementsByClassName("princiaples")[0];

            textSpan.style.fontSize = 18;

            while(textSpan.offsetHeight > textDiv.offsetHeight)
            {
                textSpan.style.fontSize = parseInt(textSpan.style.fontSize) - 1;
            }

            while(textSpan.offsetWidth > textDiv.offsetWidth)
            {
                textSpan.style.fontSize = parseInt(textSpan.style.fontSize) - 1;
            }

        }


        /*******************  PADRES  *************************/

        var textDivs = document.getElementsByClassName("padres");
        var textDivsLength = textDivs.length;
        // console.log(textDivsLength);

        // Recorre todos los divs dinámicos de la página.
        for(var i=0; i<textDivsLength; i++) {

            var textDiv = textDivs[i];

            // Recorre todos los tramos dinámicos dentro del div
            var textSpan = textDiv.getElementsByClassName("padres1")[0];

            // console.log(textSpan);
            // console.log(textSpan.style);
            
            // Use la misma lógica de bucle que antes
            textSpan.style.fontSize = 18;

            // console.log(textSpan.style.fontSize);
            // var i = 1 ;
            // console.log(textSpan.offsetWidth);
            // console.log(textDiv.offsetWidth);
            while(textSpan.offsetHeight > textDiv.offsetHeight)
            {
                textSpan.style.fontSize = parseInt(textSpan.style.fontSize) - 1;
                // i++;
                // console.log(textSpan.style.fontSize);
                // console.log(i);
            }

            while(textSpan.offsetWidth > textDiv.offsetWidth)
            {
                textSpan.style.fontSize = parseInt(textSpan.style.fontSize) - 1;
                // i++;
                // console.log(textSpan.style.fontSize);
                // console.log(i);
            }

        }


        /*******************  ABUELOS  *************************/
        var AbuelotextDivs = document.getElementsByClassName("abuelos");
        var AbuelotextDivsLength = AbuelotextDivs.length;

        for(var i=0; i<AbuelotextDivsLength; i++) {

            var AbuelotextDiv = AbuelotextDivs[i];

            var AbuelotextSpan = AbuelotextDiv.getElementsByClassName("abuelos1")[0];

            AbuelotextSpan.style.fontSize = 18;

            while(AbuelotextSpan.offsetHeight > AbuelotextDiv.offsetHeight)
            {
                AbuelotextSpan.style.fontSize = parseInt(AbuelotextSpan.style.fontSize) - 1;
            }

            while(AbuelotextSpan.offsetWidth > AbuelotextDiv.offsetWidth)
            {
                AbuelotextSpan.style.fontSize = parseInt(AbuelotextSpan.style.fontSize) - 1;
            }

        }


        /*******************  TERCERA GENERACION  *************************/
        var AbuelotextDivs = document.getElementsByClassName("tercera_generaciones");
        var AbuelotextDivsLength = AbuelotextDivs.length;

        for(var i=0; i<AbuelotextDivsLength; i++) {

            var AbuelotextDiv = AbuelotextDivs[i];

            var AbuelotextSpan = AbuelotextDiv.getElementsByClassName("tercera_generaciones1")[0];

            AbuelotextSpan.style.fontSize = 18;

            while(AbuelotextSpan.offsetHeight > AbuelotextDiv.offsetHeight)
            {
                AbuelotextSpan.style.fontSize = parseInt(AbuelotextSpan.style.fontSize) - 1;
            }

            while(AbuelotextSpan.offsetWidth > AbuelotextDiv.offsetWidth)
            {
                AbuelotextSpan.style.fontSize = parseInt(AbuelotextSpan.style.fontSize) - 1;
            }

        }


        /*******************  CUARTA GENERACION  *************************/
        var AbuelotextDivs = document.getElementsByClassName("cuarta_generaciones");
        var AbuelotextDivsLength = AbuelotextDivs.length;

        for(var i=0; i<AbuelotextDivsLength; i++) {

            var AbuelotextDiv = AbuelotextDivs[i];

            var AbuelotextSpan = AbuelotextDiv.getElementsByClassName("cuarta_generaciones1")[0];

            AbuelotextSpan.style.fontSize = 16;

            while(AbuelotextSpan.offsetHeight > AbuelotextDiv.offsetHeight)
            {
                AbuelotextSpan.style.fontSize = parseInt(AbuelotextSpan.style.fontSize) - 1;
            }

            while(AbuelotextSpan.offsetWidth > AbuelotextDiv.offsetWidth)
            {
                AbuelotextSpan.style.fontSize = parseInt(AbuelotextSpan.style.fontSize) - 1;
            }

        }


        /*******************  CUARTA GENERACION  *************************/
        var AbuelotextDivs = document.getElementsByClassName("header-11");
        var AbuelotextDivsLength = AbuelotextDivs.length;

        for(var i=0; i<AbuelotextDivsLength; i++) {

            var AbuelotextDiv = AbuelotextDivs[i];

            var AbuelotextSpan = AbuelotextDiv.getElementsByClassName("hermanos1")[0];

            AbuelotextSpan.style.fontSize = 18;

            while(AbuelotextSpan.offsetHeight > AbuelotextDiv.offsetHeight)
            {
                AbuelotextSpan.style.fontSize = parseInt(AbuelotextSpan.style.fontSize) - 1;
            }

            while(AbuelotextSpan.offsetWidth > AbuelotextDiv.offsetWidth)
            {
                AbuelotextSpan.style.fontSize = parseInt(AbuelotextSpan.style.fontSize) - 1;
            }

        }

        
        /*******************  RAZAS  *************************/
        var AbuelotextDivs = document.getElementsByClassName("header-3");
        var AbuelotextDivsLength = AbuelotextDivs.length;

        for(var i=0; i<AbuelotextDivsLength; i++) {

            var AbuelotextDiv = AbuelotextDivs[i];

            var AbuelotextSpan = AbuelotextDiv.getElementsByClassName("header-3s")[0];

            AbuelotextSpan.style.fontSize = 22;

            while(AbuelotextSpan.offsetHeight > AbuelotextDiv.offsetHeight)
            {
                AbuelotextSpan.style.fontSize = parseInt(AbuelotextSpan.style.fontSize) - 1;
            }

            while(AbuelotextSpan.offsetWidth > AbuelotextDiv.offsetWidth)
            {
                AbuelotextSpan.style.fontSize = parseInt(AbuelotextSpan.style.fontSize) - 1;
            }

        }


        /*******************  color  *************************/
        var AbuelotextDivs = document.getElementsByClassName("header-4");
        var AbuelotextDivsLength = AbuelotextDivs.length;

        for(var i=0; i<AbuelotextDivsLength; i++) {

            var AbuelotextDiv = AbuelotextDivs[i];

            var AbuelotextSpan = AbuelotextDiv.getElementsByClassName("header-4s")[0];

            AbuelotextSpan.style.fontSize = 22;

            while(AbuelotextSpan.offsetHeight > AbuelotextDiv.offsetHeight)
            {
                AbuelotextSpan.style.fontSize = parseInt(AbuelotextSpan.style.fontSize) - 1;
            }

            while(AbuelotextSpan.offsetWidth > AbuelotextDiv.offsetWidth)
            {
                AbuelotextSpan.style.fontSize = parseInt(AbuelotextSpan.style.fontSize) - 1;
            }

        }


        /*******************  AFIJO  *************************/
        var AbuelotextDivs = document.getElementsByClassName("afijo");
        var AbuelotextDivsLength = AbuelotextDivs.length;

        for(var i=0; i<AbuelotextDivsLength; i++) {

            var AbuelotextDiv = AbuelotextDivs[i];

            var AbuelotextSpan = AbuelotextDiv.getElementsByClassName("afijos")[0];

            AbuelotextSpan.style.fontSize = 22;

            while(AbuelotextSpan.offsetHeight > AbuelotextDiv.offsetHeight)
            {
                AbuelotextSpan.style.fontSize = parseInt(AbuelotextSpan.style.fontSize) - 1;
            }

            while(AbuelotextSpan.offsetWidth > AbuelotextDiv.offsetWidth)
            {
                AbuelotextSpan.style.fontSize = parseInt(AbuelotextSpan.style.fontSize) - 1;
            }

        }
    }

    // abuelos
    // function shrink()
    // {
        

    // }
</script>