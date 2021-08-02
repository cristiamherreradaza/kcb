@extends('layouts.app')

@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

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
            <h3 class="card-label">FORMULARIO DE PROPIETARIOS
            </h3>
        </div>
        <div class="card-toolbar">
        </div>
    </div>

    <div class="card-body">
        <form action="{{ url('User/guardaPropietario') }}" method="POST" id="formulario-usuarios">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nombre de Usuario
                            <span class="text-danger">*</span></label>
                        <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ ($user!=null)?$user->id:'' }}" />
                        <input type="text" class="form-control" id="name" name="name" value="{{ ($user!=null)?$user->name:'' }}" required />
                    </div>
                </div>
        
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Correo
                            <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ ($user!=null)?$user->email:'' }}" required />
                        <span class="form-text text-danger" id="msg-error-email" style="display: none;">Correo duplicado, cambielo!!!</span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Fecha de Nacimiento
                            <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ ($user!=null)?$user->fecha_nacimiento:'' }}" required />
                    </div>
                </div>
                {{--  <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" {{ ($user==null)?'required':'' }} />
                        <span class="form-text text-info">Si desea cambiar o crear llenar</span>
                    </div>
                </div>  --}}
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Cedula
                            <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="ci" name="ci"
                            title="El numero no puede exeder mas de 15 digitos" value="{{ ($user!=null)?$user->ci:'' }}" required />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Genero
                            <span class="text-danger">*</span></label>
                        <select name="genero" id="genero" class="form-control">
                            <option value="Masculino" {{ ($user != null && $user->genero=='Masculino')?'selected':'' }}>Masculino</option>
                            <option value="Femenino" {{ ($user != null && $user->genero=='Femenino')?'selected':'' }}>Femenino</option>
                            <option value="Otros" {{ ($user != null && $user->genero=='Otros')?'selected':'' }}>Otros</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Celular
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="celulares" name="celulares" value="{{ ($user!=null)?$user->celulares:'' }}" required />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Direccion
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="direccion" name="direccion" value="{{ ($user!=null)?$user->direccion:'' }}" required />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Departamento

                            <span class="text-danger">*</span></label>
                        <select name="departamento" id="departamento" class="form-control">
                            <option value="La Paz" {{ ($user != null && $user->departamento=='La Paz')?'selected':'' }} >La Paz</option>
                            <option value="Oruro" {{ ($user != null && $user->departamento=='Oruro')?'selected':'' }} >Oruro</option>
                            <option value="Potosi" {{ ($user != null && $user->departamento=='Potosi')?'selected':'' }} >Potosi</option>
                            <option value="Cochabamba" {{ ($user != null && $user->departamento=='Cochabamba')?'selected':'' }} >Cochabamba</option>
                            <option value="Chuquisaca" {{ ($user != null && $user->departamento=='Chuquisaca')?'selected':'' }} >Chuquisaca</option>
                            <option value="Tarija" {{ ($user != null && $user->departamento=='Tarija')?'selected':'' }} >Tarija</option>
                            <option value="Pando" {{ ($user != null && $user->departamento=='Pando')?'selected':'' }} >Pando</option>
                            <option value="Beni" {{ ($user != null && $user->departamento=='Beni')?'selected':'' }} >Beni</option>
                            <option value="Santa Cruz" {{ ($user != null && $user->departamento=='Santa Cruz')?'selected':'' }} >Santa Cruz</option>
                            {{--  @forelse ($sucursales as $s)
                                @if ($user != null)
                                    @if ($user->sucursal_id == $s->id)
                                        <option value="{{ $s->id }}" selected>{{ $s->nombre }}</option>
                                    @else
                                        <option value="{{ $s->id }}">{{ $s->nombre }}</option>
                                    @endif
                                @else
                                    <option value="{{ $s->id }}">{{ $s->nombre }}</option>
                                @endif
                            @empty
                                NO existen sucursales
                            @endforelse  --}}
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Socio
                            <span class="text-danger">*</span></label>
                        <select name="socio" id="socio" class="form-control">
                            @if ($user == null)
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            @else
                                <option value="Si" {{ ($user->socio=='Si')?'selected':'' }}>Si</option>
                                <option value="No" {{ ($user->socio=='No')?'selected':'' }}>No</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6"><button type="button" class="btn btn-success btn-block" onclick="crear()">GUARDAR</button></div>
                <div class="col-md-6"><button type="button" class="btn btn-dark btn-block" onclick="volver()">VOLVER</button></div>
            </div>
        </form>
    </div>
</div>
<!--end::Card-->
@stop

@section('js')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function crear()
    {
        if($('#formulario-usuarios')[0].checkValidity()){
            $('#formulario-usuarios').submit();
            Swal.fire("Excelente!", "Registro Guardado!", "success");
        }else{
            $('#formulario-usuarios')[0].reportValidity()
        }
    }

    function validaEmail()
    {
        let email = $("#email").val();

        $.ajax({
            url: "{{ url('User/validaEmail') }}",
            data: {email: email},
            type: 'POST',
            success: function(data) {
                // console.log(data.vEmail);     
                if(data.vEmail > 0){
                    $("#msg-error-email").show();
                }else{
                    $("#msg-error-email").hide();
                }
            }
        });
    }
    function volver(){
        window.location.href = "{{ url('User/listadoPropietario') }}";
    }
</script>
@endsection