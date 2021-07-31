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
        <form action="{{ url('Criadero/guarda') }}" method="POST" id="formulario-usuarios">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Propietario
                            <span class="text-danger">*</span></label>
                        <input type="hidden" class="form-control" id="criadero_id" name="criadero_id" value="{{ ($criadero!=null)?$criadero->id:'' }}" />

                        <select class="form-control select2" id="propietario_id" name="propietario_id">
                            <option label="Label"></option>
                        </select>

                        {{-- <select name="propietario_id" id="propietario_id" class="form-control">
                            @forelse ($user as $u )
                                @if ($criadero!=null)
                                    @if ($u->id == $criadero->propietario_id)
                                        <option value="{{ $u->id }}" selected>{{ $u->name }}</option>
                                    @else
                                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                                    @endif
                                @else
                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                @endif
                            @empty
                                No Existen Propietarios
                            @endforelse
                        </select> --}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Co-Propietario
                            <span class="text-danger">*</span></label>
                        <select name="copropietario_id" id="copropietario_id" class="form-control">
                            @forelse ($user as $u )
                                @if ($criadero!=null)
                                    @if ($u->id == $criadero->propietario_id)
                                        <option value="{{ $u->id }}" selected>{{ $u->name }}</option>
                                    @else
                                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                                    @endif
                                @else
                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                @endif
                            @empty
                                No Existen Propietarios
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ ($criadero != null)? $criadero->nombre:'' }}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Registro FCI
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="registro_fci" name="registro_fci"  value="{{ ($criadero != null)? $criadero->registro_fci:'' }}" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Departamento
                            <span class="text-danger">*</span></label>
                        <select name="departamento" id="departamento" class="form-control">
                            <option value="La Paz" {{ ($criadero!=null)? ($criadero->departamento=="La Paz")?"selected":'':'' }}>La Paz</option>
                            <option value="Oruro" {{ ($criadero!=null)? ($criadero->departamento=="Oruro")?"selected":'':'' }}>Oruro</option>
                            <option value="Potosi" {{ ($criadero!=null)? ($criadero->departamento=="Potosi")?"selected":'':'' }}>Potosi</option>
                            <option value="Cochabamba" {{ ($criadero!=null)? ($criadero->departamento=="Cochabamba")?"selected":'':'' }}>Cochabamba</option>
                            <option value="Chuquisaca" {{ ($criadero!=null)? ($criadero->departamento=="Chuquisaca")?"selected":'':'' }}>Chuquisaca</option>
                            <option value="Tarija" {{ ($criadero!=null)? ($criadero->departamento=="Tarija")?"selected":'':'' }}>Tarija</option>
                            <option value="Pando" {{ ($criadero!=null)? ($criadero->departamento=="Pando")?"selected":'':'' }}>Pando</option>
                            <option value="Beni" {{ ($criadero!=null)? ($criadero->departamento=="Beni")?"selected":'':'' }}>Beni</option>
                            <option value="Santa Cruz" {{ ($criadero!=null)? ($criadero->departamento=="Santa Cruz")?"selected":'':'' }}>Santa Cruz</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Fecha
                            <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="fecha" id="fecha" value="{{ ($criadero!=null)?$criadero->fecha:'' }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Modalidad de Ingreso
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="modalidad_ingreso" name="modalidad_ingreso"  value="{{ ($criadero!=null)?$criadero->modalidad_ingreso:'' }}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Direccion
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="direccion" name="direccion"  value="{{ ($criadero!=null)?$criadero->direccion:'' }}" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Celulares
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="celulares" name="celulares"  value="{{ ($criadero!=null)?$criadero->celulares:'' }}" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Pagina Web
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="pagina_web" name="pagina_web"  value="{{ ($criadero!=null)?$criadero->pagina_web:'' }}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email
                            <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email"  value="{{ ($criadero!=null)?$criadero->email:'' }}" />
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Observacion
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="observacion" name="observacion"  value="{{ ($criadero!=null)?$criadero->observacion:'' }}" />
                    </div>
                </div>
            </div>
            {{--  <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Direccion
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="direccion" name="direccion" value="{{ ($criadero!=null)?$criadero->direccion:'' }}" required />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Sucursal

                            <span class="text-danger">*</span></label>
                        <select name="sucursal_id" id="sucursal_id" class="form-control">
                            @forelse ($sucursales as $s)
                                @if ($criadero != null)
                                    @if ($criadero->sucursal_id == $s->id)
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
                        <select name="perfil_id" id="perfil_id" class="form-control">
                            @forelse ($perfiles as $p)
                                @if ($criadero != null)
                                    @if ($criadero->perfil_id == $p->id)
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
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Socio
                            <span class="text-danger">*</span></label>
                        <select name="socio" id="socio" class="form-control">
                            @if ($criadero == null)
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            @else
                                <option value="Si" {{ ($criadero->socio=='Si')?'selected':'' }}>Si</option>
                                <option value="No" {{ ($criadero->socio=='No')?'selected':'' }}>No</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>  --}}
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
<script src="{{ asset('assets/js/pages/crud/forms/widgets/select2.js') }} "></script>
<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#propietario_id").select2({
        placeholder: "Busca por nombre",
        allowClear: true,
        ajax: {
            url: "{{ url('User/ajaxBuscaPropietario') }}",
            dataType: 'json',
            method: 'POST',
            delay: 250,
            data: function (params) {
                return {
                    search: params.term,
                };
            },
            processResults: function (response) {

                return {
                    results: response
                };
            },
            cache: true
        },
        minimumInputLength: 1,
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
</script>
@endsection