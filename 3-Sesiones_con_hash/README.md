/*
|--------------------------------------------------------------------------
# Sesiones laravel
|--------------------------------------------------------------------------
|
# Sessiones en Laravel:
    Los drivers se configuran en el config/session.php y son:
        file - sessions are stored in storage/framework/sessions.
        cookie - sessions are stored in secure, encrypted cookies.
        database - sessions are stored in a relational database.
        memcached / redis - sessions are stored in one of these fast, cache based stores.
        dynamodb - sessions are stored in AWS DynamoDB.
        array - sessions are stored in a PHP array and will not be persisted.
# Teorico:
    Una session (al igual que una cookie) crea un archivo (donde se guardarán los datos). Sin embargo, en el caso de las sessions, los archivos se crean en una carpeta del servidor (allí se guardan las variables de sesión y sus valores correspondientes).
    Las sessiones se guardan en el servidor y las cookies en el cliente.

# En general:
    El backend crea un archivo o guarda en base de datos, datos del usuario.
    El backend crea un identificador unico para cada session (id de sesion).
    Se envia este id de sesion al cliente -> en php se suele llamar PHPSESSID en Laravel: laravel_session
    El archivo del backend recibe como nombre el identificador pero con el prefijo sess_. Por ejemplo sess_3c7foj34c3jj973hjkop2fc937e3443.
    Listo, ahora podemos saber de donde provienen las solicitudes.

# Conclusion:
    Cuando hablamos de Token, hablamos de token de session. Es algo que se guarda en el backend. Referenciado al coockie id de session en el cliente.
    Cuando regeneramos la sesion, no solo borramos el id de session, sino que se regenera el token. El usuario logueado con Aut::login($user) permanece logueado, pero con nuevo token de sesion.


# Middleware auth:sanctum
    Si hay Auth::login($user) deja pasar.
    Si no redirige, a donde? app/Http/Middleware/Authenticate.php ahi le decimos adonde.

# Instrucciones
   1-Se configuran en el config\session.php

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

# Como usar las sesiones laravel:
    Fundamento:
        <span> -> EL request trae a las sesiones en Laravel!    </span>

            Con el request:
                        $value = $request->session()->get('key1');   //Obtiene una variable de session con key: key1
                        
                        $token = $request->session()->token();      //Obtener el token actual
                        $request->session()->regenerateToken();     //Regenerar el token

                        $request->session()->regenerate();          // Regenerar el id de session
                        $id = $request->session()->getId();         //Obtener el id de session actual
                        
                        //

                   

        Uso de session en la vista:
            @if(Session::has('message'))
                <span> {{ Session::get('message') }} </span>
            @endif

        */

# Trabajando con Auth y con sesiones
    php artisan migrate
    En el web.php he creado varias rutas y usos comunes de la facade Auth:: y combinamos con el uso de sesiones para entender como se vinculan
