
<?php require 'header_anfi.php'; ?>

<!--contenido-->
<div class="content">

<?php $this->showMessages();?>

  <div class="card">
    <h3 class="col-md-8" >EDITAR INFO: Anfitrión <?php echo $user->getUserWhats()?></h3>
  </div>

    
          <div class="tile"> 
            <div class="tile-body">

              <form class="form-horizontal" action="<?php echo constant('URL'); ?>/opc_settings/updateUser" method="POST">
              <div><?php (isset($this->errorMessage))?  $this->errorMessage : '' ?></div>

                <div class="form-group row">
                  <label class="control-label col-md-3">Nombre</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" name="userNomb" id="userNomb" placeholder="Escribe tu nombre" value="<?php echo $user->getUserNomb() ?>">
                  </div>
                </div>

                <div class="row">
                  <label class="control-label col-md-3">Apellidos</label>
                  <div class="form-group col-md-4">
                    <input class="form-control" type="text" name="userAp" id="userAp" placeholder="Paterno" value="<?php echo $user->getUserAp() ?>">
                  </div>

                  <div class="form-group col-md-4">
                    <input class="form-control" type="text" name="userAm" id="userAm" placeholder="Materno" value="<?php echo $user->getUserAm() ?>">
                  </div>
                </div>


                <div class="form-group row">
                  <label class="control-label col-md-3">Fecha de Nacimiento</label>
                  <div class="col-md-8">    
                    <input class="form-control" type = "date" name="userFechNac" id="userFechNac" placeholder="Seleccione su fecha de Nacimiento" value="<?php echo $user->getUserFechNac() ?>"> 
                  </div>
                </div>

    
                <div class="tile-footer">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-3">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar</button>
                        </div>
                    </div>
                </div>
            
              </form>

            </div> 
          </div>


          <!-- FORMULARIO PARA SUBIR IMAGENES-->
          <div class="tile"> 
            <div class="tile-body">

              <form class="form-horizontal" action="<?php echo constant('URL'); ?>/opc_settings/updateImg" method="POST" enctype="multipart/form-data">
              <div><?php (isset($this->errorMessage))?  $this->errorMessage : '' ?></div>

                
              <div class="form-group row">
                  <label class="control-label col-md-3">Foto de Perfil</label>
                  <div class="col-md-8">
                    <input class="form-control" type="file" name="photo" id="photo">
                  </div>
                </div>
    
                <div class="tile-footer">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-3">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Subir</button>
                        </div>
                    </div>
                </div>
            
              </form>

            </div> 
          </div>
        
    
        

  
</div>
<!--contenido end-->




<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
 <script> 
  config = {
    dateFormat: "Y-m-d",

    locale: {
        firstDayOfWeek: 1,
        weekdays: {
          shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
          longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],         
        }, 
        months: {
          shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
          longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        },
      }
  }

  flatpickr("input[type=date]", config);

 </script>
 
<?php require 'footer_anfi.php'; ?>