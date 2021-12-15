<?php 
require 'assets/pdf/fpdf.php';
$contrato        = $this->d['contrato'];
$casa            = $this->d['casa'];
$anfitrion       = $this->d['anfitrion'];




    date_default_timezone_set('UTC');
    date_default_timezone_set("America/Mexico_City");
    setlocale(LC_TIME, 'spanish');

    $fechContrato = strftime("%d de %B del %Y", strtotime($contrato->getContFechAct()));

    $fechE_Mes_Anio = strftime("%B del %Y", strtotime($contrato->getContFechEntrada()));
    $fechE = strftime("%A %d", strtotime($contrato->getContFechEntrada()));
    $fechS = strftime("%A %d", strtotime($contrato->getContFechSalida()));

    $noches = (strtotime($contrato->getContFechEntrada())-strtotime($contrato->getContFechSalida()))/86400;
    $noches = abs($noches); $noches = floor($noches);
    $dias = $noches+1;

    $renta = $casa->getCasaRenta() * $noches;



$html01_Hoja1 =  utf8_decode('<br><br><div>Contrato de arrendamiento <b>'.strtoupper($casa->getCasaNombre()).'</b>, que celebran por una parte en su calidad de Arrendador o Encargado <b>'.strtoupper($anfitrion->getUserNomb()).' '.strtoupper($anfitrion->getUserAp()).' '.strtoupper($anfitrion->getUserAm()).'</b>, y por la otra parte en su calidad de arrendatario el (la) Sr. <b>'.strtoupper($contrato->getContAPaterArren()).' '.strtoupper($contrato->getContAMaterArren()).' '.strtoupper($contrato->getContNombreArren()).'</b> que se identifica con INE número <b>'.strtoupper($contrato->getContINE()).'</b> Ambos con capacidad legal para celebrar el presente contrato.</div>');
$html02_Hoja1 =  utf8_decode('<br><div>El evento se celebrará en <b>'.strtoupper($casa->getCasaNombre()).'</b> que tiene su domicilio _____________________________, <b>LOS '.$dias.' DIAS DE SEMANA DEL MES '.strtoupper($fechE_Mes_Anio).' </b>que comprenderá un horario de ingreso el <b>DIA '.strtoupper($fechE).' A PARTIR DE LAS 11:00 AM DESOCUPANDO EL DIA '.strtoupper($fechS).' HASTA LAS  7:00 PM CONTEMPLANDO '.$dias.' DIAS '.$noches.' NOCHES </b>por cada hora adicional se cobrará la cantidad de <b>$100mn</b></div>');
$html03_Hoja1 =  utf8_decode('<br><div>SOLO SE PERMITIRÁ EL ACCESO DE 08 PERSONAS COMO MÁXIMO, DE SER MÁS PERSONAS A PARTIR DE LA 9° SE COBRARÁ UN ADICIONAL SEGÚN LA INFORMACIÓN. Contemplando solo la capacidad de 7 camas,2 individuales y 5 matrimoniales, 1 por cada 2 personas en los dormitorios la cual incluirá en su interior el siguiente inventario haciéndolo responsable de cualquier daño surgido, el cual se le descontará del depósito a daños materiales antes realizado. </div>');
$html04_Hoja1 =  utf8_decode('<br><div>La limpieza final profunda no está incluida y tiene un costo de <b>$500.00mn</b><br>
<b>SI es requerida por el cliente o se cobrara a consideración de '.strtoupper($casa->getCasaNombre()).'</b><br>La limpieza de la alberca de ser requerida tiene un costo de <b>$400.00mn <br>OPCIONAL El uso de asadores tendrá que ser limpiado por usted o bien un costo de $100 extra.<br>
</b></div>');
$html05_Hoja1 =  utf8_decode('<br><div><br> <b>1.-  1 MICROONDAS        
<br> 2.-  1 ESTUFA Y BOILER CON SERVICIOS DE GAS        
<br> 3.-  1 MESA CON 5 SILLAS        
<br> 4.-  2 ASADORES         
<br> 5.-  1 FRIGOBAR         
<br> 6.-  1 MESA DE BILLAR CON 16 BOLAS Y 6 TACOS        
<br> 7.-  2 CAMAS MATRIMONIALES Y 2 INDIVIDUALES COMPLETAS (Edredón con sabanas incluidas).  + 1 LITERA MATRIMONIAL PARA NIÑOS     
<br> 8.-  1 LICUADORA 
<br> 9.-  1 NEVERA 
<br> 10.- 1 TV
<br> 11.- 5 SILLAS
<br> 12.- 2 CAMASTROS</b></div>');




$html01_Hoja2 =  utf8_decode('
Para sus efectos legales acuerdan las partes que se les designe como arrendador y arrendatario, respectivamente, al tenor de las siguientes clausulas:    
<br>
<br>
');
$html02_Hoja2 =  utf8_decode('<div><b>1.-</b> Depósito del 50% para reservar fecha de evento, así como leer detenidamente cada una de las cláusulas y condiciones estipuladas en este contrato.
<br><br>  <b>I.- Los Huéspedes se Obligan</b> a mantener la limpieza del inmueble durante el periodo del hospedaje, así como la recolección y embolsado de su propia basura.         
<br><br>  <b>II.-</b> Terminando la estancia en <b>'.strtoupper($casa->getCasaNombre()).'</b> como hospedaje los clientes deberán entregar el inmueble en buen estado en el que se recibió y devolverlo en ese mismo estado.         
<br><br>  <b>III.- Se aceptan mascotas siempre</b> y cuando el cliente este al pendiente de la limpieza de sus necesidades y respetando el reglamento con mascotas a ingresar así también se cubrirá un costo extra por mascota por la cantidad de <b>$200.00mn</b> para su respectiva desinfección         
');
$html03_Hoja2 =  utf8_decode('<br><div><b>2.-</b> La cantidad restante que corresponde al 50 % del precio total del arrendamiento <b>'.strtoupper($casa->getCasaNombre()).'</b>, se cubrirá el día que se lleve a cabo el evento a primera hora antes de ingresar.</div>');
$html04_Hoja2 =  utf8_decode('<br><div><b>3.-</b> En caso de requerir <b>CANCELACION</b> de la fecha estipulada a su evento <b>NO HABRA DEVOLUCIÓN</b>. 
<br><br>  <b>I.-</b> Es decir con respecto a lo depositado 50%.         
<br><br>  <b>II.-</b> En caso de ser <b>cambio de fecha</b> tendrá que avisar anticipadamente con una semana máximo para respetar precio, de lo contrario se descontará lo estipulado <b>en la Fracc. I</b> de este clausula.         
<br><br>  <b>III.-</b> Si Ud. Cambia la fecha de su evento 4 a 3 días antes se le cambiará, pero tendrá que cubrir el otro 50% de lo depositado por gastos de mantenimiento</div>');
$html05_Hoja2 =  utf8_decode('<br><div><b>4.-</b> Se puede programar cambio de fecha al siguiente fin de semana o fecha disponible máximo en un mes siempre y cuando <b>'.strtoupper($casa->getCasaNombre()).'</b> tenga disponible la fecha requerida de lo contrario si hay Cancelación se aplica la Cláusula antes citada en el párrafo anterior #3.</div>');
$html06_Hoja2 =  utf8_decode('<br><div><b>5.-</b> Depósito de <b>$'.strtoupper($casa->getCasaDeposito()).'.00mn</b> pesos por daños materiales, en caso de no haber daños materiales dicho depósito se devolverá al arrendatario al finalizar el evento.
<br><br>  <b>I.-</b> En caso de entregar la propiedad en mal estado o con suciedad, <b>el arrendador está en todo derecho de cobrar el 50% del anticipo para el pago de limpieza</b> y proceder con esta.         
<br><br>  <b>II.-</b> En caso de no respetar el Reglamento estipulado por <b>'.strtoupper($casa->getCasaNombre()).'</b> el <b>arrendador está en todo su derecho de no regresar el anticipo antes cobrado por daños y perjuicios que pudieran causar a la propiedad</b>.</div>');



$html01_Hoja3 =  utf8_decode('<br><div><b>6.-</b> Con respecto a la música se deberá de <b>mantener hasta las 12:00 de la noche</b>, después de esa hora será aun volumen moderado respetando los decibeles permitidos, <b>así como las luces del jardín y alberca deberán apagarse a las 12 de la noche o se apagarán automáticamente</b>.
<br><br>  <b>I.- DESPUÉS</b> de este horario deberá mantener la calma tanto en la música como el orden del ambiente, al no respetar esta cláusula y ocasionando algún perjuicio con alguna autoridad competente o inclusive con los vecinos, <b>EL ARRENDADOR está en todo su derecho de pedir el desalojo de la propiedad, así como no estará obligado a devolver el anticipo por cualquier daño o perjuicio ocasionado</b>.</div>');
$html02_Hoja3 =  utf8_decode('<br><div><b>7.- <u>'.strtoupper($casa->getCasaNombre()).' NO SE HACE RESPONSABLE DE LA LLEGADA DE PROTECCION CIVIL O ALGUNA OTRA AUTORIDAD A CAUSA DE X MOTIVO, EL REEMBOLSO NO SERA DEVUELTO SI SE PRESENTA UNA MULTA HACIA LA PROPIEDAD. (De ser necesario desalojar las instalaciones.)</u></b></div>');
$html03_Hoja3 =  utf8_decode('<br><div><b>1.- '.strtoupper($casa->getCasaNombre()).'</b> no se hace responsable de accidentes dentro y fuera de las instalaciones.</div>');
$html04_Hoja3 =  utf8_decode('<br><div><b>2.- '.strtoupper($casa->getCasaNombre()).'</b> no se hace responsable de robo total, daños materiales a vehículos, perdidas de objetos de valor dentro y fuera de las instalaciones.</div>');
$html05_Hoja3 =  utf8_decode('<br><div><b>3.- </b>En caso de problemas, discusiones, riñas dentro de las instalaciones tendrán que desalojar en su momento de lo contrario intervendrá seguridad pública.</div>');
$html06_Hoja3 =  utf8_decode('<br><div><b>4.- </b>El consumo de alcohol es responsabilidad del usuario (evite el exceso).</div>');
$html07_Hoja3 =  utf8_decode('<br><div><b>5.- </b>No armas, no drogas en caso de ser sorprendido será puesto a disposición.</div>');
$html08_Hoja3 =  utf8_decode('<br><div><b>6.- '.strtoupper($casa->getCasaNombre()).' esta monitoreada las 24hrs por cámaras de seguridad para cualquier prueba e imprevisto que llegue a surgir</b>.</div>');
$html09_Hoja3 =  utf8_decode('<br><div><b>7.- </b>En caso de algún daño material en las instalaciones deberás pagar por ello el costo del daño y su respectiva reparación.</div>');
$html10_Hoja3 =  utf8_decode('<br><div><b>8.- </b>El papel higiénico es por parte de quien rente <b>'.strtoupper($casa->getCasaNombre()).'</b>.</div>');


$html01_Hoja4 =  utf8_decode('<br><div>"ARRENDATARIO" SE COMPROMETE Y SE OBLIGA A NO        
       
<br><br>UTILIZAR EL BIEN OBJETO DEL PRESENTE CONTRATO DE ARRENDAMIENTO PARA LA COMISION DE NINGUN DELITO,        
       
<br><br>YA SEA COMO INSTRUMENTO, OBJETO O PRODUCTO DEL MISMO, EN LOS TERMINOS QUE SEÑALA LA LEY FEDERAL        
       
<br><br>DE EXTINCION DE DOMINIO REGLAMENTARIA DEL ART. 22 DE LA CONSTITUCION POLITICA DE LOS ESTADOS UNIDOS        
       
<br><br>MEXICANOS. EN ESTE SENTIDO EL ARRENDATARIO LIBERA A EL "ARRENDADOR" y/o INTERMEDIARIOS DE        
       
<br><br>CUALQUIER OBLIGACION O RESPONSABILIDAD EN QUE PUEDA INCLUIR EN LOS TERMINOS DEL ART. 7 EN RELACION        
       
<br><br>CON EL ART. 8 FRACCION III DE LA CITADA LEY FEDERAL DE EXTINCION DE DOMINIO,       
<br><br>EN LA EVENTUALIDAD DE QUE ESTE UTILIZARA DICHO BIEN INMUEBLE MATERIA DEL PRESENTE CONTRATO COMO INSTRUMENTO, OBJETO O PRODUCTO DE ALGUN DELITO.        
       
<br><br>QUEDA EXTRICTAMENTE PROHIBIDO UTILIZAR EL INMUEBLE PARA DESTINARLO A OCULTAR O MEZCLAR BIENES        
       
<br><br>PRODUCTO DE ALGUN DELITO, ENTENDIENDOCE POR OCULTAR, PARA LOS EFECTOS DE ESTE CONTRATO, LA ACCION DE ESCONDER DISIMULAR, O TRANSFORMAR BIENES QUE SON PRODUCTO DEL DELITO Y POR MEZCLA DE BIENES, LA SUMA O APLICACIÓN DE DOS O MAS BIENES.        
       
<br><br>POR EL CASO DE QUE EL ARRENDATARIO INFLINJA EL CONTENIDO DE ESTA CLAUSULA, Y EL ARRENDADOR VEA        
       
<br><br>AFECTADO SU PATRIMONIO SOBRE TODO EL INMUEBLE, POR CENTENCIA QUE DECLARE LA EXTINCION DE DOMINIO,        
       
<br><br>ADEMAS DE TENER LA OBLIGACION DE CUMPLIR CON TODAS Y CADA UNA DE LAS      
<br><br>OBLIGACIONES A CARGO DEL ARRENDATARIO, TENDRA TAMBIEN LA OBLIGACION DE PAGAR A EL ARRENDADOR EL VALOR COMERCIAL DEL INMUEBLE, EL CUAL SERA DETERMINADO POR PERITO EN LA MATERIA.
</div>');


$html01_Hoja5 =  utf8_decode('<br><div>La Renta será de <b>$'.$renta.'.00 MN</b>, contemplando los '.$dias.' días de semana del mes '.strtoupper($fechE_Mes_Anio).' en un horario de entrada del día '.strtoupper($fechE).' a las 11:00am y desocupando el día '.strtoupper($fechS).' a las 7:00pm siendo '.$dias.' días '.$noches.' noches Con un Depósito de <b>DAÑOS</b> a instalaciones que pudieran surgir de <b>$'.$casa->getCasaDeposito().'.00 MN. (Reembolsables 24 hrs después de su salida)</b>.</div>');
$html02_Hoja5 =  utf8_decode('<br><div><b>Más adicionales: </div>');
$html03_Hoja5 =  utf8_decode('<br><div>$100.00 MN </b>');
$htmlX1_Hoja5 =  utf8_decode('(ASADOR EN CASO DE LIMPIARLO SE REEBOLSARAN A SU SALIDA) </div>');  
$html04_Hoja5 =  utf8_decode('<br><div><b>$500.00 MN </b>');
$htmlX2_Hoja5 =  utf8_decode('(LIMPIEZA SI USTED LA REQUIERE, EN CASO DE QUE NO REQUIERA, SE REEMBOLSARAN A SU SALIDA) </div>'); 
$html05_Hoja5 =  utf8_decode('<br><div>UN TOTAL por la cantidad de <b>$'.$contrato->getContMontoTotal().'.00 MN.</b> Así reservando dicho lugar con Anticipo con la cantidad de <b>$'.$contrato->getContAnticipo().'.00 MN</b> depositando dicha cantidad a las siguientes cuentas.  </div>');
$html06_Hoja5 =  utf8_decode('<br><div><b>BANCOMER     4152-3133-2210-8221          
<br>SANTANDER    5579-1002-0948-5125</b>     </div>');
$html07_Hoja5 =  utf8_decode('<br><div>Al concluir los días y las horas establecidas en dicho contrato no habiendo ningún daño ni imprevisto a las instalaciones <b>El Depósito de $'.$casa->getCasaDeposito().'.00 MN</b> será reembolsado a Ud. Como arrendatario en efectivo o transferencia en 24 hrs.        </div>');
$html08_Hoja5 =  utf8_decode('<br><div>No habiendo inconveniente en lo estipulado en las cláusulas anteriores mencionadas y dando por entendido, acepto y me declaro conforme con las condiciones del contrato y no habiendo inconveniente confirmando así la fecha antes mencionada para la reservación.  </div>');
$html09_Hoja5 =  utf8_decode('<br><div>Todo lo anterior estipulado en este contrato, los servicios y la atención <b>QUEDA A SU MÁS ENTERA SATISFACCION DEL ARRENDADOR.    </div>');
$html10_Hoja5 =  utf8_decode('<br><div>ESTE CONTRATO SOLO ES VALIDO EN LA FECHA EXPEDIDO, O BIEN EN ACUERDO CON EL ARRENDADOR DE TIEMPO. </b></div>');


$html11_Hoja5 =  utf8_decode('<br><div>'.strtoupper($anfitrion->getUserNomb()).' '.strtoupper($anfitrion->getUserAp()).' '.strtoupper($anfitrion->getUserAm()).'
<br><br><br>'.strtoupper($contrato->getContAPaterArren()).' '.strtoupper($contrato->getContAMaterArren()).' '.strtoupper($contrato->getContNombreArren()).'</div>');

$pdf = new FPDF('P','mm','Letter');
// Primera página
$pdf->AddPage();
$pdf->SetLeftMargin(10.5);
$pdf->SetFont('Arial','',12);
$pdf->Image('assets/image/anfitriones/'.$casa->getId().'/'.$casa->getCasaLogo().'',15,5,48.82,32.9);
$pdf->SetFont('Arial','B',12);
$pdf->Ln(4);
$pdf->Cell(0,5,'CONTRATO DE ARRENDAMIENTO '.strtoupper($casa->getCasaNombre()).'',0,1,'R');
$pdf->SetFont('Arial','',12);
$pdf->Ln();
$pdf->Cell(0,5,'MUNICIPIO DE JIUTEPEC A '.strtoupper($fechContrato).'',0,1,'R');
$pdf->SetFontSize(11);
$pdf->Ln(10);
$pdf->WriteHTML($html01_Hoja1);
$pdf->Ln();
$pdf->WriteHTML($html02_Hoja1);
$pdf->Ln();
$pdf->WriteHTML($html03_Hoja1);
$pdf->Ln();
$pdf->WriteHTML($html04_Hoja1);
$pdf->Ln();
$pdf->WriteHTML($html05_Hoja1);

$pdf->SetFont('');

// Segunda página
$pdf->AddPage();
$pdf->SetLeftMargin(10.5);
$pdf->SetFont('Arial','',11);
$pdf->WriteHTML($html01_Hoja2);
$pdf->Ln(2);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'CLAUSULAS',0,1,'C');
$pdf->SetFont('Arial','',12);
$pdf->Ln();
$pdf->WriteHTML($html02_Hoja2);
$pdf->Ln(10);
$pdf->WriteHTML($html03_Hoja2);
$pdf->Ln(10);
$pdf->WriteHTML($html04_Hoja2);
$pdf->Ln(10);
$pdf->WriteHTML($html05_Hoja2);
$pdf->Ln(10);
$pdf->WriteHTML($html06_Hoja2);
$pdf->SetFont('');


// Tercera página
$pdf->AddPage();
$pdf->SetLeftMargin(10.5);
$pdf->SetFont('Arial','',12);
$pdf->WriteHTML($html01_Hoja3);
$pdf->Ln(10);
$pdf->WriteHTML($html02_Hoja3);
$pdf->Ln(32);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'CONDICIONES',0,1,'C');
$pdf->SetFont('Arial','',12);
$pdf->Ln(2);
$pdf->WriteHTML($html03_Hoja3);
$pdf->Ln(10);
$pdf->WriteHTML($html04_Hoja3);
$pdf->Ln(10);
$pdf->WriteHTML($html05_Hoja3);
$pdf->Ln(10);
$pdf->WriteHTML($html06_Hoja3);
$pdf->Ln(10);
$pdf->WriteHTML($html07_Hoja3);
$pdf->Ln(10);
$pdf->WriteHTML($html08_Hoja3);
$pdf->Ln(10);
$pdf->WriteHTML($html09_Hoja3);
$pdf->Ln(10);
$pdf->WriteHTML($html10_Hoja3);
$pdf->SetFont('');


// Cuarta página
$pdf->AddPage();
$pdf->SetLeftMargin(10.5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'LA LEY FEDERAL DE EXTINCION DE DOMINIO',0,1,'C');
$pdf->SetFont('Arial','',12);
$pdf->Ln(5);
$pdf->WriteHTML($html01_Hoja4);
$pdf->SetFont('');


// Quinta página
$pdf->AddPage();
$pdf->SetLeftMargin(10.5);
$pdf->SetFont('Arial','',12);
$pdf->WriteHTML($html01_Hoja5);
$pdf->Ln(10);
$pdf->WriteHTML($html02_Hoja5);
$pdf->Ln();
$pdf->WriteHTML($html03_Hoja5);
$pdf->SetFont('Arial','',10);
$pdf->WriteHTML($htmlX1_Hoja5);
$pdf->SetFont('Arial','',12);
$pdf->WriteHTML($html04_Hoja5);
$pdf->SetFont('Arial','',10);
$pdf->WriteHTML($htmlX2_Hoja5);
$pdf->SetFont('Arial','',12);
$pdf->Ln();
$pdf->WriteHTML($html05_Hoja5);
$pdf->Ln(10);
$pdf->WriteHTML($html06_Hoja5);
$pdf->Ln(10);
$pdf->WriteHTML($html07_Hoja5);
$pdf->Ln(10);
$pdf->WriteHTML($html08_Hoja5);
$pdf->Ln(10);
$pdf->WriteHTML($html09_Hoja5);
$pdf->Ln(10);
$pdf->WriteHTML($html10_Hoja5);
$pdf->Ln(40);

$pdf->SetFont('Arial','B',12);
$pdf->sety(230);
$pdf->setX(-75);
$pdf->line(15, $pdf->GetY(), 85, $pdf->GetY());
$pdf->line(130, $pdf->GetY(), 200, $pdf->GetY());
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,10,''.strtoupper($contrato->getContAPaterArren()).' '.strtoupper($contrato->getContAMaterArren()).' '.strtoupper($contrato->getContNombreArren()).'');
$pdf->setX(-190);
$pdf->Cell(20,10,''.strtoupper($anfitrion->getUserNomb()).' '.strtoupper($anfitrion->getUserAp()).' '.strtoupper($anfitrion->getUserAm()).'');
$pdf->SetFont('');
$pdf->Output();
?>