<?php
/**
 * Los datos del bloque se encuentran en el arreglo $esteBloque.
 */
// URL base
$url = $this->miConfigurador->getVariableConfiguracion("host");
$url.= $this->miConfigurador->getVariableConfiguracion("site");
$url.= "/index.php?";

// Variables
$cadenaACodificar = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificar.= "&procesarAjax=true";
$cadenaACodificar.= "&action=index.php";
$cadenaACodificar.= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar.= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar.= $cadenaACodificar . "&funcion=SeleccionMeses";
$cadenaACodificar.= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificar, $enlace);

// URL definitiva
$urlFinal = $url . $cadena;
?>
<script type='text/javascript'>

    function datosInfo(elem, request, response) {
        $.ajax({
            url: "<?php echo $urlFinal ?>",
            dataType: "json",
            data: {tiempo: $("#<?php echo $this->campoSeguro('grupo_contable') ?>").val()},
            success: function (data) {

                if (data[0] != 'null') {

                    $("#<?php echo $this->campoSeguro('meses_depreciar') ?>").val(data[0]);
                } else {
                    $("#<?php echo $this->campoSeguro('meses_depreciar') ?>").val('8');
                }
            }
        });
    }
    ;

    $("#<?php echo $this->campoSeguro('grupo_contable') ?>").select2({
        placeholder: "Search for a repository",
        minimumInputLength: 1,
    });

    $("#<?php echo $this->campoSeguro('grupo_contable') ?>").change(function () {
        datosInfo();
    });

</script>

