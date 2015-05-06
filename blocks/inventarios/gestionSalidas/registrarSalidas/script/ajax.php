<?php
/**
 *
* Los datos del bloque se encuentran en el arreglo $esteBloque.
*/

// URL base
$url = $this->miConfigurador->getVariableConfiguracion ( "host" );
$url .= $this->miConfigurador->getVariableConfiguracion ( "site" );
$url .= "/index.php?";

// Variables
$cadenaACodificar = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificar .= "&procesarAjax=true";
$cadenaACodificar .= "&action=index.php";
$cadenaACodificar .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar .= $cadenaACodificar . "&funcion=tablaItems";
$cadenaACodificar .="&tiempo=".$_REQUEST['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar, $enlace );

// URL definitiva
$urlFinal = $url . $cadena;

// Variables
$cadenaACodificar2 = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificar2 .= "&procesarAjax=true";
$cadenaACodificar2 .= "&action=index.php";
$cadenaACodificar2 .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar2 .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar2 .= $cadenaACodificar . "&funcion=AgregarItem";
$cadenaACodificar2.="&tiempo=".$_REQUEST['tiempo'];

// Codificar las variables
$enlace2 = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena2 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar2, $enlace2 );

// URL definitiva
$urlFinal2 = $url . $cadena2;

// Variables
$cadenaACodificar3 = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificar3 .= "&procesarAjax=true";
$cadenaACodificar3 .= "&action=index.php";
$cadenaACodificar3 .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar3 .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar3 .= $cadenaACodificar . "&funcion=EliminarItem";
$cadenaACodificar3 .="&tiempo=".$_REQUEST['tiempo'];

// Codificar las variables
$enlace3 = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena3 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar3, $enlace3 );

// URL definitiva
$urlFinal3 = $url . $cadena3;




// echo $urlFinal;exit;
// echo $urlFinal2;
// echo $urlFinal3;

?>
<script type='text/javascript'>


</script>

