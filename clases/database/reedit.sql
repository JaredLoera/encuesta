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

DELIMITER $$ -- CAMBIANDO EL DELIMITADOR POR "$$"
DROP PROCEDURE IF EXISTS `crearCapitulos` $$
CREATE PROCEDURE `crearCapitulos`(IN empresa_id INT)
BEGIN
    DECLARE i INT DEFAULT 1;
    WHILE i <= 3 DO
        INSERT INTO capitulo (numcapitulo, company_id, descripcion) 
        VALUES (i, empresa_id, CONCAT('Capítulo ', i));
        SET i = i + 1;
    END WHILE;
END$$
DELIMITER ; -- EL DELIMITADOR VUELVE A SER ";"



DELIMITER $$ 
CREATE PROCEDURE `preguntasCapituloUno`(IN capitulo_id INT)
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
CREATE PROCEDURE `preguntasCapituloDos`(IN capitulo_id INT)
BEGIN
    INSERT INTO question (pregunta,capitulo_id) VALUE("en mi trabajo soy responsable de cosas de mucho valor",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("respondo ante mi jefe por los resultados de toda mi área de trabajo",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("en mi trabajo me dan órdenes contradictorias",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("considero que en mi trabajo me piden hacer cosas innecesarias",capitulo_id);
END$$
DELIMITER ;


    CREATE PROCEDURE `preguntasCapituloTres`(IN capitulo_id INT)
BEGIN
    INSERT INTO question (pregunta,capitulo_id) VALUE("trabajo horas extras más de tres veces a la semana",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("mi trabajo me exige laborar en días de descanso, festivos o fines de semana",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("considero que el tiempo en el trabajo es mucho y perjudica mis actividades familiares o personales",capitulo_id);
    INSERT INTO question (pregunta,capitulo_id) VALUE("pienso en las actividades familiares o personales cuando estoy en mi trabajo",capitulo_id);DELIMITER $$ 
END$$
DELIMITER ;

drop procedure if exists preguntasCapituloUno;