<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.5">
    <title></title>
    <style>
        body {
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 10px;
        }
    </style>
</head>

<body><img src="./permiso.png" width="100%">
    <p style="position: absolute; transform: translate(-680px, 110px);">CONTRIBUYENTE: </p>
    <p style="position: absolute; transform: translate(-560px, 110px);">{{$Contribuyente}}</p>
    <p style="position: absolute; transform: translate(-280px, 110px);">NÚMERO DE LICENCIA: </p>
    <p style="position: absolute; transform: translate(-140px, 110px);">{{$NumeroLicencia}}</p>
    <p style="position: absolute; transform: translate(-680px, 130px);">DOMICILIO: </p>
    <p style="position: absolute; transform: translate(-560px, 130px);">{{$Domicilio}}</p>
    <p style="position: absolute; transform: translate(-280px, 130px);">RFC: </p>
    <p style="position: absolute; transform: translate(-140px, 130px);">{{$RFC}}</p>
    <p style="position: absolute; transform: translate(-680px, 150px);">EMAIL: </p>
    <p style="position: absolute; transform: translate(-560px, 150px);">{{session('correo')}}</p>
    
    <ul style="position: absolute; transform: translate(-730px, 200px); list-style: none !important;">
        @foreach($Conceptos as $concepto)
        <li>
            {{$concepto->Descripcion}}
        </li>
        @endforeach
    </ul>
    
    <ul style="position: absolute; transform: translate(-300px, 200px); list-style: none !important;">
        @foreach($Conceptos as $concepto)
        <li>
            $ {{$concepto->Importe}}
        </li>
        @endforeach
    </ul>

    <p style="position: absolute; transform: translate(-120px, 270px); font-size: 14px">{{$FechaPago}}</p>    

    <p style="position: absolute; transform: translate(-680px, 352px);">FOLIO: </p>
    <p style="position: absolute; transform: translate(-550px, 352px);">{{$FolioLicenciaCedula}}</p>
    <p style="position: absolute; transform: translate(-680px, 370px);">TRANSACCIÓN: </p>
    <p style="position: absolute; transform: translate(-550px, 370px);">{{$OID}}</p>
    <p style="position: absolute; transform: translate(-350px, 352px);">Redondeo: </p>
    <p style="position: absolute; transform: translate(-280px, 352px);">{{$ImporteRedondeo}} </p>
    <p style="position: absolute; transform: translate(-350px, 370px);">Total: </p>
    <p style="position: absolute; transform: translate(-280px, 370px);">{{$Total}}</p>
    <p style="position: absolute; transform: translate(-700px, 390px); font-size: 10px !important; text-align: justify; text-justify: inter-word;"><b>"El presente recibo se expide de conformidad con el artículo 140 de la Ley de Hacienda Municipal del Estado de Jalisco, artículo 65 Fraccion VI de la Ley de Ingresos del Municipio de Zapopan, Jalisco, para el ejercicio fiscal del año 2016 y artículo 33 del Reglamento de Comercio y Servicios para el Municipio de Zapopan, Jalisco."</b></p>
    <p style="position: absolute; transform: translate(-590px, 430px); font-size: 11px !important; text-align: center;"><b>EL PAGO DE ESTE RECIBO NO LIBERA AL CONTRIBUYENTE DE ADEUDOS ANTERIORES. <br> CONSERVE ESTE RECIBO PARA CUALQUIER ACLARACIÓN</b></p>
    <p style="position: absolute; transform: translate(-680px, 490px); font-size: 20px !important;"><b>No. Permiso </b></p>
    <p style="position: absolute; transform: translate(-550px, 490px); font-size: 20px !important;"><b>{{$FolioPermiso}}</b></p>
    <p style="position: absolute; transform: translate(-500px, 555px); text-align: center;">TIPO DE PERMISO: {{$TipoPermiso}}</p>
    <p style="position: absolute; transform: translate(-680px, 570px);">Nombre y/o razón social:</p>
    <p style="position: absolute; transform: translate(-540px, 570px);">{{$Nombre}}</p>
    <p style="position: absolute; transform: translate(-680px, 585px);">Calle:</p>
    <p style="position: absolute; transform: translate(-600px, 585px);">{{$NombreCalle}}</p>
    <p style="position: absolute; transform: translate(-300px, 585px);">Número ext.:</p>
    <p style="position: absolute; transform: translate(-225px, 585px);">{{$Exterior}}</p>
    <p style="position: absolute; transform: translate(-150px, 585px);">Número Interior:</p>
    <p style="position: absolute; transform: translate(-55px, 585px);">{{$Interior}}</p>
    <p style="position: absolute; transform: translate(-680px, 600px);">Entre calles:</p>
    <p style="position: absolute; transform: translate(-600px, 604px); font-size: 10px !important;">{{$EntreCalles}}</p>
    <p style="position: absolute; transform: translate(-300px, 600px);">Colonia:</p>
    <p style="position: absolute; transform: translate(-225px, 600px);">{{$NombreColonia}}</p>
    <p style="position: absolute; transform: translate(-680px, 650px);">Giro comercial:</p>
    <p style="position: absolute; transform: translate(-590px, 650px);">{{$Giro}}</p>
    <p style="position: absolute; transform: translate(-300px, 650px);">Vigencia:</p>
    <p style="position: absolute; transform: translate(-240px, 650px);">{{$Vigencia}}</p>
    <p style="position: absolute; transform: translate(-680px, 665px);">Observaciones:</p>
    <p style="position: absolute; transform: translate(-590px, 665px); text-align: justify; text-justify: inter-word; margin: 15px 90px auto auto">{{$Observaciones}}</p>
    <p style="position: absolute; transform: translate(-700px, 700px); font-size: 11px !important;">{{$Restricciones}}</p>
    <p style="position: absolute; transform: translate(-700px, 750px); font-size: 10px !important; text-align: center;"><b>Cualquier falsedad u omisión de datos, tachaduras o enmendadura invalidará el permiso y además será considerado un delito de conformidad a lo establecido por los artículos 162, 163, 164, 168 del Código Penal del Estado de Jalisco. <br> {{$FechaActual}} </b></p>
    <img style="position: absolute; transform: translate(-650px, 800px);" src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(70)->generate('No. Permiso: ' . $FolioPermiso . ' - No. Licencia: ' . $NumeroLicencia . ' - Vigencia: ' . $Vigencia)) }} ">
    <p style="position: absolute; transform: translate(-680px, 865px); font-size: 15px !important;"><b>Folio: {{$FolioLicenciaCedula}}</b></p>

    <img style="position: absolute; transform: translate(-430px, 800px);" src="./firmaDirectorPYL.jpg" alt="" width="20%">
    <p style="position: absolute; transform: translate(-450px, 850px); text-align: center;">{{$FirmaNombre}}</p>
    <p style="position: absolute; transform: translate(-450px, 860px);"> {{$FirmaLeyenda}}</p>
</body>

</html>