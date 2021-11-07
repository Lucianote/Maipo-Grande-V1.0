<?php
        include_once "db_maipogrande.php";
        $con=mysqli_connect($host,$user,$pass,$db);

        $queryNumeroVentas = "SELECT COUNT(idVenta) AS num from ventas
        where fecha BETWEEN DATE( DATE_SUB(NOW() ,INTERVAL 7 DAY) ) AND NOW()";
        $resNumeroVentas = mysqli_query($con,$queryNumeroVentas);
        $rowNumeroVentas = mysqli_fetch_assoc($resNumeroVentas);



        $queryNumeroClientes = "SELECT COUNT(rut) AS num from clientes";
        $resNumeroClientes = mysqli_query($con,$queryNumeroClientes);
        $rowNumeroClientes = mysqli_fetch_assoc($resNumeroClientes);



        $queryNumeroProductos = "SELECT COUNT(id) AS num from productos";
        $resNumeroProductos = mysqli_query($con,$queryNumeroProductos);
        $rowNumeroProductos = mysqli_fetch_assoc($resNumeroProductos);



        $queryVentasDia ="SELECT
        sum(detalle_venta.total) as total,
        ventas.fecha
        FROM
        ventas
        INNER JOIN detalle_venta ON detalle_venta.idVenta = ventas.idVenta
        GROUP BY DAY(ventas.fecha);";
        $resVentasDia = mysqli_query($con,$queryVentasDia);
        $labelVentas ="";
        $datosVentas ="";
        while($rowVentasDia = mysqli_fetch_assoc($resVentasDia)){

          $labelVentas=$labelVentas."'". date_format(date_create($rowVentasDia['fecha']),"d-m-Y")."',";
          $datosVentas=$datosVentas.$rowVentasDia['total'].",";

        }
        $labelVentas=rtrim($labelVentas,",");
        $datosVentas=rtrim($datosVentas,",");


 ?>

 <script>

  var labelVentas =[<?php echo $labelVentas ?>];
  var datosVentas = [<?php echo $datosVentas ?>];
 </script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->

      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php echo $rowNumeroVentas['num']; ?></h3>

              <p>Ventas de los ultimos 7 dias</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php echo $rowNumeroProductos['num'] ?><sup style="font-size: 20px"></sup></h3>

              <p>Productos disponibles</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?php echo $rowNumeroClientes['num'] ?></h3>

              <p>Total de clientes</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Reporte de ventas
              </h3>

            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content p-0">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart"
                     style="position: relative; height: 300px;">
                    <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                 </div>
                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                  <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                </div>
              </div>
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!--/.direct-chat -->


          <!-- /.card -->
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">


          <!-- /.card -->


          <!-- Calendar -->
          <div class="card bg-gradient-success">
            <div class="card-header border-0">

              <h3 class="card-title">
                <i class="far fa-calendar-alt"></i>
                Calendar
              </h3>
              <!-- tools card -->
              <div class="card-tools">
                <!-- button with a dropdown -->
                <div class="btn-group">
                  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fas fa-bars"></i></button>
                  <div class="dropdown-menu float-right" role="menu">
                    <a href="#" class="dropdown-item">Add new event</a>
                    <a href="#" class="dropdown-item">Clear events</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">View calendar</a>
                  </div>
                </div>
                <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body pt-0">
              <!--The calendar -->
              <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
