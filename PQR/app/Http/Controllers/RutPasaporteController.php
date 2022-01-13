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
        $rut_nro = $_POST["rut"];
        $rut_dv  = $_POST["dv"];
        $pass_nro = $_POST["pasaporte"];
        $pass_p = "p";


        //Inicia la sesion y trae los datos desde el formulario inicial
        if($pass_nro != ''){
            session(['rut_nro' => $_POST['pasaporte']]);
            session(['dv_nro' => $pass_p]);
        }
        if($rut_nro != ''){
            session(['rut_nro' => $_POST['rut']]);
            session(['dv_nro' => $_POST['dv']]);
        }
        //Declaracion de variables a partir de la informacion de la sesion
        $n_rut = session('rut_nro');
        $n_dv  = session('dv_nro'); 

        //Pregunta si existe la sesion, sino avanza
        if(!session()->has('rut_nro')) {
            return view('inicio');
        } else {
            //Validaciones del rut // pasaporte
            if(empty($rut)){
                request()->validate([
                    'pasaporte' => 'required_without:rut'
                ]);
            }
            else{
                request()->validate([
                    'rut'=>'required_without:pasaporte|digits:8',
                    'dv' =>'required_without:p|digits:1'
                ]);
            }
    
            //Obtencion de varaibles ingresadas


            //Pregunta si existe la persona en la UCT
            $query_uct = DB::select("exec TRAZA.dbo.buscar_persona_rutdv @rut_nro = ?, @dv = ?", [$n_rut,$n_dv]);

            //Pregunta si la persona existe en el registro
            $query_registro = DB::select("exec TRAZA.dbo.existe_registro @rut_nro = ?", [$n_rut]);

            //Pregunta si el cargo de la persona es funcionario de planta
            $query_cargo = DB::select("exec TRAZA.dbo.planta_identificar @rut_nro = ?", [$n_rut]);

            //Extrae 1 o 0 segun la consulta registro
            $obj = $query_registro[0]->pers_existe;

            //arma el rut con el digito verificador
            $a_rut_nro = $n_rut."-".$n_dv;

            //Define las variables para el cargo en caso de ser de la UCT
            if ($query_cargo==[]){
                $cargo = 0;
            } else{
                $cargo = $query_cargo[0]->pers_origen;
            }
            


            //Redirecionamiento a las paginas segun las consultas anteriores
            if ($query_uct == []){
                // Si no existe en la vista_personas es vacio retorna al registro
                // return $n_rut.'-'.$n_dv;
                return view('registro',[
                    "n_rut" => $a_rut_nro
                ]);
            }
            else{
                //Si existe la persona en la vista_personas
                $pnom = $query_uct[0]->pers_nombres;
                $pap = $query_uct[0]->pers_paterno;
                $pam = $query_uct[0]->pers_materno;
                $nom_com = $pnom." ".$pap." ".$pam;

                if ($obj == 0){
                    // 0 = no existe registro de confirmación del rut


                    //Se guarda en la variable de sesion el nombre completo
                    session(['nom_com' => $nom_com]);
                    $is_nom = session('nom_com');

                    //retorna la vista y envia los datos necesarios de la vista confirma
                    return view('confirma',[
                        "n_rut" => $a_rut_nro,
                        "n_com" => $nom_com,
                        "carg"  => $cargo
                    ]);
                }
                else{
                    // 1 o más = si existe registro de confirmación del rut
                    session(['nom_com' => $nom_com]);
                    return view('qr',[
                        "n_com" => $nom_com]);
                }
            }
        }
    }

}