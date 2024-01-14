<?php

use Illuminate\Support\Collection;
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

//Crear coleccion
Route::get('/create', function(){
    $colectivo = collect([1, 2, 3,"tete"]);
    return $colectivo[3];
});

//Agregar metodo custom a coleccion
Route::get('/custom', function(){
    Collection::macro('metodo_random', function () {
        return $this->map(function (string $value) {
            return "$value+";
        });
    });

    $cole = collect(['first', 'second','tres',4,5]);

    $mapeado = $cole->metodo_random();
    return $mapeado;                                    ////retorna first+second+tres+4+5 (Mapea agregando + a cada elemento)
});


//Metodo chunk: Rompe la coleccion en colecionnes mas pequeññas
Route::get ('/chunk', function(){
    $colle = collect([1, 2, 3, 4, 5, 6, 7]);
    $varias_colles = $colle->chunk(5);
    return $varias_colles->all();
});

//Metodo collapse fusiona varias colecciones de arreglos  en una
Route::get('/collapse', function(){
    $collection = collect([
        [1, 2, 3],
        [4, 5, 6],
        [7, 8, 9],
    ]);
    $collapsed = $collection->collapse();
    return $collapsed;
});


//MEtodo collect tambien sirve para duplicar una coleccion
//Mas facil $collection->duplicates();
Route::get('/collect2', function(){
    $collectionA = collect([1, 2, 3]);

    $collectionB = $collectionA->collect();


    return $collectionB->all();
// [1, 2, 3]
});


//Combined, combina 2 colecciones para crear una array asociativo.
//La primer coleccion seria como los keys y la segunda los values
Route::get('/combine', function(){
    $cole1 = collect(['name','lastname']);
    $cole2 = collect(['tete','ricciar']);
    $combinada = $cole1->combine($cole2);
    return $combinada;
});

//Count
Route::get('/count', function(){
    $coleccion1 = collect([1,2,3,7,45,87,12,23,45,99]);
    return $coleccion1->count();
});


//Somete cada elemento a una funcion, por ej: dejar pasar solo los mayores que 2
Route::get('/map', function(){
    $collection = collect([1, 2, 3, 4]);

$mayores = $collection->map(function (int $item) {
    if ($item>2) {
        return $item;
    }
});
    return $mayores;
});


//Filtrar con una condicion
Route::get('/filtrar', function(){
    $collection = collect([1, 2, 3, 4]);

    $filtered = $collection->filter(function (int $value, int $key) {
        return $value > 2;
    });

    return $filtered->all();                // [3, 4]
});


//Continuar si se va a usar esta tecnologia
