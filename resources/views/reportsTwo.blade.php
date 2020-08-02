<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reportes</title>
</head>
<body>
<style>
    * {
        font-family: sans-serif;
    }
    .table {
        border:#636b6f solid;
        border-collapse: collapse;
    }

    .text {
        font-size: 20px;
    }
</style>
{{\Illuminate\Support\Carbon::now('America/Mexico_City')}}
<table>
    <thead>
    <tr>
        <th><img src="{{asset('img/logo.png')}}" alt="" width="80px"></th>
        <th class="text"> Yeguada San Rafael</th>
    </tr>
    </thead>
</table>

<h1>Reportes de yeguas</h1>

<table class="table"border="1" width="100%">
    <thead >
    <tr>
        <th>Nombre yegua</th>
        <th>Capa</th>
        <th>Nacimiento</th>
        <th>Semental</th>
        <th>Creado por</th>
        <th>Email</th>
        <th>Teléfono</th>
        <th>Creado</th>
    </tr>
    </thead>

    <tbody>
    @foreach($response as $key => $item)
    <tr>
        <td>{{$item->yeg_nombre}}</td>
        <td>{{$item->yeg_capa}}</td>
        <td>{{$item->yeg_nacimiento}}</td>
        <td>{{$item->yeg_semental}}</td>
        <td>{{$item->use_nombre .' ' . $item->use_app .' '. $item->use_apm}}</td>
        <td>{{$item->use_email}}</td>
        <td>{{$item->use_telefono}}</td>
        <td>{{$item->created_at}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
