<?php
// include_once("../Sql.class.php");
$miSql = new Sqlmenu ();
// var_dump($this->miConfigurador);
$esteBloque = $this->miConfigurador->getVariableConfiguracion ( "esteBloque" );

$rutaBloque = $this->miConfigurador->getVariableConfiguracion ( "host" );
$rutaBloque .= $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/blocks/";
$rutaBloque .= $esteBloque ['grupo'] . "/" . $esteBloque ['nombre'];

$directorio = $this->miConfigurador->getVariableConfiguracion ( "host" );
$directorio .= $this->miConfigurador->getVariableConfiguracion ( "site" ) . "/index.php?";
$directorio .= $this->miConfigurador->getVariableConfiguracion ( "enlace" );

$conexion = "estructura";
$esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );

$miSesion = Sesion::singleton ();
// verifica los roles del usuario en el sistema
$roles = $miSesion->RolesSesion ();
$roles_unicos = $miSesion->RolesSesion_unico ();

// consulta datos del usuario
$id_usuario = $miSesion->getSesionUsuarioId ();
$_REQUEST ['usuario'] = $id_usuario;
$cadena_sql = $miSql->getCadenaSql ( "datosUsuario", $id_usuario );
$regUser = $esteRecursoDB->ejecutarAcceso ( $cadena_sql, "busqueda" );

{
	$url = $this->miConfigurador->getVariableConfiguracion ( "host" );
	$url .= $this->miConfigurador->getVariableConfiguracion ( "site" );
	
	$url .= "/index.php?";
	
	// WEB Services
	$cadenaACodificar16 = "pagina=proveedor";
	$cadenaACodificar16 .= "&procesarAjax=true";
	$cadenaACodificar16 .= "&action=index.php";
	$cadenaACodificar16 .= "&bloqueNombre=proveedor";
	$cadenaACodificar16 .= "&bloqueGrupo=webServices";
	$cadenaACodificar16 .= "&funcion=actualizarParametros";
	$cadenaACodificar16 .= "&tipo_parametro=proveedores";
	$cadenaACodificar16 .= "&webServices=true";
	
      
        
	// Codificar las variables
	$enlace = $this->miConfigurador->getVariableConfiguracion ( "enlace" );
	$cadena16 = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $cadenaACodificar16, $enlace );
	
	// URL definitiva
	$urlWS = $url . $cadena16;
        
}

if ($regUser [0] ['estado'] != 1) {
	$parametro ['cod_app'] = '';
	$parametro ['cod_rol'] = '';
} else {
	$tam = (count ( $roles ) - 1);
	$cod_rol = '';
	$cod_app = '';
	foreach ( $roles as $key => $value ) {
		if ($key < $tam) {
			$cod_rol .= $roles [$key] ['cod_rol'] . ",";
		} else {
			$cod_rol .= $roles [$key] ['cod_rol'];
		}
		
		if ($key < $tam) {
			$cod_app .= $roles [$key] ['cod_app'] . ",";
		} else {
			$cod_app .= $roles [$key] ['cod_app'];
		}
	}
	$parametro ['cod_app'] = $cod_app;
	$parametro ['cod_rol'] = $cod_rol;
}

// busca los datos de los servicios y los menus según los roles del usuario
$cadena_sql = $miSql->getCadenaSql ( "datosMenus", $parametro );
$reg_menu = $esteRecursoDB->ejecutarAcceso ( $cadena_sql, "busqueda" );

if ($reg_menu) {
	// Arma la matriz de menus con sus repectivos grupos y servicios
	$mMenu = array ();
	foreach ( $reg_menu as $key => $value ) {
		if (isset ( $reg_menu [$key] ['url_host_enlace'] ) && $reg_menu [$key] ['url_host_enlace'] != '') {
			$host = $reg_menu [$key] ['url_host_enlace'];
		} else {
			$host = $directorio;
		}
		
		$enlaceServ ['URL'] = "pagina=" . $reg_menu [$key] ['pagina_enlace'];
		$enlaceServ ['URL'] .= "&usuario=" . $id_usuario;
		$enlaceServ ['URL'] .= $reg_menu [$key] ['parametros'];
		$urlMovilArka = stristr ( $host, 'ws_arka_android' );
		
		if (! $urlMovilArka) {
			$enlaceServ ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $enlaceServ ['URL'], $host );
		} else {
			$enlaceServ ['urlCodificada'] = $host;
		}
		
		$mMenu [$reg_menu [$key] ['menu']] [$reg_menu [$key] ['grupo']] [$reg_menu [$key] ['enlace']] = array (
				'urlCodificada' => $enlaceServ ['urlCodificada'] 
		);
		unset ( $enlaceServ );
	}
}
$parametros ['id_usuario'] = $id_usuario;
$parametros ['tipo'] = 'inactivo';

$cadena_sql = $miSql->getCadenaSql ( "RolesInactivos", $parametros );
// $rolOut = $esteRecursoDB->ejecutarAcceso($cadena_sql, "busqueda");
unset ( $parametros ['tipo'] );
$parametros ['tipo'] = 'caduco';
$cadena_cad = $miSql->getCadenaSql ( "RolesInactivos", $parametros );
$rolCad = $esteRecursoDB->ejecutarAcceso ( $cadena_cad, "busqueda" );
// CambiarContraseña
$_REQUEST ['tiempo'] = time ();
$enlaceCambiarClave ['enlace'] = "pagina=cambiarClave";
$enlaceCambiarClave ['enlace'] .= "&opcion=cambiarClave";
$enlaceCambiarClave ['enlace'] .= "&campoSeguro=" . $_REQUEST ['tiempo'];
$enlaceCambiarClave ['enlace'] .= "&usuario=" . $id_usuario;
$enlaceCambiarClave ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $enlaceCambiarClave ['enlace'], $directorio );
$enlaceCambiarClave ['nombre'] = "Cambiar Contraseña";

// Fin de la sesión

$enlaceFinSesion ['enlace'] = "action=loginArka";
$enlaceFinSesion ['enlace'] .= "&pagina=index";
$enlaceFinSesion ['enlace'] .= "&bloque=loginArka";
$enlaceFinSesion ['enlace'] .= "&bloqueGrupo=registro";
$enlaceFinSesion ['enlace'] .= "&opcion=finSesion";
$enlaceFinSesion ['enlace'] .= "&campoSeguro=" . $_REQUEST ['tiempo'];
$enlaceFinSesion ['enlace'] .= "&sesion=" . $miSesion->getSesionId ();
$enlaceFinSesion ['enlace'] .= "&usuario=" . $id_usuario;
$enlaceFinSesion ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url ( $enlaceFinSesion ['enlace'], $directorio );
$enlaceFinSesion ['nombre'] = "Cerrar Sesión";

// ------------------------------- Inicio del Menú-------------------------- //
?>
<nav id="cbp-hrmenu" class="cbp-hrmenu">
	<ul>

        <?php
								if (isset ( $mMenu )) {
									// cada foreach arma encabezado del menu, grupo y servicio en su orden.
									foreach ( $mMenu as $mkey => $menus ) {
										?> <li><a href="#"><?php echo $mkey; ?> </a>
			<div class="cbp-hrsub">
				<div class="cbp-hrsub-inner"> 
                            <?php
										
										foreach ( $menus as $gkey => $grupos ) {
											?>  <div>
						<h4><?php echo $gkey; ?></h4>
						<ul>
                                        <?php
											
											foreach ( $grupos as $skey => $service ) {
												?>
                                            <li><a
								href="<?php echo $grupos[$skey]['urlCodificada'] ?>"><?php echo $skey ?></a></li>
                                        <?php } ?>                                 
                                    </ul>
					</div>
                            <?php } ?>
                        </div>
				<!-- /cbp-hrsub-inner -->
			</div> <!-- /cbp-hrsub --></li>
                <?php
									}
								}
								?>            
        <li><a href="#">Mi Sesión</a>
			<div class="cbp-hrsub">
				<div class="cbp-hrsub-inner">
					<div>
						<h4>Usuario: <?php echo $regUser[0]['nombre'] . " " . $regUser[0]['apellido'] ?></h4>
						<ul>
							<li><a href="<?php echo $enlaceCambiarClave['urlCodificada'] ?>"><?php echo ($enlaceCambiarClave['nombre']) ?></a></li>
							<li><a href="<?php echo $enlaceFinSesion['urlCodificada'] ?>"><?php echo ($enlaceFinSesion['nombre']) ?></a></li>
						</ul>
					</div>
                    <?php
																				if (isset ( $roles_unicos ) && is_array ( $roles_unicos )) {
																					?>                        
                        <div>
						<h4>Perfiles Activos</h4>
						<ul><?php
																					foreach ( $roles_unicos as $value ) {
																						?>
                                    <li><a href="#"><?php echo $value['rol'] ?></a></li>    
                                    <?php
																					}
																					?>
                            </ul>
					</div>
                        <?php
																				}
																				
																				if (isset ( $rolOut ) && is_array ( $rolOut )) {
																					?>                        
                        <div>
						<h4>Perfiles Inactivos</h4>
						<ul><?php
																					foreach ( $rolOut as $valueOut ) {
																						?>
                                    <li><a href="#"><?php echo $valueOut['rol'] ?></a></li>    
                                    <?php
																					}
																					?>
                            </ul>
					</div>
                        <?php
																				}
																				
																				if (isset ( $rolCad ) && is_array ( $rolCad )) {
																					?>                        
                        <div>
						<h4>Perfiles Caducados</h4>
						<ul><?php
																					foreach ( $rolCad as $valueCad ) {
																						?>
                                    <li><a href="#"><?php echo $valueCad['rol'] . " - " . $valueCad['fecha_caduca'] ?></a></li>    
                                    <?php
																					}
																					?>
                            </ul>
					</div>
                    <?php } ?>
                    <div>
						<h4>Manuales de Usuario</h4>
						<ul>
							<li><a target="_blank"
								href="https://drive.google.com/folderview?id=0BzG7rdBcnWhofk9Fa0lyZ1V5Zl83VF9DU2o3ZXZ1anhiS005aFdVUEpEX0VwcWhVSnNtZUU&usp=sharing_eid">Acceso
									a Manuales</a></li>


                            <?php
																												if (isset ( $roles_unicos ) && is_array ( $roles_unicos )) {
																													$a = 0;
																													foreach ( $roles_unicos as $key => $value ) {
																														if ($roles_unicos [$key] ['cod_rol'] >= 0 && $roles_unicos [$key] ['cod_rol'] <= 5) {
																															$a ++;
																														}
																													}
																													if ($a > 0) {
																														?>
                                    <li><a target="_blank"
								href="http://10.20.0.38/ws_arka_android/com.arkamovil.android-2%20(2).apk">Descargar
									Arka Móvil</a></li>    
                                    <?php
																													}
																												}
																												?>
                        </ul>
					</div>

				</div>
				<!-- /cbp-hrsub-inner -->
			</div> <!-- /cbp-hrsub --></li>

	</ul>
</nav>


