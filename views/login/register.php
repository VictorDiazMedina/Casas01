<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Regristro</title>
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
    <?php $this->showMessages();?>

    <section class="login-content">

        <div class="login-box">


            <form class="login-form" action="<?php echo constant('URL'); ?>/register/nuevoUsuario" method="POST">
                <div><?php (isset($this->errorMessage))?  $this->errorMessage : '' ?></div>

                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>REGISTRATE</h3>

                <div class="form-group">
                    <label class="control-label" for="userWhats">Télefono</label>
                    <input class="form-control" type="text" onkeypress="return numbers(event);"
                        placeholder="Escribe un número con WhatsApp" name="userWhats" id="userWhats" required=""
                        minlength="10" maxlength="10">

                </div>
                <div class="form-group">
                    <label class="control-label" for="userPass">Contraseña</label>
                    <input class="form-control" type="text" placeholder="Escribe una contraseña" name="userPass"
                        id="userPass" required="">
                </div>


                <div class="form-group btn-container">
                    <button type="submit" class="btn btn-primary btn-block">REGISTRARSE</button>
                </div>

                <div class="form-group mt-3">
                    <p class="semibold-text mb-0"><a href="<?php echo constant('URL'); ?>/login"><i
                                class="fa fa-angle-left fa-fw"></i> Iniciar Sesión</a></p>
                </div>

            </form>

        </div>
    </section>

    <script>
    function numbers(e) {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
            return true;

        return /\d/.test(String.fromCharCode(keynum));
    }
    window.addEventListener('DOMContentLoaded', () => {
        const btn_menu = document.querySelector('.btn_menu');

        const cta = document.querySelector('.cta');
        if (btn_menu) {
            btn_menu.addEventListener('click', () => {
                const menu_items = document.querySelector('.menu_items');
                menu_items.classList.toggle('show');
            });
            cta.addEventListener('click', () => {
                const menu_items = document.querySelector('.menu_items');
                menu_items.classList.toggle('show');
            });
        }
    });
    </script>
</body>

</html>