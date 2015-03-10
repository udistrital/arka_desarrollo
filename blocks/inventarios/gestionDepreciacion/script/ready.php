
// Asociar el widget de validación al formulario
$("#gestionDepreciacion").validationEngine({
promptPosition : "centerRight", 
scroll: false,
autoHidePrompt: true,
autoHideDelay: 2000
});


$(function() {
$("#gestionDepreciacion").submit(function() {
$resultado=$("#gestionDepreciacion").validationEngine("validate");
if ($resultado) {
return true;
}
return false;
});
});

$("#<?php echo $this->campoSeguro('nivel') ?>").select2();
$("#<?php echo $this->campoSeguro('grupo_contable') ?>").select2();







$('#tablaTitulos').dataTable( {
"sPaginationType": "full_numbers"
} );


$( "#<?php echo $this->campoSeguro('precio') ?>" ).keyup(function() {
cantidad=Number($("#<?php echo $this->campoSeguro('cantidad') ?>").val());
valor=Number($("#<?php echo $this->campoSeguro('precio') ?>").val());
meses=Number($("#<?php echo $this->campoSeguro('meses_depreciar') ?>").val());


corte=$("#<?php echo $this->campoSeguro('fechaCorte') ?>").val();
salida=$("#<?php echo $this->campoSeguro('fechaSalida') ?>").val();

var y = salida.substring(0,4);
var m = salida.substring(5,7);
var m2 = Number(m)-1;
var d = salida.substring(8,10);
var cadena_1 = new Date(y, m2, d);

var cy = corte.substring(0,4);
var cm = corte.substring(5,7);
var cm2 = Number(cm)-1;
var cd = corte.substring(8,10);
var cadena_2 = new Date(cy, cm2, cd);

var periodo=Number((cy-y)*12+(cm2-m2));


precio = cantidad * valor;

//VALORES HISTORIO Y AJUSTADO
if (precio==0){
$("#<?php echo $this->campoSeguro('valor_historico') ?>").val('');
$("#<?php echo $this->campoSeguro('valor_ajustado') ?>").val('');
}else{
$("#<?php echo $this->campoSeguro('valor_historico') ?>").val(precio);
$("#<?php echo $this->campoSeguro('valor_ajustado') ?>").val(precio);
}

// VALOR DE LA CUOTA
if(meses==0){
$("#<?php echo $this->campoSeguro('cuota') ?>").val('');
$("#<?php echo $this->campoSeguro('periodos_fecha') ?>").val('');
cuota= 0;
$("#<?php echo $this->campoSeguro('cuota') ?>").val(cuota);
}else{
cuota= parseInt(Number($("#<?php echo $this->campoSeguro('valor_historico') ?>").val())/meses);
$("#<?php echo $this->campoSeguro('periodos_fecha') ?>").val(periodo);
$("#<?php echo $this->campoSeguro('cuota') ?>").val(cuota);
}


//DEPRECIACION AUMULADA
if(periodo>=meses){
$("#<?php echo $this->campoSeguro('depreciacion_acumulada') ?>").val(precio);
dep_acumulada=0;
}else{
dep_acumulada=cuota*periodo;
$("#<?php echo $this->campoSeguro('depreciacion_acumulada') ?>").val(dep_acumulada);
}

inflacion=9;

//CIRCULAR 56
valor_h=Number($("#<?php echo $this->campoSeguro('valor_historico') ?>").val())+inflacion;
$("#<?php echo $this->campoSeguro('circular_56') ?>").val(valor_h);


//CUOTAS AJUSTES POR INFLACION
if(meses==0){
$("#<?php echo $this->campoSeguro('cuota_inflacion') ?>").val('');
cuota_inflacion=0;
$("#<?php echo $this->campoSeguro('cuota_inflacion') ?>").val(cuota_inflacion);
}else{
cuota_inflacion= inflacion/meses;
$("#<?php echo $this->campoSeguro('cuota_inflacion') ?>").val(cuota_inflacion);
}


//AJUSTE POR INFLACION A LA DEPRECIACION ACUMULADA
if(meses==0){
$("#<?php echo $this->campoSeguro('api_acumulada') ?>").val(inflacion);
}else{
if(periodo>=meses){
$("#<?php echo $this->campoSeguro('api_acumulada') ?>").val(inflacion);
api_acumulada=0;
}else{
api_acumulada=cuota_inflacion*periodo;
$("#<?php echo $this->campoSeguro('api_acumulada') ?>").val(api_acumulada);
}
}


//CIRCULAR 56 - DEPRECIACIÓN

circular_depreciacion=api_acumulada+dep_acumulada;
$("#<?php echo $this->campoSeguro('circular_depreciacion') ?>").val(circular_depreciacion);

//VALOR A LOS LIBROS
valor_ajustado=$("#<?php echo $this->campoSeguro('valor_ajustado') ?>").val();
valor_libros=valor_ajustado-circular_depreciacion;
$("#<?php echo $this->campoSeguro('valor_libros') ?>").val(valor_libros);
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











