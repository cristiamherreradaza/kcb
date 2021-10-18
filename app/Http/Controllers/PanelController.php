<?php

namespace App\Http\Controllers;

use App\User;

use App\Ejemplar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PanelController extends Controller
{
    public function __construct()
    {
        // solicita login de ingreso
        $this->middleware('auth');
    }

    public function inicio()
    {
        // echo "holas";
        $propietarios = User::where('perfil_id',4)->count();

        $ejemplares = Ejemplar::all()->count();

        $ejemplaresRegistrados = DB::table('ejemplares')
                                ->select('ejemplares.created_at')
                                ->groupBy('ejemplares.raza_id')
                                ->get();

        $registrosEjemplares = array();

        for($i = 1 ; $i <= 12 ; $i++){
            
            $inidate = date("Y")."-".(($i<=9)? '0'.$i : $i )."-01";
            $findate = date("Y")."-".(($i<=9)? '0'.$i : $i )."-".cal_days_in_month(CAL_GREGORIAN, (($i<=9)? '0'.$i : $i ) , date("Y"));

            $cantiodadREgistroMes = Ejemplar::whereBetween('created_at',["$inidate","$findate"])
                                    ->count(); 

            array_push($registrosEjemplares, $cantiodadREgistroMes);

        }

        return view('panel.inicio')->with(compact('propietarios', 'ejemplares', 'registrosEjemplares'));

    }

    // public function propietarios(){

    //     $propietarios = User::where('perfil_id',4)->count();

    //     return view('panel.inicio')->with(compact('propietarios'));
    // }
}
