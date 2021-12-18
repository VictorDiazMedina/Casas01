<?php
    $anfitriones    = $this->d['anfitriones'];  
?>
<?php require 'header_admin.php'; ?>


<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Anfitriones</h1>
            <p>Al eliminar un anfitrión, eliminaras sus registros dependientes (Casas, Contratos . . .).</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Blank Page</a></li>
        </ul>
    </div>

    <div class="tile">
        <div class="tile-body">
            <div class="table-responsive">


                <div class="row1">
                    <div id="history-container">
                        <table width="100%" cellpadding="0">
                            <thead>
                                <tr>
                                    <th class="desblo" data-sort="nombre">Nombre<label><i class="fa fa-arrow-down"
                                                id="arrow"></i></label></th>
                                    <th class="desblo" data-sort="ap">A. Paterno<label><i class="fa fa-arrow-down"
                                                id="arrow"></i></label></th>
                                    <th class="desblo" data-sort="am">A. Materno<label><i class="fa fa-arrow-down"
                                                id="arrow"></i></label></th>
                                    <th class="desblo" data-sort="wpp">WhatsApp<label><i class="fa fa-arrow-down"
                                                id="arrow"></i></label></th>
                                    <th class="desblo" data-sort="cas">Casa<label><i class="fa fa-arrow-down"
                                                id="arrow"></i></label></th>
                                    <th class="desblo" data-sort="s">Status<label><i class="fa fa-arrow-down"
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

    <div class="modalAbel">
        <div class="bodyModalAbel">


            <!--ventana para Update--->
            <div class="modal-dialog">
                <div class="modal-content">


                </div>
            </div>
        </div>
    </div>
</main>





<script>
var data = [];
var copydata = [];
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

        case 'wpp':
            item.classList.add('blo');
            res = this.copydata.sort(compareWhats);
            break;

        case 'cas':
            item.classList.add('blo');
            res = this.copydata.sort(compareCas);
            break;

        case 's':
            item.classList.add('blo');
            res = this.copydata.sort(compareSta);
            break;

        default:
            res = this.copydata;
    }

    renderData(res);
}

function compareName(a, b) {
    if (a.user_Nombre.toLowerCase() > b.user_Nombre.toLowerCase()) return 1;
    if (b.user_Nombre.toLowerCase() > a.user_Nombre.toLowerCase()) return -1;
    return 0;
}

function compareAP(a, b) {
    if (a.user_APaterno.toLowerCase() > b.user_APaterno.toLowerCase()) return 1;
    if (b.user_APaterno.toLowerCase() > a.user_APaterno.toLowerCase()) return -1;
    return 0;
}

function compareAM(a, b) {
    if (a.user_AMaterno.toLowerCase() > b.user_AMaterno.toLowerCase()) return 1;
    if (b.user_AMaterno.toLowerCase() > a.user_AMaterno.toLowerCase()) return -1;
    return 0;
}

function compareWhats(a, b) {
    if (a.user_WhatsApp > b.user_WhatsApp) return 1;
    if (b.user_WhatsApp > a.user_WhatsApp) return -1;
    return 0;
}

function compareCas(a, b) {
    if (a.user_FechNac > b.user_FechNac) return 1;
    if (b.user_FechNac > a.user_FechNac) return -1;
    return 0;
}

function compareSta(a, b) {
    if (a.user_Status > b.user_Status) return 1;
    if (b.user_Status > a.user_Status) return -1;
    return 0;
}

async function getData() {
    data = await fetch('http://localhost:80/Casas01/admin_anfi/getHistoryJSON')
        .then(res => res.json())
        .then(json => json);
    this.copydata = [...this.data];

    renderData(data);
}
getData();

function renderData(data) {
    var databody = document.querySelector('#databody');
    var cellStatus = 'cellAcceso';
    var status = 'Autorizado';

    databody.innerHTML = '';
    data.forEach(item => {
        if (item.user_Status == 1) {
            cellAcceso = 'cellAcceso';
            status = 'Autorizado';
        } else {
            cellAcceso = 'cellNegado';
            status = 'Desautorizado';
        }
        databody.innerHTML += `<tr class="row${item.idUsuario}">
                        <td class="celNomb">${item.user_Nombre}</td>
                        <td class="celAP">${item.user_APaterno}</td>
                        <td class="celAM">${item.user_AMaterno}</td>
                        <td class="celFE">${item.user_WhatsApp}</td>
                        <td class="celFS">${item.user_FechNac}</td>
                        <td class="${cellAcceso}">${status}</td>
                        <td class = "acci">
                          <a class = "Edit" user="${item.idUsuario}" href="#">Acceso</a>
                          <a class = "Elim" user="${item.idUsuario}" href="#">Eliminar</a>
                        </td>
                       
                    </tr>`;
    });

    $('.Edit').click(function(e) {
        e.preventDefault();
        var cont = $(this).attr('user');
        var action = 'infoUser';
        $.ajax({

            url: 'http://localhost:80/Casas01/admin_anfi/getUser',
            type: 'POST',
            async: true,
            data: {
                action: action,
                user: cont
            },


            success: function(response) {
                console.log(response);
                if (response != 'error') {

                    var info = JSON.parse(response);
                    var option1 = 'active';
                    var option2 = 'active';
                    if (info.user_Status == 1) {
                        option1 = 'active';
                        option2 = '';
                    } else {
                        option1 = '';
                        option2 = 'active';
                    }
                    $('.modal-content').html(
                        '<div class="modal-header" style="background-color: rgb(37, 156, 73);"><h6 class="modal-title" style="color: #fff; text-align: center; font-size: 20px;"> Modificar Acceso </h6></div>' +
                        '<form class="form-horizontal" action="<?php echo constant('URL'); ?>/admin_anfi/updateStatus"  name = "form_updateStatusModal" id = "form_updateStatusModal" method="POST" onsubmit="event.preventDefault(); sendDataStatus();">' +
                        ' <div class="alertModal"></div>' +
                        '    <div class="mod"> ' +
                        '      <label class="textModal" style="font-size: 16px;"> Para </label>   ' +
                        '     <label class="textModalRed">' + info.user_Nombre + ' ' + info
                        .user_APaterno + ' ' + info.user_AMaterno + '</label>' +
                        '   </div> ' +
                        '    <div class="mod2"> ' +
                        '<div class="bs-component" style="margin-bottom: 15px;">' +
                        '    <div class="btn-group btn-group-toggle" data-toggle="buttons">' +
                        '        <label class="btn btn-acceso ' + option1 + '">' +
                        '            <input id="option1" type="radio" name="options" value="1" autocomplete="off" checked=""> Autorizar ' +
                        '        </label>' +
                        '        <label class="btn btn-negado ' + option2 + '">' +
                        '            <input id="option2" type="radio" name="options" value="0" autocomplete="off"> Desautorizar ' +
                        '        </label>' +
                        '    </div>' +
                        '</div>' +
                        '</div>' +
                        '     <input type="hidden" name="idUsuario" id="idUsuario" required="" value="' +
                        info.idUsuario + '">' +
                        '    <input type="hidden" name="action" required="" value="updateStatus">' +
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

    //MODAL - ELIMINAR

    $('.Elim').click(function(e) {
        e.preventDefault();
        var cont = $(this).attr('user');
        var action = 'infoUser';
        $.ajax({

            url: 'http://localhost:80/Casas01/admin_anfi/getUser',
            type: 'POST',
            async: true,
            data: {
                action: action,
                user: cont
            },


            success: function(response) {
                console.log(response);
                if (response != 'error') {

                    var info = JSON.parse(response);
                    $('.modal-content').html(
                        '<div class="modal-header" style="background-color: #b21f2d;"><h6 class="modal-title" style="color: #fff; text-align: center; font-size: 20px;">Eliminar Anfitrión</h6></div>' +
                        '<form class="form-horizontal" action="<?php echo constant('URL'); ?>/opc_calendar/updateStatus" name = "form_deleteStatusModal" id = "form_deleteStatusModal" method="POST" onsubmit="event.preventDefault(); delDataStatus();"> ' +
                        '    <div class="mod"> ' +
                        '      <label class="textModal" style="font-size: 16px;">Se eliminará el anfitrión </label>   ' +
                        '     <label class="textModalRed">' + info.user_Nombre + ' ' + info
                        .user_APaterno + ' ' + info.user_AMaterno + '</label>' +
                        '   </div> ' +
                        '     <input type="hidden" name="idUsuario" id="idUsuario" required="" value="' +
                        info.idUsuario + '">' +
                        '    <input type="hidden" name="action" required="" value="delStatus">' +
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

function sendDataStatus() {

    $.ajax({

        url: 'http://localhost:80/Casas01/admin_anfi/updateStatus',
        type: 'POST',
        async: true,
        data: $('#form_updateStatusModal').serialize(), //TOMA TODOS LOS INPUT DE FORMA SERIALIZADA


        success: function(response) {
            console.log(response);

            var info = JSON.parse(response);
            if (info == 'error') {
                $('.alertModal').html('<p style="color: red;"> Error al actualizar User.</p>');
            } else if (info == 'errorFecha') {
                $('.alertModal').html('<p style="color: red;"> Error, verifique las Fechas</p>');

            } else if (info == 'errorFechaCoin') {
                $('.alertModal').html(
                    '<p style="color: red;"> Error, las Fechas coinciden con otro User</p>');

            } else {
                getData();

                window.location.replace(
                    "http://localhost:80/Casas01/admin_anfi?success=9d09o9dikninasiomijhdjasjduhssjn");
            }

        },
        error: function(error) {
            console.log(error);
        }
    });
}


function delDataStatus() {

    $.ajax({

        url: 'http://localhost:80/Casas01/admin_anfi/deleteStatus',
        type: 'POST',
        async: true,
        data: $('#form_deleteStatusModal').serialize(), //TOMA TODOS LOS INPUT DE FORMA SERIALIZADA


        success: function(response) {
            console.log(response);

            if (response == 'error') {

                $('.alertModal').html('<p style="color: red;"> Error al eliminar anfitrión.</php>');
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


<?php require 'footer_admin.php'; ?>