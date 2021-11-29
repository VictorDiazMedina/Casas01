<?php
    $user            = $this->d['user'];
    $house           = $this->d['house'];  
    $fechasAll       = $this->d['fechasAll'];    
    $fechasPend      = $this->d['fechasPend'];  

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <link href="assets/lightboxGallery/lightbox.min.css" rel="stylesheet" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anfitrion</title>


    <!-- Estilos -->
    <link rel="stylesheet" href="assets/css/anf.css">


    <!-- Font-icon css
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">

    
    -->

    <script src="https://kit.fontawesome.com/bd0ed12ca6.js" crossorigin="anonymous"></script>


    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <!-- DatePicker -->
    <link rel="stylesheet" href="assets/css/flatpickr.min.css">

    <!-- Cropper JS -->
    <link href="assets/cropperjs/cropper.min.css" rel="stylesheet" type="text/css" />



    <link rel="stylesheet" href="assets/css/style.css">

</head>



<body>

    <input type="checkbox" id="check">
    <!--header area start-->
    <header>
        <label for="check">
            <i class="fas fa-bars" id="sidebar_btn"></i>
        </label>
        <div class="left_area">
            <h3>Casa <span>ANFITRIÓN</span></h3>
        </div>
        <div class="right_area">
            <a href="<?php echo constant('URL'); ?>/logout" class="logout_btn">Cerrar Sesión</a>
        </div>
    </header>
    <!--header area end-->

    <!-- Conecta con su NAV BAR de ANFITRION-->
    <?php require_once("nav_anfi.php"); ?>