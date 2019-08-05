<!DOCTYPE html>
<html>

<head>
    <title>Confiarp El Salvador 2019</title>
</head>

<body>
<br />
<h2>Confiarp El Salvador 2019</h2>
<br />
<p>Muchas gracias por su compra, puede verificar el detalle de su compra a continuación:</p>
<br />

<table style="margin-left:30px;text-align: left">
    <tr>
        <th>Cliente: </th>
        <td><?=$solicitud["nombre"]." ".$solicitud["apellido"]?></td>
    </tr>
    <tr>
        <th>Correo electrónico: </th>
        <td><?=$solicitud["email"]?></td>
    </tr>
    <tr>
        <th>Lugar Trabajo/Estudio: </th>
        <td><?=$solicitud["lugar_trabajo_estudio"]?></td>
    </tr>
    <tr>
        <th>Pais Procedencia: </th>
        <td><?=$pais?></td>
    </tr>
    <tr>
        <th>ID Solicitud: </th>
        <td><?=$solicitud["id"]?></td>
    </tr>
</table>
<br />
<h3>Detalle de la compra:</h3>
<br />

<table cellspacing="0" border="1" style="width: 100%">
    <tr>
        <th>Detalle</th>
        <th>Precio unitario</th>
        <th>Cantidad</th>
        <th>Total</th>
    </tr>
    <?php
    $sum=0;
    foreach ($detalleSolicitud as $item) {
        switch ($item["tipo_detalle"]){
            case "1":
                $detalle= "Entrada Estudiante Confiarp 2019";
                break;
            case "2":
                $detalle= "Entrada Profesional Confiarp 2019";
                break;
            case "3":
                $detalle= "Entrada Miembro Confiarp 2019";
                break;
        }
        $total=intval($item["cantidad"])*intval($item["punitario"]);
        $sum += $total;
        echo "<tr>
                <td style='text-align: right'>{$detalle}</td>
                <td style='text-align: right'>{$item["punitario"]}</td>
                <td style='text-align: right'>{$item["cantidad"]}</td>
                <td style='text-align: right'>\${$total}</td>
              </tr>";
    }
    ?>
    <tr>
        <td colspan="3" style='text-align: right'>Total</td>
        <td style='text-align: right'>$<?=$sum?></td>
    </tr>
</table>
<h4 style="text-align: center; width: 100%"><a href="<?=base_url("pagoconfiarp/printvoucher/{$token}")?>">Imprimir comprobante de compra</a></h4>

</body>

</html>