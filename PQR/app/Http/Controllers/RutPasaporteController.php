<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RutPasaporteController extends Controller
{
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
    }

    
}