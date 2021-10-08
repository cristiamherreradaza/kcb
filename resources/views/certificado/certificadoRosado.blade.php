<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body{
        width: 100%;
    }
    .certificado{
        width: 100%;
        background-color: red;
        /* height: 100%; */
    }
    img{
        width: 80%; 
    }
</style>
<body>
    {{-- Hola: {{ $miNombre }} --}}
    <div class="certificado">
        <img src="{{ url('img/certificado.jpg') }}" alt="No hay imagen">
    </div>
</body>
</html>