<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/login" method="post">
    @csrf
        Email:<input type="text" name="email"/><br>
        Pass: <input type="text" name="pass"/><br>
        <input type="submit" value="entrar"/>
    </form>
</body>
</html>
