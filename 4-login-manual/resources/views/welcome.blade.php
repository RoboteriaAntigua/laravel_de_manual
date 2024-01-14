<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
    </head>
    <body>
        <?php
        $hay_login = session('login');
        if($hay_login){
        echo "<p> Hay login: $hay_login</p>";
        echo "<a href='/home') >Home</a>";
        }else {
            echo "<a href='/login'>Log in</a>
                    <a href='register'>Register</a>";
        }
        ?>
        <!--Si hay variable de sesion llamada login, aparece el link a la vista home-->
        {{--
            @if ({{session('login')}})
                <div>
                        <a href="{{ url('/home') }}" >Home</a>
                    @else
                        <a href="{{ route('/login') }}">Log in</a>
                        <a href="{{ route('register') }}">Register</a>

                </div>
            @endif--}}
    </body>
</html>
