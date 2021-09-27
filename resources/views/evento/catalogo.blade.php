@extends('layouts.app')

@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>CATEGORIA CACHORROS ESPECIALES</h2>
        {{-- @dd($ejemplares) --}}
        @php
            $grupos = array();
            foreach ($ejemplares as $key => $e){
                // echo $e;
                if($e->grupoRaza){
                    echo  ($key+1)." - ".$e->nombre_completo." <---> ".$e->grupoRaza->razas->nombre." <---><b> ".$e->grupoRaza->grupos->nombre."</b><br>";
                }
                // dd($e->grupoRaza->razas->nombre);
            }
            // foreach ($variable as $key => $value) {
            //     # code...
            // }
        @endphp
        {{-- @foreach ( $ejemplares as $e )
            @if ($e->)
                
            @else
                
            @endif
            <div>{{ $e->nombre_completo }}</div>
        @endforeach --}}
    </div>
</div>
@stop

@section('js')
    {{-- <script src="{{ asset('assets/js/pages/crud/file-upload/dropzonejs.js') }}"></script> --}}
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-switch.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            // definimos cabecera donde estarra el token y poder hacer nuestras operaciones de put,post...
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection
