<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        width: 100%;
        background-color: red;
        /* height: 100%; */
    }
    #bloque-certificado{
        /* width: 70%;  */
        /* display:flex; */
        position: relative;
        display: inline-block;
        text-align: center;
        background-color:red;
        /* margin-top: 100px; */
    }
    #enlaces a{
        /* left: 100px; */
        /* right: 500px; */
        background-color:yellow;
    }
    table{
        position: absolute;
        /* margin-top: 10px; */
        top: 45px;
        left: 110px;
        /* width: 80%; */
        /* position: relative; */
        color: #0414ff;
        font-weight: bold;
        padding:0%;

    }
    table tr td{
        border: solid 1px #000000;
        text-align: left;
    }
    td{
        /* padding: 5px; */
        /* margin */
    }
    .afijo{
        /* background-color:red; */
        /* text-align:center; */
        /* position: absolute; */
        margin-left: 10px;
        
        /* margin-right: 1000px; */
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
<body>
    <div id="bloque-certificado">
        <img src="{{ url('img/certificado.jpg') }}" width="100%" id="certificado" alt="No hay imagen">
        <table id="table-datos">
            <tr>
                <td colspan="4"  style="width: 600px" >{{ $ejemplar->nombre_completo }}</td>
                <td colspan="3" class="afijo">{{ $ejemplar->criadero->nombre }}</td>
                <td rowspan="5" style="margin-right: 50px" >
                    <div id="qrcode"></div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    @php
                        $titulos = App\TituloEjemplar::where('ejemplar_id',$ejemplar->id)->get();
                        foreach ($titulos as $t){
                            echo $t->titulo->nombre ;
                        }
                    @endphp
                </td>
                <td colspan="3" style="font-size: 13px" >{{ $ejemplar->propietario->name }}</td>
            </tr>
            <tr>
                <td colspan="3">{{ $ejemplar->raza->nombre }}</td>
                <td>{{ $ejemplar->color }}</td>
                <td colspan="3" style="font-size: 13px">{{ $ejemplar->propietario->direccion }}</td>
            </tr>
            <tr>
                <td>{{ $ejemplar->sexo }}</td>
                <td></td>
                <td>{{ $ejemplar->fecha_nacimiento }}</td>
                <td></td>
                <td>{{ ($ejemplar->consanguinidad!=null)? $ejemplar->consanguinidad :'--------'}}</td>
                <td></td>
                <td style="font-size: 13px">{{ $ejemplar->propietario->celulares }}</td>

            </tr>
            <tr>
                <td>{{ $ejemplar->kcb }}</td>
                <td></td>
                <td>{{ ($ejemplar->num_tatuaje != null)? $ejemplar->num_tatuaje:'--------'}}</td>
                <td></td>
                <td>{{ $ejemplar->chip }}</td>
                <td></td>
                <td>{{ $ejemplar->propietario->email }}</td>

            </tr>
            <tr>
                <td colspan="6">{{ $ejemplar->hermano }}</td>
                <td></td>
                <td></td>

            </tr>
        </table>
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
        var x = document.getElementById("enlaces");
        // alert(x);
        if (x.style.display == "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }

        // var certificado  = document.getElementById("certificado");

        // certificado.style.width = "100%";
        $('#bloque-certificado').css('width', '100%');
        // $('#table-datos').css('width','90%');
        // $('#certificado').hide();

        window.print();

        // $('#certificado').show();
        $('#bloque-certificado').css('width', '60%');
        x.style.display = "block";


    }
    let cadenaQr = "178436029";
    // console.log(cadenaQr);
    var qrcode = new QRCode("qrcode", {
        text: cadenaQr,
        width: 90,
        height: 90,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });

    // document.addEventListener("keydown", function (event) {
    //     if (event.ctrlKey) {
    //         event.preventDefault();
    //     }   
    // });
</script>
