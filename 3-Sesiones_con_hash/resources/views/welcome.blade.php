<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body >
        <h1>Welcome </h1>



        <h2>Guardando y recuperando una cookie con el helper sesion()</h2>
        <a href='/sesiones'>sesion</a>

        <h2>Varias sesiones </h2>
        <a href="/sesiones_varias">varias sesiones</a>

        <h2>Guardar y recuperar sesion con el metodo sesion del Request, ($request->sesion())</h2>
        <a href="sesiones_request">request sesion</a>

        <h2>Probamos encriptar algo </h2>
        <a href='/encriptando'>Encriptacion</a>

        <h2>Hash </h2>
        <a href="/hash">Hashing</a>

        <h2>Hash y encriptado</h2>
        <a href="/seguro">seguro</a>
    </body>
</html>
