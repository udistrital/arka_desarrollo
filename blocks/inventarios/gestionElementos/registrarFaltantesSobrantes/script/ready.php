<?php

?>

// Asociar el widget de validación al formulario
              $("#registrarFaltantesSobrantes").validationEngine({
            promptPosition : "centerRight", 
            scroll: false,
            autoHidePrompt: true,
            autoHideDelay: 2000
	         });
	
        
        $(function() {
            $("#registrarFaltantesSobrantes").submit(function() {
                $resultado=$("#registrarFaltantesSobrantes").validationEngine("validate");
                   
                   
                   
                if ($resultado) {
                
                    return true;
                }
                return false;
            });
        });

        
        
         $("#<?php echo $this->campoSeguro('placa')?>").select2({
             	 placeholder: "Search for a repository",
              	 minimumInputLength: 3,
              	 });
 $("#<?php echo $this->campoSeguro('serial')?>").select2({
             	 placeholder: "Search for a repository",
              	 minimumInputLength: 3,
              	 });
        
              
$("#<?php echo $this->campoSeguro('inexistencia')?>").select2();
 $("#<?php echo $this->campoSeguro('responsable')?>").select2();
$("#<?php echo $this->campoSeguro('sede')?>").select2(); 
$("#<?php echo $this->campoSeguro('responsable_reci')?>").select2();




       
     $('#<?php echo $this->campoSeguro('fecha_hurto')?>').datepicker({
					dateFormat: 'yy-mm-dd',
					maxDate: 0,
					changeYear: true,
					changeMonth: true,
					monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
					    'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
					    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
					    dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
					    dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
					    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
						
						
		});

     
          $('#<?php echo $this->campoSeguro('fecha_denuncia')?>').datepicker({
					dateFormat: 'yy-mm-dd',
					maxDate: 0,
					changeYear: true,
					changeMonth: true,
					monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
					    'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
					    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
					    dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
					    dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
					    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
						
						
		});





 $("#<?php echo $this->campoSeguro('tipo_bien')?>").select2();
 $("#<?php echo $this->campoSeguro('iva')?>").select2();
 $("#<?php echo $this->campoSeguro('bodega')?>").select2();
 <!--$("#<?php echo $this->campoSeguro('tipo_poliza')?>").select2();  -->
                  
     
     $( "#<?php echo $this->campoSeguro('inexistencia')?>" ).change(function() {
        
            switch($("#<?php echo $this->campoSeguro('inexistencia')?>").val())
            {
                           
                case '1':
                    
                   
                    $("#<?php echo $this->campoSeguro('hurto')?>").css('display','none');
                   

                   

                break;
                
                
                case '2':
                    
                    $("#<?php echo $this->campoSeguro('hurto')?>").css('display','block');
                    
       
                break;
                
                
                case '3':
                    
                    $("#<?php echo $this->campoSeguro('hurto')?>").css('display','none');
                    
       
                break;
                

                default:
                
                $("#<?php echo $this->campoSeguro('hurto')?>").css('display','none');
                   
                   break;
                
                
             }
          });  
        
		  
     $( "#<?php echo $this->campoSeguro('tipo_poliza')?>" ).change(function() {
        
            switch($("#<?php echo $this->campoSeguro('tipo_poliza')?>").val())
            {
                           
                case '1':
                    
                   
                    $("#<?php echo $this->campoSeguro('fechas_polizas')?>").css('display','none');
                   

                   

                break;
                
                
                case '2':
                    
                  $("#<?php echo $this->campoSeguro('fechas_polizas')?>").css('display','block');
       
                break;
                

                default:
                
                $("#<?php echo $this->campoSeguro('fechas_polizas')?>").css('display','none');
                   
                   break;
                
                
             }
          });  
	
	
	
	     $( "#<?php echo $this->campoSeguro('tipo_bien')?>" ).change(function() {
        
            switch($("#<?php echo $this->campoSeguro('tipo_bien')?>").val())
            {
                           
                case '2':
                    
                   
                    $("#<?php echo $this->campoSeguro('devolutivo')?>").css('display','none');
                    $("#<?php echo $this->campoSeguro('consumo_controlado')?>").css('display','block');
                   

                   

                break;
                
                
                case '3':
                    
                  $("#<?php echo $this->campoSeguro('devolutivo')?>").css('display','block');
                  $("#<?php echo $this->campoSeguro('consumo_controlado')?>").css('display','none');
       
                break;
                

                default:
                
                $("#<?php echo $this->campoSeguro('devolutivo')?>").css('display','none');
                $("#<?php echo $this->campoSeguro('consumo_controlado')?>").css('display','none');   
                   break;
                
                
             }
          });  
	

                
                
        $( "#<?php echo $this->campoSeguro('cantidad')?>" ).keyup(function() {
        
            $("#<?php echo $this->campoSeguro('valor')?>").val('');
            $("#<?php echo $this->campoSeguro('subtotal_sin_iva')?>").val('');
            $("#<?php echo $this->campoSeguro('total_iva')?>").val('');
            $("#<?php echo $this->campoSeguro('total_iva_con')?>").val('');
            
          });  
	
        $( "#<?php echo $this->campoSeguro('valor')?>" ).keyup(function() {
        	$("#<?php echo $this->campoSeguro('subtotal_sin_iva')?>").val('');
            $("#<?php echo $this->campoSeguro('total_iva')?>").val('');
            $("#<?php echo $this->campoSeguro('total_iva_con')?>").val('');
            
            cantidad=Number($("#<?php echo $this->campoSeguro('cantidad')?>").val());
            valor=Number($("#<?php echo $this->campoSeguro('valor')?>").val());
            
            precio = cantidad * valor;
      
      
            if (precio==0){
            
            
            $("#<?php echo $this->campoSeguro('subtotal_sin_iva')?>").val('');
            
            }else{
            
            $("#<?php echo $this->campoSeguro('subtotal_sin_iva')?>").val(precio);
            
            }

          }); 
          
          $( "#<?php echo $this->campoSeguro('iva')?>" ).change(function() {
        
		     switch($("#<?php echo $this->campoSeguro('iva')?>").val())
            {
                           
                case '1':
                 
                 cantidad=Number($("#<?php echo $this->campoSeguro('cantidad')?>").val());
            	 valor=Number($("#<?php echo $this->campoSeguro('valor')?>").val());
       			 precio=cantidad * valor;
       			 total=precio;
       			 
                 $("#<?php echo $this->campoSeguro('total_iva')?>").val('0');
                 
                 $("#<?php echo $this->campoSeguro('total_iva_con')?>").val(total);
                                    
                break;
                
                case '2':
                 
                 cantidad=Number($("#<?php echo $this->campoSeguro('cantidad')?>").val());
            	 valor=Number($("#<?php echo $this->campoSeguro('valor')?>").val());
       			 precio=cantidad * valor;
       			 total=precio;
       			 
                 $("#<?php echo $this->campoSeguro('total_iva')?>").val('0');
                 
                 $("#<?php echo $this->campoSeguro('total_iva_con')?>").val(total);
                                    
                break;
                
                case '3':
                
                 cantidad=Number($("#<?php echo $this->campoSeguro('cantidad')?>").val());
            	 valor=Number($("#<?php echo $this->campoSeguro('valor')?>").val());
       			 iva = (cantidad * valor)* 0.05;
       			 precio=cantidad * valor;
       			 total=precio+iva;
       			 
                 $("#<?php echo $this->campoSeguro('total_iva')?>").val(iva);
                 
                 $("#<?php echo $this->campoSeguro('total_iva_con')?>").val(total);
                    
                break;
                                
                case '4':
                
                 cantidad=Number($("#<?php echo $this->campoSeguro('cantidad')?>").val());
            	 valor=Number($("#<?php echo $this->campoSeguro('valor')?>").val());
       			 iva = (cantidad * valor)* 0.04;
       			 precio = cantidad*valor;
       			 total=precio+iva;
       			 
                 $("#<?php echo $this->campoSeguro('total_iva')?>").val(iva);
                 $("#<?php echo $this->campoSeguro('total_iva_con')?>").val(total);
                                     
                break;
                

                default:
                $("#<?php echo $this->campoSeguro('total_iva')?>").val('');
                $("#<?php echo $this->campoSeguro('total_iva_con')?>").val('');
                   
                break;
                
                }
            
          });  
          
         $( "#<?php echo $this->campoSeguro('tipo_bien')?>" ).change(function() {
        
        
        
          switch($("#<?php echo $this->campoSeguro('tipo_bien')?>").val())
            {
                           
                
                case '2':
                
                 $("#<?php echo $this->campoSeguro('cantidad')?>").val('1');
                 $('#<?php echo $this->campoSeguro('cantidad')?>').attr('disabled','');

                 break;
                
                case '3':
                
                 $("#<?php echo $this->campoSeguro('cantidad')?>").val('1');
                 $('#<?php echo $this->campoSeguro('cantidad')?>').attr('disabled','');
                    
                break;
                                
           
                break;
                

                default:
                 
                 $("#<?php echo $this->campoSeguro('cantidad')?>").val('');
                 $('#<?php echo $this->campoSeguro('cantidad')?>').removeAttr('disabled');
                 
                break;
                
                }
            
          });  
        
        
                        
        $('#<?php echo $this->campoSeguro('fecha_inicio')?>').datepicker({
		dateFormat: 'yy-mm-dd',
		maxDate: 0,
		changeYear: true,
		changeMonth: true,
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		    'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
		    dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
		    dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
		    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
		    onSelect: function(dateText, inst) {
			var lockDate = new Date($('#<?php echo $this->campoSeguro('fecha_inicio')?>').datepicker('getDate'));
			$('input#<?php echo $this->campoSeguro('fecha_final')?>').datepicker('option', 'minDate', lockDate);
			},
			onClose: function() { 
		 	    if ($('input#<?php echo $this->campoSeguro('fecha_inicio')?>').val()!='')
                    {
                        $('#<?php echo $this->campoSeguro('fecha_final')?>').attr("class", "cuadroTexto ui-widget ui-widget-content ui-corner-all   validate[required]");
                }else {
                        $('#<?php echo $this->campoSeguro('fecha_final')?>').attr("class", "cuadroTexto ui-widget ui-widget-content ui-corner-all ");
                    }
			  }
			
			
		});
              $('#<?php echo $this->campoSeguro('fecha_final')?>').datepicker({
		dateFormat: 'yy-mm-dd',
		maxDate: 0,
		changeYear: true,
		changeMonth: true,
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		    'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
		    dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
		    dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
		    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
		    onSelect: function(dateText, inst) {
			var lockDate = new Date($('#<?php echo $this->campoSeguro('fecha_final')?>').datepicker('getDate'));
			$('input#<?php echo $this->campoSeguro('fecha_inicio')?>').datepicker('option', 'maxDate', lockDate);
			 },
			 onClose: function() { 
		 	    if ($('input#<?php echo $this->campoSeguro('fecha_final')?>').val()!='')
                    {
                        $('#<?php echo $this->campoSeguro('fecha_inicio')?>').attr("class", "cuadroTexto ui-widget ui-widget-content ui-corner-all   validate[required]");
                }else {
                        $('#<?php echo $this->campoSeguro('fecha_inicio')?>').attr("class", "cuadroTexto ui-widget ui-widget-content ui-corner-all ");
                    }
			  }
			
	   });
	   
	          $('#tablaTitulos').dataTable( {
                "sPaginationType": "full_numbers"
                 } );
	   
         