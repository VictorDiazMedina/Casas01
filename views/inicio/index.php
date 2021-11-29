<?php require 'views/inicio/header.php'; ?>

<?php   
    $ubications      = $this->d['ubications'];  

?>
<div class="slider" id="Inicio">
    <div class="slide active">
        <img src="assets/image/anfitriones/2000/img1.jpg" alt="">
        <div class="info">
            <h2>Winter Mountains</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                et dolore magna aliqua.</p>
        </div>
    </div>
    <div class="slide">
        <img src="assets/image/anfitriones/2000/img2.jpg" alt="">
        <div class="info">
            <h2>Tropical Desert</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                et dolore magna aliqua.</p>
        </div>
    </div>
    <div class="slide">
        <img src="assets/image/anfitriones/2000/img3.jpg" alt="">
        <div class="info">
            <h2>Steaming Volcanoes</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                et dolore magna aliqua.</p>
        </div>
    </div>
    <div class="slide">
        <img src="assets/image/anfitriones/2000/img4.jpg" alt="">
        <div class="info">
            <h2>Mountain River</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                et dolore magna aliqua.</p>
        </div>
    </div>
    <div class="slide">
        <img src="assets/image/anfitriones/2000/img5.jpg" alt="">
        <div class="info">
            <h2>Egypt Pyramids</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                et dolore magna aliqua.</p>
        </div>
    </div>
    <div class="navigation">
        <i class="fas fa-chevron-left prev-btn"></i>
        <i class="fas fa-chevron-right next-btn"></i>
    </div>
    <div class="navigation-visibility">
        <div class="slide-icon active"></div>
        <div class="slide-icon"></div>
        <div class="slide-icon"></div>
        <div class="slide-icon"></div>
        <div class="slide-icon"></div>
    </div>
</div>
<div class="divMargin">
    <form class="form-horizontal" action="<?php echo constant('URL'); ?>/houses" name="form_busqDataHouse"
        id="form_busqDataHouse" method="GET">

        <div class="Busqueda">
            <h1>Búsqueda Rápida</h1>
            <div class="BusqGrid">
                <div class="Busq">
                    <div class="Busq2">
                        <div class="Busq3">

                            <div class="BusqLabel">
                                <div class="BusqEle">
                                    <div class="BusqTit">
                                        Ubicación Disponibles
                                    </div>
                                    <select name='ubicacion' id='ubicacion' class="BusqInf">
                                        <option value="">¿A dónde viajas?</option>
                                        <?php
                                $options = $ubications;
                                foreach($options as $option){
                                    echo "<option value=$option >".$option."</option>";
                                }
                            ?>
                                    </select>
                                </div>
                            </div>

                            <div class="BusqDiv"></div>

                            <div class="BusqLabel">
                                <div class="BusqEle">
                                    <div class="BusqTit">
                                        Llegada
                                    </div>
                                    <input name="llegada" id="llegada" class="BusqInf" type="date"
                                        placeholder="¿Cuándo llegas?">
                                </div>
                            </div>

                            <div class="BusqDiv"></div>

                            <div class="BusqLabel">
                                <div class="BusqEle">
                                    <div class="BusqTit">
                                        Salida
                                    </div>
                                    <input name="salida" id="salida" class="BusqInf" type="date"
                                        placeholder="¿Cuándo sales?">
                                </div>
                            </div>
                            <input type="hidden" name="action" required="" value="busqRapid">

                            <div class="BusqButtonEle">

                                <button class="BusqButton" type="submit"> <i class="fas fa-search"></i> Buscar</button>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <br>
    <br>
    <div class="div" id="Casas">
        <h1>Casas cercas de tí</h1>


        <div class="gridHouse" id="gridHouse">

        </div>
        <div class="house_info" id="house_info">
            <h4>Lo sentimos, no hay casas cerca de tu Estado</h4>
        </div>

    </div>
    <div class="div" id="Contacto">
        <h1>Contacto</h1>
        <div class="gridAnfi" id="gridAnfi">



        </div>


    </div>


</div>


<script src="assets/prueba/js/jquery.min.js"></script>

<script>
var dataAnfi = [];

async function getAnfiData() {
    dataAnfi = await fetch('http://localhost:80/Casas01/inicio/getHistoryJSON')
        .then(res => res.json())
        .then(json => json);

    renderAnfiData(dataAnfi);
}
getAnfiData();

function renderAnfiData(dataAnfi) {
    var dataAnfibody = document.querySelector('#gridAnfi');


    dataAnfibody.innerHTML = '';
    dataAnfi.forEach(item => {

        dataAnfibody.innerHTML += `<div class="messageSidebar">

                    <div class="messageAuthor">

                        <div class="userAvatar">
                            <img src="assets/image/anfitriones/${item.user_Perfil}" width="128"
                                height="128" alt="" class="userAvatarImage">
                        </div>

                        <div class="messageAuthorContainer">
                            <span class="badge userTitleBadge">${item.user_Nombre} ${item.user_APaterno} ${item.user_AMaterno}</span>
                        </div>

                    </div>

                    <div class="userCredits">
                        <dl class="plain dataList">
                        
                            <dt><a class="link" href="<?php echo constant('URL'); ?>/housepage?idCasa=${item.user_Status}"><i class="fas fa-house-user tamHou"></i> Casa: </a></dt>
                            <dd>${item.user_Password}</dd>

                            <dt><a class="link" href="https://api.whatsapp.com/send?phone=+52 1 ${item.user_WhatsApp}&text=Hola, me comunico desde la Página!"><i class="fab fa-whatsapp tamWhat"></i> WhatsApp: </a></dt>
                            <dd>${item.user_WhatsApp}</dd>
                        </dl>
                    </div>



                    </div>`;


    });

    if (dataAnfi.length < 5) {
        dataAnfibody.style.gridTemplateColumns = 'repeat(' + dataAnfi.length + ', 1fr)';
    } else {
        dataAnfibody.style.gridTemplateColumns = 'repeat(5 , 1fr)';
    }

}
</script>


<script>
var datos = {
    ubicacion: "Morelos"
};
var init = {

    method: "POST",
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify(datos)
};

var data = [];

async function getData() {
    data = await fetch('http://localhost:80/Casas01/inicio/busqRapi', init)
        .then(res => res.json())
        .then(json => json);

    renderData(data);
}
getData();

function renderData(data) {
    var databody = document.querySelector('#gridHouse');
    var house_info = document.querySelector('#house_info');

    if (data == "Nulo") {

    } else {

        if (data == "NULO") {
            databody.innerHTML = '';
        } else {
            databody.innerHTML = '';
            house_info.innerHTML = '';
            data.forEach(item => {

                databody.innerHTML += `
                <a class="link" href="<?php echo constant('URL'); ?>/housepage?idCasa=${item.idCasa}">
                    <div class="house_info">
                        <img src="assets/image/anfitriones/${item.idCasa}/${item.casa_Logo}" class="house_image" alt="">
                        <h4>${item.casa_Nombre}</h4>
                    </div>
                </a>`;


            });

            if (data.length < 5) {
                databody.style.gridTemplateColumns = 'repeat(' + data.length + ', 1fr)';
            } else {
                databody.style.gridTemplateColumns = 'repeat(5 , 1fr)';
            }
        }


    }

}
</script>


<?php require 'views/inicio/footer.php'; ?>