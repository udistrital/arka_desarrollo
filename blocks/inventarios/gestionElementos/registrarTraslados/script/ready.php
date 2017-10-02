<?php ?>

// Asociar el widget de validación al formulario
$("#registrarTraslados").validationEngine({
promptPosition : "topLeft:180,10",  
scroll: false,
autoHidePrompt: true,
autoHideDelay: 2000
});
 $("#<?php echo $this->campoSeguro('tipo_registro')?>").select2();

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
        

$(function() {
$("#registrarTraslados").submit(function() {
$resultado=$("#registrarTraslados").validationEngine("validate");

if ($resultado) {

return true;
}
return false;
});
});











