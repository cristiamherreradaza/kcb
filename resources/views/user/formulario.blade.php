@extends('layouts.app')

@section('css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')
{{-- inicio modal  --}}
<!-- Modal-->

{{-- fin inicio modal  --}}

<!--begin::Card-->
<div class="card card-custom gutter-b">
    <div class="card-header flex-wrap py-3">
        <div class="card-title">
            <h3 class="card-label">FORMULARIO DE USUARIOS
            </h3>
        </div>
        <div class="card-toolbar">
        </div>
    </div>

    <div class="card-body">
        <form action="{{ url('User/guarda') }}" method="POST" id="formulario-usuarios">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nombre de Usuario
                            <span class="text-danger">*</span></label>
                        <input type="hidden" class="form-control" id="user_id" name="user_id" />
                        <input type="text" class="form-control" id="name" name="name" required />
                    </div>
                </div>
        
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Correo
                            <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" required />
                    </div>
                </div>
        
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Contraseña
                            <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" required />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Fecha de Nacimiento
                            <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Cedula
                            <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="ci" name="ci"
                            title="El numero no puede exeder mas de 15 digitos" required />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Genero
                            <span class="text-danger">*</span></label>
                        <select name="genero" id="genero" class="form-control">
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                            <option value="Otros">Otros</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Celular
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="celulares" name="celulares" required />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Direccion
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="direccion" name="direccion" required />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Sucursal
                            <span class="text-danger">*</span></label>
                        <select name="sucursal_id" id="sucursal_id" class="form-control">
                            @forelse ($sucursales as $s)
                            <option value="{{ $s->id }}">{{ $s->nombre }}</option>
                            @empty
                            NO existen sucursales
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Perfil
                            <span class="text-danger">*</span></label>
                        <select name="perfil_id" id="perfil_id" class="form-control">
                            @forelse ($perfiles as $p)
                            <option value="{{ $p->id }}">{{ $p->nombre }}</option>p
                            @empty
                            No existen perfiles
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Socio
                            <span class="text-danger">*</span></label>
                        <select name="socio" id="socio" class="form-control">
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6"><button type="button" class="btn btn-success btn-block" onclick="crear()">GUARDAR</button></div>
                <div class="col-md-6"><button type="button" class="btn btn-dark btn-block">VOLVER</button></div>
            </div>
        </form>
    </div>
</div>
<!--end::Card-->
@stop

@section('js')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script type="text/javascript">
    function crear()
    {
        if($('#formulario-usuarios')[0].checkValidity()){
            $('#formulario-usuarios').submit();
            Swal.fire("Excelente!", "Registro Guardado!", "success");
        }else{
            $('#formulario-usuarios')[0].reportValidity()
        }
    }
</script>
@endsection