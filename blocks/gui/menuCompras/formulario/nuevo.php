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


// Registro Orden Compra
$enlaceRegistroOrdenCompra ['enlace'] = "pagina=registrarOrdenCompra";
$enlaceRegistroOrdenCompra ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceRegistroOrdenCompra ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceRegistroOrdenCompra ['enlace'], $directorio);
$enlaceRegistroOrdenCompra ['nombre'] = "Registrar Orden de Compra";

// consultar y modificar Orden Compra
$enlaceConsultaOrdenCompra ['enlace'] = "pagina=consultaOrdenCompra";
$enlaceRegistroOrdenCompra ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceConsultaOrdenCompra ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceConsultaOrdenCompra ['enlace'], $directorio);
$enlaceConsultaOrdenCompra ['nombre'] = "Consultar y Modificar Orden de Compra";

// Registro Orden Servicios
$enlaceRegistroOrdenServicios ['enlace'] = "pagina=registrarOrdenServicios";
$enlaceRegistroOrdenServicios ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceRegistroOrdenServicios ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceRegistroOrdenServicios ['enlace'], $directorio);
$enlaceRegistroOrdenServicios ['nombre'] = "Registrar Orden de Servicios";


// Consultar y Modificar Orden Servicios
$enlaceConsultaOrdenServicios ['enlace'] = "pagina=consultaOrdenServicios";
$enlaceConsultaOrdenServicios ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceConsultaOrdenServicios ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceConsultaOrdenServicios ['enlace'], $directorio);
$enlaceConsultaOrdenServicios ['nombre'] = "Consultar y Modificar Orden de Servicios";


// Registro de Contrato

$enlacegestionContrato['enlace'] = "pagina=gestionContrato";
$enlacegestionContrato['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlacegestionContrato['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlacegestionContrato ['enlace'], $directorio);
$enlacegestionContrato['nombre'] = "Contratos Vicerrectoría";

// Gestionar Acta de Recibido

$enlacegestionActa['enlace'] = "pagina=registrarActa";
$enlacegestionActa['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlacegestionActa['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlacegestionActa ['enlace'], $directorio);
$enlacegestionActa['nombre'] = "Registrar Acta de Recibido";

// Gestionar Acta de Recibido

$enlaceconsultaActa['enlace'] = "pagina=consultarActa";
$enlaceconsultaActa['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceconsultaActa['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceconsultaActa['enlace'], $directorio);
$enlaceconsultaActa['nombre'] = "Consultar y Modificar Acta de Recibido";

// Reportico
$enlaceReportico ['enlace'] = "pagina=reportico";
$enlaceReportico ['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceReportico ['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceReportico ['enlace'], $directorio);
$enlaceReportico ['nombre'] = "Reportes Específicos";

// Fin de la sesión
$enlaceFinSesion['enlace'] = "pagina=index";
$enlaceFinSesion['enlace'] .= "&usuario=" . $miSesion->getSesionUsuarioId();

$enlaceFinSesion['urlCodificada'] = $this->miConfigurador->fabricaConexiones->crypto->codificar_url($enlaceFinSesion['enlace'], $directorio);
$enlaceFinSesion['nombre'] = "Cerrar Sesión Asistente Compras";

//------------------------------- Inicio del Menú-------------------------- //
?>
<nav id="cbp-hrmenu" class="cbp-hrmenu">
    <ul>
        <li>
            <a href="#">Gestión de Compras</a>
            <div class="cbp-hrsub">
                <div class="cbp-hrsub-inner"> 
                    <div>
                        <h4>Orden de Compra</h4>
                        <ul>
                            <li><a href="<?php echo $enlaceRegistroOrdenCompra['urlCodificada'] ?>"><?php echo $enlaceRegistroOrdenCompra['nombre'] ?></a></li>
                            <li><a href="<?php echo $enlaceConsultaOrdenCompra['urlCodificada'] ?>"><?php echo $enlaceConsultaOrdenCompra['nombre'] ?></a></li>
                        </ul>
                    </div>
                    <div>
                        <h4>Orden de Servicios</h4>
                        <ul>
                            <li><a href="<?php echo $enlaceRegistroOrdenServicios['urlCodificada'] ?>"><?php echo $enlaceRegistroOrdenServicios['nombre'] ?></a></li>
                            <li><a href="<?php echo $enlaceConsultaOrdenServicios['urlCodificada'] ?>"><?php echo $enlaceConsultaOrdenServicios['nombre'] ?></a></li>
                        </ul>
                    </div>
                    <div>
                        <h4>Contratos Vicerrectoría</h4>
                        <ul>
                            <li><a href="<?php echo $enlacegestionContrato['urlCodificada'] ?>"><?php echo $enlacegestionContrato['nombre'] ?></a></li>
                        </ul>
                    </div>
                </div><!-- /cbp-hrsub-inner -->
            </div><!-- /cbp-hrsub -->
        </li>

        <li>
            <a href="#">Gestión Entrada y Salida</a>
            <div class="cbp-hrsub">
                <div class="cbp-hrsub-inner">
                    <div>
                        <h4>Acta de Recibido</h4>
                        <ul>
                            <li><a href="<?php echo$enlaceconsultaActa['urlCodificada'] ?>"><?php echo $enlaceconsultaActa['nombre'] ?></a></li>
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
                            <!--li><a href="<?php echo $enlaceUsuarios['urlCodificada'] ?>"><?php echo ($enlaceUsuarios['nombre']) ?></a></li-->
                            <li><a href="<?php echo$enlaceFinSesion['urlCodificada'] ?>"><?php echo$enlaceFinSesion['nombre'] ?></a></li>
                        </ul>
                    </div>
                </div><!-- /cbp-hrsub-inner -->
            </div><!-- /cbp-hrsub -->
        </li>

    </ul>
</nav>

