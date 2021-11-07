<?php
if (isset($_SESSION['rutCliente'])) {
  if(isset($_REQUEST['guardar'])){
      $nombreCli=$_REQUEST['nombreCli']??'';
      $emailCli=$_REQUEST['emailCli']??'';
      $direccionCli=$_REQUEST['direccionCli']??'';
      $codpostalCli = $_REQUEST['codCli']??'';
      $queryCli="UPDATE clientes set nombre='$nombreCli',email='$emailCli',direccion='$direccionCli',codpostal='$codpostalCli' where rut='".$_SESSION['rutCliente']."' ";
      $resCli=mysqli_query($con,$queryCli);

      $nombreRec=$_REQUEST['nombreRec']??'';
      $emailRec=$_REQUEST['emailRec']??'';
      $direccionRec=$_REQUEST['direccionRec']??'';
      $codpostalRec = $_REQUEST['codRec']??'';
      $queryRec="INSERT INTO recibe (nombre,email,direccion,codpostal,rutCliente) VALUES ('$nombreRec','$emailRec','$direccionRec','$codpostalRec','".$_SESSION['rutCliente']."')
      ON DUPLICATE KEY UPDATE
      nombre='$nombreRec',email='$emailRec',direccion='$direccionRec',codpostal='$codpostalRec'; ";
      $resRec=mysqli_query($con,$queryRec);
      if($resCli && $resRec){
          echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=pasarela" />';
      }
      else{
      ?>
          <div class="alert alert-danger" role="alert">
              Error
          </div>
          <?php
       }
   }
   $queryCli="SELECT nombre,email,direccion,codpostal from clientes where rut='".$_SESSION['rutCliente']."';";
   $resCli=mysqli_query($con,$queryCli);
   $rowCli=mysqli_fetch_assoc($resCli);

   $queryRec="SELECT nombre,email,direccion,codpostal from recibe where rutCliente='".$_SESSION['rutCliente']."';";
   $resRec=mysqli_query($con,$queryRec);
   $rowRec=mysqli_fetch_assoc($resRec);

?>
   <form method="post">
       <div class="container mt-3">
           <div class="row">
               <div class="col-6">
                   <h3>Datos del cliente</h3>
                   <div class="form-group">
                       <label for="">Nombre</label>
                       <input type="text" name="nombreCli" id="nombreCli" class="form-control" value="<?php echo $rowCli['nombre'] ?>">
                   </div>
                   <div class="form-group">
                       <label for="">Email</label>
                       <input type="email" name="emailCli" id="emailCli" class="form-control" readonly="readonly" value="<?php echo $rowCli['email'] ?>">
                   </div>
                   <div class="form-group">
                       <label for="">Direccion</label>
                       <textarea name="direccionCli" id="direCli" class="form-control" row="3"><?php echo $rowCli['direccion'] ?></textarea>
                   </div>
                   <div class="form-group">
              <label for="">Codigo Postal</label>
              <input type="number" name="codCli" id="codCli" class="form-control" value="<?php echo $rowCli['codpostal'] ?>">

            </div>

               </div>
               <div class="col-6">
    <h3>Datos del receptor </h3>
    <div class="form-group">
        <label for="">Nombre</label>
        <input type="text" name="nombreRec" id="nombreRec" class="form-control" value="<?php echo $rowRec['nombre'] ?>">
    </div>
    <div class="form-group">
        <label for="">Email</label>
        <input type="email" name="emailRec" id="emailRec" class="form-control" value="<?php echo $rowRec['email'] ?>">
    </div>
    <div class="form-group">
        <label for="">Direccion</label>
        <textarea name="direccionRec" id="direRec" class="form-control" row="3"><?php echo $rowRec['direccion'] ?></textarea>
    </div>
    <div class="form-group">
              <label for="">Codigo Postal</label>
              <input type="number" name="codRec" id="codRec" class="form-control" value="<?php echo $rowCli['codpostal'] ?>">

            </div>

    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input" id="ocupar">
            Ocupar datos del cliente
        </label>
    </div>
</div>
</div>
</div>
<a class="btn btn-warning" href="index.php?modulo=carrito" role="button">Regresar al carrito</a>
       <button type="submit" class="btn btn-primary float-right" name="guardar" value="guardar">pagar</button>
   </form>
<?php
} else {
?>
   <div class="mt-5 text-center">
       Debe <a href="login.php">Iniciar sesion</a> o <a href="registro.php">Registrarse</a>
   </div>
<?php
}
?>
