
<button class="btn btn-primary btn-block" type="button" onclick="BuscaPropietario()">Cedula: {{ $ultimaPersona->ci }} Nombre:  {{ $ultimaPersona->name }}</button>

<script type="text/javascript">
    $(document).ready(function(){
        $('#transferencia_propietario_id').val({{ $ultimaPersona->id }});
     });
</script>