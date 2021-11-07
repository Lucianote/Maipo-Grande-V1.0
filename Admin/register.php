<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Maipo Grande</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugin/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Maipo Grande</b> Web
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Únase a la web para ver nuestro catalogo</p>

      <form method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="pass">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Nombre" name="nombre">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="Register">Unirse</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <?php
        if (isset($_REQUEST['Register']) ) {

          include_once "db_maipogrande.php";
          $con=mysqli_connect($host,$user,$pass,$db);

          $email=mysqli_real_escape_string($con,$_REQUEST['email']??'') ;
          $pass=md5( mysqli_real_escape_string($con,$_REQUEST['pass']??'')) ;
          $nombre=mysqli_real_escape_string($con,$_REQUEST['nombre']??'') ;
          $query=" INSERT INTO usuarios
          (email      ,pass       ,nombre       ,tipo) VALUES
          ('".$email."','".$pass."','".$nombre."','".cliente."');
          ";
          $res=mysqli_query($con,$query);

          if($res) {
              echo '<meta http-equiv="refresh" content="0;  url=panel.php?modulo=usuarios&mensaje=Usuario agregado exitosamente"  />';
              header("location: index.php");
          }
          else {
      ?>
        <div class="alert alert-danger" role="alert">
            Error al agregar el usuario <?php echo mysqli_error($con); ?>
        </div>
      <?php
          }

        }
      ?>




    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>
