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
$cadenaACodificar .= $cadenaACodificar . "&funcion=letrasNumeros";
$cadenaACodificar .= "&tiempo=" . $_REQUEST ['tiempo'];

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
$cadenaACodificar6 .="&tiempo=".$_REQUEST['tiempo'];

// Codificar las variables
$enlace6 = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena6 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar6, $enlace6 );

// URL definitiva
$urlFinal6 = $url . $cadena6;



// Variables
$cadenaACodificar7 = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificar7 .= "&procesarAjax=true";
$cadenaACodificar7 .= "&action=index.php";
$cadenaACodificar7 .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar7 .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar7 .= $cadenaACodificar . "&funcion=SeleccionCargo";
$cadenaACodificar7 .="&tiempo=".$_REQUEST['tiempo'];

// Codificar las variables
$enlace7 = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena7 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar7, $enlace7 );

// URL definitiva
$urlFinal7 = $url . $cadena7;



?>
<script type='text/javascript'>

function valorLetras(elem, request, response){
	  $.ajax({
	    url: "<?php echo $urlFinal?>",
	    dataType: "json",
	    data: { valor:$("#<?php echo $this->campoSeguro('valor_registro')?>").val()},
	    success: function(data){ 


	    			$("#<?php echo $this->campoSeguro('valorLetras_registro')?>").val(data);

	    }
		                    
	   });
	};


	function datosCargo(elem, request, response){
		  $.ajax({
			    url: "<?php echo $urlFinal7?>",
			    dataType: "json",
			    data: { cargo:$("#<?php echo $this->campoSeguro('cargoJefeSeccion')?>").val()},
			    success: function(data){ 

			    		if(data[0]!='null'){

			    			$("#<?php echo $this->campoSeguro('nombreJefeSeccion')?>").val(data[0]);
			    			$("#<?php echo $this->campoSeguro('id_jefe')?>").val(data[1]);
			    			
									    			
				    		}else{

						


					    		
				    		}

			    }
				                    
			   });

		
		};
	

		function datosCargoDe(elem, request, response){
			  $.ajax({
				    url: "<?php echo $urlFinal7?>",
				    dataType: "json",
				    data: { cargo:$("#<?php echo $this->campoSeguro('dependencia_supervisor')?>").val()},
				    success: function(data){ 

				    		if(data[0]!='null'){

				    			$("#<?php echo $this->campoSeguro('nombre_supervisor')?>").val(data[0]);
				    			
				    			
										    			
					    		}else{

							


						    		
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
	
	



$(function() {


	 $("#<?php echo $this->campoSeguro('valor_registro')?>").keyup(function(){

		  
			if($("#<?php echo $this->campoSeguro('valor_registro')?>").val()!=""){

				valorLetras();

			}else{

				$("#<?php echo $this->campoSeguro('valorLetras_registro')?>").val('');


				 }

		  });


	    $("#<?php echo $this->campoSeguro('asignacionOrdenador')?>").change(function(){

	    	if($("#<?php echo $this->campoSeguro('asignacionOrdenador')?>").val()!=''){
	    		datosOrdenador();
			}else{
				$("#<?php echo $this->campoSeguro('nombreOrdenador')?>").val('');
				}



		      });


	    
	    

	    
	    $("#<?php echo $this->campoSeguro('cargoJefeSeccion')?>").change(function(){


			if($("#<?php echo $this->campoSeguro('cargoJefeSeccion')?>").val()!=''){
				datosCargo();
			}else{
				$("#<?php echo $this->campoSeguro('nombreJefeSeccion')?>").val('');
				}


		      });

	    
	    $("#<?php echo $this->campoSeguro('dependencia_supervisor')?>").change(function(){


			if($("#<?php echo $this->campoSeguro('dependencia_supervisor')?>").val()!=''){
				datosCargoDe();
			}else{
				$("#<?php echo $this->campoSeguro('nombre_supervisor')?>").val('');
				}


		      });

	
	    
	
  
    
});

</script>

