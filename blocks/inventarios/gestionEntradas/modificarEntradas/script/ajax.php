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
$cadenaACodificar .= $cadenaACodificar . "&funcion=estado";
$cadenaACodificar .="&tiempo=".$_REQUEST['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar, $enlace );

// URL definitiva
$urlFinal = $url . $cadena;


?>
<script type='text/javascript'>
function estado(elem, request, response){
	  $.ajax({
	    url: "<?php echo $urlFinal?>",
	    dataType: "json",
	    data: { cls_entr:$("#<?php echo $this->campoSeguro('clase')?>").val()},
	    success: function(data){ 
	        if(data[0]!=" "){

	            $("#<?php echo $this->campoSeguro('tipo_contrato')?>").html('');
	            $("<option value=''>Seleccione  ....</option>").appendTo("#<?php echo $this->campoSeguro('tipo_contrato')?>");
	            $.each(data , function(indice,valor){

	            	$("<option value='"+data[ indice ].id_tipo+"'>"+data[ indice ].descripcion+"</option>").appendTo("#<?php echo $this->campoSeguro('tipo_contrato')?>");
	            	
	            });
	            $("#<?php echo $this->campoSeguro('tipo_contrato')?>").removeAttr('disabled');
	            $("#<?php echo $this->campoSeguro('tipo_contrato')?>").select2();
	            
	            
		        }

	        


		     }
		                    
	   });
	};

</script>

