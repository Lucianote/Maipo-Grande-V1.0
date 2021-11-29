<?php
include_once "db_maipogrande.php";
$con=mysqli_connect($host,$user,$pass,$db);

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Subastas</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


<div class="card-body">
  <table id="example2" class="table table-bordered table-hover">
    <thead>
    <tr>
      <th>N° Pedido</th>
      <th>N° Puja</th>
      <th>Empresa</th>
      <th>Descripcion</th>
      <th>Envio</th>
      <th>Comentarios</th>
      <th>Ofertar
      <a href="panelTransportista.php?modulo=crearPuja"><i class="fa fa-plus" aria-hidden="true"></i></a>
      </th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query="SELECT p.numero , p.idpuja , p.descripcion , p.costo , p.comentarios, p.empresa
    from puja as p;  ";
    $res=mysqli_query($con,$query);

    while ($row=mysqli_fetch_assoc($res)) {
     ?>
    <tr>
          <td><?php echo $row['numero'] ?></td>
          <td><?php echo $row['idpuja'] ?></td>
          <td><?php echo $row['empresa'] ?></td>
          <td><?php echo $row['descripcion'] ?></td>
          <td><?php echo $row['costo'] ?></td>
          <td><?php echo $row['comentarios'] ?></td>
    </tr>
    <?php
      }
     ?>
    </tbody>
  </table>
</div>
