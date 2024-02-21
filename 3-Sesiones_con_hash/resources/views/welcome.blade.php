<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body >
        <h1>Welcome </h1>

        @if(Session::has('message'))
            <span> {{ Session::get('message') }} </span>
        @endif

        @if( ! empty($message))
            *******  Mensaje:{{$message}}
        @endif

        <h2>Guardando y recuperando una cookie con el helper sesion()</h2>
        <a href='/sesiones'>sesion</a>

        <h2>Varias sesiones </h2>
        <p>* Aqui generamos una sesion con keys: key1 y key2</p>
        <a href="/sesiones_varias">varias sesiones</a>

        <h2>Guardar y recuperar sesion con el metodo sesion del Request, ($request->sesion())</h2>
        <a href="sesiones_request">request sesion</a>

        <h2>Probamos encriptar algo </h2>
        <a href='/encriptando'>Encriptacion</a>

        <h2>Hash </h2>
        <a href="/hash">Hashing</a>

        <h2>Hash y encriptado</h2>
        <a href="/seguro">seguro</a>

        <h2>Borrar sesiones</h2>
        <p>Aqui invalidamos la sesion con key1, generar antes </p>
        <a href="/borrarSesiones">Mostrar y borrar sesiones</a>
    
        <h2>Mostrar token de session</h2>
        <p>Mostrar token de session</p>
        <a href="/tokens">Mostrar el token de sesion</a>
    
        <h2>Regenerar token de session</h2>
        <a href="/regenerarToken">Regenerar token de session</a>

        <h2>Regenerar session</h2>
        <a href="/regenerarID">Regenerar id de session</a>


        <h1>Auth y sesiones</h1>
        <span>* Con fines de practica voy a poner estos links para crear y borrar un usuario Bartola</span>
        <h2>Crear usuario Bartola</h2>
        <a href="/crear">crear</a>

        <h2>Borrar usuario Bartola</h2>
        <a href="/borrarUser">Borrar</a>

        <h2>Obtener usuario con el facade Auth::user()</h2>
        <a href="/autenticado">Obtener</a>

        <h2>Login con el facade Auth::login($user)</h2>
        <a href="/autenticar">Login</a>

        <h2>Logout</h2>
        <a href="/logout">Logout</a>
        
        <h2>Obtener el usuario con el request</h2>
        <a href="/getUserRequest">Obtener</a>

        <h2>Chequear si el usuario esta autenticado</h2>
        <a href="/check">check useer</a>


        <h2>Attemp, es un login casi completo </h2>
        <form action="{{Route('attemp')}}" method="get">
            Email<input name="email" type="text" placeholder="bartola@gmail.com"><br>
            Password<input name="password"><br>
        <button type="submit">Enviar</button>

        <h2>Es lo mismo obtener el usuario con el modelo que con el request o con el Auth:: ??????</h2>
        <a href="/superGet">Obtener</a>


        <h1>Middleware </h1>
        
        <p>------------------------------------------------------------------------------</p>
        <h2>Probar ruta protejida con middleware sanctum<h2>
            <a href="/protejida1">Ir a ruta protejida1</a>


        <h1>API y llamadas httpClient externas </h1>
        
        <p>------------------------------------------------------------------------------</p>
        <h2>CreateToken con user traido del modelo: User::where(etc..)</h2>
            <a href="/createToken">Create token con User::</a>

            <h2>Borrar tokens de usuario con $request->user()->tokens()->delete()</h2>
                <a href="/deleteToken">deleteTokens</a>

            <h2>Obtener el token del header, $request->bearerToken() </h2>
                <a href="/getBearer">Mostrar token</a>
        <p>------------------------------------------------------------------------------</p>

    </body>
</html>
