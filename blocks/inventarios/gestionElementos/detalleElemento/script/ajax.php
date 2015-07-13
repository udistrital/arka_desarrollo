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



// Variables
$cadenaACodificar3 = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificar3 .= "&procesarAjax=true";
$cadenaACodificar3 .= "&action=index.php";
$cadenaACodificar3 .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar3 .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar3 .= $cadenaACodificar3 . "&funcion=subeFoto";
$cadenaACodificar3 .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadena3 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificar3, $enlace);

// URL definitiva
$urlFinal3 = $url . $cadena3;


// Variables
$cadenaACodificar5 = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificar5 .= "&procesarAjax=true";
$cadenaACodificar5 .= "&action=index.php";
$cadenaACodificar5 .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar5 .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar5 .= $cadenaACodificar5 . "&funcion=eliminaFoto";
$cadenaACodificar5 .= "&tiempo=" . $_REQUEST ['tiempo'];

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadena5 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificar5, $enlace);

// URL definitiva
$urlFinal5 = $url . $cadena5;
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


        $("#images").fileinput({
            uploadUrl:"<?php echo $urlFinal3?>", // server upload action
            uploadAsync: true,
            showUpload: true,
            minFileCount: 1,
            maxFileCount: 10,
            overwriteInitial: false,
            'allowedFileExtensions': ['jpg', 'png'],
            initialPreview: [
                "<img src='http://placeimg.com/200/150/people/1'>",
                "<img src='http://placeimg.com/200/150/people/2'>",
            ],
            initialPreviewConfig: [
                {caption: "People-1.jpg", width: "120px", url: "<?php echo $urlFinal5 ?>", key: 1},
                {caption: "People-2.jpg", width: "120px", url: "<?php echo $urlFinal5 ?>", key: 2},
            ]
        });

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
