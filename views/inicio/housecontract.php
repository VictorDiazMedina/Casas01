<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Registro Contrato</title>
    <meta name="author" content="Adtile">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- Font-icon css -->
    <script src="https://kit.fontawesome.com/bd0ed12ca6.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- DatePicker -->
    <link rel="stylesheet" href="assets/css/flatpickr.min.css">

    <!-- DateRangePicker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>


    <link rel="stylesheet" href="assets/css/housecontract.css">
    <link rel="stylesheet" href="assets/css/nav.css">
</head>
<header>
    <?php require 'views/login/nav.php'; ?>
</header>

<body>

    <!--contenido-->


    <?php $this->showMessages();?>



    <main class="app-content">
        <!-- Buttons-->


        <div id="gridCargoForm" name="gridCargoForm">




        </div>


        <div class="tile mb-4">

            <div class="page-header">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="mb-3 line-head">Llena el formulario</h2>
                    </div>
                </div>
            </div>

            <form class="form-horizontal" action="<?php echo constant('URL'); ?>/housecontract/newContract"
                method="POST">
                <div><?php (isset($this->errorMessage))?  $this->errorMessage : '' ?></div>

                <div class="gridContract">
                    <div class="gridName">
                        <div>
                            <label class="control-label col-md-3">Nombre</label>
                            <input class="form-control form-control-lg" type="text" name="userNomb" id="userNomb"
                                placeholder="Escribe tu nombre" value="">
                        </div>
                        <div>
                            <label class="control-label col-md-3">Apellido</label>
                            <input class="form-control form-control-lg" type="text" name="userAp" id="userAp"
                                placeholder="Paterno" value="">
                        </div>
                        <div>
                            <label class="control-label col-md-3">Apellido</label>
                            <input class="form-control form-control-lg" type="text" name="userAm" id="userAm"
                                placeholder="Materno" value="">
                        </div>
                    </div>
                    <div>
                        <label class="control-label col-md-3">Número de INE</label>
                        <input class="form-control form-control-lg" type="text" name="userINE" id="userINE"
                            placeholder="No. reverso de su identifiación" value="">
                    </div>
                    <div class="gridFech">

                        <div onmouseover="haCambiado()">
                            <label class="control-label col-md-3">Fecha de Entrada y Salida</label>
                            <input type="text" name="trord" id="trord" placeholder="Confirme Fechas"
                                class="form-control form-control-lg" disabled>
                            <input type="hidden" name="FechE" id="FechE" value="">
                            <input type="hidden" name="FechS" id="FechS" value="">
                            <input type="hidden" name="renta" id="renta" value="">
                            <input type="hidden" name="total" id="total" value="">
                            <input type="hidden" name="promo" id="promo" value="0">
                        </div>


                        <div>
                            <label class="control-label col-md-3">Cargos</label>
                            <div class="gridCargos">
                                <div class="gridCargo">

                                    <label class="control-label">Renta: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">$</span>
                                        </div>
                                        <input name="rentass" id="rentass" class="form-control" type="text"
                                            placeholder="Pesos (MX)" disabled value="">
                                        <div class="input-group-append"><span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="gridCargo">

                                    <label class="control-label">Deposito: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">$</span>
                                        </div>
                                        <input name="deposito" id="deposito" class="form-control" type="text"
                                            placeholder="Pesos (MX)" disabled value="">
                                        <div class="input-group-append"><span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="gridCargo">

                                    <label class="control-label">Acticipo: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">$</span>
                                        </div>
                                        <input name="anticipo" id="anticipo" class="form-control" type="text"
                                            placeholder="Escriba la cantidad de Anticipo (MX)" onblur="myFunction()"
                                            value="">
                                        <div class="input-group-append"><span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="gridCargo">

                                    <label style="color:rgb(255, 125, 125);" class="control-label">Total: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">$</span>
                                        </div>
                                        <input name="totals" id="totals" class="form-control total" type="text"
                                            placeholder="Pesos (MX)" disabled value="">
                                        <div class="input-group-append"><span class="input-group-text">.00</span>
                                        </div>
                                    </div>

                                </div>

                            </div>


                        </div>


                    </div>



                </div>

                <input type="hidden" name="idCasa" id="idCasa" value="">
                <div class="tile-footer">
                    <button class="btn btn-outline-success btn-lg btn-block" type="submit"> REALIZAR CONTRATO
                    </button>
                </div>

            </form>

        </div>


    </main>
    <!--contenido end-->




    <script>
    var datos = {
        idCasa: "<?php echo $_GET["idCasa"]; ?>"
    };
    var init = {

        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(datos)
    };

    var data = '';

    async function getData() {
        data = await fetch('http://localhost:80/Casas01/housecontract/getPromoJSON', init)
            .then(res => res.json())
            .then(json => json);

        renderData(data);
    }
    getData();

    function renderData(data) {
        var databody = document.querySelector('#gridCargoForm');

        if (data == 'NULO') {
            databody.innerHTML = '';
        } else {


            databody.innerHTML = '';
            databody.innerHTML += `
            <div class="tile mb-4">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="mb-3 line-head">Promoción</h2>
                        </div>
                    </div>
                </div>
                <div>
                <div class="alertModal"></div>
                <form class="form-horizontal gridCargoForm"
                                        action="<?php echo constant('URL'); ?>housecontract/applyPromocion"
                                        name="form_Promo" id="form_Promo" method="POST"
                                        onsubmit="event.preventDefault(); sendDataPromo();">

                                        <label style="color:rgb(255, 125, 125);" class="control-label">Promoción:
                                        </label>
                                        <div class="input-group">

                                            <input name="promoCodigo" id="promoCodigo" class="form-control total"
                                                type="text" placeholder="Escribe código de la promoción" value="">

                                            <input type="hidden" name="idPromocion" id="idPromocion" required="" value="${data}">
                                            <input type="hidden" name="action" required="" value="updatePromo">
                                        </div>
                                        <div class="modal-footer">
                                            <button name="promo_button" id="promo_button" type="submit"
                                                class="btn btn-primary"><i
                                                    class="fa fa-fw fa-lg fa-check-circle"></i>Aplicar</button>
                                        </div>
                                    </form>

                </div>
            </div>`;

        }

    }


    function sendDataPromo() {

        $.ajax({

            url: 'http://localhost:80/Casas01/housecontract/applyPromocion',
            type: 'POST',
            async: true,
            data: $('#form_Promo').serialize(), //TOMA TODOS LOS INPUT DE FORMA SERIALIZADA

            success: function(response) {
                console.log(response);

                var info = JSON.parse(response);
                if (info == 'error') {

                    $('.alertModal').html('<p style="color: red;"> Código incorrecto</p>');


                } else {

                    $('#promo').val(info);
                    $('.alertModal').html('');
                    $('.gridCargoForm').html(
                        '<p style="color: green;"> <b>Promoción aplicada.</b> <span class="spanPromo">(Si no se refleja en Total, marque de nuevo sus fechas)</span></p>'
                    );

                }

            },
            error: function(error) {
                console.log(error);
            }
        });
    }
    </script>















    <script>
    var datos = {
        idCasa: "<?php echo $_GET["idCasa"]; ?>"
    };
    var init = {

        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(datos)
    };

    var dataHouse = [];
    var rentaX = 0;
    var renta = 0;
    var total = 0;

    // DATA HOUSE
    async function getDataHouse() {
        dataHouse = await fetch('http://localhost:80/Casas01/housecontract/dataHouse', init)
            .then(res => res.json())
            .then(json => json);
    }
    getDataHouse();

    function renderDataHouse(dataHouse, rentaX, promo) {

        dataHouse.forEach(item => {
            $('#idCasa').val(item.idCasa);
            $('#rentass').val(item.casa_Renta * rentaX);
            $('#deposito').val(item.casa_Deposito);
            $('#totals').val(((item.casa_Renta * rentaX) + item.casa_Deposito) - promo);

        });
    }

    function haCambiado() {
        if (/to/.test(document.getElementById("trord").value)) {
            var fechaini = new Date(document.getElementById("trord").value.split(' ')[0]);
            $('#FechE').val(document.getElementById("trord").value.split(' ')[0]);
            var fechafin = new Date(document.getElementById("trord").value.split(' ')[2]);
            $('#FechS').val(document.getElementById("trord").value.split(' ')[2]);
            $('#renta').val(document.getElementById("rentass").value);
            $('#total').val(document.getElementById("totals").value);
            var diasdif = fechafin.getTime() - fechaini.getTime();
            var contdias = Math.round(diasdif / (1000 * 60 * 60 * 24));
            var promo = document.getElementById("promo").value;

            renderDataHouse(dataHouse, contdias, promo);
        }
    }

    function myFunction() {
        if (document.getElementById("anticipo").value < (document.getElementById("total").value / 2)) {
            alert("Mínimo 50% de anticipo");
        }
    }
    </script>

    <script src="assets/prueba/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
    var datoF = {
        idCasa: "<?php echo $_GET["idCasa"]; ?>"
    };
    var init = {

        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(datoF)
    };

    var dataFechas = [];
    // DATA HOUSE
    async function getDataFechas() {
        dataFechas = await fetch('http://localhost:80/Casas01/housecontract/dataFechas', init)
            .then(res => res.json())
            .then(json => json);

        config = {
            "disable": dataFechas,
            minDate: "today",
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
                    shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov',
                        'Dic'
                    ],
                    longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                        'Septiembre',
                        'Octubre', 'Noviembre', 'Diciembre'
                    ],
                },
            }
        }

        flatpickr("div[type=date]", config);
        flatpickr("#trord", config);
    }
    getDataFechas();
    </script>



</body>

</html>