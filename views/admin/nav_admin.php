 <!-- Sidebar menu-->
 <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
 <aside class="app-sidebar">

     <div class="app-sidebar__user" style="align-items: center;">
         <!-- <img class="app-sidebar__user-avatar" src="assets/image/anfitriones/13ea48ae8495d0ee92d1a8d5957c5704.png"
         alt="User Image">-->
         <div>
             <p class="app-sidebar__user-name">Administrador </p>
             <p class="app-sidebar__user-designation">Buen día!</p>
         </div>
     </div>

     <ul class="app-menu">

         <li><a class="app-menu__item" href="<?php echo constant('URL'); ?>/admin"><i
                     class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Inicio</span></a></li>

         <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                     class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Gestor</span><i
                     class="treeview-indicator fa fa-angle-right"></i></a>
             <ul class="treeview-menu">
                 <li><a class="treeview-item" href="<?php echo constant('URL'); ?>/admin_anfi"><i
                             class="icon fa fa-circle-o"></i> Anfitriones</a></li>
             </ul>
         </li>

         <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                     class="app-menu__icon fa fa-bar-chart"></i><span class="app-menu__label">Reportes</span><i
                     class="treeview-indicator fa fa-angle-right"></i></a>
             <ul class="treeview-menu">
                 <li><a class="treeview-item" href="<?php echo constant('URL'); ?>/admin_report"><i
                             class="icon fa fa-circle-o"></i> Temporada</a></li>
             </ul>
         </li>


         <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i
                     class="app-menu__icon fa fa-database"></i><span class="app-menu__label">Base de datos</span><i
                     class="treeview-indicator fa fa-angle-right"></i></a>
             <ul class="treeview-menu">
                 <li><a class="treeview-item" href="<?php echo constant('URL'); ?>/admin_backup"><i
                             class="icon fa fa-circle-o"></i> Respaldo | Recuperación</a></li>
             </ul>
         </li>

         <li><a class="app-menu__item" href="<?php echo constant('URL'); ?>/logout"><i
                     class="app-menu__icon fa fa-sign-out fa-lg"></i><span class="app-menu__label">Cerrar
                     Sesión</span></a></li>
     </ul>
 </aside>