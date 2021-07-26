<?php

namespace App\Http\Controllers;

use App\Sucursal;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    public function listado()
    {
        $sucursales = Sucursal::all();

        return view('sucursales.listado')->with(compact('sucursales'));
    }

    public function guarda(Request $request)
    {
        // preguntamos si tiene tipo id
        // para editar o crear un registro
        if($request->input('sucursal_id') == null){
            // creamos un nuevo registro
            $tipo = new Sucursal();
        }else{
            // editamos un registro con su tipo_id
            $tipo = Sucursal::find($request->input('sucursal_id'));
        }

        $tipo->nombre      = $request->input('nombre');
        $tipo->celulares   = $request->input('celulares');
        $tipo->direccion   = $request->input('direccion');
        $tipo->departamento   = $request->input('departamento');
        $tipo->cuenta   = $request->input('cuenta');
        $tipo->save();

        return redirect('Sucursal/listado');
    }

    public function elimina(Request $request, $tipo_id)
    {
        Sucursal::destroy($tipo_id);
        return redirect('Sucursal/listado');
    }
}
