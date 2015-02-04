<?php

namespace inventarios\gestionCompras\consultaOrdenServicios\funcion;

use inventarios\gestionCompras\consultaOrdenServicios\funcion\redireccion;

$ruta = $this->miConfigurador->getVariableConfiguracion ( "raizDocumento" );

$host = $this->miConfigurador->getVariableConfiguracion ( "host" ) . $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/blocks/inventarios/";

// echo $host;exit();

include ($ruta . '/plugin/html2pdf/html2pdf.class.php');

if (! isset ( $GLOBALS ["autorizado"] )) {
	include ("../index.php");
	exit ();
}
class RegistradorOrden {
	var $miConfigurador;
	var $lenguaje;
	var $miFormulario;
	var $miFuncion;
	var $miSql;
	var $conexion;
	function __construct($lenguaje, $sql, $funcion) {
		$this->miConfigurador = \Configurador::singleton ();
		$this->miConfigurador->fabricaConexiones->setRecursoDB ( 'principal' );
		$this->lenguaje = $lenguaje;
		$this->miSql = $sql;
		$this->miFuncion = $funcion;
	}
	function paginas($contenidoDatos, $nombre, $directorio) {
		$contenidoPagina = "<page backtop='1mm' backbottom='1mm' backleft='1mm' backright='1mm'>";
		$contenidoPagina .= "<page_header>
		
        <table align='center' style='width: 100%;'>
            <tr>
                <td align='center' >
                    <img src='" . $directorio . "/css/images/escudo.jpg'>
                </td>
                <td align='center' >
                    <font size='12px'><b>UNIVERSIDAD DISTRITAL</b></font>
                    <br>
                    <font size='12px'><b>FRANCISCO JOSÉ DE CALDAS</b></font>
                    <br>
                    <font size='9px'><b>REPORTE DE ORDENES DE COMPRA</b></font>
                    <br>
                    <font size='9px'><b>" . date ( "Y-m-d" ) . "</b></font>
                </td>
                <td align='center' >
                    <img src='" . $directorio . "/css/images/sabio.jpg' width='60'>
                </td>
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table align='center' width = '100%'>
            <tr>
                <td align='center'>
                    <img src='" . $directorio . "/css/images/escudo.jpg'>
                </td>
            </tr>
            <tr>
                <td align='center'>
                    Universidad Distrital Francisco José de Caldas
                    <br>
                    Todos los derechos reservados.
                    <br>
                    Carrera 8 N. 40-78 Piso 1 / PBX 3238400 - 3239300
                    <br>
              
                </td>
            </tr>
        </table>
    </page_footer>";
		
		$contenidoPagina .= "
     <table>
            <tr>
                <td>
<br><br><br><br>
                <p><h5>&nbsp; &nbsp; &nbsp; Este Documento en lista las Ordenes de Compra Segun la Consulta. </h5></p>
	
         
                </td>
            </tr>
        </table>
    <style>
td{
  font-size: 13px;
}
</style>
	
                		";
		
		$contenidoPagina .= "<table width=\"30%\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\" class='bordered' align=\"center \">
	
	
	
	
	<!--Columnas-->
					<thead>
				<tr role='row'>
					<th aria-label='Documento' aria-sort='ascending'
						style='width: 100px;' colspan='1' rowspan='1'
						aria-controls='example' tabindex='0' role='columnheader'
						class='sorting_asc'>#Número Orden Compra</th>
					<th aria-label='nombres' aria-sort='ascending'
						style='width: 230px;' colspan='1' rowspan='1'
						aria-controls='example' tabindex='0' role='columnheader'
						class='sorting_asc'>Fecha Orden</th>
					<th aria-label='Descripciont' aria-sort='ascending'
						style='width: 200px;' colspan='1' rowspan='1'
						aria-controls='example' tabindex='0' role='columnheader'
						class='sorting_asc'>Nit Proveedor</th>
					<th aria-label='Descripciont' aria-sort='ascending'
						style='width: 180px;' colspan='1' rowspan='1'
						aria-controls='example' tabindex='0' role='columnheader'
						class='sorting_asc'>Dependencia Solicitante</th>
					 
				</tr>
			</thead>
	
	
";
		
		$contenidoPagina .= $contenidoDatos;
		
		$contenidoPagina .= "   	  </table>";
		
		$contenidoPagina .= "</page> ";
		
		return $contenidoPagina;
	}
	function armarContenido($NoRegistros, $respuesta, $directorio) {
		$pagina = '';
		$contenido = '';
		$i = 0;
		$Modulo = $NoRegistros;
		foreach ( $respuesta as $res ) {
			$contenido .= "<tr class='gradeA odd' align=center> ";
			$contenido .= "<td>" . $res [0] . " </td>";
			$contenido .= "<td>" . $res [1] . " </td>";
			$contenido .= "<td>" . $res [2] . " </td>";
			$contenido .= "<td>" . $res [3] . " </td>";
			
			$contenido .= "</tr>";
			
			if ($i == 24) {
				$paginaPDF = $this->paginas ( $contenido, 'Ordenes de Compra', $directorio );
				$pagina .= $paginaPDF;
				$contenido = '';
				
				$Modulo = $Modulo - 24;
				$i = 0;
			}
			
			if ($Modulo > 0 && $Modulo < 24 && $i == ($Modulo - 1)) {
				$paginaPDF = $this->paginas ( $contenido, 'Ordenes de Compra', $directorio );
				$pagina .= $paginaPDF;
				$contenido = '';
			}
			$i ++;
		}
		return $pagina;
	}
	function procesarFormulario() {
		$conexion = "inventarios";
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		$arreglo = unserialize ( $_REQUEST ['arreglo'] );
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'consultarOrden1', $arreglo );
		$ordenCompra1 = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'consultarOrden2', $arreglo );
		$ordenCompra2 = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		if ($ordenCompra1 == false) {
			
			$ordenCompra = $ordenCompra2;
		} else if ($ordenCompra2 == false) {
			
			$ordenCompra = $ordenCompra1;
		} else {
			$ordenCompra = array_merge ( $ordenCompra1, $ordenCompra2 );
		}
		
		return $ordenCompra;
	}
}

$miRegistrador = new RegistradorOrden ( $this->lenguaje, $this->sql, $this->funcion );

$resultado = $miRegistrador->procesarFormulario ();

$textos = $miRegistrador->armarContenido ( count ( $resultado ), $resultado, $_REQUEST ['directorio'] );
// ob_clean(); // cleaning the buffer before Output()
try {
	
	$html2pdf = new \HTML2PDF ( 'L', 'LETTER', 'es' );
	
	$html2pdf->WriteHTML ( $textos );

	$html2pdf->Output ( 'Compra.pdf','I' );
} catch ( HTML2PDF_exception $e ) {
	die ( $e );
	echo "estoy";
}

// header('Location: http://localhost/arka/blocks/inventarios/gestionCompras/doc/Compra.pdf');

// $pdf->Output($ruta."/documentos/prueba.pdf",'F');

// $html2pdf->Output ($host."gestionCompras/doc/prueba.pdf",'E');
// echo "<script language='javascript'>window.open('".$host."gestionCompras/doc/prueba.pdf','_self','');</script>";//para ver el archivo pdf generado
//

// ob_end_flush();
// $len=filesize($ruta);

// header("Content-type: application/pdf");
// header("Content-Length: $html2pdf->Output ( 'Reporte Orden Compra.pdf', 'D' ) ");
// //header("Content-Disposition: inline; filename=reporte.pdf");

// //header("Content-type: application/octet-stream");
// header("Content-Disposition: attachment; filename=reporte.pdf");

// // readfile($ruta);
// ob_start();
// echo $res;
// $post="/usr/local/apache/htdocs/arka/blocks/inventarios/gestionCompras/doc/Compra.pdf";

// exit ();

?>

