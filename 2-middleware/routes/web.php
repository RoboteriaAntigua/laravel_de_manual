<?php

use Illuminate\Support\Facades\Route;



Route::get('/home', function () {
    return view('welcome');
});

Route::get('/', function(){
    return redirect(('/home'));
});

//Asignar middleware
Route::get('/prueba', function(){
    //En el middleware el handle de esta ruta
})->middleware('checaredad');

//6-Pasarle parametros a un middleware:
/*
Route::post('/parametros', function(){
    //return "pasado";
})->middleware('edad:23');
*/
