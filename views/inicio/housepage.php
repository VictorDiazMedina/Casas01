<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title id="nameHouse">Adtile Fixed Nav</title>
    <meta name="author" content="Adtile">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- lightboxGallery -->
    <link href="assets/lightboxGallery/lightbox.min.css" rel="stylesheet" />

    <!-- Font-icon css -->
    <script src="https://kit.fontawesome.com/bd0ed12ca6.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>


    <link rel="stylesheet" href="assets/css/housepage.css">
    <link rel="stylesheet" href="assets/css/nav.css">



</head>
<header>
    <?php require 'views/login/nav.php'; ?>
</header>

<body>

    <!--contenido-->


    <?php $this->showMessages();?>


    <div class="elementHeader" id="elementHeader">
        <div class="elementHeaderProfile" id="elementHeaderProfile">

        </div>
        <div class="elementHeaderUpload">
            <div>
                <h2 class="profileHeaderInfo__userCasa" id="profileHeaderInfo__userCasa">CASA VERDE</h2>
                <br>
                <h3 class="profileHeaderInfo__userEstado" id="profileHeaderInfo__userEstado">CUERNAVACA</h3>
            </div>
        </div>
    </div>
    <div class="elementContent">
        <div class="elementInfo">

            <h2> Descripción </h2>
            <div class="gridDescrip" id="gridDescrip">
                Casa bonita en Jiutepec
            </div>
            <hr class="hrPage">

            <h2> Lo que ofrece este lugar</h2>
            <div id="divServicio" class="gridService">
                <p class="celIcon">🛌</p>
                <h4>4 camas</h4>
                <p class="celIcon">🛌</p>
                <h4>4 camas</h4>
                <p class="celIcon">🛌</p>
                <h4>4 camas</h4>
                <p class="celIcon">🛌</p>
                <h4>4 camas</h4>
                <p class="celIcon">🛌</p>
                <h4>4 camas</h4>
            </div>
            <hr class="hrPage">
            <h2> Qué debes saber </h2>
            <div class="gridClause">
                <div>
                    <h4>Reglas de la casa</h4>
                    <div id="divReglas" class="gridClauses">
                        <p class="celIcon">🛌</p>
                        <h4>4 camas</h4>
                        <p class="celIcon">🛌</p>
                        <h4>4 camas</h4>
                        <p class="celIcon">🛌</p>
                        <h4>4 camas</h4>
                        <p class="celIcon">🛌</p>
                        <h4>4 camas</h4>
                        <p class="celIcon">🛌</p>
                        <h4>4 camas</h4>
                    </div>
                </div>
                <div>
                    <h4>Salud y Seguridad</h4>
                    <div id="divSeguridad" class="gridClauses">
                        <p class="celIcon">🛌</p>
                        <h4>4 camas</h4>
                        <p class="celIcon">🛌</p>
                        <h4>4 camas</h4>
                        <p class="celIcon">🛌</p>
                        <h4>4 camas</h4>
                        <p class="celIcon">🛌</p>
                        <h4>4 camas</h4>
                        <p class="celIcon">🛌</p>
                        <h4>4 camas</h4>
                    </div>
                </div>
            </div>


            <hr class="hrPage">

            <h2> Ubicación</h2>
            <div class="maps">

            </div>
            <hr class="hrPage">

            <button class="btn btn-outline-success btn-lg btn-block"
                onclick="location.href='<?php echo constant('URL'); ?>/housecontract?idCasa=<?php echo $_GET['idCasa']; ?>'"
                type="button"> RENTAR CASA
            </button>

            <hr class="hrPage">
            <h2> Comentarios</h2>

            <div class="gridComentG" id="gridComentG">
                <div class="gridComent">
                    <div class="comentName"><b>German</b>
                        <div class="comentFech">
                            <div>octubre de 2021</div>
                        </div>
                    </div>
                    <div class="comentText">Excelente lugar, buenísima ubicación, limpio, ordenado, el anfitrión con
                        mucha
                        comunicación y disponibilidad, super recomendable.
                    </div>
                </div>
                <div class="gridComent">
                    <div class="comentName"><b>German</b>
                        <div class="comentFech">
                            <div>octubre de 2021</div>
                        </div>
                    </div>
                    <div class="comentText">Excelente lugar, buenísima ubicación, limpio, ordenado, el anfitrión con
                        mucha
                        comunicación y disponibilidad, super recomendable.
                    </div>
                </div>
                <div class="gridComent">
                    <div class="comentName"><b>German</b>
                        <div class="comentFech">
                            <div>octubre de 2021</div>
                        </div>
                    </div>
                    <div class="comentText">Excelente lugar, buenísima ubicación, limpio, ordenado, el anfitrión con
                        mucha
                        comunicación y disponibilidad, super recomendable.
                    </div>
                </div>
            </div>

            <br>
            <br>
            <form class="form-horizontal" action="" name="form_addcomment" id="form_addcomment" method="POST"
                onsubmit="event.preventDefault(); addDataComment();">
                <div class="alertModal"></div>
                <div class="form-coment">
                    <div class="form-coment2">
                        <div>
                            <label class="control-label">Nombre</label>
                            <input class="form-control" required="" name="commentNomb" id="commnetNomb" type="text"
                                placeholder="Escribe tu nombre">
                        </div>

                        <div>
                            <label class="control-label">Email</label>
                            <input class="form-control" required="" type="text" name="commentEmail" id="commentEmail"
                                placeholder="Escribe un correo válido">
                        </div>
                    </div>
                    <div>
                        <label class="control-label coment">Comentario</label>
                        <textarea class="form-control" required="" name="commentText" id="commentText"
                            placeholder="Comentario"></textarea>
                    </div>
                    <input type="hidden" name="idCasa" id="idCasa" required="" value="<?php echo $_GET['idCasa']; ?>">
                    <input type="hidden" name="action" required="" value="addComment">
                    <button class="btn btn-ter" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Publicar
                        Comentario</button>
                </div>

            </form>

        </div>

        <div class="elementImage">
            <div id="right1" class="image">
            </div>

            <div id="right2" class="image">
            </div>
            <div class="moreImage">
                <a href="#" id="abrir">Más Imágenes</a>
            </div>
        </div>

    </div>

    <!-- MODALES INTERNOS -->
    <div id="miModal" class="modalImage">
        <div class="flexImage" id="flex">
            <div class="contenido-modalImage">
                <div class="modal-headerImage flex">
                    <h2 id="galleryName"></h2><span class="closeImage" id="close">&times;</span>
                </div>
                <div class="modal-bodyImage">


                    <div class="gallery" id="ulGallery"></div>

                </div>
                <div class="footerImage"></div>
            </div>
        </div>
    </div>







    </div>
    <!--contenido end-->








    <script src="assets/lightboxGallery/lightbox-plus-jquery.min.js" type="text/javascript"></script>

    <script src="assets/prueba/js/jquery.min.js"></script>


    <script>
    var data = [];
    var copydata = [];



    async function getData() {
        data = await fetch('http://localhost:80/Casas01/housepage/getDataCommentJSON')
            .then(res => res.json())
            .then(json => json);
        this.copydata = [...this.data];

        renderData(data);
    }
    getData();

    function renderData(data) {
        var databody = document.querySelector('#gridComentG');

        let total = 0;
        databody.innerHTML = '';

        data.forEach(item => {

            databody.innerHTML += `<div class="gridComent">
                    <div class="comentName"><b>${item.comment_Nomb}</b>
                        <div class="comentFech">
                            <div>${item.comment_Fecha}</div>
                        </div>
                    </div>
                    <div class="comentText">${item.comment_Text}</div>
                </div>`;


        });
    }
    //MODA AGREGAR
    function addDataComment() {

        $.ajax({

            url: 'http://localhost:80/Casas01/housepage/addComment',
            type: 'POST',
            async: true,
            data: $('#form_addcomment').serialize(), //TOMA TODOS LOS INPUT DE FORMA SERIALIZADA


            success: function(response) {
                console.log(response);

                var info = JSON.parse(response);
                if (info == 'error') {
                    $('.alertModal').html('<p style="color: red;"> Error, verifica tu Email.</p>');
                } else {
                    getData();
                    document.getElementById("commnetNomb").value = "";
                    document.getElementById("commentEmail").value = "";
                    document.getElementById("commentText").value = "";

                    $('.alertModal').html('<p style="color: green;"> Agregado Exitoso.</p>');
                }

            },
            error: function(error) {
                console.log(error);
            }
        });
    }
    </script>

    <script>
    window.addEventListener('DOMContentLoaded', () => {
        const btn_menu = document.querySelector('.btn_menu');

        const cta = document.querySelector('.cta');
        if (btn_menu) {
            btn_menu.addEventListener('click', () => {
                const menu_items = document.querySelector('.menu_items');
                menu_items.classList.toggle('show');
            });
            cta.addEventListener('click', () => {
                const menu_items = document.querySelector('.menu_items');
                menu_items.classList.toggle('show');
            });
        }
    });
    </script>

    <script>
    var $body = $('html,body');
    let modal = document.getElementById('miModal');
    let flex = document.getElementById('flex');
    let abrir = document.getElementById('abrir');
    let cerrar = document.getElementById('close');

    abrir.addEventListener('click', function() {
        modal.style.display = 'block';
        $body.addClass('block-scroll');
    });

    cerrar.addEventListener('click', function() {
        modal.style.display = 'none';
        $body.removeClass('block-scroll');
    });
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
    var imgHouse = [];
    var galleryHouse = [];
    var servHouse = [];
    var clauHouse = [];

    let elementHeader = document.getElementById('elementHeader');
    let elementRight1 = document.getElementById('right1');
    let elementRight2 = document.getElementById('right2');

    // GALLERY HOUSE
    async function getGalleryHouse() {
        galleryHouse = await fetch('http://localhost:80/Casas01/housepage/galleryHouse', init)
            .then(res => res.json())
            .then(json => json);
        renderGalleryHouse(galleryHouse);
    }
    getGalleryHouse();

    function renderGalleryHouse(galleryHouse) {
        var databody = document.querySelector('#ulGallery');

        databody.innerHTML = '';

        galleryHouse.forEach(item => {

            databody.innerHTML +=
                `
            <a href="assets/image/anfitriones/<?php echo $_GET["idCasa"]; ?>/${item.img_Url}" data-lightbox="mygallery"><img src="assets/image/anfitriones/<?php echo $_GET["idCasa"]; ?>/${item.img_Url}"></a>
        `;
        });

    }
    // CLAUSE HOUSE
    async function getClauHouse() {
        clauHouse = await fetch('http://localhost:80/Casas01/housepage/clauHouse', init)
            .then(res => res.json())
            .then(json => json);
        renderClauHouse(clauHouse);
    }
    getClauHouse();

    function renderClauHouse(clauHouse) {
        var databodyR = document.querySelector('#divReglas');
        var databodyS = document.querySelector('#divSeguridad');

        databodyR.innerHTML = '';
        databodyS.innerHTML = '';
        clauHouse.forEach(item => {
            if (item.clau_Tipo == "Regla") {

                databodyR.innerHTML +=
                    `<p class="celIcon">${item.clau_Icon}</p>
                <h4>${item.clau_Descripcion}</h4>`;
            } else {
                databodyS.innerHTML +=
                    `<p class="celIcon">${item.clau_Icon}</p>
                <h4>${item.clau_Descripcion}</h4>`;
            }
        });
    }
    // SERVICE HOUSE
    async function getServHouse() {
        servHouse = await fetch('http://localhost:80/Casas01/housepage/servHouse', init)
            .then(res => res.json())
            .then(json => json);
        renderServHouse(servHouse);
    }
    getServHouse();

    function renderServHouse(servHouse) {
        var databody = document.querySelector('#divServicio');

        databody.innerHTML = '';
        servHouse.forEach(item => {

            databody.innerHTML +=
                `<p class="celIcon">${item.serv_Icon}</p>
                <h4>${item.serv_Cantidad} </h4>
                <h4>${item.serv_Descripcion}</h4>`;
        });
    }
    // IMG HOUSE
    async function getImgHouse() {
        imgHouse = await fetch('http://localhost:80/Casas01/housepage/imgHouse', init)
            .then(res => res.json())
            .then(json => json);
        renderImgHouse(imgHouse);
    }
    getImgHouse();

    function renderImgHouse(imgHouse) {

        imgHouse.forEach(item => {
            if (item.img_Tipo == "header") {
                elementHeader.style.backgroundImage =
                    'url("assets/image/anfitriones/<?php echo $_GET["idCasa"]; ?>/' + item.img_Url + '")';
            }
            if (item.img_Tipo == "right1") {
                elementRight1.style.backgroundImage =
                    'url("assets/image/anfitriones/<?php echo $_GET["idCasa"]; ?>/' + item.img_Url + '")';
            }
            if (item.img_Tipo == "right2") {
                elementRight2.style.backgroundImage =
                    'url("assets/image/anfitriones/<?php echo $_GET["idCasa"]; ?>/' + item.img_Url + '")';
            }
        });
    }
    // DATA HOUSE
    async function getDataHouse() {
        dataHouse = await fetch('http://localhost:80/Casas01/housepage/dataHouse', init)
            .then(res => res.json())
            .then(json => json);
        renderDataHouse(dataHouse);
    }
    getDataHouse();

    function renderDataHouse(dataHouse) {

        dataHouse.forEach(item => {
            $('.maps').html(' 📌 <a href="https://www.google.com/maps/search/?api=1&query=' + item
                .casa_Lati +
                ',' +
                item.casa_Long +
                '" target="_blank">Ver CASA marcada</a><iframe class="iframe" src="https://maps.google.com/?ll=' +
                item.casa_Lati + ',' + item.casa_Long +
                '&z=14&t=m&output=embed" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>'
            );

            $('#elementHeaderProfile').html(
                '<img src = "assets/image/anfitriones/' + item.idCasa + '/' + item.casa_Logo +
                '" class="profile_image" alt = "" >'
            );
            $('#galleryName').html("Galería de " + item.casa_Nombre);
            $('.profileHeaderInfo__userCasa').html(item.casa_Nombre);
            $('#nameHouse').html(item.casa_Nombre);

            $('.profileHeaderInfo__userEstado').html(item.casa_Region);
            $('.gridDescrip').html(item.casa_Descripcion);

        });
    }
    </script>

    <script>
    $(function() {
        var textArea = $('#casaDescrip'),
            hiddenDiv = $(document.createElement('div')),
            content = null;

        textArea.addClass('noscroll');
        hiddenDiv.addClass('hiddendiv');

        $(textArea).after(hiddenDiv);

        textArea.on('keyup', function() {
            content = $(this).val();
            content = content.replace(/n/g, '<br>');
            hiddenDiv.html(content + '<br class="lbr">');
            $(this).css('height', hiddenDiv.height());
        });
    });
    </script>
</body>

</html>