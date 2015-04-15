<?php
$this->miConfigurador = \Configurador::singleton ();
// ------------------Division-------------------------
$atributos ["id"] = "sabio";
$atributos ["estilo"] = "";
echo $this->miFormulario->division ( "inicio", $atributos );
unset ( $atributos );
// ------------Fin de la División -----------------------
echo $this->miFormulario->division ( "fin" );

// // ------------------Division-------------------------
// $atributos ["id"] = "escudo";
// $atributos ["estilo"] = "";
// echo $this->miFormulario->division ( "inicio", $atributos );
// unset ( $atributos );
// // ------------Fin de la División -----------------------
// echo $this->miFormulario->division ( "fin" );

// ------------------Division-------------------------
$atributos ["id"] = "pie";
$atributos ["estilo"] = "";
echo $this->miFormulario->division ( "inicio", $atributos );
unset ( $atributos );
{
	
	$esteCampo = 'mensajePie';
	$atributos ["id"] = $esteCampo;
	$atributos ["estilo"] = "";
	$atributos ['texto'] = $this->lenguaje->getCadena ( $esteCampo );
	echo $this->miFormulario->campoTexto ( $atributos );
	unset ( $atributos );
	
	// ------------------- Inicio División -------------------------------
	$esteCampo = 'divLogoNotificador';
	$atributos ['id'] = $esteCampo;
	$atributos ['imagen'] = $this->miConfigurador->getVariableConfiguracion ( 'rutaUrlBloque' ) . 'imagen/escudo.jpg';
	$atributos ['estilo'] = $esteCampo;
	$atributos ['ancho'] = '3%';
	$atributos ['alto'] = '1.5%';
	echo $this->miFormulario->campoImagen ( $atributos );
	unset ( $atributos );
}
// ------------Fin de la División -----------------------
echo $this->miFormulario->division ( "fin" );

