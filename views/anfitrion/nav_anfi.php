<!--mobile navigation bar start-->
<div class="mobile_nav">
    <div class="nav_bar">
        <img src="assets/image/anfitriones/<?php echo $user->getUserPerfil()?>" class="mobile_profile_image" alt="">
        <i class="fa fa-bars nav_btn"></i>
    </div>
    <div class="mobile_nav_items">

        <<a href="<?php echo constant('URL'); ?>/opc_settings"><i
                class="fas fa-user-cog"></i><span>Configuración</span></a>
            <hr>
            <a href="<?php echo constant('URL'); ?>/opc_house"><i class="fas fa-home"></i><span>Casa</span></a>
            <a href="<?php echo constant('URL'); ?>/opc_page"><i class="fas fa-laptop-code"></i><span>Pagina</span></a>
            <a href="<?php echo constant('URL'); ?>/opc_calendar"><i
                    class="fas fa-calendar-alt"></i><span>Contratos</span></a>
            <a href="#"><i class="fas fa-percent"></i><span>Promoción</span></a>
    </div>
</div>
<!--mobile navigation bar end-->
<!--sidebar start-->
<div class="sidebar">
    <div class="profile_info">
        <img src="assets/image/anfitriones/<?php echo $user->getUserPerfil()?>" class="profile_image" alt="">
        <h4><?php echo $user->getUserWhats()?></h4>
    </div>
    <a href="<?php echo constant('URL'); ?>/opc_settings"><i class="fas fa-user-cog"></i><span>Configuración</span></a>
    <hr>
    <a href="<?php echo constant('URL'); ?>/opc_house"><i class="fas fa-home"></i><span>Casa</span></a>
    <a href="<?php echo constant('URL'); ?>/opc_page"><i class="fas fa-laptop-code"></i><span>Pagina</span></a>
    <a href="<?php echo constant('URL'); ?>/opc_calendar"><i class="fas fa-calendar-alt"></i><span>Contratos</span></a>
    <a href="#"><i class="fas fa-percent"></i><span>Promoción</span></a>
</div>
<!--sidebar end-->