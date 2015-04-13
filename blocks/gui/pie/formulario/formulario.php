<?php


$this->miConfigurador = \Configurador::singleton();
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
	
	// ------------------- Inicio División -------------------------------
	$esteCampo = 'divLogoNotificador';
	$atributos ['id'] = $esteCampo;
	$atributos['imagen'] = $this->miConfigurador->getVariableConfiguracion('rutaUrlBloque') . 'imagen/escudo.jpg';
	$atributos['estilo'] = $esteCampo;
// 	$atributos['etiqueta'] = $this->lenguaje->getCadena($esteCampo . 'Titulo');
	$atributos['ancho'] = '100%';
	$atributos['alto'] = '5%';
	echo $this->miFormulario->campoImagen($atributos);
	unset($atributos);
	
	// -----------------Texto-----------------------------
	$esteCampo = 'mensajePie';
	$atributos ["estilo"] = "";
	$atributos ['texto'] = $this->lenguaje->getCadena ( $esteCampo );
	echo $this->miFormulario->campoTexto ( $atributos );
	unset ( $atributos );
}
// ------------Fin de la División -----------------------
echo $this->miFormulario->division ( "fin" );

