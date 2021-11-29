<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="description" content="Casa Verde Sitio de rentas de casas por México">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="shortcut icon" href="LINK_FAVICON.ICO">-->
    <title>Inicio - Admin</title>
    <!-- Main CSS-->
    <!--<link rel="stylesheet" href = "assets/css/styles.css"> -->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">



  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
       
<header class="app-header"><a class="app-header__logo" href="<?php echo constant('URL'); ?>/admin">Casa Verde</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="<?php echo constant('URL'); ?>/opciones"><i class="fa fa-cog fa-lg"></i> Opciones</a></li>
            <li><a class="dropdown-item" href="<?php echo constant('URL'); ?>/perfil"><i class="fa fa-user fa-lg"></i> Perfil</a></li>
            <li><a class="dropdown-item" href="<?php echo constant('URL'); ?>/logout"><i class="fa fa-sign-out fa-lg"></i> Cerrar Sesión</a></li>
          </ul>
        </li>
      </ul>
</header>

<!-- Conecta con su NAV BAR de ADMINISTRADOR-->
<?php require_once("nav_admin.php"); ?>