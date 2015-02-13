<?php

namespace inventarios\asignarInventarioC\generarPazSalvo\funcion;

use inventarios\asignarInventarioC\generarPazSalvo\funcion\redireccion;
use inventarios\asignarInventarioC\generarPazSalvo\script\html2pdf;

include_once ('redireccionar.php');
include_once ('html2pdf.class.php');

if (!isset($GLOBALS ["autorizado"])) {
    include ("../index.php");
    exit();
}

class RegistradorActa {

    var $miConfigurador;
    var $lenguaje;
    var $miFormulario;
    var $miFuncion;
    var $miSql;
    var $conexion;

    function __construct($lenguaje, $sql, $funcion) {
        $this->miConfigurador = \Configurador::singleton();
        $this->miConfigurador->fabricaConexiones->setRecursoDB('principal');
        $this->lenguaje = $lenguaje;
        $this->miSql = $sql;
        $this->miFuncion = $funcion;
    }

    function procesarFormulario() {
        date_default_timezone_set('America/Bogota');

        $fecha = date('d-m-Y');

        ob_start();

        $ContenidoPdf = "
<style type=\"text/css\">
    table { 
        color:#333; /* Lighten up font color */
        font-family:Helvetica, Arial, sans-serif; /* Nicer font */
        border-collapse:collapse; 
      }

    table.page_header {width: 100%; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
    table.page_footer {width: 100%; border: none; background-color: #DDDDFF; border-top: solid 1mm #AAAADD; padding: 2mm}

    td, th { 
        border: 1px solid #CCC; 
        height: 13px;
    } /* Make cells a bit taller */

    th {
        background: #F3F3F3; /* Light grey background */
        font-weight: bold; /* Make sure they're bold */
        text-align: center;
        font-size:8px
    }

    td {
        background: #FAFAFA; /* Lighter grey background */
        text-align: left;
        font-size:9px
    }
</style>
<page backtop='5mm' backbottom='10mm' backleft='10mm' backright='10mm' pagegroup='new'>

<page_footer>
        <p style='text-align: left; font-size:7px;'>Fecha Generación: " . $fecha . "</p><p style='text-align: right; font-size:10px;'>[[page_cu]]/[[page_nb]]</p>
</page_footer> 

        <table>
            <thead>
                <tr>
                    <th style=\"width:10px;word-warp:break-word\" colspan='1' rowspan='2'>
                        <img src='" . $rutaBloque . "/images/ud.jpg'>
                    </th>
                    <th style=\"width:650px;font-size:13px;\" colspan=\"5\">
                        <br>UNIVERSIDAD DISTRITAL FRANCISCO JOSÉ DE CALDAS
                        <br> NIT 899999230-7<br><br>
                        Sistema Gestión de Inventarios<br><br>
                        PAZ Y SALVO ELEMENTOS
                        <br><br>
                    </th>
                </tr>
                <tr>
                    <th colspan='5' style='font-size:10px;'></th>
                </tr>
            </thead>      
            <tr>
                <th colspan='6' style='font-size:10px;'>INFORMACIÓN GENERAL DEL DOCENTE</th>
            </tr>
           </table>
       <table>
            <tr>
                <td style=\"width:735px;text-align:right;\">
                    <br><br><br><br><br><br>
                </td>
            </tr>
            <tr>
                <th style=\"width:735px;text-align:center;\">
                    Jefe(a) Oficina de Docencia
                </th>
            </tr>
        </table>        

</page>
              

";

        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', 3);
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->WriteHTML($ContenidoPdf);
        clearstatcache();
        $html2pdf->Output('PazSalvo.pdf', 'D');
    }

}

$miRegistrador = new RegistradorActa($this->lenguaje, $this->sql, $this->funcion);

$resultado = $miRegistrador->procesarFormulario();
?>