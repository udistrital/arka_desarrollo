
// Asociar el widget de validación al formulario
     $("#registrarOrdenCompra").validationEngine({
            promptPosition : "centerRight", 
            scroll: false,
            autoHidePrompt: true,
            autoHideDelay: 2000
	         });
	

        $(function() {
            $("#registrarOrdenCompra").submit(function() {
                $resultado=$("#registrarOrdenCompra").validationEngine("validate");
                   
                if ($resultado) {
                
                    return true;
                }
                return false;
            });
        });

        
                
         
        
  

        
        
          






