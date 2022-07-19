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
            <h3 class="card-label">FORMULARIO DE USUARIOS
            </h3>
        </div>
        <div class="card-toolbar">
        </div>
    </div>

    <div class="card-body">
        <form action="{{ url('User/guarda') }}" method="POST" id="formulario-usuarios" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nombre y Apellido Completo
                            <span class="text-danger">*</span></label>
                        <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ ($user!=null)?$user->id:'' }}" />
                        <input type="text" class="form-control" id="name" name="name" value="{{ ($user!=null)?$user->name:'' }}" required />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Correo
                            <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ ($user!=null)?$user->email:'' }}" onfocusout="validaEmail()" required />
                        <span class="form-text text-danger" id="msg-error-email" style="display: none;">Correo duplicado, cambielo!!!</span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" {{ ($user==null)?'required':'' }} />
                        <span class="form-text text-info">Si desea cambiar o crear llenar</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Fecha de Nacimiento
                            <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ ($user!=null)?$user->fecha_nacimiento:'' }}" required />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Cedula
                            <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="ci" name="ci"
                            title="El numero no puede exeder mas de 15 digitos" value="{{ ($user!=null)?$user->ci:'' }}" required />
                    </div>
                </div>
                <div class="col-md-3">
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

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Celular
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="celulares" name="celulares" value="{{ ($user!=null)?$user->celulares:'' }}" required />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Direccion
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="direccion" name="direccion" value="{{ ($user!=null)?$user->direccion:'' }}" required />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Sucursal

                            <span class="text-danger">*</span></label>
                        <select name="sucursal_id" id="sucursal_id" class="form-control">
                            @forelse ($sucursales as $s)
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
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Perfil
                            <span class="text-danger">*</span></label>
                        <select name="perfil_id" id="perfil_id" class="form-control" onchange="verificaSecretario(this)">
                            @forelse ($perfiles as $p)
                                @if ($user != null)
                                    @if ($user->perfil_id == $p->id)
                                        <option value="{{ $p->id }}" selected>{{ $p->nombre }}</option>p
                                    @else
                                        <option value="{{ $p->id }}">{{ $p->nombre }}</option>p
                                    @endif
                                @else
                                    <option value="{{ $p->id }}">{{ $p->nombre }}</option>p
                                @endif

                            @empty
                                No existen perfiles
                            @endforelse
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" style="display: none;" id="block_firma">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputPassword1">FIRMA DIGITAL
                            <span class="text-danger">*</span>
                        </label>
                        <input type="file" class="form-control" name="firma_digital" id="firma_digital">
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
        window.location.href = "{{ url('User/listado')}}"
    }

    function verificaSecretario(select){

        if(select.value ==  7){

            $('#block_firma').show('toggle');

        }else{

            $('#block_firma').hide('toggle');

        }

    }
</script>
@endsection
