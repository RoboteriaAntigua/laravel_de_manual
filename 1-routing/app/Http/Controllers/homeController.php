<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homeController extends Controller
{
    //
    public function index(){
        return "hola soy el index";
    }

    public function otro_metodo(){
        return "otro metodo";
    }

    public function recuperador($id){
        return "me estan pasando el id en la url: $id";
    }

    public function recupera_varios($id,$vicios,$otro){
        return "recuperando varios parametros por ruta: $id, $vicios, $otro";
    }

    public function nombres_rutas(){
        return view('welcome');
    }
    public function otro_nombre(){
        return "otro ruta con otro nombre";
    }
}
