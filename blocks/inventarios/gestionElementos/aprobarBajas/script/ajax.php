<?php
/**
 *
 * Los datos del bloque se encuentran en el arreglo $esteBloque.
 */
// URL base
$url = $this->miConfigurador->getVariableConfiguracion("host");
$url .= $this->miConfigurador->getVariableConfiguracion("site");
$url .= "/index.php?";




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

    $(function () {
        $('#tablaTitulos').ready(function () {

            $('#tablaTitulos').dataTable({
                language: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sSearch": "Buscar:",
                    "sLoadingRecords": "Cargando...",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                },
                processing: true,
                searching: true,
                "deferLoading": 500,
                info: true,
                "scrollY": "400px",
                "scrollCollapse": false,
                "pagingType": "full_numbers",
                "bLengthChange": false,
                "bPaginate": false,
                
                 "aoColumns" : [
                    { sWidth: "6%" },
                    { sWidth: "8%" },
                    { sWidth: "20%" },
                    { sWidth: "20%" },
                    { sWidth: "20%" },
                    { sWidth: "20%" },
                    { sWidth: "6%" }
                ]
               
            });

        });

    });

    function marcar(obj) {
        elem = obj.elements;
        for (i = 0; i < elem.length; i++)
            if (elem[i].type == "checkbox")
                elem[i].checked = true;
    }

    function desmarcar(obj) {
        elem = obj.elements;
        for (i = 0; i < elem.length; i++)
            if (elem[i].type == "checkbox")
                elem[i].checked = false;
    }



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
            data: {valorD: $("#<?php echo $this->campoSeguro('dependencia') ?>").val(),
                valorS: $("#<?php echo $this->campoSeguro('sede') ?>").val(), },
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


    $(function () {


        $("#<?php echo $this->campoSeguro('selecc_registros') ?>").change(function () {


            if ($("#<?php echo $this->campoSeguro('selecc_registros') ?>").val() == 1) {
                marcar(this.form);


            } else {

                desmarcar(this.form);
            }

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
</script>