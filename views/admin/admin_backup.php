<?php require 'header_admin.php'; ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.js"
    integrity="sha512-CWVDkca3f3uAWgDNVzW+W4XJbiC3CH84P2aWZXj+DqI6PNbTzXbl1dIzEHeNJpYSn4B6U8miSZb/hCws7FnUZA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Base de Datos</h1>
            <p>Respaldos y recuperación de la base de datos.</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Blank Page</a></li>
        </ul>
    </div>

    <?php $this->showMessages();?>

    <div class="tile">
        <div class="tile-body">
            <h1>Respaldo</h1>

            <a style="Color:#20c997;" class="treeview-item" href="<?php echo constant('URL'); ?>/admin_backup/backup"><i
                    class="icon fa fa-hand-pointer-o"></i> Clic para hacer copia</a>

        </div>
    </div>

    <div class="tile">
        <div class="tile-body">
            <h1>Recuperar</h1>
            <form class="form-horizontal" action="<?php echo constant('URL'); ?>/admin_backup/restore" method="POST">

                <div class="form-group">
                    <label for="archSelect">Selecciona Archivo de restauración</label>
                    <select class="form-control" name="archSelect" id="archSelect">
                        <?php
                            $ruta="assets/backup/";
                            if(is_dir($ruta)){
                                if($aux=opendir($ruta)){
                                    while(($archivo = readdir($aux)) !== false){
                                        if($archivo!="."&&$archivo!=".."){
                                            $nombrearchivo=str_replace(".sql", "", $archivo);
                                            $nombrearchivo=str_replace("-", ":", $nombrearchivo);
                                            $ruta_completa=$ruta.$archivo;
                                            if(is_dir($ruta_completa)){
                                            }else{
                                                echo '<option value="'.$ruta_completa.'">'.$nombrearchivo.'</option>';
                                            }
                                        }
                                    }
                                    closedir($aux);
                                }
                            }else{
                                echo $ruta." No es ruta válida";
                            }
                        ?>
                    </select>
                </div>


                <div class="tile-footer">
                    <button class="btn btn-primary" type="submit"><i
                            class="fa fa-fw fa-lg fa-check-circle"></i>Restaurar</button>
                </div>
            </form>

        </div>
    </div>



</main>



<?php require 'footer_admin.php'; ?>