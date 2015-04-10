
// Asociar el widget de validación al formulario
     $("#radicacionesElementos").validationEngine({
            promptPosition : "centerRight", 
            scroll: false,
            autoHidePrompt: true,
            autoHideDelay: 2000
	         });
	

        $(function() {
            $("#radicacionesElementos").submit(function() {
                $resultado=$("#radicacionesElementos").validationEngine("validate");
                   
                if ($resultado) {
                
                    return true;
                }
                return false;
            });
        });

        
        

     
               
        
$("#<?php echo $this->campoSeguro('tipo')?>").select2();



 
        
          






