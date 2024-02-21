<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;


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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use PhpParser\Parser\Tokens;

Route::get('/sesiones_request', function (Request $request){
    //Establecer una sesion
    $request->session()->put('clave1','1234567');

    //recuperar una session
    $recuperada = $request->session()->get('clave1');

    /*******************Determinar si existe una session************** */
    if($request->session()->has('clave1')){
        $token = $request->session()->token();
        return "existe la session y es $recuperada y el token es: $token";
    }
    
});


Route::get('/', function () {
    return view('welcome');
})->name('index');


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
    } else { return 'no';}
});



//Verificando si un email es existente
//Laravel provee la logica para verificar mails en Auth\VerificationController ver manual
//Para ello son los campos que crea automaticamente email_verify_at en las migraciones que vienen por defecto

//Reseteando un pass
//Laravel tambien lo provee en auth



/****************************Sesiones y seguridad, regenerar, olvidar etc*********************************/
Route::get('/borrarSesiones', function(Request $request){

    //Si la session existe, invalidar key1:
    
    if( $request->session()->has('key1') ) {

        $request->session()->invalidate();  // Esto regenera un token de session automaticamente, pero Breeze igual le hace:
        $request->session()->regenerateToken();
        
        
        return 'sesiones invalidadas';
    }

    return 'No habia sesion con key: clave1';

    /*
         * // Forget a single key...
        $request->session()->forget('key1');

        // Forget multiple keys...
        $request->session()->forget(['key1', 'key2']);

        //olvidar todas las sessiones
        $request->session()->flush();
*/
});


/************** Obtener el token de sesion, regenerarlo y  */
Route::get('/tokens', function(Request $request){
    $token = $request->session()->token();
    return redirect('/')->with('message',"el token es:". $token);
});

//Regenerar el token de session
Route::get('/regenerarToken', function(Request $request){
    $tokenViejo = $request->session()->token();
    $request->session()->regenerateToken();
    $token = $request->session()->token();
    return redirect('/')->with('message','TOken viejo: '.$tokenViejo." Token regenerado: ".$token);
});

//Regenerar el id de session 
Route::get('/regenerarID', function(Request $request){
    $request->session()->regenerate();      //Regenera token y Id de sesion
    $token = $request->session()->token();  //Token de la sesion
    $id = $request->session()->getId();     //Id de la sesion
    $idUser = Auth::id();                   //Id del usuario authenticado, si lo hay
    return redirect('/')->with('message','Regenerada la session, nuevo token: '.$token. "El id de session: ".$id. " no confundir con el id de usuario que es: ".$idUser);
});

//Crear un Usuario:
Route::get('/crear', function(Request $request){
    $user = User::create([
        'name'=> 'Bartola',
        'email'=>'bartola@gmail.com',
        'password'=>Hash::make('12345678')
    ]);
    
    return redirect('/')->with('message',$user);
});

//Borrar un usuario
Route::get('/borrarUser', function(){
     User::where('email','bartola@gmail.com')->delete();
     return redirect('/')->with('message','Usuario borrado');
});

//Obtener usuario Autenticado en el facade Auth
Route::get('/autenticado', function(){
    return redirect('/')->with('message', 'El usuario autenticado es: '.Auth::user());
});

//Authenticar usuario con Facade Auth::login -> LOGIN
Route::get('/autenticar', function(){
    $user= User::where('email','bartola@gmail.com')->first();
    Auth::login($user);
    //Auth::authenticate($user); //Usa una ruta que debemos crear con el nombre 'login'
    return redirect('/')->with('message', 'Autenticado'); 
});

//Logout
Route::get('/logout', function(){
    Auth::logout();
    return redirect('/')->with('message','Has salido de sesion');
});

//Obtener usuario del modelo solo con el mail
Route::get('/getUserModel', function(){
    $user= User::where('email','bartola@gmail.com')->first();
    return redirect('/')->with('message','El usuario es: '.$user); 
});



//Obtener el usuario authenticado si lo hay con el request
Route::get('/getUserRequest', function(Request $request){
    $user = $request->user();
    return redirect('/')->with('message','El usuario authenticado obteneido con el request es: '.$user);
});

//Chequear si el usuario esta authenticado
Route::get('/check', function(Request $request){
    $user = $request->user();
    if ( Auth::check($user)){
        return redirect('/')->with('message','usuario esta authenticado');
    }
    return redirect('/')->with('message', 'Usuario no autenticado');
});

//Attemp para saber si el usuario existe y el password es correcto
Route::get('/attemp', function(Request $request){
    if( ! Auth::attempt( $request->only('email','password'))){
        return response()->json(['message'=>'No autorizado'],401);
    }
    $user = $request->user();
    Auth::login($user);
    //Auth::login($user, remember:true);    //Esto recuerda el token en la base de datos
    $token = $request->session()->token();
    return redirect('/')->with('message', ' Usuario logueado con token: '.$token);
})->name('attemp');

//Es lo mismo obtener el usuario con el modelo que con el request o con el Auth:: ??????
Route::get('/superGet', function(Request $request){
    $userAuth = Auth::user();
    $userRequest = $request->user();
    $userModel = User::where('email','bartola@gmail.com')->first();
    
    //Respuesta: NO
    //Obtenido con el Request Y el modelo existe el metodo tokens()->delete()
    //$userRequest->tokens()->delete(); //No hace nada
    //$userModel->tokens()->delete();   //No se bien que tokens borra, ni el de session ni el que se guarda en la base de datos.

    return redirect('/')->with('message','Tokens borrados?');
});

//Protejer con middleware
Route::middleware('auth:sanctum')->get('/protejida1', function(){
    return redirect('/')->with('message','acceso correcto a ruta protegida1');
});


/****************** Para API y LLamadas http externas, poner en API.php ************************************************************** */
//Agregar un header 'token_type'=>'bearer' si es lo mismo.
//Por navegador tendriamos que agregarselo, probarlo con postman o con algun httpclient
Route::get('/createToken', function (Request $request){
    $user= User::where('email','bartola@gmail.com')->first();
    $token = $user->createToken('auth_token')->plainTextToken;
    //return redirect('/')->with('message','nuevo token: '.$token);
    return response()->json($token);
});

//Eliminar tokens, borra el token creado con createToken, de vuelta, depende de los headers
Route::get('/deleteToken', function(Request $request){
        $user = request()->user(); //or Auth::user(), pero no trae el metodo tokens()
        $user->tokens()->delete();
        //return redirect('/')->with('message','token Eliminado o : ');
        return response()->json('Token eliminado');
});

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

//Con solo token pasa el middleware auth:sanctum ??

/***************************** fin api y httpclient externos *********************************************** */



