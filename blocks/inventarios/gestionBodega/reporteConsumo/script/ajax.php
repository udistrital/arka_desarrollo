<?php
/**
 * Los datos del bloque se encuentran en el arreglo $esteBloque.
 */
// URL base
$url = $this->miConfigurador->getVariableConfiguracion("host");
$url.= $this->miConfigurador->getVariableConfiguracion("site");
$url.= "/index.php?";
$urlDirectorio = $url;
$urlDirectorio = $urlDirectorio . "/plugin/scripts/javascript/dataTable/Spanish.json";
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


//Atributos para cargar elementos
$cadenaACodificar2 = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificar2 .= "&procesarAjax=true";
$cadenaACodificar2 .= "&action=index.php";
$cadenaACodificar2 .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar2 .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar2 .= $cadenaACodificar2 . "&funcion=Consulta";
$cadenaACodificar2 .= "&tiempo=" . $_REQUEST ['tiempo'];

if (isset($_REQUEST['id_grupo']) && $_REQUEST['id_grupo'] != '') {
    $nivel = $_REQUEST['id_grupo'];
} else {
    $nivel = '';
}

if (isset($_REQUEST['id_funcionario']) && $_REQUEST['id_funcionario'] != '') {
    $funcionario = $_REQUEST['id_funcionario'];
} else {
    $funcionario = '';
}

if (isset($_REQUEST['fechaCorte']) && $_REQUEST['fechaCorte'] != '') {
    $fechaCorte = $_REQUEST['fechaCorte'];
} else {
    $fechaCorte = date('Y-m-d');
}


if (isset($_REQUEST['id_cuenta']) && $_REQUEST['id_cuenta'] != '') {
    $cuenta_contable = $_REQUEST['id_cuenta'];
} else {
    $cuenta_contable = '';
}

$arreglo = array(
    'grupo' => $nivel,
    'funcionario' => $funcionario,
    'fecha_corte' => $fechaCorte,
    'cuenta_salida' => $cuenta_contable,
);

$arreglo = serialize($arreglo);

$cadenaACodificar2.= "&arreglo=" . $arreglo;

// Codificar las variables
$enlace2 = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadena2 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificar2, $enlace2);

// URL definitiva
$urlFinal2 = $url . $cadena2;







$cadenaACodificarGrupo = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificarGrupo .= "&procesarAjax=true";
$cadenaACodificarGrupo .= "&action=index.php";
$cadenaACodificarGrupo .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificarGrupo .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificarGrupo .= "&funcion=grupo";
$cadenaACodificarGrupo .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificarGrupo, $enlace);

// URL definitiva
$urlFinalGrupo = $url . $cadena;


$cadenaACodificarCuenta = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificarCuenta .= "&procesarAjax=true";
$cadenaACodificarCuenta .= "&action=index.php";
$cadenaACodificarCuenta .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificarCuenta .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificarCuenta .= "&funcion=cuenta";
$cadenaACodificarCuenta .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificarCuenta, $enlace);

// URL definitiva
$urlFinalCuenta = $url . $cadena;


$cadenaACodificarFuncionario = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificarFuncionario .= "&procesarAjax=true";
$cadenaACodificarFuncionario .= "&action=index.php";
$cadenaACodificarFuncionario .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificarFuncionario .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificarFuncionario .= "&funcion=funcionario";
$cadenaACodificarFuncionario .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificarFuncionario, $enlace);

// URL definitiva
$urlFinalFuncionario = $url . $cadena;
?>
<script type='text/javascript'>
    $('#<?php echo $this->campoSeguro('sede') ?>').width(210);
    $("#<?php echo $this->campoSeguro('sede') ?>").select2();


    $(function () {
        $('#tablaTitulos').ready(function () {

            $('#tablaTitulos').dataTable({
                dom: 'Blfrtip',
                buttons: [
                    'csvFlash',
                    'excelFlash'
                ],
                language: {
                    url: "<?php echo $urlDirectorio ?>"
                },
                processing: true,
                searching: true,
                info: true,
                paging: true,
                ajax: {
                    url: "<?php echo $urlFinal2 ?>",
                    dataSrc: "data"
                },
                columns: [
                    {data: "cuenta"},
                    {data: "grupo"},
                    {data: "fechaSalida"},
                    {data: "fechaCorte"},
                    {data: "funcionario"},
                    {data: "sede"},
                    {data: "dependencia"},
                    {data: "espacio"},
                    {data: "valor_historico"},
                    {data: "ajuste_inflacion"},
                    {data: "valor_ajustado"},
                    {data: "circular_56"},
                    {data: "circular_depreciacion"},
                    {data: "valor_libros"},
                ]
            });
        });
    });



    $(function () {


        $("#<?php echo $this->campoSeguro('grupo_contable') ?>").keyup(function () {
            $('#<?php echo $this->campoSeguro('grupo_contable') ?>').val($('#<?php echo $this->campoSeguro('grupo_contable') ?>').val().toUpperCase());
        });

        $("#<?php echo $this->campoSeguro('grupo_contable') ?>").autocomplete({
            minChars: 2,
            serviceUrl: '<?php echo $urlFinalGrupo; ?>',
            onSelect: function (suggestion) {
                $("#<?php echo $this->campoSeguro('id_grupo') ?>").val(suggestion.data);
            }
        });
    });


    $(function () {

        $("#<?php echo $this->campoSeguro('cuenta_salida') ?>").keyup(function () {
            $('#<?php echo $this->campoSeguro('cuenta_salida') ?>').val($('#<?php echo $this->campoSeguro('cuenta_salida') ?>').val().toUpperCase());
        });

        $("#<?php echo $this->campoSeguro('cuenta_salida') ?>").autocomplete({
            minChars: 2,
            serviceUrl: '<?php echo $urlFinalCuenta; ?>',
            onSelect: function (suggestion) {
                $("#<?php echo $this->campoSeguro('id_cuenta') ?>").val(suggestion.data);
            }
        });
    });


    $(function () {

        $("#<?php echo $this->campoSeguro('funcionario') ?>").keyup(function () {
            $('#<?php echo $this->campoSeguro('funcionario') ?>').val($('#<?php echo $this->campoSeguro('funcionario') ?>').val().toUpperCase());
        });

        $("#<?php echo $this->campoSeguro('funcionario') ?>").autocomplete({
            minChars: 2,
            serviceUrl: '<?php echo $urlFinalFuncionario; ?>',
            onSelect: function (suggestion) {
                $("#<?php echo $this->campoSeguro('id_funcionario') ?>").val(suggestion.data);
            }
        });
    });







</script>

