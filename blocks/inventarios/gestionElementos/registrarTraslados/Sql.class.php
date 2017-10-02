<?php

namespace inventarios\gestionElementos\registrarTraslados;

if (!isset($GLOBALS ["autorizado"])) {
    include ("../index.php");
    exit();
}

include_once ("core/manager/Configurador.class.php");
include_once ("core/connection/Sql.class.php");

// Para evitar redefiniciones de clases el nombre de la clase del archivo sqle debe corresponder al nombre del bloque
// en camel case precedida por la palabra sql
class Sql extends \Sql {

    var $miConfigurador;

    function __construct() {
        $this->miConfigurador = \Configurador::singleton();
    }

    function getCadenaSql($tipo, $variable = "", $auxiliar = "") {

        /**
         * 1.
         * Revisar las variables para evitar SQL Injection
         */
        $prefijo = $this->miConfigurador->getVariableConfiguracion("prefijo");
        $idSesion = $this->miConfigurador->getVariableConfiguracion("id_sesion");

        switch ($tipo) {

            /**
             * Clausulas específicas
             */
            case "buscarUsuario" :
                $cadenaSql = "SELECT ";
                $cadenaSql .= "FECHA_CREACION, ";
                $cadenaSql .= "PRIMER_NOMBRE ";
                $cadenaSql .= "FROM ";
                $cadenaSql .= "USUARIOS ";
                $cadenaSql .= "WHERE ";
                $cadenaSql .= "`PRIMER_NOMBRE` ='" . $variable . "' ";
                break;

            case "insertarRegistro" :
                $cadenaSql = "INSERT INTO ";
                $cadenaSql .= $prefijo . "registradoConferencia ";
                $cadenaSql .= "( ";
                $cadenaSql .= "`idRegistrado`, ";
                $cadenaSql .= "`nombre`, ";
                $cadenaSql .= "`apellido`, ";
                $cadenaSql .= "`identificacion`, ";
                $cadenaSql .= "`codigo`, ";
                $cadenaSql .= "`correo`, ";
                $cadenaSql .= "`tipo`, ";
                $cadenaSql .= "`fecha` ";
                $cadenaSql .= ") ";
                $cadenaSql .= "VALUES ";
                $cadenaSql .= "( ";
                $cadenaSql .= "NULL, ";
                $cadenaSql .= "'" . $variable ['nombre'] . "', ";
                $cadenaSql .= "'" . $variable ['apellido'] . "', ";
                $cadenaSql .= "'" . $variable ['identificacion'] . "', ";
                $cadenaSql .= "'" . $variable ['codigo'] . "', ";
                $cadenaSql .= "'" . $variable ['correo'] . "', ";
                $cadenaSql .= "'0', ";
                $cadenaSql .= "'" . time() . "' ";
                $cadenaSql .= ")";
                break;

            case "actualizarRegistro" :
                $cadenaSql = "UPDATE ";
                $cadenaSql .= $prefijo . "conductor ";
                $cadenaSql .= "SET ";
                $cadenaSql .= "`nombre` = '" . $variable ["nombre"] . "', ";
                $cadenaSql .= "`apellido` = '" . $variable ["apellido"] . "', ";
                $cadenaSql .= "`identificacion` = '" . $variable ["identificacion"] . "', ";
                $cadenaSql .= "`telefono` = '" . $variable ["telefono"] . "' ";
                $cadenaSql .= "WHERE ";
                $cadenaSql .= "`idConductor` =" . $_REQUEST ["registro"] . " ";
                break;

            /**
             * Clausulas genéricas.
             * se espera que estén en todos los formularios
             * que utilicen esta plantilla
             */
            case "iniciarTransaccion" :
                $cadenaSql = "START TRANSACTION";
                break;

            case "finalizarTransaccion" :
                $cadenaSql = "COMMIT";
                break;

            case "cancelarTransaccion" :
                $cadenaSql = "ROLLBACK";
                break;

            case "eliminarTemp" :

                $cadenaSql = "DELETE ";
                $cadenaSql .= "FROM ";
                $cadenaSql .= $prefijo . "tempFormulario ";
                $cadenaSql .= "WHERE ";
                $cadenaSql .= "id_sesion = '" . $variable . "' ";
                break;

            case "insertarTemp" :
                $cadenaSql = "INSERT INTO ";
                $cadenaSql .= $prefijo . "tempFormulario ";
                $cadenaSql .= "( ";
                $cadenaSql .= "id_sesion, ";
                $cadenaSql .= "formulario, ";
                $cadenaSql .= "campo, ";
                $cadenaSql .= "valor, ";
                $cadenaSql .= "fecha ";
                $cadenaSql .= ") ";
                $cadenaSql .= "VALUES ";

                foreach ($_REQUEST as $clave => $valor) {
                    $cadenaSql .= "( ";
                    $cadenaSql .= "'" . $idSesion . "', ";
                    $cadenaSql .= "'" . $variable ['formulario'] . "', ";
                    $cadenaSql .= "'" . $clave . "', ";
                    $cadenaSql .= "'" . $valor . "', ";
                    $cadenaSql .= "'" . $variable ['fecha'] . "' ";
                    $cadenaSql .= "),";
                }

                $cadenaSql = substr($cadenaSql, 0, (strlen($cadenaSql) - 1));
                break;

            case "rescatarTemp" :
                $cadenaSql = "SELECT ";
                $cadenaSql .= "id_sesion, ";
                $cadenaSql .= "formulario, ";
                $cadenaSql .= "campo, ";
                $cadenaSql .= "valor, ";
                $cadenaSql .= "fecha ";
                $cadenaSql .= "FROM ";
                $cadenaSql .= $prefijo . "tempFormulario ";
                $cadenaSql .= "WHERE ";
                $cadenaSql .= "id_sesion='" . $idSesion . "'";
                break;

            /**
             * Clausulas Del Caso Uso.
             */
            case "ubicacionesConsultadas" :
                $cadenaSql = "SELECT DISTINCT  ef.\"ESF_ID_ESPACIO\" , ef.\"ESF_NOMBRE_ESPACIO\" ";
                $cadenaSql .= " FROM arka_parametros.arka_espaciosfisicos ef  ";
                $cadenaSql .= " JOIN arka_parametros.arka_dependencia ad ON ad.\"ESF_ID_ESPACIO\"=ef.\"ESF_ID_ESPACIO\" ";
                $cadenaSql .= " JOIN  arka_parametros.arka_sedes sa ON sa.\"ESF_COD_SEDE\"=ef.\"ESF_COD_SEDE\" ";
                $cadenaSql .= " WHERE ad.\"ESF_CODIGO_DEP\"='" . $variable [0] . "' ";
                $cadenaSql .= " AND  sa.\"ESF_ID_SEDE\"='" . $variable [1] . "' ";
                $cadenaSql .= " AND  ef.\"ESF_ESTADO\"='A'";

                break;

            case "dependenciasConsultadas" :
                $cadenaSql = "SELECT DISTINCT  \"ESF_CODIGO_DEP\" , \"ESF_DEP_ENCARGADA\" ";
                $cadenaSql .= " FROM arka_parametros.arka_dependencia ad ";
                $cadenaSql .= " JOIN  arka_parametros.arka_espaciosfisicos ef ON  ef.\"ESF_ID_ESPACIO\"=ad.\"ESF_ID_ESPACIO\" ";
                $cadenaSql .= " JOIN  arka_parametros.arka_sedes sa ON sa.\"ESF_COD_SEDE\"=ef.\"ESF_COD_SEDE\" ";
                $cadenaSql .= " WHERE sa.\"ESF_ID_SEDE\"='" . $variable . "' ";
                $cadenaSql .= " AND  ad.\"ESF_ESTADO\"='A'";

                break;

            case "sede" :
                $cadenaSql = "SELECT DISTINCT  \"ESF_ID_SEDE\", \"ESF_SEDE\" ";
                $cadenaSql .= " FROM arka_parametros.arka_sedes ";
                $cadenaSql .= " WHERE   \"ESF_ESTADO\"='A' ";
                $cadenaSql .= " AND    \"ESF_COD_SEDE\" >  0 ";

                break;

            case "dependencias" :
                $cadenaSql = "SELECT DISTINCT  \"ESF_CODIGO_DEP\" , \"ESF_DEP_ENCARGADA\" ";
                $cadenaSql .= " FROM arka_parametros.arka_dependencia ad ";
                $cadenaSql .= " JOIN  arka_parametros.arka_espaciosfisicos ef ON  ef.\"ESF_ID_ESPACIO\"=ad.\"ESF_ID_ESPACIO\" ";
                $cadenaSql .= " JOIN  arka_parametros.arka_sedes sa ON sa.\"ESF_COD_SEDE\"=ef.\"ESF_COD_SEDE\" ";
                $cadenaSql .= " WHERE ad.\"ESF_ESTADO\"='A'";

                break;

            case "ubicaciones" :
                $cadenaSql = "SELECT DISTINCT  ef.\"ESF_ID_ESPACIO\" , ef.\"ESF_NOMBRE_ESPACIO\" ";
                $cadenaSql .= " FROM arka_parametros.arka_espaciosfisicos ef  ";
                $cadenaSql .= " JOIN arka_parametros.arka_dependencia ad ON ad.\"ESF_ID_ESPACIO\"=ef.\"ESF_ID_ESPACIO\" ";
                $cadenaSql .= " WHERE  ef.\"ESF_ESTADO\"='A'";
                break;
            case "funcionarios" :
                $cadenaSql = "SELECT DISTINCT \"FUN_IDENTIFICACION\", \"FUN_IDENTIFICACION\" ||' - '||  \"FUN_NOMBRE\" ";
                $cadenaSql .= "FROM  arka_parametros.arka_funcionarios ";
                $cadenaSql .= "WHERE \"FUN_IDENTIFICACION\"<>'899999230' ";
//                $cadenaSql .= "AND \"FUN_ESTADO\"='A' ";

                break;

            case "funcionario_informacion_fn" :

                $cadenaSql = "SELECT \"FUN_IDENTIFICACION\" ||' - '|| \"FUN_NOMBRE\" ";
                $cadenaSql .= "FROM arka_parametros.arka_funcionarios ";
                $cadenaSql .= "WHERE \"FUN_IDENTIFICACION\"='" . $variable . "' ";
                $cadenaSql .= "AND \"FUN_ESTADO\"='A' ";

                break;

            case "seleccion_funcionario" :

                $cadenaSql = "SELECT id_funcionario, identificacion ||'-'||nombre AS funcionario  ";
                $cadenaSql .= "FROM funcionario;";
                break;

            case "consultarElemento" :

                $cadenaSql = ' SELECT DISTINCT id_elemento_ind, elemento_individual.placa,  ';
                $cadenaSql .= ' elemento_individual.serie, elemento_individual.funcionario, id_elemento_gen,  ';
                $cadenaSql .= ' elemento_individual.id_salida , tipo_bienes.descripcion, dependencias."ESF_DEP_ENCARGADA" dependencia,elemento.descripcion descripcion_elemento,
                    			 funcionario."FUN_IDENTIFICACION" iden_funcionario, 
  								funcionario."FUN_NOMBRE" nom_funcionario,espacios."ESF_NOMBRE_ESPACIO" espacio,sedes."ESF_SEDE" sede,dependencias."ESF_CODIGO_DEP" coddep ';
                $cadenaSql .= ' FROM elemento_individual  ';
                $cadenaSql .= ' JOIN elemento ON elemento.id_elemento = elemento_individual.id_elemento_gen  ';
                $cadenaSql .= ' LEFT JOIN salida ON salida.id_salida = elemento_individual.id_salida  ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_funcionarios as funcionario ON funcionario."FUN_IDENTIFICACION" = elemento_individual.funcionario  ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_espaciosfisicos as espacios ON espacios."ESF_ID_ESPACIO"=elemento_individual.ubicacion_elemento ';

                $cadenaSql .= " LEFT JOIN  arka_parametros.arka_sedes sedes ON sedes.\"ESF_COD_SEDE\"=espacios.\"ESF_COD_SEDE\" ";
                $cadenaSql .= " LEFT JOIN   arka_parametros.arka_dependencia dependencias ON dependencias.\"ESF_ID_ESPACIO\"=espacios.\"ESF_ID_ESPACIO\" ";

                $cadenaSql .= ' LEFT JOIN tipo_bienes ON tipo_bienes.id_tipo_bienes = elemento.tipo_bien  ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_dependencia ON arka_parametros.arka_dependencia."ESF_CODIGO_DEP"=salida.dependencia ';

                // $cadenaSql .= "JOIN funcionario ON funcionario.id_funcionario = salida.funcionario ";
                $cadenaSql .= "WHERE 1=1 ";
                $cadenaSql .= "AND elemento.tipo_bien <> 1 ";
                $cadenaSql .= "AND elemento_individual.id_elemento_ind NOT IN (SELECT id_elemento_ind FROM arka_inventarios.estado_elemento WHERE estado_registro='t' AND id_reposicion=0 AND tipo_faltsobr in (2,3)) ";
                $cadenaSql .= "AND elemento_individual.id_elemento_ind NOT IN (SELECT id_elemento_ind FROM  arka_inventarios.baja_elemento) ";

                if ($variable ['funcionario'] != '') {
                    $cadenaSql .= " AND elemento_individual.funcionario = '" . $variable ['funcionario'] . "'";
                }
                if ($variable ['serie'] != '') {
                    $cadenaSql .= " AND  elemento_individual.serie= '" . $variable ['serie'] . "'";
                }
                if ($variable ['placa'] != '') {
                    $cadenaSql .= " AND  elemento_individual.placa= '" . $variable ['placa'] . "'";
                }

                if ($variable ['sede'] != '') {
                    $cadenaSql .= ' AND sedes."ESF_ID_SEDE" = ';
                    $cadenaSql .= " '" . $variable ['sede'] . "' ";
                }

                if ($variable ['dependencia'] != '') {
                    $cadenaSql .= ' AND dependencias."ESF_CODIGO_DEP" = ';
                    $cadenaSql .= " '" . $variable ['dependencia'] . "' ";
                }

                if ($variable ['ubicacion'] != '') {
                    $cadenaSql .= ' AND espacios."ESF_ID_ESPACIO" = ';
                    $cadenaSql .= " '" . $variable ['ubicacion'] . "' ";
                }

                $cadenaSql .= " ; ";

                break;


            case "verificar_elemento_funcionario" :

                $cadenaSql = ' SELECT DISTINCT id_elemento_ind, elemento_individual.placa,  ';
                $cadenaSql .= ' elemento_individual.serie, elemento_individual.funcionario, id_elemento_gen,  ';
                $cadenaSql .= ' elemento_individual.id_salida , tipo_bienes.descripcion, dependencias."ESF_DEP_ENCARGADA" dependencia,elemento.descripcion descripcion_elemento,
                    			 funcionario."FUN_IDENTIFICACION" iden_funcionario, 
  								funcionario."FUN_NOMBRE" nom_funcionario,espacios."ESF_NOMBRE_ESPACIO" espacio,sedes."ESF_SEDE" sede,dependencias."ESF_CODIGO_DEP" coddep ';
                $cadenaSql .= ' FROM elemento_individual  ';
                $cadenaSql .= ' JOIN elemento ON elemento.id_elemento = elemento_individual.id_elemento_gen  ';
                $cadenaSql .= ' LEFT JOIN salida ON salida.id_salida = elemento_individual.id_salida  ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_funcionarios as funcionario ON funcionario."FUN_IDENTIFICACION" = elemento_individual.funcionario  ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_espaciosfisicos as espacios ON espacios."ESF_ID_ESPACIO"=elemento_individual.ubicacion_elemento ';

                $cadenaSql .= " LEFT JOIN  arka_parametros.arka_sedes sedes ON sedes.\"ESF_COD_SEDE\"=espacios.\"ESF_COD_SEDE\" ";
                $cadenaSql .= " LEFT JOIN   arka_parametros.arka_dependencia dependencias ON dependencias.\"ESF_ID_ESPACIO\"=espacios.\"ESF_ID_ESPACIO\" ";

                $cadenaSql .= ' LEFT JOIN tipo_bienes ON tipo_bienes.id_tipo_bienes = elemento.tipo_bien  ';
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_dependencia ON arka_parametros.arka_dependencia."ESF_CODIGO_DEP"=salida.dependencia ';

                // $cadenaSql .= "JOIN funcionario ON funcionario.id_funcionario = salida.funcionario ";
                $cadenaSql .= "WHERE 1=1 ";
                $cadenaSql .= "AND elemento.tipo_bien <> 1 ";
                $cadenaSql .= "AND elemento_individual.id_elemento_ind NOT IN (SELECT id_elemento_ind FROM arka_inventarios.estado_elemento WHERE estado_registro='t' AND id_reposicion=0 AND tipo_faltsobr in (2,3)) ";
                $cadenaSql .= "AND elemento_individual.id_elemento_ind NOT IN (SELECT id_elemento_ind FROM  arka_inventarios.baja_elemento) ";

                if ($auxiliar != '') {
                    $cadenaSql .= " AND elemento_individual.funcionario = '" . $auxiliar . "'";
                }
                if ($variable != '') {
                    $cadenaSql .= " AND  elemento_individual.placa= '" . $variable . "'";
                }
                $cadenaSql .= " ; ";

                break;



            case "consultarElementoID" :

                $cadenaSql = ' SELECT DISTINCT id_elemento_ind ';
                $cadenaSql .= ' FROM elemento_individual ';
                $cadenaSql .= ' WHERE ';
                $cadenaSql .= ' placa = ';
                $cadenaSql .= " '" . $variable . "' ";
                break;

            case "consultarElementoBaja" :

                $cadenaSql = ' SELECT DISTINCT id_elemento_ind ';
                $cadenaSql .= ' FROM baja_elemento ';
                $cadenaSql .= ' WHERE ';
                $cadenaSql .= ' id_elemento_ind = ';
                $cadenaSql .= " " . $variable . " ";
                break;
            case "consultarElementoEstado" :

                $cadenaSql = ' SELECT DISTINCT id_elemento_ind ';
                $cadenaSql .= ' FROM estado_elemento ';
                $cadenaSql .= ' WHERE ';
                $cadenaSql .= ' id_elemento_ind = ';
                $cadenaSql .= " " . $variable . "  AND id_reposicion = 0";
                break;



            case "elemento_informacion" :

                $cadenaSql = "SELECT DISTINCT ";
                $cadenaSql .= " id_elemento_ind id, elemento_individual.placa, ";
                $cadenaSql .= " tipo_bienes.descripcion tipo, elemento.descripcion,  elemento_individual.funcionario, ";
                $cadenaSql .= ' "ESF_DEP_ENCARGADA"  dependencia ';
                $cadenaSql .= " FROM elemento_individual ";
                $cadenaSql .= " LEFT JOIN elemento ON elemento.id_elemento = elemento_individual.id_elemento_gen ";
                $cadenaSql .= " LEFT JOIN salida ON salida.id_salida = elemento_individual.id_salida ";
                $cadenaSql .= " LEFT JOIN tipo_bienes ON tipo_bienes.id_tipo_bienes = elemento.tipo_bien ";
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_dependencia ON arka_parametros.arka_dependencia."ESF_ID_ESPACIO"=elemento_individual.ubicacion_elemento ';
                // $cadenaSql .= "JOIN funcionario ON funcionario.id_funcionario = salida.funcionario ";
                $cadenaSql .= " WHERE 1=1 ";
                $cadenaSql .= " AND id_elemento_ind='" . $variable . "' ";


                break;

            case "elemento_informacionxplaca" :

                $cadenaSql = "SELECT DISTINCT ";
                $cadenaSql .= " id_elemento_ind id, elemento_individual.placa, ";
                $cadenaSql .= " tipo_bienes.descripcion tipo, elemento.descripcion,  elemento_individual.funcionario, ";
                $cadenaSql .= ' "ESF_DEP_ENCARGADA"  dependencia ';
                $cadenaSql .= " FROM elemento_individual ";
                $cadenaSql .= " LEFT JOIN elemento ON elemento.id_elemento = elemento_individual.id_elemento_gen ";
                $cadenaSql .= " LEFT JOIN salida ON salida.id_salida = elemento_individual.id_salida ";
                $cadenaSql .= " LEFT JOIN tipo_bienes ON tipo_bienes.id_tipo_bienes = elemento.tipo_bien ";
                $cadenaSql .= ' LEFT JOIN arka_parametros.arka_dependencia ON arka_parametros.arka_dependencia."ESF_ID_ESPACIO"=elemento_individual.ubicacion_elemento ';
                // $cadenaSql .= "JOIN funcionario ON funcionario.id_funcionario = salida.funcionario ";
                $cadenaSql .= " WHERE 1=1 ";
                $cadenaSql .= " AND placa='" . $variable . "' ";
              


                break;
            case "seleccion_funcionario_anterior" :

                $cadenaSql = "SELECT id_elemento_ind,funcionario ";
                $cadenaSql .= "FROM elemento_individual ";
                $cadenaSql .= "JOIN salida ON salida.id_salida = elemento_individual.id_salida ";
                // $cadenaSql .= "JOIN funcionario ON funcionario.id_funcionario = salida.funcionario ";
                $cadenaSql .= "WHERE  id_elemento_ind='" . $variable . "';";

                break;

            case "insertar_historico" :

                $cadenaSql = " INSERT INTO arka_inventarios.historial_elemento_individual( ";
                $cadenaSql .= "fecha_registro, elemento_individual, funcionario,descripcion_funcionario, destino, observaciones,usuario)  ";
                $cadenaSql .= " VALUES ";

                $tamaño = sizeof($variable);
                foreach ($variable as $key => $values) {

                    if ($tamaño == 1) {
                        $cadenaSql .= "('" . $auxiliar [0] . "',";
                        $cadenaSql .= "'" . $variable [$key] ['id'] . "',";
                        $cadenaSql .= "'" . $auxiliar [1] . "',";
                        $cadenaSql .= "'" . $variable [$key] ['funcionario'] . "',";
                        $cadenaSql .= "'" . $auxiliar [2] . "',";
                        $cadenaSql .= "'" . $auxiliar [3] . "',";
                        $cadenaSql .= "'" . $auxiliar [4] . "') ";
                    } else {
                        $cadenaSql .= "('" . $auxiliar [0] . "',";
                        $cadenaSql .= "'" . $variable [$key] ['id'] . "',";
                        $cadenaSql .= "'" . $auxiliar [1] . "',";
                        $cadenaSql .= "'" . $variable [$key] ['funcionario'] . "',";
                        $cadenaSql .= "'" . $auxiliar [2] . "',";
                        $cadenaSql .= "'" . $auxiliar [3] . "',";
                        $cadenaSql .= "'" . $auxiliar [4] . "'), ";
                    }
                    $tamaño--;
                }



                break;

            case "eliminar_historico" :

                $cadenaSql = " DELETE FROM historial_elemento_individual( ";
                $cadenaSql .= "WHERE  id_evento='" . $variable . "'";
                break;

            case "actualizar_salida" :
                $tamaño = sizeof($variable);

                $cadenaSql = " UPDATE arka_inventarios.elemento_individual ";
                $cadenaSql .= " SET funcionario=" . $auxiliar ['recibe'] . ", ";
                $cadenaSql .= " ubicacion_elemento='" . $auxiliar ['ubicacion'] . "' ";
                $cadenaSql .= " WHERE id_elemento_ind IN (";
                foreach ($variable as $key => $values) {
                    if ($tamaño == 1) {
                        $cadenaSql .= $variable [$key] ['id'] . ")";
                    } else {
                        $cadenaSql .= $variable [$key] ['id'] . ", ";
                    }
                    $tamaño--;
                }

                break;

            case "actualizar_registro_salida" :

                $cadenaSql = " UPDATE salida ";
                $cadenaSql .= " SET funcionario='" . $variable [1] . "', ";
                $cadenaSql .= " sede='" . $variable [2] . "' ,";
                $cadenaSql .= " dependencia='" . $variable [3] . "' ,";
                $cadenaSql .= " ubicacion='" . $variable [4] . "' ";
                $cadenaSql .= " WHERE id_salida ='" . $variable [0] . "' ;";

                break;

            case "buscar_salidas" :

                $cadenaSql = " SELECT id_elemento_ind, id_salida as salida  ";
                $cadenaSql .= " FROM elemento_individual  ";
                $cadenaSql .= " WHERE id_elemento_ind='" . $variable . "' ;";

                break;

            case "funcionario_informacion" :

                $cadenaSql = "SELECT FUN_IDENTIFICACION,  FUN_NOMBRE ";
                $cadenaSql .= "FROM FUNCIONARIOS ";
                $cadenaSql .= "WHERE FUN_IDENTIFICACION='" . $variable . "' ";
                $cadenaSql .= "AND FUN_ESTADO='A' ";

                break;

            case "buscar_serie" :
                $cadenaSql = " SELECT DISTINCT serie, serie as series ";
                $cadenaSql .= "FROM elemento_individual ";
                $cadenaSql .= "WHERE  serie <> '' ";
                $cadenaSql .= "ORDER BY serie DESC ";

                break;

            case "buscar_placa" :
                $cadenaSql = " SELECT DISTINCT placa, placa as placas ";
                $cadenaSql .= "FROM elemento_individual ";
                $cadenaSql .= "ORDER BY placa DESC ";
                break;

            case "dependencia_nombre" :
                $cadenaSql = 'SELECT "ESF_NOMBRE_ESPACIO" ';
                $cadenaSql .= " FROM arka_parametros.arka_espaciosfisicos ";
                $cadenaSql .= ' WHERE "ESF_ID_ESPACIO"=';
                $cadenaSql .= "'" . $variable . "'";

                break;

            case "ConsultasPlacas" :
                $cadenaSql = " SELECT DISTINCT placa AS value, placa as data ";
                $cadenaSql .= "FROM elemento_individual ";
                $cadenaSql .= "WHERE placa IS NOT NULL  ";
                $cadenaSql .= " AND placa LIKE '" . $variable . "%' ";
                $cadenaSql .= "ORDER BY placa ASC ;";
                break;
        }
        return $cadenaSql;
    }

}

?>
