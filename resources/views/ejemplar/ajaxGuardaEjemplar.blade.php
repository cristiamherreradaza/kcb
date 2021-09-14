@if ( $ejemplar->sexo == "Macho")
    <button type="button" class="btn btn-block btn-primary" onclick="edicionAjaxBuscaEjemplar('Macho')">Nombre: {{ $ejemplar->nombre }}</button>
@else
    <button type="button" class="btn btn-block btn-info" onclick="edicionAjaxBuscaEjemplar('Hembra')">Nombre: {{ $ejemplar->nombre }}</button>
@endif

<script type="text/javascript">
    if('{{ $ejemplar->sexo }}' == "Macho"){
        $("#edicion_padre_id").val({{ $ejemplar->id }});
    }else{
        $("#edicion_madre_id").val({{ $ejemplar->id }});
    }
    // $("#edicion_ejemplar_id_editar").val({{ $ejemplar->id }});
</script>