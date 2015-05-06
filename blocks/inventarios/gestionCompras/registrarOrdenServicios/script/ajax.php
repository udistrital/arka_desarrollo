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
$cadenaACodificar6 .= "&tiempo=" . $_REQUEST ['tiempo'];

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
$cadenaACodificar7 .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace7 = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena7 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar7, $enlace7 );

// URL definitiva
$urlFinal7 = $url . $cadena7;

// Variables
$cadenaACodificar9 = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificar9 .= "&procesarAjax=true";
$cadenaACodificar9 .= "&action=index.php";
$cadenaACodificar9 .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar9 .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar9 .= $cadenaACodificar9 . "&funcion=letrasNumeros";
$cadenaACodificar9 .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena9 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar9, $enlace );

// URL definitiva
$urlFinal9 = $url . $cadena9;


// Variables
$cadenaACodificar10 = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificar10 .= "&procesarAjax=true";
$cadenaACodificar10 .= "&action=index.php";
$cadenaACodificar10 .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar10 .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar10 .= $cadenaACodificar10 . "&funcion=disponibilidades";
$cadenaACodificar10 .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena10 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar10, $enlace );

// URL definitiva
$urlFinal10 = $url . $cadena10;

// Variables
$cadenaACodificar12 = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificar12 .= "&procesarAjax=true";
$cadenaACodificar12 .= "&action=index.php";
$cadenaACodificar12 .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar12 .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar12 .= $cadenaACodificar12 . "&funcion=Infodisponibilidades";
$cadenaACodificar12 .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena12 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar12, $enlace );

// URL definitiva
$urlFinal12 = $url . $cadena12;


// Variables
$cadenaACodificar13 = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificar13 .= "&procesarAjax=true";
$cadenaACodificar13 .= "&action=index.php";
$cadenaACodificar13 .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar13 .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar13 .= $cadenaACodificar13 . "&funcion=registroPresupuestal";
$cadenaACodificar13 .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena13 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar13, $enlace );

// URL definitiva
$urlFinal13 = $url . $cadena13;



// Variables
$cadenaACodificar14 = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificar14 .= "&procesarAjax=true";
$cadenaACodificar14 .= "&action=index.php";
$cadenaACodificar14 .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar14 .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar14 .= $cadenaACodificar14 . "&funcion=Inforegistro";
$cadenaACodificar14 .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena14 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar14, $enlace );

// URL definitiva
$urlFinal14 = $url . $cadena14;


// Variables
$cadenaACodificar15 = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificar15 .= "&procesarAjax=true";
$cadenaACodificar15 .= "&action=index.php";
$cadenaACodificar15 .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar15 .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar15 .= $cadenaACodificar15 . "&funcion=consultarContratistas";
$cadenaACodificar15 .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena15 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar15, $enlace );

// URL definitiva
$urlFinal15 = $url . $cadena15;



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



	function valorLetrasDis(elem, request, response){
		  $.ajax({
		    url: "<?php echo $urlFinal9?>",
		    dataType: "json",
		    data: { valor:$("#<?php echo $this->campoSeguro('valor_disponibilidad')?>").val()},
		    success: function(data){ 


		    			$("#<?php echo $this->campoSeguro('valorLetras_disponibilidad')?>").val(data);

		    }
			                    
		   });
		};




		function valorLetrasReg(elem, request, response){
			  $.ajax({
			    url: "<?php echo $urlFinal9?>",
			    dataType: "json",
			    data: { valor:$("#<?php echo $this->campoSeguro('valor_registro')?>").val()},
			    success: function(data){ 


			    			$("#<?php echo $this->campoSeguro('valorL_registro')?>").val(data);

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




    $("#<?php echo $this->campoSeguro('vigencia_contratista')?>").change(function() {
    	
		if($("#<?php echo $this->campoSeguro('vigencia_contratista')?>").val()!=''){

			contratistasC();	

		}else{}


 		});
    
    $("#<?php echo $this->campoSeguro('vigencia_disponibilidad')?>").change(function() {
	
				if($("#<?php echo $this->campoSeguro('vigencia_disponibilidad')?>").val()!=''){

					disponibilidades();	
		
				}else{}

	
         });





$("#<?php echo $this->campoSeguro('diponibilidad')?>").change(function() {

		if($("#<?php echo $this->campoSeguro('diponibilidad')?>").val()!=''){
		
			infodisponibilidades();	
		
		}else{}
		
		
		});




			$("#<?php echo $this->campoSeguro('vigencia_registro')?>").change(function() {
				
				if($("#<?php echo $this->campoSeguro('vigencia_registro')?>").val()!=''){
			
					registrosP();	
			
				}else{}
			
			
			});
			
			
			
			$("#<?php echo $this->campoSeguro('registro')?>").change(function() {
			
				if($("#<?php echo $this->campoSeguro('registro')?>").val()!=''){
			
					inforegistrosP();	
			
				}else{}
			
			
			});

	
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


function disponibilidades(elem, request, response){
	  $.ajax({
	    url: "<?php echo $urlFinal10?>",
	    dataType: "json",
	    data: { vigencia:$("#<?php echo $this->campoSeguro('vigencia_disponibilidad')?>").val()},
	    success: function(data){ 
	        if(data[0]!=" "){

	            $("#<?php echo $this->campoSeguro('diponibilidad')?>").html('');
	            $("<option value=''>Seleccione  ....</option>").appendTo("#<?php echo $this->campoSeguro('diponibilidad')?>");
	            $.each(data , function(indice,valor){

	            	$("<option value='"+data[ indice ].IDENTIFICADOR+"'>"+data[ indice ].NUMERO+"</option>").appendTo("#<?php echo $this->campoSeguro('diponibilidad')?>");
	            	
	            });
	            $("#<?php echo $this->campoSeguro('diponibilidad')?>").removeAttr('disabled');
	            $('#<?php echo $this->campoSeguro('diponibilidad')?>').attr("class", " validate[required]");
	            $("#<?php echo $this->campoSeguro('diponibilidad')?>").select2({
	          		 placeholder: "Search for a repository",
	           		 minimumInputLength: 1	,
	               });
	            
	            
		        }

	        


		     }
		                    
	   });
	};


	function infodisponibilidades(elem, request, response){
		  $.ajax({
		    url: "<?php echo $urlFinal12?>",
		    dataType: "json",
		    data: { vigencia:$("#<?php echo $this->campoSeguro('vigencia_disponibilidad')?>").val(),
			    disponibilidad:$("#<?php echo $this->campoSeguro('diponibilidad')?>").val()},
		    success: function(data){ 
			    
		        if(data[0]!="null"){
		        	$("#<?php echo $this->campoSeguro('fecha_diponibilidad')?>").val(data[0]);
			    	$("#<?php echo $this->campoSeguro('valor_disponibilidad')?>").val(data[1]);
				
			    	valorLetrasDis();
	
		            
			        }

		        


			     }
			                    
		   });
		};


		function registrosP(elem, request, response){
			
			  $.ajax({
			    url: "<?php echo $urlFinal13?>",
			    dataType: "json",
			    data: { vigencia:$("#<?php echo $this->campoSeguro('vigencia_registro')?>").val()},
			    success: function(data){ 
			        if(data[0]!=" "){

			            $("#<?php echo $this->campoSeguro('registro')?>").html('');
			            $("<option value=''>Seleccione  ....</option>").appendTo("#<?php echo $this->campoSeguro('registro')?>");
			            $.each(data , function(indice,valor){

			            	$("<option value='"+data[ indice ].IDENTIFICADOR+"'>"+data[ indice ].NUMERO+"</option>").appendTo("#<?php echo $this->campoSeguro('registro')?>");
			            	
			            });
			            
			            $("#<?php echo $this->campoSeguro('registro')?>").removeAttr('disabled');
			            $('#<?php echo $this->campoSeguro('registro')?>').attr("class", " validate[required]");
			            $("#<?php echo $this->campoSeguro('registro')?>").select2({
			          		 placeholder: "Search for a repository",
			           		 minimumInputLength: 1	,
			               });
			          
			            
				        }

			        


				     }
				                    
			   });
			};


			function inforegistrosP(elem, request, response){
				  $.ajax({
				    url: "<?php echo $urlFinal14?>",
				    dataType: "json",
				    data: { vigencia:$("#<?php echo $this->campoSeguro('vigencia_registro')?>").val(),
					    disponibilidad:$("#<?php echo $this->campoSeguro('registro')?>").val()},
				    success: function(data){ 
					    
				        if(data[0]!="null"){
				        	$("#<?php echo $this->campoSeguro('fecha_registro')?>").val(data[0]);
					    	$("#<?php echo $this->campoSeguro('valor_registro')?>").val(data[1]);
						
					    	valorLetrasReg();
			
				            
					        }

				        


					     }
					                    
				   });
				};

		
				function contratistasC(elem, request, response){
					
					  $.ajax({
					    url: "<?php echo $urlFinal15?>",
					    dataType: "json",
					    data: { vigencia:$("#<?php echo $this->campoSeguro('vigencia_contratista')?>").val()},
					    success: function(data){ 
					        if(data[0]!=" "){

					            $("#<?php echo $this->campoSeguro('nombreContratista')?>").html('');
					            $("<option value=''>Seleccione  ....</option>").appendTo("#<?php echo $this->campoSeguro('nombreContratista')?>");
					            $.each(data , function(indice,valor){

					            	$("<option value='"+data[ indice ].IDENTIFICADOR+"'>"+data[ indice ].CONTRATISTA+"</option>").appendTo("#<?php echo $this->campoSeguro('nombreContratista')?>");
					            	
					            });

					            
					            
					            $("#<?php echo $this->campoSeguro('nombreContratista')?>").removeAttr('disabled');
					            
					            
					            $('#<?php echo $this->campoSeguro('nombreContratista')?>').attr("style", "width: 25 ; '");
					            					            
					            $("#<?php echo $this->campoSeguro('nombreContratista')?>").select2({
					          		 placeholder: "Search for a repository",
					           		 minimumInputLength: 3	,
					               });
					          
					            
						        }
					        

					        


						     }
						                    
					   });
					};






</script>

