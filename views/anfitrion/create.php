<link rel="stylesheet" href="<?php echo constant('URL'); ?>/assets/public/css/expense.css">

<div id="Mod">

    <form id="form-expense-container" action="opc_calendar/updateContract" method="POST">
        <h3>Registrar nuevo gasto</h3>

        <div class="section">
            <label class="control-label">Nombre</label>
            <input class="form-control" type="text" name="userNomb" id="userNomb" placeholder="Escribe tu nombre"
                value="">


        </div>




        <div class="center">
            <input type="submit" value="Nuevo expense">
        </div>
    </form>
</div>




<script>
var datatwo = [];
var copydatatwo = [];



async function getDatatwo() {
    datatwo = await fetch('http://localhost:80/Casas01/opc_page/getDataClauseJSON')
        .then(res => res.json())
        .then(json => json);
    this.copydatatwo = [...this.datatwo];

    renderData(datatwo);
}
getDatatwo();

function renderData(datatwo) {
    var databodytwo = document.querySelector('#databodytwo');

    let total = 0;
    databodytwo.innerHTML = '';

    datatwo.forEach(item => {

        databodytwo.innerHTML += `<tr class="row${item.idClausula}">
                        <td class="celIcon"><i class="${item.clau_Icon}"></i></td>
                        <td class="celDescrip">${item.clau_Descripcion}</td>
                        <td class="celTipo">${item.clau_Tipo}</td>
                        <td class = "acci">
                          <a class = "Edit" clause="${item.idClausula}" href="#">Editar</a>
                          <a class = "Elim" clause="${item.idClausula}" href="#">Eliminar</a>
                        </td>
                       
                    </tr>`;


    });
    //MODA AGREGAR
    $('.btn-ter').click(function(e) {
        e.preventDefault();

        $('.modal-content').html(
            '<div class="modal-header" style="background-color: #004696;"><h6 class="modal-title" style="color: #fff; text-align: center; font-size: 20px;"> Agregar Clausula </h6></div>' +
            '<form class="form-horizontal" action=""  name = "form_addclauseModal" id = "form_addclauseModal" method="POST" onsubmit="event.preventDefault(); addDataClause();">' +
            ' <div class="alertModal"></div>' +
            '           <label class="textObliga">Registro Obligatorio (<span> * </span>)</label>' +
            '   <div class="mod"> ' +
            '     <div class="rowOne">    ' +
            '       <div class="Onetwo">' +
            '         <div>' +
            '           <label class="textModal">Icono</label>' +
            '           <input class="form-control" type="text" name="clauIcon" id="clauIcon" placeholder="Agrega un Icono">' +
            '         </div>' +
            '         <div class="divUrl">' +
            '           <a class="url" href="https://fontawesome.com/v5.15/icons?d=gallery&p=9&m=free"><i class="fa fa-external-link" aria-hidden="true"></i> Ver iconos disponibles</a>' +
            '         </div>' +
            '       </div>' +
            '     </div>' +
            '     <div class="rowDouble">' +
            '       <div class="doubletwo">' +
            '         <div>' +
            '           <label class="textModal">Tipo</label>' +
            '           <input class="form-control" type="text" name="clauTipo" id="clauTipo" placeholder="Número">' +
            '         </div>' +
            '         <div>   ' +
            '           <label class="textModal">Descripción <span> * </span></label>' +
            '           <input class="form-control" type="text" name="clauDescrip" id="clauDescrip" required="" placeholder="Agrega una descripción">' +
            '         </div>' +
            '       </div>' +
            '     </div>' +
            '   </div>' +
            '    <input type="hidden" name="idCasa" id="idCasa" required="" value="<?php echo $house->getId()?>">' +
            '    <input type="hidden" name="action" required="" value="addclause">' +
            '   <div class="modal-footer">' +
            '     <button type="button" class="btn btn-secondary" onclick="closeModaltwo();">Cerrar</button>' +
            '     <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar</button>' +
            '    </div>' +
            '</form>');

        $('.modalAbeltwo').fadeIn();
    });

    //MODAL EDITAR
    $('.Edit').click(function(e) {
        e.preventDefault();
        var cont = $(this).attr('clause');
        var action = 'infoClausula';
        $.ajax({

            url: 'http://localhost:80/Casas01/opc_page/getClause',
            type: 'POST',
            async: true,
            data: {
                action: action,
                Clausula: cont
            },


            success: function(response) {
                console.log(response);
                if (response != 'error') {

                    var info = JSON.parse(response);
                    $('.modal-content').html(
                        '<div class="modal-header" style="background-color: rgb(37, 156, 73);"><h6 class="modal-title" style="color: #fff; text-align: center; font-size: 20px;"> Actualizar Información </h6></div>' +
                        '<form class="form-horizontal" action="<?php echo constant('URL'); ?>/opc_page/updateclause"  name = "form_updateclauseModal" id = "form_updateclauseModal" method="POST" onsubmit="event.preventDefault(); sendDataClause();">' +
                        ' <div class="alertModal"></div>' +
                        '           <label class="textObliga">Registro Obligatorio (<span> * </span>)</label>' +
                        '   <div class="mod"> ' +
                        '     <div class="rowOne">    ' +
                        '       <div class="Onetwo">' +
                        '         <div>' +
                        '           <label class="textModal">Icono</label>' +
                        '           <input class="form-control" type="text" name="clauIcon" id="clauIcon" placeholder="Agrega un Icono" value="' +
                        info.clau_Icon + '">' +
                        '         </div>' +
                        '         <div class="divUrl">' +
                        '           <a class="url" href="https://fontawesome.com/v5.15/icons?d=gallery&p=9&m=free"><i class="fa fa-external-link" aria-hidden="true"></i> Ver iconos disponibles</a>' +
                        '         </div>' +
                        '       </div>' +
                        '     </div>' +
                        '     <div class="rowDouble">' +
                        '       <div class="doubletwo">' +
                        '         <div>' +
                        '           <label class="textModal">Tipo</label>' +
                        '           <input class="form-control" type="text" name="clauTipo" id="clauTipo" placeholder="Número" value="' +
                        info.clau_Tipo + '">' +
                        '         </div>' +
                        '         <div>   ' +
                        '           <label class="textModal">Descripción <span> * </span></label>' +
                        '           <input class="form-control" type="text" name="clauDescrip" id="clauDescrip" required="" placeholder="Agrega una descripción" value="' +
                        info.clau_Descripcion + '">' +
                        '         </div>' +
                        '       </div>' +
                        '     </div>' +
                        '   </div>' +
                        '    <input type="hidden" name="idClausula" id="idClausula" required="" value="' +
                        info.idClausula + '">' +
                        '    <input type="hidden" name="action" required="" value="updateclause">' +
                        '   <div class="modal-footer">' +
                        '     <button type="button" class="btn btn-secondary" onclick="closeModaltwo();">Cerrar</button>' +
                        '     <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar</button>' +
                        '    </div>' +
                        '</form>');
                }
            },
            error: function(error) {
                console.log(error);
            }
        });

        $('.modalAbeltwo').fadeIn();
    });

    //MODAL - ELIMINAR

    $('.Elim').click(function(e) {
        e.preventDefault();
        var cont = $(this).attr('clause');
        var action = 'infoClausula';
        $.ajax({

            url: 'http://localhost:80/Casas01/opc_page/getClause',
            type: 'POST',
            async: true,
            data: {
                action: action,
                Clausula: cont
            },


            success: function(response) {
                console.log(response);
                if (response != 'error') {

                    var info = JSON.parse(response);
                    $('.modal-content').html(
                        '<div class="modal-header" style="background-color: #b21f2d;"><h6 class="modal-title" style="color: #fff; text-align: center; font-size: 20px;">Eliminar Clausula</h6></div>' +
                        '<form class="form-horizontal" action="<?php echo constant('URL'); ?>/opc_calendar/updateclause" name = "form_deleteclauseModal" id = "form_deleteclauseModal" method="POST" onsubmit="event.preventDefault(); delDataClause();"> ' +
                        '    <div class="mod"> ' +
                        '      <label class="textModal" style="font-size: 16px;">Se eliminará el Clausula de </label>   ' +
                        '     <label class="textModalRed"> <i class="' + info.clau_Icon +
                        '"></i>  ' + info.clau_Descripcion + '</label>' +
                        '   </div> ' +
                        '     <input type="hidden" name="idClausula" id="idClausula" required="" value="' +
                        info.idClausula + '">' +
                        '    <input type="hidden" name="action" required="" value="delclause">' +
                        '   <div class="modal-footer">' +
                        '     <button type="button" class="btn btn-secondary" onclick="closeModaltwo();">Cancelar</button>' +
                        '     <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i>Aceptar</button>' +
                        '    </div>' +
                        '</form>');
                }
            },
            error: function(error) {
                console.log(error);
            }
        });

        $('.modalAbeltwo').fadeIn();
    });
}

function closeModaltwo() {
    //AUI SE LIMPIAN CAMPOS
    $('.addModal').html('');
    $('.modalAbeltwo').fadeOut();
}


function addDataClause() {

    $.ajax({

        url: 'http://localhost:80/Casas01/opc_page/addClause',
        type: 'POST',
        async: true,
        data: $('#form_addclauseModal').serialize(), //TOMA TODOS LOS INPUT DE FORMA SERIALIZADA


        success: function(response) {
            console.log(response);

            var info = JSON.parse(response);
            if (info == 'error') {
                $('.alertModal').html('<p style="color: red;"> Error al agregar Clausula.</p>');
            } else {
                getDatatwo();
                $('.clauIcon').html('');
                $('.clauDescrip').html('');
                $('.clauTipo').html('');

                $('.alertModal').html('<p style="color: green;"> Agregado Exitoso.</p>');
            }

        },
        error: function(error) {
            console.log(error);
        }
    });
}



function sendDataClause() {

    $.ajax({

        url: 'http://localhost:80/Casas01/opc_page/updateClause',
        type: 'POST',
        async: true,
        data: $('#form_updateclauseModal').serialize(), //TOMA TODOS LOS INPUT DE FORMA SERIALIZADA


        success: function(response) {
            console.log(response);

            var info = JSON.parse(response);
            if (info == 'error') {
                $('.alertModal').html('<p style="color: red;"> Error al actualizar Clausula.</p>');
            } else {
                $('.row' + info.idClausula + ' .celIcon').html(info.clau_Icon);
                $('.row' + info.idClausula + ' .celTipo').html(info.clau_Tipo);
                $('.row' + info.idClausula + ' .celDescrip').html(info.clau_Descrip);
                window.location.replace(
                    "http://localhost:80/Casas01/opc_page?success=9d09o9dikninasiomijhdjasjduhssjn");
            }

        },
        error: function(error) {
            console.log(error);
        }
    });
}


function delDataClause() {
    //alert("Enviar Datos");
    $.ajax({

        url: 'http://localhost:80/Casas01/opc_page/deleteClause',
        type: 'POST',
        async: true,
        data: $('#form_deleteclauseModal').serialize(), //TOMA TODOS LOS INPUT DE FORMA SERIALIZADA


        success: function(response) {
            console.log(response);

            if (response == 'error') {

                $('.alertModal').html('<p style="color: red;"> Error al eliminar Clausula.</php>');
            } else {
                window.location.replace(
                    "http://localhost:80/Casas01/opc_page?success=7hj7a7sdh77jjd7aunio0989w88vyn8f");
            }


        },
        error: function(error) {
            console.log(error);
        }
    });
}
</script>