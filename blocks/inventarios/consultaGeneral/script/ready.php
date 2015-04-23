<?php ?>

// Asociar el widget de validación al formulario
$("#consultaGeneral").validationEngine({
promptPosition : "centerRight", 
scroll: false,
autoHidePrompt: true,
autoHideDelay: 2000
});


$(function() {
$("#consultaGeneral").submit(function() {
$resultado=$("#consultaGeneral").validationEngine("validate");



if ($resultado) {

return true;
}
return false;
});
});

$('#tablaTitulos').dataTable( {
"sPaginationType": "full_numbers"
} );



$('#<?php echo $this->campoSeguro('sede') ?>').select2();
$('#<?php echo $this->campoSeguro('nombreFuncionario') ?>').select2();
$('#<?php echo $this->campoSeguro('selec_tipoConsulta') ?>').select2();
$("#<?php echo $this->campoSeguro('selec_dependencia_Sol') ?>").select2();



$("#<?php echo $this->campoSeguro('numero_entrada') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('numero_salida') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('vigencia_entrada') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('vigencia_salida') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('proveedor') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('numero_placa') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('numero_serie') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDtraslado') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDbaja') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('estado_b') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDfaltante') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDhurto') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('tipo_entrada') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('agrupacionCriterios') ?>").css('display','none');




$( "#<?php echo $this->campoSeguro('selec_tipoConsulta')?>" ).change(function() {
switch($("#<?php echo $this->campoSeguro('selec_tipoConsulta') ?>").val())
{

case '1':

$("#<?php echo $this->campoSeguro('numero_entrada') ?>").css('display','block');
$("#<?php echo $this->campoSeguro('numero_salida') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('vigencia_entrada') ?>").css('display','block');
$("#<?php echo $this->campoSeguro('vigencia_salida') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('proveedor') ?>").css('display','block');
$("#<?php echo $this->campoSeguro('numero_placa') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('numero_serie') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDtraslado') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDbaja') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('estado_b') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDfaltante') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDhurto') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('agrupacionCriterios') ?>").css('display','block');
$("#<?php echo $this->campoSeguro('tipo_entrada') ?>").css('display','block');


$("#<?php echo $this->campoSeguro('numero_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('tipo_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('vigencia_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 2,
});

$("#<?php echo $this->campoSeguro('numero_salida') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('vigencia_salida') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 2,
});

$("#<?php echo $this->campoSeguro('proveedor') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});


$("#<?php echo $this->campoSeguro('numero_placa') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('numero_serie') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDfaltante') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDhurto') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDbaja') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDtraslado') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('estado_b') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

break;


case '2':

$("#<?php echo $this->campoSeguro('numero_entrada') ?>").css('display','block');
$("#<?php echo $this->campoSeguro('numero_salida') ?>").css('display','block');
$("#<?php echo $this->campoSeguro('vigencia_entrada') ?>").css('display','block');
$("#<?php echo $this->campoSeguro('vigencia_salida') ?>").css('display','block');
$("#<?php echo $this->campoSeguro('proveedor') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('numero_placa') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('numero_serie') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDtraslado') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDbaja') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('estado_b') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDfaltante') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDhurto') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('tipo_entrada') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('agrupacionCriterios') ?>").css('display','block');

$("#<?php echo $this->campoSeguro('numero_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('vigencia_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 2,
});

$("#<?php echo $this->campoSeguro('tipo_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});


$("#<?php echo $this->campoSeguro('numero_salida') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('vigencia_salida') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 2,
});

$("#<?php echo $this->campoSeguro('proveedor') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});


$("#<?php echo $this->campoSeguro('numero_placa') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('numero_serie') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDfaltante') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDhurto') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDbaja') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDtraslado') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('estado_b') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

break;


case '3':

$("#<?php echo $this->campoSeguro('numero_entrada') ?>").css('display','block');
$("#<?php echo $this->campoSeguro('numero_salida') ?>").css('display','block');
$("#<?php echo $this->campoSeguro('vigencia_entrada') ?>").css('display','block');
$("#<?php echo $this->campoSeguro('vigencia_salida') ?>").css('display','block');
$("#<?php echo $this->campoSeguro('proveedor') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('numero_placa') ?>").css('display','block');
$("#<?php echo $this->campoSeguro('numero_serie') ?>").css('display','block');
$("#<?php echo $this->campoSeguro('IDtraslado') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDbaja') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('estado_b') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDfaltante') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDhurto') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('tipo_entrada') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('agrupacionCriterios') ?>").css('display','block');

$("#<?php echo $this->campoSeguro('numero_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('tipo_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('vigencia_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 2,
});

$("#<?php echo $this->campoSeguro('numero_salida') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('vigencia_salida') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 2,
});

$("#<?php echo $this->campoSeguro('proveedor') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});


$("#<?php echo $this->campoSeguro('numero_placa') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('numero_serie') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDfaltante') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDhurto') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDbaja') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDtraslado') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('estado_b') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});


break;

case '4':
$("#<?php echo $this->campoSeguro('numero_entrada') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('numero_salida') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('vigencia_entrada') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('vigencia_salida') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('proveedor') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('numero_placa') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('numero_serie') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDtraslado') ?>").css('display','block');
$("#<?php echo $this->campoSeguro('IDbaja') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('estado_b') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDfaltante') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDhurto') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('tipo_entrada') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('agrupacionCriterios') ?>").css('display','block');


$("#<?php echo $this->campoSeguro('numero_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('tipo_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});


$("#<?php echo $this->campoSeguro('vigencia_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 2,
});

$("#<?php echo $this->campoSeguro('numero_salida') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('vigencia_salida') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 2,
});

$("#<?php echo $this->campoSeguro('proveedor') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});


$("#<?php echo $this->campoSeguro('numero_placa') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('numero_serie') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDfaltante') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDhurto') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDbaja') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDtraslado') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('estado_b') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

break;



case '5':
$("#<?php echo $this->campoSeguro('numero_entrada') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('numero_salida') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('vigencia_entrada') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('vigencia_salida') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('proveedor') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('numero_placa') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('numero_serie') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDtraslado') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDbaja') ?>").css('display','block');
$("#<?php echo $this->campoSeguro('estado_b') ?>").css('display','block');
$("#<?php echo $this->campoSeguro('IDfaltante') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDhurto') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('tipo_entrada') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('agrupacionCriterios') ?>").css('display','block');


$("#<?php echo $this->campoSeguro('numero_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('vigencia_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 2,
});

$("#<?php echo $this->campoSeguro('numero_salida') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('tipo_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('vigencia_salida') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 2,
});

$("#<?php echo $this->campoSeguro('proveedor') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});


$("#<?php echo $this->campoSeguro('numero_placa') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('numero_serie') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDfaltante') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDhurto') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDbaja') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDtraslado') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('estado_b') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

break;


case '6':
$("#<?php echo $this->campoSeguro('numero_entrada') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('numero_salida') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('vigencia_entrada') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('vigencia_salida') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('proveedor') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('numero_placa') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('numero_serie') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDtraslado') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDbaja') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('estado_b') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDfaltante') ?>").css('display','block');
$("#<?php echo $this->campoSeguro('IDhurto') ?>").css('display','block');
$("#<?php echo $this->campoSeguro('tipo_entrada') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('agrupacionCriterios') ?>").css('display','block');


$("#<?php echo $this->campoSeguro('numero_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('tipo_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('vigencia_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 2,
});

$("#<?php echo $this->campoSeguro('numero_salida') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('vigencia_salida') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 2,
});

$("#<?php echo $this->campoSeguro('proveedor') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});


$("#<?php echo $this->campoSeguro('numero_placa') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('numero_serie') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDfaltante') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDhurto') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDbaja') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDtraslado') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('estado_b') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

break;

case '7':
$("#<?php echo $this->campoSeguro('numero_entrada') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('numero_salida') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('vigencia_entrada') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('vigencia_salida') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('proveedor') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('numero_placa') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('numero_serie') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDtraslado') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDbaja') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('estado_b') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDfaltante') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDhurto') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('tipo_entrada') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('agrupacionCriterios') ?>").css('display','none');

$("#<?php echo $this->campoSeguro('numero_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('tipo_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('vigencia_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 2,
});

$("#<?php echo $this->campoSeguro('numero_salida') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('vigencia_salida') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 2,
});

$("#<?php echo $this->campoSeguro('proveedor') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});


$("#<?php echo $this->campoSeguro('numero_placa') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('numero_serie') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDfaltante') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDhurto') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDbaja') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDtraslado') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('estado_b') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

break;

default:

$("#<?php echo $this->campoSeguro('numero_entrada') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('numero_salida') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('vigencia_entrada') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('vigencia_salida') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('proveedor') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('numero_placa') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('numero_serie') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDtraslado') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDbaja') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('estado_b') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDfaltante') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('IDhurto') ?>").css('display','none');
$("#<?php echo $this->campoSeguro('tipo_entrada') ?>").css('display','none');


$("#<?php echo $this->campoSeguro('numero_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('tipo_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('vigencia_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 2,
});

$("#<?php echo $this->campoSeguro('numero_salida') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('vigencia_salida') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 2,
});

$("#<?php echo $this->campoSeguro('proveedor') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});


$("#<?php echo $this->campoSeguro('numero_placa') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('numero_serie') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDfaltante') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDhurto') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDbaja') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDtraslado') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('estado_b') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

break;

}
});  


           
$("#<?php echo $this->campoSeguro('numero_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('tipo_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('vigencia_entrada') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 2,
});

$("#<?php echo $this->campoSeguro('numero_salida') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('vigencia_salida') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 2,
});

$("#<?php echo $this->campoSeguro('proveedor') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});


$("#<?php echo $this->campoSeguro('numero_placa') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('numero_serie') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDfaltante') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDhurto') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDbaja') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('IDtraslado') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
});

$("#<?php echo $this->campoSeguro('estado_b') ?>").select2({
placeholder: "Search for a repository",
minimumInputLength: 1,
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
	   
           
