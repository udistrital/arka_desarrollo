
// Asociar el widget de validación al formulario
$("#radicarAsignar").validationEngine({
promptPosition : "centerRight", 
scroll: false,
autoHidePrompt: true,
autoHideDelay: 2000
});


$(function() {
$("#radicarAsignar").submit(function() {
$resultado=$("#radicarAsignar").validationEngine("validate");

if ($resultado) {

return true;
}
return false;
});
});


$("#<?php echo $this->campoSeguro('tipoCargue') ?>").select2();
$("#<?php echo $this->campoSeguro('numero_entrada') ?>").select2();
$("#<?php echo $this->campoSeguro('vigencia_entrada') ?>").select2();


$("#<?php echo $this->campoSeguro('resolucionD') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('contratoD') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('ordenD') ?>").css('display','none');

$("#<?php echo $this->campoSeguro('facturaD') ?>").css('display','none');

$("#<?php echo $this->campoSeguro('satisfaccionD') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('cartaD') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('actaD') ?>").css('display','none');



$( "#<?php echo $this->campoSeguro('tipoCargue')?>" ).change(function() {
switch($("#<?php echo $this->campoSeguro('tipoCargue') ?>").val())
{

case '1':

$("#<?php echo $this->campoSeguro('resolucionD') ?>").css('display','block');
$("#<?php echo $this->campoSeguro('contratoD') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('ordenD') ?>").css('display','none');

$("#<?php echo $this->campoSeguro('facturaD') ?>").css('display','block');

$("#<?php echo $this->campoSeguro('satisfaccionD') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('cartaD') ?>").css('display','block');

$("#<?php echo $this->campoSeguro('actaD') ?>").css('display','block');

break;


case '3':

$("#<?php echo $this->campoSeguro('resolucionD') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('contratoD') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('ordenD') ?>").css('display','block');

$("#<?php echo $this->campoSeguro('facturaD') ?>").css('display','block');

$("#<?php echo $this->campoSeguro('satisfaccionD') ?>").css('display','block');
$("#<?php echo $this->campoSeguro('cartaD') ?>").css('display','none');

$("#<?php echo $this->campoSeguro('actaD') ?>").css('display','block');

break;


case '4':

$("#<?php echo $this->campoSeguro('resolucionD') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('contratoD') ?>").css('display','block');
$("#<?php echo $this->campoSeguro('ordenD') ?>").css('display','none');

$("#<?php echo $this->campoSeguro('facturaD') ?>").css('display','block');

$("#<?php echo $this->campoSeguro('satisfaccionD') ?>").css('display','block');
$("#<?php echo $this->campoSeguro('cartaD') ?>").css('display','none');

$("#<?php echo $this->campoSeguro('actaD') ?>").css('display','block');
break;


default:

$("#<?php echo $this->campoSeguro('resolucionD') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('contratoD') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('ordenD') ?>").css('display','none');

$("#<?php echo $this->campoSeguro('facturaD') ?>").css('display','none');

$("#<?php echo $this->campoSeguro('satisfaccionD') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('cartaD') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('actaD') ?>").css('display','none');
break;

}
});  








