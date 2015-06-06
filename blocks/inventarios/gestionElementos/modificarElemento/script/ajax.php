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
$cadenaACodificar .= $cadenaACodificar . "&funcion=Consulta";
$cadenaACodificar .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar, $enlace );

// URL definitiva
$urlFinal = $url . $cadena;
echo $urlFinal;
?>
<script type='text/javascript'>
$(function() {

	$('#tablaTitulos').ready(function() {
		
    $('#tablaTitulos').dataTable( {
    	 serverSide: true,
    	 processing: false,
         ordering: true,
         searching: true,
         ajax:"<?php echo $urlFinal?>",
        
         columns: [
         { data :"placa" },
         { data :"serie" },
         { data :"descripcion" },
         { data :"fecha_registro" }
     ]
        	    




             
         } );

	});
});

</script>
