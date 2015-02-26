<?php

namespace bloquesModelo\bloqueModelo1;

// Evitar un acceso directo a este archivo
if (! isset ( $GLOBALS ["autorizado"] )) {
    include ("../index.php");
    exit ();
}

// Todo bloque debe implementar la interfaz Bloque
include_once ("core/builder/Bloque.interface.php");
include_once ("core/manager/Configurador.class.php");
include_once ("core/builder/FormularioHtml.class.php");

// Elementos que constituyen un bloque típico CRUD.

// Interfaz gráfica
include_once ("Frontera.class.php");

// Funciones de procesamiento de datos
include_once ("Funcion.class.php");

// Compilación de clausulas SQL utilizadas por el bloque
include_once ("Sql.class.php");

// Mensajes
include_once ("Lenguaje.class.php");


include_once 'component/GestorHTMLCRUD/Componente.php';
use component\GestoHTMLCRUD\Componente as GestorHTMLCRUD;
// Esta clase actua como control del bloque en un patron FCE

if (! class_exists ( '\\bloquesModelo\\bloqueModelo1\\Bloque' )) {
    
    class Bloque implements \Bloque {
        var $nombreBloque;
        var $miFuncion;
        var $miSql;
        var $miConfigurador;
        var $miFormulario;
		
		private $gestorHTMLCRUD;
		private $bloqueNombre;
		private $bloqueGrupo;
        
        var $ruta;
        
        public function __construct($esteBloque, $lenguaje = "") {
            
            // El objeto de la clase Configurador debe ser único en toda la aplicación
            $this->miConfigurador = \Configurador::singleton ();
            
            $ruta = $this->miConfigurador->getVariableConfiguracion ( "raizDocumento" );
            $rutaURL = $this->miConfigurador->getVariableConfiguracion ( "host" ) . $this->miConfigurador->getVariableConfiguracion ( "site" );
            
            if (! isset ( $esteBloque ["grupo"] ) || $esteBloque ["grupo"] == "") {
                $ruta .= "/blocks/" . $esteBloque ["nombre"] . "/";
                $rutaURL .= "/blocks/" . $esteBloque ["nombre"] . "/";
            } else {
                $ruta .= "/blocks/" . $esteBloque ["grupo"] . "/" . $esteBloque ["nombre"] . "/";
                $rutaURL .= "/blocks/" . $esteBloque ["grupo"] . "/" . $esteBloque ["nombre"] . "/";
            }
            
			$this->ruta =  $ruta;
            $this->miConfigurador->setVariableConfiguracion ( "rutaBloque", $ruta );
            $this->miConfigurador->setVariableConfiguracion ( "rutaUrlBloque", $rutaURL );
            
			$this->bloqueNombre =  $esteBloque['nombre'];
			$this->bloqueGrupo =  $esteBloque['grupo'];
			
            $this->miFuncion = new Funcion ();
            $this->miSql = new Sql ();
            $this->miFrontera = new Frontera ();
            $this->miLenguaje = new Lenguaje ();
			$this->miFuncion->setLenguaje($this->miLenguaje);
            $this->miFormulario = new \FormularioHtml ();
        
        }
        public function bloque() {
            
			
			
            if (isset ( $_REQUEST ['botonCancelar'] ) && $_REQUEST ['botonCancelar'] == "true") {
                $this->miFuncion->redireccionar ( "paginaPrincipal" );
            } else {
                
                /**
                 * Injección de dependencias
                 */
                
                // Para la frontera
                $this->miFrontera->setSql ( $this->miSql );
                $this->miFrontera->setFuncion ( $this->miFuncion );
                $this->miFrontera->setFormulario ( $this->miFormulario );
                $this->miFrontera->setLenguaje ( $this->miLenguaje );
                
                // Para la entidad
                $this->miFuncion->setSql ( $this->miSql );
                $this->miFuncion->setFuncion ( $this->miFuncion );
                $this->miFuncion->setLenguaje ( $this->miLenguaje );
                
                if (! isset ( $_REQUEST ['action'] )) {
                    
                    //$this->miFrontera->frontera ();
                                $gh =  new GestorHTMLCRUD($this->miLenguaje);
                    			//$gh->setOperaciones($this->operaciones());
                    			$gh->setObjetos('3,5');
								//var_dump($gh->setObjetos('3,5'));exit;
								//$gh->setObjetos('3');
								$gh->setFuncionInicio('if($(\'#objetoId\').val()!=0) 	getFormularioConsulta(true);');
								$gh->setBloque($this->bloqueNombre,$this->bloqueGrupo);
								$gh->iniciarPrincipal();
								unset($gh);
								return true;
					                    
                } else {
                    
                    $respuesta = $this->miFuncion->action ();
                    
                    // Si $respuesta==false, entonces se debe recargar el formulario y mostrar un mensaje de error.
                    if (! $respuesta) {
                        
                        $miBloque = $this->miConfigurador->getVariableConfiguracion ( 'esteBloque' );
                        $this->miConfigurador->setVariableConfiguracion ( 'errorFormulario', $miBloque ['nombre'] );
                    
                    }
                    /*if (! isset ( $_REQUEST ['procesarAjax'] )) {
                       $this->miFrontera->frontera ();
                    }*/
                
                }
            }
        }
        
		public function operaciones(){
				$operaciones =  array();
			
			
			//Crear
			$operacion = array(
			                  "nombre"=>'crear',
			                  "cadena"=>'principalCrear',
			                  "text"=>"false",
			                  "icono"=>"ui-icon-plus",
			                  "click"=>"$('#selectedItems').val('');getFormularioCreacionEdicion(true);"
							  );
			$operaciones[] =$operacion;
			unset($operacion);
			
			
			//consultar
			$operacion = array(
			                  "nombre"=>'consultar',
			                  "cadena"=>'principalConsultar',
			                  "text"=>"false",
			                  "icono"=>"ui-icon-search",
			                  "click"=>"getFormularioConsulta(true);"
							  );
			$operaciones[] =$operacion;
			unset($operacion);
			
			//editar
			$operacion = array(
			                  "nombre"=>'editar',
			                  "cadena"=>'principalEditar',
			                  "text"=>"false",
			                  "icono"=>"ui-icon-pencil",
			                  "click"=>"if($('#selectedItems').val()!='') 	getFormularioCreacionEdicion(false)"
							  );
			$operaciones[] =$operacion;
			unset($operacion);
			
			//duplicar
			$operacion = array(
			                  "nombre"=>'duplicar',
			                  "cadena"=>'principalDuplicar',
			                  "text"=>"false",
			                  "icono"=>"ui-icon-pause",
			                  "click"=>"if($('#selectedItems').val()!='') 	duplicarElemento();"
							  );
			$operaciones[] =$operacion;
			unset($operacion);
			
			
			//cambiar estado
			$operacion = array(
			                  "nombre"=>'cambiarEstado',
			                  "cadena"=>'principalCambiarEstado',
			                  "text"=>"false",
			                  "icono"=>"ui-icon-transferthick-e-w",
			                  "click"=>"if($('#selectedItems').val()!='') 	cambiarEstadoElemento();"
							  );
			$operaciones[] =$operacion;
			unset($operacion);
			
			//eliminar
			$operacion = array(
			                  "nombre"=>'eliminar',
			                  "cadena"=>'principalEliminar',
			                  "text"=>"false",
			                  "icono"=>"ui-icon-close",
			                  "click"=>"if($('#selectedItems').val()!='') 	eliminarElemento();"
							  );
			$operaciones[] =$operacion;
			unset($operacion);
			
			//ver
			$operacion = array(
			                  "nombre"=>'ver',
			                  "cadena"=>'principalVer',
			                  "text"=>"false",
			                  "icono"=>"ui-icon-info",
			                  "click"=>"if($('#selectedItems').val()!='') 	verElemento();"
							  );
			$operaciones[] =$operacion;
			unset($operacion);
			
			
			//validar
			$operacion = array(
			                  "nombre"=>'validar',
			                  "cadena"=>'principalValidar',
			                  "text"=>"false",
			                  "icono"=>"ui-icon-check",
			                  "click"=>"if($('#selectedItems').val()!='') 	validarElemento();"
							  );
			$operaciones[] =$operacion;
			unset($operacion);
			
			//ejecutar
			$operacion = array(
			                  "nombre"=>'ejecutar',
			                  "cadena"=>'principalEjecutar',
			                  "text"=>"false",
			                  "icono"=>"ui-icon-play",
			                  "click"=>"if($('#selectedItems').val()!='') 	ejecutarElemento();"
							  );
			$operaciones[] =$operacion;
			unset($operacion);
			
			return $operaciones; 
		}   
}
}
// @ Crear un objeto bloque especifico
// El arreglo $unBloque está definido en el objeto de la clase ArmadorPagina o en la clase ProcesadorPagina

if (isset ( $_REQUEST ["procesarAjax"] )) {
    $unBloque ["nombre"] = $_REQUEST ["bloqueNombre"];
    $unBloque ["grupo"] = $_REQUEST ["bloqueGrupo"];
}

$this->miConfigurador->setVariableConfiguracion ( "esteBloque", $unBloque );

if (isset ( $lenguaje )) {
    $esteBloque = new Bloque ( $unBloque, $lenguaje );
} else {
    $esteBloque = new Bloque ( $unBloque );
}

$esteBloque->bloque ();

?>
