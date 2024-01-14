<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\HomeController as ControllersHomeController;

/*
|--------------------------------------------------------------------------
| Routing con laravel
|--------------------------------------------------------------------------
|   Conceptos:
        Las rutas del web.php estan asignadas al web middleware group, que provee caracteristicas
        como sesiones y el csrf protection. O sea, todas los forms que usen rutas post, put o delete
        deben llevar el token @csrf
        Las rutas del api.php estan asignadas al "api" middleware group.
|
    1-Rutas basicas con controlador
    2-redireccion
    3-Rutas que solamente retornas vistas
    4-parametros por rutas y a la vistas
    5-Limitar url con expresiones regulares
    6-Nombres a las rutas: es el famoso {{route('algo')}}
    7-Grupos de rutas
    8-Middlewares a grupos de rutas
    9- Fallback routes / cuando no se encuentra la ruta
    10- Forms y los tokens
    11 - Accediendo a la ruta actual:
|
|
|
*/

//1- ruta basica
Route::get('/', function () {
    return 'hola mundo';
});

//Asignacion basica a un controlador
// php artisan make:controller nombreController
Route::get('/home',[homeController::class,'index']); //Siendo index el metodo del controlador

//tambien valido
Route::get('/otro','App\Http\Controllers\homeController@otro_metodo');  //Tenga en cuenta las mayusculas en la estructura de carpetas

//2-redirigiendo rutas
//Route::redirect('/aqui','/hacia_aqui');
Route::redirect('/redirigir','/home');      //redirige al home

//3-Rutas que solamente retornas vistas
Route::view('/vista1','articulo1');

//4-Pasarle datos a una vista
Route::view('/vista-con-data','articulo1',['title'=>'aqui un titulo']); //en la vista accedemos con {{$title}}

//4 - Pasar parametros a un controlador
Route::get('/user/{id}',[homeController::class,'recuperador']);     //lo recuperamos en el metodo recuperador del controlador

//4 -varios parametros por ruta
Route::get('/lectores/{id}/{vicios}/{otro}',[homeController::class,'recupera_varios']);


//4 - Parametro opcional con ? y en el parametro de la funcion definir como null o algun valor de default
Route::get('/opcional/{par1?}', function($par1=null){
    return "es opcional el parametro: $par1";
});

//5- Limitar con expresiones regulares
Route::get('/regex/{var1}', function ($var1) {
    return "una letra a-z o A-Z, var1:$var1";   //si ponemos /regex/algo todo bien
})->where('var1', '[A-Za-z]+');                 //si ponemos /regex/23 todo mal y tira 404


//6- Nombres a las rutas
//Despues podes acceder a ellas por medio del route('nombre')
Route::get('/nombre_rutas',[homeController::class,'nombres_rutas'])->name('pepito');
Route::get('/otro_nombre',[homeController::class,'otro_nombre'])->name('juanelo');
/*
// Un link con route
<a href={{route('juanelo')}};

// Redirects...
return redirect()->route('pepito');

//parametros:
route('pepito', ['id' => 1]);
*/

//7 - Grupos de rutas:
route::controller(homeController::class)->group(function(){
    Route::get('lala', 'index');        //Llamo al controlador y uso el metodo class
    Route::get('lala/create','index');
    Route::get('lala/{var_ingresado}','otro_nombre');   //Pasamos de parametro lo que el user escriba en el url
});

//8- Middlewares a grupos de rutas,
Route::middleware(['first', 'second'])->group(function () {
    Route::get('/', function () {
        // Uses first & second Middleware
    });

    Route::get('user/profile', function () {
        // Uses first & second Middleware
    });
});

//9- Fallback routes / cuando no se encuentra la ruta
Route::fallback(function () {
    return "no se encontro la ruta";        //tipicamente el 404
});


//10- Forms y los tokens
/*
<form action="/foo/bar" method="POST">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>

//es lo mismo que:

<form action="/foo/bar" method="POST">
    @method('PUT')
    @csrf
</form>
*/


//11 - Accediendo a la ruta actual:
/*
$route = Route::current();

$name = Route::currentRouteName();

$action = Route::currentRouteAction();
*/
