                  <!-- Navbar -->
<nav class="navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="https://twitter.com/riverparktweets?lang=eu" class="nav-link">Contact</a>
        </li>
    </ul>
    <!-- SEARCH FORM -->
    <form class="form-inline ml-3" action="index.php">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" name="nombre" value="<?php echo $_REQUEST['nombre']??''; ?>">
            <input type="hidden" name="modulo" value="productos">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" id="iconoCarrito">
                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                <span class="badge badge-danger navbar-badge" id="badgeProducto"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="listaCarrito">

                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="admin/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>

            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-user" aria-hidden="true"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
              <?php
                if (isset($_SESSION['rutCliente'])==false) {


               ?>
                <a href="login.php" class="dropdown-item text-primary">
                    <i class="fas fa-door-open mr-2"></i> Iniciar sesion
                </a>
                <div class="dropdown-divider"></div>
                <a href="registro.php" class="dropdown-item text-primary">
                    <i class="fas fa-sign-in-alt mr-2"></i> Resgistrarse
                </a>
                <?php
              } else {
                                 ?>
                                     <a href="index.php?modulo=usuario" class="dropdown-item">
                                         <i class="fas fa-user text-primary mr-2"></i>Hola <?php echo $_SESSION['nombreCliente']; ?>
                                     </a>
                                     <form action="index.php" method="post">
                                         <button name="accion" class="btn btn-danger dropdown-item" type="submit" value="cerrar">
                                             <i class="fas fa-door-closed text-danger mr-2"></i>Cerrar sesion
                                         </button>
                                     </form>
                                 <?php
                                 }
                                 ?>
                             </div>
                         </li>
                     </ul>
                 </nav>
                 <?php
                 $mensaje = $_REQUEST['mensaje'] ?? '';
                 if ($mensaje) {
                 ?>
                     <div class="alert alert-primary alert-dismissible fade show" role="alert">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                             <span class="sr-only">Close</span>
                         </button>
                         <?php echo $mensaje; ?>
                     </div>
                 <?php
                 }
                 ?>
