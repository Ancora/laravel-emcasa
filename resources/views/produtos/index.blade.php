<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Loja Estelar - Produtos</title>
</head>
<body>
    <h1>Produtos</h1>
    <ul>
        @foreach ($produtos as $produto)
    <li>
        <a href="http://127.0.0.1:8000/produtos/{{$produto->id}}">
            {{$produto->title}}
        </a>
    </li>
        @endforeach
    </ul>
</body>
</html>
