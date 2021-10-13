<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection
<style>

    /* @page port {size: portrait;} */
    @page {
        /* size: 21cm 29.7cm; */
    /* margin: 30mm 45mm 30mm 45mm; */
        size: landscape;
        /* size:A4; */
        margin: 0;
    }

    /* .portrait {page: port;}

    .landscape {page: land;} */
    body{
        width: 100%;
        margin: 0;
    }
    .certificado{
        /* width: 100%;
        background-color: red; */
        /* height: 100%; */
    }
    #bloque-certificado{
        /* width: 70%;  */
        /* display:flex; */
        /* position: relative;
        display: inline-block;
        text-align: center; */
        /* background-color:red; */
        /* margin-top: 100px; */
    }
    #enlaces a{
        /* left: 100px; */
        /* right: 500px; */
        background-color:yellow;
    }
    /* #table-datos{
        height: 100px;
    } */
    #datos-ejemplar-1{
        position: absolute;
        top: 65px;
        left: 140px;
        color: #0414ff;
        font-weight: bold;
        width: 700px;
        /* padding:0%; */
    }
    #table-datos-1{
        width: 100%;
    }
    #color{
        width: 150px;
    }
    #fecha-naciento{
        width: 100px;
    }
    #consagnidad{
        width: 80px;
    }
    #propietario{
        width: 400px;
        font-size: 15px;
        /* padding: 5px; */
        padding: 5px 0px 5px 0px;
    }
    #direccion{
        /* padding: 5px; */
        padding: 5px 0px 5px 0px;
    }
    #telefono{
        padding: 3px 0px 3px 0px;
    }
    #email{
        padding: 3px 0px 3px 60px;
    }
    table tr td{
        border: solid 1px #000000;
        text-align: left;
    }
    td{
        /* height: 10px; */
        /* padding: 5px; */
        /* margin */
        font-size: 13px;
        padding: 0;
        margin: 0;
    }
    .impor-1{
        font-size: 22px;
    }
    #datos-ejemplar-2{
        position: absolute;
        top: 65px;
        left: 910px;
        color: #0414ff;
        font-weight: bold;
        width: 550px;
        /* height: 500px; */
        padding:0%;
    }
    #arbol-genealogio{
        position: absolute;
        top: 270px;
        left: 80px;
        color: #0414ff;
        font-weight: bold;
        /* background-color:red; */
        /* opacity: 0.8; */
        width:1340px;   
        height: 560px;   
    }
    #tabla-genealogio{
        width:100%;
    }

    #padre_1{
        position: absolute;
        /* background-color:red; */
        width:275px;
        font-size: 18px;
        /* height: 10px; */

    }

    #padre_2{
        position: absolute;
        top: 300px;
        /* background-color:red; */
        width:275px;
        font-size: 18px;
        /* height: 10px; */

    }
    #abuelo_1{
        position: absolute;
        left: 280px;
        width:287px;
        font-size: 12px;
        height: 135px;
    }
    #abuelo_2{
        position: absolute;
        left: 280px;
        top: 135px;
        width:287px;
        font-size: 12px;
        height: 135px;
    }
    #abuelo_3{
        position: absolute;
        top: 280px;
        left: 280px;
        width:287px;
        font-size: 12px;
        height: 135px;
    }
    #abuelo_4{
        position: absolute;
        left: 280px;
        top: 425px;
        width:287px;
        font-size: 12px;
        height: 135px;
    }
    #tg_1{
        position: absolute;
        left: 570px;
        /* background-color:orange; */
        width:329px;
        font-size: 11px;
        height: 60px;

    }
    #tg_2{
        position: absolute;
        left: 570px;
        top:63px;
        /* background-color:orange; */
        width:329px;
        font-size: 11px;
        height: 60px;
    }

    #tg_3{
        position: absolute;
        left: 570px;
        top:135px;
        /* background-color:orange; */
        width:329px;
        font-size: 11px;
        height: 60px;
    }
    #tg_4{
        position: absolute;
        left: 570px;
        top:210px;
        /* background-color:orange; */
        width:329px;
        font-size: 11px;
        height: 60px;
    }

    #tg_5{
        position: absolute;
        left: 570px;
        top: 280px;
        /* background-color:orange; */
        width:329px;
        font-size: 11px;
        height: 60px;

    }
    #tg_6{
        position: absolute;
        left: 570px;
        top:350px;
        /* background-color:orange; */
        width:329px;
        font-size: 11px;
        height: 60px;
    }

    #tg_7{
        position: absolute;
        left: 570px;
        top:423px;
        /* background-color:orange; */
        width:329px;
        font-size: 11px;
        height: 60px;
    }
    #tg_8{
        position: absolute;
        left: 570px;
        top:495px;
        /* background-color:orange; */
        width:329px;
        font-size: 11px;
        height: 60px;
    }
    #cg_1{
        position: absolute;
        left: 900px;
        /* background-color:yellow; */
        padding:0;
        /* padding: 0px 0px 0px 0px; */
        /* height: 10px; */
        font-size: 12px;
        margin: 0;
        word-wrap: break-word;
    }
    #cg_2{
        position: absolute;
        left: 900px;
        top: 40px;
        /* background-color:yellow; */
        padding:0;
        /* padding: 0px 0px 0px 0px; */
        /* height: 10px; */
        font-size: 12px;
        margin: 0;
        word-wrap: break-word;
    }
    #cg_3{
        
        position: absolute;
        left: 900px;
        top: 70px;
        padding:0;
        font-size: 12px;
        margin: 0;
        word-wrap: break-word;
    }
    #cg_4{
        
        position: absolute;
        left: 900px;
        top: 105px;
        padding:0;
        font-size: 12px;
        margin: 0;
        word-wrap: break-word;
    }
    #cg_5{
        
        position: absolute;
        left: 900px;
        top: 140px;
        padding:0;
        font-size: 12px;
        margin: 0;
        word-wrap: break-word;
    }
    #cg_6{
        
        position: absolute;
        left: 900px;
        top: 175px;
        padding:0;
        font-size: 12px;
        margin: 0;
        word-wrap: break-word;
    }

    #cg_7{
        
        position: absolute;
        left: 900px;
        top: 215px;
        padding:0;
        font-size: 12px;
        margin: 0;
        word-wrap: break-word;
    }

    #cg_8{
        
        position: absolute;
        left: 900px;
        top: 250px;
        padding:0;
        font-size: 12px;
        margin: 0;
        word-wrap: break-word;
    }

    #cg_9{
        
        position: absolute;
        left: 900px;
        top: 285px;
        padding:0;
        font-size: 12px;
        margin: 0;
        word-wrap: break-word;
    }
    #cg_10{
        
        position: absolute;
        left: 900px;
        top: 320px;
        padding:0;
        font-size: 12px;
        margin: 0;
        word-wrap: break-word;
    }
    #cg_11{
        
        position: absolute;
        left: 900px;
        top: 355px;
        padding:0;
        font-size: 12px;
        margin: 0;
        word-wrap: break-word;
    }
    #cg_12{
        
        position: absolute;
        left: 900px;
        top: 390px;
        padding:0;
        font-size: 12px;
        margin: 0;
        word-wrap: break-word;
    }
    #cg_13{
        position: absolute;
        left: 900px;
        top: 430px;
        padding:0;
        font-size: 12px;
        margin: 0;
        word-wrap: break-word;
    }
    #cg_14{
        position: absolute;
        left: 900px;
        top: 465px;
        padding:0;
        font-size: 12px;
        margin: 0;
        word-wrap: break-word;
    }
    #cg_15{
        position: absolute;
        left: 900px;
        top: 490px;
        padding:0;
        font-size: 12px;
        margin: 0;
        word-wrap: break-word;
    }
    #cg_16{
        position: absolute;
        left: 900px;
        top: 520px;
        padding:0;
        font-size: 12px;
        margin: 0;
        word-wrap: break-word;
    }
    /* #contenedor-abuelo_1{
        height: 100%;
        background-color:pink;
        word-wrap: break-word;

    } */
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
<body>
    <div id="bloque-certificado">
        <img src="{{ url('img/certificado.jpg') }}" width="77%" id="certificado" alt="No hay imagen">
        <div id="datos-ejemplar-1">
            <table id="table-datos-1" cellspacing="0">
                <tr>
                    <td class="impor-1" colspan="5">{{ $ejemplar->nombre_completo }}</td>
                </tr>
                <tr>
                    <td class="impor-1" colspan="5">
                        @php
                            $titulos = App\TituloEjemplar::where('ejemplar_id',$ejemplar->id)->get();
                            foreach ($titulos as $t){
                                echo $t->titulo->nombre ;
                            }
                        @endphp
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="impor-1">{{ $ejemplar->raza->nombre }}</td>
                    <td id="color">{{ $ejemplar->color }}</td>
                </tr>
                <tr>
                    <td>{{ $ejemplar->sexo }}</td>
                    <td id="fecha-naciento"></td>
                    <td>{{ $ejemplar->fecha_nacimiento }}</td>
                    <td id="consagnidad"></td>
                    <td>{{ ($ejemplar->consanguinidad!=null)? $ejemplar->consanguinidad :'--------'}}</td>
                </tr>
                <tr>
                    <td>{{ $ejemplar->kcb }}</td>
                    <td id="fecha-naciento"></td>
                    <td>{{ ($ejemplar->num_tatuaje != null)? $ejemplar->num_tatuaje:'--------'}}</td>
                    <td id="consagnidad"></td>
                    <td>{{ $ejemplar->chip }}</td>
                </tr>
                <tr>
                    <td colspan="5">{{ $ejemplar->hermano }}</td>
                </tr>
            </table>
        </div>
        <div id="datos-ejemplar-2">
            <table id="table-datos-2">
                <tr>
                    <td colspan="2" class="impor-1">{{ $ejemplar->criadero->nombre }}</td>
                    <td rowspan="5"> <div id="qrcode"></div></td>
                </tr>
                <tr>
                    <td colspan="2"  id="propietario">{{ $ejemplar->propietario->name }}</td>
                </tr>
                <tr>
                    <td colspan="2" id="direccion" >{{ $ejemplar->propietario->direccion }}</td>
                </tr>
                <tr>
                    <td colspan="2" id="telefono"  >{{ $ejemplar->propietario->celulares }}</td>
                </tr>
                <tr>
                    <td colspan="2"  id="email" >{{ $ejemplar->propietario->email }}</td>
                    <td></td>
                </tr>
                {{-- <tr>
                    <td id="telefono"></td>
                    <td></td>
                    <td></td>
                </tr> --}}
            </table>
        </div>
        <div id="arbol-genealogio">
            <section id="bloque-padres" >
                <div id="padre_1">
                    @php
                        if(isset($papa)){
                            echo $papa->nombre_completo."<br>";
                            echo "K.C.B. ".$papa->kcb."<br>";
                            echo "No. x Raza ".$papa->num_tatuaje."<br>";
                            echo "Chip ".$papa->chip."<br>";

                            $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$papa->id)
                                        ->where('examen_id','=',3)
                                        ->first();
                            if($examenMascotaPapa){
                                $examenPapa = $examenMascotaPapa->examen->nombre;
                                $resultadoPapa = $examenMascotaPapa->resultado;
                            }else{
                                $examenPapa = "";
                                $resultadoPapa = "";
                            }

                            echo $examenPapa."<br>";
                            echo $resultadoPapa."<br>";
                            echo "Color: ".$papa->color."<br>";
                        }
                    @endphp
                </div>

                <div id="padre_2">
                    
                    @php
                        if(isset($mama)){
                            echo $mama->nombre_completo."<br>";
                            echo "K.C.B. ".$mama->kcb."<br>";
                            echo "No. x Raza ".$mama->num_tatuaje."<br>";
                            echo "Chip ".$mama->chip."<br>";

                            $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$mama->id)
                                        ->where('examen_id','=',3)
                                        ->first();
                            if($examenMascotaPapa){
                                $examenPapa = $examenMascotaPapa->examen->nombre;
                                $resultadoPapa = $examenMascotaPapa->resultado;
                            }else{
                                $examenPapa = "";
                                $resultadoPapa = "";
                            }

                            echo $examenPapa."<br>";
                            echo $resultadoPapa."<br>";
                            echo "Color: ".$mama->color."<br>";
                        }
                    @endphp
                </div>
            </section>
            <section id="bloque-abuelos">
                <div id="abuelo_1">
                    @php
                        if(isset($abuelo)){
                            echo $abuelo->nombre_completo."<br>";
                            echo "K.C.B. ".$abuelo->kcb."<br>";
                            echo "No. x Raza ".$abuelo->num_tatuaje."<br>";
                            echo "Chip ".$abuelo->chip."<br>";

                            $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$abuelo->id)
                                        ->where('examen_id','=',3)
                                        ->first();
                            if($examenMascotaPapa){
                                $examenPapa = $examenMascotaPapa->examen->nombre;
                                $resultadoPapa = $examenMascotaPapa->resultado;
                            }else{
                                $examenPapa = "";
                                $resultadoPapa = "";
                            }

                            echo $examenPapa."<br>";
                            echo $resultadoPapa."<br>";
                            echo "Color: ".$abuelo->color."<br>";
                        }
                    @endphp
                </div>

                <div id="abuelo_2">
                    @php
                        if(isset($abuela)){
                            echo $abuela->nombre_completo."<br>";
                            echo "K.C.B. ".$abuela->kcb."<br>";
                            echo "No. x Raza ".$abuela->num_tatuaje."<br>";
                            echo "Chip ".$abuela->chip."<br>";

                            $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$abuela->id)
                                        ->where('examen_id','=',3)
                                        ->first();
                            if($examenMascotaPapa){
                                $examenPapa = $examenMascotaPapa->examen->nombre;
                                $resultadoPapa = $examenMascotaPapa->resultado;
                            }else{
                                $examenPapa = "";
                                $resultadoPapa = "";
                            }

                            echo $examenPapa."<br>";
                            echo $resultadoPapa."<br>";
                            echo "Color: ".$abuela->color."<br>";
                        }
                    @endphp
                </div>

                <div id="abuelo_3">
                    @php
                        if(isset($abueloM)){
                            echo $abueloM->nombre_completo."<br>";
                            echo "K.C.B. ".$abueloM->kcb."<br>";
                            echo "No. x Raza ".$abueloM->num_tatuaje."<br>";
                            echo "Chip ".$abueloM->chip."<br>";

                            $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$abueloM->id)
                                        ->where('examen_id','=',3)
                                        ->first();
                            if($examenMascotaPapa){
                                $examenPapa = $examenMascotaPapa->examen->nombre;
                                $resultadoPapa = $examenMascotaPapa->resultado;
                            }else{
                                $examenPapa = "";
                                $resultadoPapa = "";
                            }

                            echo $examenPapa."<br>";
                            echo $resultadoPapa."<br>";
                            echo "Color: ".$abueloM->color."<br>";
                        }
                    @endphp
                </div>
                <div id="abuelo_4">
                    @php
                        if(isset($abuelaM)){
                            echo $abuelaM->nombre_completo."<br>";
                            echo "K.C.B. ".$abuelaM->kcb."<br>";
                            echo "No. x Raza ".$abuelaM->num_tatuaje."<br>";
                            echo "Chip ".$abuelaM->chip."<br>";

                            $examenMascotaPapa = App\ExamenMascota::where('ejemplar_id','=',$abuelaM->id)
                                        ->where('examen_id','=',3)
                                        ->first();
                            if($examenMascotaPapa){
                                $examenPapa = $examenMascotaPapa->examen->nombre;
                                $resultadoPapa = $examenMascotaPapa->resultado;
                            }else{
                                $examenPapa = "";
                                $resultadoPapa = "";
                            }

                            echo $examenPapa."<br>";
                            echo $resultadoPapa."<br>";
                            echo "Color: ".$abuelaM->color."<br>";
                        }
                    @endphp
                </div>
            </section>

            <section id="bloque-tg">
                <div  id="tg_1">
                    @php
                        if(isset($tGPadre)){
                            echo $tGPadre->nombre_completo." ";
                            echo "K.C.B. ".$tGPadre->kcb."<br>";
                            echo "No. x Raza ".$tGPadre->num_tatuaje." ";
                            echo "Chip ".$tGPadre->chip."<br>";

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

                            echo $examenPapa." ";
                            echo $resultadoPapa."<br>";
                            echo "Color: ".$tGPadre->color."<br>";
                        }
                    @endphp
                </div>

                <div  id="tg_2">
                    @php
                        if(isset($tGMadre)){
                            echo $tGMadre->nombre_completo." ";
                            echo "K.C.B. ".$tGMadre->kcb."<br>";
                            echo "No. x Raza ".$tGMadre->num_tatuaje." ";
                            echo "Chip ".$tGMadre->chip."<br>";

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

                            echo $examenPapa." ";
                            echo $resultadoPapa."<br>";
                            echo "Color: ".$tGMadre->color."<br>";
                        }
                    @endphp
                </div>

                <div  id="tg_3">
                    @php
                        if(isset($abueloTG)){
                            echo $abueloTG->nombre_completo." ";
                            echo "K.C.B. ".$abueloTG->kcb."<br>";
                            echo "No. x Raza ".$abueloTG->num_tatuaje." ";
                            echo "Chip ".$abueloTG->chip."<br>";

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

                            echo $examenPapa." ";
                            echo $resultadoPapa."<br>";
                            echo "Color: ".$abueloTG->color;
                        }
                    @endphp
                </div>

                <div  id="tg_4">
                    @php
                        if(isset($abuelaTG)){
                            echo $abuelaTG->nombre_completo." ";
                            echo "K.C.B. ".$abuelaTG->kcb."<br>";
                            echo "No. x Raza ".$abuelaTG->num_tatuaje." ";
                            echo "Chip ".$abuelaTG->chip."<br>";

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

                            echo $examenPapa." ";
                            echo $resultadoPapa."<br>";
                            echo "Color: ".$abuelaTG->color;
                        }
                    @endphp
                </div>

                <div id="tg_5">
                    @php
                        if(isset($tGPadreM)){
                            echo $tGPadreM->nombre_completo." ";
                            echo "K.C.B. ".$tGPadreM->kcb."<br>";
                            echo "No. x Raza ".$tGPadreM->num_tatuaje." ";
                            echo "Chip ".$tGPadreM->chip."<br>";

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

                            echo $examenPapa." ";
                            echo $resultadoPapa."<br>";
                            echo "Color: ".$tGPadreM->color;
                        }
                    @endphp
                </div>
                <div id="tg_6">
                    @php
                        if(isset($tGMadreM)){
                            echo $tGMadreM->nombre_completo." ";
                            echo "K.C.B. ".$tGMadreM->kcb."<br>";
                            echo "No. x Raza ".$tGMadreM->num_tatuaje." ";
                            echo "Chip ".$tGMadreM->chip."<br>";

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

                            echo $examenPapa." ";
                            echo $resultadoPapa."<br>";
                            echo "Color: ".$tGMadreM->color;
                        }
                    @endphp
                </div>
                <div id="tg_7">
                    @php
                        if(isset($abueloSG)){
                            echo $abueloSG->nombre_completo." ";
                            echo "K.C.B. ".$abueloSG->kcb."<br>";
                            echo "No. x Raza ".$abueloSG->num_tatuaje." ";
                            echo "Chip ".$abueloSG->chip."<br>";

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

                            echo $examenPapa." ";
                            echo $resultadoPapa."<br>";
                            echo "Color: ".$abueloSG->color;
                        }
                    @endphp
                </div>
                <div id="tg_8">
                    @php
                        if(isset($abueloSGM2)){
                            echo $abueloSGM2->nombre_completo." ";
                            echo "K.C.B. ".$abueloSGM2->kcb."<br>";
                            echo "No. x Raza ".$abueloSGM2->num_tatuaje." ";
                            echo "Chip ".$abueloSGM2->chip."<br>";

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

                            echo $examenPapa." ";
                            echo $resultadoPapa."<br>";
                            echo "Color: ".$abueloSGM2->color;
                        }
                    @endphp
                </div>
                
                
            </section>
            
            <section id="bloque-cg">
                <div  id="cg_1">
                    @php
                        if(isset($cGPadre)){
                            echo $cGPadre->nombre_completo." ";
                            echo "K.C.B. ".$cGPadre->kcb." ";
                            echo "No. x Raza ".$cGPadre->num_tatuaje." ";
                            echo "Chip ".$cGPadre->chip." ";

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
                            echo "Color: ".$cGPadre->color." ";
                        }
                    @endphp
                </div>
                <div  id="cg_2">
                    @php
                        if(isset($cGMadre)){
                            echo $cGMadre->nombre_completo." ";
                            echo "K.C.B. ".$cGMadre->kcb." ";
                            echo "No. x Raza ".$cGMadre->num_tatuaje." ";
                            echo "Chip ".$cGMadre->chip." ";

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
                            echo "Color: ".$cGMadre->color." ";
                        }
                    @endphp
                </div>

                <div  id="cg_3">
                    @php
                        if(isset($CGMadreP)){
                            echo $CGMadreP->nombre_completo." ";
                            echo "K.C.B. ".$CGMadreP->kcb." ";
                            echo "No. x Raza ".$CGMadreP->num_tatuaje." ";
                            echo "Chip ".$CGMadreP->chip." ";

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
                            echo "Color: ".$CGMadreP->color." ";
                        }
                    @endphp
                </div>

                <div  id="cg_4">
                    @php
                        if(isset($CGMadreM2)){
                            echo $CGMadreM2->nombre_completo." ";
                            echo "K.C.B. ".$CGMadreM2->kcb." ";
                            echo "No. x Raza ".$CGMadreM2->num_tatuaje." ";
                            echo "Chip ".$CGMadreM2->chip." ";

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
                            echo "Color: ".$CGMadreM2->color." ";
                        }
                    @endphp
                </div>

                <div  id="cg_5">
                    @php
                        if(isset($abueloCG)){
                            echo $abueloCG->nombre_completo." ";
                            echo "K.C.B. ".$abueloCG->kcb." ";
                            echo "No. x Raza ".$abueloCG->num_tatuaje." ";
                            echo "Chip ".$abueloCG->chip." ";
        
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
                            echo "Color: ".$abueloCG->color." ";
                        }
                    @endphp
                </div>

                <div  id="cg_6">
                    @php
                        if(isset($abueloCGM)){
                            echo $abueloCGM->nombre_completo." ";
                            echo "K.C.B. ".$abueloCGM->kcb." ";
                            echo "No. x Raza ".$abueloCGM->num_tatuaje." ";
                            echo "Chip ".$abueloCGM->chip." ";

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
                            echo "Color: ".$abueloCGM->color." ";
                        }
                    @endphp
                </div>

                <div  id="cg_7">
                    @php
                        if(isset($abueloTGM1)){
                            echo $abueloTGM1->nombre_completo." ";
                            echo "K.C.B. ".$abueloTGM1->kcb." ";
                            echo "No. x Raza ".$abueloTGM1->num_tatuaje." ";
                            echo "Chip ".$abueloTGM1->chip." ";

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
                            echo "Color: ".$abueloTGM1->color." ";
                        }
                    @endphp
                </div>

                <div  id="cg_8">
                    @php
                        if(isset($abuelaTGM1)){
                            echo $abuelaTGM1->nombre_completo." ";
                            echo "K.C.B. ".$abuelaTGM1->kcb." ";
                            echo "No. x Raza ".$abuelaTGM1->num_tatuaje." ";
                            echo "Chip ".$abuelaTGM1->chip." ";

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
                            echo "Color: ".$abuelaTGM1->color." ";
                        }
                    @endphp
                </div>

                <div  id="cg_9">
                    @php
                        if(isset($CGPadreM1)){
                            echo $CGPadreM1->nombre_completo." ";
                            echo "K.C.B. ".$CGPadreM1->kcb." ";
                            echo "No. x Raza ".$CGPadreM1->num_tatuaje." ";
                            echo "Chip ".$CGPadreM1->chip." ";

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
                            echo "Color: ".$CGPadreM1->color." ";
                        }
                    @endphp
                </div>

                <div  id="cg_10">
                    @php
                        if(isset($CGPadreM2)){
                            echo $CGPadreM2->nombre_completo." ";
                            echo "K.C.B. ".$CGPadreM2->kcb." ";
                            echo "No. x Raza ".$CGPadreM2->num_tatuaje." ";
                            echo "Chip ".$CGPadreM2->chip." ";

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
                            echo "Color: ".$CGPadreM2->color." ";
                        }
                    @endphp
                </div>

                <div id="cg_11">
                    @php
                        if(isset($CGPadreM)){
                            echo $CGPadreM->nombre_completo." ";
                            echo "K.C.B. ".$CGPadreM->kcb." ";
                            echo "No. x Raza ".$CGPadreM->num_tatuaje." ";
                            echo "Chip ".$CGPadreM->chip." ";

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
                            echo "Color: ".$CGPadreM->color." ";
                        }
                    @endphp
                </div>
                <div id="cg_12">
                    @php
                        if(isset($CGMadreM)){
                            echo $CGMadreM->nombre_completo." ";
                            echo "K.C.B. ".$CGMadreM->kcb." ";
                            echo "No. x Raza ".$CGMadreM->num_tatuaje." ";
                            echo "Chip ".$CGMadreM->chip." ";

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
                            echo "Color: ".$CGMadreM->color." ";
                        }
                    @endphp
                </div>
                <div id="cg_13">
                    @php
                        if(isset($abueloTG1)){
                            echo $abueloTG1->nombre_completo." ";
                            echo "K.C.B. ".$abueloTG1->kcb." ";
                            echo "No. x Raza ".$abueloTG1->num_tatuaje." ";
                            echo "Chip ".$abueloTG1->chip." ";

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
                            echo "Color: ".$abueloTG1->color." ";
                        }
                    @endphp
                </div>
                <div id="cg_14">
                    @php
                        if(isset($abueloTG11)){
                            echo $abueloTG11->nombre_completo." ";
                            echo "K.C.B. ".$abueloTG11->kcb." ";
                            echo "No. x Raza ".$abueloTG11->num_tatuaje." ";
                            echo "Chip ".$abueloTG11->chip." ";

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
                            echo "Color: ".$abueloTG11->color." ";
                        }
                    @endphp
                </div>
                <div id="cg_15">
                    @php
                        if(isset($abueloSGM22)){
                            echo $abueloSGM22->nombre_completo." ";
                            echo "K.C.B. ".$abueloSGM22->kcb." ";
                            echo "No. x Raza ".$abueloSGM22->num_tatuaje." ";
                            echo "Chip ".$abueloSGM22->chip." ";

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
                            echo "Color: ".$abueloSGM22->color." ";
                        }
                    @endphp
                </div>
                <div id="cg_16">
                    @php
                        if(isset($abueloSGM222)){
                            echo $abueloSGM222->nombre_completo." ";
                            echo "K.C.B. ".$abueloSGM222->kcb." ";
                            echo "No. x Raza ".$abueloSGM222->num_tatuaje." ";
                            echo "Chip ".$abueloSGM222->chip." ";

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
                            echo "Color: ".$abueloSGM222->color." ";
                        }
                    @endphp
                </div>
                
                
            </section>
        </div>
    </div>
    <div id="enlaces">
        <a href="{{ url('Ejemplar/informacion') }}/{{ $ejemplar->id }}">Volver</a>
        <a href="#" onclick="imprimir()">Imprimir</a>
    </div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="http://kcb.test/assets/js/qrcode.min.js"></script>
<script type="text/javascript">
    function imprimir(){
        // $("#haber").val('holas')
        // alert('en desarrollo :v');

        /*prueba*/
        // var x = document.getElementById("enlaces");
        // // alert(x);
        // if (x.style.display == "none") {
        //     x.style.display = "block";
        // } else {
        //     x.style.display = "none";
        // }

        var certificado  = document.getElementById("certificado");

        certificado.style.width = "100%";
        // $('#bloque-certificado').css('width', '100%');
        // $('#table-datos').css('width','90%');
        // $('#certificado').hide();

        window.print();

        certificado.style.width = "77%";
        // $('#certificado').show();
        // $('#bloque-certificado').css('width', '60%');
        // x.style.display = "block";


    }
    let cadenaQr = "178436029";
    // console.log(cadenaQr);
    var qrcode = new QRCode("qrcode", {
        text: cadenaQr,
        width: 110,
        height: 110,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });

    // document.addEventListener("keydown", function (event) {
    //     if (event.ctrlKey) {
    //         event.preventDefault();
    //     }   
    // });
    $(window).keydown(function(event) { 
        if(event.ctrlKey && event.keyCode == 80) { 
            // console.log("Hey! Ctrl+T event captured!"); 
            var certificado  = document.getElementById("certificado");
            certificado.style.width = "100%";
            window.print();
            certificado.style.width = "77%";
            event.preventDefault(); 
        } 
        // if(event.ctrlKey && event.keyCode == 83) {
        //      console.log("Hey! Ctrl+S event captured!");
        //       event.preventDefault(); } 
    });

</script>
