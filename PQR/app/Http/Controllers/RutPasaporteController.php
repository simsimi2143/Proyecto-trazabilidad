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

session_start();

class RutPasaporteController extends Controller {
    public function store(){
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
        
 
        return view('registro');

        // $query = DB::select("exec TRAZA.dbo.existe_registro @rut_nro = ?", [20365955]);
        // dd($query);
        // die();
    }

    public function index(){
        $rut = $_POST["rut"];
        $query = DB::select("exec TRAZA.dbo.existe_registro @rut_nro = ?", [$rut]);
        $obj = $query[0]->pers_existe;

        if ($obj == 0){
            // 0 = no existe registro de confirmación del rut
            return view('registro');
        }
        else{
            // 1 o más = si existe registro de confirmación del rut
            return view('confirm');
        }
    }
}