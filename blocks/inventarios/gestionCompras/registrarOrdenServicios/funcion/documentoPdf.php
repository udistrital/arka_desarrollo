<?

$ruta = $this->miConfigurador->getVariableConfiguracion ( "raizDocumento" );

$host = $this->miConfigurador->getVariableConfiguracion ( "host" ) . $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/plugin/html2pfd/";

include ($ruta . "/plugin/html2pdf/html2pdf.class.php");

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
		
// 		var_dump($_REQUEST);exit;
		$conexion = "sicapital";
		$esteRecursoDBO = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		$conexion = "inventarios";
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		$directorio = $this->miConfigurador->getVariableConfiguracion ( 'rutaUrlBloque' );
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'consultarOrdenServicios', $_REQUEST ['numero_orden'] );
		$orden = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		$orden = $orden [0];
		
		
// 		var_dump($orden);
		
		
		
		
// 		$cadenaSql = $this->miSql->getCadenaSql ( 'informacionPresupuestal', $ordenCompra ['info_presupuestal'] );
// 		$info_presupuestal = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
// 		$info_presupuestal = $info_presupuestal [0];
		
// 		$cadenaSql = $this->miSql->getCadenaSql ( 'informacion_proveedor', $ordenCompra ['id_proveedor'] );
// 		$proveedor = $esteRecursoDBO->ejecutarAcceso ( $cadenaSql, "busqueda" );
// 		$proveedor = $proveedor [0];
		
// 		$cotizacion = ($ordenCompra ['nombre_cotizacion'] != '') ? 'SI' : 'NO';
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'consultarRubro', $orden ['rubro'] );
		$rubro = $esteRecursoDBO->ejecutarAcceso ( $cadenaSql, "busqueda" );
		$rubro = $rubro [0];
		
// 		var_dump($rubro);
		$cadenaSql = $this->miSql->getCadenaSql ( 'consultarDependencia', $orden ['dependencia_solicitante'] );
		$dependencia_solicitante = $esteRecursoDBO->ejecutarAcceso ( $cadenaSql, "busqueda" );
		$dependencia_solicitante = $dependencia_solicitante [0];
// 		var_dump($dependencia_solicitante);exit;
		
		
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'consultarSupervisor', $orden ['id_supervisor'] );
		$supervisor = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		$supervisor = $supervisor [0];
		
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'consultarDependenciaSupervisor', $supervisor ['dependencia'] );
		$dependencia_supervisor = $esteRecursoDBO->ejecutarAcceso ( $cadenaSql, "busqueda" );
		$dependencia_supervisor = $dependencia_supervisor [0];
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'consultarCosntraistaServicios', $orden['id_contratista'] );
		$datosContratista = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		
		$datosContratista=$datosContratista[0];
// 		var_dump($datosContratista);exit;
		
// 		exit;
		$cadenaSql = $this->miSql->getCadenaSql ( 'polizas' );
		$polizas = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		$polizas = $polizas [0];
		
		$poliza1 = ($orden ['poliza1'] != 'f') ? 'X' : ' ';
		$poliza2 = ($orden ['poliza2'] != 'f') ? 'X' : ' ';
		$poliza3 = ($orden ['poliza3'] != 'f') ? 'X' : ' ';
		$poliza4 = ($orden ['poliza4'] != 'f') ? 'X' : ' ';
		
// 		$cadenaSql = $this->miSql->getCadenaSql ( 'consultarDestino', $ordenCompra ['destino'] );
// 		$destino = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
// 		$destino = $destino [0];
		
// 		$cadenaSql = $this->miSql->getCadenaSql ( 'consultar_forma_pago', $ordenCompra ['forma_pago'] );
// 		$forma_pago = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
// 		$forma_pago = $forma_pago [0];
		
// 		$arreglo = array (
// 				$ordenCompra ['id_contratista'],
// 				$ordenCompra ['vig_contratista'] 
// 		);
// 		$cadenaSql = $this->miSql->getCadenaSql ( 'consultarContratista', $arreglo );
// 		$contratista = $esteRecursoDBO->ejecutarAcceso ( $cadenaSql, "busqueda" );
// 		$contratista = $contratista [0];
		
		
		
// 		$cadenaSql = $this->miSql->getCadenaSql ( 'consultarOrdenador_gasto', $ordenCompra['id_ordenador'] );
// 		$ordenador = $esteRecursoDBO->ejecutarAcceso ( $cadenaSql, "busqueda" );
// 		$ordenador = $ordenador [0];
		
		
// 		var_dump($ordenador);exit;
// 		var_dump($contratista);exit;
		// var_dump($forma_pago);exit;
		// var_dump($destino);exit;
		// var_dump($items);
// 		var_dump ( $ordenCompra );exit;
		// var_dump($info_presupuestal);
		// var_dump($proveedor);
		// var_dump($dependencia);exit;
		$contenidoPagina = "
<style type=\"text/css\">
    table { 
        color:#333; /* Lighten up font color */
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
        background: #F3F3F3; /* Light grey background */
        font-weight: bold; /* Make sure they're bold */
        text-align: center;
        font-size:10px
    }

    td {
        background: #FAFAFA; /* Lighter grey background */
        text-align: left;
        font-size:10px
    }
</style>				
				
				
<page backtop='10mm' backbottom='7mm' backleft='10mm' backright='10mm'>
	

        <table align='left' style='width:100%;' >
            <tr>
                <td align='center' >
                    <img src='" . $directorio . "/css/images/escudo.png'  width='80' height='100'>
                </td>
                <td align='center' style='width:88%;' >
                    <font size='9px'><b>UNIVERSIDAD DISTRITAL FRANCISCO JOSÉ DE CALDAS </b></font>
                     <br>
                    <font size='7px'><b>NIT: 899.999.230-7</b></font>
                     <br>
                    <font size='3px'>CARRERA 7 No. 40-53 PISO 7. TELEFONO 3239300 EXT. 2609 -2605</font>
                     <br>		
                    <font size='5px'>www.udistrital.edu.co</font>
                     <br>
                    <font size='4px'>" . date ( "Y-m-d" ) . "</font>
                </td>
            </tr>
        </table>
	
	                  		
       		<table style='width:100%;'>
            <tr> 
			<td style='width:50%;'>ORDEN DE SERVICIOS Nro.  " . $_REQUEST ['numero_orden'] . "</td>
			<td style='width:50%;text-aling=right;'>FECHA DE ORDEN :  " . $orden ['fecha_registro'] . "</td> 			
 		 	</tr>
		    </table>
						
		    <table style='width:100%;'>
			<tr> 
			<td style='width:100%;'><b>Información Solicitante</b></td>
			</tr>
         	</table>


		    <table style='width:100%;'>
			<tr> 
			<td style='width:50%;'>Dependencia : ".$dependencia_solicitante[1]." </td>
			<td style='width:50%;'>Rubro: ".$rubro[0]."</td>		
			</tr>
			</table>	

			<table style='width:100%;'>
			<tr> 
			<td style='width:100%;'><b>Datos Supervisor</b></td>
			</tr>
         	</table>

		    <table style='width:100%;'>
			<tr> 
			<td style='width:100%;'>Nombre : ".$supervisor['nombre']." </td>
			</tr>
			<tr> 
			<td style='width:100%;'>Cargo : ".$supervisor['cargo']." </td>
			</tr>		
			<tr> 
			<td style='width:100%;'>Dependencia : ".rtrim($dependencia_supervisor[1])." </td>
			</tr>						
			</table>			
					
			<table style='width:100%;'>
			<tr> 
			<td style='width:100%;'><b>Información Contratista</b></td>
			</tr>
         	</table>	

            <table style='width:100%;'>
			<tr> 
			<td style='width:50%;'>Nombre o Razón Social : ".$datosContratista['nombre_razon_social']." </td>
			<td style='width:50%;'>Cedula o Nit : ".$datosContratista['identificacion']." </td>
			</tr>
			<tr> 
			<td style='width:50%;'>Dirección : ".$datosContratista['direccion']." </td>
			<td style='width:50%;'>Telefono : ".$datosContratista['telefono']." </td>
			</tr>		
			</table>	

			<table style='width:100%;'>
			<tr> 
			<td style='width:100%;'>Cargo : ".$datosContratista['cargo']."</td>
			</tr>
         	</table>			
					
			<table style='width:100%;'>
			<tr> 
			<td style='width:100%;'><b>Información Contrato</b></td>
			</tr>
         	</table>	

			<table style='width:100%;'>
			<tr> 
			<td style='width:100%;'>Objeto General : </td>
			</tr>
			<tr> 
			<td style='width:100%;text-align:justify;'>".$orden[4]." </td>
			</tr>		
			</table>			
<table style='width:100%;'>		
			<tr> 
			<td style='width:90%;text-align:left;'>" . $polizas [1] . "</td>	
			<td style='width:10%;text-align:center;'>" . $poliza1 . "</td>		
			</tr>
			<tr> 
			<td style='width:90%;text-align:left;'>" . $polizas [2] . "</td>	
			<td style='width:10%;text-align:center;'>" . $poliza2 . "</td>		
			</tr>
			<tr> 
			<td style='width:90%;text-align:left;'>" . $polizas [3] . "</td>	
			<td style='width:10%;text-align:center;'>" . $poliza3 . "</td>		
			</tr>								
			<tr> 
			<td style='width:90%;text-align:left;'>" . $polizas [4] . "</td>	
			<td style='width:10%;text-align:center;'>" . $poliza4 . "</td>		
			</tr>					
			</table>			                 		

<page_footer  backleft='10mm' backright='10mm'>
			<table style='width:100%;'>		
			<tr>
			<td style='width:100%;text-align:left;'><font size='1px'>Para el respectivo pago deberá radicar en la sección de compras la factura o cuenta de cobro, pago de aportes para fiscales o planilla de pago si es el caso, certificación bancaria indicando tipo y numero de cuenta y el cumplido a satisfacción del bien debidamente firmado por el supervisor del contrato o el funcionario quien recibe el bien.</font></td>	
			</tr>
			</table>
			<table style='width:100%;'>		
			<tr>
			<td style='width:50%;text-align:left;'>Proveedor : </td>
			<td style='width:50%;text-align:left;'>Nombre de quien recibe : </td>			
			</tr>
			</table>
			<table style='width:100%;'>		
			<tr>
			<td style='width:33.31%;'>Firma : </td>
			<td style='width:33.31%;'>Fecha : </td>
			<td style='width:33.31%;'>Sello : </td>			
			</tr>
			</table>		
</page_footer> 
					
					
				";
		
		$contenidoPagina .= "</page>";
		
		// echo $contenidoPagina;exit;
		return $contenidoPagina;
	}
}

$miRegistrador = new RegistradorOrden ( $this->lenguaje, $this->sql, $this->funcion );

$textos = $miRegistrador->documento ();

ob_start ();
$html2pdf = new \HTML2PDF ( 'P', 'LETTER', 'es', true, 'UTF-8' );
$html2pdf->pdf->SetDisplayMode ( 'fullpage' );
$html2pdf->WriteHTML ( $textos );

$html2pdf->Output ( 'Compra_Nro_'.$_REQUEST['numero_orden'].'_'.date ( "Y-m-d" ).'.pdf', 'D' );

?>





