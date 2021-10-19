<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
    // 'PDF' => Barryvdh\DomPDF\Facade::class;

class ReporteController extends Controller
{

    public function ejemplarporRaza(Request $request){
        return view('reportes.ejemplaresporraza');
    }

    public function ejemplarporRazaPdf(Request $request){
        $miNombre = $request->input('anio');

        $pdf    = PDF::loadView('pdf.ejemplarporRazaPdf', compact('miNombre'))->setPaper('letter');

        return $pdf->stream('boletinInscripcion_'.date('Y-m-d H:i:s').'.pdf');        

        // dd($request->input('anio'));
        // dd('en desarrollo :v');
        // return view('reportes.ejemplaresporraza');
    }
}
