<?php

namespace component\GestoHTMLCRUD;


require_once ('component/Component.class.php');

use component\Component as Component;

//VISTA
require_once ('component/GestorHTMLCRUD/Vista/Consultar.class.php');
use component\GestoHTMLCRUD\Vista\Consultar as Consultar;

require_once ('component/GestorHTMLCRUD/Vista/Principal.class.php');
use component\GestorHTMLCRUD\Vista\Principal as Principal;

//CONTROLADOR
require_once ('component/GestorHTMLCRUD/Clase/Autocompletar.class.php');
use component\GestoHTMLCRUD\Clase\Autocompletar as Autocompletar;


class Componente extends Component  {
	

	private $consultarForm;
	private $idElemento;
	private $principal;
	private $autocompletar;
	// El componente actua como Fachada
	
	/**
	 * un objeto de la clase GestorUsuarios
	 */
	public function __construct($lenguaje, $idElemento = '') {
		

         $this->consultarForm =  new Consultar($lenguaje, $idElemento);
		 $this->principal = new Principal($lenguaje);
		 $this->autocompletar =  new \component\GestoHTMLCRUD\Clase\Autocompletar($lenguaje);
	}
	
	public function iniciarPrincipal()	{
		$this->principal->formulario();
	}
	
	public function setOperaciones($operaciones){
		$this->principal->setOperaciones($operaciones);
	}
	
	public function setObjetos($objetos){
		$this->principal->setObjetos($objetos);
	}
	
	public function setFuncionInicio($funcion){
		$this->principal->setFuncionInicio($funcion);
	}
	
	public function setBloque($nombre , $grupo = ''){
		$this->principal->setBloque($nombre , $grupo);
	}
	
	public function setQueryStringConsulta($value){
		$this->principal->setQueryStringConsulta($value);
	}
	
	public function setLenguajeConsultar($lenguaje){
		$this->consultarForm->setLenguaje($lenguaje);
	}
	
	public function setObjetoIdConsultar($id)	{
		$this->consultarForm->setObjetoId($id);
	}
	
	public function consultar()	{
		$this->consultarForm->formulario();
	}
	
	public function setQueryStringAutocompletar($value){
		$this->principal->setQueryStringAutocompletar($value);
	}
	
	public function setObjetoIdAutocompletar($id)	{
		$this->autocompletar->setObjetoId($id);
	}
	
	public function autocompletar($valor = '')	{
		$this->autocompletar->autocompletar($valor = '');
	}
		
	
}


