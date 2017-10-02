<?php ?>

// Asociar el widget de validación al formulario
$("#registrarReposicion").validationEngine({
promptPosition : "centerRight", 
scroll: false,
autoHidePrompt: true,
autoHideDelay: 2000
});


$(function() {
$("#registrarReposicion").submit(function() {
$resultado=$("#registrarReposicion").validationEngine("validate");



if ($resultado) {

return true;
}
return false;
});
});



$("#<?php echo $this->campoSeguro('numero_entrada') ?>").select2({
placeholder: "Seleccione...",
});

$("#<?php echo $this->campoSeguro('iva') ?>").select2(); 
$("#<?php echo $this->campoSeguro('supervisor') ?>").select2({
placeholder: "",
});

$("#<?php echo $this->campoSeguro('sede_salida') ?>").select2(); 
$("#<?php echo $this->campoSeguro('dependencia_salida') ?>").select2(); 
$("#<?php echo $this->campoSeguro('ubicacion_salida') ?>").select2(); 


$("#<?php echo $this->campoSeguro('asignacionOrdenador') ?>").select2();
$("#<?php echo $this->campoSeguro('sede') ?>").select2(); 
$("#<?php echo $this->campoSeguro('dependencia') ?>").select2(); 
$("#<?php echo $this->campoSeguro('funcionario_salida') ?>").select2({
placeholder: "",
});

$("#<?php echo $this->campoSeguro('serial') ?>").select2({
placeholder: "Seleccione...",
});

$("#<?php echo $this->campoSeguro('responsable') ?>").select2({
placeholder: "",
});



$('#<?php echo $this->campoSeguro('fecha_factura') ?>').datepicker({
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


$( "#<?php echo $this->campoSeguro('cantidad') ?>" ).keyup(function() {

$("#<?php echo $this->campoSeguro('valor') ?>").val('');
$("#<?php echo $this->campoSeguro('subtotal_sin_iva') ?>").val('');
$("#<?php echo $this->campoSeguro('total_iva') ?>").val('');
$("#<?php echo $this->campoSeguro('total_iva_con') ?>").val('');

});  

$( "#<?php echo $this->campoSeguro('valor') ?>" ).keyup(function() {
$("#<?php echo $this->campoSeguro('subtotal_sin_iva') ?>").val('');
$("#<?php echo $this->campoSeguro('total_iva') ?>").val('');
$("#<?php echo $this->campoSeguro('total_iva_con') ?>").val('');

cantidad=Number($("#<?php echo $this->campoSeguro('cantidad') ?>").val());
valor=Number($("#<?php echo $this->campoSeguro('valor') ?>").val());


precio = cantidad * valor;


if (precio==0){


$("#<?php echo $this->campoSeguro('subtotal_sin_iva') ?>").val('');

}else{

$("#<?php echo $this->campoSeguro('subtotal_sin_iva') ?>").val(precio);

}

}); 

$( "#<?php echo $this->campoSeguro('iva') ?>" ).change(function() {

switch($("#<?php echo $this->campoSeguro('iva') ?>").val())
{

case '1':

cantidad=Number($("#<?php echo $this->campoSeguro('cantidad') ?>").val());
valor=Number($("#<?php echo $this->campoSeguro('valor') ?>").val());
precio=cantidad * valor;
total=precio;

$("#<?php echo $this->campoSeguro('total_iva') ?>").val('0');

$("#<?php echo $this->campoSeguro('total_iva_con') ?>").val(total);

break;

case '2':

cantidad=Number($("#<?php echo $this->campoSeguro('cantidad') ?>").val());
valor=Number($("#<?php echo $this->campoSeguro('valor') ?>").val());
precio=cantidad * valor;
total=precio;

$("#<?php echo $this->campoSeguro('total_iva') ?>").val('0');

$("#<?php echo $this->campoSeguro('total_iva_con') ?>").val(total);

break;

case '3':

cantidad=Number($("#<?php echo $this->campoSeguro('cantidad') ?>").val());
valor=Number($("#<?php echo $this->campoSeguro('valor') ?>").val());
iva = (cantidad * valor)* 0.05;
precio=cantidad * valor;
total=precio+iva;

$("#<?php echo $this->campoSeguro('total_iva') ?>").val(iva);

$("#<?php echo $this->campoSeguro('total_iva_con') ?>").val(total);

break;

case '4':

cantidad=Number($("#<?php echo $this->campoSeguro('cantidad') ?>").val());
valor=Number($("#<?php echo $this->campoSeguro('valor') ?>").val());
iva = (cantidad * valor)* 0.04;
precio = cantidad*valor;
total=precio+iva;

$("#<?php echo $this->campoSeguro('total_iva') ?>").val(iva);
$("#<?php echo $this->campoSeguro('total_iva_con') ?>").val(total);

break;

case '5':

cantidad=Number($("#<?php echo $this->campoSeguro('cantidad') ?>").val());
valor=Number($("#<?php echo $this->campoSeguro('valor') ?>").val());
iva = Math.round(((cantidad * valor)* 0.1)*100)/100;
precio = Math.round((cantidad*valor)*100)/100;
total=Math.round((precio+iva)*100)/100;

$("#<?php echo $this->campoSeguro('total_iva') ?>").val(iva);
$("#<?php echo $this->campoSeguro('total_iva_con') ?>").val(total);

break;

case '6':

cantidad=Number($("#<?php echo $this->campoSeguro('cantidad') ?>").val());
valor=Number($("#<?php echo $this->campoSeguro('valor') ?>").val());
iva = Math.round(((cantidad * valor)* 0.16)*100)/100;
precio = Math.round((cantidad*valor)*100)/100;
total=Math.round((precio+iva)*100)/100;

$("#<?php echo $this->campoSeguro('total_iva') ?>").val(iva);
$("#<?php echo $this->campoSeguro('total_iva_con') ?>").val(total);

break;

case '7':

cantidad=Number($("#<?php echo $this->campoSeguro('cantidad') ?>").val());
valor=Number($("#<?php echo $this->campoSeguro('valor') ?>").val());
iva = Math.round(((cantidad * valor)* 0.19)*100)/100;
precio = Math.round((cantidad * valor)*100)/100;
total=Math.round((precio+iva)*100)/100;

$("#<?php echo $this->campoSeguro('total_iva') ?>").val(iva);
$("#<?php echo $this->campoSeguro('total_iva_con') ?>").val(total);

break;


default:
$("#<?php echo $this->campoSeguro('total_iva') ?>").val('');
$("#<?php echo $this->campoSeguro('total_iva_con') ?>").val('');

break;

}

});  

$( "#<?php echo $this->campoSeguro('tipo_bien') ?>" ).change(function() {



switch($("#<?php echo $this->campoSeguro('tipo_bien') ?>").val())
{


case '2':

$("#<?php echo $this->campoSeguro('cantidad') ?>").val('1');
$('#<?php echo $this->campoSeguro('cantidad') ?>').attr('disabled','');

break;

case '3':

$("#<?php echo $this->campoSeguro('cantidad') ?>").val('1');
$('#<?php echo $this->campoSeguro('cantidad') ?>').attr('disabled','');

break;


break;


default:

$("#<?php echo $this->campoSeguro('cantidad') ?>").val('');
$('#<?php echo $this->campoSeguro('cantidad') ?>').removeAttr('disabled');

break;

}

});  







