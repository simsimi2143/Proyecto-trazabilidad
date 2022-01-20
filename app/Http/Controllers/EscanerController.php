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

class EscanerController extends Controller {
    
    public function index(Request $request) {
        //Pregunta si existe la sesion, sino avanza
        if(!session()->has('rut_nro')) {
            return view('inicio');
        } else {
            // Definicion de variables necesarias
            $n_rut = session('rut_nro');
            $n_dv  = session('dv_nro');  
            $nom_com = session('nom_com'); 
            $t_traza = $_POST['t_traza'];
            $code_ambi = $_POST['code_ambi'];
            $campo = 'ambi_codigo';
            

            $ip = $_SERVER['REMOTE_ADDR'].'; '.$_SERVER['HTTP_USER_AGENT'];
        
            // Sentencia SQL que retorna si el ambiente existe o no en la base de datos
            $query_ambi = DB::select("SET NOCOUNT ON; exec TRAZA.dbo.buscar_ambiente @campo = ?, @valor = ?", [$campo,$code_ambi]);

            //Si no existe nos enseñara un error y volvera a la pantalla del QR
            if($query_ambi == []){
                $nom_ambi = '';
                $estado = 'error';
                return view('alerts',[
                    "estado" => $estado,
                    "n_com" => $nom_com,
                    "nom_ambi" => $nom_ambi,
                    "t_traza" => $t_traza
                ]);
            }
            // Si existe procedera a ejecutar la sentencia SQL e ingresar el dato en la tabla de trazabilidad y un mensaje de suceso
            else{
                $query_uct = DB::select("SET NOCOUNT ON; exec TRAZA.dbo.confirma_trazabilidad @traz_tipo = ?, @pers_rut_nro = ?, @pers_dv = ?, @ambi_codigo = ?, @traz_extra2 = ?", [$t_traza,$n_rut,$n_dv,$code_ambi,$ip]);
                $query_success = $query_uct[0]->sql_status;
                $nom_ambi = $query_ambi[0]->ambi_nombre;
                if($query_uct==[] || $query_success != 0){
                    $estado = 'error';
                    return view('qr',[
                        "estado" => $estado,
                        "n_com" => $nom_com,
                        "nom_ambi" => $nom_ambi,
                        "t_traza" => $t_traza
                    ]);
                }
                else{
                    $estado = 'exito';
                    return view('alerts',[
                        "estado" => $estado,
                        "n_com" => $nom_com,
                        "nom_ambi" => $nom_ambi,
                        "t_traza" => $t_traza
                    ]);
                    // dd($method1,$method2,getBrowser());
                }               
            }
        }
    }
}