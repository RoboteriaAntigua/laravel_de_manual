<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Sesiones laravel
|--------------------------------------------------------------------------
|
|   1-Se configuran en el config\session.php

            driver -> aqui es a donde se alojan las sesiones:
                opciones:
                    file - son guardadas en storage/framework/sessions.
                    cookie - en encrypted cookies.
                    database - sessions son guardadas en relational database.
                    memcached / redis - sessions are stored in one of these fast, cache based stores.
                    array - sessions son guardadas en un PHP array and will not be persisted.

                pre-requisitos para el guardado en BAses de datos (driver prerequisites):
                    Una tabla llamada sessions con ciertos campos, podemos crear automaticamente con:
                        php artisan session:table
                        php artisan migrate

    2-Como usar las sesiones laravel:
        a-Recuperar la sesion del navegador A travez del request, en el controlador:
                public function show(Request $request, $id)
                    {
                        $value = $request->session()->get('key');

                        //
                    }

                    Si la key de sesion no existe podemos ejecutar una funcion que se ejecute:
                        $value = $request->session()->get('key', function () {
                            return 'default';
                            });
                            o
                            $value = $request->session()->get('key', 'default');

        b-Con el helper session()

        Nota: el request es desde el backend en cambio el helper se puede incrustar en el front

        */
//******************************Uso del helper de session**********************************
Route::get('/sesiones', function () {
    //Guardar en la sesion
    session(['key' => 'un valor 123']);     //La cookie guardada se llama: laravel_session

    // recuperar la session
    $value = session('key');

    // Specifying a default value...
    //$value = session('key', 'default');

    return "recuperado de la sesion: $value";
});

//Guardar varias sesiones
Route::get('/sesiones_varias', function () {
    //Guardar en la sesion
    session(['key1' => 'un valor 1234']);     //La cookie guardada se llama: laravel_session
    session(['key2'   => 'otro 678']);

    // recuperar la session
    $value1 = session('key1');
    $value2 = session('key2');

    return "recuperado de la sesiones: $value1 y $value2";
});

//******************************Con el request:********************************
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

Route::get('/sesiones_request', function (Request $request){
    //Establecer una sesion
    $request->session()->put('clave1','1234567');

    //recuperar una session
    $recuperada = $request->session()->get('clave1');

    /*******************Determinar si existe una session************** */
    if($request->session()->has('clave1')){
        return "existe la session y es $recuperada";
    }
});

/****************************Olvidar sesiones*********************************/

/*
 * // Forget a single key...
$request->session()->forget('key');

// Forget multiple keys...
$request->session()->forget(['key1', 'key2']);

//olvidar todas las sessiones
$request->session()->flush();

*/

Route::get('/', function () {
    return view('welcome');
});


/* Para encriptar algo directamente aca*/
Route::get('/encriptando', function (){
    $variable1='123abc';
    $encriptado = Crypt::encryptString($variable1);
    $desencriptado = Crypt::decryptString($encriptado);
    return "123abc encriptado es $encriptado y <br> desencriptado nuevamente: $desencriptado";
} );


/* Hash simple */
Route::get('/hash', function(){
    $pass ='123abc';
    $hasheado = Hash::make($pass);

    //Chequear el password
    if(Hash::check('123abc',$hasheado)){
        $math = "es correcto el check";
    }else {$math='no';}

    //Agregarle o quitarle complejidad al hasheo:
    $complejo = Hash::make($pass, [
        'rounds' => 12
    ]);
    return "el pass es: $pass y hasheado es: $hasheado,<br> hay math?: $math <br> Mas complejo: $complejo";
});

//Hash de password y encriptado
//PRimero se hace el hash y luego se encripta, sino no podes hacer el check del hash
Route::get('/seguro', function(){
    $clave='123';
    //Primer hash
    $hash=Hash::make($clave);
    //Encripto
    $cripto=Crypt::encryptString($hash);
    //Envio
    //Recibo el pass hash y encriptado, o sea recibiria $cripto
    //Desencripto
    $desencanto = Crypt::decryptString($cripto);
    //chequeo
    if( Hash::check('123',$desencanto)){
        return 'desencriptado y chequeado con exito';
    }else { return 'no';}
});



//Verificando si un email es existente
//Laravel provee la logica para verificar mails en Auth\VerificationController ver manual
//Para ello son los campos que crea automaticamente email_verify_at en las migraciones que vienen por defecto

//Reseteando un pass
//Laravel tambien lo provee en auth

