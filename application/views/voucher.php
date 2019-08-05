<!DOCTYPE html>
<html>

<head>
    <title>Confiarp El Salvador 2019</title>
</head>

<body>
<br />
<img src="<?=base_url()?>assets/images/confiarp.png" alt="Confiarp El Salvador" style="float:right; width: 375px;" />
<img src="data:image/png;base64, <?=$barcode?>" style="float:left;padding-top: 36px;padding-bottom: 36px;"/>
<div style="clear: both"></div>
<br />
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



<style>
    body{
        font-size: 16px;
    }
</style>

<script>
    window.print();
</script>

</body>

</html>