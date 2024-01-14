<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cache1', function(){

    //Guardar datos en cache
    Cache::store('file')->put('key1','primer variable en cache',600);

    //Recuperar datos de la cache
    $valor = Cache::store('file')->get('key1');

    //No hace falta el store('file') si ya esta por defecto
    Cache::put('key2','Mas data en cache 2',600);
    $valor2 = Cache::get('key2');
    return " $valor <br> $valor2";
});

//Chequear si existe cierta key
Route::get('/existe', function(){
    if(Cache::has('key1')){
        return 'si existe la key1 en cache';
    }
    return "no existe";
});


//Crear key si este no existe (add) y de paso incrementar un contador
Route::get('/add',function(){
    // Inicializamos key3 si es que no existe, tambien le decimos que valgar hasta dentro de 4 horas
    Cache::add('key3', 0, now()->addHours(4));

    // Incrementamos key3=0+1
    Cache::increment('key3');

    //Acepta un segundo argumento
    $incremento=23;
    Cache::increment('key3', $incremento);  //Key3 = 1+23

    Cache::decrement('key3');    //Key3 =24-1

    $valor3= Cache::get('key3');    //Valor3 =23
    return $valor3; //Retorna 23

});


//Recuperar si existe sino guardar un default
Route::get('/recuperar', function(){
    $value = Cache::remember('users', 600, function () {
        $users=['pepe','juan','alan'];
        return $users;
    });
    $recu = Cache::get('users');
    Return $recu;
});


//Recuperar y borrar
Route::get('/recuyborrar', function(){
    Cache::add('key1','un value foo',2000);
    $value = Cache::pull('key1');
    if( ! Cache::has('key1')){
        return "Ya borramos key1 asi que no existe y cae aca: <br> Recuperado: $value";
    }
    return "algo";
});
