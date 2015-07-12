<?php ?>

// Asociar el widget de validación al formulario
$("#modificarElemento").validationEngine({
promptPosition : "centerRight", 
scroll: false,
autoHidePrompt: true,
autoHideDelay: 2000
});


$(function() {
$("#modificarElemento").submit(function() {
$resultado=$("#modificarElemento").validationEngine("validate");



if ($resultado) {

return true;
}
return false;
});
});




$('#<?php echo $this->campoSeguro('sede') ?>').width(210);
$("#<?php echo $this->campoSeguro('sede') ?>").select2(); 
$("#<?php echo $this->campoSeguro('numero_entrada') ?>").select2(); 
$('#<?php echo $this->campoSeguro('dependencia') ?>').width(210);
$("#<?php echo $this->campoSeguro('dependencia') ?>").select2(); 
$("#<?php echo $this->campoSeguro('ubicacion') ?>").select2();
$("#<?php echo $this->campoSeguro('nombreFuncionario') ?>").select2();


$('#<?php echo $this->campoSeguro('fecha_inicio') ?>').datepicker({
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
var lockDate = new Date($('#<?php echo $this->campoSeguro('fecha_inicio') ?>').datepicker('getDate'));
$('input#<?php echo $this->campoSeguro('fecha_final') ?>').datepicker('option', 'minDate', lockDate);
},
onClose: function() { 
if ($('input#<?php echo $this->campoSeguro('fecha_inicio') ?>').val()!='')
{
$('#<?php echo $this->campoSeguro('fecha_final') ?>').attr("class", "cuadroTexto ui-widget ui-widget-content ui-corner-all   validate[required]");
}else {
$('#<?php echo $this->campoSeguro('fecha_final') ?>').attr("class", "cuadroTexto ui-widget ui-widget-content ui-corner-all ");
}
}


});
$('#<?php echo $this->campoSeguro('fecha_final') ?>').datepicker({
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
var lockDate = new Date($('#<?php echo $this->campoSeguro('fecha_final') ?>').datepicker('getDate'));
$('input#<?php echo $this->campoSeguro('fecha_inicio') ?>').datepicker('option', 'maxDate', lockDate);
},
onClose: function() { 
if ($('input#<?php echo $this->campoSeguro('fecha_final') ?>').val()!='')
{
$('#<?php echo $this->campoSeguro('fecha_inicio') ?>').attr("class", "cuadroTexto ui-widget ui-widget-content ui-corner-all   validate[required]");
}else {
$('#<?php echo $this->campoSeguro('fecha_inicio') ?>').attr("class", "cuadroTexto ui-widget ui-widget-content ui-corner-all ");
}
}

});



