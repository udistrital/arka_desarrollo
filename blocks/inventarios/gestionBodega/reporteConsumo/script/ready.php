
// Asociar el widget de validación al formulario
$("#reporteConsumo").validationEngine({
promptPosition : "centerRight", 
scroll: false,
autoHidePrompt: true,
autoHideDelay: 2000
});


$(function() {
$("#reporteConsumo").submit(function() {
$resultado=$("#gestionBodega").validationEngine("validate");
if ($resultado) {
return true;
}
return false;
});
});


//-------------------------------------------------
$('#<?php echo $this->campoSeguro('fechaCorte') ?>').datepicker({
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
var lockDate = new Date($('#<?php echo $this->campoSeguro('fechaSalida') ?>').datepicker('getDate'));
$('input#<?php echo $this->campoSeguro('fechaCorte') ?>').datepicker('option', 'minDate', lockDate);
},
onClose: function() { 
if ($('input#<?php echo $this->campoSeguro('fechaSalida') ?>').val()!='')
{
$('#<?php echo $this->campoSeguro('fechaCorte') ?>').attr("class", "cuadroTexto ui-widget ui-widget-content ui-corner-all   validate[required]");
}else {
$('#<?php echo $this->campoSeguro('fechaCorte') ?>').attr("class", "cuadroTexto ui-widget ui-widget-content ui-corner-all ");
}
}

});





