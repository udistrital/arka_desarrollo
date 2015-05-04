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




// Variables
$cadenaACodificar6 = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificar6 .= "&procesarAjax=true";
$cadenaACodificar6 .= "&action=index.php";
$cadenaACodificar6 .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar6 .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar6 .= $cadenaACodificar . "&funcion=SeleccionOrdenador";
$cadenaACodificar6 .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace6 = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena6 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar6, $enlace6 );

// URL definitiva
$urlFinal6 = $url . $cadena6;


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


	function datosOrdenador(elem, request, response){
		  $.ajax({
		    url: "<?php echo $urlFinal6?>",
		    dataType: "json",
		    data: { ordenador:$("#<?php echo $this->campoSeguro('asignacionOrdenador')?>").val()},
		    success: function(data){ 

		    		if(data[0]!='null'){

		    			$("#<?php echo $this->campoSeguro('nombreOrdenador')?>").val(data[0]);
		    			$("#<?php echo $this->campoSeguro('id_ordenador')?>").val(data[1]);
								    			
			    		}else{

					


				    		
			    		}

		    }
			                    
		   });
		};
	
    $(function () {

    $("#<?php echo $this->campoSeguro('asignacionOrdenador')?>").change(function(){
    	
    	if($("#<?php echo $this->campoSeguro('asignacionOrdenador')?>").val()!=''){
    		datosOrdenador();
		}else{
			$("#<?php echo $this->campoSeguro('nombreOrdenador')?>").val('');
			}
	      });
	
    });

</script>

