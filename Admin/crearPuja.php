<?php
  if (isset($_REQUEST['guardarOferta']) ) {

    include_once "db_maipogrande.php";
    $con=mysqli_connect($host,$user,$pass,$db);

    $numero=(mysqli_real_escape_string($con,$_REQUEST['numero']??'')) ;
    $idpuja=mysqli_real_escape_string($con,$_REQUEST['idpuja']??'') ;
    $empresa=mysqli_real_escape_string($con,$_REQUEST['empresa']??'') ;
    $pdescripcion=mysqli_real_escape_string($con,$_REQUEST['descripcion']??'') ;
    $costo=mysqli_real_escape_string($con,$_REQUEST['costo']??'') ;
    $comentarios=mysqli_real_escape_string($con,$_REQUEST['comentarios']??'') ;
    $queryPuja=" INSERT INTO puja
    (numero      ,idpuja      ,empresa      ,descripcion      ,costo      ,comentarios) VALUES
    ('".$numero."','".$idpuja."','".$empresa."','".$pdescripcion."','".$costo."','".$comentarios."');
    ";
    $res=mysqli_query($con,$queryPuja);

    if($res) {
        echo '<meta http-equiv="refresh" content="0;  url=panelTransportista.php?modulo=subastas&mensaje=Oferta registrada exitosamente"  />';

    }
    else {
?>
  <div class="alert alert-danger" role="alert">
      Error al agregar su oferta <?php echo mysqli_error($con); ?>
  </div>
<?php
    }

  }
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Agregar Oferta</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <!-- /.card-header -->
          <div class="card-body">
            <form action="panelTransportista.php?modulo=crearPuja" method="post">
              <div class="form-group">
                <label >N° Pedido</label>
                <input type="text" name="numero"class="form-control" required="required">
              </div>

              <div class="form-group">
                <label >N° Puja</label>
                <input type="text" name="idpuja"class="form-control" required="required">
              </div>

              <div class="form-group">
                <label >Empresa</label>
                <input type="text" name="empresa"class="form-control" required="required">
              </div>

              <div class="form-group">
                <label >Descripcion</label>
                <input type="text" name="descripcion"class="form-control" required="required">
              </div>

              <div class="form-group">
                <label >Costo</label>
                <input type="number" name="costo"class="form-control" required="required">
              </div>

              <div class="form-group">
                <label >Comentarios</label>
                <input type="text" name="comentarios"class="form-control">
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary" name="guardarOferta">Ofertar</button>
              </div>

            </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
