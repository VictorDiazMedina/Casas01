<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bloqueo</title>
    <script src="https://kit.fontawesome.com/bd0ed12ca6.js" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="assets/css/nav.css">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body>
    <?php require 'views/login/nav.php'; ?>

    <main class="app-content">
        <div class="page-error tile">
            <h1><i class="fa fa-exclamation-circle"></i> Usted no ha sido Autorizado</h1>
            <p>Contacte el Administrador por WhatsApp.</p>
            <p><a class="btn btn-primary"
                    href="https://api.whatsapp.com/send?phone=+52 1 777 443 2521&text=Quiero ser Anfitrión, no tengo acceso. ">Enviar
                    Mensaje</a></p>
        </div>
    </main>

    <!-- Essential javascripts for application to work-->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="assets/js/plugins/pace.min.js"></script>
</body>

</html>