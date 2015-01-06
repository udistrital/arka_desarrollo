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


// Variables
$cadenaACodificar4 = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificar4 .= "&procesarAjax=true";
$cadenaACodificar4 .= "&action=index.php";
$cadenaACodificar4 .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar4 .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar4 .= $cadenaACodificar . "&funcion=SeleccionProveedor";
$cadenaACodificar4 .="&tiempo=".$_REQUEST['tiempo'];

// Codificar las variables
$enlace4 = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena4 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar4, $enlace4 );

// URL definitiva
$urlFinal4 = $url . $cadena4;


// Variables
$cadenaACodificar5 = "pagina=" . $this->miConfigurador->getVariableConfiguracion ( "pagina" );
$cadenaACodificar5 .= "&procesarAjax=true";
$cadenaACodificar5 .= "&action=index.php";
$cadenaACodificar5 .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar5 .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar5 .= $cadenaACodificar . "&funcion=SeleccionDependencia";
$cadenaACodificar5 .="&tiempo=".$_REQUEST['tiempo'];

// Codificar las variables
$enlace5 = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
$cadena5 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar5, $enlace5 );

// URL definitiva
$urlFinal5 = $url . $cadena5;



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




// echo $urlFinal;exit;
// echo $urlFinal2;
// echo $urlFinal3;

?>
<script type='text/javascript'>


function datosInfo(elem, request, response){
	  $.ajax({
	    url: "<?php echo $urlFinal4?>",
	    dataType: "json",
	    data: { personaje:$("#<?php echo $this->campoSeguro('selec_proveedor')?>").val()},
	    success: function(data){ 

	    		if(data[0]!='null'){

	    			$("#<?php echo $this->campoSeguro('proveedor')?>").val(data[0]);
					$("#<?php echo $this->campoSeguro('nitProveedor')?>").val(data[1]);
					$("#<?php echo $this->campoSeguro('direccionProveedor')?>").val(data[2]);
					$("#<?php echo $this->campoSeguro('telefonoProveedor')?>").val(data[3]);

	    			
		    		}else{

				


			    		
		    		}

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
		    			$("#<?php echo $this->campoSeguro('id_jefe_oculto')?>").val(data[1]);
		    			
								    			
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
		    			$("#<?php echo $this->campoSeguro('id_ordenador_oculto')?>").val(data[1]);
								    			
			    		}else{

					


				    		
			    		}

		    }
			                    
		   });
		};





		function datosDependencia(elem, request, response){
			  $.ajax({
			    url: "<?php echo $urlFinal5?>",
			    dataType: "json",
			    data: { dependencia:$("#<?php echo $this->campoSeguro('selec_dependencia')?>").val()},
			    success: function(data){ 

			    		if(data[0]!='null'){

			    			$("#<?php echo $this->campoSeguro('direccionDependencia')?>").val(data[0]);
							$("#<?php echo $this->campoSeguro('telefonoDependencia')?>").val(data[1]);
			

			    			
				    		}else{

						


					    		
				    		}

			    }
				                    
			   });
			};


$(function() {

    $("#tablaContenido").jqGrid({
        url: "<?php echo $urlFinal?>",
        datatype: "json",
        height: 200,
        width: 930,
        mtype: "GET",
        colNames: [ "Item", "Unidad de Medida", "Cantidad", "Descripción", "($)Valor Unitario","($)Valor Total"],
        colModel: [
            
            { name: "item", width: 90,align: "center", editable:true },
            { name: "unidad_medida", width: 100, align: "center", editable:true },
            { name: "cantidad", width: 80, align: "center" ,editable:true,editrules:{number:true},sorttype:'number',formatter:'number' },
            { name: "descripcion", width: 80, align: "center",editable:true },
            { name: "valor_unitario", width: 80, align: "center",editable:true,editrules:{number:true},sorttype:'number',formatter:'number' },
            { name: "valor_total", width: 80, align: "center",editable:false,editrules:{number:true},sorttype:'number',formatter:'number' },
            ],

        pager: "#barraNavegacion",
        rowNum: 10,
        rowList: [10, 20, 30],
        sortname: "id_items",
        sortorder: "desc",
        viewrecords: false,
        loadtext: "Cargando...",
        pgtext : "Pagina {0} de {1}",
        caption: "Solicitud Items ",
        
        
               
    }).navGrid('#barraNavegacion',
    	    {	
	    add:true,
	    addtext:'Añadir Item',
		edit:false,	    		
		del:true ,
		deltext:'Eliminar Item',
		alertcap:"Alerta",
        alerttext:"Seleccione Item",
		search:false ,
		refresh:true,
		refreshstate: 'current',
		refreshtext:'Refrescar Items',
		},

    { },//edit
    {

        caption:"Añadir Item",
        addCaption: "Adicionar Item",
        width: 425, 
        height: 310,
        mtype:'GET',
        url:'<?php echo $urlFinal2?>',
        bSubmit: "Agregar",
        bCancel: "Cancelar",
        bClose: "Close",
        saveData: "Data has been changed! Save changes?",
        bYes : "Yes",
        bNo : "No",
        bExit : "Cancel",
        closeOnEscape:true,
        closeAfterAdd:true,
        onclickSubmit:function(params, postdata){
            //save add
            var p=params;
            var pt=postdata;
        },
        beforeSubmit : function(postdata, formid) { 
            var p = postdata;
            var id=id;
            var success=true;
            var message="continue";
            return[success,message]; 
        },    
        afterSubmit : function(response, postdata) 
        { 
            var r=response; 
            var p=postdata;
            var responseText=jQuery.jgrid.parse(response.responseText);
            var success=true;
            var message="continue";
            return [success,message] 
        },
        afterComplete : function (response, postdata, formid) {        
            var responseText=jQuery.jgrid.parse(response.responseText);
            var r=response;
            var p=postdata;
            var f=formid;
        } },//add
     {
			
             
            url:'<?php echo $urlFinal3?>',
            caption: "Eliminar Item",
            width: 425, 
            height: 150,
            mtype:'GET',
            bSubmit: "Eliminar",
            bCancel: "Cancelar",
            bClose: "Close",
            msg:"Desea Eliminar Item ?",
            bYes : "Yes",
            bNo : "No",
            bExit : "Cancel",
            closeOnEscape:true,
            closeAfterAdd:true,
            refresh:true,
            onclickSubmit:function(params, postdata,id_items){
                //save add
                var p=params;
                var pt=postdata;
                
                
            },
            beforeSubmit : function(postdata, formid) { 
                var p = postdata;
                var id=formid;
                var success=true;
                var message="continue";
                return[success,message]; 
            }, 
            afterSubmit : function(response, postdata) 
            { 
                var r=response; 
                var p=postdata;
                var responseText=jQuery.jgrid.parse(response.responseText);
                var success=true;
                var message="continue";
                return [success,message] 
            },
            afterComplete : function (response, postdata, formid) {        
                var responseText=jQuery.jgrid.parse(response.responseText);
                var r=response;
                var p=postdata;
                var f=formid;
            } 

            },//del
     {},
     {}
   	);


    $("#<?php echo $this->campoSeguro('selec_proveedor')?>").select2({
    	 placeholder: "Search for a repository",
    	 minimumInputLength: 3,

        });

    $("#<?php echo $this->campoSeguro('proveedor_consulta')?>").select2({ 	 
     placeholder: "Search for a repository",
   	 minimumInputLength: 3,

   	 });

    $("#<?php echo $this->campoSeguro('selec_proveedor')?>").change(function() {datosInfo(); });


    $("#<?php echo $this->campoSeguro('selec_dependencia')?>").change(function(){ datosDependencia(); });


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


  


    
});





</script>

