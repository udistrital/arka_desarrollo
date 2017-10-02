<?php

namespace inventarios\gestionBodega\administracionBodega\funcion;

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

        $directorio = $this->miConfigurador->getVariableConfiguracion('rutaUrlBloque');

      
        $salida = $_REQUEST['serial'];

        $cadenaSql = $this->miSql->getCadenaSql('consultarSalidaElemento', $salida);
        $resultadoSalida = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
        
        
        
        $cadenaSql = $this->miSql->getCadenaSql('consultarRecibeSalidaF', $resultadoSalida[0][5]);
        $recibeFuncionario = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
        
        
        if($recibeFuncionario==false){
            $cadenaSql = $this->miSql->getCadenaSql('consultarRecibeSalidaC', $resultadoSalida[0][5]);
            $recibeContratista = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
            $persona_recibe=$recibeContratista[0][0];
        }
        else{
            $persona_recibe=$recibeFuncionario[0][0];
        }
        
        
        
       
        $contenidoPagina = "
<style type=\"text/css\">
    table { 
        
        font-family:Helvetica, Arial, sans-serif; /* Nicer font */
		
        border-collapse:collapse; border-spacing: 3px; 
    }
    td, th { 
        border: 1px solid #CCC; 
        height: 13px;
    } /* Make cells a bit taller */
	col{
	width=50%;
	
	}			
	th {
        
        font-weight: bold; /* Make sure they're bold */
        text-align: center;
        font-size:10px
    }
    img {
        float: left;
    }
   
</style>				
			
<page backtop='5mm' backbottom='20mm' backleft='5mm' backright='5mm' footer='page'>
<table align='center' style='width:100%;' >
            <tr>
                <td align='left' style='width:60%;' >
                    <img SRC=" . $this->miConfigurador->getVariableConfiguracion('rutaUrlBloque') . 'images/escudo.jpg' . " WIDTH=50 HEIGHT=60>
                    <font size=2><b>UNIVERSIDAD DISTRITAL <br> FRANCISCO JOSÉ DE CALDAS </b></font>
                     <br>
                     <font size='9px'><i>Almacén General e Inventarios</i></font>
                </td>
                <td align='right' style='width:40%;' >
                    <br>                    
                    <font size='9px'><b>Salida de Bodega </b></font>
                </td>
            </tr>
            <tr>
                <td align='left' style='width:60%;' >
                    <font size='4px'>Fecha :  " . date("Y-m-d") . "</font>
		</td>
                <td align='right' style='width:40%;' >
                     <font size='9px'><b>No." . $salida . "</b></font>
                </td>
            </tr>
             <tr>
                <td align='left' style='width:60%;' >
                    <font size='7px'><b>Dependencia: (" . $resultadoSalida[0][0] . ")  </b></font>
                     <br>	
                </td>
                <td align='left' style='width:40%;' >                
                    <font size='7px'><b>Sede: (" . $resultadoSalida[0][1] . ")</b></font>
                     <br>
		 </td>
            </tr>
        </table>
        

<table align='center' style='width:100%;' > 
    
            <tr>
                <td align='center' style='width:20%;' >
                    <font size='9px'>Cantidad</font>
		</td>
                <td align='center' style='width:80%;'>
                     <font size='9px'>Descripción</font>
                </td>
            </tr>";
        $contador = 0;
        while ($contador < count($resultadoSalida)) {
            $contenidoPagina .= "<tr>
        <td style = 'width:20%;text-align=center;'>" . $resultadoSalida [$contador][2] . "</td>
        <td style = 'width:80%;text-align=center;'><font size = '0.5px'>" . $resultadoSalida [$contador][3] . "</font></td>
        </tr > ";
            $contador++;
        }

        $contenidoPagina .="</table>";


        $contenidoPagina .= "<page_footer>";
        $contenidoPagina .= "
												<br>
												<table style='width:100%; background:#FFFFFF ; border: 0px  #FFFFFF;'>
												<tr>
												<td style='width:40%;text-align:center;background:#FFFFFF ; border: 0px  #FFFFFF;'></td>
												<td style='width:40%;text-align:center;background:#FFFFFF ; border: 0px  #FFFFFF;'>_______________________________________________________</td>
                                                                                                <td style='width:20%;text-align:center;background:#FFFFFF ; border: 0px  #FFFFFF;'></td>
												</tr>
                                                                                                <tr>
												<td style='width:40%;text-align:center; border: 0px  #FFFFFF;'>Solicita: " . $resultadoSalida[0][4] . "</td>
												<td style='width:40%;text-align:center; border: 0px  #FFFFFF;'>Recibe: " .$persona_recibe . "</td>
                                                                                                <td style='width:20%;text-align:center; border: 0px  #FFFFFF;'></td>
												</tr>
                                                                                                
												</table>";
        $contenidoPagina .= "
         </page_footer> ";





        $contenidoPagina .= "</page>";


        // echo $contenidoPagina;exit;
        return $contenidoPagina;
    }

}

$miRegistrador = new RegistradorOrden($this->lenguaje, $this->sql, $this->funcion);
$textos = $miRegistrador->documento();
ob_start();
$width_in_mm = 135;
$height_in_mm = 205;
$html2pdf = new \HTML2PDF('P', array($width_in_mm, $height_in_mm), 'es', true, 'UTF-8', array(
            1,
            1,
            1,
            1
        ));
$html2pdf->pdf->SetDisplayMode('fullpage');
$html2pdf->WriteHTML($textos);
$html2pdf->Output('Salida  	' . date('Y-m-d') . '.pdf', 'D');
?>