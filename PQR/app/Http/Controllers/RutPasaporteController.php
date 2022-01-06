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

class RutPasaporteController extends Controller {
    public function index(){
        if(!session()->has('rut_nro')) {
            session(['rut_nro' => $_POST['rut']]);
            session(['dv' => $_POST['dv']]);
            echo "Valor rut sesión: ".session('rut_nro');

            if($_POST['rut']){
                header('qr');
            } else if($_POST('rut')) {
                header('confirma');
            } else {
                header('registro');
            }
        };

        //Validaciones del rut / pasaporte
        if(empty($rut)){
            request()->validate([
                'pasaporte' => 'required_without:rut',
                'p'=>'required_without:dv'
            ]);
        }
        else{
            request()->validate([
                'rut'=>'required_without:pasaporte|digits:8',
                'dv' =>'required_without:p|digits:1'
            ]);
        }

        //Toma el valor del rut ingresado
        $rut_nro = $_POST["rut"];
        $dv = $_POST["dv"];
        $pass_nro = $_POST["pasaporte"];
        $query_uct = DB::select("exec TRAZA.dbo.buscar_persona @rut_nro = ?", [$rut_nro]);
        $query_registro = DB::select("exec TRAZA.dbo.existe_registro @rut_nro = ?", [$rut_nro]);
        $obj = $query_registro[0]->pers_existe;
        $nrut = $query_uct[0]->pers_rut;
        $pnom = $query_uct[0]->pers_nombres;
        $pap = $query_uct[0]->pers_paterno;
        $pam = $query_uct[0]->pers_materno;

        $nom_com = $pnom." ".$pap." ".$pam;

        // pers_nombres     pers_paterno       pers_materno

        if ($query_uct == []){
            // Si la persona no está registrada y NO está en la vista_personas es vacio y retorna al registro
            return view('registro');
        }else{
            //Si la persona no está registrada y SI está en la vista_personas retorna a la vista confirma
            if ($obj == 0){
                // 0 = no existe registro de confirmación del rut
                // devuelve el formulario de confirmar, envia datos a la vista de confirmar
                return view('confirma',[
                    "n_rut" => $nrut,
                    "n_com" => $nom_com
                ]);
            }else{
                // 1 o más = si existe registro de confirmación del rut
                return view('qr');
            }
        }
    }
}