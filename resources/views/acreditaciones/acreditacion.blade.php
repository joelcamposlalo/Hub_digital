<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</HEAD>

<body>
    <img src="https://i.postimg.cc/rFg3Q2pC/carta2.png" width="100%">
    <img style="position: absolute; transform: translate(-288px, 340px);" src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(230)->generate($curp)) }} ">
    <img style="position: absolute; transform: translate(-643px, 715px);" src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(150)->generate($curp)) }} ">
    <p style="position: absolute; transform: translate(-600px, 554px);">{{$curp}}</p>
    <p style="position: absolute; transform: translate(-502px, 577px);">{{$tipo_acreditacion}}</p>
    <p style="position: absolute; transform: translate(-582px, 601px);">{{$vigencia}}</p>
    <p style="position: absolute; transform: translate(-600px, 625px);">{{$placa}}</p>
    <p style="position: absolute; transform: translate(-600px, 648px);">{{$folio}}</p>
</body>

</html>