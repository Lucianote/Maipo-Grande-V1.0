<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Maipo Grande | Feria Virtual</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="Admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="Admin/dist/css/adminlte.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="Admin/plugins/daterangepicker/daterangepicker.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="Admin/css/stripe.css">
    <?php
      session_start();
      $accion =$_REQUEST['accion']??'';
      if ($accion=='cerrar') {
        session_destroy();
        header("Refresh:0");
      }
     ?>
  </head>
  <body>
    <!-- jQuery -->
    <script src="Admin/plugins/jquery/jquery.min.js"></script>
    <?php
    include_once"Admin/db_maipogrande.php";
    $con=mysqli_connect($host,$user,$pass,$db);
     ?>
    <div class="container">
          <div class="row">
              <div class="col-12">


                  <?php
                  include_once "menu.php";
                  $modulo=$_REQUEST['modulo']??'';
                  if ($modulo=="productos" || $modulo=="") {
                    include_once "productos.php";
                  }
                  if ($modulo=="detalleproducto"){
                      include_once "detalleProducto.php";
                  }
                  if ($modulo=="carrito"){
                      include_once "carrito.php";
                  }
                  if ($modulo=="envio") {
                    include_once "envio.php";
                  }
                  if ($modulo=="pasarela") {
                    include_once "pasarela.php";
                  }
                  if ($modulo=="factura") {
                    include_once "factura.php";
                  }

                   ?>
              </div>
          </div>
      </div>



    <!-- jQuery UI 1.11.4 -->
    <script src="Admin/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="Admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- daterangepicker -->
    <script src="Admin/plugins/moment/moment.min.js"></script>
    <script src="Admin/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- AdminLTE App -->
    <script src="Admin/dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="Admin/dist/js/pages/dashboard.js"></script>
    <script src="https://js.stripe.com/v3"></script>
    <script src="Admin/js/stripe.js"></script>
    <script src="Admin/js/ecommerce.js"></script>

  </body>
</html>
