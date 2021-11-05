<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <img src="http://kcb.org.bo/logoKennel.png" alt="aqui va el Logo de KENNEL">
        <h1 class="text-center text-danger"><b> INSCRITO CORRECTAMENTE!!!</h1></b>
        @php

            $ejemplarParticipante = App\EjemplarEvento::find($datosR);

            if($ejemplarParticipante->extrangero == 'no'){
                $ejemplar = App\Ejemplar::find($ejemplarParticipante->ejemplar_id);
            }else{
                $ejemplar = $ejemplarParticipante;
            }

            $evento = App\Evento::find($ejemplarParticipante->evento_id);

            $utilidades = new App\librerias\Utilidades();
            $fecha = $utilidades->fechaHoraCastellano($ejemplarParticipante->created_at);

        @endphp
        @if ($ejemplarParticipante->extrangero == 'no')
            <div class="row">
                <div class="col-md-6"><b>Ejemplar: </b></div>
                <div class="col-md-6">{{ $ejemplar->nombre_completo }}</div>
            </div>
            <div class="row">
                <div class="col-md-6"><b>KCB: </b></div>
                <div class="col-md-6">{{ $ejemplar->kcb }}</div>
            </div>
            <div class="row">
                <div class="col-md-6"><b>EVENTO: </b></div>
                <div class="col-md-6">{{ $evento->nombre }}</div>
            </div>
            <div class="row">
                <div class="col-md-6"><b>FECHA: </b></div>
                <div class="col-md-6">{{ $fecha }}</div>
            </div>
            <div class="row">
                <div class="col-md-6"><b>CODIGO DE INSCRIPCION: </b></div>
                <div class="col-md-6">KCB-{{ $ejemplarParticipante->id }}</div>
            </div>
        @else
            <div class="row">
                <div class="col-md-6"><b>Ejemplar: </b></div>
                <div class="col-md-6">{{ $ejemplar->nombre_completo }}</div>
            </div>
            <div class="row">
                <div class="col-md-6"><b>CODIGO NACIONALIZADO: </b></div>
                <div class="col-md-6">{{ $datosEjemplar->codigo_nacionalizado }}</div>
            </div>
            <div class="row">
                <div class="col-md-6"><b>EVENTO: </b></div>
                <div class="col-md-6">{{ $evento->nombre }}</div>
            </div>
            <div class="row">
                <div class="col-md-6"><b>FECHA: </b></div>
                <div class="col-md-6">{{ $fecha }}</div>
            </div>
            <div class="row">
                <div class="col-md-6"><b>CODIGO DE INSCRIPCION: </b></div>
                <div class="col-md-6">KCB-{{ $ejemplarParticipante->id }}</div>
            </div>
        @endif
    </div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>