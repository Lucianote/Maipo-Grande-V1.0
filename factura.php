<?php

  $total=$_REQUEST['total']??'';
  include_once "stripe/init.php";
  \Stripe\Stripe::setApiKey("sk_test_51JpKkYK9CriEPLP7e3aGMoQrTNBRUxRFrc15zYbuDT3wT9ewwNV9q1swPFkWRri6IwRLuXpJYKuFUdSmIkmCd6p800B5F9WJXy");
  $toke=$_POST['stripeToken'];
  $charge=\Stripe\Charge::create([
      'amount'=>$total*100,
      'currency'=>'usd',
      'description'=>'Compra portal MaipoGrande',
      'source'=>$toke
  ]);
  if ($charge['captured']) {
      $queryVenta = "INSERT INTO ventas
      (rutCliente                   ,fecha              ,idPago) values
      ('".$_SESSION['rutCliente']."',now()                ,'".$charge['id']."');
      ";
      $resVenta=mysqli_query($con,$queryVenta);
      $id=mysqli_insert_id($con);
    /*  if ($resVenta) {
        echo "Compra efectuada con exito , muchas gracias por su preferencia :D N° De compra : ".$id;
      }  */
      $insertaDetalle="";
      $cantProd=count ($_REQUEST['id']);
      for($i=0;$i<$cantProd;$i++){
           $subTotal=$_REQUEST['precio'][$i]*$_REQUEST['cantidad'][$i];
           $insertaDetalle=$insertaDetalle."('".$_REQUEST['id'][$i]."','$id','".$_REQUEST['cantidad'][$i]."','".$_REQUEST['precio'][$i]."','$subTotal'),";
       }
      $insertaDetalle=rtrim($insertaDetalle,",");
      $queryDetalle="INSERT INTO detalle_venta
      (idProducto, idVenta,cantidad_vendia,precio,total) VALUES
      $insertaDetalle;";
      $resDetalle=mysqli_query($con,$queryDetalle);

      $queryActualizarStock = "UPDATE productos INNER JOIN detalle_venta ON productos.id=detalle_venta.idProducto
      SET productos.existencia = productos.existencia - detalle_venta.cantidad_vendia
      WHERE idVenta =$id;";
      $resStock=mysqli_query($con,$queryActualizarStock);


      if ($resVenta && $resDetalle) {
        ?>
        <div class="container mt-3">
          <div class="row">
            <div class="col-6">
              <?php muestraRecibe($id); ?>

            </div>

          </div>

        </div>
        <?php

        ?>
        <div class="container mt-3">
          <div class="row">
            <div class="col-6">
              <?php muestraDetalle($id); ?>

            </div>

          </div>

        </div>
        <?php


        borrarCarrito();

      }
  }
function borrarCarrito(){
  ?>
  <script>
        $.ajax({
            type: "post",
            url: "ajax/borrarCarrito.php",
            dataType: "json",
            success: function (response) {

              $("#badgeProducto").text("");
                $("#listaCarrito").text("");
      }
  });
  </script>
  <?php
}

  function muestraRecibe($idVenta){

    ?>
    <table class="table">
      <thead>
        <tr>
            <th colspan="3" class="text-center">Datos del receptor</th>
        </tr>
        <tr>
            <th>Nombre</th>
            <th>Direccion</th>
            <th>Codigo Postal</th>
            <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <?php
        global $con;
        $queryRecibe="SELECT nombre,direccion,codpostal,email
        from recibe
         where rutCliente =".$_SESSION['rutCliente']."; ";
        $resRecibe=mysqli_query($con,$queryRecibe);
        $row=mysqli_fetch_assoc($resRecibe);
         ?>
          <tr>
            <td><?php echo $row['nombre'] ?></td>
            <td><?php echo $row['direccion'] ?></td>
            <td><?php echo $row['codpostal'] ?></td>
            <td><?php echo $row['email'] ?></td>
          </tr>

      </tbody>
    </table>
    <?php

  }

  function muestraDetalle($idVenta){

    ?>
    <table class="table">
      <thead>
        <tr>
            <th colspan="3" class="text-center">Datos de la venta</th>
        </tr>
        <tr>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Sub Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
        global $con;
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
dv.idDetalleVenta ='64'";
$resDetalle=mysqli_query($con,$queryDetalle);
$total=0;
while($row=mysqli_fetch_assoc($resDetalle)){
    $total=$total+$row['Total'];
         ?>
          <tr>
            <td><?php echo $row['nombre'] ?></td>
            <td><?php echo $row['cantidad_vendia'] ?></td>
            <td><?php echo $row['precio'] ?></td>
            <td><?php echo $row['Total'] ?></td>
          </tr>
        <?php }

        ?>
        <tr>
          <td colspan="3" class="text right">Total:</td>
          <td><?php echo $total; ?></td>
        </tr>

      </tbody>
    </table>
      <a class="btn btn-secondary float-right" target="_blank" href="imprimirFactura.php?idVenta=<?php echo $idVenta ?>" role="button">Imprimir Boleta </a>
    <?php

  }
 ?>
