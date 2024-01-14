<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Middleware
|--------------------------------------------------------------------------
|

    1-Crear un middleware:
        -php artisan make:middleware nombre (Se crea la clase en App\Http\Middleware)
        -En este ejemplo creamos un middleware que checha $request->edad para dejar pasar
         y redirecciona al /home  a menores de 200 años.
|
    2- Middleware que corren siempre, en cada una de las http request.
        Son en App\Http\Kernel.php  (por ejemplo session)
        Alli podemos agregar al hecho por nosotros

    3-Asignar middleware a una ruta (usar middleware):
        a-Para poder llamarlo adentro del methodo ->middleware('nombre_deL_middle')
            hacer falta agregarlo en el arreglo $middlewareAliases del Kernel.php (App\Http\Kernel.php)
            de esta forma:
                'checaredad' => \App\Http\Middleware\CheckarEdad::class
        b-Luego llamar como en el metodo:
        Route::get('/prueba', function(){
            return "prueba exitoza";
            })->middleware('checharedad');
    4-Para varios middlewares:
            Route::get('/', function () {
                //
            })->middleware('first', 'second');

    5-Grupos de middlewares:
            En el kernel.php vamos a encontrar 2 grupos 'web' y 'api' que son conjuntos de middleware para asignar facilmente:
                ->middleware('web')
            Estos se definen en el arreglo: protected $middlewareGroups = []
            Aqui tambien podemos crear nuestros propios grupos de middlewares.
            Puede ser a cada ruta individual, como a grupos de rutas:
            Route::get('/', function () {
                //
            })->middleware('web');

            Route::group(['middleware' => ['web']], function () {
                //
            });

    6-Pasarle parametros a un middleware:
            Route::post('/parametros', function(){
                return "pasado";
            })->middleware('edad:23');

    7-Metodo terminate: se usa en el middleware, le manda info al navegador despues de pasar el middleware:
            public function handle($request, Closure $next)
            {
                return $next($request);
            }

            public function terminate($request, $response)
            {
                // Store the session data...
            }
            Util para guardar en el navegador los datos de sesion
*/

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
