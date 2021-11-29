
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
          <h1>Pedidos</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


<div class="card-body">
  <table id="example2" class="table table-bordered table-hover">
    <thead>
    <tr>
      <th>Nombre</th>
      <th>Email</th>
      <th>Direccion de envio</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query="SELECT nombre,direccion,email from recibe;  ";
    $res=mysqli_query($con,$query);

    while ($row=mysqli_fetch_assoc($res)) {
     ?>
    <tr>
          <td><?php echo $row['nombre'] ?></td>
          <td><?php echo $row['email'] ?></td>
          <td><?php echo $row['direccion'] ?></td>
    </tr>
    <?php
      }
     ?>
    </tbody>
  </table>
</div>
