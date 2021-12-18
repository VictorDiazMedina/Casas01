<?php require 'header_anfi.php'; ?>

<!--contenido-->


<div class="content">

    <?php $this->showMessages();?>

    <div class="card">
        <h3 class="col-md-8">CALENDARIO: Anfitrión <?php echo $user->getUserWhats()?></h3>
    </div>



    <div class="tile">

        <div class="tile-body">
            <div><?php (isset($this->errorMessage))?  $this->errorMessage : '' ?></div>


            <div class="grid">

                <div class="row2">
                    <div type="date"></div>
                </div>

                <div class="row3">
                    <section id="expenses-recents">
                        <h2>Contratos Próximos</h2>
                        <?php
                if($fechasPend === NULL){
                //showError('Error al cargar los datos');
                  
                  }else{
                
                    foreach ($fechasPend as $fecha) { 
                      if ((date('Y-m-d') >=  $fecha->getContFechEntrada()) ){
              ?>
                        <div class='preview-expense1'>
                            <div class="left">
                                <div class="expense-date"><?php echo $fecha->getContAPaterArren(); ?></div>
                                <div class="expense-title"><?php echo $fecha->getContNombreArren(); ?></div>
                            </div>
                            <div class="right">
                                <div class="expense-amount"><?php echo $fecha->getContFechEntrada();?></div>
                            </div>
                        </div>

                        <?php
                      }else{
                      ?>
                        <div class='preview-expense2'>
                            <div class="left">
                                <div class="expense-date"><?php echo $fecha->getContAPaterArren(); ?></div>
                                <div class="expense-title"><?php echo $fecha->getContNombreArren(); ?></div>
                            </div>
                            <div class="right">
                                <div class="expense-amount"><?php echo $fecha->getContFechEntrada();?></div>
                            </div>
                        </div>
                        <?php
                      }
                    }
                  } 
                     ?>
                    </section>
                </div>

                <div class="row1">
                    <div id="history-container">
                        <table width="100%" cellpadding="0">
                            <thead>
                                <tr>
                                    <th class="desblo" data-sort="nombre">Nombre Arren.<label><i
                                                class="fa fa-arrow-down" id="arrow"></i></label></th>
                                    <th class="desblo" data-sort="ap">A. Paterno<label><i class="fa fa-arrow-down"
                                                id="arrow"></i></label></th>
                                    <th class="desblo" data-sort="am">A. Materno<label><i class="fa fa-arrow-down"
                                                id="arrow"></i></label></th>
                                    <th class="desblo" data-sort="fE">Fecha Entrada<label><i class="fa fa-arrow-down"
                                                id="arrow"></i></label></th>
                                    <th class="desblo" data-sort="fS">Fecha Salida<label><i class="fa fa-arrow-down"
                                                id="arrow"></i></label></th>
                                    <th class="desblo" data-sort="a">Renta Total<label><i class="fa fa-arrow-down"
                                                id="arrow"></i></label></th>
                                    <th class="acc">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="databody">

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


        </div>
    </div>


</div>


<div class="modalAbel">
    <div class="bodyModalAbel">


        <!--ventana para Update--->
        <div class="modal-dialog">
            <div class="modal-content">


            </div>
        </div>
    </div>
</div>

</div>


<script type="text/javascript">
$(document).ready(function() {

    $(window).load(function() {
        $(".cargando").fadeOut(1000);
    });

    //Ocultar mensaje
    setTimeout(function() {
        $("#contenMsjs").fadeOut(1000);
    }, 3000);



    $('.btnBorrar').click(function(e) {
        e.preventDefault();
        var id = $(this).attr("id");

        var dataString = 'id=' + id;
        url = "recib_Delete.php";
        $.ajax({
            type: "POST",
            url: url,
            data: dataString,
            success: function(data) {
                window.location.href = "index.php";
                $('#respuesta').html(data);
            }
        });
        return false;

    });


});
</script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
config = {

    "disable": [<?php echo $fechasAll?>],
    mode: "range",
    inline: true,
    dateFormat: "Y-m-d",

    locale: {
        firstDayOfWeek: 1,
        weekdays: {
            shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
            longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        },
        months: {
            shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
            longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                'Octubre', 'Noviembre', 'Diciembre'
            ],
        },
    }
}

flatpickr("div[type=date]", config);
</script>









<script>
var data = [];
var copydata = [];
const sdate = document.querySelector('#sdate');
const scategory = document.querySelector('#scategory');
const sorts = document.querySelectorAll('th');
const sort = document.querySelectorAll('th');



sorts.forEach(item => {
    item.addEventListener('click', e => {
        sort.forEach(items => {
            items.classList.remove('blo');
        });

        if (item.dataset.sort) {
            sortBy(item.dataset.sort, item);
        }
    });
});

function sortBy(name, item) {
    this.copydata = [...this.data];
    let res;

    switch (name) {
        case 'nombre':
            item.classList.add('blo');
            res = this.copydata.sort(compareName);
            break;

        case 'ap':
            item.classList.add('blo');
            res = this.copydata.sort(compareAP);
            break;

        case 'am':
            item.classList.add('blo');
            res = this.copydata.sort(compareAM);
            break;

        case 'fE':
            item.classList.add('blo');
            res = this.copydata.sort(compareDateE);
            break;

        case 'fS':
            item.classList.add('blo');
            res = this.copydata.sort(compareDateS);
            break;

        case 'a':
            item.classList.add('blo');
            res = this.copydata.sort(compareAccount);
            break;

        default:
            res = this.copydata;
    }

    renderData(res);
}

function compareName(a, b) {
    if (a.cont_NombreArren.toLowerCase() > b.cont_NombreArren.toLowerCase()) return 1;
    if (b.cont_NombreArren.toLowerCase() > a.cont_NombreArren.toLowerCase()) return -1;
    return 0;
}

function compareAP(a, b) {
    if (a.cont_APaterArren.toLowerCase() > b.cont_APaterArren.toLowerCase()) return 1;
    if (b.cont_APaterArren.toLowerCase() > a.cont_APaterArren.toLowerCase()) return -1;
    return 0;
}

function compareAM(a, b) {
    if (a.cont_AMaterArren.toLowerCase() > b.cont_AMaterArren.toLowerCase()) return 1;
    if (b.cont_AMaterArren.toLowerCase() > a.cont_AMaterArren.toLowerCase()) return -1;
    return 0;
}

function compareDateE(a, b) {
    if (a.cont_FechEntrada > b.cont_FechEntrada) return 1;
    if (b.cont_FechEntrada > a.cont_FechEntrada) return -1;
    return 0;
}

function compareDateS(a, b) {
    if (a.cont_FechSalida > b.cont_FechSalida) return 1;
    if (b.cont_FechSalida > a.cont_FechSalida) return -1;
    return 0;
}

function compareAccount(a, b) {
    if (a.cont_MontoTotal > b.cont_MontoTotal) return 1;
    if (b.cont_MontoTotal > a.cont_MontoTotal) return -1;
    return 0;
}

async function getData() {
    data = await fetch('http://localhost:80/Casas01/opc_calendar/getHistoryJSON')
        .then(res => res.json())
        .then(json => json);
    this.copydata = [...this.data];

    renderData(data);
}
getData();

function renderData(data) {
    var databody = document.querySelector('#databody');
    let total = 0;
    databody.innerHTML = '';
    data.forEach(item => {

        databody.innerHTML += `<tr class="row${item.idContrato}">
                        <td class="celNomb">${item.cont_NombreArren}</td>
                        <td class="celAP">${item.cont_APaterArren}</td>
                        <td class="celAM">${item.cont_AMaterArren}</td>
                        <td class="celFE">${item.cont_FechEntrada}</td>
                        <td class="celFS">${item.cont_FechSalida}</td>
                        <td>$${item.cont_MontoTotal}</td>
                        <td class = "acci">
                          <a class = "Edit" contract="${item.idContrato}" href="#">Editar</a>
                          <a class = "Elim" contract="${item.idContrato}" href="#">Eliminar</a>
                        </td>
                       
                    </tr>`;
    });

    $('.Edit').click(function(e) {
        e.preventDefault();
        var cont = $(this).attr('contract');
        var action = 'infoContrato';
        $.ajax({

            url: 'http://localhost:80/Casas01/opc_calendar/getContract',
            type: 'POST',
            async: true,
            data: {
                action: action,
                contrato: cont
            },


            success: function(response) {
                console.log(response);
                if (response != 'error') {

                    var info = JSON.parse(response);
                    $('.modal-content').html(
                        '<div class="modal-header" style="background-color: rgb(37, 156, 73);"><h6 class="modal-title" style="color: #fff; text-align: center; font-size: 20px;"> Actualizar Información </h6></div>' +
                        '<form class="form-horizontal" action="<?php echo constant('URL'); ?>/opc_calendar/updateContract"  name = "form_updateContractModal" id = "form_updateContractModal" method="POST" onsubmit="event.preventDefault(); sendDataContract();">' +
                        ' <div class="alertModal"></div>' +
                        '   <div class="mod"> ' +
                        '     <div class="rowOne">    ' +
                        '       <div class="One">' +
                        '         <div>' +
                        '           <label class="textModal">Nombre Arren.</label>' +
                        '           <input class="form-control" type="text" name="contNombreArren" id="contNombreArren" placeholder="Nombre nuevo" required="" value="' +
                        info.cont_NombreArren + '">' +
                        '         </div>' +
                        '         <div>' +
                        '           <label class="textModal">APaterno</label>' +
                        '           <input class="form-control" type="text" name="contAPaterArren" id="contAPaterArren" placeholder="Apellido Paterno" required="" value="' +
                        info.cont_APaterArren + '">' +
                        '         </div>' +
                        '         <div>   ' +
                        '           <label class="textModal">AMaterno</label>' +
                        '           <input class="form-control" type="text" name="contAMaterArren" id="contAMaterArren" placeholder="Apellido Materno" required="" value="' +
                        info.cont_AMaterArren + '">' +
                        '         </div>' +
                        '       </div>' +
                        '     </div>' +
                        '     <div class="rowDouble">' +
                        '       <div class="double">' +
                        '         <div>' +
                        '           <label class="textModal">Fecha Entrada</label>' +
                        '           <input class="form-control" type="date" name="contFechEntrada" id="contFechEntrada" required="" value="' +
                        info.cont_FechEntrada + '">' +
                        '         </div>' +
                        '         <div>   ' +
                        '           <label class="textModal">Fecha Salida</label>' +
                        '           <input class="form-control" type="date" name="contFechSalida" id="contFechSalida" required="" value="' +
                        info.cont_FechSalida + '">' +
                        '         </div>' +
                        '       </div>' +
                        '     </div>' +
                        '   </div>' +
                        '    <input type="hidden" name="idCasa" id="idCasa" required="" value="' +
                        info.idCasa + '">' +
                        '    <input type="hidden" name="idContrato" id="idContrato" required="" value="' +
                        info.idContrato + '">' +
                        '    <input type="hidden" name="action" required="" value="updateContract">' +
                        '   <div class="modal-footer">' +
                        '     <button type="button" class="btn btn-secondary" onclick="closeModal();">Cerrar</button>' +
                        '     <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar</button>' +
                        '    </div>' +
                        '</form>');
                }
            },
            error: function(error) {
                console.log(error);
            }
        });

        $('.modalAbel').fadeIn();
    });

    //MODAL - ELIMINAR

    $('.Elim').click(function(e) {
        e.preventDefault();
        var cont = $(this).attr('contract');
        var action = 'infoContrato';
        $.ajax({

            url: 'http://localhost:80/Casas01/opc_calendar/getContract',
            type: 'POST',
            async: true,
            data: {
                action: action,
                contrato: cont
            },


            success: function(response) {
                console.log(response);
                if (response != 'error') {

                    var info = JSON.parse(response);
                    $('.modal-content').html(
                        '<div class="modal-header" style="background-color: #b21f2d;"><h6 class="modal-title" style="color: #fff; text-align: center; font-size: 20px;">Eliminar Contrato</h6></div>' +
                        '<form class="form-horizontal" action="<?php echo constant('URL'); ?>/opc_calendar/updateContract" name = "form_deleteContractModal" id = "form_deleteContractModal" method="POST" onsubmit="event.preventDefault(); delDataContract();"> ' +
                        '    <div class="mod"> ' +
                        '      <label class="textModal" style="font-size: 16px;">Se eliminará el contrato de </label>   ' +
                        '     <label class="textModalRed">' + info.cont_NombreArren + ' ' +
                        info.cont_APaterArren + ' ' + info.cont_AMaterArren + '</label>' +
                        '   </div> ' +
                        '     <input type="hidden" name="idContrato" id="idContrato" required="" value="' +
                        info.idContrato + '">' +
                        '    <input type="hidden" name="action" required="" value="delContract">' +
                        '   <div class="modal-footer">' +
                        '     <button type="button" class="btn btn-secondary" onclick="closeModal();">Cancelar</button>' +
                        '     <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i>Aceptar</button>' +
                        '    </div>' +
                        '</form>');
                }
            },
            error: function(error) {
                console.log(error);
            }
        });

        $('.modalAbel').fadeIn();
    });
}

function closeModal() {
    $('.modalAbel').fadeOut();
}

function sendDataContract() {

    $.ajax({

        url: 'http://localhost:80/Casas01/opc_calendar/updateContract',
        type: 'POST',
        async: true,
        data: $('#form_updateContractModal').serialize(), //TOMA TODOS LOS INPUT DE FORMA SERIALIZADA


        success: function(response) {
            console.log(response);

            var info = JSON.parse(response);
            if (info == 'error') {
                $('.alertModal').html('<p style="color: red;"> Error al actualizar Contrato.</p>');
            } else if (info == 'errorFecha') {
                $('.alertModal').html('<p style="color: red;"> Error, verifique las Fechas</p>');

            } else if (info == 'errorFechaCoin') {
                $('.alertModal').html(
                    '<p style="color: red;"> Error, las Fechas coinciden con otro Contrato</p>');

            } else {
                $('.row' + info.idContrato + ' .celNomb').html(info.cont_NombreArren);
                $('.row' + info.idContrato + ' .celAP').html(info.cont_APaterArren);
                $('.row' + info.idContrato + ' .celAM').html(info.cont_AMaterArren);
                $('.row' + info.idContrato + ' .celFE').html(info.cont_FechEntrada);
                $('.row' + info.idContrato + ' .celFS').html(info.cont_FechSalida);

                window.location.replace(
                    "http://localhost:80/Casas01/opc_calendar?success=9d09o9dikninasiomijhdjasjduhssjn");
            }

        },
        error: function(error) {
            console.log(error);
        }
    });
}


function delDataContract() {

    $.ajax({

        url: 'http://localhost:80/Casas01/opc_calendar/deleteContract',
        type: 'POST',
        async: true,
        data: $('#form_deleteContractModal').serialize(), //TOMA TODOS LOS INPUT DE FORMA SERIALIZADA


        success: function(response) {
            console.log(response);

            if (response == 'error') {

                $('.alertModal').html('<p style="color: red;"> Error al eliminar Contrato.</php>');
            } else {
                getData();
                closeModal();

                // window.location.replace("http://localhost:80/Casas01/opc_calendar?success=7hj7a7sdh77jjd7aunio0989w88vyn8f");
            }


        },
        error: function(error) {
            console.log(error);
        }
    });
}
</script>


<?php require 'footer_anfi.php'; ?>