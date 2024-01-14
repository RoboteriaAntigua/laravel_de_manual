<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1> Show </h1>
    @foreach($pagina->chunk(10) as $fila)
    @foreach($fila as $item)
            {{ $item->nombre }}
             {{ $item->email }}
             {{$item->edad}}<br>
    @endforeach
@endforeach
{{ $pagina->links() }}

</body>
</html>
