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
    primary key(id),
    foreign key(contacto_id) references contacto(id) ON DELETE CASCADE
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
    foreign key(company_id) references company(id) ON DELETE CASCADE,
    foreign key(contacto_id) references contacto(id)
);
create table capitulo(
    id int not null auto_increment,
    numcapitulo int not null,
    company_id int not null,
    descripcion varchar(255) not null,
    nombre_examen varchar(255) not null,
    primary key(id),
    foreign key(company_id) references company(id) ON DELETE CASCADE
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
    calsificacion int not null,
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
CREATE TABLE bloque(
    id INT NOT NULL AUTO_INCREMENT,
    folio VARCHAR(255) NOT NULL,
    company_id INT NOT NULL,
    fecha_ingreso datetime not null default current_timestamp,
    PRIMARY KEY(id),
    FOREIGN KEY(company_id) REFERENCES company(id) ON DELETE CASCADE
);

ALTER TABLE quiz ADD COLUMN bloque_id INT NULL;
ALTER TABLE quiz ADD FOREIGN KEY(bloque_id) REFERENCES bloque(id);

CREATE TABLE bloque_info(
id INT NOT NULL AUTO_INCREMENT,
nombre VARCHAR(255) NOT NULL,
company_id INT NOT NULL,
fecha_ingreso datetime not null default current_timestamp,
PRIMARY KEY(id),
FOREIGN KEY(company_id) REFERENCES company(id) ON DELETE CASCADE
);

ALTER TABLE capitulo ADD COLUMN bloqueinfo_id INT NULL;
ALTER TABLE capitulo ADD FOREIGN KEY(bloqueinfo_id) REFERENCES bloque_info(id)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE bloque ADD COLUMN bloqueinfo_id INT NULL;
ALTER TABLE bloque ADD FOREIGN KEY(bloqueinfo_id) REFERENCES bloque_info(id)
ON DELETE CASCADE
ON UPDATE CASCADE;

DELIMITER $$ 
DROP PROCEDURE IF EXISTS `crearBloquesInfoYRetornarId` $$ 
CREATE PROCEDURE `crearBloquesInfoYRetornarId`(IN empresa_id INT, OUT blockinfo_id INT)
BEGIN
    INSERT INTO bloque_info (nombre, company_id) VALUES ("Encuesta-1", empresa_id);
    SET blockinfo_id = LAST_INSERT_ID();
END$$
DELIMITER ;



DELIMITER $$ 
DROP PROCEDURE IF EXISTS `crearCapitulos` $$
CREATE PROCEDURE `crearCapitulos`(IN empresa_id INT, IN blockinfo_id INT)
BEGIN
    INSERT INTO capitulo (numcapitulo, company_id, descripcion, nombre_examen, bloqueinfo_id) VALUES 
    (1, empresa_id, "El trabajador considerara las condiciones de su centro de trabajo asi como la calidad y ritmo de trabajo", "Condiciones del centro de trabajo", blockinfo_id),
    (2, empresa_id, "Las siguientes preguntas están relacionadas con las actividades que realiza en us trabajo y las responsabilidades que tiene", "Responsabilidades del trabajo", blockinfo_id),
    (3, empresa_id, "Las siguientes preguntas están relacionadas con el tiempo destinado a su trabajo y a sus responsabilidades familiares", "Tiempo en el trabajo y casa", blockinfo_id),
    (4, empresa_id, "Las siguientes preguntas están relacionadas con las decisiones que puede tomar en su trabajo", "Decisiones en el trabajo", blockinfo_id),
    (5, empresa_id, "Las preguntas siguientes están relacionadas con la capacitación e información que recibe su trabajo", "Capacitación e información en el trabajo", blockinfo_id),
    (6, empresa_id, "Las preguntas siguientes están relacionadas con las relaciones con sus compañeros de trabajo y su jefe", "Relaciones en el trabajo", blockinfo_id),
    (7, empresa_id, "Las siguientes preguntas están relacionadas con las actitudes de los trabajadores que supervisa","Supervisiones con empelados", blockinfo_id);
      
END$$
DELIMITER ;

DELIMITER $$ 
DROP PROCEDURE IF EXISTS `preguntasCapitulo1` $$
CREATE PROCEDURE `preguntasCapitulo1`(IN capitulo_id INT)
BEGIN
	INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Mi trabajo me exige hacer mucho esfuerzo físico",capitulo_id,1,1);/*1*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Me preocupa sufrir un accidente en mi trabajo",capitulo_id,1,2);/*2*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Considero que las actividades que realizo son peligrosas",capitulo_id,1,3);/*3*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Por la cantidad de trabajo que tengo debo quedarme tiempo adicional a mi turno",capitulo_id,1,4);/*4*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Por la cantidad de trabajo que tengo debo trabajar sin parar",capitulo_id,1,5);/*5*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Considero que es necesario mantener un ritmo de trabajo acelerado",capitulo_id,1,6);/*6*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Mi trabajo exige que esté muy concentrado",capitulo_id,1,7);/*7*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Mi trabajo requiere que memorice mucha información",capitulo_id,1,8);/*8*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Mi trabajo exige que atienda varios asuntos al mismo tiempo",capitulo_id,1,9);/*9*/
END$$
DELIMITER ;

DELIMITER $$ 
DROP PROCEDURE IF EXISTS `preguntasCapitulo2` $$
CREATE PROCEDURE `preguntasCapitulo2`(IN capitulo_id INT)
BEGIN
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("En mi trabajo soy responsable de cosas de mucho valor",capitulo_id,1,10);/*10*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Respondo ante mi jefe por los resultados de toda mi área de trabajo",capitulo_id,1,11);/*11*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("En mi trabajo me dan órdenes contradictorias",capitulo_id,1,12);/*12*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Considero que en mi trabajo me piden hacer cosas innecesarias",capitulo_id,1,13);/*13*/
END$$
DELIMITER ;

DELIMITER $$ 
    DROP PROCEDURE IF EXISTS `preguntasCapitulo3` $$
    CREATE PROCEDURE `preguntasCapitulo3`(IN capitulo_id INT)
BEGIN
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Trabajo horas extras más de tres veces a la semana",capitulo_id,1,14);/*14*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Mi trabajo me exige laborar en días de descanso, festivos o fines de semana",capitulo_id,1,15);/*15*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Considero que el tiempo en el trabajo es mucho y perjudica mis actividades familiares o personales",capitulo_id,1,16);/*16*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Pienso en las actividades familiares o personales cuando estoy en mi trabajo",capitulo_id,1,17);/*17*/
END$$
DELIMITER ;

DELIMITER $$ 
    DROP PROCEDURE IF EXISTS `preguntasCapitulo4` $$
    CREATE PROCEDURE `preguntasCapitulo4`(IN capitulo_id INT)
BEGIN
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Mi trabajo permite que desarrolle nuevas habilidades",capitulo_id,2,18);/*18*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("En mi trabajo puedo aspirar a un mejor puesto",capitulo_id,2,19);/*19*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Durante mi jornada de trabajo puedo tomar pausas cuando las necesito",capitulo_id,2,20);/*20*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Puedo decidir cuánto trabajo realizo durante la jornada laboral",capitulo_id,2,21);/*21*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Puedo decidir la velocidad a la que realizo mis actividades en mi trabajo",capitulo_id,2,22);/*22*/

END$$
DELIMITER ;

DELIMITER $$ 
    DROP PROCEDURE IF EXISTS `preguntasCapitulo5` $$
    CREATE PROCEDURE `preguntasCapitulo5`(IN capitulo_id INT)
BEGIN
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Me informan con claridad cuáles son mis funciones",capitulo_id,2,23);/*23*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Me explican claramente los resultados que debo obtener en mi trabajo",capitulo_id,2,24);/*24*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Me informan con quién puedo resolver problemas o asuntos de trabajo",capitulo_id,2,25);/*25*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Me permiten asistir a capacitaciones relacionadas con mi trabajo",capitulo_id,2,26);/*26*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Recibo capacitación útil para hacer mi trabajo",capitulo_id,2,27);/*27*/
END$$
DELIMITER ;

DELIMITER $$ 
    DROP PROCEDURE IF EXISTS `preguntasCapitulo6` $$
    CREATE PROCEDURE `preguntasCapitulo6`(IN capitulo_id INT)
BEGIN
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Mi jefe tiene en cuenta mis puntos de vista y opiniones",capitulo_id,2,28);/*28*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Mi jefe ayuda a solucionar los problemas que se presentan en el trabajo",capitulo_id,2,29);/*29*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Puedo confiar en mis compañeros de trabajo",capitulo_id,2,30);/*30*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Cuando tenemos que realizar trabajo de equipo los compañeros colaboran",capitulo_id,2,31);/*31*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Mis compañeros de trabajo me ayudan cuando tengo dificultades",capitulo_id,2,32);/*32*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("En mi trabajo puedo expresarme libremente sin interrupciones",capitulo_id,2,33);/*33*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Recibo críticas constantes a mi persona y/o trabajo",capitulo_id,1,34);/*34*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Recibo burlas, calumnias, difamaciones, humillaciones o ridiculizaciones",capitulo_id,1,25);/*35*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Se ignora mi presencia o se me excluye de las reuniones de trabajo y en la toma de decisiones",capitulo_id,1,36);/*36*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Se manipulan las situaciones de trabajo para hacerme parecer un mal trabajador",capitulo_id,1,37);/*37*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Se ignoran mis éxitos laborales y se atribuyen a otros trabajadores",capitulo_id,1,38);/*38*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Me bloquean o impiden las oportunidades que tengo para obtener ascenso o mejora en mi trabajo",capitulo_id,1,39);/*39*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("He presenciado actos de violencia en mi centro de trabajo",capitulo_id,1,40);/*40*/
END$$
DELIMITER ;

DELIMITER $$ 
    DROP PROCEDURE IF EXISTS `preguntasCapitulo7` $$
    CREATE PROCEDURE `preguntasCapitulo7`(IN capitulo_id INT)
BEGIN
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Comunican tarde los asuntos del trabajo",capitulo_id,1,41);/*41*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Dificultan el logro de los resultados del trabajo",capitulo_id,1,42);/*42*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion,item) VALUE("Ignoran las sugerencias para mejorar su trabajo",capitulo_id,1,43);/*43*/
END$$
DELIMITER ;

DELIMITER $$ 
DROP PROCEDURE IF EXISTS `obtenerCapitulos` $$ 
CREATE PROCEDURE `obtenerCapitulos`(IN empresa_id INT)
BEGIN
    SELECT * FROM capitulo WHERE company_id = empresa_id;
END$$
DELIMITER ;

DELIMITER $$ 
DROP PROCEDURE IF EXISTS `obtenerBloquesInfo` $$ 
CREATE PROCEDURE `obtenerBloquesInfo`(IN empresa_id INT)
BEGIN
    SELECT * FROM bloques_info WHERE company_id = empresa_id;
END$$
DELIMITER ;


