<?php

/**
 *
 * Los datos del bloque se encuentran en el arreglo $esteBloque.
 */

// Variables
$cadenaACodificar = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificar .= "&procesarAjax=true";
$cadenaACodificar .= "&action=index.php";
$cadenaACodificar .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar .= "&funcion=Consulta";
$cadenaACodificar .= "&usuario=" . $_REQUEST ['usuario'];
$cadenaACodificar .= "&tiempo=" . $_REQUEST ['tiempo'];

if (isset ( $_REQUEST ['accesoCondor'] ) && $_REQUEST ['accesoCondor'] == 'true') {
	
	$_REQUEST ['funcionario'] = $_REQUEST ['usuario'];
	$cadenaACodificar .= "&accesoCondor='true'";
}

if (isset ( $_REQUEST ['funcionario'] ) && $_REQUEST ['funcionario'] != '') {
	$funcionario = $_REQUEST ['funcionario'];
} else {
	$funcionario = '';
}

if (isset ( $_REQUEST ['sede'] ) && $_REQUEST ['sede'] != '') {
	$sede = $_REQUEST ['sede'];
} else {
	$sede = '';
}

if (isset ( $_REQUEST ['dependencia'] ) && $_REQUEST ['dependencia'] != '') {
	$dependencia = $_REQUEST ['dependencia'];
} else {
	$dependencia = '';
}

if (isset ( $_REQUEST ['ubicacion'] ) && $_REQUEST ['ubicacion'] != '') {
	$ubicacion = $_REQUEST ['ubicacion'];
} else {
	$ubicacion = '';
}
if (isset ( $_REQUEST ['selec_nivel'] ) && $_REQUEST ['selec_nivel'] != '') {
	$arreglo2 = $_REQUEST ['selec_nivel'];
} else {
	$arreglo2 = '';
}


$arreglo = array (
		'funcionario' => $funcionario,
		'sede' => $sede,
		'dependencia' => $dependencia,
		'ubicacion' => $ubicacion 
);

$arreglo = serialize ( $arreglo );

$cadenaACodificar .= "&arreglo=" . $arreglo;
$cadenaACodificar .= "&arreglo2=" . $arreglo2;

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar, $enlace );

// URL definitiva
$urlFinal = $url . $cadena;


?>
<script type='text/javascript'>




$(function() {
         	$('#tablaTitulos').ready(function() {

             $('#tablaTitulos').dataTable( {
				language: {
                url: "<?php echo $urlDirectorio?>"
            			},
          	processing: true,
             searching: true,
             "deferLoading": 500,
             info:true,
             "scrollY":"400px",
             "scrollCollapse": false, 
   		    "pagingType": "full_numbers",
   		   "bLengthChange": false,
	   		  "bPaginate": false,

                  ajax:{
                      url:"<?php echo $urlFinal?>",
                      dataSrc:"data"                                                                  
                  },
                  columns: [
                  { data :"tipobien" },
                  { data :"placa" },
                  { data :"descripcion" },
                  { data :"sede" },
                  { data :"dependencia" },
                  { data :"espaciofisico" },
                  { data :"contratista" },
                  { data :"detalle" },
                  { data :"observaciones" },
                  { data :"verificacion" },
                            ]
             });
                  
         		});

});




</script>
