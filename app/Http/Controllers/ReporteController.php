<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
    // 'PDF' => Barryvdh\DomPDF\Facade::class;

class ReporteController extends Controller
{

    public function ejemplarporRaza(Request $request){
        return view('reportes.ejemplaresporraza');
    }

    public function ejemplarporRazaPdf(Request $request){

        $anio = $request->input('anio');

        $ejemplares = DB::table('ejemplares')
                        ->join('razas', 'ejemplares.raza_id', '=', 'razas.id')
                        ->groupBy('ejemplares.raza_id')
                        ->orderBy('razas.nombre', 'asc')
                        ->get();

        // return view('pdf.ejemplarporRazaPdf')->with(compact('anio','ejemplares'));

        $pdf    = PDF::loadView('pdf.ejemplarporRazaPdf', compact('anio','ejemplares'))->setPaper('letter');

        return $pdf->stream('boletinInscripcion_'.date('Y-m-d H:i:s').'.pdf');        

        // dd($request->input('anio'));
        // dd('en desarrollo :v');
        // return view('reportes.ejemplaresporraza');
    }
}
