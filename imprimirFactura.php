<?php
session_start();
include_once "Admin/db_maipogrande.php";
$con = mysqli_connect($host, $user, $pass, $db);

$queryRecibe="SELECT nombre,email,direccion
from recibe
where rutCliente='".$_SESSION['rutCliente']."';";
$resRecibe=mysqli_query($con,$queryRecibe);
$rowRecibe=mysqli_fetch_assoc($resRecibe);

$queryCli="SELECT nombre,email,direccion
from clientes
where rut='".$_SESSION['rutCliente']."';";
$resCli=mysqli_query($con,$queryCli);
$rowCli=mysqli_fetch_assoc($resCli);

$idVenta= mysqli_real_escape_string($con,$_REQUEST['idVenta']??'');
$queryVenta="SELECT v.idVenta,v.fecha
FROM ventas AS v
WHERE v.idVenta = '$idVenta';";
$resVenta=mysqli_query($con,$queryVenta);
$rowVenta=mysqli_fetch_assoc($resVenta);
?>
<?php ob_start(); ?>
<div>
  <?php
$nombreImagen = "Admin/images/logo.png";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
?>
    <img src="<?php echo $imagenBase64 ?>" style="width: 30px;">
    Maipo Grande
</div>

<table style="width: 750px;margin-top: 20px;">
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Receptor</th>
            <th>Datos de la factura</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <strong>Nombre:</strong><?php echo $rowCli['nombre'] ?><br>
                <strong>Email:</strong><?php echo $rowCli['email'] ?><br>
                <strong>Direccion:</strong><?php echo $rowCli['direccion'] ?><br>
            </td>
            <td>
                <strong>Nombre:</strong><?php echo $rowRecibe['nombre'] ?><br>
                <strong>Email:</strong><?php echo $rowRecibe['email'] ?><br>
                <strong>Direccion:</strong><?php echo $rowRecibe['direccion'] ?><br>
            </td>
            <td>
                <strong>Numero de venta:</strong><?php echo $rowVenta['idVenta'] ?><br>
                <strong>Fecha:</strong><?php echo $rowVenta['fecha'] ?><br>
            </td>
        </tr>
    </tbody>
</table>

    <table style="width: 750px;margin-top 20px;">
      <thead>

        <tr>
            <th>Producto(s)</th>
            <th>Cantidad (Lotes)</th>
            <th>Precio</th>
            <th>Sub Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
    $queryDetalle="SELECT
    p.nombre,
    dv.cantidad_vendia,
    dv.precio,
    dv.Total
    FROM
    ventas AS v
    INNER JOIN detalle_venta AS dv ON dv.idDetalleVenta = v.idVenta
    INNER JOIN productos AS p ON p.id = dv.idProducto
    WHERE
    v.idVenta = '25'";
    $resDetalle=mysqli_query($con,$queryDetalle);
    $total=0;
    while($row=mysqli_fetch_assoc($resDetalle)){
    $total=$total+$row['Total'];
         ?>
          <tr>
            <td><?php echo $row['nombre'] ?></td>
            <td><?php echo $row['cantidad_vendia'] ?></td>
            <td><?php echo $row['precio'] ?>($USD)</td>
            <td><?php echo $row['Total'] ?>($USD)</td>
          </tr>
        <?php }

        ?>
        <tr>
          <td colspan="3" class="text right" style="text-align: right">Total:</td>
          <td><?php echo $total; ?>($USD)</td>
        </tr>

      </tbody>
    </table>
    <?php $html= ob_get_clean(); ?>
    <?php
    include_once "dompdf/autoload.inc.php";
    use Dompdf\Dompdf;
    $pdf= new Dompdf();
    $pdf->loadHtml($html);
    $pdf->setPaper("A4","landingscape");
    $pdf->render();
    $pdf->stream();
     ?>
