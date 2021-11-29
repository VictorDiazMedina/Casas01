<?php require 'header_admin.php'; ?>

<?php 
$meses          = $this->d['meses'];
$contratos      = $this->d['contratos'];
$rentas         = $this->d['rentas']; 
$labelsTiempo   = $this->d['labelsTiempo'];
$colorTiempo    = $this->d['colorTiempo']; 
$labelsRentas   = $this->d['labelsRentas'];
$colorRentas    = $this->d['colorRentas'];?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.js"
    integrity="sha512-CWVDkca3f3uAWgDNVzW+W4XJbiC3CH84P2aWZXj+DqI6PNbTzXbl1dIzEHeNJpYSn4B6U8miSZb/hCws7FnUZA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Reportes</h1>
            <p>Reportes</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Blank Page</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Tiempo de Renta</h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <canvas class="embed-responsive-item" id="chart1"></canvas>
                    <div class="filter-container">
                        <select id="scategory" class="custom-select">
                            <option value="">Ver información en Lista</option>
                            <?php
                                for ($x = 0; $x < count($labelsTiempo); $x++) {
                                    echo "<option class='optionTiempo' style='background-color: ".$colorTiempo[$x]."' disabled>".$labelsTiempo[$x]."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Total de Rentas</h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <canvas class="embed-responsive-item" id="pieChart"></canvas>

                </div>
                <div class="filter-container">
                    <select id="scategory" class="custom-select">
                        <option value="">Ver información en Lista</option>
                        <?php
                                for ($x = 0; $x < count($labelsRentas); $x++) {
                                    echo "<option class='optionTiempo' style='background-color: ".$colorRentas[$x]."' disabled>".$labelsRentas[$x]."</option>";
                                }
                            ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="tile">
        <div class="tile-body">
            <div class="table-responsive">

                <form class="form-horizontal" action="<?php echo constant('URL'); ?>/admin_report/newPromo"
                    method="POST">
                    <div><?php (isset($this->errorMessage))?  $this->errorMessage : '' ?></div>

                    <h1>Promociones</h1>

                    <div class="form-group">
                        <label for="houseSelect">Selecciona Casa</label>
                        <select class="form-control" name="houseSelect" id="houseSelect">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="promo_Codigo">Código</label>
                        <input class="form-control" id="promo_Codigo" name="promo_Codigo" type="text"
                            placeholder="Escribe el código">
                    </div>

                    <div class="form-group">
                        <label class="control-label">Cantidad</label>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                <input class="form-control" name="promo_Cantidad" id="promo_Cantidad" type="text"
                                    placeholder="MX">
                                <div class="input-group-append"><span class="input-group-text">.00</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i
                                class="fa fa-fw fa-lg fa-check-circle"></i>Guardar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <div class="tile">
        <div class="tile-body">
            <div class="table-responsive">


                <div class="row1">
                    <div id="history-container">
                        <table width="100%" cellpadding="0">
                            <thead>
                                <tr>
                                    <th class="desblo" data-sort="nombre">Casa<label><i class="fa fa-arrow-down"
                                                id="arrow"></i></label></th>
                                    <th class="desblo" data-sort="cantidad">Cantidad<label><i class="fa fa-arrow-down"
                                                id="arrow"></i></label></th>
                                    <th class="desblo" data-sort="codigo">Código<label><i class="fa fa-arrow-down"
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

        case 'cantidad':
            item.classList.add('blo');
            res = this.copydata.sort(compareAP);
            break;

        case 'codigo':
            item.classList.add('blo');
            res = this.copydata.sort(compareAM);
            break;

        default:
            res = this.copydata;
    }

    renderData(res);
}

function compareName(a, b) {
    if (a.promo_Codigo.toLowerCase() > b.promo_Codigo.toLowerCase()) return 1;
    if (b.promo_Codigo.toLowerCase() > a.promo_Codigo.toLowerCase()) return -1;
    return 0;
}

function compareAP(a, b) {
    if (a.promo_Cantidad.toLowerCase() > b.promo_Cantidad.toLowerCase()) return 1;
    if (b.promo_Cantidad.toLowerCase() > a.promo_Cantidad.toLowerCase()) return -1;
    return 0;
}

function compareAM(a, b) {
    if (a.idCasa.toLowerCase() > b.idCasa.toLowerCase()) return 1;
    if (b.idCasa.toLowerCase() > a.idCasa.toLowerCase()) return -1;
    return 0;
}

async function getData() {
    data = await fetch('http://localhost:80/Casas01/admin_report/getHistoryJSON')
        .then(res => res.json())
        .then(json => json);
    this.copydata = [...this.data];

    renderData(data);
}
getData();

function renderData(data) {
    var databody = document.querySelector('#databody');


    databody.innerHTML = '';
    data.forEach(item => {

        databody.innerHTML += `<tr class="row${item.idPromocion}">
                        <td class="celNomb">${item.idCasa}</td>
                        <td class="celAP">${item.promo_Cantidad}</td>
                        <td class="celAM">${item.promo_Codigo}</td>
                        <td class = "acci">
                          <a class = "Edit" promo="${item.idPromocion}" href="#">Actualizar</a>
                          <a class = "Elim" promo="${item.idPromocion}" href="#">Eliminar</a>
                        </td>
                       
                    </tr>`;
    });

    $('.Edit').click(function(e) {
        e.preventDefault();
        var cont = $(this).attr('promo');
        var action = 'infoPromo';
        $.ajax({

            url: 'http://localhost:80/Casas01/admin_report/getPromo',
            type: 'POST',
            async: true,
            data: {
                action: action,
                promo: cont
            },


            success: function(response) {
                console.log(response);
                if (response != 'error') {

                    var info = JSON.parse(response);
                    $('.modal-content').html(
                        '<div class="modal-header" style="background-color: rgb(37, 156, 73);"><h6 class="modal-title" style="color: #fff; text-align: center; font-size: 20px;"> Actualizar Promoción </h6></div>' +
                        '<form class="form-horizontal" action="<?php echo constant('URL'); ?>admin_report/updatePromo"  name = "form_updatePromocionModal" id = "form_updatePromocionModal" method="POST" onsubmit="event.preventDefault(); sendDataPromo();">' +
                        ' <div class="alertModal"></div>' +
                        '   <div class="mod4"> ' +
                        '     <div class="rowOne">    ' +
                        '       <div class="One">' +
                        '         <div>' +
                        '           <label class="textModal">Código</label>' +
                        '           <input class="form-control" type="text" name="promoCodigo" id="promoCodigo" placeholder="Nombre nuevo" required="" value="' +
                        info.promo_Codigo + '">' +
                        '         </div>' +
                        '         <div>' +
                        '           <label class="textModal">Cantidad</label>' +
                        '           <input class="form-control" type="text" name="promoCantidad" id="promoCantidad" placeholder="Apellido Paterno" required="" value="' +
                        info.promo_Cantidad + '">' +
                        '         </div>' +
                        '       </div>' +
                        '     </div>' +
                        '   </div>' +
                        '    <input type="hidden" name="idCasa" id="idCasa" required="" value="' +
                        info.idCasa + '">' +
                        '    <input type="hidden" name="idPromocion" id="idPromocion" required="" value="' +
                        info.idPromocion + '">' +
                        '    <input type="hidden" name="action" required="" value="updatePromo">' +
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
        var cont = $(this).attr('promo');
        var action = 'infoPromo';
        $.ajax({

            url: 'http://localhost:80/Casas01/admin_report/getpromo',
            type: 'POST',
            async: true,
            data: {
                action: action,
                promo: cont
            },


            success: function(response) {
                console.log(response);
                if (response != 'error') {

                    var info = JSON.parse(response);
                    $('.modal-content').html(
                        '<div class="modal-header" style="background-color: #b21f2d;"><h6 class="modal-title" style="color: #fff; text-align: center; font-size: 20px;">Eliminar Promoción</h6></div>' +
                        '<form class="form-horizontal" action="<?php echo constant('URL'); ?>/opc_calendar/updatePromocion" name = "form_deletePromocionModal" id = "form_deletePromocionModal" method="POST" onsubmit="event.preventDefault(); delDataPromocion();"> ' +
                        '    <div class="mod"> ' +
                        '      <label class="textModal" style="font-size: 16px;">Se eliminará la Promoción </label>   ' +
                        '     <label class="textModalRed">' + info.promo_Codigo + '</label>' +
                        '   </div> ' +
                        '     <input type="hidden" name="idPromocion" id="idPromocion" required="" value="' +
                        info.idPromocion + '">' +
                        '    <input type="hidden" name="action" required="" value="delPromocion">' +
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

function sendDataPromo() {

    $.ajax({

        url: 'http://localhost:80/Casas01/admin_report/updatePromocion',
        type: 'POST',
        async: true,
        data: $('#form_updatePromocionModal').serialize(), //TOMA TODOS LOS INPUT DE FORMA SERIALIZADA


        success: function(response) {
            console.log(response);

            var info = JSON.parse(response);
            if (info == 'error') {
                $('.alertModal').html('<p style="color: red;"> Error al actualizar promo.</p>');
            } else {
                getData();
                closeModal();
            }

        },
        error: function(error) {
            console.log(error);
        }
    });
}


function delDataPromocion() {
    //alert("Enviar Datos");
    $.ajax({

        url: 'http://localhost:80/Casas01/admin_report/deletePromocion',
        type: 'POST',
        async: true,
        data: $('#form_deletePromocionModal').serialize(), //TOMA TODOS LOS INPUT DE FORMA SERIALIZADA


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


<script>
var datas = [];
var copydata = [];



async function getDatas() {
    datas = await fetch('http://localhost:80/Casas01/admin_report/getDataCasasJSON')
        .then(res => res.json())
        .then(json => json);

    renderDatas(datas);
}
getDatas();

function renderDatas(datas) {
    var databodys = document.querySelector('#houseSelect');

    let total = 0;
    databodys.innerHTML = '';

    datas.forEach(item => {
        databodys.innerHTML +=
            `<option value="${item.idCasa}">${item.casa_Nombre}</option>`;
    });
}
</script>

<script>
var ctx = document.getElementById('chart1').getContext('2d');
//Asignar json generado por php a la variable JavaScript
var mesesArray = <?php echo json_encode($meses); ?>;
var contratosArray = <?php echo json_encode($contratos); ?>;
var labelsTiempoArray = <?php echo json_encode($labelsTiempo); ?>;
var colorTiempoArray = <?php echo json_encode($colorTiempo); ?>;

var chart1 = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: mesesArray,
        datasets: [{
            label: '',
            data: contratosArray,
            backgroundColor: colorTiempoArray
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }

});
</script>

<script type="text/javascript" src="assets/js/plugins/chart.js"></script>

<script type="text/javascript">
var rentasArray = <?php echo json_encode($rentas); ?>;

var ctxpo = document.getElementById('pieChart').getContext('2d');
var polarChart = new Chart(ctxpo).PolarArea(rentasArray);
</script>
<?php require 'footer_admin.php'; ?>