<?php require 'header_anfi.php'; ?>



<!--contenido-->
<div class="content">

    <?php $this->showMessages();?>

    <div class="card">
        <h3 class="col-md-8">CASA INFO: ANFITRIÓN <?php echo $user->getUserWhats()?></h3>
    </div>


    <div class="tile">
        <div class="tile-body">

            <form class="form-horizontal" action="<?php echo constant('URL'); ?>/opc_house/updateHouse" method="POST">
                <div><?php (isset($this->errorMessage))?  $this->errorMessage : '' ?></div>

                <div class="form-group row">
                    <label class="control-label col-md-3">Casa</label>
                    <div class="col-md-8">
                        <div class="input-group">

                            <input class="form-control" type="text" name="casaNombre" id="casaNombre"
                                placeholder="Escribe el nombre de la casa" value="<?php echo $house->getCasaNombre()?>">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-3">Renta por Noche</label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">$</span>
                            </div>
                            <input class="form-control" onkeypress="return numbers(event);" type="text" name="casaRenta"
                                id="casaRenta" placeholder="MX" value="<?php echo $house->getCasaRenta()?>">
                            <div class="input-group-append"><span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-3">Deposito</label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">$</span>
                            </div>
                            <input class="form-control" onkeypress="return numbers(event);" type="text"
                                name="casaDeposito" id="casaDeposito" placeholder="MX"
                                value="<?php echo $house->getCasaDeposito()?>">
                            <div class="input-group-append"><span class="input-group-text">.00</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <label class="control-label col-md-3">Ubicación</label>
                    <div class="form-group col-md-5">
                        <input class="form-control" onkeypress="return numbers(event);" type="text" name="casaLati"
                            id="casaLati" value="<?php echo $house->getCasaLati()?>">
                    </div>

                    <div class="form-group col-md-5">
                        <input class="form-control" onkeypress="return numbers(event);" type="text" name="casaLong"
                            id="casaLong" value="<?php echo $house->getCasaLong()?>">
                    </div>
                </div>

                <div id="map"></div>

                <div class="tile-footer">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-3">
                            <button class="btn btn-primary" type="submit"><i
                                    class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar</button>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>


    <!-- FORMULARIO PARA SUBIR IMAGENES-->
    <div class="tile">
        <div class="tile-body">
            <div class="form-group row">
                <label class="control-label col-md-3">Logo</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <label class="p_Text2" data-toggle="tooltip">
                            <input type="file" class="sr-only" id="input" name="image" accept="image/*"
                                onclick="header()">Subir
                            Logo
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- MODALES INTERNOS -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-contentFot">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Recortar imagen del Logo</h5>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="crop">Cortar</button>
                </div>
            </div>
        </div>
    </div>

</div>
<!--contenido end-->




<script>
var tipo = "";
var altura = 0;
var anchura = 0;

function header() {
    tipo = "header";
    anchura = 423;
    altura = 285;
}


window.addEventListener('DOMContentLoaded', function() {
    var avatar = document.getElementById('avatar');
    var image = document.getElementById('image');
    var input = document.getElementById('input');

    var $progress = $('.progress');
    var $progressBar = $('.progress-bar');
    var $alert = $('.alert');
    var $modal = $('#modal');
    var cropper;

    $('[data-toggle="tooltip"]').tooltip();



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
                        url: "http://localhost:80/Casas01/opc_house/saveGallery",
                        data: {
                            image: base64data
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






<script src="assets/cropperjs/cropper.js" type="text/javascript"></script>
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
            longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                'Octubre', 'Noviembre', 'Diciembre'
            ],
        },
    }
}

flatpickr("input[type=date]", config);
</script>


<script>
function iniciarMap() {

    var purple_icon = 'http://maps.google.com/mapfiles/ms/icons/purple-dot.png';
    var coord = {
        lat: <?php echo $house->getCasaLati()?>,
        lng: <?php echo $house->getCasaLong()?>
    };
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: coord
    });

    var marker = new google.maps.Marker({
        position: coord,
        icon: purple_icon,
        map: map
    });

    var markers = {};
    var cont = 1;

    var getMarkerUniqueId = function(lat, lng) {
        return lat + '_' + lng;
    };

    /**
     * Creates an instance of google.maps.LatLng by given lat and lng values and returns it.
     * This function can be useful for getting new coordinates quickly.
     * @param {!number} lat Latitude.
     * @param {!number} lng Longitude.
     * @return {google.maps.LatLng} An instance of google.maps.LatLng object
     */
    var getLatLng = function(lat, lng) {
        return new google.maps.LatLng(lat, lng);
    };

    var addMarker = google.maps.event.addListener(map, 'click', function(e) {


        console.log("IF: " + cont);
        if (cont == 1) {
            var lat = e.latLng.lat(); // lat of clicked point
            var lng = e.latLng.lng(); // lng of clicked point
            var markerId = getMarkerUniqueId(lat,
                lng); // an that will be used to cache this marker in markers object.
            var marker = new google.maps.Marker({
                position: getLatLng(lat, lng),
                map: map,
                animation: google.maps.Animation.DROP,
                id: 'marker_' + markerId

            });



            document.getElementById("casaLati").value = lat;
            document.getElementById("casaLong").value = lng;

            markers[markerId] = marker;
            cont = cont + 1;
            console.log("MARCO: " + cont);

            google.maps.event.addListener(marker, "click", function(point) {
                var markerId = getMarkerUniqueId(point.latLng.lat(), point.latLng
                    .lng()); // get marker id by using clicked point's coordinate
                var marker = markers[markerId]; // find marker
                removeMarker(marker, markerId); // remove it

                cont = cont - 1;
                console.log("DESMARCO: " + cont);
            });

        }
        console.log(cont);
    });

    function bindMarkerEvents(marker, cont) {
        google.maps.event.addListener(marker, "click", function(point) {
            var markerId = getMarkerUniqueId(point.latLng.lat(), point.latLng
                .lng()); // get marker id by using clicked point's coordinate
            var marker = markers[markerId]; // find marker
            removeMarker(marker, markerId); // remove it


        });

    };

    var removeMarker = function(marker, markerId) {
        marker.setMap(null); // set markers setMap to null to remove it from map
        delete markers[markerId]; // delete marker instance from markers object
        //https://maps.googleapis.com/maps/api/js?key=AIzaSyBDaeWicvigtP9xPv919E-RNoxfvC-Hqik&callback=iniciarMap

    };

}
</script>

<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOhUZGAk2C0EfNybUwsce2-hRJ1Lcaxs4&callback=iniciarMap">
</script>

<script>
function numbers(e) {
    var keynum = window.event ? window.event.keyCode : e.which;
    if ((keynum == 8) || (keynum == 46))
        return true;

    return /\d/.test(String.fromCharCode(keynum));
}
</script>
<?php require 'footer_anfi.php'; ?>