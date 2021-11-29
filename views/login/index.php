<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio de Sesión</title>
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

    <main>
        <?php $this->showMessages();?>

        <section class="login-content">

            <div class="login-box">


                <form class="login-form" action="<?php echo constant('URL'); ?>/login/authenticate" method="POST">
                    <div><?php (isset($this->errorMessage))?  $this->errorMessage : '' ?></div>

                    <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>INICIO SESIÓN</h3>


                    <div class="form-group">
                        <label class="control-label">TÉLEFONO</label>
                        <input type="text" name="userWhats" onkeypress="return numbers(event);" class="form-control"
                            id="userWhats" placeholder="Número de WhatsApp" autocomplete="off" required=""
                            minlength="10" maxlength="10">
                    </div>

                    <div class="form-group">
                        <label class="control-label">CONTRASEÑA</label>
                        <input type="password" name="userPass" class="form-control" id="userPass"
                            placeholder="Contraseña" autocomplete="off" required="">
                    </div>

                    <div class="form-group btn-container">
                        <button type="submit" class="btn btn-primary btn-block"><i
                                class="fa fa-sign-in fa-lg fa-fw"></i>INICIAR SESIÓN</button>
                    </div>

                    <div id="alertLogin" class="text-center"></div>

                    <div class="form-group">
                        <div class="utility">
                            <p class="semibold-text mb-2"><a href="<?php echo constant('URL'); ?>/register">¿Quieres ser
                                    Anfitrión?</a></p>
                        </div>
                    </div>
                </form>




            </div>
        </section>

    </main>
    <!-- Essential javascripts for application to work-->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="assets/js/plugins/pace.min.js"></script>


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