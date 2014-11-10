<?php

?>

// Asociar el widget de validación al formulario
              $("#registrarElemento").validationEngine({
            promptPosition : "centerRight", 
            scroll: false,
            autoHidePrompt: true,
            autoHideDelay: 2000
	         });
	
        
        $(function() {
            $("#registrarElemento").submit(function() {
                $resultado=$("#registrarElemento").validationEngine("validate");
                   
                   
                   
                if ($resultado) {
                
                    return true;
                }
                return false;
            });
        });

                     $('#tablaTitulos').dataTable( {
                "sPaginationType": "full_numbers"
                 } );


             
 $('#<?php echo $this->campoSeguro('numero_entrada_c')?>').attr('disabled','');
 $('#<?php echo $this->campoSeguro('fecha_entrada')?>').attr('disabled','');
 $('#<?php echo $this->campoSeguro('clase_entrada')?>').attr('disabled','');
 $('#<?php echo $this->campoSeguro('razon_social')?>').attr('disabled','');
 $('#<?php echo $this->campoSeguro('nit_proveedor')?>').attr('disabled','');
 $('#<?php echo $this->campoSeguro('numero_factura')?>').attr('disabled','');
 $('#<?php echo $this->campoSeguro('fecha_factura')?>').attr('disabled','');
 
 
 $("#<?php echo $this->campoSeguro('tipo_registro')?>").select2();
 $("#<?php echo $this->campoSeguro('tipo_bien')?>").select2();
 $("#<?php echo $this->campoSeguro('iva')?>").select2();
 $("#<?php echo $this->campoSeguro('bodega')?>").select2();
 $("#<?php echo $this->campoSeguro('tipo_poliza')?>").select2();
                  
     
     $( "#<?php echo $this->campoSeguro('tipo_registro')?>" ).change(function() {
        
            switch($("#<?php echo $this->campoSeguro('tipo_registro')?>").val())
            {
                           
                case '1':
                    
                   
                    $("#<?php echo $this->campoSeguro('cargar_elemento')?>").css('display','block');
                    $("#<?php echo $this->campoSeguro('cargue_elementos')?>").css('display','none');

                   

                break;
                
                
                       case '2':
                    
                    $("#<?php echo $this->campoSeguro('cargar_elemento')?>").css('display','none');
                    $("#<?php echo $this->campoSeguro('cargue_elementos')?>").css('display','block');
       
                break;
                

                default:
                
                    $("#<?php echo $this->campoSeguro('cargar_elemento')?>").css('display','block');
                    $("#<?php echo $this->campoSeguro('cargue_elementos')?>").css('display','none');
                   
                   break;
                
                
             }
          });  
        
		  
     $( "#<?php echo $this->campoSeguro('tipo_poliza')?>" ).change(function() {
        
            switch($("#<?php echo $this->campoSeguro('tipo_poliza')?>").val())
            {
                           
                case 'No Aplica':
                    
                   
                    $("#<?php echo $this->campoSeguro('fechas_polizas')?>").css('display','none');
                   

                   

                break;
                
                
                case 'De Calidad':
                    
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
	
                
         
        
        
        
          






