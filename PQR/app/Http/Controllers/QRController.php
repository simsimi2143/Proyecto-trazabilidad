<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use hisorange\BrowserDetect\Parser as Browser;

class QrController extends Controller
{
    public function index()
    {
        //Declaracion de varaibles a partir de la informacion de la sesion
        // $n_rut = session('rut_nro');
        // $n_dv  = session('dv_nro'); 

        //Pregunta si existe la sesion, sino avanza
        if(!session()->has('rut_nro')) {
            return view('inicio');
        } else {
            $n_rut = session('rut_nro');
            $n_dv  = session('dv_nro');   
            $t_traza = $_POST['t_traza'];
            $code_ambi = $_POST['code_ambi'];
            
            // return $n_rut.'-'.$n_dv.'//'.$t_traza.'//'.$previa;
            $query_uct = DB::select("SET NOCOUNT ON; exec TRAZA.dbo.ingresa_trazabilidad @pers_rut_nro = ?, @pers_dv = ?, @ambi_codigo = ?, @traz_tipo = ?", [$n_rut,$n_dv,$code_ambi,$t_traza]);

            if($query_uct == []){
                return view('qr');
            }
            else{
                return view('inicio');
            }
        }
    }
}
