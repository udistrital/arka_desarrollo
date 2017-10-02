<?php
/**
 *
 * Los datos del bloque se encuentran en el arreglo $esteBloque.
 */
$url = $this->miConfigurador->getVariableConfiguracion("host");
$url .= $this->miConfigurador->getVariableConfiguracion("site");
$url .= "/index.php?";

// Variables
$cadenaACodificar = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificar .= "&procesarAjax=true";
$cadenaACodificar .= "&action=index.php";
$cadenaACodificar .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar .= "&funcion=SeleccionTipoBien";
$cadenaACodificar .="&tiempo=" . $_REQUEST['tiempo'];


// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificar, $enlace);

// URL definitiva
$urlFinal = $url . $cadena;


// Variables
$cadenaACodificarProveedor = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificarProveedor .= "&procesarAjax=true";
$cadenaACodificarProveedor .= "&action=index.php";
$cadenaACodificarProveedor .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificarProveedor .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificarProveedor .= "&funcion=consultaProveedor";
$cadenaACodificarProveedor .= "&tiempo=" . $_REQUEST ['tiempo'];



// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificarProveedor, $enlace);

// URL definitiva
$urlFinalProveedor = $url . $cadena;
?>


<script>

    $(document).ready(function () {
        $('#botonMod').hide();
        var table = $('#tablaTitulos').DataTable();


        $('#tablaTitulos tbody').on('click', 'tr', function () {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });
        $('#btConfirmar').click(function () {
           

            var cadena = [];
            var con = 0;

            campos = '';

            table.rows('.selected').every(function (rowIdx, tableLoop, rowLoop) {
                var data = this.data();

                campos = campos + data[0] + ',';
                
                if(data != null){
                     $("#confirmar").hide("fast");
                     $('#botonMod').show();
                     $('#botonReg').hide();
                }

            });
            $("#<?php echo $this->campoSeguro('variablesCampo') ?>").val(campos);
        });
    });

    $(function () {

        $("#<?php echo $this->campoSeguro('nitproveedor') ?>").keyup(function () {
            $('#<?php echo $this->campoSeguro('nitproveedor') ?>').val($('#<?php echo $this->campoSeguro('nitproveedor') ?>').val().toUpperCase());
        });

        $("#<?php echo $this->campoSeguro('nitproveedor') ?>").autocomplete({
            minChars: 3,
            serviceUrl: '<?php echo $urlFinalProveedor; ?>',
            onSelect: function (suggestion) {
                $("#<?php echo $this->campoSeguro('id_proveedor') ?>").val(suggestion.data);
            }
        });

    });







</script>