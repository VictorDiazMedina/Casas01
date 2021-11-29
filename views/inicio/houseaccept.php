<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Contrato</title>
    <meta name="author" content="Adtile">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- Font-icon css -->
    <script src="https://kit.fontawesome.com/bd0ed12ca6.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>


    <link rel="stylesheet" href="assets/css/housecontract.css">
    <link rel="stylesheet" href="assets/css/nav.css">
</head>
<header>
    <?php require 'views/login/nav.php'; ?>
</header>

<body>

    <!--contenido-->


    <?php $this->showMessages();?>




    <!--contenido end-->




</body>

</html>
<main class="app-content">
    <div class="page-error tile">
        <h1>✔️ Se ha registrado su renta</h1>
        <p>Por favor, notifique a nuestro anfitrión mediante WhatsApp.</p>
        <p><a class="btn btn-primary"
                href="https://api.whatsapp.com/send?phone=+52 1 735 139 9044&text=Solo es una prueba del Proyecto!">Enviar
                Mensaje</a></p>
    </div>
    <div class="page-error tile">
        <h1>📄 Verifica tu contrato</h1>
        <p>Lee detenidamente tu contrato.</p>
        <form action="<?php echo constant('URL'); ?>/contractPDF" method="POST">
            <input type="hidden" id="casa" name="casa" value="<?php echo $_GET["idCasa"]; ?>">
            <button class="btn btn-primary" type="submit"> Generar Contrato</button>
        </form>
    </div>


</main>