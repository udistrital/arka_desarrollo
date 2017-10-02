<?php

namespace inventarios\gestionElementos\radicadoLevantamiento\funcion;

$ruta = $this->miConfigurador->getVariableConfiguracion("raizDocumento");

$host = $this->miConfigurador->getVariableConfiguracion("host") . $this->miConfigurador->getVariableConfiguracion("site") . "/plugin/html2pfd/";

include ($ruta . "/plugin/html2pdf/html2pdf.class.php");

if (!isset($GLOBALS ["autorizado"])) {
    include ("../index.php");
    exit();
}

class RegistradorOrden {

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

    function documento() {
        $conexion = "inventarios";
        $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

        $funcionario = $_REQUEST ['funcionario'];

        $cadenaSql = $this->miSql->getCadenaSql('ConsultarSedesRadicado', $_REQUEST ['sedeReporte']);

        $resultado_sedes = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

//        $cadenaSql = $this->miSql->getCadenaSql('ConsultarUbicacionRadicado');
//
//        $resultado_ubicacion = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");




        $cadenaSql = $this->miSql->getCadenaSql('jefe_recursos_fisicos');

        $jefe = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
        $jefe = $jefe [0];

        $directorio = $this->miConfigurador->getVariableConfiguracion('rutaBloque');

        $contenidoPagina = '';

        $contenidoPagina .= "
<style type=\"text/css\">
    table { 
        
        font-family:Helvetica, Arial, sans-serif; /* Nicer font */
		
        border-collapse:collapse; border-spacing: 3px; 
    }

    td, th { 
        border: 1px solid #CCC; 
        height: 13px;
    } 

	col{
	width=50%;
	
	}			
	th {
        
        font-weight: bold; /* Make sure they're bold */
        text-align: center;
        font-size:10px
    }

    td {
        
        text-align: left;
        font-size:10px
    }
</style>				
				
				
<page backtop='1mm' backbottom='1mm' backleft='5mm' backright='5mm' footer='page'>
	

        <table align='left' style='width:100%;' >
            <tr>
                <td align='center' style='width:12%;border=none;' >
                    <img src='" . $directorio . "/css/images/escudo.png'  width='80' height='100'>
                </td>
                <td align='center' style='width:88%;border=none;' >
                    <font size='9px'><b>UNIVERSIDAD DISTRITAL FRANCISCO JOSÉ DE CALDAS </b></font>
                     <br>
                    <font size='7px'><b>NIT: 899.999.230-7</b></font>
                     <br>
                      <br>
                     <font size='9px'><b>Almacén General e Inventarios</b></font>
                    <br>		
                    <font size='7px'><b>Inventario Radicado Funcionario</b></font>
                    <br>									
                    <font size='3px'>www.udistrital.edu.co</font>
                     <br>
                	<br>
                    <font size='4px'>" . date("Y-m-d") . "</font>
                    
                   			
                </td>
            </tr>
        </table>";

        $num_radicados_global = 0;
        $num_no_radicados_global = 0;
        $num_radicados = 0;
        $num_no_radicados = 0;
        $total_inventarios_global=0;



        foreach ($resultado_sedes as $sedes) {
            $cadenaSql = $this->miSql->getCadenaSql('consultarFuncionariosaCargoElementos2', $sedes['codigo_sede']);
            $resultadoElementos = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

            $contenidoPagina.="
                        <table style='width:100%;border=none;'>
                        <tr> 
			<td style='width:50%;text-align:left;background:#FFFFFF ; border: 0px  #FFFFFF;'><b>Sede  : " . $sedes ['sede'] . "</b></td>
			</tr>
                        </table><br>";
            $contador = 0;

            while ($contador < count($resultadoElementos)) {

                if ($resultadoElementos[$contador][9] != NULL) {
                    $num_radicados = $num_radicados + 1;
                    $num_radicados_global = $num_radicados_global + 1;
                } else {
                    $num_no_radicados = $num_no_radicados + 1;
                    $num_no_radicados_global = $num_no_radicados_global + 1;
                }
                $contador++;
            }
            $contenidoPagina .= "";
            $total_inventario = $num_radicados + $num_no_radicados;

            $porcentaje_avance = round(($num_radicados / $total_inventario) * 100, 3);

            $contenidoPagina .= "
			
            <table style='width:100%;'>
                    <tr>
			<td style='width:25%;text-align:center;background:#FFFFFF ;'>Total Radicados:</td>
                        <td style='width:25%;text-align:center;background:#FFFFFF ;'>Total No Radicado:</td>
                        <td style='width:25%;text-align:center;background:#FFFFFF ;'>Total Inventarios:</td>
                        <td style='width:25%;text-align:center;background:#FFFFFF ;'><b>% Avance:</b></td>
                        </tr>
                    <tr>
			<td style='width:10%;text-align:center;background:#FFFFFF ;'>" . $num_radicados . "</td>
			<td style='width:10%;text-align:center;background:#FFFFFF ;'>" . $num_no_radicados . "</td>
			<td style='width:10%;text-align:center;background:#FFFFFF ;'>" . $total_inventario . "</td>
			<td style='width:10%;text-align:center;background:#FFFFFF ;'><b>" . $porcentaje_avance . " %</b></td>
                    </tr>		    		
			</table> <br><br>
			";
            $num_radicados = 0;
            $num_no_radicados = 0;
            $total_inventarios_global= $total_inventarios_global + $total_inventario;
        }







        $total_inventario_global = $total_inventarios_global;

        $porcentaje_avance_global = round(($num_radicados_global / $total_inventario_global) * 100, 3);

        $contenidoPagina .= "
		
			<page_footer  backbottom='10mm'>
			
				
			<table style='width:100%; background:#FFFFFF ; border: 0px  #FFFFFF;'>
			<tr>
			<td style='width:100%;text-align:center;background:#FFFFFF ; border: 0px  #FFFFFF;'>_______________________________________________________</td>
			</tr>
			<tr>
			<td style='width:100%;text-align:center;background:#FFFFFF ; border: 0px  #FFFFFF;'>" . $jefe ['nombre'] . "</td>
			</tr>
			<tr>
			<td style='width:100%;text-align:center;background:#FFFFFF ; border: 0px  #FFFFFF; text-transform:capitalize;'>Jefe Sección Almacén General e Inventarios</td>
			</tr>
			</table>				
				
				
				
				
				
			<table style='width:100%;border=none;'>
            <tr>
			<td style='width:50%;text-align:center;'><b>TOTAL RADICADO GLOBAL:</b></td>
			<td style='width:50%;text-align:center;'><b>" . $num_radicados_global . "</b></td>
 		 	</tr>
			<tr>
			<td style='width:50%;text-align:center;'><b>TOTAL NO RADICADOS GLOBAL:</b></td>
			<td style='width:50%;text-align:center;'><b>" . $num_no_radicados_global . "</b></td>
 		 	</tr>
			<tr>
			<td style='width:50%;text-align:center;'><b>TOTAL INVENTARIOS:</b></td>
			<td style='width:50%;text-align:center;'><b>" . $total_inventario_global . "</b></td>
 		 	</tr>
			<tr>
			<td style='width:50%;text-align:center;'><b>% AVANCE:</b></td>
			<td style='width:50%;text-align:center;'><b>" . $porcentaje_avance_global . " %</b></td>
 		 	</tr>
			</table>
			</page_footer>
//					";

        $contenidoPagina .= "</page>";



        return $contenidoPagina;
    }

}

$miRegistrador = new RegistradorOrden($this->lenguaje, $this->sql, $this->funcion);

$textos = $miRegistrador->documento();

ob_start();
$html2pdf = new \HTML2PDF('L', 'LETTER', 'es', true, 'UTF-8', array(
    1,
    2,
    2,
    10
        ));
$html2pdf->pdf->SetDisplayMode('fullpage');
$html2pdf->WriteHTML($textos);

$html2pdf->Output('Radicado Funcionario  	' . date('Y-m-d') . '.pdf', 'D');
?>





