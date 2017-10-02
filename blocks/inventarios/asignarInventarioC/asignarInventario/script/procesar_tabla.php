<?php
/**
 *
 * Los datos del bloque se encuentran en el arreglo $esteBloque.
 */
// Variables
$cadenaACodificar = "pagina=" . $this->miConfigurador->getVariableConfiguracion("pagina");
$cadenaACodificar .= "&procesarAjax=true";
$cadenaACodificar .= "&action=index.php";
$cadenaACodificar .= "&bloqueNombre=" . $esteBloque ["nombre"];
$cadenaACodificar .= "&bloqueGrupo=" . $esteBloque ["grupo"];
$cadenaACodificar .= "&funcion=ConsultarInventario";
$cadenaACodificar .= "&usuario=" . $_REQUEST ['usuario'];
$cadenaACodificar .= "&funcionario=" . $_REQUEST ['usuario'];
$cadenaACodificar .= "&tiempo=" . $_REQUEST ['tiempo'];

if (isset($_REQUEST ['accesoCondor']) && $_REQUEST ['accesoCondor'] == 'true') {

    $_REQUEST ['funcionario'] = $_REQUEST ['usuario'];
    $cadenaACodificar .= "&accesoCondor='true'";
}

if (isset($_REQUEST ['funcionario']) && $_REQUEST ['funcionario'] != '') {
    $funcionario = $_REQUEST ['funcionario'];
} else {
    $funcionario = '';
}
if (isset($_REQUEST ['selec_nivel']) && $_REQUEST ['selec_nivel'] != '') {
    $arreglo2 = $_REQUEST ['selec_nivel'];
} else {
    $arreglo2 = '';
}
$cadenaACodificar .= "&arreglo2=" . $arreglo2;

// Codificar las variables
$enlace = $this->miConfigurador->getVariableConfiguracion("enlace");
$cadena = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($cadenaACodificar, $enlace);

// URL definitiva
$urlFinal = $url . $cadena;
?>
<script type='text/javascript'>




    $(function () {
        $('#tablaTitulos').ready(function () {

            $('#tablaTitulos').dataTable({
//              	 serverSide: true,
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sSearch": "Buscar:",
                    "sLoadingRecords": "Cargando...",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Ãšltimo",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    }
                },
                processing: true,
                searching: true,
                "deferLoading": 500,
                info: true,
                "scrollY": "600px",
                "scrollCollapse": false,
                "pagingType": "full_numbers",
                "bLengthChange": false,
                "bPaginate": false,
                ajax: {
                    url: "<?php echo $urlFinal ?>",
                    dataSrc: "data"
                },
                columns: [
                    {data: "placa"},
                    {data: "descripcion"},
                    {data: "marca"},
                    {data: "serie"},
                    {data: "sede"},
                    {data: "dependencia"},
                    {data: "ubicacion"},
                    {data: "seleccion"},
                ]
            });

        });

    });




 

</script>
