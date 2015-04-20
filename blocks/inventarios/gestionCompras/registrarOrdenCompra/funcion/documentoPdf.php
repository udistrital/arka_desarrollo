<?

namespace inventarios\gestionCompras\registrarOrdenCompra\funcion;
// var_dump($_REQUEST);
use inventarios\gestionCompras\registrarOrdenCompra\funcion\redireccion;

$ruta = $this->miConfigurador->getVariableConfiguracion ( "raizDocumento" );

$host = $this->miConfigurador->getVariableConfiguracion ( "host" ) . $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/plugin/html2pfd/";

include ($ruta . "/plugin/html2pdf/html2pdf.class.php");

// ob_end_clean();
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
	function documento() {
		$conexion = "inventarios";
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		$directorio = $this->miConfigurador->getVariableConfiguracion ( 'rutaUrlBloque' );
		var_dump($_REQUEST);
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'consultarOrdenCompra', $_REQUEST['numero_orden'] );
		$ordenCompra = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		var_dump($ordenCompra);
		
		$contenidoPagina = "<page backtop='1mm' backbottom='1mm' backleft='1mm' backright='1mm'>";
		$contenidoPagina .= "<page_header>
		
        <table align='center' style='width: 100%;'>
            <tr>
                <td align='center' >
                    <img src='" . $directorio . "/css/images/escudo.png'  width='80' height='100'>
                </td>
                <td align='center' >
                    <font size='9px'><b>UNIVERSIDAD DISTRITAL FRANCISCO JOSÉ DE CALDAS </b></font>
                    <br>
                    <font size='7px'><b>NIT: 899.999.230-7</b></font>
                    <br>		
                    <font size='5px'>www.udistrital.edu.co</font>
                    <br>
                    <font size='4px'>" . date ( "Y-m-d" ) . "</font>
                </td>
                <td align='center' >
                    <img src='" . $directorio . "/css/images/sabio.jpg' width='80' height='100'>
                </td>
            </tr>
        </table>
    </page_header>
                    		
                    		<body>
                    		
                    		
                    			
                    		
                    		</body>
                    		
                    		
                    		
    <page_footer>
        <table align='center' width = '100%'>
 
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
		
// 		$contenidoPagina .= $contenidoDatos;
		
		$contenidoPagina .= "   	  </table>";
		
		$contenidoPagina .= "</page> ";
		echo $contenidoPagina;
		return $contenidoPagina;
		exit;
		
	}
}

$miRegistrador = new RegistradorOrden ( $this->lenguaje, $this->sql, $this->funcion );

$textos=$miRegistrador->documento ();

// ob_start ();
// $html2pdf = new \HTML2PDF ( 'L', 'LETTER', 'es' );

// $html2pdf->WriteHTML ( $textos );

// $html2pdf->Output ( 'Compra.pdf', 'D' );

?>





