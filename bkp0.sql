--
-- PostgreSQL database dump
--

-- Dumped from database version 9.2.1
-- Dumped by pg_dump version 9.2.1
-- Started on 2013-09-10 07:14:12 PYT

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 179 (class 3079 OID 12318)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2600 (class 0 OID 0)
-- Dependencies: 179
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- TOC entry 193 (class 1255 OID 24751)
-- Name: t_cliente(); Type: FUNCTION; Schema: public; Owner: admin
--

CREATE FUNCTION t_cliente() RETURNS trigger
    LANGUAGE plpgsql SECURITY DEFINER
    AS $$
DECLARE
  rplan record;
  rtipo record;
  rcli record;
  rbenef record;
  rpdist record;
  vpid integer;
  vsaldo integer;
  vimporte integer;
  --vpin text;
BEGIN
  IF (TG_WHEN = 'BEFORE') THEN
    IF (TG_OP = 'INSERT') THEN
      if new.id>0 and new.plan=0 then
        raise exception 'Plan no permitido para clientes';
      end if;
      return new;
    ELSIF (TG_OP = 'UPDATE') THEN
      if new.id>0 and new.plan=0 then
        raise exception 'Plan no permitido para clientes';
      end if;
      if new.id=0 then
        raise exception 'No se permiten modificaciones al cliente cero';
      end if;
      return new;
    ELSIF (TG_OP = 'DELETE') THEN
      if old.id=0 then
        raise exception 'No se permiten eliminar al cliente cero';
      end if;
      return old;
    END IF;
  ELSE 
    --AFTER
    IF (TG_OP = 'INSERT') THEN	
      return new;
    ELSIF (TG_OP = 'UPDATE') THEN
      return new;-- aceptar
    ELSIF (TG_OP = 'DELETE') THEN
      return old;-- aceptar
    END IF;    
  END IF;		
END
$$;


ALTER FUNCTION public.t_cliente() OWNER TO admin;

--
-- TOC entry 192 (class 1255 OID 24735)
-- Name: t_operacion(); Type: FUNCTION; Schema: public; Owner: admin
--

CREATE FUNCTION t_operacion() RETURNS trigger
    LANGUAGE plpgsql SECURITY DEFINER
    AS $$
DECLARE
  rplan record;
  rtipo record;
  rcli record;
  rbenef record;
  rpdist record;
  vpid integer;
  vsaldo integer;
  vimporte integer;
  --vpin text;
BEGIN
  IF (TG_WHEN = 'BEFORE') THEN
    IF (TG_OP = 'INSERT') THEN
      for rtipo in select * from tipo_operacion where id=new.tipo_operacion loop
        --raise notice 'plan';
	for rcli in select * from cliente where id=new.cliente loop
	  --raise notice 'cli';
	  if rcli.id=0 then
		raise exception 'No se permiten operaciones sobre el cliente cero';
	  end if;
	  for rplan in select * from plan where id=rcli.plan loop
	    --raise notice 'plan';
	    -- validar cliente activo
	    if not rcli.activo then
	      raise exception 'OPER.01 El cliente [% %, %] no se encuentra activo',new.cliente,rcli.apellidos, rcli.nombres;
	    end if;
	    -- validar monto de la operacion segun el plan
	    if rtipo.sigla='INSC' and new.importe<>rplan.inscripcion then
	      raise exception 'OPER.02 El Importe de la operacion[%] no coincide con el monto de inscripcion segun el plan  [%: %]',new.importe,rplan.plan, rplan.inscripcion;
	    elsif rtipo.sigla='APM' and new.importe<rplan.minimo_mensual then
	      raise exception 'OPER.02 El Importe de la operacion[%] es menor al monto minimo segun el plan  [%: %]',new.importe,rplan.plan, rplan.minimo_mensual;
	    end if;
	    if rtipo.sigla in ('INSC','APM') then
	      new.cred=new.importe;
	    else
	      raise exception 'OPER.03 Operacion no implementada [%]',rtipo.sigla;
	    end if;
	    return new;
	  end loop; --rplan
	end loop; --rcli
      end loop; --rtipo
      raise exception 'OPER.05 Datos no encontrados';
    ELSIF (TG_OP = 'UPDATE') THEN
      --Las devoluciones no se modifican
      raise exception 'OPER.04: No se permite modificar operacion';--no permitido
    ELSIF (TG_OP = 'DELETE') THEN
      return old;
    END IF;
  ELSE 
    --AFTER
    IF (TG_OP = 'INSERT') THEN	
      -- distribuir
      for rtipo in select * from tipo_operacion where id=new.tipo_operacion loop
        raise notice 'tipo';
	for rcli in select * from cliente where id=new.cliente loop
	  raise notice 'cli';
	  for rplan in select * from plan where id=rcli.plan loop
	    raise notice 'plan';
	    --level +1
	    if rtipo.sigla in ('APM','INSC') then
	      vsaldo=new.importe;	
  	      vpid=rcli.pid;
	      for rpdist in select * from plan_dist where plan=rplan.id order by nivel desc loop
	        raise notice 'dist';
	        for rbenef in select * from cliente where id=vpid loop
	          raise notice 'benef';
		  if vsaldo<=0 then
		    raise exception 'OPER.06: Importe insuficiente';
		  end if;
		  vimporte=0;
		  if rtipo.sigla = 'INSC' then
		    vimporte=rpdist.inscripcion;
		  end if;
		  if rtipo.sigla = 'APM' then
		    vimporte=rpdist.mensualidad;
		  end if;
		  insert into mov(tipo_operacion,operacion,cliente,cred) values(rtipo.id,new.id,vpid,vimporte);
		  vsaldo=vsaldo - vimporte;
		  vpid=rbenef.pid;
	        end loop; 	
	      end loop; --rpdist
   	      if vsaldo >0 then
	        insert into mov(tipo_operacion,operacion,cliente,cred) values(rtipo.id,new.id,rcli.id,vsaldo);	
	      end if;  			
	    end if;-- operacion aporte
	  end loop; --rplan
	end loop; --rcli
      end loop; --rtipo
          
      return new;
    ELSIF (TG_OP = 'UPDATE') THEN
      return new;-- aceptar
    ELSIF (TG_OP = 'DELETE') THEN
      return old;-- aceptar
    END IF;    
  END IF;		
END
$$;


ALTER FUNCTION public.t_operacion() OWNER TO admin;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 172 (class 1259 OID 24639)
-- Name: cliente; Type: TABLE; Schema: public; Owner: admin; Tablespace: 
--

CREATE TABLE cliente (
    id integer NOT NULL,
    plan integer NOT NULL,
    nro_doc character varying(32) NOT NULL,
    nombres text,
    apellidos text,
    fecha_ing date,
    activo boolean DEFAULT false NOT NULL,
    pid integer DEFAULT 0 NOT NULL,
    clave character varying(110)
);


ALTER TABLE public.cliente OWNER TO admin;

--
-- TOC entry 171 (class 1259 OID 24637)
-- Name: cliente_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE cliente_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cliente_id_seq OWNER TO admin;

--
-- TOC entry 2601 (class 0 OID 0)
-- Dependencies: 171
-- Name: cliente_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE cliente_id_seq OWNED BY cliente.id;


--
-- TOC entry 2602 (class 0 OID 0)
-- Dependencies: 171
-- Name: cliente_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('cliente_id_seq', 5, true);


--
-- TOC entry 176 (class 1259 OID 24680)
-- Name: mov; Type: TABLE; Schema: public; Owner: admin; Tablespace: 
--

CREATE TABLE mov (
    id integer NOT NULL,
    tipo_operacion integer NOT NULL,
    operacion integer NOT NULL,
    cliente integer NOT NULL,
    deb integer DEFAULT 0 NOT NULL,
    cred integer DEFAULT 0 NOT NULL,
    fecha_ins timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.mov OWNER TO admin;

--
-- TOC entry 175 (class 1259 OID 24678)
-- Name: mov_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE mov_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.mov_id_seq OWNER TO admin;

--
-- TOC entry 2603 (class 0 OID 0)
-- Dependencies: 175
-- Name: mov_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE mov_id_seq OWNED BY mov.id;


--
-- TOC entry 2604 (class 0 OID 0)
-- Dependencies: 175
-- Name: mov_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('mov_id_seq', 51, true);


--
-- TOC entry 174 (class 1259 OID 24659)
-- Name: operacion; Type: TABLE; Schema: public; Owner: admin; Tablespace: 
--

CREATE TABLE operacion (
    id integer NOT NULL,
    cliente integer NOT NULL,
    tipo_operacion integer NOT NULL,
    fecha date NOT NULL,
    comprobante character varying(32),
    deb integer DEFAULT 0 NOT NULL,
    cred integer DEFAULT 0 NOT NULL,
    fecha_ins timestamp without time zone DEFAULT now() NOT NULL,
    importe integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.operacion OWNER TO admin;

--
-- TOC entry 173 (class 1259 OID 24657)
-- Name: operacion_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE operacion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.operacion_id_seq OWNER TO admin;

--
-- TOC entry 2605 (class 0 OID 0)
-- Dependencies: 173
-- Name: operacion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE operacion_id_seq OWNED BY operacion.id;


--
-- TOC entry 2606 (class 0 OID 0)
-- Dependencies: 173
-- Name: operacion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('operacion_id_seq', 33, true);


--
-- TOC entry 170 (class 1259 OID 24626)
-- Name: plan; Type: TABLE; Schema: public; Owner: admin; Tablespace: 
--

CREATE TABLE plan (
    id integer NOT NULL,
    sigla character varying(32) NOT NULL,
    plan character varying(64) NOT NULL,
    distribucion integer[],
    inscripcion integer DEFAULT 0 NOT NULL,
    minimo_mensual integer DEFAULT 0 NOT NULL,
    maximo integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.plan OWNER TO admin;

--
-- TOC entry 178 (class 1259 OID 24739)
-- Name: plan_dist; Type: TABLE; Schema: public; Owner: admin; Tablespace: 
--

CREATE TABLE plan_dist (
    plan integer NOT NULL,
    nivel integer NOT NULL,
    inscripcion integer DEFAULT 0 NOT NULL,
    mensualidad integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.plan_dist OWNER TO admin;

--
-- TOC entry 168 (class 1259 OID 24616)
-- Name: tipo_documento; Type: TABLE; Schema: public; Owner: admin; Tablespace: 
--

CREATE TABLE tipo_documento (
    id integer NOT NULL,
    sigla character varying(32) NOT NULL,
    tipo_documento character varying(64) NOT NULL
);


ALTER TABLE public.tipo_documento OWNER TO admin;

--
-- TOC entry 169 (class 1259 OID 24621)
-- Name: tipo_operacion; Type: TABLE; Schema: public; Owner: admin; Tablespace: 
--

CREATE TABLE tipo_operacion (
    id integer NOT NULL,
    sigla character varying(32) NOT NULL,
    tipo_operacion character varying(64) NOT NULL
);


ALTER TABLE public.tipo_operacion OWNER TO admin;

--
-- TOC entry 177 (class 1259 OID 24715)
-- Name: v_dd_cliente; Type: VIEW; Schema: public; Owner: admin
--

CREATE VIEW v_dd_cliente AS
    SELECT cliente.id, (((((cliente.nro_doc)::text || ' '::text) || cliente.apellidos) || ' '::text) || cliente.nombres) AS descr, cliente.pid FROM cliente WHERE cliente.activo;


ALTER TABLE public.v_dd_cliente OWNER TO admin;

--
-- TOC entry 2545 (class 2604 OID 24642)
-- Name: id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY cliente ALTER COLUMN id SET DEFAULT nextval('cliente_id_seq'::regclass);


--
-- TOC entry 2553 (class 2604 OID 24683)
-- Name: id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY mov ALTER COLUMN id SET DEFAULT nextval('mov_id_seq'::regclass);


--
-- TOC entry 2548 (class 2604 OID 24662)
-- Name: id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY operacion ALTER COLUMN id SET DEFAULT nextval('operacion_id_seq'::regclass);


--
-- TOC entry 2589 (class 0 OID 24639)
-- Dependencies: 172
-- Data for Name: cliente; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO cliente VALUES (0, 0, '0', ' ', 'LA EMPRESA', '2013-01-03', true, 0, NULL);
INSERT INTO cliente VALUES (5, 1, '123456', 'Fulano', 'Mengano', '2013-06-26', true, 0, '');


--
-- TOC entry 2591 (class 0 OID 24680)
-- Dependencies: 176
-- Data for Name: mov; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO mov VALUES (47, 1, 33, 0, 0, 30, '2013-09-10 07:03:43.995655');
INSERT INTO mov VALUES (48, 1, 33, 0, 0, 30, '2013-09-10 07:03:43.995655');
INSERT INTO mov VALUES (49, 1, 33, 0, 0, 20, '2013-09-10 07:03:43.995655');
INSERT INTO mov VALUES (50, 1, 33, 0, 0, 10, '2013-09-10 07:03:43.995655');
INSERT INTO mov VALUES (51, 1, 33, 5, 0, 29, '2013-09-10 07:03:43.995655');


--
-- TOC entry 2590 (class 0 OID 24659)
-- Dependencies: 174
-- Data for Name: operacion; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO operacion VALUES (33, 5, 1, '2013-07-22', '123', 0, 119, '2013-09-10 07:03:43.995655', 119);


--
-- TOC entry 2588 (class 0 OID 24626)
-- Dependencies: 170
-- Data for Name: plan; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO plan VALUES (0, '---', '---', NULL, 0, 0, 0);
INSERT INTO plan VALUES (1, 'ECO365', 'ECO365', NULL, 119, 35, 625);


--
-- TOC entry 2592 (class 0 OID 24739)
-- Dependencies: 178
-- Data for Name: plan_dist; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO plan_dist VALUES (1, 0, 10, 5);
INSERT INTO plan_dist VALUES (1, 1, 20, 10);
INSERT INTO plan_dist VALUES (1, 2, 30, 10);
INSERT INTO plan_dist VALUES (1, 3, 30, 10);


--
-- TOC entry 2586 (class 0 OID 24616)
-- Dependencies: 168
-- Data for Name: tipo_documento; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO tipo_documento VALUES (1, 'CI', 'Cedula de Identidad Policial');


--
-- TOC entry 2587 (class 0 OID 24621)
-- Dependencies: 169
-- Data for Name: tipo_operacion; Type: TABLE DATA; Schema: public; Owner: admin
--

INSERT INTO tipo_operacion VALUES (1, 'INSC', 'INSCRIPCION');
INSERT INTO tipo_operacion VALUES (2, 'APM', 'APORTE MENSUAL');


--
-- TOC entry 2566 (class 2606 OID 24651)
-- Name: cliente_nro_doc_key; Type: CONSTRAINT; Schema: public; Owner: admin; Tablespace: 
--

ALTER TABLE ONLY cliente
    ADD CONSTRAINT cliente_nro_doc_key UNIQUE (nro_doc);


--
-- TOC entry 2568 (class 2606 OID 24649)
-- Name: cliente_pkey; Type: CONSTRAINT; Schema: public; Owner: admin; Tablespace: 
--

ALTER TABLE ONLY cliente
    ADD CONSTRAINT cliente_pkey PRIMARY KEY (id);


--
-- TOC entry 2572 (class 2606 OID 24688)
-- Name: mov_pkey; Type: CONSTRAINT; Schema: public; Owner: admin; Tablespace: 
--

ALTER TABLE ONLY mov
    ADD CONSTRAINT mov_pkey PRIMARY KEY (id);


--
-- TOC entry 2570 (class 2606 OID 24667)
-- Name: operacion_pkey; Type: CONSTRAINT; Schema: public; Owner: admin; Tablespace: 
--

ALTER TABLE ONLY operacion
    ADD CONSTRAINT operacion_pkey PRIMARY KEY (id);


--
-- TOC entry 2574 (class 2606 OID 24745)
-- Name: plan_dist_pkey; Type: CONSTRAINT; Schema: public; Owner: admin; Tablespace: 
--

ALTER TABLE ONLY plan_dist
    ADD CONSTRAINT plan_dist_pkey PRIMARY KEY (plan, nivel);


--
-- TOC entry 2564 (class 2606 OID 24636)
-- Name: plan_pkey; Type: CONSTRAINT; Schema: public; Owner: admin; Tablespace: 
--

ALTER TABLE ONLY plan
    ADD CONSTRAINT plan_pkey PRIMARY KEY (id);


--
-- TOC entry 2560 (class 2606 OID 24620)
-- Name: tipo_documento_pkey; Type: CONSTRAINT; Schema: public; Owner: admin; Tablespace: 
--

ALTER TABLE ONLY tipo_documento
    ADD CONSTRAINT tipo_documento_pkey PRIMARY KEY (id);


--
-- TOC entry 2562 (class 2606 OID 24625)
-- Name: tipo_operacion_pkey; Type: CONSTRAINT; Schema: public; Owner: admin; Tablespace: 
--

ALTER TABLE ONLY tipo_operacion
    ADD CONSTRAINT tipo_operacion_pkey PRIMARY KEY (id);


--
-- TOC entry 2583 (class 2620 OID 24753)
-- Name: ta_cliente; Type: TRIGGER; Schema: public; Owner: admin
--

CREATE TRIGGER ta_cliente AFTER INSERT OR DELETE OR UPDATE ON cliente FOR EACH ROW EXECUTE PROCEDURE t_cliente();


--
-- TOC entry 2585 (class 2620 OID 24737)
-- Name: ta_operacion; Type: TRIGGER; Schema: public; Owner: admin
--

CREATE TRIGGER ta_operacion AFTER INSERT OR DELETE OR UPDATE ON operacion FOR EACH ROW EXECUTE PROCEDURE t_operacion();


--
-- TOC entry 2582 (class 2620 OID 24752)
-- Name: tb_cliente; Type: TRIGGER; Schema: public; Owner: admin
--

CREATE TRIGGER tb_cliente BEFORE INSERT OR DELETE OR UPDATE ON cliente FOR EACH ROW EXECUTE PROCEDURE t_cliente();


--
-- TOC entry 2584 (class 2620 OID 24736)
-- Name: tb_operacion; Type: TRIGGER; Schema: public; Owner: admin
--

CREATE TRIGGER tb_operacion BEFORE INSERT OR DELETE OR UPDATE ON operacion FOR EACH ROW EXECUTE PROCEDURE t_operacion();


--
-- TOC entry 2575 (class 2606 OID 24652)
-- Name: cliente_plan_fkey; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY cliente
    ADD CONSTRAINT cliente_plan_fkey FOREIGN KEY (plan) REFERENCES plan(id);


--
-- TOC entry 2580 (class 2606 OID 24699)
-- Name: mov_cliente_fkey; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY mov
    ADD CONSTRAINT mov_cliente_fkey FOREIGN KEY (cliente) REFERENCES cliente(id);


--
-- TOC entry 2579 (class 2606 OID 24694)
-- Name: mov_operacion_fkey; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY mov
    ADD CONSTRAINT mov_operacion_fkey FOREIGN KEY (operacion) REFERENCES operacion(id);


--
-- TOC entry 2578 (class 2606 OID 24689)
-- Name: mov_tipo_operacion_fkey; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY mov
    ADD CONSTRAINT mov_tipo_operacion_fkey FOREIGN KEY (tipo_operacion) REFERENCES tipo_operacion(id);


--
-- TOC entry 2576 (class 2606 OID 24724)
-- Name: operacion_cliente_fkey; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY operacion
    ADD CONSTRAINT operacion_cliente_fkey FOREIGN KEY (cliente) REFERENCES cliente(id);


--
-- TOC entry 2577 (class 2606 OID 24729)
-- Name: operacion_tipo_operacion_fkey; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY operacion
    ADD CONSTRAINT operacion_tipo_operacion_fkey FOREIGN KEY (tipo_operacion) REFERENCES tipo_operacion(id);


--
-- TOC entry 2581 (class 2606 OID 24746)
-- Name: plan_dist_plan_fkey; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY plan_dist
    ADD CONSTRAINT plan_dist_plan_fkey FOREIGN KEY (plan) REFERENCES plan(id);


--
-- TOC entry 2599 (class 0 OID 0)
-- Dependencies: 5
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2013-09-10 07:14:13 PYT

--
-- PostgreSQL database dump complete
--

