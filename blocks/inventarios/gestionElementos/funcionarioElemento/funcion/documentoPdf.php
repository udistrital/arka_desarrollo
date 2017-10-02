<?php

namespace inventarios\gestionElementos\funcionarioElemento\funcion;



use inventarios\gestionElementos\funcionarioElemento\funcion\redireccion;

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

	   
        $esteBloque = $this->miConfigurador->getVariableConfiguracion("esteBloque");
        $rutaBloque = $this->miConfigurador->getVariableConfiguracion("host");
        $rutaBloque .= $this->miConfigurador->getVariableConfiguracion("site") . "/blocks/";
        $rutaBloque .= $esteBloque ['grupo'] . "/" . $esteBloque ['nombre'];

        $conexion = "inventarios";
        $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);

        if (isset($_REQUEST ['funcionario']) && $_REQUEST ['funcionario'] != '') {
            $funcionario = $_REQUEST ['funcionario'];
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

        $arreglo = array(
            'funcionario' => $funcionario,
            'sede' => $sede,
            'dependencia' => $dependencia,
            'ubicacion' => $ubicacion
        );


        $cadenaSql = $this->miSql->getCadenaSql('consultarCountElementos', $arreglo);
        $count = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

        if (isset($count) && $count != false) {
            $num_tipos = count($count);
            $aux_con = 0;
            while ($aux_con < $num_tipos) {
                if ($count[$aux_con][1] == 2) {
                    $numero_consumo = $count[$aux_con][0];
                }
                if ($count[$aux_con][1] == 3) {
                    $numero_devolutivo = $count[$aux_con][0];
                }
                $aux_con++;
            }
        }


        if (isset($numero_consumo)) {
            $cadenaSql = $this->miSql->getCadenaSql('consultarElementosCC', $arreglo, $numero_consumo);
            $elementos_consumo_controlado = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
        }
        if (isset($numero_devolutivo)) {
            $cadenaSql = $this->miSql->getCadenaSql('consultarElementosDEV', $arreglo, $numero_devolutivo);
            $elementos_devolutivos = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
        }

        $cadenaSql = $this->miSql->getCadenaSql('nombreFuncionario', $_REQUEST ['funcionario']);
        $nombre_funcionario = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");

//        $resultado = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");


        $cadenaSql = $this->miSql->getCadenaSql('jefe_recursos_fisicos');
        // echo $cadenaSql;
        $jefe = $esteRecursoDB->ejecutarAcceso($cadenaSql, "busqueda");
        $jefe = $jefe [0];

        // var_dump($jefe);exit;
        // var_dump($resultado);exit;
//        foreach ($resultado as $valor) {
//
//            if ($valor ['tipo_bien'] == 2) {
//
//                $elementos_consumo_controlado [] = $valor;
//            }
//
//            if ($valor ['tipo_bien'] == 3) {
//
//                $elementos_devolutivos [] = $valor;
//            }
//        }
        // var_dump($elementos_devolutivos);exit;

        $directorio = $this->miConfigurador->getVariableConfiguracion('rutaUrlBloque');

        $contenidoPagina = '';

        if (isset($elementos_consumo_controlado) && $elementos_consumo_controlado!=false) {

            $contenidoPagina .= "
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
    td {
        
        text-align: left;
        font-size:10px
    }
</style>				
				
				
<page backtop='5mm' backbottom='20mm' backleft='5mm' backright='5mm' footer='page'>
	
        <table align='center'>
        
            <tr style=\"width:1px;\" colspan=\"1\">
                <th rowspan='3'> <img alt=\"Imagen\" src=" . $rutaBloque . "/css/images/escudoDistrital.png\" /></th>
                <th style=\"width:300px;font-size:11px;\" colspan=\"1\">LEVANTAMIENTO DE INVENTARIOS</th>            
                <th style=\"width:100px;font-size:11px;\" colspan=\"1\">Código: GIF PR-003-FR-004</th>
                <th rowspan='3'> <img alt=\"Imagen\" src=" . $rutaBloque . "/css/images/sigud.jpg\" /></th>
            </tr>
            <tr style=\"width:1px;\" colspan=\"1\">
                <th style=\"width:300px;font-size:11px;\" colspan=\"1\">Macroproceso: Gestión de Recursos</th>            
                <th style=\"width:100px;font-size:11px;\" colspan=\"1\">Versión: 03</th>  
            </tr>
            <tr style=\"width:1px;\" colspan=\"1\">
                <th style=\"width:300px;font-size:11px;\" colspan=\"1\">Proceso: Gestión de Infraestructura Física</th>            
                <th style=\"width:100px;font-size:11px;\" colspan=\"1\">Fecha de Aprobación: 23/03/16</th>  
            </tr>
              
                    <tr></tr>
   		</table>  	<br><br><br>
           	<table style='width:100%;border=none;'>
            <tr> 
			<td style='width:50%;text-align:center;background:#FFFFFF ; border: 0px  #FFFFFF;'>NOMBRE FUNCIONARIO : " . $nombre_funcionario[0][0] . "</td>
			<td style='width:50%;text-align:center;background:#FFFFFF ; border: 0px  #FFFFFF;'>CC : " . $_REQUEST ['funcionario'] . "</td> 			
 		 	</tr>
			</table>
			
           	<table style='width:100%;'>
            <tr> 
			<td style='width:100%;border=none;text-align:left;'>TIPO DE BIEN CONSUMO CONTROLADO</td> 			
 		 	</tr>
			</table>  
			 <br>		
			<table style='width:100%;'>
			<tr> 
			<td style='width:10%;text-align=center;'>Placa</td>
			<td style='width:10%;text-align=center;'>Sede</td>
			<td style='width:10%;text-align=center;'>Dependencia</td>
			<td style='width:10%;text-align=center;'>Espacio Físico</td>
			<td style='width:20%;text-align=center;'>Descripción</td>
			<td style='width:15%;text-align=center;'>Marca y Serie</td>
			<td style='width:5%;text-align=center;'>Estado</td>
			<td style='width:10%;text-align=center;'>Contratista<br>A Cargo</td>
			<td style='width:10%;text-align=center;'>Verificación</td>
			</tr>";

            foreach ($elementos_consumo_controlado as $valor) {
		$valor ['marca']  = str_replace("/", "/ ",$valor ['marca']);
            $valor ['marca']  = str_replace("-", "- ",$valor ['marca']);
            $valor ['serie']  = str_replace("/", "/ ",$valor ['serie']);
            $valor ['serie']  = str_replace("-", "- ",$valor ['serie']);
	    $valor ['serie']  = str_replace(",", ", ",$valor ['serie']);
            $valor ['marca']  = str_replace(",", ", ",$valor ['marca']);
                $contenidoPagina .= "<tr>
                    			<td style='width:10%;text-align=center;'>" . $valor ['placa'] . "</td>
                    			<td style='width:10%;text-align=center;'><font size='0.5px'>" . $valor ['sede'] . "</font></td>
                    			<td style='width:10%;text-align=center;'><font size='0.5px'>" . $valor ['dependencia'] . "</font></td>
                    			<td style='width:10%;text-align=center;'><font size='0.5px'>" . $valor ['espacio_fisico'] . "</font></td>
                    			<td style='width:20%;text-align=center;'>" . $valor ['descripcion_elemento'] . "</td>
                    			<td style='width:15%;text-align=center;'>" . $valor ['marca'] . " - " . $valor ['serie'] . "</td>
                    			<td style='width:5%;text-align=center;'>" . $valor ['estado_bien'] . "</td>
                    			<td style='width:10%;text-align=center;'>" . $valor ['contratista'] . "</td>
                    			<td style='width:10%;text-align=center;'>" . $valor ['marca_existencia'] . "</td>
                    			</tr>";
            }

            $contenidoPagina .= "</table>";
 	    $contenidoPagina .= "<br>";

            $contenidoPagina .= "<table style='width:100%;'>
											<tr>
											<td style='width:100%;border=none;'><font size='5px'>Nota: Antes de firmar, verifique que los bienes que se encuentran en el presente listado corresponden a los que usted se hace responsable.</font></td>
											</tr>
											</table>
											";

            $contenidoPagina .= "<page_footer>";

            $contenidoPagina .= "
												<br>
												<table style='width:100%; background:#FFFFFF ; border: 0px  #FFFFFF;'>
												<tr>
												<td style='width:50%;text-align:center;background:#FFFFFF ; border: 0px  #FFFFFF;'>_______________________________________________________</td>
												<td style='width:50%;text-align:center;background:#FFFFFF ; border: 0px  #FFFFFF;'>_______________________________________________________</td>
												</tr>
												<tr>
												<td style='width:50%;text-align:center;background:#FFFFFF ; border: 0px  #FFFFFF;'>" . $jefe ['nombre'] . "</td>
												<td style='width:50%;text-align:center;background:#FFFFFF ; border: 0px  #FFFFFF; text-transform:capitalize;'>" . $nombre_funcionario[0][0] . "</td>
												</tr>
												<tr>
												<td style='width:50%;text-align:center;background:#FFFFFF ; border: 0px  #FFFFFF; text-transform:capitalize;'>Almacenista General</td>
												<td style='width:50%;text-align:center;background:#FFFFFF ; border: 0px  #FFFFFF;'>CC : " . $_REQUEST ['funcionario'] . "</td>
												</tr>
												</table>";

            $contenidoPagina .= "		<br>
										<br>
										<br>
												<table style='width:100%; background:#FFFFFF ; border: 0px  #FFFFFF;'>
												<tr>
												<td style='width:100%;text-align:left;background:#FFFFFF ; border: 0px  #FFFFFF;'>Realizo y Verificó Existencia Fìsica:</td>
												</tr>
												</table>
			
												<table style='width:100%; background:#FFFFFF ; border: 0px  #FFFFFF;'>
												<tr>
												<td style='width:20%;text-align:left;background:#FFFFFF ; border: 0px  #FFFFFF;'>Nombre : </td>
												<td style='width:30%;text-align:left;background:#FFFFFF ; border: 0px  #FFFFFF;'>________________________________________</td>
												<td style='width:20%;text-align:left;background:#FFFFFF ; border: 0px  #FFFFFF;'>Actualizado a : </td>
												<td style='width:30%;text-align:left;background:#FFFFFF ; border: 0px  #FFFFFF;'>" . date('Y - m - d    H:i:s') . "</td>
												</tr>
												</table>
					
					
														<table style='width:100%; background:#FFFFFF ; border: 0px  #FFFFFF;'>
														<tr>
														<td style='width:100%;text-align:left;background:#FFFFFF ; border: 0px  #FFFFFF;'>
									                    <font size='1px'>Para mayor información y solicitud de inventarios: almacen@udistrital.edu.co</font>
									                    <br>
									                    <font size='0.5px'>Ley 734 del 2002 :Delos deberes del Servidor Pùblico. Vigilar y salvaguardar los bienes y valores que le han sido encomendados y cuidar que sean utilizados debida y racionalmente, de conformidad con los<br>fines a que han sido destinados.</font>
														</td>
														</tr>
														</table>
									    </page_footer> ";

            $contenidoPagina .= "</page>";
        }

        if (isset($elementos_devolutivos) && $elementos_devolutivos != false) {

            $contenidoPagina .= "
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
		
    td {
		
        text-align: left;
        font-size:10px
    }
</style>
		
		
<page backtop='10mm' backbottom='20mm' backleft='10mm' backright='10mm' footer='page' >
		
		
         <table align='center'>
        
           <tr style=\"width:1px;\" colspan=\"1\">
                <th rowspan='3'> <img alt=\"Imagen\" src=" . $rutaBloque . "/css/images/escudoDistrital.png\" /></th>
                <th style=\"width:300px;font-size:11px;\" colspan=\"1\">LEVANTAMIENTO DE INVENTARIOS</th>            
                <th style=\"width:100px;font-size:11px;\" colspan=\"1\">Código: GIF PR-003-FR-004</th>
                <th rowspan='3'> <img alt=\"Imagen\" src=" . $rutaBloque . "/css/images/sigud.jpg\" /></th>
            </tr>
            <tr style=\"width:1px;\" colspan=\"1\">
                <th style=\"width:300px;font-size:11px;\" colspan=\"1\">Macroproceso: Gestión de Recursos</th>            
                <th style=\"width:100px;font-size:11px;\" colspan=\"1\">Versión: 03</th>  
            </tr>
            <tr style=\"width:1px;\" colspan=\"1\">
                <th style=\"width:300px;font-size:11px;\" colspan=\"1\">Proceso: Gestión de Infraestructura Física</th>            
                <th style=\"width:100px;font-size:11px;\" colspan=\"1\">Fecha de Aprobación: 23/03/16</th>  
            </tr>
              
                    <tr></tr>
    		</table>  	<br><br><br>
           	<table style='width:100%;'>
            <tr>
			<td style='width:50%;border=none;text-align:center;'>NOMBRE FUNCIONARIO : " . $nombre_funcionario[0][0] . "</td>
			<td style='width:50%;border=none;text-align:center;'>CC :    " . $_REQUEST ['funcionario'] . "</td>
 		 	</tr>
			</table>
			
           	<table style='width:100%;'>
            <tr>
			<td style='width:100%;border=none;text-align:left;'>TIPO DE BIEN DEVOLUTIVO</td>
 		 	</tr>
			</table>
			 <br>
			<table style='width:100%;'>
			<tr>
			<td style='width:10%;text-align=center;'>Placa</td>
			<td style='width:10%;text-align=center;'>Sede</td>
			<td style='width:10%;text-align=center;'>Dependencia</td>
			<td style='width:10%;text-align=center;'>Espacio Físico</td>
			<td style='width:20%;text-align=center;'>Descripción</td>
			<td style='width:15%;text-align=center;'>Marca y Serie</td>
			<td style='width:5%;text-align=center;'>Estado</td>
			<td style='width:10%;text-align=center;'>Contratista<br>A Cargo</td>
			<td style='width:10%;text-align=center;'>Verificación</td>
			</tr>";

            foreach ($elementos_devolutivos as $valor) {
		 $valor ['marca']  = str_replace("/", "/ ",$valor ['marca']);
            $valor ['marca']  = str_replace("-", "- ",$valor ['marca']);
            $valor ['serie']  = str_replace("/", "/ ",$valor ['serie']);
            $valor ['serie']  = str_replace("-", "- ",$valor ['serie']);
	    $valor ['serie']  = str_replace(",", ", ",$valor ['serie']);
            $valor ['marca']  = str_replace(",", ", ",$valor ['marca']);
                $contenidoPagina .= "<tr>
                    			<td style='width:10%;text-align=center;'>" . $valor ['placa'] . "</td>
                    			<td style='width:10%;text-align=center;'><font size='0.5px'>" . $valor ['sede'] . "</font></td>
                    			<td style='width:10%;text-align=center;'><font size='0.5px'>" . $valor ['dependencia'] . "</font></td>
                    			<td style='width:10%;text-align=center;'><font size='0.5px'>" . $valor ['espacio_fisico'] . "</font></td>
                    			<td style='width:20%;text-align=center;'>" . $valor ['descripcion_elemento'] . "</td>
                    			<td style='width:15%;text-align=center;'>" . $valor ['marca'] . " - " . $valor ['serie'] . "</td>
                    			<td style='width:5%;text-align=center;'>" . $valor ['estado_bien'] . "</td>
                    			<td style='width:10%;text-align=center;'>" . $valor ['contratista'] . "</td>
                    			<td style='width:10%;text-align=center;'>" . $valor ['marca_existencia'] . "</td>
                    			</tr>";
            }

            $contenidoPagina .= "</table>";
	    $contenidoPagina .= "<br>";

            $contenidoPagina .= "<table style='width:100%;'>
											<tr>
											<td style='width:100%;border=none;'><font size='5px'>Nota: Antes de firmar, verifique que los bienes que se encuentran en el presente listado corresponden a los que usted se hace responsable.</font></td>
											</tr>
											</table>
					<br>
					<br>
					";

            $contenidoPagina .= "<page_footer>";

            $contenidoPagina .= "<br>
								<br>
								<table style='width:100%; background:#FFFFFF ; border: 0px  #FFFFFF;'>
								<tr>
								<td style='width:50%;text-align:center;background:#FFFFFF ; border: 0px  #FFFFFF;'>_______________________________________________________</td>
								<td style='width:50%;text-align:center;background:#FFFFFF ; border: 0px  #FFFFFF;'>_______________________________________________________</td>
								</tr>
								<tr>
								<td style='width:50%;text-align:center;background:#FFFFFF ; border: 0px  #FFFFFF;'>" . $jefe ['nombre'] . "</td>
								<td style='width:50%;text-align:center;background:#FFFFFF ; border: 0px  #FFFFFF; text-transform:capitalize;'>" . $nombre_funcionario[0][0] . "</td>
								</tr>
								<tr>
								<td style='width:50%;text-align:center;background:#FFFFFF ; border: 0px  #FFFFFF; text-transform:capitalize;'>Almacenista General</td>
								<td style='width:50%;text-align:center;background:#FFFFFF ; border: 0px  #FFFFFF;'>CC : " . $_REQUEST ['funcionario'] . "</td>
								</tr>
								</table>";

            $contenidoPagina .= "<br>
								<br>
								<br>
										<table style='width:100%; background:#FFFFFF ; border: 0px  #FFFFFF;'>
										<tr>
										<td style='width:100%;text-align:left;background:#FFFFFF ; border: 0px  #FFFFFF;'>Realizo y Verificó Existencia Fìsica:</td>
										</tr>
										</table>
	
										<table style='width:100%; background:#FFFFFF ; border: 0px  #FFFFFF;'>
										<tr>
										<td style='width:20%;text-align:left;background:#FFFFFF ; border: 0px  #FFFFFF;'>Nombre : </td>
										<td style='width:30%;text-align:left;background:#FFFFFF ; border: 0px  #FFFFFF;'>________________________________________</td>
										<td style='width:20%;text-align:left;background:#FFFFFF ; border: 0px  #FFFFFF;'>Actualizado a : </td>
										<td style='width:30%;text-align:left;background:#FFFFFF ; border: 0px  #FFFFFF;'>" . date('Y - m - d    H:i:s') . "</td>
										</tr>
										</table>
	
											<table style='width:100%; background:#FFFFFF ; border: 0px  #FFFFFF;'>
											<tr>
											<td style='width:100%;text-align:left;background:#FFFFFF ; border: 0px  #FFFFFF;'>
						                    <font size='1px'>Para mayor información y solicitud de inventarios: almacen@udistrital.edu.co</font>
						                    <br>
						                    <font size='0.5px'>Ley 734 del 2002 :Delos deberes del Servidor Pùblico. Vigilar y salvaguardar los bienes y valores que le han sido encomendados y cuidar que sean utilizados debida y racionalmente, de conformidad con los<br>fines a que han sido destinados.</font>
											</td>
											</tr>
											</table>
									    </page_footer> ";

            $contenidoPagina .= "</page>";
        }
       
        return $contenidoPagina;
    }

}

$miRegistrador = new RegistradorOrden($this->lenguaje, $this->sql, $this->funcion);
$textos = $miRegistrador->documento();
ob_start();
$html2pdf = new \HTML2PDF('L', 'LETTER', 'es', true, 'UTF-8', array(
    1,
    1,
    1,
    1
        ));
$html2pdf->pdf->SetDisplayMode('fullpage');
$html2pdf->WriteHTML($textos);
$html2pdf->Output('Certificado  	' . date('Y-m-d') . '.pdf', 'D');
ini_restore("memory_limit");
?>
