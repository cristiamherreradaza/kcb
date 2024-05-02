{{-- <!DOCTYPE html> --}}
@php
    use \App\Http\Controllers\EjemplarController;
@endphp
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
        size: landscape;
        margin: 0;
    }
    body{
        width: 100%;
        margin: 0;
        padding:0;
        /* font-family: Arial, Helvetica, sans-serif; */
        font-family: Tahoma, Helvetica, sans-serif;
    }
    #enlaces a{
        background-color:yellow;
    }
    #datos-ejemplar-1{
        position        : absolute;
        top             : 90px;
        left            : 160px;
        width           : 700px;
        background: rgb(21, 255, 0);
    }
    #table-datos-1{
        width: 100%;
    }
    .header-datos-ejemplar{
        position : absolute;
        font-size: 22px;
        padding  : 0;
        margin   : 0;
            /* color: #0414ff; */
        color           : #000000;
        font-weight     : bold;
        /* background-color: red; */
    }
    .header-1{
        position        : absolute;
        top             : -25px;
        width           : 200px;
        height          : 150px;
        /* background-color: yellow; */
        text-align      : center;
    }
    .header-2{
        position: absolute;
        top: 30px;
        width:670px;
        height: 28px;
    }
    .header-3{
        width   : 410px;
        height  : 28px;
        position: absolute;
        top      : -15px;
        font-size  : 16px;
        margin-left: 250px;
        margin-top : -10px;
        /* background-color:red; */
    }
    .header-4{
        text-align: center;
        /* background-color: red; */
        position : absolute;
        top      : -25px;
        left     : 480px;
        font-size: 15px;
        width    : 170px;
        height   : 28px;
    }
    .header-5{
        width      : 147px;
        height     : 25;
        position   : absolute;
        top        : 5px;
        font-size  : 16;
        margin-left: 250px;
    }
    .header-6{
        position   : absolute;
        top        : 5px;
        left       : 198px;
        width      : 140px;
        height     : 20px;
        font-size  : 16;
        margin-left: 325px;
    }
    .header-7{
        position: absolute;
        top: 81px;
        left: 500px;
        font-size: 15px;
        width:  170px;
        height: 22px;
    }
    .header-8{
        position   : absolute;
        top        : 30px;
        font-size  : 16px;
        margin-left: 280px;
    }
    .header-9{
        position : absolute;
        top      : 30px;
        font-size: 16px;
        left     : 525px;
    }
    .header-10{
        position : absolute;
        top      : -25px;
        font-size: 11px;
        left     : 720px;
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
    #fecha-naciento{
        width: 150px;
    }
    #consagnidad{
        width: 80px;
    }
    #propietario{
        width: 400px;
        font-size: 15px;
        padding: 5px 0px 5px 0px;
    }

    .codigo-qr{
        top     : -25px;
        left    : 345px;
        position: absolute;
    }
    #direccion{
        font-size: 14px;
        padding: 10px 0px 7px 0px;
    }
    #telefono{
        padding: 3px 0px 0px 0px;
    }
    #email{
        padding: 0px 0px 0px 60px;
    }
    .afijo{
        position   : absolute;
        top        : 30px;
        font-size  : 12px;
        width      : 340px;
        height     : 36px;
        /* margin-left: -80px; */
    }
    .criador{
        width : 125px;
        height: 30px;
          /* background-color: red; */
        font-size  : 16px;
        position   : absolute;
        top        : 6px;
        /* margin-left: -80px; */
    }
    .direccion{
        font-size       : 10px;
        position        : absolute;
        top             : 5px;
        /* background-color: rebeccapurple; */
        margin-left     : 180px;
        width           : 150px;
    }
    .telefonos{
        font-size  : 11px;
        position   : absolute;
        top        : -18px;
        margin-left: 210px;
    }
    .correo{
        font-size  : 12px;
        position   : absolute;
        top        : 55px;
        padding    : 0px 0px 0px 49px;
        margin-left: 10px;
    }
    .raza{
        position: absolute;
        color: yellow;
        width:410px;
        opacity: 0.5;


        background-color: red;
        font-size: 17px;
        height: 28px;
    }
    .titulos{
        height: 33px;
    }
    .hermanos{
        width: 670px;
        height: 25px;
    }
    #datos-ejemplar-2{
        position: absolute;
        top: 85px;
        left: 830px;
        color: #000000;
        /* color: #0414ff; */
        font-weight: bold;
        width: 550px;
        padding:0%;
        /* background-color:rgb(9, 255, 0); */
    }
    #arbol-genealogio{
        position: absolute;
        top     : 222px;
        left    : 160px;
        color   : #000000;
          /* color: #0414ff; */
        font-weight: bold;
        width      : 1340px;
        height     : 560px;
    }
    #tabla-genealogio{
        width:100%;
    }
    .padres{
        position : absolute;
        width    : 290px;
        height   : 230px;
        font-size: 18px;
    }
    .padre_1{
        /* background-color:red; */
        top: 10px;
    }

    .padre_2{
        /* background-color:yellow; */

        top: 265px;
    }
    .abuelos{
        position : absolute;
        font-size: 12px;
        left     : 290px;
        width    : 250px;
        height   : 123px;
        
    }
    .abuelo_1{
        top:-3px;
    }
    .abuelo_2{
        top: 133px;
    }
    .abuelo_3{
        top: 270px;
    }
    .abuelo_4{
        top: 407px;
    }
    .tercera_generaciones{
        position : absolute;
        font-size: 11px;
        height   : 60px;
        width    : 280px;
        left     : 570px;
    }
    .tg_1{
        top:0px;
    }
    .tg_2{
        top:68px;
    }

    .tg_3{
        top:133px;
    }
    .tg_4{
        top:205px;
    }
    .tg_5{
        top: 270px;
    }
    .tg_6{
        top:340px;
    }
    .tg_7{
        top:407px;
    }
    .tg_8{
        top:479px;
    }
    
    .cuarta_generaciones{
          /* background-color: yellowgreen; */
        position : absolute;
        width    : 400px;
        height   : 30px;
        font-size: 11px;
          /* padding:0;
        margin: 0; */
        left  : 860px;
          /* word-wrap: break-word; */
    }
    .cg_1{
        top: -10px;
    }
    .cg_2{
        top: 25px;
    }
    .cg_3{
        top: 63px;
    }
    .cg_4{
        top: 93px;
    }
    .cg_5{
        top: 130px;
    }
    .cg_6{
        top: 164px;
    }
    .cg_7{
        top: 200px;
    }
    .cg_8{
        top: 235px;
    }
    .cg_9{
        top: 270px;
    }
    .cg_10{
        top: 303px;
    }
    .cg_11{
        top: 340px;
    }
    .cg_12{
        top: 372px;
    }
    .cg_13{
        top: 407px;
    }
    .cg_14{
        top: 440px;
    }
    .cg_15{
        top: 475px;
    }
    .cg_16{
        top: 510px;
    }
    #certificado{
        padding: 15px 20px 0px 160px;
        width: 85%;
    }

    .lechigada{
        /* background-color: yellowgreen; */
        position: absolute;
        /* width: 200px;
        height: 50px; */
        font-size: 15px;
        top: 775px;
        /* bottom: 155px; */
        left: 570px;
        color: #000000;
        /* color: #0414ff; */
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

                if($tGMadre){
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
        <img src="{{ url('img/certificado_1_new.jpg') }}" id="certificado" alt="No hay imagen">
        <div id="datos-ejemplar-1">
            <div class="header-datos-ejemplar">
                <div class="header-1">
                    {{ $ejemplar->nombre_completo }}
                </div>
                <div class="header-2">
                    @php
                        $titulos = App\TituloEjemplar::where('ejemplar_id',$ejemplar->id)->get();
                        $titulos1 = '';
                        foreach ($titulos as $t){
                            $titulos1= $t->titulo->nombre ;
                        }
                    @endphp
                </div>
                <div class="header-3"><span class="header-3s">{{ strtoupper($ejemplar->raza->nombre) }}</span></div>
                <div class="header-4">
                    <span class="header-4s">
                        {{ $ejemplar->color }}

                        @php
                            if($ejemplar->senas != ''){
                                echo "<br>".$ejemplar->senas;
                            }
                        @endphp
                    </span>
                </div>
                <div class="header-5">{{ strtoupper($ejemplar->sexo)}}</div>
                <div class="header-6">{{ date('d/m/Y',strtotime($ejemplar->fecha_nacimiento)) }}</div>
                {{-- <div class="header-7">{{ ($ejemplar->consanguinidad!=null)? $ejemplar->consanguinidad :'--------'}}</div> --}}
                <div class="header-8">{{ $ejemplar->kcb }}</div>
                <div class="header-9">{{ ($ejemplar->num_tatuaje != null)? $ejemplar->num_tatuaje:'--------'}}</div>
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
            </div>
        </div>

        <div id="datos-ejemplar-2">
            <div class="datos-secundarios">
                <div class="afijo"> <span class="afijos">{{ ($ejemplar->criadero)? $ejemplar->criadero->nombre." FCI: ".$ejemplar->criadero->registro_fci : '' }}</span></div>
                @php
                    $propietarioCriadero  = App\PropietarioCriadero::where('criadero_id', $ejemplar->criadero->id)->first();
                @endphp
                <div class="criador"><span class="criadors">{{ ($propietarioCriadero)? (($propietarioCriadero->propietario)? $propietarioCriadero->propietario->name : '') : '' }}</span></div>
                <div class="direccion">{{ ($ejemplar->propietario)?  $ejemplar->propietario->direccion : ''}}</div>
                <div class="telefonos">{{  ($ejemplar->propietario)? $ejemplar->propietario->celulares : ''}}</div>
                <div class="correo">{{ ($ejemplar->propietario)? $ejemplar->propietario->email :'' }}</div>
                <div class="codigo-qr"><div id="qrcode"></div></div>
            </div>
        </div>
        <div id="arbol-genealogio">
            <section id="bloque-padres" >
                <div class="padre_1 padres">
                    <span class="padres1">
                        @php
                            if(isset($papa)){
                                EjemplarController::armaEjemplarCertificado($papa,1);
                            }
                        @endphp
                    </span>
                </div>

                <div class="padre_2 padres">
                    <span class="padres1">
                        @php
                            if(isset($mama)){
                                EjemplarController::armaEjemplarCertificado($mama,1);
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
                                EjemplarController::armaEjemplarCertificado($abuelo,2);
                            }
                        @endphp
                    </span>
                </div>

                <div class="abuelo_2 abuelos">
                    <span class="abuelos1">
                        @php
                            if(isset($abuela)){
                                EjemplarController::armaEjemplarCertificado($abuela,2);
                            }
                        @endphp
                    </span>
                </div>

                <div class="abuelo_3 abuelos">
                    <span class="abuelos1">
                        @php
                            if(isset($abueloM)){
                                EjemplarController::armaEjemplarCertificado($abueloM,2);
                            }
                        @endphp
                    </span>
                </div>
                <div class="abuelo_4 abuelos">
                    <span class="abuelos1">
                        @php
                            if(isset($abuelaM)){
                                EjemplarController::armaEjemplarCertificado($abuelaM,2);
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
                                EjemplarController::armaEjemplarCertificado($tGPadre,3);
                            }
                        @endphp
                    </span>
                </div>

                <div  class="tg_2 tercera_generaciones">
                    <span class="tercera_generaciones1">
                        @php
                            if(isset($tGMadre)){
                                EjemplarController::armaEjemplarCertificado($tGMadre,3);
                            }
                        @endphp
                    </span>
                </div>

                <div  class="tg_3 tercera_generaciones">
                    <span class="tercera_generaciones1">
                        @php
                            if(isset($abueloTG)){
                                EjemplarController::armaEjemplarCertificado($abueloTG,3);
                            }
                        @endphp
                    </span>
                </div>

                <div  class="tg_4 tercera_generaciones">
                    <span class="tercera_generaciones1">
                        @php
                            if(isset($abuelaTG)){
                                EjemplarController::armaEjemplarCertificado($abuelaTG,3);
                            }
                        @endphp
                    </span>
                </div>

                <div class="tg_5 tercera_generaciones">
                    <span class="tercera_generaciones1">
                        @php
                            if(isset($tGPadreM)){
                                EjemplarController::armaEjemplarCertificado($tGPadreM,3);
                            }
                        @endphp
                    </span>
                </div>
                <div class="tg_6 tercera_generaciones">
                    <span class="tercera_generaciones1">
                        @php
                            if(isset($tGMadreM)){
                                EjemplarController::armaEjemplarCertificado($tGMadreM,3);
                            }
                        @endphp
                    </span>
                </div>
                <div class="tg_7 tercera_generaciones">
                    <span class="tercera_generaciones1">
                        @php
                            if(isset($abueloSG)){
                                EjemplarController::armaEjemplarCertificado($abueloSG,3);
                            }
                        @endphp
                    </span>
                </div>
                <div class="tg_8 tercera_generaciones">
                    <span class="tercera_generaciones1">
                        @php
                            if(isset($abueloSGM2)){
                                EjemplarController::armaEjemplarCertificado($abueloSGM2,3);
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
                                EjemplarController::armaEjemplarCertificado($cGPadre,4);
                            }
                        @endphp
                    </span>
                </div>
                <div  class="cg_2 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($cGMadre)){
                                EjemplarController::armaEjemplarCertificado($cGMadre,4);
                            }
                        @endphp
                    </span>
                </div>

                <div  class="cg_3 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($CGMadreP)){
                                EjemplarController::armaEjemplarCertificado($CGMadreP,4);
                            }
                        @endphp
                    </span>
                </div>

                <div  class="cg_4 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($CGMadreM2)){
                                EjemplarController::armaEjemplarCertificado($CGMadreM2,4);
                            }
                        @endphp
                    </span>
                </div>

                <div  class="cg_5 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($abueloCG)){
                                EjemplarController::armaEjemplarCertificado($abueloCG,4);
                            }
                        @endphp
                    </span>
                </div>

                <div  class="cg_6 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($abueloCGM)){
                                EjemplarController::armaEjemplarCertificado($abueloCGM,4);
                            }
                        @endphp
                    </span>
                </div>

                <div  class="cg_7 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($abueloTGM1)){
                                EjemplarController::armaEjemplarCertificado($abueloTGM1,4);
                            }
                        @endphp
                    </span>
                </div>

                <div  class="cg_8 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($abuelaTGM1)){
                                EjemplarController::armaEjemplarCertificado($abuelaTGM1,4);
                            }
                        @endphp
                    </span>
                </div>

                <div  class="cg_9 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($CGPadreM1)){
                                EjemplarController::armaEjemplarCertificado($CGPadreM1,4);
                            }
                        @endphp
                    </span>
                </div>

                <div  class="cg_10 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($CGPadreM2)){
                                EjemplarController::armaEjemplarCertificado($CGPadreM2,4);
                            }
                        @endphp
                    </span>
                </div>

                <div class="cg_11 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($CGPadreM)){
                                EjemplarController::armaEjemplarCertificado($CGPadreM,4);
                            }
                        @endphp
                    </span>
                </div>
                <div class="cg_12 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($CGMadreM)){
                                EjemplarController::armaEjemplarCertificado($CGMadreM,4);
                            }
                        @endphp
                    </span>
                </div>
                <div class="cg_13 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($abueloTG1)){
                                EjemplarController::armaEjemplarCertificado($abueloTG1,4);
                            }
                        @endphp
                    </span>
                </div>
                <div class="cg_14 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($abueloTG11)){
                                EjemplarController::armaEjemplarCertificado($abueloTG11,4);
                            }
                        @endphp
                    </span>
                </div>
                <div class="cg_15 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($abueloSGM22)){
                                EjemplarController::armaEjemplarCertificado($abueloSGM22,4);
                            }
                        @endphp
                    </span>
                </div>
                <div class="cg_16 cuarta_generaciones">
                    <span class="cuarta_generaciones1">
                        @php
                            if(isset($abueloSGM222)){
                                EjemplarController::armaEjemplarCertificado($abueloSGM222,4);
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
        // NOMBRE DEL EJEMPLAR
        $cadenalimpia = preg_replace("[\n|\r|\n\r]", "", $ejemplar->nombre_completo);

        // $input = $ejemplar->nombre_completo;
        $input = $cadenalimpia;
        setlocale(LC_ALL, "en_US.utf8");
        $output = iconv("utf-8", "ascii//TRANSLIT", $input);
        $output = str_replace("'",'',$output);
        $nombre_ejemplar = $output;

        // NOMBRE DE LA RAZA
        $input = trim($ejemplar->raza->nombre);
        setlocale(LC_ALL, "en_US.utf8");
        $output = iconv("utf-8", "ascii//TRANSLIT", $input);
        $output = str_replace("'",'',$output);
        $nombre_raza = $output;

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
    
    let cadenaQr = "KCB: {{ $ejemplar->kcb }}\nNombre: {{$nombre_ejemplar}}\nRaza: {{$nombre_raza}}\nN. Tatuaje: {{$ejemplar->num_tatuaje}}\nChip: {{ $ejemplar->chip }}\nSexo: {{ $ejemplar->sexo }}\nF. Nacimeinto: {{ date('d/m/Y' ,strtotime($ejemplar->fecha_nacimiento)) }}\nPagina Web: https://kcb.org.bo/";

    var qrcode = new QRCode("qrcode", {
        text        : cadenaQr,
        width       : 100,
        height      : 100,
        colorDark   : "#000000",
        colorLight  : "#ffffff",
        correctLevel: QRCode.CorrectLevel.L
    });


    $(window).keydown(function(event) { 
        if(event.ctrlKey && event.keyCode == 80) { 
            if({{ Auth::user()->id }} == 1){
                var certificado  = document.getElementById("certificado");
                $('#certificado').hide();
                $('#enlaces').hide();
                window.print();
                $('#certificado').show();
                $('#enlaces').show();
                certificado.style.width = "85%";
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
        /*******************  PADRES  *************************/

        var textDivs = document.getElementsByClassName("padres");
        var textDivsLength = textDivs.length;

        // Recorre todos los divs dinámicos de la página.
        for(var i=0; i<textDivsLength; i++) {

            var textDiv = textDivs[i];

            // Recorre todos los tramos dinámicos dentro del div
            var textSpan = textDiv.getElementsByClassName("padres1")[0];

            // Use la misma lógica de bucle que antes
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


        /*******************  ABUELOS  *************************/
        var AbuelotextDivs = document.getElementsByClassName("abuelos");
        var AbuelotextDivsLength = AbuelotextDivs.length;

        for(var i=0; i<AbuelotextDivsLength; i++) {

            var AbuelotextDiv = AbuelotextDivs[i];

            var AbuelotextSpan = AbuelotextDiv.getElementsByClassName("abuelos1")[0];

            AbuelotextSpan.style.fontSize = 12;

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

            AbuelotextSpan.style.fontSize = 11;

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

            AbuelotextSpan.style.fontSize = 11;

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


        /*******************  color  *************************/
        var AbuelotextDivs = document.getElementsByClassName("header-4");
        var AbuelotextDivsLength = AbuelotextDivs.length;

        for(var i=0; i<AbuelotextDivsLength; i++) {

            var AbuelotextDiv = AbuelotextDivs[i];

            var AbuelotextSpan = AbuelotextDiv.getElementsByClassName("header-4s")[0];

            AbuelotextSpan.style.fontSize = 15;

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


        /*******************  AFIJO  *************************/
        var AbuelotextDivs = document.getElementsByClassName("criador");
        var AbuelotextDivsLength = AbuelotextDivs.length;

        for(var i=0; i<AbuelotextDivsLength; i++) {

            var AbuelotextDiv = AbuelotextDivs[i];

            var AbuelotextSpan = AbuelotextDiv.getElementsByClassName("criadors")[0];

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
    }
</script>
