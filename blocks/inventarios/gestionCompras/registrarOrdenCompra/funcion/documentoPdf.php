<?

namespace inventarios\gestionCompras\registrarOrdenCompra\funcion;

use inventarios\gestionCompras\registrarOrdenCompra\funcion\redireccion;

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
		$conexion = "sicapital";
		$esteRecursoDBO = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		$conexion = "inventarios";
		$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
		
		$directorio = $this->miConfigurador->getVariableConfiguracion ( 'rutaUrlBloque' );
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'consultarOrdenCompra', $_REQUEST ['numero_orden'] );
		$ordenCompra = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		$ordenCompra = $ordenCompra [0];
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'informacionPresupuestal', $ordenCompra ['info_presupuestal'] );
		$info_presupuestal = $esteRecursoDB->ejecutarAcceso ( $cadenaSql, "busqueda" );
		$info_presupuestal = $info_presupuestal [0];
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'informacion_proveedor', $ordenCompra ['id_proveedor'] );
		$proveedor = $esteRecursoDBO->ejecutarAcceso ( $cadenaSql, "busqueda" );
		$proveedor=$proveedor[0];
		
		
		$cotizacion=($ordenCompra['nombre_cotizacion']!='')?'SI':'NO';
		
		
		$cadenaSql = $this->miSql->getCadenaSql ( 'consultarRubro', $ordenCompra ['rubro'] );
		$rubro = $esteRecursoDBO->ejecutarAcceso ( $cadenaSql, "busqueda" );
		$rubro=$rubro[0];
		
		
// 		var_dump ( $ordenCompra );
// 		var_dump($info_presupuestal);
// 		var_dump($proveedor);
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
				
				
<page backtop='10mm' backbottom='10mm' backleft='10mm' backright='10mm'>
	

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
			<td style='width:50%;'>ORDEN DE COMPRA Nro.  " . $_REQUEST ['numero_orden'] . "</td>
			<td style='width:50%;text-aling=right;'>FECHA DE ORDEN :  " . $ordenCompra ['fecha_registro'] . "</td> 			
 		 	</tr>
			<tr> 
			<td >Disponibilidad Presupuestal : Nro. " . $info_presupuestal ['numero_dispo'] . "</td>
			<td>Vigencia Disponibilidad :  " . $info_presupuestal ['vigencia_dispo'] . "</td> 			
 		 	</tr>	
		 	<tr> 
			<td >Proveedor : " . $proveedor [0] . "</td>
			<td>Nit :  " . $info_presupuestal ['1'] . "</td> 			
 		 	</tr>
		    </table>	
					                 		
		    <table style='width:100%;'>
			<tr> 
			<td style='width:33.31%;'>Dirección : " . $proveedor [2] . "</td>
			<td style='width:33.31%;'>Telefono :  " . $proveedor[3] . "</td>
			<td style='width:33.31%;'>Cotización Adjunta:  " . $cotizacion. "</td> 			
 		 	</tr> 		          		
 			</table>	    
					             		
			<table style='width:100%;'>
			<tr> 
			<td style='width:100%;'>Rubro :  " . $rubro [0] . "</td>
			</tr> 		          		
 			</table>		
					
		</page>";
		
// echo $contenidoPagina;exit;
		return $contenidoPagina;
	}
}

$miRegistrador = new RegistradorOrden ( $this->lenguaje, $this->sql, $this->funcion );

$textos = $miRegistrador->documento ();

ob_start ();
$html2pdf = new \HTML2PDF ( 'P', 'LETTER', 'es' ,true,'UTF-8');
$html2pdf->pdf->SetDisplayMode('fullpage');
$html2pdf->WriteHTML ( $textos );

$html2pdf->Output ( 'Compra.pdf', 'D' );

?>





