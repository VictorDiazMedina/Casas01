<?php require 'header_anfi.php'; ?>


<?php
    $imgH      = $this->d['imgH'];
    $imgR1     = $this->d['imgR1']; 
    $imgR2     = $this->d['imgR2'];
?>

<!--contenido-->
<div class="content">

    <?php $this->showMessages();?>


    <div class="elementHeader"
        style="background-image: url('assets/image/anfitriones/<?php echo $house->getId()?>/<?php echo $imgH?>');">
        <div class="elementHeaderProfile">
            <img src="assets/image/anfitriones/<?php echo $house->getId()?>/<?php echo $house->getCasaLogo()?>"
                class="logohouse_image" alt="">
        </div>
        <div class="elementHeaderUpload">
            <div>
                <h2 class="profileHeaderInfo__userCasa"><?php echo $house->getCasaNombre()?></h2>
                <br>
                <h3 class="profileHeaderInfo__userEstado"><?php echo $house->getCasaRegion()?></h3>
            </div>

            <div id="div_Image">
                <label class="p_Text" data-toggle="tooltip">
                    <input type="file" class="sr-only" id="input" name="image" accept="image/*" onclick="header()">Subir
                    Imagen
                </label>
            </div>

        </div>
    </div>

    <div class="elementContent">
        <div class="elementInfo">

            <h2> Descripción </h2>
            <form class="form-horizontal" action="<?php echo constant('URL'); ?>/opc_page/updateHouseDescrip"
                method="POST">
                <div><?php (isset($this->errorMessage))?  $this->errorMessage : '' ?></div>

                <div class="gridDescrip">
                    <div class="topDesc">
                        <textarea class="form-control" name="casaDescrip" id="casaDescrip"
                            placeholder="Escribe una descripción de la casa"><?php echo $house->getCasaDescrip()?></textarea>
                    </div>


                    <div class="leftBtn">
                        <button class="btn btn-primary" type="submit"><i
                                class="fa fa-fw fa-lg fa-check-circle"></i>Guardar</button>

                    </div>
                </div>
            </form>
            <hr class="hrPage">
            <h2> Lo que ofrece este lugar</h2>
            <div class="gridService">
                <div id="history-container">
                    <table width="100%" cellpadding="0">
                        <thead>
                            <tr>
                                <th class="desblo" data-sort="nombre">Icono<label>
                                        </i></label></th>
                                <th class="desblo" data-sort="ap">Cantidad<label>
                                        </i></label></th>
                                <th class="desblo" data-sort="am">Descripción<label>
                                        </i></label></th>
                                <th class="acc">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="databody">

                        </tbody>
                    </table>
                </div>
                <div id="buttonAdd" class="buttonAdd">
                    <button class="btn btn-ter"><i class="fa fa-fw fa-lg fa-plus-circle"></i>Agregar</button>
                </div>
            </div>
            <hr class="hrPage">
            <h2> Qué debes saber </h2>
            <div class="gridService">
                <div id="history-container">
                    <table width="100%" cellpadding="0">
                        <thead>
                            <tr>
                                <th class="desblo" data-sort="nombre">Icono<label>
                                        </i></label></th>
                                <th class="desblo" data-sort="ap">Descripción<label>
                                        </i></label></th>
                                <th class="desblo" data-sort="am">Tipo<label>
                                        </i></label></th>
                                <th class="acc">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="databodytwo">

                        </tbody>
                    </table>
                </div>
                <div id="buttonAdd" class="buttonAdd">
                    <button class="btn btn-tertwo"><i class="fa fa-fw fa-lg fa-plus-circle"></i>Agregar</button>
                </div>
            </div>

        </div>

        <div class="elementImage">
            <div style="background-image: url(assets/image/anfitriones/<?php echo $house->getId()?>/<?php echo $imgR1?>);"
                class="image">

                <label class="p_Text" data-toggle="tooltip">
                    <input type="file" class="sr-only" id="inputRight1" name="image" accept="image/*"
                        onclick="right1()">Subir Imagen
                </label>
            </div>

            <div style="background-image: url(assets/image/anfitriones/<?php echo $house->getId()?>/<?php echo $imgR2?>);"
                class="image">

                <label class="p_Text" data-toggle="tooltip">
                    <input type="file" class="sr-only" id="inputRight2" name="image" accept="image/*"
                        onclick="right2()">Subir Imagen
                </label>
            </div>
            <div class="moreImage">
                <a href="#" id="abrir">Más Imágenes</a>
            </div>
        </div>
    </div>

    <!-- MODALES INTERNOS -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-contentFot">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Crop the image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>


    <div id="miModal" class="modalImage">
        <div class="flexImage" id="flex">
            <div class="contenido-modalImage">
                <div class="modal-headerImage flex">
                    <h2>Galería de <?php echo $house->getCasaNombre()?></h2><span class="closeImage"
                        id="close">&times;</span>
                </div>
                <div class="modal-bodyImage">

                    <div class="tile">
                        <div class="tile-body">
                            <form class="form-horizontal" method="post" action="#" enctype="multipart/form-data">
                                <div class=" form-group row">
                                    <label class="control-label col-md-3">Fotografía</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="file" name="imagenn" id="imagenn">
                                    </div>
                                </div>

                                <div class="tile-footer">
                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-3">
                                            <button id="btnGa" class="btn btn-primary" type="submit"><i
                                                    class="fa fa-fw fa-lg fa-check-circle"></i>Subir</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                    <div class="gallery" id="ulGallery">


                    </div>

                </div>
                <div class="footerImage">
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

    <div class="modalAbeltwo">
        <div class="bodyModalAbeltwo">


            <!--ventana para Update--->
            <div class="modal-dialogtwo">
                <div class="modal-contenttwo">


                </div>
            </div>
        </div>
    </div>

</div>
<!--contenido end-->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="assets/cropperjs/cropper.js" type="text/javascript"></script>
<script src="assets/lightboxGallery/lightbox-plus-jquery.min.js" type="text/javascript"></script>









<script>
var dataGallery = [];
var copydataG = [];



async function getDataGallery() {
    dataGallery = await fetch('http://localhost:80/Casas01/opc_page/getDataGalleryJSON')
        .then(res => res.json())
        .then(json => json);
    this.copydataG = [...this.dataGallery];

    renderDataGallery(dataGallery);
}
getDataGallery();

function renderDataGallery(dataGallery) {
    var databodyG = document.querySelector('#ulGallery');

    databodyG.innerHTML = '';

    dataGallery.forEach(item => {

        databodyG.innerHTML +=
            `
            <a href="assets/image/anfitriones/<?php echo $house->getId()?>/${item.img_Url}" data-lightbox="mygallery"><img src="assets/image/anfitriones/<?php echo $house->getId()?>/${item.img_Url}"></a>
        `;
    });

}

$(document).ready(function() {
    $("#btnGa").on('click', function() {
        var formData = new FormData();
        var files = $('#imagenn')[0].files[0];
        formData.append('file', files);
        $.ajax({
            url: 'http://localhost:80/Casas01/opc_page/uploadImg',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response != 0) {

                    getDataGallery();
                } else {
                    alert('Formato de imagen incorrecto.');
                }
            }
        });
        return false;
    });
});
</script>


<script>
var tipo = "";
var altura = 0;
var anchura = 0;

function header() {
    tipo = "header";
    anchura = 1345;
    altura = 232;
}

function right1() {
    tipo = "right1";
    anchura = 300;
    altura = 300;
}

function right2() {
    tipo = "right2";
    anchura = 300;
    altura = 300;
}
window.addEventListener('DOMContentLoaded', function() {
    var avatar = document.getElementById('avatar');
    var image = document.getElementById('image');
    var input = document.getElementById('input');
    var inputRight1 = document.getElementById('inputRight1');
    var inputRight2 = document.getElementById('inputRight2');

    var $progress = $('.progress');
    var $progressBar = $('.progress-bar');
    var $alert = $('.alert');
    var $modal = $('#modal');
    var cropper;

    $('[data-toggle="tooltip"]').tooltip();

    inputRight1.addEventListener('change', function(e) {
        var files = e.target.files;
        var done = function(url) {
            inputRight1.value = '';
            image.src = url;
            $alert.hide();
            $modal.modal('show');
        };
        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
            file = files[0];

            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function(e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    inputRight2.addEventListener('change', function(e) {
        var files = e.target.files;
        var done = function(url) {
            inputRight1.value = '';
            image.src = url;
            $alert.hide();
            $modal.modal('show');
        };
        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
            file = files[0];

            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function(e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    input.addEventListener('change', function(e) {
        var files = e.target.files;
        var done = function(url) {
            input.value = '';
            image.src = url;
            $alert.hide();
            $modal.modal('show');
        };
        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
            file = files[0];

            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function(e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    $modal.on('shown.bs.modal', function() {
        cropper = new Cropper(image, {
            dragMode: 'move',
            aspectRatio: anchura / altura
        });
    }).on('hidden.bs.modal', function() {
        cropper.destroy();
        cropper = null;
    });

    document.getElementById('crop').addEventListener('click', function() {
        var initialAvatarURL;
        var canvas;

        $modal.modal('hide');

        if (cropper) {
            canvas = cropper.getCroppedCanvas({
                width: anchura,
                height: altura,
            });


            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;

                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "http://localhost:80/Casas01/opc_page/saveGallery",
                        data: {
                            image: base64data,
                            imageType: tipo
                        },
                        success: function(data) {

                            $modal.modal('hide');
                            alert("success upload image");
                            window.location.reload();
                        }
                    });
                };
            });

        }
    });
});
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
var data = [];
var copydata = [];



async function getData() {
    data = await fetch('http://localhost:80/Casas01/opc_page/getDataServiceJSON')
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

        databody.innerHTML += `<tr class="row${item.idServicio}">
                        <td class="celIcon"><p class="celIconP">${item.serv_Icon}</p><i class="${item.serv_Icon}"></i></td>
                        <td class="celCantidad">${item.serv_Cantidad}</td>
                        <td class="celDescrip">${item.serv_Descripcion}</td>
                        <td class = "acci">
                          <a class = "Edit" service="${item.idServicio}" href="#">Editar</a>
                          <a class = "Elim" service="${item.idServicio}" href="#">Eliminar</a>
                        </td>
                       
                    </tr>`;


    });


    //MODA AGREGAR
    $('.btn-ter').click(function(e) {
        e.preventDefault();

        $('.modal-content').html(
            '<div class="modal-header" style="background-color: #004696;"><h6 class="modal-title" style="color: #fff; text-align: center; font-size: 20px;"> Agregar Servicio </h6></div>' +
            '<form class="form-horizontal" action=""  name = "form_addserviceModal" id = "form_addserviceModal" method="POST" onsubmit="event.preventDefault(); addDataService();">' +
            ' <div class="alertModal"></div>' +
            '           <label class="textObliga">Registro Obligatorio (<span> * </span>)</label>' +
            '   <div class="mod"> ' +
            '     <div class="rowOne">    ' +
            '       <div class="Onetwo">' +
            '         <div>' +
            '           <label class="textModal">Icono</label>' +
            '           <input class="form-control" type="text" name="servIcon" id="servIcon" placeholder="Agrega un Icono">' +
            '         </div>' +
            '         <div class="divUrl">' +
            '           <a class="url" href="https://fontawesome.com/v5.15/icons?d=gallery&p=9&m=free"><i class="fa fa-external-link" aria-hidden="true"></i> Ver iconos disponibles</a>' +
            '         </div>' +
            '       </div>' +
            '     </div>' +
            '     <div class="rowDouble">' +
            '       <div class="doubletwo">' +
            '         <div>' +
            '           <label class="textModal">Cantidad</label>' +
            '           <input class="form-control" type="text" name="servCantidad" id="servCantidad" placeholder="Número">' +
            '         </div>' +
            '         <div>   ' +
            '           <label class="textModal">Descripción <span> * </span></label>' +
            '           <input class="form-control" type="text" name="servDescrip" id="servDescrip" required="" placeholder="Agrega una descripción">' +
            '         </div>' +
            '       </div>' +
            '     </div>' +
            '   </div>' +
            '    <input type="hidden" name="idCasa" id="idCasa" required="" value="<?php echo $house->getId()?>">' +
            '    <input type="hidden" name="action" required="" value="addService">' +
            '   <div class="modal-footer">' +
            '     <button type="button" class="btn btn-secondary" onclick="closeModal();">Cerrar</button>' +
            '     <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar</button>' +
            '    </div>' +
            '</form>');

        $('.modalAbel').fadeIn();
    });

    //MODAL EDITAR
    $('.Edit').click(function(e) {
        e.preventDefault();
        var cont = $(this).attr('service');
        var action = 'infoServicio';
        $.ajax({

            url: 'http://localhost:80/Casas01/opc_page/getService',
            type: 'POST',
            async: true,
            data: {
                action: action,
                servicio: cont
            },


            success: function(response) {
                console.log(response);
                if (response != 'error') {

                    var info = JSON.parse(response);
                    $('.modal-content').html(
                        '<div class="modal-header" style="background-color: rgb(37, 156, 73);"><h6 class="modal-title" style="color: #fff; text-align: center; font-size: 20px;"> Actualizar Información </h6></div>' +
                        '<form class="form-horizontal" action="<?php echo constant('URL'); ?>/opc_page/updateService"  name = "form_updateserviceModal" id = "form_updateserviceModal" method="POST" onsubmit="event.preventDefault(); sendDataService();">' +
                        ' <div class="alertModal"></div>' +
                        '           <label class="textObliga">Registro Obligatorio (<span> * </span>)</label>' +
                        '   <div class="mod"> ' +
                        '     <div class="rowOne">    ' +
                        '       <div class="Onetwo">' +
                        '         <div>' +
                        '           <label class="textModal">Icono</label>' +
                        '           <input class="form-control" type="text" name="servIcon" id="servIcon" placeholder="Agrega un Icono" value="' +
                        info.serv_Icon + '">' +
                        '         </div>' +
                        '         <div class="divUrl">' +
                        '           <a class="url" href="https://fontawesome.com/v5.15/icons?d=gallery&p=9&m=free"><i class="fa fa-external-link" aria-hidden="true"></i> Ver iconos disponibles</a>' +
                        '         </div>' +
                        '       </div>' +
                        '     </div>' +
                        '     <div class="rowDouble">' +
                        '       <div class="doubletwo">' +
                        '         <div>' +
                        '           <label class="textModal">Cantidad</label>' +
                        '           <input class="form-control" type="text" name="servCantidad" id="servCantidad" placeholder="Número" value="' +
                        info.serv_Cantidad + '">' +
                        '         </div>' +
                        '         <div>   ' +
                        '           <label class="textModal">Descripción <span> * </span></label>' +
                        '           <input class="form-control" type="text" name="servDescrip" id="servDescrip" required="" placeholder="Agrega una descripción" value="' +
                        info.serv_Descripcion + '">' +
                        '         </div>' +
                        '       </div>' +
                        '     </div>' +
                        '   </div>' +
                        '    <input type="hidden" name="idServicio" id="idServicio" required="" value="' +
                        info.idServicio + '">' +
                        '    <input type="hidden" name="action" required="" value="updateService">' +
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
        var cont = $(this).attr('service');
        var action = 'infoServicio';
        $.ajax({

            url: 'http://localhost:80/Casas01/opc_page/getService',
            type: 'POST',
            async: true,
            data: {
                action: action,
                servicio: cont
            },


            success: function(response) {
                console.log(response);
                if (response != 'error') {

                    var info = JSON.parse(response);
                    $('.modal-content').html(
                        '<div class="modal-header" style="background-color: #b21f2d;"><h6 class="modal-title" style="color: #fff; text-align: center; font-size: 20px;">Eliminar servicio</h6></div>' +
                        '<form class="form-horizontal" action="<?php echo constant('URL'); ?>/opc_calendar/updateservice" name = "form_deleteserviceModal" id = "form_deleteserviceModal" method="POST" onsubmit="event.preventDefault(); delDataService();"> ' +
                        '    <div class="mod"> ' +
                        '      <label class="textModal" style="font-size: 16px;">Se eliminará el servicio de </label>   ' +
                        '     <label class="textModalRed"> <i class="' + info.serv_Icon +
                        '"></i>  ' + info.serv_Descripcion + '</label>' +
                        '   </div> ' +
                        '     <input type="hidden" name="idservicio" id="idservicio" required="" value="' +
                        info.idServicio + '">' +
                        '    <input type="hidden" name="action" required="" value="delservice">' +
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
    //AUI SE LIMPIAN CAMPOS
    $('.modalAbel').fadeOut();
}



function addDataService() {

    $.ajax({

        url: 'http://localhost:80/Casas01/opc_page/addService',
        type: 'POST',
        async: true,
        data: $('#form_addserviceModal').serialize(), //TOMA TODOS LOS INPUT DE FORMA SERIALIZADA


        success: function(response) {
            console.log(response);

            var info = JSON.parse(response);
            if (info == 'error') {
                $('.alertModal').html('<p style="color: red;"> Error al agregar Servicio.</p>');
            } else {
                getData();
                $('.servIcon').html('');
                $('.servDescrip').html('');
                $('.servCantidad').html('');

                $('.alertModal').html('<p style="color: green;"> Agregado Exitoso.</p>');
            }

        },
        error: function(error) {
            console.log(error);
        }
    });
}
/*
function addDataService() {

    $.ajax({

        url: 'http://localhost:80/Casas01/opc_page/addService',
        type: 'POST',
        async: true,
        data: $('#form_addServiceModal').serialize(), //TOMA TODOS LOS INPUT DE FORMA SERIALIZADA


        success: function(response) {
            console.log(response);

            var info = JSON.parse(response);
            if (info == 'error') {
                $('.alertModal').html('<p style="color: red;"> Error al agregar servicio.</p>');
            } else {
                getData();
                $('.servIcon').html('');
                $('.servDescrip').html('');
                $('.servCantidad').html('');

                $('.alertModal').html('<p style="color: green;"> Agregado Exitoso.</p>');
            }

        },
        error: function(error) {
            console.log(error);
        }
    });
}

*/

function sendDataService() {

    $.ajax({

        url: 'http://localhost:80/Casas01/opc_page/updateService',
        type: 'POST',
        async: true,
        data: $('#form_updateserviceModal').serialize(), //TOMA TODOS LOS INPUT DE FORMA SERIALIZADA


        success: function(response) {
            console.log(response);

            var info = JSON.parse(response);
            if (info == 'error') {
                $('.alertModal').html('<p style="color: red;"> Error al actualizar servicio.</p>');
            } else {
                $('.row' + info.idServicio + ' .celIcon').html(info.serv_Icon);
                $('.row' + info.idServicio + ' .celCantidad').html(info.serv_Cantidad);
                $('.row' + info.idServicio + ' .celDescrip').html(info.serv_Descrip);
                window.location.replace(
                    "http://localhost:80/Casas01/opc_page?success=9d09o9dikninasiomijhdjasjduhssjn");
            }

        },
        error: function(error) {
            console.log(error);
        }
    });
}


function delDataService() {
    //alert("Enviar Datos");
    $.ajax({

        url: 'http://localhost:80/Casas01/opc_page/deleteService',
        type: 'POST',
        async: true,
        data: $('#form_deleteserviceModal').serialize(), //TOMA TODOS LOS INPUT DE FORMA SERIALIZADA


        success: function(response) {
            console.log(response);

            if (response == 'error') {

                $('.alertModal').html('<p style="color: red;"> Error al eliminar servicio.</php>');
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


<!-- CLAUSULAS -->

<script>
var datatwo = [];
var copydatatwo = [];



async function getDatatwo() {
    datatwo = await fetch('http://localhost:80/Casas01/opc_page/getDataClauseJSON')
        .then(res => res.json())
        .then(json => json);
    this.copydatatwo = [...this.datatwo];

    renderDatatwo(datatwo);
}
getDatatwo();

function renderDatatwo(datatwo) {
    var databodytwo = document.querySelector('#databodytwo');

    let total = 0;
    databodytwo.innerHTML = '';

    datatwo.forEach(item => {

        databodytwo.innerHTML += `<tr class="row${item.idClausula}">
                            <td class="celIcon"><p class="celIconP">${item.clau_Icon}</p><i class="${item.clau_Icon}"></i></td>
                            
                            <td class="celDescrip">${item.clau_Descripcion}</td>
                            <td class="celTipo">${item.clau_Tipo}</td>
                            <td class = "acci">
                            <a class = "Editt" clause="${item.idClausula}" href="#">Editar</a>
                            <a class = "Elimm" clause="${item.idClausula}" href="#">Eliminar</a>
                            </td>
                        
                        </tr>`;


    });
    //MODA AGREGAR
    $('.btn-tertwo').click(function(e) {
        e.preventDefault();

        $('.modal-contenttwo').html(
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
            '         <div class="form-group">' +
            '           <label class="textModal">Tipo</label>' +
            '           <select class="form-control" name="clauTipo" id="clauTipo" >' +
            '           <option>Regla</option>' +
            '           <option>Seguridad y Salud</option>' +
            '           </select>' +
            '         </div>' +
            '         <div>   ' +
            '           <label class="textModal">Descripción <span> * </span></label>' +
            '           <input class="form-control" type="text" name="clauDescrip" id="clauDescrip" required="" placeholder="Agrega una descripción">' +
            '         </div>' +
            '       </div>' +
            '     </div>' +
            '   </div>' +
            '    <input type="hidden" name="idCasa" id="idCasa" required="" value="<?php echo $house->getId()?>">' +
            '    <input type="hidden" name="action" required="" value="addClause">' +
            '   <div class="modal-footer">' +
            '     <button type="button" class="btn btn-secondary" onclick="closeModaltwo();">Cerrar</button>' +
            '     <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar</button>' +
            '    </div>' +
            '</form>');

        $('.modalAbeltwo').fadeIn();
    });

    //MODAL EDITAR
    $('.Editt').click(function(e) {
        e.preventDefault();
        var cont = $(this).attr('clause');
        var action = 'infoClausula';
        $.ajax({

            url: 'http://localhost:80/Casas01/opc_page/getClause',
            type: 'POST',
            async: true,
            data: {
                action: action,
                clausula: cont
            },


            success: function(response) {
                console.log(response);
                if (response != 'error') {

                    var info = JSON.parse(response);
                    $('.modal-contenttwo').html(
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
                        '         <div class="form-group">' +
                        '           <label class="textModal">Tipo</label>' +
                        '           <select class="form-control" name="clauTipo" id="clauTipo" >' +
                        '           <option>' + info.clau_Tipo + '</option>' +
                        '           <option>Regla</option>' +
                        '           <option>Seguridad y Salud</option>' +
                        '           </select>' +
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
                        '    <input type="hidden" name="action" required="" value="updateClause">' +
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

    $('.Elimm').click(function(e) {
        e.preventDefault();
        var cont = $(this).attr('clause');
        var action = 'infoClausula';
        $.ajax({

            url: 'http://localhost:80/Casas01/opc_page/getClause',
            type: 'POST',
            async: true,
            data: {
                action: action,
                clausula: cont
            },


            success: function(response) {
                console.log(response);
                if (response != 'error') {

                    var info = JSON.parse(response);
                    $('.modal-contenttwo').html(
                        '<div class="modal-header" style="background-color: #b21f2d;"><h6 class="modal-title" style="color: #fff; text-align: center; font-size: 20px;">Eliminar Clausula</h6></div>' +
                        '<form class="form-horizontal" action="<?php echo constant('URL'); ?>/opc_calendar/updateclause" name = "form_deleteclauseModal" id = "form_deleteclauseModal" method="POST" onsubmit="event.preventDefault(); delDataClause();"> ' +
                        '    <div class="mod"> ' +
                        '      <label class="textModal" style="font-size: 16px;">Se eliminará el Clausula de </label>   ' +
                        '     <label class="textModalRed"> <i class="' + info.clau_Icon +
                        '"></i>  ' + info.clau_Descripcion + '</label>' +
                        '   </div> ' +
                        '     <input type="hidden" name="idClausula" id="idClausula" required="" value="' +
                        info.idClausula + '">' +
                        '    <input type="hidden" name="action" required="" value="delClause">' +
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

<?php require 'footer_anfi.php'; ?>