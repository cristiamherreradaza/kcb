<form id="formularioPermisosUsuarios">
    <div class="row">
        <div class="col-md-6">
            <h5>Administracion de Datos</h5>
            <br>- <input type="checkbox" id="eliminar" name="eliminar" {{ (($permisos != null)? (($permisos->adminDatos != null)? (($permisos->adminDatos->eliminar)? "checked":'') : '') : '' ) }} > <label for="eliminar">Eliminacion de Datos</label>
            <br>- <input type="checkbox" id="editar" name="editar" {{ (($permisos != null)? (($permisos->adminDatos != null)? (($permisos->adminDatos->editar)? "checked":'') : '') : '' ) }} > <label for="editar">Edicion de Datos</label>
            <br>- <input type="checkbox" id="agregar" name="agregar" {{ (($permisos != null)? (($permisos->adminDatos != null)? (($permisos->adminDatos->agregar)? "checked":'') : '') : '' ) }} > <label for="agregar">Agregar de Datos</label>
            <input type="hidden" name="usuario_id" id="usuario_id" value="{{ $usuario_id }}">
        </div>
        <div class="col-md-6">
            <h5>Administracion de Datos Ejemplares</h5>
            <br>- <input type="checkbox" id="registroExamen" name="registroExamen" {{ (($permisos != null)? (($permisos->adminEjemplar != null)? (($permisos->adminEjemplar->registroExamen)? "checked":'') : '') : '' ) }} > <label for="registroExamen">Registro de Examen</label>
            <br>- <input type="checkbox" id="registroTramsferencia" name="registroTramsferencia" {{ (($permisos != null)? (($permisos->adminEjemplar != null)? (($permisos->adminEjemplar->registroTramsferencia)? "checked":'') : '') : '' ) }} > <label for="registroTramsferencia">Registro de Tramsferencia</label>
            <br>- <input type="checkbox" id="registroTitulo" name="registroTitulo" {{ (($permisos != null)? (($permisos->adminEjemplar != null)? (($permisos->adminEjemplar->registroTitulo)? "checked":'') : '') : '' ) }} > <label for="registroTitulo">Registro de Titulo</label>
            <br>- <input type="checkbox" id="impresionPedigree" name="impresionPedigree" {{ (($permisos != null)? (($permisos->adminEjemplar != null)? (($permisos->adminEjemplar->impresionPedigree)? "checked":'') : '') : '' ) }}> <label for="impresionPedigree">Impresion de Pedeegre</label>
        </div>
        {{-- @dd($permisos->adminDatos) --}}
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-success w-100 btn-sm" onclick="guardarPermisoUsuario()">Guardar</button>
        </div>
    </div>
</form>
