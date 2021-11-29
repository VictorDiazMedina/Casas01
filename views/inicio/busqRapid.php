<form class="form-horizontal" action="" name="form_busqDataHouse" id="form_busqDataHouse" method="POST"
    onsubmit="event.preventDefault(); busqDataHouse();">
    <div><?php (isset($this->errorMessage))?  $this->errorMessage : '' ?></div>


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
                        <input type="hidden" name="action" required="" value="busqRapidsss">

                        <div class="BusqButtonEle">

                            <button class="BusqButton" type="submit"> <i class="fas fa-search"></i> Buscar</button>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
function busqDataHouse() {

    $.ajax({

        url: 'http://localhost:80/Casas01/inicio/busqRapid',
        type: 'POST',
        async: true,
        data: $('#form_busqDataHouse').serialize(), //TOMA TODOS LOS INPUT DE FORMA SERIALIZADA


        success: function(response) {
            console.log(response);

        },
        error: function(error) {
            console.log(error);
        }
    });
}
</script>