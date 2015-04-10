<?php 
namespace arka\grupoContable\eliminarGrupo;



if(!isset($GLOBALS["autorizado"])) {
	include("../index.php");
	exit;
}


class Formulario {

    var $miConfigurador;
    var $lenguaje;
    var $miFormulario;
    var $sql;
    var $esteRecursoDB;
    var $miFuncion;

    function __construct($lenguaje, $formulario , $sql , $funcion) {

        $this->miConfigurador = \Configurador::singleton ();

        $this->miConfigurador->fabricaConexiones->setRecursoDB ( 'principal' );

        $this->lenguaje = $lenguaje;

        $this->miFormulario = $formulario;
        
        $this->sql = $sql;
        
        //$this->miFuncion = $funcion;
        
        $conexion = "inventarios";
        $this->esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB($conexion);
        if (!$this->esteRecursoDB) {
        	//Este se considera un error fatal
        	exit;
        }

    }

    function eliminar() {
		
    	//validar request idGrupo
    	if(!isset($_REQUEST['idGrupo'])){
    		$this->miConfigurador->setVariableConfiguracion ( 'mostrarMensaje', 'errorId' );
    		$this->miConfigurador->setVariableConfiguracion ( 'tipoMensaje','error' );
    		$this->mensaje();
    		exit;
    	}
    	
    	if(strlen($_REQUEST['idGrupo'])>50||!is_numeric($_REQUEST['idGrupo'])){
    		$this->miConfigurador->setVariableConfiguracion ( 'mostrarMensaje', 'errorValId' );
    		$this->miConfigurador->setVariableConfiguracion ( 'tipoMensaje','error' );
    		$this->mensaje();
    		exit;
    	}
    	
    	//validar Grupo existente
    	$cadena_sql = $this->sql->getCadenaSql("buscarGrupoId",$_REQUEST['idGrupo']);
    	$registros = $this->esteRecursoDB->ejecutarAcceso($cadena_sql,"busqueda");
    	 
    	if(!$registros){
    		$this->miConfigurador->setVariableConfiguracion ( 'mostrarMensaje', 'errorGrupoExiste' );
    		$this->miConfigurador->setVariableConfiguracion ( 'tipoMensaje','error' );
    		$this->mensaje();
    		exit;
    	}
    	
    	
    	$cadena_sql = $this->sql->getCadenaSql("eliminarGrupo",$_REQUEST['idGrupo']);
    	
    	$registros = $this->esteRecursoDB->ejecutarAcceso($cadena_sql);
    	
    	if(!$registros){
    		$this->miConfigurador->setVariableConfiguracion ( 'mostrarMensaje', 'errorEliminar' );
    		$this->miConfigurador->setVariableConfiguracion ( 'tipoMensaje','error' );
    		$this->mensaje();
    		exit;
    	}

    	$this->miConfigurador->setVariableConfiguracion ( 'mostrarMensaje', 'operacionExitosa' );
    	$this->mensaje();
    	
    	
    	exit;
    	
    	 
		    	 
    }

    function mensaje() {

        // Si existe algun tipo de error en el login aparece el siguiente mensaje
        $mensaje = $this->miConfigurador->getVariableConfiguracion ( 'mostrarMensaje' );
        //$this->miConfigurador->setVariableConfiguracion ( 'mostrarMensaje', null );

        if ($mensaje) {

            $tipoMensaje = $this->miConfigurador->getVariableConfiguracion ( 'tipoMensaje' );

            if ($tipoMensaje == 'json') {

                $atributos ['mensaje'] = $mensaje;
                $atributos ['json'] = true;
            } else {
                $atributos ['mensaje'] = $this->lenguaje->getCadena ( $mensaje );
            }
            // -------------Control texto-----------------------
            $esteCampo = 'divMensaje';
            $atributos ['id'] = $esteCampo;
            $atributos ["tamanno"] = '';
            if( $tipoMensaje)  $atributos ["estilo"] = $tipoMensaje;
            else $atributos ["estilo"] = 'information';
            $atributos ["etiqueta"] = '';
            $atributos ["columnas"] = ''; // El control ocupa 47% del tamaño del formulario
            echo $this->miFormulario->campoMensaje ( $atributos );
            unset ( $atributos );

             
        }

        return true;

    }
    

}

$miFormulario = new Formulario ( $this->lenguaje, $this->miFormulario,$this->sql,$this );


$miFormulario->eliminar ();
$miFormulario->mensaje ();

?>