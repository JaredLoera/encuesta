create database tercerEjemplo;
use tercerEjemplo;

create table tipo_user(
    id int not null auto_increment,
    nombre varchar(255) not null,
    primary key(id)
);
INSERT INTO tipo_user (nombre) VALUES ('root'), ('company'), ('worker');

create table contacto(
    id int not null auto_increment,
    pass varchar(255) not null,
    correo varchar(255) not null unique,
    tipo_user_id int not null,
    foreign key(tipo_user_id) references tipo_user(id),
    primary key(id)
);
create table company(
    id int not null auto_increment,
    nombre varchar(255) not null,
    refimenFiscal varchar(255) not null,
    domicilio varchar(255) not null,
    contacto_id int not null,
    foreign key(contacto_id) references contacto(id),
    primary key(id)
);
create table user(
    id int not null auto_increment,
    nombre varchar(255) not null,
    ap_paterno varchar(255) not null,
    ap_materno varchar(255) not null,
    rfc varchar(16) not null,
    telefono varchar(10) not null,
    company_id int not null,
    contacto_id int not null,
    primary key(id),
    foreign key(company_id) references company(id),
    foreign key(contacto_id) references contacto(id)
);
create table capitulo(
    id int not null auto_increment,
    numcapitulo int not null,
    company_id int not null,
    descripcion varchar(255) not null,
    primary key(id),
    foreign key(company_id) references company(id)
);
create table quiz(
    id int not null auto_increment,
    capitulo_id int not null,
    fecha_inicio datetime not null default current_timestamp,
    primary key(id),
    foreign key(capitulo_id) references capitulo(id)
);
create table question(
    id int not null auto_increment,
    pregunta varchar(255) not null,
    capitulo_id int not null,
    estado boolean not null default true,
	fecha_pregunta datetime not null default current_timestamp,
    primary key(id),
    foreign key(capitulo_id) references capitulo(id)
);
CREATE TABLE user_answer(
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    quiz_id INT NOT NULL,
    answers JSON NOT NULL,
    fecha_respondido datetime not null default current_timestamp,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES user(id),
    FOREIGN KEY(quiz_id) REFERENCES quiz(id)
);

alter table capitulo add column nombre_examen varchar(255) not null;

DELIMITER $$ 
DROP PROCEDURE IF EXISTS `crearCapitulos` $$
CREATE PROCEDURE `crearCapitulos`(IN empresa_id INT)
BEGIN
    DECLARE i INT DEFAULT 1;
    WHILE i <= 6 DO
        INSERT INTO capitulo (numcapitulo, company_id, descripcion) 
        VALUES (i, empresa_id, CONCAT('Capítulo ', i));
        SET i = i + 1;
    END WHILE;
END$$
DELIMITER ;

DELIMITER $$ 
DROP PROCEDURE IF EXISTS `preguntasCapitulo1` $$
CREATE PROCEDURE `preguntasCapitulo1`(IN capitulo_id INT)
BEGIN
	INSERT INTO question (pregunta,capitulo_id) VALUE("mi trabajo me exige hacer mucho esfuerzo fisico",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("me preocupa sufrir un accidente en mi trabajo",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("considero que las actividades que realizo son peligrosas",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("por la cantidad de trabajo que tengo debo quedarme tiempo adicional a mi turno",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("por la cantidad de trabajo que tengo debo trabajar sin parar",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("considero que es necesario mantener un ritmo de trabajo acelerado",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("mi trabajo exige que esté muy concentrado",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("mi trabajo requiere que memorice mucha información",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("mi trabajo exige que atienda varios asuntos al mismo tiempo",capitulo_id);
END$$
DELIMITER ;

DELIMITER $$ 
DROP PROCEDURE IF EXISTS `preguntasCapitulo2` $$
CREATE PROCEDURE `preguntasCapitulo2`(IN capitulo_id INT)
BEGIN
    INSERT INTO question (pregunta,capitulo_id) VALUE("en mi trabajo soy responsable de cosas de mucho valor",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("respondo ante mi jefe por los resultados de toda mi área de trabajo",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("en mi trabajo me dan órdenes contradictorias",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("considero que en mi trabajo me piden hacer cosas innecesarias",capitulo_id);
END$$
DELIMITER ;

DELIMITER $$ 
    DROP PROCEDURE IF EXISTS `preguntasCapitulo3` $$
    CREATE PROCEDURE `preguntasCapitulo3`(IN capitulo_id INT)
BEGIN
    INSERT INTO question (pregunta,capitulo_id) VALUE("trabajo horas extras más de tres veces a la semana",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("mi trabajo me exige laborar en días de descanso, festivos o fines de semana",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("considero que el tiempo en el trabajo es mucho y perjudica mis actividades familiares o personales",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("pienso en las actividades familiares o personales cuando estoy en mi trabajo",capitulo_id);
END$$
DELIMITER ;

DELIMITER $$ 
    DROP PROCEDURE IF EXISTS `preguntasCapitulo4` $$
    CREATE PROCEDURE `preguntasCapitulo4`(IN capitulo_id INT)
BEGIN
    INSERT INTO question (pregunta,capitulo_id) VALUE("mi trabajo permite que desarrolle nuevas habilidades",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("en mi trabajo puedo aspirar a un mejor puesto",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("durante mi jornada de trabajo puedo tomar pausas cuando las necesito",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("puedo decidir cuánto trabajo realizo durante la jornada laboral",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("puedo decidir la velocidad a la que realizo mis actividades en mi trabajo",capitulo_id);

END$$
DELIMITER ;

DELIMITER $$ 
    DROP PROCEDURE IF EXISTS `preguntasCapitulo5` $$
    CREATE PROCEDURE `preguntasCapitulo5`(IN capitulo_id INT)
BEGIN
    INSERT INTO question (pregunta,capitulo_id) VALUE("me informan con claridad cuáles son mis funciones",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("me explican claramente los resultados que debo obtener en mi trabajo",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("me informan con quién puedo resolver problemas o asuntos de trabajo",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("me permiten asistir a capacitaciones relacionadas con mi trabajo",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("recibo capacitación útil para hacer mi trabajo",capitulo_id);
END$$
DELIMITER ;

DELIMITER $$ 
    DROP PROCEDURE IF EXISTS `preguntasCapitulo6` $$
    CREATE PROCEDURE `preguntasCapitulo6`(IN capitulo_id INT)
BEGIN
    INSERT INTO question (pregunta,capitulo_id) VALUE("mi jefe tiene en cuenta mis puntos de vista y opiniones",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("mi jefe ayuda a solucionar los problemas que se presentan en el trabajo",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("puedo confiar en mis compañeros de trabajo",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("cuando tenemos que realizar trabajo de equipo los compañeros colaboran",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("mis compañeros de trabajo me ayudan cuando tengo dificultades",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("en mi trabajo puedo expresarme libremente sin interrupciones",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("recibo críticas constantes a mi persona y/o trabajo",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("recibo burlas, calumnias, difamaciones, humillaciones o ridiculizaciones",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("se ignora mi presencia o se me excluye de las reuniones de trabajo y en la toma de decisiones",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("se manipulan las situaciones de trabajo para hacerme parecer un mal trabajador",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("se ignoran mis éxitos laborales y se atribuyen a otros trabajadores",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("me bloquean o impiden las oportunidades que tengo para obtener ascenso o mejora en mi trabajo",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("he presenciado actos de violencia en mi centro de trabajo",capitulo_id);
END$$
DELIMITER ;

DELIMITER $$ 
    DROP PROCEDURE IF EXISTS `preguntasCapitulo7` $$
    CREATE PROCEDURE `preguntasCapitulo7`(IN capitulo_id INT)
BEGIN
    INSERT INTO question (pregunta,capitulo_id) VALUE("comunican tarde los asuntos del trabajo",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("dificultan el logro de los resultados del trabajo",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("ignoran las sugerencias para mejorar su trabajo",capitulo_id);
END$$
DELIMITER ;

DELIMITER $$ 
    DROP PROCEDURE IF EXISTS `obtenerCapitulos ` $$
    CREATE PROCEDURE `obtenerCapitulos `(IN empresa_id INT)
BEGIN
    SELECT * FROM capitulo WHERE empresa_id = empresa_id;
END$$
DELIMITER ;


