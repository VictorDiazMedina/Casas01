
<!--ventana para Update--->
<div class="modal fade" id="editChildresn${item.idContrato}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #b21f2d;">
        <h6 class="modal-title" style="color: #fff; text-align: center; font-size: 20px;">
            Eliminar Contrato
        </h6>
      </div>



            <form class="form-horizontal" action="<?php echo constant('URL'); ?>/opc_calendar/updateContract" method="POST" onsubmit="event.preventDefault(); sendDataContract();">
              
              
              <div class="mod"> 
                <label class="textModal" style="font-size: 16px;">Se eliminará el contrato de </label>   
                
                <label class="textModalRed">${item.cont_NombreArren} ${item.cont_APaterArren} ${item.cont_AMaterArren}</label>

              </div>
                  
                <input type="hidden" name="idContrato" id="idContrato" required="">
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i>Aceptar</button>        
                </div>
            </form>


    </div>
  </div>
</div>


