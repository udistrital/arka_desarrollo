<?php
// var_dump($this->miConfigurador);
$esteBloque = $this->miConfigurador->getVariableConfiguracion("esteBloque");

$rutaBloque = $this->miConfigurador->getVariableConfiguracion("host");
$rutaBloque .= $this->miConfigurador->getVariableConfiguracion("site") . "/blocks/";
$rutaBloque .= $esteBloque ['grupo'] . "/" . $esteBloque ['nombre'];

$directorio = $this->miConfigurador->getVariableConfiguracion("host");
$directorio .= $this->miConfigurador->getVariableConfiguracion("site") . "/index.php?";
$directorio .= $this->miConfigurador->getVariableConfiguracion("enlace");
$miSesion = Sesion::singleton();

var_dump($miSesion);
exit;
// Consulta General
$enlaceConsultaGeneral ['enlace'] = "pagina=consultaGeneral";
$enlaceConsultaGeneral ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceConsultaGeneral ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceConsultaGeneral ['enlace'], $directorio);
$enlaceConsultaGeneral ['nombre'] = "Consulta General";


// Reportico
$enlaceReportico ['enlace'] = "pagina=reportico";
$enlaceReportico ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceReportico ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceReportico ['enlace'], $directorio);
$enlaceReportico ['nombre'] = "Reportes Inventarios";

//gestión depreciación - registro
$enlaceregistrarDepreciacion ['enlace'] = "pagina=registrarDepreciacion";
$enlaceregistrarDepreciacion ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceregistrarDepreciacion ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceregistrarDepreciacion ['enlace'], $directorio);
$enlaceregistrarDepreciacion ['nombre'] = "Generar Depreciación por Elemento";

//gestión depreciación - general
$enlacedepreciacionGeneral ['enlace'] = "pagina=depreciacionGeneral";
$enlacedepreciacionGeneral ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlacedepreciacionGeneral ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlacedepreciacionGeneral ['enlace'], $directorio);
$enlacedepreciacionGeneral ['nombre'] = "Generar Depreciación por Grupo Contable";

// Gestionar Catalogo

$enlaceGestionarCatalogo ['enlace'] = "pagina=catalogo";
$enlaceGestionarCatalogo ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceGestionarCatalogo ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceGestionarCatalogo ['enlace'], $directorio);
$enlaceGestionarCatalogo ['nombre'] = "Nivel de Inventarios";

// Gestionar GrupoC

$enlaceGestionarGrupoC ['enlace'] = "pagina=grupoContable";
$enlaceGestionarGrupoC ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceGestionarGrupoC ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceGestionarGrupoC ['enlace'], $directorio);
$enlaceGestionarGrupoC ['nombre'] = "Grupos Contables";


// Cierre Contable
$enlaceCierreContable ['enlace'] = "pagina=cierreContable";
$enlaceCierreContable ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceCierreContable ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceCierreContable ['enlace'], $directorio);
$enlaceCierreContable ['nombre'] = "Registrar Cierre Contable";

// Fin de la sesión
$enlaceFinSesion['enlace'] = "pagina=index";
$enlaceFinSesion['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceFinSesion['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceFinSesion['enlace'], $directorio);
$enlaceFinSesion['nombre'] = "Cerrar Sesión Contabilidad";

//------------------------------- Inicio del Menú-------------------------- //
?>
<nav id="cbp-hrmenu" class="cbp-hrmenu">
    <ul>
        <li>
            <a href="#">Gestión Contable</a>
            <div class="cbp-hrsub">
                <div class="cbp-hrsub-inner"> 
                    <div>
                        <h4>Gestión de Catálogos</h4>
                        <ul>
                            <!--li><a href="<?php echo $enlaceGestionarCatalogo['urlCodificada'] ?>"><?php echo $enlaceGestionarCatalogo['nombre'] ?></a></li-->
                            <li><a href="<?php echo $enlaceGestionarGrupoC['urlCodificada'] ?>"><?php echo $enlaceGestionarGrupoC['nombre'] ?></a></li>
                        </ul>
                    </div>
                    <div>
                        <h4>Periodos Contables</h4>
                        <ul>
                            <li><a href="<?php echo $enlaceCierreContable['urlCodificada'] ?>"><?php echo $enlaceCierreContable['nombre'] ?></a></li>
                        </ul>
                    </div>
                </div><!-- /cbp-hrsub-inner -->
            </div><!-- /cbp-hrsub -->
        </li>

        <li>
            <a href="#">Gestor Reportes</a>
            <div class="cbp-hrsub">
                <div class="cbp-hrsub-inner"> 
                    <div>
                        <h4>Gestor Reportes</h4>
                        <ul>
                            <li><a href="<?php echo$enlaceReportico['urlCodificada'] ?>"><?php echo $enlaceReportico['nombre'] ?></a></li>
                            <li><a href="<?php echo $enlaceConsultaGeneral['urlCodificada'] ?>"><?php echo $enlaceConsultaGeneral['nombre'] ?></a></li>
                        </ul>
                    </div>
                    <div>
                        <h4>Reportes Depreciación</h4>
                        <ul>
                            <li><a href="<?php echo$enlaceregistrarDepreciacion['urlCodificada'] ?>"><?php echo$enlaceregistrarDepreciacion['nombre'] ?></a></li>
                            <li><a href="<?php echo$enlacedepreciacionGeneral['urlCodificada'] ?>"><?php echo$enlacedepreciacionGeneral['nombre'] ?></a></li>
                        </ul>
                    </div>
                </div><!-- /cbp-hrsub-inner -->
            </div><!-- /cbp-hrsub -->
        </li>

        <li>
            <a href="#">Mi Sesión</a>
            <div class="cbp-hrsub">
                <div class="cbp-hrsub-inner"> 
                    <div>
                        <h4>Usuarios</h4>
                        <ul>
                            <li><a href="<?php echo$enlaceFinSesion['urlCodificada'] ?>"><?php echo$enlaceFinSesion['nombre'] ?></a></li>                          
                        </ul>
                    </div>
                </div><!-- /cbp-hrsub-inner -->
            </div><!-- /cbp-hrsub -->
        </li>

    </ul>
</nav>

