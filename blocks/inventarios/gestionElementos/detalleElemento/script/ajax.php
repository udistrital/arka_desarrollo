<?php
/**
 *
 * Los datos del bloque se encuentran en el arreglo $esteBloque.
 */

// URL base
$url = $this->miConfigurador->getVariableConfiguracion ( "host" );
$url .= $this->miConfigurador->getVariableConfiguracion ( "site" );

$urlDirectorio=$url;

$urlDirectorio =$urlDirectorio."/plugin/scripts/javascript/dataTable/Spanish.json";

$url .= "/index.php?";

// Variables
$cadenaACodificar = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificar .= "&procesarAjax=true";
$cadenaACodificar .= "&action=index.php";
$cadenaACodificar .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar .= $cadenaACodificar . "&funcion=Consulta";
$cadenaACodificar .= "&tiempo=" . $_REQUEST ['tiempo'];

if (isset ( $_REQUEST ['fecha_inicio'] ) && $_REQUEST ['fecha_inicio'] != '') {
	$fechaInicio = $_REQUEST ['fecha_inicio'];
} else {
	$fechaInicio = '';
}

if (isset ( $_REQUEST ['fecha_final'] ) && $_REQUEST ['fecha_final'] != '') {
	$fechaFinal = $_REQUEST ['fecha_final'];
} else {
	$fechaFinal = '';
}

if (isset ( $_REQUEST ['placa'] ) && $_REQUEST ['placa'] != '') {
	$placa = $_REQUEST ['placa'];
} else {
	$placa = '';
}

if (isset ( $_REQUEST ['serie1'] ) && $_REQUEST ['serie1'] != '') {
	$serie = $_REQUEST ['serie1'];
} else {
	$serie = '';
}

$arreglo = array (
		$fechaInicio,
		$fechaFinal,
		$placa,
		$serie 
);

$arreglo = serialize ( $arreglo );

$cadenaACodificar .= "&arreglo=" .$arreglo;


// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar, $enlace );


// URL definitiva
$urlFinal = $url . $cadena;
// echo $urlFinal;
?>
<script type='text/javascript'>
$(function() {
         	$('#tablaTitulos').ready(function() {

             $('#tablaTitulos').dataTable( {
//              	 serverSide: true,
				language: {
                url: "<?php echo $urlDirectorio?>"
            			},
             	 processing: true,
//                   ordering: true,
                  searching: true,
//                   deferRender: true,
                  sScrollY: 200	,
         //          bScrollCollapse: true,
                  info:true,
//                   lengthChange:true,
                  paging: true,
//                   stateSave: true,
         //          renderer: "bootstrap",
         //          retrieve: true,
                  ajax:{
                      url:"<?php echo $urlFinal?>",
                      dataSrc:"data"                                                                  
                  },
                  columns: [
                  { data :"placa" },
                  { data :"serie" },
                  { data :"descripcion" },
                  { data :"fecharegistro" },
                  { data :"detalle" },
                            ]
             });
                  
         		});

});

</script>
<?php
if (version_compare(phpversion(), "5.3.0", ">=")  == 1)
  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
else
  error_reporting(E_ALL & ~E_NOTICE); 

if ($_POST['action'] == 'get_info' && (int)$_POST['id'] > 0) {

    require_once('classes/CMySQL.php'); // include service classes to work with database and comments
    require_once('classes/CMyComments.php');

    // get photo info
    $iPid = (int)$_POST['id'];
    $aImageInfo = $GLOBALS['MySQL']->getRow("SELECT * FROM `s281_photos` WHERE `id` = '{$iPid}'");

    // prepare last 10 comments
    $sCommentsBlock = $GLOBALS['MyComments']->getComments($iPid);

    $aItems = $GLOBALS['MySQL']->getAll("SELECT * FROM `s281_photos` ORDER by `when` ASC"); // get photos info

    // Prev & Next navigation
    $sNext = $sPrev = '';
    $iPrev = (int)$GLOBALS['MySQL']->getOne("SELECT `id` FROM `s281_photos` WHERE `id` < '{$iPid}' ORDER BY `id` DESC LIMIT 1");
    $iNext = (int)$GLOBALS['MySQL']->getOne("SELECT `id` FROM `s281_photos` WHERE `id` > '{$iPid}' ORDER BY `id` ASC LIMIT 1");
    $sPrevBtn = ($iPrev) ? '<div class="preview_prev" onclick="getPhotoPreviewAjx(\''.$iPrev.'\')"><img src="images/prev.png" alt="prev" /></div>' : '';
    $sNextBtn = ($iNext) ? '<div class="preview_next" onclick="getPhotoPreviewAjx(\''.$iNext.'\')"><img src="images/next.png" alt="next" /></div>' : '';

    require_once('classes/Services_JSON.php');
    $oJson = new Services_JSON();
    header('Content-Type:text/javascript');
    echo $oJson->encode(array(
        'data1' => '<img class="fileUnitSpacer" src="images/'. $aImageInfo['filename'] .'">' . $sPrevBtn . $sNextBtn,
        'data2' => $sCommentsBlock,
    ));
    exit;
}
