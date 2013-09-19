-- tablas auxiliares
create table tipo_documento(
  id integer not null primary key,
  sigla varchar(32) not null,
  tipo_documento varchar(64) not null
);

create table pais(
  id varchar(2) not null primary key,
  activo boolean not null default false,

  sigla_es varchar(32) not null,
  pais_es varchar(32) not null,
  nacionalidad_es varchar(32) not null,

  sigla_de varchar(32) not null,
  pais_de varchar(32) not null,
  nacionalidad_de varchar(32) not null
);

create table forma_pago(
  id varchar(3) not null primary key,
  activo boolean not null default false,
  forma_pago varchar(32) not null unique,
  sigla varchar(32) not null unique
);

-- Aporte Retiro Premio
create table tipo_operacion(
  id integer not null primary key,
  sigla varchar(32) not null,
  tipo_operacion varchar(64) not null
  );

create table plan(
  id integer not null primary key,
  sigla varchar(32) not null,
  plan varchar(64) not null,
  distribucion integer[], -- (cuatro elementos desde el nivel inicial 0 hasta el nivelfina maximo)
  inscripcion integer not null default 0,--importe inscripcion
  minimo_mensual integer not null default 0,--minimo cuota mensual
  maximo integer not null default 0--maximo acumulable, despues cambia de plan
);

create table plan_dist(
  plan integer not null references plan,
  nivel integer not null,
  importe integer not null default 0,
  primary key(plan,nivel)
);

-- tablas principales
create table cliente(
  id serial not null primary key,
  plan integer not null references plan,
  -- datos del cliente
  nro_doc varchar(32) unique not null,
  nombres text,
  apellidos text,
  fecha_ing date ,
  activo boolean not null default false,
  nacionalidad varchar(2) references pais,
  fecha_nacim date,
  tipo_documento integer references tipo_documento,
  residencia varchar(2) references pais,
  email varchar(200),
  telefono text,
  forma_pago varchar(3) references forma_pago,
  -- nivel superior
  cod_patrocinador varchar(32),
  cod_pid varchar(32),
  pid integer not null default 0,
  clave varchar(110)
);

-- registra aportes,inscripciones,pagos
create table operacion(
  id serial not null primary key,
  cliente integer not null references cliente,
  tipo_operacion integer not null references tipo_operacion,
  fecha date not null,
  comprobante varchar(32),
  importe integer not null default 0,
  deb integer not null default 0,
  cred integer not null default 0,
  fecha_ins timestamp not null default now()
);

-- registra distribucion de aportes
create table mov(
  id serial not null primary key,
  tipo_operacion integer not null references tipo_operacion,
  operacion integer not null references operacion,
  cliente integer not null references cliente,
  deb integer not null default 0,
  cred integer not null default 0,
  fecha_ins timestamp not null default now()
);
   


CREATE FUNCTION t_operacion() RETURNS trigger
    LANGUAGE plpgsql SECURITY DEFINER
    AS $$
DECLARE
  rplan record;
  rtipo record;
  rcli record;
  --vpin text;
BEGIN
  IF (TG_WHEN = 'BEFORE') THEN
    IF (TG_OP = 'INSERT') THEN
      for rtipo in select * from tipo_operacion where id=new.tipo_operacion loop
	for rplan in select * from plan where id=new.plan loop
	  for rcli in select * from cliente where id=new.cliente loop
	    -- validar cliente activo
	    if not rcli.activo then
	      raise exception 'OPER.01 El cliente [% %, %] no se encuentra activo',new.cliente,rcli.apellidos, rcli.nombres;
	    end if;
	    -- validar monto de la operacion segun el plan
	    if rtipo.sigla='INSC' and new.importe<>rplan.inscripcion then
	      raise exception 'OPER.02 El Importe de la operacion[%] no coincide con el monto de inscripcion segun el plan  [%: %] no se encuentra activo',new.importe,rplan.plan, rplan.inscripcion;
	    elsif rtipo.sigla='APM' and new.importe<rplan.minimo then
	      raise exception 'OPER.02 El Importe de la operacion[%] es menor al monto minimo segun el plan  [%: %] no se encuentra activo',new.importe,rplan.plan, rplan.minimo;
	    else then
	      raise exception 'OPER.03 Operacion no implementada [%]',rtipo.sigla;
	    end if;
	    return new;
	  end loop; --rplan
	end loop; --rplan
      end loop; --rtipo
      raise exception 'OPER.91 Datos no encontrados';
    ELSIF (TG_OP = 'UPDATE') THEN
      --Las devoluciones no se modifican
      raise exception 'ERR[305]: No se permite modificar operacion';--no permitido
    ELSIF (TG_OP = 'DELETE') THEN
      return old;
    END IF;
  ELSE 
    --AFTER
    IF (TG_OP = 'INSERT') THEN	    
      return new;-- aceptar
    ELSIF (TG_OP = 'UPDATE') THEN
      return new;-- aceptar
    ELSIF (TG_OP = 'DELETE') THEN
      return old;-- aceptar
    END IF;    
  END IF;		
END
$$;

CREATE TRIGGER tb_operacion BEFORE INSERT OR DELETE OR UPDATE ON operacion FOR EACH ROW EXECUTE PROCEDURE t_operacion();
CREATE TRIGGER ta_operacion AFTER INSERT OR DELETE OR UPDATE ON operacion FOR EACH ROW EXECUTE PROCEDURE t_operacion();


CREATE FUNCTION t_cliente() RETURNS trigger
    LANGUAGE plpgsql SECURITY DEFINER
    AS $$
DECLARE
  rplan record;
  rtipo record;
  rcli record;
  --vpin text;
BEGIN
  IF (TG_WHEN = 'BEFORE') THEN
    IF (TG_OP = 'INSERT') THEN
      --raise exception 'OPER.91 Datos no encontrados';
      return new;
    ELSIF (TG_OP = 'UPDATE') THEN
      --Las devoluciones no se modifican
      --raise exception 'ERR[305]: No se permite modificar operacion';--no permitido
      return new;
    ELSIF (TG_OP = 'DELETE') THEN
      return old;
    END IF;
  ELSE 
    --AFTER
    IF (TG_OP = 'INSERT') THEN	    
      return new;-- aceptar
    ELSIF (TG_OP = 'UPDATE') THEN
      return new;-- aceptar
    ELSIF (TG_OP = 'DELETE') THEN
      return old;-- aceptar
    END IF;    
  END IF;		
END
$$;

CREATE TRIGGER tb_cliente BEFORE INSERT OR DELETE OR UPDATE ON cliente FOR EACH ROW EXECUTE PROCEDURE t_cliente();
CREATE TRIGGER tb_cliente AFTER INSERT OR DELETE OR UPDATE ON cliente FOR EACH ROW EXECUTE PROCEDURE t_cliente();

