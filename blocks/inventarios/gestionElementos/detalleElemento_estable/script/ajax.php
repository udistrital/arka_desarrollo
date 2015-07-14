<?php
/**
 *
 * Los datos del bloque se encuentran en el arreglo $esteBloque.
 */
$pagina = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
// URL base
$url = $this->miConfigurador->getVariableConfiguracion("host");
$url .= $this->miConfigurador->getVariableConfiguracion("site");

$urlDirectorio = $url;

$urlDirectorio = $urlDirectorio . "/plugin/scripts/javascript/dataTable/Spanish.json";

$url .= "/index.php?";

// Variables
$cadenaACodificar = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificar .= "&procesarAjax=true";
$cadenaACodificar .= "&action=index.php";
$cadenaACodificar .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar .= $cadenaACodificar . "&funcion=Consulta";
$cadenaACodificar .= "&tiempo=" . $_REQUEST ['tiempo'];

if (isset($_REQUEST ['fecha_inicio']) && $_REQUEST ['fecha_inicio'] != '') {
    $fecha_inicio = $_REQUEST ['fecha_inicio'];
} else {
    $fecha_inicio = '';
}

if (isset($_REQUEST ['fecha_final']) && $_REQUEST ['fecha_final'] != '') {
    $fecha_final = $_REQUEST ['fecha_final'];
} else {
    $fecha_final = '';
}

if (isset($_REQUEST ['sede']) && $_REQUEST ['sede'] != '') {
    $sede = $_REQUEST ['sede'];
} else {
    $sede = '';
}

if (isset($_REQUEST ['dependencia']) && $_REQUEST ['dependencia'] != '') {
    $dependencia = $_REQUEST ['dependencia'];
} else {
    $dependencia = '';
}

if (isset($_REQUEST ['ubicacion']) && $_REQUEST ['ubicacion'] != '') {
    $ubicacion = $_REQUEST ['ubicacion'];
} else {
    $ubicacion = '';
}

if (isset($_REQUEST ['nombreFuncionario']) && $_REQUEST ['nombreFuncionario'] != '') {
    $funcionario = $_REQUEST ['nombreFuncionario'];
} else {
    $funcionario = '';
}

if (isset($_REQUEST ['numero_entrada']) && $_REQUEST ['numero_entrada'] != '') {
    $entrada = $_REQUEST ['numero_entrada'];
} else {
    $entrada = '';
}

if (isset($_REQUEST ['id_placa']) && $_REQUEST ['id_placa'] != '') {
    $elemento = $_REQUEST ['id_placa'];
} else {
    $elemento = '';
}

$datos = array(
    'entrada' => $entrada,
    'sede' => $sede,
    'dependencia' => $dependencia,
    'ubicacion' => $ubicacion,
    'funcionario' => $funcionario,
    'fechainicial' => $fecha_inicio,
    'fechafinal' => $fecha_final,
    'elemento' => $elemento,
);

$arreglo = serialize($datos);

$cadenaACodificar .= $cadenaACodificar . "&arreglo=" . $arreglo;



// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificar, $enlace);


// URL definitiva
$urlFinal = $url . $cadena;
// echo $urlFinal;

$cadena0 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($pagina, $enlace);

//Cadena codificada para listar Placas
$cadenaACodificar1 = $cadenaACodificar . "&funcion=placas";
$cadena1 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificar1, $enlace);

$urlFinal1 = $url . $cadena1;


// Variables
$cadenaACodificar16 = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificar16 .= "&procesarAjax=true";
$cadenaACodificar16 .= "&action=index.php";
$cadenaACodificar16 .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar16 .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar16 .= $cadenaACodificar16 . "&funcion=consultarDependencia";
$cadenaACodificar16 .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadena16 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificar16, $enlace);

// URL definitiva
$urlFinal16 = $url . $cadena16;


// Variables
$cadenaACodificar4 = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificar4 .= "&procesarAjax=true";
$cadenaACodificar4 .= "&action=index.php";
$cadenaACodificar4 .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar4 .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar4 .= $cadenaACodificar4 . "&funcion=consultarUbicacion";
$cadenaACodificar4 .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadena4 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificar4, $enlace);

// URL definitiva
$urlFinal4 = $url . $cadena4;
?>
<script type='text/javascript'>
    $(document).ready(function () {
        $("#<?php echo $this->campoSeguro('placa') ?>").devbridgeAutocomplete({
            minLength: 2,
            serviceUrl: '<?php echo $urlFinal1; ?>',
            onSelect: function (suggestion) {
                $("#<?php echo $this->campoSeguro('id_placa') ?>").val(suggestion.data);
            }
        });
    });

</script>

<script type='text/javascript'>
    $(function () {

        $('#tablaTitulos').ready(function () {
            $('#tablaTitulos').dataTable({
//              	 serverSide: true,
                language: {
                    url: "<?php echo $urlDirectorio ?>"
                },
                processing: true,
                searching: true,
                info: true,
                paging: true,
                ajax: {
                    url: "<?php echo $urlFinal ?>",
                    dataSrc: "data"
                },
                columns: [
                    {data: "placa"},
                    {data: "descripcion"},
                    {data: "sede"},
                    {data: "dependencia"},
                    {data: "funcionario"},
                    {data: "detalle"}
                ]
            });

        });





        $("#<?php echo $this->campoSeguro('sede') ?>").change(function () {
            if ($("#<?php echo $this->campoSeguro('sede') ?>").val() != '') {

                consultarDependencia();
            } else {
                $("#<?php echo $this->campoSeguro('dependencia') ?>").attr('disabled', '');
            }

        });


        $("#<?php echo $this->campoSeguro('dependencia') ?>").change(function () {
            if ($("#<?php echo $this->campoSeguro('dependencia') ?>").val() != '') {
                consultarEspacio();
            } else {
                $("#<?php echo $this->campoSeguro('ubicacion') ?>").attr('disabled', '');
            }

        });

    });


    function consultarDependencia(elem, request, response) {
        $.ajax({
            url: "<?php echo $urlFinal16 ?>",
            dataType: "json",
            data: {valor: $("#<?php echo $this->campoSeguro('sede') ?>").val()},
            success: function (data) {



                if (data[0] != " ") {

                    $("#<?php echo $this->campoSeguro('dependencia') ?>").html('');
                    $("<option value=''>Seleccione  ....</option>").appendTo("#<?php echo $this->campoSeguro('dependencia') ?>");
                    $.each(data, function (indice, valor) {

                        $("<option value='" + data[ indice ].ESF_CODIGO_DEP + "'>" + data[ indice ].ESF_DEP_ENCARGADA + "</option>").appendTo("#<?php echo $this->campoSeguro('dependencia') ?>");

                    });

                    $("#<?php echo $this->campoSeguro('dependencia') ?>").removeAttr('disabled');

                    $('#<?php echo $this->campoSeguro('dependencia') ?>').width(210);
                    $("#<?php echo $this->campoSeguro('dependencia') ?>").select2();



                }


            }

        });
    }
    ;






    function consultarEspacio(elem, request, response) {
        $.ajax({
            url: "<?php echo $urlFinal4 ?>",
            dataType: "json",
            data: {valor: $("#<?php echo $this->campoSeguro('dependencia') ?>").val()},
            success: function (data) {



                if (data[0] != " ") {

                    $("#<?php echo $this->campoSeguro('ubicacion') ?>").html('');
                    $("<option value=''>Seleccione  ....</option>").appendTo("#<?php echo $this->campoSeguro('ubicacion') ?>");
                    $.each(data, function (indice, valor) {

                        $("<option value='" + data[ indice ].ESF_ID_ESPACIO + "'>" + data[ indice ].ESF_NOMBRE_ESPACIO + "</option>").appendTo("#<?php echo $this->campoSeguro('ubicacion') ?>");

                    });

                    $("#<?php echo $this->campoSeguro('ubicacion') ?>").removeAttr('disabled');
                    $('#<?php echo $this->campoSeguro('ubicacion') ?>').width(200);
                    $("#<?php echo $this->campoSeguro('ubicacion') ?>").select2();


                }
            }

        });
    }
    ;























</script>


<?php
// disable warnings
