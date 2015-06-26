--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: arka_inventarios; Type: SCHEMA; Schema: -; Owner: arka_inventarios
--

CREATE SCHEMA arka_inventarios;


ALTER SCHEMA arka_inventarios OWNER TO arka_inventarios;

--
-- Name: SCHEMA arka_inventarios; Type: COMMENT; Schema: -; Owner: arka_inventarios
--

COMMENT ON SCHEMA arka_inventarios IS 'Base de Datos Inventario
';


--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = arka_inventarios, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: aplicacion_iva; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE aplicacion_iva (
    id_iva integer NOT NULL,
    iva double precision,
    descripcion character varying
);


ALTER TABLE arka_inventarios.aplicacion_iva OWNER TO arka_inventarios;

--
-- Name: TABLE aplicacion_iva; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE aplicacion_iva IS 'Tabla que permite seleccionar tipo de iva a aplicar';


--
-- Name: aplicacion_iva_id_iva_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE aplicacion_iva_id_iva_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.aplicacion_iva_id_iva_seq OWNER TO arka_inventarios;

--
-- Name: aplicacion_iva_id_iva_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE aplicacion_iva_id_iva_seq OWNED BY aplicacion_iva.id_iva;


--
-- Name: baja_elemento; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE baja_elemento (
    id_baja integer NOT NULL,
    dependencia_funcionario integer,
    estado_funcional integer,
    tramite integer,
    tipo_mueble integer,
    ruta_radicacion character varying,
    nombre_radicacion character varying,
    observaciones character varying,
    id_elemento_ind integer,
    fecha_registro date,
    estado_registro boolean DEFAULT true
);


ALTER TABLE arka_inventarios.baja_elemento OWNER TO arka_inventarios;

--
-- Name: TABLE baja_elemento; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE baja_elemento IS 'Tabla permite el registro de  bajas de los Elementos';


--
-- Name: baja_elemento_id_baja_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE baja_elemento_id_baja_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.baja_elemento_id_baja_seq OWNER TO arka_inventarios;

--
-- Name: baja_elemento_id_baja_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE baja_elemento_id_baja_seq OWNED BY baja_elemento.id_baja;


--
-- Name: bodega; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE bodega (
    id_bodega integer NOT NULL,
    descripcion character varying
);


ALTER TABLE arka_inventarios.bodega OWNER TO arka_inventarios;

--
-- Name: TABLE bodega; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE bodega IS 'Tabla que permite seleccionar Bodegas Existentes Para asignar Elemento';


--
-- Name: bodega_id_bodega_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE bodega_id_bodega_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.bodega_id_bodega_seq OWNER TO arka_inventarios;

--
-- Name: bodega_id_bodega_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE bodega_id_bodega_seq OWNED BY bodega.id_bodega;


--
-- Name: catalogo_elemento; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE catalogo_elemento (
    id_catalogo integer NOT NULL,
    tipo_bien integer,
    codigo character varying,
    nombre character varying
);


ALTER TABLE arka_inventarios.catalogo_elemento OWNER TO arka_inventarios;

--
-- Name: TABLE catalogo_elemento; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE catalogo_elemento IS 'Tabla Permite Seleccionar el Catalogo';


--
-- Name: catalogo_elemento_id_catalogo_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE catalogo_elemento_id_catalogo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.catalogo_elemento_id_catalogo_seq OWNER TO arka_inventarios;

--
-- Name: catalogo_elemento_id_catalogo_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE catalogo_elemento_id_catalogo_seq OWNED BY catalogo_elemento.id_catalogo;


--
-- Name: clase_entrada; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE clase_entrada (
    id_clase integer NOT NULL,
    descripcion character varying
);


ALTER TABLE arka_inventarios.clase_entrada OWNER TO arka_inventarios;

--
-- Name: TABLE clase_entrada; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE clase_entrada IS 'Tabla describe los tipos de Entradas';


--
-- Name: clase_entrada_id_clase_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE clase_entrada_id_clase_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.clase_entrada_id_clase_seq OWNER TO arka_inventarios;

--
-- Name: clase_entrada_id_clase_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE clase_entrada_id_clase_seq OWNED BY clase_entrada.id_clase;


--
-- Name: contratista_servicios; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE contratista_servicios (
    id_contratista integer NOT NULL,
    nombre_razon_social character varying,
    identificacion character varying,
    direccion character varying,
    telefono character varying,
    cargo character varying
);


ALTER TABLE arka_inventarios.contratista_servicios OWNER TO arka_inventarios;

--
-- Name: TABLE contratista_servicios; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE contratista_servicios IS 'Tabla Permite hacer registro de los Contratistas  de las ordenes de Servicios';


--
-- Name: contratista_servicios_id_contratista_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE contratista_servicios_id_contratista_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.contratista_servicios_id_contratista_seq OWNER TO arka_inventarios;

--
-- Name: contratista_servicios_id_contratista_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE contratista_servicios_id_contratista_seq OWNED BY contratista_servicios.id_contratista;


--
-- Name: contratos; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE contratos (
    id_contrato integer NOT NULL,
    nombre_contratista character varying,
    numero_contrato character varying,
    fecha_contrato date,
    id_documento_soporte integer,
    fecha_registro date,
    estado boolean
);


ALTER TABLE arka_inventarios.contratos OWNER TO arka_inventarios;

--
-- Name: TABLE contratos; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE contratos IS 'Tabla Permite hacer registro de los Contratos de Vicerectoria';


--
-- Name: contratos_id_contrato_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE contratos_id_contrato_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.contratos_id_contrato_seq OWNER TO arka_inventarios;

--
-- Name: contratos_id_contrato_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE contratos_id_contrato_seq OWNED BY contratos.id_contrato;


--
-- Name: dependencia; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE dependencia (
    id_dependencia integer NOT NULL,
    nombre character varying,
    direccion character varying,
    telefono character varying,
    cod_dependencia character varying,
    cod_sede character varying
);


ALTER TABLE arka_inventarios.dependencia OWNER TO arka_inventarios;

--
-- Name: TABLE dependencia; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE dependencia IS 'Tabla Permite hacer un registro Dependencia';


--
-- Name: dependencia_id_dependencia_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE dependencia_id_dependencia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.dependencia_id_dependencia_seq OWNER TO arka_inventarios;

--
-- Name: dependencia_id_dependencia_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE dependencia_id_dependencia_seq OWNED BY dependencia.id_dependencia;


--
-- Name: destino_orden; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE destino_orden (
    id_destino integer NOT NULL,
    descripcion character varying
);


ALTER TABLE arka_inventarios.destino_orden OWNER TO arka_inventarios;

--
-- Name: TABLE destino_orden; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE destino_orden IS 'Tabla que permite seleccionar Destino de la Orden Compra';


--
-- Name: destino_orden_id_destino_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE destino_orden_id_destino_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.destino_orden_id_destino_seq OWNER TO arka_inventarios;

--
-- Name: destino_orden_id_destino_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE destino_orden_id_destino_seq OWNED BY destino_orden.id_destino;


--
-- Name: donacion_entrada; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE donacion_entrada (
    id_donacion integer NOT NULL,
    ruta_acto character varying,
    nombre_acto character varying
);


ALTER TABLE arka_inventarios.donacion_entrada OWNER TO arka_inventarios;

--
-- Name: TABLE donacion_entrada; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE donacion_entrada IS 'Tabla Permite registrar una entrada cuando es por donacion';


--
-- Name: donacion_entrada_id_donacion_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE donacion_entrada_id_donacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.donacion_entrada_id_donacion_seq OWNER TO arka_inventarios;

--
-- Name: donacion_entrada_id_donacion_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE donacion_entrada_id_donacion_seq OWNED BY donacion_entrada.id_donacion;


--
-- Name: elemento; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE elemento (
    id_elemento integer NOT NULL,
    fecha_registro date,
    nivel integer,
    tipo_bien integer,
    descripcion character varying,
    cantidad double precision,
    unidad character varying,
    valor double precision,
    iva integer,
    ajuste double precision,
    bodega integer,
    subtotal_sin_iva double precision,
    total_iva double precision,
    total_iva_con double precision,
    tipo_poliza integer DEFAULT 0,
    fecha_inicio_pol date DEFAULT '0001-01-01'::date,
    fecha_final_pol date DEFAULT '0001-01-01'::date,
    marca character varying,
    serie character varying,
    id_entrada integer,
    estado boolean DEFAULT true
);


ALTER TABLE arka_inventarios.elemento OWNER TO arka_inventarios;

--
-- Name: TABLE elemento; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE elemento IS 'Tabla Permite hacer registro de  Elemento';


--
-- Name: elemento_anulado; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE elemento_anulado (
    id_elemento_anulado integer NOT NULL,
    id_elemento integer,
    observacion character varying
);


ALTER TABLE arka_inventarios.elemento_anulado OWNER TO arka_inventarios;

--
-- Name: TABLE elemento_anulado; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE elemento_anulado IS 'Tabla Permite hacer la anulacion de  Elementos';


--
-- Name: elemento_anulado_id_elemento_anulado_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE elemento_anulado_id_elemento_anulado_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.elemento_anulado_id_elemento_anulado_seq OWNER TO arka_inventarios;

--
-- Name: elemento_anulado_id_elemento_anulado_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE elemento_anulado_id_elemento_anulado_seq OWNED BY elemento_anulado.id_elemento_anulado;


--
-- Name: elemento_id_elemento_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE elemento_id_elemento_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.elemento_id_elemento_seq OWNER TO arka_inventarios;

--
-- Name: elemento_id_elemento_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE elemento_id_elemento_seq OWNED BY elemento.id_elemento;


--
-- Name: elemento_individual; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE elemento_individual (
    id_elemento_ind integer NOT NULL,
    fecha_registro date,
    placa character varying,
    serie character varying,
    id_elemento_gen integer,
    estado_elemento integer,
    id_salida integer,
    estado_registro boolean DEFAULT true,
    observaciones_traslados character varying
);


ALTER TABLE arka_inventarios.elemento_individual OWNER TO arka_inventarios;

--
-- Name: TABLE elemento_individual; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE elemento_individual IS 'Tabla Permite hacer registro de Individual de los elementos Elementos';


--
-- Name: elemento_individual_id_elemento_ind_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE elemento_individual_id_elemento_ind_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.elemento_individual_id_elemento_ind_seq OWNER TO arka_inventarios;

--
-- Name: elemento_individual_id_elemento_ind_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE elemento_individual_id_elemento_ind_seq OWNED BY elemento_individual.id_elemento_ind;


--
-- Name: encargado; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE encargado (
    id_encargado integer NOT NULL,
    id_tipo_encargado integer,
    nombres character varying,
    apellidos character varying,
    identificacion character varying,
    cargo character varying,
    asignacion character varying,
    estado boolean
);


ALTER TABLE arka_inventarios.encargado OWNER TO arka_inventarios;

--
-- Name: TABLE encargado; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE encargado IS 'Tabla Permite hacer un registro Encargados';


--
-- Name: encargado_id_encargado_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE encargado_id_encargado_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.encargado_id_encargado_seq OWNER TO arka_inventarios;

--
-- Name: encargado_id_encargado_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE encargado_id_encargado_seq OWNED BY encargado.id_encargado;


--
-- Name: entrada; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE entrada (
    id_entrada integer NOT NULL,
    fecha_registro date,
    vigencia character varying,
    clase_entrada integer,
    info_clase integer,
    tipo_contrato integer,
    numero_contrato character varying,
    fecha_contrato date,
    proveedor integer,
    numero_factura character varying,
    fecha_factura date,
    observaciones character varying,
    acta_recibido integer,
    estado_entrada integer DEFAULT 1 NOT NULL,
    estado_registro boolean DEFAULT true NOT NULL
);


ALTER TABLE arka_inventarios.entrada OWNER TO arka_inventarios;

--
-- Name: TABLE entrada; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE entrada IS 'Tabla Permite hacer registro de  Entradas';


--
-- Name: entrada_id_entrada_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE entrada_id_entrada_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.entrada_id_entrada_seq OWNER TO arka_inventarios;

--
-- Name: entrada_id_entrada_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE entrada_id_entrada_seq OWNED BY entrada.id_entrada;


--
-- Name: estado_baja; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE estado_baja (
    id_estado integer NOT NULL,
    descripcion character varying
);


ALTER TABLE arka_inventarios.estado_baja OWNER TO arka_inventarios;

--
-- Name: TABLE estado_baja; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE estado_baja IS 'Tabla describe los estados de Baja';


--
-- Name: estado_baja_id_estado_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE estado_baja_id_estado_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.estado_baja_id_estado_seq OWNER TO arka_inventarios;

--
-- Name: estado_baja_id_estado_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE estado_baja_id_estado_seq OWNED BY estado_baja.id_estado;


--
-- Name: estado_elemento; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE estado_elemento (
    id_estado_elemento integer NOT NULL,
    id_elemento_ind integer,
    tipo_faltsobr integer,
    id_faltante integer,
    id_sobrante integer,
    id_hurto integer,
    observaciones character varying,
    ruta_denuncia character varying,
    nombre_denuncia character varying,
    fecha_denuncia date,
    fecha_hurto date,
    fecha_registro date,
    estado_registro boolean DEFAULT true
);


ALTER TABLE arka_inventarios.estado_elemento OWNER TO arka_inventarios;

--
-- Name: TABLE estado_elemento; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE estado_elemento IS 'Tabla permite el registro de elementos faltantes , sobrantes y hurtos de los Elementos';


--
-- Name: estado_elemento_id_estado_elemento_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE estado_elemento_id_estado_elemento_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.estado_elemento_id_estado_elemento_seq OWNER TO arka_inventarios;

--
-- Name: estado_elemento_id_estado_elemento_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE estado_elemento_id_estado_elemento_seq OWNED BY estado_elemento.id_estado_elemento;


--
-- Name: estado_entrada; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE estado_entrada (
    id_estado integer NOT NULL,
    descripcion character varying
);


ALTER TABLE arka_inventarios.estado_entrada OWNER TO arka_inventarios;

--
-- Name: TABLE estado_entrada; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE estado_entrada IS 'Tabla describe los estados de Entradas';


--
-- Name: estado_entrada_id_estado_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE estado_entrada_id_estado_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.estado_entrada_id_estado_seq OWNER TO arka_inventarios;

--
-- Name: estado_entrada_id_estado_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE estado_entrada_id_estado_seq OWNED BY estado_entrada.id_estado;


--
-- Name: forma_pago_orden; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE forma_pago_orden (
    id_forma_pago integer NOT NULL,
    descripcion character varying
);


ALTER TABLE arka_inventarios.forma_pago_orden OWNER TO arka_inventarios;

--
-- Name: TABLE forma_pago_orden; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE forma_pago_orden IS 'Tabla que permite seleccionar Forma de Pago de la Orden Compra';


--
-- Name: forma_pago_orden_id_forma_pago_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE forma_pago_orden_id_forma_pago_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.forma_pago_orden_id_forma_pago_seq OWNER TO arka_inventarios;

--
-- Name: forma_pago_orden_id_forma_pago_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE forma_pago_orden_id_forma_pago_seq OWNED BY forma_pago_orden.id_forma_pago;


--
-- Name: funcionario; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE funcionario (
    id_funcionario integer NOT NULL,
    nombre character varying,
    identificacion character varying,
    dependencia integer
);


ALTER TABLE arka_inventarios.funcionario OWNER TO arka_inventarios;

--
-- Name: TABLE funcionario; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE funcionario IS 'Tabla de funcionarios a lo que se les asigan salidas';


--
-- Name: funcionario_id_funcionario_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE funcionario_id_funcionario_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.funcionario_id_funcionario_seq OWNER TO arka_inventarios;

--
-- Name: funcionario_id_funcionario_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE funcionario_id_funcionario_seq OWNED BY funcionario.id_funcionario;


--
-- Name: historial_elemento_individual; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE historial_elemento_individual (
    id_evento integer NOT NULL,
    fecha_registro date,
    elemento_individual integer,
    funcionario integer,
    descripcion_funcionario character varying
);


ALTER TABLE arka_inventarios.historial_elemento_individual OWNER TO arka_inventarios;

--
-- Name: TABLE historial_elemento_individual; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE historial_elemento_individual IS 'Tabla Permite hacer registro  historico de Individuales  Elementos';


--
-- Name: historial_elemento_individual_id_evento_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE historial_elemento_individual_id_evento_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.historial_elemento_individual_id_evento_seq OWNER TO arka_inventarios;

--
-- Name: historial_elemento_individual_id_evento_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE historial_elemento_individual_id_evento_seq OWNED BY historial_elemento_individual.id_evento;


--
-- Name: info_clase_entrada; Type: TABLE; Schema: arka_inventarios; Owner: postgres; Tablespace: 
--

CREATE TABLE info_clase_entrada (
    id_info_clase integer NOT NULL,
    observacion character varying,
    id_entrada integer,
    id_salida integer,
    id_hurto integer,
    num_placa double precision,
    val_sobrante double precision,
    ruta_archivo character varying,
    nombre_archivo character varying
);


ALTER TABLE arka_inventarios.info_clase_entrada OWNER TO postgres;

--
-- Name: info_clase_entrada_id_info_clase_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: postgres
--

CREATE SEQUENCE info_clase_entrada_id_info_clase_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.info_clase_entrada_id_info_clase_seq OWNER TO postgres;

--
-- Name: info_clase_entrada_id_info_clase_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: postgres
--

ALTER SEQUENCE info_clase_entrada_id_info_clase_seq OWNED BY info_clase_entrada.id_info_clase;


--
-- Name: informacion_presupuestal_orden; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE informacion_presupuestal_orden (
    id_informacion integer NOT NULL,
    vigencia_dispo integer,
    numero_dispo integer,
    valor_disp numeric,
    fecha_dip date,
    letras_dispo character varying,
    vigencia_regis integer,
    numero_regis integer,
    valor_regis numeric,
    fecha_regis date,
    letras_regis character varying,
    fecha_registro date,
    estado_registro boolean DEFAULT true NOT NULL
);


ALTER TABLE arka_inventarios.informacion_presupuestal_orden OWNER TO arka_inventarios;

--
-- Name: TABLE informacion_presupuestal_orden; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE informacion_presupuestal_orden IS 'Tabla Permite hacer registro de Informacion Presupuestal de la Orden de Compra y de Servicios ';


--
-- Name: informacion_presupuestal_orden_id_informacion_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE informacion_presupuestal_orden_id_informacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.informacion_presupuestal_orden_id_informacion_seq OWNER TO arka_inventarios;

--
-- Name: informacion_presupuestal_orden_id_informacion_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE informacion_presupuestal_orden_id_informacion_seq OWNED BY informacion_presupuestal_orden.id_informacion;


--
-- Name: items_actarecibido; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE items_actarecibido (
    id_items integer NOT NULL,
    id_acta integer,
    item character varying,
    cantidad integer,
    descripcion character varying,
    valor_unitario numeric(30,0) DEFAULT 0.00 NOT NULL,
    valor_total numeric(30,0) DEFAULT 0.00 NOT NULL,
    estado_registro numeric(2,0),
    fecha_registro date NOT NULL,
    id_salida integer DEFAULT 0 NOT NULL
);


ALTER TABLE arka_inventarios.items_actarecibido OWNER TO arka_inventarios;

--
-- Name: items_actarecibido_id_items_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE items_actarecibido_id_items_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.items_actarecibido_id_items_seq OWNER TO arka_inventarios;

--
-- Name: items_actarecibido_id_items_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE items_actarecibido_id_items_seq OWNED BY items_actarecibido.id_items;


--
-- Name: items_orden_compra; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE items_orden_compra (
    id_items integer NOT NULL,
    id_orden integer,
    item character varying,
    unidad_medida character varying,
    cantidad integer,
    descripcion character varying,
    valor_unitario numeric(30,0) DEFAULT 0.00 NOT NULL,
    valor_total numeric(30,0) DEFAULT 0.00 NOT NULL,
    descuento numeric(30,0) DEFAULT 0.00 NOT NULL
);


ALTER TABLE arka_inventarios.items_orden_compra OWNER TO arka_inventarios;

--
-- Name: TABLE items_orden_compra; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE items_orden_compra IS 'Tabla Permite hacer un registro  de los Items de la Orden de Compra';


--
-- Name: items_orden_compra_id_items_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE items_orden_compra_id_items_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.items_orden_compra_id_items_seq OWNER TO arka_inventarios;

--
-- Name: items_orden_compra_id_items_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE items_orden_compra_id_items_seq OWNED BY items_orden_compra.id_items;


--
-- Name: items_orden_compra_temp; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE items_orden_compra_temp (
    id_items integer NOT NULL,
    item character varying,
    unidad_medida character varying,
    cantidad integer,
    descripcion character varying,
    valor_unitario numeric(30,0) DEFAULT 0.00 NOT NULL,
    valor_total numeric(30,0) DEFAULT 0.00 NOT NULL,
    descuento numeric(30,0) DEFAULT 0.00 NOT NULL,
    seccion integer
);


ALTER TABLE arka_inventarios.items_orden_compra_temp OWNER TO arka_inventarios;

--
-- Name: TABLE items_orden_compra_temp; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE items_orden_compra_temp IS 'Tabla Permite hacer un registro temporal de los Items de la Orden de Compra';


--
-- Name: items_orden_compra_temp_id_items_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE items_orden_compra_temp_id_items_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.items_orden_compra_temp_id_items_seq OWNER TO arka_inventarios;

--
-- Name: items_orden_compra_temp_id_items_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE items_orden_compra_temp_id_items_seq OWNED BY items_orden_compra_temp.id_items;


--
-- Name: modulos; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE modulos (
    id_modulos integer NOT NULL,
    modulos_descripcion character varying
);


ALTER TABLE arka_inventarios.modulos OWNER TO arka_inventarios;

--
-- Name: TABLE modulos; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE modulos IS 'Tabla contiene modulos de Arka de registro';


--
-- Name: modulos_id_modulos_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE modulos_id_modulos_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.modulos_id_modulos_seq OWNER TO arka_inventarios;

--
-- Name: modulos_id_modulos_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE modulos_id_modulos_seq OWNED BY modulos.id_modulos;


--
-- Name: orden_compra; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE orden_compra (
    id_orden_compra integer NOT NULL,
    fecha_registro date,
    info_presupuestal integer,
    rubro character varying,
    obligaciones_proveedor character varying,
    obligaciones_contratista character varying,
    poliza1 boolean,
    poliza2 boolean,
    poliza3 boolean,
    poliza4 boolean,
    poliza5 boolean,
    lugar_entrega character varying,
    destino character varying,
    tiempo_entrega character varying,
    forma_pago character varying,
    supervision character varying,
    inhabilidades character varying,
    id_proveedor integer,
    ruta_cotizacion character varying,
    nombre_cotizacion character varying,
    id_dependencia integer,
    id_contratista integer,
    id_ordenador integer,
    subtotal numeric,
    iva numeric,
    total numeric,
    valor_letras character varying,
    vig_contratista integer,
    estado boolean
);


ALTER TABLE arka_inventarios.orden_compra OWNER TO arka_inventarios;

--
-- Name: TABLE orden_compra; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE orden_compra IS 'Tabla Permite hacer registro de orden de compra';


--
-- Name: orden_compra_id_orden_compra_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE orden_compra_id_orden_compra_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.orden_compra_id_orden_compra_seq OWNER TO arka_inventarios;

--
-- Name: orden_compra_id_orden_compra_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE orden_compra_id_orden_compra_seq OWNED BY orden_compra.id_orden_compra;


--
-- Name: orden_servicio; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE orden_servicio (
    id_orden_servicio integer NOT NULL,
    fecha_registro date,
    info_presupuestal integer,
    dependencia_solicitante integer,
    rubro integer,
    objeto_contrato character varying,
    poliza1 boolean,
    poliza2 boolean,
    poliza3 boolean,
    poliza4 boolean,
    duracion_pago integer,
    fecha_inicio_pago date,
    fecha_final_pago date,
    forma_pago character varying,
    total_preliminar double precision,
    iva double precision,
    total double precision,
    id_contratista integer,
    id_contratista_encargado integer,
    vig_contratista integer,
    id_ordenador_encargado integer,
    id_supervisor integer,
    estado boolean
);


ALTER TABLE arka_inventarios.orden_servicio OWNER TO arka_inventarios;

--
-- Name: TABLE orden_servicio; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE orden_servicio IS 'Tabla Permite hacer registro de orden de servicio';


--
-- Name: orden_servicio_id_orden_servicio_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE orden_servicio_id_orden_servicio_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.orden_servicio_id_orden_servicio_seq OWNER TO arka_inventarios;

--
-- Name: orden_servicio_id_orden_servicio_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE orden_servicio_id_orden_servicio_seq OWNED BY orden_servicio.id_orden_servicio;


--
-- Name: parrafos; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE parrafos (
    id_parrafos integer NOT NULL,
    parrafo character varying,
    tipo_parrafo character varying,
    modulo_parrafo integer,
    estado boolean
);


ALTER TABLE arka_inventarios.parrafos OWNER TO arka_inventarios;

--
-- Name: TABLE parrafos; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE parrafos IS 'Tabla contiene las clausulas textos por Defecto de Cada Modulo';


--
-- Name: parrafos_id_parrafos_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE parrafos_id_parrafos_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.parrafos_id_parrafos_seq OWNER TO arka_inventarios;

--
-- Name: parrafos_id_parrafos_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE parrafos_id_parrafos_seq OWNED BY parrafos.id_parrafos;


--
-- Name: polizas; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE polizas (
    id_polizas integer NOT NULL,
    poliza_1 character varying,
    poliza_2 character varying,
    poliza_3 character varying,
    poliza_4 character varying,
    poliza_5 character varying,
    modulo_tipo integer,
    estado boolean
);


ALTER TABLE arka_inventarios.polizas OWNER TO arka_inventarios;

--
-- Name: TABLE polizas; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE polizas IS 'Tabla contiene las polizas en General';


--
-- Name: polizas_id_polizas_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE polizas_id_polizas_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.polizas_id_polizas_seq OWNER TO arka_inventarios;

--
-- Name: polizas_id_polizas_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE polizas_id_polizas_seq OWNED BY polizas.id_polizas;


--
-- Name: proveedor; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE proveedor (
    id_proveedor integer NOT NULL,
    razon_social character varying,
    nit_proveedor character varying,
    direccion character varying,
    telefono character varying
);


ALTER TABLE arka_inventarios.proveedor OWNER TO arka_inventarios;

--
-- Name: TABLE proveedor; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE proveedor IS 'Tabla Permite hacer un registro proveedores nuevos';


--
-- Name: proveedor_id_proveedor_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE proveedor_id_proveedor_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.proveedor_id_proveedor_seq OWNER TO arka_inventarios;

--
-- Name: proveedor_id_proveedor_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE proveedor_id_proveedor_seq OWNED BY proveedor.id_proveedor;


--
-- Name: proveedor_nuevo; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE proveedor_nuevo (
    id_proveedor_n integer NOT NULL,
    razon_social character varying,
    nit_proveedor character varying,
    direccion character varying,
    telefono character varying
);


ALTER TABLE arka_inventarios.proveedor_nuevo OWNER TO arka_inventarios;

--
-- Name: proveedor_nuevo_id_proveedor_n_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE proveedor_nuevo_id_proveedor_n_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.proveedor_nuevo_id_proveedor_n_seq OWNER TO arka_inventarios;

--
-- Name: proveedor_nuevo_id_proveedor_n_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE proveedor_nuevo_id_proveedor_n_seq OWNED BY proveedor_nuevo.id_proveedor_n;


--
-- Name: recuperacion_entrada; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE recuperacion_entrada (
    id_recuperacion integer NOT NULL,
    observaciones character varying,
    ruta_acta character varying,
    nombre_acta character varying
);


ALTER TABLE arka_inventarios.recuperacion_entrada OWNER TO arka_inventarios;

--
-- Name: TABLE recuperacion_entrada; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE recuperacion_entrada IS 'Tabla Permite registrar una entrada cuando es por recuperacion';


--
-- Name: recuperacion_entrada_id_recuperacion_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE recuperacion_entrada_id_recuperacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.recuperacion_entrada_id_recuperacion_seq OWNER TO arka_inventarios;

--
-- Name: recuperacion_entrada_id_recuperacion_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE recuperacion_entrada_id_recuperacion_seq OWNED BY recuperacion_entrada.id_recuperacion;


--
-- Name: registro_actarecibido; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE registro_actarecibido (
    id_actarecibido integer NOT NULL,
    dependencia character varying(50) NOT NULL,
    fecha_recibido date NOT NULL,
    tipo_bien integer NOT NULL,
    nitproveedor numeric(30,0) NOT NULL,
    proveedor character varying(50) NOT NULL,
    numfactura numeric(30,0) NOT NULL,
    fecha_factura date NOT NULL,
    tipocomprador integer NOT NULL,
    tipoaccion integer NOT NULL,
    fecha_revision date NOT NULL,
    revisor character varying(50) NOT NULL,
    observacionesacta character varying(500) NOT NULL,
    estado_registro numeric(1,0),
    fecha_registro date
);


ALTER TABLE arka_inventarios.registro_actarecibido OWNER TO arka_inventarios;

--
-- Name: registro_actarecibido_id_actarecibido_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE registro_actarecibido_id_actarecibido_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.registro_actarecibido_id_actarecibido_seq OWNER TO arka_inventarios;

--
-- Name: registro_actarecibido_id_actarecibido_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE registro_actarecibido_id_actarecibido_seq OWNED BY registro_actarecibido.id_actarecibido;


--
-- Name: registro_documento; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE registro_documento (
    documento_id integer NOT NULL,
    documento_idunico character varying(50) NOT NULL,
    documento_nombre character varying(50) NOT NULL,
    documento_ruta character varying(250),
    documento_fechar date NOT NULL,
    documento_estado boolean
);


ALTER TABLE arka_inventarios.registro_documento OWNER TO arka_inventarios;

--
-- Name: registro_documento_documento_id_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE registro_documento_documento_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.registro_documento_documento_id_seq OWNER TO arka_inventarios;

--
-- Name: registro_documento_documento_id_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE registro_documento_documento_id_seq OWNED BY registro_documento.documento_id;


--
-- Name: reposicion_entrada; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE reposicion_entrada (
    id_reposicion integer NOT NULL,
    id_entrada character varying,
    id_hurto character varying,
    id_salida character varying
);


ALTER TABLE arka_inventarios.reposicion_entrada OWNER TO arka_inventarios;

--
-- Name: TABLE reposicion_entrada; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE reposicion_entrada IS 'Tabla Permite registrar una entrada cuando es por reposicion';


--
-- Name: reposicion_entrada_id_reposicion_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE reposicion_entrada_id_reposicion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.reposicion_entrada_id_reposicion_seq OWNER TO arka_inventarios;

--
-- Name: reposicion_entrada_id_reposicion_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE reposicion_entrada_id_reposicion_seq OWNED BY reposicion_entrada.id_reposicion;


--
-- Name: rubro; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE rubro (
    id_rubro integer NOT NULL,
    nombre character varying,
    codigo character varying
);


ALTER TABLE arka_inventarios.rubro OWNER TO arka_inventarios;

--
-- Name: TABLE rubro; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE rubro IS 'Tabla Permite seleccionar rubros';


--
-- Name: rubro_id_rubro_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE rubro_id_rubro_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.rubro_id_rubro_seq OWNER TO arka_inventarios;

--
-- Name: rubro_id_rubro_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE rubro_id_rubro_seq OWNED BY rubro.id_rubro;


--
-- Name: salida; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE salida (
    id_salida integer NOT NULL,
    fecha date,
    dependencia integer,
    ubicacion integer,
    funcionario integer,
    observaciones character varying,
    id_entrada integer
);


ALTER TABLE arka_inventarios.salida OWNER TO arka_inventarios;

--
-- Name: TABLE salida; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE salida IS 'Tabla Permite hacer registro de Salidas';


--
-- Name: salida_id_salida_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE salida_id_salida_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.salida_id_salida_seq OWNER TO arka_inventarios;

--
-- Name: salida_id_salida_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE salida_id_salida_seq OWNED BY salida.id_salida;


--
-- Name: seccion; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE seccion (
    id_seccion integer NOT NULL,
    nombre character varying
);


ALTER TABLE arka_inventarios.seccion OWNER TO arka_inventarios;

--
-- Name: TABLE seccion; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE seccion IS 'Tabla que permite seleccionar sección con respecto a la ubicacion  en la universidad';


--
-- Name: seccion_id_seccion_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE seccion_id_seccion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.seccion_id_seccion_seq OWNER TO arka_inventarios;

--
-- Name: seccion_id_seccion_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE seccion_id_seccion_seq OWNED BY seccion.id_seccion;


--
-- Name: sobrante_entrada; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE sobrante_entrada (
    id_sobrante integer NOT NULL,
    observaciones character varying,
    ruta_acta character varying,
    nombre_acta character varying
);


ALTER TABLE arka_inventarios.sobrante_entrada OWNER TO arka_inventarios;

--
-- Name: TABLE sobrante_entrada; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE sobrante_entrada IS 'Tabla Permite registrar una entrada cuando es por sobrante';


--
-- Name: sobrante_entrada_id_sobrante_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE sobrante_entrada_id_sobrante_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.sobrante_entrada_id_sobrante_seq OWNER TO arka_inventarios;

--
-- Name: sobrante_entrada_id_sobrante_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE sobrante_entrada_id_sobrante_seq OWNED BY sobrante_entrada.id_sobrante;


--
-- Name: solicitante_servicios; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE solicitante_servicios (
    id_solicitante integer NOT NULL,
    dependencia character varying,
    rubro character varying
);


ALTER TABLE arka_inventarios.solicitante_servicios OWNER TO arka_inventarios;

--
-- Name: TABLE solicitante_servicios; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE solicitante_servicios IS 'Tabla Permite hacer registro de los Solicitantes de orden de Servicios';


--
-- Name: solicitante_servicios_id_solicitante_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE solicitante_servicios_id_solicitante_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.solicitante_servicios_id_solicitante_seq OWNER TO arka_inventarios;

--
-- Name: solicitante_servicios_id_solicitante_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE solicitante_servicios_id_solicitante_seq OWNED BY solicitante_servicios.id_solicitante;


--
-- Name: supervisor_servicios; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE supervisor_servicios (
    id_supervisor integer NOT NULL,
    nombre character varying,
    cargo character varying,
    dependencia character varying
);


ALTER TABLE arka_inventarios.supervisor_servicios OWNER TO arka_inventarios;

--
-- Name: TABLE supervisor_servicios; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE supervisor_servicios IS 'Tabla Permite hacer registro de los Supervisores  de las ordenes de Servicios';


--
-- Name: supervisor_servicios_id_supervisor_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE supervisor_servicios_id_supervisor_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.supervisor_servicios_id_supervisor_seq OWNER TO arka_inventarios;

--
-- Name: supervisor_servicios_id_supervisor_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE supervisor_servicios_id_supervisor_seq OWNED BY supervisor_servicios.id_supervisor;


--
-- Name: tipo_bien; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE tipo_bien (
    tb_idbien integer NOT NULL,
    tb_descripcion character varying NOT NULL,
    tb_estado numeric NOT NULL,
    tb_registro date NOT NULL
);


ALTER TABLE arka_inventarios.tipo_bien OWNER TO arka_inventarios;

--
-- Name: tipo_bien_tb_idbien_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE tipo_bien_tb_idbien_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.tipo_bien_tb_idbien_seq OWNER TO arka_inventarios;

--
-- Name: tipo_bien_tb_idbien_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE tipo_bien_tb_idbien_seq OWNED BY tipo_bien.tb_idbien;


--
-- Name: tipo_bienes; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE tipo_bienes (
    id_tipo_bienes integer NOT NULL,
    descripcion character varying
);


ALTER TABLE arka_inventarios.tipo_bienes OWNER TO arka_inventarios;

--
-- Name: TABLE tipo_bienes; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE tipo_bienes IS 'Tabla que permite seleccionar tipo de Bien en el Registro de Elementos';


--
-- Name: tipo_bienes_id_tipo_bienes_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE tipo_bienes_id_tipo_bienes_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.tipo_bienes_id_tipo_bienes_seq OWNER TO arka_inventarios;

--
-- Name: tipo_bienes_id_tipo_bienes_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE tipo_bienes_id_tipo_bienes_seq OWNED BY tipo_bienes.id_tipo_bienes;


--
-- Name: tipo_cargo; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE tipo_cargo (
    id_cargo integer NOT NULL,
    descripcion character varying
);


ALTER TABLE arka_inventarios.tipo_cargo OWNER TO arka_inventarios;

--
-- Name: TABLE tipo_cargo; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE tipo_cargo IS 'Tabla describe los tipos de Cargos de Jefes';


--
-- Name: tipo_cargo_id_cargo_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE tipo_cargo_id_cargo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.tipo_cargo_id_cargo_seq OWNER TO arka_inventarios;

--
-- Name: tipo_cargo_id_cargo_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE tipo_cargo_id_cargo_seq OWNED BY tipo_cargo.id_cargo;


--
-- Name: tipo_contrato; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE tipo_contrato (
    id_tipo integer NOT NULL,
    descripcion character varying
);


ALTER TABLE arka_inventarios.tipo_contrato OWNER TO arka_inventarios;

--
-- Name: TABLE tipo_contrato; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE tipo_contrato IS 'Tabla describe los tipos de Contratos';


--
-- Name: tipo_contrato_id_tipo_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE tipo_contrato_id_tipo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.tipo_contrato_id_tipo_seq OWNER TO arka_inventarios;

--
-- Name: tipo_contrato_id_tipo_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE tipo_contrato_id_tipo_seq OWNED BY tipo_contrato.id_tipo;


--
-- Name: tipo_encargado; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE tipo_encargado (
    id_tipo_encargado integer NOT NULL,
    descripcion character varying
);


ALTER TABLE arka_inventarios.tipo_encargado OWNER TO arka_inventarios;

--
-- Name: TABLE tipo_encargado; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE tipo_encargado IS 'Tabla describe los tipos de Encargados';


--
-- Name: tipo_encargado_id_tipo_encargado_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE tipo_encargado_id_tipo_encargado_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.tipo_encargado_id_tipo_encargado_seq OWNER TO arka_inventarios;

--
-- Name: tipo_encargado_id_tipo_encargado_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE tipo_encargado_id_tipo_encargado_seq OWNED BY tipo_encargado.id_tipo_encargado;


--
-- Name: tipo_falt_sobr; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE tipo_falt_sobr (
    id_tipo_falt_sobr integer NOT NULL,
    descripcion character varying
);


ALTER TABLE arka_inventarios.tipo_falt_sobr OWNER TO arka_inventarios;

--
-- Name: TABLE tipo_falt_sobr; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE tipo_falt_sobr IS 'Tabla que permite seleccionar tipo de faltante o Sobrante en el Registro Faltantes y Sobrantes';


--
-- Name: tipo_falt_sobr_id_tipo_falt_sobr_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE tipo_falt_sobr_id_tipo_falt_sobr_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.tipo_falt_sobr_id_tipo_falt_sobr_seq OWNER TO arka_inventarios;

--
-- Name: tipo_falt_sobr_id_tipo_falt_sobr_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE tipo_falt_sobr_id_tipo_falt_sobr_seq OWNED BY tipo_falt_sobr.id_tipo_falt_sobr;


--
-- Name: tipo_mueble; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE tipo_mueble (
    id_tipo_mueble integer NOT NULL,
    descripcion character varying
);


ALTER TABLE arka_inventarios.tipo_mueble OWNER TO arka_inventarios;

--
-- Name: TABLE tipo_mueble; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE tipo_mueble IS 'Tabla que permite seleccionar tipo de mueble en el Registro de Bajas';


--
-- Name: tipo_mueble_id_tipo_mueble_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE tipo_mueble_id_tipo_mueble_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.tipo_mueble_id_tipo_mueble_seq OWNER TO arka_inventarios;

--
-- Name: tipo_mueble_id_tipo_mueble_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE tipo_mueble_id_tipo_mueble_seq OWNED BY tipo_mueble.id_tipo_mueble;


--
-- Name: tipo_ordenador_gasto; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE tipo_ordenador_gasto (
    id_ordenador integer NOT NULL,
    descripcion character varying
);


ALTER TABLE arka_inventarios.tipo_ordenador_gasto OWNER TO arka_inventarios;

--
-- Name: TABLE tipo_ordenador_gasto; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE tipo_ordenador_gasto IS 'Tabla describe los tipos de Ordenador Gasto';


--
-- Name: tipo_ordenador_gasto_id_ordenador_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE tipo_ordenador_gasto_id_ordenador_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.tipo_ordenador_gasto_id_ordenador_seq OWNER TO arka_inventarios;

--
-- Name: tipo_ordenador_gasto_id_ordenador_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE tipo_ordenador_gasto_id_ordenador_seq OWNED BY tipo_ordenador_gasto.id_ordenador;


--
-- Name: tipo_poliza; Type: TABLE; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

CREATE TABLE tipo_poliza (
    id_tipo_poliza integer NOT NULL,
    descripcion character varying
);


ALTER TABLE arka_inventarios.tipo_poliza OWNER TO arka_inventarios;

--
-- Name: TABLE tipo_poliza; Type: COMMENT; Schema: arka_inventarios; Owner: arka_inventarios
--

COMMENT ON TABLE tipo_poliza IS 'Tabla que permite seleccionar tipo de poliza en elementos';


--
-- Name: tipo_poliza_id_tipo_poliza_seq; Type: SEQUENCE; Schema: arka_inventarios; Owner: arka_inventarios
--

CREATE SEQUENCE tipo_poliza_id_tipo_poliza_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arka_inventarios.tipo_poliza_id_tipo_poliza_seq OWNER TO arka_inventarios;

--
-- Name: tipo_poliza_id_tipo_poliza_seq; Type: SEQUENCE OWNED BY; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER SEQUENCE tipo_poliza_id_tipo_poliza_seq OWNED BY tipo_poliza.id_tipo_poliza;


SET search_path = public, pg_catalog;

--
-- Name: arka_bloque; Type: TABLE; Schema: public; Owner: arka_frame; Tablespace: 
--

CREATE TABLE arka_bloque (
    id_bloque integer NOT NULL,
    nombre character(50) NOT NULL,
    descripcion character(255) DEFAULT NULL::bpchar,
    grupo character(200) NOT NULL
);


ALTER TABLE public.arka_bloque OWNER TO arka_frame;

--
-- Name: arka_bloque_id_bloque_seq; Type: SEQUENCE; Schema: public; Owner: arka_frame
--

CREATE SEQUENCE arka_bloque_id_bloque_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.arka_bloque_id_bloque_seq OWNER TO arka_frame;

--
-- Name: arka_bloque_id_bloque_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arka_frame
--

ALTER SEQUENCE arka_bloque_id_bloque_seq OWNED BY arka_bloque.id_bloque;


--
-- Name: arka_bloque_pagina; Type: TABLE; Schema: public; Owner: arka_frame; Tablespace: 
--

CREATE TABLE arka_bloque_pagina (
    idrelacion integer NOT NULL,
    id_pagina integer DEFAULT 0 NOT NULL,
    id_bloque integer DEFAULT 0 NOT NULL,
    seccion character(1) NOT NULL,
    posicion integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.arka_bloque_pagina OWNER TO arka_frame;

--
-- Name: arka_bloque_pagina_idrelacion_seq; Type: SEQUENCE; Schema: public; Owner: arka_frame
--

CREATE SEQUENCE arka_bloque_pagina_idrelacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.arka_bloque_pagina_idrelacion_seq OWNER TO arka_frame;

--
-- Name: arka_bloque_pagina_idrelacion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arka_frame
--

ALTER SEQUENCE arka_bloque_pagina_idrelacion_seq OWNED BY arka_bloque_pagina.idrelacion;


--
-- Name: arka_configuracion; Type: TABLE; Schema: public; Owner: arka_frame; Tablespace: 
--

CREATE TABLE arka_configuracion (
    id_parametro integer NOT NULL,
    parametro character(255) NOT NULL,
    valor character(255) NOT NULL
);


ALTER TABLE public.arka_configuracion OWNER TO arka_frame;

--
-- Name: arka_configuracion_id_parametro_seq; Type: SEQUENCE; Schema: public; Owner: arka_frame
--

CREATE SEQUENCE arka_configuracion_id_parametro_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.arka_configuracion_id_parametro_seq OWNER TO arka_frame;

--
-- Name: arka_configuracion_id_parametro_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arka_frame
--

ALTER SEQUENCE arka_configuracion_id_parametro_seq OWNED BY arka_configuracion.id_parametro;


--
-- Name: arka_dbms; Type: TABLE; Schema: public; Owner: arka_frame; Tablespace: 
--

CREATE TABLE arka_dbms (
    idconexion integer NOT NULL,
    nombre character varying(50) NOT NULL,
    dbms character varying(20) NOT NULL,
    servidor character varying(50) NOT NULL,
    puerto integer NOT NULL,
    conexionssh character varying(50) NOT NULL,
    db character varying(100) NOT NULL,
    esquema character varying(100) NOT NULL,
    usuario character varying(100) NOT NULL,
    password character varying(200) NOT NULL
);


ALTER TABLE public.arka_dbms OWNER TO arka_frame;

--
-- Name: arka_dbms_idconexion_seq; Type: SEQUENCE; Schema: public; Owner: arka_frame
--

CREATE SEQUENCE arka_dbms_idconexion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.arka_dbms_idconexion_seq OWNER TO arka_frame;

--
-- Name: arka_dbms_idconexion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arka_frame
--

ALTER SEQUENCE arka_dbms_idconexion_seq OWNED BY arka_dbms.idconexion;


--
-- Name: arka_estilo; Type: TABLE; Schema: public; Owner: arka_frame; Tablespace: 
--

CREATE TABLE arka_estilo (
    usuario character(50) DEFAULT '0'::bpchar NOT NULL,
    estilo character(50) NOT NULL
);


ALTER TABLE public.arka_estilo OWNER TO arka_frame;

--
-- Name: arka_logger; Type: TABLE; Schema: public; Owner: arka_frame; Tablespace: 
--

CREATE TABLE arka_logger (
    id_usuario integer NOT NULL,
    evento character(255) NOT NULL,
    fecha character(50) NOT NULL
);


ALTER TABLE public.arka_logger OWNER TO arka_frame;

--
-- Name: arka_logger_id_usuario_seq; Type: SEQUENCE; Schema: public; Owner: arka_frame
--

CREATE SEQUENCE arka_logger_id_usuario_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.arka_logger_id_usuario_seq OWNER TO arka_frame;

--
-- Name: arka_logger_id_usuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arka_frame
--

ALTER SEQUENCE arka_logger_id_usuario_seq OWNED BY arka_logger.id_usuario;


--
-- Name: arka_pagina; Type: TABLE; Schema: public; Owner: arka_frame; Tablespace: 
--

CREATE TABLE arka_pagina (
    id_pagina integer NOT NULL,
    nombre character(50) DEFAULT ''::bpchar NOT NULL,
    descripcion character(250) DEFAULT ''::bpchar NOT NULL,
    modulo character(50) DEFAULT ''::bpchar NOT NULL,
    nivel integer DEFAULT 0 NOT NULL,
    parametro character(255) NOT NULL
);


ALTER TABLE public.arka_pagina OWNER TO arka_frame;

--
-- Name: arka_pagina_id_pagina_seq; Type: SEQUENCE; Schema: public; Owner: arka_frame
--

CREATE SEQUENCE arka_pagina_id_pagina_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.arka_pagina_id_pagina_seq OWNER TO arka_frame;

--
-- Name: arka_pagina_id_pagina_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arka_frame
--

ALTER SEQUENCE arka_pagina_id_pagina_seq OWNED BY arka_pagina.id_pagina;


--
-- Name: arka_subsistema; Type: TABLE; Schema: public; Owner: arka_frame; Tablespace: 
--

CREATE TABLE arka_subsistema (
    id_subsistema integer NOT NULL,
    nombre character varying(250) NOT NULL,
    etiqueta character varying(100) NOT NULL,
    id_pagina integer DEFAULT 0 NOT NULL,
    observacion text
);


ALTER TABLE public.arka_subsistema OWNER TO arka_frame;

--
-- Name: arka_subsistema_id_subsistema_seq; Type: SEQUENCE; Schema: public; Owner: arka_frame
--

CREATE SEQUENCE arka_subsistema_id_subsistema_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.arka_subsistema_id_subsistema_seq OWNER TO arka_frame;

--
-- Name: arka_subsistema_id_subsistema_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arka_frame
--

ALTER SEQUENCE arka_subsistema_id_subsistema_seq OWNED BY arka_subsistema.id_subsistema;


--
-- Name: arka_tempformulario; Type: TABLE; Schema: public; Owner: arka_frame; Tablespace: 
--

CREATE TABLE arka_tempformulario (
    id_sesion character(32) NOT NULL,
    formulario character(100) NOT NULL,
    campo character(100) NOT NULL,
    valor text NOT NULL,
    fecha character(50) NOT NULL
);


ALTER TABLE public.arka_tempformulario OWNER TO arka_frame;

--
-- Name: arka_usuario; Type: TABLE; Schema: public; Owner: arka_frame; Tablespace: 
--

CREATE TABLE arka_usuario (
    id_usuario integer NOT NULL,
    nombre character varying(50) DEFAULT ''::character varying NOT NULL,
    apellido character varying(50) DEFAULT ''::character varying NOT NULL,
    correo character varying(100) DEFAULT ''::character varying NOT NULL,
    telefono character varying(50) DEFAULT ''::character varying NOT NULL,
    imagen character(255) NOT NULL,
    clave character varying(100) DEFAULT ''::character varying NOT NULL,
    tipo character varying(255) DEFAULT ''::character varying NOT NULL,
    estilo character varying(50) DEFAULT 'basico'::character varying NOT NULL,
    idioma character varying(50) DEFAULT 'es_es'::character varying NOT NULL,
    estado integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.arka_usuario OWNER TO arka_frame;

--
-- Name: arka_usuario_id_usuario_seq; Type: SEQUENCE; Schema: public; Owner: arka_frame
--

CREATE SEQUENCE arka_usuario_id_usuario_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.arka_usuario_id_usuario_seq OWNER TO arka_frame;

--
-- Name: arka_usuario_id_usuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: arka_frame
--

ALTER SEQUENCE arka_usuario_id_usuario_seq OWNED BY arka_usuario.id_usuario;


--
-- Name: arka_usuario_subsistema; Type: TABLE; Schema: public; Owner: arka_frame; Tablespace: 
--

CREATE TABLE arka_usuario_subsistema (
    id_usuario integer DEFAULT 0 NOT NULL,
    id_subsistema integer DEFAULT 0 NOT NULL,
    estado integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.arka_usuario_subsistema OWNER TO arka_frame;

--
-- Name: arka_valor_sesion; Type: TABLE; Schema: public; Owner: arka_frame; Tablespace: 
--

CREATE TABLE arka_valor_sesion (
    sesionid character(32) NOT NULL,
    variable character(20) NOT NULL,
    valor character(255) NOT NULL,
    expiracion bigint DEFAULT 0 NOT NULL
);


ALTER TABLE public.arka_valor_sesion OWNER TO arka_frame;

SET search_path = arka_inventarios, pg_catalog;

--
-- Name: id_iva; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY aplicacion_iva ALTER COLUMN id_iva SET DEFAULT nextval('aplicacion_iva_id_iva_seq'::regclass);


--
-- Name: id_baja; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY baja_elemento ALTER COLUMN id_baja SET DEFAULT nextval('baja_elemento_id_baja_seq'::regclass);


--
-- Name: id_bodega; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY bodega ALTER COLUMN id_bodega SET DEFAULT nextval('bodega_id_bodega_seq'::regclass);


--
-- Name: id_catalogo; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY catalogo_elemento ALTER COLUMN id_catalogo SET DEFAULT nextval('catalogo_elemento_id_catalogo_seq'::regclass);


--
-- Name: id_clase; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY clase_entrada ALTER COLUMN id_clase SET DEFAULT nextval('clase_entrada_id_clase_seq'::regclass);


--
-- Name: id_contratista; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY contratista_servicios ALTER COLUMN id_contratista SET DEFAULT nextval('contratista_servicios_id_contratista_seq'::regclass);


--
-- Name: id_contrato; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY contratos ALTER COLUMN id_contrato SET DEFAULT nextval('contratos_id_contrato_seq'::regclass);


--
-- Name: id_dependencia; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY dependencia ALTER COLUMN id_dependencia SET DEFAULT nextval('dependencia_id_dependencia_seq'::regclass);


--
-- Name: id_destino; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY destino_orden ALTER COLUMN id_destino SET DEFAULT nextval('destino_orden_id_destino_seq'::regclass);


--
-- Name: id_donacion; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY donacion_entrada ALTER COLUMN id_donacion SET DEFAULT nextval('donacion_entrada_id_donacion_seq'::regclass);


--
-- Name: id_elemento; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY elemento ALTER COLUMN id_elemento SET DEFAULT nextval('elemento_id_elemento_seq'::regclass);


--
-- Name: id_elemento_anulado; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY elemento_anulado ALTER COLUMN id_elemento_anulado SET DEFAULT nextval('elemento_anulado_id_elemento_anulado_seq'::regclass);


--
-- Name: id_elemento_ind; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY elemento_individual ALTER COLUMN id_elemento_ind SET DEFAULT nextval('elemento_individual_id_elemento_ind_seq'::regclass);


--
-- Name: id_encargado; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY encargado ALTER COLUMN id_encargado SET DEFAULT nextval('encargado_id_encargado_seq'::regclass);


--
-- Name: id_entrada; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY entrada ALTER COLUMN id_entrada SET DEFAULT nextval('entrada_id_entrada_seq'::regclass);


--
-- Name: id_estado; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY estado_baja ALTER COLUMN id_estado SET DEFAULT nextval('estado_baja_id_estado_seq'::regclass);


--
-- Name: id_estado_elemento; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY estado_elemento ALTER COLUMN id_estado_elemento SET DEFAULT nextval('estado_elemento_id_estado_elemento_seq'::regclass);


--
-- Name: id_estado; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY estado_entrada ALTER COLUMN id_estado SET DEFAULT nextval('estado_entrada_id_estado_seq'::regclass);


--
-- Name: id_forma_pago; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY forma_pago_orden ALTER COLUMN id_forma_pago SET DEFAULT nextval('forma_pago_orden_id_forma_pago_seq'::regclass);


--
-- Name: id_funcionario; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY funcionario ALTER COLUMN id_funcionario SET DEFAULT nextval('funcionario_id_funcionario_seq'::regclass);


--
-- Name: id_evento; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY historial_elemento_individual ALTER COLUMN id_evento SET DEFAULT nextval('historial_elemento_individual_id_evento_seq'::regclass);


--
-- Name: id_info_clase; Type: DEFAULT; Schema: arka_inventarios; Owner: postgres
--

ALTER TABLE ONLY info_clase_entrada ALTER COLUMN id_info_clase SET DEFAULT nextval('info_clase_entrada_id_info_clase_seq'::regclass);


--
-- Name: id_informacion; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY informacion_presupuestal_orden ALTER COLUMN id_informacion SET DEFAULT nextval('informacion_presupuestal_orden_id_informacion_seq'::regclass);


--
-- Name: id_items; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY items_actarecibido ALTER COLUMN id_items SET DEFAULT nextval('items_actarecibido_id_items_seq'::regclass);


--
-- Name: id_items; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY items_orden_compra ALTER COLUMN id_items SET DEFAULT nextval('items_orden_compra_id_items_seq'::regclass);


--
-- Name: id_items; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY items_orden_compra_temp ALTER COLUMN id_items SET DEFAULT nextval('items_orden_compra_temp_id_items_seq'::regclass);


--
-- Name: id_modulos; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY modulos ALTER COLUMN id_modulos SET DEFAULT nextval('modulos_id_modulos_seq'::regclass);


--
-- Name: id_orden_compra; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY orden_compra ALTER COLUMN id_orden_compra SET DEFAULT nextval('orden_compra_id_orden_compra_seq'::regclass);


--
-- Name: id_orden_servicio; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY orden_servicio ALTER COLUMN id_orden_servicio SET DEFAULT nextval('orden_servicio_id_orden_servicio_seq'::regclass);


--
-- Name: id_parrafos; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY parrafos ALTER COLUMN id_parrafos SET DEFAULT nextval('parrafos_id_parrafos_seq'::regclass);


--
-- Name: id_polizas; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY polizas ALTER COLUMN id_polizas SET DEFAULT nextval('polizas_id_polizas_seq'::regclass);


--
-- Name: id_proveedor; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY proveedor ALTER COLUMN id_proveedor SET DEFAULT nextval('proveedor_id_proveedor_seq'::regclass);


--
-- Name: id_proveedor_n; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY proveedor_nuevo ALTER COLUMN id_proveedor_n SET DEFAULT nextval('proveedor_nuevo_id_proveedor_n_seq'::regclass);


--
-- Name: id_recuperacion; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY recuperacion_entrada ALTER COLUMN id_recuperacion SET DEFAULT nextval('recuperacion_entrada_id_recuperacion_seq'::regclass);


--
-- Name: id_actarecibido; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY registro_actarecibido ALTER COLUMN id_actarecibido SET DEFAULT nextval('registro_actarecibido_id_actarecibido_seq'::regclass);


--
-- Name: documento_id; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY registro_documento ALTER COLUMN documento_id SET DEFAULT nextval('registro_documento_documento_id_seq'::regclass);


--
-- Name: id_reposicion; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY reposicion_entrada ALTER COLUMN id_reposicion SET DEFAULT nextval('reposicion_entrada_id_reposicion_seq'::regclass);


--
-- Name: id_rubro; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY rubro ALTER COLUMN id_rubro SET DEFAULT nextval('rubro_id_rubro_seq'::regclass);


--
-- Name: id_salida; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY salida ALTER COLUMN id_salida SET DEFAULT nextval('salida_id_salida_seq'::regclass);


--
-- Name: id_seccion; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY seccion ALTER COLUMN id_seccion SET DEFAULT nextval('seccion_id_seccion_seq'::regclass);


--
-- Name: id_sobrante; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY sobrante_entrada ALTER COLUMN id_sobrante SET DEFAULT nextval('sobrante_entrada_id_sobrante_seq'::regclass);


--
-- Name: id_solicitante; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY solicitante_servicios ALTER COLUMN id_solicitante SET DEFAULT nextval('solicitante_servicios_id_solicitante_seq'::regclass);


--
-- Name: id_supervisor; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY supervisor_servicios ALTER COLUMN id_supervisor SET DEFAULT nextval('supervisor_servicios_id_supervisor_seq'::regclass);


--
-- Name: tb_idbien; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY tipo_bien ALTER COLUMN tb_idbien SET DEFAULT nextval('tipo_bien_tb_idbien_seq'::regclass);


--
-- Name: id_tipo_bienes; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY tipo_bienes ALTER COLUMN id_tipo_bienes SET DEFAULT nextval('tipo_bienes_id_tipo_bienes_seq'::regclass);


--
-- Name: id_cargo; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY tipo_cargo ALTER COLUMN id_cargo SET DEFAULT nextval('tipo_cargo_id_cargo_seq'::regclass);


--
-- Name: id_tipo; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY tipo_contrato ALTER COLUMN id_tipo SET DEFAULT nextval('tipo_contrato_id_tipo_seq'::regclass);


--
-- Name: id_tipo_encargado; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY tipo_encargado ALTER COLUMN id_tipo_encargado SET DEFAULT nextval('tipo_encargado_id_tipo_encargado_seq'::regclass);


--
-- Name: id_tipo_falt_sobr; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY tipo_falt_sobr ALTER COLUMN id_tipo_falt_sobr SET DEFAULT nextval('tipo_falt_sobr_id_tipo_falt_sobr_seq'::regclass);


--
-- Name: id_tipo_mueble; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY tipo_mueble ALTER COLUMN id_tipo_mueble SET DEFAULT nextval('tipo_mueble_id_tipo_mueble_seq'::regclass);


--
-- Name: id_ordenador; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY tipo_ordenador_gasto ALTER COLUMN id_ordenador SET DEFAULT nextval('tipo_ordenador_gasto_id_ordenador_seq'::regclass);


--
-- Name: id_tipo_poliza; Type: DEFAULT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY tipo_poliza ALTER COLUMN id_tipo_poliza SET DEFAULT nextval('tipo_poliza_id_tipo_poliza_seq'::regclass);


SET search_path = public, pg_catalog;

--
-- Name: id_bloque; Type: DEFAULT; Schema: public; Owner: arka_frame
--

ALTER TABLE ONLY arka_bloque ALTER COLUMN id_bloque SET DEFAULT nextval('arka_bloque_id_bloque_seq'::regclass);


--
-- Name: idrelacion; Type: DEFAULT; Schema: public; Owner: arka_frame
--

ALTER TABLE ONLY arka_bloque_pagina ALTER COLUMN idrelacion SET DEFAULT nextval('arka_bloque_pagina_idrelacion_seq'::regclass);


--
-- Name: id_parametro; Type: DEFAULT; Schema: public; Owner: arka_frame
--

ALTER TABLE ONLY arka_configuracion ALTER COLUMN id_parametro SET DEFAULT nextval('arka_configuracion_id_parametro_seq'::regclass);


--
-- Name: idconexion; Type: DEFAULT; Schema: public; Owner: arka_frame
--

ALTER TABLE ONLY arka_dbms ALTER COLUMN idconexion SET DEFAULT nextval('arka_dbms_idconexion_seq'::regclass);


--
-- Name: id_usuario; Type: DEFAULT; Schema: public; Owner: arka_frame
--

ALTER TABLE ONLY arka_logger ALTER COLUMN id_usuario SET DEFAULT nextval('arka_logger_id_usuario_seq'::regclass);


--
-- Name: id_pagina; Type: DEFAULT; Schema: public; Owner: arka_frame
--

ALTER TABLE ONLY arka_pagina ALTER COLUMN id_pagina SET DEFAULT nextval('arka_pagina_id_pagina_seq'::regclass);


--
-- Name: id_subsistema; Type: DEFAULT; Schema: public; Owner: arka_frame
--

ALTER TABLE ONLY arka_subsistema ALTER COLUMN id_subsistema SET DEFAULT nextval('arka_subsistema_id_subsistema_seq'::regclass);


--
-- Name: id_usuario; Type: DEFAULT; Schema: public; Owner: arka_frame
--

ALTER TABLE ONLY arka_usuario ALTER COLUMN id_usuario SET DEFAULT nextval('arka_usuario_id_usuario_seq'::regclass);


SET search_path = arka_inventarios, pg_catalog;

--
-- Data for Name: aplicacion_iva; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY aplicacion_iva (id_iva, iva, descripcion) FROM stdin;
1	0	Exento
2	0	Tarifa de Cero
3	0.0500000000000000028	5%
4	0.0400000000000000008	4%
5	0.100000000000000006	10%
6	0.160000000000000003	16%
\.


--
-- Name: aplicacion_iva_id_iva_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('aplicacion_iva_id_iva_seq', 4, true);


--
-- Data for Name: baja_elemento; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY baja_elemento (id_baja, dependencia_funcionario, estado_funcional, tramite, tipo_mueble, ruta_radicacion, nombre_radicacion, observaciones, id_elemento_ind, fecha_registro, estado_registro) FROM stdin;
1	4	1	5	1	http://localhost/arka/blocks/inventarios/gestionElementos/registrarBajas/documento_radicacion/640814_Untitled 1.ods	Untitled 1.ods	werwerwer	255	2015-03-27	t
2	4	1	5	1	http://localhost/arka/blocks/inventarios/gestionElementos/registrarBajas/documento_radicacion/f0fa66_Untitled 1.ods	Untitled 1.ods	werwerwer	255	2015-03-27	t
3	8	2	0	1	http://localhost/arka/blocks/inventarios/gestionElementos/registrarBajas/documento_radicacion/f8b6c8_Untitled 1.ods	Untitled 1.ods	asdaasdasd	255	2015-03-27	t
\.


--
-- Name: baja_elemento_id_baja_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('baja_elemento_id_baja_seq', 3, true);


--
-- Data for Name: bodega; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY bodega (id_bodega, descripcion) FROM stdin;
1	Bodega Central 40
2	Bodega Aduanilla
3	Bodega Tomas Jeferson
\.


--
-- Name: bodega_id_bodega_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('bodega_id_bodega_seq', 3, true);


--
-- Data for Name: catalogo_elemento; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY catalogo_elemento (id_catalogo, tipo_bien, codigo, nombre) FROM stdin;
1	1	101	Aceites, grasas y lubricantes
2	1	10101	Aceites
3	1	10102	Grasasnull
4	1	10103	 Lubricantes
5	1	102	         Combustibles
6	1	10201	Combustibles líquidos.
7	1	10202	Combustibles gaseosos
8	1	10203	Combustibles sólidos
9	1	103	Medicamentos, materiales quirúrgicos y de sanidad
10	1	10301	Medicamentos para atención humana
11	1	10302	Elementos y materiales para atención humana
12	1	10303	Medicamentos para atención animal
13	1	10304	Elementos y materiales para atención animal
14	1	104	Elementos,  materiales y materias  primas  para  construcción, instalación y labores
15	1	10401	Elementos para construcción y reparación
16	1	10402	Elementos de instalación y adhesión
17	1	10403	Elementos para mantenimiento de instalaciones físicas
18	1	10404	Herramientas de consumo
19	1	105	Explosivos
20	1	10501	Munición y similares
21	1	107	Elementos y sustancias para erradicación de plagas
22	1	10701	Elementos para erradicación de plagas animales
23	1	10702	Elementos para erradicación de plagas vegetales
24	1	10703	Sustancias para erradicación de plagas animales
25	1	10704	Sustancias para erradicación de plagas vegetales
26	1	109	Semillas y abonos
27	1	10901	Abonosnull
28	1	10902	Semillasnull
29	1	110	Elementos para oficina
30	1	11002	Elementos de oficina, escritorio y papeleria
31	1	111	Víveres, abarrotes y elementos de Cafetería
32	1	11101	Víveres
33	1	11102	Utencilios de cafetería
34	1	112	Repuestos para maquinaria y equipos
35	1	11201	Repuestos para máquina de escribir y calculadoras
36	1	11202	Repuestos para equipo de computación,  impresoras y similares
37	1	11203	Repuestos para equipos de laboratorionull
38	1	11204	Repuestos para vehículos
39	1	11205	Repuestos para ascensores, plantas eléctricas y máquinas hidráulicas
40	1	113	Elementos de aseo y protección
41	1	11301	Elementos para protección y seguridad industrial
42	1	11302	Elementos de aseo
43	1	114	Dotaciones
44	1	11401	Dotación para empleados
45	1	11402	Dotación para  deportistas
46	1	11403	Dotación para grupos culturales
47	1	11404	Pupitres para aulas de clase
48	1	11405	Elementos de consumo para biblioteca
49	1	11406	Implementos deportivos de consumo
50	1	115	Impresos y publicaciones
51	1	11501	Revistas
52	1	11502	Libros
53	1	11503	Impresos publicitarios
54	1	11504	Insumos para artes gráficas
55	1	11505	Diplomas y Actas de Grado
56	1	116	Elementos de premiaciones, condolencias y decoraciones
57	1	11601	Elementos para condecoraciones y reconocimientos
58	1	11602	Elementos de decoración
59	1	117	Elmentos y Suministros de Laboratorio 
60	1	11701	Insumos de laboratorio
61	1	11702	Material de vidrio para laboratorio
62	1	11703	Reactivos
63	1	11704	Elementos de consumo para laboratorio de música
64	2	201	Armas
65	2	20101	Armas de fuego
66	2	20102	Accesorios para armas de fuego
67	2	202	Discotecas y musicotecas
68	2	20201	Juegos de luces
69	2	20202	Accesorios para juegos de luces
70	2	20203	Equipo de sonido
71	2	20204	Accesorios para equipos de sonido
72	2	20205	Tarimas
73	2	20206	Accesorios para tarimas
74	2	20207	Colecciones musicales
75	2	203	Elementos de culto
76	2	20301	Ornamentos
77	2	20302	Vestiduras litúrgicas y ropa de altar
78	2	20303	Símbolos y objetos patrios
79	2	204	Elementos de museo, cuadros y pinturas
80	2	20401	Esculturas
81	2	20402	Pinturas
82	2	20403	Biologia
83	2	20404	Humana
84	2	206	Equipos  y  máquinas para procesar alimentos
85	2	20601	Equipos para despensa y cocina
86	2	207	Equipo y maquinaria para comunicaciones
87	2	20701	Equipos para comunicación en audio
88	2	20703	Equipos para comunicación en imágenes
89	2	20704	Satélites, transmisores y antenas
90	2	20705	Radares
91	2	20790	Equipos para proyección de imágenes
92	2	208	Equipos y maquinarias industriales
93	2	20801	Equipos para construcción
94	2	20802	Equipos para taller
95	2	20802	Equipos para aseo
96	2	209	Equipos y elementos para deporte
97	2	20901	Máquinas para gimnasio
98	2	20902	Elementos devolutivos para prácticas deportivas
99	2	210	 Equipos  para  laboratorios
100	2	21001	Equipos de laboratorio
101	2	21002	Instrumental para laboratorio
102	2	211	  Equipos  y  máquinas  para  medicina
103	2	21101	Equipos de medicina
104	2	21102	Equipos de odontología
105	2	21108	  Equipo de apoyo terapéutico
106	2	212	     Equipo y máquina de oficina
107	2	21201	Equipos de comunicación para oficinas
108	2	21202	Fotocopiadoras
109	2	21203	Impresoras y Scáneres
110	2	213	Vehículos y máquinas para transportenull
111	2	21301	  Vehículos y máquinas para transporte terrestre
112	2	21302	  Vehículos y máquinas para transporte fluvial
113	2	21303	  Vehículos y máquinas para transporte aérreo
114	2	214	Herramientasnull
115	2	21401	Herramientas Agropecuarias
116	2	21402	Herramientas para Electricidad
117	2	21403	Herramientas de taller
118	2	21404	Herramientas para construcción
119	2	215	Instrumentos musicalesnull
120	2	21501	Instrumentos musicales de cuerda
121	2	21502	Instrumentos musicales de viento
122	2	21503	Instrumentos musicales de percusión
123	2	21504	Instrumentos de música electrónicos
124	2	216	Colecciones bibliográficas
125	2	21601	Libros para consulta e investigación
126	2	21602	Hemerotecas
127	2	21603	Videotecas
128	2	21604	Colección electrónica
129	2	218	           Mobiliarios y enseres
130	2	21801	  Muebles y enseres
131	2	219	          Semovientes
132	2	21901	Bovinos
133	2	21902	Equinos
134	2	21903	Porcinos
135	2	220	Vestuario
136	2	22001	Cultural
137	2	22002	Deporte
138	2	22003	Lenceria
139	2	221	          Dispositivos para control de energía eléctrica
140	2	22101	UPS
141	2	22102	Plantas eléctricas
142	2	224	Equipos de cómputo y procesamiento de datos
143	2	22401	CPU
144	2	22402	Monitoresnull
145	2	22403	Tecladosnull
146	2	22404	Servidores
147	2	22405	Switch
148	2	22406	Routers y módems
149	2	22407	Cámaras de seguridad
150	2	22408	Unidades para almacenamiento de imágenes y videos
151	2	22409	Táblets y similares
152	2	22410	Dispositivos periféricos
153	2	225	Intangibles
154	2	22501	Software
155	2	22502	Licencias
156	2	22503	Patentes
157	2	22504	Derechos
158	2	22505	know how
159	2	301	Terrenos y edificaciones
160	2	30101	Terrenos
161	2	30102	Edificaciones
162	1	101	Aceites, grasas y lubricantes
163	1	10101	Aceites
164	1	10102	Grasasnull
165	1	10103	 Lubricantes
166	1	102	         Combustibles
167	1	10201	Combustibles líquidos.
168	1	10202	Combustibles gaseosos
169	1	10203	Combustibles sólidos
170	1	103	Medicamentos, materiales quirúrgicos y de sanidad
171	1	10301	Medicamentos para atención humana
172	1	10302	Elementos y materiales para atención humana
173	1	10303	Medicamentos para atención animal
174	1	10304	Elementos y materiales para atención animal
175	1	104	Elementos,  materiales y materias  primas  para  construcción, instalación y labores
176	1	10401	Elementos para construcción y reparación
177	1	10402	Elementos de instalación y adhesión
178	1	10403	Elementos para mantenimiento de instalaciones físicas
179	1	10404	Herramientas de consumo
180	1	105	Explosivos
181	1	10501	Munición y similares
182	1	107	Elementos y sustancias para erradicación de plagas
183	1	10701	Elementos para erradicación de plagas animales
184	1	10702	Elementos para erradicación de plagas vegetales
185	1	10703	Sustancias para erradicación de plagas animales
186	1	10704	Sustancias para erradicación de plagas vegetales
187	1	109	Semillas y abonos
188	1	10901	Abonosnull
189	1	10902	Semillasnull
190	1	110	Elementos para oficina
191	1	11002	Elementos de oficina, escritorio y papeleria
192	1	111	Víveres, abarrotes y elementos de Cafetería
193	1	11101	Víveres
194	1	11102	Utencilios de cafetería
195	1	112	Repuestos para maquinaria y equipos
196	1	11201	Repuestos para máquina de escribir y calculadoras
197	1	11202	Repuestos para equipo de computación,  impresoras y similares
198	1	11203	Repuestos para equipos de laboratorionull
199	1	11204	Repuestos para vehículos
200	1	11205	Repuestos para ascensores, plantas eléctricas y máquinas hidráulicas
201	1	113	Elementos de aseo y protección
202	1	11301	Elementos para protección y seguridad industrial
203	1	11302	Elementos de aseo
204	1	114	Dotaciones
205	1	11401	Dotación para empleados
206	1	11402	Dotación para  deportistas
207	1	11403	Dotación para grupos culturales
208	1	11404	Pupitres para aulas de clase
209	1	11405	Elementos de consumo para biblioteca
210	1	11406	Implementos deportivos de consumo
211	1	115	Impresos y publicaciones
212	1	11501	Revistas
213	1	11502	Libros
214	1	11503	Impresos publicitarios
215	1	11504	Insumos para artes gráficas
216	1	11505	Diplomas y Actas de Grado
217	1	116	Elementos de premiaciones, condolencias y decoraciones
218	1	11601	Elementos para condecoraciones y reconocimientos
219	1	11602	Elementos de decoración
220	1	117	Elmentos y Suministros de Laboratorio 
221	1	11701	Insumos de laboratorio
222	1	11702	Material de vidrio para laboratorio
223	1	11703	Reactivos
224	1	11704	Elementos de consumo para laboratorio de música
\.


--
-- Name: catalogo_elemento_id_catalogo_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('catalogo_elemento_id_catalogo_seq', 224, true);


--
-- Data for Name: clase_entrada; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY clase_entrada (id_clase, descripcion) FROM stdin;
1	Reposición
2	Donación
3	Sobrante
4	Producción Propia
5	Recuperación
\.


--
-- Name: clase_entrada_id_clase_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('clase_entrada_id_clase_seq', 5, true);


--
-- Data for Name: contratista_servicios; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY contratista_servicios (id_contratista, nombre_razon_social, identificacion, direccion, telefono, cargo) FROM stdin;
2	123	123	234234	123	123
3	123	123	234	123	123
4	123	123	1243	123	123
1	123123	123123	123123	12321	123123123
5	123	123	123	123	123
6	123123	123	123	123	123
7	123	123	123	123	123
8					
9					
10					
11					
12					
13					
14	Pepe Papeleria	1026276984	Kr 80 N # 73F - 72 SUR	7768019	JEFE 
15	Pepe Papeleria	109129289128	Kr 80 N 73 - 10	315125142	Jefe BLLA
16	Pepe Papeleria	109129289128	Kr 80 N 73 - 10	315125142	Jefe BLLA
17	Pepe Papeleria	109129289128	Kr 80 N 73 - 10	315125142	Jefe BLLA
18	Pepe Papeleria	109129289128	Kr 80 N 73 - 10	315125142	Jefe BLLA
19	Pepe Papeleria 	127653125	Kr 80 #12 -12	16253421	Jefe BLA
20	Pepe Papeleria 	127653125	Kr 80 #12 -12	16253421	Jefe BLA
21	Pepe Papeleria 	1421542354	Kr 80 # 73 - 72 sur 	123123123	Jefe BLA
22	Pepe Papeleria 	1421542354	Kr 80 # 73 - 72 sur 	123123123	Jefe BLA
23	Pepe Papeleria 	1421542354	Kr 80 # 73 - 72 sur 	123123123	Jefe BLA
24	Pepe Papeleria 	1421542354	Kr 80 # 73 - 72 sur 	123123123	Jefe BLA
25	Pepe Papeleria 	1421542354	Kr 80 # 73 - 72 sur 	123123123	Jefe BLA
26	Pepe Papeleria 	1421542354	Kr 80 # 73 - 72 sur 	123123123	Jefe BLA
27	Pepe Papeleria 	1421542354	Kr 80 # 73 - 72 sur 	123123123	Jefe BLA
28	Pepe	123	Kr 80 # 21-12	11124321	BLA
29	Pepe	123	Kr 80 # 21-12	11124321	BLA
30	Pepe	123	Kr 80 # 21-12	11124321	BLA
31	Pepe Papeleria	123	Kr 80 # 21-12	11124321	BLAS
32	PEP asd	1231231	K123 # 12-12	312512129	JEFE CRAS
33	PEP asd	1231231	K123 # 12-12	312512129	JEFE CRAS
34	Stiv Verdugo	1026276984	Cr 80 N 73 - 72 sur	123123123	jefe asdas
35	Stiv Verdusf	123123	123123213sdfsd	7768019	123123
36	Stiv Verdusf	123123	123123213sdfsd	7768019	123123
37	Stiv Verdugo	1231313123	kr 80 N 	123123	OPS
38	Stiv Verdugo	1231313123	kr 80 N 	123123	OPS
39	Stiv Verdugo	1231313123	kr 80 N 	123123	OPS
40	Stiv Verdugo	1231313123	kr 80 N 	123123	OPS
41	Stiv Verdugo	1231313123	kr 80 N 	123123	OPS
42	Stiv Verdugo	1231313123	kr 80 N 	123123	OPS
43	Stiv Verdugo	1231313123	kr 80 N 	123123	OPS
44	Stiv Verdugo	1231313123	kr 80 N 	123123	OPS
\.


--
-- Name: contratista_servicios_id_contratista_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('contratista_servicios_id_contratista_seq', 44, true);


--
-- Data for Name: contratos; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY contratos (id_contrato, nombre_contratista, numero_contrato, fecha_contrato, id_documento_soporte, fecha_registro, estado) FROM stdin;
9	Lizeth Caicedo	4444	2015-01-01	14	2015-01-06	t
10	Violeta Ana Luz Sosa	5525	2014-01-16	15	2015-01-06	t
8	Michael Stiv Verdugo Marquez	4425	2015-01-01	13	2015-01-06	t
11	Stiv Verdugo Marquez	2134	2015-01-02	16	2015-01-07	t
\.


--
-- Name: contratos_id_contrato_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('contratos_id_contrato_seq', 11, true);


--
-- Data for Name: dependencia; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY dependencia (id_dependencia, nombre, direccion, telefono, cod_dependencia, cod_sede) FROM stdin;
1	ACREDITACION Y AUTOEVALUACION	CRA. 3 No.26 A -40	3239300 Ext 2611	1	1
2	ADE	CRA. 3 No.26 A -40		2	1
3	ALMACEN DE TOPOGRAFIA	CRA. 3 No.26 A -40	2860463 EXT 61	3	1
4	ALMACEN DEPOSITO	CRA. 3 No.26 A -40	3239300 EXT 2714	4	1
5	ANECB	CRA. 3 No.26 A -40		5	1
6	SECCION DE ACTAS, ARCHIVO Y MICROFILMACIÓN	CRA. 3 No.26 A -40	2864425 - 2869666 Ext 41	6	1
7	ARC-INFO	CRA. 3 No.26 A -40		7	1
8	AUDITORIO	CRA. 3 No.26 A -40	2860463 EXT 42 - 2843045	8	1
9	AULA INFORMATICA EDUC.INFANCIA	CRA. 3 No.26 A -40	2869666	9	1
10	AYUDAS EDUCATIVAS	CRA. 3 No.26 A -40		10	1
11	BODEGA DE BAJAS	CRA. 3 No.26 A -40	3239300 EXT 2714	11	1
12	BIBLIOTECA CENTRAL	CRA. 3 No.26 A -40	2864149	13	1
13	BIENESTAR UNIVERSITARIO	CRA. 3 No.26 A -40	3400583	15	1
14	CAFETERIA	CRA. 3 No.26 A -40		17	1
15	CENTRO DOCUMENTACION CIENCIAS SOCIALES	CRA. 3 No.26 A -40		18	1
16	CENTRO DOCUMENTACION HISTORIA BOGOTA	CRA. 3 No.26 A -40		19	1
17	CIENCIAS SOCIALES	CRA. 3 No.26 A -40		20	1
18	CIIGER	CRA. 3 No.26 A -40		21	1
19	COMUNICACIÓN DIALOGICA Y DEMOCRACIA	CRA. 3 No.26 A -40		22	1
20	COORD AULAS INFORMATICA	CRA. 3 No.26 A -40		23	1
21	COORDINACION DE SERVICIOS GENERALES	CRA. 3 No.26 A -40		24	1
22	DEPORTES	CRA. 3 No.26 A -40		25	1
23	EDUCACION BASICA ENFASIS INGLES	CRA. 3 No.26 A -40	2842473 - 2869666 Ext 11	26	1
24	ENERGIAS ALTERNATIVAS	CRA. 3 No.26 A -40		27	1
25	DECANATURA FACULTAD DE CIENCIAS	CRA. 3 No.26 A -40	2860866	29	1
26	FALTANTES	CRA. 3 No.26 A -40		30	1
27	LICENCIATURA EN FISICA	CRA. 3 No.26 A -40	2864289 - 2869666 Ext 12 - 30	31	1
28	GRUPO FISICA E INFORMATICA	CRA. 3 No.26 A -40		32	1
29	GRUPO IDDF - FISICA QUINTO NIVEL	CRA. 3 No.26 A -40		33	1
30	GRUPO INSTRUMENTACION DIDACTACTICA	CRA. 3 No.26 A -40		34	1
31	HEMEROTECA	CRA. 3 No.26 A -40		35	1
32	HILDA	CRA. 3 No.26 A -40		36	1
33	INGENIERIA CATASTRAL	CRA. 3 No.26 A -40	3376969	38	1
34	INSTR.DIDACT.PROY.CAQUETA	CRA. 3 No.26 A -40		40	1
35	LABORATORIO FOTOGRAMETRIA	CRA. 3 No.26 A -40	2869666 EXT 59	41	1
36	LABORATORIO DE FISICA	CRA. 3 No.26 A -40	2864289	42	1
37	LABORATORIO DE GEODESIA	CRA. 3 No.26 A -40		43	1
38	LABORATORIO ESPAÑOL-INGLES	CRA. 3 No.26 A -40		44	1
39	LABORATORIO FONETICA EXPERIMENTAL	CRA. 3 No.26 A -40	2869666 EXT 63	45	1
40	LABORATORIO MULTIMEDIA	CRA. 3 No.26 A -40		46	1
41	LAS ESTRUCTURAS MENTALES	CRA. 3 No.26 A -40		47	1
42	LICENCIATURA CON ENFASIS EN HUMNIDADES Y LENGUA CASTELLANA	CRA. 3 No.26 A -40	2869666 Ext 15 ó 19	48	1
43	LICENCIATURA BASICA EN ENFASIS EN EDUCACION ARTISTICA	CRA. 3 No.26 A -40	2869666 Ext 16 -18	49	1
44	LICENCIATURA BIOLOGIA	CRA. 3 No.26 A -40	2842801	50	1
45	LICENCIATURA ESPAÑOL-INGLES	CRA. 3 No.26 A -40		51	1
46	LICENCIATURA QUIMICA	CRA. 3 No.26 A -40	2841752	52	1
47	MAESTRIA EN INVESTIGACION SOCIAL INTERDISCIPLINARIA	CRA. 3 No.26 A -40	2842878 - 2869666 Ext 36	53	1
48	PEDAGOGIA	CRA. 3 No.26 A -40	2842557	55	1
49	RECEPCION	CRA. 3 No.26 A -40		56	1
50	ROBO	CRA. 3 No.26 A -40		57	1
51	SALA DE PROFESORES CATASTRAL	CRA. 3 No.26 A -40	2864330	58	1
52	TALLER DE FISICA	CRA. 3 No.26 A -40		59	1
53	TECNOLOGIA EN SANEAMIENTO AMBIENTAL	CRA. 3 No.26 A -40	3424706	60	1
54	TOPOCART	CRA. 3 No.26 A -40		62	1
55	VISION CATASTRAL	CRA. 3 No.26 A -40		64	1
56	MATEMATICA PURA	CRA. 3 No.26 A -40	2869666 Ext 53	65	1
57	EDIFICIO Y TERRENO	CRA. 3 No.26 A -40		66	1
58	SECRETARIA ACADEMICA FACULTAD DE CIENCIAS Y EDUCACION	CRA. 3 No.26 A -40	2862810 - 2860205 Ext 23 y 27	67	1
59	COMITE DE INVESTIGACIONES	CRA. 3 No.26 A -40		68	1
60	GRUPO DE ENSEÑANZA DE LAS CIENCIAS Y LA ASTRONOMIA	CRA. 3 No.26 A -40		69	1
61	UNIDAD DE EXTENSION FACULTAD DE CIENCIAS	CRA. 3 No.26 A -40	2841936	2.020	1
62	FAC.CIENCIAS	CRA. 4 No.26 B-54		1.050	2
63	AULA INFORMATICA EDUC.INFANCIA	CRA. 4 No.26 B-54		2.001	2
64	BIBLIOTECA JAIRO ANIBAL NIÑO	CRA. 4 No.26 B-54		2.004	2
65	BIENESTAR UNIVERSITARIO	CRA. 4 No.26 B-54	2869666 EXT 29	2.005	2
66	COORDINACION DE ARTES	CRA. 4 No.26 B-54		2.006	2
67	ESPECIALIZACION EDUCACION Y GEST. AMBIENTAL	CRA. 4 No.26 B-54	2840463 - 3419569	2.007	2
68	GRUPO INTERCULTURAL CIENCIA Y TECNOLOGICA	CRA. 4 No.26 B-54		2.009	2
69	HERBARIO	CRA. 4 No.26 B-54	3419537	2.010	2
70	LABORATORIO BIOLOGIA - COORDINACION	CRA. 4 No.26 B-54	3419618 - 3419619	2.011	2
71	LABORATORIO QUIMICA	CRA. 4 No.26 B-54	3419538	2.012	2
72	MUSEO DE BIOLOGIA	CRA. 4 No.26 B-54		2.013	2
73	OFICINA EXTENSION CULTURAL	CRA. 4 No.26 B-54		2.014	2
74	ESPECIALIZACION EN INFANCIA, CULTURA Y DESARROLLO	CRA. 4 No.26 B-54	2840686	2.015	2
75	PROY.CURRI. LIC. EDUCACION INFANTIL	CRA. 4 No.26 B-54		2.016	2
76	ROBO	CRA. 4 No.26 B-54		2.017	2
77	SALA DE INVESTIGADORES	CRA. 4 No.26 B-54		2.018	2
78	SERVICIOS GENERALES	CRA. 4 No.26 B-54		2.019	2
79	ORNITOLOGIA, BIOLOGIA MOLECULAR Y PROTEOMA	CRA. 4 No.26 B-54	3375130	2.021	2
80	LABORATORIO QUIMICA - OBSERVATORIO PEDAGOGICO	CRA. 4 No.26 B-54	3419538	2.022	2
81	LABORATORIO QUIMICA - DOCENCIA DE LA QUIMICA	CRA. 4 No.26 B-54	3419538	2.023	2
82	LABORATORIO QUIMICA - FITOQUIMICA	CRA. 4 No.26 B-54	3419538	2.024	2
83	LABORATORIO QUIMICA - ALMACEN	CRA. 4 No.26 B-54	3419538	2.025	2
84	LABORATORIO QUIMICA - REACTIVOS	CRA. 4 No.26 B-54	3419538	2.026	2
85	LABORATORIO QUIMICA - INSTRUMENTACION I	CRA. 4 No.26 B-54	3419538	2.027	2
86	LABORATORIO QUIMICA - INSTRUMENTACION II	CRA. 4 No.26 B-54	3419538	2.028	2
87	LABORATORIO QUIMICA	CRA. 4 No.26 B-54	3419538	2.029	2
169	ROBOCUPA UD	CRA. 7 No.40-53		218	3
88	LABORATORIO QUIMICA - SALA MULTUPLE	CRA. 4 No.26 B-54	3419538	2.030	2
89	LABORATORIO QUIMICA - SINTESIS ORGANICA	CRA. 4 No.26 B-54	3419538	2.031	2
90	LABORATORIO QUIMICA - SISTESIS INORGANICA	CRA. 4 No.26 B-54	3419538	2.032	2
91	LABORATORIO QUIMICA - BIOQUIMICA	CRA. 4 No.26 B-54	3419538	2.033	2
92	LABORATORIO QUIMICA - RADIOQUIMICA	CRA. 4 No.26 B-54	3419538	2.034	2
93	LABORATORIO QUIMICA - LABORATORIOS	CRA. 4 No.26 B-54	3419538	2.035	2
94	LABORATORIO QUIMICA - CARBONES	CRA. 4 No.26 B-54	3419538	2.036	2
95	SALA INFORMATICA LABORATORIOS	CRA. 4 No.26 B-54		2.037	2
96	LABORATORIO BIOLOGIA - ATENEO	CRA. 4 No.26 B-54	3419618 - 3419619	2.038	2
97	LABORATORIO BIOLOGIA - ALMACEN	CRA. 4 No.26 B-54	3419618 - 3419619	2.039	2
98	LABORATORIO BIOLOGIA - ANIMALARIO	CRA. 4 No.26 B-54	3419618 - 3419619	2.040	2
99	LABORATORIO BIOLOGIA - BIOTECNOLOGIA	CRA. 4 No.26 B-54	3419618 - 3419619	2.041	2
100	LABORATORIO BIOLOGIA - BIOLOGIA MOLECULAR	CRA. 4 No.26 B-54	3419618 - 3419619	2.042	2
101	LABORATORIO BIOLOGIA - AGUAS	CRA. 4 No.26 B-54	3419618 - 3419619	2.043	2
102	LABORATORIO BIOLOGIA - REACTIVOS	CRA. 4 No.26 B-54	3419618 - 3419619	2.044	2
103	LABORATORIO BIOLOGIA - MICROBIOLOGIA	CRA. 4 No.26 B-54	3419618 - 3419619	2.045	2
104	EDIFICIO Y TERRENO	CRA. 4 No.26 B-54		2.046	2
105	FALTANTES	CRA. 4 No.26 B-54		2.047	2
106	LABORATORIO BIOLOGIA - PROTEOMA	CRA. 4 No.26 B-54	3419618 - 3419619	2.048	2
107	ACREDITACION	CRA. 7 No.40-53	3239300 EXT 2611	101	3
108	ADMINISTRADOR SEDE	CRA. 7 No.40-53		102	3
109	ACREDITACION INGENIERIA	CRA. 7 No.40-53	3238400 ext 2820	103	3
110	SECCION DE ALMACEN GENERAL E INVENTARIOS	CRA. 7 No.40-53	3239300 Ext 2712 - 2714	104	3
111	ASESOR DE RECTORIA	CRA. 7 No.40-53		105	3
112	AUDITORIA	CRA. 7 No.40-53		106	3
113	AULA INFORMATICA DE INGENIERIA	CRA. 7 No.40-53		107	3
114	BIENESTAR INSTITUCIONAL	CRA. 7 No.40-53	3400583	110	3
115	CATEDRA UNESCO	CRA. 7 No.40-53	3239300 Ext 2711	111	3
116	CICLO BASICO	CRA. 7 No.40-53		112	3
117	SECCION DE CONTABILIDAD	CRA. 7 No.40-53	3239300 Ext 2701 - 2704	113	3
118	SECCION DE PRESUPUESTO	CRA. 7 No.40-53	3239300 Ext 2701 - 2702	114	3
119	SECCION DE TESORERIA	CRA. 7 No.40-53	3239300 Ext 2720 - 2709	115	3
120	SECCION DE COMPRAS	CRA. 7 No.40-53	3239300 Ext 2605 - 2609	116	3
121	RECEPCION	CRA. 7 No.40-53	3239300 EXT 0 - 2107	117	3
122	DECANATURA FACULTAD INGENIERIA	CRA. 7 No.40-53	3239300 Ext 2500	118	3
123	VICERRECTORIA ADMINISTRATIVA Y FINANCIERA	CRA. 7 No.40-53	3239300 Ext 2800 - 2801 - fax 2807	119	3
124	DIVISION DE RECURSOS FINANCIEROS	CRA. 7 No.40-53	3239300 Ext 2700 y 2707	120	3
125	EDUCACION NO FORMAL	CRA. 7 No.40-53		121	3
126	ESPECIALIZACION EN AVALUOS	CRA. 7 No.40-53	3239300 Ext 2401	122	3
127	FALTANTES	CRA. 7 No.40-53		123	3
128	FONDO DE PENSIONES	CRA. 7 No.40-53		124	3
129	GRUPO INVESTIGACION GITEM	CRA. 7 No.40-53		126	3
130	GRUPO LIV-GILP-HILES	CRA. 7 No.40-53		127	3
131	GRUPO SIGUD	CRA. 7 No.40-53		128	3
132	ILUD	CRA. 7 No.40-53	3382675 - 3239300 Ext 2810	129	3
133	INVENTARIO OBRA	CRA. 7 No.40-53		130	3
134	CENTRO DE INVESTIGACIONES Y DESARROLLO	CRA. 7 No.40-53	3239300 Ext 2610	131	3
135	IPAZUD	CRA. 7 No.40-53	3239300 Ext 2112	133	3
136	DIVISION DE RECURSOS HUMANOS	CRA. 7 No.40-53	3239300 Ext 2600 - 2603 - 2604	134	3
137	DIVISION DE RECURSOS FISICOS	CRA. 7 No.40-53	3239300 Ext 2607 - 2608	135	3
138	LABORATORIO BASE DE DATOS	CRA. 7 No.40-53		136	3
139	LABORATORIO DE ERGONOMIA	CRA. 7 No.40-53		137	3
140	LABORATORIO DE METROLOGIA	CRA. 7 No.40-53		139	3
141	MAESTRIA EN TELEINFORMATICA	CRA. 7 No.40-53		140	3
142	MAESTRIA EN INGENIERIA INDUSTRIAL	CRA. 7 No.40-53	3239300 Ext 2420	141	3
143	CONGRESO UNIVERSITARIO	CRA. 7 No.40-53	3382811	142	3
144	OFICINA ASESORA DE ASUNTOS DISCIPLINARIOS	CRA. 7 No.40-53	3239300 Ext 2906 - 2920 - 2910	143	3
145	OFICINA DE DOCENCIA	CRA. 7 No.40-53	3239300 Ext 2904 - 2905	193	3
146	OFICINA ASESORA JURIDICA	CRA. 7 No.40-53	3239300 Ext 2902	194	3
147	OFICINA DE QUEJAS, RECLAMOS Y ATENCION AL CIUDADANO	CRA. 7 No.40-53	3239300 Ext 2907	195	3
148	PASANTIAS	CRA. 7 No.40-53		196	3
149	OFICINA ASESORA DE PLANEACION Y CONTROL	CRA. 7 No.40-53	3239300 Ext 2802 - 2803 - 2806	197	3
150	POST BIOINGENIERIA	CRA. 7 No.40-53	3239300 Ext 2406 - 2400	198	3
151	ESPECIALIZACION EN INFORMATICA INDUSTRIAL	CRA. 7 No.40-53	3239300 Ext 2420 - 2403	199	3
152	ESPECIALIZACION EN INGENIERIA DE PRODUCCION	CRA. 7 No.40-53	3239300 Ext 2403 - 2407	200	3
153	ESPECIALIZACION EN HIGIENE Y SALUD OCUPACIONAL	CRA. 7 No.40-53	3239300 Ext 2406	201	3
154	ESPECIALIZACION EN TELECOMUNICACIONES MOVILES	CRA. 7 No.40-53	3239300 Ext 2413	202	3
155	ESPECIALIZACION EN INGENIERIA DE SOFTWARE	CRA. 7 No.40-53	3239300 Ext 2408	203	3
156	ESPECIALIZACION EN SISTEMAS DE INFOR. GEOGRAFICA	CRA. 7 No.40-53	3239300 Ext 2402	204	3
157	ESPECIALIZACION EN TELEINFORMATICA	CRA. 7 No.40-53	3239300 Ext 2413	205	3
158	ESPECIALIZACION EN GESTION DE PROYECTOS DE INGENIERIA	CRA. 7 No.40-53	3239300 Ext 2400	206	3
159	PROCESAMIENTO DIGITAL DE SEÑALES	CRA. 7 No.40-53		207	3
160	PROGRAMA ESTUDIANTIL OF.IEEE	CRA. 7 No.40-53		208	3
161	PROYECTO CURRICULAR EN INGENIERIA INDUSTRIAL	CRA. 7 No.40-53	3239300 Ext 2504 - 2505	209	3
162	PROY.INGENIERIA ELECTRICA	CRA. 7 No.40-53	3238400 Ext 1540 - 1510	210	3
163	PROY.INGENIERIA ELECTRONICA	CRA. 7 No.40-53	3239300 Ext 2506	211	3
164	PROY.INGENIERIA SISTEMAS	CRA. 7 No.40-53	3239300 Ext 2508 - 2509	212	3
165	RECTORIA	CRA. 7 No.40-53	2881960 - 3239300 Ext 2000 - 2006	213	3
166	RED UDNET	CRA. 7 No.40-53		214	3
167	OFICINA DE RELACIONES INTERINSTITUCIONALES	CRA. 7 No.40-53	3239300 Ext 2005	215	3
168	HURTOS	CRA. 7 No.40-53	3239300 EXT 2714	217	3
170	SALA DE PROFESORES	CRA. 7 No.40-53		219	3
171	SECR.ACADEMICA FAC.INGENIERIA	CRA. 7 No.40-53		220	3
172	SECRETARIA GENERAL	CRA. 7 No.40-53	3238333	221	3
173	SEMANA DE INGENIERIA INDUSTRIAL	CRA. 7 No.40-53		222	3
174	SEMANA INGENIO DISEÑO	CRA. 7 No.40-53		223	3
175	OFICINA ASESORA DE CONTROL INTERNO	CRA. 7 No.40-53	3239300 Ext 2805	224	3
176	UNIDAD DE EXTENSION FACULTAD DE INGENIERIA	CRA. 7 No.40-53	3238400 Ext 1711-1712	225	3
177	VICERRECTORIA ACADEMICA	CRA. 7 No.40-53	3239300 Ext 2900 - fax 2901	226	3
178	EVALUACION DOCENTE	CRA. 7 No.40-53		227	3
179	ESPECIALIZACION EN PROYECTOS INFORMATICOS	CRA. 7 No.40-53	3239300 Ext 2408	228	3
180	FEDERACION ESTUDIANTES UNIVERSITARIOS	CRA. 7 No.40-53		229	3
181	GRUPO GITUD	CRA. 7 No.40-53		230	3
182	GRUPO LIFAE	CRA. 7 No.40-53		231	3
183	INTERVENTORIA E.P.S.	CRA. 7 No.40-53		1.054	3
184	CORRESPONDENCIA	CRA. 7 No.40-53	3239300	1.171	3
185	DESARROLLO HUMANO - FACULTAD INGENIERIA	CRA. 7 No.40-53	3239300 Ext 2500	1.181	3
186	DECANATURA INGENIERIA - ASISTENTE	CRA. 7 No.40-53	3239300 Ext 2500	1.182	3
187	ECAES	CRA. 7 No.40-53		2.191	3
188	EDIFICIO Y TERRENO	CRA. 7 No.40-53		2.192	3
189	ANULADA	CRA. 7 No.40-53		9.999	3
190	ADMINISTRACION AMBIENTAL	AV. CIRCUNVALAR VENADO DE ORO		401	4
191	ADMINISTRACION SEDE	AV. CIRCUNVALAR VENADO DE ORO		402	4
192	ALMACEN DE TOPOGRAFIA	AV. CIRCUNVALAR VENADO DE ORO	0	403	4
193	ASISTENTE DECANATURA FACULTAD DEL M/AMBIENTE	AV. CIRCUNVALAR VENADO DE ORO	3376927 - 2841658	404	4
194	AUDIOVISUALES	AV. CIRCUNVALAR VENADO DE ORO		405	4
195	AUDITORIO	AV. CIRCUNVALAR VENADO DE ORO		406	4
196	AULA  POSTGRADO 	AV. CIRCUNVALAR VENADO DE ORO		407	4
197	BIENESTAR UNIVERSITARIO 	AV. CIRCUNVALAR VENADO DE ORO	3376907	410	4
198	BODEGA 	AV. CIRCUNVALAR VENADO DE ORO		411	4
199	CAFETERIA	AV. CIRCUNVALAR VENADO DE ORO		412	4
200	CEDOF	AV. CIRCUNVALAR VENADO DE ORO		413	4
201	CONSULTORIO AMBIENTAL	AV. CIRCUNVALAR VENADO DE ORO		414	4
202	COORDINACION DE LABORATORIOS	AV. CIRCUNVALAR VENADO DE ORO	3376928	415	4
203	CUARTO CELADURIA 	AV. CIRCUNVALAR VENADO DE ORO		416	4
204	CUARTO DE TELECOMUNICACIONES	AV. CIRCUNVALAR VENADO DE ORO		417	4
205	DECANATURA 	AV. CIRCUNVALAR VENADO DE ORO	3376927 - 2841658	418	4
206	DEPOSITO DE REACTIVOS	AV. CIRCUNVALAR VENADO DE ORO		419	4
207	ESPECIALIZACION EN DISEÑO DE VIAS URBANAS	AV. CIRCUNVALAR VENADO DE ORO	3376981 - 2841412	420	4
208	FALTANTES	AV. CIRCUNVALAR VENADO DE ORO		421	4
209	ESPECIALIZACION EN GERENCIA DE RECURSOS NATURALES	AV. CIRCUNVALAR VENADO DE ORO	2841412	422	4
210	TECNOLOGIA EN GESTION AMBIENTAL Y SERVICIOS PUBLICOS	AV. CIRCUNVALAR VENADO DE ORO	3376895	423	4
211	HERBARIO 	AV. CIRCUNVALAR VENADO DE ORO	3376918	424	4
212	PROYECTO CURRICULAR EN INGENIERIA TOPOGRAFICA	AV. CIRCUNVALAR VENADO DE ORO	3376906	425	4
213	INSECTARIO	AV. CIRCUNVALAR VENADO DE ORO		426	4
214	INVERNADERO  	AV. CIRCUNVALAR VENADO DE ORO		427	4
215	LABORATORIO DE BIOLOGIA	AV. CIRCUNVALAR VENADO DE ORO		428	4
216	LABORATORIO DE EXTENSION	AV. CIRCUNVALAR VENADO DE ORO		429	4
217	LABORATORIO DE INVESTIGACION	AV. CIRCUNVALAR VENADO DE ORO		430	4
218	LABORATORIO DE QUIMICA Y CALIDAD DEL AGUA	AV. CIRCUNVALAR VENADO DE ORO	0	431	4
219	LABORATORIO DE SANIDAD - INVESTIGACION	AV. CIRCUNVALAR VENADO DE ORO		432	4
220	LABORATORIO DE SILVICULTURA	AV. CIRCUNVALAR VENADO DE ORO	0	433	4
221	LABORATORIO DE SUELOS 	AV. CIRCUNVALAR VENADO DE ORO	2841574	434	4
222	LABORATORIO DE MICROBIOLOGIA	AV. CIRCUNVALAR VENADO DE ORO		435	4
223	OFICINA ACREDITACION	AV. CIRCUNVALAR VENADO DE ORO		436	4
224	OFICINA DE PROYECTOS	AV. CIRCUNVALAR VENADO DE ORO		437	4
225	PROYECTO CURRICULAR DE INGENIERIA FORESTAL	AV. CIRCUNVALAR VENADO DE ORO	3376894	438	4
226	PROY. INV. COMPETITIVIDAD EN LA IND.AGROALIMENTARIA DE LACTEOS Y FRUTAS EN COLOMBIA	AV. CIRCUNVALAR VENADO DE ORO		439	4
227	ROBO	AV. CIRCUNVALAR VENADO DE ORO		440	4
228	SALA  JUNTAS 	AV. CIRCUNVALAR VENADO DE ORO		441	4
229	SALA ATENCION ESTUDIANTES	AV. CIRCUNVALAR VENADO DE ORO		442	4
230	SALA DE CARTOGRAFIA	AV. CIRCUNVALAR VENADO DE ORO		443	4
231	SALA DE INVESTIGACION	AV. CIRCUNVALAR VENADO DE ORO		444	4
232	SALA DE PROFESORES 	AV. CIRCUNVALAR VENADO DE ORO		445	4
233	SALA DE PROFESORES PRIMER PISO	AV. CIRCUNVALAR VENADO DE ORO		446	4
234	SALA DE PROFESORES SEGUNDO PISO	AV. CIRCUNVALAR VENADO DE ORO		447	4
235	SALA FOTOINTERPRETACION	AV. CIRCUNVALAR VENADO DE ORO		448	4
236	SALA GEOMATICA	AV. CIRCUNVALAR VENADO DE ORO		449	4
237	SALA INTERNET I	AV. CIRCUNVALAR VENADO DE ORO		450	4
238	SALA INTERNET II	AV. CIRCUNVALAR VENADO DE ORO		451	4
239	SALA MULTIPLE 	AV. CIRCUNVALAR VENADO DE ORO		452	4
240	SALUD OCUPACIONAL	AV. CIRCUNVALAR VENADO DE ORO		453	4
241	SECRETARIA ACADEMICA FACULTAD DEL MEDIO AMBIENTE	AV. CIRCUNVALAR VENADO DE ORO	3376715	454	4
242	SERVICIOS GENERALES 	AV. CIRCUNVALAR VENADO DE ORO		455	4
243	SOPORTE Y COMUNICACIONES	AV. CIRCUNVALAR VENADO DE ORO		456	4
244	TALLER DE CARPINTERIA 	AV. CIRCUNVALAR VENADO DE ORO		457	4
245	COORDINACION EN TECNOLOGIA SANEAMIENTO AMBIENTAL	AV. CIRCUNVALAR VENADO DE ORO	3424706	458	4
246	TECNOLOGIA DE MADERAS	AV. CIRCUNVALAR VENADO DE ORO		459	4
247	TECNOLOGIA EN TOPOGRAFIA 	AV. CIRCUNVALAR VENADO DE ORO	3376947	460	4
248	DECANATURA FACULTAD DEL MEDIO AMBIENTE	AV. CIRCUNVALAR VENADO DE ORO	3376927 - 2841658	461	4
249	EDIFICIO Y TERRENO	AV. CIRCUNVALAR VENADO DE ORO		462	4
250	SALA JUNTAS EDIFICIO NUEVO	AV. CIRCUNVALAR VENADO DE ORO		463	4
251	OFICINA POSGRADOS SEGUNDO PISO	AV. CIRCUNVALAR VENADO DE ORO		464	4
252	INGENIERIA AMBIENTAL	AV. CIRCUNVALAR VENADO DE ORO	3376969	465	4
253	SALA DIBUJO	AV. CIRCUNVALAR VENADO DE ORO		466	4
254	SALA PROFESORES ING. TOPOGRAFIA	AV. CIRCUNVALAR VENADO DE ORO		467	4
255	SALA PROFESORES ING. FORESTAL	AV. CIRCUNVALAR VENADO DE ORO		468	4
256	LABORATORIO DE SERVICIOS PUBLICOS	AV. CIRCUNVALAR VENADO DE ORO		469	4
257	ºOK	AV. CIRCUNVALAR VENADO DE ORO		470	4
258	ESPECIALIZACION EN AMBIENTE Y DESARROLLO LOCAL	AV. CIRCUNVALAR VENADO DE ORO	2841412 - 3376981	471	4
259	LABORATORIO DE SANIDAD FORESTAL Y BIOLOGIA	AV. CIRCUNVALAR VENADO DE ORO	3362077	498	4
260	DECANATURA FACULTAD ARTES	CRA.13 No.14-69	2828220 Ext 102 - 110	500	5
261	PROYECTO CURRICULAR ARTES ESCENICAS	CRA.13 No.14-69	3421019	501	5
262	PROYECTO CURRICULAR ARTES PLASTICAS	CRA.13 No.14-69	2821645	502	5
263	PROYECTO CURRICULAR ARTES MUSICALES	CRA.13 No.14-69	2828180	503	5
264	ADMINISTRADOR SEDE	CRA.13 No.14-69		505	5
265	BIENESTAR INSTITUCIONAL	CRA.13 No.14-69		506	5
266	AUDITORIO ALEJANDRO OBREGON	CRA.13 No.14-69		507	5
267	BIBLIOTECA ANTONIO NARIÑO	CRA.13 No.14-69		508	5
268	BODEGA DE INSTRUMENTOS MUSICA	CRA.13 No.14-69		509	5
269	por asignar	CRA.13 No.14-69		510	5
270	BODEGA PROYECTO CURRICULAR  ARTES ESCENICAS	CRA.13 No.14-69	3421019	511	5
271	CAFETERIA ESTUDIANTES	CRA.13 No.14-69		512	5
272	CAFETERIA ASEO INTERNO	CRA.13 No.14-69		513	5
273	AULA DIGITAL	CRA.13 No.14-69		514	5
274	EQUIPO DE URGENCIAS	CRA.13 No.14-69		515	5
275	SALONES DE CLASE ESCENICAS	CRA.13 No.14-69	3421019	516	5
276	OFICINA ADMINISTRATIVOS	CRA.13 No.14-69		517	5
277	OFICINA CENTRO DE INVESTIGACIONES	CRA.13 No.14-69		518	5
278	OFICINA ACREDITACION	CRA.13 No.14-69		519	5
279	OFICINA DE EXTENSION	CRA.13 No.14-69		520	5
280	SECRETARIA ACADEMICA FACULTAD DE ARTES	CRA.13 No.14-69	2828240 Ext 104	521	5
281	RECEPCION	CRA.13 No.14-69		522	5
282	SALA DE PROFESORES	CRA.13 No.14-69		523	5
283	TALLER DE AUDIOVISUALES	CRA.13 No.14-69		524	5
284	TALLER DE CERAMICA	CRA.13 No.14-69		525	5
285	TALLER DE MADERAS	CRA.13 No.14-69		526	5
286	TALLER DE METAL	CRA.13 No.14-69		527	5
287	TALLER DE PAPEL	CRA.13 No.14-69		528	5
288	TALLER DE SERIGRAFIA	CRA.13 No.14-69		529	5
289	TALLER DE VIDRIO	CRA.13 No.14-69		530	5
290	VESTUARIO	CRA.13 No.14-69		531	5
291	VIGILANCIA	CRA.13 No.14-69		532	5
292	COMUNICACIONES	CRA.13 No.14-69		533	5
293	SALONES DE CLASE PLASTICAS	CRA.13 No.14-69		535	5
294	CENTRO DE INFORMATICA MUSICA	CRA.13 No.14-69		536	5
295	PASILLO EXTERIORES	CRA.13 No.14-69		537	5
296	CENTRO DE DOCUMENTACION DE LAS ARTES	CRA.13 No.14-69		538	5
297	UNIDAD EXTENSION FACULTAD	CRA.13 No.14-69		539	5
298	DECANATURA FACULTAD ARTES	CRA.13 No.14-69	2828220 Ext 102 - 110	540	5
299	SALONES DE CLASE MUSICA	CRA.13 No.14-69		541	5
300	TALLER DE GRABADO	CRA.13 No.14-69		542	5
301	TALLER DE MUSICA	CRA.13 No.14-69		543	5
302	COORDINACION DE INVESTIGACION	CRA.13 No.14-69		544	5
303	SALONES SOTANOS ASAB	CRA.13 No.14-69		545	5
304	FALTANTES	CRA.13 No.14-69		547	5
305	EDIFICIOS Y TERRENOS	CRA.13 No.14-69		548	5
306	BIENESTAR UNIVERSITARIO ASAB	CRA.13 No.14-69		3.001	5
307	ADUD	CRA. 8 No.40-78		701	7
308	AUDIOVISUALES	CRA. 8 No.40-78		702	7
309	AUDITORIO	CRA. 8 No.40-78		703	7
310	BIBLIOTECA	CRA. 8 No.40-78		706	7
311	BIENESTAR UNIVERSITARIO	CRA. 8 No.40-78		707	7
312	BODEGA RED UDNET	CRA. 8 No.40-78		708	7
313	LABORATORIO ELECTRONICA	CRA. 8 No.40-78		710	7
314	LABORATORIO OPTOELECTRONICAS	CRA. 8 No.40-78		711	7
315	OFICINA DE EGRESADOS	CRA. 8 No.40-78	3238400 Ext 1730	712	7
316	PROCESAMIENTO DE SEÑALES	CRA. 8 No.40-78		713	7
317	RED UDNET	CRA. 8 No.40-78	3239300 Ext 2202 - 2300	714	7
318	ROBO	CRA. 8 No.40-78		715	7
319	SID	CRA. 8 No.40-78		716	7
320	SINDICATO DE TRABAJADORES	CRA. 8 No.40-78	2882096	717	7
321	OFICINA ASESORA DE SISTEMAS	CRA. 8 No.40-78	3238400 Ext 1111 - 1112	718	7
322	SALA FIG	CRA. 8 No.40-78		719	7
323	RED UDNET - GRUPO DE MANTENIMIENTO	CRA. 8 No.40-78		7.140	7
324	RED UDNET - SALA DE GESTION Y SOPORTE	CRA. 8 No.40-78		7.141	7
325	RED UDNET - CENTRO CABLEADO	CRA. 8 No.40-78		7.142	7
326	RED UDNET - SALON GLOBAL DE SERVIDORES	CRA. 8 No.40-78		7.143	7
327	RED UDNET - CENTRO DE GESTION	CRA. 8 No.40-78		7.144	7
328	RED UDNET - SALON DE COMUNICACIONES	CRA. 8 No.40-78		7.145	7
329	EDIFICIO Y TERRENO	CRA. 8 No.40-78		7.146	7
330	RED UDNET - LABORATORIO DE REDES	CRA. 8 No.40-78		7.147	7
331	FALTANTES	CRA. 8 No.40-78		7.149	7
332	EMISORA LAUD 90.4 FM	CALLE 31 No.6-42 PISO 8	2877157 - 2877147	80	8
333	EDIFICIO Y TERRENO	CALLE 31 No.6-42 PISO 8		81	8
334	FALTANTES	CALLE 31 No.6-42 PISO 8		87	8
335	ACREDITACION INSTITUCIONAL	CALLE 70 B No. 73-35 SUR		901	9
336	ADMINISTRACION	CALLE 70 B No. 73-35 SUR		902	9
337	ASISTENTE DE DECANATURA	CALLE 70 B No. 73-35 SUR	7311526 - 7311527	903	9
338	AUDIOVISUALES	CALLE 70 B No. 73-35 SUR		904	9
339	BIBLIOTECA	CALLE 70 B No. 73-35 SUR		907	9
340	BIENESTAR UNIVERSITARIO	CALLE 70 B No. 73-35 SUR	7311529	908	9
341	CAFETERIA 	CALLE 70 B No. 73-35 SUR	7311546	909	9
342	LABORATORIO DE CIRCUITOS IMPRESOS	CALLE 70 B No. 73-35 SUR		910	9
343	COORDINACION TECNOLOGIA EN ELECTRICIDAD	CALLE 70 B No. 73-35 SUR	7311537 EXT 120	911	9
344	COORDINACION TECNOLOGIA EN ELECTRONICA	CALLE 70 B No. 73-35 SUR	7311537 EXT 122	912	9
345	COORD. TECNOLOGIA INDUSTRIAL	CALLE 70 B No. 73-35 SUR		913	9
346	COORDINACION TECNOLOGIA EN MECANICA	CALLE 70 B No. 73-35 SUR	7311536 EXT 119	914	9
347	COORDINACION TECNOLOGIA EN OBRAS CIVILES	CALLE 70 B No. 73-35 SUR	7311535	915	9
348	COORDINACION TECNOLOGIA EN SISTEMATIZACION DE DATOS	CALLE 70 B No. 73-35 SUR	7311539	916	9
349	DECANATURA FACULTAD TECNOLOGICA	CALLE 70 B No. 73-35 SUR	7311526 - 7311527	917	9
350	FALTANTES	CALLE 70 B No. 73-35 SUR		918	9
351	GIMNASIO	CALLE 70 B No. 73-35 SUR		919	9
352	INSTRUMENTACION VIRTUAL	CALLE 70 B No. 73-35 SUR		920	9
353	INVENTARIOS	CALLE 70 B No. 73-35 SUR		921	9
354	LABORATORIO DE AUTOMATIZACION Y CONTROL	CALLE 70 B No. 73-35 SUR	7311536 ext 126	922	9
355	LABORATORIO DE DISTRIBUCION E INSTALACIONES	CALLE 70 B No. 73-35 SUR		923	9
356	LABORATORIO DE INVESTIGACION	CALLE 70 B No. 73-35 SUR		924	9
357	LABORATORIO DE METODOS Y TIEMPOS	CALLE 70 B No. 73-35 SUR		925	9
358	LABORATORIO DE QUIMICA	CALLE 70 B No. 73-35 SUR		926	9
359	LABORATORIO DE SUELOS	CALLE 70 B No. 73-35 SUR	7311535 ext 111	927	9
360	LABORATORIO DE TOPOGRAFIA	CALLE 70 B No. 73-35 SUR		928	9
361	SALA DE SOFTWARE APLICADO DE ELECTRONICA	CALLE 70 B No. 73-35 SUR		929	9
362	LEVITACION MAGNETICA	CALLE 70 B No. 73-35 SUR		930	9
363	OFICINA COMITE INNOVACION	CALLE 70 B No. 73-35 SUR		931	9
364	OFICINA DE GESTION	CALLE 70 B No. 73-35 SUR		932	9
365	OFICINA SISTEMAS DE INFORMATICA	CALLE 70 B No. 73-35 SUR		933	9
366	REVISTA TECNURA	CALLE 70 B No. 73-35 SUR	7311536 ext 126	934	9
367	ROBO	CALLE 70 B No. 73-35 SUR		935	9
368	ROBO CON DENUNCIO	CALLE 70 B No. 73-35 SUR		936	9
369	SALA DE INFORMATICA	CALLE 70 B No. 73-35 SUR	7311539 ext 112	937	9
370	SALA DE JUNTAS	CALLE 70 B No. 73-35 SUR		938	9
371	SALA PROFESORES	CALLE 70 B No. 73-35 SUR	7311534	939	9
372	SALA PROFESORES MECANICA	CALLE 70 B No. 73-35 SUR		940	9
373	SECRETARIA ACADEMICA FACULTAD TECNOLOGICA	CALLE 70 B No. 73-35 SUR	7311529	941	9
374	SERVICIOS GENERALES 	CALLE 70 B No. 73-35 SUR		942	9
375	SUMINISTROS	CALLE 70 B No. 73-35 SUR		943	9
376	TALLER DE MECANICA	CALLE 70 B No. 73-35 SUR	7311536 ext 130	944	9
377	TALLER DE ELECTRICIDAD	CALLE 70 B No. 73-35 SUR		945	9
378	TALLER DE INSTRUMENTACION	CALLE 70 B No. 73-35 SUR		946	9
379	TALLER DE FISICA	CALLE 70 B No. 73-35 SUR		947	9
380	TALLER INDUSTRIAL	CALLE 70 B No. 73-35 SUR		948	9
381	TEATRO	CALLE 70 B No. 73-35 SUR	7311526 ext 102	949	9
382	UNIDAD DE EXTENSION FACULTAD TECNOLOGICA	CALLE 70 B No. 73-35 SUR	7311530 - 7311528	950	9
383	COORDINACION SOFTWARE	CALLE 70 B No. 73-35 SUR		951	9
384	LABORATORIO DE RESISTENCIA DE MATERIALES	CALLE 70 B No. 73-35 SUR		952	9
385	TALLER DE SOLDADURA	CALLE 70 B No. 73-35 SUR		953	9
386	LABORATORIO DE METALOGRAFIA	CALLE 70 B No. 73-35 SUR		954	9
387	EDIFICIO Y TERRENO	CALLE 70 B No. 73-35 SUR		955	9
388	REVISTA TEKNE	CALLE 70 B No. 73-35 SUR		956	9
389	TECNOLOGIA INDUSTRIAL	CALLE 70 B No. 73-35 SUR	7311535	957	9
390	GRUPO DE INVESTIGACION ORCA	CALLE 70 B No. 73-35 SUR		958	9
391	AUDITORIO	CALLE 70 B No. 73-35 SUR		959	9
392	ADMINISTRACION DE LA SEDE	CALLE 38 No.15-31		1.042	10
393	AJUBILUD	CALLE 38 No.15-31		1.044	10
394	ASOPENUD	CALLE 38 No.15-31	3230916 - 4009433	1.045	10
395	AUDITORIA	CALLE 38 No.15-31		1.046	10
396	DAMA	CALLE 38 No.15-31		1.049	10
397	FALTANTES	CALLE 38 No.15-31		1.051	10
398	FONDO EMPLEADOS	CALLE 38 No.15-31		1.052	10
399	ROBO	CALLE 38 No.15-31		1.057	10
400	ADMINISTRADOR CEAD	CALLE 34 No.13-15		1.201	13
401	ADMINISTRADOR SEDE	CALLE 34 No.13-15		1.301	13
402	CAFETERIA	CALLE 34 No.13-15		1.304	13
403	CENTRO DE RECURSOS	CALLE 34 No.13-15		1.305	13
404	COORD. AULAS INFORMATICA	CALLE 34 No.13-15		1.306	13
405	FUNDAC.MANUEL GAONA	CALLE 34 No.13-15		1.310	13
406	ROBO	CALLE 34 No.13-15		1.317	13
407	SALA DE JUNTAS	CALLE 34 No.13-15		1.318	13
408	OFICINA ACREDITACION	CALLE 34 No.13-15		1.320	13
409	EDIFICIO Y TERRENO	CALLE 34 No.13-15		1.321	13
410	BIENESTAR UNIVERSITARIO	CALLE 34 No.13-15		1.325	13
411	ADMINISTRACION DEPORTIVA	CALLE 34 No.13-15	3200771	3.000	13
412	EDIFICIO Y TERRENO	CALLE 34 No.13-15		3.002	13
413	FALTANTES	CALLE 34 No.13-15		3.007	13
414	SALA DE VIDEO CONFERENCIA	CRA. 40 No. 8-78		232	14
415	IDEXUD	DIAGONAL 57 No 27-21	2102831	1.053	15
416	OFICINA DE PUBLICACIONES	DIAGONAL 57 No 27-21	3491512	1.055	15
417	ADMINISTRADOR CAMPIN	DIAGONAL 57 No 27-21		1.300	15
418	EDIFICIO Y TERRENO	DIAGONAL 57 No 27-21		1.659	15
419	FALTANTES	DIAGONAL 57 No 27-21		3.008	15
420	ACADEMIA LUIS A. CALVO	CRA. 9 No 52-52	2486403 - 2492780	504	16
421	SOTANOS AV. JIMENEZ	AV JIMENEZ CRA  7ª		534	17
422	INSTITUTO DE ESTIDIOS E INVESTIGACIONES EDUCATIVAS	AV. CIUDAD DE QUITO # 64-81	3238400 Ext 6331 - 6333	39	20
423	LICENCIAT.EDUC.BASICA ENFASIS EN MATEMATICAS	AV. CIUDAD DE QUITO # 64-81	3238400 Ext 6340 - 6341	54	20
424	MAESTRIA EN LINGUISTICA APLICADA A LA ENSEÑANZA DEL INGLES	AV. CIUDAD DE QUITO # 64-81	3238400 Ext 6362 - 6363	70	20
425	DOCTORADO INTERINSTITUCIONAL EN EDUCACION	AV. CIUDAD DE QUITO # 64-81	3238400 Ext 6330-6334	1.303	20
426	ESPECIALIZACION EN DESARROLLO HUMANO	AV. CIUDAD DE QUITO # 64-81	3238400 Ext 6355, 6354	1.307	20
427	ESPECIALIZACION EN EDUCACION EN TECNOLOGIA	AV. CIUDAD DE QUITO # 64-81	3238400 Ext 6357 - 6356	1.308	20
428	FALTANTES	AV. CIUDAD DE QUITO # 64-81		1.309	20
429	ESPECIALIZACION EN GERENCIA PROYECTOS	AV. CIUDAD DE QUITO # 64-81		1.311	20
430	ESPECIALIZACION LENGUAJE Y PEDAGOGIA DE PROYECTOS	AV. CIUDAD DE QUITO # 64-81	3238400 Ext 6360 - 6361	1.312	20
431	ESPEC.PEDAGOGIA DE LA COMUNICACION Y MEDIOS INTERACTIVOS	AV. CIUDAD DE QUITO # 64-81	3238400 Ext 6366 - 6367	1.313	20
432	ESPECIALIZACION EN EDUCACION MATEMATICA	AV. CIUDAD DE QUITO # 64-81	3238400 Ext 6365 - 6364	1.315	20
433	POSTGRADO EN LINGÜÍSTICA	AV. CIUDAD DE QUITO # 64-81		1.316	20
434	GRUPO MESCUD	AV. CIUDAD DE QUITO # 64-81		1.319	20
435	BIENESTAR UNIVERSITARIO CALLE 64	AV. CIUDAD DE QUITO # 64-81		1.322	20
436	BIBLIOTECA	AV. CIUDAD DE QUITO # 64-81		1.324	20
437	PROVISONAL	calle 7 no 40	2714	1	21
\.


--
-- Name: dependencia_id_dependencia_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('dependencia_id_dependencia_seq', 1, false);


--
-- Data for Name: destino_orden; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY destino_orden (id_destino, descripcion) FROM stdin;
2	Dependencia
1	Almacén
\.


--
-- Name: destino_orden_id_destino_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('destino_orden_id_destino_seq', 2, true);


--
-- Data for Name: donacion_entrada; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY donacion_entrada (id_donacion, ruta_acto, nombre_acto) FROM stdin;
1	http://localhost/administrativa/arka/blocks/inventarios/gestionEntradas/registrarEntradas/actas/753850_Untitled 1.ods	Untitled 1.ods
2	http://localhost/administrativa/arka/blocks/inventarios/gestionEntradas/registrarEntradas/actas/0eda9d_kyron_docencia.backup	kyron_docencia.backup
3	http://localhost/administrativa/arka/blocks/inventarios/gestionEntradas/registrarEntradas/actas/f34d4f_Estilo.php	Estilo.php
4	http://localhost/administrativa/arka/blocks/inventarios/gestionEntradas/registrarEntradas/actas/f2cce9_Prueba Votaciones Stiv.xlsx	Prueba Votaciones Stiv.xlsx
\.


--
-- Name: donacion_entrada_id_donacion_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('donacion_entrada_id_donacion_seq', 4, true);


--
-- Data for Name: elemento; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY elemento (id_elemento, fecha_registro, nivel, tipo_bien, descripcion, cantidad, unidad, valor, iva, ajuste, bodega, subtotal_sin_iva, total_iva, total_iva_con, tipo_poliza, fecha_inicio_pol, fecha_final_pol, marca, serie, id_entrada, estado) FROM stdin;
124	2015-03-20	1	2	qweqweqwe	1	213213	12312123	3	123123	3	12312	615606.150000000023	12927729.1500000004	0	0001-01-01	0001-01-01	123123	12321	6	t
125	2015-04-02	4	3	ninguna	1	123123	123	4	123	2	123	4.91999999999999993	127.920000000000002	1	0001-01-01	0001-01-01	Sony	qweqwe	6	t
126	2015-04-02	4	3	ninguna	1	123123	123	4	123	2	123	4.91999999999999993	127.920000000000002	1	0001-01-01	0001-01-01	Sony	qweqwe	6	t
127	2015-04-02	4	3	ninguna	1	123123	123	4	123	2	123	4.91999999999999993	127.920000000000002	1	0001-01-01	0001-01-01	Sony	qweqwe	6	t
128	2015-04-02	4	3	ninguna	1	123123	123	4	123	2	123	4.91999999999999993	127.920000000000002	1	0001-01-01	0001-01-01	Sony	qweqwe	6	t
129	2015-04-02	4	3	ninguna	1	123123	123	4	123	2	123	4.91999999999999993	127.920000000000002	1	0001-01-01	0001-01-01	Sony	qweqwe	6	t
130	2015-04-02	4	3	ninguna	1	123123	123	4	123	2	123	4.91999999999999993	127.920000000000002	1	0001-01-01	0001-01-01	Sony	qweqwe	6	t
131	2015-04-02	4	3	ninguna	1	123123	123	4	123	2	123	4.91999999999999993	127.920000000000002	1	0001-01-01	0001-01-01	Sony	qweqwe	6	t
132	2015-04-02	4	3	ninguna	1	123123	123	4	123	2	123	4.91999999999999993	127.920000000000002	1	0001-01-01	0001-01-01	Sony	qweqwe	6	t
133	2015-04-02	4	3	ninguna	1	123123	123	4	123	2	123	4.91999999999999993	127.920000000000002	1	0001-01-01	0001-01-01	Sony	qweqwe	6	t
134	2015-04-02	4	3	ninguna	1	123123	123	4	123	2	123	4.91999999999999993	127.920000000000002	1	0001-01-01	0001-01-01	Sony	qweqwe	6	t
135	2015-04-02	4	3	ninguna	1	123123	123	4	123	2	123	4.91999999999999993	127.920000000000002	1	0001-01-01	0001-01-01	Sony	qweqwe	6	t
136	2015-04-02	1	1	21213	11	123	123123	2	123	2	1354353	0	1354353	0	0001-01-01	0001-01-01	213	213	6	t
137	2015-04-02	1	1	21213	11	123	123123	2	123	2	1354353	0	1354353	0	0001-01-01	0001-01-01	213	213	6	t
138	2015-04-02	4	3	3123123	1	123	123	2	123	2	123	0	123	1	0001-01-01	0001-01-01	12312	123123	6	t
139	2015-04-03	4	1	123123	5	123	123	2	123	2	615	0	615	0	0001-01-01	0001-01-01	123123	123123	6	t
140	2015-04-03	4	1	123123	5	123	123	2	123	2	615	0	615	0	0001-01-01	0001-01-01	123123	123123	6	t
141	2015-04-03	4	1	123123	5	123	123	2	123	2	615	0	615	0	0001-01-01	0001-01-01	123123	123123	6	t
142	2015-04-03	4	1	123123	5	123	123	2	123	2	615	0	615	0	0001-01-01	0001-01-01	123123	123123	6	t
143	2015-04-03	4	1	123123	5	123	123	2	123	2	615	0	615	0	0001-01-01	0001-01-01	123123	123123	6	t
144	2015-04-03	5	1	123123	1	312	123	3	123	3	123	6.15000000000000036	129.150000000000006	0	0001-01-01	0001-01-01	SOny	123123	6	t
145	2015-04-03	3	1	wer	123	123	123	2	123	3	15129	0	15129	0	0001-01-01	0001-01-01	wer	wer	6	t
146	2015-04-03	3	1	wer	123	123	123	2	123	3	15129	0	15129	0	0001-01-01	0001-01-01	wer	wer	6	t
147	2015-04-03	3	1	wer	123	123	123	2	123	3	15129	0	15129	0	0001-01-01	0001-01-01	wer	wer	6	t
148	2015-04-03	2	1	234	234	234	234	2	234	1	54756	0	54756	0	0001-01-01	0001-01-01	234234	234	6	t
149	2015-04-03	2	1	234	234	234	234	2	234	1	54756	0	54756	0	0001-01-01	0001-01-01	234234	234	6	t
150	2015-04-03	2	1	234	234	234	234	2	234	1	54756	0	54756	0	0001-01-01	0001-01-01	234234	234	6	t
151	2015-04-03	2	1	234	234	234	234	2	234	1	54756	0	54756	0	0001-01-01	0001-01-01	234234	234	6	t
152	2015-04-03	3	3	234234	1	234	234	3	234	1	234	11.7000000000000011	245.699999999999989	1	0001-01-01	0001-01-01	234	234	6	t
153	2015-04-03	5	3	234234	1	234	234	3	234	1	234	11.7000000000000011	245.699999999999989	1	0001-01-01	0001-01-01	234	234	6	t
154	2015-04-03	4	3	123	1	123	123	3	123	2	123	6.15000000000000036	129.150000000000006	1	0001-01-01	0001-01-01	qwe	123	6	t
155	2015-04-03	4	3	123	1	123	123	3	123	2	123	6.15000000000000036	129.150000000000006	1	0001-01-01	0001-01-01	qwe	123	6	t
156	2015-04-03	4	3	123	1	123	123	3	123	2	123	6.15000000000000036	129.150000000000006	1	0001-01-01	0001-01-01	qwe	123	6	t
157	2015-04-03	4	3	123	1	123	123	3	123	2	123	6.15000000000000036	129.150000000000006	1	0001-01-01	0001-01-01	qwe	123	6	t
158	2015-04-03	4	3	123	1	123	123	3	123	2	123	6.15000000000000036	129.150000000000006	1	0001-01-01	0001-01-01	qwe	123	6	t
159	2015-04-03	4	3	123	1	123	123	3	123	2	123	6.15000000000000036	129.150000000000006	1	0001-01-01	0001-01-01	qwe	123	6	t
160	2015-04-03	4	3	123	1	123	123	3	123	2	123	6.15000000000000036	129.150000000000006	1	0001-01-01	0001-01-01	qwe	123	6	t
161	2015-04-03	4	3	123	1	123	123	3	123	2	123	6.15000000000000036	129.150000000000006	1	0001-01-01	0001-01-01	qwe	123	6	t
162	2015-04-03	4	3	123	1	123	123	3	123	2	123	6.15000000000000036	129.150000000000006	1	0001-01-01	0001-01-01	qwe	123	6	t
163	2015-04-03	4	3	123	1	123	123	3	123	2	123	6.15000000000000036	129.150000000000006	1	0001-01-01	0001-01-01	qwe	123	6	t
164	2015-04-03	4	3	123	1	123	123	3	123	2	123	6.15000000000000036	129.150000000000006	1	0001-01-01	0001-01-01	qwe	123	6	t
165	2015-04-03	4	3	123	1	123	123	3	123	2	123	6.15000000000000036	129.150000000000006	1	0001-01-01	0001-01-01	qwe	123	6	t
166	2015-04-03	4	3	123	1	123	123	3	123	2	123	6.15000000000000036	129.150000000000006	1	0001-01-01	0001-01-01	qwe	123	6	t
167	2015-04-03	3	1	123	12	123	123	2	123	1	1476	0	1476	0	0001-01-01	0001-01-01	123	123	6	t
168	2015-04-03	4	2	234	1	234	234	4	234	2	234	9.35999999999999943	243.360000000000014	0	0001-01-01	0001-01-01	234	234	6	t
169	2015-04-03	7	3	123	1	123	123	4	123	3	123	4.91999999999999993	127.920000000000002	1	0001-01-01	0001-01-01	w123	123	6	t
170	2015-04-03	7	3	123	1	123	123	4	123	3	123	4.91999999999999993	127.920000000000002	1	0001-01-01	0001-01-01	w123	123	6	f
\.


--
-- Data for Name: elemento_anulado; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY elemento_anulado (id_elemento_anulado, id_elemento, observacion) FROM stdin;
1	50	ewqewqwe
2	50	ewqewqwe
3	49	AOskaposdpoaskdasd
4	170	ninguna\r\n
\.


--
-- Name: elemento_anulado_id_elemento_anulado_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('elemento_anulado_id_elemento_anulado_seq', 4, true);


--
-- Name: elemento_id_elemento_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('elemento_id_elemento_seq', 170, true);


--
-- Data for Name: elemento_individual; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY elemento_individual (id_elemento_ind, fecha_registro, placa, serie, id_elemento_gen, estado_elemento, id_salida, estado_registro, observaciones_traslados) FROM stdin;
255	2015-03-20	2015032000000	12321	124	2	40	t	\N
256	2015-04-02	2015040200000	qweqwe	131	\N	\N	t	\N
257	2015-04-02	2015040200000	213	137	\N	\N	t	\N
258	2015-04-02	2015040200001	213	137	\N	\N	t	\N
259	2015-04-02	2015040200002	213	137	\N	\N	t	\N
260	2015-04-02	2015040200003	213	137	\N	\N	t	\N
261	2015-04-02	2015040200004	213	137	\N	\N	t	\N
262	2015-04-02	2015040200005	213	137	\N	\N	t	\N
263	2015-04-02	2015040200006	213	137	\N	\N	t	\N
264	2015-04-02	2015040200007	213	137	\N	\N	t	\N
265	2015-04-02	2015040200008	213	137	\N	\N	t	\N
266	2015-04-02	2015040200009	213	137	\N	\N	t	\N
267	2015-04-02	2015040200010	213	137	\N	\N	t	\N
268	2015-04-03	2015040300000	123123	139	\N	\N	t	\N
269	2015-04-03	2015040300001	123123	139	\N	\N	t	\N
270	2015-04-03	2015040300002	123123	139	\N	\N	t	\N
271	2015-04-03	2015040300003	123123	139	\N	\N	t	\N
272	2015-04-03	2015040300004	123123	139	\N	\N	t	\N
273	2015-04-03	2015040300005	123123	143	\N	\N	t	\N
274	2015-04-03	2015040300006	123123	143	\N	\N	t	\N
275	2015-04-03	2015040300007	123123	143	\N	\N	t	\N
276	2015-04-03	2015040300008	123123	143	\N	\N	t	\N
277	2015-04-03	2015040300009	wer	145	\N	\N	t	\N
278	2015-04-03	2015040300010	wer	145	\N	\N	t	\N
279	2015-04-03	2015040300011	wer	145	\N	\N	t	\N
280	2015-04-03	2015040300012	wer	145	\N	\N	t	\N
281	2015-04-03	2015040300013	wer	145	\N	\N	t	\N
282	2015-04-03	2015040300014	wer	145	\N	\N	t	\N
283	2015-04-03	2015040300015	wer	145	\N	\N	t	\N
284	2015-04-03	2015040300016	wer	145	\N	\N	t	\N
285	2015-04-03	2015040300017	wer	145	\N	\N	t	\N
286	2015-04-03	2015040300018	wer	145	\N	\N	t	\N
287	2015-04-03	2015040300019	wer	145	\N	\N	t	\N
288	2015-04-03	2015040300020	wer	145	\N	\N	t	\N
289	2015-04-03	2015040300021	wer	145	\N	\N	t	\N
290	2015-04-03	2015040300022	wer	145	\N	\N	t	\N
291	2015-04-03	2015040300023	wer	145	\N	\N	t	\N
292	2015-04-03	2015040300024	wer	145	\N	\N	t	\N
293	2015-04-03	2015040300025	wer	145	\N	\N	t	\N
294	2015-04-03	2015040300026	wer	145	\N	\N	t	\N
295	2015-04-03	2015040300027	wer	145	\N	\N	t	\N
296	2015-04-03	2015040300028	wer	145	\N	\N	t	\N
297	2015-04-03	2015040300029	wer	145	\N	\N	t	\N
298	2015-04-03	2015040300030	wer	145	\N	\N	t	\N
299	2015-04-03	2015040300031	wer	145	\N	\N	t	\N
300	2015-04-03	2015040300032	wer	145	\N	\N	t	\N
301	2015-04-03	2015040300033	wer	145	\N	\N	t	\N
302	2015-04-03	2015040300034	wer	145	\N	\N	t	\N
303	2015-04-03	2015040300035	wer	145	\N	\N	t	\N
304	2015-04-03	2015040300036	wer	145	\N	\N	t	\N
305	2015-04-03	2015040300037	wer	145	\N	\N	t	\N
306	2015-04-03	2015040300038	wer	145	\N	\N	t	\N
307	2015-04-03	2015040300039	wer	145	\N	\N	t	\N
308	2015-04-03	2015040300040	wer	145	\N	\N	t	\N
309	2015-04-03	2015040300041	wer	145	\N	\N	t	\N
310	2015-04-03	2015040300042	wer	145	\N	\N	t	\N
311	2015-04-03	2015040300043	wer	145	\N	\N	t	\N
312	2015-04-03	2015040300044	wer	145	\N	\N	t	\N
313	2015-04-03	2015040300045	wer	145	\N	\N	t	\N
314	2015-04-03	2015040300046	wer	145	\N	\N	t	\N
315	2015-04-03	2015040300047	wer	145	\N	\N	t	\N
316	2015-04-03	2015040300048	wer	145	\N	\N	t	\N
317	2015-04-03	2015040300049	wer	145	\N	\N	t	\N
318	2015-04-03	2015040300050	wer	145	\N	\N	t	\N
319	2015-04-03	2015040300051	wer	145	\N	\N	t	\N
320	2015-04-03	2015040300052	wer	145	\N	\N	t	\N
321	2015-04-03	2015040300053	wer	145	\N	\N	t	\N
322	2015-04-03	2015040300054	wer	145	\N	\N	t	\N
323	2015-04-03	2015040300055	wer	145	\N	\N	t	\N
324	2015-04-03	2015040300056	wer	145	\N	\N	t	\N
325	2015-04-03	2015040300057	wer	145	\N	\N	t	\N
326	2015-04-03	2015040300058	wer	145	\N	\N	t	\N
327	2015-04-03	2015040300059	wer	145	\N	\N	t	\N
328	2015-04-03	2015040300060	wer	145	\N	\N	t	\N
329	2015-04-03	2015040300061	wer	145	\N	\N	t	\N
330	2015-04-03	2015040300062	wer	145	\N	\N	t	\N
331	2015-04-03	2015040300063	wer	145	\N	\N	t	\N
332	2015-04-03	2015040300064	wer	145	\N	\N	t	\N
333	2015-04-03	2015040300065	wer	145	\N	\N	t	\N
334	2015-04-03	2015040300066	wer	145	\N	\N	t	\N
335	2015-04-03	2015040300067	wer	145	\N	\N	t	\N
336	2015-04-03	2015040300068	wer	145	\N	\N	t	\N
337	2015-04-03	2015040300069	wer	145	\N	\N	t	\N
338	2015-04-03	2015040300070	wer	145	\N	\N	t	\N
339	2015-04-03	2015040300071	wer	145	\N	\N	t	\N
340	2015-04-03	2015040300072	wer	145	\N	\N	t	\N
341	2015-04-03	2015040300073	wer	145	\N	\N	t	\N
342	2015-04-03	2015040300074	wer	145	\N	\N	t	\N
343	2015-04-03	2015040300075	wer	145	\N	\N	t	\N
344	2015-04-03	2015040300076	wer	145	\N	\N	t	\N
345	2015-04-03	2015040300077	wer	145	\N	\N	t	\N
346	2015-04-03	2015040300078	wer	145	\N	\N	t	\N
347	2015-04-03	2015040300079	wer	145	\N	\N	t	\N
348	2015-04-03	2015040300080	wer	145	\N	\N	t	\N
349	2015-04-03	2015040300081	wer	145	\N	\N	t	\N
350	2015-04-03	2015040300082	wer	145	\N	\N	t	\N
351	2015-04-03	2015040300083	wer	145	\N	\N	t	\N
352	2015-04-03	2015040300084	wer	145	\N	\N	t	\N
353	2015-04-03	2015040300085	wer	145	\N	\N	t	\N
354	2015-04-03	2015040300086	wer	145	\N	\N	t	\N
355	2015-04-03	2015040300087	wer	145	\N	\N	t	\N
356	2015-04-03	2015040300088	wer	145	\N	\N	t	\N
357	2015-04-03	2015040300089	wer	145	\N	\N	t	\N
358	2015-04-03	2015040300090	wer	145	\N	\N	t	\N
359	2015-04-03	2015040300091	wer	145	\N	\N	t	\N
360	2015-04-03	2015040300092	wer	145	\N	\N	t	\N
361	2015-04-03	2015040300093	wer	145	\N	\N	t	\N
362	2015-04-03	2015040300094	wer	145	\N	\N	t	\N
363	2015-04-03	2015040300095	wer	145	\N	\N	t	\N
364	2015-04-03	2015040300096	wer	145	\N	\N	t	\N
365	2015-04-03	2015040300097	wer	145	\N	\N	t	\N
366	2015-04-03	2015040300098	wer	145	\N	\N	t	\N
367	2015-04-03	2015040300099	wer	145	\N	\N	t	\N
368	2015-04-03	2015040300100	wer	145	\N	\N	t	\N
369	2015-04-03	2015040300101	wer	145	\N	\N	t	\N
370	2015-04-03	2015040300102	wer	145	\N	\N	t	\N
371	2015-04-03	2015040300103	wer	145	\N	\N	t	\N
372	2015-04-03	2015040300104	wer	145	\N	\N	t	\N
373	2015-04-03	2015040300105	wer	145	\N	\N	t	\N
374	2015-04-03	2015040300106	wer	145	\N	\N	t	\N
375	2015-04-03	2015040300107	wer	145	\N	\N	t	\N
376	2015-04-03	2015040300108	wer	145	\N	\N	t	\N
377	2015-04-03	2015040300109	wer	145	\N	\N	t	\N
378	2015-04-03	2015040300110	wer	145	\N	\N	t	\N
379	2015-04-03	2015040300111	wer	145	\N	\N	t	\N
380	2015-04-03	2015040300112	wer	145	\N	\N	t	\N
381	2015-04-03	2015040300113	wer	145	\N	\N	t	\N
382	2015-04-03	2015040300114	wer	145	\N	\N	t	\N
383	2015-04-03	2015040300115	wer	145	\N	\N	t	\N
384	2015-04-03	2015040300116	wer	145	\N	\N	t	\N
385	2015-04-03	2015040300117	wer	145	\N	\N	t	\N
386	2015-04-03	2015040300118	wer	145	\N	\N	t	\N
387	2015-04-03	2015040300119	wer	145	\N	\N	t	\N
388	2015-04-03	2015040300120	wer	145	\N	\N	t	\N
389	2015-04-03	2015040300121	wer	145	\N	\N	t	\N
390	2015-04-03	2015040300122	wer	145	\N	\N	t	\N
391	2015-04-03	2015040300123	wer	145	\N	\N	t	\N
392	2015-04-03	2015040300124	wer	145	\N	\N	t	\N
393	2015-04-03	2015040300125	wer	145	\N	\N	t	\N
394	2015-04-03	2015040300126	wer	145	\N	\N	t	\N
395	2015-04-03	2015040300127	wer	145	\N	\N	t	\N
396	2015-04-03	2015040300128	wer	145	\N	\N	t	\N
397	2015-04-03	2015040300129	wer	145	\N	\N	t	\N
398	2015-04-03	2015040300130	wer	145	\N	\N	t	\N
399	2015-04-03	2015040300131	wer	146	\N	\N	t	\N
400	2015-04-03	2015040300132	wer	146	\N	\N	t	\N
401	2015-04-03	2015040300133	wer	146	\N	\N	t	\N
402	2015-04-03	2015040300134	wer	146	\N	\N	t	\N
403	2015-04-03	2015040300135	wer	146	\N	\N	t	\N
404	2015-04-03	2015040300136	wer	146	\N	\N	t	\N
405	2015-04-03	2015040300137	wer	146	\N	\N	t	\N
406	2015-04-03	2015040300138	wer	146	\N	\N	t	\N
407	2015-04-03	2015040300139	wer	146	\N	\N	t	\N
408	2015-04-03	2015040300140	wer	146	\N	\N	t	\N
409	2015-04-03	2015040300141	wer	146	\N	\N	t	\N
410	2015-04-03	2015040300142	wer	146	\N	\N	t	\N
411	2015-04-03	2015040300143	wer	146	\N	\N	t	\N
412	2015-04-03	2015040300144	wer	146	\N	\N	t	\N
413	2015-04-03	2015040300145	wer	146	\N	\N	t	\N
414	2015-04-03	2015040300146	wer	146	\N	\N	t	\N
415	2015-04-03	2015040300147	wer	146	\N	\N	t	\N
416	2015-04-03	2015040300148	wer	146	\N	\N	t	\N
417	2015-04-03	2015040300149	wer	146	\N	\N	t	\N
418	2015-04-03	2015040300150	wer	146	\N	\N	t	\N
419	2015-04-03	2015040300151	wer	146	\N	\N	t	\N
420	2015-04-03	2015040300152	wer	146	\N	\N	t	\N
421	2015-04-03	2015040300153	wer	146	\N	\N	t	\N
422	2015-04-03	2015040300154	wer	146	\N	\N	t	\N
423	2015-04-03	2015040300155	wer	146	\N	\N	t	\N
424	2015-04-03	2015040300156	wer	146	\N	\N	t	\N
425	2015-04-03	2015040300157	wer	146	\N	\N	t	\N
426	2015-04-03	2015040300158	wer	146	\N	\N	t	\N
427	2015-04-03	2015040300159	wer	146	\N	\N	t	\N
428	2015-04-03	2015040300160	wer	146	\N	\N	t	\N
429	2015-04-03	2015040300161	wer	146	\N	\N	t	\N
430	2015-04-03	2015040300162	wer	146	\N	\N	t	\N
431	2015-04-03	2015040300163	wer	146	\N	\N	t	\N
432	2015-04-03	2015040300164	wer	146	\N	\N	t	\N
433	2015-04-03	2015040300165	wer	146	\N	\N	t	\N
434	2015-04-03	2015040300166	wer	146	\N	\N	t	\N
435	2015-04-03	2015040300167	wer	146	\N	\N	t	\N
436	2015-04-03	2015040300168	wer	146	\N	\N	t	\N
437	2015-04-03	2015040300169	wer	146	\N	\N	t	\N
438	2015-04-03	2015040300170	wer	146	\N	\N	t	\N
439	2015-04-03	2015040300171	wer	146	\N	\N	t	\N
440	2015-04-03	2015040300172	wer	146	\N	\N	t	\N
441	2015-04-03	2015040300173	wer	146	\N	\N	t	\N
442	2015-04-03	2015040300174	wer	146	\N	\N	t	\N
443	2015-04-03	2015040300175	wer	146	\N	\N	t	\N
444	2015-04-03	2015040300176	wer	146	\N	\N	t	\N
445	2015-04-03	2015040300177	wer	146	\N	\N	t	\N
446	2015-04-03	2015040300178	wer	146	\N	\N	t	\N
447	2015-04-03	2015040300179	wer	146	\N	\N	t	\N
448	2015-04-03	2015040300180	wer	146	\N	\N	t	\N
449	2015-04-03	2015040300181	wer	146	\N	\N	t	\N
450	2015-04-03	2015040300182	wer	146	\N	\N	t	\N
451	2015-04-03	2015040300183	wer	146	\N	\N	t	\N
452	2015-04-03	2015040300184	wer	146	\N	\N	t	\N
453	2015-04-03	2015040300185	wer	146	\N	\N	t	\N
454	2015-04-03	2015040300186	wer	146	\N	\N	t	\N
455	2015-04-03	2015040300187	wer	146	\N	\N	t	\N
456	2015-04-03	2015040300188	wer	146	\N	\N	t	\N
457	2015-04-03	2015040300189	wer	146	\N	\N	t	\N
458	2015-04-03	2015040300190	wer	146	\N	\N	t	\N
459	2015-04-03	2015040300191	wer	146	\N	\N	t	\N
460	2015-04-03	2015040300192	wer	146	\N	\N	t	\N
461	2015-04-03	2015040300193	wer	146	\N	\N	t	\N
462	2015-04-03	2015040300194	wer	146	\N	\N	t	\N
463	2015-04-03	2015040300195	wer	146	\N	\N	t	\N
464	2015-04-03	2015040300196	wer	146	\N	\N	t	\N
465	2015-04-03	2015040300197	wer	146	\N	\N	t	\N
466	2015-04-03	2015040300198	wer	146	\N	\N	t	\N
467	2015-04-03	2015040300199	wer	146	\N	\N	t	\N
468	2015-04-03	2015040300200	wer	146	\N	\N	t	\N
469	2015-04-03	2015040300201	wer	146	\N	\N	t	\N
470	2015-04-03	2015040300202	wer	146	\N	\N	t	\N
471	2015-04-03	2015040300203	wer	146	\N	\N	t	\N
472	2015-04-03	2015040300204	wer	146	\N	\N	t	\N
473	2015-04-03	2015040300205	wer	146	\N	\N	t	\N
474	2015-04-03	2015040300206	wer	146	\N	\N	t	\N
475	2015-04-03	2015040300207	wer	146	\N	\N	t	\N
476	2015-04-03	2015040300208	wer	146	\N	\N	t	\N
477	2015-04-03	2015040300209	wer	146	\N	\N	t	\N
478	2015-04-03	2015040300210	wer	146	\N	\N	t	\N
479	2015-04-03	2015040300211	wer	146	\N	\N	t	\N
480	2015-04-03	2015040300212	wer	146	\N	\N	t	\N
481	2015-04-03	2015040300213	wer	146	\N	\N	t	\N
482	2015-04-03	2015040300214	wer	146	\N	\N	t	\N
483	2015-04-03	2015040300215	wer	146	\N	\N	t	\N
484	2015-04-03	2015040300216	wer	146	\N	\N	t	\N
485	2015-04-03	2015040300217	wer	146	\N	\N	t	\N
486	2015-04-03	2015040300218	wer	146	\N	\N	t	\N
487	2015-04-03	2015040300219	wer	146	\N	\N	t	\N
488	2015-04-03	2015040300220	wer	146	\N	\N	t	\N
489	2015-04-03	2015040300221	wer	146	\N	\N	t	\N
490	2015-04-03	2015040300222	wer	146	\N	\N	t	\N
491	2015-04-03	2015040300223	wer	146	\N	\N	t	\N
492	2015-04-03	2015040300224	wer	146	\N	\N	t	\N
493	2015-04-03	2015040300225	wer	146	\N	\N	t	\N
494	2015-04-03	2015040300226	wer	146	\N	\N	t	\N
495	2015-04-03	2015040300227	wer	146	\N	\N	t	\N
496	2015-04-03	2015040300228	wer	146	\N	\N	t	\N
497	2015-04-03	2015040300229	wer	146	\N	\N	t	\N
498	2015-04-03	2015040300230	wer	146	\N	\N	t	\N
499	2015-04-03	2015040300231	wer	146	\N	\N	t	\N
500	2015-04-03	2015040300232	wer	146	\N	\N	t	\N
501	2015-04-03	2015040300233	wer	146	\N	\N	t	\N
502	2015-04-03	2015040300234	wer	146	\N	\N	t	\N
503	2015-04-03	2015040300235	wer	146	\N	\N	t	\N
504	2015-04-03	2015040300236	wer	146	\N	\N	t	\N
505	2015-04-03	2015040300237	wer	146	\N	\N	t	\N
506	2015-04-03	2015040300238	wer	146	\N	\N	t	\N
507	2015-04-03	2015040300239	wer	146	\N	\N	t	\N
508	2015-04-03	2015040300240	wer	146	\N	\N	t	\N
509	2015-04-03	2015040300241	wer	146	\N	\N	t	\N
510	2015-04-03	2015040300242	wer	146	\N	\N	t	\N
511	2015-04-03	2015040300243	wer	146	\N	\N	t	\N
512	2015-04-03	2015040300244	wer	146	\N	\N	t	\N
513	2015-04-03	2015040300245	wer	146	\N	\N	t	\N
514	2015-04-03	2015040300246	wer	146	\N	\N	t	\N
515	2015-04-03	2015040300247	wer	146	\N	\N	t	\N
516	2015-04-03	2015040300248	wer	146	\N	\N	t	\N
517	2015-04-03	2015040300249	wer	146	\N	\N	t	\N
518	2015-04-03	2015040300250	wer	146	\N	\N	t	\N
519	2015-04-03	2015040300251	wer	146	\N	\N	t	\N
520	2015-04-03	2015040300252	wer	146	\N	\N	t	\N
521	2015-04-03	2015040300253	wer	147	\N	\N	t	\N
522	2015-04-03	2015040300254	wer	147	\N	\N	t	\N
523	2015-04-03	2015040300255	wer	147	\N	\N	t	\N
524	2015-04-03	2015040300256	wer	147	\N	\N	t	\N
525	2015-04-03	2015040300257	wer	147	\N	\N	t	\N
526	2015-04-03	2015040300258	wer	147	\N	\N	t	\N
527	2015-04-03	2015040300259	wer	147	\N	\N	t	\N
528	2015-04-03	2015040300260	wer	147	\N	\N	t	\N
529	2015-04-03	2015040300261	wer	147	\N	\N	t	\N
530	2015-04-03	2015040300262	wer	147	\N	\N	t	\N
531	2015-04-03	2015040300263	wer	147	\N	\N	t	\N
532	2015-04-03	2015040300264	wer	147	\N	\N	t	\N
533	2015-04-03	2015040300265	wer	147	\N	\N	t	\N
534	2015-04-03	2015040300266	wer	147	\N	\N	t	\N
535	2015-04-03	2015040300267	wer	147	\N	\N	t	\N
536	2015-04-03	2015040300268	wer	147	\N	\N	t	\N
537	2015-04-03	2015040300269	wer	147	\N	\N	t	\N
538	2015-04-03	2015040300270	wer	147	\N	\N	t	\N
539	2015-04-03	2015040300271	wer	147	\N	\N	t	\N
540	2015-04-03	2015040300272	wer	147	\N	\N	t	\N
541	2015-04-03	2015040300273	wer	147	\N	\N	t	\N
542	2015-04-03	2015040300274	wer	147	\N	\N	t	\N
543	2015-04-03	2015040300275	wer	147	\N	\N	t	\N
544	2015-04-03	2015040300276	wer	147	\N	\N	t	\N
545	2015-04-03	2015040300277	wer	147	\N	\N	t	\N
546	2015-04-03	2015040300278	wer	147	\N	\N	t	\N
547	2015-04-03	2015040300279	wer	147	\N	\N	t	\N
548	2015-04-03	2015040300280	wer	147	\N	\N	t	\N
549	2015-04-03	2015040300281	wer	147	\N	\N	t	\N
550	2015-04-03	2015040300282	wer	147	\N	\N	t	\N
551	2015-04-03	2015040300283	wer	147	\N	\N	t	\N
552	2015-04-03	2015040300284	wer	147	\N	\N	t	\N
553	2015-04-03	2015040300285	wer	147	\N	\N	t	\N
554	2015-04-03	2015040300286	wer	147	\N	\N	t	\N
555	2015-04-03	2015040300287	wer	147	\N	\N	t	\N
556	2015-04-03	2015040300288	wer	147	\N	\N	t	\N
557	2015-04-03	2015040300289	wer	147	\N	\N	t	\N
558	2015-04-03	2015040300290	wer	147	\N	\N	t	\N
559	2015-04-03	2015040300291	wer	147	\N	\N	t	\N
560	2015-04-03	2015040300292	wer	147	\N	\N	t	\N
561	2015-04-03	2015040300293	wer	147	\N	\N	t	\N
562	2015-04-03	2015040300294	wer	147	\N	\N	t	\N
563	2015-04-03	2015040300295	wer	147	\N	\N	t	\N
564	2015-04-03	2015040300296	wer	147	\N	\N	t	\N
565	2015-04-03	2015040300297	wer	147	\N	\N	t	\N
566	2015-04-03	2015040300298	wer	147	\N	\N	t	\N
567	2015-04-03	2015040300299	wer	147	\N	\N	t	\N
568	2015-04-03	2015040300300	wer	147	\N	\N	t	\N
569	2015-04-03	2015040300301	wer	147	\N	\N	t	\N
570	2015-04-03	2015040300302	wer	147	\N	\N	t	\N
571	2015-04-03	2015040300303	wer	147	\N	\N	t	\N
572	2015-04-03	2015040300304	wer	147	\N	\N	t	\N
573	2015-04-03	2015040300305	wer	147	\N	\N	t	\N
574	2015-04-03	2015040300306	wer	147	\N	\N	t	\N
575	2015-04-03	2015040300307	wer	147	\N	\N	t	\N
576	2015-04-03	2015040300308	wer	147	\N	\N	t	\N
577	2015-04-03	2015040300309	wer	147	\N	\N	t	\N
578	2015-04-03	2015040300310	wer	147	\N	\N	t	\N
579	2015-04-03	2015040300311	wer	147	\N	\N	t	\N
580	2015-04-03	2015040300312	wer	147	\N	\N	t	\N
581	2015-04-03	2015040300313	wer	147	\N	\N	t	\N
582	2015-04-03	2015040300314	wer	147	\N	\N	t	\N
583	2015-04-03	2015040300315	wer	147	\N	\N	t	\N
584	2015-04-03	2015040300316	wer	147	\N	\N	t	\N
585	2015-04-03	2015040300317	wer	147	\N	\N	t	\N
586	2015-04-03	2015040300318	wer	147	\N	\N	t	\N
587	2015-04-03	2015040300319	wer	147	\N	\N	t	\N
588	2015-04-03	2015040300320	wer	147	\N	\N	t	\N
589	2015-04-03	2015040300321	wer	147	\N	\N	t	\N
590	2015-04-03	2015040300322	wer	147	\N	\N	t	\N
591	2015-04-03	2015040300323	wer	147	\N	\N	t	\N
592	2015-04-03	2015040300324	wer	147	\N	\N	t	\N
593	2015-04-03	2015040300325	wer	147	\N	\N	t	\N
594	2015-04-03	2015040300326	wer	147	\N	\N	t	\N
595	2015-04-03	2015040300327	wer	147	\N	\N	t	\N
596	2015-04-03	2015040300328	wer	147	\N	\N	t	\N
597	2015-04-03	2015040300329	wer	147	\N	\N	t	\N
598	2015-04-03	2015040300330	wer	147	\N	\N	t	\N
599	2015-04-03	2015040300331	wer	147	\N	\N	t	\N
600	2015-04-03	2015040300332	wer	147	\N	\N	t	\N
601	2015-04-03	2015040300333	wer	147	\N	\N	t	\N
602	2015-04-03	2015040300334	wer	147	\N	\N	t	\N
603	2015-04-03	2015040300335	wer	147	\N	\N	t	\N
604	2015-04-03	2015040300336	wer	147	\N	\N	t	\N
605	2015-04-03	2015040300337	wer	147	\N	\N	t	\N
606	2015-04-03	2015040300338	wer	147	\N	\N	t	\N
607	2015-04-03	2015040300339	wer	147	\N	\N	t	\N
608	2015-04-03	2015040300340	wer	147	\N	\N	t	\N
609	2015-04-03	2015040300341	wer	147	\N	\N	t	\N
610	2015-04-03	2015040300342	wer	147	\N	\N	t	\N
611	2015-04-03	2015040300343	wer	147	\N	\N	t	\N
612	2015-04-03	2015040300344	wer	147	\N	\N	t	\N
613	2015-04-03	2015040300345	wer	147	\N	\N	t	\N
614	2015-04-03	2015040300346	wer	147	\N	\N	t	\N
615	2015-04-03	2015040300347	wer	147	\N	\N	t	\N
616	2015-04-03	2015040300348	wer	147	\N	\N	t	\N
617	2015-04-03	2015040300349	wer	147	\N	\N	t	\N
618	2015-04-03	2015040300350	wer	147	\N	\N	t	\N
619	2015-04-03	2015040300351	wer	147	\N	\N	t	\N
620	2015-04-03	2015040300352	wer	147	\N	\N	t	\N
621	2015-04-03	2015040300353	wer	147	\N	\N	t	\N
622	2015-04-03	2015040300354	wer	147	\N	\N	t	\N
623	2015-04-03	2015040300355	wer	147	\N	\N	t	\N
624	2015-04-03	2015040300356	wer	147	\N	\N	t	\N
625	2015-04-03	2015040300357	wer	147	\N	\N	t	\N
626	2015-04-03	2015040300358	wer	147	\N	\N	t	\N
627	2015-04-03	2015040300359	wer	147	\N	\N	t	\N
628	2015-04-03	2015040300360	wer	147	\N	\N	t	\N
629	2015-04-03	2015040300361	wer	147	\N	\N	t	\N
630	2015-04-03	2015040300362	wer	147	\N	\N	t	\N
631	2015-04-03	2015040300363	wer	147	\N	\N	t	\N
632	2015-04-03	2015040300364	wer	147	\N	\N	t	\N
633	2015-04-03	2015040300365	wer	147	\N	\N	t	\N
634	2015-04-03	2015040300366	wer	147	\N	\N	t	\N
635	2015-04-03	2015040300367	wer	147	\N	\N	t	\N
636	2015-04-03	2015040300368	wer	147	\N	\N	t	\N
637	2015-04-03	2015040300369	wer	147	\N	\N	t	\N
638	2015-04-03	2015040300370	wer	147	\N	\N	t	\N
639	2015-04-03	2015040300371	wer	147	\N	\N	t	\N
640	2015-04-03	2015040300372	wer	147	\N	\N	t	\N
641	2015-04-03	2015040300373	wer	147	\N	\N	t	\N
642	2015-04-03	2015040300374	wer	147	\N	\N	t	\N
643	2015-04-03	2015040300375	234	148	\N	\N	t	\N
644	2015-04-03	2015040300376	234	148	\N	\N	t	\N
645	2015-04-03	2015040300377	234	148	\N	\N	t	\N
646	2015-04-03	2015040300378	234	148	\N	\N	t	\N
647	2015-04-03	2015040300379	234	148	\N	\N	t	\N
648	2015-04-03	2015040300380	234	148	\N	\N	t	\N
649	2015-04-03	2015040300381	234	148	\N	\N	t	\N
650	2015-04-03	2015040300382	234	148	\N	\N	t	\N
651	2015-04-03	2015040300383	234	148	\N	\N	t	\N
652	2015-04-03	2015040300384	234	148	\N	\N	t	\N
653	2015-04-03	2015040300385	234	148	\N	\N	t	\N
654	2015-04-03	2015040300386	234	148	\N	\N	t	\N
655	2015-04-03	2015040300387	234	148	\N	\N	t	\N
656	2015-04-03	2015040300388	234	148	\N	\N	t	\N
657	2015-04-03	2015040300389	234	148	\N	\N	t	\N
658	2015-04-03	2015040300390	234	148	\N	\N	t	\N
659	2015-04-03	2015040300391	234	148	\N	\N	t	\N
660	2015-04-03	2015040300392	234	148	\N	\N	t	\N
661	2015-04-03	2015040300393	234	148	\N	\N	t	\N
662	2015-04-03	2015040300394	234	148	\N	\N	t	\N
663	2015-04-03	2015040300395	234	148	\N	\N	t	\N
664	2015-04-03	2015040300396	234	148	\N	\N	t	\N
665	2015-04-03	2015040300397	234	148	\N	\N	t	\N
666	2015-04-03	2015040300398	234	148	\N	\N	t	\N
667	2015-04-03	2015040300399	234	148	\N	\N	t	\N
668	2015-04-03	2015040300400	234	148	\N	\N	t	\N
669	2015-04-03	2015040300401	234	148	\N	\N	t	\N
670	2015-04-03	2015040300402	234	148	\N	\N	t	\N
671	2015-04-03	2015040300403	234	148	\N	\N	t	\N
672	2015-04-03	2015040300404	234	148	\N	\N	t	\N
673	2015-04-03	2015040300405	234	148	\N	\N	t	\N
674	2015-04-03	2015040300406	234	148	\N	\N	t	\N
675	2015-04-03	2015040300407	234	148	\N	\N	t	\N
676	2015-04-03	2015040300408	234	148	\N	\N	t	\N
677	2015-04-03	2015040300409	234	148	\N	\N	t	\N
678	2015-04-03	2015040300410	234	148	\N	\N	t	\N
679	2015-04-03	2015040300411	234	148	\N	\N	t	\N
680	2015-04-03	2015040300412	234	148	\N	\N	t	\N
681	2015-04-03	2015040300413	234	148	\N	\N	t	\N
682	2015-04-03	2015040300414	234	148	\N	\N	t	\N
683	2015-04-03	2015040300415	234	148	\N	\N	t	\N
684	2015-04-03	2015040300416	234	148	\N	\N	t	\N
685	2015-04-03	2015040300417	234	148	\N	\N	t	\N
686	2015-04-03	2015040300418	234	148	\N	\N	t	\N
687	2015-04-03	2015040300419	234	148	\N	\N	t	\N
688	2015-04-03	2015040300420	234	148	\N	\N	t	\N
689	2015-04-03	2015040300421	234	148	\N	\N	t	\N
690	2015-04-03	2015040300422	234	148	\N	\N	t	\N
691	2015-04-03	2015040300423	234	148	\N	\N	t	\N
692	2015-04-03	2015040300424	234	148	\N	\N	t	\N
693	2015-04-03	2015040300425	234	148	\N	\N	t	\N
694	2015-04-03	2015040300426	234	148	\N	\N	t	\N
695	2015-04-03	2015040300427	234	148	\N	\N	t	\N
696	2015-04-03	2015040300428	234	148	\N	\N	t	\N
697	2015-04-03	2015040300429	234	148	\N	\N	t	\N
698	2015-04-03	2015040300430	234	148	\N	\N	t	\N
699	2015-04-03	2015040300431	234	148	\N	\N	t	\N
700	2015-04-03	2015040300432	234	148	\N	\N	t	\N
701	2015-04-03	2015040300433	234	148	\N	\N	t	\N
702	2015-04-03	2015040300434	234	148	\N	\N	t	\N
703	2015-04-03	2015040300435	234	148	\N	\N	t	\N
704	2015-04-03	2015040300436	234	148	\N	\N	t	\N
705	2015-04-03	2015040300437	234	148	\N	\N	t	\N
706	2015-04-03	2015040300438	234	148	\N	\N	t	\N
707	2015-04-03	2015040300439	234	148	\N	\N	t	\N
708	2015-04-03	2015040300440	234	148	\N	\N	t	\N
709	2015-04-03	2015040300441	234	148	\N	\N	t	\N
710	2015-04-03	2015040300442	234	148	\N	\N	t	\N
711	2015-04-03	2015040300443	234	148	\N	\N	t	\N
712	2015-04-03	2015040300444	234	148	\N	\N	t	\N
713	2015-04-03	2015040300445	234	148	\N	\N	t	\N
714	2015-04-03	2015040300446	234	148	\N	\N	t	\N
715	2015-04-03	2015040300447	234	148	\N	\N	t	\N
716	2015-04-03	2015040300448	234	148	\N	\N	t	\N
717	2015-04-03	2015040300449	234	148	\N	\N	t	\N
718	2015-04-03	2015040300450	234	148	\N	\N	t	\N
719	2015-04-03	2015040300451	234	148	\N	\N	t	\N
720	2015-04-03	2015040300452	234	148	\N	\N	t	\N
721	2015-04-03	2015040300453	234	148	\N	\N	t	\N
722	2015-04-03	2015040300454	234	148	\N	\N	t	\N
723	2015-04-03	2015040300455	234	148	\N	\N	t	\N
724	2015-04-03	2015040300456	234	148	\N	\N	t	\N
725	2015-04-03	2015040300457	234	148	\N	\N	t	\N
726	2015-04-03	2015040300458	234	148	\N	\N	t	\N
727	2015-04-03	2015040300459	234	148	\N	\N	t	\N
728	2015-04-03	2015040300460	234	148	\N	\N	t	\N
729	2015-04-03	2015040300461	234	148	\N	\N	t	\N
730	2015-04-03	2015040300462	234	148	\N	\N	t	\N
731	2015-04-03	2015040300463	234	148	\N	\N	t	\N
732	2015-04-03	2015040300464	234	148	\N	\N	t	\N
733	2015-04-03	2015040300465	234	148	\N	\N	t	\N
734	2015-04-03	2015040300466	234	148	\N	\N	t	\N
735	2015-04-03	2015040300467	234	148	\N	\N	t	\N
736	2015-04-03	2015040300468	234	148	\N	\N	t	\N
737	2015-04-03	2015040300469	234	148	\N	\N	t	\N
738	2015-04-03	2015040300470	234	148	\N	\N	t	\N
739	2015-04-03	2015040300471	234	148	\N	\N	t	\N
740	2015-04-03	2015040300472	234	148	\N	\N	t	\N
741	2015-04-03	2015040300473	234	148	\N	\N	t	\N
742	2015-04-03	2015040300474	234	148	\N	\N	t	\N
743	2015-04-03	2015040300475	234	148	\N	\N	t	\N
744	2015-04-03	2015040300476	234	148	\N	\N	t	\N
745	2015-04-03	2015040300477	234	148	\N	\N	t	\N
746	2015-04-03	2015040300478	234	148	\N	\N	t	\N
747	2015-04-03	2015040300479	234	148	\N	\N	t	\N
748	2015-04-03	2015040300480	234	148	\N	\N	t	\N
749	2015-04-03	2015040300481	234	148	\N	\N	t	\N
750	2015-04-03	2015040300482	234	148	\N	\N	t	\N
751	2015-04-03	2015040300483	234	148	\N	\N	t	\N
752	2015-04-03	2015040300484	234	148	\N	\N	t	\N
753	2015-04-03	2015040300485	234	148	\N	\N	t	\N
754	2015-04-03	2015040300486	234	148	\N	\N	t	\N
755	2015-04-03	2015040300487	234	148	\N	\N	t	\N
756	2015-04-03	2015040300488	234	148	\N	\N	t	\N
757	2015-04-03	2015040300489	234	148	\N	\N	t	\N
758	2015-04-03	2015040300490	234	148	\N	\N	t	\N
759	2015-04-03	2015040300491	234	148	\N	\N	t	\N
760	2015-04-03	2015040300492	234	148	\N	\N	t	\N
761	2015-04-03	2015040300493	234	148	\N	\N	t	\N
762	2015-04-03	2015040300494	234	148	\N	\N	t	\N
763	2015-04-03	2015040300495	234	148	\N	\N	t	\N
764	2015-04-03	2015040300496	234	148	\N	\N	t	\N
765	2015-04-03	2015040300497	234	148	\N	\N	t	\N
766	2015-04-03	2015040300498	234	148	\N	\N	t	\N
767	2015-04-03	2015040300499	234	148	\N	\N	t	\N
768	2015-04-03	2015040300500	234	148	\N	\N	t	\N
769	2015-04-03	2015040300501	234	148	\N	\N	t	\N
770	2015-04-03	2015040300502	234	148	\N	\N	t	\N
771	2015-04-03	2015040300503	234	148	\N	\N	t	\N
772	2015-04-03	2015040300504	234	148	\N	\N	t	\N
773	2015-04-03	2015040300505	234	148	\N	\N	t	\N
774	2015-04-03	2015040300506	234	148	\N	\N	t	\N
775	2015-04-03	2015040300507	234	148	\N	\N	t	\N
776	2015-04-03	2015040300508	234	148	\N	\N	t	\N
777	2015-04-03	2015040300509	234	148	\N	\N	t	\N
778	2015-04-03	2015040300510	234	148	\N	\N	t	\N
779	2015-04-03	2015040300511	234	148	\N	\N	t	\N
780	2015-04-03	2015040300512	234	148	\N	\N	t	\N
781	2015-04-03	2015040300513	234	148	\N	\N	t	\N
782	2015-04-03	2015040300514	234	148	\N	\N	t	\N
783	2015-04-03	2015040300515	234	148	\N	\N	t	\N
784	2015-04-03	2015040300516	234	148	\N	\N	t	\N
785	2015-04-03	2015040300517	234	148	\N	\N	t	\N
786	2015-04-03	2015040300518	234	148	\N	\N	t	\N
787	2015-04-03	2015040300519	234	148	\N	\N	t	\N
788	2015-04-03	2015040300520	234	148	\N	\N	t	\N
789	2015-04-03	2015040300521	234	148	\N	\N	t	\N
790	2015-04-03	2015040300522	234	148	\N	\N	t	\N
791	2015-04-03	2015040300523	234	148	\N	\N	t	\N
792	2015-04-03	2015040300524	234	148	\N	\N	t	\N
793	2015-04-03	2015040300525	234	148	\N	\N	t	\N
794	2015-04-03	2015040300526	234	148	\N	\N	t	\N
795	2015-04-03	2015040300527	234	148	\N	\N	t	\N
796	2015-04-03	2015040300528	234	148	\N	\N	t	\N
797	2015-04-03	2015040300529	234	148	\N	\N	t	\N
798	2015-04-03	2015040300530	234	148	\N	\N	t	\N
799	2015-04-03	2015040300531	234	148	\N	\N	t	\N
800	2015-04-03	2015040300532	234	148	\N	\N	t	\N
801	2015-04-03	2015040300533	234	148	\N	\N	t	\N
802	2015-04-03	2015040300534	234	148	\N	\N	t	\N
803	2015-04-03	2015040300535	234	148	\N	\N	t	\N
804	2015-04-03	2015040300536	234	148	\N	\N	t	\N
805	2015-04-03	2015040300537	234	148	\N	\N	t	\N
806	2015-04-03	2015040300538	234	148	\N	\N	t	\N
807	2015-04-03	2015040300539	234	148	\N	\N	t	\N
808	2015-04-03	2015040300540	234	148	\N	\N	t	\N
809	2015-04-03	2015040300541	234	148	\N	\N	t	\N
810	2015-04-03	2015040300542	234	148	\N	\N	t	\N
811	2015-04-03	2015040300543	234	148	\N	\N	t	\N
812	2015-04-03	2015040300544	234	148	\N	\N	t	\N
813	2015-04-03	2015040300545	234	148	\N	\N	t	\N
814	2015-04-03	2015040300546	234	148	\N	\N	t	\N
815	2015-04-03	2015040300547	234	148	\N	\N	t	\N
816	2015-04-03	2015040300548	234	148	\N	\N	t	\N
817	2015-04-03	2015040300549	234	148	\N	\N	t	\N
818	2015-04-03	2015040300550	234	148	\N	\N	t	\N
819	2015-04-03	2015040300551	234	148	\N	\N	t	\N
820	2015-04-03	2015040300552	234	148	\N	\N	t	\N
821	2015-04-03	2015040300553	234	148	\N	\N	t	\N
822	2015-04-03	2015040300554	234	148	\N	\N	t	\N
823	2015-04-03	2015040300555	234	148	\N	\N	t	\N
824	2015-04-03	2015040300556	234	148	\N	\N	t	\N
825	2015-04-03	2015040300557	234	148	\N	\N	t	\N
826	2015-04-03	2015040300558	234	148	\N	\N	t	\N
827	2015-04-03	2015040300559	234	148	\N	\N	t	\N
828	2015-04-03	2015040300560	234	148	\N	\N	t	\N
829	2015-04-03	2015040300561	234	148	\N	\N	t	\N
830	2015-04-03	2015040300562	234	148	\N	\N	t	\N
831	2015-04-03	2015040300563	234	148	\N	\N	t	\N
832	2015-04-03	2015040300564	234	148	\N	\N	t	\N
833	2015-04-03	2015040300565	234	148	\N	\N	t	\N
834	2015-04-03	2015040300566	234	148	\N	\N	t	\N
835	2015-04-03	2015040300567	234	148	\N	\N	t	\N
836	2015-04-03	2015040300568	234	148	\N	\N	t	\N
837	2015-04-03	2015040300569	234	148	\N	\N	t	\N
838	2015-04-03	2015040300570	234	148	\N	\N	t	\N
839	2015-04-03	2015040300571	234	148	\N	\N	t	\N
840	2015-04-03	2015040300572	234	148	\N	\N	t	\N
841	2015-04-03	2015040300573	234	148	\N	\N	t	\N
842	2015-04-03	2015040300574	234	148	\N	\N	t	\N
843	2015-04-03	2015040300575	234	148	\N	\N	t	\N
844	2015-04-03	2015040300576	234	148	\N	\N	t	\N
845	2015-04-03	2015040300577	234	148	\N	\N	t	\N
846	2015-04-03	2015040300578	234	148	\N	\N	t	\N
847	2015-04-03	2015040300579	234	148	\N	\N	t	\N
848	2015-04-03	2015040300580	234	148	\N	\N	t	\N
849	2015-04-03	2015040300581	234	148	\N	\N	t	\N
850	2015-04-03	2015040300582	234	148	\N	\N	t	\N
851	2015-04-03	2015040300583	234	148	\N	\N	t	\N
852	2015-04-03	2015040300584	234	148	\N	\N	t	\N
853	2015-04-03	2015040300585	234	148	\N	\N	t	\N
854	2015-04-03	2015040300586	234	148	\N	\N	t	\N
855	2015-04-03	2015040300587	234	148	\N	\N	t	\N
856	2015-04-03	2015040300588	234	148	\N	\N	t	\N
857	2015-04-03	2015040300589	234	148	\N	\N	t	\N
858	2015-04-03	2015040300590	234	148	\N	\N	t	\N
859	2015-04-03	2015040300591	234	148	\N	\N	t	\N
860	2015-04-03	2015040300592	234	148	\N	\N	t	\N
861	2015-04-03	2015040300593	234	148	\N	\N	t	\N
862	2015-04-03	2015040300594	234	148	\N	\N	t	\N
863	2015-04-03	2015040300595	234	148	\N	\N	t	\N
864	2015-04-03	2015040300596	234	148	\N	\N	t	\N
865	2015-04-03	2015040300597	234	148	\N	\N	t	\N
866	2015-04-03	2015040300598	234	148	\N	\N	t	\N
867	2015-04-03	2015040300599	234	148	\N	\N	t	\N
868	2015-04-03	2015040300600	234	148	\N	\N	t	\N
869	2015-04-03	2015040300601	234	148	\N	\N	t	\N
870	2015-04-03	2015040300602	234	148	\N	\N	t	\N
871	2015-04-03	2015040300603	234	148	\N	\N	t	\N
872	2015-04-03	2015040300604	234	148	\N	\N	t	\N
873	2015-04-03	2015040300605	234	148	\N	\N	t	\N
874	2015-04-03	2015040300606	234	148	\N	\N	t	\N
875	2015-04-03	2015040300607	234	148	\N	\N	t	\N
876	2015-04-03	2015040300608	234	149	\N	\N	t	\N
877	2015-04-03	2015040300609	234	149	\N	\N	t	\N
878	2015-04-03	2015040300610	234	149	\N	\N	t	\N
879	2015-04-03	2015040300611	234	149	\N	\N	t	\N
880	2015-04-03	2015040300612	234	149	\N	\N	t	\N
881	2015-04-03	2015040300613	234	149	\N	\N	t	\N
882	2015-04-03	2015040300614	234	149	\N	\N	t	\N
883	2015-04-03	2015040300615	234	149	\N	\N	t	\N
884	2015-04-03	2015040300616	234	149	\N	\N	t	\N
885	2015-04-03	2015040300617	234	149	\N	\N	t	\N
886	2015-04-03	2015040300618	234	149	\N	\N	t	\N
887	2015-04-03	2015040300619	234	149	\N	\N	t	\N
888	2015-04-03	2015040300620	234	149	\N	\N	t	\N
889	2015-04-03	2015040300621	234	149	\N	\N	t	\N
890	2015-04-03	2015040300622	234	149	\N	\N	t	\N
891	2015-04-03	2015040300623	234	149	\N	\N	t	\N
892	2015-04-03	2015040300624	234	149	\N	\N	t	\N
893	2015-04-03	2015040300625	234	149	\N	\N	t	\N
894	2015-04-03	2015040300626	234	149	\N	\N	t	\N
895	2015-04-03	2015040300627	234	149	\N	\N	t	\N
896	2015-04-03	2015040300628	234	149	\N	\N	t	\N
897	2015-04-03	2015040300629	234	149	\N	\N	t	\N
898	2015-04-03	2015040300630	234	149	\N	\N	t	\N
899	2015-04-03	2015040300631	234	149	\N	\N	t	\N
900	2015-04-03	2015040300632	234	149	\N	\N	t	\N
901	2015-04-03	2015040300633	234	149	\N	\N	t	\N
902	2015-04-03	2015040300634	234	149	\N	\N	t	\N
903	2015-04-03	2015040300635	234	149	\N	\N	t	\N
904	2015-04-03	2015040300636	234	149	\N	\N	t	\N
905	2015-04-03	2015040300637	234	149	\N	\N	t	\N
906	2015-04-03	2015040300638	234	149	\N	\N	t	\N
907	2015-04-03	2015040300639	234	149	\N	\N	t	\N
908	2015-04-03	2015040300640	234	149	\N	\N	t	\N
909	2015-04-03	2015040300641	234	149	\N	\N	t	\N
910	2015-04-03	2015040300642	234	149	\N	\N	t	\N
911	2015-04-03	2015040300643	234	149	\N	\N	t	\N
912	2015-04-03	2015040300644	234	149	\N	\N	t	\N
913	2015-04-03	2015040300645	234	149	\N	\N	t	\N
914	2015-04-03	2015040300646	234	149	\N	\N	t	\N
915	2015-04-03	2015040300647	234	149	\N	\N	t	\N
916	2015-04-03	2015040300648	234	149	\N	\N	t	\N
917	2015-04-03	2015040300649	234	149	\N	\N	t	\N
918	2015-04-03	2015040300650	234	149	\N	\N	t	\N
919	2015-04-03	2015040300651	234	149	\N	\N	t	\N
920	2015-04-03	2015040300652	234	149	\N	\N	t	\N
921	2015-04-03	2015040300653	234	149	\N	\N	t	\N
922	2015-04-03	2015040300654	234	149	\N	\N	t	\N
923	2015-04-03	2015040300655	234	149	\N	\N	t	\N
924	2015-04-03	2015040300656	234	149	\N	\N	t	\N
925	2015-04-03	2015040300657	234	149	\N	\N	t	\N
926	2015-04-03	2015040300658	234	149	\N	\N	t	\N
927	2015-04-03	2015040300659	234	149	\N	\N	t	\N
928	2015-04-03	2015040300660	234	149	\N	\N	t	\N
929	2015-04-03	2015040300661	234	149	\N	\N	t	\N
930	2015-04-03	2015040300662	234	149	\N	\N	t	\N
931	2015-04-03	2015040300663	234	149	\N	\N	t	\N
932	2015-04-03	2015040300664	234	149	\N	\N	t	\N
933	2015-04-03	2015040300665	234	149	\N	\N	t	\N
934	2015-04-03	2015040300666	234	149	\N	\N	t	\N
935	2015-04-03	2015040300667	234	149	\N	\N	t	\N
936	2015-04-03	2015040300668	234	149	\N	\N	t	\N
937	2015-04-03	2015040300669	234	149	\N	\N	t	\N
938	2015-04-03	2015040300670	234	149	\N	\N	t	\N
939	2015-04-03	2015040300671	234	149	\N	\N	t	\N
940	2015-04-03	2015040300672	234	149	\N	\N	t	\N
941	2015-04-03	2015040300673	234	149	\N	\N	t	\N
942	2015-04-03	2015040300674	234	149	\N	\N	t	\N
943	2015-04-03	2015040300675	234	149	\N	\N	t	\N
944	2015-04-03	2015040300676	234	149	\N	\N	t	\N
945	2015-04-03	2015040300677	234	149	\N	\N	t	\N
946	2015-04-03	2015040300678	234	149	\N	\N	t	\N
947	2015-04-03	2015040300679	234	149	\N	\N	t	\N
948	2015-04-03	2015040300680	234	149	\N	\N	t	\N
949	2015-04-03	2015040300681	234	149	\N	\N	t	\N
950	2015-04-03	2015040300682	234	149	\N	\N	t	\N
951	2015-04-03	2015040300683	234	149	\N	\N	t	\N
952	2015-04-03	2015040300684	234	149	\N	\N	t	\N
953	2015-04-03	2015040300685	234	149	\N	\N	t	\N
954	2015-04-03	2015040300686	234	149	\N	\N	t	\N
955	2015-04-03	2015040300687	234	149	\N	\N	t	\N
956	2015-04-03	2015040300688	234	149	\N	\N	t	\N
957	2015-04-03	2015040300689	234	149	\N	\N	t	\N
958	2015-04-03	2015040300690	234	149	\N	\N	t	\N
959	2015-04-03	2015040300691	234	149	\N	\N	t	\N
960	2015-04-03	2015040300692	234	149	\N	\N	t	\N
961	2015-04-03	2015040300693	234	149	\N	\N	t	\N
962	2015-04-03	2015040300694	234	149	\N	\N	t	\N
963	2015-04-03	2015040300695	234	149	\N	\N	t	\N
964	2015-04-03	2015040300696	234	149	\N	\N	t	\N
965	2015-04-03	2015040300697	234	149	\N	\N	t	\N
966	2015-04-03	2015040300698	234	149	\N	\N	t	\N
967	2015-04-03	2015040300699	234	149	\N	\N	t	\N
968	2015-04-03	2015040300700	234	149	\N	\N	t	\N
969	2015-04-03	2015040300701	234	149	\N	\N	t	\N
970	2015-04-03	2015040300702	234	149	\N	\N	t	\N
971	2015-04-03	2015040300703	234	149	\N	\N	t	\N
972	2015-04-03	2015040300704	234	149	\N	\N	t	\N
973	2015-04-03	2015040300705	234	149	\N	\N	t	\N
974	2015-04-03	2015040300706	234	149	\N	\N	t	\N
975	2015-04-03	2015040300707	234	149	\N	\N	t	\N
976	2015-04-03	2015040300708	234	149	\N	\N	t	\N
977	2015-04-03	2015040300709	234	149	\N	\N	t	\N
978	2015-04-03	2015040300710	234	149	\N	\N	t	\N
979	2015-04-03	2015040300711	234	149	\N	\N	t	\N
980	2015-04-03	2015040300712	234	149	\N	\N	t	\N
981	2015-04-03	2015040300713	234	149	\N	\N	t	\N
982	2015-04-03	2015040300714	234	149	\N	\N	t	\N
983	2015-04-03	2015040300715	234	149	\N	\N	t	\N
984	2015-04-03	2015040300716	234	149	\N	\N	t	\N
985	2015-04-03	2015040300717	234	149	\N	\N	t	\N
986	2015-04-03	2015040300718	234	149	\N	\N	t	\N
987	2015-04-03	2015040300719	234	149	\N	\N	t	\N
988	2015-04-03	2015040300720	234	149	\N	\N	t	\N
989	2015-04-03	2015040300721	234	149	\N	\N	t	\N
990	2015-04-03	2015040300722	234	149	\N	\N	t	\N
991	2015-04-03	2015040300723	234	149	\N	\N	t	\N
992	2015-04-03	2015040300724	234	149	\N	\N	t	\N
993	2015-04-03	2015040300725	234	149	\N	\N	t	\N
994	2015-04-03	2015040300726	234	149	\N	\N	t	\N
995	2015-04-03	2015040300727	234	149	\N	\N	t	\N
996	2015-04-03	2015040300728	234	149	\N	\N	t	\N
997	2015-04-03	2015040300729	234	149	\N	\N	t	\N
998	2015-04-03	2015040300730	234	149	\N	\N	t	\N
999	2015-04-03	2015040300731	234	149	\N	\N	t	\N
1000	2015-04-03	2015040300732	234	149	\N	\N	t	\N
1001	2015-04-03	2015040300733	234	149	\N	\N	t	\N
1002	2015-04-03	2015040300734	234	149	\N	\N	t	\N
1003	2015-04-03	2015040300735	234	149	\N	\N	t	\N
1004	2015-04-03	2015040300736	234	149	\N	\N	t	\N
1005	2015-04-03	2015040300737	234	149	\N	\N	t	\N
1006	2015-04-03	2015040300738	234	149	\N	\N	t	\N
1007	2015-04-03	2015040300739	234	149	\N	\N	t	\N
1008	2015-04-03	2015040300740	234	149	\N	\N	t	\N
1009	2015-04-03	2015040300741	234	149	\N	\N	t	\N
1010	2015-04-03	2015040300742	234	149	\N	\N	t	\N
1011	2015-04-03	2015040300743	234	149	\N	\N	t	\N
1012	2015-04-03	2015040300744	234	149	\N	\N	t	\N
1013	2015-04-03	2015040300745	234	149	\N	\N	t	\N
1014	2015-04-03	2015040300746	234	149	\N	\N	t	\N
1015	2015-04-03	2015040300747	234	149	\N	\N	t	\N
1016	2015-04-03	2015040300748	234	149	\N	\N	t	\N
1017	2015-04-03	2015040300749	234	149	\N	\N	t	\N
1018	2015-04-03	2015040300750	234	149	\N	\N	t	\N
1019	2015-04-03	2015040300751	234	149	\N	\N	t	\N
1020	2015-04-03	2015040300752	234	149	\N	\N	t	\N
1021	2015-04-03	2015040300753	234	149	\N	\N	t	\N
1022	2015-04-03	2015040300754	234	149	\N	\N	t	\N
1023	2015-04-03	2015040300755	234	149	\N	\N	t	\N
1024	2015-04-03	2015040300756	234	149	\N	\N	t	\N
1025	2015-04-03	2015040300757	234	149	\N	\N	t	\N
1026	2015-04-03	2015040300758	234	149	\N	\N	t	\N
1027	2015-04-03	2015040300759	234	149	\N	\N	t	\N
1028	2015-04-03	2015040300760	234	149	\N	\N	t	\N
1029	2015-04-03	2015040300761	234	149	\N	\N	t	\N
1030	2015-04-03	2015040300762	234	149	\N	\N	t	\N
1031	2015-04-03	2015040300763	234	149	\N	\N	t	\N
1032	2015-04-03	2015040300764	234	149	\N	\N	t	\N
1033	2015-04-03	2015040300765	234	149	\N	\N	t	\N
1034	2015-04-03	2015040300766	234	149	\N	\N	t	\N
1035	2015-04-03	2015040300767	234	149	\N	\N	t	\N
1036	2015-04-03	2015040300768	234	149	\N	\N	t	\N
1037	2015-04-03	2015040300769	234	149	\N	\N	t	\N
1038	2015-04-03	2015040300770	234	149	\N	\N	t	\N
1039	2015-04-03	2015040300771	234	149	\N	\N	t	\N
1040	2015-04-03	2015040300772	234	149	\N	\N	t	\N
1041	2015-04-03	2015040300773	234	149	\N	\N	t	\N
1042	2015-04-03	2015040300774	234	149	\N	\N	t	\N
1043	2015-04-03	2015040300775	234	149	\N	\N	t	\N
1044	2015-04-03	2015040300776	234	149	\N	\N	t	\N
1045	2015-04-03	2015040300777	234	149	\N	\N	t	\N
1046	2015-04-03	2015040300778	234	149	\N	\N	t	\N
1047	2015-04-03	2015040300779	234	149	\N	\N	t	\N
1048	2015-04-03	2015040300780	234	149	\N	\N	t	\N
1049	2015-04-03	2015040300781	234	149	\N	\N	t	\N
1050	2015-04-03	2015040300782	234	149	\N	\N	t	\N
1051	2015-04-03	2015040300783	234	149	\N	\N	t	\N
1052	2015-04-03	2015040300784	234	149	\N	\N	t	\N
1053	2015-04-03	2015040300785	234	149	\N	\N	t	\N
1054	2015-04-03	2015040300786	234	149	\N	\N	t	\N
1055	2015-04-03	2015040300787	234	149	\N	\N	t	\N
1056	2015-04-03	2015040300788	234	149	\N	\N	t	\N
1057	2015-04-03	2015040300789	234	149	\N	\N	t	\N
1058	2015-04-03	2015040300790	234	149	\N	\N	t	\N
1059	2015-04-03	2015040300791	234	149	\N	\N	t	\N
1060	2015-04-03	2015040300792	234	149	\N	\N	t	\N
1061	2015-04-03	2015040300793	234	149	\N	\N	t	\N
1062	2015-04-03	2015040300794	234	149	\N	\N	t	\N
1063	2015-04-03	2015040300795	234	149	\N	\N	t	\N
1064	2015-04-03	2015040300796	234	149	\N	\N	t	\N
1065	2015-04-03	2015040300797	234	149	\N	\N	t	\N
1066	2015-04-03	2015040300798	234	149	\N	\N	t	\N
1067	2015-04-03	2015040300799	234	149	\N	\N	t	\N
1068	2015-04-03	2015040300800	234	149	\N	\N	t	\N
1069	2015-04-03	2015040300801	234	149	\N	\N	t	\N
1070	2015-04-03	2015040300802	234	149	\N	\N	t	\N
1071	2015-04-03	2015040300803	234	149	\N	\N	t	\N
1072	2015-04-03	2015040300804	234	149	\N	\N	t	\N
1073	2015-04-03	2015040300805	234	149	\N	\N	t	\N
1074	2015-04-03	2015040300806	234	149	\N	\N	t	\N
1075	2015-04-03	2015040300807	234	149	\N	\N	t	\N
1076	2015-04-03	2015040300808	234	149	\N	\N	t	\N
1077	2015-04-03	2015040300809	234	149	\N	\N	t	\N
1078	2015-04-03	2015040300810	234	149	\N	\N	t	\N
1079	2015-04-03	2015040300811	234	149	\N	\N	t	\N
1080	2015-04-03	2015040300812	234	149	\N	\N	t	\N
1081	2015-04-03	2015040300813	234	149	\N	\N	t	\N
1082	2015-04-03	2015040300814	234	149	\N	\N	t	\N
1083	2015-04-03	2015040300815	234	149	\N	\N	t	\N
1084	2015-04-03	2015040300816	234	149	\N	\N	t	\N
1085	2015-04-03	2015040300817	234	149	\N	\N	t	\N
1086	2015-04-03	2015040300818	234	149	\N	\N	t	\N
1087	2015-04-03	2015040300819	234	149	\N	\N	t	\N
1088	2015-04-03	2015040300820	234	149	\N	\N	t	\N
1089	2015-04-03	2015040300821	234	149	\N	\N	t	\N
1090	2015-04-03	2015040300822	234	149	\N	\N	t	\N
1091	2015-04-03	2015040300823	234	149	\N	\N	t	\N
1092	2015-04-03	2015040300824	234	149	\N	\N	t	\N
1093	2015-04-03	2015040300825	234	149	\N	\N	t	\N
1094	2015-04-03	2015040300826	234	149	\N	\N	t	\N
1095	2015-04-03	2015040300827	234	149	\N	\N	t	\N
1096	2015-04-03	2015040300828	234	149	\N	\N	t	\N
1097	2015-04-03	2015040300829	234	149	\N	\N	t	\N
1098	2015-04-03	2015040300830	234	149	\N	\N	t	\N
1099	2015-04-03	2015040300831	234	149	\N	\N	t	\N
1100	2015-04-03	2015040300832	234	149	\N	\N	t	\N
1101	2015-04-03	2015040300833	234	149	\N	\N	t	\N
1102	2015-04-03	2015040300834	234	149	\N	\N	t	\N
1103	2015-04-03	2015040300835	234	149	\N	\N	t	\N
1104	2015-04-03	2015040300836	234	149	\N	\N	t	\N
1105	2015-04-03	2015040300837	234	149	\N	\N	t	\N
1106	2015-04-03	2015040300838	234	149	\N	\N	t	\N
1107	2015-04-03	2015040300839	234	149	\N	\N	t	\N
1108	2015-04-03	2015040300840	234	149	\N	\N	t	\N
1109	2015-04-03	2015040300841	234	150	\N	\N	t	\N
1110	2015-04-03	2015040300842	234	150	\N	\N	t	\N
1111	2015-04-03	2015040300843	234	150	\N	\N	t	\N
1112	2015-04-03	2015040300844	234	150	\N	\N	t	\N
1113	2015-04-03	2015040300845	234	150	\N	\N	t	\N
1114	2015-04-03	2015040300846	234	150	\N	\N	t	\N
1115	2015-04-03	2015040300847	234	150	\N	\N	t	\N
1116	2015-04-03	2015040300848	234	150	\N	\N	t	\N
1117	2015-04-03	2015040300849	234	150	\N	\N	t	\N
1118	2015-04-03	2015040300850	234	150	\N	\N	t	\N
1119	2015-04-03	2015040300851	234	150	\N	\N	t	\N
1120	2015-04-03	2015040300852	234	150	\N	\N	t	\N
1121	2015-04-03	2015040300853	234	150	\N	\N	t	\N
1122	2015-04-03	2015040300854	234	150	\N	\N	t	\N
1123	2015-04-03	2015040300855	234	150	\N	\N	t	\N
1124	2015-04-03	2015040300856	234	150	\N	\N	t	\N
1125	2015-04-03	2015040300857	234	150	\N	\N	t	\N
1126	2015-04-03	2015040300858	234	150	\N	\N	t	\N
1127	2015-04-03	2015040300859	234	150	\N	\N	t	\N
1128	2015-04-03	2015040300860	234	150	\N	\N	t	\N
1129	2015-04-03	2015040300861	234	150	\N	\N	t	\N
1130	2015-04-03	2015040300862	234	150	\N	\N	t	\N
1131	2015-04-03	2015040300863	234	150	\N	\N	t	\N
1132	2015-04-03	2015040300864	234	150	\N	\N	t	\N
1133	2015-04-03	2015040300865	234	150	\N	\N	t	\N
1134	2015-04-03	2015040300866	234	150	\N	\N	t	\N
1135	2015-04-03	2015040300867	234	150	\N	\N	t	\N
1136	2015-04-03	2015040300868	234	150	\N	\N	t	\N
1137	2015-04-03	2015040300869	234	150	\N	\N	t	\N
1138	2015-04-03	2015040300870	234	150	\N	\N	t	\N
1139	2015-04-03	2015040300871	234	150	\N	\N	t	\N
1140	2015-04-03	2015040300872	234	150	\N	\N	t	\N
1141	2015-04-03	2015040300873	234	150	\N	\N	t	\N
1142	2015-04-03	2015040300874	234	150	\N	\N	t	\N
1143	2015-04-03	2015040300875	234	150	\N	\N	t	\N
1144	2015-04-03	2015040300876	234	150	\N	\N	t	\N
1145	2015-04-03	2015040300877	234	150	\N	\N	t	\N
1146	2015-04-03	2015040300878	234	150	\N	\N	t	\N
1147	2015-04-03	2015040300879	234	150	\N	\N	t	\N
1148	2015-04-03	2015040300880	234	150	\N	\N	t	\N
1149	2015-04-03	2015040300881	234	150	\N	\N	t	\N
1150	2015-04-03	2015040300882	234	150	\N	\N	t	\N
1151	2015-04-03	2015040300883	234	150	\N	\N	t	\N
1152	2015-04-03	2015040300884	234	150	\N	\N	t	\N
1153	2015-04-03	2015040300885	234	150	\N	\N	t	\N
1154	2015-04-03	2015040300886	234	150	\N	\N	t	\N
1155	2015-04-03	2015040300887	234	150	\N	\N	t	\N
1156	2015-04-03	2015040300888	234	150	\N	\N	t	\N
1157	2015-04-03	2015040300889	234	150	\N	\N	t	\N
1158	2015-04-03	2015040300890	234	150	\N	\N	t	\N
1159	2015-04-03	2015040300891	234	150	\N	\N	t	\N
1160	2015-04-03	2015040300892	234	150	\N	\N	t	\N
1161	2015-04-03	2015040300893	234	150	\N	\N	t	\N
1162	2015-04-03	2015040300894	234	150	\N	\N	t	\N
1163	2015-04-03	2015040300895	234	150	\N	\N	t	\N
1164	2015-04-03	2015040300896	234	150	\N	\N	t	\N
1165	2015-04-03	2015040300897	234	150	\N	\N	t	\N
1166	2015-04-03	2015040300898	234	150	\N	\N	t	\N
1167	2015-04-03	2015040300899	234	150	\N	\N	t	\N
1168	2015-04-03	2015040300900	234	150	\N	\N	t	\N
1169	2015-04-03	2015040300901	234	150	\N	\N	t	\N
1170	2015-04-03	2015040300902	234	150	\N	\N	t	\N
1171	2015-04-03	2015040300903	234	150	\N	\N	t	\N
1172	2015-04-03	2015040300904	234	150	\N	\N	t	\N
1173	2015-04-03	2015040300905	234	150	\N	\N	t	\N
1174	2015-04-03	2015040300906	234	150	\N	\N	t	\N
1175	2015-04-03	2015040300907	234	150	\N	\N	t	\N
1176	2015-04-03	2015040300908	234	150	\N	\N	t	\N
1177	2015-04-03	2015040300909	234	150	\N	\N	t	\N
1178	2015-04-03	2015040300910	234	150	\N	\N	t	\N
1179	2015-04-03	2015040300911	234	150	\N	\N	t	\N
1180	2015-04-03	2015040300912	234	150	\N	\N	t	\N
1181	2015-04-03	2015040300913	234	150	\N	\N	t	\N
1182	2015-04-03	2015040300914	234	150	\N	\N	t	\N
1183	2015-04-03	2015040300915	234	150	\N	\N	t	\N
1184	2015-04-03	2015040300916	234	150	\N	\N	t	\N
1185	2015-04-03	2015040300917	234	150	\N	\N	t	\N
1186	2015-04-03	2015040300918	234	150	\N	\N	t	\N
1187	2015-04-03	2015040300919	234	150	\N	\N	t	\N
1188	2015-04-03	2015040300920	234	150	\N	\N	t	\N
1189	2015-04-03	2015040300921	234	150	\N	\N	t	\N
1190	2015-04-03	2015040300922	234	150	\N	\N	t	\N
1191	2015-04-03	2015040300923	234	150	\N	\N	t	\N
1192	2015-04-03	2015040300924	234	150	\N	\N	t	\N
1193	2015-04-03	2015040300925	234	150	\N	\N	t	\N
1194	2015-04-03	2015040300926	234	150	\N	\N	t	\N
1195	2015-04-03	2015040300927	234	150	\N	\N	t	\N
1196	2015-04-03	2015040300928	234	150	\N	\N	t	\N
1197	2015-04-03	2015040300929	234	150	\N	\N	t	\N
1198	2015-04-03	2015040300930	234	150	\N	\N	t	\N
1199	2015-04-03	2015040300931	234	150	\N	\N	t	\N
1200	2015-04-03	2015040300932	234	150	\N	\N	t	\N
1201	2015-04-03	2015040300933	234	150	\N	\N	t	\N
1202	2015-04-03	2015040300934	234	150	\N	\N	t	\N
1203	2015-04-03	2015040300935	234	150	\N	\N	t	\N
1204	2015-04-03	2015040300936	234	150	\N	\N	t	\N
1205	2015-04-03	2015040300937	234	150	\N	\N	t	\N
1206	2015-04-03	2015040300938	234	150	\N	\N	t	\N
1207	2015-04-03	2015040300939	234	150	\N	\N	t	\N
1208	2015-04-03	2015040300940	234	150	\N	\N	t	\N
1209	2015-04-03	2015040300941	234	150	\N	\N	t	\N
1210	2015-04-03	2015040300942	234	150	\N	\N	t	\N
1211	2015-04-03	2015040300943	234	150	\N	\N	t	\N
1212	2015-04-03	2015040300944	234	150	\N	\N	t	\N
1213	2015-04-03	2015040300945	234	150	\N	\N	t	\N
1214	2015-04-03	2015040300946	234	150	\N	\N	t	\N
1215	2015-04-03	2015040300947	234	150	\N	\N	t	\N
1216	2015-04-03	2015040300948	234	150	\N	\N	t	\N
1217	2015-04-03	2015040300949	234	150	\N	\N	t	\N
1218	2015-04-03	2015040300950	234	150	\N	\N	t	\N
1219	2015-04-03	2015040300951	234	150	\N	\N	t	\N
1220	2015-04-03	2015040300952	234	150	\N	\N	t	\N
1221	2015-04-03	2015040300953	234	150	\N	\N	t	\N
1222	2015-04-03	2015040300954	234	150	\N	\N	t	\N
1223	2015-04-03	2015040300955	234	150	\N	\N	t	\N
1224	2015-04-03	2015040300956	234	150	\N	\N	t	\N
1225	2015-04-03	2015040300957	234	150	\N	\N	t	\N
1226	2015-04-03	2015040300958	234	150	\N	\N	t	\N
1227	2015-04-03	2015040300959	234	150	\N	\N	t	\N
1228	2015-04-03	2015040300960	234	150	\N	\N	t	\N
1229	2015-04-03	2015040300961	234	150	\N	\N	t	\N
1230	2015-04-03	2015040300962	234	150	\N	\N	t	\N
1231	2015-04-03	2015040300963	234	150	\N	\N	t	\N
1232	2015-04-03	2015040300964	234	150	\N	\N	t	\N
1233	2015-04-03	2015040300965	234	150	\N	\N	t	\N
1234	2015-04-03	2015040300966	234	150	\N	\N	t	\N
1235	2015-04-03	2015040300967	234	150	\N	\N	t	\N
1236	2015-04-03	2015040300968	234	150	\N	\N	t	\N
1237	2015-04-03	2015040300969	234	150	\N	\N	t	\N
1238	2015-04-03	2015040300970	234	150	\N	\N	t	\N
1239	2015-04-03	2015040300971	234	150	\N	\N	t	\N
1240	2015-04-03	2015040300972	234	150	\N	\N	t	\N
1241	2015-04-03	2015040300973	234	150	\N	\N	t	\N
1242	2015-04-03	2015040300974	234	150	\N	\N	t	\N
1243	2015-04-03	2015040300975	234	150	\N	\N	t	\N
1244	2015-04-03	2015040300976	234	150	\N	\N	t	\N
1245	2015-04-03	2015040300977	234	150	\N	\N	t	\N
1246	2015-04-03	2015040300978	234	150	\N	\N	t	\N
1247	2015-04-03	2015040300979	234	150	\N	\N	t	\N
1248	2015-04-03	2015040300980	234	150	\N	\N	t	\N
1249	2015-04-03	2015040300981	234	150	\N	\N	t	\N
1250	2015-04-03	2015040300982	234	150	\N	\N	t	\N
1251	2015-04-03	2015040300983	234	150	\N	\N	t	\N
1252	2015-04-03	2015040300984	234	150	\N	\N	t	\N
1253	2015-04-03	2015040300985	234	150	\N	\N	t	\N
1254	2015-04-03	2015040300986	234	150	\N	\N	t	\N
1255	2015-04-03	2015040300987	234	150	\N	\N	t	\N
1256	2015-04-03	2015040300988	234	150	\N	\N	t	\N
1257	2015-04-03	2015040300989	234	150	\N	\N	t	\N
1258	2015-04-03	2015040300990	234	150	\N	\N	t	\N
1259	2015-04-03	2015040300991	234	150	\N	\N	t	\N
1260	2015-04-03	2015040300992	234	150	\N	\N	t	\N
1261	2015-04-03	2015040300993	234	150	\N	\N	t	\N
1262	2015-04-03	2015040300994	234	150	\N	\N	t	\N
1263	2015-04-03	2015040300995	234	150	\N	\N	t	\N
1264	2015-04-03	2015040300996	234	150	\N	\N	t	\N
1265	2015-04-03	2015040300997	234	150	\N	\N	t	\N
1266	2015-04-03	2015040300998	234	150	\N	\N	t	\N
1267	2015-04-03	2015040300999	234	150	\N	\N	t	\N
1268	2015-04-03	2015040301000	234	150	\N	\N	t	\N
1269	2015-04-03	2015040301001	234	150	\N	\N	t	\N
1270	2015-04-03	2015040301002	234	150	\N	\N	t	\N
1271	2015-04-03	2015040301003	234	150	\N	\N	t	\N
1272	2015-04-03	2015040301004	234	150	\N	\N	t	\N
1273	2015-04-03	2015040301005	234	150	\N	\N	t	\N
1274	2015-04-03	2015040301006	234	150	\N	\N	t	\N
1275	2015-04-03	2015040301007	234	150	\N	\N	t	\N
1276	2015-04-03	2015040301008	234	150	\N	\N	t	\N
1277	2015-04-03	2015040301009	234	150	\N	\N	t	\N
1278	2015-04-03	2015040301010	234	150	\N	\N	t	\N
1279	2015-04-03	2015040301011	234	150	\N	\N	t	\N
1280	2015-04-03	2015040301012	234	150	\N	\N	t	\N
1281	2015-04-03	2015040301013	234	150	\N	\N	t	\N
1282	2015-04-03	2015040301014	234	150	\N	\N	t	\N
1283	2015-04-03	2015040301015	234	150	\N	\N	t	\N
1284	2015-04-03	2015040301016	234	150	\N	\N	t	\N
1285	2015-04-03	2015040301017	234	150	\N	\N	t	\N
1286	2015-04-03	2015040301018	234	150	\N	\N	t	\N
1287	2015-04-03	2015040301019	234	150	\N	\N	t	\N
1288	2015-04-03	2015040301020	234	150	\N	\N	t	\N
1289	2015-04-03	2015040301021	234	150	\N	\N	t	\N
1290	2015-04-03	2015040301022	234	150	\N	\N	t	\N
1291	2015-04-03	2015040301023	234	150	\N	\N	t	\N
1292	2015-04-03	2015040301024	234	150	\N	\N	t	\N
1293	2015-04-03	2015040301025	234	150	\N	\N	t	\N
1294	2015-04-03	2015040301026	234	150	\N	\N	t	\N
1295	2015-04-03	2015040301027	234	150	\N	\N	t	\N
1296	2015-04-03	2015040301028	234	150	\N	\N	t	\N
1297	2015-04-03	2015040301029	234	150	\N	\N	t	\N
1298	2015-04-03	2015040301030	234	150	\N	\N	t	\N
1299	2015-04-03	2015040301031	234	150	\N	\N	t	\N
1300	2015-04-03	2015040301032	234	150	\N	\N	t	\N
1301	2015-04-03	2015040301033	234	150	\N	\N	t	\N
1302	2015-04-03	2015040301034	234	150	\N	\N	t	\N
1303	2015-04-03	2015040301035	234	150	\N	\N	t	\N
1304	2015-04-03	2015040301036	234	150	\N	\N	t	\N
1305	2015-04-03	2015040301037	234	150	\N	\N	t	\N
1306	2015-04-03	2015040301038	234	150	\N	\N	t	\N
1307	2015-04-03	2015040301039	234	150	\N	\N	t	\N
1308	2015-04-03	2015040301040	234	150	\N	\N	t	\N
1309	2015-04-03	2015040301041	234	150	\N	\N	t	\N
1310	2015-04-03	2015040301042	234	150	\N	\N	t	\N
1311	2015-04-03	2015040301043	234	150	\N	\N	t	\N
1312	2015-04-03	2015040301044	234	150	\N	\N	t	\N
1313	2015-04-03	2015040301045	234	150	\N	\N	t	\N
1314	2015-04-03	2015040301046	234	150	\N	\N	t	\N
1315	2015-04-03	2015040301047	234	150	\N	\N	t	\N
1316	2015-04-03	2015040301048	234	150	\N	\N	t	\N
1317	2015-04-03	2015040301049	234	150	\N	\N	t	\N
1318	2015-04-03	2015040301050	234	150	\N	\N	t	\N
1319	2015-04-03	2015040301051	234	150	\N	\N	t	\N
1320	2015-04-03	2015040301052	234	150	\N	\N	t	\N
1321	2015-04-03	2015040301053	234	150	\N	\N	t	\N
1322	2015-04-03	2015040301054	234	150	\N	\N	t	\N
1323	2015-04-03	2015040301055	234	150	\N	\N	t	\N
1324	2015-04-03	2015040301056	234	150	\N	\N	t	\N
1325	2015-04-03	2015040301057	234	150	\N	\N	t	\N
1326	2015-04-03	2015040301058	234	150	\N	\N	t	\N
1327	2015-04-03	2015040301059	234	150	\N	\N	t	\N
1328	2015-04-03	2015040301060	234	150	\N	\N	t	\N
1329	2015-04-03	2015040301061	234	150	\N	\N	t	\N
1330	2015-04-03	2015040301062	234	150	\N	\N	t	\N
1331	2015-04-03	2015040301063	234	150	\N	\N	t	\N
1332	2015-04-03	2015040301064	234	150	\N	\N	t	\N
1333	2015-04-03	2015040301065	234	150	\N	\N	t	\N
1334	2015-04-03	2015040301066	234	150	\N	\N	t	\N
1335	2015-04-03	2015040301067	234	150	\N	\N	t	\N
1336	2015-04-03	2015040301068	234	150	\N	\N	t	\N
1337	2015-04-03	2015040301069	234	150	\N	\N	t	\N
1338	2015-04-03	2015040301070	234	150	\N	\N	t	\N
1339	2015-04-03	2015040301071	234	150	\N	\N	t	\N
1340	2015-04-03	2015040301072	234	150	\N	\N	t	\N
1341	2015-04-03	2015040301073	234	150	\N	\N	t	\N
1342	2015-04-03	2015040301074	234	151	\N	\N	t	\N
1343	2015-04-03	2015040301075	234	151	\N	\N	t	\N
1344	2015-04-03	2015040301076	234	151	\N	\N	t	\N
1345	2015-04-03	2015040301077	234	151	\N	\N	t	\N
1346	2015-04-03	2015040301078	234	151	\N	\N	t	\N
1347	2015-04-03	2015040301079	234	151	\N	\N	t	\N
1348	2015-04-03	2015040301080	234	151	\N	\N	t	\N
1349	2015-04-03	2015040301081	234	151	\N	\N	t	\N
1350	2015-04-03	2015040301082	234	151	\N	\N	t	\N
1351	2015-04-03	2015040301083	234	151	\N	\N	t	\N
1352	2015-04-03	2015040301084	234	151	\N	\N	t	\N
1353	2015-04-03	2015040301085	234	151	\N	\N	t	\N
1354	2015-04-03	2015040301086	234	151	\N	\N	t	\N
1355	2015-04-03	2015040301087	234	151	\N	\N	t	\N
1356	2015-04-03	2015040301088	234	151	\N	\N	t	\N
1357	2015-04-03	2015040301089	234	151	\N	\N	t	\N
1358	2015-04-03	2015040301090	234	151	\N	\N	t	\N
1359	2015-04-03	2015040301091	234	151	\N	\N	t	\N
1360	2015-04-03	2015040301092	234	151	\N	\N	t	\N
1361	2015-04-03	2015040301093	234	151	\N	\N	t	\N
1362	2015-04-03	2015040301094	234	151	\N	\N	t	\N
1363	2015-04-03	2015040301095	234	151	\N	\N	t	\N
1364	2015-04-03	2015040301096	234	151	\N	\N	t	\N
1365	2015-04-03	2015040301097	234	151	\N	\N	t	\N
1366	2015-04-03	2015040301098	234	151	\N	\N	t	\N
1367	2015-04-03	2015040301099	234	151	\N	\N	t	\N
1368	2015-04-03	2015040301100	234	151	\N	\N	t	\N
1369	2015-04-03	2015040301101	234	151	\N	\N	t	\N
1370	2015-04-03	2015040301102	234	151	\N	\N	t	\N
1371	2015-04-03	2015040301103	234	151	\N	\N	t	\N
1372	2015-04-03	2015040301104	234	151	\N	\N	t	\N
1373	2015-04-03	2015040301105	234	151	\N	\N	t	\N
1374	2015-04-03	2015040301106	234	151	\N	\N	t	\N
1375	2015-04-03	2015040301107	234	151	\N	\N	t	\N
1376	2015-04-03	2015040301108	234	151	\N	\N	t	\N
1377	2015-04-03	2015040301109	234	151	\N	\N	t	\N
1378	2015-04-03	2015040301110	234	151	\N	\N	t	\N
1379	2015-04-03	2015040301111	234	151	\N	\N	t	\N
1380	2015-04-03	2015040301112	234	151	\N	\N	t	\N
1381	2015-04-03	2015040301113	234	151	\N	\N	t	\N
1382	2015-04-03	2015040301114	234	151	\N	\N	t	\N
1383	2015-04-03	2015040301115	234	151	\N	\N	t	\N
1384	2015-04-03	2015040301116	234	151	\N	\N	t	\N
1385	2015-04-03	2015040301117	234	151	\N	\N	t	\N
1386	2015-04-03	2015040301118	234	151	\N	\N	t	\N
1387	2015-04-03	2015040301119	234	151	\N	\N	t	\N
1388	2015-04-03	2015040301120	234	151	\N	\N	t	\N
1389	2015-04-03	2015040301121	234	151	\N	\N	t	\N
1390	2015-04-03	2015040301122	234	151	\N	\N	t	\N
1391	2015-04-03	2015040301123	234	151	\N	\N	t	\N
1392	2015-04-03	2015040301124	234	151	\N	\N	t	\N
1393	2015-04-03	2015040301125	234	151	\N	\N	t	\N
1394	2015-04-03	2015040301126	234	151	\N	\N	t	\N
1395	2015-04-03	2015040301127	234	151	\N	\N	t	\N
1396	2015-04-03	2015040301128	234	151	\N	\N	t	\N
1397	2015-04-03	2015040301129	234	151	\N	\N	t	\N
1398	2015-04-03	2015040301130	234	151	\N	\N	t	\N
1399	2015-04-03	2015040301131	234	151	\N	\N	t	\N
1400	2015-04-03	2015040301132	234	151	\N	\N	t	\N
1401	2015-04-03	2015040301133	234	151	\N	\N	t	\N
1402	2015-04-03	2015040301134	234	151	\N	\N	t	\N
1403	2015-04-03	2015040301135	234	151	\N	\N	t	\N
1404	2015-04-03	2015040301136	234	151	\N	\N	t	\N
1405	2015-04-03	2015040301137	234	151	\N	\N	t	\N
1406	2015-04-03	2015040301138	234	151	\N	\N	t	\N
1407	2015-04-03	2015040301139	234	151	\N	\N	t	\N
1408	2015-04-03	2015040301140	234	151	\N	\N	t	\N
1409	2015-04-03	2015040301141	234	151	\N	\N	t	\N
1410	2015-04-03	2015040301142	234	151	\N	\N	t	\N
1411	2015-04-03	2015040301143	234	151	\N	\N	t	\N
1412	2015-04-03	2015040301144	234	151	\N	\N	t	\N
1413	2015-04-03	2015040301145	234	151	\N	\N	t	\N
1414	2015-04-03	2015040301146	234	151	\N	\N	t	\N
1415	2015-04-03	2015040301147	234	151	\N	\N	t	\N
1416	2015-04-03	2015040301148	234	151	\N	\N	t	\N
1417	2015-04-03	2015040301149	234	151	\N	\N	t	\N
1418	2015-04-03	2015040301150	234	151	\N	\N	t	\N
1419	2015-04-03	2015040301151	234	151	\N	\N	t	\N
1420	2015-04-03	2015040301152	234	151	\N	\N	t	\N
1421	2015-04-03	2015040301153	234	151	\N	\N	t	\N
1422	2015-04-03	2015040301154	234	151	\N	\N	t	\N
1423	2015-04-03	2015040301155	234	151	\N	\N	t	\N
1424	2015-04-03	2015040301156	234	151	\N	\N	t	\N
1425	2015-04-03	2015040301157	234	151	\N	\N	t	\N
1426	2015-04-03	2015040301158	234	151	\N	\N	t	\N
1427	2015-04-03	2015040301159	234	151	\N	\N	t	\N
1428	2015-04-03	2015040301160	234	151	\N	\N	t	\N
1429	2015-04-03	2015040301161	234	151	\N	\N	t	\N
1430	2015-04-03	2015040301162	234	151	\N	\N	t	\N
1431	2015-04-03	2015040301163	234	151	\N	\N	t	\N
1432	2015-04-03	2015040301164	234	151	\N	\N	t	\N
1433	2015-04-03	2015040301165	234	151	\N	\N	t	\N
1434	2015-04-03	2015040301166	234	151	\N	\N	t	\N
1435	2015-04-03	2015040301167	234	151	\N	\N	t	\N
1436	2015-04-03	2015040301168	234	151	\N	\N	t	\N
1437	2015-04-03	2015040301169	234	151	\N	\N	t	\N
1438	2015-04-03	2015040301170	234	151	\N	\N	t	\N
1439	2015-04-03	2015040301171	234	151	\N	\N	t	\N
1440	2015-04-03	2015040301172	234	151	\N	\N	t	\N
1441	2015-04-03	2015040301173	234	151	\N	\N	t	\N
1442	2015-04-03	2015040301174	234	151	\N	\N	t	\N
1443	2015-04-03	2015040301175	234	151	\N	\N	t	\N
1444	2015-04-03	2015040301176	234	151	\N	\N	t	\N
1445	2015-04-03	2015040301177	234	151	\N	\N	t	\N
1446	2015-04-03	2015040301178	234	151	\N	\N	t	\N
1447	2015-04-03	2015040301179	234	151	\N	\N	t	\N
1448	2015-04-03	2015040301180	234	151	\N	\N	t	\N
1449	2015-04-03	2015040301181	234	151	\N	\N	t	\N
1450	2015-04-03	2015040301182	234	151	\N	\N	t	\N
1451	2015-04-03	2015040301183	234	151	\N	\N	t	\N
1452	2015-04-03	2015040301184	234	151	\N	\N	t	\N
1453	2015-04-03	2015040301185	234	151	\N	\N	t	\N
1454	2015-04-03	2015040301186	234	151	\N	\N	t	\N
1455	2015-04-03	2015040301187	234	151	\N	\N	t	\N
1456	2015-04-03	2015040301188	234	151	\N	\N	t	\N
1457	2015-04-03	2015040301189	234	151	\N	\N	t	\N
1458	2015-04-03	2015040301190	234	151	\N	\N	t	\N
1459	2015-04-03	2015040301191	234	151	\N	\N	t	\N
1460	2015-04-03	2015040301192	234	151	\N	\N	t	\N
1461	2015-04-03	2015040301193	234	151	\N	\N	t	\N
1462	2015-04-03	2015040301194	234	151	\N	\N	t	\N
1463	2015-04-03	2015040301195	234	151	\N	\N	t	\N
1464	2015-04-03	2015040301196	234	151	\N	\N	t	\N
1465	2015-04-03	2015040301197	234	151	\N	\N	t	\N
1466	2015-04-03	2015040301198	234	151	\N	\N	t	\N
1467	2015-04-03	2015040301199	234	151	\N	\N	t	\N
1468	2015-04-03	2015040301200	234	151	\N	\N	t	\N
1469	2015-04-03	2015040301201	234	151	\N	\N	t	\N
1470	2015-04-03	2015040301202	234	151	\N	\N	t	\N
1471	2015-04-03	2015040301203	234	151	\N	\N	t	\N
1472	2015-04-03	2015040301204	234	151	\N	\N	t	\N
1473	2015-04-03	2015040301205	234	151	\N	\N	t	\N
1474	2015-04-03	2015040301206	234	151	\N	\N	t	\N
1475	2015-04-03	2015040301207	234	151	\N	\N	t	\N
1476	2015-04-03	2015040301208	234	151	\N	\N	t	\N
1477	2015-04-03	2015040301209	234	151	\N	\N	t	\N
1478	2015-04-03	2015040301210	234	151	\N	\N	t	\N
1479	2015-04-03	2015040301211	234	151	\N	\N	t	\N
1480	2015-04-03	2015040301212	234	151	\N	\N	t	\N
1481	2015-04-03	2015040301213	234	151	\N	\N	t	\N
1482	2015-04-03	2015040301214	234	151	\N	\N	t	\N
1483	2015-04-03	2015040301215	234	151	\N	\N	t	\N
1484	2015-04-03	2015040301216	234	151	\N	\N	t	\N
1485	2015-04-03	2015040301217	234	151	\N	\N	t	\N
1486	2015-04-03	2015040301218	234	151	\N	\N	t	\N
1487	2015-04-03	2015040301219	234	151	\N	\N	t	\N
1488	2015-04-03	2015040301220	234	151	\N	\N	t	\N
1489	2015-04-03	2015040301221	234	151	\N	\N	t	\N
1490	2015-04-03	2015040301222	234	151	\N	\N	t	\N
1491	2015-04-03	2015040301223	234	151	\N	\N	t	\N
1492	2015-04-03	2015040301224	234	151	\N	\N	t	\N
1493	2015-04-03	2015040301225	234	151	\N	\N	t	\N
1494	2015-04-03	2015040301226	234	151	\N	\N	t	\N
1495	2015-04-03	2015040301227	234	151	\N	\N	t	\N
1496	2015-04-03	2015040301228	234	151	\N	\N	t	\N
1497	2015-04-03	2015040301229	234	151	\N	\N	t	\N
1498	2015-04-03	2015040301230	234	151	\N	\N	t	\N
1499	2015-04-03	2015040301231	234	151	\N	\N	t	\N
1500	2015-04-03	2015040301232	234	151	\N	\N	t	\N
1501	2015-04-03	2015040301233	234	151	\N	\N	t	\N
1502	2015-04-03	2015040301234	234	151	\N	\N	t	\N
1503	2015-04-03	2015040301235	234	151	\N	\N	t	\N
1504	2015-04-03	2015040301236	234	151	\N	\N	t	\N
1505	2015-04-03	2015040301237	234	151	\N	\N	t	\N
1506	2015-04-03	2015040301238	234	151	\N	\N	t	\N
1507	2015-04-03	2015040301239	234	151	\N	\N	t	\N
1508	2015-04-03	2015040301240	234	151	\N	\N	t	\N
1509	2015-04-03	2015040301241	234	151	\N	\N	t	\N
1510	2015-04-03	2015040301242	234	151	\N	\N	t	\N
1511	2015-04-03	2015040301243	234	151	\N	\N	t	\N
1512	2015-04-03	2015040301244	234	151	\N	\N	t	\N
1513	2015-04-03	2015040301245	234	151	\N	\N	t	\N
1514	2015-04-03	2015040301246	234	151	\N	\N	t	\N
1515	2015-04-03	2015040301247	234	151	\N	\N	t	\N
1516	2015-04-03	2015040301248	234	151	\N	\N	t	\N
1517	2015-04-03	2015040301249	234	151	\N	\N	t	\N
1518	2015-04-03	2015040301250	234	151	\N	\N	t	\N
1519	2015-04-03	2015040301251	234	151	\N	\N	t	\N
1520	2015-04-03	2015040301252	234	151	\N	\N	t	\N
1521	2015-04-03	2015040301253	234	151	\N	\N	t	\N
1522	2015-04-03	2015040301254	234	151	\N	\N	t	\N
1523	2015-04-03	2015040301255	234	151	\N	\N	t	\N
1524	2015-04-03	2015040301256	234	151	\N	\N	t	\N
1525	2015-04-03	2015040301257	234	151	\N	\N	t	\N
1526	2015-04-03	2015040301258	234	151	\N	\N	t	\N
1527	2015-04-03	2015040301259	234	151	\N	\N	t	\N
1528	2015-04-03	2015040301260	234	151	\N	\N	t	\N
1529	2015-04-03	2015040301261	234	151	\N	\N	t	\N
1530	2015-04-03	2015040301262	234	151	\N	\N	t	\N
1531	2015-04-03	2015040301263	234	151	\N	\N	t	\N
1532	2015-04-03	2015040301264	234	151	\N	\N	t	\N
1533	2015-04-03	2015040301265	234	151	\N	\N	t	\N
1534	2015-04-03	2015040301266	234	151	\N	\N	t	\N
1535	2015-04-03	2015040301267	234	151	\N	\N	t	\N
1536	2015-04-03	2015040301268	234	151	\N	\N	t	\N
1537	2015-04-03	2015040301269	234	151	\N	\N	t	\N
1538	2015-04-03	2015040301270	234	151	\N	\N	t	\N
1539	2015-04-03	2015040301271	234	151	\N	\N	t	\N
1540	2015-04-03	2015040301272	234	151	\N	\N	t	\N
1541	2015-04-03	2015040301273	234	151	\N	\N	t	\N
1542	2015-04-03	2015040301274	234	151	\N	\N	t	\N
1543	2015-04-03	2015040301275	234	151	\N	\N	t	\N
1544	2015-04-03	2015040301276	234	151	\N	\N	t	\N
1545	2015-04-03	2015040301277	234	151	\N	\N	t	\N
1546	2015-04-03	2015040301278	234	151	\N	\N	t	\N
1547	2015-04-03	2015040301279	234	151	\N	\N	t	\N
1548	2015-04-03	2015040301280	234	151	\N	\N	t	\N
1549	2015-04-03	2015040301281	234	151	\N	\N	t	\N
1550	2015-04-03	2015040301282	234	151	\N	\N	t	\N
1551	2015-04-03	2015040301283	234	151	\N	\N	t	\N
1552	2015-04-03	2015040301284	234	151	\N	\N	t	\N
1553	2015-04-03	2015040301285	234	151	\N	\N	t	\N
1554	2015-04-03	2015040301286	234	151	\N	\N	t	\N
1555	2015-04-03	2015040301287	234	151	\N	\N	t	\N
1556	2015-04-03	2015040301288	234	151	\N	\N	t	\N
1557	2015-04-03	2015040301289	234	151	\N	\N	t	\N
1558	2015-04-03	2015040301290	234	151	\N	\N	t	\N
1559	2015-04-03	2015040301291	234	151	\N	\N	t	\N
1560	2015-04-03	2015040301292	234	151	\N	\N	t	\N
1561	2015-04-03	2015040301293	234	151	\N	\N	t	\N
1562	2015-04-03	2015040301294	234	151	\N	\N	t	\N
1563	2015-04-03	2015040301295	234	151	\N	\N	t	\N
1564	2015-04-03	2015040301296	234	151	\N	\N	t	\N
1565	2015-04-03	2015040301297	234	151	\N	\N	t	\N
1566	2015-04-03	2015040301298	234	151	\N	\N	t	\N
1567	2015-04-03	2015040301299	234	151	\N	\N	t	\N
1568	2015-04-03	2015040301300	234	151	\N	\N	t	\N
1569	2015-04-03	2015040301301	234	151	\N	\N	t	\N
1570	2015-04-03	2015040301302	234	151	\N	\N	t	\N
1571	2015-04-03	2015040301303	234	151	\N	\N	t	\N
1572	2015-04-03	2015040301304	234	151	\N	\N	t	\N
1573	2015-04-03	2015040301305	234	151	\N	\N	t	\N
1574	2015-04-03	2015040301306	234	151	\N	\N	t	\N
1575	2015-04-03	2015040301307	123	163	\N	\N	t	\N
1576	2015-04-03	2015040301308	123	164	\N	\N	t	\N
1577	2015-04-03	2015040301309	123	165	\N	\N	t	\N
1578	2015-04-03	2015040301310	123	166	\N	\N	t	\N
1579	2015-04-03	2015040301311	123	170	\N	\N	t	\N
\.


--
-- Name: elemento_individual_id_elemento_ind_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('elemento_individual_id_elemento_ind_seq', 1579, true);


--
-- Data for Name: encargado; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY encargado (id_encargado, id_tipo_encargado, nombres, apellidos, identificacion, cargo, asignacion, estado) FROM stdin;
1	2	Carlos 	Sanchez	912398744	1	\N	t
2	2	Juan	Perez	6776512736	2	\N	t
3	2	Geimy	Urrego	615231276123	3	\N	t
4	2	Milton 	Parra	9817239891923	4	\N	t
5	1	Edwin 	Sanchez	12312312312	\N	2	t
6	1	Tom Jerry 	SinPerder	12342342344	\N	1	t
7	1	Jarrison 	Caspa	987549644444	\N	3	t
8	1	Fernando 	Torrez	66453737387	\N	4	t
9	1	Diana 	Guayara	6262626298234792	\N	5	t
10	1	Violeta 	Sosa	102402394023	\N	6	t
12	1	Stiv	Verdugo	10265276984	\N	7	t
13	1	Jhon 	Castellanos	2142414121561	\N	8	t
14	1	Arturo 	Nomeacurerdo	62626252625920	\N	9	t
15	3	Eduardo	Castillo	72100506	\N	\N	t
16	3	Cristian 	Marquez	5536789202	\N	\N	t
17	3	Maria 	Garzon	55242426716	\N	\N	t
11	3	Luz 	Sarmiento	78288282	\N	\N	t
\.


--
-- Name: encargado_id_encargado_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('encargado_id_encargado_seq', 17, true);


--
-- Data for Name: entrada; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY entrada (id_entrada, fecha_registro, vigencia, clase_entrada, info_clase, tipo_contrato, numero_contrato, fecha_contrato, proveedor, numero_factura, fecha_factura, observaciones, acta_recibido, estado_entrada, estado_registro) FROM stdin;
6	2015-03-20	2015	1	27	3	0	0001-01-01	3	123123	2015-03-11	asdasdasd	3	1	t
\.


--
-- Name: entrada_id_entrada_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('entrada_id_entrada_seq', 6, true);


--
-- Data for Name: estado_baja; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY estado_baja (id_estado, descripcion) FROM stdin;
1	Servible
2	Inservible
3	Traslado Interno
4	Traslado Otra Entidad
5	Desmantelamiento (Académico y/o Administrativo)
\.


--
-- Name: estado_baja_id_estado_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('estado_baja_id_estado_seq', 5, true);


--
-- Data for Name: estado_elemento; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY estado_elemento (id_estado_elemento, id_elemento_ind, tipo_faltsobr, id_faltante, id_sobrante, id_hurto, observaciones, ruta_denuncia, nombre_denuncia, fecha_denuncia, fecha_hurto, fecha_registro, estado_registro) FROM stdin;
1	251	2	0	0	1	huret	http://localhost/arka/blocks/inventarios/gestionElementos/registrarFaltantesSobrantes/documento_denuncia/3e9dec_via valorizacion.pdf	via valorizacion.pdf	2015-03-13	2015-03-11	2015-03-16	t
2	255	1	0	1	0	12312321	NULL	NULL	0001-01-01	0001-01-01	2015-03-27	t
\.


--
-- Name: estado_elemento_id_estado_elemento_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('estado_elemento_id_estado_elemento_seq', 2, true);


--
-- Data for Name: estado_entrada; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY estado_entrada (id_estado, descripcion) FROM stdin;
1	Trámite
2	Aprovado
3	Devuelto
\.


--
-- Name: estado_entrada_id_estado_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('estado_entrada_id_estado_seq', 5, true);


--
-- Data for Name: forma_pago_orden; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY forma_pago_orden (id_forma_pago, descripcion) FROM stdin;
1	Pago Parcial
2	Pago Total
\.


--
-- Name: forma_pago_orden_id_forma_pago_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('forma_pago_orden_id_forma_pago_seq', 2, true);


--
-- Data for Name: funcionario; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY funcionario (id_funcionario, nombre, identificacion, dependencia) FROM stdin;
1	Stiv Verdugo	1026276984	4
3	Carlos Rojas	1100004	17
4	Stiv 	1026276984	11
5	Paulo Cesar	110202020	1
2	Violeta Sosa	11010023123	3
\.


--
-- Name: funcionario_id_funcionario_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('funcionario_id_funcionario_seq', 41, true);


--
-- Data for Name: historial_elemento_individual; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY historial_elemento_individual (id_evento, fecha_registro, elemento_individual, funcionario, descripcion_funcionario) FROM stdin;
1	2015-03-12	252	4	1026276984  -  Stiv 
2	2015-03-12	252	4	1026276984 - Stiv 
3	2015-03-12	252	4	1026276984 - Stiv 
4	2015-03-12	252	4	1026276984  -  Stiv 
5	2015-03-12	252	4	1026276984  -  Stiv 
6	2015-03-12	252	4	1026276984  -  Stiv 
7	2015-03-12	252	4	1026276984  -  Stiv 
8	2015-03-12	252	4	1026276984  -  Stiv 
9	2015-03-12	252	4	1026276984  -  Stiv 
10	2015-03-12	252	4	1026276984  -  Stiv 
11	2015-03-12	251	3	1100004  -  Carlos Rojas
12	2015-03-12	254	1	1026276984  -  Stiv Verdugo
13	2015-03-12	251	5	110202020  -  Paulo Cesar
14	2015-03-22	255	40	 - CORONADO SANCHEZ PAULO CESAR
15	2015-03-27	255	17	35455125 - MONTOYA CASTILLO MARIO
16	2015-04-07	255	11	 - ARANZALEZ GARCIA RAFAEL ENRIQUE
17	2015-04-07	255	11	 - ARANZALEZ GARCIA RAFAEL ENRIQUE
18	2015-04-07	255	11	 - ARANZALEZ GARCIA RAFAEL ENRIQUE
19	2015-04-07	255	11	 - ARANZALEZ GARCIA RAFAEL ENRIQUE
20	2015-04-07	255	3	 - PARSONS DELGADO ASTRID XIMENA
21	2015-04-07	255	40	 - CORONADO SANCHEZ PAULO CESAR
22	2015-04-07	255	9	 - CREDITOS CON EL ICETEX CREDITOS CON EL ICETEX CREDITOS CON EL ICETEX
23	2015-04-07	255	37	 - HUERTAS  NESTOR EMILIO
\.


--
-- Name: historial_elemento_individual_id_evento_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('historial_elemento_individual_id_evento_seq', 23, true);


--
-- Data for Name: info_clase_entrada; Type: TABLE DATA; Schema: arka_inventarios; Owner: postgres
--

COPY info_clase_entrada (id_info_clase, observacion, id_entrada, id_salida, id_hurto, num_placa, val_sobrante, ruta_archivo, nombre_archivo) FROM stdin;
1	123123	12313	123123	123	0	0	NULL	NULL
2	123123	12313	123123	123	0	0	NULL	NULL
3	Salida	123	123	123	0	0	NULL	NULL
4	Salida	123	123	123	0	0	NULL	NULL
5	Salida	123	123	123	0	0	NULL	NULL
6	Salida	123	123	123	0	0	NULL	NULL
7	Salida	123	123	123	0	0	NULL	NULL
8	Salida	123	123	123	0	0	NULL	NULL
9	asdasd	0	0	0	0	0	NULL	
10	asdasd	0	0	0	0	0	NULL	
11	qweqweqweqwewqe	0	0	0	0	0	NULL	
12	qweqweqweqwewqe	0	0	0	0	0	NULL	
13	qweqweqweqwewqe	0	0	0	0	0	NULL	
14	qweqweqweqwewqe	0	0	0	0	0	NULL	
15	qweqweqweqwewqe	0	0	0	0	0	http://localhost/arka/blocks/inventarios/gestionEntradas/registrarEntradas/actas/fa19c7_LISTA TESIS.xlsx	LISTA TESIS.xlsx
16	qweqweqweqwewqe	0	0	0	0	0	http://localhost/arka/blocks/inventarios/gestionEntradas/registrarEntradas/actas/a040d9_LISTA TESIS.xlsx	LISTA TESIS.xlsx
17	qweqweqweqwewqe	0	0	0	0	0	http://localhost/arka/blocks/inventarios/gestionEntradas/registrarEntradas/actas/929a46_LISTA TESIS.xlsx	LISTA TESIS.xlsx
18	qweqweqweqwewqe	0	0	0	0	0	http://localhost/arka/blocks/inventarios/gestionEntradas/registrarEntradas/actas/5268d9_LISTA TESIS.xlsx	LISTA TESIS.xlsx
19	qweqweqweqwewqe	0	0	0	0	0	http://localhost/arka/blocks/inventarios/gestionEntradas/registrarEntradas/actas/79a91b_LISTA TESIS.xlsx	LISTA TESIS.xlsx
20	qweqweqweqwewqe	0	0	0	0	0	http://localhost/arka/blocks/inventarios/gestionEntradas/registrarEntradas/actas/de88b0_LISTA TESIS.xlsx	LISTA TESIS.xlsx
21	123213123	123	123	123	0	0	NULL	NULL
22	Salidas	1233	123	123	0	0	NULL	NULL
23	Salidas	1233	123	123	0	0	NULL	NULL
24	asdasdasd eliana	123	123	123123123	0	0	NULL	NULL
26	adasd	123	123	123	0	0	NULL	NULL
25	Verdasd	123	123	0	123	123	http://localhost/arka/blocks/inventarios/gestionEntradas/registrarEntradas/actas/473010_via valorizacion.pdf	via valorizacion.pdf
27	adasdasdasd	123	123	123123	0	0	NULL	NULL
\.


--
-- Name: info_clase_entrada_id_info_clase_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: postgres
--

SELECT pg_catalog.setval('info_clase_entrada_id_info_clase_seq', 27, true);


--
-- Data for Name: informacion_presupuestal_orden; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY informacion_presupuestal_orden (id_informacion, vigencia_dispo, numero_dispo, valor_disp, fecha_dip, letras_dispo, vigencia_regis, numero_regis, valor_regis, fecha_regis, letras_regis, fecha_registro, estado_registro) FROM stdin;
1	2011	95	19710080	2011-01-17	Diecinueve Millones Setecientos Diez Mil Ochenta Pesos	2010	6095	5281316	2010-07-28	Cinco Millones Doscientos Ochenta y Un Mil Trescientos Dieciseis Pesos	2015-03-30	t
2	2011	95	19710080	2011-01-17	Diecinueve Millones Setecientos Diez Mil Ochenta Pesos	2010	6095	5281316	2010-07-28	Cinco Millones Doscientos Ochenta y Un Mil Trescientos Dieciseis Pesos	2015-03-30	t
3	2011	95	19710080	2011-01-17	Diecinueve Millones Setecientos Diez Mil Ochenta Pesos	2010	6095	5281316	2010-07-28	Cinco Millones Doscientos Ochenta y Un Mil Trescientos Dieciseis Pesos	2015-03-30	t
4	2011	95	19710080	2011-01-17	Diecinueve Millones Setecientos Diez Mil Ochenta Pesos	2010	6095	5281316	2010-07-28	Cinco Millones Doscientos Ochenta y Un Mil Trescientos Dieciseis Pesos	2015-03-30	t
5	2011	95	19710080	2011-01-17	Diecinueve Millones Setecientos Diez Mil Ochenta Pesos	2010	6095	5281316	2010-07-28	Cinco Millones Doscientos Ochenta y Un Mil Trescientos Dieciseis Pesos	2015-03-30	t
6	2011	95	19710080	2011-01-17	Diecinueve Millones Setecientos Diez Mil Ochenta Pesos	2010	6095	5281316	2010-07-28	Cinco Millones Doscientos Ochenta y Un Mil Trescientos Dieciseis Pesos	2015-03-30	t
7	2011	95	19710080	2011-01-17	Diecinueve Millones Setecientos Diez Mil Ochenta Pesos	2010	6095	5281316	2010-07-28	Cinco Millones Doscientos Ochenta y Un Mil Trescientos Dieciseis Pesos	2015-03-30	t
8	2009	599	11925600	2009-02-10	Once Millones Novecientos Veinticinco Mil Seiscientos Pesos	2012	497	17114340	2012-02-14	Diecisiete Millones Ciento Catorce Mil Trescientos Cuarenta Pesos	2015-03-30	t
9	2009	599	11925600	2009-02-10	Once Millones Novecientos Veinticinco Mil Seiscientos Pesos	2012	497	17114340	2012-02-14	Diecisiete Millones Ciento Catorce Mil Trescientos Cuarenta Pesos	2015-03-30	t
10	2011	99	29565120	2011-01-17	Veintinueve Millones Quinientos Sesenta y Cinco Mil Ciento Veinte Pesos	2011	124	19710080	2011-01-24	Diecinueve Millones Setecientos Diez Mil Ochenta Pesos	2015-03-30	t
11	2015	996	75042080	2015-02-16	Setenta y Cinco Millones Cuarenta y Dos Mil Ochenta Pesos	2010	390	5917187	2010-01-21	Cinco Millones Novecientos Diecisiete Mil Ciento Ochenta y Siete Pesos	2015-03-30	t
12	2015	996	75042080	2015-02-16	Setenta y Cinco Millones Cuarenta y Dos Mil Ochenta Pesos	2010	390	5917187	2010-01-21	Cinco Millones Novecientos Diecisiete Mil Ciento Ochenta y Siete Pesos	2015-03-30	t
13	2015	996	75042080	2015-02-16	Setenta y Cinco Millones Cuarenta y Dos Mil Ochenta Pesos	2010	390	5917187	2010-01-21	Cinco Millones Novecientos Diecisiete Mil Ciento Ochenta y Siete Pesos	2015-03-30	t
14	2015	996	75042080	2015-02-16	Setenta y Cinco Millones Cuarenta y Dos Mil Ochenta Pesos	2010	390	5917187	2010-01-21	Cinco Millones Novecientos Diecisiete Mil Ciento Ochenta y Siete Pesos	2015-03-30	t
15	2015	996	75042080	2015-02-16	Setenta y Cinco Millones Cuarenta y Dos Mil Ochenta Pesos	2010	390	5917187	2010-01-21	Cinco Millones Novecientos Diecisiete Mil Ciento Ochenta y Siete Pesos	2015-03-30	t
16	2015	996	75042080	2015-02-16	Setenta y Cinco Millones Cuarenta y Dos Mil Ochenta Pesos	2010	390	5917187	2010-01-21	Cinco Millones Novecientos Diecisiete Mil Ciento Ochenta y Siete Pesos	2015-03-30	t
17	2015	996	75042080	2015-02-16	Setenta y Cinco Millones Cuarenta y Dos Mil Ochenta Pesos	2010	390	5917187	2010-01-21	Cinco Millones Novecientos Diecisiete Mil Ciento Ochenta y Siete Pesos	2015-03-30	t
18	2015	996	75042080	2015-02-16	Setenta y Cinco Millones Cuarenta y Dos Mil Ochenta Pesos	2010	390	5917187	2010-01-21	Cinco Millones Novecientos Diecisiete Mil Ciento Ochenta y Siete Pesos	2015-03-30	t
19	2007	121	18215400	2007-01-26	Dieciocho Millones Doscientos Quince Mil Cuatrocientos  Pesos 	2011	87	33280000	2011-01-21	Treinta y Tres Millones Doscientos Ochenta Mil  Pesos 	2015-04-07	t
20	2007	121	18215400	2007-01-26	Dieciocho Millones Doscientos Quince Mil Cuatrocientos  Pesos 	2011	87	33280000	2011-01-21	Treinta y Tres Millones Doscientos Ochenta Mil  Pesos 	2015-04-07	t
21	2007	121	18215400	2007-01-26	Dieciocho Millones Doscientos Quince Mil Cuatrocientos  Pesos 	2011	87	33280000	2011-01-21	Treinta y Tres Millones Doscientos Ochenta Mil  Pesos 	2015-04-07	t
22	2007	121	18215400	2007-01-26	Dieciocho Millones Doscientos Quince Mil Cuatrocientos  Pesos 	2011	87	33280000	2011-01-21	Treinta y Tres Millones Doscientos Ochenta Mil  Pesos 	2015-04-07	t
23	2007	121	18215400	2007-01-26	Dieciocho Millones Doscientos Quince Mil Cuatrocientos  Pesos 	2011	87	33280000	2011-01-21	Treinta y Tres Millones Doscientos Ochenta Mil  Pesos 	2015-04-07	t
24	2007	121	18215400	2007-01-26	Dieciocho Millones Doscientos Quince Mil Cuatrocientos  Pesos 	2011	87	33280000	2011-01-21	Treinta y Tres Millones Doscientos Ochenta Mil  Pesos 	2015-04-07	t
25	2007	121	18215400	2007-01-26	Dieciocho Millones Doscientos Quince Mil Cuatrocientos  Pesos 	2011	87	33280000	2011-01-21	Treinta y Tres Millones Doscientos Ochenta Mil  Pesos 	2015-04-07	t
\.


--
-- Name: informacion_presupuestal_orden_id_informacion_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('informacion_presupuestal_orden_id_informacion_seq', 25, true);


--
-- Data for Name: items_actarecibido; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY items_actarecibido (id_items, id_acta, item, cantidad, descripcion, valor_unitario, valor_total, estado_registro, fecha_registro, id_salida) FROM stdin;
2	1	Televisor	12	Sony , LG	100000	1200000	\N	2014-10-11	0
3	1	sillas	12	Duplex	100000	1200000	\N	2014-10-11	0
4	1	pupitres	12	madera	100000	1200000	\N	2014-10-11	0
5	2	pupitres	12	madera	100000	1200000	\N	2014-10-11	0
7	2	tableros 	12	con pizarra y tiza	100000	1200000	\N	2014-10-11	0
6	2	sillas	12	Duplex	100000	1200000	\N	2014-10-11	0
11	3	muebles	12	Rimax	100000	1200000	\N	2014-10-11	36
10	3	software	12	Arcgis	100000	1200000	\N	2014-10-11	36
9	3	computadores	12	Asus	100000	1200000	\N	2014-10-11	36
8	3	cajas	12	carton	100000	1200000	\N	2014-10-11	36
\.


--
-- Name: items_actarecibido_id_items_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('items_actarecibido_id_items_seq', 4, true);


--
-- Data for Name: items_orden_compra; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY items_orden_compra (id_items, id_orden, item, unidad_medida, cantidad, descripcion, valor_unitario, valor_total, descuento) FROM stdin;
3	5	12	12	12	12	12	144	12
4	1	12	12	12	12	12	144	12
6	2	12	12	12	12	12	144	12
10	2	123	123	123	123	213	26199	123
14	3	12	12	12	12	12	144	12
15	3	12	21	12	12	12	144	21
\.


--
-- Name: items_orden_compra_id_items_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('items_orden_compra_id_items_seq', 15, true);


--
-- Data for Name: items_orden_compra_temp; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY items_orden_compra_temp (id_items, item, unidad_medida, cantidad, descripcion, valor_unitario, valor_total, descuento, seccion) FROM stdin;
1	tv 	UNd	132	123	123	16236	0	1427173461
2	tv 	UNd	132	123	123	16236	123	1427173563
3	tv 	UNd	132	123	123	16236	123	1427173754
4	tv 	UNd	132	123	123	16236	123	1427173775
5	tv 	UNd	132	123	123	16236	123	1427173810
6	tv 	UNd	132	123	123	16236	123	1427173843
7	tv 	UNd	132	123	123	16236	123	1427173877
8	tv 	UNd	132	123	123	16236	123	1427173981
9	tv 	UNd	132	123	123	16236	123	1427174086
10	qwe	12	12	12	12	144	0	12
11	tv	12	12	12	12	144	0	12
12	tv 	UNd	132	123	123	16236	123	1427174375
13	celuar	UND	123	weqw	123	15129	0	123123
14	tv 	UNd	132	123	123	16236	123	1427174604
15	tv 	UNd	132	123	123	16236	123	1427174622
16	tv 	UNd	132	123	123	16236	123	1427174636
17	tv 	UNd	132	123	123	16236	123	1427174660
18	tv 	UNd	132	123	123	16236	123	1427174683
19	tv 	UNd	132	123	123	16236	123	1427174823
20	celuaasr	12	12	12	12	144	0	12
21	tv 	UNd	132	123	123	16236	123	1427174958
22	cel	12	12	12	12	144	12	1427174986
23	tv 	UNd	132	123	123	16236	123	1427175118
25	tv 	UNd	132	123	123	16236	123	1427175217
26	celuaslase	12	21	12	12	252	12	1427204826
27	12	12	12	12	12	144	12	1427205986
28	12	12	12	12	12	144	12	1427206011
29	12	12	12	12	12	144	12	1427206047
30	12	12	12	12	12	144	12	1427206335
31	12	12	12	12	12	144	12	1427206427
32	12	12	12	12	12	144	12	1427206599
33	12	12	12	12	12	144	12	1427206639
34	12	12	12	12	12	144	12	1427206813
35	12	12	12	12	12	144	12	1427207047
36	Cqwe	qwe	111	11	11	1221	11	1427207304
37	12	12	12	12	12	144	12	1427207967
38	12	12	12	12	12	144	12	1427208851
39	12	12	12	12	12	144	12	1427208910
40	12	12	12	12	12	144	12	1427209025
41	12	12	12	12	12	144	12	1427210737
42	12	12	12	12	12	144	12	1427210857
43	12	12	12	12	12	144	12	1427210875
44	12	12	12	12	12	144	12	1427210932
45	12	12	12	12	12	144	12	1427213241
46	12	12	12	12	12	144	12	1427213604
47	12	12	12	12	12	144	12	1427213989
48	12	12	12	12	12	144	12	1427214049
49	12	12	12	12	12	144	12	1427214102
50	12	12	12	12	12	144	12	1427214225
51	12	12	12	12	12	144	12	1427214254
52	12	12	12	12	12	144	12	1427214275
53	12	12	12	12	12	144	12	1427214589
54	12	12	12	12	12	144	12	1427214605
55	12	12	12	12	12	144	12	1427214632
56	12	12	12	12	12	144	12	1427214641
57	12	12	12	12	12	144	12	1427214886
58	12	12	12	12	12	144	12	1427214945
59	12	12	12	12	12	144	12	1427214984
60	12	12	12	12	12	144	12	1427215021
61	12	12	12	12	12	144	12	1427215355
62	12	12	12	12	12	144	12	1427215363
63	12	12	12	12	12	144	12	1427215419
64	12	12	12	12	12	144	12	1427215851
65	12	12	12	12	12	144	12	1427215876
68	12	12	12	12	12	144	12	1427217877
69	12	12	12	12	12	144	12	1427705817
70	12	12	12	12	12	144	12	1427705969
71	12	12	12	12	12	144	12	1427706005
72	12	12	12	12	12	144	12	1427706023
73	12	12	12	12	12	144	12	1427706194
74	12	12	12	12	12	144	12	1427706266
75	12	12	12	12	12	144	12	1427706467
76	12	12	12	12	12	144	12	1427706517
77	12	12	12	12	12	144	12	1427706618
78	12	12	12	12	12	144	12	1427706652
79	12	12	12	12	12	144	12	1427706915
80	12	12	12	12	12	144	12	1427707028
81	12	12	12	12	12	144	12	1427707090
82	12	12	12	12	12	144	12	1427707108
83	12	12	12	12	12	144	12	1427707926
84	12	12	12	12	12	144	12	1427708851
85	12	21	12	12	12	144	21	1427708851
86	12	12	12	12	12	144	12	1427709136
87	12	21	12	12	12	144	21	1427709136
88	12	12	12	12	12	144	12	1427709174
89	12	21	12	12	12	144	21	1427709174
90	12	12	12	12	12	144	12	1427709187
91	12	21	12	12	12	144	21	1427709187
92	12	12	12	12	12	144	12	1427709225
93	12	21	12	12	12	144	21	1427709225
94	12	12	12	12	12	144	12	1427709540
95	12	21	12	12	12	144	21	1427709540
96	12	12	12	12	12	144	12	1427709731
97	12	21	12	12	12	144	21	1427709731
98	12	12	12	12	12	144	12	1427709784
99	12	21	12	12	12	144	21	1427709784
100	12	12	12	12	12	144	12	1427709859
101	12	21	12	12	12	144	21	1427709859
102	12	12	12	12	12	144	12	1427709946
103	12	21	12	12	12	144	21	1427709946
104	12	12	12	12	12	144	12	1427710083
105	12	21	12	12	12	144	21	1427710083
106	12	12	12	12	12	144	12	1427710153
107	12	21	12	12	12	144	21	1427710153
108	12	12	12	12	12	144	12	1427710175
109	12	21	12	12	12	144	21	1427710175
110	12	12	12	12	12	144	12	1427710241
111	12	21	12	12	12	144	21	1427710241
112	12	12	12	12	12	144	12	1427710254
113	12	21	12	12	12	144	21	1427710254
114	12	12	12	12	12	144	12	1427710272
115	12	21	12	12	12	144	21	1427710272
116	12	12	12	12	12	144	12	1427710302
117	12	21	12	12	12	144	21	1427710302
118	12	12	12	12	21	252	21	1427710554
119	12	12	12	12	21	252	21	1427710729
123	12	12	12	12	12	144	12	1427712266
124	12	21	12	12	12	144	21	1427712266
125	12	12	12	12	12	144	12	1427712355
126	12	21	12	12	12	144	21	1427712355
127	12	12	12	12	12	144	12	1427712599
128	12	21	12	12	12	144	21	1427712599
129	12	12	12	12	12	144	12	1427712732
130	12	21	12	12	12	144	21	1427712732
131	12	12	12	12	12	144	12	1427713212
132	12	21	12	12	12	144	21	1427713212
133	12	12	12	12	12	144	12	1427834356
134	12	21	12	12	12	144	21	1427834356
135	12	12	12	12	12	144	12	1427859055
136	12	21	12	12	12	144	21	1427859055
137	12	12	12	12	12	144	12	1427863180
138	12	21	12	12	12	144	21	1427863180
\.


--
-- Name: items_orden_compra_temp_id_items_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('items_orden_compra_temp_id_items_seq', 138, true);


--
-- Data for Name: modulos; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY modulos (id_modulos, modulos_descripcion) FROM stdin;
1	registrar Orden Compra
2	registrar Orden Servicios
\.


--
-- Name: modulos_id_modulos_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('modulos_id_modulos_seq', 2, true);


--
-- Data for Name: orden_compra; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY orden_compra (id_orden_compra, fecha_registro, info_presupuestal, rubro, obligaciones_proveedor, obligaciones_contratista, poliza1, poliza2, poliza3, poliza4, poliza5, lugar_entrega, destino, tiempo_entrega, forma_pago, supervision, inhabilidades, id_proveedor, ruta_cotizacion, nombre_cotizacion, id_dependencia, id_contratista, id_ordenador, subtotal, iva, total, valor_letras, vig_contratista, estado) FROM stdin;
1	2015-03-30	12	66	qwe	wqe	f	t	f	f	f	Administrativa	2	123	1	Paulo Cesar Coronado	Ninguna	3	http://localhost/arka/blocks/inventarios/gestionCompras/registrarOrdenCompra/cotizaciones/25a78c_horario eliana	horario eliana	39	29075	4	252	0	252	Doscientos Setenta y Siete Pesos Con Veinte Centavos	2015	t
2	2015-03-30	13	66	qwe	wqe	f	t	f	f	f	Administrativa	2	123	1	Paulo Cesar Coronado	Ninguna	3	http://localhost/arka/blocks/inventarios/gestionCompras/registrarOrdenCompra/cotizaciones/03af58_horario eliana	horario eliana	39	29075	4	252	0	252	Doscientos Setenta y Siete Pesos Con Veinte Centavos	2015	t
4	2015-03-30	18	66	qwe	wqe	f	t	f	f	f	Administrativa	2	123	1	Paulo Cesar Coronado	Ninguna	3	horario eliana	39	39	27	4	0	0	0	Doscientos Setenta y Siete Pesos Con Veinte Centavos	2015	t
3	2015-03-30	17	66	qwe	wqe	f	t	f	f	f	Administrativa	2	123	1	Paulo Cesar Coronado	Ninguna	3	horario eliana	39	39	27	4	288	0	288	Doscientos Setenta y Siete Pesos Con Veinte Centavos	2015	t
\.


--
-- Name: orden_compra_id_orden_compra_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('orden_compra_id_orden_compra_seq', 4, true);


--
-- Data for Name: orden_servicio; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY orden_servicio (id_orden_servicio, fecha_registro, info_presupuestal, dependencia_solicitante, rubro, objeto_contrato, poliza1, poliza2, poliza3, poliza4, duracion_pago, fecha_inicio_pago, fecha_final_pago, forma_pago, total_preliminar, iva, total, id_contratista, id_contratista_encargado, vig_contratista, id_ordenador_encargado, id_supervisor, estado) FROM stdin;
1	2015-04-07	24	3	66	Contratar para sufragar el pago para la certificación en fundamentos de ITIL fundamentos y COBIT 5 fundamentos, de los (---------------------------------------------), el cual se realizara en la ciudad de Bogotá.. La cotización hace parte integral de la orden de servicio. CLAUSULA PENAL PECUNIARIA: En caso de incumplimiento de la orden de servicio el contratista se obliga a pagar a la Universidad una suma equivalente al diez (10\\%) del valor total de la orden, a titulo de indemnización por los posibles perjuicios que le pueda ocasionar. FORMAS DE TERMINACION DE LA ORDEN: TERMINACION Y LIQUIDACION. El presente contrato se dará por terminado en los siguientes eventos: 1) Por extinción del plazo pactado para la ejecución. 2) A solicitud debidamente sustentada interpuesta por una de las partes, por lo menos con un (1) mes de anticipación. 3) Por acuerdo bilateral. 4) Por caso fortuito o fuerza mayor debidamente comprobados. En los eventos numerados con 2, 3 y 4 se deberá suscribir acta donde conste tal hecho. Una vez terminado el contrato se procederá a su liquidación. 5) Por incumplimiento del objeto contractual. Para tal efecto el SUPERVISOR debe proyectar la liquidación dentro de los tres (3) meses siguientes a la fecha de terminación, anexando: a) estado de cuenta; b) certificado de cumplimiento; y c) informe final de ejecución. La liquidación se efectuará de común acuerdo dentro de los tres (3) meses siguientes a la terminación del contrato. Si vencido este plazo el CONTRATISTA no se presenta a la liquidación o las partes no llegan a un acuerdo sobre el contenido de la misma, será practicada directa y unilateralmente por la UNIVERSIDAD o se adoptará por acto administrativo motivado, susceptible del recurso de reposición. PARAGRAFO. El CONTRATISTA autoriza con la firma del presente contrato a la UNIVERSIDAD para que los valores que se adeuden a las entidades del Sistema de Seguridad Social integral o parafiscales sean descontados directamente del saldo a su favor. De no existir saldo a favor del CONTRATISTA se hará efectiva la garantía única constituida. EL CONTRATISTA SE OBLIGA A: 1) Aceptar íntegramente las condiciones y obligaciones del presente CONTRATO y aquellas que de conformidad con la ley deben tener los contratos celebrados con la Administración Pública. 2) Entregar el objeto del contrato de conformidad con lo ofrecido en su propuesta la cual es parte integrante del presente contrato, respetando en todo caso las condiciones mínimas. 3) Mantener los precios contenidos ofrecidos en la propuesta. GARANTÍAS CONTRACTUALES El CONTRATISTA se obliga a constituir a favor de la Universidad, garantía única del contrato constituida en una Compañía de seguros legalmente establecida en Colombia que ampare los siguientes riesgos: siguientes garantías: Una GARANTÍA ÚNICA expedida por una entidad Bancaria o por una compañía de seguros legalmente establecida en Colombia y cuya póliza matriz haya sido aprobada por la Superintendencia Financiera; que ampare los siguientes riesgos:	t	f	t	f	20	2015-04-01	2015-04-21	La Universidad pagará el servicio a los treinta (30) días calendario, contados a partir de la radicación de la correspondiente factura con el visto bueno del supervisor del contrato y el último pago de parafiscale.s	1231233	0	1231233	43	29075	2015	12	69	t
2	2015-04-07	25	3	66	Contratar para sufragar el pago para la certificación en fundamentos de ITIL fundamentos y COBIT 5 fundamentos, de los (---------------------------------------------), el cual se realizara en la ciudad de Bogotá.. La cotización hace parte integral de la orden de servicio.\r\n\r\nCLAUSULA PENAL PECUNIARIA: En caso de incumplimiento de la orden de servicio el contratista se obliga a pagar a la Universidad una suma equivalente al diez (10\\\\%) del valor total de la orden, a titulo de indemnización por los posibles perjuicios que le pueda ocasionar.\r\n\r\nFORMAS DE TERMINACION DE LA ORDEN:\r\n TERMINACION Y LIQUIDACION. El presente contrato se dará por terminado en los siguientes eventos: 1) Por extinción del plazo pactado para la ejecución. 2) A solicitud debidamente sustentada interpuesta por una de las partes, por lo menos con un (1) mes de anticipación. 3) Por acuerdo bilateral. 4) Por caso fortuito o fuerza mayor debidamente comprobados. En los eventos numerados con 2, 3 y 4 se deberá suscribir acta donde conste tal hecho. Una vez terminado el contrato se procederá a su liquidación. 5) Por incumplimiento del objeto contractual. Para tal efecto el SUPERVISOR debe proyectar la liquidación dentro de los tres (3) meses siguientes a la fecha de terminación, anexando: a) estado de cuenta; b) certificado de cumplimiento; y c) informe final de ejecución. La liquidación se efectuará de común acuerdo dentro de los tres (3) meses siguientes a la terminación del contrato. Si vencido este plazo el CONTRATISTA no se presenta a la liquidación o las partes no llegan a un acuerdo sobre el contenido de la misma, será practicada directa y unilateralmente por la UNIVERSIDAD o se adoptará por acto administrativo motivado, susceptible del recurso de reposición.\r\n\r\nPARAGRAFO. El CONTRATISTA autoriza con la firma del presente contrato a la UNIVERSIDAD para que los valores que se adeuden a las entidades del Sistema de Seguridad Social integral o parafiscales sean descontados directamente del saldo a su favor. De no existir saldo a favor del CONTRATISTA se hará efectiva la garantía única constituida.\r\n\r\nEL CONTRATISTA SE OBLIGA  A:\r\n\r\n1) Aceptar íntegramente las condiciones y obligaciones del presente CONTRATO y aquellas que de conformidad con la ley deben tener los contratos celebrados con la Administración Pública.\r\n2) Entregar el objeto del contrato de conformidad con lo ofrecido en su propuesta la cual es parte integrante del presente contrato, respetando en todo caso las condiciones mínimas.\r\n3) Mantener los precios contenidos ofrecidos en la propuesta.\r\n\r\nGARANTÍAS CONTRACTUALES\r\nEl CONTRATISTA se obliga a constituir a favor de la Universidad, garantía única del contrato constituida en una Compañía de seguros legalmente establecida en Colombia que ampare los siguientes riesgos: siguientes garantías: Una GARANTÍA ÚNICA expedida por una entidad Bancaria o por una compañía de seguros legalmente establecida en Colombia y cuya póliza matriz haya sido aprobada por la Superintendencia Financiera; que ampare los siguientes riesgos:	t	f	t	f	20	2015-04-01	2015-04-21	La Universidad pagará el servicio a los treinta (30) días calendario, contados a partir de la radicación de la correspondiente factura con el visto bueno del supervisor del contrato y el último pago de parafiscale.s	1231233	0	1231233	44	29075	2015	12	70	t
\.


--
-- Name: orden_servicio_id_orden_servicio_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('orden_servicio_id_orden_servicio_seq', 2, true);


--
-- Data for Name: parrafos; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY parrafos (id_parrafos, parrafo, tipo_parrafo, modulo_parrafo, estado) FROM stdin;
3	La Universidad pagará el servicio a los treinta (30) días calendario, contados a partir de la radicación de la correspondiente factura con el visto bueno del supervisor del contrato y el último pago de parafiscale.s	Forma de Pago	2	t
2	Contratar para sufragar el pago para la certificación en fundamentos de ITIL fundamentos y COBIT 5 fundamentos, de los (---------------------------------------------), el cual se realizara en la ciudad de Bogotá.. La cotización hace parte integral de la orden de servicio.\n\nCLAUSULA PENAL PECUNIARIA: En caso de incumplimiento de la orden de servicio el contratista se obliga a pagar a la Universidad una suma equivalente al diez (10%) del valor total de la orden, a titulo de indemnización por los posibles perjuicios que le pueda ocasionar.\n\nFORMAS DE TERMINACION DE LA ORDEN:\n TERMINACION Y LIQUIDACION. El presente contrato se dará por terminado en los siguientes eventos: 1) Por extinción del plazo pactado para la ejecución. 2) A solicitud debidamente sustentada interpuesta por una de las partes, por lo menos con un (1) mes de anticipación. 3) Por acuerdo bilateral. 4) Por caso fortuito o fuerza mayor debidamente comprobados. En los eventos numerados con 2, 3 y 4 se deberá suscribir acta donde conste tal hecho. Una vez terminado el contrato se procederá a su liquidación. 5) Por incumplimiento del objeto contractual. Para tal efecto el SUPERVISOR debe proyectar la liquidación dentro de los tres (3) meses siguientes a la fecha de terminación, anexando: a) estado de cuenta; b) certificado de cumplimiento; y c) informe final de ejecución. La liquidación se efectuará de común acuerdo dentro de los tres (3) meses siguientes a la terminación del contrato. Si vencido este plazo el CONTRATISTA no se presenta a la liquidación o las partes no llegan a un acuerdo sobre el contenido de la misma, será practicada directa y unilateralmente por la UNIVERSIDAD o se adoptará por acto administrativo motivado, susceptible del recurso de reposición.\n\nPARAGRAFO. El CONTRATISTA autoriza con la firma del presente contrato a la UNIVERSIDAD para que los valores que se adeuden a las entidades del Sistema de Seguridad Social integral o parafiscales sean descontados directamente del saldo a su favor. De no existir saldo a favor del CONTRATISTA se hará efectiva la garantía única constituida.\n\nEL CONTRATISTA SE OBLIGA  A:\n\n1) Aceptar íntegramente las condiciones y obligaciones del presente CONTRATO y aquellas que de conformidad con la ley deben tener los contratos celebrados con la Administración Pública.\n2) Entregar el objeto del contrato de conformidad con lo ofrecido en su propuesta la cual es parte integrante del presente contrato, respetando en todo caso las condiciones mínimas.\n3) Mantener los precios contenidos ofrecidos en la propuesta.\n\nGARANTÍAS CONTRACTUALES\nEl CONTRATISTA se obliga a constituir a favor de la Universidad, garantía única del contrato constituida en una Compañía de seguros legalmente establecida en Colombia que ampare los siguientes riesgos: siguientes garantías: Una GARANTÍA ÚNICA expedida por una entidad Bancaria o por una compañía de seguros legalmente establecida en Colombia y cuya póliza matriz haya sido aprobada por la Superintendencia Financiera; que ampare los siguientes riesgos:	Objeto Contrato	2	t
\.


--
-- Name: parrafos_id_parrafos_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('parrafos_id_parrafos_seq', 2, true);


--
-- Data for Name: polizas; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY polizas (id_polizas, poliza_1, poliza_2, poliza_3, poliza_4, poliza_5, modulo_tipo, estado) FROM stdin;
2	Póliza de calidad del servicio equivalente al veinte 20% del valor total del contrato incluido el iva, durante su ejecución y dieciocho (18) meses más.	Póliza de cumplimiento por el diez (10%) del valor total del contrato y con una vigencia igual a la del plazo del contrato y tres (3) meses más.	Póliza de amparo para el pago de salarios, prestaciones sociales e indemnizaciones por el 5% del valor del contrato por el termino de vigencia del contrato y tres meses más.	Responsabilidad civil frente a terceros: deberá ser equivalente a un 10% del valor total del contrato, por una vigencia igual a la misma y un (1) año más.	NULL	2	t
1	Póliza de amparo de anticipo, por una cuantiá equivalente al cien (100%) por ciento del monto que el contratista reciba como anticipo, con vigencia igual a la del contrato y tres (3) meses más.	Póliza De Amparo De Anticipo, Por Una Cuantia Equivalente Al Cien (100%) Por Ciento Del Monto Que El Contratista Reciba Como Anticipo, Con Vigencia Igual A La Del Contrato Y Un (1) Mes Mas.	Póliza de cumplimiento por el 10% del valor total, con una vigencia igual a la del plazo del contrato y tres (3) meses mas. una póliza de calidad y correcto funcionamiento por el término mínimo de un (1) año por el 20% del valor total incluido el iva.	Póliza De Cumplimiento Por El 10% Del Valor Total, Con Una Vigencia Igual A La Del Plazo Del Contrato Y Tres (3) Meses Mas. Una Poliza De Calidad Y Correcto Funcionamiento Por El Término Mínimo De Tres (3) Años Por El 20% Del Valor Total Incluido El Iva.	Póliza de amparo para el pago de salarios, prestaciones sociales e indemnizaciones por el 5% del valor del contrato por el termino de vigencia del contrato y tres meses más.	1	t
\.


--
-- Name: polizas_id_polizas_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('polizas_id_polizas_seq', 2, true);


--
-- Data for Name: proveedor; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY proveedor (id_proveedor, razon_social, nit_proveedor, direccion, telefono) FROM stdin;
1178	 DIAZ MERINO EVELYN	10425732949	MZA. G1 LOTE. 1 INT. PS.2 URB. SAN DIEGO VIPOL	949896461
1179	 MARIN CHAVEZ LIMBERS	10481389505	JR. JOSE BALTA NRO. 395 P.J. EL PROGRESO 1ER SECTOR	962797978
1180	 NAVARRO CHANG RITA YSABEL	10456259168	BL. C NRO. 403 C.HAB. JOSE BALTA (BLOCK C-N 403-43-4P)	0
1181	 PALOMINO BRAVO ANDREA PAULA	10453014067	JR. JOSE MARTIR OLAYA NRO. 643 URB. ZARUMILLA	0
1182	 QUISPE GONZALES LISETE YIZZA	10439062555	MZA. C LOTE. 10 ASOC. AAPITAC (ZONA D)	0
1183	 RIVERA AYALA MARIANO	10106451970	MZA. S LOTE. 8 A.H. FLORES DE VILLA	949822027
1184	 RODRIGUEZ GARCIA CARLA MARIBEL	10416552245	AV. CENTRAL NRO. 175 P.J. EL VOLANTE	962533449
1185	2001 OFFSET INDUSTRY SOCIEDAD COMERCIAL DE RESPONSABILIDAD LIMITADA- 2001 OFFSET INDUSTRY S.R.L.	20393013266	AV. LOS CORALES NRO. 375 URB. BALCONCILLO LIMA - LIMA - LA VICTORIA	2657350
1186	A. JAIME ROJAS REPRESENTACIONES GENERALES S.A.	20102032951	JR. GARCIA Y GARCIA N?? 870	7056500 7056539
1187	ABA SINGER & CIA S.A.C.	20100032881	CALLE MONTE ROSA N?? 240 OFICINA 1002 URB CHACARILLA DEL ESTANQUE	7195874-7195875-4715948
1188	ABANTO SARAVIA CAROL PAOLA	10099074642	AV. ENRIQUE FERMI NRO. 595 URB. FIORI (ALT. CDRA 14 DE ALFREDO MENDIOL	5340457
1189	ABARCA TORRES JHAGAYDA LIDD	10425811318	JR. DANIEL ALCIDES CARRION NRO. 108 URB. REYNOSO	0
1190	ACEVEDO PALIZA VANESSA DEL CARMEN	10467782610	MZA. P LOTE. 14 URB. SAN JOAQUIN IV ETAPA	0
1191	ACOSTA ATOCHE JUBITZA ELIZABETH	10438516455	JR. SANTA ROSA NRO. 126 (FRENTE A IE 094)	10438516455
1192	ACOSTA HOYOS MILUSKA ESTEFANY	10457510816	CAL. 1 MZA. B LOTE. 12 URB. RESD ALAMEDA DEL NORTE (ALT MERCADO 3 REGI	0
1193	ACOSTA NAVARRO ROSA YSABEL	10096940098	BL. 3C NRO. 1203 C.R. SAN FELIPE	0
1194	ACROTA CHOQUEHUANCA MATILDE	10700690879	JR. SAN MARTIN MZA. I LOTE. 13 BARRIO PROGRESO PUNO - AZANGARO - JOSE	0
1195	ADRIANZEN AYALA CRISTHEL LORENA	10452044612	CAL. JUAN FANNING NRO. 291 INT. 41 C.C. LA GRUTA DE CRISTAL (STAND 41)	980240371
1196	ADRIAZOLA IQUE GABRIELLA JOYCELINE	10450159421	BL. E NRO. . DPTO. 42 RES. M. SCORZA	2711604
1197	AGUILAR MATTOS LAURA CRISTINA	10407209562	PJ. 30 AMIGOS LOTE. 24 ??A??A (ALTURA KM 19.5 DE LA CARRETERA CENTRAL)	9922-79536
1198	AGUILAR RAMOS ROXANA MILAGROS	10407448524	JR. ACOMAYO NRO. 251 DPTO. 409	0
1199	AGUILAR ROJAS ROLY PABLO	10414262533	MZA. ?? LOTE. 13 ASOC.VIV.ROSARIO DEL NORT LIMA - LIMA - SAN MARTIN DE	988105278
1200	AGUILAR ROMERO ELIDA CELESTINA	10006829959	CAL. TARAPACA NRO. 802 P.J. VIGIL	0
1201	AGUILAR YZQUIERDO JEFFER EDHITSON	10460892568	JR. PRLG.LOS FRESNOS MZA. Z LOTE. 13 URB. PRADERAS DE LA MOLINA	577-7043
1202	AGUINAGA CHIRINOS CESAR ANTONIO	10101441402	CAL. LOS LAURELES NRO. 240 URB. SALAVERRY LAMBAYEQUE - CHICLAYO - CHIC	0
1203	AGUIRRE CHIRI MARCELO ANDRES	10400302290	BL. EDIFICIO V INGRESO 3 NRO. S/N INT. 10 AGRUPACION PALOMINO (ALT.CDR	564-2174
1204	AIQUE RIVAS OSMAR CELESTINO	10449064696	JR. LIBERTAD MZA. A LOTE. 9 CENT PAUCARBAMBILLA (A 1 CDRA DEL PUENTE S	0
1205	ALANOCA SAGUA LILIA CONCEPCION	10412086614	CAL. 08 DE SETIEMBRE NRO. 1785 P.J. NATIVIDAD (FRENTE A PLAZA MANUEL A	0
1206	ALARCON ALARCON SEBASTIAN	10441912949	JR. MANCO SEGUNDO NRO. 520 DPTO. 301 URB. MARANGA (ESPALDA DE LA CLINI	942913167
1207	ALARCON BAUTISTA MARIA DORIS	10467383987	CAL. LETICIA NRO. 532 URB. CERCADO DE CHICLAYO LAMBAYEQUE - CHICLAYO -	980066838
1208	ALARCON LOPEZ MIRTHA REGINA	10464684153	JR. FEDERICO SANCHEZ NRO. 276	0
1209	ALBERTO CRUCES LINDA FLOR	10468152482	PJ. 9 MZA. B1 LOTE. 10 ASOC AMPL VIV CAUDIVILLA (AL FINAL DE LA AV LA	0
1210	ALBIS S.A.	20418140551	CAL LOS NEGOCIOS 185 URB. JARDIN	411-6300
1211	ALBORNOZ CHAVEZ EMPERATRIZ	10745746123	JR. ANTONIO PLASCENCIA MZA. Q11 LOTE. 19 URB. MRCAL CACERES LIMA - LIM	0
1212	ALCANTARA MIMBELA MIGUEL ANGEL	10450485549	"CALLE GRAU N?? 355 BLOCK ""C"" SPRO. 301 URB. CAMPOD??NICO"	0
1213	ALCANTARA POGGI JANETTE VANESSA	10401537363	CAL. UNO NRO. 131 URB. LAS MAGNOLIAS (CERCA AL CORTIJO)	445-1661
1214	ALFARO SALAZAR ALEX JULIO	10483255051	CAL. 4 MZA. I1-5 LOTE. 6 A.H. CORAZON DE MARIA A (A 3 CDRAS. MERCADO S	267-4224
1215	ALIAGA ALEJO JOSE	10065916440	CAL. CADIZ MZA. E LOTE. 17 URB. LA CAPILLA (ALT. FACULTA DE MEDICINA D	950921308
1216	ALIAGA QUISPE PATRICIA GASDALY	10442589742	JR. DEUSTUA NRO. 616 URB. LA PAMPILLA (FRENTE AL CENTRO DE SALUD DE LA	0
1217	ALLACARIMA ALLCCARIMA ANGUELINE WENDY	10706929628	MZA. P LOTE. 19 A.H. LOS OLIVOS DE PRO LIMA - LIMA - LOS OLIVOS	978738555
1218	ALLCCARIMA MARTINEZ FLOR MARGARITA	10106894201	CAL. 122 MZA. P LOTE. 19 A.H. LOS OLIVOS DE PRO	980813328
1219	ALLPANCCA PALOMINO DAVID	10457554503	AV. HUANTA MZA. X LOTE. 35	0
1220	ALTAMIRANO CABEZAS ERIKA MARGARITA	10439585086	JR. TACNA NRO. 232 AYACUCHO - HUAMANGA - SAN JUAN BAUTISTA	
1221	ALTAMIRANO QUINTANA ALICIA	10423383092	AV. JOSE MARIA ARGUEDAS N?? 603	944076445
1222	ALVARADO ALVARADO DEBORA DEL CARMEN	10054033724	AV. NAVARRO CAUPER NRO. 328 (ENTRE PEVAS Y CAUPER)	0
1223	ALVARADO AZURIN CARLA LORENA	10443303826	CAL. REPUBLICA DE PORTUGAL NRO. 247 INT. B URB. CHACRA COLORADA (ALT H	959363345
1224	ALVARADO PRINCIPE EUDOMILIA	10410413715	MZA. G5 LOTE. 7 URB. LAS GARDENIAS	955338259
1225	ALVAREZ ALVAREZ EDITH ADELA	10106662814	CAL. GRANDE MZA. I6 LOTE. 24 A.H. JOSE C. MARIATEGUI (CONCHA ACUSTICA	0
1226	ALVAREZ A??ACATA TRINIDAD INGRID	10296259492	TORRE 6 NRO. ---- DPTO. 502 VILLA MEDICA (POR LA UAP) AREQUIPA - AREQU	0
1227	ALVAREZ RAMOS CARMELA PIEDAD	10091574433	CALLE MARCELINO GONZALES N?? 250 URB. SANTA CATALINA	999006144/224-8935
1228	ALVAREZ SURITA MARIA ESTHER	10450959460	CAL. HUAMANTANGA NRO. 1001 CENTRO JAEN CAJAMARCA - JAEN - JAEN	0
1229	ALVAREZ YANA YOLANDA	10422644500	JR. AYAVIRI NRO. 236 PUNO - SAN ROMAN - JULIACA	0
1230	ALZA ZEVALLOS ANGELICA VICTORIA	10704112985	MZA. C LOTE. 23 A.V. ALEGRIA DE CARABAYLLO LIMA - LIMA - CARABAYLLO	941736069
1231	ALZAMORA LALUPU FIORELLA ROSA AMALIA	10413576445	JR. TRUJILLO NRO. 449 PIURA - PIURA - CATACAOS	0
1232	AMERICA MOVIL PERU S.A.C	20467534026	AV. Nicol??s de Arriola N?? 480, Piso 8, Urbanizaci??n Santa Catalina	613-1000
1233	AMESQUITA MENDIGURI ELIAN ELIETTE	10430214875	MZA. D LOTE. 4 URB. VILLA LAS CASUARINAS AREQUIPA - AREQUIPA - JOSE LU	0
1234	AMPUDIA LOZANO LILY MARLEY	10053910985	AV. QUI??ONEZ KM. 4.5 (HOSTAL MAYROS)	0
1235	ANCHARI OBLITAS YULIZA FRANCESCA	10704132978	CAL. SIMON BOLIVAR MZA. CC LOTE. 20B URB. ZARZUELA ALTA (COMITE 2 JUNT	0
1236	ANCHILLO TIMOTEO LIZ GENINA	10715625127	CAL. LOS NARANJOS MZA. B LOTE. 12 (CERCA A LA COOPERATIVA ANDACOCHA	0
1237	ANCRO S.R.L.	20431084172	AV. LOS CIPRESES NRO. 250 URB. LOS FICUS (PTE.SAT.ANITA,EVITAMIENTO.MZ	3624409
1238	ANDIA SANCHEZ PAULINA VERONICA	10403752296	AV. ICA NRO. 559 LIMA - LIMA - LIMA	0
1239	ANDRES HILARIO ROCIO	10422981034	JR. LOS ANDES NRO. C3 INT. 28 P.J. SAN LUIS (MZ C3 LT 28	0
1240	ANGULO RENGIFO DELTON JESUS	10400132408	JR. LIBERTAD MZA. 75 LOTE. 02 (FRENTE AL MUNICIPIO)	0
1241	APAESTEGUI PAREDES CESAR AUGUSTO	10072123455	CAL. COLOMA NRO. 130 LIMA - LIMA - PUEBLO LIBRE (MAGDALENA VIEJA	0
1242	APAICO HASQUIERI JENNY MARISOL	10705674740	JR. LORETO 1274 MZA. C LOTE. 3A A.H. RUGGIA PROV. CONST. DEL CALLAO -	955403656
1243	APAZA COYLA YANET YOVANA	10428961566	AV. GUARDIA CIVIL SUR MZA. B LOTE. 38 URB. VI??AS DE SAN ANTONIO	0
1244	APAZA MEDINA ANGHI GLENI	10024180013	JR. MARIANO NU??EZ NRO. 1030 URB. LAS MERCEDES (A MEDIA CUADRA DEL PARA	0
1245	APONTE BERDEJO BETSY BERENICE	10406200642	PZA. BLOCK 53 NRO. S/N DPTO. B U.V. MIRONES (ESPALDA FAB. D'ONOFRIO	4254074
1246	AQUINO CONDOR AURELIO RAFAEL	10409842343	JR. LAS PALMERAS MZA. E LOTE. 13 APV. AGRICULTURA (ESPALDA DE LA UNDAC	0
1247	AQUINO CRUZADO SOCORRO DEL PILAR	10267227191	AV. INDEPENDENCIA NRO. 576 BR LA FLORIDA CAJAMARCA - CAJAMARCA - CAJAM	0
1248	ARAGON BASURCO CARMEN LIS	10428664626	NRO. E-1 DPTO. 104 ASOC. AMAUTA (CERCA AL ICPNA)	0
1249	ARAUJO DIAZ CELIA DAYANA	10454939218	JR. LA HISTORIA NRO. 291 BR MOLLEPAMPA	0
1250	ARAUJO QUIROZ ANDRES AVELINO	10714281181	PROL 20 DE DICIEMBRE NRO. 138	974673794
1251	ARAUJO QUIROZ CYNTHIA MARGARITA	10466841337	PROLONG. 20 DE DICIEMBRE NRO. 138 (PAYET. ALT ULTIMO PARAD DE LA LINEA	985316657
1252	ARELLANO BARDALES JUAN PABLO	10702707329	JR. TOMAS CATARI NRO. 813 URB. EL TREBOL LIMA - LIMA - LOS OLIVOS	6557693
1253	ARELLANO BARRETO JAIME JULIO	10074773066	JR. CRESPO Y CASTILLO NRO. 2674 P.J. MIRONES BAJO	961725562
1254	ARELLANO TORRES PAMELA KAREN	10430060096	AV. PARDO NRO. 328 CENT CERCADO ANCASH - SANTA - CHIMBOTE	0
1255	AREVALO RUIZ JENNIFER	10457470229	CAL. LOS CEDROS MZA. M LOTE. 15 A.H. LAS PALMAS	0
1256	ARIAS APARICIO ROSSMELI	10239980894	AV. ARCOPATA NRO. 339 (A LA VUELTA DE LA CALLE MELOC) CUSCO - CUSCO -	0
1257	ARIES COMERCIAL S.A.C	20101420591	AV. ELMER FAUCETT N?? 1814	464-5620 / 561-0710
1258	ARIZA BRAVO RUSBEL	10436232620	MZA. D LOTE. 14 LOS JAZMINES DEL NARANJAL	992-334301
1259	ARONES CAHUA YAQUELYN LISBETH	10445516690	MZA. I LOTE. 12 PACHACUTEC (CALLE R. CASTILLA ESPALDAS DEL COLEGIO	0
1260	ARRESE ALARCON KIARA ROSANELLY	10714676097	BL. 3 NRO. . DPTO. 40 URB. PALOMINO (ENTRADA 1	0
1261	ARRIETA JERI MARIA YSABEL	10419948395	PJ. LOS ANDES NRO. 264 (AL COSTADO DE INSTITUTO SAN PEDRO) JUNIN - HUA	0
1262	ARROSPIDE MEDINA MARIO ALFREDO	10082052068	CAL. CHARDIN NRO. 176 URB. SAN BORJA (ALT.36 AV.JAVIER PRADO ESTE)	4342816 / 995144788
1263	ARROYO RUIZ JULIO CESAR	10106895088	NRO. A INT. 3 URB. JOSE CARLOS MARIATEGUI (FRENTE DE EDELNOR) LIMA - L	0
1264	ARTEAGA PORRAS PAOLA LUZ	10705051467	JR. PABLO BERMUDEZ NRO. 115 (71362206-A 50 MT. DEL MERCADO DE FRUTAS)	971100099
1265	ARTEAGA TORRES ELIZABETH PAMELA	10418737242	CAL. LIBERTAD NRO. 107 (ALT DEL GRIFO MANILSA	0
1266	AS7 IMMOBILIEN CONSULTORES Y CONTRATISTAS S.A.C.	20552303076	JR. LAS MANDARINAS MZ. C LT. 17 URB. RESIDENCIAL MONTERRICO	436-1262
1267	ASCOY EGUILAS MILAGROS MERCEDES	10408948806	AV. ENRIQUE MEIGGS MZA. A2 LOTE. 20 URB. EL TRAPECIO III ETAPA (COSTAD	0
1268	ASENCIOS GUERRA VALERY VERONICA	10757171070	MZA. 45 LOTE. 11 HORTENCIAS (ALT. COLEGIO BELEN GRANDE) PROV. CONST. D	971910486
1269	ASHCALLA PACHECO MIGUEL ARTURO	10726861230	JR. POMABAMBA NRO. 432 INT. 203 (METRO DE ALFONSO UGARTE) LIMA - LIMA	983751790
1270	ASOCIACION GUARANGO CINE Y VIDEO	20251826774	JR. CAYETANO HEREDIA 785 - INT. 2 - JESUS MARIA	4601135
1271	ASTO VILCAS ALICIA CELINA	10404207283	AV. PER?? S/N PAMPA DEL CARMEN	964447638
1272	ASTOCONDOR ZU??IGA MIRIAM	10408682334	CAL. SACSAYHUAMAN NRO. 184 COO. 27 DE ABRIL (POR EL OVALO SANTA ANITA	0
1273	ASTORAYME VALENZUELA LADY LAURA	10448676990	AV. OSCAR R. BENAVIDES NRO. 599 (ESQUINA DE PLAZA DE ARMAS PUEBLO NUEV	0
1274	ATAO AYMA RUTH DINA	10425616809	MZA. D LOTE. 13 APV.SAN BENITO (SANTA ANA) CUSCO - CUSCO - CUSCO	0
1275	ATO AUDIOVISUALES TRADUCCION SIMULTANEA S.A.C	20513992425	AV. ARNALDO MARQUEZ NRO. 1683	261-2326
1276	AVELLANEDA GUERRERO REINERITA	10471368682	CALLE LAS GUINDAS N?? 108 PJ EL ERMITA??O	662-0537
1277	AYALA ASTUYAURI NILA	10103571036	MZA. Q.1 LOTE. 9 P.J. SN HILARION	0
1278	AYALA PLASENCIA ALAN JOEL	10406798840	CAL. FRANCISCA SANCHEZ PAGADOR NRO. 177 (CRUCE DE CUEVA CON AV. LA MAR	6478062
1279	AYALA ROMANI JUAN JOSE	10410780092	JR. JOSE PEZO MZA. 65 LOTE. 8B (ENTRADA A NUEVA REQUENA.)	0
1280	AYASTA CAPU??AY SARA DEISY	10432226528	CAL. SIMON BOLIVAR NRO. 303 CERCADO LAMBAYEQUE - CHICLAYO - MONSEFU	
1281	B. BRAUN MEDICAL PERU S.A.	20377339461	AV. SEPARADORA INDUSTRIAL 887 URB. MIGUEL GRAU	326-1825 / 326-6070
1282	BACA RODRIGUEZ ANA DEL PILAR	10456962896	JR. MADRE DE DIOS NRO. 442 SECTOR 08 (JR. MADRE DE DIOS 447)	0
1283	BAIGORRIA NOBLEGA SHIRLEY SOFIA	10424764898	AV. CHILE NRO. 310 URB. LAS AMERICAS (INTERIOR HOSPEFAJE) APURIMAC - A	0
1284	BALDARRAGO ARELA RIGOBERTO	10450550669	JR. ECUADOR NRO. 414 BR. UNION LLAVINI (A 2 CDRAS DE LA UNA PUNO	0
1285	BALDARRAGO FLORES EDERLYN GUISELLA	10402825613	AV. SAN FELIPE N?? 620 DPTO. 1401 - JESUS MARIA	980900649
1286	BALTA ALVA MANUEL GERARDO	10411598107	CAL. LAS BEGONIAS NRO. 230	0
1287	BALUARTE RONCEROS ARACELI CRISTINA	10425852936	JR. PUMACAHUA NRO. 1561 INT. C (2DO PISO/COSTADO DE LA MUNICIPALIDAD)	0
1288	BARDALES PE??A TANIA PATRICIA	10446423512	CAL. NAUTA NRO. 288 LORETO - MAYNAS - IQUITOS	0
1289	BARREROS CASTRO GUISELA	10400320948	CAL. MARTINEZ DE PINILLOS NRO. 123 URB. CAP J. QUI??ONES	999518959
1290	BARRETO VILLENA VIRGINIA YESSICA	10413989154	JR. MIGUEL DE ECHENIQUE NRO. 289 DPTO. 202 (ALT DEL MALECON) LIMA - LI	975398013
1291	BARRIOS CARPIO SILVIA LUZ	10440805651	JR. PIEROLA NRO. REF. (1115-A /A MEDIA CUADRA DE AV. MAESTRO) PUNO - S	0
1292	BARRIOS CRUZ NADIEHSKA SARA	10424536887	JR- R??MAC N?? 969	574-6040 / 990461167
1293	BASUALDO NAJERA KARLA DANA	10434832891	MZA. G LOTE. 9C ASOC.VIV.HIJOS APURIMAC (KM 10.5 DE LA CARRETERA CENTR	356-4368 / 956387520
1294	BAUTISTA SAIRITUPAC ESTHER JUANA	10402463703	PJ. MARISCAL SUCRE NRO. REF SECTOR LAS ALMENDRAS (FRENTE TALLER DE SOL	0
1295	BAZAN MONJA NARDA GISELA	10458199715	CAL. CANEPA NRO. 436 URB. LA PRIMAVERA (A ESPALDAS DEL MAESTRO HOME CE	0
1296	BECERRA SALAZAR CINTHYA LIZETH	10440517183	JR. BAMBAMARCA NRO. 388 BR LA MERCED	0
1297	BELLEZA FLORES VALERIA AIDA	10740883858	JR CHINCHAYSUYO 213 URB. MARANGA SAN MIGUEL	0
1298	BELTRAN PEREZ GUADALUPE	10024333481	JR. PIEROLA NRO. SN BR. TUPAC AMARU (A 2 CDRS DE LA COMISARIA) PUNO -	0
1299	BENAVIDES CASTILLO JUAN CARLOS	10003734981	MZ C NRO. 10 URB. LAS GARDENIAS	0
1300	BENITES SANCHEZ KELLY RITA	10416109503	PJ. B NRO. 136 INT. 2PSO URB. 28 D (ALT CDRA 10 AV MARIANO CORNEJO)	0
1301	BENITO TORRES SHARON GABRIELA	10701831727	HUANUCO NRO. 2723 URB. 3 MARIAS DE LA POLVORA (ALT DE LA CDRA 14 DE AV	0
1302	BERAUN CRUZ ELIAS LUIS	10453467215	BL. TOMAYQUICHUA MZA. F LOTE. 27 P.J. TOMAYQUICHUA	0
1303	BERNABEL RODRIGUEZ KAREM YESENIA	10708271069	BL. R NRO. 4 INT. 004 URB. PALOMARES (CRUCE CON AV. ALCAZAR)	0
1304	BERNAL GALLEGOS MARGOT	10250055973	NRO. S/N INT. S/N APV CRUZ VERDE QQUEHUAPAY	0
1305	BERNAOLA BELLO HENRY JOSE	10716058366	MZA. H LOTE. 201 C.H. JOSE DE TORRE UGARTE- (2DO PISO-2DA ETAPA-COST.M	0
1306	BERNARDO ARELLANO DIEGO JESUS	10476704974	JR. ISAAC NEWTON NRO. 2150 URB. EL TREBOL I ETAPA	9750-24333
1307	BERROCAL MORALES EMERSON DAVID	10062973744	CAL. ACACIAS MZA. J4 LOTE. 32 URB. SAN ISIDRO (A MEDIA CDRA DE MERCADO	2242624
1308	BERROCAL MORENO DE KAHN SARITA DEL PILAR	10105453162	JR. JOAQUIN BERNAL NRO. 486 (CDR.22 DE ARENALES.)	0
1309	BIOTOSCANA FARMA S.A. SUCURSAL PERU	20431224870	CALLE AMADOR MERINO REYNA 285 OF 902	4225500
1310	BLAS HUANCAS DIRLEY JULIA	10106323661	CALLE TIAHUANACO MZ. D1 LT. 1 PORTADA DEL SOL	0
1311	BLAS TRUJILLO ANGIE BRISETH	10770785257	PJ. SIN NOMBRE MZA. X LOTE. 34A BARR. LETICIA (ALT. DE ACHO	0
1312	BLITCHTEIN WINICKI DE LEVY DORA	15428386083	CAL. LOS NOGALES 765 402 (4TO.PISO)	422-9826
1313	BOHORQUEZ BARBA FIORELLA LUISA	10441765733	MZA. 18 LOTE. 18 A.H. VILLA CRISTO REY (ESPALDAS DEL COLEGIO CRISTO RE	0
1314	BOLIVAR HERRADA LUCIA MARGARITA	10038544867	JR. FRANCISCO IBA??EZ NRO. 132 BARRIO BELLAVISTA	0
1315	BONILLA CISNEROS DARWIN JOEL	10455942204	JR. D DE AG??ERO NRO. 311 DPTO. D LIMA - LIMA - SAN MIGUEL	694339284
1316	BORDA LOPEZ ERICK MAXIMO	10411916117	JR. AMERICO ORE NRO. 161	9668-05728
1317	BORGO??O ESPINOZA DAVID SIXTILO	10443884101	JR MARKHAN CLEMENT 337 403 LIMA	0
1318	BORJA PUCUHUARANGA EDITH NATALI	10436871622	MZA. L LOTE. 34 URB. LOS PORTALES	0
1319	BRAVO BARSALLO SIRIA FLORENCIA	10450316968	CAL. TARAPACA NRO. 130 CPM LAS MERCEDES LAMBAYEQUE - CHICLAYO - JOSE L	
1320	BRAVO SANCHEZ YOBANA MARILUZ	10432746629	JR. MANUEL UBALDE NRO. 126 (ESPALDAS DEL ESTADIO SEGUNDO ARANDA) LIMA	0
1321	BUENDIA CERRON CARLOS ALBERTO	10096157105	Calle Pierre Constant 320 Urb. Palao	4618715 / 945077614
1322	BUENO TEJADA GEOBANA ELIZABETH	10295022812	CAL. FRANCISCO BOLOGNESI NRO. 301 URB. BELLA PAMPA AREQUIPA - AREQUIPA	0
1323	BUJAICO HINOSTROZA ELIZABETH DIANA	10412861073	GUZMAN Y BARRON NRO. 2642 ELIO	0
1324	BURGA BOCANGEL ELSIE ROXANA	10094637401	AV. LOS PATRIOTAS NRO. 389 DPTO. 402 URB. MA	578-6686
1325	BURGOS COBE??AS ANITA MAGDALENA	10459193559	CAL. SAN MARTIN NRO. 1055 (A CUATRO CASAS DE ICPNA) PIURA - SULLANA -	0
1326	BUSINESS TECHNOLOGY SOCIEDAD ANONIMA	20521302390	AV. PASEO DE LA REPUBLICA NRO. 3127 DPTO. 501 RES. CORPAC	6160505
1327	BUSTAMANTE ESTELA EDER ROLANDO	10437951557	CAL. SAN ISIDRO NRO. 327 CERCADO (POR EL COLEGIO SALAVERRY) LAMBAYEQUE	966975829
1328	BUTRON GUEVARA CESAR DANIEL	10400380568	MZA. S LOTE. 06 URB. IGNACIO MERINO 2 ETAPA	0
1329	C.M.V. SERVICIO EJECUTIVO S.A	20291772286	AV. PAZ SOLDAN NRO. 170 INT. 701 (PISO 7) LIMA - LIMA - SAN ISIDRO	2190266
1330	CABALLERO GUTIERREZ ANGELA CAROL	10410499504	AV. JOSE LOPEZ PAZOS NRO. 1215 URB. REYNOSO (ALT.COMISARIA CARMEN DE L	4523720
1331	CABALLERO HERRERA ANNGIE ELISA	10401330645	BL. 4 NRO. _ DPTO. 101 C.H. ANGAMOS (PASEO DE LA REP.4886, EDIFICIO D)	659-4763
1332	CABRERA LLIUYAC NYRA MARGOTT	10097658116	AV. LIMA SUR NRO. 362 CHOSICA (STAND 02)	0
1333	CABRERA VIZCARRA CESAR AUGUSTO	10078612440	CAL. COPENHAGUE NRO. 103 URB. PORTALESDEJAVIERPRADO (ENTRADA RUINAS DE	0
1334	CABRERA YUPTON GLADYS MARIBELL	10409157535	JR. PABLO DE OLAVIDE N?? 548 URB. HUAQUILLAY	979017190
1335	CACERES NU??EZ OSCAR DANIEL	10096671968	AV. LURIGANCHO N?? 1121 URB. HORIZONTE DE ZARATE	3873617
1336	CACERES TINTAYA NESTOR	10421111958	JR. SANTA BARBARA NRO. 690 (A 2 CUADRAS DEL PODER JUDICIAL) PUNO - YUN	0
1337	CAJAS NAUPAY MIRIAHM	10404798397	JR. DON BOSCO NRO. 459 DPTO. 201	994705827
1338	CAJO GONZALES MARIA SOCORRO	10465389201	MZA. C LOTE. 01 C.H. BATANGRANDE LAMBAYEQUE - FERRE??AFE - FERRE??AFE	0
1339	CALDERON DELGADO CESAR GIANINO SHALON	10436657167	JR. KANTU MZA. I LOTE. 3 CUSCO - CANCHIS - SICUANI	0
1340	CALDERON TAVARA CARLOS GABRIEL	10434647458	AV. MARISCAL CASTILLA NRO. 529 (A MEDIA CUADRA DEL MERCADO MODELO) TUM	0
1341	CALERI PIZARRAS S.A.C.	20557492055	MZA. B LOTE. 22 COO. SAN JUAN DE SALINAS	0
1342	CALERO MIRANDA DORIS NILDA	10040637538	JR. C??SAR VALLEJO NRO. 207 URB. SAN JUAN	947482383
1343	CALIXTO VEGA NOELIA	10408357808	AV. TUPAC AMARU MZA. A2 LOTE. 8 (A 2CDRS DEL PARQUE SAN ANTONIO) LIMA	0
1344	CALLAN CONTRERAS CYNTHIA FELICITA	10701417670	AV. LOMAS DE CARABAYLLO MZA. B LOTE. 06 ASOC.PEC. VALLE SAGRADO	954481067
1345	CALLE SULCA ERICK ANTHONY	10762045881	PJ. EMANCIPACION MZA. Q2 LOTE. 05 A.H. MRCAL CASTILLA LIMA - LIMA - RI	3813669
1346	CALLIRGOS FLORES YECENIA CECILIA	10707908764	AV. MESONES MURO NRO. 121 SECTOR MORRO SOLAR CAJAMARCA - JAEN - JAEN	0
1347	CALUA FLORES JUAN CHRISTIAN	10437156854	PRLONG. PETATEROS NRO. 2246 SANTA ELENA ALTA CAJAMARCA - CAJAMARCA - C	0
1348	CAMAC TORIBIO JENNYFER KATHLEEN	10450954255	PJ. 15 DE AGOSTO NRO. 739 A.H. LA CANTUTA (A 1/2 CDRA DEL PARQUE BOLOG	0
1349	CAMARGO AGUILAR YOVANA HILDA	10413351036	MZA. A LOTE. 3 A.H. S. HERRERA (EN HOSPEDAJE MIRAFLORES 1 CDRA DE TERM	0
1350	CAMPOMANES TORRES SAUL EBER	10440525348	CAL. 12 DE FEBRERO MZA. N5 LOTE. 18 A.H. HEROE GUERRA DEL PACIFICO (EL	5295025
1351	CAMPOS BALLARTA CESAR JUNIOR	10424122934	FRANCISO SOLANO N?? 535  - PICHANAKI	0
1352	CAMPOS GARCIA PATRICIA ISABEL	10414339544	MZA. I LOTE. 03 URB. SAN JOAQUIN (IV ETAPA)	0
1353	CAMPOS SANCHEZ MIGUEL ANGEL	10061144001	JR. HAWAI NRO. 141 INT. A URB. SOL DE LA MOLINA 3 ETAPA LIMA - LIMA -	4791161
1354	CANO MENDOZA RUBEN ALONSO	10107361982	PQ. GRAU NRO. 75 DPTO. 202 (ALT CDRA 7 AV COLOMBIA	478-1548
1355	CAPCHA HUAMANI MERY LUZ	10413007548	CAL. FAUSTINO SILVA NRO. 480 URB. POP.CIUDAD DE DIOS	0
1356	CARCAHUSTO PUMA BERTHA NORMA	10015440339	JR. LEONCIO PRADO NRO. 889 BR. SAN MARTIN (AL COSTADO DEL COLEGIO VILL	0
1357	CARCAMO QUISPE EDUARDO ENRIQUE	10409860856	JR. VENUS NRO. 1058 URB. LA LUZ (ALT CRUCE AV BERTELLO CON 28 DE JULIO	998597052
1358	CARDENAS CUSIPUMA ADELMA	10443844061	JR. SAN MARTIN NRO. 250 (ENTRE JR MIGUEL GRAU Y FCO BOLOGNESI) JUNIN -	0
1359	CARDENAS SALINAS DE ESCALANTE NORMA BEATRIZ	10069089904	JR. 21 DE SETIEMBRE NRO. 616 P.J. LA LIBERTAD	0
1360	CARDENAS SEDANO LUZ NOHELY	10447048260	CAL. PASEO DE LA LIBERTAD NRO. 353	99194-5040
1361	CARDENAS SOTO YADIRA GERALDINE	10442555406	MZA. Q LOTE. 37 URB. COOPIP (ALT. DE BOCANEGRA)	0
1362	CARDENAS TAIPE ROSITA BLANCA	10406376589	JR. FRANCISCO IRAZOLA NRO. 353 (ALTURA PQUE PRINCIPAL) JUNIN - SATIPO	0
1363	CARDENAS VALVERDE SUSAN FABIOLA	10448896680	AV. PACHECO NRO. 1730 BARR. HUANUQUILLO ALTO (S.71191539A 1 CDRA LOCAL	0
1364	CARHUAS TINTAYA ROXANA CECILIA	10406630701	CAL. GRL JUAN VELASCO ALVARADO NRO. 335 P.J. HUASCAR (PTE ATARJEA)	0
1365	CARPIO GUTIERREZ VICENTE MANUEL	10432232633	MZA. F LOTE. 13 URB. MNO. BUSTAMANTE (A 1 CDRA DE ESCUELA MARIANO BUST	0
1366	CARPIO VASQUEZ GREYCI TATIANA	10459143969	CAL. MARISCAL LUZURIAGA NRO. 179 DPTO. 101 (ALT CDRA 12 DE GARZON) LIM	959203033
1367	CARPIO ZU??IGA CINTYA MASSIEL	10421029682	JR. CUZCO NRO. 411 P.J. BUENOS AIRES AREQUIPA - AREQUIPA - CAYMA	0
1368	CARRANZA ALEGRE LUZ VANESSA	10454515809	MZA. C LOTE. 19 A.H. RAMIRO PRIALE (POR EL COLEGIO NAZARENO)	978393743
1369	CARRANZA CORONEL NEYDI	10601583424	JOS?? CARLOS MARI??TEGUI N?? 281 NUEVA CAJAMARCA	0
1370	CARRASCO REYNA LUCIA ELIZABETH	10433822124	AV. ENRIQUE MEIGGS NRO. 631 P.J. MIRAMAR BAJO	0
1371	CARRILLO CUMPA VIOLETA LISSET	10449133477	AV. MARISCAL NIETO NRO. 245 CENTRO LAMBAYEQUE - CHICLAYO - CHICLAYO	
1372	CARRION ALCALDE ARLENE MELISA	10462095321	PJ. STA CLARITA NRO. 137 URB. SAN GREGORIO (ALT MDO SAN GREGORIO) LIMA	0
1373	CARRIZALES FLORINDEZ JOSE LUIS	10400698525	S. BONDY 115 EDF 20 TD 1 NRO. . DPTO. 206 (AL FRENTE INDECOPI)	9595-76781
1374	CASANOVA LEDO HILDA	10438991455	AV. FRANCISCA ZUBIAGA NRO. 417 (CERCA A LA OFICINA DE ELECTRO SUR ESTE	0
1375	CASAS LEVANO MARY LUISA	10434475126	CAL. LOS RUISE??ORES NRO. 676 URB. SANTA ANITA	987143277
1376	CASTA??EDA ALVARADO ROCIO ANGELICA	10097826621	AV. JOSE DE LA RIVA AGUERO NRO. 1824 URB. CORPORACION EL AGUSTINO LIMA	7332978
1377	CASTELO ZEVALLOS LILIANA ROCIO	10417127424	PJ. EX FUNDO MARQUEZ MZA. 72 LOTE. 22 PROV. CONST. DEL CALLAO - PROV.	0
1378	CASTILLO DE LA VEGA KATHERYNE BELEN	10449652351	SANCHEZ CERRO NRO. 413 PROGRESO (ALT COMISARIA EL PROGRESO CARABAYLLO	0
1379	CASTILLO DOZA DORIXA GRIZZELY	10158640622	JR. PROGRESO NRO. S/N SAN FRANCISCO (A 3 CASAS DEL COLEGIO AURORA	0
1380	CASTILLO SOTO PEDRO FELIX	10164008652	CALLE LAS LILAS N?? 128-132, DPTO. 306 / ED. G.VELARDE X	99856-7785
1381	CASTRO AZCARATE NORMA ELIANA	10422715318	MZA. B LOTE. 6 URB. MARIA AUXILIADORA (COSTADO DE COLEGIO MARIA DE NAZ	0
1382	CASTRO LUNA ANTONIO FLORENTINO	10093738514	PR JAVIER PRADO NRO. 9215 URB. PORTALES DE JAVIER PRADO (PORTALES DE J	428-5888
1383	CASTRO MEZA DE HORNA MELISSA ROSALVA	10107245869	AV. NICOLAS DE ARANIBAR NRO. 863 URB. SANTA BEATRIZ (3ER PISO)	666-2717
1384	CASTRO VALVERDE CINDY MILAGROS	10455269658	MZA. D LOTE. 23 URB. ANDRES RAZURI LA LIBERTAD - TRUJILLO - TRUJILLO	0
1385	CAVERO FLORES CLAUDIA YOLANDA	10450380216	JR. CAPULIES NRO. 201 URB. RECAUDADORES (ALT. CDRA 6 DE PARACAS)	436-4076
1386	CAVIEDES MAYORGA CATHERINE NIEVES	10467840946	JR. RICARDO PALMA NRO. 608 INT. 610 QUILLABAMBA (FRENTE AL GRIFO EL PI	0
1387	CAYCHO VALENCIA FELIX ALBERTO	10159925671	AV. EDUARDO DE HABICH 594 201 URB. INGENIERIA	483-0493 / 377-2263
1388	CAYTANO ROMAN LUZ ESPERANZA	10432232757	URB. HOYOS RUBIO Z-22 A.S.A	959077156
1389	CCACCA MAMANI ISABEL NOEMI	10097909038	CAL. K MZA. U' LOTE. 8 ASOC. VICTOR R H DE LA T	942445128
1390	CCAHUANA QUISPE ELIZABETH LIDIA	10425536791	PJ. VICTOR SANTANDER NRO. 157 (PARALELA FINAL AV. REAL.) CUSCO - CANCH	0
1391	CCASA CHINO INES LUCIA	10292007502	MZA. A LOTE. 2 A.H. JUAN VELASCO ALVARADO (A 3 CDRAS DEL COL. MILITAR	0
1392	CCOICCA ALMIDON FLOR	10438815525	CAL. 59 MZA. 132 LOTE. 28 A.H. ENRIQUE MILLA OCHOA	0
1393	CELIS SAAVEDRA MELISA	10444625797	PERU NRO. 522 HUAQUILLAY (ALT. DEL PARADERO CALLE OCHO)	0
1394	CENTURION Y AG??ERO CARLOS ALFREDO	10178524882	CAL. RICARDO ANGULO NRO. 545 DPTO. 101	0
1395	CERDA JALLO SONIA ESTEFANY	10710440307	MZA. A LOTE. 4 SEC. BELLA VISTA I (LA NUEVA RINCONADA PAMPLONA ALTA) L	9910-75257
1396	CERNA MACHACA JENNY ANDREA	10439864465	MZA. 12 LOTE. 1 S ANTONIO PEDREGAL (CHOSICA	0
1397	CERNA MENDOZA GALIA CAROL	10453153351	MZA. C LOTE. 16 A.V. ALEGRIA DE CARABAYLLO LIMA - LIMA - CARABAYLLO	994954742
1398	CERSSO BENDEZU CRISTIAN ANIBAL	10417467241	NRO. 314 PROLOG. CUTERVO ICA - ICA - ICA	41746724
1399	CERSSO BENDEZU RIVER REYNALDO	10215204516	ALM. DE LAS BELLAS ARTES NRO. 140 INT. 501 C.H. LIMATAMBO LIMA - LIMA	989977948
1400	CERVANTES RAMIREZ CELESTE AREMI	10445893001	MZA. E LOTE. 2 P.J. ALBERTO PORTELLA	0
1401	CGI CONTRATISTAS GENERALES S.A.C.	20514431362	AV. LOS FRESNOS NRO. 1361 URB. PORTADA DEL SOL 1ERA ETAP (ALT CDRA 12	0
1402	CHACA VALENTIN NIERI GLADYS	10073550187	CAL. LOS HORCONES MZA. M LOTE. 57 URB. LA CAPULLANA LIMA - LIMA - SANT	0
1403	CHAFLOQUE SEGOVIA GISELLA	10704462897	MZA. A LOTE. 31 A.V. SANTA ISABEL (COSTADO DEL COLEGIO JUANA MARLENE U	0
1404	CHAMBILLA APAZA LOURDES	10436583422	MZA. E LOTE. 2 URB. LOS PERALES	0
1405	CHAMOLI HERRERA GLENDY ROCIO	10433508373	CAL. BRASIL NRO. 1228 INT. B (POR LA ALZAMORA)	0
1406	CHAPILLIQUEN YOVERA CECILIA MERCEDES	10444947166	PJ. 2 MZA. C LOTE. 16 APV. CHIRA PIURA (POR LOS TALLANES.FRENTE A PLAT	0
1407	CHASKI, COMUNICACION AUDIOVISUAL	20510401809	AV. LIMA NRO. 927 (MALECON GRAU) LIMA - LIMA - CHORRILLOS	2513404
1408	CHAVARRY CAYAS JOANNA LIZBETH	10422935237	JR. ARICA NRO. 430 INT. 101 (CRUCE DE ANGAMOS CON CMDTE.ESPINAR	0
1409	CHAVEZ HUACCHA ROSMERY	10433980366	JR. 1 DE SETIEMBRE NRO. 300 (LUCUTORIO STAND 12 DENTRO DE TERMINAL	0
1410	CHAVEZ LOAYZA EDDY JORGE	10420483371	JR. J TORRE UGARTE NRO. 131 (ALT CDRA 21 DE JOSE GRANDA) LIMA - LIMA -	978944405
1411	CHAVEZ LUZON ROCIO MERCEDES	10410282271	CAL. MEDELLIN NRO. 155 INT. 2PIS URB. J.F. SANCHEZ CARRION	0
1412	CHAVEZ RARAZ NILDA LOURDES	10426152709	CAL. ANTONIO PORTUGAL NRO. 686 URB. FICUS (ALT. COLEGIO JOHN DALTON)	0
1413	CHAVEZ ZU??IGA MARJORIE SADID	10460404784	MZA. E LOTE. 16 DPTO. 201 URB. MAGISTERIAL II AREQUIPA - AREQUIPA - YA	0
1414	CHERO ORDO??EZ LILIANA MILAGROS	10446846189	CAL. MOCCE NRO. 107 UPIS SAN ANTONIO LAMBAYEQUE - LAMBAYEQUE - LAMBAYE	
1415	CHIHUAN MEJIA NESTOR PEDRO	10105949699	GRUPO 25 MZA. E LOTE. 9 SECTOR 3 (RUTA B CON VALLEJO)	287-3073 / 995544449
1416	CHIPANA ENCISO LOURDES	10430380074	MZA. F LOTE. 10 P.J. STA. ISABEL DE VILLA (ALTURA KM 17 PANAMERICANA S	0
1417	CHIPANA HUAMAN ALICET	10453545721	NRO. SN C.P. ECHARATI CIUDAD (FT MCDO LOCAL PROYECTO JASS F. SALAZAR)	0
1418	CHIRE CHIPANA LILY	10424753241	AV. FERIAL NRO. 588 URB. SANTA MARIA PUNO - SAN ROMAN - JULIACA	0
1419	CHOMBA CAMPOS MARIA ELIZABETH	10083894364	CAL. DO??A ROSA MERCEDES NRO. 133 URB. SANTA ROSA DE SURCO 2DA E (FRENT	0
1420	CHONG LOPEZ NORY MEYLIN	10414444623	MZA. I LOTE. 31 AG. MONTE AZUL (CUADRA 16 DE LA AV NARANJAL	0
1421	CHOQUE COA ELOY EZMER	10310441592	AV. PANAMA NRO. S/N (MZ A LT 16, 1CD PQ PIKICHAS) APURIMAC - ABANCAY -	
1422	CHOQUECCAHUA AYMA MARIA SALOME	10412492361	PJ. 2 MZA. G2 LOTE. 19 A.H. BOCANEGRA ZONA 5 PROV. CONST. DEL CALLAO -	0
1423	CHOQUEHUANCA VALERO YENI NOEMI	10441956822	JR. CAHUIDE NRO. 329 BARRIO MANCO CAPAC	0
1424	CHUMACERO PASAPERA JOHYSI JULIANA	10429784188	MZA. 13 LOTE. 15 A.H. SAN PEDRO PIURA - PIURA - PIURA	0
1425	CHUMBE ALVA KELVIN	10419876351	MZA. R LOTE. 19 APV. R.H. DE LA TORRE INDEP LIMA - LIMA - INDEPENDENCI	526-2491
1426	CHUMBILLUNGO REYES ERIKA ROSA	10701366145	MZA. BE LOTE. 18 URB. P. NUEVO BUENOS AIRES LIMA - HUAROCHIRI - SANTA	0
1427	CHUNGA CHAMBERGO JOSE CARLOS	10458259572	CAL. S/N MZA. S4 LOTE. 14 C DEL PESCADOR	968958273
1428	CHUQUISPUMA CAMPOS LIZETH MAGALY	10422480990	MZA. O2 LOTE. 3 A.H. BAYOBAR AMPLIACION (PARADERO 16 DE BAYOBAR) LIMA	0
1429	CIBERTEC PERU S.A.C.	20545739284	AV. 28 DE JULIO NRO. 1044 INT. 301 URB. SAN ANTONIO	419-2900
1430	CISNEROS CHAVEZ MONICA FLORINDA	10033845656	CAL. DO??A DELMIRA NRO. 228 DPTO. 401	5868302 / 997179932
1431	CISNEROS GUERRERO YESENIA MILAGROS	10479493346	CAL. H MZA. H1 LOTE. 15 A.H. SAN GENARO (ESPALDA DE COLEGIO JUAN PABLO	255-1450
1432	CISNEROS IGLESIAS BRIANDA BERUSHKA DE LOS MILAGROS	10466189451	MZA. C LOTE. 3B A.V. SAN ANDRES DE CARABAYLLO	980903332
1433	CISNEROS ROJAS ABEL	10408007408	JR. HUANUCO NRO. 338 INT. 1	999-524040
1434	COANDINA SRL	20100900247	CAL. LOS TALLADORES NRO. 353A URB. EL ARTESANO (ALT.CDRA.5 AV. LOS FRU	434-4188
1435	COLAN PALACIOS MARGOT YULIANA	10412733504	JR. CARAZ NRO. 991 URB. MERCURIO	0
1436	COLLAVE CARRANZA SEGUNDO ERNESTO	10452086846	CAL. HIPOLITO UNANUE NRO. 334 URB. LOS GRANADOS	0
1437	COLVI COM S.A. SOCIEDAD ANONIMA CERRADA	20101986315	AV. RAMON CASTILLA 128 URB. LA AURORA (ALT CRDA 59 DE AV REP. DE PANAM	241-2212
1438	COMERC. E IND DENT TARRILLO BARBA S.A.C	20100262291	AV. EMANCIPACI??N N?? 267	4286429 / 428-5171
1439	COMERCIAL DENIA S.A.C.	20427497888	AV. REP??BLICA DE COLOMBIA N?? 623	717-4555-118
1440	COMERCIAL GIOVA S.A.	20125412875	CALLE  LOS CORALES N?? 206 SANTA CATALINA	4729972 ANEXO203-204
1441	COMERCIAL VRAM S.A.	20268875426	JR. PACHITEA NRO. 261 LIMA - LIMA - LIMA	4282132
1442	COMERCIALIZADORA Y SERVICIOS HAMBERT E.I.R.L.	20462004380	CALLE. ROBLES APARICIO NRO. 1599 LIMA - LIMA - LIMA	336-5779
1443	COMESA??A REYES ROBERTO ESTEBAN	10418243916	JR. PABLO BERMUDEZ NRO. 285 INT. 304	992121839
1444	COMITE ADMI.FONDO.ASIST.Y ESTIMULO M.E.F	20456637796	JR. JUNIN 319 LIMA LIMA LIMA	428-2261
1445	CONDO ORTEGA FRANCISCO HENRRY	10075349195	CAL. CAPITAN D NAVIO FERREYROS MZA. C LOTE. 17 URB. RAFAEL ESCARDO (CD	0
1446	CONDOR ZU??IGA YAQUELIN JOYCE	10431334769	JR. JOSE PARDO NRO. 461 P.J. EL PROGRESO 1ER SECT. (ALT. KM. 19.5 DE L	954619776
1447	CONDORHUAMAN FIGUEROA ARTURO	10401032709	AV. EL SOL NRO. 176 (A 3 CDRAS DE LA PLAZA) CUSCO - URUBAMBA - HUAYLLA	0
1448	CONDORI IBARRA RITA	10101717335	MZA. 1 LOTE. 16 S.ANTONIO PEDREGAL ALTO (ESPALDA INSTITUTO RAMIRO PRIA	0
1449	CONDORI ORME??O MARIA DEL CARMEN	10214936785	JR. LOMA UMBROSA NRO. 213 INT. 2PIS URB. PROLONGACION BENAVIDES	0
1450	CONSTRUCCIONES DE ESTRUCTURAS METALICAS Y SERVICIOS SOCIEDAD COMERCIAL DE RESPONSABILIDAD LIMITADA	20507583114	AV. AV.REP DE POLONIA NRO. 1307 (ALT. CDRA. 13 AV. WIESSE) LIMA - LIMA	6056-750
1451	CONTRERAS ECOS FELICIA	10239264587	AV. ARICA NRO. 410 DPTO. 402 (ENTRE AV.ARICA Y HUARAZ) LIMA - LIMA - B	0
1452	CONTRERAS ESPINOZA MILAGROS	10408119761	MZA. R LOTE. 17 C.H. LA ANGOSTURA III ETAPA (FTE VALLE HERMOSO) ICA -	0
1453	CONTRERAS MATIAS JUAN CARLOS	10257667583	"JR. HUIRACOCHA N?? 1458 DPTO. ""J"""	4241897
1454	COPASA SERVICIOS GENERALES S.A.	20300706828	JR. CAILLOMA NRO. 124 DPTO. 309	4261283
1455	CORDAEZ E.I.R.L.	20507476547	AV. LA MARINA NRO. 785	261-5707
1456	CORDOVA LOPEZ MARTIN JOSE	10099678807	CAL. JUAN DE ARONA NRO. 124 URB. STA LUZMILA	986884092
1457	CORDOVA PURE MONICA	10077628571	JR. MANUELA ESTACIO N?? 152 DPTO. 202	0
1458	CORNEJO CARBAJAL PAOLA ELEANA	10461175967	JR. JAVIER HERAUD MZA. I LOTE. 2 (TERCER PISO, DEPARTAMENTO NRO. 8	0
1459	CORNEJO COAGUILA YENNY JULIA	10096517144	AV. SAN MARTIN DE PORRAS NRO. 443 URB. CANTO GRANDE (ALT. PARADERO 10	387-5132
1460	CORNEJO ZARATE JESSICA GIOVANNA	10258027332	MZA. K LOTE. 1 A.H. SARITA COLONIA (ALT. BASE NAVAL DEL CALLAO) PROV.	993246109
1461	CORONEL CHILCON INDIRA YOSUNI	10427183128	JR. ATAHUALPA NRO. 332 CERCADO CAJAMARCA - JAEN - JAEN	0
1462	CORONEL GUEVARA ANA	10069130190	CAL. ATAHUALPA NRO. MZ D INT. 35 URB. SAN AGUSTIN	0
1463	CORONEL URIONA FRANCISCO	10428463655	AV. PASEO DE LA CASTELLANA NRO. 1080 DPTO. 204 LIMA - LIMA - SANTIAGO	985208645
1464	CORPORACION BIOTEC S.A.C	20512356657	CAL. FLORA TRISTAN NRO. 449 (ENTRE LA CUADRA 8 Y 9 DE LA AV. PERSHING)	0
1465	CORPORACION GOURMET MARLU S.A.C	20563649357	CAL. HURTADO DE MENDOZA NRO. 375 URB. LA COLONIAL (CRUCE AV FAUCETT CO	9554-10280
1466	CORPORACION GRAFICA NOCEDA S.A.C.	20504793584	GENERAL VALERA 2030  PUEBLO LIBRE	4330154
1467	CORPORACION HOTELERA METOR S.A.	20386303003	AV. SALAVERRY N?? 2599	4119057
1468	CORREA HUAMAN VERONICA FELICITA	10441515311	CAL. LOS EUCALIPTOS MZA. L1 LOTE. 06 P.J. SAN HILARION	0
1469	COSI COSI ZULMA SONIA	10297017395	MZA. K LOTE. 30 URB. MINISTERIO AGRICULTURA (FRENTE DEL IREN) AREQUIPA	0
1470	COSTILLA GARCIA EDGARD LUIS	10400692616	NRO. E-6 URB. SANTA MARTHA CUSCO - CUSCO - SAN JERONIMO	3513020
1471	COTRINA IDRUGO YESSICA ROSSEVITH	10419496362	JR. AUGUSTO B. LEGUIA NRO. 118 BR. SAN JOSE CAJAMARCA - CAJAMARCA - CA	
1472	CRIOLLO TIMOTEO MARIA ELENA	10421851005	JR. LOS JAZMINES NRO. 748 PAUCARBAMBILLA	0
1473	CRUCES MONTOYA LHENA JHOSELINE	10067832804	CAL. 5 MZA. G LOTE. 14 URB. PORVENIR (MAR DEL CARIBE	0
1474	CRUZ CHILCON FATIMA LURDES	10460119958	CAL. MITIMAES NRO. 127 LAMBAYEQUE - CHICLAYO - LA VICTORIA	0
1475	CRUZ MAMANI JUAN VLADIMIR	10473276416	MZA. O LOTE. 27 URB. SAN IGNACIO 1RA ETAPA LIMA - LIMA - SAN JUAN DE L	959718044
1476	CRUZADO GIL ROSA JACKELINE	10450908067	CAL. PACHACUTEC NRO. 1754 P.J. EL BOSQUE LAMBAYEQUE - CHICLAYO - LA VI	
1477	CRUZADO MIRANDA ANITA MARIA	10105553116	MZA. D LOTE. 20 SECTOR VI GRUPO11 (CRUCE AV. VELASCO CON RUTA D	0
1478	CUBAS RUPAY JHANET	10451314951	JR. LLOQUE YUPANQUI NRO. 184	0
1479	CUENTAS BARRIOS CARLOS IVAN	10157267235	PROLONG.AUGUSTO B.LEGUIA NRO. 512	232-6206
1480	CULQUI VALLE DIANA VANESSA	10451522057	JR. AMAZONAS NRO. 336 AMAZONAS - CHACHAPOYAS - CHACHAPOYAS	0
1481	CULQUITANTE SANCHEZ KARLA BEATRIZ	10458717091	AV. INDOAMERICA NRO. 622 P.J. LA ESPERANZA LA LIBERTAD - TRUJILLO - LA	0
1482	CURIEL DEL AGUILA CLAUDIA DENISSE	10100005889	AV. SANTA ELVIRA NRO. 5980	421-2543
1483	CUSIHUALLPA BELLIDO HAYDEE	10409392232	MZA. I LOTE. 14 URB. VISTA ALEGRE (A 2 CASA GRIFO VISTA ALEGRE JR LAS	0
1484	CUTTI TRILLO MARIA JUSTINA	10222414020	NRO. P INT. 23 SECTOR PUBLICO AYACUCHO - HUAMANGA - AYACUCHO	0
1485	CUYA ACHAHUANCO KATHERINE SOFIA	10482880831	AV. GARCILASO DE LA VEGA NRO. 1055 A.H. 7 DE OCTUBRE	9804-87009
1486	CUZCANO CARHUAPOMA MARLENE	10100405569	CAL. LOS TUCANES NRO. 260 URB. SANTA ANITA 1ER SECTOR (ESPALDA CDRA 2	362-3716
1487	CUZCANO SAJAMI ROBERTO	10457331253	JR. LEONCIO PRADO NRO. 225 (POR LA ESCUELA MARGARITA)	0
1488	DADTHER HUAMAN YNDHIRA ZULLY	10407036331	MZA. B LOTE. 6 ASOC LOS PINOS DE LIMA (ALT 3 CDRAS DE DINOES) LIMA - L	0
1489	DANIEL ARMANDO RIVERA REGALADO	10067358177	Jr. Az??ngaro cdra. 4 puesto N?? 488 - Esquina con Miroquesada	381-3199
1490	DAVILA CHAVARRY JOSE LUIS	10446346909	CAL. PANAMA NRO. 1760 CPM URRUNAGA LAMBAYEQUE - CHICLAYO - JOSE LEONAR	979430600
1491	DAZA VELASQUEZ SUSANA BEATRIZ	10198300832	CAL. REAL NRO. 564	0
1492	DE LA CRUZ CCANTO GLADYS	10465357563	MZA. A LOTE. 01 PROG DE VIV LOS OLIVOS	949211773
1493	DE LA CRUZ ENCISO EDITH CINTIA	10415502813	JR. JOSE SANTOS CHOCANO NRO. 1170 (A UNA CUADRA DE LA POLICIA D TRANSI	
1494	DE LA CRUZ SANCHEZ JULIO	10425450447	CAL. SIN NOMBRE MZA. A LOTE. 07 A.V. LAS BEGONIAS LIMA - LIMA - PUENTE	944442240
1495	DE LA RIVA CHOQUE MADELEINE KARINA	10406938005	JR. AREQUIPA NRO. 1116 BARRIO VICTORIA PUNO - PUNO - PUNO	0
1496	DE LA TORRE MENDOZA INDIRA YOSHIMI	10466122705	AV. EL MINERO N?? 509	0
1497	DECOGAR S.A.C.	20500294508	AV. MEXICO NRO. 953 (CRUCE CON JR. CISNEROS) LIMA - LIMA - LA VICTORIA	7175419
1498	DEL CASTILLO PINTO MARIA RAFFAELLA	10406796316	LAS PALMERAS NRO. S/N DPTO. 902 (EDIFICIO LAS PALMERAS.CDRA 4 DE ESCOB	461-3435 / 988-347542
1499	DEL PINO CONDOR RONALD	10413881582	AV. SANTOS VILLA NRO. 282 (ESPALDA DE LA DRE HVCA)	0
1500	DEL VILLAR RAMIREZ LISSET	10460011073	MZA. F LOTE. 01 URB. MARIA PARADO DE BELLIDO AYACUCHO - HUAMANGA - AYA	0
1501	DELGADO AGUILAR RUBEN OMAR	10098469201	NRO. U INT. 15 ASOC.VIV.FORTALEZA	995-061007
1502	DELGADO CUBAS LUCERITO MAITHE	10464942721	MZA. A LOTE. 19 APV. LOS OLIVOS SAN MARTIN - MOYOBAMBA - MOYOBAMBA	979263846
1503	DELGADO MEGO ROSA ANITA	10473905014	PJ. UNO NRO. REF SECTOR NUEVO HORIZONTE (CA. JUAN VELASCO ALVARADO) CA	0
1504	DELGADO RIVERA TERRY	10732592925	CAL. VILLARAN NRO. 1094	222-1995
1505	DELGADO VARGAS SANDRA	10460295047	MZA. E2 LOTE. 11 URB. TUPAC AMARU (ENACO.POR EL POLICLINICO DE LA POLI	0
1506	DENEGRI MANRIQUE ESTEFANIA DESIRE	10726350065	JR. ANDAHUAYLAS NRO. 171 DPTO. B	428-0857
1507	DEPAZ COAQUIRA LYNN CAROL	10422043913	MZA. J LOTE. 12 A.H. MICAELA BASTIDAS SEC. II (ALT. DE LA DINOES	0
1508	DEZA FLORES NANCY ELIZABETH	10086943358	MZA. H LOTE. 4B A.H. ANTENOR ORREGO	0
1509	DIAZ ABANTO CANDY CAROL	10419932707	CAL. FRAY PEDRO URRACA NRO. 362 URB. SAN ANDRES I ETAPA LA LIBERTAD -	0
1510	DIAZ GUEVARA NIDIA	10421132777	JR. CARLOS LAGOMARCINO NRO. 236	0
1511	DIAZ HERRERA MELINA	10436674681	JR. DIEGO VILLACORTA NRO. 320 CAJAMARCA - CHOTA - CHOTA	0
1512	DIAZ MAYURI ITALO JAIME	10076083768	JR. FRANCISCO VALLEJO NRO. 366 CIUDAD DE DIOS ZONA A (ALT.AV.CARAVELI	276-6349
1513	DIAZ QUISPE ANTONI AYIN	10726925521	AV. MELLO FRANCO NRO. 223 URB. SAN FELI	481-7684
1514	DIAZ SANTOS CARMEN ROSA	10335880451	JR. ATAHUALPA NRO. 220 SECTOR 07	0
1515	DIPROINSA S.R.L.	20470538202	CAL. FERNANDO CASTRAT NRO. 310 DPTO. 303 URB. CHAMA	271-1645 / 271-1057
1516	DISTRIBUIDORA JOVAZA EIRL	20330055805	CAL. LAS AMANITAS NRO. 154 PROV. CONST. DEL CALLAO	5753900
1517	DOMADOR MIJA MARIXA	10430062498	MZA. O LOTE. 05 A.H. LOPEZ ALBUJAR PIURA - PIURA - PIURA	0
1518	DOMINGUEZ LOPEZ NELVA	10466500041	JR. BOLOGNESI N?? 216	997958778
1519	DOMINGUEZ MORALES MARIA LUISA	10434870076	CAL. LOS MANZANOS NRO. 114 URB. LAS DELICIAS LAMBAYEQUE - CHICLAYO - C	
1520	DONAYRE MU??OZ KAROL ANALI	10429307860	CALLE EMILIO FERNANDEZ N?? 663 DPTO. 1802 SANTA BEATRIZ	940285494
1521	DOROTEO MORENO MARIA	10080910547	NRO. MZ.O INT. LT38 A.H. LETICIA (ESPALDA DEL POTAO Y AV LETICIA	669-0411
1522	DOW S.A.	20381847927	AV. PRIMAVERA NRO. 1416 INT. 1 URB. C.C.MONTERRICO	4217188
1523	DROGUERIA INVERSIONES JPS SAC	20482137319	AV. AMERICA OESTE NRO. 160 URB. LOS CEDROS LA LIBERTAD - TRUJILLO - TR	0
1524	DURAND CASTILLO JANET EDITH	10458690150	JR. J. CARLOS MARIATEGUI MZA. H LOTE. 9 A.H. SAN ISIDRO ANCASH - CASMA	0
1525	E-BUSINESS DISTRIBUTION PERU S.A	20474529291	AV. JOSE GALVEZ BARRENECHEA N?? 996 - URB. CORPAC	712-5000
1526	EDIFICIOS Y CONST. SANTA PATRICIA S.A.	20110545798	CALLE SAN MARTIN N?? 305	610-7000/2107/2143
1527	EGOAVIL OCROSPOMA JHON ANTHONY	10726409337	AV. TUPAC AMARU NRO. 376 P.J. CLORINDA MALAGA DE PRADO	992054026
1528	ELECTRONICA MUSICAL SOCIEDAD ANONIMA CERRADA	20537679663	JR. PARURO NRO. 1382 CERCADO LIMA - LIMA - LIMA	428-0929
1529	ELEGANCIA Y SABOR S.A.C	20546329161	PJ. SANTA ROSA MZA. B LOTE. 3 LIMA - LIMA - SAN BORJA	2655440
1530	ELUQUIS HUERTAS MIRTHA SOLEDAD	10449053643	MZA. D LOTE. 15 A.H. 18 DE FEBRERO	0
1531	EMP SERVIC TURISTICOS COLON SAC	20462041587	CAL. COLON NRO. 600 URB. MIRAFLORES (ALT.CDR 12 DE AV.LARCO) LIMA	6100900 / 4442000
1532	"EMPRESA DE LA TECNOLOGIA ENERGIA Y CONSTRUCCION SOCIEDAD ANONIMA CERRADA-""EDELTEC S.A.C."""	20490969765	MZA. G LOTE. 6 URB. CRUZPATA (PSJE FRANCISCA ZUBIAGA X IE REP D MEXICO	0
1533	EMPRESA DE SERVICIOS GLOBALES S.A.C. - EMSERGLOBALES S.A.C.	20537285371	AV. VALLES DEL SUR NRO. 382 DPTO. 102	6529738 / 996626570
1534	EMPRESA EDITORA EL COMERCIO S.A.	20143229816	JR. ANTONIO MIRO QUESADA 300	311-6500
1535	EMPRESA PERUANA DE SERVICIOS EDITORIALES S.A.	20100072751	AV. ALFONSO UGARTE N?? 873	315-0400
1536	ENCISO MARTINEZ MAURA	10234655774	JR. ARICA N?? 381	0
1537	EQUIDATA S.A.C.	20473350271	JR. WASHINGTON NRO. 1105	6134760
1538	ESCAJADILLO LAGOS NATIVIDAD ROSARIO	10434552864	MZA. P LOTE. 02 P.J. ACOMAYO ZONA B (ANTES DE LLEGAR A LA PARROQUIA) I	0
1539	ESCAJADILLO PALOMINO MARIA	10425691932	CAL. V. M. MAURTUA NRO. 283	0
1540	ESPINOZA COVE??AS MIRYAM DONELLA	10258422142	AV. DOS DE MAYO 518	
1541	ESPINOZA LUNA TERESA ADITH	10457546870	AV. CANADA MZA. F-1 LOTE. 17 URB. SAN JUAN MASIAS (A MEDIA CUADRA DE L	0
1542	ESPINOZA RIMARI POOL DAVIS	10448259515	JR. LIBERTAD NRO. 250 (A1 CDRA. DEL COLEGIO LEV VITOSKY) JUNIN - TARMA	985037907
1543	ESPINOZA SILVA MAXIMO MANUEL	10087788151	CAL. LOMA RICA NRO. 191 URB. PROLONG.BENAVIDES LIMA - LIMA - SANTIAGO	2754099
1544	ESPINOZA SOLORZANO ROXANA YEZABEL	10181660380	AV. 28 DE JULIO N?? 465 DPTO. 402	953792274
1545	ESPINOZA VIVAS JAKELIN JUDITH	10464433347	JR. ALBERTO HIDALGO MZA. C LOTE. 16 COO. CANTO GRANDE (PARADERO 7 DE C	0
1546	ESPIRITU DIAZ CLELIA MYRIAM	10096274918	CAL. JOSE GALVEZ NRO. 264 URB. VALDIVIEZO (A 4 CDRAS DEL GRIFO PALAO)	0
1547	ESTRADA FERNANDEZ TADASKY ULIANOVA	10433861421	CAL. W. RODRIGUEZ NRO. 229 URB. PRIMAVERA	0
1548	ESTRELLA BRAVO LUIS SUNIL	10001278598	JR. LAS PALMERAS MZA. 238 LOTE. 17	0
1549	EUFRACIO BERNAL WENDY LUZ	10719428385	CAL. LAS ZUCENAS MZA. I LOTE. 17 ASOC.RESIDENCIAL MOSHA LIMA - LIMA -	0
1550	EVAISA SAC.	20555997931	JR. LOS LAURELES Mz ?? - LTE. 19 - SAN MIGUEL	5617567
1551	EVARISTO WHARTON SUSAN MARGOT	10404221847	JR. GENERAL PEZET NRO. 199 (ALT CDR 11 FRANC.PIZARRO Y CDR8 PROCERES)	338-7370
1552	FARFAN NAVENTA CRISTINA	10485237904	CAL. 7 MZA. J2 LOTE. 3 A.H. SAN GENARO II ETAPA	567-0054
1553	FARFAN SAAVEDRA MARIA DEL PILAR	10705650824	JR. LORETO NRO. 1131 BARRIO FISCAL (ALT DE LA COMISARIA ALIPIO PONSE)	9869-60520
1554	FARFAN TIRADO JOVANNA	10445436092	CAL. LA FLORIDA NRO. 136 URB. SAN ISIDRO	0
1555	FASCE LOMAS MERCEDES	10403433883	AV. AMAZONAS MZA. A LOTE. 10 ASOC.P.V.SANTA INES	0
1556	FERNANDEZ ASTETE IVONNE MABELL	10402942342	AV. LOS EUCALIPTOS NRO. 1171 INT. 201 COO. LA UNIVERSAL (ALT. A UNA CD	0
1557	FERNANDEZ BUENDIA LUISA LAURA	10434941658	JR. MARISCAL CASTILLA NRO. 2028 CHILCA SECTOR 11 (80MTRS D MARISCAL CA	0
1558	FERNANDEZ DE LA CRUZ GILBERTO OSWALDO	10455042769	CAL. TIPUANA TIPA NRO. 54 BARR. BARRIO OBRERO LA LIBERTAD - ASCOPE - C	0
1559	FERNANDEZ DELGADO LEOPOLDO ARTURO	10085576491	PSJE. FEDERICO SOTOMAYOR N?? 157 RESIDENCIAL GRAU	533-5921/ 990333555
1560	FIESTAS BAZALAR ROXANA IBETH	10443637538	MZA. D LOTE. 2 A.H. 23 DE ABRIL (FRENTE A URNA DE CRUZ DE MOTUPE) LIMA	0
1561	FIGUEROA CHAVEZ VIRGILIO ROBERT	10107887798	AV. MANCO CAPAC NRO. 635 BARRIO DE NICRUPAMPA	0
1562	FIGUEROA URREGO JENNIFER PAOLA	10465278655	PJ. LAS MAGNOLIAS MZA. F LOTE. 4 A.H. JOSE MARIA ARGUEDAS LIMA - LIMA	0
1563	FLOA CONSTRUCCIONES Y SERVICIOS SOCIEDAD ANONIMA CERRADA	20538304124	JR. FRANCISO DE ZELA NRO. 943 DPTO. 501	0
1564	FLORES ALDAVE KARIM	10802120287	MZA. 125 LOTE. 29 URB. NICOLAS GARATEA (ULTIMA MANZANA FRENTE ZONA DE	6021364
1565	FLORES APARI ANABEL SHOLANCHS	10732600561	CAL. 8 MZA. K10 LOTE. 03 A.H. ANGAMOS (FTE. A LA GUARDERIA) PROV. CONS	0
1566	FLORES ARGUMEDO KATTYA ROXANNA	10101705191	PJ. HIPOLITO UNANUE NRO. 122 MARIA PARADO DE BELLIDO (MOYOPAMPA BAJA	0
1567	FLORES BA??OS MAYCO	10435407809	NRO. 04 VERDE CCOCHA AYACUCHO - HUANTA - SIVIA	0
1568	FLORES CAHUAYA DORIS ELEUTERIA	10013398971	AV. TUPAC AMARU NRO. 506 CERCADO	0
1569	FLORES CAMPOS DE NITZUMA PILAR	10000763964	PJ. RAFAEL DE SOUZA MZA. 146 LOTE. 07 (FRENTE A LA DREU)	0
1570	FLORES CONDORI ADELA ESTHER	10046358827	AV. JORGE CHAVEZ NRO. 309 URB. JORGE CHAVEZ AREQUIPA - AREQUIPA - PAUC	0
1571	FLORES LEON VANESSA MILAGROS	10449563196	JR. PIURA N?? 711	987926068
1572	FLORES MEZA LIZBETH OLIVIA	10435768488	CAL. FRANCISCO LAZO NRO. 117 URB. STO DOMINGUITO (CERCA AV AME.SUR CON	0
1573	FLORES RAMIREZ JENY MANUELA	10406965240	URB TUPAC AMARU MZA. L LOTE. 14 (CAPILLA MARAVILLA POR EL PUENTE)	0
1574	FLORES RAMOS EDWIN AMERICO	10437821955	CAL. LA CHIRA MZA. P LOTE. 1 A.H. NUEVA CALEDONIA	993668832
1575	FLORES TELLEZ ANGELA MARJORY	10421578554	JR. MEZA MEDRANO NRO. 577 SAN GERMAN	0
1576	FLORES VILLACORTA PAULO SERGIO MANASES	10454860255	JR. MIGUEL GRAU NRO. 1418 SAN MARTIN - SAN MARTIN - TARAPOTO	0
1577	FLORES YAJAHUANCA AIDEE	10774636060	PJ. ALBERTO URETA MZA. J LOTE. 6 A.H. EL AMAUTA	9898-58121
1578	FONSECA CCALLUCO MERCEDES ISABEL	10410841555	CAL. ABANCAY NRO. 205 P.J. APURIMAC AREQUIPA - AREQUIPA - ALTO SELVA A	0
1579	FRIAS DELGADO ELMER	10277504338	CAL. MARIETA NRO. 630 NUEVO HORIZONTE	0
1580	FUNDACION ACADEMIA DIPLOMATICA DEL PERU	20108022451	AV. FAUSTINO S??NCHEZ CARRI??N NRO. 335 URB. SANTA ROSA (ALT. CDRA. 26 A	0
1581	G & A CONSULTORES Y CONTRATISTAS S.A.C.	20525074057	JR. LAS MANDARINAS MZA. C LOTE. 17 RES. MONTERRICO (GRIFO PRIMAX DE AV	4361262
1582	G Y G INVERSIONES GENERALES S.A.C.	20568533322	JR. LOS CLAVELES MZA. A LOTE. 06 BARRIO SAN CRISTOBAL (MANO IZQUIERDA	961026268
1583	GALLEGOS CANO MATILDE GLADYS	10292805468	CAL. LIBERTAD NRO. 3608 URB. PERU	6575691
1584	GALLIANI MONTES ANGHELLA MELISSA	10463769481	MESONES Y MURO N?? 155 - MARANGA	992182744
1585	GALVEZ GONZALES COTTY LIZETH	10460353349	AV. TUPAC AMARU NRO. 260 CAJAMARCA - CHOTA - CHOTA	
1586	GALVEZ LA FUENTE ANA MARIA	10075778509	JR. LOS JAZMINES NRO. 326 INT. A LIMA - LIMA - LINCE	422-1324
1587	GAMARRA ANGELES RUBY	10463928741	MZA. 9 LOTE. 15 URB. NICOLAS GARATEA ANCASH - SANTA - NUEVO CHIMBOTE	0
1588	GAMARRA MINAYA DAN ANGELO	10430661642	AV. BOLIVAR NRO. 416 DPTO. 2002 (A CUATRO CUADRAS DE LA AV BRASIL) LIM	991184388
1589	GAMARRA MUNDACA CYNTHIA GISSELA	10461125692	MZA. 104A LOTE. 9 SEC. JUAN VELASCO	0
1590	GAMARRA QUISPE MERCEDES JESSICA	10410618031	MZA. C6 LOTE. 4 LOS OLIVOS ANCASH - SANTA - NUEVO CHIMBOTE	0
1591	GAMBOA VASQUEZ WILLIAM PERCY	10181639381	EDIFICIO NRO. 12 DPTO. 301 C.H. FONAVI II	0
1592	GANOZA CUEVA KAREN KEYLA	10728408974	JR. FEDERICO NOGUERA NRO. 357 URB. MIGUEL GRAU (MCDO CAQUETA PLAZA 2 C	0
1593	GARAY PEREZ ROSARIO	10447808175	JR. VICENTE MORALES NRO. 190 URB. SANTA LUZMILA 2DA ETAPA (ALT HOSPITA	9930554913
1594	GARAY SALAZAR CELIA VERISA	10449126276	AV. LAS TORRES MZA. B LOTE. 13 URB. CASABLANCA	0
1595	GARAY VILCHEZ MARIO MARTIN	10804442877	CAL. TACNA 1ER PISO NRO. 1018 (A 1 CUADRA DE AV. BOLOGNESI	979-698002
1596	GARCES BELTRAN ALEJANDRO MIGUEL	10424566611	JR. HUANCAVELICA MZA. V LOTE. 57 URB. SANTA PATRICIA 2DA ETAPA (ALT DE	3491099
1597	GARCIA GARIBAY CINTHYA HEIDY	10425938954	MZA. S LOTE. 09 P.J. SAN CARLOS ICA - ICA - ICA	349-1079
1598	GARCIA GUTIERREZ CARMEN ROSA	10403496869	MZA. E LOTE. 09 BQ LUIS ALBERTO SANCHEZ (ENTRE LA ESCUELA AGONIA Y EXP	0
1599	GARCIA HEREDIA SANTOS MERCEDES	10412978922	CAL. EL NARANJAL NRO. 108 P.J. LOS OLIVOS LAMBAYEQUE - CHICLAYO - CHIC	0
1600	GARCIA OLIVARES DIANA IRINA	10456061333	CAL. LORETO NRO. 900 (CERCA DEL COLEGIO MARIA INMACULADA	0
1601	GARCIA RAZA JOSUE ANGEL	10732365074	CAL. GRAL BUENDIA NRO. 574 P.J. 2 DE MAYO (ALT. CUADRA 5 AV. MARALES D	989679709
1602	GARCIA ROMERO MARIA DOMITILA	10450247753	MZA. E LOTE. 15 URB. LA RINCONADA II ETP	0
1603	GARCIA SANCHEZ MARTHA JACINTA	10438192986	CAL. INCA GARCILAZO DE LA VEGA LOTE. 14 A.H. LEONCIO PRADO (A 1 CDRA D	0
1604	GARRIDO PASTOR JOHANA ROSALYN	10420512185	GDIA PERUANA NRO. 487 MATELLN (METRO CHORRILLOS, 2DA ENTRADA)	0
1605	GARRO MARQUEZ JAVIER WILLAM	10060892933	NRO. MZA3 INT. LT23 ASOC. DANIEL A. CARRION (ALT. PARADERO 5 AV. SANTA	0
1606	GASPAR CACERES BERENICE	10466158556	AV. CESAR VALLEJO NRO. 102 (POLLERIA WILLYS) CUSCO - CANCHIS - SICUANI	0
1607	GASPAR PORRAS JOVANA JANETH	10421522362	JR. PERSICARIAS N?? 1842 URB. SAN HILARI??N	0
1608	GAZEL PERU SOCIEDAD ANONIMA CERRADA - GAZEL PERU S.A.C	20511995028	AV. PABLO CARRIQUIRRY NRO. 660 URB. EL PALOMAR LIMA - LIMA - SAN ISIDR	4216006
1609	GENFAR PERU S.A.	20153275450	CAL. LOS TELARES 165 URB. VULCANO (SEPARADORA INDUSTRIAL Y AV. LA MOLI	6186100 / 3492734 / 3492730
1610	GLATT SOCIEDAD ANONIMA	20420289597	AV. SANTIAGO DE SURCO NRO. 3887 URB. VISTA ALEGRE	2720562
1611	GOICOCHEA READI JUAN PABLO	10103198220	AV. JULIO BAILETTI NRO. 223 DPTO. 101 URB. JACARANDA II (A 1 CDR DE IN	998886544
1612	GONZA AGUILERA SEGUNDO MARTIN	10425121761	MZA. C LOTE. 10 A.H. LOS ANGELES 1 ETAPA (FRENTE AL COLEGIO PRIMARIO)	0
1613	GONZALES DIAZ JAIME GENARO	10292933563	CAL. CUZCO NRO. 721 MOQUEGUA - MARISCAL NIETO - MOQUEGUA	942002271
1614	GONZALES GUZMAN ALBERTO	10418787126	AV. 28 DE JULIO NRO. 228 INT. 43 (PI4 A 1 CDRA DEL HOSPITAL DEL NI??O)	4236576
1615	GONZALES JULCA MARY CARMEN	10465744877	PJ. IV CENTENARIO NRO. 133 CP CAMANA (FRENTE A LA SUBREGION)	0
1616	GONZALES LOLI JOHN RONALD	10329898666	ALBERT EINSTEIN 210 SURQUILLO	6647996
1617	GONZALES QUISPE ROXANA	10417688922	CAL. FORTALEZA NRO. 263 COO. CHANCAS DE ANDAHUAYLAS (POR EL MERCADO LA	0
1618	GONZALES RUIZ KAREN LISBETH	10432496428	II ETAPA MZA. I LOTE. 12 URB. PABLO VI AREQUIPA - AREQUIPA - AREQUIPA	0
1619	GONZALES VILLALTA DOMINGO	10012097706	JR. DEUSTUA NRO. 910 CERCADO PUNO - PUNO - PUNO	968291080
1620	GONZALO GONZALO SIMONA	10418615945	MZA. B LOTE. 8 URB. SAN ISIDRO DE CACACHI (A 3 CUADRAS DE ESCUELA DE S	0
1621	GONZALO LAVADO ERIKA DAYSI	10444275401	JR. 28 DE JULIO NRO. 970 (A TRES CUADRAS DEL CUARTEL) JUNIN - HUANCAYO	0
1622	GRAFICA VILCA FLORES E.I.R.L.	20511906297	FCO PIZARRO NRO. 568 INT. 6 LIMA - LIMA - RIMAC	4817140
1623	GRANDEZ MU??OZ ROSA MERCEDES	10445838387	JR. GRAU NRO. 307 URB. YANCE AMAZONAS	0
1624	GRIFOS ESPINOZA S A	20100111838	AV. LA ENCALADA NRO. 1388 (A MEDIA CDRA. EMBAJADA DE E.E.U.U.)	4342351 / 7080700
1625	GRUPO RASO E.I.R.L.	20554236791	JR. LAS TRES MARIAS MZA. A-3 LOTE. 18 INT. 3 URB. LOS CEDROS DE VILLA	987715560
1626	GUAYAMBAL AGUIRRE ERICA JACQUELINE	10400408241	JR. LIBERTAD NRO. 678 URB. LA LIBERTAD (ALT. DEL KM 11 DE LA AV. TUPAC	0
1627	GUERRA AREVALO LUIS ENRIQUE	10403642296	AV. LIMA NRO. 1018 URB. PANDO (ALT CDRA 4 AV UNIVERSITARIA)	958099823
1628	GUERRA LOLOY BERTILDA	10448424401	JR. SAN MARTIN NRO. 863 CENT CERCADO	0
1629	GUERRA MURGA FORTUNATA	10239873591	PJ. CANGALLO NRO. 113 (COSTADO DE LA AGENCIA REY BUS) AYACUCHO - HUANT	0
1630	GUERRA RAMOS DIANA MAGALY	10096710734	JR. BACA FLOR NRO. 522 URB. INGENIER	3300189 / 91022110
1631	GUERRERO MACHA PATRICIA MABEL	10430725063	JR. LA PRUDENCIA NRO. 7957 URB. PRO 5TO SECTOR I ETAPA (ENTRE AV. CORD	0
1632	GUERRERO VERTIZ NIMIA ROSA DEL PILAR	10102029262	CAL. TAMBO REAL NRO. 490 DPTO. 204 INT. 01	523-8968
1633	GUEVARA ACU??A ARNOLD GUBERLI	10446329176	JR. J. SOTO BURGA NRO. 165 (CERCA A I.E. 11039	0
1634	GUEVARA AURICH LIZET CAROLINA	10445194978	CAL. RICARDO PALMA NRO. 22 PROLG 24 DE JUNIO	0
1635	GUEVARA GONZALES TANIA NOELIA	10436406776	CAL. SAMAREN NRO. 259 (AV QUI??ONES 1 CDRA DEL COLEG RUY GUZMAN) LORETO	0
1636	GUEVARA SIMON YOLANDA NOEMI	10422445639	CAL. 38 MZA. Q LOTE. 23 SEC. BARRIO III LA LIBERTAD - TRUJILLO - EL PO	0
1637	GUEVARA URBINA RONALD	10419919026	URB. LOS LIRIOS MZ. I LOTE 28	5751170
1638	GUILLEN PAZ NATALI ADELAIDA	10430515085	JR. YEN ESCOBEDO NRO. 509 URB. SAN GERMAN (ALT.DE CDRA.5 DE AV.GERMAN	4565289
1639	GUILLEN QUISPE NILDA ERIKA	10402976832	AV. J. FRANCISCO MARIATEGUI NRO. 1785 DPTO. 405 RES. RAPALLO (ALTURA C	983945931
1640	GUILLINTA HERNANDEZ ALYS YISSET	10441473562	MZA. C LOTE. 9 CAS. PUNO SE 7 (POR COLEG PRIMARIA) ICA - ICA - TATE	0
1641	GUTIERREZ BRICE??O PAMELA ALEXANDRA	10765012908	JR. LORETO NRO. 1230 A.H. RUGGIA	453-5043
1642	GUTIERREZ CATA??O JAIME PABLO	10428538779	AV. TUPAC AMARU NRO. 1848 A.H. RAUL PORRAS BARR (FRENTE AL PARQUE ZONA	0
1643	GUTIERREZ CORREA LIBBY DIANA	10453077816	LITUMA PORTOCARRERO N?? 131	984126899
1644	GUTIERREZ MONRROY JHON MANUEL	10475609170	MZA. N LOTE. 7 A.H. JUAN GONZALES BERROSPI (FRENTE A PLAZA VITARTE) LI	0
1645	GUTIERREZ MONRROY JUAN LUIS	10756294976	MZA. N LOTE. 7 A.H. JUAN GONZALES BERROSPI LIMA - LIMA - ATE	0
1646	GUTIERREZ SAMANEZ CARLOS ENRIQUE	10768042247	CAL. REAL NRO. 374 P.J. SANTA ROSA (COLEGIO SANTA ROSA)	966858236
1647	HANCCO BARREDA VANESSA	10455614665	MZA. K LOTE. 7 URB. RAFAEL HOYOS RUBIO ZON A (CERCA A LA PISCINA DE SE	0
1648	HAVAS MEDIA PERU S.A.C.	20417930079	AV. JUAN DE ARONA NRO. 151 INT. 703 C.C.JUAN DE ARONA LIMA - LIMA - SA	6118800-118
1649	HELEZZIA & TOURS S.A.C.	20509341011	Av. La Paz N?? 1362 Miraflores ( esquina con Vasco Nu??ez de Balboa)	2416571 997891153
1650	HERBOZO SARMIENTO EVELYN ROCIO	10401280699	JR. LORETO N?? 1156	997665325
1651	HERMOZA SOTOMAYOR CRISTINA	10414204711	JR. ARICA NRO. 126 AYACUCHO - HUANTA - HUANTA	0
1652	HERNANDEZ GUEVARA OLIVER ENRIQUE	10704370879	MZA. F-1 LOTE. 8 COO. VIV ALBINO HERRERA 2DA ET (ALT. CDRA. 33 DE TOMA	5752198
1653	HERNANDEZ LOYA FLOR DE LIZ	10436353893	PJ. SAN VICENTE DE PAUL NRO. 127	0
1654	HERNANDEZ MANSILLA CATHERINE MICHEL	10454522538	AV. HONORIO DELGADO NRO. 429 URB. INGENIERIA (FRENTE UNIV CAYETANO	0
1655	HERNANDEZ NI??O GISELLA JULIANA	10422398622	MZA. C LOTE. 16 APV. CHIRA PIURA PIURA - PIURA - PIURA	0
1656	HERNANDEZ ORDINOLA MARIANELLA CECILIA	10093913707	CAL. CERRO COLORADO NRO. 126 URB. SAN IGNACIO LIMA - LIMA - SANTIAGO D	991888273
1657	HERRERA BERGAMINO GISELLA IVONNE	10081706749	CALLE 6 NRO. 1110 URB. LA FLORIDA (ALT. CDA.10 DE ALCAZAR)	482-6351
1658	HERRERA COLMENARES SAHIKO ALIX	10484685598	CAL. S/N MZA. M LOTE. 6 P.J. TACALA (ALT. PARALELA AV EL SOL)	994912627
1659	HERRERA FERNANDEZ YANET DEL ROCIO	10182113226	MZA. E LOTE. 4 URB. HUERTA GRANDE	0
1660	HERRERA GUTIERREZ SARA SAMANTA	10456676648	MZA. D LOTE. 4 URB. CESAR VALLEJO AREQUIPA - AREQUIPA - PAUCARPATA	0
1661	HIDALGO YUPANQUI EPIFANIO AQUILINO	10207228236	AV. MANUEL A.PINTO NRO. 602	0
1662	HILARIO LEANDRO JUSTO SANDRO	10225155980	AV. MICAELA BASTIDAS NRO. 732	0
1663	HILMART S.A.	20457010266	NRO. C INT. 24 SECTOR 2, GRUPO 17 (ALT CRUCE AV ALAMOS Y AV EL SOL) LI	288-0366
1664	HINOSTROZA GOMEZ ANTONIA	10001224820	JR. MEXICO NRO. B INT. 11 A.H. INDOAMERICA (POR EL TIO TO??O)	0
1665	HOTEL CARRERA SAC	20538869491	CAL. LEON VELARDE NRO. 123 LIMA - LIMA - LINCE	6195200-2517
1666	HOTELES ESTELAR DEL PERU S.A.C.	20518738314	AV. ALFREDO BENAVIDES NRO. 415 LIMA - LIMA - MIRAFLORES	6307777-230
1667	HOTELES SHERATON DEL PERU S.A	20100032610	AV. PASEO DE LA REPUBLICA 170/LIMA	3155017
1668	HPH INVERSIONES E.I.R.L	20506598282	AV. GUARDIA CIVIL NRO. 277 URB. CORPAC	226-5661/4750947
1669	HUACCHO CORTEZ MARCO ANTONIO	10435771870	CAL. CARLOS A. SACCO NRO. 238 EL BOSQUE (ALTURA DE LA CUADRA 8 DE LA A	0
1670	HUACHO SUSANIVAR CERAO ROSARIO	10468927301	JR. ESTEBAN PAVLETICH NRO. 991 (A MEDIA CDRA DEL COLEGIO ILLATHUPA	0
1671	HUALPA HERNANDEZ DIANA ROSARIO	10455253361	MZA. D LOTE. 14 P.J. SR DE LOS MILAGROS (1 CDRA ENTRANDO POR SUBIDA D	0
1672	HUAMAN CCORIMANYA YANINA ISIDORA	10446737444	CAL. LA PAZ MZA. G LOTE. 03 A.H. LAS MALVINAS (PAMPLONA ALTA. ALTURA D	0
1673	HUAMAN CERRON DIANA ELIZABETH	10710233573	PJ. 1 MZA. 19 LOTE. 13 A.H. STA TERESA DE VILLA	941554967
1674	HUAMAN CRUZADO MERLY EDITH	10450418752	MZA. C LOTE. 14 LT LAS TORRECITAS (CALLE LAS GOLONDRINAS 262) CAJAMARC	
1675	HUAMAN LUCERO JUANA MARIA	10430971561	MZA. T LOTE. 23 P.J. VILLA HERMOSA LAMBAYEQUE - CHICLAYO - JOSE LEONAR	0
1676	HUAMAN MAYURI FRANCISCA DEL PILAR	10198701438	CAL. 8 MZA. R LOTE. 18 URB. EL PINAR (CRUCE ENTRE AV. EL PINO Y CALLE	996271776
1677	HUAMAN TIMOTEO DEYSI YANNET	10426060243	MZA. C13 LOTE. 13 A.H. SAN MARTIN PIURA - PIURA - PIURA	0
1678	HUAMAN VARGAS ROCIO	10431278711	CAL. SIETE DE JUNIO NRO. 481 CENT BAMBAMARCA CAJAMARCA - HUALGAYOC - B	
1679	HUAMANI ENCISO RICHARD HILARIO	10101577444	JR. SUCCHA NRO. 271 URB. CHACRA COLORADA LIMA - LIMA - BRE??A	989249045
1680	HUAMANI MORENO JOSSELYN	10482529106	MZA. S3 LOTE. 21 A.H. DEFENSORES DE LA PATRIA	940763262
1681	HUANCAHUARI PEREZ GRACE LUCIA	10458545702	MZA. D LOTE. 13 ASOC SANTA CHIARA (KM 11.5 CARR.CENT. STA CLARA ALT.SE	0
1682	HUANSI CHILO VICTOR JAVIER	10441015327	CAL. MIGUEL GRAU NRO. 132	0
1683	HUARACHI MU??OZ ANNIE JACKELYN	10708886926	MZA. 25 LOTE. 15 P.J. MNO MELGAR (CURVA NUEVA ESPERANZA, TIENDA MAYORS	593-3703
1684	HUARINGA CANGALAYA LUSMILA GISELA	10471575467	PJ. ALBERTO URETA MZA. J LOTE. 6 A.H. EL AMAUTA 1ER SECTOR (PARADERO E	965082402
1685	HUASCO FARFAN EDELMIRA	10406943441	MZA. H LOTE. 05 A.H. SAN MARTIN DE PORRES	0
1686	HUASHUAYA VELIZ JULIO	10434052152	JR. ROSA MERINO MZA. C4 LOTE. 25 URB. MRCAL CACERES (ALT.PDRO.3 DE MAR	3928157
1687	HUAYTA PILLACA ADEMIR GINO	10075297527	CAL. MARSELLA MZA. G LOTE. 11 A.H. MICAELA BASTIDAS SECTOR 1	9992-71766
1688	HUIVIN GRANDEZ DE MORI MILITZA	10011250608	JR. SAN MARTIN NRO. 808	0
1689	HURTADO CERRON SOFIA	10435600544	CAL. OLAECHEA ARNAO NRO. 1264 URB. ELIO	563-8248 / 940146564
1690	HURTADO YUPANQUI DIANA CAROLINA	10436269990	JR. ELIAS ROBLEDO MZA. E LOTE. 06 A.H. AUGUSTIN CAUPER	0
1691	I & G HISPANIA S.A.C.	20550025176	AV. LA PAZ NRO. 1101 URB. MIRAFLORES LIMA - LIMA - MIRAFLORES	2008000
1692	IBA??EZ GONZALEZ ERMANCIA ERSELIZ	10456298457	NRO. SN CAS. PURUMARCA (CERCA DEL DESVIO)	0
1693	IBA??EZ MAMANI FRESIA PILAR	10460652915	MZA. J LOTE. 08 URB. VILLA DEL LAGO	0
1694	IBARRA NORE??A HAYDEE	10426085319	JR. 14 DE AGOSTO NRO. 360 P.J. LAS MORAS (FRENTE AL INABIF	0
1695	ILLESCA PUMARRUMI JUDY REBECA	10157583587	JR. ALPAMAYO NRO. 135 BARRIO PUQUIO CANO	0
1696	IMAGEN CORPORATIVA GRAFIMAR S.A.C	20524913390	JR. LUIS GALVEZ CHIPOCO NRO. 333 DPTO. 5 LIMA - LIMA - LIMA	998994969
1697	IMPORTACIONES HIRAOKA S.A.C.	20100016681	AV.ABANCAY N?? 594	428-8185
1698	IMPORTADORA Y DISTRIBUIDORA ZURECE SAC	20502891767	AV. ABANCAY N?? 407 INTERIOR 602	42671677 / 4264782 / 830*7085
1699	IMPORTS & EXPORTS TEXTILES NEW WORD SAC	20392657020	jiron belgica 1605 la victoria	3244089
1700	IMPRESOS Y SOLUCIONES E.I.R.L.	20563564441	CAL. INDEPENDENCIA NRO. 521 URB. PANDO ET 7 LIMA - LIMA - SAN MIGUEL	95641177
1701	INDUSTRIAL PRODEX DELGADO S.A.	20262173853	CAL. PEDRO MURILLO NRO. 1041 URB. EL CARMEN (ESPALDA METRO AV SUCRE)	3247974 / 4620425
1702	INDUSTRIAS GRAFICAS ZAFERRO S.A.C.	20546879748	JR. CALLAO NRO. 727 INT. 108 (ALT. AV. TACNA CDRA. 1)	6886773 / 993332706
1703	INFANTES POMAR ELIANA CARMEN	10257673923	CAL. VIRREY HURTADO DE MENDOZA NRO. 375 URB. LA COLONIAL	#969696529
1704	INGARUCA AMAYA GISSELA NATALY	10473789529	JR. LORETO NRO. S/N (S71360696-N 611-A 50MT DE HUAYNACAPAC) JUNIN - TA	0
1705	INGUNZA CA??OLI PATRICIA ISABEL	10214610952	AV. ALAMEDA DEL NORTE MZA. A4 LOTE. 10 ALAMEDA DEL NORTE (ALT. GRIFO S	0
1706	INGUNZA RIVERA DIANA JUDITH	10444901123	BL. TOMAYQUICHUA MZA. F LOTE. 27 P.J. TOMAYQUICHUA (1 CDRA DE LA PERRI	0
1707	INSTITUTO QUIMIOTERAPICO S.A.	20100287791	AV. SANTA ROSA 350	6120707
1708	INSTITUTO SUPERIOR SAN IGNACIO DE LOYOLA S.A.	20100134455	AV. LA FONTANA NRO. 795 URB. SANTA PATRICIA LIMA - LIMA - LA MOLINA	7060000
1709	INVERSIONES CORBAN S.A.C.	20520767143	BOLIVAR NRO. 199 DPTO. 1 (FRENTE AL ESTADIO NACIONAL)	330-9762 / 947054051
1710	INVERSIONES KAMIA S.R.L	20510367601	JR. CHAVIN NRO. 495 COO. CHANCAS DE ANDAHUAYLAS (1RA ET-ALT DEL MCDO A	956350395
1711	INVERSIONES KUSADASI S.A.C.	20544496078	AV. EL DERBY NRO. 055 (TORRE 1 - PISO 7) LIMA - LIMA - SANTIAGO DE SUR	2730687
1712	INVERSIONES MECANICAS & TECNOLOGICAS S.A.C. IMETEC S.A.C.	20545254272	AV. CATALINO MIRANDA NRO. 230 (INICIO LA VIA EXPRESA) LIMA - LIMA - BA	992510397
1713	IRRIBARREN CALDERON HEELEN	10439645496	JR. UBINAS MZA. G LOTE. 2 INT. 03 P.J. SAN LUIS (ALTURA DEL PARQUE DE	0
1714	IZQUIERDO FERNANDEZ EDILBERTO NILO	10406454776	MARIANO BUSTAMANTE NRO. 557 (ALT.. DELA CDRA 5 DE LA AV. BOLOGNESI) LI	0
1715	IZQUIERDO ZAGACETA MIRIAN NADINE	10467463956	MZA. 15 LOTE. 07 URB. SANTA ROSA LAMBAYEQUE - CHICLAYO - LA VICTORIA	0
1716	JACINTO YOVERA JORGE JESUS	10449870234	CAL. ALFONSO UGARTE NRO. 104 PIURA - SECHURA - VICE	0
1717	JARA NOEL KATHERINE IVONNE	10448118644	CALLE LOS NOGALES N?? 105 URBANIZACI??N LOMAS	0
1718	JARAMILLO BARDALES INGRID	10435199041	MZA. J LOTE. 23 A.H. CONSUELO DE VELASCO (1 CUADRA ANTES DE LA AV.PERU	0
1719	JAUREGUI CANCHARI VLADIMIR	10283149795	MZA. B LOTE. 17 URB. SECTOR EDUCACION	96696-7911
1720	JAUREGUI PORTILLA CARLOS GUSTAVO	10421167945	CAL. PROF JORGE MUELLE NRO. 472 DPTO. 401 C.R. TORRES DE LIMATAMBO	987-829051
1721	JIMENEZ CHAVARRIA EUGENIO FAUSTO	10068397346	MZA. A2 LOTE. 05 A.H. MANCO INCA (PAR MANCO INCA AV. TUPAC AMARU KM 7.	525-5635
1722	JIMENEZ GARCIA MARIA ELENA	10277317678	CAL. HUAMANTANGA NRO. 1634 SECTOR PUEBLO NUEVO CAJAMARCA - JAEN - JAEN	0
1723	JOHANNA LIDIAN HERNANDEZ OBLITAS	10408887254	CALLE MATIER N?? 778	424-4387
1724	JOHNSON - LUCY JEAN	10409091089	JR. TRINIDAD NRO. 187 BR SAN ANTONIO	0
1725	JORDAN VELA JAVIER GUSTAVO	10061900913	JR. LOS ROSALES NRO. 384 INT. 2 URB. VILLA JARDIN (2PISO CRUC AV.CANAD	961045770
1726	JORGE PE??A S A JORPESA	20101015492	JR. CHICLAYO 487 B (ALT. CERVECRIA BACKUS Y JHONSON)	482-0290
1727	JULCA CASTA??EDA YESSICA MARIBEL	10429091697	CAL. PEDRO RUIZ NRO. 2112 P.J. SAN ANTONIO (ENTRE PEDRO RUIZ Y HUMBOLT	0
1728	JULI ESPINOZA DORIS CLOTILDE	10447363301	JR. TUPAC YUPANQUI NRO. 267 (A CDRA Y MEDIA DE ADUANAS) PUNO - PUNO -	0
1729	JUNCO RAMOS ESTEFANY ESTRELLA	10448210001	CAL. ATAHUALPA NRO. 1073 (POR EL OVALO DE LA PERLA) PROV. CONST. DEL C	5595804
1730	KAHN GRANDA JAIME JESUS	10103284801	CAL. MOLOCAY NRO. MZF6 INT. LT11 URB. LOS CEDROS DE VILLA (ALT. CDRA 8	2341540
1731	KYBALION GROUP S.A.C.	20477828567	CAL. MIROQUESADA NRO. 247 INT. 505 MIROQUESADA (MIROQUESADA-LAMPA)	2031400
1732	LA COFRADIA CREATIVA S.R.L.	20551395554	CAL. PROLONG. MANCO SEGUNDO NRO. 115 DPTO. 1204 INT. A URB. PANDO (ESP	0
1733	LA ECONOMICA LIDER E.I.R.L.	20508763655	"AV. ""A"" MZA. ""Z"" LOTE 17 URB. SANTO DOMINGO 9NA. ETAPA"	0
1734	LA POSITIVA SEGUROS Y REASEGUROS	20100210909	JAVIER PRADO ESTE Y FCO MASIAS 370	226-3000  -  9836-6117
1735	LA TORRE ROSILLO LENIN YONEL	10444723829	CAL. LOS CIPRECES NRO. 211 URB. LA MOLINA (A 1/2 CUADRA ESQ. MARA??ON Y	0
1736	LABORATORIOS AC FARMA S.A	20347268683	los hornos 110 - urb vulcano - ate	618-4900/3498080
1737	LABORATORIOS AMERICANOS S.A.	20255361695	CAL. SALAVERRY NRO. 419 URB. INDUSTRIAL EL PINO LIMA - LIMA - SAN LUIS	3261515 / 2126022 ANEXO 115
1738	LABORATORIOS INDUQUIMICA S.A.	20101364152	CALLE S. LUCILA 154 URB. V.MARIA	617-6008
1739	LABORATORIOS PORTUGAL S R L	20100204330	CAL. LOS TALLADORES NRO. 402 URB. INDUSTRIAL DEL ARTESANO	4353470
1740	LABORATORIOS UNIDOS S.A.	20417180134	AV. PASO DE LOS ANDES N?? 740	261-8603
1741	LAGUNA TORRES VICTOR ALBERTO	10256216162	JR. JOS?? ANTONIO NRO. 110 URB. PARQUE DE MONTERRICO LIMA - LIMA - LA M	999958818
1742	LAIMITO ALIAGA CELSO OSCAR	10201140345	JR. SANTOS BRAVO NRO. S/N (SECTOR C- 1A CDRA 8 DE AV. BRUNO TERRERO)	980-088710
1743	LANDEO ARAUZO RUTH NOEMI	10462404650	MZA. U-V LOTE. 15 MANCO CAPAC (FTE.COLEG.138 VILLA FLORES) LIMA - LIMA	2531140
1744	LAOS VILLAR IRMA LAURA	10404495718	BL. LEONCIO PRADO MZA. C LOTE. 2 URB. LEONCIO PRADO	0
1745	LAPA AGUILAR NELVA NERY	10477772990	MZA. F LOTE. 16 ASOC. 9 DE DICIEMBRE (1 CDRA DEL ESTADIO CUMANA) AYACU	0
1746	LAPA PINEDA AGUSTINA	10408787560	MZA. A LOTE. 09 ASOC. INGENIERIA (ESPALDAS DE LA UNSCH) AYACUCHO - HUA	0
1747	LARA INFANTE SEGUNDO GUILLERMO	10802627969	AV. HABICH N?? 560-620 URB. INGENIER??A	RPC 991490440
1748	LATFAR S.A.C.	20516289261	JR. JOSE OLAYA NRO. 272 P.J. MICAELA BASTIDAS	421-4373
1749	LAURENTE BENITEZ SONIA	10410943421	CAL. LEON NRO. 120 URB. MAYORAZGO 1RA ET	0
1750	LAVADO GRAOS CONCEPCION ANDRES	10416208641	JR. SIMON BOLIVAR NRO. 1522 PBLO. HUAMACHUCO	971-188159
1751	LAVADO VILLANUEVA EMELDA	10098487757	AV.SAN MARTIN DE PORRES LT.102-109 -102B BLOCK 4 DPTO.501	356-1285 / 980551460
1752	LAYMITO ANDRES VICENTA ESMILA	10069161800	JR. BELISARIO GUTIERREZ NRO. 180 INT. 1PSO URB. SANTA LUZMILA ETAPA 2	0
1753	LAZARTE QUISPE MERY ROXANA	10451105502	MZA. B LOTE. 11 P.J. JESUS NAZARENO AREQUIPA - AREQUIPA - PAUCARPATA	0
1754	LE SHENG INVERSIONES S.A.C.	20514754293	AV. ARENALES NRO. 1798 (ESQUINA DE MANUEL CANDAMO CON ARENALES)	651-6888
1755	LEANDRO ISIDRO PERCY OMAR	10411687959	AV. ARBORIZACI??N MZA. M LOTE. 24A A.H. LAS ALAMEDAS (POR EL AEROPUERTO	0
1756	LEIVA ALFARO SILVIA EUGENIA	10414856646	CAL. MARISCAL SUCRE NRO. 495 CAJAMARCA - HUALGAYOC - BAMBAMARCA	0
1757	LEIVA MALCA GINA LIZSETH	10803409272	CAL. LOS ALHELIES NRO. 390 DPTO. 502 (CRUCE FAUCETT Y VENEZUELA)	0
1758	LEON BERNAOLA MARILYN MARIELLA	10708747691	JR. CALCA NRO. 175 LIMA - LIMA - INDEPENDENCIA	0
1759	LEON LIMA YESSENIA DITHLIN	10466189818	AV. SAN MARTIN DE PORRES ESTE MZA. V1 LOTE. 27 A.H. JUAN PABLO II DE C	0
1760	LEON MENDOZA CARLOS SANTIAGO	10258596931	AV. ALFREDO PALACIOS MZA. E LOTE. 18 A.H. AH EL CARMEN (ALT CDRA 25 AV	0
1761	LEON ORELLANA DEBBYE ELIZABETH	10214604383	MZA. ?? LOTE. 28 C.H. ANGOSTURA II ETAPA (ESPALDA DE LA BODEGA BLANQUIT	0
1762	LEON PLASENCIA OMAR GERARDO	10700803266	PJ. CHICLAYO MZA. C LOTE. 6 SEC. LOS PORTALES DE HUANCHACO LA LIBERTAD	0
1763	LEONARDO GASTELO LISSET VANESSA	10451566569	CAL. ANTISUYO NRO. 1781 INT. A LAMBAYEQUE - CHICLAYO - LA VICTORIA	
1764	LETHMOORE ASOCIADOS S.A.	20554473815	PJ. MACATE NRO. 192 DPTO. 2 URB. CHACRA COLORADA (CUADRA 7 JR. IQUIQUE	0
1765	LEYVA CABRERA MARIA ESTHER	10072397351	PSJE. MARACAIBO 102	2616704
1766	LEYVA SIPAN KARINA DEL PILAR	10158457305	CAL. 5 MZA. L LOTE. 17 INT. B6 URB. LOS PILARES AZULES (ALT CDRA 28 DE	4209620-997010766
1767	LIFETEC SOCIEDAD ANONIMA CERRADA - LIFETEC SAC	20518686250	CAL. LAS GUINDAS MZA. C1 LOTE. 04 URB. CERES 2DA ETAPA LIMA - LIMA - A	3516376
1768	LIMACHI QUISPE EDITH SONIA	10452288848	JR. GONZALES PRADA NRO. 950 BARRIO MANCO CAPAC (ENTRE JR. MARIANO MELG	0
1769	LIMO ANDIA FREDY	10419346212	AV. MARISCAL GAMARRA MZA. D LOTE. 9A URB. SANTA ANA (FRENTE IGLESIA DE	0
1770	LINGAN CUEVA ELIZABETH	10416635868	JR. MIGUEL GRAU NRO. 623	0
1771	LINO PEREZ JHOMNELA PILAR	10462357554	JR. 2 DE MAYO NRO. 1265 INT. 1 (FTE A PSTOS DE PERIODICO ENTRADA A BIL	0
1772	LIZA LOPEZ PERCY MIGUEL	10106035232	AV. PUENTE LLANOS MZA. D LOTE. 22 ASOC.VILLA VITARTE (KM 6.5 DE CARRET	0
1773	LIZARES ARREDONDO FELI	10100700200	MZA. C LOTE. 1 A.H. SAN JOSE (ALT. KM. 36.5 PANAMERICANA NORTE)	979530824
1774	LLALLAHUI VELASQUEZ ANA MARIA	10402650406	AV. LOS INCAS NRO. 213 AYACUCHO - HUAMANGA - SAN JUAN BAUTISTA	
1775	LLANCARI RAMOS DE APOLAYA DANIELA GINA	10435090121	JR. VILLA REAL DE LOS INFANTE MZA. R1 LOTE. 02 URB. LAS LOMAS DE LA MO	0
1776	LLANOS ALBERCA ROSA ARACELLI	10098853435	JR. FELIPE ARIAS MZA. P URB. EL ROSARIO (CRUCE DE UNIVERSITARIA CON SA	0
1777	LLAUCE CHAFLOQUE FLAVIA	10410609768	MZA. I LOTE. 6 P.J. LAS COLINAS DE LAS BRISAS (CERROPON) LAMBAYEQUE -	
1778	LLERENA MENDEZ ANA PAULA FATIMA	10462319938	CAL. MAURICIO SIMONS NRO. 746 URB. LAS QUINTANAS	RPC 964283073
1779	LLIUYACC QUISPE AIDA	10440357305	LA CAMPI??A SECTOR A MZA. H LOTE. 10 A.H. CASA HUERTA LIMA - LIMA - LUR	0
1780	LOAYZA GONZALES JOSE HAROLD	10427987499	JR. CARLOS VALENZUELA NRO. 1097 BARRIO SOLEDAD BAJA (INTER.RAMON CASTI	952985034
1781	LOAYZA RODRIGUEZ ROSARIO MELCHORA	10199224374	AV. BOLOGNESI NRO. 171 URB. JULIO C.TELLO	954836555
1782	LOO ZULOAGA MIRIAM MARGARITA	10408128213	AV. EL SOL NRO. 025 URB. SAN CARLOS LIMA - LIMA - SAN JUAN DE LURIGANC	982623925
1783	LOPEZ CHAPO??AN VIOLETA	10409058553	CAL. MIGUEL GRAU NRO. 676 CERCADO LAMBAYEQUE - LAMBAYEQUE - LAMBAYEQUE	
1784	LOPEZ MORALES CLAUDIA ELISA	10401331889	AV. CARLOS ALBERTO IZAGUIRRE NRO. 710 URB. LAS PALMERAS I ETAPA (FRENT	3691377
1785	LOPEZ NAVARRO ELENA ROCIO	10105290638	JR. RESTAURACION NRO. 401 DPTO. 902	0
1786	LOPEZ PINTO BETZABETH ZARA	10207248326	AV. MCAL. CACERES NRO. 315 URB. VALDIVIEZO (A 2 CDRAS DE CLINICA SAN J	0
1787	LOPEZ ZEGARRA OLGA LISSETH	10445885253	ASOC. LOS DIAMANTES MZ. B LT. 7	0
1788	LORA ZEVALLOS WILLY	10000261900	CALLE DO??A DELMIRA N?? 228 DPTO. 504	961621237
1789	LOYOLA AQUIJE GABRIELA SYLVANNA	10454374326	AV. TUPAC AMARU MZA. A LOTE. 2 (FRENTE AL RESTAURANTE LA CANDELA	0
1790	LOYOLA GARCIA CINTHIA KUSSY	10440835045	JR. LOS JAZMINES MZA. 169 LOTE. 14 BARR VILLON ALTO ANCASH - HUARAZ -	0
1791	LOZANO BAZAN STEPHANIA FIORELLA	10475897396	CAL. 72 MZA. J4 LOTE. 32 URB. EL PINAR	991071646
1792	LOZANO REVOLLAR CARMEN ROSA	10282716742	AV. PERU NRO. 114 (BARRIO LA LIBERTAD) AYACUCHO - HUAMANGA - AYACUCHO	966154851
1793	LUCERO LUCERO YIMER GUSTAVO	10444592023	CAL. SANTA MARTHA NRO. 206 C.P.M. URRUNAGA LAMBAYEQUE - CHICLAYO - JOS	978420390
1794	LUJAN AURIS JULISSA VERONICA	10447468498	MZA. F LOTE. 46 URB. PEDREROS (POR EL MDO MODELO-POR LA CANCHITA) ICA	0
1795	LUJAN FERNANDEZ BETZABEL ROSARIO	10403688814	JR. MARIANO NECOCHEA NRO. 266 INT. 268 URB. HUAQUILLAY (ALT. KM. 12.5	5370284
1796	LUNA TORIBIO ANDREA DEL PILAR	10431343482	AV. INDUSTRIAL NRO. 7031 URB. MESA REDONDA	0
1797	LUPU ZEVALLOS CRISTIN ITALIA	10446092982	HUANACAURE JTO NRO. 985 TAHUANTINSUYO LIMA - LIMA - COMAS	0
1798	LUZQUI??OS VILLEGAS NADIA STEPHANI	10455680102	CAL. TUPAC AMARU NRO. 109 URB. JOSE QUI??ONES LAMBAYEQUE - CHICLAYO - C	
1799	MACEDO VILLEGAS MILAGROS ELIZABETH	10427669161	CAL. GARCILAZO DE LA VEGA NRO. 313 CENTRO JAEN CAJAMARCA - JAEN - JAEN	976464042
1800	MACHACA DIAZ SAYDA VERONICA	10420019519	JR. TAHUANTINSUYO MZA. B LOTE. 02 URB. ALTO RINCONADA (ATRAS DE LA ESC	0
1801	MACHADO ZAMUDIO FRESIA CAROLINA	10460546171	AV. TUPAC AMARU MZA. 29 LOTE. 2 P.J. SAN ANTONIO PEDREGAL ALTO	0
1802	MACRO ASSYSTEMP E.I.R.L.	20550534135	JR. LAS CIDRAS NRO. 1284 URB. LOS JARDINES DE SAN JUAN LIMA - LIMA - S	3747076
1803	MACROPOST LOGISTICS S.A.C	20552588569	PJ. ADAM MEJ??A NRO. 103 INT. 205 LIMA - LIMA - JESUS MARIA	2530419
1804	MADERERA INVICTA S R LTDA	20101353975	AV. EL ZINC 293 URB. INDUSTRIAL INFANTAS	528-1257
1805	MAGALLANES VEGA LOURDES JOHANNA	10444239391	PJ. LOS PINOS NRO. 112 ICA - CHINCHA - CHINCHA ALTA	0
1806	MAGSAMAR INSUMOS S.A.C.	20507764330	AV. URUGUAY NRO. 320 INT. 112 URB. CERCADO LIMA - LIMA - LIMA	3328347
1807	MAGUI??A RAMIREZ PAMELA ROSMERY	10425733929	JR. CANDELARIA VILLAR NRO. 374 BARRIO CENTENARIO OES (2 CDRAS. ANTES D	0
1808	MAITA ROJAS ANALLY FERMINA	10427770180	MZA. O12 LOTE. 03 A.H. HOSPITAL DEL NI??O (ALT. CUADRA 18 AV. PROCECERE	0
1809	MALCA ROJAS FIORELLA TATIANA	10422717604	JR. HUAMACHUCO N?? 1895	0
1810	MALPARTIDA BLAS KATHERINE JANETH	10730827330	PJ. ROBLES MORALES NRO. S/N URB. ARTURO ROBLES MORALES (A 20 METROS DE	0
1811	MAMANI LAYME NERY NILDA	10456217554	MZA. C LOTE. 5 A.V. DON MAXIMO (PENAL SOCABAYA-FRENTE GRIFO SAN MIGUEL	0
1812	MAMANI MAMANI MARIBEL	10413426524	JR. UBINAS NRO. 466 URB. SAN MARTIN DE PORRAS (A 1 CUADRA DE TERMINAL	0
1813	MAMANI MAMANI YOVANA	10426317473	MZA. I LOTE. 03 ASOC.TEODORO R. PISCO (PARADERO DE RUTA A.-CIUDAD PERD	0
1814	MAMANI PERALTA ENMELI YURIKO	10456633019	MZA. U LOTE. 6 A.V. LAS ROCAS (2 CUADRAS TERMINAL DE BUS CORRECAMINOS)	0
1815	MAMANI PERALTA GISELA	10461849836	MZA. A LOTE. 5 A.H. STA. MONICA (PUCCHUN-COSTADO REST. MANLY) AREQUIPA	0
1816	MAMANI TURPO YULI LISBETH	10451603821	AV. SUCRE NRO. 416 DPTO. 201	966404375
1817	MAMANI VELASQUEZ IVAN CARLOS	10443786274	AV. SIMON BOLIVAR NRO. 1234 BARRIO CESAR VALLEJO PUNO - PUNO - PUNO	0
1818	MAMANI VILCA ROSANIA ELSA	10452941541	CAL. HUAMACHUCO CDA. 5 MZA. K LOTE. 8 COO. ANDRES AVELINO CACERES (A D	0
1819	MANCHEGO LLERENA JORGE MIGUEL	10431915095	AV. OSCAR R BENAVIDES NRO. 510 INT. 15	0
1820	MANCHEGOT PERU S.A.C.	20451535766	AV. JOSE GALVEZ BARRENECHEA NRO. 592 INT. 401 URB. CORPAC (FRENTE AL O	2263239
1821	MANDRILE BALLON DESIRE	10411926881	AV. EL GOLF NRO. 308 URB. MONTERRICO (COSTADO DEL CLUB PETROPERU)	0
1822	MANRIQUE MAMANI LIZETH EVELYN	10439370926	MZA. C LOTE. 4 URB. 3 DE OCTUBRE COMITE 5 AREQUIPA - AREQUIPA - JOSE L	0
1823	MANTARI MURILLO ROSA MARY KARINA	10419308574	AV. ALFONSO UGARTE MZA. 12 Z LOTE. 20A TABLADA DE LURIN (PARADERO 19)	0
1824	MANTILLA SAGASTEGUI JORGE LUIS	10410332804	MIGUEL ANGEL N?? 391	948102700
1825	MAQUERA CHURA BETZY NELLY	10456490994	LAS BEGONIAS MZA. 07 LOTE. 14 URB. AZIRUNI (FRENTE AL MERCADITO DE SAL	0
1826	MARCA LARICO OLGA MAGALY	10005040383	CAL. TACNA NRO. S/N (A 1CASA DEL C.INICIAL)	0
1827	MARCATOMA LLANOS KELY MAYUMY	10418364365	SUCRE NRO. 335 LA LIBERTAD - SANCHEZ CARRION - HUAMACHUCO	
1828	MARCELO FLORES GERALDINE ELIZABETH	10723796232	MZA. Q LOTE. 21 A.H. SAN GENARO LIMA - LIMA - CHORRILLOS	2542088
1829	MARCHENA SANCHEZ CYNTHIA VICTORIA	10444032753	MZA. H' LOTE. 9 URB. LAS BRISAS (II ETAPA	965851040
1830	MARCOS QUISPE MYRIAM PAOLA	10100248048	JR. JOSE MANUEL ITURREGUI NRO. 510 (ENTRE ANGAMOS Y REPUBLICA DE PANAM	0
1831	MARIN DEL AGUILA ERICK JAVIER	10419263899	JR. SANTA IN??S N?? 462	0
1832	MARQUEZ TEMOCHE MARYURIE GISELLA	10453087013	CAL. AMAZONAS NRO. 1023 (COLEGIO JOSE MARIA ESCRIV?? DE BALAGUER) PIURA	0
1833	MARQUINA ARAUJO DEYSY ELYTA	10448647876	PJ. EL TUNANTE LOTE. 15 A.H. 10 DE JULIO (A 2 CDRAS. DEL ESTADIO	0
1834	MARTINEZ ALCA LUIS ALBERTO	10422484979	CAL. MANUEL CANDAMO NRO. 128 (COSTADO DEL HOSPITAL)	9976-45585
1835	MARTINEZ BENAVENTE YANH CARLOS	10410688277	AV. 28 DE JULIO NRO. 340	0
1836	MARTINEZ ORDINOLA CARLA	10456752620	JR. RAUL PORRAS BARRENECHEA NRO. 2115 DPTO. 202	955312240
1837	MARTINEZ SANCHEZ BETTY ELIZABETH	10447298401	JR. CARLOS LAGOMERCINDO NRO. 236 CAJAMARCA - CHOTA - CHOTA	
1838	MARTINEZ ZEVALLOS JOSE ANTONIO	10077577373	JR. TARAPACA NRO. 424 URB. OYAGUE	3461415
1839	MASIAS CANDIA EMMA LUZ	10410383280	CAL. NATIVIDAD MZA. T LOTE. 12 URB. TTIO (A 2CDRAS DE CAPILLA 3ER PARA	0
1840	MASIAS QUISPE BETZABE	10411990121	PJ. JAVIER HERAUD MZA. T1 LOTE. 15 URB. TTIO (ENTRE EL TERCER Y CUARTO	956611011
1841	MASTER MEDIC EQUIPMENT S.R.L.	20546757472	AV. BENAVIDES NRO. 1238 DPTO. 1002	4460496
1842	MASTER TECNOLOGIES E.I.R.L.	20522496864	JR. EL CHACO NRO. 2228 (AV PERU CDRA 22 ESPALDA CINE JUNIN)	568-1147
1843	MATOS CASTRO DIEGO ENRIQUE	10741473998	CAL. TORRICELI NRO. 195 DPTO. 201 URB. SAN BORJA (CRUCE LAS ARTES SUR	593-5487
1844	MAURICIO ALTAMIRANO JORGE BRIYAN	10468740058	CAL. PIMENTEL NRO. 351 URB. SAN FELIPE 2DA ETAPA	543-0581
1845	MAYANGA ARROYO JULIO	10174233310	NRO. S-N CAS. TAMBO REAL -BATAN GRANDE (PASANDO CASERIO LA ZARANDA) LA	979822592
1846	MAYTA QUISPE KETTLYN	10428742392	AV. ISABEL LA CATOLICA NRO. 1579 INT. 316 (PISO 3 TDA 316-GAMARRA)	324-5205
1847	MEDICA DEL PACIFICO S.R.L.	20168548916	AV. DOS DE MAYO NRO. 1502 INT. 603	4402990 / 4211770
1848	MEDIFARMA S A	20100018625	CAL. ECUADOR 787	3326200
1849	MEDINA CABEZUDO DIANA CAROLINA	10448297115	PJ. MARTINEZ NRO. 105 CP CAMANA (FRENTE AL HOSPITAL) AREQUIPA - CAMANA	0
1850	MEDINA COLLANTES LEONEL ANTONIO	10802828662	CAL. ELIAS IPINCE NRO. 156 (2DO PISO	972914-204
1851	MEDINA HIJAR LIZETH BERENICE	10463962150	MZA. 171A LOTE. 6 A.H. SAN MARTIN DE PORRES (AV. HUANDOY CON AV. A)	0
1852	MEDINA LUCERO NOEMINA ELVIRA	10408240960	AV. DOS DE MAYO NRO. 1779 A.H. DOS DE MAYO	0
1853	MEDINA NAUPARI ELEOTT ULISES	10106472110	JR. VALENTIN ESPEJO NRO. 211 URB. SAN JUAN (ALT TELEFONICA DE SAN JUAN	9971-44064
1854	MEDINA QUISURCO JANY DEL ROSARIO	10400612078	JR. GERARDO DIANDERAS NRO. 2482 CONDEVILLA	567-3749 / 949382061
1855	MEDINA SUNCION STALYN FERNANDO	10704771156	URBANIZACION BANCARIOS MZA. C LOTE. 8 URB. BANCARIOS 2 ETAPA	0
1856	MEDRANO GAGO EDSEL YANELA	10447626158	MZA. 126A LOTE. 15 A.H. ENRIQUE MILLA OCHOA (AV.CENTRAL CON ENRIQUE MI	0
1857	MEDRANO RIVERA TONY	10425560641	CONDOMINIO CIUDAD NUEVA - URB. SAN JUAN MASIAS TORRE II-706	RPM 973998006
1858	MEDROCK CORPORATION SOCIEDAD ANONIMA CERRADA	20514710911	AV. BOLIVAR NRO. 795 LIMA - LIMA - PUEBLO LIBRE	261-4477/261-4503
1859	MEGO REBAZA NATALI VANESA	10436651398	MZA. C LOTE. 12 URB. LAS CAPULLANAS	0
1860	MEJIA TARAZONA EDWARD MICHAEL	10099347517	JR. ICA NRO. 759 DPTO. 201	731-3387
1861	MELGAREJO OCHOA ANGEL QUIRINO	10732515742	JR. RIVERO MANUEL NRO. 241 URB. PANAMERICANA NORTE LIMA - LIMA - LOS O	0
1862	MEMBRILLO OCAS YOVANA GISELA	10450481934	MZA. A LOTE. 42 CPM TARTAR I (ESPALDAS DE INIA) CAJAMARCA - CAJAMARCA	
1863	MENA RAMIREZ MARCO ANTONIO	10098608414	AV. UNIVERSITARIA NRO. 857 DPTO. 502	942-749986 / 983-453715
1864	MENA RUIZ JESSICA DEL MILAGRO	10401459231	CAR. PANAMERICANA MZA. B LOTE. 07 A.H. LOS ALMENDROS (A DOS CUADRAS DE	0
1865	MEND.GROUP E.I.R.L.	20519256887	MZA. H LOTE. 29 URB. LOS JAZMINES 3RA ETAPA PROV. CONST. DEL CALLAO	4845449
1866	MENDIETA OCHOA JUAN EMILIO	10768193989	MZA. A LOTE. 04 ASOC PROP LOS PARRALES (ALT DE LA POSTA MEDICA) LIMA -	992787660
1867	MENDOZA CASTA??EDA EMILY MELISSA	10438250153	MZA. 12 LOTE. 38 URB. NICOLAS GARATEA ANCASH - SANTA - NUEVO CHIMBOTE	0
1868	MENDOZA CASTILLO MAGALY CRISTINA	10166487400	NRO. C INT. 48 URB. SIETE DE AGOSTO (AL COSTADO CLINICA SAN JUAN DE DI	0
1869	MENDOZA FLORES OMARA OGMEF LIA KEYSHI	10705094239	CAL. JUNIN NRO. 607 (FTE AL POLIDEPORTIVO ROSA VARGAS DE PANI) ICA - I	0
1870	MENDOZA LAREDO FLOR VERONICA	10416213114	MZA. N LOTE. 13 URB. EL SATELIT	0
1871	MENDOZA SALDA??A MARIA FLORENCIA	10409810786	JR. FEDERICO VILLAREAL NRO. SN (CUADRA 7)	0
1872	MENDOZA VILLANUEVA JUDITH BEATRIZ	10081109783	CAL. RIVERA NRO. 110 URB. HUASCARAN	0
1873	MENGOA CASTA??EDA HELEN MARGIORI	10408576607	AV. CANTA CALLAO S/N COND. CIUDAD NUEVA	0
1874	MERE BURGA GUIDO ANTONIO	10452250085	JR. TACNA N?? 993 DPTO. 804	965966552
1875	MEZA CASTRO MARITA IRENE JOVITA	10700219912	CAL. J.BUSTAMANTE NRO. 258 U.PO.CONDEVILLA DEL SE??OR LIMA - LIMA - SAN	5673041
1876	MEZA PABLO SANDRA MARYLIN	10430100811	AV. 28 DE JULIO NRO. 1314 BARRIO SOLEDAD ALTA (FRENTE AL COLEGIO JEAN	0
2695	DOMINGUEZ LOPEZ NELVA	10466500041	JR. BOLOGNESI N?? 216	997958778
1877	MEZA VILCA YESIKA MARTHA	10247194016	NRO. B 23 URB. UVIMA II (FRENTE AL UNICO TELEFONO PUBLICO) CUSCO - CUS	0
1878	MIGUEL REYNA JACKELINE	10405952322	CAL. BOLIVAR NRO. 513 (ENTRE YAVARI Y TAVARA)	065-222497 / 954108619
1879	MINAYA LEON PERCY LUIS	10254958781	BL. 37 NRO. S/N DPTO. 804 RES. SAN FELIPE (CLINICA SAN FELIPE)	01-4622731
1880	MINISTERIO DE JUSTICIA Y DERECHOS HUMANOS	20131371617	CALLE SCIPION  LLONA 350 M??DULO 14	422-7804  /  440-4310
1881	MI??ANO MONTES ROSA HAYDEE	10161660341	AV. JUAN DE ALIAGA N?? 436	985865306
1882	MI??ANO SANCHEZ MARITZA RAQUEL	10434765621	CAL. REFORMA NRO. 10 CAP LAREDO LA LIBERTAD - TRUJILLO - LAREDO	0
1883	MIRANDA GARCIA MARICARMEN SCARLY	10464001099	SECTOR 8 MZA. A LOTE. 14 C.H. DEAN VALDIVIA ( ENACE) AREQUIPA - AREQUI	0
1884	MIRANDA YARANGA MAYRA ELISA	10414018616	URB. NOSIGLIA II PSJE. 3 N?? 146	993231272
1885	MISPIRETA LOLI SERGIO RICARDO	10102871851	CAL. GRAL. CLEMENT NRO. 1364 (ALT CD 13 DE LA AV LA MAR)	0
1886	MOGROVEJO BARRERA ANTONIO BERNARDO	10414531143	AV. BRASIL NRO. 3774	0
1887	MOLANO CHAVEZ TERESA NATALIA	10765373293	MZA. A LOTE. 2 A.H. 1RO DE NOVIEMBRE (FRENTE A SANTA ISABEL) LIMA - LI	0
1888	MOLINA GAVILAN LUCIA ISABEL	10412012068	CAL. PEDRO PENAGOS MZA. E LOTE. 7 URB. SAN ISIDRO (A 1CDRA DEL CENTRO	0
1889	MOLINA NEYRA KARINA LIZETH	10441624943	JR. LEONCIO PRADO NRO. 260 BARRIO SANTA ROSA PUNO - PUNO - PUNO	0
1890	MOLINA ROJAS ELIZABETH JUDITH	10416051998	JR. LIBERTAD NRO. 723 LIMA - LIMA - MAGDALENA DEL MAR	959974774
1891	MONDRAGON SUXE LADY	10458367260	JR. CENTRAL NRO. 503 C.P.M LLATA (A UNA CUADRA DEL INST. SUP. PED. LLA	0
1892	MONJA TINEO MILAGROS DEL PILAR	10454074373	MZA. F LOTE. 13 P.J. JORGE BASADRE (A ESPALDAS DE ALICORP) LAMBAYEQUE	950614735
1893	MONTALVAN HERNANDEZ DENISSE LISSETH	10406048905	AV. MORALES DUAREZ NRO. 2851 MIRONES BAJO (CRUCE CON AV. UNIVERSITARIA	0
1894	MONTENEGRO ALARCON FLOR DE LIZ	10335926710	JR. SANTO DOMINGO NRO. 139 (BARRIO LUYA URCO)	0
1895	MONTEROLA MEDINA DAMARIS SANDRA	10460381563	CAL. M. G. PRADA NRO. 401 P.J. EL CARMEN (PDO LA PASCANA 5 CDRAS PARA	0
1896	MONTES CARLOS FAVIOLA	10100324020	JR. LAS ESMERALDAS NRO. 945 P.J. EL BRILLANTE LIMA - LIMA - SAN JUAN D	0
1897	MONTES HUAMAN JULIA ANGELICA	10107198844	JR. JULIO C. TELLO NRO. 1235 URB. COVIDA 2DA ETAPA	0
1898	MONTES LAUREANO JAVIER JAIME	10421199090	0	0
1899	MONTEZA GONZALES JANETH ELIZABETH	10459981581	CAL. RICHARD GORDON NRO. 340 C.P. URRUNAGA IV SECTOR LAMBAYEQUE - CHIC	0
1900	MONZON OTINIANO JOSE JESUS	10456302349	CAL. AMAZONAS NRO. 390 INT. 3 URB. EL MOLINO	948186802
1901	MORALES ATOCHE JULIANA DEL PILAR	10429587854	MZA. E LOTE. 14-A A.H. JOSE OLAYA PIURA - PIURA - PIURA	0
1902	MORALES AVALOS ANA MARIA	10224037452	JR. SAN LUIS GONZAGA NRO. 171 PAUCARBAMBA HUANUCO - HUANUCO - AMARILIS	4331047
1903	MORALES MAGUI??A LUCIA MELCHORA	10258175943	CAL. LAS ESMERALDAS NRO. 184 URB. SAN ANTONIO PROV. CONST. DEL CALLAO	0
1904	MORALES NOLASCO NOR MARIBEL	10407635171	MZA. C LOTE. 04 ASOC LOS MECANICOS AYACUCHO - HUAMANGA - JESUS NAZAREN	0
1905	MORANTE QUIROZ MARJOIRIE ALDANA	10704874401	CAL. ANTONIO POLO NRO. 367 (ALT. CDRA 21 AV BRASIL) LIMA - LIMA - PUEB	9831150733
1906	MORE REYES JANETT ABIGAIL	10466155883	CAL. LOS TULIPANES MZA. LL LOTE. 20 URB. SANTA MARIA DEL PINAR	0
1907	MORENO EUSTAQUIO JAIME	10178076782	AV. PETIT THUOARS 1507-405	975692131
1908	MORENO VASQUEZ ELIANA VANESSA	10445305800	AV. PABLO CASALS NRO. 336 URB. MOCHICA	0
1909	MORILLO PEREYRA BRIGITTE NATALIE	10460477951	MZA. 74 LOTE. 30 NICOLAS GARATEA (FRENTE AL MERCADO SANTA ROSA)	0
1910	MOSQUERA CURITIMA ERIKA	10410419241	JR. AGUSTIN CAUPER NRO. 353 (HOSPITAL REGIONAL)	0
1911	MOSQUERA LEIVA CARLOS ENRIQUE	10084721625	JR. JOSE OLAYA NRO. 1179 PROV. CONST. DEL CALLAO - PROV. CONST. DEL CA	2612043
1912	MOTTA RODRIGUEZ LILIANA ELIZABETH	10430465746	JR. SAN GREGORIO MZA. Q LOTE. 18 URB. SAN DIEGO 2DA ETAPA	0
1913	MOYA ZAVALETA JIMMY CARLOS	10403284039	JR. GAMARRA N??613 - INT. 306 - LA VICTORIA	4326078 / 986609300 / 946270752
1914	MR KUVIC E.I.R.L.	20552707169	 Av. Uruguay Nro. 483 Int. 5 (Esp. del Colegio Ntra. Sra. de Guadalupe	674-7425
1915	MUCHAYPI??A VIVANCO JADY LAURA	10406011980	PJ. R MZA. B LOTE. 12 ASOC SANTO DOMINGO LIMA - LIMA - ATE	5832-818
1916	MULANOVICH LARRABURE GABRIEL	10416473451	AV LAS ARTES NORTE 634-SAN BORJA	987717008
1917	MULTIMUEBLES MONTERO SOCIEDAD ANONIMA CERRADA - MULTIMUEBLES MONTERO S.A.C.	20549245855	JR. MENDOZA MERINO NRO. 874 LIMA - LIMA - LA VICTORIA	4231224
1918	MULTIOFICINA S.R.L.	20471654079	AV. LAS FLORES N?? 220	388-9525
1919	MULTISERVICIOS GABRIELA E.I.R.L.	20452268834	JR. BELLIDO NRO. 530	(066) 966657011/ (066) - 319636
1920	MUNDACA NU??EZ JUAN ANTONIO	10174403215	CALLE MOLOKAY MZ. F6 LOTE 11	999991655
1921	MU??OZ AVILA EDGAR GUILLERMO	10002379789	MZA. A' LOTE. 10 A.H. ANDR??S A. C??CERES 2DA ET.	0
1922	MU??OZ ROSADA OLINDA	10024396296	JR. TUPAC AMARU NRO. 228 PUNO - SAN ROMAN - JULIACA	0
1923	MURGADO BLAS RICARDO ESTEBAN	10416470958	JR. RESTAURACION 540 NRO. 101 - BRE??A	97399458
1924	MURILLO CHUQUIVILCA ELISA	10098990785	JR. FELIX DEL VALLE NO. 424. - S.M.DE PORRES	
1925	MURILLO PE??A JUAN PABLO	10067222135	AV. SAN FELIPE NRO. 647 INT. 1502 (TORRE B)	4612665 / 999746449
1926	MURILLO RIOS KASSANDRA LUCERO	10727292794	MZ. L LT. 22 SAN PABLO	984184992
1927	NEYRA HERRERA SARELA	10437969251	CAL. LOS CLAVELES-1MER PISO NRO. 225 URB. SAN LORENZO (POR EL HOSTAL L	0
1928	NICHO RAMOS MAYRA GERALDINE	10445413581	CAL. J MZA. X LOTE. 17 ASOC PRO. LOS INCAS	0
1929	NI??O DE GUZMAN SISNIEGUES SILVIA LOURDES	10061430313	JR. ENRIQUE BARRON 1125 DPTO. 202	998095814
1930	NIVIN PARIAMACHI JANY JENIFER	10462119190	MZA. L LOTE. 22 E4L HEROE MCAL LUZURIA	0
1931	NOLE ALARCON DERY ARNALDO	10476025813	CAL. VICTOR CRIADO NRO. 2666 LIMA - LIMA - LIMA	2489434
1932	NOMEROS ORE MARIA JULIA	10210003008	AV. PEDRO DE LA GASCA NRO. 1096 P.J. EL CARMEN (ALT.AV.BELAUNDE CUADRA	0
1933	NORDIC PHARMACEUTICAL COMPANY S.A.C	20503794692	JR. PATRICIO IRIARTE 279 SANTA CATALINA	471-6076
1934	NORE??A MARTEL EDITH CARMEN	10225052561	JR. DANIEL A CARRION NRO. 115 PAUCARBAMBA	0
1935	NUNURA TOCTO ANA SOCORRO	10445302622	AV. NN MZA. B LOTE. 16 URB. IGNACIO MERINO ETAPA I (POR EL HOTEL GOLDE	0
1936	NU??EZ CULQUI MILAGROS SOFIA	10426997733	ESTOCOLMO MZA. Z-1 LOTE. 15 PORT J. PRADO (ALT DEL GRIFO VISTA ALEGRE	0
1937	NU??EZ GUERRERO ROSA KATHERINE	10446530700	CAR. CENTRAL KM. 14.5 LOTE. 51 (A 2 CDRAS ANTES DEL GRIFO STA CLARA	0
1938	NU??EZ ROBLES MARIA ELOISA	10225131347	CAL. PALMA REAL NRO. 115 URB. CAMACHO (AL FRENTE DEL COLEGI WALFOR	436-1837
1939	??AUPARI RUIZ TERESA CATHERINE	10106942345	AV. CORDILLERA ORIENTAL MZA. C1 LOTE. 08A DELICIAS DE VILLA 2DA ZON	0
1940	OBREGON QUISPE NELIDA NOEMI	10416095545	CAL. GUSTAVO VALCARCEL 221 MZA. K LOTE. 2 P.J. 4 DE OCTUBRE	987306079
1941	OCON TORRES JACKELINE CELIA	10459082242	JR. FERROCARRIL MZA. K3 LOTE. 7A IZCUCHACA (ENTRADA DEL CENTRO DE SALU	982723691
1942	OFIS IMPRESSER SAC	20508864923	CAL. 7 MZA. Q LOTE. 13 URB. SAN CARLOS	354-4759
1943	OJEDA MU??ANTE DE HUACASI ROCIO ENCARNACION	10081264495	CAL. TOBIAS MEYER MZA. L LOTE. 63 URB. EL PACIFICO (ALTURA CDRA 30 AV	0
1944	OLARTE CASTRO GLEDIA	10456031302	JR. HUANCAVELICA NRO. SN VILLA LA LIBERTAD	0
1945	OLVA COURIER S.A.C	20100686814	AV. ARENALES 1755	714-0909
1946	OPEN MEDIC S.A.C.	20524232104	CAL. MILTON NUMASON MZA. U LOTE. 1 URB. EL PACIFICO ET.2	531-2514
1947	ORDO??EZ CABELLOS MARY DE FATIMA	10806397071	CAL. LA PERLA NRO. 501 URB. SANTA INES	0
1948	ORE OSORIO JULIA FELICITA	10085361568	JR. LAMBAYEQUE NRO. 3717 INT. 2PIS URB. PERU	0
1949	OREGON ANTEZANA PATRICIA ROSA	10081666305	AV. CARLOS VALDERRAMA NRO. 457	565-7507
1950	ORELLANA ROMO GIULIANA HANNY	10215453371	AV. PETIT THOUARS NRO. 4470 DPTO. 401 (ALTURA CUADRA 41 AV.AREQUIPA)	0
1951	ORIHUELA COTERA MARLENE PILAR	10212843208	MZA. P LOTE. 37 CTO POBLADO VILLA RICA-E1 (ALT KM 18 CARRET CENTRAL-PA	0
1952	ORME??O ALBURQUEQUE GIULIANA MELISSA	10423682715	JR. GENERAL VARELA NRO. 1230 DPTO. 304 (ALT. CDRA 4 AV. ARICA	0
1953	ORTIZ ALIAGA CINTIA JANETH	10450686986	CAL. 15 MZA. X LOTE. 06 URB. EL ALAMO (CRUCE TOMAS VALLE CON PACASMAYO	0
1954	ORTIZ MORON HECTOR CESAR	10440974053	AV. LOS PARACAS NRO. 612 URB. SALAMANCA	992172403
1955	OSCO CHAMORRO EDITH MIRIAM	10437449959	MZA. A LOTE. 13 PROVIV. BAHIA BLANCA DE O PROV. CONST. DEL CALLAO	0
1956	OSTOS JARA BERNARDO ELVIS	10091606254	CAL. JOSE MARIA SERT NRO. 185 URB. SAN BORJA NORTE LIMA - LIMA - SAN B	996629443
1957	OTOYA MOYA CARLOS AUGUSTO	10027882370	BL. BLOCK NRO. 11A INT. 02 RES. ANAGAMOS (2 ETAPA-DPTO 2-EDIF. BLANCO-	073-327376
1958	OVIEDO ORELLANA MILAGROS ROSARIO	10199065829	AV. LOS LIBERTADORES MZA. P LOTE. 15 LIMA - LIMA - SAN MARTIN DE PORRE	995232409
1959	PACHECO IZQUIERDO KELLY JOANNE	10455173782	MZA. A?? LOTE. 5 A.H. ANDRES A. CACERES (ALT. DEPOSITO MUNICIPAL PUYANG	0
1960	PACHECO SANCHEZ DAYSI KAROL	10418531822	MZA. A LOTE. 20 SECTOR 2, GRUPO 4 (ALTURA DE PARADERO CUAVES) LIMA - L	981512321
1961	PACOSH BLAS LOURDES PAMELA	10406088681	PJ. LA ORQUIDEAS MZA. 16 LOTE. 2 PVU EL CARMEN ANCASH - SANTA - CHIMBO	0
1962	PALACIOS ARECHAGA DE AGURTO CARMEN MELISA	10418617247	MZA. G LOTE. 20 A.H. ALM MIGUEL GRAU 1 ETAPA PIURA - PIURA - PIURA	0
1963	PALACIOS MARTINEZ CARMEN MARIA MERCEDES	10104311836	MZA. G2 LOTE. 38 URB. SANTA LUZMILA (CDRA.64 AV.GERARDO UNGER-COMISARI	0
1964	PALOMINO AGUILAR DE GONZALES ELVIRA	10013428587	JR. RIVERA DEL MAR NRO. 171 BRR. RICARDO PALMA PUNO - PUNO - PUNO	0
1965	PALOMINO ESPINOZA EDER YAMILL	10425291110	JR. LAS ANEMONAS NRO. 1017 URB. LAS FLORES DE LIMA (ESP. ROKYS DE LAS	9979-17877
1966	PALOMINO JARA GUISELA MERCEDES	10420457958	CAL. SAN ERNESTO NRO. 6253 URB. STA.LUISA (ALT.GRIFO LAS VEGAS) LIMA -	0
1967	PALOMINO REYNAGA MARIBEL EUFEMIA	10409653559	CAL. LOS CIPRESES MZA. A LOTE. 33 ASOC RESID VILLA SULLANA	0
1968	PALOMINO TARAZONA LIZ CLARA	10700422726	MZA. H LOTE. 12 A.H. LETICIA (ESPALDA DE POTAO) LIMA - LIMA - RIMAC	5791062
1969	PALOMINO TOSCANO KATIA CAROL	10704325911	AV. ENRIQUE MEIGGS MZA. E LOTE. 21 P.J. MIRONES BAJOS (ES PJ ANTONIO L	3361528
1970	PANDURO SAAVEDRA EYDER	10417459249	JR. LETICIA NRO. 220	0
1971	PANDURO VILLANUEVA LESLY JOSELINE	10443796261	JR. COLONIAL NRO. 414 (A 1 CDRA DEL C.S SHOWING FERRARI)	0
1972	PAQUIYAURI CANCHO CATALINA	10403536399	CAL. SIN NOMBRE MZA. D LOTE. 24 URB. EX-FUNDO BUENA VISTA LIMA - LIMA	990228845
1973	PAREDES JARA ANA LUCILA	10434837532	AV. RICARDO PALMA NRO. 684 URB. SANTO DOMINGUITO	0
1974	PARI APAZA YOLANDA	10430048410	JR. LOS LIBERTADORES NRO. 521 URB. HORACIO ZEVALLOS (A 2 CDRS DE LA AV	0
1975	PARI HILASACA WILLAM ARTURO	10068105213	MZ. H1 LT. 9 VIRGEN DEL CARMEN NA??A	952255734
1976	PARRAGUEZ MONTENEGRO LEIPZIG DEL CARMEN	10452158910	CAL. HUASCAR NRO. 1381 A.H. C. PARRAGUEZ	0
1977	PASTOR BRIZZOLESE SUSANA JUDITH	10077691885	CAL. TARAPACA NRO. 142 INT. 4 (ESPALDA DE REST. MANOS MORENAS) LIMA -	998587928
1978	PASTOR TAPIA VICTOR JOSE	10700284935	AV. PAZ SOLDAN NRO. 263 URB. CONDEVILLA (ALT.CDRA.30 JOSE GRANDA) LIMA	0
1979	PATRICIO CENTENO LUIS ALBERTO	10441480119	AV. LOS EUCALIPTOS NRO. 166 URB. LAS VIOLETA (FRENTE DE PLAZA NORTE)	0
1980	PAZ GRADOS LINDER PAUL	10100693432	CAL. ERNESTO MALINOWSKI NRO. 388 CH.RIOS SUR (ALT CDRA 16 AV TINGO MAR	958792698
1981	PE??A ROMAN JHAJHAIRA PAOLA	10462743772	MZA. V LOTE. 13 INT. 01 A.H. LOS ALGARROBOS 1 ETAPA PIURA - PIURA - PI	0
1982	PE??ARANDA CUADROS MARIA ANGELA	10099362982	CALLE JOSE URDANIVIA GINES MZA. N3 LOTE. 03 URB. JAVIER PRADO	4372077 / 989323213 / 989583956
1983	PEQUE??O GONZALES MARIO ALEXANDER	10476358766	CAL. 5E MZA. F LOTE. 22 URB. SAN EULOGIO LIMA - LIMA - COMAS	6053262
1984	PEREDA DISTRIBUIDORES S R L	20136961528	AV. MRSCAL. LA MAR NRO. 318	441-3778
1985	PEREDA PASQUEL MARIA LUZ	10424842741	JR. JHON F. KENEDY MZA. A LOTE. 2 A.H. ESPERANZA BAJA ANCASH - SANTA -	0
1986	PEREZ CARO EVELYN SUSANA	10456775751	AV. ATAHUALPA NRO. 117 CAJAMARCA - CAJAMARCA - CAJAMARCA	0
1987	PEREZ CHINGO FERNANDO	10413548328	JR. SAENZ PE??A NRO. 445	0
1988	PEREZ CISNEROS ROBINSON GERARDO	10424652241	JR. 9 DE DICIEMBRE NRO. 412	966-022966
1989	PEREZ GUEVARA DEYSI	10420687244	AV. MESONES MURO NRO. 625 SEC. MORRO SOLAR CAJAMARCA - JAEN - JAEN	0
1990	PEREZ MORENO JOSE LUIS	10181379541	AV. ALAMEDA DEL CORREGIDOR N?? 2071 URB. LA CAPILLA	9446-28999
1991	PEREZ PAUCARCHUCO JENNY LUCY	10433127981	PROL. BOLOGNESI MZA. D1 LOTE. 9 PBLO PUCARA (A 1/2CDRA DESPUES DEL PAR	0
1992	PEREZ QUISPE OSCAR FREDY	10178679932	AV. TOMAS VALLE 1530 BLQ 2 NRO. 1530 DPTO. 202 LIMA - LIMA - LOS OLIVO	985791554
1993	PEREZ SOLORZANO CYNTHIA MILAGROS	10422050235	MZA. B24 LOTE. 8 URB. 21 DE ABRIL ANCASH - SANTA - CHIMBOTE	0
1994	PERULAB SA	20300795821	AV. SANTA ROSA NRO. 350 LIMA - LIMA - SANTA ANITA	6269090
1995	PETRERA PAVONE MARGARITA MARIA	10072068276	CAL. LOS CEDROS NRO. 727 DPTO. 602 (TORRE 2)	0
1996	PEZO PINEDO GISSELA DEL PILAR	10054044823	CAL. SANTA NICERATA NRO. 514 URB. SANTA EMMA LIMA - LIMA - LIMA	5645966
1997	PEZO RODRIGUEZ OLINDA BEATRIZ	10431639217	JR. ROSA MERINO MZA. I LOTE. 9 A.H. TUPAC AMARU	0
1998	PHARMAGEN S.A.C.	20478224169	AV. INDUSTRIAL NRO. 160 URB. LA AURORA LIMA - LIMA - ATE	3267200
1999	PHYMED SRLTDA	20335599251	CAL. LOS ANTARES NRO. 255 INT. 5 URB. LA ALBORADA	271-9859
2000	PINCO CONDORI YASMINA CARINA	10456459736	MZA. C LOTE. 12 A.H. V.EL SALVADOR GR. 16 (ALT. MARIATEGUI CON REVOLUC	0
2001	PINEDO ROJAS YAZMIN DEL CARMEN	10443373387	MZA. K LOTE. 20 URB. AYACUCHO LIMA - LIMA - SAN JUAN DE LURIGANCHO	0
2002	PINELO ALAMO CLAUDIA CECILIA	10446182906	CAL. CASTRO SILVA NRO. 184 PIURA - SULLANA - BELLAVISTA	0
2003	PINTO CARRANZA HELLEY TATIANA	10454356255	CAL. MANCO CAPAC MZA. G LOTE. 5 A.H. GALPONCILLO	0
2004	PINTO SANCHEZ CRISTHIAN OMAR	10706034868	MZA. S LOTE. 10 A.H. LUIS F. DE LAS CASAS	951993757
2005	PINTO SILVESTRE MILAGROS JOSEFINA	10724539977	JR. CALLAO NRO. 434 INT. PS 2	980465571
2006	PLAZA EVENTOS S.A.	20508091371	CAL. LA VENDIMIA NRO. 168 URB. LA TALANA (CDRA.10-11 AV.CASTILLA, FREN	272-0464
2007	POMA SALINAS EMMA RUTH	10199140405	AV. MANCHEGO MU??OZ N?? 458 DEL BARRIO DE SANTA ANA	0
2008	PONCE ESTELA RAQUEL ROXANA	10701527165	CAL. MS CARVAJAL NRO. 371 DPTO. 401 (TOMAS VALLE CON BERTELLO) PROV. C	982055517
2009	PONGO CHOTON GABRIELA MARIA	10462407721	AV. ESPA??A NRO. 2496 CERCADO TRUJILLO LA LIBERTAD - TRUJILLO - TRUJILL	
2010	PORTOCARRERO OLANO JUAN JOSE	10404310076	AV. CRLOS A. IZAGUIRRE NRO. 1327 URB. PALMAS REALES (A TRES CDRAS DE A	9870-13600
2011	POZO QUISPE CARMEN SOLEDAD	10102792748	CAL. S/N MZA. E LOTE. 11 14.6 HECTAREAS (ESPALDA CEMENTERIO DEL CALLAO	0
2012	POZO SOLIS YOLY	10097721691	AV. GRAL. VIVANCO NRO. 958 DPTO. 202B C.H. CONDOMINIO VIVANCO (AL LADO	0
2013	PRIETO RIVAS JOSE LUIS	10429782223	JR. SUYO NRO. 460 PIURA - PIURA - TAMBO GRANDE	0
2014	PRINCIPE DURAND DIRSEU HARRINSON	10465824552	JR. PENSILVANIA MZ. B LT. 10 URB. LAS VEGAS	999604099
2015	PRISMA COMUNICACIONES S.R.L.	20510000481	AV. JOSE PARDO NRO. 257 INT. 1501 (A 2 CDRAS DEL OVALO DE MIRAFLORES)	4451248
2016	PRODUCCIONES GENESIS S.A.C.	20293877964	JR. ANTONIO MIROQUESADA No. 376 - Of. 407	4265631
2017	PRODUCTOS DE PERU E.I.R.L.	20478124377	CAL. PABLO NERUDA NRO. 176 DPTO. 101 URB. COVIMA (A 2CDRAS. DE HOSPITA	624048
2018	PRODUCTOS YULI DEL PERU S.A.C.	20502739540	AV. ALEJANDRO TIRADO NRO. 706 URB. SANTA BEATRIZ	726-8718
2019	PROMED E.I.R.L.	20101267386	AV. GREGORIO ESCOBEDO 776 - 778	463-5287  /  463-8409  /  463-3497
2020	PROSAC S.A.	20167884491	calle san Ignacio de Loyola N?? 271	617-1212
2021	PROTECH DEL PERU S.A.C	20520714457	AV. ELMER FAUCETT NRO. 1663 URB. JARDINES VIRU PROV. CONST. DEL CALLAO	4640619
2022	PROVEEDORES TEXTILES MULTISERVICIOS E INVERSIONES S.A.C	20451730461	AV. UNIVERSITARIA MZA. E 2 LOTE. 04 URB. SAN CARLOS (ENTRE LA AV UNIVE	527-8242
2023	PROVERSAL SRL	20123751664	JR. PEDRO RUIZ 611 URB. SAN GREGORIO (ALT OVALO SHELL) LIMA LIMA BRE??A	425-0591  3321344
2024	PUICON PURIZACA CESAR EDUARDO	10433142964	CAL. DANIEL ALCIDES CARRION NRO. 469 INT. B URB. ALBRECHT (POR REST. D	0
2025	PULACHE FARFAN MARIA CYNTHIA	10725226158	JR. LORETO N?? 1274 MZ. A LT. 12	959306568
2026	PUMA ABARCA DANIELA VANESA	10455141686	JR. BOLIVAR NRO. 603 INT. C (CRUCE CON JIRON TARAPACA) LIMA - LIMA - L	4300194
2027	PUMA TORRES LUISA YSABEL	10405107967	CAL. INDEPENDENCIA NRO. 324 ICA - PISCO - PISCO	0
2028	Q PHARMA SOCIEDAD ANONIMA CERRADA - Q PHARMA S.A.C	20492461459	CAL. LOS ANTARES NRO. 320 INT. 803 URB. ALBORADA (TORRE A) LIMA - LIMA	6371957
2029	Q-MEDICAL S.A.C	20505719396	AV. ARICA N?? 1442	424-7290 / 433-4197
2030	QUESQUEN LOPEZ CESAR DANIEL	10167895650	JR. JOSE OLAYA NRO. 301 SAN MARTIN - SAN MARTIN - TARAPOTO	0
2031	QUISPE ALANYA BERTHA	10461393476	PJ. LOS CELAJES NRO. 213 (DETRAS DE LA UGEL) APURIMAC - ANDAHUAYLAS -	
2032	QUISPE CARDENAS RAUL ALFREDO	10450487410	NRO. 173 A.H. HUAYCAN GR UCV ZONA M (ALT. DEL MERCADO) LIMA - LIMA - A	987088654
2033	QUISPE CHAMBILLA DORALI RUTH	10427585412	CAL. 28 DE JULIO MZA. U LOTE. 15 P.J. SAN FRANCISCO (A UNA CUADRA DEL	0
2034	QUISPE DELGADO HAYDEE MARIA	10207076207	AV. SAN CARLOS NRO. 2115 (A 1 CDRA Y 1/2 DE LA UCCI) JUNIN - HUANCAYO	963520707
2035	QUISPE ESPINOZA GLORIA MARIA	10413041487	MZA. I LOTE. 12 APV HILDA SALAS (ESPALDA COLISEO CERRADO, CAMINO CACHI	0
2036	QUISPE GUTIERREZ HAYDEE DINA	10432473827	MZA. 37 LOTE. 02 ASOC. JOSE C. MARIATEGUI	0
2037	QUISPE HUAMAN DEYNI LORENA	10449409006	JR. MISION JAPONESA NRO. 315 BARR.MOLLEPAMPA BAJA CAJAMARCA - CAJAMARC	0
2038	QUISPE OSCUVILCA TABITA	10416497279	AV. OSCAR R. BENAVIDES NRO. 1061	0
2039	QUISPE QUINTANA EDGAR AMERICO	10283131845	JR. LA MAR NRO. 128 AYACUCHO - HUAMANGA - SAN JUAN BAUTISTA	966196110
2040	QUISPE QUISPE KAREN MARILIN	10423905013	MZA. Q LOTE. 2 URB. 10 DE SETIMBRE	0
2041	QUISPE RODRIGUEZ GISELLA FABIOLA	10435474158	AV. SAN MARTIN NRO. 133	4632166
2042	QUISPE SANCHEZ KARINA ELIANA	10414463822	MZA. 3 LOTE. 2 A.H. HUAYCAN ZONA A (ALT COLEGIO 1236) LIMA - LIMA - AT	0
2043	QUISPE SANTOS PATRICIA LILIA	10442811259	CAL. 8 MZA. O LOTE. 16 URB. AMAUTA LIMA - LIMA - SAN JUAN DE MIRAFLORE	0
2044	QUISPE SERRANO LUZ MARINA	10249946244	JR. VILCANOTA NRO. 230 QUILLABAMBA (1 CDRA ABAJO DE POLLERIA ROLY) CUS	0
2045	QUISPE TORO RONI	10450931581	AA.HH. MIRAFLORES MZ. A LT. B	0
2046	R & C HOLDING SOCIEDAD COMERCIAL DE RESPONSABILIDAD LIMITADA - R & C HOLDING S.R.L.	20507312943	CAL. JORGE BROGGI NRO. 284 DPTO. 401 URB. CHAMA	437-7998
2047	RABANAL ODAR ELTON ERICK	10431730931	LOS EUCALIPTOS NRO. 514 BELLASVISTA (PARALELA AV FAUCETT	0
2048	RAFAEL LLATAS LUISA MILAGRITOS	10448807601	AV. BALTA NRO. 2331 CPM GARCES (LADO HOSTAL MUCHIK-PORTON Y PUERTA CRE	947893199
2049	RAMIREZ ATOCHE GABY PAOLA	10412345377	MZA. J LOTE. 5 A.H. VILLA VICTORIA (POR EL CAMPUS UNIVERSITARIO DE LA	0
2050	RAMIREZ CESPEDES YERITZA PAOLA	10450684487	CAL. AMAZONAS NRO. 300 SECTOR CASTILLA	0
2051	RAMIREZ FREYRE LUZ ILLARY	10066714921	CAL. RICHARD STRAUSS NRO. 766 URB. LAS MAGNOLIAS (3PISO/ESPALDA CDRA 3	6625206
2052	RAMIREZ GUERRA VICTOR ROBINSON	10707635598	CAL. MAESTRANZA NRO. 118 (ENTRE SAN FCO. CON C. PORTUGAL) LORETO - MAY	0
2053	RAMIREZ HUERTA ADRIAN	10085199396	AV. CARLOS IZAGUIRRE NRO. 1286 COO. ANGELICA GAMARRA LIMA - LIMA - LOS	5230044
2054	RAMIREZ LALANGUI JACSELI MAGDA	10474631953	JR. 21 DE SETIEMBRE NRO. 526 DPTO. PS-2 P.J. LA LIBERTAD	979424814
2055	RAMIREZ MENDOZA EDELITA	10484005601	MZA. I LOTE. 60 PRO LIMA (PARQUE 2 COSTADO MINIMARKET)	552-5124
2056	RAMIREZ REATEGUI NELSON RAFAEL	10000935315	JR. GUILLERMO SISLEY NRO. 557 URB. JOSE C. MARIATEGUI (A MEDIA CDA MER	0
2057	RAMIREZ ROSADIO JOAN	10432396849	CAL. BOLOGNESI NRO. 316 LIMA - HUAURA - VEGUETA	0
2058	RAMIREZ SANCHEZ ROCIO JUDITH	10427274166	JR. MITOBAMBA MZA. D3 LOTE. 17 URB. LOS NARANJOS 3ET	0
2059	RAMIREZ SUAREZ DE TEMOCHE DEYSI SUSANA	10028937151	CAL. LEONCIO PRADO NRO. 406 INT. 01 (CERCA A PLATAFORMA) PIURA - SECHU	0
2060	RAMIREZ TUYA EYEDOLL HAIROSS	10417488982	AV. PROGRESO NRO. S.N URB. NICRUPAMPA (A DOS CASAS DEL PARADERO DE LA	0
2061	RAMOS FLORES SANDRA YESSICA	10095390060	PJ. BENJAMIN CISNEROS NRO. 164 DPTO. 301 BK. 2-A (ESPALDA DE BIBLIOTEC	226-7136
2062	RAMOS FLORES YELITZA	10436289311	SEC.24 DE JUNIO, PARCELA NRO. 9A COM.CAMP.COLLANAC (PARCELA 9A, AL LAD	0
2063	RAMOS LOPEZ FIORELLA IVONNE	10438100836	CAL. LOS AZAHARES NRO. 148 URB. SANTA ROSA DE QUIVES (ALTURA PUENTE SA	9751091718
2064	RAVINES CUBAS PATRICIA YSABEL	10266463231	JR. SAN SALVADOR NRO. 192 CAJAMARCA - CAJAMARCA - CAJAMARCA	
2065	REFASA S.A.C.	20100151970	CAL. ENRIQUE VILLANUEVA 105 URB. JUAN PABLO DE MONTERRICO	610-3100
2066	REINOSO SOTO NILDA	10310312989	AV. VENEZUELA NRO. 233 (1/2CD ESTADIO EL OLIVO) APURIMAC - ABANCAY - A	
2067	RENGIFO PINCHI MARLON MAYER	10405841571	JIRON MOROCOCOCHA N?? 164-DPTO E SURQUILLO	992772822
2068	RENGIFO ZAPATA JANINA MELISSA	10447102124	MZA. I2 LOTE. 20 URB. MICAELA BASTIDAS 4 ETAPA (DETR??S DEL COLEGIO CIS	0
2069	REPRESENTACIONES MADS E.I.R.L.	20500516764	JR. PARURO NRO. 1364	0
2070	REPRESENTACIONES MEDICAS MARY DEL PERU S.A.C.	20551917437	CAL. OMEGA NRO. 285 URB. PQ. INT. DE LA IND. Y COM	451-3771
2071	REQUE ACOSTA JACKELINE ALICIA INES	10075352862	CALLE AVILA N?? 159 URB. MAYORAZGO	3488439
2072	REYES CALERO JULIO CESAR	10445815905	AV. UNIVERSITARIA NRO. 2808 (FRENTE AL PARADERO LOS FICUS	0
2073	RIOS CHUQUIHUARA ZUSAN DEYSI	10417677149	PJ. UNION MZA. U LOTE. 2 A.H. EL PORVENIR ANCASH - SANTA - CHIMBOTE	0
2074	RIOS LUNA CAMILA BEATRIZ	10001107947	JR. IQUITOS NRO. 267 (POR GRUPO SAN ANTONIO)	0
2075	RIOS PEZO ANDREA ANAIS	10478392961	MZA. A LOTE. 15 A.V. LOS CHASQUIS LIMA - LIMA - SAN MARTIN DE PORRES	940087562
2076	RIOS RIOS BERTHA	10257298057	MZA. 79 LOTE. 12 A.H. EX FUNDO MARQUEZ (ALT KILOMETRO 14 DE MARQUEZ)	0
2077	RIVERA BENITES HELEM MARILY	10407856444	PJ. UNANUE NRO. 180 URB. AZCONA LIMA	991698344
2078	RIVERA CORONADO LIZETH MILAGROS	10433172219	CAL. AMOTAPE NRO. 299 A.H. JUAN VELASCO ALVARADO PIURA - SULLANA - SUL	0
2079	RIVERO GARCIA DANIEL GERMAN	10430290059	AV. LA MARINA NRO. 1236 URB. CEREZOS I (CEREZOS 1ERA ETAPA FRENTE MIN.	420-4051
2080	RIVEROS VELARDE SANDRA	10406626798	JR. COLONIAL NRO. 215 BARR.YANANACO (FTE ESQ. JR.PACHACUTEC,2PI RUSTIC	0
2081	ROA ORDINOLA MAYRA LIZBETH	10451445281	CAL. MARIANO MELGAR NRO. 224 A.H. SANTA TERESITA	0
2082	ROBLES ASTUHUAMAN DENISSE KETTY	10406876107	JR. LAS COLINAS NRO. S/N CPM BELLAVISTA (S69430185-1/2CD CARR CTRL X E	0
2083	ROBLES CABRERA MARLENY	10403553005	PROLONGACION CHEPEN NRO. 1015 CAJAMARCA - CAJAMARCA - CAJAMARCA	0
2084	RODAS MORON ROOY RONALD	10439870538	AV. R. RIVERA NRO. 2607 DPTO. D (PISO 3)	0
2085	RODRIGUEZ CAPACYACHI ESTHER NELLY	10200107093	AV. MANCHEGO MUNOZ NRO. 361 JUNIN - HUANCAYO - EL TAMBO	964040498
2086	RODRIGUEZ DIAZ FERNANDO	10066009705	PJ. LOPEZ DE GAMARRA NRO. 124 URB. SALAMANCA DE MONTERRICO LIMA - LIMA	956721195
2087	RODRIGUEZ GARCIA CARLOS MARTIN	10182121911	AV. JUAN PABLO II NRO. MZ N INT. L108 RES. LUIS ALBRECHT	0
2088	RODRIGUEZ PAIVA DEL AGUILA CELIA	17149116931	EL DERBY 335 URB.EL DERBY DE MONTERRICO	989850316
2089	RODRIGUEZ QUICHIZ DAVID ALBERTO	10479100824	AV. COLOMBIA NRO. 255	941162345
2090	RODRIGUEZ QUISPE FANNY KELLI	10269632921	CAL. LOS RUBIES NRO. 213 URB. SANTA INES LA LIBERTAD - TRUJILLO - TRUJ	0
2091	RODRIGUEZ VILCA RUT MERY	10454470473	UCV 187 LOTE 47 ZONA O HUAYCAN	0
2092	ROJAS AMAYA ROSARIO ELIZABET	10443879434	CAL. FELIX ALDAO NRO. 125	0
2093	ROJAS BARDON LIZ KARINA	10416388071	FILADELFIA NRO. 1393 LIMA - LIMA - SAN MARTIN DE PORRES	
2094	ROJAS BENITO EDER GREGORIO	10413451570	JR. LAS PERAS NRO. 370 URB. NARANJAL LIMA - LIMA - SAN MARTIN DE PORRE	5216596
2095	ROJAS CABRERA FIORELLA JEANETT	10467396205	MZA. N LOTE. 26 URB. PARQUE INDUSTRIAL LA LIBERTAD - TRUJILLO - LA ESP	0
2096	ROJAS DIAZ JESSICA LITA	10447318950	JR. GUILLERMO URRELO NRO. 1298 BR SAN ANTONIO	0
2097	ROJAS ESPIRITU PAOLA PATRICIA	10469334282	AV. TUPAC AMARU NRO. 322 (A 05 CASAS DE I.E. ANGELA MORENO) JUNIN - TA	988860989
2098	ROJAS LEANDRO ELA MIRIAM	10402578691	MZA. E LOTE. 8 URB. EL BOSQUE (COSTADO DEL ESTADIO HERACLIO) HUANUCO -	0
2099	ROJAS LIVIA SELY	10404839671	CAL. JAVIER PULGAR VIDAL MZA. A LOTE. 13 C.P. ME. VILCAR CAYHUAYNA	0
2100	ROJAS MESIA ADILIA	10087664347	CAL. C-1 NRO. 170 URB. LOS PRECURSORES LIMA - LIMA - SANTIAGO DE SURCO	282-2179
2101	ROJAS MEZA LINDA RUTH	10414711222	ZONA II MZA. B4 LOTE. 1 URB. DELICIAS	0
2102	ROJAS PISSANI JESSICA RAQUEL	10412953024	PJ. MARIA PARADO DE BELLIDO NRO. 120 URB. SANTA CLARA (A MEDIA CUADRA	969532478
2103	ROJAS TAMARA MARY LUZ	10400937538	BL. APROVICA MZA. A LOTE. 20 URB. APROVICA (ESPALDA DEL CONTROL	0
2104	ROJAS VASQUEZ JULISSA DEL PILAR	10444534431	MZA. 61 LOTE. 15 URB. SAN JUAN DE CHOTA LAMBAYEQUE - CHICLAYO - PATAPO	1123-4567
2105	ROJAS VELA JOYCE JAZMIN	10054166139	AV. ESTEBAN CAMPODONICO NRO. 490 DPTO. D URB. SANTA CATALINA	0
2106	ROLDAN MONZON ANGIE VANESSA	10428545147	JR. FLORA TRISTAN NRO. 3153 URB. CONDEVILLA (ALTURA CUADRA 30 AV. JOSE	0
2107	ROMERO FRANCO KARINA	10406183195	CAL. MARISCAL MILLER NRO. 1780 (CERCA AV. CANEVARO) LIMA - LIMA - LINC	2255213
2108	ROMERO SANTA CRUZ EYDA	10421396596	CAL. JORGE CHAVEZ NRO. C4 SECTOR SANTA CECILIA CAJAMARCA - JAEN - JAEN	0
2109	ROMERO VELA KATHERINE ADRIANA	10726529928	CAL. MANUEL GONZALES PRADA NRO. 492 COO. UNIVERSAL 1 ETAPA LIMA - LIMA	602-5830
2110	RONDINEL GOMEZ CARLOS RONALD	10429198475	JR. ABRAHAN VALDELOMAR NRO. 871 (LA RECTA DE LA POSTA NAZARENAS	966-76295
2986	MALCA ROJAS FIORELLA TATIANA	10422717604	JR. HUAMACHUCO N?? 1895	0
2111	ROQUE ARIAS NANCY LILIANA	10090552720	CAL. 24 MZA. P LOTE. 02 URB. LOS ANGELES DE VITARTE (FRENTE COLEGIO IN	0
2112	ROSALES BRIONES KARINA FIORELLA	10440572788	JR. GUILLERMO MOORE NRO. 509 A.H. EL ACERO (FRENTE A LOS BOMBEROS) ANC	0
2113	ROSALES PALACIOS MANUEL ERNESTO	10434828029	AV. CAMINO REAL MZA. G LOTE. 1 P.J. ALTO PERU ANCASH - SANTA - CHIMBOT	0
2114	ROSPIGLIOSI ORBEGOSO MILUSKA YANIRA	10463179161	CAL. FRAGONAR NRO. 156 URB. SAN BORJA LIMA - LIMA - SAN BORJA	940248430
2115	RPQ LOGHIST INTEGRAL SOLUTIONS S.A.C	20537568080	AV. 6 DE AGOSTO N?? 525 INT. 201	240-1348
2116	RUBIO JUAREZ ANA MARIA	10102168068	CAL. LAS PASIONARIAS NRO. 240 URB. SANTA ISABEL	0
2117	RUIZ AGUILAR MILAGROS ELIZABETH	10409196379	JR. EL INCA NRO. 417 BARRIO LA COLMENA CAJAMARCA - CAJAMARCA - CAJAMAR	976727656
2118	RUIZ BRIOSO DANY	10466064063	MZA. 66 LOTE. 11 BARR 27 DE MAYO (DETRAS DE CLAS AUCAYACU	0
2119	RUIZ DIAZ JHOSELYN PAMELA	10765243713	I. MERINO NRO. 3776 PANAM. NORTE LIMA - LIMA - LOS OLIVOS	0
2120	RUIZ GOMEZ RUTH ROSARIO	10455451928	MZA. D LOTE. 16 URB. HORACIO ZEVALLOS (JR. TARSICIO BAZAN 344) CAJAMAR	943065692
2121	RUIZ HERRERA GISELLA GREYSY	10439411355	JR. LAS BEGONIAS MZA. P LOTE. 6 URB. ENTEL PERU (ALT DEL CINE SUSI)	0
2122	RUIZ LEIVA FATIMA JANETH	10457718620	JR. ILLIMANI NRO. 115 BAR, MARCOPAMPA CAJAMARCA - CAJAMARCA - CAJAMARC	0
2123	RUIZ VARGAS WILLY FRANK	10454578037	CAL. 2 MZA. C LOTE. 03 URB. SANTA ROSA (POR LA CASA BLANCA)	0
2124	SAAVEDRA ARRASCUE OMAR HERNANDO	10451377171	CAL. COSME BUENO NRO. 485 URB. LA NORIA LA LIBERTAD - TRUJILLO - TRUJI	0
2125	SAAVEDRA SOSA SAYMIN DEL SOCORRO	10453813458	CAL. TARATA NRO. S/N P.J. SANTA ISABEL LAMBAYEQUE - LAMBAYEQUE - OLMOS	
2126	SABA SALAZAR ELENA ALICIA	10329756314	JR. MATEO PUMACAHUA NRO. 322 A.H. LA LIBERTAD	0
2127	SABAS OLAYA YADIRA YAJAIRA	10435455056	MZA. B7 LOTE. 6 C.H. MARISCAL CACERES LIMA - LIMA - SAN JUAN DE LURIGA	0
2128	SALAS HIDALGO LARISA	10054168565	PJ. CABO PANTOJA NRO. 163 (MANCO C. STA. ROSA CDRA. 15 PUTUMAYO	0
2129	SALAS LAZA LUIS ANGEL	10769216095	SECTOR ESTABLO HUAMAN MZA. B LOTE. 6 ASO.DE PROP.LA GRAMA (ALT. GRIFO	964848398
2130	SALAS RAMIREZ YESENIA	10409374480	MZA. D3 LOTE. 13 URB. JOSE CARLOS MARIATEGUI ANCASH - SANTA - NUEVO CH	0
2131	SALAS YUMBATO KATHERIN ARLEY	10703472040	CAL. DOS MZA. A LOTE. 24 (A ESPALDAS DE GRIFO AMPARITO - TERMINAL) LOR	0
2132	SALAZAR CHU PATRICIA	10296655916	MZA. C LOTE. 3 ASOC. DOCENTES U.C.S.M. AREQUIPA - AREQUIPA - CERRO COL	0
2133	SALAZAR QUISPE JOSE JESUS	10450629354	AV. CENTENARIO NRO. 159 LA LIBERTAD - PACASMAYO - SAN PEDRO DE LLOC	0
2134	SALAZAR QUISPE SHEILA MARILIZ	10428002984	CAL. 1 MZA. E LOTE. 12 URB. LOS VI??EDOS DE CARABAYLLO	0
2135	SALAZAR VENTURA DEBORA RUTH	10773230281	CAL. CRNL FRANCISCO BOLOGNESI MZA. 01 LOTE. 14 A.H. A??O NUEVO (ALT DEL	0
2136	SALAZAR VENTURA EVELYN LUZMILA	10483351033	CAL. CRNEL FRANCISCO BOLOGNESI MZA. 01 LOTE. 14 P.J. A??O NUEVO LIMA -	0
2137	SALCEDO CHANDIA CRISTIAN DAVID	10257460008	AV. BRASIL NRO. 2377 DPTO. 102 LIMA - LIMA - JESUS MARIA	0
2138	SALDANA VILLANUEVA ROCIO MARGARITA	10081534794	BLOCK NRO. 48 INT. 201 U.V. DEL RIMAC LIMA - LIMA - RIMAC	0
2139	SALDA??A MACEDO NAHUN	10458318501	JR. SAN JUAN MZA. A LOTE. 32 URB. EL TOTORAL (AL FINAL DE LA SOTO BERM	4772461
2140	SALINAS QUINTANA LUIS FRANCISCO	10405809520	PJ. 1 NRO. A INT. 12 URB. VILLA MARINA (ALT.MERACDO DEL PUEBLO--AV.SAN	344-2527
2141	SALINAS QUISPITUPA JUAN RICHARD	10439980716	MZA. D7 LOTE. 3 A.H. ANGAMOS SECTOR I (PARADERO 8)	0
2142	SALINAS VEGA ALDO ALBERTO	10400677617	PROLONG MANCO SEGUNDO NRO. 115 DPTO. 1204 INT. A URB. PANDO	997561105
2143	SALVADOR VIGIL MIRLA DALIA	10421709837	JR. LA COLMENA NRO. 141 P.J. SAN MARTIN (FRENTE A TRANSPORTES FLORES)	
2144	SAMPEN CELIS LUZMILA EMPERATRIZ	10409034808	PJ. VENTURA HUAMAN NRO. 180 URB. FEDERICO VILLAREAL LAMBAYEQUE - CHICL	990351521
2145	SANCHEZ CORTEZ JENNIFER LISBETT	10468648381	LOS CLAVELES NRO. 188 ERMITA??O	992362553
2146	SANCHEZ GONZALES FLOR KARINA	10425779406	AV. 28 JULIO NRO. 178 (PARQUE ARTESANAL)	0
2147	SANCHEZ HUAMAN ELMER ROGER	10455975544	JR. ANTONIO RAIMONDI NRO. 141 URB. SAN LUIS CAJAMARCA - CAJAMARCA - CA	0
2148	SANCHEZ MANZO JAVIER HERNAN	10101293233	JR. YURAYACU N?? 2471 URB. MANGOMARCA	0
2149	SANCHEZ PERALTA NADIA DENISSE	10422185971	CAL. CORREA NRO. C-02 NUEVO HORIZONTE (FELIZ CORREA C-2 T-65) CAJAMARC	0
2150	SANCHEZ ROJAS MARIA MILAGROS	10401924910	AV. LA PAZ NRO. 1519 URB. LOS ROSALES DE STA. ROSA	0
2151	SANCHEZ TELLO MARIA VIOLETA	10418146830	CAL. 69 MZA. N4 LOTE. 29 URB. EL PINAR (ALT AV LOS INCAS) LIMA - LIMA	
2152	SANCHEZ VALVERDE JACKELINE ELIZABETH	10445127804	CAL. MIGUEL GRAU NRO. 921 BUENOS AIRES NORTE	0
2153	SANCHEZ VILLAR CECILIA TERESA	10257267810	JR. BOLOGNESI NRO. 1228	0
2154	SANDERSON S.A. (PERU)	20381450377	AV. NICOLAS ARRIOLA 345 URB. SANTA CATALINA	471-1143/471-1101
2155	SANDOVAL GOMEZ MERCEDES DEL PILAR	10420731014	JR. CAJAMARCA NRO. 843 A.H. PACHITEA PIURA - PIURA - PIURA	0
2156	SANDOVAL REYES VIKY DINA	10712656455	MZA. B LOTE. 3 A.H. LOS CLAVELES II LIMA - LIMA - SAN JUAN DE LURIGANC	0
2157	SANTISTEBAN DE LA CRUZ DIGNA ELENA	10439153364	MZA. A LOTE. SN CAS. SANTA ISABEL (INGRESANDO A CASERIO) LAMBAYEQUE -	
2158	SANTIVA??EZ PANTOJA ARACELLY FLOR DE MARIA	10443932351	JR. TRUJILLO NRO. 1080 BARR.TUCUMACHAY JUNIN - HUANCAYO - EL TAMBO	0
2159	SANTOS CHERO MILAGROS DE LOURDES	10426966412	CAL. ICA-CUADRA 10 NRO. -- INT. 3 (POR EL BANCO DE CREDITO) PIURA - PI	0
2160	SANTOS ILLESCAS SILVIA LIZ	10437615859	CAL. GREGORIO ATENCIO NRO. 117 PBLO. SAN ANTONIO DE RANC (AL COSTADO D	0
2161	SANTOS MANTURANO JANETH ELIZABETH	10102517721	MZA. Q LOTE. 4 LOS ANGELES SECT.	0
2162	SAQUICORAY LANDA NORY CYNTHIA	10707650813	JR. LOS PROCERES NRO. SN (ENT PROCERES Y PSAJE AURORA S.71161692) JUNI	0
2163	SARAVIA MONDALGO MONICA LISETH	10438317843	AV. EL BOSQUE MZA. A LOTE. 4 C.H. IGNACIA RODULFO VDA DE CA LIMA - LIM	964388654
2164	SECLEN CADENILLAS VILMA TERESA	10472224498	BL. B NRO. S/N DPTO. 401 C.H. JOSE BALTA LAMBAYEQUE - CHICLAYO - CHICL	
2165	SEGOVIA CABELLO NADIA LIZ	10402412980	ASUNCION NRO. 188 EL PARRAL (ALT. KM. 8.5 DE AV. T??PAC AMARU	0
2166	SEGOVIA VENTURA ARELI	10472905088	MZA. B LOTE. 15 A.H. RINCONADA DE VILLA	0
2167	SEGURA CORAMPA ROSA BEATRIZ	10732294380	CAL. 18 MZA. 58 LOTE. 10 (ALT DEL OVALO DE CALLE 17) PROV. CONST. DEL	0
3222	QUISPE TORO RONI	10450931581	AA.HH. MIRAFLORES MZ. A LT. B	0
2168	SEGURA CORDOVA ZOILA LUZ	10095963540	CAL. LOS GLADIOLOS NRO. 272 URB. LOS JARCINES DE SALAMANCA (ALT.ULTIMA	0
2169	SEJEKAM WAJAI ELVIS JHOVER	10460801406	JR. SAMUEL WAJAJAI NRO. S/N NARANJILLO SAN MARTIN - RIOJA - AWAJUN	950668218
2170	SEMPERTIGUI RODAS MANUEL	10335916960	PJ. PERU NRO. 372	0
2171	SERNA SERVICIOS S.A.	20549566147	JR. CARLOS AGUSTO SALAVERRY NRO. 3981 URB. PANAMERICANA NORTE	622-0185
2172	SERRANO CARRANZA MIRIAM ROSANNA	10411628421	JR. COMERCIO NRO. 1115 CENTRO BAGUA	0
2173	SERRANO VARGAS LAURA	10425139105	MZA. F LOTE. 21 URB. VELASCO ASTETE (LADO IZQUIERDO DEL AEREOPUERTO CA	0
2174	SERVICIOS GENERALES JUCASE E.I.R.L	20392514342	JR. SAN PEDRO DE CARABAYLLO NRO. 329 URB. SANTA ISABEL	5351290 / 5441633 / 980299290 / 99267027
2175	SERVICIOS NAVALES E INDUSTRIALES SAN PEDRO S.A.	20101399703	Calle Edwin White N?? 326, Urb. Industrial La Chalaca	4652176
2176	SERVICIOS Y DERIVADOS VR S.A.C.	20548531650	RECUAY NRO. 628 LIMA - LIMA - BRE??A	998301974
2177	SHUPINGAHUA PANDURO SULLY	10425118191	JR. VISTA ALEGRE NRO. 397 A.H. LAS MERCEDES	0
2178	SICHA CUETO IVETH SALLY	10460316966	AV. MARISCAL CACERES NRO. 874 INT. 8 (FRENTE DE CARSA EN UN PASAJE) AY	
2179	SIERRA FARFAN ROCIO KARINA	10316703521	AV. PROGRESO NRO. S.N URB. NICRUPAMPA (FRENTE A BODEGA KARINA)	0
2180	SIERRA RODRIGUEZ CINDY	10448854138	MZA. B LOTE. 3 ASOC PROP VICENTELO BAJO	0
2181	SIGUAS GONZALES LUIS YSMAEL	10096959414	MZ. I LT. 20 URB. PACHACAMAC 3RA ETAPA (AV. MARIATEGUI CON AV. CENTR	996784395
2182	SIHUINCHA LAPA JACKELYN	10430227730	MZA. E LOTE. 7-8 A.H. CESAR VALLEJO (KILOMETRO 9.200 CARRETERA CENTRAL	0
2183	SILUPU CASTILLO ROSA MARIBEL	10707741380	MZA. F5 LOTE. 08 INT. 1 A.H. TUPAC AMARU (A 2 CDRAS DE LA IGLESIA FATI	0
2184	SILVA GOMEZ MONIQUE JULIETTE	10079248598	JR. MADRID NRO. 157 INT. B (ALT CDRA 12 AV BOLIVAR)	461-3878 / 945026444
2185	SILVA PAREDES JULISSA DEL CARMEN	10329874686	MZA. N5 LOTE. 12 URB. LAS GARDENIAS ANCASH - SANTA - NUEVO CHIMBOTE	0
2186	SILVERA RICHARTE DEMI YULIZA	10703788055	JR. AYACUCHO NRO. S/N (1187,FRENTE AL PRONAA) APURIMAC - ANDAHUAYLAS -	
2187	SINCHEZ ROJAS EVELYN DIONICIA	10444751580	CAL. 8 MZA. G LOTE. 18 URB. LA MERCED DE MONTERRICO	0
2188	SIVIRICHI GARMA TATIANA JHAJAIRA	10447618678	MZA. E LOTE. 10 URB. SAN JOAQUIN I ETAPA (POR LA PANADERIA-SEGUNDA ENT	940161516
2189	SOLIS SALINAS KAREN VICTORIA	10457897273	JR. REYNALDO DE VIVANCO NRO. 375 U. POP. CIUDAD DE DIOS	0
2190	SOLUCIONES ESTRUCTURALES SOCIEDAD ANONIMA CERRADA	20506963754	AV. SALAVERRY N?? 2802	7179300 - 7179304
2191	SONICA PERU E.I.R.L.	20553658226	"AV. JORGE CHAVEZ N?? 242 OF. ""E"""	981455091
2192	SORIANO AGUILAR JULISSA NATALY	10445712405	CAL. TNTE CORONEL NICOLAS ARR NRO. S/N A.H. SE??OR DE LOS MILAGROS	0
2193	SOSA GILES MARIA ISABEL	10434508164	CAL. 1 DE MAYO - SECT II NRO. 281 CERCADO	0
2194	SOSA SOTO ESTEFANY CRISTEL	10446301425	CAL. BUENOS AIRES MZA. 12 LOTE. 26 A.H. SAN PEDRO PIURA - PIURA - PIUR	0
2195	SOTELO GOMEZ JOSHELYN JERIT KELLY	10466434979	CAL JULIAN ALARCON NRO. 812 URB. SAN GERMAN	0
2196	SOTO ESPINOZA NOYMI EDELINA	10094576895	JR. HUALCAN NRO. 342 ANCASH - HUARAZ - HUARAZ	0
2197	SOTO ROSADO DENISSE CINTHIA	10421003870	CONCHUCOS NRO. 467 (MEDIA CUDRA DE LA DIROVE)	0
2198	SOTO TINOCO CLAUDIA FIORELLA GEORGINA	10452670955	JR. CHAVIN NRO. 2 URB. CHACRA COLORADA	0
2199	SOUZA FLORES JESSY CAROLINA	10424186851	CAL. CAPITAN BELGRANO NRO. 122 (CON PIURA) LORETO - MAYNAS - PUNCHANA	0
2200	SPECTRUM INGENIEROS S.A.C.	20503650186	JR. GREGORIO PAREDES NRO. 220 (OTRO 222/PARALELA A CDRA.27 AV.BRASIL)	462-2749
2201	STAR PRINTING S.A.C	20545777968	ESQ EMILIO ALTHAUS NRO. 406 LIMA - LIMA - LINCE	4710956
2202	SUAREZ MENDOZA ROSA MARIBEL	10426752889	CAL. MERCADERES NRO. 264 URB. LAS GARDENIAS	0
2203	SUAREZ MORENO VICTOR JAVIER	10094077228	PJ. EL AMAUTA NRO. 105 C. FERNANDINI (AV LAS PALMERAS CDRA 42) LIMA -	993961864
2204	SUAREZ PALOMINO DELIA	10433078069	MZA. R LOTE. 9 URB. SAN MIGUEL DE SAUCEDA (DETRAS DE LA UGEL CERCO PRT	0
2205	SUAREZ SEGOVIA RAQUEL	10423832709	CAL. CARLOS DE LOS HEROS NRO. 168 URB. NAVAL ANTARES (AV TOMAS VALLE Y	5314756
2206	SUNCION ZAPATA ERICKA ARACELLY	10429275399	MZA. D?? LOTE. 06 A.H. LOS FICUS (ESPALDA DEL ESTADIO) TUMBES - TUMBES	0
2207	SUYON SANTA CRUZ PAOLA GIOVANNA	10434312430	AV. AVENIDA MIGUEL GRUA NRO. 607 C.P. PICSI (ULTIMO ROMPEMUELLE) LAMBA	
2208	TAFUR PORTOCARRERO DEYSY	10439561896	JR. HERMOSURA NRO. 160 AMAZONAS - CHACHAPOYAS - CHACHAPOYAS	0
2209	TAKEMOTO VILLANUEVA YURIKO YOMARA	10456751364	CAL. BELEN NRO. 137 P.J. LA ESPERANZA LA LIBERTAD - TRUJILLO - LA ESPE	0
2210	TALLEDO HUAMAN JOSE DOMINGO	10258369322	CAL. HUAMACHUCO NRO. 152 URB. EMPLEADOS DE MIRAFLORES (ENTRE CDRA 8 Y	0
2211	TALMA SERVICIOS AEROPORTUARIOS S.A	20204621242	ELMER FAUCETT CDRA S/N	  574-3459
2212	TAYPE CASTILLO TANYA MAGALI	10084635702	JR 9 N?? 318 DPTO 303 - URB MONTERRICO NORTE - SAN BORJA	996284165
2213	TE.SA.M. PERU S.A.	20306102967	CAL. CORONEL ODRIOZOLA NRO. 126 URB. SAN ISIDRO	705-4141
2214	TECNOLOGIA INDUSTRIAL Y NACIONAL S.A.	20110133091	AV. MANUEL OLGUIN N?? 501 DPTO. 1103	2081230/2081259
2215	TEJADA MUSAYON MARIA JAQUELINE	10454129780	CAL. MARISCAL URETA NRO. 1377 CPM TORIBIA CASTRO LAMBAYEQUE - LAMBAYEQ	
2216	TELCOMSYS S.A.C.	20511145156	JR. PABLO ALAS MZA. C LOTE. 14 URB. SAN JUAN DE MIRAFLORES	276-8100 4660536
2217	TELEFONICA DEL PERU S.A.A.	20100017491	AV.AREQUIPA N?? 1155	210-4895
2218	TELEFONICA MOVILES S.A	20100177774	AV. JAVIER PRADO ESTE 3190	6904070/2109229
2219	TELLO PARIAMANCO EDITH JULIA	10454325546	PJ. 1 MZA. 36 LOTE. 10 A.H. 9 DE FEBRERO	0
2220	TELLO ROJAS EVER EDINSON	10454670553	PJ. SAN AGUSTIN NRO. 134 BARR.SAN SEBASTIAN (PLAZ.BOLOG.MEDIA CDRA.POR	
2221	TELLO TORRES MARIBEL ESMERALDA	10413983890	PROL. LEONCIO PRADO NRO. 140 INT. 2	0
2222	TENORIO CARRASCO GIANNI VRUBEL	10423468454	JR. ASAMBLEA NRO. 338	#999002408
2223	TIMANA RUIZ RAUL ALONSO	10428396397	EDIFICIO 19 NRO. S/N DPTO. S-19 C.H. SAN GABINO 3RA. ETAPA (ALT. DE LA	984107448
2224	TINCHO TIJIAS LIDIA	10421519663	PJ. ALTAMIRANO NRO. 109 SECTOR JAEN CERCADO (A 1/2 CDRA CASITA DEL PAN	0
2225	TINEO VALLES SOCORRO ANA	10430550859	JR. UTCUBAMBA NRO. 906	0
2226	TINTA SANCHEZ ROSA MARIA NATHALIE	10421625307	PIEDRITAS NRO. 449 ZARUMILLA (ALT. PUENTE CONTROL)	0
2227	TIPIAN JUAREZ GIOVANA VANESSA	10469039833	JR. PACASMAYO NRO. 853 INT. 861 (ESPALDA DEL HOSPITAL LOAYZA) LIMA - L	0
2228	TITO RAMOS PAOLA MARGOT	10446567573	JR. LOS BELE??OS NRO. 334 URB. SAN SILVESTRE (ALT DE CDRA 4 DE FLORES	0
2229	TOCRE ESPINOZA YESSENIA	10463191901	AV. JOSE CARLOS MARIATEGUI MZA. C LOTE. 20 URB. VILLA MIRAFLORES (COST	0
2230	TOLEDO ROJAS NATALIA MARGARITA	10432108941	MZA. E LOTE. 06 LAS FLORES DE COPACABANA LIMA - LIMA - PUENTE PIEDRA	992423846
2231	TOLEDO ZELAYA ELIZABETH GRACIA	10107408270	AV. PROGRESO NRO. 158 P.J. MALAGA DE PRADO (ALT.KM.8.5 T.AMARU)	983275090
2232	TORREJON CAMACHO ROYCER	10001245215	JR. MARISCAL CASTILLA NRO. 315	0
2233	TORREL PAEZ KARINA MARLENY	10416118766	AV. JOSE DE LAMA NRO. 844 CENT. SULLANA PIURA - SULLANA - SULLANA	0
2234	TORRES ARAGON VICTOR HUGO	10460951041	CAL. VENECIA NRO. 960 URB. LA ACHIRANA SECTOR I	0
2235	TORRES BERNAL RICARDO	10108618499	JR. ICA 3189	565-1046/ 9766-67131
2236	TORRES ESPINOZA DIEGO RICARDO	10709059501	MZA. F LOTE. 2 COO. VIRGEN DEL ROSARIO (ALT. INABIF) LIMA - LIMA - ANC	991096727
2237	TORRES GONZALES MANUEL	10413978284	AV. SANTOS VILLA NRO. 835 (A 1.5 CDRA PASANDO ESCUELA ASCENSION)	943888989
2238	TORRES INGA NILFER ANTONI	10719664950	JR. CELESTINO AVILA GODOY N?? 297	957898756
2239	TORRES PECHO YESENIA LISSETH	10436386244	JR. SAN SALVADOR NRO. 385 URB. VILLA SR DE LOS MILAGROS (ALT.PARQUE 20	0
2240	TORRES PHARMA SAC	20502425367	AV.  EL POLO  196  STGO DE SURCO	2578099
2241	TORRES ROMAN BARBARA JULIA	10456184192	MZA. T LOTE. 17 A.H. MIGUEL GRAU ICA - CHINCHA - PUEBLO NUEVO	0
2242	TOYODA NECIOSUPE JESSICA PAOLA	10107431191	JR. SUCRE NRO. 451 URB. SAN AGUSTIN (ENTRE AV UNIVERSITARIA Y BELAUNDE	0
2243	TRANSP.TURIS Y SERV.GNRLES EL AEREO EIRL	20197116171	CAL. GARCIA NARANJO 1091 (CRUCE CON JR.LUCANAS) LIMA LIMA LA VICTORIA	324-6216
2244	TRANSPORTES FELIPE J HUANCA ALVITEZ EIRL	20298258821	"CALLE ""A"" MZ. X LOTE 2 URB. ALBINO HERRERA 1RA. ETAPA"	4842526/5695150
2245	TRATAMIENTO DE AIRE SAC	20514546267	AV. JOSE GALVEZ N??1741 - LINCE	472-9237
2246	TRAVEL TIME S.A.	20112846477	Av. Javier Prado Este # 5193 Ofic. C10  PLAZA CAMACHO  LAMOLINA	436-0777 / 436-0299 / 436-4420
2247	TRAVEZA??O LEONARDO GABY	10461524309	AV. ANDRES A. CACERES NRO. 228 (COSTADO DEL PARQUE INFNTIL YANACANCHA	
2248	TTITO HUARHUA NOEMI ESTHER	10417246695	JR. GENERAL VELARDE NRO. 457 (ENTRE AV ANGAMOS Y AV PANAMA) LIMA - LIM	4441785
2249	TUPPIA NAVARRO NORKA ELIZABETH	10078751938	CAL. BUENAVENTURA AGUIRRE NRO. 340 DPTO. 502 LIMA - LIMA - BARRANCO	444-4868 / 247-4620
2250	T-VIGILA PERU.COM S.A.C.	20536853660	CAL. LOS MELOCOTONES NRO. 226 URB. NARANJAL	836*2208
2251	UBALDO ALVARADO DIORELY KASANDRA	10769856922	MZA. M1 LOTE. 19 LOS PORTALES DE CHILLON LIMA - LIMA - PUENTE PIEDRA	
2252	UGARTE LAURA KARLA	10412968919	SAN MARTIN NRO. 802 (FRENTE A LA ESCUELA 56025 CASA AMRILLA) CUSCO - C	
2253	UGAZ ROMERO RAQUEL ALEJANDRA	10463404831	AV. MONASTERIO NRO. 599 INT. 302 (PISO 3)	
2254	UNIMED DEL PERU S.A.	20253768119	CAL. LOS LIBERTADORES NRO. 155 (PISO 6 Y 7 ALTURA C.C. CAMINO REAL) LI	6115500
2255	UNIVERSIDAD DE SAN MARTIN DE PORRES	20138149022	CALLE MART??N DULANTO N?? 101 SAN ANTONIO	947455506 / 989207296
2256	URETA CASTELLI REBECA ALBERTINA	10103221507	ALM. DEL CORREGIDOR NRO. 1375 DPTO. 302 URB. LOS SIRIUS	495-4061 / #971703901
2257	URTECHO CASTILLO FRANKLIN JOHAN	10806382839	CAL. ATAHUALPA NRO. 1021 PUEBLO HUAMACHUCO LA LIBERTAD - SANCHEZ CARRI	044-348128 / RPM # 1826560
2258	VALDEZ MARCELO SELENE CELICA	10455984829	AV. LIMA NRO. 3779 (ESPALDAS DE 37 DE AV. PERU)	
2259	VALDEZ PAREJA ELSA FRANCA	10438080681	JR. CIRO ALEGRIA NRO. 940 (COSTADO DE HOSPITAL JESUS NAZARENO) AYACUCH	
2260	VALENZUELA MENESES JOSE RICARDO	10427098732	CAL. MARISCAL CACERES NRO. S/N	
2261	VALERA BUSTOS BIDALITHA AZUCENA	10405778039	PJ. 9 NRO. 114 (ALT LINEA DEL TREN	
2262	VALERIO AYALA JURY JACKELINE	10425229864	CAL. ANCASH NRO. 490 (1 CDRA DEL MATERNO INFANTIL FTE TIENDA) LIMA - H	
2263	VALLADARES SALINAS MILAGROS ELIZABETH	10419458371	SAN RAMAN NRO. 404 (CRUCE CDRA. 6 Y 7 DE PIZARRO) LIMA - LIMA - RIMAC	
2264	VALLADARES VIDAL ELGA STEFANNY	10463605781	AV. LIBERTAD MZA. KA LOTE. 5 ANCASH - CASMA - CASMA	
2265	VALLE GRANDEZ JACKELINE	10434638327	JR. TRIUNFO NRO. 907 AMAZONAS - CHACHAPOYAS - CHACHAPOYAS	
2266	VALLEJOS MILIAN SANTOS MAXIMILA	10436892514	CAL. 23 DE AGOSTO NRO. 120 C.P.M SAN JOSE OBRERO LAMBAYEQUE - CHICLAYO	
2267	VALVERDE VELASQUEZ TANIA LUZMILA	10420070956	MZA. B LOTE. 44 COO. JUAN MANUEL POLAR AREQUIPA - AREQUIPA - JOSE LUIS	
2268	VARA GRA??A CARLOS GIUSSEPPE	10725784797	CAL. FIDEL OLIVAS ESCUDERO NRO. 128 URB. PANDO 1RA ET. LIMA - LIMA - S	
2269	VARAS PRADA LUIS ANGEL	10778186115	JR. MARACAIBO NRO. 1601 URB. PERU (1ER PISO) LIMA - LIMA - SAN MARTIN	963744570
2270	VARGAS CACERES AMILCAR DANTE	10062327711	CAL. ABELARDO GAMARRA NRO. 1557 URB. ELIO III ETP (ALT CDRA 31 DE AV V	945128853
2271	VARGAS CHAVEZ SERGIO ALDO	10700853476	CAL. BLONDELL NRO. 40 (FRENTE AL HOSPITAL HIPOLITO UNANUE)	
2272	VARGAS GRANILLA ANA MARILUZ	10475515019	JR. LOS NOGALES MZA. E LOTE. 9 A.H. SANTA ROSA	
2273	VARGAS HIDALGO CATHERINE JEANNETTE	10451044325	JR. CAHUIDE NRO. SN (COSTADO DE JARDIN VIRGEN DE LA ESTRELLA) APURIMAC	
2274	VARGAS LIVON ROBERTO ROBINSON	10106440528	AV. LOS CEDROS MZA. Y LOTE. 5 COO. UMAMARCA	
2275	VARGAS MONRROY LUZ MARIA	10296085541	CAL. 13 DE ABRIL NRO. 1003 URB. ALTO SELVA ALEGRE (ZONA B) AREQUIPA -	
2276	VASQUEZ BEDON ERIKA MERICIA	10257535636	CAL. ATAHUALPA NRO. 258 INT. 4 (ALT. CDRA.7 AV. SAENZ PENA)	
2277	VASQUEZ CALERO RAQUEL	10454929743	CAL. AMOTAPE NRO. 210 A.H. SANTA TERESITA (FRENTE AL MERCADO) PIURA -	
2278	VASQUEZ FLORES ELIBERTO OSCAR	10106739809	CALLE MARCHAND N?? 158 DPTO. 201	990431059
2279	VASQUEZ GUERRA KARIN JANETH	10453843276	JR. COMANDANTE ESPINAR NRO. 351 (POR LA MARINA)	
2280	VASQUEZ RUIZ SADITH	10431921478	JR. MESON Y MURO S/N	
2281	VEGA SANCHEZ MARIELA DANISSA	10430846979	CAL. AYACUCHO NRO. 280 SECTOR MORRO SOLAR ALTO	
2282	VELA RAMIREZ SARITA ELIZABETH	10420273857	JR. PIURA MZA. 04 LOTE. 02 A.H. NUEVA MAGDALENA	
2283	VELARDE ARCE JOSE CAMILO	10719591804	MZ. L 16 LT. 8 MARISCAL C??CERES	286-3095 / 962549632
2284	VELASCO HUIVIN ELSA JHULIANA	10452837299	CAL. LUIS PASTEUR NRO. 219 URB. DANIEL HOYLE	
2285	VELASQUEZ CHAVEZ MARISOL	10437101006	AV. 9 DE OCTUBRE NRO. 462 CERCADO LAMBAYEQUE - CHICLAYO - SANTA ROSA	
2286	VELASQUEZ LARREA JUAN JOSE ALEX	10402215858	AV. MRCAL O.R.BENAVIDES NRO. 4745 INT. 2 URB. COLONIAL (A 3 CDRAS DEL	4518950
2287	VELASQUEZ OJEDA JENNIFER	10451695407	MZA. A LOTE. 13 A.H. 25 DE DICIEMBRE (ESPALDA COLEGIO GRAN BRETA??A)	
2288	VELASQUEZ SAMANEZ GIAN FRANCO	10774388929	CAL. AMAZONAS MZA. H16 LOTE. 14 A.H. MI PERU	956922452
2289	VELIZ MEZA LUISA MARIA	10209940278	JR. JUNIN NRO. S/N (S72628152 CD5- ESQ SAN MARTIN) JUNIN - SATIPO - SA	
2290	VENTOCILLA MINAYA YESENIA KARLA	10157439885	JR. LA PALMA NRO. 341 (PASAN.AV.SAN MARTIN FTE.TESOR.ATAHUALPA	
2291	VENTOSILLA QUISPE WALTER ESTANISLAO	10067594628	CAL. GRAL VARELA NRO. 1878 INT. 108 (ALT. CDRA 9 AV. BRASIL) LIMA - LI	4781548
2292	VENTURA AMASIFUEN JULIO	10707635652	CAL. A MZA. F LOTE. 02 COO. SAN JUAN DE SALINAS LIMA - LIMA - SAN MART	
2293	VERA MONTALVO ROBERTO CARLOS	10434183869	CAL. HUASCAR NRO. 1493 C.P.M PRIMERO DE MAYO LAMBAYEQUE - CHICLAYO - J	
2294	VERA TUDELA RODRIGUEZ ANA MARIA BETHSABE	10102803235	CAL. ENRIQUE PALACIOS NRO. 1051 DPTO. 701 (ALT DE LA CDRA 10 DE PARDO	
2295	VERASTEGUI MORAN JOE ANTHONY	10482717841	AV. ELIAS AGUIRRE NRO. 615 P.J. I.PACHAC. MARIANO MELGAR	943634850
2296	VERGARA CUEVA KARLA PIERINA	10460287443	JR. SANTA ROSA NRO. 768	
2297	VHL CORPORATION SAC	20426332168	AV. TINGO MARIA 874 (ALT.PUENTE TINGO MARIA CON VENEZUELA) LIMA LIMA L	 :  4255525/4255530
2298	VIBLAN S.L. - SUCURSAL DEL PERU	20554097490	MZA. H LOTE. 27 URB. SANTA ROSITA 2DA ETAPA LIMA - LIMA - ATE	985791832
2299	VICUNA OLIVERA MARISOL ROXANA	10238515110	CALLE PATIVILCA N?? 180	964827578 / 653-9863
2300	VIDEOCORP PERU S.A.C.	20519019834	CAL. JOSE RIVADENEYRA NRO. 1050 URB. SANTA CATALINA (ALT. CDRA 04 NICO	987936227
2301	VIGO MONZON ELSY ROCIO	10267079388	JR. CIRO ALEGRIA NRO. 442 BR SAN SEBASTIAN CAJAMARCA - CAJAMARCA - CAJ	976540065
2302	VILCA CONDORI DE JURADO CRELIA MARLENI	10221830054	AV. LAS AGUILAS NRO. 376 (PISO 3-ALT CDRA 7 DE LA AV RUISE??ORES) LIMA	
2303	VILCA HUAMANI NIDIA MILAGROS	10215740604	CAL. LAS ROSALES NRO. 421 MANZANILLA	
2304	VILCA RODRIGUEZ RICHARD GUSTAVO	10455500830	MZA. F LOTE. 18 A.H. 28 DE JULIO (POR BELLAVISTA) PUNO - PUNO - PUNO	
2305	VILCA SINARAHUA JOSE LUIS	10444730612	AV. OXAPAMPA S/N PUERTO BERMUDEZ	
2306	VILCHEZ HUAMANI EDUARDO GONZALO	10728807640	CAL. LOS CLAVELES NRO. 130 URB. SAN GABRIEL LIMA - LIMA - VILLA MARIA	2837256
2307	VILCHEZ LOPEZ LIZ JACKELINE	10417471699	AV. LOS HEROES NRO. 888 (2 CDRS ANT DEL C.E. 19 D ABRIL S68958581) JUN	
2308	VILLA SEMINARIO MARILYN YESICA	10433415260	MZA. B13 LOTE. 34 A.H. SAN MARTIN PIURA	
2309	VILLANES ESTEBAN JOSE ANTONIO	10179059784	AV. DEFENSORES DEL MORRO NRO. 570 INT. 27 (STAND 27) LIMA - LIMA - CHO	7243938
2310	VILLANUEVA CORDOVA SINDY KELLY	10466316992	CAL. MANCO INCA MZA. C LOTE. 12 (A 3 CDRS DE BOMBEROS)	
2311	VILLANUEVA LAZARO MARISOL TATIANA	10093144771	CAL. JR 27 NRO. 102 DPTO. 404 URB. MARISCAL CASTILLA (AL COSTADO DE LA	3722411
2312	VILLANUEVA RAMIREZ MARIA ESTHEFANY	10479332563	PJ. FRANCISCO BOLOGNESI MZA. 1 LOTE. 14 (ALT. MERCADO A??O NUEVO) LIMA	
2313	VILLEGAS CASTRO ENA MARIA	10336756133	AV. FLORES PRIMAVERA NRO. 1455 URB. LAS FLORES	
2314	VILLEGAS LOAYZA KATERINE CAROL	10464383528	AV. DEL CORREGIDOR NRO. 928 URB. REMANSO DE LA MOLINA 1 ET (ALT DE LA	
2315	VILLEGAS MEDINA MARJORIE NIKITA	10441424791	CAL. SAN AGUSTIN NRO. 322 (AL FRENTE DE LA FABRICA PEDRO P DIAZ) AREQU	
2316	VIRU RODRIGUEZ LAURA JENNIFFER	10446216894	CAL. MANUEL ANTONIO LINO NRO. 170 (ALTURA DEL COLEGIO AGROPECUARIO)	
2317	VIVAR ARIAS SABELY CATHERINE	10704394158	CAL. FLORENCIA NRO. 1491 URB. FIORI 4TA ET LIMA - LIMA - SAN MARTIN DE	987473271
2318	WILCON INTERNACIONAL SOCIEDAD ANONIMA	20550610419	AV. PETIT THOURS NRO. 5356 INT. 2054	01-4334229
2319	WONG MATOS JENNIFER	10704407721	CAL. LAS ORQUIDEAS NRO. 319 (PISO 1-ALT CDRA 19 AV.FAUCETT) PROV. CONS	
2320	YAGUILLO VICA??A NOEMI	10443704782	JR. PEDRO RUIZ GALLO NRO. S/N (A MEDIA CDRA DE LA PLAZA) AYACUCHO - LA	
2321	YANCE CARDENAS MODESTA ISABEL	10452767835	SECTOR YANIZU - PUERTO BERMUDEZ	
2322	YA??EZ ALVARADO ELIZABETH MERY	10440367912	AV. EDUARDO DE HABICH NRO. 610 URB. INGENIERIA	
2323	YA??EZ GARCIA ALEJANDRO FRANCISCO	10238581830	AV. CASCAPARO N?? 130	958-192902
2324	YATACO CHUMBIAUCA ROXANA MARIA	10106472039	AV. PASEO DE LA REPUBLICA NRO. 4886 INT. 402-B	973938705
2325	YATACO HUAMAN DEYSI GIOVANA	10416136021	AV. SUCRE NRO. 1071 DPTO. 304 (ALT DE GRIFO) LIMA - LIMA - PUEBLO LIBR	
2326	YATACO VICENTE GISSELA KATHERINEE	10455980076	CAL. SAN JOSE MZA. W LOTE. 28 URB. SAN AGUSTIN LIMA - CA??ETE - SAN VIC	
2327	YAYA GARCIA CLORINDA ELITA ANDREA	10704368769	JR. 9 DE OCTUBRE NRO. 128	
2328	YAYA PACO RICARDO ANDREE	10730903591	JR. LIMA NRO. 140 P.J. RAUL PORRAS BARRENECHEA (ALTURA KM 18) LIMA - L	985001864
2329	YEREN MORALES IVETTE KATHERINE	10420587126	BLOCK NRO. 1 INT. 203 C.H. MATIAS MANZANILLA (URB. LA MODERNA) ICA - I	237926
2330	YLIQUIN THOMAS JOSE ARTURO	10433237221	JR. MANUEL PEREZ DE TUDELA NRO. 2300 MIRONES BAJO LIMA - LIMA - LIMA	
2331	YNCA SOTO REGINA FABIOLA	10728736467	PJ. ISLAS BALLESTAS MZA. C1 LOTE. 28 A.H. PUERTO NUEVO (ALT. COLEGIO M	
2332	YNGA CASTRO JUDY	10428053317	JR. ANTONIO JOSE DE SUCRE NRO. 326 SECT FONCHILL	
2333	YNGUIL VASQUEZ KAREN PAOLA	10437200250	JR. HUANCAYO NRO. 864 (ALT. CDRA 38 AV PERU)	
2334	YTO COAGUILA JENNY VANESSA	10459840741	CAL. 27 DE JULIO NRO. 112 URB. LOS OLIVOS (A CUATRO CUADRAS DEL COLEGI	
2335	YTURRY FARGE ERIKA VANESSA	10462192393	CAL. PROFESOR JORGE MUELLE NRO. 133 INT. 303 RES. LAS TORRES DE LIMATA	2263547
2336	YUCRA MENDOZA ROSMERY YESSICA	10431056441	JR. ECUADOR NRO. 414 BARRIO UNION LLAVINI (CERCA A LA UNIVERSIDAD) PUN	
2337	YUEN VENTURO JEMIMA CESIA	10420863492	JR. FRANCISCO PIZARRO NRO. 513 A.H. BOLIVAR BAJO (FRENTE A IGLESIA FAR	
2338	ZAFRA REYES JESSICA MARIELA	10401329493	AV. ENRIQUE MEIGGS NRO. 2018 URB. SAN FERNANDO	
2339	ZAPATA CASTRO DE LOSTAUNAU SONIA DEL ROCIO	10077994519	AV. MARISCAL CASTILLA 228 LAS MAGNOLIAS - SURCO	2424824
2340	ZAPATA NAVARRO DIANA DEL PILAR	10461491095	CAL. LEONCIO PRADO NRO. 410 CENT SULLANA PIURA - SULLANA - SULLANA	
2341	ZAPATA VARILLAS BRUNO ARNALDO	10418601375	JR. LOS CIPRECES NRO. 415 URB. LOS SIRIUS 1RA. ETAPA	987341113 / 632-0697
2342	ZARATE FLORES RAFAEL JUAN	10095943417	AV. CANADA NRO. 3357 URB. JAVIER PRADO LIMA - LIMA - SAN LUIS	3461187
2343	ZARRIA LINARES GEISELL SELENE	10074645530	CAL. LOS PENSAMIENTOS NRO. 185 URB. SANTA ISABEL (AV.TUPAC AMARU PARAD	5433897
2344	ZAVALAGA VALENCIA VERONICA	10405580026	PZA. PUNKIRA MZA. H DPTO. 502 C.H. JULIO CESAR TELLO	997488998
2345	ZAVALETA OLIVARES ANGELA JESUS	10329098562	MZA. B9 LOTE. 14 URB. 21 DE ABRIL	944978540
2346	ZEGARRA HUAPAYA HERNAN ERNESTO	10406164816	JR. BONDI NRO. 450 INT. A LIMA - LIMA - PUEBLO LIBRE (MAGDALENA VIEJA)	949475030
2347	ZEGARRA NINA MIRIAM ROSA	10402073492	CAL. SAN ISIDRO -A MZA. T LOTE. 08 SAN FRANCISCO (URB. SAN ISIDRO	
2348	ZELAYA YACTAYO LIZBEHT DENISSE	10700653116	CAL. PROGRESO NRO. 257 DPTO. 2PS (COLEGIO ESTADOS UNIDOS	525-5098
2349	ZE??A ARMAS NOEMI	10032434105	AV. CORICANCHA NRO. 494 3RA ZONA TAHUANTINSUYO	
2350	ZE??A OLANO MILAGRITOS ELIZABETH	10255710147	MZA. 38 LOTE. 21 URB. EL DORAL DE TORRE BLANCA (EL DORAL DE TORRE BLAN	
2351	ZEVALLOS SANTANDER AMPARO VICTORIA	10415005976	MZA. C LOTE. 6 URB. JESUS NAZARENO AREQUIPA - AREQUIPA - SOCABAYA	
2352	ZORRILLA ARAUJO KAREN YESENIA	10455768417	JR. CUZCO NRO. 330 DPTO. 202	
2353	ZULOETA VIGO JOHANNA PAOLA	10443465087	BL. C NRO.   DPTO. 402 C.H. JOSE BALTA (4TO PISO-SUBIENDO A LA IZQ, RE	
2354	ZUNIGA FLORES JUANA ANGELA	10090334056	AV. PUNO NRO. 2596 (FRENTE A LA COMISARIA DE COMAS) LIMA - LIMA - COMA	
2355	 DIAZ MERINO EVELYN	10425732949	MZA. G1 LOTE. 1 INT. PS.2 URB. SAN DIEGO VIPOL	949896461
2356	 MARIN CHAVEZ LIMBERS	10481389505	JR. JOSE BALTA NRO. 395 P.J. EL PROGRESO 1ER SECTOR	962797978
2357	 NAVARRO CHANG RITA YSABEL	10456259168	BL. C NRO. 403 C.HAB. JOSE BALTA (BLOCK C-N 403-43-4P)	0
2358	 PALOMINO BRAVO ANDREA PAULA	10453014067	JR. JOSE MARTIR OLAYA NRO. 643 URB. ZARUMILLA	0
2359	 QUISPE GONZALES LISETE YIZZA	10439062555	MZA. C LOTE. 10 ASOC. AAPITAC (ZONA D)	0
2360	 RIVERA AYALA MARIANO	10106451970	MZA. S LOTE. 8 A.H. FLORES DE VILLA	949822027
2361	 RODRIGUEZ GARCIA CARLA MARIBEL	10416552245	AV. CENTRAL NRO. 175 P.J. EL VOLANTE	962533449
2362	2001 OFFSET INDUSTRY SOCIEDAD COMERCIAL DE RESPONSABILIDAD LIMITADA- 2001 OFFSET INDUSTRY S.R.L.	20393013266	AV. LOS CORALES NRO. 375 URB. BALCONCILLO LIMA - LIMA - LA VICTORIA	2657350
2363	A. JAIME ROJAS REPRESENTACIONES GENERALES S.A.	20102032951	JR. GARCIA Y GARCIA N?? 870	7056500 7056539
2364	ABA SINGER & CIA S.A.C.	20100032881	CALLE MONTE ROSA N?? 240 OFICINA 1002 URB CHACARILLA DEL ESTANQUE	7195874-7195875-4715948
2365	ABANTO SARAVIA CAROL PAOLA	10099074642	AV. ENRIQUE FERMI NRO. 595 URB. FIORI (ALT. CDRA 14 DE ALFREDO MENDIOL	5340457
2366	ABARCA TORRES JHAGAYDA LIDD	10425811318	JR. DANIEL ALCIDES CARRION NRO. 108 URB. REYNOSO	0
2367	ACEVEDO PALIZA VANESSA DEL CARMEN	10467782610	MZA. P LOTE. 14 URB. SAN JOAQUIN IV ETAPA	0
2368	ACOSTA ATOCHE JUBITZA ELIZABETH	10438516455	JR. SANTA ROSA NRO. 126 (FRENTE A IE 094)	10438516455
2369	ACOSTA HOYOS MILUSKA ESTEFANY	10457510816	CAL. 1 MZA. B LOTE. 12 URB. RESD ALAMEDA DEL NORTE (ALT MERCADO 3 REGI	0
2370	ACOSTA NAVARRO ROSA YSABEL	10096940098	BL. 3C NRO. 1203 C.R. SAN FELIPE	0
2371	ACROTA CHOQUEHUANCA MATILDE	10700690879	JR. SAN MARTIN MZA. I LOTE. 13 BARRIO PROGRESO PUNO - AZANGARO - JOSE	0
2372	ADRIANZEN AYALA CRISTHEL LORENA	10452044612	CAL. JUAN FANNING NRO. 291 INT. 41 C.C. LA GRUTA DE CRISTAL (STAND 41)	980240371
2373	ADRIAZOLA IQUE GABRIELLA JOYCELINE	10450159421	BL. E NRO. . DPTO. 42 RES. M. SCORZA	2711604
2374	AGUILAR MATTOS LAURA CRISTINA	10407209562	PJ. 30 AMIGOS LOTE. 24 ??A??A (ALTURA KM 19.5 DE LA CARRETERA CENTRAL)	9922-79536
2375	AGUILAR RAMOS ROXANA MILAGROS	10407448524	JR. ACOMAYO NRO. 251 DPTO. 409	0
2376	AGUILAR ROJAS ROLY PABLO	10414262533	MZA. ?? LOTE. 13 ASOC.VIV.ROSARIO DEL NORT LIMA - LIMA - SAN MARTIN DE	988105278
2377	AGUILAR ROMERO ELIDA CELESTINA	10006829959	CAL. TARAPACA NRO. 802 P.J. VIGIL	0
2378	AGUILAR YZQUIERDO JEFFER EDHITSON	10460892568	JR. PRLG.LOS FRESNOS MZA. Z LOTE. 13 URB. PRADERAS DE LA MOLINA	577-7043
2379	AGUINAGA CHIRINOS CESAR ANTONIO	10101441402	CAL. LOS LAURELES NRO. 240 URB. SALAVERRY LAMBAYEQUE - CHICLAYO - CHIC	0
2380	AGUIRRE CHIRI MARCELO ANDRES	10400302290	BL. EDIFICIO V INGRESO 3 NRO. S/N INT. 10 AGRUPACION PALOMINO (ALT.CDR	564-2174
2381	AIQUE RIVAS OSMAR CELESTINO	10449064696	JR. LIBERTAD MZA. A LOTE. 9 CENT PAUCARBAMBILLA (A 1 CDRA DEL PUENTE S	0
2382	ALANOCA SAGUA LILIA CONCEPCION	10412086614	CAL. 08 DE SETIEMBRE NRO. 1785 P.J. NATIVIDAD (FRENTE A PLAZA MANUEL A	0
2383	ALARCON ALARCON SEBASTIAN	10441912949	JR. MANCO SEGUNDO NRO. 520 DPTO. 301 URB. MARANGA (ESPALDA DE LA CLINI	942913167
2384	ALARCON BAUTISTA MARIA DORIS	10467383987	CAL. LETICIA NRO. 532 URB. CERCADO DE CHICLAYO LAMBAYEQUE - CHICLAYO -	980066838
2385	ALARCON LOPEZ MIRTHA REGINA	10464684153	JR. FEDERICO SANCHEZ NRO. 276	0
2386	ALBERTO CRUCES LINDA FLOR	10468152482	PJ. 9 MZA. B1 LOTE. 10 ASOC AMPL VIV CAUDIVILLA (AL FINAL DE LA AV LA	0
2387	ALBIS S.A.	20418140551	CAL LOS NEGOCIOS 185 URB. JARDIN	411-6300
2388	ALBORNOZ CHAVEZ EMPERATRIZ	10745746123	JR. ANTONIO PLASCENCIA MZA. Q11 LOTE. 19 URB. MRCAL CACERES LIMA - LIM	0
2389	ALCANTARA MIMBELA MIGUEL ANGEL	10450485549	"CALLE GRAU N?? 355 BLOCK ""C"" SPRO. 301 URB. CAMPOD??NICO"	0
2390	ALCANTARA POGGI JANETTE VANESSA	10401537363	CAL. UNO NRO. 131 URB. LAS MAGNOLIAS (CERCA AL CORTIJO)	445-1661
2391	ALFARO SALAZAR ALEX JULIO	10483255051	CAL. 4 MZA. I1-5 LOTE. 6 A.H. CORAZON DE MARIA A (A 3 CDRAS. MERCADO S	267-4224
2392	ALIAGA ALEJO JOSE	10065916440	CAL. CADIZ MZA. E LOTE. 17 URB. LA CAPILLA (ALT. FACULTA DE MEDICINA D	950921308
2393	ALIAGA QUISPE PATRICIA GASDALY	10442589742	JR. DEUSTUA NRO. 616 URB. LA PAMPILLA (FRENTE AL CENTRO DE SALUD DE LA	0
2394	ALLACARIMA ALLCCARIMA ANGUELINE WENDY	10706929628	MZA. P LOTE. 19 A.H. LOS OLIVOS DE PRO LIMA - LIMA - LOS OLIVOS	978738555
2395	ALLCCARIMA MARTINEZ FLOR MARGARITA	10106894201	CAL. 122 MZA. P LOTE. 19 A.H. LOS OLIVOS DE PRO	980813328
2396	ALLPANCCA PALOMINO DAVID	10457554503	AV. HUANTA MZA. X LOTE. 35	0
2397	ALTAMIRANO CABEZAS ERIKA MARGARITA	10439585086	JR. TACNA NRO. 232 AYACUCHO - HUAMANGA - SAN JUAN BAUTISTA	
2398	ALTAMIRANO QUINTANA ALICIA	10423383092	AV. JOSE MARIA ARGUEDAS N?? 603	944076445
2399	ALVARADO ALVARADO DEBORA DEL CARMEN	10054033724	AV. NAVARRO CAUPER NRO. 328 (ENTRE PEVAS Y CAUPER)	0
2400	ALVARADO AZURIN CARLA LORENA	10443303826	CAL. REPUBLICA DE PORTUGAL NRO. 247 INT. B URB. CHACRA COLORADA (ALT H	959363345
2401	ALVARADO PRINCIPE EUDOMILIA	10410413715	MZA. G5 LOTE. 7 URB. LAS GARDENIAS	955338259
2402	ALVAREZ ALVAREZ EDITH ADELA	10106662814	CAL. GRANDE MZA. I6 LOTE. 24 A.H. JOSE C. MARIATEGUI (CONCHA ACUSTICA	0
2403	ALVAREZ A??ACATA TRINIDAD INGRID	10296259492	TORRE 6 NRO. ---- DPTO. 502 VILLA MEDICA (POR LA UAP) AREQUIPA - AREQU	0
2404	ALVAREZ RAMOS CARMELA PIEDAD	10091574433	CALLE MARCELINO GONZALES N?? 250 URB. SANTA CATALINA	999006144/224-8935
2405	ALVAREZ SURITA MARIA ESTHER	10450959460	CAL. HUAMANTANGA NRO. 1001 CENTRO JAEN CAJAMARCA - JAEN - JAEN	0
2406	ALVAREZ YANA YOLANDA	10422644500	JR. AYAVIRI NRO. 236 PUNO - SAN ROMAN - JULIACA	0
2407	ALZA ZEVALLOS ANGELICA VICTORIA	10704112985	MZA. C LOTE. 23 A.V. ALEGRIA DE CARABAYLLO LIMA - LIMA - CARABAYLLO	941736069
2408	ALZAMORA LALUPU FIORELLA ROSA AMALIA	10413576445	JR. TRUJILLO NRO. 449 PIURA - PIURA - CATACAOS	0
2409	AMERICA MOVIL PERU S.A.C	20467534026	AV. Nicol??s de Arriola N?? 480, Piso 8, Urbanizaci??n Santa Catalina	613-1000
2410	AMESQUITA MENDIGURI ELIAN ELIETTE	10430214875	MZA. D LOTE. 4 URB. VILLA LAS CASUARINAS AREQUIPA - AREQUIPA - JOSE LU	0
2411	AMPUDIA LOZANO LILY MARLEY	10053910985	AV. QUI??ONEZ KM. 4.5 (HOSTAL MAYROS)	0
2412	ANCHARI OBLITAS YULIZA FRANCESCA	10704132978	CAL. SIMON BOLIVAR MZA. CC LOTE. 20B URB. ZARZUELA ALTA (COMITE 2 JUNT	0
2413	ANCHILLO TIMOTEO LIZ GENINA	10715625127	CAL. LOS NARANJOS MZA. B LOTE. 12 (CERCA A LA COOPERATIVA ANDACOCHA	0
2414	ANCRO S.R.L.	20431084172	AV. LOS CIPRESES NRO. 250 URB. LOS FICUS (PTE.SAT.ANITA,EVITAMIENTO.MZ	3624409
2415	ANDIA SANCHEZ PAULINA VERONICA	10403752296	AV. ICA NRO. 559 LIMA - LIMA - LIMA	0
2416	ANDRES HILARIO ROCIO	10422981034	JR. LOS ANDES NRO. C3 INT. 28 P.J. SAN LUIS (MZ C3 LT 28	0
2417	ANGULO RENGIFO DELTON JESUS	10400132408	JR. LIBERTAD MZA. 75 LOTE. 02 (FRENTE AL MUNICIPIO)	0
2418	APAESTEGUI PAREDES CESAR AUGUSTO	10072123455	CAL. COLOMA NRO. 130 LIMA - LIMA - PUEBLO LIBRE (MAGDALENA VIEJA	0
2419	APAICO HASQUIERI JENNY MARISOL	10705674740	JR. LORETO 1274 MZA. C LOTE. 3A A.H. RUGGIA PROV. CONST. DEL CALLAO -	955403656
2420	APAZA COYLA YANET YOVANA	10428961566	AV. GUARDIA CIVIL SUR MZA. B LOTE. 38 URB. VI??AS DE SAN ANTONIO	0
2421	APAZA MEDINA ANGHI GLENI	10024180013	JR. MARIANO NU??EZ NRO. 1030 URB. LAS MERCEDES (A MEDIA CUADRA DEL PARA	0
2422	APONTE BERDEJO BETSY BERENICE	10406200642	PZA. BLOCK 53 NRO. S/N DPTO. B U.V. MIRONES (ESPALDA FAB. D'ONOFRIO	4254074
2423	AQUINO CONDOR AURELIO RAFAEL	10409842343	JR. LAS PALMERAS MZA. E LOTE. 13 APV. AGRICULTURA (ESPALDA DE LA UNDAC	0
2424	AQUINO CRUZADO SOCORRO DEL PILAR	10267227191	AV. INDEPENDENCIA NRO. 576 BR LA FLORIDA CAJAMARCA - CAJAMARCA - CAJAM	0
2425	ARAGON BASURCO CARMEN LIS	10428664626	NRO. E-1 DPTO. 104 ASOC. AMAUTA (CERCA AL ICPNA)	0
2426	ARAUJO DIAZ CELIA DAYANA	10454939218	JR. LA HISTORIA NRO. 291 BR MOLLEPAMPA	0
2427	ARAUJO QUIROZ ANDRES AVELINO	10714281181	PROL 20 DE DICIEMBRE NRO. 138	974673794
2428	ARAUJO QUIROZ CYNTHIA MARGARITA	10466841337	PROLONG. 20 DE DICIEMBRE NRO. 138 (PAYET. ALT ULTIMO PARAD DE LA LINEA	985316657
2429	ARELLANO BARDALES JUAN PABLO	10702707329	JR. TOMAS CATARI NRO. 813 URB. EL TREBOL LIMA - LIMA - LOS OLIVOS	6557693
2430	ARELLANO BARRETO JAIME JULIO	10074773066	JR. CRESPO Y CASTILLO NRO. 2674 P.J. MIRONES BAJO	961725562
2431	ARELLANO TORRES PAMELA KAREN	10430060096	AV. PARDO NRO. 328 CENT CERCADO ANCASH - SANTA - CHIMBOTE	0
2432	AREVALO RUIZ JENNIFER	10457470229	CAL. LOS CEDROS MZA. M LOTE. 15 A.H. LAS PALMAS	0
2433	ARIAS APARICIO ROSSMELI	10239980894	AV. ARCOPATA NRO. 339 (A LA VUELTA DE LA CALLE MELOC) CUSCO - CUSCO -	0
2434	ARIES COMERCIAL S.A.C	20101420591	AV. ELMER FAUCETT N?? 1814	464-5620 / 561-0710
2435	ARIZA BRAVO RUSBEL	10436232620	MZA. D LOTE. 14 LOS JAZMINES DEL NARANJAL	992-334301
2436	ARONES CAHUA YAQUELYN LISBETH	10445516690	MZA. I LOTE. 12 PACHACUTEC (CALLE R. CASTILLA ESPALDAS DEL COLEGIO	0
2437	ARRESE ALARCON KIARA ROSANELLY	10714676097	BL. 3 NRO. . DPTO. 40 URB. PALOMINO (ENTRADA 1	0
2438	ARRIETA JERI MARIA YSABEL	10419948395	PJ. LOS ANDES NRO. 264 (AL COSTADO DE INSTITUTO SAN PEDRO) JUNIN - HUA	0
2439	ARROSPIDE MEDINA MARIO ALFREDO	10082052068	CAL. CHARDIN NRO. 176 URB. SAN BORJA (ALT.36 AV.JAVIER PRADO ESTE)	4342816 / 995144788
2440	ARROYO RUIZ JULIO CESAR	10106895088	NRO. A INT. 3 URB. JOSE CARLOS MARIATEGUI (FRENTE DE EDELNOR) LIMA - L	0
2441	ARTEAGA PORRAS PAOLA LUZ	10705051467	JR. PABLO BERMUDEZ NRO. 115 (71362206-A 50 MT. DEL MERCADO DE FRUTAS)	971100099
2442	ARTEAGA TORRES ELIZABETH PAMELA	10418737242	CAL. LIBERTAD NRO. 107 (ALT DEL GRIFO MANILSA	0
2443	AS7 IMMOBILIEN CONSULTORES Y CONTRATISTAS S.A.C.	20552303076	JR. LAS MANDARINAS MZ. C LT. 17 URB. RESIDENCIAL MONTERRICO	436-1262
2444	ASCOY EGUILAS MILAGROS MERCEDES	10408948806	AV. ENRIQUE MEIGGS MZA. A2 LOTE. 20 URB. EL TRAPECIO III ETAPA (COSTAD	0
2445	ASENCIOS GUERRA VALERY VERONICA	10757171070	MZA. 45 LOTE. 11 HORTENCIAS (ALT. COLEGIO BELEN GRANDE) PROV. CONST. D	971910486
2446	ASHCALLA PACHECO MIGUEL ARTURO	10726861230	JR. POMABAMBA NRO. 432 INT. 203 (METRO DE ALFONSO UGARTE) LIMA - LIMA	983751790
2447	ASOCIACION GUARANGO CINE Y VIDEO	20251826774	JR. CAYETANO HEREDIA 785 - INT. 2 - JESUS MARIA	4601135
2448	ASTO VILCAS ALICIA CELINA	10404207283	AV. PER?? S/N PAMPA DEL CARMEN	964447638
2449	ASTOCONDOR ZU??IGA MIRIAM	10408682334	CAL. SACSAYHUAMAN NRO. 184 COO. 27 DE ABRIL (POR EL OVALO SANTA ANITA	0
2450	ASTORAYME VALENZUELA LADY LAURA	10448676990	AV. OSCAR R. BENAVIDES NRO. 599 (ESQUINA DE PLAZA DE ARMAS PUEBLO NUEV	0
2451	ATAO AYMA RUTH DINA	10425616809	MZA. D LOTE. 13 APV.SAN BENITO (SANTA ANA) CUSCO - CUSCO - CUSCO	0
2452	ATO AUDIOVISUALES TRADUCCION SIMULTANEA S.A.C	20513992425	AV. ARNALDO MARQUEZ NRO. 1683	261-2326
2453	AVELLANEDA GUERRERO REINERITA	10471368682	CALLE LAS GUINDAS N?? 108 PJ EL ERMITA??O	662-0537
2454	AYALA ASTUYAURI NILA	10103571036	MZA. Q.1 LOTE. 9 P.J. SN HILARION	0
2455	AYALA PLASENCIA ALAN JOEL	10406798840	CAL. FRANCISCA SANCHEZ PAGADOR NRO. 177 (CRUCE DE CUEVA CON AV. LA MAR	6478062
2456	AYALA ROMANI JUAN JOSE	10410780092	JR. JOSE PEZO MZA. 65 LOTE. 8B (ENTRADA A NUEVA REQUENA.)	0
2457	AYASTA CAPU??AY SARA DEISY	10432226528	CAL. SIMON BOLIVAR NRO. 303 CERCADO LAMBAYEQUE - CHICLAYO - MONSEFU	
2458	B. BRAUN MEDICAL PERU S.A.	20377339461	AV. SEPARADORA INDUSTRIAL 887 URB. MIGUEL GRAU	326-1825 / 326-6070
2459	BACA RODRIGUEZ ANA DEL PILAR	10456962896	JR. MADRE DE DIOS NRO. 442 SECTOR 08 (JR. MADRE DE DIOS 447)	0
2460	BAIGORRIA NOBLEGA SHIRLEY SOFIA	10424764898	AV. CHILE NRO. 310 URB. LAS AMERICAS (INTERIOR HOSPEFAJE) APURIMAC - A	0
2461	BALDARRAGO ARELA RIGOBERTO	10450550669	JR. ECUADOR NRO. 414 BR. UNION LLAVINI (A 2 CDRAS DE LA UNA PUNO	0
2462	BALDARRAGO FLORES EDERLYN GUISELLA	10402825613	AV. SAN FELIPE N?? 620 DPTO. 1401 - JESUS MARIA	980900649
2463	BALTA ALVA MANUEL GERARDO	10411598107	CAL. LAS BEGONIAS NRO. 230	0
2464	BALUARTE RONCEROS ARACELI CRISTINA	10425852936	JR. PUMACAHUA NRO. 1561 INT. C (2DO PISO/COSTADO DE LA MUNICIPALIDAD)	0
2465	BARDALES PE??A TANIA PATRICIA	10446423512	CAL. NAUTA NRO. 288 LORETO - MAYNAS - IQUITOS	0
2466	BARREROS CASTRO GUISELA	10400320948	CAL. MARTINEZ DE PINILLOS NRO. 123 URB. CAP J. QUI??ONES	999518959
2467	BARRETO VILLENA VIRGINIA YESSICA	10413989154	JR. MIGUEL DE ECHENIQUE NRO. 289 DPTO. 202 (ALT DEL MALECON) LIMA - LI	975398013
2468	BARRIOS CARPIO SILVIA LUZ	10440805651	JR. PIEROLA NRO. REF. (1115-A /A MEDIA CUADRA DE AV. MAESTRO) PUNO - S	0
2469	BARRIOS CRUZ NADIEHSKA SARA	10424536887	JR- R??MAC N?? 969	574-6040 / 990461167
2470	BASUALDO NAJERA KARLA DANA	10434832891	MZA. G LOTE. 9C ASOC.VIV.HIJOS APURIMAC (KM 10.5 DE LA CARRETERA CENTR	356-4368 / 956387520
2471	BAUTISTA SAIRITUPAC ESTHER JUANA	10402463703	PJ. MARISCAL SUCRE NRO. REF SECTOR LAS ALMENDRAS (FRENTE TALLER DE SOL	0
2472	BAZAN MONJA NARDA GISELA	10458199715	CAL. CANEPA NRO. 436 URB. LA PRIMAVERA (A ESPALDAS DEL MAESTRO HOME CE	0
2473	BECERRA SALAZAR CINTHYA LIZETH	10440517183	JR. BAMBAMARCA NRO. 388 BR LA MERCED	0
2474	BELLEZA FLORES VALERIA AIDA	10740883858	JR CHINCHAYSUYO 213 URB. MARANGA SAN MIGUEL	0
2475	BELTRAN PEREZ GUADALUPE	10024333481	JR. PIEROLA NRO. SN BR. TUPAC AMARU (A 2 CDRS DE LA COMISARIA) PUNO -	0
2476	BENAVIDES CASTILLO JUAN CARLOS	10003734981	MZ C NRO. 10 URB. LAS GARDENIAS	0
2477	BENITES SANCHEZ KELLY RITA	10416109503	PJ. B NRO. 136 INT. 2PSO URB. 28 D (ALT CDRA 10 AV MARIANO CORNEJO)	0
2478	BENITO TORRES SHARON GABRIELA	10701831727	HUANUCO NRO. 2723 URB. 3 MARIAS DE LA POLVORA (ALT DE LA CDRA 14 DE AV	0
2479	BERAUN CRUZ ELIAS LUIS	10453467215	BL. TOMAYQUICHUA MZA. F LOTE. 27 P.J. TOMAYQUICHUA	0
2480	BERNABEL RODRIGUEZ KAREM YESENIA	10708271069	BL. R NRO. 4 INT. 004 URB. PALOMARES (CRUCE CON AV. ALCAZAR)	0
2481	BERNAL GALLEGOS MARGOT	10250055973	NRO. S/N INT. S/N APV CRUZ VERDE QQUEHUAPAY	0
2482	BERNAOLA BELLO HENRY JOSE	10716058366	MZA. H LOTE. 201 C.H. JOSE DE TORRE UGARTE- (2DO PISO-2DA ETAPA-COST.M	0
2483	BERNARDO ARELLANO DIEGO JESUS	10476704974	JR. ISAAC NEWTON NRO. 2150 URB. EL TREBOL I ETAPA	9750-24333
2484	BERROCAL MORALES EMERSON DAVID	10062973744	CAL. ACACIAS MZA. J4 LOTE. 32 URB. SAN ISIDRO (A MEDIA CDRA DE MERCADO	2242624
2485	BERROCAL MORENO DE KAHN SARITA DEL PILAR	10105453162	JR. JOAQUIN BERNAL NRO. 486 (CDR.22 DE ARENALES.)	0
2486	BIOTOSCANA FARMA S.A. SUCURSAL PERU	20431224870	CALLE AMADOR MERINO REYNA 285 OF 902	4225500
2487	BLAS HUANCAS DIRLEY JULIA	10106323661	CALLE TIAHUANACO MZ. D1 LT. 1 PORTADA DEL SOL	0
2488	BLAS TRUJILLO ANGIE BRISETH	10770785257	PJ. SIN NOMBRE MZA. X LOTE. 34A BARR. LETICIA (ALT. DE ACHO	0
2489	BLITCHTEIN WINICKI DE LEVY DORA	15428386083	CAL. LOS NOGALES 765 402 (4TO.PISO)	422-9826
2490	BOHORQUEZ BARBA FIORELLA LUISA	10441765733	MZA. 18 LOTE. 18 A.H. VILLA CRISTO REY (ESPALDAS DEL COLEGIO CRISTO RE	0
2491	BOLIVAR HERRADA LUCIA MARGARITA	10038544867	JR. FRANCISCO IBA??EZ NRO. 132 BARRIO BELLAVISTA	0
2492	BONILLA CISNEROS DARWIN JOEL	10455942204	JR. D DE AG??ERO NRO. 311 DPTO. D LIMA - LIMA - SAN MIGUEL	694339284
2493	BORDA LOPEZ ERICK MAXIMO	10411916117	JR. AMERICO ORE NRO. 161	9668-05728
2494	BORGO??O ESPINOZA DAVID SIXTILO	10443884101	JR MARKHAN CLEMENT 337 403 LIMA	0
2495	BORJA PUCUHUARANGA EDITH NATALI	10436871622	MZA. L LOTE. 34 URB. LOS PORTALES	0
2496	BRAVO BARSALLO SIRIA FLORENCIA	10450316968	CAL. TARAPACA NRO. 130 CPM LAS MERCEDES LAMBAYEQUE - CHICLAYO - JOSE L	
2497	BRAVO SANCHEZ YOBANA MARILUZ	10432746629	JR. MANUEL UBALDE NRO. 126 (ESPALDAS DEL ESTADIO SEGUNDO ARANDA) LIMA	0
2498	BUENDIA CERRON CARLOS ALBERTO	10096157105	Calle Pierre Constant 320 Urb. Palao	4618715 / 945077614
2499	BUENO TEJADA GEOBANA ELIZABETH	10295022812	CAL. FRANCISCO BOLOGNESI NRO. 301 URB. BELLA PAMPA AREQUIPA - AREQUIPA	0
2500	BUJAICO HINOSTROZA ELIZABETH DIANA	10412861073	GUZMAN Y BARRON NRO. 2642 ELIO	0
2501	BURGA BOCANGEL ELSIE ROXANA	10094637401	AV. LOS PATRIOTAS NRO. 389 DPTO. 402 URB. MA	578-6686
2502	BURGOS COBE??AS ANITA MAGDALENA	10459193559	CAL. SAN MARTIN NRO. 1055 (A CUATRO CASAS DE ICPNA) PIURA - SULLANA -	0
2503	BUSINESS TECHNOLOGY SOCIEDAD ANONIMA	20521302390	AV. PASEO DE LA REPUBLICA NRO. 3127 DPTO. 501 RES. CORPAC	6160505
2504	BUSTAMANTE ESTELA EDER ROLANDO	10437951557	CAL. SAN ISIDRO NRO. 327 CERCADO (POR EL COLEGIO SALAVERRY) LAMBAYEQUE	966975829
2505	BUTRON GUEVARA CESAR DANIEL	10400380568	MZA. S LOTE. 06 URB. IGNACIO MERINO 2 ETAPA	0
2506	C.M.V. SERVICIO EJECUTIVO S.A	20291772286	AV. PAZ SOLDAN NRO. 170 INT. 701 (PISO 7) LIMA - LIMA - SAN ISIDRO	2190266
2507	CABALLERO GUTIERREZ ANGELA CAROL	10410499504	AV. JOSE LOPEZ PAZOS NRO. 1215 URB. REYNOSO (ALT.COMISARIA CARMEN DE L	4523720
2508	CABALLERO HERRERA ANNGIE ELISA	10401330645	BL. 4 NRO. _ DPTO. 101 C.H. ANGAMOS (PASEO DE LA REP.4886, EDIFICIO D)	659-4763
2509	CABRERA LLIUYAC NYRA MARGOTT	10097658116	AV. LIMA SUR NRO. 362 CHOSICA (STAND 02)	0
2510	CABRERA VIZCARRA CESAR AUGUSTO	10078612440	CAL. COPENHAGUE NRO. 103 URB. PORTALESDEJAVIERPRADO (ENTRADA RUINAS DE	0
2511	CABRERA YUPTON GLADYS MARIBELL	10409157535	JR. PABLO DE OLAVIDE N?? 548 URB. HUAQUILLAY	979017190
2512	CACERES NU??EZ OSCAR DANIEL	10096671968	AV. LURIGANCHO N?? 1121 URB. HORIZONTE DE ZARATE	3873617
2513	CACERES TINTAYA NESTOR	10421111958	JR. SANTA BARBARA NRO. 690 (A 2 CUADRAS DEL PODER JUDICIAL) PUNO - YUN	0
2514	CAJAS NAUPAY MIRIAHM	10404798397	JR. DON BOSCO NRO. 459 DPTO. 201	994705827
2515	CAJO GONZALES MARIA SOCORRO	10465389201	MZA. C LOTE. 01 C.H. BATANGRANDE LAMBAYEQUE - FERRE??AFE - FERRE??AFE	0
2516	CALDERON DELGADO CESAR GIANINO SHALON	10436657167	JR. KANTU MZA. I LOTE. 3 CUSCO - CANCHIS - SICUANI	0
2517	CALDERON TAVARA CARLOS GABRIEL	10434647458	AV. MARISCAL CASTILLA NRO. 529 (A MEDIA CUADRA DEL MERCADO MODELO) TUM	0
2518	CALERI PIZARRAS S.A.C.	20557492055	MZA. B LOTE. 22 COO. SAN JUAN DE SALINAS	0
2519	CALERO MIRANDA DORIS NILDA	10040637538	JR. C??SAR VALLEJO NRO. 207 URB. SAN JUAN	947482383
2520	CALIXTO VEGA NOELIA	10408357808	AV. TUPAC AMARU MZA. A2 LOTE. 8 (A 2CDRS DEL PARQUE SAN ANTONIO) LIMA	0
2521	CALLAN CONTRERAS CYNTHIA FELICITA	10701417670	AV. LOMAS DE CARABAYLLO MZA. B LOTE. 06 ASOC.PEC. VALLE SAGRADO	954481067
2522	CALLE SULCA ERICK ANTHONY	10762045881	PJ. EMANCIPACION MZA. Q2 LOTE. 05 A.H. MRCAL CASTILLA LIMA - LIMA - RI	3813669
2523	CALLIRGOS FLORES YECENIA CECILIA	10707908764	AV. MESONES MURO NRO. 121 SECTOR MORRO SOLAR CAJAMARCA - JAEN - JAEN	0
2524	CALUA FLORES JUAN CHRISTIAN	10437156854	PRLONG. PETATEROS NRO. 2246 SANTA ELENA ALTA CAJAMARCA - CAJAMARCA - C	0
2525	CAMAC TORIBIO JENNYFER KATHLEEN	10450954255	PJ. 15 DE AGOSTO NRO. 739 A.H. LA CANTUTA (A 1/2 CDRA DEL PARQUE BOLOG	0
2526	CAMARGO AGUILAR YOVANA HILDA	10413351036	MZA. A LOTE. 3 A.H. S. HERRERA (EN HOSPEDAJE MIRAFLORES 1 CDRA DE TERM	0
2527	CAMPOMANES TORRES SAUL EBER	10440525348	CAL. 12 DE FEBRERO MZA. N5 LOTE. 18 A.H. HEROE GUERRA DEL PACIFICO (EL	5295025
2528	CAMPOS BALLARTA CESAR JUNIOR	10424122934	FRANCISO SOLANO N?? 535  - PICHANAKI	0
2529	CAMPOS GARCIA PATRICIA ISABEL	10414339544	MZA. I LOTE. 03 URB. SAN JOAQUIN (IV ETAPA)	0
2530	CAMPOS SANCHEZ MIGUEL ANGEL	10061144001	JR. HAWAI NRO. 141 INT. A URB. SOL DE LA MOLINA 3 ETAPA LIMA - LIMA -	4791161
2531	CANO MENDOZA RUBEN ALONSO	10107361982	PQ. GRAU NRO. 75 DPTO. 202 (ALT CDRA 7 AV COLOMBIA	478-1548
2532	CAPCHA HUAMANI MERY LUZ	10413007548	CAL. FAUSTINO SILVA NRO. 480 URB. POP.CIUDAD DE DIOS	0
2533	CARCAHUSTO PUMA BERTHA NORMA	10015440339	JR. LEONCIO PRADO NRO. 889 BR. SAN MARTIN (AL COSTADO DEL COLEGIO VILL	0
2534	CARCAMO QUISPE EDUARDO ENRIQUE	10409860856	JR. VENUS NRO. 1058 URB. LA LUZ (ALT CRUCE AV BERTELLO CON 28 DE JULIO	998597052
2535	CARDENAS CUSIPUMA ADELMA	10443844061	JR. SAN MARTIN NRO. 250 (ENTRE JR MIGUEL GRAU Y FCO BOLOGNESI) JUNIN -	0
2536	CARDENAS SALINAS DE ESCALANTE NORMA BEATRIZ	10069089904	JR. 21 DE SETIEMBRE NRO. 616 P.J. LA LIBERTAD	0
2537	CARDENAS SEDANO LUZ NOHELY	10447048260	CAL. PASEO DE LA LIBERTAD NRO. 353	99194-5040
2538	CARDENAS SOTO YADIRA GERALDINE	10442555406	MZA. Q LOTE. 37 URB. COOPIP (ALT. DE BOCANEGRA)	0
2539	CARDENAS TAIPE ROSITA BLANCA	10406376589	JR. FRANCISCO IRAZOLA NRO. 353 (ALTURA PQUE PRINCIPAL) JUNIN - SATIPO	0
2540	CARDENAS VALVERDE SUSAN FABIOLA	10448896680	AV. PACHECO NRO. 1730 BARR. HUANUQUILLO ALTO (S.71191539A 1 CDRA LOCAL	0
2541	CARHUAS TINTAYA ROXANA CECILIA	10406630701	CAL. GRL JUAN VELASCO ALVARADO NRO. 335 P.J. HUASCAR (PTE ATARJEA)	0
2542	CARPIO GUTIERREZ VICENTE MANUEL	10432232633	MZA. F LOTE. 13 URB. MNO. BUSTAMANTE (A 1 CDRA DE ESCUELA MARIANO BUST	0
2543	CARPIO VASQUEZ GREYCI TATIANA	10459143969	CAL. MARISCAL LUZURIAGA NRO. 179 DPTO. 101 (ALT CDRA 12 DE GARZON) LIM	959203033
2544	CARPIO ZU??IGA CINTYA MASSIEL	10421029682	JR. CUZCO NRO. 411 P.J. BUENOS AIRES AREQUIPA - AREQUIPA - CAYMA	0
2545	CARRANZA ALEGRE LUZ VANESSA	10454515809	MZA. C LOTE. 19 A.H. RAMIRO PRIALE (POR EL COLEGIO NAZARENO)	978393743
2546	CARRANZA CORONEL NEYDI	10601583424	JOS?? CARLOS MARI??TEGUI N?? 281 NUEVA CAJAMARCA	0
2547	CARRASCO REYNA LUCIA ELIZABETH	10433822124	AV. ENRIQUE MEIGGS NRO. 631 P.J. MIRAMAR BAJO	0
2548	CARRILLO CUMPA VIOLETA LISSET	10449133477	AV. MARISCAL NIETO NRO. 245 CENTRO LAMBAYEQUE - CHICLAYO - CHICLAYO	
2549	CARRION ALCALDE ARLENE MELISA	10462095321	PJ. STA CLARITA NRO. 137 URB. SAN GREGORIO (ALT MDO SAN GREGORIO) LIMA	0
2550	CARRIZALES FLORINDEZ JOSE LUIS	10400698525	S. BONDY 115 EDF 20 TD 1 NRO. . DPTO. 206 (AL FRENTE INDECOPI)	9595-76781
2551	CASANOVA LEDO HILDA	10438991455	AV. FRANCISCA ZUBIAGA NRO. 417 (CERCA A LA OFICINA DE ELECTRO SUR ESTE	0
2552	CASAS LEVANO MARY LUISA	10434475126	CAL. LOS RUISE??ORES NRO. 676 URB. SANTA ANITA	987143277
2553	CASTA??EDA ALVARADO ROCIO ANGELICA	10097826621	AV. JOSE DE LA RIVA AGUERO NRO. 1824 URB. CORPORACION EL AGUSTINO LIMA	7332978
2554	CASTELO ZEVALLOS LILIANA ROCIO	10417127424	PJ. EX FUNDO MARQUEZ MZA. 72 LOTE. 22 PROV. CONST. DEL CALLAO - PROV.	0
2555	CASTILLO DE LA VEGA KATHERYNE BELEN	10449652351	SANCHEZ CERRO NRO. 413 PROGRESO (ALT COMISARIA EL PROGRESO CARABAYLLO	0
2556	CASTILLO DOZA DORIXA GRIZZELY	10158640622	JR. PROGRESO NRO. S/N SAN FRANCISCO (A 3 CASAS DEL COLEGIO AURORA	0
2557	CASTILLO SOTO PEDRO FELIX	10164008652	CALLE LAS LILAS N?? 128-132, DPTO. 306 / ED. G.VELARDE X	99856-7785
2558	CASTRO AZCARATE NORMA ELIANA	10422715318	MZA. B LOTE. 6 URB. MARIA AUXILIADORA (COSTADO DE COLEGIO MARIA DE NAZ	0
2559	CASTRO LUNA ANTONIO FLORENTINO	10093738514	PR JAVIER PRADO NRO. 9215 URB. PORTALES DE JAVIER PRADO (PORTALES DE J	428-5888
2560	CASTRO MEZA DE HORNA MELISSA ROSALVA	10107245869	AV. NICOLAS DE ARANIBAR NRO. 863 URB. SANTA BEATRIZ (3ER PISO)	666-2717
2561	CASTRO VALVERDE CINDY MILAGROS	10455269658	MZA. D LOTE. 23 URB. ANDRES RAZURI LA LIBERTAD - TRUJILLO - TRUJILLO	0
2562	CAVERO FLORES CLAUDIA YOLANDA	10450380216	JR. CAPULIES NRO. 201 URB. RECAUDADORES (ALT. CDRA 6 DE PARACAS)	436-4076
2563	CAVIEDES MAYORGA CATHERINE NIEVES	10467840946	JR. RICARDO PALMA NRO. 608 INT. 610 QUILLABAMBA (FRENTE AL GRIFO EL PI	0
2564	CAYCHO VALENCIA FELIX ALBERTO	10159925671	AV. EDUARDO DE HABICH 594 201 URB. INGENIERIA	483-0493 / 377-2263
2565	CAYTANO ROMAN LUZ ESPERANZA	10432232757	URB. HOYOS RUBIO Z-22 A.S.A	959077156
2566	CCACCA MAMANI ISABEL NOEMI	10097909038	CAL. K MZA. U' LOTE. 8 ASOC. VICTOR R H DE LA T	942445128
2567	CCAHUANA QUISPE ELIZABETH LIDIA	10425536791	PJ. VICTOR SANTANDER NRO. 157 (PARALELA FINAL AV. REAL.) CUSCO - CANCH	0
2568	CCASA CHINO INES LUCIA	10292007502	MZA. A LOTE. 2 A.H. JUAN VELASCO ALVARADO (A 3 CDRAS DEL COL. MILITAR	0
2569	CCOICCA ALMIDON FLOR	10438815525	CAL. 59 MZA. 132 LOTE. 28 A.H. ENRIQUE MILLA OCHOA	0
2570	CELIS SAAVEDRA MELISA	10444625797	PERU NRO. 522 HUAQUILLAY (ALT. DEL PARADERO CALLE OCHO)	0
2571	CENTURION Y AG??ERO CARLOS ALFREDO	10178524882	CAL. RICARDO ANGULO NRO. 545 DPTO. 101	0
2572	CERDA JALLO SONIA ESTEFANY	10710440307	MZA. A LOTE. 4 SEC. BELLA VISTA I (LA NUEVA RINCONADA PAMPLONA ALTA) L	9910-75257
2573	CERNA MACHACA JENNY ANDREA	10439864465	MZA. 12 LOTE. 1 S ANTONIO PEDREGAL (CHOSICA	0
2574	CERNA MENDOZA GALIA CAROL	10453153351	MZA. C LOTE. 16 A.V. ALEGRIA DE CARABAYLLO LIMA - LIMA - CARABAYLLO	994954742
2575	CERSSO BENDEZU CRISTIAN ANIBAL	10417467241	NRO. 314 PROLOG. CUTERVO ICA - ICA - ICA	41746724
2634	CORDOVA PURE MONICA	10077628571	JR. MANUELA ESTACIO N?? 152 DPTO. 202	0
2576	CERSSO BENDEZU RIVER REYNALDO	10215204516	ALM. DE LAS BELLAS ARTES NRO. 140 INT. 501 C.H. LIMATAMBO LIMA - LIMA	989977948
2577	CERVANTES RAMIREZ CELESTE AREMI	10445893001	MZA. E LOTE. 2 P.J. ALBERTO PORTELLA	0
2578	CGI CONTRATISTAS GENERALES S.A.C.	20514431362	AV. LOS FRESNOS NRO. 1361 URB. PORTADA DEL SOL 1ERA ETAP (ALT CDRA 12	0
2579	CHACA VALENTIN NIERI GLADYS	10073550187	CAL. LOS HORCONES MZA. M LOTE. 57 URB. LA CAPULLANA LIMA - LIMA - SANT	0
2580	CHAFLOQUE SEGOVIA GISELLA	10704462897	MZA. A LOTE. 31 A.V. SANTA ISABEL (COSTADO DEL COLEGIO JUANA MARLENE U	0
2581	CHAMBILLA APAZA LOURDES	10436583422	MZA. E LOTE. 2 URB. LOS PERALES	0
2582	CHAMOLI HERRERA GLENDY ROCIO	10433508373	CAL. BRASIL NRO. 1228 INT. B (POR LA ALZAMORA)	0
2583	CHAPILLIQUEN YOVERA CECILIA MERCEDES	10444947166	PJ. 2 MZA. C LOTE. 16 APV. CHIRA PIURA (POR LOS TALLANES.FRENTE A PLAT	0
2584	CHASKI, COMUNICACION AUDIOVISUAL	20510401809	AV. LIMA NRO. 927 (MALECON GRAU) LIMA - LIMA - CHORRILLOS	2513404
2585	CHAVARRY CAYAS JOANNA LIZBETH	10422935237	JR. ARICA NRO. 430 INT. 101 (CRUCE DE ANGAMOS CON CMDTE.ESPINAR	0
2586	CHAVEZ HUACCHA ROSMERY	10433980366	JR. 1 DE SETIEMBRE NRO. 300 (LUCUTORIO STAND 12 DENTRO DE TERMINAL	0
2587	CHAVEZ LOAYZA EDDY JORGE	10420483371	JR. J TORRE UGARTE NRO. 131 (ALT CDRA 21 DE JOSE GRANDA) LIMA - LIMA -	978944405
2588	CHAVEZ LUZON ROCIO MERCEDES	10410282271	CAL. MEDELLIN NRO. 155 INT. 2PIS URB. J.F. SANCHEZ CARRION	0
2589	CHAVEZ RARAZ NILDA LOURDES	10426152709	CAL. ANTONIO PORTUGAL NRO. 686 URB. FICUS (ALT. COLEGIO JOHN DALTON)	0
2590	CHAVEZ ZU??IGA MARJORIE SADID	10460404784	MZA. E LOTE. 16 DPTO. 201 URB. MAGISTERIAL II AREQUIPA - AREQUIPA - YA	0
2591	CHERO ORDO??EZ LILIANA MILAGROS	10446846189	CAL. MOCCE NRO. 107 UPIS SAN ANTONIO LAMBAYEQUE - LAMBAYEQUE - LAMBAYE	
2592	CHIHUAN MEJIA NESTOR PEDRO	10105949699	GRUPO 25 MZA. E LOTE. 9 SECTOR 3 (RUTA B CON VALLEJO)	287-3073 / 995544449
2593	CHIPANA ENCISO LOURDES	10430380074	MZA. F LOTE. 10 P.J. STA. ISABEL DE VILLA (ALTURA KM 17 PANAMERICANA S	0
2594	CHIPANA HUAMAN ALICET	10453545721	NRO. SN C.P. ECHARATI CIUDAD (FT MCDO LOCAL PROYECTO JASS F. SALAZAR)	0
2595	CHIRE CHIPANA LILY	10424753241	AV. FERIAL NRO. 588 URB. SANTA MARIA PUNO - SAN ROMAN - JULIACA	0
2596	CHOMBA CAMPOS MARIA ELIZABETH	10083894364	CAL. DO??A ROSA MERCEDES NRO. 133 URB. SANTA ROSA DE SURCO 2DA E (FRENT	0
2597	CHONG LOPEZ NORY MEYLIN	10414444623	MZA. I LOTE. 31 AG. MONTE AZUL (CUADRA 16 DE LA AV NARANJAL	0
2598	CHOQUE COA ELOY EZMER	10310441592	AV. PANAMA NRO. S/N (MZ A LT 16, 1CD PQ PIKICHAS) APURIMAC - ABANCAY -	
2599	CHOQUECCAHUA AYMA MARIA SALOME	10412492361	PJ. 2 MZA. G2 LOTE. 19 A.H. BOCANEGRA ZONA 5 PROV. CONST. DEL CALLAO -	0
2600	CHOQUEHUANCA VALERO YENI NOEMI	10441956822	JR. CAHUIDE NRO. 329 BARRIO MANCO CAPAC	0
2601	CHUMACERO PASAPERA JOHYSI JULIANA	10429784188	MZA. 13 LOTE. 15 A.H. SAN PEDRO PIURA - PIURA - PIURA	0
2602	CHUMBE ALVA KELVIN	10419876351	MZA. R LOTE. 19 APV. R.H. DE LA TORRE INDEP LIMA - LIMA - INDEPENDENCI	526-2491
2603	CHUMBILLUNGO REYES ERIKA ROSA	10701366145	MZA. BE LOTE. 18 URB. P. NUEVO BUENOS AIRES LIMA - HUAROCHIRI - SANTA	0
2604	CHUNGA CHAMBERGO JOSE CARLOS	10458259572	CAL. S/N MZA. S4 LOTE. 14 C DEL PESCADOR	968958273
2605	CHUQUISPUMA CAMPOS LIZETH MAGALY	10422480990	MZA. O2 LOTE. 3 A.H. BAYOBAR AMPLIACION (PARADERO 16 DE BAYOBAR) LIMA	0
2606	CIBERTEC PERU S.A.C.	20545739284	AV. 28 DE JULIO NRO. 1044 INT. 301 URB. SAN ANTONIO	419-2900
2607	CISNEROS CHAVEZ MONICA FLORINDA	10033845656	CAL. DO??A DELMIRA NRO. 228 DPTO. 401	5868302 / 997179932
2608	CISNEROS GUERRERO YESENIA MILAGROS	10479493346	CAL. H MZA. H1 LOTE. 15 A.H. SAN GENARO (ESPALDA DE COLEGIO JUAN PABLO	255-1450
2609	CISNEROS IGLESIAS BRIANDA BERUSHKA DE LOS MILAGROS	10466189451	MZA. C LOTE. 3B A.V. SAN ANDRES DE CARABAYLLO	980903332
2610	CISNEROS ROJAS ABEL	10408007408	JR. HUANUCO NRO. 338 INT. 1	999-524040
2611	COANDINA SRL	20100900247	CAL. LOS TALLADORES NRO. 353A URB. EL ARTESANO (ALT.CDRA.5 AV. LOS FRU	434-4188
2612	COLAN PALACIOS MARGOT YULIANA	10412733504	JR. CARAZ NRO. 991 URB. MERCURIO	0
2613	COLLAVE CARRANZA SEGUNDO ERNESTO	10452086846	CAL. HIPOLITO UNANUE NRO. 334 URB. LOS GRANADOS	0
2614	COLVI COM S.A. SOCIEDAD ANONIMA CERRADA	20101986315	AV. RAMON CASTILLA 128 URB. LA AURORA (ALT CRDA 59 DE AV REP. DE PANAM	241-2212
2615	COMERC. E IND DENT TARRILLO BARBA S.A.C	20100262291	AV. EMANCIPACI??N N?? 267	4286429 / 428-5171
2616	COMERCIAL DENIA S.A.C.	20427497888	AV. REP??BLICA DE COLOMBIA N?? 623	717-4555-118
2617	COMERCIAL GIOVA S.A.	20125412875	CALLE  LOS CORALES N?? 206 SANTA CATALINA	4729972 ANEXO203-204
2618	COMERCIAL VRAM S.A.	20268875426	JR. PACHITEA NRO. 261 LIMA - LIMA - LIMA	4282132
2619	COMERCIALIZADORA Y SERVICIOS HAMBERT E.I.R.L.	20462004380	CALLE. ROBLES APARICIO NRO. 1599 LIMA - LIMA - LIMA	336-5779
2620	COMESA??A REYES ROBERTO ESTEBAN	10418243916	JR. PABLO BERMUDEZ NRO. 285 INT. 304	992121839
2621	COMITE ADMI.FONDO.ASIST.Y ESTIMULO M.E.F	20456637796	JR. JUNIN 319 LIMA LIMA LIMA	428-2261
2622	CONDO ORTEGA FRANCISCO HENRRY	10075349195	CAL. CAPITAN D NAVIO FERREYROS MZA. C LOTE. 17 URB. RAFAEL ESCARDO (CD	0
2623	CONDOR ZU??IGA YAQUELIN JOYCE	10431334769	JR. JOSE PARDO NRO. 461 P.J. EL PROGRESO 1ER SECT. (ALT. KM. 19.5 DE L	954619776
2624	CONDORHUAMAN FIGUEROA ARTURO	10401032709	AV. EL SOL NRO. 176 (A 3 CDRAS DE LA PLAZA) CUSCO - URUBAMBA - HUAYLLA	0
2625	CONDORI IBARRA RITA	10101717335	MZA. 1 LOTE. 16 S.ANTONIO PEDREGAL ALTO (ESPALDA INSTITUTO RAMIRO PRIA	0
2626	CONDORI ORME??O MARIA DEL CARMEN	10214936785	JR. LOMA UMBROSA NRO. 213 INT. 2PIS URB. PROLONGACION BENAVIDES	0
2627	CONSTRUCCIONES DE ESTRUCTURAS METALICAS Y SERVICIOS SOCIEDAD COMERCIAL DE RESPONSABILIDAD LIMITADA	20507583114	AV. AV.REP DE POLONIA NRO. 1307 (ALT. CDRA. 13 AV. WIESSE) LIMA - LIMA	6056-750
2628	CONTRERAS ECOS FELICIA	10239264587	AV. ARICA NRO. 410 DPTO. 402 (ENTRE AV.ARICA Y HUARAZ) LIMA - LIMA - B	0
2629	CONTRERAS ESPINOZA MILAGROS	10408119761	MZA. R LOTE. 17 C.H. LA ANGOSTURA III ETAPA (FTE VALLE HERMOSO) ICA -	0
2630	CONTRERAS MATIAS JUAN CARLOS	10257667583	"JR. HUIRACOCHA N?? 1458 DPTO. ""J"""	4241897
2631	COPASA SERVICIOS GENERALES S.A.	20300706828	JR. CAILLOMA NRO. 124 DPTO. 309	4261283
2632	CORDAEZ E.I.R.L.	20507476547	AV. LA MARINA NRO. 785	261-5707
2633	CORDOVA LOPEZ MARTIN JOSE	10099678807	CAL. JUAN DE ARONA NRO. 124 URB. STA LUZMILA	986884092
2635	CORNEJO CARBAJAL PAOLA ELEANA	10461175967	JR. JAVIER HERAUD MZA. I LOTE. 2 (TERCER PISO, DEPARTAMENTO NRO. 8	0
2636	CORNEJO COAGUILA YENNY JULIA	10096517144	AV. SAN MARTIN DE PORRAS NRO. 443 URB. CANTO GRANDE (ALT. PARADERO 10	387-5132
2637	CORNEJO ZARATE JESSICA GIOVANNA	10258027332	MZA. K LOTE. 1 A.H. SARITA COLONIA (ALT. BASE NAVAL DEL CALLAO) PROV.	993246109
2638	CORONEL CHILCON INDIRA YOSUNI	10427183128	JR. ATAHUALPA NRO. 332 CERCADO CAJAMARCA - JAEN - JAEN	0
2639	CORONEL GUEVARA ANA	10069130190	CAL. ATAHUALPA NRO. MZ D INT. 35 URB. SAN AGUSTIN	0
2640	CORONEL URIONA FRANCISCO	10428463655	AV. PASEO DE LA CASTELLANA NRO. 1080 DPTO. 204 LIMA - LIMA - SANTIAGO	985208645
2641	CORPORACION BIOTEC S.A.C	20512356657	CAL. FLORA TRISTAN NRO. 449 (ENTRE LA CUADRA 8 Y 9 DE LA AV. PERSHING)	0
2642	CORPORACION GOURMET MARLU S.A.C	20563649357	CAL. HURTADO DE MENDOZA NRO. 375 URB. LA COLONIAL (CRUCE AV FAUCETT CO	9554-10280
2643	CORPORACION GRAFICA NOCEDA S.A.C.	20504793584	GENERAL VALERA 2030  PUEBLO LIBRE	4330154
2644	CORPORACION HOTELERA METOR S.A.	20386303003	AV. SALAVERRY N?? 2599	4119057
2645	CORREA HUAMAN VERONICA FELICITA	10441515311	CAL. LOS EUCALIPTOS MZA. L1 LOTE. 06 P.J. SAN HILARION	0
2646	COSI COSI ZULMA SONIA	10297017395	MZA. K LOTE. 30 URB. MINISTERIO AGRICULTURA (FRENTE DEL IREN) AREQUIPA	0
2647	COSTILLA GARCIA EDGARD LUIS	10400692616	NRO. E-6 URB. SANTA MARTHA CUSCO - CUSCO - SAN JERONIMO	3513020
2648	COTRINA IDRUGO YESSICA ROSSEVITH	10419496362	JR. AUGUSTO B. LEGUIA NRO. 118 BR. SAN JOSE CAJAMARCA - CAJAMARCA - CA	
2649	CRIOLLO TIMOTEO MARIA ELENA	10421851005	JR. LOS JAZMINES NRO. 748 PAUCARBAMBILLA	0
2650	CRUCES MONTOYA LHENA JHOSELINE	10067832804	CAL. 5 MZA. G LOTE. 14 URB. PORVENIR (MAR DEL CARIBE	0
2651	CRUZ CHILCON FATIMA LURDES	10460119958	CAL. MITIMAES NRO. 127 LAMBAYEQUE - CHICLAYO - LA VICTORIA	0
2652	CRUZ MAMANI JUAN VLADIMIR	10473276416	MZA. O LOTE. 27 URB. SAN IGNACIO 1RA ETAPA LIMA - LIMA - SAN JUAN DE L	959718044
2653	CRUZADO GIL ROSA JACKELINE	10450908067	CAL. PACHACUTEC NRO. 1754 P.J. EL BOSQUE LAMBAYEQUE - CHICLAYO - LA VI	
2654	CRUZADO MIRANDA ANITA MARIA	10105553116	MZA. D LOTE. 20 SECTOR VI GRUPO11 (CRUCE AV. VELASCO CON RUTA D	0
2655	CUBAS RUPAY JHANET	10451314951	JR. LLOQUE YUPANQUI NRO. 184	0
2656	CUENTAS BARRIOS CARLOS IVAN	10157267235	PROLONG.AUGUSTO B.LEGUIA NRO. 512	232-6206
2657	CULQUI VALLE DIANA VANESSA	10451522057	JR. AMAZONAS NRO. 336 AMAZONAS - CHACHAPOYAS - CHACHAPOYAS	0
2658	CULQUITANTE SANCHEZ KARLA BEATRIZ	10458717091	AV. INDOAMERICA NRO. 622 P.J. LA ESPERANZA LA LIBERTAD - TRUJILLO - LA	0
2659	CURIEL DEL AGUILA CLAUDIA DENISSE	10100005889	AV. SANTA ELVIRA NRO. 5980	421-2543
2660	CUSIHUALLPA BELLIDO HAYDEE	10409392232	MZA. I LOTE. 14 URB. VISTA ALEGRE (A 2 CASA GRIFO VISTA ALEGRE JR LAS	0
2661	CUTTI TRILLO MARIA JUSTINA	10222414020	NRO. P INT. 23 SECTOR PUBLICO AYACUCHO - HUAMANGA - AYACUCHO	0
2662	CUYA ACHAHUANCO KATHERINE SOFIA	10482880831	AV. GARCILASO DE LA VEGA NRO. 1055 A.H. 7 DE OCTUBRE	9804-87009
2663	CUZCANO CARHUAPOMA MARLENE	10100405569	CAL. LOS TUCANES NRO. 260 URB. SANTA ANITA 1ER SECTOR (ESPALDA CDRA 2	362-3716
2664	CUZCANO SAJAMI ROBERTO	10457331253	JR. LEONCIO PRADO NRO. 225 (POR LA ESCUELA MARGARITA)	0
2665	DADTHER HUAMAN YNDHIRA ZULLY	10407036331	MZA. B LOTE. 6 ASOC LOS PINOS DE LIMA (ALT 3 CDRAS DE DINOES) LIMA - L	0
2666	DANIEL ARMANDO RIVERA REGALADO	10067358177	Jr. Az??ngaro cdra. 4 puesto N?? 488 - Esquina con Miroquesada	381-3199
2667	DAVILA CHAVARRY JOSE LUIS	10446346909	CAL. PANAMA NRO. 1760 CPM URRUNAGA LAMBAYEQUE - CHICLAYO - JOSE LEONAR	979430600
2668	DAZA VELASQUEZ SUSANA BEATRIZ	10198300832	CAL. REAL NRO. 564	0
2669	DE LA CRUZ CCANTO GLADYS	10465357563	MZA. A LOTE. 01 PROG DE VIV LOS OLIVOS	949211773
2670	DE LA CRUZ ENCISO EDITH CINTIA	10415502813	JR. JOSE SANTOS CHOCANO NRO. 1170 (A UNA CUADRA DE LA POLICIA D TRANSI	
2671	DE LA CRUZ SANCHEZ JULIO	10425450447	CAL. SIN NOMBRE MZA. A LOTE. 07 A.V. LAS BEGONIAS LIMA - LIMA - PUENTE	944442240
2672	DE LA RIVA CHOQUE MADELEINE KARINA	10406938005	JR. AREQUIPA NRO. 1116 BARRIO VICTORIA PUNO - PUNO - PUNO	0
2673	DE LA TORRE MENDOZA INDIRA YOSHIMI	10466122705	AV. EL MINERO N?? 509	0
2674	DECOGAR S.A.C.	20500294508	AV. MEXICO NRO. 953 (CRUCE CON JR. CISNEROS) LIMA - LIMA - LA VICTORIA	7175419
2675	DEL CASTILLO PINTO MARIA RAFFAELLA	10406796316	LAS PALMERAS NRO. S/N DPTO. 902 (EDIFICIO LAS PALMERAS.CDRA 4 DE ESCOB	461-3435 / 988-347542
2676	DEL PINO CONDOR RONALD	10413881582	AV. SANTOS VILLA NRO. 282 (ESPALDA DE LA DRE HVCA)	0
2677	DEL VILLAR RAMIREZ LISSET	10460011073	MZA. F LOTE. 01 URB. MARIA PARADO DE BELLIDO AYACUCHO - HUAMANGA - AYA	0
2678	DELGADO AGUILAR RUBEN OMAR	10098469201	NRO. U INT. 15 ASOC.VIV.FORTALEZA	995-061007
2679	DELGADO CUBAS LUCERITO MAITHE	10464942721	MZA. A LOTE. 19 APV. LOS OLIVOS SAN MARTIN - MOYOBAMBA - MOYOBAMBA	979263846
2680	DELGADO MEGO ROSA ANITA	10473905014	PJ. UNO NRO. REF SECTOR NUEVO HORIZONTE (CA. JUAN VELASCO ALVARADO) CA	0
2681	DELGADO RIVERA TERRY	10732592925	CAL. VILLARAN NRO. 1094	222-1995
2682	DELGADO VARGAS SANDRA	10460295047	MZA. E2 LOTE. 11 URB. TUPAC AMARU (ENACO.POR EL POLICLINICO DE LA POLI	0
2683	DENEGRI MANRIQUE ESTEFANIA DESIRE	10726350065	JR. ANDAHUAYLAS NRO. 171 DPTO. B	428-0857
2684	DEPAZ COAQUIRA LYNN CAROL	10422043913	MZA. J LOTE. 12 A.H. MICAELA BASTIDAS SEC. II (ALT. DE LA DINOES	0
2685	DEZA FLORES NANCY ELIZABETH	10086943358	MZA. H LOTE. 4B A.H. ANTENOR ORREGO	0
2686	DIAZ ABANTO CANDY CAROL	10419932707	CAL. FRAY PEDRO URRACA NRO. 362 URB. SAN ANDRES I ETAPA LA LIBERTAD -	0
2687	DIAZ GUEVARA NIDIA	10421132777	JR. CARLOS LAGOMARCINO NRO. 236	0
2688	DIAZ HERRERA MELINA	10436674681	JR. DIEGO VILLACORTA NRO. 320 CAJAMARCA - CHOTA - CHOTA	0
2689	DIAZ MAYURI ITALO JAIME	10076083768	JR. FRANCISCO VALLEJO NRO. 366 CIUDAD DE DIOS ZONA A (ALT.AV.CARAVELI	276-6349
2690	DIAZ QUISPE ANTONI AYIN	10726925521	AV. MELLO FRANCO NRO. 223 URB. SAN FELI	481-7684
2691	DIAZ SANTOS CARMEN ROSA	10335880451	JR. ATAHUALPA NRO. 220 SECTOR 07	0
2692	DIPROINSA S.R.L.	20470538202	CAL. FERNANDO CASTRAT NRO. 310 DPTO. 303 URB. CHAMA	271-1645 / 271-1057
2693	DISTRIBUIDORA JOVAZA EIRL	20330055805	CAL. LAS AMANITAS NRO. 154 PROV. CONST. DEL CALLAO	5753900
2694	DOMADOR MIJA MARIXA	10430062498	MZA. O LOTE. 05 A.H. LOPEZ ALBUJAR PIURA - PIURA - PIURA	0
2696	DOMINGUEZ MORALES MARIA LUISA	10434870076	CAL. LOS MANZANOS NRO. 114 URB. LAS DELICIAS LAMBAYEQUE - CHICLAYO - C	
2697	DONAYRE MU??OZ KAROL ANALI	10429307860	CALLE EMILIO FERNANDEZ N?? 663 DPTO. 1802 SANTA BEATRIZ	940285494
2698	DOROTEO MORENO MARIA	10080910547	NRO. MZ.O INT. LT38 A.H. LETICIA (ESPALDA DEL POTAO Y AV LETICIA	669-0411
2699	DOW S.A.	20381847927	AV. PRIMAVERA NRO. 1416 INT. 1 URB. C.C.MONTERRICO	4217188
2700	DROGUERIA INVERSIONES JPS SAC	20482137319	AV. AMERICA OESTE NRO. 160 URB. LOS CEDROS LA LIBERTAD - TRUJILLO - TR	0
2701	DURAND CASTILLO JANET EDITH	10458690150	JR. J. CARLOS MARIATEGUI MZA. H LOTE. 9 A.H. SAN ISIDRO ANCASH - CASMA	0
2702	E-BUSINESS DISTRIBUTION PERU S.A	20474529291	AV. JOSE GALVEZ BARRENECHEA N?? 996 - URB. CORPAC	712-5000
2703	EDIFICIOS Y CONST. SANTA PATRICIA S.A.	20110545798	CALLE SAN MARTIN N?? 305	610-7000/2107/2143
2704	EGOAVIL OCROSPOMA JHON ANTHONY	10726409337	AV. TUPAC AMARU NRO. 376 P.J. CLORINDA MALAGA DE PRADO	992054026
2705	ELECTRONICA MUSICAL SOCIEDAD ANONIMA CERRADA	20537679663	JR. PARURO NRO. 1382 CERCADO LIMA - LIMA - LIMA	428-0929
2706	ELEGANCIA Y SABOR S.A.C	20546329161	PJ. SANTA ROSA MZA. B LOTE. 3 LIMA - LIMA - SAN BORJA	2655440
2707	ELUQUIS HUERTAS MIRTHA SOLEDAD	10449053643	MZA. D LOTE. 15 A.H. 18 DE FEBRERO	0
2708	EMP SERVIC TURISTICOS COLON SAC	20462041587	CAL. COLON NRO. 600 URB. MIRAFLORES (ALT.CDR 12 DE AV.LARCO) LIMA	6100900 / 4442000
2709	"EMPRESA DE LA TECNOLOGIA ENERGIA Y CONSTRUCCION SOCIEDAD ANONIMA CERRADA-""EDELTEC S.A.C."""	20490969765	MZA. G LOTE. 6 URB. CRUZPATA (PSJE FRANCISCA ZUBIAGA X IE REP D MEXICO	0
2710	EMPRESA DE SERVICIOS GLOBALES S.A.C. - EMSERGLOBALES S.A.C.	20537285371	AV. VALLES DEL SUR NRO. 382 DPTO. 102	6529738 / 996626570
2711	EMPRESA EDITORA EL COMERCIO S.A.	20143229816	JR. ANTONIO MIRO QUESADA 300	311-6500
2712	EMPRESA PERUANA DE SERVICIOS EDITORIALES S.A.	20100072751	AV. ALFONSO UGARTE N?? 873	315-0400
2713	ENCISO MARTINEZ MAURA	10234655774	JR. ARICA N?? 381	0
2714	EQUIDATA S.A.C.	20473350271	JR. WASHINGTON NRO. 1105	6134760
2715	ESCAJADILLO LAGOS NATIVIDAD ROSARIO	10434552864	MZA. P LOTE. 02 P.J. ACOMAYO ZONA B (ANTES DE LLEGAR A LA PARROQUIA) I	0
2716	ESCAJADILLO PALOMINO MARIA	10425691932	CAL. V. M. MAURTUA NRO. 283	0
2717	ESPINOZA COVE??AS MIRYAM DONELLA	10258422142	AV. DOS DE MAYO 518	
2718	ESPINOZA LUNA TERESA ADITH	10457546870	AV. CANADA MZA. F-1 LOTE. 17 URB. SAN JUAN MASIAS (A MEDIA CUADRA DE L	0
2719	ESPINOZA RIMARI POOL DAVIS	10448259515	JR. LIBERTAD NRO. 250 (A1 CDRA. DEL COLEGIO LEV VITOSKY) JUNIN - TARMA	985037907
2720	ESPINOZA SILVA MAXIMO MANUEL	10087788151	CAL. LOMA RICA NRO. 191 URB. PROLONG.BENAVIDES LIMA - LIMA - SANTIAGO	2754099
2721	ESPINOZA SOLORZANO ROXANA YEZABEL	10181660380	AV. 28 DE JULIO N?? 465 DPTO. 402	953792274
2722	ESPINOZA VIVAS JAKELIN JUDITH	10464433347	JR. ALBERTO HIDALGO MZA. C LOTE. 16 COO. CANTO GRANDE (PARADERO 7 DE C	0
2723	ESPIRITU DIAZ CLELIA MYRIAM	10096274918	CAL. JOSE GALVEZ NRO. 264 URB. VALDIVIEZO (A 4 CDRAS DEL GRIFO PALAO)	0
2724	ESTRADA FERNANDEZ TADASKY ULIANOVA	10433861421	CAL. W. RODRIGUEZ NRO. 229 URB. PRIMAVERA	0
2725	ESTRELLA BRAVO LUIS SUNIL	10001278598	JR. LAS PALMERAS MZA. 238 LOTE. 17	0
2726	EUFRACIO BERNAL WENDY LUZ	10719428385	CAL. LAS ZUCENAS MZA. I LOTE. 17 ASOC.RESIDENCIAL MOSHA LIMA - LIMA -	0
2727	EVAISA SAC.	20555997931	JR. LOS LAURELES Mz ?? - LTE. 19 - SAN MIGUEL	5617567
2728	EVARISTO WHARTON SUSAN MARGOT	10404221847	JR. GENERAL PEZET NRO. 199 (ALT CDR 11 FRANC.PIZARRO Y CDR8 PROCERES)	338-7370
2729	FARFAN NAVENTA CRISTINA	10485237904	CAL. 7 MZA. J2 LOTE. 3 A.H. SAN GENARO II ETAPA	567-0054
2730	FARFAN SAAVEDRA MARIA DEL PILAR	10705650824	JR. LORETO NRO. 1131 BARRIO FISCAL (ALT DE LA COMISARIA ALIPIO PONSE)	9869-60520
2731	FARFAN TIRADO JOVANNA	10445436092	CAL. LA FLORIDA NRO. 136 URB. SAN ISIDRO	0
2732	FASCE LOMAS MERCEDES	10403433883	AV. AMAZONAS MZA. A LOTE. 10 ASOC.P.V.SANTA INES	0
2733	FERNANDEZ ASTETE IVONNE MABELL	10402942342	AV. LOS EUCALIPTOS NRO. 1171 INT. 201 COO. LA UNIVERSAL (ALT. A UNA CD	0
2734	FERNANDEZ BUENDIA LUISA LAURA	10434941658	JR. MARISCAL CASTILLA NRO. 2028 CHILCA SECTOR 11 (80MTRS D MARISCAL CA	0
2735	FERNANDEZ DE LA CRUZ GILBERTO OSWALDO	10455042769	CAL. TIPUANA TIPA NRO. 54 BARR. BARRIO OBRERO LA LIBERTAD - ASCOPE - C	0
2736	FERNANDEZ DELGADO LEOPOLDO ARTURO	10085576491	PSJE. FEDERICO SOTOMAYOR N?? 157 RESIDENCIAL GRAU	533-5921/ 990333555
2737	FIESTAS BAZALAR ROXANA IBETH	10443637538	MZA. D LOTE. 2 A.H. 23 DE ABRIL (FRENTE A URNA DE CRUZ DE MOTUPE) LIMA	0
2738	FIGUEROA CHAVEZ VIRGILIO ROBERT	10107887798	AV. MANCO CAPAC NRO. 635 BARRIO DE NICRUPAMPA	0
2739	FIGUEROA URREGO JENNIFER PAOLA	10465278655	PJ. LAS MAGNOLIAS MZA. F LOTE. 4 A.H. JOSE MARIA ARGUEDAS LIMA - LIMA	0
2740	FLOA CONSTRUCCIONES Y SERVICIOS SOCIEDAD ANONIMA CERRADA	20538304124	JR. FRANCISO DE ZELA NRO. 943 DPTO. 501	0
2741	FLORES ALDAVE KARIM	10802120287	MZA. 125 LOTE. 29 URB. NICOLAS GARATEA (ULTIMA MANZANA FRENTE ZONA DE	6021364
2742	FLORES APARI ANABEL SHOLANCHS	10732600561	CAL. 8 MZA. K10 LOTE. 03 A.H. ANGAMOS (FTE. A LA GUARDERIA) PROV. CONS	0
2743	FLORES ARGUMEDO KATTYA ROXANNA	10101705191	PJ. HIPOLITO UNANUE NRO. 122 MARIA PARADO DE BELLIDO (MOYOPAMPA BAJA	0
2744	FLORES BA??OS MAYCO	10435407809	NRO. 04 VERDE CCOCHA AYACUCHO - HUANTA - SIVIA	0
2745	FLORES CAHUAYA DORIS ELEUTERIA	10013398971	AV. TUPAC AMARU NRO. 506 CERCADO	0
2746	FLORES CAMPOS DE NITZUMA PILAR	10000763964	PJ. RAFAEL DE SOUZA MZA. 146 LOTE. 07 (FRENTE A LA DREU)	0
2747	FLORES CONDORI ADELA ESTHER	10046358827	AV. JORGE CHAVEZ NRO. 309 URB. JORGE CHAVEZ AREQUIPA - AREQUIPA - PAUC	0
2748	FLORES LEON VANESSA MILAGROS	10449563196	JR. PIURA N?? 711	987926068
2749	FLORES MEZA LIZBETH OLIVIA	10435768488	CAL. FRANCISCO LAZO NRO. 117 URB. STO DOMINGUITO (CERCA AV AME.SUR CON	0
2750	FLORES RAMIREZ JENY MANUELA	10406965240	URB TUPAC AMARU MZA. L LOTE. 14 (CAPILLA MARAVILLA POR EL PUENTE)	0
2751	FLORES RAMOS EDWIN AMERICO	10437821955	CAL. LA CHIRA MZA. P LOTE. 1 A.H. NUEVA CALEDONIA	993668832
2752	FLORES TELLEZ ANGELA MARJORY	10421578554	JR. MEZA MEDRANO NRO. 577 SAN GERMAN	0
2753	FLORES VILLACORTA PAULO SERGIO MANASES	10454860255	JR. MIGUEL GRAU NRO. 1418 SAN MARTIN - SAN MARTIN - TARAPOTO	0
2754	FLORES YAJAHUANCA AIDEE	10774636060	PJ. ALBERTO URETA MZA. J LOTE. 6 A.H. EL AMAUTA	9898-58121
2755	FONSECA CCALLUCO MERCEDES ISABEL	10410841555	CAL. ABANCAY NRO. 205 P.J. APURIMAC AREQUIPA - AREQUIPA - ALTO SELVA A	0
2756	FRIAS DELGADO ELMER	10277504338	CAL. MARIETA NRO. 630 NUEVO HORIZONTE	0
2757	FUNDACION ACADEMIA DIPLOMATICA DEL PERU	20108022451	AV. FAUSTINO S??NCHEZ CARRI??N NRO. 335 URB. SANTA ROSA (ALT. CDRA. 26 A	0
2758	G & A CONSULTORES Y CONTRATISTAS S.A.C.	20525074057	JR. LAS MANDARINAS MZA. C LOTE. 17 RES. MONTERRICO (GRIFO PRIMAX DE AV	4361262
2759	G Y G INVERSIONES GENERALES S.A.C.	20568533322	JR. LOS CLAVELES MZA. A LOTE. 06 BARRIO SAN CRISTOBAL (MANO IZQUIERDA	961026268
2760	GALLEGOS CANO MATILDE GLADYS	10292805468	CAL. LIBERTAD NRO. 3608 URB. PERU	6575691
2761	GALLIANI MONTES ANGHELLA MELISSA	10463769481	MESONES Y MURO N?? 155 - MARANGA	992182744
2762	GALVEZ GONZALES COTTY LIZETH	10460353349	AV. TUPAC AMARU NRO. 260 CAJAMARCA - CHOTA - CHOTA	
2763	GALVEZ LA FUENTE ANA MARIA	10075778509	JR. LOS JAZMINES NRO. 326 INT. A LIMA - LIMA - LINCE	422-1324
2764	GAMARRA ANGELES RUBY	10463928741	MZA. 9 LOTE. 15 URB. NICOLAS GARATEA ANCASH - SANTA - NUEVO CHIMBOTE	0
2765	GAMARRA MINAYA DAN ANGELO	10430661642	AV. BOLIVAR NRO. 416 DPTO. 2002 (A CUATRO CUADRAS DE LA AV BRASIL) LIM	991184388
2766	GAMARRA MUNDACA CYNTHIA GISSELA	10461125692	MZA. 104A LOTE. 9 SEC. JUAN VELASCO	0
2767	GAMARRA QUISPE MERCEDES JESSICA	10410618031	MZA. C6 LOTE. 4 LOS OLIVOS ANCASH - SANTA - NUEVO CHIMBOTE	0
2768	GAMBOA VASQUEZ WILLIAM PERCY	10181639381	EDIFICIO NRO. 12 DPTO. 301 C.H. FONAVI II	0
2769	GANOZA CUEVA KAREN KEYLA	10728408974	JR. FEDERICO NOGUERA NRO. 357 URB. MIGUEL GRAU (MCDO CAQUETA PLAZA 2 C	0
2770	GARAY PEREZ ROSARIO	10447808175	JR. VICENTE MORALES NRO. 190 URB. SANTA LUZMILA 2DA ETAPA (ALT HOSPITA	9930554913
2771	GARAY SALAZAR CELIA VERISA	10449126276	AV. LAS TORRES MZA. B LOTE. 13 URB. CASABLANCA	0
2772	GARAY VILCHEZ MARIO MARTIN	10804442877	CAL. TACNA 1ER PISO NRO. 1018 (A 1 CUADRA DE AV. BOLOGNESI	979-698002
2773	GARCES BELTRAN ALEJANDRO MIGUEL	10424566611	JR. HUANCAVELICA MZA. V LOTE. 57 URB. SANTA PATRICIA 2DA ETAPA (ALT DE	3491099
2774	GARCIA GARIBAY CINTHYA HEIDY	10425938954	MZA. S LOTE. 09 P.J. SAN CARLOS ICA - ICA - ICA	349-1079
2775	GARCIA GUTIERREZ CARMEN ROSA	10403496869	MZA. E LOTE. 09 BQ LUIS ALBERTO SANCHEZ (ENTRE LA ESCUELA AGONIA Y EXP	0
2776	GARCIA HEREDIA SANTOS MERCEDES	10412978922	CAL. EL NARANJAL NRO. 108 P.J. LOS OLIVOS LAMBAYEQUE - CHICLAYO - CHIC	0
2777	GARCIA OLIVARES DIANA IRINA	10456061333	CAL. LORETO NRO. 900 (CERCA DEL COLEGIO MARIA INMACULADA	0
2778	GARCIA RAZA JOSUE ANGEL	10732365074	CAL. GRAL BUENDIA NRO. 574 P.J. 2 DE MAYO (ALT. CUADRA 5 AV. MARALES D	989679709
2779	GARCIA ROMERO MARIA DOMITILA	10450247753	MZA. E LOTE. 15 URB. LA RINCONADA II ETP	0
2780	GARCIA SANCHEZ MARTHA JACINTA	10438192986	CAL. INCA GARCILAZO DE LA VEGA LOTE. 14 A.H. LEONCIO PRADO (A 1 CDRA D	0
2781	GARRIDO PASTOR JOHANA ROSALYN	10420512185	GDIA PERUANA NRO. 487 MATELLN (METRO CHORRILLOS, 2DA ENTRADA)	0
2782	GARRO MARQUEZ JAVIER WILLAM	10060892933	NRO. MZA3 INT. LT23 ASOC. DANIEL A. CARRION (ALT. PARADERO 5 AV. SANTA	0
2783	GASPAR CACERES BERENICE	10466158556	AV. CESAR VALLEJO NRO. 102 (POLLERIA WILLYS) CUSCO - CANCHIS - SICUANI	0
2784	GASPAR PORRAS JOVANA JANETH	10421522362	JR. PERSICARIAS N?? 1842 URB. SAN HILARI??N	0
2785	GAZEL PERU SOCIEDAD ANONIMA CERRADA - GAZEL PERU S.A.C	20511995028	AV. PABLO CARRIQUIRRY NRO. 660 URB. EL PALOMAR LIMA - LIMA - SAN ISIDR	4216006
2786	GENFAR PERU S.A.	20153275450	CAL. LOS TELARES 165 URB. VULCANO (SEPARADORA INDUSTRIAL Y AV. LA MOLI	6186100 / 3492734 / 3492730
2787	GLATT SOCIEDAD ANONIMA	20420289597	AV. SANTIAGO DE SURCO NRO. 3887 URB. VISTA ALEGRE	2720562
2788	GOICOCHEA READI JUAN PABLO	10103198220	AV. JULIO BAILETTI NRO. 223 DPTO. 101 URB. JACARANDA II (A 1 CDR DE IN	998886544
2789	GONZA AGUILERA SEGUNDO MARTIN	10425121761	MZA. C LOTE. 10 A.H. LOS ANGELES 1 ETAPA (FRENTE AL COLEGIO PRIMARIO)	0
2790	GONZALES DIAZ JAIME GENARO	10292933563	CAL. CUZCO NRO. 721 MOQUEGUA - MARISCAL NIETO - MOQUEGUA	942002271
2791	GONZALES GUZMAN ALBERTO	10418787126	AV. 28 DE JULIO NRO. 228 INT. 43 (PI4 A 1 CDRA DEL HOSPITAL DEL NI??O)	4236576
2792	GONZALES JULCA MARY CARMEN	10465744877	PJ. IV CENTENARIO NRO. 133 CP CAMANA (FRENTE A LA SUBREGION)	0
2793	GONZALES LOLI JOHN RONALD	10329898666	ALBERT EINSTEIN 210 SURQUILLO	6647996
2794	GONZALES QUISPE ROXANA	10417688922	CAL. FORTALEZA NRO. 263 COO. CHANCAS DE ANDAHUAYLAS (POR EL MERCADO LA	0
2795	GONZALES RUIZ KAREN LISBETH	10432496428	II ETAPA MZA. I LOTE. 12 URB. PABLO VI AREQUIPA - AREQUIPA - AREQUIPA	0
2796	GONZALES VILLALTA DOMINGO	10012097706	JR. DEUSTUA NRO. 910 CERCADO PUNO - PUNO - PUNO	968291080
2797	GONZALO GONZALO SIMONA	10418615945	MZA. B LOTE. 8 URB. SAN ISIDRO DE CACACHI (A 3 CUADRAS DE ESCUELA DE S	0
2798	GONZALO LAVADO ERIKA DAYSI	10444275401	JR. 28 DE JULIO NRO. 970 (A TRES CUADRAS DEL CUARTEL) JUNIN - HUANCAYO	0
2799	GRAFICA VILCA FLORES E.I.R.L.	20511906297	FCO PIZARRO NRO. 568 INT. 6 LIMA - LIMA - RIMAC	4817140
2800	GRANDEZ MU??OZ ROSA MERCEDES	10445838387	JR. GRAU NRO. 307 URB. YANCE AMAZONAS	0
2801	GRIFOS ESPINOZA S A	20100111838	AV. LA ENCALADA NRO. 1388 (A MEDIA CDRA. EMBAJADA DE E.E.U.U.)	4342351 / 7080700
2802	GRUPO RASO E.I.R.L.	20554236791	JR. LAS TRES MARIAS MZA. A-3 LOTE. 18 INT. 3 URB. LOS CEDROS DE VILLA	987715560
2803	GUAYAMBAL AGUIRRE ERICA JACQUELINE	10400408241	JR. LIBERTAD NRO. 678 URB. LA LIBERTAD (ALT. DEL KM 11 DE LA AV. TUPAC	0
2804	GUERRA AREVALO LUIS ENRIQUE	10403642296	AV. LIMA NRO. 1018 URB. PANDO (ALT CDRA 4 AV UNIVERSITARIA)	958099823
2805	GUERRA LOLOY BERTILDA	10448424401	JR. SAN MARTIN NRO. 863 CENT CERCADO	0
2806	GUERRA MURGA FORTUNATA	10239873591	PJ. CANGALLO NRO. 113 (COSTADO DE LA AGENCIA REY BUS) AYACUCHO - HUANT	0
2807	GUERRA RAMOS DIANA MAGALY	10096710734	JR. BACA FLOR NRO. 522 URB. INGENIER	3300189 / 91022110
2808	GUERRERO MACHA PATRICIA MABEL	10430725063	JR. LA PRUDENCIA NRO. 7957 URB. PRO 5TO SECTOR I ETAPA (ENTRE AV. CORD	0
2809	GUERRERO VERTIZ NIMIA ROSA DEL PILAR	10102029262	CAL. TAMBO REAL NRO. 490 DPTO. 204 INT. 01	523-8968
2810	GUEVARA ACU??A ARNOLD GUBERLI	10446329176	JR. J. SOTO BURGA NRO. 165 (CERCA A I.E. 11039	0
2811	GUEVARA AURICH LIZET CAROLINA	10445194978	CAL. RICARDO PALMA NRO. 22 PROLG 24 DE JUNIO	0
2812	GUEVARA GONZALES TANIA NOELIA	10436406776	CAL. SAMAREN NRO. 259 (AV QUI??ONES 1 CDRA DEL COLEG RUY GUZMAN) LORETO	0
2813	GUEVARA SIMON YOLANDA NOEMI	10422445639	CAL. 38 MZA. Q LOTE. 23 SEC. BARRIO III LA LIBERTAD - TRUJILLO - EL PO	0
2814	GUEVARA URBINA RONALD	10419919026	URB. LOS LIRIOS MZ. I LOTE 28	5751170
2815	GUILLEN PAZ NATALI ADELAIDA	10430515085	JR. YEN ESCOBEDO NRO. 509 URB. SAN GERMAN (ALT.DE CDRA.5 DE AV.GERMAN	4565289
2816	GUILLEN QUISPE NILDA ERIKA	10402976832	AV. J. FRANCISCO MARIATEGUI NRO. 1785 DPTO. 405 RES. RAPALLO (ALTURA C	983945931
2817	GUILLINTA HERNANDEZ ALYS YISSET	10441473562	MZA. C LOTE. 9 CAS. PUNO SE 7 (POR COLEG PRIMARIA) ICA - ICA - TATE	0
2818	GUTIERREZ BRICE??O PAMELA ALEXANDRA	10765012908	JR. LORETO NRO. 1230 A.H. RUGGIA	453-5043
2819	GUTIERREZ CATA??O JAIME PABLO	10428538779	AV. TUPAC AMARU NRO. 1848 A.H. RAUL PORRAS BARR (FRENTE AL PARQUE ZONA	0
2820	GUTIERREZ CORREA LIBBY DIANA	10453077816	LITUMA PORTOCARRERO N?? 131	984126899
2821	GUTIERREZ MONRROY JHON MANUEL	10475609170	MZA. N LOTE. 7 A.H. JUAN GONZALES BERROSPI (FRENTE A PLAZA VITARTE) LI	0
2822	GUTIERREZ MONRROY JUAN LUIS	10756294976	MZA. N LOTE. 7 A.H. JUAN GONZALES BERROSPI LIMA - LIMA - ATE	0
2823	GUTIERREZ SAMANEZ CARLOS ENRIQUE	10768042247	CAL. REAL NRO. 374 P.J. SANTA ROSA (COLEGIO SANTA ROSA)	966858236
2824	HANCCO BARREDA VANESSA	10455614665	MZA. K LOTE. 7 URB. RAFAEL HOYOS RUBIO ZON A (CERCA A LA PISCINA DE SE	0
2825	HAVAS MEDIA PERU S.A.C.	20417930079	AV. JUAN DE ARONA NRO. 151 INT. 703 C.C.JUAN DE ARONA LIMA - LIMA - SA	6118800-118
2826	HELEZZIA & TOURS S.A.C.	20509341011	Av. La Paz N?? 1362 Miraflores ( esquina con Vasco Nu??ez de Balboa)	2416571 997891153
2827	HERBOZO SARMIENTO EVELYN ROCIO	10401280699	JR. LORETO N?? 1156	997665325
2828	HERMOZA SOTOMAYOR CRISTINA	10414204711	JR. ARICA NRO. 126 AYACUCHO - HUANTA - HUANTA	0
2829	HERNANDEZ GUEVARA OLIVER ENRIQUE	10704370879	MZA. F-1 LOTE. 8 COO. VIV ALBINO HERRERA 2DA ET (ALT. CDRA. 33 DE TOMA	5752198
2830	HERNANDEZ LOYA FLOR DE LIZ	10436353893	PJ. SAN VICENTE DE PAUL NRO. 127	0
2831	HERNANDEZ MANSILLA CATHERINE MICHEL	10454522538	AV. HONORIO DELGADO NRO. 429 URB. INGENIERIA (FRENTE UNIV CAYETANO	0
2832	HERNANDEZ NI??O GISELLA JULIANA	10422398622	MZA. C LOTE. 16 APV. CHIRA PIURA PIURA - PIURA - PIURA	0
2833	HERNANDEZ ORDINOLA MARIANELLA CECILIA	10093913707	CAL. CERRO COLORADO NRO. 126 URB. SAN IGNACIO LIMA - LIMA - SANTIAGO D	991888273
2834	HERRERA BERGAMINO GISELLA IVONNE	10081706749	CALLE 6 NRO. 1110 URB. LA FLORIDA (ALT. CDA.10 DE ALCAZAR)	482-6351
2835	HERRERA COLMENARES SAHIKO ALIX	10484685598	CAL. S/N MZA. M LOTE. 6 P.J. TACALA (ALT. PARALELA AV EL SOL)	994912627
2836	HERRERA FERNANDEZ YANET DEL ROCIO	10182113226	MZA. E LOTE. 4 URB. HUERTA GRANDE	0
2837	HERRERA GUTIERREZ SARA SAMANTA	10456676648	MZA. D LOTE. 4 URB. CESAR VALLEJO AREQUIPA - AREQUIPA - PAUCARPATA	0
2838	HIDALGO YUPANQUI EPIFANIO AQUILINO	10207228236	AV. MANUEL A.PINTO NRO. 602	0
2839	HILARIO LEANDRO JUSTO SANDRO	10225155980	AV. MICAELA BASTIDAS NRO. 732	0
2840	HILMART S.A.	20457010266	NRO. C INT. 24 SECTOR 2, GRUPO 17 (ALT CRUCE AV ALAMOS Y AV EL SOL) LI	288-0366
2841	HINOSTROZA GOMEZ ANTONIA	10001224820	JR. MEXICO NRO. B INT. 11 A.H. INDOAMERICA (POR EL TIO TO??O)	0
2842	HOTEL CARRERA SAC	20538869491	CAL. LEON VELARDE NRO. 123 LIMA - LIMA - LINCE	6195200-2517
2843	HOTELES ESTELAR DEL PERU S.A.C.	20518738314	AV. ALFREDO BENAVIDES NRO. 415 LIMA - LIMA - MIRAFLORES	6307777-230
2844	HOTELES SHERATON DEL PERU S.A	20100032610	AV. PASEO DE LA REPUBLICA 170/LIMA	3155017
2845	HPH INVERSIONES E.I.R.L	20506598282	AV. GUARDIA CIVIL NRO. 277 URB. CORPAC	226-5661/4750947
2846	HUACCHO CORTEZ MARCO ANTONIO	10435771870	CAL. CARLOS A. SACCO NRO. 238 EL BOSQUE (ALTURA DE LA CUADRA 8 DE LA A	0
2847	HUACHO SUSANIVAR CERAO ROSARIO	10468927301	JR. ESTEBAN PAVLETICH NRO. 991 (A MEDIA CDRA DEL COLEGIO ILLATHUPA	0
2848	HUALPA HERNANDEZ DIANA ROSARIO	10455253361	MZA. D LOTE. 14 P.J. SR DE LOS MILAGROS (1 CDRA ENTRANDO POR SUBIDA D	0
2849	HUAMAN CCORIMANYA YANINA ISIDORA	10446737444	CAL. LA PAZ MZA. G LOTE. 03 A.H. LAS MALVINAS (PAMPLONA ALTA. ALTURA D	0
2850	HUAMAN CERRON DIANA ELIZABETH	10710233573	PJ. 1 MZA. 19 LOTE. 13 A.H. STA TERESA DE VILLA	941554967
2851	HUAMAN CRUZADO MERLY EDITH	10450418752	MZA. C LOTE. 14 LT LAS TORRECITAS (CALLE LAS GOLONDRINAS 262) CAJAMARC	
2852	HUAMAN LUCERO JUANA MARIA	10430971561	MZA. T LOTE. 23 P.J. VILLA HERMOSA LAMBAYEQUE - CHICLAYO - JOSE LEONAR	0
2853	HUAMAN MAYURI FRANCISCA DEL PILAR	10198701438	CAL. 8 MZA. R LOTE. 18 URB. EL PINAR (CRUCE ENTRE AV. EL PINO Y CALLE	996271776
2854	HUAMAN TIMOTEO DEYSI YANNET	10426060243	MZA. C13 LOTE. 13 A.H. SAN MARTIN PIURA - PIURA - PIURA	0
2855	HUAMAN VARGAS ROCIO	10431278711	CAL. SIETE DE JUNIO NRO. 481 CENT BAMBAMARCA CAJAMARCA - HUALGAYOC - B	
2856	HUAMANI ENCISO RICHARD HILARIO	10101577444	JR. SUCCHA NRO. 271 URB. CHACRA COLORADA LIMA - LIMA - BRE??A	989249045
2857	HUAMANI MORENO JOSSELYN	10482529106	MZA. S3 LOTE. 21 A.H. DEFENSORES DE LA PATRIA	940763262
2858	HUANCAHUARI PEREZ GRACE LUCIA	10458545702	MZA. D LOTE. 13 ASOC SANTA CHIARA (KM 11.5 CARR.CENT. STA CLARA ALT.SE	0
2859	HUANSI CHILO VICTOR JAVIER	10441015327	CAL. MIGUEL GRAU NRO. 132	0
2860	HUARACHI MU??OZ ANNIE JACKELYN	10708886926	MZA. 25 LOTE. 15 P.J. MNO MELGAR (CURVA NUEVA ESPERANZA, TIENDA MAYORS	593-3703
2861	HUARINGA CANGALAYA LUSMILA GISELA	10471575467	PJ. ALBERTO URETA MZA. J LOTE. 6 A.H. EL AMAUTA 1ER SECTOR (PARADERO E	965082402
2862	HUASCO FARFAN EDELMIRA	10406943441	MZA. H LOTE. 05 A.H. SAN MARTIN DE PORRES	0
2863	HUASHUAYA VELIZ JULIO	10434052152	JR. ROSA MERINO MZA. C4 LOTE. 25 URB. MRCAL CACERES (ALT.PDRO.3 DE MAR	3928157
2864	HUAYTA PILLACA ADEMIR GINO	10075297527	CAL. MARSELLA MZA. G LOTE. 11 A.H. MICAELA BASTIDAS SECTOR 1	9992-71766
2865	HUIVIN GRANDEZ DE MORI MILITZA	10011250608	JR. SAN MARTIN NRO. 808	0
2866	HURTADO CERRON SOFIA	10435600544	CAL. OLAECHEA ARNAO NRO. 1264 URB. ELIO	563-8248 / 940146564
2867	HURTADO YUPANQUI DIANA CAROLINA	10436269990	JR. ELIAS ROBLEDO MZA. E LOTE. 06 A.H. AUGUSTIN CAUPER	0
2868	I & G HISPANIA S.A.C.	20550025176	AV. LA PAZ NRO. 1101 URB. MIRAFLORES LIMA - LIMA - MIRAFLORES	2008000
2869	IBA??EZ GONZALEZ ERMANCIA ERSELIZ	10456298457	NRO. SN CAS. PURUMARCA (CERCA DEL DESVIO)	0
2870	IBA??EZ MAMANI FRESIA PILAR	10460652915	MZA. J LOTE. 08 URB. VILLA DEL LAGO	0
2871	IBARRA NORE??A HAYDEE	10426085319	JR. 14 DE AGOSTO NRO. 360 P.J. LAS MORAS (FRENTE AL INABIF	0
2872	ILLESCA PUMARRUMI JUDY REBECA	10157583587	JR. ALPAMAYO NRO. 135 BARRIO PUQUIO CANO	0
2873	IMAGEN CORPORATIVA GRAFIMAR S.A.C	20524913390	JR. LUIS GALVEZ CHIPOCO NRO. 333 DPTO. 5 LIMA - LIMA - LIMA	998994969
2874	IMPORTACIONES HIRAOKA S.A.C.	20100016681	AV.ABANCAY N?? 594	428-8185
2875	IMPORTADORA Y DISTRIBUIDORA ZURECE SAC	20502891767	AV. ABANCAY N?? 407 INTERIOR 602	42671677 / 4264782 / 830*7085
2876	IMPORTS & EXPORTS TEXTILES NEW WORD SAC	20392657020	jiron belgica 1605 la victoria	3244089
2877	IMPRESOS Y SOLUCIONES E.I.R.L.	20563564441	CAL. INDEPENDENCIA NRO. 521 URB. PANDO ET 7 LIMA - LIMA - SAN MIGUEL	95641177
2878	INDUSTRIAL PRODEX DELGADO S.A.	20262173853	CAL. PEDRO MURILLO NRO. 1041 URB. EL CARMEN (ESPALDA METRO AV SUCRE)	3247974 / 4620425
2879	INDUSTRIAS GRAFICAS ZAFERRO S.A.C.	20546879748	JR. CALLAO NRO. 727 INT. 108 (ALT. AV. TACNA CDRA. 1)	6886773 / 993332706
2880	INFANTES POMAR ELIANA CARMEN	10257673923	CAL. VIRREY HURTADO DE MENDOZA NRO. 375 URB. LA COLONIAL	#969696529
2881	INGARUCA AMAYA GISSELA NATALY	10473789529	JR. LORETO NRO. S/N (S71360696-N 611-A 50MT DE HUAYNACAPAC) JUNIN - TA	0
2882	INGUNZA CA??OLI PATRICIA ISABEL	10214610952	AV. ALAMEDA DEL NORTE MZA. A4 LOTE. 10 ALAMEDA DEL NORTE (ALT. GRIFO S	0
2883	INGUNZA RIVERA DIANA JUDITH	10444901123	BL. TOMAYQUICHUA MZA. F LOTE. 27 P.J. TOMAYQUICHUA (1 CDRA DE LA PERRI	0
2884	INSTITUTO QUIMIOTERAPICO S.A.	20100287791	AV. SANTA ROSA 350	6120707
2885	INSTITUTO SUPERIOR SAN IGNACIO DE LOYOLA S.A.	20100134455	AV. LA FONTANA NRO. 795 URB. SANTA PATRICIA LIMA - LIMA - LA MOLINA	7060000
2886	INVERSIONES CORBAN S.A.C.	20520767143	BOLIVAR NRO. 199 DPTO. 1 (FRENTE AL ESTADIO NACIONAL)	330-9762 / 947054051
2887	INVERSIONES KAMIA S.R.L	20510367601	JR. CHAVIN NRO. 495 COO. CHANCAS DE ANDAHUAYLAS (1RA ET-ALT DEL MCDO A	956350395
2888	INVERSIONES KUSADASI S.A.C.	20544496078	AV. EL DERBY NRO. 055 (TORRE 1 - PISO 7) LIMA - LIMA - SANTIAGO DE SUR	2730687
2889	INVERSIONES MECANICAS & TECNOLOGICAS S.A.C. IMETEC S.A.C.	20545254272	AV. CATALINO MIRANDA NRO. 230 (INICIO LA VIA EXPRESA) LIMA - LIMA - BA	992510397
2890	IRRIBARREN CALDERON HEELEN	10439645496	JR. UBINAS MZA. G LOTE. 2 INT. 03 P.J. SAN LUIS (ALTURA DEL PARQUE DE	0
2891	IZQUIERDO FERNANDEZ EDILBERTO NILO	10406454776	MARIANO BUSTAMANTE NRO. 557 (ALT.. DELA CDRA 5 DE LA AV. BOLOGNESI) LI	0
2892	IZQUIERDO ZAGACETA MIRIAN NADINE	10467463956	MZA. 15 LOTE. 07 URB. SANTA ROSA LAMBAYEQUE - CHICLAYO - LA VICTORIA	0
2893	JACINTO YOVERA JORGE JESUS	10449870234	CAL. ALFONSO UGARTE NRO. 104 PIURA - SECHURA - VICE	0
2894	JARA NOEL KATHERINE IVONNE	10448118644	CALLE LOS NOGALES N?? 105 URBANIZACI??N LOMAS	0
2895	JARAMILLO BARDALES INGRID	10435199041	MZA. J LOTE. 23 A.H. CONSUELO DE VELASCO (1 CUADRA ANTES DE LA AV.PERU	0
2896	JAUREGUI CANCHARI VLADIMIR	10283149795	MZA. B LOTE. 17 URB. SECTOR EDUCACION	96696-7911
2897	JAUREGUI PORTILLA CARLOS GUSTAVO	10421167945	CAL. PROF JORGE MUELLE NRO. 472 DPTO. 401 C.R. TORRES DE LIMATAMBO	987-829051
2898	JIMENEZ CHAVARRIA EUGENIO FAUSTO	10068397346	MZA. A2 LOTE. 05 A.H. MANCO INCA (PAR MANCO INCA AV. TUPAC AMARU KM 7.	525-5635
2899	JIMENEZ GARCIA MARIA ELENA	10277317678	CAL. HUAMANTANGA NRO. 1634 SECTOR PUEBLO NUEVO CAJAMARCA - JAEN - JAEN	0
2900	JOHANNA LIDIAN HERNANDEZ OBLITAS	10408887254	CALLE MATIER N?? 778	424-4387
2901	JOHNSON - LUCY JEAN	10409091089	JR. TRINIDAD NRO. 187 BR SAN ANTONIO	0
2902	JORDAN VELA JAVIER GUSTAVO	10061900913	JR. LOS ROSALES NRO. 384 INT. 2 URB. VILLA JARDIN (2PISO CRUC AV.CANAD	961045770
2903	JORGE PE??A S A JORPESA	20101015492	JR. CHICLAYO 487 B (ALT. CERVECRIA BACKUS Y JHONSON)	482-0290
2904	JULCA CASTA??EDA YESSICA MARIBEL	10429091697	CAL. PEDRO RUIZ NRO. 2112 P.J. SAN ANTONIO (ENTRE PEDRO RUIZ Y HUMBOLT	0
2905	JULI ESPINOZA DORIS CLOTILDE	10447363301	JR. TUPAC YUPANQUI NRO. 267 (A CDRA Y MEDIA DE ADUANAS) PUNO - PUNO -	0
2906	JUNCO RAMOS ESTEFANY ESTRELLA	10448210001	CAL. ATAHUALPA NRO. 1073 (POR EL OVALO DE LA PERLA) PROV. CONST. DEL C	5595804
2907	KAHN GRANDA JAIME JESUS	10103284801	CAL. MOLOCAY NRO. MZF6 INT. LT11 URB. LOS CEDROS DE VILLA (ALT. CDRA 8	2341540
2908	KYBALION GROUP S.A.C.	20477828567	CAL. MIROQUESADA NRO. 247 INT. 505 MIROQUESADA (MIROQUESADA-LAMPA)	2031400
2909	LA COFRADIA CREATIVA S.R.L.	20551395554	CAL. PROLONG. MANCO SEGUNDO NRO. 115 DPTO. 1204 INT. A URB. PANDO (ESP	0
2910	LA ECONOMICA LIDER E.I.R.L.	20508763655	"AV. ""A"" MZA. ""Z"" LOTE 17 URB. SANTO DOMINGO 9NA. ETAPA"	0
2911	LA POSITIVA SEGUROS Y REASEGUROS	20100210909	JAVIER PRADO ESTE Y FCO MASIAS 370	226-3000  -  9836-6117
2912	LA TORRE ROSILLO LENIN YONEL	10444723829	CAL. LOS CIPRECES NRO. 211 URB. LA MOLINA (A 1/2 CUADRA ESQ. MARA??ON Y	0
2913	LABORATORIOS AC FARMA S.A	20347268683	los hornos 110 - urb vulcano - ate	618-4900/3498080
2914	LABORATORIOS AMERICANOS S.A.	20255361695	CAL. SALAVERRY NRO. 419 URB. INDUSTRIAL EL PINO LIMA - LIMA - SAN LUIS	3261515 / 2126022 ANEXO 115
2915	LABORATORIOS INDUQUIMICA S.A.	20101364152	CALLE S. LUCILA 154 URB. V.MARIA	617-6008
2916	LABORATORIOS PORTUGAL S R L	20100204330	CAL. LOS TALLADORES NRO. 402 URB. INDUSTRIAL DEL ARTESANO	4353470
2917	LABORATORIOS UNIDOS S.A.	20417180134	AV. PASO DE LOS ANDES N?? 740	261-8603
2918	LAGUNA TORRES VICTOR ALBERTO	10256216162	JR. JOS?? ANTONIO NRO. 110 URB. PARQUE DE MONTERRICO LIMA - LIMA - LA M	999958818
2919	LAIMITO ALIAGA CELSO OSCAR	10201140345	JR. SANTOS BRAVO NRO. S/N (SECTOR C- 1A CDRA 8 DE AV. BRUNO TERRERO)	980-088710
2920	LANDEO ARAUZO RUTH NOEMI	10462404650	MZA. U-V LOTE. 15 MANCO CAPAC (FTE.COLEG.138 VILLA FLORES) LIMA - LIMA	2531140
2921	LAOS VILLAR IRMA LAURA	10404495718	BL. LEONCIO PRADO MZA. C LOTE. 2 URB. LEONCIO PRADO	0
2922	LAPA AGUILAR NELVA NERY	10477772990	MZA. F LOTE. 16 ASOC. 9 DE DICIEMBRE (1 CDRA DEL ESTADIO CUMANA) AYACU	0
2923	LAPA PINEDA AGUSTINA	10408787560	MZA. A LOTE. 09 ASOC. INGENIERIA (ESPALDAS DE LA UNSCH) AYACUCHO - HUA	0
2924	LARA INFANTE SEGUNDO GUILLERMO	10802627969	AV. HABICH N?? 560-620 URB. INGENIER??A	RPC 991490440
2925	LATFAR S.A.C.	20516289261	JR. JOSE OLAYA NRO. 272 P.J. MICAELA BASTIDAS	421-4373
2926	LAURENTE BENITEZ SONIA	10410943421	CAL. LEON NRO. 120 URB. MAYORAZGO 1RA ET	0
2927	LAVADO GRAOS CONCEPCION ANDRES	10416208641	JR. SIMON BOLIVAR NRO. 1522 PBLO. HUAMACHUCO	971-188159
2928	LAVADO VILLANUEVA EMELDA	10098487757	AV.SAN MARTIN DE PORRES LT.102-109 -102B BLOCK 4 DPTO.501	356-1285 / 980551460
2929	LAYMITO ANDRES VICENTA ESMILA	10069161800	JR. BELISARIO GUTIERREZ NRO. 180 INT. 1PSO URB. SANTA LUZMILA ETAPA 2	0
2930	LAZARTE QUISPE MERY ROXANA	10451105502	MZA. B LOTE. 11 P.J. JESUS NAZARENO AREQUIPA - AREQUIPA - PAUCARPATA	0
2931	LE SHENG INVERSIONES S.A.C.	20514754293	AV. ARENALES NRO. 1798 (ESQUINA DE MANUEL CANDAMO CON ARENALES)	651-6888
2932	LEANDRO ISIDRO PERCY OMAR	10411687959	AV. ARBORIZACI??N MZA. M LOTE. 24A A.H. LAS ALAMEDAS (POR EL AEROPUERTO	0
2933	LEIVA ALFARO SILVIA EUGENIA	10414856646	CAL. MARISCAL SUCRE NRO. 495 CAJAMARCA - HUALGAYOC - BAMBAMARCA	0
2934	LEIVA MALCA GINA LIZSETH	10803409272	CAL. LOS ALHELIES NRO. 390 DPTO. 502 (CRUCE FAUCETT Y VENEZUELA)	0
2935	LEON BERNAOLA MARILYN MARIELLA	10708747691	JR. CALCA NRO. 175 LIMA - LIMA - INDEPENDENCIA	0
2936	LEON LIMA YESSENIA DITHLIN	10466189818	AV. SAN MARTIN DE PORRES ESTE MZA. V1 LOTE. 27 A.H. JUAN PABLO II DE C	0
2937	LEON MENDOZA CARLOS SANTIAGO	10258596931	AV. ALFREDO PALACIOS MZA. E LOTE. 18 A.H. AH EL CARMEN (ALT CDRA 25 AV	0
2938	LEON ORELLANA DEBBYE ELIZABETH	10214604383	MZA. ?? LOTE. 28 C.H. ANGOSTURA II ETAPA (ESPALDA DE LA BODEGA BLANQUIT	0
2939	LEON PLASENCIA OMAR GERARDO	10700803266	PJ. CHICLAYO MZA. C LOTE. 6 SEC. LOS PORTALES DE HUANCHACO LA LIBERTAD	0
2940	LEONARDO GASTELO LISSET VANESSA	10451566569	CAL. ANTISUYO NRO. 1781 INT. A LAMBAYEQUE - CHICLAYO - LA VICTORIA	
2941	LETHMOORE ASOCIADOS S.A.	20554473815	PJ. MACATE NRO. 192 DPTO. 2 URB. CHACRA COLORADA (CUADRA 7 JR. IQUIQUE	0
2942	LEYVA CABRERA MARIA ESTHER	10072397351	PSJE. MARACAIBO 102	2616704
2943	LEYVA SIPAN KARINA DEL PILAR	10158457305	CAL. 5 MZA. L LOTE. 17 INT. B6 URB. LOS PILARES AZULES (ALT CDRA 28 DE	4209620-997010766
2944	LIFETEC SOCIEDAD ANONIMA CERRADA - LIFETEC SAC	20518686250	CAL. LAS GUINDAS MZA. C1 LOTE. 04 URB. CERES 2DA ETAPA LIMA - LIMA - A	3516376
2945	LIMACHI QUISPE EDITH SONIA	10452288848	JR. GONZALES PRADA NRO. 950 BARRIO MANCO CAPAC (ENTRE JR. MARIANO MELG	0
2946	LIMO ANDIA FREDY	10419346212	AV. MARISCAL GAMARRA MZA. D LOTE. 9A URB. SANTA ANA (FRENTE IGLESIA DE	0
2947	LINGAN CUEVA ELIZABETH	10416635868	JR. MIGUEL GRAU NRO. 623	0
2948	LINO PEREZ JHOMNELA PILAR	10462357554	JR. 2 DE MAYO NRO. 1265 INT. 1 (FTE A PSTOS DE PERIODICO ENTRADA A BIL	0
2949	LIZA LOPEZ PERCY MIGUEL	10106035232	AV. PUENTE LLANOS MZA. D LOTE. 22 ASOC.VILLA VITARTE (KM 6.5 DE CARRET	0
2950	LIZARES ARREDONDO FELI	10100700200	MZA. C LOTE. 1 A.H. SAN JOSE (ALT. KM. 36.5 PANAMERICANA NORTE)	979530824
2951	LLALLAHUI VELASQUEZ ANA MARIA	10402650406	AV. LOS INCAS NRO. 213 AYACUCHO - HUAMANGA - SAN JUAN BAUTISTA	
2952	LLANCARI RAMOS DE APOLAYA DANIELA GINA	10435090121	JR. VILLA REAL DE LOS INFANTE MZA. R1 LOTE. 02 URB. LAS LOMAS DE LA MO	0
2953	LLANOS ALBERCA ROSA ARACELLI	10098853435	JR. FELIPE ARIAS MZA. P URB. EL ROSARIO (CRUCE DE UNIVERSITARIA CON SA	0
2954	LLAUCE CHAFLOQUE FLAVIA	10410609768	MZA. I LOTE. 6 P.J. LAS COLINAS DE LAS BRISAS (CERROPON) LAMBAYEQUE -	
2955	LLERENA MENDEZ ANA PAULA FATIMA	10462319938	CAL. MAURICIO SIMONS NRO. 746 URB. LAS QUINTANAS	RPC 964283073
2956	LLIUYACC QUISPE AIDA	10440357305	LA CAMPI??A SECTOR A MZA. H LOTE. 10 A.H. CASA HUERTA LIMA - LIMA - LUR	0
2957	LOAYZA GONZALES JOSE HAROLD	10427987499	JR. CARLOS VALENZUELA NRO. 1097 BARRIO SOLEDAD BAJA (INTER.RAMON CASTI	952985034
2958	LOAYZA RODRIGUEZ ROSARIO MELCHORA	10199224374	AV. BOLOGNESI NRO. 171 URB. JULIO C.TELLO	954836555
2959	LOO ZULOAGA MIRIAM MARGARITA	10408128213	AV. EL SOL NRO. 025 URB. SAN CARLOS LIMA - LIMA - SAN JUAN DE LURIGANC	982623925
2960	LOPEZ CHAPO??AN VIOLETA	10409058553	CAL. MIGUEL GRAU NRO. 676 CERCADO LAMBAYEQUE - LAMBAYEQUE - LAMBAYEQUE	
2961	LOPEZ MORALES CLAUDIA ELISA	10401331889	AV. CARLOS ALBERTO IZAGUIRRE NRO. 710 URB. LAS PALMERAS I ETAPA (FRENT	3691377
2962	LOPEZ NAVARRO ELENA ROCIO	10105290638	JR. RESTAURACION NRO. 401 DPTO. 902	0
2963	LOPEZ PINTO BETZABETH ZARA	10207248326	AV. MCAL. CACERES NRO. 315 URB. VALDIVIEZO (A 2 CDRAS DE CLINICA SAN J	0
2964	LOPEZ ZEGARRA OLGA LISSETH	10445885253	ASOC. LOS DIAMANTES MZ. B LT. 7	0
2965	LORA ZEVALLOS WILLY	10000261900	CALLE DO??A DELMIRA N?? 228 DPTO. 504	961621237
2966	LOYOLA AQUIJE GABRIELA SYLVANNA	10454374326	AV. TUPAC AMARU MZA. A LOTE. 2 (FRENTE AL RESTAURANTE LA CANDELA	0
2967	LOYOLA GARCIA CINTHIA KUSSY	10440835045	JR. LOS JAZMINES MZA. 169 LOTE. 14 BARR VILLON ALTO ANCASH - HUARAZ -	0
2968	LOZANO BAZAN STEPHANIA FIORELLA	10475897396	CAL. 72 MZA. J4 LOTE. 32 URB. EL PINAR	991071646
2969	LOZANO REVOLLAR CARMEN ROSA	10282716742	AV. PERU NRO. 114 (BARRIO LA LIBERTAD) AYACUCHO - HUAMANGA - AYACUCHO	966154851
2970	LUCERO LUCERO YIMER GUSTAVO	10444592023	CAL. SANTA MARTHA NRO. 206 C.P.M. URRUNAGA LAMBAYEQUE - CHICLAYO - JOS	978420390
2971	LUJAN AURIS JULISSA VERONICA	10447468498	MZA. F LOTE. 46 URB. PEDREROS (POR EL MDO MODELO-POR LA CANCHITA) ICA	0
2972	LUJAN FERNANDEZ BETZABEL ROSARIO	10403688814	JR. MARIANO NECOCHEA NRO. 266 INT. 268 URB. HUAQUILLAY (ALT. KM. 12.5	5370284
2973	LUNA TORIBIO ANDREA DEL PILAR	10431343482	AV. INDUSTRIAL NRO. 7031 URB. MESA REDONDA	0
2974	LUPU ZEVALLOS CRISTIN ITALIA	10446092982	HUANACAURE JTO NRO. 985 TAHUANTINSUYO LIMA - LIMA - COMAS	0
2975	LUZQUI??OS VILLEGAS NADIA STEPHANI	10455680102	CAL. TUPAC AMARU NRO. 109 URB. JOSE QUI??ONES LAMBAYEQUE - CHICLAYO - C	
2976	MACEDO VILLEGAS MILAGROS ELIZABETH	10427669161	CAL. GARCILAZO DE LA VEGA NRO. 313 CENTRO JAEN CAJAMARCA - JAEN - JAEN	976464042
2977	MACHACA DIAZ SAYDA VERONICA	10420019519	JR. TAHUANTINSUYO MZA. B LOTE. 02 URB. ALTO RINCONADA (ATRAS DE LA ESC	0
2978	MACHADO ZAMUDIO FRESIA CAROLINA	10460546171	AV. TUPAC AMARU MZA. 29 LOTE. 2 P.J. SAN ANTONIO PEDREGAL ALTO	0
2979	MACRO ASSYSTEMP E.I.R.L.	20550534135	JR. LAS CIDRAS NRO. 1284 URB. LOS JARDINES DE SAN JUAN LIMA - LIMA - S	3747076
2980	MACROPOST LOGISTICS S.A.C	20552588569	PJ. ADAM MEJ??A NRO. 103 INT. 205 LIMA - LIMA - JESUS MARIA	2530419
2981	MADERERA INVICTA S R LTDA	20101353975	AV. EL ZINC 293 URB. INDUSTRIAL INFANTAS	528-1257
2982	MAGALLANES VEGA LOURDES JOHANNA	10444239391	PJ. LOS PINOS NRO. 112 ICA - CHINCHA - CHINCHA ALTA	0
2983	MAGSAMAR INSUMOS S.A.C.	20507764330	AV. URUGUAY NRO. 320 INT. 112 URB. CERCADO LIMA - LIMA - LIMA	3328347
2984	MAGUI??A RAMIREZ PAMELA ROSMERY	10425733929	JR. CANDELARIA VILLAR NRO. 374 BARRIO CENTENARIO OES (2 CDRAS. ANTES D	0
2985	MAITA ROJAS ANALLY FERMINA	10427770180	MZA. O12 LOTE. 03 A.H. HOSPITAL DEL NI??O (ALT. CUADRA 18 AV. PROCECERE	0
2987	MALPARTIDA BLAS KATHERINE JANETH	10730827330	PJ. ROBLES MORALES NRO. S/N URB. ARTURO ROBLES MORALES (A 20 METROS DE	0
2988	MAMANI LAYME NERY NILDA	10456217554	MZA. C LOTE. 5 A.V. DON MAXIMO (PENAL SOCABAYA-FRENTE GRIFO SAN MIGUEL	0
2989	MAMANI MAMANI MARIBEL	10413426524	JR. UBINAS NRO. 466 URB. SAN MARTIN DE PORRAS (A 1 CUADRA DE TERMINAL	0
2990	MAMANI MAMANI YOVANA	10426317473	MZA. I LOTE. 03 ASOC.TEODORO R. PISCO (PARADERO DE RUTA A.-CIUDAD PERD	0
2991	MAMANI PERALTA ENMELI YURIKO	10456633019	MZA. U LOTE. 6 A.V. LAS ROCAS (2 CUADRAS TERMINAL DE BUS CORRECAMINOS)	0
2992	MAMANI PERALTA GISELA	10461849836	MZA. A LOTE. 5 A.H. STA. MONICA (PUCCHUN-COSTADO REST. MANLY) AREQUIPA	0
2993	MAMANI TURPO YULI LISBETH	10451603821	AV. SUCRE NRO. 416 DPTO. 201	966404375
2994	MAMANI VELASQUEZ IVAN CARLOS	10443786274	AV. SIMON BOLIVAR NRO. 1234 BARRIO CESAR VALLEJO PUNO - PUNO - PUNO	0
2995	MAMANI VILCA ROSANIA ELSA	10452941541	CAL. HUAMACHUCO CDA. 5 MZA. K LOTE. 8 COO. ANDRES AVELINO CACERES (A D	0
2996	MANCHEGO LLERENA JORGE MIGUEL	10431915095	AV. OSCAR R BENAVIDES NRO. 510 INT. 15	0
2997	MANCHEGOT PERU S.A.C.	20451535766	AV. JOSE GALVEZ BARRENECHEA NRO. 592 INT. 401 URB. CORPAC (FRENTE AL O	2263239
2998	MANDRILE BALLON DESIRE	10411926881	AV. EL GOLF NRO. 308 URB. MONTERRICO (COSTADO DEL CLUB PETROPERU)	0
2999	MANRIQUE MAMANI LIZETH EVELYN	10439370926	MZA. C LOTE. 4 URB. 3 DE OCTUBRE COMITE 5 AREQUIPA - AREQUIPA - JOSE L	0
3000	MANTARI MURILLO ROSA MARY KARINA	10419308574	AV. ALFONSO UGARTE MZA. 12 Z LOTE. 20A TABLADA DE LURIN (PARADERO 19)	0
3001	MANTILLA SAGASTEGUI JORGE LUIS	10410332804	MIGUEL ANGEL N?? 391	948102700
3002	MAQUERA CHURA BETZY NELLY	10456490994	LAS BEGONIAS MZA. 07 LOTE. 14 URB. AZIRUNI (FRENTE AL MERCADITO DE SAL	0
3003	MARCA LARICO OLGA MAGALY	10005040383	CAL. TACNA NRO. S/N (A 1CASA DEL C.INICIAL)	0
3004	MARCATOMA LLANOS KELY MAYUMY	10418364365	SUCRE NRO. 335 LA LIBERTAD - SANCHEZ CARRION - HUAMACHUCO	
3005	MARCELO FLORES GERALDINE ELIZABETH	10723796232	MZA. Q LOTE. 21 A.H. SAN GENARO LIMA - LIMA - CHORRILLOS	2542088
3006	MARCHENA SANCHEZ CYNTHIA VICTORIA	10444032753	MZA. H' LOTE. 9 URB. LAS BRISAS (II ETAPA	965851040
3007	MARCOS QUISPE MYRIAM PAOLA	10100248048	JR. JOSE MANUEL ITURREGUI NRO. 510 (ENTRE ANGAMOS Y REPUBLICA DE PANAM	0
3008	MARIN DEL AGUILA ERICK JAVIER	10419263899	JR. SANTA IN??S N?? 462	0
3009	MARQUEZ TEMOCHE MARYURIE GISELLA	10453087013	CAL. AMAZONAS NRO. 1023 (COLEGIO JOSE MARIA ESCRIV?? DE BALAGUER) PIURA	0
3010	MARQUINA ARAUJO DEYSY ELYTA	10448647876	PJ. EL TUNANTE LOTE. 15 A.H. 10 DE JULIO (A 2 CDRAS. DEL ESTADIO	0
3011	MARTINEZ ALCA LUIS ALBERTO	10422484979	CAL. MANUEL CANDAMO NRO. 128 (COSTADO DEL HOSPITAL)	9976-45585
3012	MARTINEZ BENAVENTE YANH CARLOS	10410688277	AV. 28 DE JULIO NRO. 340	0
3013	MARTINEZ ORDINOLA CARLA	10456752620	JR. RAUL PORRAS BARRENECHEA NRO. 2115 DPTO. 202	955312240
3014	MARTINEZ SANCHEZ BETTY ELIZABETH	10447298401	JR. CARLOS LAGOMERCINDO NRO. 236 CAJAMARCA - CHOTA - CHOTA	
3015	MARTINEZ ZEVALLOS JOSE ANTONIO	10077577373	JR. TARAPACA NRO. 424 URB. OYAGUE	3461415
3016	MASIAS CANDIA EMMA LUZ	10410383280	CAL. NATIVIDAD MZA. T LOTE. 12 URB. TTIO (A 2CDRAS DE CAPILLA 3ER PARA	0
3017	MASIAS QUISPE BETZABE	10411990121	PJ. JAVIER HERAUD MZA. T1 LOTE. 15 URB. TTIO (ENTRE EL TERCER Y CUARTO	956611011
3018	MASTER MEDIC EQUIPMENT S.R.L.	20546757472	AV. BENAVIDES NRO. 1238 DPTO. 1002	4460496
3019	MASTER TECNOLOGIES E.I.R.L.	20522496864	JR. EL CHACO NRO. 2228 (AV PERU CDRA 22 ESPALDA CINE JUNIN)	568-1147
3020	MATOS CASTRO DIEGO ENRIQUE	10741473998	CAL. TORRICELI NRO. 195 DPTO. 201 URB. SAN BORJA (CRUCE LAS ARTES SUR	593-5487
3021	MAURICIO ALTAMIRANO JORGE BRIYAN	10468740058	CAL. PIMENTEL NRO. 351 URB. SAN FELIPE 2DA ETAPA	543-0581
3022	MAYANGA ARROYO JULIO	10174233310	NRO. S-N CAS. TAMBO REAL -BATAN GRANDE (PASANDO CASERIO LA ZARANDA) LA	979822592
3023	MAYTA QUISPE KETTLYN	10428742392	AV. ISABEL LA CATOLICA NRO. 1579 INT. 316 (PISO 3 TDA 316-GAMARRA)	324-5205
3024	MEDICA DEL PACIFICO S.R.L.	20168548916	AV. DOS DE MAYO NRO. 1502 INT. 603	4402990 / 4211770
3025	MEDIFARMA S A	20100018625	CAL. ECUADOR 787	3326200
3026	MEDINA CABEZUDO DIANA CAROLINA	10448297115	PJ. MARTINEZ NRO. 105 CP CAMANA (FRENTE AL HOSPITAL) AREQUIPA - CAMANA	0
3027	MEDINA COLLANTES LEONEL ANTONIO	10802828662	CAL. ELIAS IPINCE NRO. 156 (2DO PISO	972914-204
3028	MEDINA HIJAR LIZETH BERENICE	10463962150	MZA. 171A LOTE. 6 A.H. SAN MARTIN DE PORRES (AV. HUANDOY CON AV. A)	0
3029	MEDINA LUCERO NOEMINA ELVIRA	10408240960	AV. DOS DE MAYO NRO. 1779 A.H. DOS DE MAYO	0
3030	MEDINA NAUPARI ELEOTT ULISES	10106472110	JR. VALENTIN ESPEJO NRO. 211 URB. SAN JUAN (ALT TELEFONICA DE SAN JUAN	9971-44064
3031	MEDINA QUISURCO JANY DEL ROSARIO	10400612078	JR. GERARDO DIANDERAS NRO. 2482 CONDEVILLA	567-3749 / 949382061
3032	MEDINA SUNCION STALYN FERNANDO	10704771156	URBANIZACION BANCARIOS MZA. C LOTE. 8 URB. BANCARIOS 2 ETAPA	0
3033	MEDRANO GAGO EDSEL YANELA	10447626158	MZA. 126A LOTE. 15 A.H. ENRIQUE MILLA OCHOA (AV.CENTRAL CON ENRIQUE MI	0
3034	MEDRANO RIVERA TONY	10425560641	CONDOMINIO CIUDAD NUEVA - URB. SAN JUAN MASIAS TORRE II-706	RPM 973998006
3035	MEDROCK CORPORATION SOCIEDAD ANONIMA CERRADA	20514710911	AV. BOLIVAR NRO. 795 LIMA - LIMA - PUEBLO LIBRE	261-4477/261-4503
3036	MEGO REBAZA NATALI VANESA	10436651398	MZA. C LOTE. 12 URB. LAS CAPULLANAS	0
3037	MEJIA TARAZONA EDWARD MICHAEL	10099347517	JR. ICA NRO. 759 DPTO. 201	731-3387
3038	MELGAREJO OCHOA ANGEL QUIRINO	10732515742	JR. RIVERO MANUEL NRO. 241 URB. PANAMERICANA NORTE LIMA - LIMA - LOS O	0
3039	MEMBRILLO OCAS YOVANA GISELA	10450481934	MZA. A LOTE. 42 CPM TARTAR I (ESPALDAS DE INIA) CAJAMARCA - CAJAMARCA	
3040	MENA RAMIREZ MARCO ANTONIO	10098608414	AV. UNIVERSITARIA NRO. 857 DPTO. 502	942-749986 / 983-453715
3041	MENA RUIZ JESSICA DEL MILAGRO	10401459231	CAR. PANAMERICANA MZA. B LOTE. 07 A.H. LOS ALMENDROS (A DOS CUADRAS DE	0
3042	MEND.GROUP E.I.R.L.	20519256887	MZA. H LOTE. 29 URB. LOS JAZMINES 3RA ETAPA PROV. CONST. DEL CALLAO	4845449
3043	MENDIETA OCHOA JUAN EMILIO	10768193989	MZA. A LOTE. 04 ASOC PROP LOS PARRALES (ALT DE LA POSTA MEDICA) LIMA -	992787660
3044	MENDOZA CASTA??EDA EMILY MELISSA	10438250153	MZA. 12 LOTE. 38 URB. NICOLAS GARATEA ANCASH - SANTA - NUEVO CHIMBOTE	0
3045	MENDOZA CASTILLO MAGALY CRISTINA	10166487400	NRO. C INT. 48 URB. SIETE DE AGOSTO (AL COSTADO CLINICA SAN JUAN DE DI	0
3046	MENDOZA FLORES OMARA OGMEF LIA KEYSHI	10705094239	CAL. JUNIN NRO. 607 (FTE AL POLIDEPORTIVO ROSA VARGAS DE PANI) ICA - I	0
3047	MENDOZA LAREDO FLOR VERONICA	10416213114	MZA. N LOTE. 13 URB. EL SATELIT	0
3048	MENDOZA SALDA??A MARIA FLORENCIA	10409810786	JR. FEDERICO VILLAREAL NRO. SN (CUADRA 7)	0
3049	MENDOZA VILLANUEVA JUDITH BEATRIZ	10081109783	CAL. RIVERA NRO. 110 URB. HUASCARAN	0
3050	MENGOA CASTA??EDA HELEN MARGIORI	10408576607	AV. CANTA CALLAO S/N COND. CIUDAD NUEVA	0
3051	MERE BURGA GUIDO ANTONIO	10452250085	JR. TACNA N?? 993 DPTO. 804	965966552
3052	MEZA CASTRO MARITA IRENE JOVITA	10700219912	CAL. J.BUSTAMANTE NRO. 258 U.PO.CONDEVILLA DEL SE??OR LIMA - LIMA - SAN	5673041
3053	MEZA PABLO SANDRA MARYLIN	10430100811	AV. 28 DE JULIO NRO. 1314 BARRIO SOLEDAD ALTA (FRENTE AL COLEGIO JEAN	0
3054	MEZA VILCA YESIKA MARTHA	10247194016	NRO. B 23 URB. UVIMA II (FRENTE AL UNICO TELEFONO PUBLICO) CUSCO - CUS	0
3055	MIGUEL REYNA JACKELINE	10405952322	CAL. BOLIVAR NRO. 513 (ENTRE YAVARI Y TAVARA)	065-222497 / 954108619
3056	MINAYA LEON PERCY LUIS	10254958781	BL. 37 NRO. S/N DPTO. 804 RES. SAN FELIPE (CLINICA SAN FELIPE)	01-4622731
3057	MINISTERIO DE JUSTICIA Y DERECHOS HUMANOS	20131371617	CALLE SCIPION  LLONA 350 M??DULO 14	422-7804  /  440-4310
3058	MI??ANO MONTES ROSA HAYDEE	10161660341	AV. JUAN DE ALIAGA N?? 436	985865306
3059	MI??ANO SANCHEZ MARITZA RAQUEL	10434765621	CAL. REFORMA NRO. 10 CAP LAREDO LA LIBERTAD - TRUJILLO - LAREDO	0
3060	MIRANDA GARCIA MARICARMEN SCARLY	10464001099	SECTOR 8 MZA. A LOTE. 14 C.H. DEAN VALDIVIA ( ENACE) AREQUIPA - AREQUI	0
3061	MIRANDA YARANGA MAYRA ELISA	10414018616	URB. NOSIGLIA II PSJE. 3 N?? 146	993231272
3062	MISPIRETA LOLI SERGIO RICARDO	10102871851	CAL. GRAL. CLEMENT NRO. 1364 (ALT CD 13 DE LA AV LA MAR)	0
3063	MOGROVEJO BARRERA ANTONIO BERNARDO	10414531143	AV. BRASIL NRO. 3774	0
3064	MOLANO CHAVEZ TERESA NATALIA	10765373293	MZA. A LOTE. 2 A.H. 1RO DE NOVIEMBRE (FRENTE A SANTA ISABEL) LIMA - LI	0
3065	MOLINA GAVILAN LUCIA ISABEL	10412012068	CAL. PEDRO PENAGOS MZA. E LOTE. 7 URB. SAN ISIDRO (A 1CDRA DEL CENTRO	0
3066	MOLINA NEYRA KARINA LIZETH	10441624943	JR. LEONCIO PRADO NRO. 260 BARRIO SANTA ROSA PUNO - PUNO - PUNO	0
3067	MOLINA ROJAS ELIZABETH JUDITH	10416051998	JR. LIBERTAD NRO. 723 LIMA - LIMA - MAGDALENA DEL MAR	959974774
3068	MONDRAGON SUXE LADY	10458367260	JR. CENTRAL NRO. 503 C.P.M LLATA (A UNA CUADRA DEL INST. SUP. PED. LLA	0
3069	MONJA TINEO MILAGROS DEL PILAR	10454074373	MZA. F LOTE. 13 P.J. JORGE BASADRE (A ESPALDAS DE ALICORP) LAMBAYEQUE	950614735
3070	MONTALVAN HERNANDEZ DENISSE LISSETH	10406048905	AV. MORALES DUAREZ NRO. 2851 MIRONES BAJO (CRUCE CON AV. UNIVERSITARIA	0
3071	MONTENEGRO ALARCON FLOR DE LIZ	10335926710	JR. SANTO DOMINGO NRO. 139 (BARRIO LUYA URCO)	0
3072	MONTEROLA MEDINA DAMARIS SANDRA	10460381563	CAL. M. G. PRADA NRO. 401 P.J. EL CARMEN (PDO LA PASCANA 5 CDRAS PARA	0
3073	MONTES CARLOS FAVIOLA	10100324020	JR. LAS ESMERALDAS NRO. 945 P.J. EL BRILLANTE LIMA - LIMA - SAN JUAN D	0
3074	MONTES HUAMAN JULIA ANGELICA	10107198844	JR. JULIO C. TELLO NRO. 1235 URB. COVIDA 2DA ETAPA	0
3075	MONTES LAUREANO JAVIER JAIME	10421199090	0	0
3076	MONTEZA GONZALES JANETH ELIZABETH	10459981581	CAL. RICHARD GORDON NRO. 340 C.P. URRUNAGA IV SECTOR LAMBAYEQUE - CHIC	0
3077	MONZON OTINIANO JOSE JESUS	10456302349	CAL. AMAZONAS NRO. 390 INT. 3 URB. EL MOLINO	948186802
3078	MORALES ATOCHE JULIANA DEL PILAR	10429587854	MZA. E LOTE. 14-A A.H. JOSE OLAYA PIURA - PIURA - PIURA	0
3079	MORALES AVALOS ANA MARIA	10224037452	JR. SAN LUIS GONZAGA NRO. 171 PAUCARBAMBA HUANUCO - HUANUCO - AMARILIS	4331047
3080	MORALES MAGUI??A LUCIA MELCHORA	10258175943	CAL. LAS ESMERALDAS NRO. 184 URB. SAN ANTONIO PROV. CONST. DEL CALLAO	0
3081	MORALES NOLASCO NOR MARIBEL	10407635171	MZA. C LOTE. 04 ASOC LOS MECANICOS AYACUCHO - HUAMANGA - JESUS NAZAREN	0
3082	MORANTE QUIROZ MARJOIRIE ALDANA	10704874401	CAL. ANTONIO POLO NRO. 367 (ALT. CDRA 21 AV BRASIL) LIMA - LIMA - PUEB	9831150733
3083	MORE REYES JANETT ABIGAIL	10466155883	CAL. LOS TULIPANES MZA. LL LOTE. 20 URB. SANTA MARIA DEL PINAR	0
3084	MORENO EUSTAQUIO JAIME	10178076782	AV. PETIT THUOARS 1507-405	975692131
3085	MORENO VASQUEZ ELIANA VANESSA	10445305800	AV. PABLO CASALS NRO. 336 URB. MOCHICA	0
3086	MORILLO PEREYRA BRIGITTE NATALIE	10460477951	MZA. 74 LOTE. 30 NICOLAS GARATEA (FRENTE AL MERCADO SANTA ROSA)	0
3087	MOSQUERA CURITIMA ERIKA	10410419241	JR. AGUSTIN CAUPER NRO. 353 (HOSPITAL REGIONAL)	0
3088	MOSQUERA LEIVA CARLOS ENRIQUE	10084721625	JR. JOSE OLAYA NRO. 1179 PROV. CONST. DEL CALLAO - PROV. CONST. DEL CA	2612043
3089	MOTTA RODRIGUEZ LILIANA ELIZABETH	10430465746	JR. SAN GREGORIO MZA. Q LOTE. 18 URB. SAN DIEGO 2DA ETAPA	0
3090	MOYA ZAVALETA JIMMY CARLOS	10403284039	JR. GAMARRA N??613 - INT. 306 - LA VICTORIA	4326078 / 986609300 / 946270752
3091	MR KUVIC E.I.R.L.	20552707169	 Av. Uruguay Nro. 483 Int. 5 (Esp. del Colegio Ntra. Sra. de Guadalupe	674-7425
3092	MUCHAYPI??A VIVANCO JADY LAURA	10406011980	PJ. R MZA. B LOTE. 12 ASOC SANTO DOMINGO LIMA - LIMA - ATE	5832-818
3093	MULANOVICH LARRABURE GABRIEL	10416473451	AV LAS ARTES NORTE 634-SAN BORJA	987717008
3094	MULTIMUEBLES MONTERO SOCIEDAD ANONIMA CERRADA - MULTIMUEBLES MONTERO S.A.C.	20549245855	JR. MENDOZA MERINO NRO. 874 LIMA - LIMA - LA VICTORIA	4231224
3095	MULTIOFICINA S.R.L.	20471654079	AV. LAS FLORES N?? 220	388-9525
3096	MULTISERVICIOS GABRIELA E.I.R.L.	20452268834	JR. BELLIDO NRO. 530	(066) 966657011/ (066) - 319636
3097	MUNDACA NU??EZ JUAN ANTONIO	10174403215	CALLE MOLOKAY MZ. F6 LOTE 11	999991655
3098	MU??OZ AVILA EDGAR GUILLERMO	10002379789	MZA. A' LOTE. 10 A.H. ANDR??S A. C??CERES 2DA ET.	0
3099	MU??OZ ROSADA OLINDA	10024396296	JR. TUPAC AMARU NRO. 228 PUNO - SAN ROMAN - JULIACA	0
3100	MURGADO BLAS RICARDO ESTEBAN	10416470958	JR. RESTAURACION 540 NRO. 101 - BRE??A	97399458
3101	MURILLO CHUQUIVILCA ELISA	10098990785	JR. FELIX DEL VALLE NO. 424. - S.M.DE PORRES	
3102	MURILLO PE??A JUAN PABLO	10067222135	AV. SAN FELIPE NRO. 647 INT. 1502 (TORRE B)	4612665 / 999746449
3103	MURILLO RIOS KASSANDRA LUCERO	10727292794	MZ. L LT. 22 SAN PABLO	984184992
3104	NEYRA HERRERA SARELA	10437969251	CAL. LOS CLAVELES-1MER PISO NRO. 225 URB. SAN LORENZO (POR EL HOSTAL L	0
3105	NICHO RAMOS MAYRA GERALDINE	10445413581	CAL. J MZA. X LOTE. 17 ASOC PRO. LOS INCAS	0
3106	NI??O DE GUZMAN SISNIEGUES SILVIA LOURDES	10061430313	JR. ENRIQUE BARRON 1125 DPTO. 202	998095814
3107	NIVIN PARIAMACHI JANY JENIFER	10462119190	MZA. L LOTE. 22 E4L HEROE MCAL LUZURIA	0
3108	NOLE ALARCON DERY ARNALDO	10476025813	CAL. VICTOR CRIADO NRO. 2666 LIMA - LIMA - LIMA	2489434
3109	NOMEROS ORE MARIA JULIA	10210003008	AV. PEDRO DE LA GASCA NRO. 1096 P.J. EL CARMEN (ALT.AV.BELAUNDE CUADRA	0
3110	NORDIC PHARMACEUTICAL COMPANY S.A.C	20503794692	JR. PATRICIO IRIARTE 279 SANTA CATALINA	471-6076
3111	NORE??A MARTEL EDITH CARMEN	10225052561	JR. DANIEL A CARRION NRO. 115 PAUCARBAMBA	0
3112	NUNURA TOCTO ANA SOCORRO	10445302622	AV. NN MZA. B LOTE. 16 URB. IGNACIO MERINO ETAPA I (POR EL HOTEL GOLDE	0
3113	NU??EZ CULQUI MILAGROS SOFIA	10426997733	ESTOCOLMO MZA. Z-1 LOTE. 15 PORT J. PRADO (ALT DEL GRIFO VISTA ALEGRE	0
3114	NU??EZ GUERRERO ROSA KATHERINE	10446530700	CAR. CENTRAL KM. 14.5 LOTE. 51 (A 2 CDRAS ANTES DEL GRIFO STA CLARA	0
3115	NU??EZ ROBLES MARIA ELOISA	10225131347	CAL. PALMA REAL NRO. 115 URB. CAMACHO (AL FRENTE DEL COLEGI WALFOR	436-1837
3116	??AUPARI RUIZ TERESA CATHERINE	10106942345	AV. CORDILLERA ORIENTAL MZA. C1 LOTE. 08A DELICIAS DE VILLA 2DA ZON	0
3117	OBREGON QUISPE NELIDA NOEMI	10416095545	CAL. GUSTAVO VALCARCEL 221 MZA. K LOTE. 2 P.J. 4 DE OCTUBRE	987306079
3118	OCON TORRES JACKELINE CELIA	10459082242	JR. FERROCARRIL MZA. K3 LOTE. 7A IZCUCHACA (ENTRADA DEL CENTRO DE SALU	982723691
3119	OFIS IMPRESSER SAC	20508864923	CAL. 7 MZA. Q LOTE. 13 URB. SAN CARLOS	354-4759
3120	OJEDA MU??ANTE DE HUACASI ROCIO ENCARNACION	10081264495	CAL. TOBIAS MEYER MZA. L LOTE. 63 URB. EL PACIFICO (ALTURA CDRA 30 AV	0
3121	OLARTE CASTRO GLEDIA	10456031302	JR. HUANCAVELICA NRO. SN VILLA LA LIBERTAD	0
3122	OLVA COURIER S.A.C	20100686814	AV. ARENALES 1755	714-0909
3123	OPEN MEDIC S.A.C.	20524232104	CAL. MILTON NUMASON MZA. U LOTE. 1 URB. EL PACIFICO ET.2	531-2514
3124	ORDO??EZ CABELLOS MARY DE FATIMA	10806397071	CAL. LA PERLA NRO. 501 URB. SANTA INES	0
3125	ORE OSORIO JULIA FELICITA	10085361568	JR. LAMBAYEQUE NRO. 3717 INT. 2PIS URB. PERU	0
3126	OREGON ANTEZANA PATRICIA ROSA	10081666305	AV. CARLOS VALDERRAMA NRO. 457	565-7507
3127	ORELLANA ROMO GIULIANA HANNY	10215453371	AV. PETIT THOUARS NRO. 4470 DPTO. 401 (ALTURA CUADRA 41 AV.AREQUIPA)	0
3128	ORIHUELA COTERA MARLENE PILAR	10212843208	MZA. P LOTE. 37 CTO POBLADO VILLA RICA-E1 (ALT KM 18 CARRET CENTRAL-PA	0
3129	ORME??O ALBURQUEQUE GIULIANA MELISSA	10423682715	JR. GENERAL VARELA NRO. 1230 DPTO. 304 (ALT. CDRA 4 AV. ARICA	0
3130	ORTIZ ALIAGA CINTIA JANETH	10450686986	CAL. 15 MZA. X LOTE. 06 URB. EL ALAMO (CRUCE TOMAS VALLE CON PACASMAYO	0
3131	ORTIZ MORON HECTOR CESAR	10440974053	AV. LOS PARACAS NRO. 612 URB. SALAMANCA	992172403
3132	OSCO CHAMORRO EDITH MIRIAM	10437449959	MZA. A LOTE. 13 PROVIV. BAHIA BLANCA DE O PROV. CONST. DEL CALLAO	0
3133	OSTOS JARA BERNARDO ELVIS	10091606254	CAL. JOSE MARIA SERT NRO. 185 URB. SAN BORJA NORTE LIMA - LIMA - SAN B	996629443
3134	OTOYA MOYA CARLOS AUGUSTO	10027882370	BL. BLOCK NRO. 11A INT. 02 RES. ANAGAMOS (2 ETAPA-DPTO 2-EDIF. BLANCO-	073-327376
3135	OVIEDO ORELLANA MILAGROS ROSARIO	10199065829	AV. LOS LIBERTADORES MZA. P LOTE. 15 LIMA - LIMA - SAN MARTIN DE PORRE	995232409
3136	PACHECO IZQUIERDO KELLY JOANNE	10455173782	MZA. A?? LOTE. 5 A.H. ANDRES A. CACERES (ALT. DEPOSITO MUNICIPAL PUYANG	0
3137	PACHECO SANCHEZ DAYSI KAROL	10418531822	MZA. A LOTE. 20 SECTOR 2, GRUPO 4 (ALTURA DE PARADERO CUAVES) LIMA - L	981512321
3138	PACOSH BLAS LOURDES PAMELA	10406088681	PJ. LA ORQUIDEAS MZA. 16 LOTE. 2 PVU EL CARMEN ANCASH - SANTA - CHIMBO	0
3139	PALACIOS ARECHAGA DE AGURTO CARMEN MELISA	10418617247	MZA. G LOTE. 20 A.H. ALM MIGUEL GRAU 1 ETAPA PIURA - PIURA - PIURA	0
3140	PALACIOS MARTINEZ CARMEN MARIA MERCEDES	10104311836	MZA. G2 LOTE. 38 URB. SANTA LUZMILA (CDRA.64 AV.GERARDO UNGER-COMISARI	0
3141	PALOMINO AGUILAR DE GONZALES ELVIRA	10013428587	JR. RIVERA DEL MAR NRO. 171 BRR. RICARDO PALMA PUNO - PUNO - PUNO	0
3142	PALOMINO ESPINOZA EDER YAMILL	10425291110	JR. LAS ANEMONAS NRO. 1017 URB. LAS FLORES DE LIMA (ESP. ROKYS DE LAS	9979-17877
3143	PALOMINO JARA GUISELA MERCEDES	10420457958	CAL. SAN ERNESTO NRO. 6253 URB. STA.LUISA (ALT.GRIFO LAS VEGAS) LIMA -	0
3144	PALOMINO REYNAGA MARIBEL EUFEMIA	10409653559	CAL. LOS CIPRESES MZA. A LOTE. 33 ASOC RESID VILLA SULLANA	0
3145	PALOMINO TARAZONA LIZ CLARA	10700422726	MZA. H LOTE. 12 A.H. LETICIA (ESPALDA DE POTAO) LIMA - LIMA - RIMAC	5791062
3146	PALOMINO TOSCANO KATIA CAROL	10704325911	AV. ENRIQUE MEIGGS MZA. E LOTE. 21 P.J. MIRONES BAJOS (ES PJ ANTONIO L	3361528
3147	PANDURO SAAVEDRA EYDER	10417459249	JR. LETICIA NRO. 220	0
3148	PANDURO VILLANUEVA LESLY JOSELINE	10443796261	JR. COLONIAL NRO. 414 (A 1 CDRA DEL C.S SHOWING FERRARI)	0
3149	PAQUIYAURI CANCHO CATALINA	10403536399	CAL. SIN NOMBRE MZA. D LOTE. 24 URB. EX-FUNDO BUENA VISTA LIMA - LIMA	990228845
3150	PAREDES JARA ANA LUCILA	10434837532	AV. RICARDO PALMA NRO. 684 URB. SANTO DOMINGUITO	0
3151	PARI APAZA YOLANDA	10430048410	JR. LOS LIBERTADORES NRO. 521 URB. HORACIO ZEVALLOS (A 2 CDRS DE LA AV	0
3152	PARI HILASACA WILLAM ARTURO	10068105213	MZ. H1 LT. 9 VIRGEN DEL CARMEN NA??A	952255734
3153	PARRAGUEZ MONTENEGRO LEIPZIG DEL CARMEN	10452158910	CAL. HUASCAR NRO. 1381 A.H. C. PARRAGUEZ	0
3154	PASTOR BRIZZOLESE SUSANA JUDITH	10077691885	CAL. TARAPACA NRO. 142 INT. 4 (ESPALDA DE REST. MANOS MORENAS) LIMA -	998587928
3155	PASTOR TAPIA VICTOR JOSE	10700284935	AV. PAZ SOLDAN NRO. 263 URB. CONDEVILLA (ALT.CDRA.30 JOSE GRANDA) LIMA	0
3156	PATRICIO CENTENO LUIS ALBERTO	10441480119	AV. LOS EUCALIPTOS NRO. 166 URB. LAS VIOLETA (FRENTE DE PLAZA NORTE)	0
3157	PAZ GRADOS LINDER PAUL	10100693432	CAL. ERNESTO MALINOWSKI NRO. 388 CH.RIOS SUR (ALT CDRA 16 AV TINGO MAR	958792698
3158	PE??A ROMAN JHAJHAIRA PAOLA	10462743772	MZA. V LOTE. 13 INT. 01 A.H. LOS ALGARROBOS 1 ETAPA PIURA - PIURA - PI	0
3159	PE??ARANDA CUADROS MARIA ANGELA	10099362982	CALLE JOSE URDANIVIA GINES MZA. N3 LOTE. 03 URB. JAVIER PRADO	4372077 / 989323213 / 989583956
3160	PEQUE??O GONZALES MARIO ALEXANDER	10476358766	CAL. 5E MZA. F LOTE. 22 URB. SAN EULOGIO LIMA - LIMA - COMAS	6053262
3161	PEREDA DISTRIBUIDORES S R L	20136961528	AV. MRSCAL. LA MAR NRO. 318	441-3778
3162	PEREDA PASQUEL MARIA LUZ	10424842741	JR. JHON F. KENEDY MZA. A LOTE. 2 A.H. ESPERANZA BAJA ANCASH - SANTA -	0
3163	PEREZ CARO EVELYN SUSANA	10456775751	AV. ATAHUALPA NRO. 117 CAJAMARCA - CAJAMARCA - CAJAMARCA	0
3164	PEREZ CHINGO FERNANDO	10413548328	JR. SAENZ PE??A NRO. 445	0
3165	PEREZ CISNEROS ROBINSON GERARDO	10424652241	JR. 9 DE DICIEMBRE NRO. 412	966-022966
3166	PEREZ GUEVARA DEYSI	10420687244	AV. MESONES MURO NRO. 625 SEC. MORRO SOLAR CAJAMARCA - JAEN - JAEN	0
3167	PEREZ MORENO JOSE LUIS	10181379541	AV. ALAMEDA DEL CORREGIDOR N?? 2071 URB. LA CAPILLA	9446-28999
3168	PEREZ PAUCARCHUCO JENNY LUCY	10433127981	PROL. BOLOGNESI MZA. D1 LOTE. 9 PBLO PUCARA (A 1/2CDRA DESPUES DEL PAR	0
3169	PEREZ QUISPE OSCAR FREDY	10178679932	AV. TOMAS VALLE 1530 BLQ 2 NRO. 1530 DPTO. 202 LIMA - LIMA - LOS OLIVO	985791554
3170	PEREZ SOLORZANO CYNTHIA MILAGROS	10422050235	MZA. B24 LOTE. 8 URB. 21 DE ABRIL ANCASH - SANTA - CHIMBOTE	0
3171	PERULAB SA	20300795821	AV. SANTA ROSA NRO. 350 LIMA - LIMA - SANTA ANITA	6269090
3172	PETRERA PAVONE MARGARITA MARIA	10072068276	CAL. LOS CEDROS NRO. 727 DPTO. 602 (TORRE 2)	0
3173	PEZO PINEDO GISSELA DEL PILAR	10054044823	CAL. SANTA NICERATA NRO. 514 URB. SANTA EMMA LIMA - LIMA - LIMA	5645966
3174	PEZO RODRIGUEZ OLINDA BEATRIZ	10431639217	JR. ROSA MERINO MZA. I LOTE. 9 A.H. TUPAC AMARU	0
3175	PHARMAGEN S.A.C.	20478224169	AV. INDUSTRIAL NRO. 160 URB. LA AURORA LIMA - LIMA - ATE	3267200
3176	PHYMED SRLTDA	20335599251	CAL. LOS ANTARES NRO. 255 INT. 5 URB. LA ALBORADA	271-9859
3177	PINCO CONDORI YASMINA CARINA	10456459736	MZA. C LOTE. 12 A.H. V.EL SALVADOR GR. 16 (ALT. MARIATEGUI CON REVOLUC	0
3178	PINEDO ROJAS YAZMIN DEL CARMEN	10443373387	MZA. K LOTE. 20 URB. AYACUCHO LIMA - LIMA - SAN JUAN DE LURIGANCHO	0
3179	PINELO ALAMO CLAUDIA CECILIA	10446182906	CAL. CASTRO SILVA NRO. 184 PIURA - SULLANA - BELLAVISTA	0
3180	PINTO CARRANZA HELLEY TATIANA	10454356255	CAL. MANCO CAPAC MZA. G LOTE. 5 A.H. GALPONCILLO	0
3181	PINTO SANCHEZ CRISTHIAN OMAR	10706034868	MZA. S LOTE. 10 A.H. LUIS F. DE LAS CASAS	951993757
3182	PINTO SILVESTRE MILAGROS JOSEFINA	10724539977	JR. CALLAO NRO. 434 INT. PS 2	980465571
3183	PLAZA EVENTOS S.A.	20508091371	CAL. LA VENDIMIA NRO. 168 URB. LA TALANA (CDRA.10-11 AV.CASTILLA, FREN	272-0464
3184	POMA SALINAS EMMA RUTH	10199140405	AV. MANCHEGO MU??OZ N?? 458 DEL BARRIO DE SANTA ANA	0
3185	PONCE ESTELA RAQUEL ROXANA	10701527165	CAL. MS CARVAJAL NRO. 371 DPTO. 401 (TOMAS VALLE CON BERTELLO) PROV. C	982055517
3186	PONGO CHOTON GABRIELA MARIA	10462407721	AV. ESPA??A NRO. 2496 CERCADO TRUJILLO LA LIBERTAD - TRUJILLO - TRUJILL	
3187	PORTOCARRERO OLANO JUAN JOSE	10404310076	AV. CRLOS A. IZAGUIRRE NRO. 1327 URB. PALMAS REALES (A TRES CDRAS DE A	9870-13600
3188	POZO QUISPE CARMEN SOLEDAD	10102792748	CAL. S/N MZA. E LOTE. 11 14.6 HECTAREAS (ESPALDA CEMENTERIO DEL CALLAO	0
3189	POZO SOLIS YOLY	10097721691	AV. GRAL. VIVANCO NRO. 958 DPTO. 202B C.H. CONDOMINIO VIVANCO (AL LADO	0
3190	PRIETO RIVAS JOSE LUIS	10429782223	JR. SUYO NRO. 460 PIURA - PIURA - TAMBO GRANDE	0
3191	PRINCIPE DURAND DIRSEU HARRINSON	10465824552	JR. PENSILVANIA MZ. B LT. 10 URB. LAS VEGAS	999604099
3192	PRISMA COMUNICACIONES S.R.L.	20510000481	AV. JOSE PARDO NRO. 257 INT. 1501 (A 2 CDRAS DEL OVALO DE MIRAFLORES)	4451248
3193	PRODUCCIONES GENESIS S.A.C.	20293877964	JR. ANTONIO MIROQUESADA No. 376 - Of. 407	4265631
3194	PRODUCTOS DE PERU E.I.R.L.	20478124377	CAL. PABLO NERUDA NRO. 176 DPTO. 101 URB. COVIMA (A 2CDRAS. DE HOSPITA	624048
3195	PRODUCTOS YULI DEL PERU S.A.C.	20502739540	AV. ALEJANDRO TIRADO NRO. 706 URB. SANTA BEATRIZ	726-8718
3196	PROMED E.I.R.L.	20101267386	AV. GREGORIO ESCOBEDO 776 - 778	463-5287  /  463-8409  /  463-3497
3197	PROSAC S.A.	20167884491	calle san Ignacio de Loyola N?? 271	617-1212
3198	PROTECH DEL PERU S.A.C	20520714457	AV. ELMER FAUCETT NRO. 1663 URB. JARDINES VIRU PROV. CONST. DEL CALLAO	4640619
3199	PROVEEDORES TEXTILES MULTISERVICIOS E INVERSIONES S.A.C	20451730461	AV. UNIVERSITARIA MZA. E 2 LOTE. 04 URB. SAN CARLOS (ENTRE LA AV UNIVE	527-8242
3200	PROVERSAL SRL	20123751664	JR. PEDRO RUIZ 611 URB. SAN GREGORIO (ALT OVALO SHELL) LIMA LIMA BRE??A	425-0591  3321344
3201	PUICON PURIZACA CESAR EDUARDO	10433142964	CAL. DANIEL ALCIDES CARRION NRO. 469 INT. B URB. ALBRECHT (POR REST. D	0
3202	PULACHE FARFAN MARIA CYNTHIA	10725226158	JR. LORETO N?? 1274 MZ. A LT. 12	959306568
3203	PUMA ABARCA DANIELA VANESA	10455141686	JR. BOLIVAR NRO. 603 INT. C (CRUCE CON JIRON TARAPACA) LIMA - LIMA - L	4300194
3204	PUMA TORRES LUISA YSABEL	10405107967	CAL. INDEPENDENCIA NRO. 324 ICA - PISCO - PISCO	0
3205	Q PHARMA SOCIEDAD ANONIMA CERRADA - Q PHARMA S.A.C	20492461459	CAL. LOS ANTARES NRO. 320 INT. 803 URB. ALBORADA (TORRE A) LIMA - LIMA	6371957
3206	Q-MEDICAL S.A.C	20505719396	AV. ARICA N?? 1442	424-7290 / 433-4197
3207	QUESQUEN LOPEZ CESAR DANIEL	10167895650	JR. JOSE OLAYA NRO. 301 SAN MARTIN - SAN MARTIN - TARAPOTO	0
3208	QUISPE ALANYA BERTHA	10461393476	PJ. LOS CELAJES NRO. 213 (DETRAS DE LA UGEL) APURIMAC - ANDAHUAYLAS -	
3209	QUISPE CARDENAS RAUL ALFREDO	10450487410	NRO. 173 A.H. HUAYCAN GR UCV ZONA M (ALT. DEL MERCADO) LIMA - LIMA - A	987088654
3210	QUISPE CHAMBILLA DORALI RUTH	10427585412	CAL. 28 DE JULIO MZA. U LOTE. 15 P.J. SAN FRANCISCO (A UNA CUADRA DEL	0
3211	QUISPE DELGADO HAYDEE MARIA	10207076207	AV. SAN CARLOS NRO. 2115 (A 1 CDRA Y 1/2 DE LA UCCI) JUNIN - HUANCAYO	963520707
3212	QUISPE ESPINOZA GLORIA MARIA	10413041487	MZA. I LOTE. 12 APV HILDA SALAS (ESPALDA COLISEO CERRADO, CAMINO CACHI	0
3213	QUISPE GUTIERREZ HAYDEE DINA	10432473827	MZA. 37 LOTE. 02 ASOC. JOSE C. MARIATEGUI	0
3214	QUISPE HUAMAN DEYNI LORENA	10449409006	JR. MISION JAPONESA NRO. 315 BARR.MOLLEPAMPA BAJA CAJAMARCA - CAJAMARC	0
3215	QUISPE OSCUVILCA TABITA	10416497279	AV. OSCAR R. BENAVIDES NRO. 1061	0
3216	QUISPE QUINTANA EDGAR AMERICO	10283131845	JR. LA MAR NRO. 128 AYACUCHO - HUAMANGA - SAN JUAN BAUTISTA	966196110
3217	QUISPE QUISPE KAREN MARILIN	10423905013	MZA. Q LOTE. 2 URB. 10 DE SETIMBRE	0
3218	QUISPE RODRIGUEZ GISELLA FABIOLA	10435474158	AV. SAN MARTIN NRO. 133	4632166
3219	QUISPE SANCHEZ KARINA ELIANA	10414463822	MZA. 3 LOTE. 2 A.H. HUAYCAN ZONA A (ALT COLEGIO 1236) LIMA - LIMA - AT	0
3220	QUISPE SANTOS PATRICIA LILIA	10442811259	CAL. 8 MZA. O LOTE. 16 URB. AMAUTA LIMA - LIMA - SAN JUAN DE MIRAFLORE	0
3221	QUISPE SERRANO LUZ MARINA	10249946244	JR. VILCANOTA NRO. 230 QUILLABAMBA (1 CDRA ABAJO DE POLLERIA ROLY) CUS	0
3223	R & C HOLDING SOCIEDAD COMERCIAL DE RESPONSABILIDAD LIMITADA - R & C HOLDING S.R.L.	20507312943	CAL. JORGE BROGGI NRO. 284 DPTO. 401 URB. CHAMA	437-7998
3224	RABANAL ODAR ELTON ERICK	10431730931	LOS EUCALIPTOS NRO. 514 BELLASVISTA (PARALELA AV FAUCETT	0
3225	RAFAEL LLATAS LUISA MILAGRITOS	10448807601	AV. BALTA NRO. 2331 CPM GARCES (LADO HOSTAL MUCHIK-PORTON Y PUERTA CRE	947893199
3226	RAMIREZ ATOCHE GABY PAOLA	10412345377	MZA. J LOTE. 5 A.H. VILLA VICTORIA (POR EL CAMPUS UNIVERSITARIO DE LA	0
3227	RAMIREZ CESPEDES YERITZA PAOLA	10450684487	CAL. AMAZONAS NRO. 300 SECTOR CASTILLA	0
3228	RAMIREZ FREYRE LUZ ILLARY	10066714921	CAL. RICHARD STRAUSS NRO. 766 URB. LAS MAGNOLIAS (3PISO/ESPALDA CDRA 3	6625206
3229	RAMIREZ GUERRA VICTOR ROBINSON	10707635598	CAL. MAESTRANZA NRO. 118 (ENTRE SAN FCO. CON C. PORTUGAL) LORETO - MAY	0
3230	RAMIREZ HUERTA ADRIAN	10085199396	AV. CARLOS IZAGUIRRE NRO. 1286 COO. ANGELICA GAMARRA LIMA - LIMA - LOS	5230044
3231	RAMIREZ LALANGUI JACSELI MAGDA	10474631953	JR. 21 DE SETIEMBRE NRO. 526 DPTO. PS-2 P.J. LA LIBERTAD	979424814
3232	RAMIREZ MENDOZA EDELITA	10484005601	MZA. I LOTE. 60 PRO LIMA (PARQUE 2 COSTADO MINIMARKET)	552-5124
3233	RAMIREZ REATEGUI NELSON RAFAEL	10000935315	JR. GUILLERMO SISLEY NRO. 557 URB. JOSE C. MARIATEGUI (A MEDIA CDA MER	0
3234	RAMIREZ ROSADIO JOAN	10432396849	CAL. BOLOGNESI NRO. 316 LIMA - HUAURA - VEGUETA	0
3235	RAMIREZ SANCHEZ ROCIO JUDITH	10427274166	JR. MITOBAMBA MZA. D3 LOTE. 17 URB. LOS NARANJOS 3ET	0
3236	RAMIREZ SUAREZ DE TEMOCHE DEYSI SUSANA	10028937151	CAL. LEONCIO PRADO NRO. 406 INT. 01 (CERCA A PLATAFORMA) PIURA - SECHU	0
3237	RAMIREZ TUYA EYEDOLL HAIROSS	10417488982	AV. PROGRESO NRO. S.N URB. NICRUPAMPA (A DOS CASAS DEL PARADERO DE LA	0
3238	RAMOS FLORES SANDRA YESSICA	10095390060	PJ. BENJAMIN CISNEROS NRO. 164 DPTO. 301 BK. 2-A (ESPALDA DE BIBLIOTEC	226-7136
3239	RAMOS FLORES YELITZA	10436289311	SEC.24 DE JUNIO, PARCELA NRO. 9A COM.CAMP.COLLANAC (PARCELA 9A, AL LAD	0
3240	RAMOS LOPEZ FIORELLA IVONNE	10438100836	CAL. LOS AZAHARES NRO. 148 URB. SANTA ROSA DE QUIVES (ALTURA PUENTE SA	9751091718
3241	RAVINES CUBAS PATRICIA YSABEL	10266463231	JR. SAN SALVADOR NRO. 192 CAJAMARCA - CAJAMARCA - CAJAMARCA	
3242	REFASA S.A.C.	20100151970	CAL. ENRIQUE VILLANUEVA 105 URB. JUAN PABLO DE MONTERRICO	610-3100
3243	REINOSO SOTO NILDA	10310312989	AV. VENEZUELA NRO. 233 (1/2CD ESTADIO EL OLIVO) APURIMAC - ABANCAY - A	
3244	RENGIFO PINCHI MARLON MAYER	10405841571	JIRON MOROCOCOCHA N?? 164-DPTO E SURQUILLO	992772822
3245	RENGIFO ZAPATA JANINA MELISSA	10447102124	MZA. I2 LOTE. 20 URB. MICAELA BASTIDAS 4 ETAPA (DETR??S DEL COLEGIO CIS	0
3246	REPRESENTACIONES MADS E.I.R.L.	20500516764	JR. PARURO NRO. 1364	0
3247	REPRESENTACIONES MEDICAS MARY DEL PERU S.A.C.	20551917437	CAL. OMEGA NRO. 285 URB. PQ. INT. DE LA IND. Y COM	451-3771
3248	REQUE ACOSTA JACKELINE ALICIA INES	10075352862	CALLE AVILA N?? 159 URB. MAYORAZGO	3488439
3249	REYES CALERO JULIO CESAR	10445815905	AV. UNIVERSITARIA NRO. 2808 (FRENTE AL PARADERO LOS FICUS	0
3250	RIOS CHUQUIHUARA ZUSAN DEYSI	10417677149	PJ. UNION MZA. U LOTE. 2 A.H. EL PORVENIR ANCASH - SANTA - CHIMBOTE	0
3251	RIOS LUNA CAMILA BEATRIZ	10001107947	JR. IQUITOS NRO. 267 (POR GRUPO SAN ANTONIO)	0
3252	RIOS PEZO ANDREA ANAIS	10478392961	MZA. A LOTE. 15 A.V. LOS CHASQUIS LIMA - LIMA - SAN MARTIN DE PORRES	940087562
3253	RIOS RIOS BERTHA	10257298057	MZA. 79 LOTE. 12 A.H. EX FUNDO MARQUEZ (ALT KILOMETRO 14 DE MARQUEZ)	0
3254	RIVERA BENITES HELEM MARILY	10407856444	PJ. UNANUE NRO. 180 URB. AZCONA LIMA	991698344
3255	RIVERA CORONADO LIZETH MILAGROS	10433172219	CAL. AMOTAPE NRO. 299 A.H. JUAN VELASCO ALVARADO PIURA - SULLANA - SUL	0
3256	RIVERO GARCIA DANIEL GERMAN	10430290059	AV. LA MARINA NRO. 1236 URB. CEREZOS I (CEREZOS 1ERA ETAPA FRENTE MIN.	420-4051
3257	RIVEROS VELARDE SANDRA	10406626798	JR. COLONIAL NRO. 215 BARR.YANANACO (FTE ESQ. JR.PACHACUTEC,2PI RUSTIC	0
3258	ROA ORDINOLA MAYRA LIZBETH	10451445281	CAL. MARIANO MELGAR NRO. 224 A.H. SANTA TERESITA	0
3259	ROBLES ASTUHUAMAN DENISSE KETTY	10406876107	JR. LAS COLINAS NRO. S/N CPM BELLAVISTA (S69430185-1/2CD CARR CTRL X E	0
3260	ROBLES CABRERA MARLENY	10403553005	PROLONGACION CHEPEN NRO. 1015 CAJAMARCA - CAJAMARCA - CAJAMARCA	0
3261	RODAS MORON ROOY RONALD	10439870538	AV. R. RIVERA NRO. 2607 DPTO. D (PISO 3)	0
3262	RODRIGUEZ CAPACYACHI ESTHER NELLY	10200107093	AV. MANCHEGO MUNOZ NRO. 361 JUNIN - HUANCAYO - EL TAMBO	964040498
3263	RODRIGUEZ DIAZ FERNANDO	10066009705	PJ. LOPEZ DE GAMARRA NRO. 124 URB. SALAMANCA DE MONTERRICO LIMA - LIMA	956721195
3264	RODRIGUEZ GARCIA CARLOS MARTIN	10182121911	AV. JUAN PABLO II NRO. MZ N INT. L108 RES. LUIS ALBRECHT	0
3265	RODRIGUEZ PAIVA DEL AGUILA CELIA	17149116931	EL DERBY 335 URB.EL DERBY DE MONTERRICO	989850316
3266	RODRIGUEZ QUICHIZ DAVID ALBERTO	10479100824	AV. COLOMBIA NRO. 255	941162345
3267	RODRIGUEZ QUISPE FANNY KELLI	10269632921	CAL. LOS RUBIES NRO. 213 URB. SANTA INES LA LIBERTAD - TRUJILLO - TRUJ	0
3268	RODRIGUEZ VILCA RUT MERY	10454470473	UCV 187 LOTE 47 ZONA O HUAYCAN	0
3269	ROJAS AMAYA ROSARIO ELIZABET	10443879434	CAL. FELIX ALDAO NRO. 125	0
3270	ROJAS BARDON LIZ KARINA	10416388071	FILADELFIA NRO. 1393 LIMA - LIMA - SAN MARTIN DE PORRES	
3271	ROJAS BENITO EDER GREGORIO	10413451570	JR. LAS PERAS NRO. 370 URB. NARANJAL LIMA - LIMA - SAN MARTIN DE PORRE	5216596
3272	ROJAS CABRERA FIORELLA JEANETT	10467396205	MZA. N LOTE. 26 URB. PARQUE INDUSTRIAL LA LIBERTAD - TRUJILLO - LA ESP	0
3273	ROJAS DIAZ JESSICA LITA	10447318950	JR. GUILLERMO URRELO NRO. 1298 BR SAN ANTONIO	0
3274	ROJAS ESPIRITU PAOLA PATRICIA	10469334282	AV. TUPAC AMARU NRO. 322 (A 05 CASAS DE I.E. ANGELA MORENO) JUNIN - TA	988860989
3275	ROJAS LEANDRO ELA MIRIAM	10402578691	MZA. E LOTE. 8 URB. EL BOSQUE (COSTADO DEL ESTADIO HERACLIO) HUANUCO -	0
3276	ROJAS LIVIA SELY	10404839671	CAL. JAVIER PULGAR VIDAL MZA. A LOTE. 13 C.P. ME. VILCAR CAYHUAYNA	0
3277	ROJAS MESIA ADILIA	10087664347	CAL. C-1 NRO. 170 URB. LOS PRECURSORES LIMA - LIMA - SANTIAGO DE SURCO	282-2179
3278	ROJAS MEZA LINDA RUTH	10414711222	ZONA II MZA. B4 LOTE. 1 URB. DELICIAS	0
3279	ROJAS PISSANI JESSICA RAQUEL	10412953024	PJ. MARIA PARADO DE BELLIDO NRO. 120 URB. SANTA CLARA (A MEDIA CUADRA	969532478
3280	ROJAS TAMARA MARY LUZ	10400937538	BL. APROVICA MZA. A LOTE. 20 URB. APROVICA (ESPALDA DEL CONTROL	0
3281	ROJAS VASQUEZ JULISSA DEL PILAR	10444534431	MZA. 61 LOTE. 15 URB. SAN JUAN DE CHOTA LAMBAYEQUE - CHICLAYO - PATAPO	1123-4567
3282	ROJAS VELA JOYCE JAZMIN	10054166139	AV. ESTEBAN CAMPODONICO NRO. 490 DPTO. D URB. SANTA CATALINA	0
3283	ROLDAN MONZON ANGIE VANESSA	10428545147	JR. FLORA TRISTAN NRO. 3153 URB. CONDEVILLA (ALTURA CUADRA 30 AV. JOSE	0
3284	ROMERO FRANCO KARINA	10406183195	CAL. MARISCAL MILLER NRO. 1780 (CERCA AV. CANEVARO) LIMA - LIMA - LINC	2255213
3285	ROMERO SANTA CRUZ EYDA	10421396596	CAL. JORGE CHAVEZ NRO. C4 SECTOR SANTA CECILIA CAJAMARCA - JAEN - JAEN	0
3286	ROMERO VELA KATHERINE ADRIANA	10726529928	CAL. MANUEL GONZALES PRADA NRO. 492 COO. UNIVERSAL 1 ETAPA LIMA - LIMA	602-5830
3287	RONDINEL GOMEZ CARLOS RONALD	10429198475	JR. ABRAHAN VALDELOMAR NRO. 871 (LA RECTA DE LA POSTA NAZARENAS	966-76295
3288	ROQUE ARIAS NANCY LILIANA	10090552720	CAL. 24 MZA. P LOTE. 02 URB. LOS ANGELES DE VITARTE (FRENTE COLEGIO IN	0
3289	ROSALES BRIONES KARINA FIORELLA	10440572788	JR. GUILLERMO MOORE NRO. 509 A.H. EL ACERO (FRENTE A LOS BOMBEROS) ANC	0
3290	ROSALES PALACIOS MANUEL ERNESTO	10434828029	AV. CAMINO REAL MZA. G LOTE. 1 P.J. ALTO PERU ANCASH - SANTA - CHIMBOT	0
3291	ROSPIGLIOSI ORBEGOSO MILUSKA YANIRA	10463179161	CAL. FRAGONAR NRO. 156 URB. SAN BORJA LIMA - LIMA - SAN BORJA	940248430
3292	RPQ LOGHIST INTEGRAL SOLUTIONS S.A.C	20537568080	AV. 6 DE AGOSTO N?? 525 INT. 201	240-1348
3293	RUBIO JUAREZ ANA MARIA	10102168068	CAL. LAS PASIONARIAS NRO. 240 URB. SANTA ISABEL	0
3294	RUIZ AGUILAR MILAGROS ELIZABETH	10409196379	JR. EL INCA NRO. 417 BARRIO LA COLMENA CAJAMARCA - CAJAMARCA - CAJAMAR	976727656
3295	RUIZ BRIOSO DANY	10466064063	MZA. 66 LOTE. 11 BARR 27 DE MAYO (DETRAS DE CLAS AUCAYACU	0
3296	RUIZ DIAZ JHOSELYN PAMELA	10765243713	I. MERINO NRO. 3776 PANAM. NORTE LIMA - LIMA - LOS OLIVOS	0
3297	RUIZ GOMEZ RUTH ROSARIO	10455451928	MZA. D LOTE. 16 URB. HORACIO ZEVALLOS (JR. TARSICIO BAZAN 344) CAJAMAR	943065692
3298	RUIZ HERRERA GISELLA GREYSY	10439411355	JR. LAS BEGONIAS MZA. P LOTE. 6 URB. ENTEL PERU (ALT DEL CINE SUSI)	0
3299	RUIZ LEIVA FATIMA JANETH	10457718620	JR. ILLIMANI NRO. 115 BAR, MARCOPAMPA CAJAMARCA - CAJAMARCA - CAJAMARC	0
3300	RUIZ VARGAS WILLY FRANK	10454578037	CAL. 2 MZA. C LOTE. 03 URB. SANTA ROSA (POR LA CASA BLANCA)	0
3301	SAAVEDRA ARRASCUE OMAR HERNANDO	10451377171	CAL. COSME BUENO NRO. 485 URB. LA NORIA LA LIBERTAD - TRUJILLO - TRUJI	0
3302	SAAVEDRA SOSA SAYMIN DEL SOCORRO	10453813458	CAL. TARATA NRO. S/N P.J. SANTA ISABEL LAMBAYEQUE - LAMBAYEQUE - OLMOS	
3303	SABA SALAZAR ELENA ALICIA	10329756314	JR. MATEO PUMACAHUA NRO. 322 A.H. LA LIBERTAD	0
3304	SABAS OLAYA YADIRA YAJAIRA	10435455056	MZA. B7 LOTE. 6 C.H. MARISCAL CACERES LIMA - LIMA - SAN JUAN DE LURIGA	0
3305	SALAS HIDALGO LARISA	10054168565	PJ. CABO PANTOJA NRO. 163 (MANCO C. STA. ROSA CDRA. 15 PUTUMAYO	0
3306	SALAS LAZA LUIS ANGEL	10769216095	SECTOR ESTABLO HUAMAN MZA. B LOTE. 6 ASO.DE PROP.LA GRAMA (ALT. GRIFO	964848398
3307	SALAS RAMIREZ YESENIA	10409374480	MZA. D3 LOTE. 13 URB. JOSE CARLOS MARIATEGUI ANCASH - SANTA - NUEVO CH	0
3308	SALAS YUMBATO KATHERIN ARLEY	10703472040	CAL. DOS MZA. A LOTE. 24 (A ESPALDAS DE GRIFO AMPARITO - TERMINAL) LOR	0
3309	SALAZAR CHU PATRICIA	10296655916	MZA. C LOTE. 3 ASOC. DOCENTES U.C.S.M. AREQUIPA - AREQUIPA - CERRO COL	0
3310	SALAZAR QUISPE JOSE JESUS	10450629354	AV. CENTENARIO NRO. 159 LA LIBERTAD - PACASMAYO - SAN PEDRO DE LLOC	0
3311	SALAZAR QUISPE SHEILA MARILIZ	10428002984	CAL. 1 MZA. E LOTE. 12 URB. LOS VI??EDOS DE CARABAYLLO	0
3312	SALAZAR VENTURA DEBORA RUTH	10773230281	CAL. CRNL FRANCISCO BOLOGNESI MZA. 01 LOTE. 14 A.H. A??O NUEVO (ALT DEL	0
3313	SALAZAR VENTURA EVELYN LUZMILA	10483351033	CAL. CRNEL FRANCISCO BOLOGNESI MZA. 01 LOTE. 14 P.J. A??O NUEVO LIMA -	0
3314	SALCEDO CHANDIA CRISTIAN DAVID	10257460008	AV. BRASIL NRO. 2377 DPTO. 102 LIMA - LIMA - JESUS MARIA	0
3315	SALDANA VILLANUEVA ROCIO MARGARITA	10081534794	BLOCK NRO. 48 INT. 201 U.V. DEL RIMAC LIMA - LIMA - RIMAC	0
3316	SALDA??A MACEDO NAHUN	10458318501	JR. SAN JUAN MZA. A LOTE. 32 URB. EL TOTORAL (AL FINAL DE LA SOTO BERM	4772461
3317	SALINAS QUINTANA LUIS FRANCISCO	10405809520	PJ. 1 NRO. A INT. 12 URB. VILLA MARINA (ALT.MERACDO DEL PUEBLO--AV.SAN	344-2527
3318	SALINAS QUISPITUPA JUAN RICHARD	10439980716	MZA. D7 LOTE. 3 A.H. ANGAMOS SECTOR I (PARADERO 8)	0
3319	SALINAS VEGA ALDO ALBERTO	10400677617	PROLONG MANCO SEGUNDO NRO. 115 DPTO. 1204 INT. A URB. PANDO	997561105
3320	SALVADOR VIGIL MIRLA DALIA	10421709837	JR. LA COLMENA NRO. 141 P.J. SAN MARTIN (FRENTE A TRANSPORTES FLORES)	
3321	SAMPEN CELIS LUZMILA EMPERATRIZ	10409034808	PJ. VENTURA HUAMAN NRO. 180 URB. FEDERICO VILLAREAL LAMBAYEQUE - CHICL	990351521
3322	SANCHEZ CORTEZ JENNIFER LISBETT	10468648381	LOS CLAVELES NRO. 188 ERMITA??O	992362553
3323	SANCHEZ GONZALES FLOR KARINA	10425779406	AV. 28 JULIO NRO. 178 (PARQUE ARTESANAL)	0
3324	SANCHEZ HUAMAN ELMER ROGER	10455975544	JR. ANTONIO RAIMONDI NRO. 141 URB. SAN LUIS CAJAMARCA - CAJAMARCA - CA	0
3325	SANCHEZ MANZO JAVIER HERNAN	10101293233	JR. YURAYACU N?? 2471 URB. MANGOMARCA	0
3326	SANCHEZ PERALTA NADIA DENISSE	10422185971	CAL. CORREA NRO. C-02 NUEVO HORIZONTE (FELIZ CORREA C-2 T-65) CAJAMARC	0
3327	SANCHEZ ROJAS MARIA MILAGROS	10401924910	AV. LA PAZ NRO. 1519 URB. LOS ROSALES DE STA. ROSA	0
3328	SANCHEZ TELLO MARIA VIOLETA	10418146830	CAL. 69 MZA. N4 LOTE. 29 URB. EL PINAR (ALT AV LOS INCAS) LIMA - LIMA	
3329	SANCHEZ VALVERDE JACKELINE ELIZABETH	10445127804	CAL. MIGUEL GRAU NRO. 921 BUENOS AIRES NORTE	0
3330	SANCHEZ VILLAR CECILIA TERESA	10257267810	JR. BOLOGNESI NRO. 1228	0
3331	SANDERSON S.A. (PERU)	20381450377	AV. NICOLAS ARRIOLA 345 URB. SANTA CATALINA	471-1143/471-1101
3332	SANDOVAL GOMEZ MERCEDES DEL PILAR	10420731014	JR. CAJAMARCA NRO. 843 A.H. PACHITEA PIURA - PIURA - PIURA	0
3333	SANDOVAL REYES VIKY DINA	10712656455	MZA. B LOTE. 3 A.H. LOS CLAVELES II LIMA - LIMA - SAN JUAN DE LURIGANC	0
3334	SANTISTEBAN DE LA CRUZ DIGNA ELENA	10439153364	MZA. A LOTE. SN CAS. SANTA ISABEL (INGRESANDO A CASERIO) LAMBAYEQUE -	
3335	SANTIVA??EZ PANTOJA ARACELLY FLOR DE MARIA	10443932351	JR. TRUJILLO NRO. 1080 BARR.TUCUMACHAY JUNIN - HUANCAYO - EL TAMBO	0
3336	SANTOS CHERO MILAGROS DE LOURDES	10426966412	CAL. ICA-CUADRA 10 NRO. -- INT. 3 (POR EL BANCO DE CREDITO) PIURA - PI	0
3337	SANTOS ILLESCAS SILVIA LIZ	10437615859	CAL. GREGORIO ATENCIO NRO. 117 PBLO. SAN ANTONIO DE RANC (AL COSTADO D	0
3338	SANTOS MANTURANO JANETH ELIZABETH	10102517721	MZA. Q LOTE. 4 LOS ANGELES SECT.	0
3339	SAQUICORAY LANDA NORY CYNTHIA	10707650813	JR. LOS PROCERES NRO. SN (ENT PROCERES Y PSAJE AURORA S.71161692) JUNI	0
3340	SARAVIA MONDALGO MONICA LISETH	10438317843	AV. EL BOSQUE MZA. A LOTE. 4 C.H. IGNACIA RODULFO VDA DE CA LIMA - LIM	964388654
3341	SECLEN CADENILLAS VILMA TERESA	10472224498	BL. B NRO. S/N DPTO. 401 C.H. JOSE BALTA LAMBAYEQUE - CHICLAYO - CHICL	
3342	SEGOVIA CABELLO NADIA LIZ	10402412980	ASUNCION NRO. 188 EL PARRAL (ALT. KM. 8.5 DE AV. T??PAC AMARU	0
3343	SEGOVIA VENTURA ARELI	10472905088	MZA. B LOTE. 15 A.H. RINCONADA DE VILLA	0
3344	SEGURA CORAMPA ROSA BEATRIZ	10732294380	CAL. 18 MZA. 58 LOTE. 10 (ALT DEL OVALO DE CALLE 17) PROV. CONST. DEL	0
3345	SEGURA CORDOVA ZOILA LUZ	10095963540	CAL. LOS GLADIOLOS NRO. 272 URB. LOS JARCINES DE SALAMANCA (ALT.ULTIMA	0
3346	SEJEKAM WAJAI ELVIS JHOVER	10460801406	JR. SAMUEL WAJAJAI NRO. S/N NARANJILLO SAN MARTIN - RIOJA - AWAJUN	950668218
3347	SEMPERTIGUI RODAS MANUEL	10335916960	PJ. PERU NRO. 372	0
3348	SERNA SERVICIOS S.A.	20549566147	JR. CARLOS AGUSTO SALAVERRY NRO. 3981 URB. PANAMERICANA NORTE	622-0185
3349	SERRANO CARRANZA MIRIAM ROSANNA	10411628421	JR. COMERCIO NRO. 1115 CENTRO BAGUA	0
3350	SERRANO VARGAS LAURA	10425139105	MZA. F LOTE. 21 URB. VELASCO ASTETE (LADO IZQUIERDO DEL AEREOPUERTO CA	0
3351	SERVICIOS GENERALES JUCASE E.I.R.L	20392514342	JR. SAN PEDRO DE CARABAYLLO NRO. 329 URB. SANTA ISABEL	5351290 / 5441633 / 980299290 / 99267027
3352	SERVICIOS NAVALES E INDUSTRIALES SAN PEDRO S.A.	20101399703	Calle Edwin White N?? 326, Urb. Industrial La Chalaca	4652176
3353	SERVICIOS Y DERIVADOS VR S.A.C.	20548531650	RECUAY NRO. 628 LIMA - LIMA - BRE??A	998301974
3354	SHUPINGAHUA PANDURO SULLY	10425118191	JR. VISTA ALEGRE NRO. 397 A.H. LAS MERCEDES	0
3355	SICHA CUETO IVETH SALLY	10460316966	AV. MARISCAL CACERES NRO. 874 INT. 8 (FRENTE DE CARSA EN UN PASAJE) AY	
3356	SIERRA FARFAN ROCIO KARINA	10316703521	AV. PROGRESO NRO. S.N URB. NICRUPAMPA (FRENTE A BODEGA KARINA)	0
3357	SIERRA RODRIGUEZ CINDY	10448854138	MZA. B LOTE. 3 ASOC PROP VICENTELO BAJO	0
3358	SIGUAS GONZALES LUIS YSMAEL	10096959414	MZ. I LT. 20 URB. PACHACAMAC 3RA ETAPA (AV. MARIATEGUI CON AV. CENTR	996784395
3359	SIHUINCHA LAPA JACKELYN	10430227730	MZA. E LOTE. 7-8 A.H. CESAR VALLEJO (KILOMETRO 9.200 CARRETERA CENTRAL	0
3360	SILUPU CASTILLO ROSA MARIBEL	10707741380	MZA. F5 LOTE. 08 INT. 1 A.H. TUPAC AMARU (A 2 CDRAS DE LA IGLESIA FATI	0
3361	SILVA GOMEZ MONIQUE JULIETTE	10079248598	JR. MADRID NRO. 157 INT. B (ALT CDRA 12 AV BOLIVAR)	461-3878 / 945026444
3362	SILVA PAREDES JULISSA DEL CARMEN	10329874686	MZA. N5 LOTE. 12 URB. LAS GARDENIAS ANCASH - SANTA - NUEVO CHIMBOTE	0
3363	SILVERA RICHARTE DEMI YULIZA	10703788055	JR. AYACUCHO NRO. S/N (1187,FRENTE AL PRONAA) APURIMAC - ANDAHUAYLAS -	
3364	SINCHEZ ROJAS EVELYN DIONICIA	10444751580	CAL. 8 MZA. G LOTE. 18 URB. LA MERCED DE MONTERRICO	0
3365	SIVIRICHI GARMA TATIANA JHAJAIRA	10447618678	MZA. E LOTE. 10 URB. SAN JOAQUIN I ETAPA (POR LA PANADERIA-SEGUNDA ENT	940161516
3366	SOLIS SALINAS KAREN VICTORIA	10457897273	JR. REYNALDO DE VIVANCO NRO. 375 U. POP. CIUDAD DE DIOS	0
3367	SOLUCIONES ESTRUCTURALES SOCIEDAD ANONIMA CERRADA	20506963754	AV. SALAVERRY N?? 2802	7179300 - 7179304
3368	SONICA PERU E.I.R.L.	20553658226	"AV. JORGE CHAVEZ N?? 242 OF. ""E"""	981455091
3369	SORIANO AGUILAR JULISSA NATALY	10445712405	CAL. TNTE CORONEL NICOLAS ARR NRO. S/N A.H. SE??OR DE LOS MILAGROS	0
3370	SOSA GILES MARIA ISABEL	10434508164	CAL. 1 DE MAYO - SECT II NRO. 281 CERCADO	0
3371	SOSA SOTO ESTEFANY CRISTEL	10446301425	CAL. BUENOS AIRES MZA. 12 LOTE. 26 A.H. SAN PEDRO PIURA - PIURA - PIUR	0
3372	SOTELO GOMEZ JOSHELYN JERIT KELLY	10466434979	CAL JULIAN ALARCON NRO. 812 URB. SAN GERMAN	0
3373	SOTO ESPINOZA NOYMI EDELINA	10094576895	JR. HUALCAN NRO. 342 ANCASH - HUARAZ - HUARAZ	0
3374	SOTO ROSADO DENISSE CINTHIA	10421003870	CONCHUCOS NRO. 467 (MEDIA CUDRA DE LA DIROVE)	0
3375	SOTO TINOCO CLAUDIA FIORELLA GEORGINA	10452670955	JR. CHAVIN NRO. 2 URB. CHACRA COLORADA	0
3376	SOUZA FLORES JESSY CAROLINA	10424186851	CAL. CAPITAN BELGRANO NRO. 122 (CON PIURA) LORETO - MAYNAS - PUNCHANA	0
3377	SPECTRUM INGENIEROS S.A.C.	20503650186	JR. GREGORIO PAREDES NRO. 220 (OTRO 222/PARALELA A CDRA.27 AV.BRASIL)	462-2749
3378	STAR PRINTING S.A.C	20545777968	ESQ EMILIO ALTHAUS NRO. 406 LIMA - LIMA - LINCE	4710956
3379	SUAREZ MENDOZA ROSA MARIBEL	10426752889	CAL. MERCADERES NRO. 264 URB. LAS GARDENIAS	0
3380	SUAREZ MORENO VICTOR JAVIER	10094077228	PJ. EL AMAUTA NRO. 105 C. FERNANDINI (AV LAS PALMERAS CDRA 42) LIMA -	993961864
3381	SUAREZ PALOMINO DELIA	10433078069	MZA. R LOTE. 9 URB. SAN MIGUEL DE SAUCEDA (DETRAS DE LA UGEL CERCO PRT	0
3382	SUAREZ SEGOVIA RAQUEL	10423832709	CAL. CARLOS DE LOS HEROS NRO. 168 URB. NAVAL ANTARES (AV TOMAS VALLE Y	5314756
3383	SUNCION ZAPATA ERICKA ARACELLY	10429275399	MZA. D?? LOTE. 06 A.H. LOS FICUS (ESPALDA DEL ESTADIO) TUMBES - TUMBES	0
3384	SUYON SANTA CRUZ PAOLA GIOVANNA	10434312430	AV. AVENIDA MIGUEL GRUA NRO. 607 C.P. PICSI (ULTIMO ROMPEMUELLE) LAMBA	
3385	TAFUR PORTOCARRERO DEYSY	10439561896	JR. HERMOSURA NRO. 160 AMAZONAS - CHACHAPOYAS - CHACHAPOYAS	0
3386	TAKEMOTO VILLANUEVA YURIKO YOMARA	10456751364	CAL. BELEN NRO. 137 P.J. LA ESPERANZA LA LIBERTAD - TRUJILLO - LA ESPE	0
3387	TALLEDO HUAMAN JOSE DOMINGO	10258369322	CAL. HUAMACHUCO NRO. 152 URB. EMPLEADOS DE MIRAFLORES (ENTRE CDRA 8 Y	0
3388	TALMA SERVICIOS AEROPORTUARIOS S.A	20204621242	ELMER FAUCETT CDRA S/N	  574-3459
3389	TAYPE CASTILLO TANYA MAGALI	10084635702	JR 9 N?? 318 DPTO 303 - URB MONTERRICO NORTE - SAN BORJA	996284165
3390	TE.SA.M. PERU S.A.	20306102967	CAL. CORONEL ODRIOZOLA NRO. 126 URB. SAN ISIDRO	705-4141
3391	TECNOLOGIA INDUSTRIAL Y NACIONAL S.A.	20110133091	AV. MANUEL OLGUIN N?? 501 DPTO. 1103	2081230/2081259
3392	TEJADA MUSAYON MARIA JAQUELINE	10454129780	CAL. MARISCAL URETA NRO. 1377 CPM TORIBIA CASTRO LAMBAYEQUE - LAMBAYEQ	
3393	TELCOMSYS S.A.C.	20511145156	JR. PABLO ALAS MZA. C LOTE. 14 URB. SAN JUAN DE MIRAFLORES	276-8100 4660536
3394	TELEFONICA DEL PERU S.A.A.	20100017491	AV.AREQUIPA N?? 1155	210-4895
3395	TELEFONICA MOVILES S.A	20100177774	AV. JAVIER PRADO ESTE 3190	6904070/2109229
3396	TELLO PARIAMANCO EDITH JULIA	10454325546	PJ. 1 MZA. 36 LOTE. 10 A.H. 9 DE FEBRERO	0
3397	TELLO ROJAS EVER EDINSON	10454670553	PJ. SAN AGUSTIN NRO. 134 BARR.SAN SEBASTIAN (PLAZ.BOLOG.MEDIA CDRA.POR	
3398	TELLO TORRES MARIBEL ESMERALDA	10413983890	PROL. LEONCIO PRADO NRO. 140 INT. 2	0
3399	TENORIO CARRASCO GIANNI VRUBEL	10423468454	JR. ASAMBLEA NRO. 338	#999002408
3400	TIMANA RUIZ RAUL ALONSO	10428396397	EDIFICIO 19 NRO. S/N DPTO. S-19 C.H. SAN GABINO 3RA. ETAPA (ALT. DE LA	984107448
3401	TINCHO TIJIAS LIDIA	10421519663	PJ. ALTAMIRANO NRO. 109 SECTOR JAEN CERCADO (A 1/2 CDRA CASITA DEL PAN	0
3402	TINEO VALLES SOCORRO ANA	10430550859	JR. UTCUBAMBA NRO. 906	0
3403	TINTA SANCHEZ ROSA MARIA NATHALIE	10421625307	PIEDRITAS NRO. 449 ZARUMILLA (ALT. PUENTE CONTROL)	0
3404	TIPIAN JUAREZ GIOVANA VANESSA	10469039833	JR. PACASMAYO NRO. 853 INT. 861 (ESPALDA DEL HOSPITAL LOAYZA) LIMA - L	0
3405	TITO RAMOS PAOLA MARGOT	10446567573	JR. LOS BELE??OS NRO. 334 URB. SAN SILVESTRE (ALT DE CDRA 4 DE FLORES	0
3406	TOCRE ESPINOZA YESSENIA	10463191901	AV. JOSE CARLOS MARIATEGUI MZA. C LOTE. 20 URB. VILLA MIRAFLORES (COST	0
3407	TOLEDO ROJAS NATALIA MARGARITA	10432108941	MZA. E LOTE. 06 LAS FLORES DE COPACABANA LIMA - LIMA - PUENTE PIEDRA	992423846
3408	TOLEDO ZELAYA ELIZABETH GRACIA	10107408270	AV. PROGRESO NRO. 158 P.J. MALAGA DE PRADO (ALT.KM.8.5 T.AMARU)	983275090
3409	TORREJON CAMACHO ROYCER	10001245215	JR. MARISCAL CASTILLA NRO. 315	0
3410	TORREL PAEZ KARINA MARLENY	10416118766	AV. JOSE DE LAMA NRO. 844 CENT. SULLANA PIURA - SULLANA - SULLANA	0
3411	TORRES ARAGON VICTOR HUGO	10460951041	CAL. VENECIA NRO. 960 URB. LA ACHIRANA SECTOR I	0
3412	TORRES BERNAL RICARDO	10108618499	JR. ICA 3189	565-1046/ 9766-67131
3413	TORRES ESPINOZA DIEGO RICARDO	10709059501	MZA. F LOTE. 2 COO. VIRGEN DEL ROSARIO (ALT. INABIF) LIMA - LIMA - ANC	991096727
3414	TORRES GONZALES MANUEL	10413978284	AV. SANTOS VILLA NRO. 835 (A 1.5 CDRA PASANDO ESCUELA ASCENSION)	943888989
3415	TORRES INGA NILFER ANTONI	10719664950	JR. CELESTINO AVILA GODOY N?? 297	957898756
3416	TORRES PECHO YESENIA LISSETH	10436386244	JR. SAN SALVADOR NRO. 385 URB. VILLA SR DE LOS MILAGROS (ALT.PARQUE 20	0
3417	TORRES PHARMA SAC	20502425367	AV.  EL POLO  196  STGO DE SURCO	2578099
3418	TORRES ROMAN BARBARA JULIA	10456184192	MZA. T LOTE. 17 A.H. MIGUEL GRAU ICA - CHINCHA - PUEBLO NUEVO	0
3419	TOYODA NECIOSUPE JESSICA PAOLA	10107431191	JR. SUCRE NRO. 451 URB. SAN AGUSTIN (ENTRE AV UNIVERSITARIA Y BELAUNDE	0
3420	TRANSP.TURIS Y SERV.GNRLES EL AEREO EIRL	20197116171	CAL. GARCIA NARANJO 1091 (CRUCE CON JR.LUCANAS) LIMA LIMA LA VICTORIA	324-6216
3421	TRANSPORTES FELIPE J HUANCA ALVITEZ EIRL	20298258821	"CALLE ""A"" MZ. X LOTE 2 URB. ALBINO HERRERA 1RA. ETAPA"	4842526/5695150
3422	TRATAMIENTO DE AIRE SAC	20514546267	AV. JOSE GALVEZ N??1741 - LINCE	472-9237
3423	TRAVEL TIME S.A.	20112846477	Av. Javier Prado Este # 5193 Ofic. C10  PLAZA CAMACHO  LAMOLINA	436-0777 / 436-0299 / 436-4420
3424	TRAVEZA??O LEONARDO GABY	10461524309	AV. ANDRES A. CACERES NRO. 228 (COSTADO DEL PARQUE INFNTIL YANACANCHA	
3425	TTITO HUARHUA NOEMI ESTHER	10417246695	JR. GENERAL VELARDE NRO. 457 (ENTRE AV ANGAMOS Y AV PANAMA) LIMA - LIM	4441785
3426	TUPPIA NAVARRO NORKA ELIZABETH	10078751938	CAL. BUENAVENTURA AGUIRRE NRO. 340 DPTO. 502 LIMA - LIMA - BARRANCO	444-4868 / 247-4620
3427	T-VIGILA PERU.COM S.A.C.	20536853660	CAL. LOS MELOCOTONES NRO. 226 URB. NARANJAL	836*2208
3428	UBALDO ALVARADO DIORELY KASANDRA	10769856922	MZA. M1 LOTE. 19 LOS PORTALES DE CHILLON LIMA - LIMA - PUENTE PIEDRA	
3429	UGARTE LAURA KARLA	10412968919	SAN MARTIN NRO. 802 (FRENTE A LA ESCUELA 56025 CASA AMRILLA) CUSCO - C	
3430	UGAZ ROMERO RAQUEL ALEJANDRA	10463404831	AV. MONASTERIO NRO. 599 INT. 302 (PISO 3)	
3431	UNIMED DEL PERU S.A.	20253768119	CAL. LOS LIBERTADORES NRO. 155 (PISO 6 Y 7 ALTURA C.C. CAMINO REAL) LI	6115500
3432	UNIVERSIDAD DE SAN MARTIN DE PORRES	20138149022	CALLE MART??N DULANTO N?? 101 SAN ANTONIO	947455506 / 989207296
3433	URETA CASTELLI REBECA ALBERTINA	10103221507	ALM. DEL CORREGIDOR NRO. 1375 DPTO. 302 URB. LOS SIRIUS	495-4061 / #971703901
3434	URTECHO CASTILLO FRANKLIN JOHAN	10806382839	CAL. ATAHUALPA NRO. 1021 PUEBLO HUAMACHUCO LA LIBERTAD - SANCHEZ CARRI	044-348128 / RPM # 1826560
3435	VALDEZ MARCELO SELENE CELICA	10455984829	AV. LIMA NRO. 3779 (ESPALDAS DE 37 DE AV. PERU)	
3436	VALDEZ PAREJA ELSA FRANCA	10438080681	JR. CIRO ALEGRIA NRO. 940 (COSTADO DE HOSPITAL JESUS NAZARENO) AYACUCH	
3437	VALENZUELA MENESES JOSE RICARDO	10427098732	CAL. MARISCAL CACERES NRO. S/N	
3438	VALERA BUSTOS BIDALITHA AZUCENA	10405778039	PJ. 9 NRO. 114 (ALT LINEA DEL TREN	
3439	VALERIO AYALA JURY JACKELINE	10425229864	CAL. ANCASH NRO. 490 (1 CDRA DEL MATERNO INFANTIL FTE TIENDA) LIMA - H	
3440	VALLADARES SALINAS MILAGROS ELIZABETH	10419458371	SAN RAMAN NRO. 404 (CRUCE CDRA. 6 Y 7 DE PIZARRO) LIMA - LIMA - RIMAC	
3441	VALLADARES VIDAL ELGA STEFANNY	10463605781	AV. LIBERTAD MZA. KA LOTE. 5 ANCASH - CASMA - CASMA	
3442	VALLE GRANDEZ JACKELINE	10434638327	JR. TRIUNFO NRO. 907 AMAZONAS - CHACHAPOYAS - CHACHAPOYAS	
3443	VALLEJOS MILIAN SANTOS MAXIMILA	10436892514	CAL. 23 DE AGOSTO NRO. 120 C.P.M SAN JOSE OBRERO LAMBAYEQUE - CHICLAYO	
3444	VALVERDE VELASQUEZ TANIA LUZMILA	10420070956	MZA. B LOTE. 44 COO. JUAN MANUEL POLAR AREQUIPA - AREQUIPA - JOSE LUIS	
3445	VARA GRA??A CARLOS GIUSSEPPE	10725784797	CAL. FIDEL OLIVAS ESCUDERO NRO. 128 URB. PANDO 1RA ET. LIMA - LIMA - S	
3446	VARAS PRADA LUIS ANGEL	10778186115	JR. MARACAIBO NRO. 1601 URB. PERU (1ER PISO) LIMA - LIMA - SAN MARTIN	963744570
3447	VARGAS CACERES AMILCAR DANTE	10062327711	CAL. ABELARDO GAMARRA NRO. 1557 URB. ELIO III ETP (ALT CDRA 31 DE AV V	945128853
3448	VARGAS CHAVEZ SERGIO ALDO	10700853476	CAL. BLONDELL NRO. 40 (FRENTE AL HOSPITAL HIPOLITO UNANUE)	
3449	VARGAS GRANILLA ANA MARILUZ	10475515019	JR. LOS NOGALES MZA. E LOTE. 9 A.H. SANTA ROSA	
3450	VARGAS HIDALGO CATHERINE JEANNETTE	10451044325	JR. CAHUIDE NRO. SN (COSTADO DE JARDIN VIRGEN DE LA ESTRELLA) APURIMAC	
3451	VARGAS LIVON ROBERTO ROBINSON	10106440528	AV. LOS CEDROS MZA. Y LOTE. 5 COO. UMAMARCA	
3452	VARGAS MONRROY LUZ MARIA	10296085541	CAL. 13 DE ABRIL NRO. 1003 URB. ALTO SELVA ALEGRE (ZONA B) AREQUIPA -	
3453	VASQUEZ BEDON ERIKA MERICIA	10257535636	CAL. ATAHUALPA NRO. 258 INT. 4 (ALT. CDRA.7 AV. SAENZ PENA)	
3454	VASQUEZ CALERO RAQUEL	10454929743	CAL. AMOTAPE NRO. 210 A.H. SANTA TERESITA (FRENTE AL MERCADO) PIURA -	
3455	VASQUEZ FLORES ELIBERTO OSCAR	10106739809	CALLE MARCHAND N?? 158 DPTO. 201	990431059
3456	VASQUEZ GUERRA KARIN JANETH	10453843276	JR. COMANDANTE ESPINAR NRO. 351 (POR LA MARINA)	
3457	VASQUEZ RUIZ SADITH	10431921478	JR. MESON Y MURO S/N	
3458	VEGA SANCHEZ MARIELA DANISSA	10430846979	CAL. AYACUCHO NRO. 280 SECTOR MORRO SOLAR ALTO	
3459	VELA RAMIREZ SARITA ELIZABETH	10420273857	JR. PIURA MZA. 04 LOTE. 02 A.H. NUEVA MAGDALENA	
3460	VELARDE ARCE JOSE CAMILO	10719591804	MZ. L 16 LT. 8 MARISCAL C??CERES	286-3095 / 962549632
3461	VELASCO HUIVIN ELSA JHULIANA	10452837299	CAL. LUIS PASTEUR NRO. 219 URB. DANIEL HOYLE	
3462	VELASQUEZ CHAVEZ MARISOL	10437101006	AV. 9 DE OCTUBRE NRO. 462 CERCADO LAMBAYEQUE - CHICLAYO - SANTA ROSA	
3463	VELASQUEZ LARREA JUAN JOSE ALEX	10402215858	AV. MRCAL O.R.BENAVIDES NRO. 4745 INT. 2 URB. COLONIAL (A 3 CDRAS DEL	4518950
3464	VELASQUEZ OJEDA JENNIFER	10451695407	MZA. A LOTE. 13 A.H. 25 DE DICIEMBRE (ESPALDA COLEGIO GRAN BRETA??A)	
3465	VELASQUEZ SAMANEZ GIAN FRANCO	10774388929	CAL. AMAZONAS MZA. H16 LOTE. 14 A.H. MI PERU	956922452
3466	VELIZ MEZA LUISA MARIA	10209940278	JR. JUNIN NRO. S/N (S72628152 CD5- ESQ SAN MARTIN) JUNIN - SATIPO - SA	
3467	VENTOCILLA MINAYA YESENIA KARLA	10157439885	JR. LA PALMA NRO. 341 (PASAN.AV.SAN MARTIN FTE.TESOR.ATAHUALPA	
3468	VENTOSILLA QUISPE WALTER ESTANISLAO	10067594628	CAL. GRAL VARELA NRO. 1878 INT. 108 (ALT. CDRA 9 AV. BRASIL) LIMA - LI	4781548
3469	VENTURA AMASIFUEN JULIO	10707635652	CAL. A MZA. F LOTE. 02 COO. SAN JUAN DE SALINAS LIMA - LIMA - SAN MART	
3470	VERA MONTALVO ROBERTO CARLOS	10434183869	CAL. HUASCAR NRO. 1493 C.P.M PRIMERO DE MAYO LAMBAYEQUE - CHICLAYO - J	
3471	VERA TUDELA RODRIGUEZ ANA MARIA BETHSABE	10102803235	CAL. ENRIQUE PALACIOS NRO. 1051 DPTO. 701 (ALT DE LA CDRA 10 DE PARDO	
3472	VERASTEGUI MORAN JOE ANTHONY	10482717841	AV. ELIAS AGUIRRE NRO. 615 P.J. I.PACHAC. MARIANO MELGAR	943634850
3473	VERGARA CUEVA KARLA PIERINA	10460287443	JR. SANTA ROSA NRO. 768	
3474	VHL CORPORATION SAC	20426332168	AV. TINGO MARIA 874 (ALT.PUENTE TINGO MARIA CON VENEZUELA) LIMA LIMA L	 :  4255525/4255530
3475	VIBLAN S.L. - SUCURSAL DEL PERU	20554097490	MZA. H LOTE. 27 URB. SANTA ROSITA 2DA ETAPA LIMA - LIMA - ATE	985791832
3476	VICUNA OLIVERA MARISOL ROXANA	10238515110	CALLE PATIVILCA N?? 180	964827578 / 653-9863
3477	VIDEOCORP PERU S.A.C.	20519019834	CAL. JOSE RIVADENEYRA NRO. 1050 URB. SANTA CATALINA (ALT. CDRA 04 NICO	987936227
3478	VIGO MONZON ELSY ROCIO	10267079388	JR. CIRO ALEGRIA NRO. 442 BR SAN SEBASTIAN CAJAMARCA - CAJAMARCA - CAJ	976540065
3479	VILCA CONDORI DE JURADO CRELIA MARLENI	10221830054	AV. LAS AGUILAS NRO. 376 (PISO 3-ALT CDRA 7 DE LA AV RUISE??ORES) LIMA	
3480	VILCA HUAMANI NIDIA MILAGROS	10215740604	CAL. LAS ROSALES NRO. 421 MANZANILLA	
3481	VILCA RODRIGUEZ RICHARD GUSTAVO	10455500830	MZA. F LOTE. 18 A.H. 28 DE JULIO (POR BELLAVISTA) PUNO - PUNO - PUNO	
3482	VILCA SINARAHUA JOSE LUIS	10444730612	AV. OXAPAMPA S/N PUERTO BERMUDEZ	
3483	VILCHEZ HUAMANI EDUARDO GONZALO	10728807640	CAL. LOS CLAVELES NRO. 130 URB. SAN GABRIEL LIMA - LIMA - VILLA MARIA	2837256
3484	VILCHEZ LOPEZ LIZ JACKELINE	10417471699	AV. LOS HEROES NRO. 888 (2 CDRS ANT DEL C.E. 19 D ABRIL S68958581) JUN	
3485	VILLA SEMINARIO MARILYN YESICA	10433415260	MZA. B13 LOTE. 34 A.H. SAN MARTIN PIURA	
3486	VILLANES ESTEBAN JOSE ANTONIO	10179059784	AV. DEFENSORES DEL MORRO NRO. 570 INT. 27 (STAND 27) LIMA - LIMA - CHO	7243938
3487	VILLANUEVA CORDOVA SINDY KELLY	10466316992	CAL. MANCO INCA MZA. C LOTE. 12 (A 3 CDRS DE BOMBEROS)	
3488	VILLANUEVA LAZARO MARISOL TATIANA	10093144771	CAL. JR 27 NRO. 102 DPTO. 404 URB. MARISCAL CASTILLA (AL COSTADO DE LA	3722411
3489	VILLANUEVA RAMIREZ MARIA ESTHEFANY	10479332563	PJ. FRANCISCO BOLOGNESI MZA. 1 LOTE. 14 (ALT. MERCADO A??O NUEVO) LIMA	
3490	VILLEGAS CASTRO ENA MARIA	10336756133	AV. FLORES PRIMAVERA NRO. 1455 URB. LAS FLORES	
3491	VILLEGAS LOAYZA KATERINE CAROL	10464383528	AV. DEL CORREGIDOR NRO. 928 URB. REMANSO DE LA MOLINA 1 ET (ALT DE LA	
3492	VILLEGAS MEDINA MARJORIE NIKITA	10441424791	CAL. SAN AGUSTIN NRO. 322 (AL FRENTE DE LA FABRICA PEDRO P DIAZ) AREQU	
3493	VIRU RODRIGUEZ LAURA JENNIFFER	10446216894	CAL. MANUEL ANTONIO LINO NRO. 170 (ALTURA DEL COLEGIO AGROPECUARIO)	
3494	VIVAR ARIAS SABELY CATHERINE	10704394158	CAL. FLORENCIA NRO. 1491 URB. FIORI 4TA ET LIMA - LIMA - SAN MARTIN DE	987473271
3495	WILCON INTERNACIONAL SOCIEDAD ANONIMA	20550610419	AV. PETIT THOURS NRO. 5356 INT. 2054	01-4334229
3496	WONG MATOS JENNIFER	10704407721	CAL. LAS ORQUIDEAS NRO. 319 (PISO 1-ALT CDRA 19 AV.FAUCETT) PROV. CONS	
3497	YAGUILLO VICA??A NOEMI	10443704782	JR. PEDRO RUIZ GALLO NRO. S/N (A MEDIA CDRA DE LA PLAZA) AYACUCHO - LA	
3498	YANCE CARDENAS MODESTA ISABEL	10452767835	SECTOR YANIZU - PUERTO BERMUDEZ	
3499	YA??EZ ALVARADO ELIZABETH MERY	10440367912	AV. EDUARDO DE HABICH NRO. 610 URB. INGENIERIA	
3500	YA??EZ GARCIA ALEJANDRO FRANCISCO	10238581830	AV. CASCAPARO N?? 130	958-192902
3501	YATACO CHUMBIAUCA ROXANA MARIA	10106472039	AV. PASEO DE LA REPUBLICA NRO. 4886 INT. 402-B	973938705
3502	YATACO HUAMAN DEYSI GIOVANA	10416136021	AV. SUCRE NRO. 1071 DPTO. 304 (ALT DE GRIFO) LIMA - LIMA - PUEBLO LIBR	
3503	YATACO VICENTE GISSELA KATHERINEE	10455980076	CAL. SAN JOSE MZA. W LOTE. 28 URB. SAN AGUSTIN LIMA - CA??ETE - SAN VIC	
3504	YAYA GARCIA CLORINDA ELITA ANDREA	10704368769	JR. 9 DE OCTUBRE NRO. 128	
3505	YAYA PACO RICARDO ANDREE	10730903591	JR. LIMA NRO. 140 P.J. RAUL PORRAS BARRENECHEA (ALTURA KM 18) LIMA - L	985001864
3506	YEREN MORALES IVETTE KATHERINE	10420587126	BLOCK NRO. 1 INT. 203 C.H. MATIAS MANZANILLA (URB. LA MODERNA) ICA - I	237926
3507	YLIQUIN THOMAS JOSE ARTURO	10433237221	JR. MANUEL PEREZ DE TUDELA NRO. 2300 MIRONES BAJO LIMA - LIMA - LIMA	
3508	YNCA SOTO REGINA FABIOLA	10728736467	PJ. ISLAS BALLESTAS MZA. C1 LOTE. 28 A.H. PUERTO NUEVO (ALT. COLEGIO M	
3509	YNGA CASTRO JUDY	10428053317	JR. ANTONIO JOSE DE SUCRE NRO. 326 SECT FONCHILL	
3510	YNGUIL VASQUEZ KAREN PAOLA	10437200250	JR. HUANCAYO NRO. 864 (ALT. CDRA 38 AV PERU)	
3511	YTO COAGUILA JENNY VANESSA	10459840741	CAL. 27 DE JULIO NRO. 112 URB. LOS OLIVOS (A CUATRO CUADRAS DEL COLEGI	
3512	YTURRY FARGE ERIKA VANESSA	10462192393	CAL. PROFESOR JORGE MUELLE NRO. 133 INT. 303 RES. LAS TORRES DE LIMATA	2263547
3513	YUCRA MENDOZA ROSMERY YESSICA	10431056441	JR. ECUADOR NRO. 414 BARRIO UNION LLAVINI (CERCA A LA UNIVERSIDAD) PUN	
3514	YUEN VENTURO JEMIMA CESIA	10420863492	JR. FRANCISCO PIZARRO NRO. 513 A.H. BOLIVAR BAJO (FRENTE A IGLESIA FAR	
3515	ZAFRA REYES JESSICA MARIELA	10401329493	AV. ENRIQUE MEIGGS NRO. 2018 URB. SAN FERNANDO	
3516	ZAPATA CASTRO DE LOSTAUNAU SONIA DEL ROCIO	10077994519	AV. MARISCAL CASTILLA 228 LAS MAGNOLIAS - SURCO	2424824
3517	ZAPATA NAVARRO DIANA DEL PILAR	10461491095	CAL. LEONCIO PRADO NRO. 410 CENT SULLANA PIURA - SULLANA - SULLANA	
3518	ZAPATA VARILLAS BRUNO ARNALDO	10418601375	JR. LOS CIPRECES NRO. 415 URB. LOS SIRIUS 1RA. ETAPA	987341113 / 632-0697
3519	ZARATE FLORES RAFAEL JUAN	10095943417	AV. CANADA NRO. 3357 URB. JAVIER PRADO LIMA - LIMA - SAN LUIS	3461187
3520	ZARRIA LINARES GEISELL SELENE	10074645530	CAL. LOS PENSAMIENTOS NRO. 185 URB. SANTA ISABEL (AV.TUPAC AMARU PARAD	5433897
3521	ZAVALAGA VALENCIA VERONICA	10405580026	PZA. PUNKIRA MZA. H DPTO. 502 C.H. JULIO CESAR TELLO	997488998
3522	ZAVALETA OLIVARES ANGELA JESUS	10329098562	MZA. B9 LOTE. 14 URB. 21 DE ABRIL	944978540
3523	ZEGARRA HUAPAYA HERNAN ERNESTO	10406164816	JR. BONDI NRO. 450 INT. A LIMA - LIMA - PUEBLO LIBRE (MAGDALENA VIEJA)	949475030
3524	ZEGARRA NINA MIRIAM ROSA	10402073492	CAL. SAN ISIDRO -A MZA. T LOTE. 08 SAN FRANCISCO (URB. SAN ISIDRO	
3525	ZELAYA YACTAYO LIZBEHT DENISSE	10700653116	CAL. PROGRESO NRO. 257 DPTO. 2PS (COLEGIO ESTADOS UNIDOS	525-5098
3526	ZE??A ARMAS NOEMI	10032434105	AV. CORICANCHA NRO. 494 3RA ZONA TAHUANTINSUYO	
3527	ZE??A OLANO MILAGRITOS ELIZABETH	10255710147	MZA. 38 LOTE. 21 URB. EL DORAL DE TORRE BLANCA (EL DORAL DE TORRE BLAN	
3528	ZEVALLOS SANTANDER AMPARO VICTORIA	10415005976	MZA. C LOTE. 6 URB. JESUS NAZARENO AREQUIPA - AREQUIPA - SOCABAYA	
3529	ZORRILLA ARAUJO KAREN YESENIA	10455768417	JR. CUZCO NRO. 330 DPTO. 202	
3530	ZULOETA VIGO JOHANNA PAOLA	10443465087	BL. C NRO.   DPTO. 402 C.H. JOSE BALTA (4TO PISO-SUBIENDO A LA IZQ, RE	
3531	ZUNIGA FLORES JUANA ANGELA	10090334056	AV. PUNO NRO. 2596 (FRENTE A LA COMISARIA DE COMAS) LIMA - LIMA - COMA	
\.


--
-- Name: proveedor_id_proveedor_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('proveedor_id_proveedor_seq', 12008, true);


--
-- Data for Name: proveedor_nuevo; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY proveedor_nuevo (id_proveedor_n, razon_social, nit_proveedor, direccion, telefono) FROM stdin;
100	Stiv Verdugo	1551551616	Kr 80 N #73F - 72  sur 	7768019
101	Carlos Eduardo Verdugo	72100506	Kr 120 #12-12	3174815629
102	Carlos Eduardo Verdugo	72100506	Kr 120 #12-12	3174815629
103	Carlos Eduardo Verdugo	72100506	Kr 120 #12-12	3174815629
\.


--
-- Name: proveedor_nuevo_id_proveedor_n_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('proveedor_nuevo_id_proveedor_n_seq', 99, true);


--
-- Data for Name: recuperacion_entrada; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY recuperacion_entrada (id_recuperacion, observaciones, ruta_acta, nombre_acta) FROM stdin;
1	sadadad	http://localhost/administrativa/arka/blocks/inventarios/gestionEntradas/registrarEntradas/actas/3d2112_Prueba Votaciones Stiv.xlsx	Prueba Votaciones Stiv.xlsx
2	sadadad	http://localhost/administrativa/arka/blocks/inventarios/gestionEntradas/registrarEntradas/actas/f8900f_Prueba Votaciones Stiv.xlsx	Prueba Votaciones Stiv.xlsx
3	123123	http://localhost/administrativa/arka/blocks/inventarios/gestionEntradas/registrarEntradas/actas/50c875_logo100free.png	logo100free.png
\.


--
-- Name: recuperacion_entrada_id_recuperacion_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('recuperacion_entrada_id_recuperacion_seq', 3, true);


--
-- Data for Name: registro_actarecibido; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY registro_actarecibido (id_actarecibido, dependencia, fecha_recibido, tipo_bien, nitproveedor, proveedor, numfactura, fecha_factura, tipocomprador, tipoaccion, fecha_revision, revisor, observacionesacta, estado_registro, fecha_registro) FROM stdin;
1	Ingenieria	2014-10-08	1	123132123	papeleria	123312313	2014-10-10	1	1	2014-08-09	Violeta sosa	registro actualsa a s asa	1	2014-10-10
2	Administrativa	2014-10-08	1	123132123	papeleria	123312313	2014-10-10	1	1	2014-08-09	Violeta sosa	registro actualsa a s asa	1	2014-10-10
3	Doncencia	2014-10-08	1	123132123	Miselanea	123312313	2014-10-10	1	1	2014-08-09	Violeta sosa	registro actualsa a s asa	1	2014-10-10
\.


--
-- Name: registro_actarecibido_id_actarecibido_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('registro_actarecibido_id_actarecibido_seq', 1, true);


--
-- Data for Name: registro_documento; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY registro_documento (documento_id, documento_idunico, documento_nombre, documento_ruta, documento_fechar, documento_estado) FROM stdin;
1	282679-arrow-left-red.png	arrow-left-red.png	http://10.20.2.101/arka/blocks/inventarios/gestionContrato/archivoSoporte/282679-arrow-left-red.png	2014-09-26	t
1	1a2c9f-Planilla Noviembre.pdf	Planilla Noviembre.pdf	http://localhost/arka/blocks/inventarios/gestionContrato/archivoSoporte/1a2c9f-Planilla Noviembre.pdf	2015-01-05	t
2	4c2d2a-Planilla Noviembre.pdf	Planilla Noviembre.pdf	http://localhost/arka/blocks/inventarios/gestionContrato/archivoSoporte/4c2d2a-Planilla Noviembre.pdf	2015-01-05	t
3	36907b-Planilla Noviembre.pdf	Planilla Noviembre.pdf	http://localhost/arka/blocks/inventarios/gestionContrato/archivoSoporte/36907b-Planilla Noviembre.pdf	2015-01-05	t
4	5def74-esquema.sql	esquema.sql	http://localhost/arka/blocks/inventarios/gestionContrato/archivoSoporte/5def74-esquema.sql	2015-01-05	t
5	6eeba5-Planilla Noviembre.pdf	Planilla Noviembre.pdf	http://localhost/arka/blocks/inventarios/gestionContrato/archivoSoporte/6eeba5-Planilla Noviembre.pdf	2015-01-05	t
6	14599a-Planilla Noviembre.pdf	Planilla Noviembre.pdf	http://localhost/arka/blocks/inventarios/gestionContrato/archivoSoporte/14599a-Planilla Noviembre.pdf	2015-01-05	t
7	90ea52-Planilla Noviembre.pdf	Planilla Noviembre.pdf	http://localhost/arka/blocks/inventarios/gestionContrato/archivoSoporte/90ea52-Planilla Noviembre.pdf	2015-01-05	t
8	091a6d-Planilla Noviembre.pdf	Planilla Noviembre.pdf	http://localhost/arka/blocks/inventarios/gestionContrato/archivoSoporte/091a6d-Planilla Noviembre.pdf	2015-01-05	t
9	aec953-Planilla Noviembre.pdf	Planilla Noviembre.pdf	http://localhost/arka/blocks/inventarios/gestionContrato/archivoSoporte/aec953-Planilla Noviembre.pdf	2015-01-05	t
10	15efe7-Planilla Noviembre.pdf	Planilla Noviembre.pdf	http://localhost/arka/blocks/inventarios/gestionContrato/archivoSoporte/15efe7-Planilla Noviembre.pdf	2015-01-05	t
11	0191b1-Planilla Noviembre.pdf	Planilla Noviembre.pdf	http://localhost/arka/blocks/inventarios/gestionContrato/archivoSoporte/0191b1-Planilla Noviembre.pdf	2015-01-05	t
12	cf448f-esquema.sql	esquema.sql	http://localhost/arka/blocks/inventarios/gestionContrato/archivoSoporte/cf448f-esquema.sql	2015-01-05	t
14	5ddf7c-kyron_local.sql	kyron_local.sql	http://localhost/arka/blocks/inventarios/gestionContrato/archivoSoporte/5ddf7c-kyron_local.sql	2015-01-06	t
13	5dc74a-esquema.sql	esquema.sql	http://localhost/arka/blocks/inventarios/gestionContrato/archivoSoporte/5dc74a-esquema.sql	2015-01-06	t
15	1d80aa-Seminario.pdf	Seminario.pdf	http://localhost/arka/blocks/inventarios/gestionContrato/archivoSoporte/1d80aa-Seminario.pdf	2015-01-06	t
16	48b3fd-bloque.sql	bloque.sql	http://localhost/arka/blocks/inventarios/gestionContrato/archivoSoporte/48b3fd-bloque.sql	2015-01-07	t
\.


--
-- Name: registro_documento_documento_id_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('registro_documento_documento_id_seq', 16, true);


--
-- Data for Name: reposicion_entrada; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY reposicion_entrada (id_reposicion, id_entrada, id_hurto, id_salida) FROM stdin;
1	1212	12121	1212121
2	123	123	123
3	123	123	123
4	123	123	123
5	123	123	123
6	123	123	123
7	123	123	123
8	123	123	123
9	123	123	123
10	123	123	123
11	222222	888888	099999
12	000000001	888888811	777777777
13	2	12	12
14	12	12	12
15	123		
\.


--
-- Name: reposicion_entrada_id_reposicion_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('reposicion_entrada_id_reposicion_seq', 15, true);


--
-- Data for Name: rubro; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY rubro (id_rubro, nombre, codigo) FROM stdin;
1	Otros Gastos Generales Operativos	3120299
2	Afiliación Asociaciones Afines 	312029901
3	Eventos Académicos 	312029902
4	Practicas Académicas 	312029903
5	Estímulos Académicos 	312029006
6	Maestrías y Especializaciones 	312029908
7	Gastos de Transporte y Comunicación 	312029909
8	Impresos y Publicaciones 	312029910
9	Capacitación Docente 	312029914
10	Doctorado Interinstitucional en Educación 	312029923
\.


--
-- Name: rubro_id_rubro_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('rubro_id_rubro_seq', 1, false);


--
-- Data for Name: salida; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY salida (id_salida, fecha, dependencia, ubicacion, funcionario, observaciones, id_entrada) FROM stdin;
39	2015-03-20	1	1	13	asdasdassdasdasd	6
41	2015-04-05	5	2	40	Ninguna\r\n	6
38	2015-03-20	3	3	14	Salidasd	6
40	2015-03-22	6	3	8	Ninguna\r\n	6
\.


--
-- Name: salida_id_salida_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('salida_id_salida_seq', 41, true);


--
-- Data for Name: seccion; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY seccion (id_seccion, nombre) FROM stdin;
1	Seccion 1
2	Seccion 2
3	Seccion 3
4	Seccion 4
\.


--
-- Name: seccion_id_seccion_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('seccion_id_seccion_seq', 4, true);


--
-- Data for Name: sobrante_entrada; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY sobrante_entrada (id_sobrante, observaciones, ruta_acta, nombre_acta) FROM stdin;
1	123123123123	http://localhost/administrativa/arka/blocks/inventarios/gestionEntradas/registrarEntradas/actas/b00d40_Voto Prueba.ods	Voto Prueba.ods
2	123123123	http://localhost/administrativa/arka/blocks/inventarios/gestionEntradas/registrarEntradas/actas/4a80e5_kyron_docencia.backup	kyron_docencia.backup
3	123123123	http://localhost/administrativa/arka/blocks/inventarios/gestionEntradas/registrarEntradas/actas/ed3746_kyron_docencia.backup	kyron_docencia.backup
4	123123123	http://localhost/administrativa/arka/blocks/inventarios/gestionEntradas/registrarEntradas/actas/a100a5_kyron_docencia.backup	kyron_docencia.backup
5	123123123	http://localhost/administrativa/arka/blocks/inventarios/gestionEntradas/registrarEntradas/actas/9fd27c_kyron_docencia.backup	kyron_docencia.backup
6	123123123	http://localhost/administrativa/arka/blocks/inventarios/gestionEntradas/registrarEntradas/actas/0a2ec8_kyron_docencia.backup	kyron_docencia.backup
7	123123123	http://localhost/administrativa/arka/blocks/inventarios/gestionEntradas/registrarEntradas/actas/8a1fd7_kyron_docencia.backup	kyron_docencia.backup
8	123123123	http://localhost/administrativa/arka/blocks/inventarios/gestionEntradas/registrarEntradas/actas/4bb7f7_kyron_docencia.backup	kyron_docencia.backup
9	123123	http://localhost/administrativa/arka/blocks/inventarios/gestionEntradas/registrarEntradas/actas/085669_index.php	index.php
10			
\.


--
-- Name: sobrante_entrada_id_sobrante_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('sobrante_entrada_id_sobrante_seq', 10, true);


--
-- Data for Name: solicitante_servicios; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY solicitante_servicios (id_solicitante, dependencia, rubro) FROM stdin;
1	123	123
2	123	123
3	123	123
4	123	123
5	123	123
6	123	123
7	123	123
8	123	123
9	123	123
10	123	123
11	123	123
12	123	123
13	123	123
14	123	123
15	123	123
16	123	123
17	123	123
18	123	123
19		
20	123	123
21		
22	678	678
23	asdasdasdasd	stiv
25	123	123
26	123	123
27	123	123
28	123	123
24	stiv verdugoasdasdasd	123123
29	123123	123
30	12321	123123
31	123	123
32		
33		
34		
35		
36		
37		
38		
39		
40		
41		
42		
43		
44	1	5
\.


--
-- Name: solicitante_servicios_id_solicitante_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('solicitante_servicios_id_solicitante_seq', 44, true);


--
-- Data for Name: supervisor_servicios; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY supervisor_servicios (id_supervisor, nombre, cargo, dependencia) FROM stdin;
1	123	123	123
2	123	123	123
3	123	123	123
4	123	123	123
5	123	123	123
6	123	123	123
7	123	123	123
8	123	123	123
9	123	123	123
10	123	123	123
11	123	123	123
12	123	123	123
13	123	123	123
14	123	123	123
15	123	123	123
16	123	123	123
17	123	123	123
18			
19	123	123	123
20			
21	678	678	678
22	ñlkñlk	ñlkñlk	ñlkñlkñl
24	123	123	123
25	123	213	123
26	123	213	123
27	123	213	123
23	123	123123	123123
28	123	123	123
29	123123	123123	123123
30	123	123	123
31			
32			
33			
34			
35			
36			
37			
38			
39			
40	Paulo Cesar Coronado	Jefe de Sistemas	365
41	Paulo Cesar Coronado	Jefe Sistemas	365
42	Paulo Cesar Coronado	Jefe Sistemas	365
43	Paulo Cesar Coronado	Jefe Sistemas	365
44	Paulo Cesar Coronado	Jefe Sistemas	365
45	Paulo Cesar Coronado	Jefe Sistemas	365
46	Paulo Cesar Coronado	Jefe Sistemas	365
47	Paulo Cesar Coronado	Jefe Sistemas	365
48	Paulo Cesar Coronado	Jefe Sistemas	365
49	Paulo Cesar Coronado	Jefe Sistemas	365
50	Paulo Cesar Coronado	Jefe Sistemas	365
51	Paulo Cesar Coronado	Jefe Sistemas	365
52	Paulo Cesar Coronado	Jefe Sistemas	365
53	Paulo Cesar Coronado	Jefe Sistemas	365
54	Stiv Verdugp	Jafe LIST	1
55	Stiv Verdugp	Jafe LIST	1
56	Stiv Verdugp	Jafe LIST	1
57	Paulo Cesar	Jafe LIST	21
58	Paulo Cesar Coronado	Jefe Sistemas	365
59	Paulo Cesar Coronado	Jefe Sistemas	365
60	PARRA VALDERRAMA SNADRA ISABEL	Jefe	3
61		Jefe	4
62		Jefe	4
63	CORONADO SANCHEZ PAULO CESAR	JEFE 	40
64	CORONADO SANCHEZ PAULO CESAR	JEFE 	40
65	CORONADO SANCHEZ PAULO CESAR	JEFE 	40
66	CORONADO SANCHEZ PAULO CESAR	JEFE 	40
67	CORONADO SANCHEZ PAULO CESAR	JEFE 	40
68	CORONADO SANCHEZ PAULO CESAR	JEFE 	40
69	CORONADO SANCHEZ PAULO CESAR	JEFE 	40
70	DIAZ LOZANO AURA YOLANDA	JEFE 	40
\.


--
-- Name: supervisor_servicios_id_supervisor_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('supervisor_servicios_id_supervisor_seq', 70, true);


--
-- Data for Name: tipo_bien; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY tipo_bien (tb_idbien, tb_descripcion, tb_estado, tb_registro) FROM stdin;
1	Consumo	1	2014-10-14
2	Consulmo Controlado	1	2014-10-14
3	Devolutivo	1	2014-10-14
\.


--
-- Name: tipo_bien_tb_idbien_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('tipo_bien_tb_idbien_seq', 3, true);


--
-- Data for Name: tipo_bienes; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY tipo_bienes (id_tipo_bienes, descripcion) FROM stdin;
1	Consumo
2	Consulmo Controlado
3	Devolutivo
\.


--
-- Name: tipo_bienes_id_tipo_bienes_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('tipo_bienes_id_tipo_bienes_seq', 3, true);


--
-- Data for Name: tipo_cargo; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY tipo_cargo (id_cargo, descripcion) FROM stdin;
1	Jefe de Almacén
2	Jefe Contabilidad
3	Jefe de Compras
4	Jefe  de Recursos Fisicos
\.


--
-- Name: tipo_cargo_id_cargo_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('tipo_cargo_id_cargo_seq', 4, true);


--
-- Data for Name: tipo_contrato; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY tipo_contrato (id_tipo, descripcion) FROM stdin;
1	Avances
2	Orden de Servicio 
3	Orden Compras
4	Contratos(ViceRectoria)
5	Por Aseguradora
\.


--
-- Name: tipo_contrato_id_tipo_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('tipo_contrato_id_tipo_seq', 3, true);


--
-- Data for Name: tipo_encargado; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY tipo_encargado (id_tipo_encargado, descripcion) FROM stdin;
1	Ordenador Gasto
2	Jefe de Sección
3	Contratista
\.


--
-- Name: tipo_encargado_id_tipo_encargado_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('tipo_encargado_id_tipo_encargado_seq', 6, true);


--
-- Data for Name: tipo_falt_sobr; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY tipo_falt_sobr (id_tipo_falt_sobr, descripcion) FROM stdin;
1	Sobrante
2	Faltante por Hurto
3	Faltante Dependencia
4	Baja
\.


--
-- Name: tipo_falt_sobr_id_tipo_falt_sobr_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('tipo_falt_sobr_id_tipo_falt_sobr_seq', 4, true);


--
-- Data for Name: tipo_mueble; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY tipo_mueble (id_tipo_mueble, descripcion) FROM stdin;
1	Mueble
2	Electrónico
\.


--
-- Name: tipo_mueble_id_tipo_mueble_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('tipo_mueble_id_tipo_mueble_seq', 2, true);


--
-- Data for Name: tipo_ordenador_gasto; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY tipo_ordenador_gasto (id_ordenador, descripcion) FROM stdin;
1	Rector 
2	Vicerector Administrativo
3	Decano 
4	Vicerector Académico
5	Vicerector Financiero
6	Secretario General
7	Director IDEXUD
8	Vicerector de Investigaciones
9	Director de Centro de Invetigaciones
\.


--
-- Name: tipo_ordenador_gasto_id_ordenador_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('tipo_ordenador_gasto_id_ordenador_seq', 9, true);


--
-- Data for Name: tipo_poliza; Type: TABLE DATA; Schema: arka_inventarios; Owner: arka_inventarios
--

COPY tipo_poliza (id_tipo_poliza, descripcion) FROM stdin;
2	De Calidad
1	No Aplica
\.


--
-- Name: tipo_poliza_id_tipo_poliza_seq; Type: SEQUENCE SET; Schema: arka_inventarios; Owner: arka_inventarios
--

SELECT pg_catalog.setval('tipo_poliza_id_tipo_poliza_seq', 1, false);


SET search_path = public, pg_catalog;

--
-- Data for Name: arka_bloque; Type: TABLE DATA; Schema: public; Owner: arka_frame
--

COPY arka_bloque (id_bloque, nombre, descripcion, grupo) FROM stdin;
-9	codificador                                       	Módulo para decodificar cadenas.                                                                                                                                                                                                                               	development                                                                                                                                                                                             
-8	contenidoCentral                                  	Contenido página principal de desarrollo.                                                                                                                                                                                                                      	development                                                                                                                                                                                             
-7	constructor                                       	Módulo para diseñar páginas.                                                                                                                                                                                                                                   	development                                                                                                                                                                                             
-6	registro                                          	Módulo para registrar páginas o módulos.                                                                                                                                                                                                                       	development                                                                                                                                                                                             
-5	desenlace                                         	Módulo de gestión de desenlace.                                                                                                                                                                                                                                	development                                                                                                                                                                                             
-4	cruder                                            	Módulo para crear módulos CRUD.                                                                                                                                                                                                                                	development                                                                                                                                                                                             
-3	banner                                            	Banner módulo de desarrollo.                                                                                                                                                                                                                                   	development                                                                                                                                                                                             
-1	menuLateral                                       	Menú lateral módulo de desarrollo.                                                                                                                                                                                                                             	development                                                                                                                                                                                             
1	loginArka                                         	Login Principal                                                                                                                                                                                                                                                	registro                                                                                                                                                                                                
2	pie                                               	Pie de pagina                                                                                                                                                                                                                                                  	gui                                                                                                                                                                                                     
3	menu                                              	menu sistema Arka                                                                                                                                                                                                                                              	gui                                                                                                                                                                                                     
4	registrarOrdenCompra                              	Bloque que permite la gestion de Compras                                                                                                                                                                                                                       	inventarios/gestionCompras                                                                                                                                                                              
5	consultaOrdenCompra                               	Bloque que permite la gestionde consulta y modificación de las Ordenes deCompras                                                                                                                                                                               	inventarios/gestionCompras                                                                                                                                                                              
6	gestionContrato                                   	Bloque para subida de contratos para compras                                                                                                                                                                                                                   	inventarios                                                                                                                                                                                             
7	registrarOrdenServicios                           	Bloque que permite el registro deOrdenes deServicios                                                                                                                                                                                                           	inventarios/gestionCompras                                                                                                                                                                              
8	consultaOrdenServicios                            	Bloque que permite el Consulta y Modificación deOrdenes deServicios                                                                                                                                                                                            	inventarios/gestionCompras                                                                                                                                                                              
10	registrarActa                                     	Bloque para registrar acta recibido del bien                                                                                                                                                                                                                   	inventarios/gestionActa                                                                                                                                                                                 
11	registrarEntradas                                 	Bloque que permite el registro de la Entrada                                                                                                                                                                                                                   	inventarios/gestionEntradas                                                                                                                                                                             
12	consultaEntradas                                  	Bloque que permite el registro de la Entrada                                                                                                                                                                                                                   	inventarios/gestionEntradas                                                                                                                                                                             
13	modificarEntradas                                 	Bloque que permite el registro de la Entrada                                                                                                                                                                                                                   	inventarios/gestionEntradas                                                                                                                                                                             
14	catalogo                                          	Bloque para gestionar catalogos                                                                                                                                                                                                                                	inventarios                                                                                                                                                                                             
15	consultarActa                                     	Bloque para consultar y modificar registros de acta                                                                                                                                                                                                            	inventarios/gestionActa                                                                                                                                                                                 
16	radicarAsignar                                    	Bloque para gestionar radicados                                                                                                                                                                                                                                	inventarios                                                                                                                                                                                             
18	registrarSalidas                                  	Bloque que permite el registro de Salidas del Almacen                                                                                                                                                                                                          	inventarios/gestionSalidas                                                                                                                                                                              
19	modificarSalidas                                  	Bloque que permite el Modificar de Salidas del Almacen                                                                                                                                                                                                         	inventarios/gestionSalidas                                                                                                                                                                              
20	reportico                                         	Bloque para gestionar reportes                                                                                                                                                                                                                                 	inventarios                                                                                                                                                                                             
21	registrarElemento                                 	bloque que permite la carga de elementos                                                                                                                                                                                                                       	inventarios/gestionElementos                                                                                                                                                                            
22	modificarElemento                                 	bloque que permite consulta y modificacion de elementos                                                                                                                                                                                                        	inventarios/gestionElementos                                                                                                                                                                            
23	asignarInventario                                 	bloque para asignar inventarios                                                                                                                                                                                                                                	inventarios/asignarInventarioC                                                                                                                                                                          
24	descargarInventario                               	bloque para dar paso al paz y salvo                                                                                                                                                                                                                            	inventarios/asignarInventarioC                                                                                                                                                                          
25	radicarEntradaSalida                              	bloque para gestionar entraday salida de elementos                                                                                                                                                                                                             	inventarios                                                                                                                                                                                             
26	consultarAsignacion                               	bloque para modificar los elementos de un contratista                                                                                                                                                                                                          	inventarios/asignarInventarioC                                                                                                                                                                          
27	bannerUsuario                                     	bloque para mostrar la zona del banner                                                                                                                                                                                                                         	gui                                                                                                                                                                                                     
28	registrarTraslados                                	Bloque que permite el Registro de Traslados de los Elementos                                                                                                                                                                                                   	inventarios/gestionElementos                                                                                                                                                                            
29	registrarFaltantesSobrantes                       	Bloque que permite registrar los estados de sobrante y faltantes de un Elemento                                                                                                                                                                                	inventarios/gestionElementos                                                                                                                                                                            
-2	pie2                                              	Pie de página módulo de desarrollo.                                                                                                                                                                                                                            	development                                                                                                                                                                                             
30	registrarBajas                                    	Bloque que permite el Registro de Bajas de  Elementos                                                                                                                                                                                                          	inventarios/gestionElementos                                                                                                                                                                            
\.


--
-- Name: arka_bloque_id_bloque_seq; Type: SEQUENCE SET; Schema: public; Owner: arka_frame
--

SELECT pg_catalog.setval('arka_bloque_id_bloque_seq', 68, true);


--
-- Data for Name: arka_bloque_pagina; Type: TABLE DATA; Schema: public; Owner: arka_frame
--

COPY arka_bloque_pagina (idrelacion, id_pagina, id_bloque, seccion, posicion) FROM stdin;
1	-1	-1	B	1
2	-1	-2	E	1
3	-1	-3	A	1
4	-1	-8	C	1
5	-2	-1	B	1
6	-2	-2	E	1
7	-2	-3	A	1
8	-2	-4	C	1
9	-3	-1	B	1
10	-3	-2	E	1
11	-3	-3	A	1
12	-3	-5	C	1
13	-4	-1	B	1
14	-4	-2	E	1
15	-4	-3	A	1
16	-4	-9	C	1
17	-5	-1	B	1
18	-5	-2	E	1
19	-5	-3	A	1
20	-5	-6	C	1
21	-6	-1	B	1
22	-6	-2	E	1
23	-6	-3	A	1
24	-6	-7	C	1
25	1	1	C	1
26	2	2	E	1
27	3	2	E	1
28	4	2	E	1
29	2	3	A	2
30	5	3	A	2
31	5	4	C	1
32	5	2	E	1
33	6	3	A	2
34	6	2	E	1
35	6	6	C	1
36	7	3	A	2
37	7	5	C	1
38	7	2	E	1
39	8	3	A	2
40	8	7	C	1
41	8	2	E	1
42	9	3	A	2
43	9	8	C	1
44	9	2	E	1
45	10	10	C	1
46	10	3	A	2
47	10	2	E	1
48	11	2	E	1
49	11	11	C	1
50	11	3	A	2
51	12	2	E	1
52	12	12	C	1
53	12	3	A	2
54	14	3	C	0
55	14	14	C	1
56	15	15	C	1
57	15	3	A	2
58	15	2	E	1
59	13	2	E	1
60	13	3	A	2
61	13	13	C	1
62	16	16	C	1
63	16	3	A	2
64	16	2	E	1
68	18	18	C	1
69	18	2	E	1
70	18	3	A	2
71	19	19	C	1
72	19	2	E	1
73	19	3	A	2
74	20	20	C	1
75	20	2	E	1
76	20	3	A	2
77	21	3	A	2
78	21	21	C	1
79	21	2	E	1
80	22	3	A	2
81	22	22	C	1
82	22	2	E	1
83	23	23	C	1
84	23	2	E	1
85	23	3	A	2
86	24	24	C	1
87	24	3	A	2
88	24	2	E	1
89	25	25	C	1
90	25	2	E	1
91	25	3	A	2
92	26	3	A	2
93	26	2	E	1
94	26	26	C	1
95	2	27	A	1
96	10	27	A	1
97	2	27	A	1
98	8	27	A	1
99	25	27	A	1
100	24	27	A	1
101	23	27	A	1
102	7	27	A	1
103	22	27	A	1
104	21	27	A	1
105	11	27	A	1
106	20	27	A	1
107	12	27	A	1
108	6	27	A	1
109	15	27	A	1
110	19	27	A	1
111	18	27	A	1
112	13	27	A	1
113	9	27	A	1
114	16	27	A	1
115	5	27	A	1
116	26	27	A	1
117	27	28	C	1
118	27	2	E	1
119	27	3	A	2
120	27	27	A	1
121	28	29	C	1
122	28	2	E	1
123	28	3	A	2
124	28	27	A	1
125	29	30	C	1
126	29	2	E	1
127	29	3	A	2
128	29	27	A	1
\.


--
-- Name: arka_bloque_pagina_idrelacion_seq; Type: SEQUENCE SET; Schema: public; Owner: arka_frame
--

SELECT pg_catalog.setval('arka_bloque_pagina_idrelacion_seq', 29, true);


--
-- Data for Name: arka_configuracion; Type: TABLE DATA; Schema: public; Owner: arka_frame
--

COPY arka_configuracion (id_parametro, parametro, valor) FROM stdin;
1	dbesquema                                                                                                                                                                                                                                                      	public                                                                                                                                                                                                                                                         
2	prefijo                                                                                                                                                                                                                                                        	arka_                                                                                                                                                                                                                                                          
3	nombreAplicativo                                                                                                                                                                                                                                               	Sistema Gestión Almacén y Inventarios                                                                                                                                                                                                                          
7	nombreAdministrador                                                                                                                                                                                                                                            	administrador                                                                                                                                                                                                                                                  
8	claveAdministrador                                                                                                                                                                                                                                             	L5CqsOyro0VQVAj0sSBie1MvJXmlqypM7WuEpeEfbt4=                                                                                                                                                                                                                   
9	correoAdministrador                                                                                                                                                                                                                                            	stiv@as.com                                                                                                                                                                                                                                                    
10	enlace                                                                                                                                                                                                                                                         	data                                                                                                                                                                                                                                                           
12	moduloDesarrollo                                                                                                                                                                                                                                               	moduloDesarrollo                                                                                                                                                                                                                                               
13	googlemaps                                                                                                                                                                                                                                                     	                                                                                                                                                                                                                                                               
14	recatchapublica                                                                                                                                                                                                                                                	                                                                                                                                                                                                                                                               
4	raizDocumento                                                                                                                                                                                                                                                  	/usr/local/apache/htdocs/arka                                                                                                                                                                                                                                  
6	site                                                                                                                                                                                                                                                           	/arka                                                                                                                                                                                                                                                          
15	recatchaprivada                                                                                                                                                                                                                                                	                                                                                                                                                                                                                                                               
17	instalado                                                                                                                                                                                                                                                      	true                                                                                                                                                                                                                                                           
18	debugMode                                                                                                                                                                                                                                                      	false                                                                                                                                                                                                                                                          
19	dbPrincipal                                                                                                                                                                                                                                                    	arka                                                                                                                                                                                                                                                           
20	hostSeguro                                                                                                                                                                                                                                                     	https://localhost                                                                                                                                                                                                                                              
11	estiloPredeterminado                                                                                                                                                                                                                                           	smoothness                                                                                                                                                                                                                                                     
16	expiracion                                                                                                                                                                                                                                                     	1                                                                                                                                                                                                                                                              
5	host                                                                                                                                                                                                                                                           	http://localhost                                                                                                                                                                                                                                               
\.


--
-- Name: arka_configuracion_id_parametro_seq; Type: SEQUENCE SET; Schema: public; Owner: arka_frame
--

SELECT pg_catalog.setval('arka_configuracion_id_parametro_seq', 20, true);


--
-- Data for Name: arka_dbms; Type: TABLE DATA; Schema: public; Owner: arka_frame
--

COPY arka_dbms (idconexion, nombre, dbms, servidor, puerto, conexionssh, db, esquema, usuario, password) FROM stdin;
1	estructura	pgsql	localhost	5432		arka	public	arka_frame	LnHO0stMVuVlsQK4jJHXB9kQNASvMBhmiWHA2f5AuTw
2	inventarios	pgsql	localhost	5432		arka	arka_inventarios	arka_inventarios	5Tr58Y37FXOua8IlDFXwhDGh7BNSZzmO2AExESe9WvQ
3	sicapital	oci8	10.20.0.7	1521		PROD_SIC		sicaarka	yBUhul9MoqZNguqA-3--QVkoKzlJ61q75KGXQK_ft98
\.


--
-- Name: arka_dbms_idconexion_seq; Type: SEQUENCE SET; Schema: public; Owner: arka_frame
--

SELECT pg_catalog.setval('arka_dbms_idconexion_seq', 10, true);


--
-- Data for Name: arka_estilo; Type: TABLE DATA; Schema: public; Owner: arka_frame
--

COPY arka_estilo (usuario, estilo) FROM stdin;
\.


--
-- Data for Name: arka_logger; Type: TABLE DATA; Schema: public; Owner: arka_frame
--

COPY arka_logger (id_usuario, evento, fecha) FROM stdin;
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-03  02:55:53 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-03  03:11:50 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-03  04:42:40 PM                           
1100000	[]                                                                                                                                                                                                                                                             	2015-02-03  04:50:44 PM                           
1100000	[]                                                                                                                                                                                                                                                             	2015-02-03  04:50:57 PM                           
1100000	[]                                                                                                                                                                                                                                                             	2015-02-03  04:51:42 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-03  04:57:10 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-03  04:59:32 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-03  05:09:17 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-03  05:10:00 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-03  05:54:24 PM                           
1100000	[]                                                                                                                                                                                                                                                             	2015-02-03  05:54:41 PM                           
1100000	["claveNoValida","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                              	2015-02-03  06:00:34 PM                           
1100000	["claveNoValida","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                              	2015-02-04  10:33:24 AM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-04  11:21:33 AM                           
1100000	["claveNoValida","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                              	2015-02-04  12:14:30 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-04  12:23:10 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-04  12:47:55 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-04  02:16:03 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-10  10:41:56 AM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-10  10:44:52 AM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-10  02:38:41 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-10  04:13:58 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-10  05:12:06 PM                           
1100000	["autenticacionExitosa","1100000","10.20.4.15","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                      	2015-02-12  09:48:21 AM                           
1100000	["autenticacionExitosa","1100000","10.20.4.15","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                      	2015-02-12  09:48:42 AM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-16  10:12:37 AM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-16  10:22:32 AM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-16  10:35:48 AM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-16  01:01:40 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-16  01:17:51 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-16  03:36:28 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-18  03:18:38 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-20  02:48:58 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-20  02:56:13 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-20  03:06:21 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-20  03:07:18 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-20  03:34:57 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-20  04:01:10 PM                           
1100000	["claveNoValida","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                              	2015-02-20  04:12:46 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-20  04:12:53 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Opera\\/9.80 (X11; Linux x86_64) Presto\\/2.12.388 Version\\/12.16"]                                                                                                                                               	2015-02-20  04:43:52 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                       	2015-02-20  05:56:46 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Fedora; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                               	2015-02-23  09:07:32 AM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Fedora; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                               	2015-02-23  11:36:42 AM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Fedora; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                               	2015-02-23  11:38:18 AM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Fedora; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                               	2015-02-23  12:22:40 PM                           
1100000	["claveNoValida","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Fedora; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                      	2015-02-24  11:57:24 AM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Fedora; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                               	2015-02-24  11:57:33 AM                           
1100000	["claveNoValida","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Fedora; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                                      	2015-02-25  03:11:58 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Fedora; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                               	2015-02-25  03:12:06 PM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Mozilla\\/5.0 (X11; Fedora; Linux x86_64; rv:35.0) Gecko\\/20100101 Firefox\\/35.0"]                                                                                                                               	2015-02-26  04:17:52 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-02  02:17:23 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-02  02:43:05 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-02  03:17:48 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/38.0.2125.111 Safari\\/537.36"]                                                                                                       	2015-03-02  03:23:12 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-02  04:30:50 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-02  05:06:10 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/38.0.2125.111 Safari\\/537.36"]                                                                                                       	2015-03-02  05:29:28 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-02  05:33:10 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-02  07:01:02 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-03  10:05:14 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-03  10:09:54 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-03  06:51:57 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-03  07:56:23 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-03  04:31:08 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/38.0.2125.111 Safari\\/537.36"]                                                                                                       	2015-03-03  10:04:31 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-04  03:34:42 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/38.0.2125.111 Safari\\/537.36"]                                                                                                       	2015-03-08  12:09:02 AM                           
1100000	["claveNoValida","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                                    	2015-03-08  12:19:18 AM                           
1100000	["claveNoValida","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                                    	2015-03-08  12:19:25 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-08  12:20:26 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-08  01:14:46 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-08  02:04:55 PM                           
1100000	["claveNoValida","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                                    	2015-03-08  02:39:35 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-08  02:39:43 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-08  03:13:47 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-08  04:10:26 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-08  08:21:29 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-09  02:18:54 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-09  05:06:55 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-09  06:58:55 AM                           
1100000	["claveNoValida","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                                    	2015-03-09  02:37:45 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-09  02:37:53 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-10  01:16:30 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-10  11:06:44 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-10  06:09:06 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-11  12:58:29 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-11  06:49:32 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-11  07:15:18 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-11  10:44:05 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-12  01:41:45 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-12  08:15:25 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-12  01:18:20 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-13  12:06:01 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-13  01:49:01 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-13  02:38:51 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-15  09:07:27 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-15  11:38:41 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-17  12:18:14 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-17  08:14:17 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-17  11:17:33 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-18  06:31:28 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-18  06:54:07 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-19  12:24:01 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-19  01:18:32 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-19  01:24:25 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-19  01:26:26 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-19  02:07:05 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-20  07:49:23 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-20  08:15:36 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-20  08:48:10 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-22  09:24:11 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-22  09:35:02 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-23  10:17:11 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-23  10:41:06 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-24  08:24:27 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/38.0.2125.111 Safari\\/537.36"]                                                                                                       	2015-03-24  08:30:08 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-24  08:43:57 AM                           
1100000	["autenticacionExitosa","1100000","127.0.0.1","Opera\\/9.80 (X11; Linux x86_64) Presto\\/2.12.388 Version\\/12.16"]                                                                                                                                               	2015-03-24  08:44:26 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-24  10:05:39 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-24  10:52:42 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-24  11:03:34 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-24  11:04:55 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-24  11:20:31 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-25  08:05:09 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-26  12:53:46 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-26  01:01:27 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-27  08:54:51 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-27  11:31:28 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-29  07:26:01 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-29  08:20:13 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-29  08:29:44 PM                           
1100000	["claveNoValida","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                                    	2015-03-29  08:53:54 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-29  08:54:11 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-29  09:44:05 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-30  12:26:54 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-30  02:03:45 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-30  02:51:45 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-30  03:09:17 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-30  04:28:46 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-30  05:21:35 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-31  03:30:01 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-31  03:32:20 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-31  10:27:04 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-03-31  10:29:06 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-04-02  08:25:38 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-04-03  10:01:27 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-04-03  10:44:13 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-04-03  11:53:56 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-04-04  10:19:28 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-04-05  07:39:38 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-04-05  09:45:49 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-04-06  11:13:30 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-04-06  11:28:57 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-04-06  11:39:08 PM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-04-07  12:41:50 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-04-07  01:07:14 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-04-07  02:53:16 AM                           
1100000	["autenticacionExitosa","1100000","::1","Mozilla\\/5.0 (X11; Linux x86_64; rv:31.0) Gecko\\/20100101 Firefox\\/31.0"]                                                                                                                                             	2015-04-07  10:09:13 AM                           
\.


--
-- Name: arka_logger_id_usuario_seq; Type: SEQUENCE SET; Schema: public; Owner: arka_frame
--

SELECT pg_catalog.setval('arka_logger_id_usuario_seq', 1, false);


--
-- Data for Name: arka_pagina; Type: TABLE DATA; Schema: public; Owner: arka_frame
--

COPY arka_pagina (id_pagina, nombre, descripcion, modulo, nivel, parametro) FROM stdin;
-6	constructor                                       	Diseñar páginas.                                                                                                                                                                                                                                          	development                                       	0	jquery=true                                                                                                                                                                                                                                                    
-5	registro                                          	Registrar páginas o módulos.                                                                                                                                                                                                                              	development                                       	0	jquery=true                                                                                                                                                                                                                                                    
-4	codificador                                       	Codificar/decodificar cadenas.                                                                                                                                                                                                                            	development                                       	0	jquery=true                                                                                                                                                                                                                                                    
-3	desenlace                                         	Analizar enlaces.                                                                                                                                                                                                                                         	development                                       	0	jquery=true                                                                                                                                                                                                                                                    
-2	cruder                                            	Generador módulos CRUD.                                                                                                                                                                                                                                   	development                                       	0	jquery=true                                                                                                                                                                                                                                                    
-1	development                                       	Index módulo de desarrollo.                                                                                                                                                                                                                               	development                                       	0	jquery=true                                                                                                                                                                                                                                                    
1	index                                             	Pagina Principal                                                                                                                                                                                                                                          	general                                           	0	jquery=true                                                                                                                                                                                                                                                    
2	indexAlmacen                                      	Pagina principal almacen                                                                                                                                                                                                                                  	almacen                                           	0	jquery=true                                                                                                                                                                                                                                                    
3	indexInventarios                                  	Pagina principal inventarios                                                                                                                                                                                                                              	inventarios                                       	0	jquery=true                                                                                                                                                                                                                                                    
4	indexContabilidad                                 	Pagina principal contabilidad                                                                                                                                                                                                                             	contabilidad                                      	0	jquery=true                                                                                                                                                                                                                                                    
5	registrarOrdenCompra                              	Pagni que permite el registro de orden de Compra                                                                                                                                                                                                          	gestión Compras                                   	0	jquery=true                                                                                                                                                                                                                                                    
6	gestionContrato                                   	Pagina para gestionar contratos                                                                                                                                                                                                                           	inventarios                                       	0	jquery=true                                                                                                                                                                                                                                                    
7	consultaOrdenCompra                               	Pagina que permite la Consulta y Modificación de orden de Compra                                                                                                                                                                                          	gestión Compras                                   	0	jquery=true                                                                                                                                                                                                                                                    
8	registrarOrdenServicios                           	Pagina que permite el registrode orden de Servicios                                                                                                                                                                                                       	gestión Compras                                   	0	jquery=true                                                                                                                                                                                                                                                    
9	consultaOrdenServicios                            	Pagina que permite el consulta y modificacionde orden de Servicios                                                                                                                                                                                        	gestión Compras                                   	0	jquery=true                                                                                                                                                                                                                                                    
10	registrarActa                                     	Pagina para registrar acta de recibido del bien                                                                                                                                                                                                           	gestión Acta                                      	0	jquery=true                                                                                                                                                                                                                                                    
11	registrarEntradas                                 	Pagina que permite el registro de Entradas                                                                                                                                                                                                                	gestión Entradas                                  	0	jquery=true                                                                                                                                                                                                                                                    
12	consultaEntradas                                  	Pagina que permite el consultar y asiganar el estadode Entradas                                                                                                                                                                                           	gestión Entradas                                  	0	jquery=true                                                                                                                                                                                                                                                    
13	modificarEntradas                                 	Pagina que permite el modificar las Entradas                                                                                                                                                                                                              	gestión Entradas                                  	0	jquery=true                                                                                                                                                                                                                                                    
14	catalogo                                          	Pagina de gestion de catalogos                                                                                                                                                                                                                            	gestión catalogo                                  	0	jquery=true                                                                                                                                                                                                                                                    
15	consultarActa                                     	Pagina para gestionarl registros de acta de recibido                                                                                                                                                                                                      	gestiòn Acta                                      	0	jquery=true                                                                                                                                                                                                                                                    
16	radicarAsignar                                    	Pagina para gestionar radicados                                                                                                                                                                                                                           	gestion radicacion                                	0	jquery=true                                                                                                                                                                                                                                                    
18	registrarSalidas                                  	Pagina que permite el registro de salidas                                                                                                                                                                                                                 	gestión Salidas                                   	0	jquery=true                                                                                                                                                                                                                                                    
19	modificarSalidas                                  	Pagina que permite el Consulta y Modificar Salidas                                                                                                                                                                                                        	gestión Salidas                                   	0	jquery=true                                                                                                                                                                                                                                                    
20	reportico                                         	Pagina para gestionar reportes                                                                                                                                                                                                                            	gestión reportes                                  	0	jquery=true                                                                                                                                                                                                                                                    
21	registrarElemento                                 	Pagina que permite el registro de elementos                                                                                                                                                                                                               	gestion Elementos                                 	0	jquery=true                                                                                                                                                                                                                                                    
22	modificarElemento                                 	Pagina que permite el consulta y modificación de elementos                                                                                                                                                                                                	gestion Elementos                                 	0	jquery=true                                                                                                                                                                                                                                                    
23	asignarInventarioC                                	Pagina para asignar inventarios                                                                                                                                                                                                                           	gestion asignar inventarios                       	0	jquery=true                                                                                                                                                                                                                                                    
24	descargarInventario                               	Pagina para dar paso al paz y salvo al eliminar elementos asignados                                                                                                                                                                                       	gestión asignar inventarios                       	0	jquery=true                                                                                                                                                                                                                                                    
25	radicarEntradaSalida                              	Pagina para gestionar la radcacion de entrada y salida de elementos                                                                                                                                                                                       	gestión radicación                                	0	jquery=true                                                                                                                                                                                                                                                    
26	consultarAsignacion                               	Pagina para modificar los elementos asignados a un contratista                                                                                                                                                                                            	gestión asignar inventarios                       	0	jquery=true                                                                                                                                                                                                                                                    
27	registrarTraslados                                	Pagina registrar el traslado de los Elementos                                                                                                                                                                                                             	gestion Movimientos Elementos                     	0	jquery=true                                                                                                                                                                                                                                                    
28	registrarFaltantesSobrantes                       	Pagina para el registro de los estados de Faltante y sobrantes de los Elementos                                                                                                                                                                           	gestion Movimientos Elementos                     	0	jquery=true                                                                                                                                                                                                                                                    
29	registrarBajas                                    	Pagina registrar bajas de los Elementos                                                                                                                                                                                                                   	gestion Movimientos Elementos                     	0	jquery=true                                                                                                                                                                                                                                                    
\.


--
-- Name: arka_pagina_id_pagina_seq; Type: SEQUENCE SET; Schema: public; Owner: arka_frame
--

SELECT pg_catalog.setval('arka_pagina_id_pagina_seq', 12, true);


--
-- Data for Name: arka_subsistema; Type: TABLE DATA; Schema: public; Owner: arka_frame
--

COPY arka_subsistema (id_subsistema, nombre, etiqueta, id_pagina, observacion) FROM stdin;
\.


--
-- Name: arka_subsistema_id_subsistema_seq; Type: SEQUENCE SET; Schema: public; Owner: arka_frame
--

SELECT pg_catalog.setval('arka_subsistema_id_subsistema_seq', 1, false);


--
-- Data for Name: arka_tempformulario; Type: TABLE DATA; Schema: public; Owner: arka_frame
--

COPY arka_tempformulario (id_sesion, formulario, campo, valor, fecha) FROM stdin;
\.


--
-- Data for Name: arka_usuario; Type: TABLE DATA; Schema: public; Owner: arka_frame
--

COPY arka_usuario (id_usuario, nombre, apellido, correo, telefono, imagen, clave, tipo, estilo, idioma, estado) FROM stdin;
1100000	Almacen	Pruebas	esanchez1988@gmail.com	3018946	                                                                                                                                                                                                                                                               	eab41e38426312cf48baaaf80af9ee88b6023a44	1	basico	es_es	1
1100001	Inventarios	Pruebas	esanchez1988@gmail.com	3018946	                                                                                                                                                                                                                                                               	eab41e38426312cf48baaaf80af9ee88b6023a44		basico	es_es	1
1100002	Contabilidad	Pruebas	esanchez1988@gmail.com	3018946	                                                                                                                                                                                                                                                               	eab41e38426312cf48baaaf80af9ee88b6023a44		basico	es_es	1
\.


--
-- Name: arka_usuario_id_usuario_seq; Type: SEQUENCE SET; Schema: public; Owner: arka_frame
--

SELECT pg_catalog.setval('arka_usuario_id_usuario_seq', 1, false);


--
-- Data for Name: arka_usuario_subsistema; Type: TABLE DATA; Schema: public; Owner: arka_frame
--

COPY arka_usuario_subsistema (id_usuario, id_subsistema, estado) FROM stdin;
\.


--
-- Data for Name: arka_valor_sesion; Type: TABLE DATA; Schema: public; Owner: arka_frame
--

COPY arka_valor_sesion (sesionid, variable, valor, expiracion) FROM stdin;
\.


SET search_path = arka_inventarios, pg_catalog;

--
-- Name: pk_id__historico_elemento_ind; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY historial_elemento_individual
    ADD CONSTRAINT pk_id__historico_elemento_ind PRIMARY KEY (id_evento);


--
-- Name: pk_id_baja; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY baja_elemento
    ADD CONSTRAINT pk_id_baja PRIMARY KEY (id_baja);


--
-- Name: pk_id_bodega; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY bodega
    ADD CONSTRAINT pk_id_bodega PRIMARY KEY (id_bodega);


--
-- Name: pk_id_cargo; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY tipo_cargo
    ADD CONSTRAINT pk_id_cargo PRIMARY KEY (id_cargo);


--
-- Name: pk_id_catalogo; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY catalogo_elemento
    ADD CONSTRAINT pk_id_catalogo PRIMARY KEY (id_catalogo);


--
-- Name: pk_id_clase_entrada; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY clase_entrada
    ADD CONSTRAINT pk_id_clase_entrada PRIMARY KEY (id_clase);


--
-- Name: pk_id_contratista_servicios; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY contratista_servicios
    ADD CONSTRAINT pk_id_contratista_servicios PRIMARY KEY (id_contratista);


--
-- Name: pk_id_contrato; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY contratos
    ADD CONSTRAINT pk_id_contrato PRIMARY KEY (id_contrato);


--
-- Name: pk_id_dependencia; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY dependencia
    ADD CONSTRAINT pk_id_dependencia PRIMARY KEY (id_dependencia);


--
-- Name: pk_id_destino; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY destino_orden
    ADD CONSTRAINT pk_id_destino PRIMARY KEY (id_destino);


--
-- Name: pk_id_donacion; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY donacion_entrada
    ADD CONSTRAINT pk_id_donacion PRIMARY KEY (id_donacion);


--
-- Name: pk_id_elemento; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY elemento
    ADD CONSTRAINT pk_id_elemento PRIMARY KEY (id_elemento);


--
-- Name: pk_id_elemento_anulado; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY elemento_anulado
    ADD CONSTRAINT pk_id_elemento_anulado PRIMARY KEY (id_elemento_anulado);


--
-- Name: pk_id_elemento_individual; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY elemento_individual
    ADD CONSTRAINT pk_id_elemento_individual PRIMARY KEY (id_elemento_ind);


--
-- Name: pk_id_encargado; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY encargado
    ADD CONSTRAINT pk_id_encargado PRIMARY KEY (id_encargado);


--
-- Name: pk_id_entrada; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY entrada
    ADD CONSTRAINT pk_id_entrada PRIMARY KEY (id_entrada);


--
-- Name: pk_id_estado_baja; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY estado_baja
    ADD CONSTRAINT pk_id_estado_baja PRIMARY KEY (id_estado);


--
-- Name: pk_id_estado_elemento; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY estado_elemento
    ADD CONSTRAINT pk_id_estado_elemento PRIMARY KEY (id_estado_elemento);


--
-- Name: pk_id_estado_entrada; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY estado_entrada
    ADD CONSTRAINT pk_id_estado_entrada PRIMARY KEY (id_estado);


--
-- Name: pk_id_forma_pago; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY forma_pago_orden
    ADD CONSTRAINT pk_id_forma_pago PRIMARY KEY (id_forma_pago);


--
-- Name: pk_id_funcionario; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY funcionario
    ADD CONSTRAINT pk_id_funcionario PRIMARY KEY (id_funcionario);


--
-- Name: pk_id_info_clase; Type: CONSTRAINT; Schema: arka_inventarios; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY info_clase_entrada
    ADD CONSTRAINT pk_id_info_clase PRIMARY KEY (id_info_clase);


--
-- Name: pk_id_item_actarecibido; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY items_actarecibido
    ADD CONSTRAINT pk_id_item_actarecibido PRIMARY KEY (id_items);


--
-- Name: pk_id_iten_orden_compra; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY items_orden_compra
    ADD CONSTRAINT pk_id_iten_orden_compra PRIMARY KEY (id_items);


--
-- Name: pk_id_iten_orden_compra_temp; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY items_orden_compra_temp
    ADD CONSTRAINT pk_id_iten_orden_compra_temp PRIMARY KEY (id_items);


--
-- Name: pk_id_iva; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY aplicacion_iva
    ADD CONSTRAINT pk_id_iva PRIMARY KEY (id_iva);


--
-- Name: pk_id_modulos; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY modulos
    ADD CONSTRAINT pk_id_modulos PRIMARY KEY (id_modulos);


--
-- Name: pk_id_ordenador; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY tipo_ordenador_gasto
    ADD CONSTRAINT pk_id_ordenador PRIMARY KEY (id_ordenador);


--
-- Name: pk_id_parrafos; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY parrafos
    ADD CONSTRAINT pk_id_parrafos PRIMARY KEY (id_parrafos);


--
-- Name: pk_id_polizas_orden_compra; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY polizas
    ADD CONSTRAINT pk_id_polizas_orden_compra PRIMARY KEY (id_polizas);


--
-- Name: pk_id_proveedor; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY proveedor
    ADD CONSTRAINT pk_id_proveedor PRIMARY KEY (id_proveedor);


--
-- Name: pk_id_proveedor_n; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY proveedor_nuevo
    ADD CONSTRAINT pk_id_proveedor_n PRIMARY KEY (id_proveedor_n);


--
-- Name: pk_id_recuperacion; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY recuperacion_entrada
    ADD CONSTRAINT pk_id_recuperacion PRIMARY KEY (id_recuperacion);


--
-- Name: pk_id_reposicion; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY reposicion_entrada
    ADD CONSTRAINT pk_id_reposicion PRIMARY KEY (id_reposicion);


--
-- Name: pk_id_rubro; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY rubro
    ADD CONSTRAINT pk_id_rubro PRIMARY KEY (id_rubro);


--
-- Name: pk_id_salida; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY salida
    ADD CONSTRAINT pk_id_salida PRIMARY KEY (id_salida);


--
-- Name: pk_id_seccion; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY seccion
    ADD CONSTRAINT pk_id_seccion PRIMARY KEY (id_seccion);


--
-- Name: pk_id_sobrante; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY sobrante_entrada
    ADD CONSTRAINT pk_id_sobrante PRIMARY KEY (id_sobrante);


--
-- Name: pk_id_solicitante_servicios; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY solicitante_servicios
    ADD CONSTRAINT pk_id_solicitante_servicios PRIMARY KEY (id_solicitante);


--
-- Name: pk_id_supervisor_servicios; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY supervisor_servicios
    ADD CONSTRAINT pk_id_supervisor_servicios PRIMARY KEY (id_supervisor);


--
-- Name: pk_id_tipo_bienes; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY tipo_bienes
    ADD CONSTRAINT pk_id_tipo_bienes PRIMARY KEY (id_tipo_bienes);


--
-- Name: pk_id_tipo_contrato; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY tipo_contrato
    ADD CONSTRAINT pk_id_tipo_contrato PRIMARY KEY (id_tipo);


--
-- Name: pk_id_tipo_encargado; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY tipo_encargado
    ADD CONSTRAINT pk_id_tipo_encargado PRIMARY KEY (id_tipo_encargado);


--
-- Name: pk_id_tipo_falt_sobr; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY tipo_falt_sobr
    ADD CONSTRAINT pk_id_tipo_falt_sobr PRIMARY KEY (id_tipo_falt_sobr);


--
-- Name: pk_id_tipo_mueble; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY tipo_mueble
    ADD CONSTRAINT pk_id_tipo_mueble PRIMARY KEY (id_tipo_mueble);


--
-- Name: pk_id_tipo_poliza; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY tipo_poliza
    ADD CONSTRAINT pk_id_tipo_poliza PRIMARY KEY (id_tipo_poliza);


--
-- Name: pk_orden_compra; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY orden_compra
    ADD CONSTRAINT pk_orden_compra PRIMARY KEY (id_orden_compra);


--
-- Name: pk_orden_servicio; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY orden_servicio
    ADD CONSTRAINT pk_orden_servicio PRIMARY KEY (id_orden_servicio);


--
-- Name: pk_registro_actarecibido; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY registro_actarecibido
    ADD CONSTRAINT pk_registro_actarecibido PRIMARY KEY (id_actarecibido);


--
-- Name: registro_documento_pkey; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY registro_documento
    ADD CONSTRAINT registro_documento_pkey PRIMARY KEY (documento_id, documento_nombre);


--
-- Name: tipo_bien_pkey; Type: CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios; Tablespace: 
--

ALTER TABLE ONLY tipo_bien
    ADD CONSTRAINT tipo_bien_pkey PRIMARY KEY (tb_idbien);


SET search_path = public, pg_catalog;

--
-- Name: arka_bloque_pagina_pkey; Type: CONSTRAINT; Schema: public; Owner: arka_frame; Tablespace: 
--

ALTER TABLE ONLY arka_bloque_pagina
    ADD CONSTRAINT arka_bloque_pagina_pkey PRIMARY KEY (idrelacion);


--
-- Name: arka_bloque_pkey; Type: CONSTRAINT; Schema: public; Owner: arka_frame; Tablespace: 
--

ALTER TABLE ONLY arka_bloque
    ADD CONSTRAINT arka_bloque_pkey PRIMARY KEY (id_bloque);


--
-- Name: arka_configuracion_pkey; Type: CONSTRAINT; Schema: public; Owner: arka_frame; Tablespace: 
--

ALTER TABLE ONLY arka_configuracion
    ADD CONSTRAINT arka_configuracion_pkey PRIMARY KEY (id_parametro);


--
-- Name: arka_dbms_pkey; Type: CONSTRAINT; Schema: public; Owner: arka_frame; Tablespace: 
--

ALTER TABLE ONLY arka_dbms
    ADD CONSTRAINT arka_dbms_pkey PRIMARY KEY (idconexion);


--
-- Name: arka_estilo_pkey; Type: CONSTRAINT; Schema: public; Owner: arka_frame; Tablespace: 
--

ALTER TABLE ONLY arka_estilo
    ADD CONSTRAINT arka_estilo_pkey PRIMARY KEY (usuario, estilo);


--
-- Name: arka_pagina_pkey; Type: CONSTRAINT; Schema: public; Owner: arka_frame; Tablespace: 
--

ALTER TABLE ONLY arka_pagina
    ADD CONSTRAINT arka_pagina_pkey PRIMARY KEY (id_pagina);


--
-- Name: arka_subsistema_pkey; Type: CONSTRAINT; Schema: public; Owner: arka_frame; Tablespace: 
--

ALTER TABLE ONLY arka_subsistema
    ADD CONSTRAINT arka_subsistema_pkey PRIMARY KEY (id_subsistema);


--
-- Name: arka_usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: arka_frame; Tablespace: 
--

ALTER TABLE ONLY arka_usuario
    ADD CONSTRAINT arka_usuario_pkey PRIMARY KEY (id_usuario);


--
-- Name: arka_valor_sesion_pkey; Type: CONSTRAINT; Schema: public; Owner: arka_frame; Tablespace: 
--

ALTER TABLE ONLY arka_valor_sesion
    ADD CONSTRAINT arka_valor_sesion_pkey PRIMARY KEY (sesionid, variable);


SET search_path = arka_inventarios, pg_catalog;

--
-- Name: fk_acta_recibido; Type: FK CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY entrada
    ADD CONSTRAINT fk_acta_recibido FOREIGN KEY (acta_recibido) REFERENCES registro_actarecibido(id_actarecibido);


--
-- Name: fk_clase_entrada; Type: FK CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY entrada
    ADD CONSTRAINT fk_clase_entrada FOREIGN KEY (clase_entrada) REFERENCES clase_entrada(id_clase);


--
-- Name: fk_estado_elemento; Type: FK CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY elemento_individual
    ADD CONSTRAINT fk_estado_elemento FOREIGN KEY (estado_elemento) REFERENCES estado_elemento(id_estado_elemento);


--
-- Name: fk_estado_entrada; Type: FK CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY entrada
    ADD CONSTRAINT fk_estado_entrada FOREIGN KEY (estado_entrada) REFERENCES estado_entrada(id_estado);


--
-- Name: fk_id_elemento_general; Type: FK CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY elemento_individual
    ADD CONSTRAINT fk_id_elemento_general FOREIGN KEY (id_elemento_gen) REFERENCES elemento(id_elemento);


--
-- Name: fk_id_entrada; Type: FK CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY elemento
    ADD CONSTRAINT fk_id_entrada FOREIGN KEY (id_entrada) REFERENCES entrada(id_entrada);


--
-- Name: fk_id_entrada; Type: FK CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY salida
    ADD CONSTRAINT fk_id_entrada FOREIGN KEY (id_entrada) REFERENCES entrada(id_entrada);


--
-- Name: fk_id_salida; Type: FK CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY elemento_individual
    ADD CONSTRAINT fk_id_salida FOREIGN KEY (id_salida) REFERENCES salida(id_salida);


--
-- Name: fk_tipo_falt_sobr; Type: FK CONSTRAINT; Schema: arka_inventarios; Owner: arka_inventarios
--

ALTER TABLE ONLY estado_elemento
    ADD CONSTRAINT fk_tipo_falt_sobr FOREIGN KEY (tipo_faltsobr) REFERENCES tipo_falt_sobr(id_tipo_falt_sobr);


--
-- Name: arka_inventarios; Type: ACL; Schema: -; Owner: arka_inventarios
--

REVOKE ALL ON SCHEMA arka_inventarios FROM PUBLIC;
REVOKE ALL ON SCHEMA arka_inventarios FROM arka_inventarios;
GRANT ALL ON SCHEMA arka_inventarios TO arka_inventarios;
GRANT ALL ON SCHEMA arka_inventarios TO PUBLIC;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO arka_frame;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

