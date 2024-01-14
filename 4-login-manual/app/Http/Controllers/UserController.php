<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function login(Request $request, User $user){
        //recuperamos de la base de datos (toda la fila) o encontramos un arreglo vacio []
        $usuario= User::where('email',$request->email)->get();
        /*[{"id":1,"name":"topo","email":"topodelbajo@hotmail.com","email_verified_at":null,"created_at":null,"updated_at":null}]
        acceder al name:
            $usuario[0]->namespace
            */

        /* Sobre el isset()
        if( isset($usuario[0])){
            echo "esta esta definido";
        }else{
            echo "no esta definido";
        } */
        if( isset($usuario[0])){            //Si esta definido el array[0]
            $email = $usuario[0]->email;        //Recuperado de la base de datos
            $pass = $usuario[0]->password;
            if($email==$request->email && $pass==$request->pass){
                echo "login correcto";
                //Crear sesion
                //redirigir a home fin
            }else{
                echo "login incorrecto";
            }
        }else{
            echo "no se encontro el usuario";
        }

    }
}
