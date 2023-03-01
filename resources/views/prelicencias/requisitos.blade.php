<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <img src="https://portal.zapopan.gob.mx/logos_vdigital/logo_pyl.png" alt="Dirección de Padrón y Licencias" width="25%">

    <h3 style="text-align: center; margin-top: 5px">Requisitos para el giro de</h3>
    <h4 style="text-align: center; margin-top: 2px">"{{$giro}}"</h4>
    <ol>
        @foreach($requisitos as $requisito)

        <li class="requisito">
            <div style="width: 10px; height: 10px; border: 1px solid #555; display: inline-block"></div> {{$requisito->Nombre}}
        </li>

        @endforeach
    </ol>

</body>

</html>