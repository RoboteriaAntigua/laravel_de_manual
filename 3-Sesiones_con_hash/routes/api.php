<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/pruebaInicial', function(Request $request){
    return response()->json('Ok, primer prueba sin problemas');
});


//Crear token 
//Agregar un header 'token_type'=>'bearer' si es lo mismo.
Route::get('/createToken', function (Request $request){
    $user= User::where('email','bartola@gmail.com')->first();
    $token = $user->createToken('auth_token')->plainTextToken;
    //return redirect('/')->with('message','nuevo token: '.$token);
    return response()->json($token);
});

//Eliminar tokens, borra el token creado con createToken (No funciona, probado en postman)
Route::get('/deleteToken', function(Request $request){
        $user = request()->user(); //or Auth::user(), pero no trae el metodo tokens()
        $user->tokens()->delete();
        //return redirect('/')->with('message','token Eliminado o : ');
        return response()->json('Token eliminado');
});

//NO funciona
Route::Get('/getBearer', function(Request $request){
    $token= $request->bearerToken();
    //return redirect('/')->with('message','el bearer token traido del header cliente es: '.$token);
    return response()->json( "el bearearToken es: ".$token);
});

//Chequear si el usuario esta authenticado desde postman, Auth::check() no funciona con solo token, hay que hacer login
Route::get('/checkExterno', function(){
    $user = User::where('email','bartola@gmail.com')->first();
    if ( Auth::check($user)){
        return response()->json('usuario esta authenticado');
    }
    return response()->json('Usuario no autenticado'.$user);
});